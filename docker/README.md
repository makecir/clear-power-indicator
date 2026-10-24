# 開発・検証用の Docker 環境

PHP / CakePHP のバージョンを上げるときに、手元で動作を確かめるための環境。本番では使わない。

- `app`: PHP 8.3 + Apache（本番 (Xserver) も PHP 8.3）
- `db`: MySQL 8.0（本番は MySQL 5.7。理由は `compose.yaml` のコメントを参照）。5.7 にはハッシュ結合がないため、8.0 でも無効にして、結合の遅さを本番と揃えている

## 起動

```sh
docker compose up -d --build
docker compose exec app composer install
```

`http://localhost:8765` で開ける。`config/app_local.php` が無ければ、起動時に `docker/php/app_local.php` がコピーされる。

PHP のバージョンは `PHP_VERSION` で変えられるが、今のパッケージで動くのは PHP 8.3 だけ。

- `composer.json` で PHP 8.3 以上を要求しているため、8.2 以下では動かない
- CakePHP 4 が使う laminas/laminas-diactoros 2.x が PHP 8.3 までの対応のため、8.4 以上は CakePHP 5 に上げてから使う

## DB の用意

リポジトリにはスキーマを置いていないので、本番から `mysqldump --no-data` で取ったものを読み込む。そのあと動作確認用のダミーデータを入れる。ダミーデータは 30 曲 × ANOTHER / LEGGENDARIA の譜面と、24196 人分のゴーストとそのランプで、すべて架空のもの（作り方は `docker/db/seed.sql` のコメントを参照）。

```sh
docker compose exec -T db mysql -ucpi -pcpi cpi_db < /path/to/schema.sql
docker compose exec -T db mysql -ucpi -pcpi cpi_db < docker/db/seed.sql
```

## 本番の DB に手で行った変更

リポジトリではスキーマを管理していないため、本番の DB に直接行った変更をここに残す。手元で使うスキーマは、変更のあとに取り直したものを使う。DB の構造を変えたら、本番で `php bin/cake.php cache clear_all` を実行して CakePHP のテーブル定義のキャッシュも消す。

| 日付 | 変更 | 理由 |
|---|---|---|
| 2026/10/25 | `ALTER TABLE user_details MODIFY user_id INT(11) NOT NULL;`（変更前は `varchar(16) CHARACTER SET utf8`） | `users.id`（int）と型が違い、MySQL 5.7 では結合に `user_details` の主キーが使えず、ユーザー一覧（約 1.3 万人）の表示に 20〜40 秒かかっていた。変更後は約 0.7 秒 |

戻すとき：`ALTER TABLE user_details MODIFY user_id VARCHAR(16) CHARACTER SET utf8 NOT NULL;`

## スモークテスト

新規登録 → ランプ登録 → 各ページの閲覧 → 設定変更 → 退会 までを順に実行し、各レスポンスのステータスと HTML、最後の DB の状態を保存する。DB は毎回作り直す。

```sh
tests/smoke/run.sh /path/to/schema.sql /tmp/smoke-before
# バージョンを上げたあと
tests/smoke/run.sh /path/to/schema.sql /tmp/smoke-after
diff /tmp/smoke-before/summary.txt /tmp/smoke-after/summary.txt
```

腕前を変えた 5 人のユーザーでランプを登録し、レーティングの計算（`IndicatorComponent::setRating`）も確かめる。シーズンが変わったあとの再計算と、ランプを下げたデータの登録も含む。

`summary.txt` が一致していれば、ステータスコード・リダイレクト先・DB に保存された値（レーティングなど）は変わっていない。HTML の差分は個別に確認する。非推奨 API の呼び出しは `logs/debug.log` に記録される。

## 注意

- `app` の `memory_limit` は `PHP_MEMORY_LIMIT`（既定 512M）で変えられる
- 更新前のコードと比べるときは、`git worktree` で更新前のコードを取り出し、同じイメージで別のコンテナ（例: ポート 8766）を立てて `BASE_URL=http://localhost:8766 tests/smoke/run.sh ...` を実行する。HTML にはポート番号が入るので、比べるときは置き換える
