<?php
require "vendor/autoload.php";
require "bootstrap.php";
use ADPBot\Ads;

$ads = new Ads();
$new_ads = $ads->delete(1);

