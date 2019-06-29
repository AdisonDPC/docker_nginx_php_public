<?php

require __DIR__ . '/../vendor/autoload.php';

$aSettings = require __DIR__ . '/../config/app.php';

$aApp = new \Slim\App($aSettings);

require __DIR__ . '/../app/provider/app.php';

require __DIR__ . '/../app/route/app.php';
