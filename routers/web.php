<?php

declare(strict_types=1);

use ADPBot\Router;
use ADPBot\Bot;
use ADPBot\Ads;

$bot = new Bot($_ENV['TELEGRAM_BOT_TOKEN']);
$task = new Ads();
$users = $bot->getAll();

Router::get('/', fn() => require 'view/home.php');
Router::post('/text', callback: function () use ($task, $bot, $users) {
    if (isset($_POST['content'])) {

        $task->create($_POST['title'],$_POST['content']);

        foreach ($users as $user) {
            $bot->sendPost($user['chat_id'], $_POST['content']);
        }
        header('Location: /');
    }
});