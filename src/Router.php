<?php

declare(strict_types=1);

namespace ADPBot;

class Router
{
    private mixed $update;

    public function __construct()
    {
        $this->update = json_decode(file_get_contents('php://input'));
    }

    public function getUpdates()
    {
        return $this->update;
    }

    public static function get($path, $callback): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'GET' && parse_url($_SERVER['REQUEST_URI'])['path'] === $path) {
            $callback();
            exit();
        }
    }

    public static function post($path, $callback): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_SERVER['REQUEST_URI'] === $path) {
            $callback();
            exit();
        }
    }
}