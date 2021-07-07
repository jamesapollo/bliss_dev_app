<?php
require __DIR__ . '/vendor/autoload.php';

define("ROOT", __DIR__ . '/src/');

use App\App;

(new App)->run();

