<?php

require_once '../vendor/autoload.php'; // Autoloadingni to'g'ri yuklash

use ADPBot\Ads;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = trim($_POST['title']);
    $content = trim($_POST['content']);

    $ads = new Ads();
    $ads->create($title, $content);
    header('Location: /view/home.html');
    exit();
}
