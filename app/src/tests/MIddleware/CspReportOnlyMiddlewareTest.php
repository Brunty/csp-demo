<?php

namespace App\Tests\Middleware;

use App\Middleware\CspReportOnlyMiddleware;
use Psr\Http\Message\ResponseInterface;
use Slim\Http\Response;
use Zend\Diactoros\ServerRequestFactory;

class CspReportOnlyMiddlewareTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @test
     */
    public function it_adds_the_header_to_the_response()
    {
        $request = ServerRequestFactory::fromGlobals(['REMOTE_ADDR' => '192.168.1.1']);
        $response = new Response();

        $middleware = new CspReportOnlyMiddleware("default-src: 'none'; script-src: 'self';");

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

        self::assertEquals(
            "default-src: 'none'; script-src: 'self';",
            $middlewareResponse->getHeader('Content-Security-Policy-Report-Only')[0]
        );
    }

    /**
     * @test
     */
    public function it_adds_the_header_with_a_nonce_to_the_response()
    {
        $request = ServerRequestFactory::fromGlobals(['REMOTE_ADDR' => '192.168.1.1']);
        $response = new Response();

        $middleware = new CspReportOnlyMiddleware(
            "default-src: 'none'; script-src: 'self' 'nonce-%s';",
            'thisIsATotallySecureNonceString'
        );

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

        self::assertEquals(
            "default-src: 'none'; script-src: 'self' 'nonce-thisIsATotallySecureNonceString';",
            $middlewareResponse->getHeader('Content-Security-Policy-Report-Only')[0]
        );
    }

    /**
     * @test
     */
    public function it_adds_the_header_to_the_response_if_no_nonce_is_given()
    {
        $request = ServerRequestFactory::fromGlobals(['REMOTE_ADDR' => '192.168.1.1']);
        $response = new Response();

        $middleware = new CspReportOnlyMiddleware("default-src: 'none'; script-src: 'self' 'nonce-%s';");

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

        self::assertEquals(
            "default-src: 'none'; script-src: 'self' 'nonce-';",
            $middlewareResponse->getHeader('Content-Security-Policy-Report-Only')[0]
        );
    }
}
