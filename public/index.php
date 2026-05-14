<?php

require '../vendor/autoload.php';
require '../core/View.php';

Zems\Env::load(__DIR__ . '/../.env');

$router = require '../routes/web.php';
