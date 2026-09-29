<?php

// 1. Kulazimisha kuki ya InfinityFree/iFastNet kufanya kazi
if (!isset($_COOKIE['__test'])) {
    setcookie("__test", md5(time()), time() + 3600 * 24 * 365, "/", "", false, false);
    header("Location: " . $_SERVER['REQUEST_URI']);
    exit();
}

define('LARAVEL_START', microtime(true));

// 2. Sajili Composer Autoloader (Inatoka nje ya public kwenda htdocs)
require __DIR__.'/../vendor/autoload.php';

// 3. Angalia kama mfumo uko kwenye maintenance mode
if (file_exists($maintenance = __DIR__.'/../storage/framework/maintenance.php')) {
    require $maintenance;
}

// 4. Washa Laravel Application Bootstrap
$app = require_once __DIR__.'/../bootstrap/app.php';

// 5. Kushughulikia maombi
use Illuminate\Http\Request;
$app->handleRequest(Request::capture());