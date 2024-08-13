<?php

declare(strict_types=1);

namespace ADPBot;

use PDO;

class DB
{
    public static function connect(): PDO
    {
        $dsn = sprintf(
            '%s:host=%s;dbname=%s',
            $_ENV['DB_CONNECTION'],
            $_ENV['DB_HOST'],
            $_ENV['DB_NAME']
        );

        return new PDO(
            $dsn,
            $_ENV['DB_USERNAME'],
            $_ENV['DB_PASSWORD'],
            [
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            ]
        );
    }
}
