<?php

$container = $app->getContainer();

$container['config'] = [
    'security' => require __DIR__ . '/../resources/config/security.php',
    'app' => [
        'dirs' => [
            'root' => realpath(__DIR__ . '/../../')
        ]
    ]
];
