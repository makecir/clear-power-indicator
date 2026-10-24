#!/bin/bash
# 動作確認用のスモークテスト。Docker 環境 (compose.yaml) で起動したアプリに対して
# 新規登録 → プロフィール編集 → ランプ登録 → 各ページ閲覧 → 設定変更 → ログアウト を順に行い、
# 各レスポンスのステータスと HTML を出力先に保存する。
# CakePHP / PHP のバージョンを上げる前後で実行し、出力を diff して挙動の差を確認する。
#
# 使い方: tests/smoke/run.sh <本番スキーマの SQL> <出力先ディレクトリ>
#   本番スキーマは mysqldump --no-data で取得したもの。DB の中身は毎回作り直す。
set -u

SCHEMA_SQL=${1:?本番スキーマの SQL ファイルを指定してください}
OUT=${2:?出力先ディレクトリを指定してください}
BASE=${BASE_URL:-http://localhost:8765}
ROOT=$(cd "$(dirname "$0")/../.." && pwd)

mkdir -p "$OUT"
rm -f "$OUT"/*.html "$OUT/summary.txt"
JAR=$(mktemp)
trap 'rm -f "$JAR"' EXIT

mysql_db() {
    docker compose -f "$ROOT/compose.yaml" exec -T db mysql -ucpi -pcpi "$@" 2>/dev/null
}

# DB を作り直す
mysql_db -e "DROP DATABASE IF EXISTS cpi_db; CREATE DATABASE cpi_db CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;"
mysql_db cpi_db < "$SCHEMA_SQL"
mysql_db cpi_db < "$ROOT/docker/db/seed.sql"
# 前回の実行で残ったアップロードファイルを消す (最後に、今回の実行で残っていないかを数える)
find "$ROOT/webroot/uploaded" -type f ! -name .gitkeep -delete
docker compose -f "$ROOT/compose.yaml" exec -T app bin/cake cache clear_all > /dev/null

n=0
# request <名前> <メソッド> <パス> [curl の追加引数...]
request() {
    local name=$1 method=$2 path=$3
    shift 3
    n=$((n + 1))
    local file
    file=$(printf "%s/%02d_%s.html" "$OUT" "$n" "$name")
    # POST などには CSRF トークン (Cookie の値) をヘッダで付ける
    local csrf
    csrf=$(awk '$6 == "csrfToken" { print $7 }' "$JAR")
    # 4.6 以降は Cookie の値が URL エンコードされているので戻す
    csrf=$(printf '%b' "${csrf//%/\\x}")
    local result
    result=$(curl -s -o "$file" -b "$JAR" -c "$JAR" -X "$method" -H "X-CSRF-Token: $csrf" -w "%{http_code} %{redirect_url}" "$@" "$BASE$path")
    printf "%02d %-24s %-6s %-28s %s\n" "$n" "$name" "$method" "$path" "${result/$BASE/}" | tee -a "$OUT/summary.txt"
}

lamp_csv() {
    # e-amusement のプレイデータ CSV と同じ 41 列の形式。ANOTHER は 27 列目、LEGGENDARIA は 34 列目から
    echo "バージョン,タイトル,ジャンル,アーティスト,プレー回数,B難易度,BEXスコア,BPGreat,BGreat,BMISS,Bクリアタイプ,BDJ LEVEL,N難易度,NEXスコア,NPGreat,NGreat,NMISS,Nクリアタイプ,NDJ LEVEL,H難易度,HEXスコア,HPGreat,HGreat,HMISS,Hクリアタイプ,HDJ LEVEL,A難易度,AEXスコア,APGreat,AGreat,AMISS,Aクリアタイプ,ADJ LEVEL,L難易度,LEXスコア,LPGreat,LGreat,LMISS,Lクリアタイプ,LDJ LEVEL,最終プレー日時"
    local line
    for line in "$@"; do
        IFS='|' read -r title a_clear a_miss l_clear l_miss <<< "$line"
        echo "tricoro,$title,GENRE,ARTIST,10,0,0,0,0,---,NO PLAY,---,0,0,0,0,---,NO PLAY,---,0,0,0,0,---,NO PLAY,---,12,2000,800,400,$a_miss,$a_clear,AA,12,1900,700,500,$l_miss,$l_clear,A,2026-01-01 00:00"
    done
}

profile() {
    request "$1_edit_profile" POST "/users/edit/$2" \
        --data-urlencode "_method=PUT" \
        --data-urlencode "user_detail[dj_name]=$3" \
        --data-urlencode "user_detail[iidx_id]=$4" \
        --data-urlencode "user_detail[grade_sp]=17" \
        --data-urlencode "user_detail[grade_dp]=0" \
        --data-urlencode "user_detail[arena_sp]=0" \
        --data-urlencode "user_detail[arena_dp]=0" \
        --data-urlencode "user_detail[twitter_id]="
}

# --- 未ログインで閲覧できるページ
request about GET /pages/about
request scores GET /scores
request scores_view GET /scores/view/1
request scores_tables GET /scores/tables
request login_form GET /users/login
request add_form GET /users/add

# --- alice: 新規登録 → プロフィール → ランプ登録 (1 回目・2 回目)
request alice_add_mismatch POST /users/add --data-urlencode "username=alice01" --data-urlencode "password=password1" --data-urlencode "retype_password=password2"
request alice_add_invalid POST /users/add --data-urlencode "username=a!" --data-urlencode "password=password1" --data-urlencode "retype_password=password1"
request alice_add POST /users/add --data-urlencode "username=alice01" --data-urlencode "password=password1" --data-urlencode "retype_password=password1"
request alice_view_after_add GET /users/view/1
request alice_edit_form GET /users/edit/1
profile alice 1 alice 12345678
request alice_upload_1 POST /users/edit/1 --data-urlencode "upload-text=$(lamp_csv \
    'Sample Song 01|HARD CLEAR|5|CLEAR|20' \
    'Sample Song 02|EASY CLEAR|30|FAILED|---' \
    'Sample Song 03|ASSIST CLEAR|40|NO PLAY|---' \
    'Unknown Song|CLEAR|1|NO PLAY|---')"
request alice_history_1 GET /user-histories/view/1
request alice_upload_2 POST /users/edit/1 --data-urlencode "upload-text=$(lamp_csv \
    'Sample Song 01|FULLCOMBO CLEAR|0|EX HARD CLEAR|2' \
    'Sample Song 02|CLEAR|10|EASY CLEAR|25' \
    'Sample Song 03|ASSIST CLEAR|40|NO PLAY|---' \
    'Sample Song 04|HARD CLEAR|8|NO PLAY|---' \
    'Sample Song 06|CLEAR|12|EASY CLEAR|30')"
request alice_history_2 GET /user-histories/view/2
request alice_view GET /users/view/1
request alice_tables GET /users/tables/1
request alice_scores_view GET /scores/view/1
request alice_recalc GET /users/recalclate/1
request alice_add_while_login GET /users/add
request alice_logout GET /users/logout

# --- bob: 新規登録 → ランプ登録 → 非公開に設定
request bob_add POST /users/add --data-urlencode "username=bob_0001" --data-urlencode "password=password2" --data-urlencode "retype_password=password2"
profile bob 2 bob 1111-2222
request bob_upload POST /users/edit/2 --data-urlencode "upload-text=$(lamp_csv \
    'Sample Song 01|CLEAR|15|EASY CLEAR|30' \
    'Sample Song 05|EX HARD CLEAR|3|HARD CLEAR|9')"
request bob_setting_form GET /users/setting/2
request bob_set_private POST /users/setting/2 --data-urlencode "_method=PUT" --data-urlencode "private_level=1" --data-urlencode "follow_pass=secret_word" --data-urlencode "user_detail[twitter_id]=" --data-urlencode "email=bob@example.com"
request bob_edit_other GET /users/edit/1
request bob_logout GET /users/logout

# --- alice: ログイン → bob を閲覧・フォロー・比較 → パスワード変更
request alice_login_wrong POST /users/login --data-urlencode "username=alice01" --data-urlencode "password=wrongpass"
request alice_login POST /users/login --data-urlencode "username=alice01" --data-urlencode "password=password1"
request users_index GET /users
request bob_view_private GET /users/view/2
request alice_compare_denied GET /users/compare/1/2
request alice_follow_form GET /users/following/1/2
request alice_follow_wrong POST /users/following/1/2 --data-urlencode "phrase=wrong_word"
request alice_follow POST /users/following/1/2 --data-urlencode "phrase=secret_word"
request bob_view_followed GET /users/view/2
request bob_tables_followed GET /users/tables/2
request alice_compare GET /users/compare/1/2
request alice_view_following GET /users/view/1
request alice_pass_wrong POST /users/setting/1 --data-urlencode "_method=PUT" --data-urlencode "old_password=nope" --data-urlencode "new_password=password9"
request alice_pass_change POST /users/setting/1 --data-urlencode "_method=PUT" --data-urlencode "old_password=password1" --data-urlencode "new_password=password9"
request alice_unfollow GET /users/following/1/2
request alice_logout_2 GET /users/logout
request alice_login_new_pass POST /users/login --data-urlencode "username=alice01" --data-urlencode "password=password9"
request alice_history_delete POST /user-histories/delete/1
request alice_view_after_reset GET /users/view/1
request alice_delete_wrong POST /users/delete/1 --data-urlencode "password=nope"
request alice_delete POST /users/delete/1 --data-urlencode "password=password9"
request alice_view_deleted GET /users/view/1

# --- 未ログインでの保護ページ
request guest_edit GET /users/edit/2
request guest_setting GET /users/setting/2

# --- レーティング算出 (IndicatorComponent::setRating)
# 腕前 (レーティング換算) を決めたユーザーごとに、seed.sql の譜面の強さから決まるランプで全 30 曲を登録する。
# 腕前の順にレーティングと順位が並ぶことと、更新前後で値が一致することを確かめる。
lamp_names=("NO PLAY" "FAILED" "ASSIST CLEAR" "EASY CLEAR" "CLEAR" "HARD CLEAR" "EX HARD CLEAR" "FULLCOMBO CLEAR")

# skill_lamp <腕前> <譜面の強さ> <ずらす段数>: 腕前と譜面の強さの差 150 ごとにランプが 1 段上がる
skill_lamp() {
    local diff=$(($1 - $2))
    local lamp=$(( diff >= 0 ? 3 + diff / 150 : 3 - (149 - diff) / 150 ))
    lamp=$((lamp + $3))
    ((lamp < 1)) && lamp=1
    ((lamp > 7)) && lamp=7
    echo "${lamp_names[$lamp]}"
}

# skill_csv <腕前> [ずらす段数]: 全 30 曲の ANOTHER / LEGGENDARIA のランプを CSV にする
skill_csv() {
    local lines=() n another legg
    for n in $(seq 1 30); do
        another=$((1200 + (n - 1) * 45))
        legg=$((another + 150))
        lines+=("$(printf 'Sample Song %02d' "$n")|$(skill_lamp "$1" "$another" "${2:-0}")|10|$(skill_lamp "$1" "$legg" "${2:-0}")|20")
    done
    lamp_csv "${lines[@]}"
}

# rating_user <名前> <パスワード> <腕前>: 新規登録してランプを登録する。ユーザー ID を uid に入れる
# (request の連番を保つため、サブシェルで呼ばない)
rating_user() {
    request "$1_add" POST /users/add --data-urlencode "username=$1" --data-urlencode "password=$2" --data-urlencode "retype_password=$2"
    uid=$(mysql_db -N cpi_db -e "SELECT id FROM users WHERE username = '$1'")
    request "$1_upload" POST "/users/edit/$uid" --data-urlencode "upload-text=$(skill_csv "$3")"
}

rating_user r_beginner password1 1300
request r_beginner_logout GET /users/logout
rating_user r_middle password1 1800
middle=$uid
# 同じデータをもう一度登録する (ランプの変化なし)
request r_middle_upload_same POST "/users/edit/$middle" --data-urlencode "upload-text=$(skill_csv 1800)"
# 1 段下げたデータを登録する (「矛盾したデータ」の警告が出て concise_logs に記録される)
request r_middle_upload_lower POST "/users/edit/$middle" --data-urlencode "upload-text=$(skill_csv 1800 -1)"
request r_middle_view GET "/users/view/$middle"
request r_middle_logout GET /users/logout
rating_user r_advanced password1 2200
advanced=$uid
# 同じシーズンなので再計算は不要
request r_advanced_recalc_same_season GET "/users/recalclate/$advanced"
# 前のシーズンのレーティングとして保存されている状態にして再計算する
mysql_db cpi_db -e "UPDATE user_details SET season = 17 WHERE user_id = '$advanced'"
request r_advanced_recalc_new_season GET "/users/recalclate/$advanced"
request r_advanced_view GET "/users/view/$advanced"
request r_advanced_logout GET /users/logout
rating_user r_expert password1 2600
expert=$uid
request r_expert_logout GET /users/logout
rating_user r_allfc password1 9999
allfc=$uid
request r_allfc_tables GET "/users/tables/$allfc"
request r_allfc_compare GET "/users/compare/$allfc/$expert"
request r_allfc_logout GET /users/logout
# CSV ファイルをアップロードしてランプを登録する (CSVComponent)。改行が LF と CRLF の両方を試す
request r_csv_add POST /users/add --data-urlencode "username=r_csv" --data-urlencode "password=password1" --data-urlencode "retype_password=password1"
csv_user=$(mysql_db -N cpi_db -e "SELECT id FROM users WHERE username = 'r_csv'")
skill_csv 2000 > "$OUT/playdata_lf.csv"
skill_csv 2100 | sed 's/$/\r/' > "$OUT/playdata_crlf.csv"
request r_csv_upload_lf POST "/users/edit/$csv_user" -F "_method=POST" -F "upload-csv=@$OUT/playdata_lf.csv;filename=playdata.csv;type=text/csv"
request r_csv_upload_crlf POST "/users/edit/$csv_user" -F "_method=POST" -F "upload-csv=@$OUT/playdata_crlf.csv;filename=playdata.csv;type=text/csv"
# ファイル名にディレクトリの移動 (../) や % を含む場合も、ファイル名を使わずに読み込めること
request r_csv_upload_traversal POST "/users/edit/$csv_user" -F "_method=POST" -F "upload-csv=@$OUT/playdata_lf.csv;filename=../../config/playdata.csv;type=text/csv"
request r_csv_upload_percent POST "/users/edit/$csv_user" -F "_method=POST" -F "upload-csv=@$OUT/playdata_crlf.csv;filename=%d%s.csv;type=text/csv"
request r_csv_view GET "/users/view/$csv_user"
request r_csv_logout GET /users/logout
# ランプが 1 つもない状態で再計算する
request r_nolamp_add POST /users/add --data-urlencode "username=r_nolamp" --data-urlencode "password=password1" --data-urlencode "retype_password=password1"
nolamp=$(mysql_db -N cpi_db -e "SELECT id FROM users WHERE username = 'r_nolamp'")
mysql_db cpi_db -e "UPDATE user_details SET season = 17 WHERE user_id = '$nolamp'"
request r_nolamp_recalc GET "/users/recalclate/$nolamp"
request r_nolamp_view GET "/users/view/$nolamp"
request r_nolamp_logout GET /users/logout

# ページ下部の DebugKit ツールバーなど、実行ごとに変わる部分を取り除く
for f in "$OUT"/*.html; do
    sed -E -i.bak \
        -e 's#<script id="__debug_kit_script"[^>]*></script>##g' \
        -e 's#/debug-kit/toolbar/[0-9a-f-]+#/debug-kit/toolbar/X#g' \
        "$f" && rm -f "$f.bak"
done

# アップロードされた CSV はサーバに残らない (読み込んだあと削除される)
echo "webroot/uploaded: $(find "$ROOT/webroot/uploaded" -type f ! -name .gitkeep | wc -l | tr -d ' ') files" | tee -a "$OUT/summary.txt"

echo "DB:"
mysql_db cpi_db -e "SELECT 'users', COUNT(*) FROM users UNION ALL SELECT 'user_details', COUNT(*) FROM user_details UNION ALL SELECT 'user_lamps', COUNT(*) FROM user_lamps UNION ALL SELECT 'user_histories', COUNT(*) FROM user_histories UNION ALL SELECT 'lamp_changes', COUNT(*) FROM lamp_changes UNION ALL SELECT 'followings', COUNT(*) FROM followings UNION ALL SELECT 'concise_logs', COUNT(*) FROM concise_logs" | tee -a "$OUT/summary.txt"
mysql_db cpi_db -e "SELECT user_details.user_id, users.username, dj_name, iidx_id, CAST(rating AS DOUBLE) AS rating, standing, season FROM user_details JOIN users ON users.id = user_details.user_id ORDER BY rating; SELECT id, user_id, CAST(rating_cur AS DOUBLE) AS rating_cur, CAST(rating_diff AS DOUBLE) AS rating_diff, standing_cur, standing_diff, is_season_change FROM user_histories ORDER BY id; SELECT type, user_id FROM concise_logs; SELECT user_id, lamp, COUNT(*) FROM user_lamps GROUP BY user_id, lamp ORDER BY user_id, lamp; SELECT * FROM user_lamps ORDER BY user_id, score_id; SELECT * FROM lamp_changes ORDER BY id" | sed -E 's/[0-9]{4}-[0-9]{2}-[0-9]{2} [0-9:]{8}/<datetime>/g' | tee -a "$OUT/summary.txt"
