<?php

use App\Middleware\CspMiddleware;
use App\Middleware\DisableXssProtectionMiddleware;
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

$cspMiddleWare = new CspMiddleware($app->getContainer()['app.generator.nonce.generated_nonce']);

/*
 * Browsers now implement some built-in XSS protection if they detect it in request attributes.
 *
 * To show some CSP stuff, we'll just disable that here so it doesn't interfere with showing
 * what I want to show.
 */
$app->add(new DisableXssProtectionMiddleware);

$app->get(
    '/',
    function (Request $request, Response $response) {
        return $this->view->render($response, 'home.html.twig');
    }
);

$app->get(
    '/the-gibson',
    function (Request $request, Response $response) {
        return $this->view->render(
            $response,
            'the-gibson.html.twig',
            ['nonce' => $this['app.generator.nonce.generated_nonce']]
        );
    }
)->add($cspMiddleWare);

$app->map(
    ['GET', 'POST'],
    '/garbage-files',
    function (Request $request, Response $response, $args) {
        return $this->view->render(
            $response,
            'garbage-files.html.twig',
            ['secure_message' => $request->getQueryParams()['secure_message'] ?? null]
        );
    }
);

$app->get(
    '/hello/{name}',
    function (Request $request, Response $response, $args) {
        return $this->view->render($response, 'home.html.twig', ['name' => $args['name']]);
    }
);