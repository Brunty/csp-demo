<?php

use App\Generator\NonceGenerator;

$container = $app->getContainer();

$container['view'] = function ($container) {
    $view = new \Slim\Views\Twig(realpath(__DIR__ . '/../resources/views'));

    // Instantiate and add Slim specific extension
    $basePath = rtrim(str_ireplace('index.php', '', $container['request']->getUri()->getBasePath()), '/');
    $view->addExtension(new Slim\Views\TwigExtension($container['router'], $basePath));

    return $view;
};

$container['app.generator.nonce'] = function ($container) {
    $nonceGenerator = new NonceGenerator;
    return $nonceGenerator;
};

$container['app.generator.nonce.generated_nonce'] = function($container) {
    /** @var NonceGenerator $nonceGenerator*/
    $nonceGenerator = $container['app.generator.nonce'];
    return $nonceGenerator->generateNonce();
};
