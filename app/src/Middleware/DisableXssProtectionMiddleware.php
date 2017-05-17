<?php

namespace App\Middleware;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class DisableXssProtectionMiddleware
{

    /**
     * Example middleware invokable class
     *
     * @param  \Psr\Http\Message\ServerRequestInterface $request  PSR7 request
     * @param  \Psr\Http\Message\ResponseInterface      $response PSR7 response
     * @param  callable                                 $next     Next middleware
     *
     * @throws \InvalidArgumentException
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function __invoke(
        ServerRequestInterface $request,
        ResponseInterface $response,
        callable $next
    ): ResponseInterface {
        /** @var ResponseInterface $response */
        $response = $next($request, $response);

        /*
         * https://scotthelme.co.uk/hardening-your-http-response-headers/#x-xss-protection
         *
         * Possible values:
         *      0                   disables protection
         *      1                   enables protection: sanitise script / input before sending to server
         *      1; mode=block       enables protection: block the response rather than sanitising
         */
        return $response->withHeader('X-XSS-Protection', '0');
    }
}
