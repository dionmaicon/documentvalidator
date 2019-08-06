<?php

return [
    'mapping'         => 'annotations',
    'paths'           => [
        base_path('app/Models'),
        base_path('app'),
    ],
    'proxy'           => [
        'directory' => storage_path('doctrine/proxies'),
    ],
    'hydrator'        => [
        'directory' => storage_path('doctrine/hydrators'),
    ],
];