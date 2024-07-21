<?php

require_once __DIR__."/../vendor/autoload.php";
require_once __DIR__."/../app/web/routes.php";

use App\Core\Core;
use App\Http\Route;

Core::start(Route::getRoutes());