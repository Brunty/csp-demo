<?php

use App\Middleware\CspMiddleware;
use App\Middleware\CspReportOnlyMiddleware;
use App\Middleware\DisableXssProtectionMiddleware;

/*
 * Some browsers now implement some built-in XSS protection if they detect it in request attributes.
 *
 * To show some CSP stuff, we'll have to disable that here so it doesn't interfere with demonstrating
 * the things I want you to see. *DO NOT DO THIS ON YOUR SITES*
 *
 * I repeat:
 * DO NOT DO THIS ON YOUR SITES
 * UNDERSTAND?!
 */
$app->add(new DisableXssProtectionMiddleware);
/*
 * Now let's add our CSP middleware
 */
//$app->add(new CspMiddleware($container['config']['security']['csp'], $container['app.generator.nonce.generated_nonce']));
//$app->add(new CspReportOnlyMiddleware($container['config']['security']['csp'], $container['app.generator.nonce.generated_nonce']));
