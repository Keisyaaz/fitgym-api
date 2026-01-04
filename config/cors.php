<?php

return [

    'paths' => [
        'api/*',
        'storage/*',   // 🔥 INI PENTING UNTUK GAMBAR
    ],

    'allowed_methods' => ['*'],

    'allowed_origins' => [
        'http://localhost:*',
        'http://127.0.0.1:*',
    ],

    'allowed_headers' => ['*'],

    'exposed_headers' => [],

    'max_age' => 0,

    'supports_credentials' => false,
];
