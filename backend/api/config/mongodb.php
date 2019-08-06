<?php

return [
    'default' => env('MONGODB_DB_CONNECTION', 'mongodb'),
    'connections' => [
        env('MONGODB_DB_CONNECTION', 'mongodb') => [
            'host'     => 'mongodb://validator_mongodb:27017',
            'database' => env('MONGODB_DB_DATABASE', 'demo'),
            'username' => env('MONGODB_DB_USERNAME', ''),
            'password' => env('MONGODB_DB_PASSWORD', ''),
            'timezone' => env('MONGODB_DB_TIMEZONE', '+00:00'),
        ]
    ],
];