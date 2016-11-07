<?php

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

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
);

$app->get(
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
