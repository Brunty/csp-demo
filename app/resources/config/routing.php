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
            'the-gibson.html.twig'
        );
    }
);

$app->get(
    '/garbage-files',
    function (Request $request, Response $response, $args) {
        $filename = $this->config['app']['dirs']['root'] . '/var/cache/note';
        $content = '';

        if (file_exists($filename)) {
            $content = file_get_contents($filename);
        }

        return $this->view->render(
            $response,
            'garbage-files.html.twig',
            [
                'secure_message' => $request->getQueryParams()['secure_message'] ?? null,
                'note_content'   => $content
            ]
        );
    }
);

$app->post(
    '/garbage-files',
    function (Request $request, Response $response, $args) {
        $filename = $this->config['app']['dirs']['root'] . '/var/cache/note';
        file_put_contents($filename, $request->getParsedBody()['note']);

        return $response->withHeader('Location', '/garbage-files?secure_message=Files updated');
    }
);

$app->get(
    '/hello/{name}',
    function (Request $request, Response $response, $args) {
        return $this->view->render($response, 'home.html.twig', ['name' => $args['name']]);
    }
);
