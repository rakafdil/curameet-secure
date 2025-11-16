<?php
return [
    'paths' => ['api/*', 'sanctum/csrf-cookie', 'files/*'],

    'allowed_methods' => ['*'],

    'allowed_origins' => [
        'http://localhost:3000',
        'https://curameet-secure.duckdns.org',
        'https://api.curameet-secure.duckdns.org'
    ],

    'allowed_origins_patterns' => [
        '/^https?:\/\/([a-z0-9-]+\.)?api.curameet-secure.duckdns\.org$/',
    ],
    'allowed_headers' => [''],

    'exposed_headers' => [],

    'max_age' => 86400,

    'supports_credentials' => true,
];
