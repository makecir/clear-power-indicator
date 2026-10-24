#!/bin/sh
set -e

# config/app_local.php が無ければ Docker 用の設定を置く（既にあれば上書きしない）
if [ ! -f config/app_local.php ]; then
    cp docker/php/app_local.php config/app_local.php
fi

mkdir -p logs tmp
# macOS のバインドマウントでは chown できないことがあるため失敗しても続行する
chmod -R a+rwX logs tmp 2>/dev/null || true

exec docker-php-entrypoint "$@"
