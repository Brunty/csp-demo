<?php

use App\Middleware\DisableXssProtectionMiddleware;

/*
 * Browsers now implement some built-in XSS protection if they detect it in request attributes.
 *
 * To show some CSP stuff, we'll just disable that here so it doesn't interfere with showing
 * what I want to show.
 */
$app->add(new DisableXssProtectionMiddleware);
