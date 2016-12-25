<?php

use App\Generator\NonceGenerator;

$container = $app->getContainer();

$container['view'] = function ($container) {
    $view = new \Slim\Views\Twig(realpath(__DIR__ . '/../resources/views'));
    $basePath = rtrim(str_ireplace('index.php', '', $container['request']->getUri()->getBasePath()), '/');
    $view->addExtension(new Slim\Views\TwigExtension($container['router'], $basePath));

    $randomlyGeneratedNonce = (new NonceGenerator)->generateNonce();
    // Add global to twig so we don't have to add the nonce to every view we render
    $view->getEnvironment()
         ->addGlobal('nonce', $randomlyGeneratedNonce);

    return $view;
};

$container['app.generator.nonce'] = function ($container) {
    return new NonceGenerator;
};

$container['app.generator.nonce.generated_nonce'] = function ($container) {
    /** @var NonceGenerator $nonceGenerator */
    $nonceGenerator = $container['app.generator.nonce'];

    return $nonceGenerator->generateNonce();
};
