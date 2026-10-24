<?php
/*
 * Docker 開発環境用の設定。docker/php/entrypoint.sh が config/app_local.php にコピーする。
 */
return [
    'debug' => filter_var(env('DEBUG', true), FILTER_VALIDATE_BOOLEAN),

    'Security' => [
        'salt' => env('SECURITY_SALT', 'docker-dev-salt-0123456789abcdef0123456789abcdef'),
        'cookieSalt' => env('SECURITY_COOKIE_SALT', 'docker-dev-cookie-salt-0123456789abcdef0123456789'),
    ],

    'Datasources' => [
        'default' => [
            'host' => 'db',
            'username' => 'cpi',
            'password' => 'cpi',
            'database' => 'cpi_db',
        ],
        'test' => [
            'host' => 'db',
            'username' => 'cpi',
            'password' => 'cpi',
            'database' => 'cpi_test',
        ],
        'debug_kit' => [
            'host' => 'db',
            'username' => 'cpi',
            'password' => 'cpi',
            'database' => 'cpi_db',
        ],
    ],
];
