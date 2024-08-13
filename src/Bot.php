<?php

namespace ADPBot;

use GuzzleHttp\Client;

class Bot
{
    private \PDO $pdo;
    private Client $http;
    const string REQUEST_API = "https://api.telegram.org/bot";

    public function __construct(string $token)
    {
        $this->pdo = DB::connect();
        $this->http = new Client(['base_uri' => self::REQUEST_API . $token . "/"]);
    }

    public function startCommand(int $chat_id): void
    {
        try {
            if (!$this->checkForUniqueChatId($chat_id)) {
                $stmt = $this->pdo->prepare("INSERT INTO user (chat_id) VALUES (:chatId)");
                $stmt->bindParam(':chatId', $chat_id, \PDO::PARAM_INT);
                $stmt->execute();

                $this->sendPost($chat_id, "Welcome . Thsi is ADvertasing Panel for the Bot.");
            } else {
                $this->sendPost($chat_id, "Welcome. ");
            }
        } catch (\Exception $e) {
            error_log('Error in startCommand: ' . $e->getMessage());
        }
    }


    public function getAll(): false|array
    {
        $stmt = $this->pdo->query("SELECT * FROM user");
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function checkForUniqueChatId(int $chat_id): bool
    {
        $stmt = $this->pdo->prepare("SELECT chat_id FROM user WHERE chat_id = :chatId");
        $stmt->bindParam(':chatId', $chat_id);
        $stmt->execute();
        $result = $stmt->fetch();
        return $result !== false;
    }

    public function sendPost($chat_id, $post): void
    {
        $this->http->post('sendMessage', [
            'form_params' => [
                'chat_id' => $chat_id,
                'text' => $post,
            ]
        ]);
    }
}