<?php

require_once "../vendor/autoload.php";
require_once "../app/routes/main.php";

use App\Core\Core;
use App\Http\Route;

Core::dispath(Route::routes());