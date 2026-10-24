# 開発・検証用の Docker 環境

PHP / CakePHP のバージョンを上げるときに、手元で動作を確かめるための環境。本番では使わない。

- `app`: PHP + Apache。既定は本番と同じ PHP 7.4。`PHP_VERSION` で切り替えられる
- `db`: MySQL 8.0（本番は MySQL 5.7。理由は `compose.yaml` のコメントを参照）

## 起動

```sh
docker compose up -d --build
docker compose exec app composer install
```

`http://localhost:8765` で開ける。`config/app_local.php` が無ければ、起動時に `docker/php/app_local.php` がコピーされる。

PHP のバージョンを変えるときは次のようにする。

```sh
PHP_VERSION=8.1 docker compose up -d --build
```

ただし `composer.json` の `config.platform.php` で PHP 7.4.33 に固定しているため、`composer.lock` は PHP 7.4 向けのパッケージのまま。PHP 8 系で確かめるときは、固定を外して `composer update` し直す。

## DB の用意

リポジトリにはスキーマを置いていないので、本番から `mysqldump --no-data` で取ったものを読み込む。そのあと動作確認用のダミーデータを入れる。ダミーデータは 30 曲 × ANOTHER / LEGGENDARIA の譜面と、24196 人分のゴーストとそのランプで、すべて架空のもの（作り方は `docker/db/seed.sql` のコメントを参照）。

```sh
docker compose exec -T db mysql -ucpi -pcpi cpi_db < /path/to/schema.sql
docker compose exec -T db mysql -ucpi -pcpi cpi_db < docker/db/seed.sql
```

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

- レーティングの計算は `ghost_lamps` を全件読み込むので、ダミーデータでは約 250MB のメモリを使う。`app` の `memory_limit` は `PHP_MEMORY_LIMIT`（既定 512M）で変えられる
- 更新前のコードと比べるときは、`git worktree` で更新前のコードを取り出し、同じイメージで別のコンテナ（例: ポート 8766）を立てて `BASE_URL=http://localhost:8766 tests/smoke/run.sh ...` を実行する。HTML にはポート番号が入るので、比べるときは置き換える
