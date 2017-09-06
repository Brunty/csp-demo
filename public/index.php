<?php


require_once __DIR__ . '/../vendor/autoload.php';

$app = require __DIR__ . '/../app/bootstrap/app.php';

require_once __DIR__ . '/../app/bootstrap/configure.php';

require_once __DIR__ . '/../app/bootstrap/container.php';

require_once __DIR__ . '/../app/bootstrap/middleware.php';

require_once __DIR__ . '/../app/resources/config/routing.php';

$app->run();
