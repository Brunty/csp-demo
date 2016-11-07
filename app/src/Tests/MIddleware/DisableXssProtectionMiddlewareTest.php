<?php

namespace App\Tests\Middleware;

use App\Middleware\DisableXssProtectionMiddleware;
use Psr\Http\Message\ResponseInterface;
use Slim\Http\Response;
use Zend\Diactoros\ServerRequestFactory;

class DisableXssProtectionMiddlewareTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @test
     */
    public function it_adds_the_header_to_the_response()
    {
        $request = ServerRequestFactory::fromGlobals();
        $response = new Response();

        $middleware = new DisableXssProtectionMiddleware;

        /**
         * @var ResponseInterface $middlewareResponse
         */
        $middlewareResponse = $middleware(
            $request,
            $response,
            function ($request, $response) {
                return $response;
            }
        );

        self::assertEquals(0, $middlewareResponse->getHeader('X-XSS-Protection')[0]);
    }
}
