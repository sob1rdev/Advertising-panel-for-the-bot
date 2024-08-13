<?php

require 'vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

$timezone = getenv('TIMEZONE');
if (!$timezone) {
    $timezone = 'Asia/Tashkent';
}
date_default_timezone_set($timezone);
