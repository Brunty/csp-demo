<?php

use App\Middleware\CspMiddleware;
use App\Middleware\DisableXssProtectionMiddleware;

/*
 * Browsers now implement some built-in XSS protection if they detect it in request attributes.
 *
 * To show some CSP stuff, we'll just disable that here so it doesn't interfere with showing
 * what I want to show.
 */
$app->add(new DisableXssProtectionMiddleware);
$app->add(new CspMiddleware($container['app.generator.nonce.generated_nonce']));
