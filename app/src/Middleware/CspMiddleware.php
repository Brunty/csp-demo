<?php

namespace App\Middleware;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class CspMiddleware
{

    /**
     * @var string
     */
    private $nonce;

    /**
     * @var string
     */
    private $policy;

    public function __construct(
        string $policy = "default-src 'none';",
        string $nonce = ''
    ) {
        $this->policy = $policy;
        $this->nonce = $nonce;
    }

    /**
     * Example middleware invokable class
     *
     * @param  \Psr\Http\Message\ServerRequestInterface $request  PSR7 request
     * @param  \Psr\Http\Message\ResponseInterface      $response PSR7 response
     * @param  callable                                 $next     Next middleware
     *
     * @return \Psr\Http\Message\ResponseInterface
     * @throws \InvalidArgumentException
     */
    public function __invoke(
        ServerRequestInterface $request,
        ResponseInterface $response,
        callable $next
    ) : ResponseInterface
    {
        $newResponse = $response->withAddedHeader(
            'Content-Security-Policy',
            sprintf($this->policy, 'nonce-' . $this->nonce)
        );

        return $next($request, $newResponse);
    }
}
