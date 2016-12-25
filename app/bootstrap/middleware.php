<?php

use App\Middleware\CspMiddleware;
use App\Middleware\DisableXssProtectionMiddleware;

/*
 * Browsers now implement some built-in XSS protection if they detect it in request attributes.
 *
 * To show some CSP stuff, we'll just disable that here so it doesn't interfere with showing
 * what I want to show. *DO NOT DO THIS ON YOUR SITES*
 */
$app->add(new DisableXssProtectionMiddleware);
/*
 * Now let's add our CSP middleware
 */
//$app->add(new CspMiddleware($container['config']['security']['csp'], $container['app.generator.nonce.generated_nonce']));
