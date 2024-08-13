<?php

namespace ADPBot;
use ADPBot\DB;
use PDO;
class Ads
{
    private PDO $pdo;

    public function __construct()
    {
        $this->pdo = DB::connect();
    }

    public function create(string $title, string $content): bool
    {
        $query = "INSERT INTO advertasing (content, title, created_at) VALUES (:content, :title, NOW())";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':content', $content);
        $stmt->bindParam(':title', $title);

        return $stmt->execute();
    }


    public function get(int $id): array|false
    {
        $query = "SELECT * FROM advertasing WHERE id = :id";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getAll(): array
    {
        $query = "SELECT * FROM advertasing ORDER BY created_at DESC";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }




    public function update(int $id, string $title, string $content): bool
    {
        if (strlen($content) > 500) {
            echo "Content exceeds maximum length of 500 characters.";
        }
        $query = "UPDATE advertasing SET content = :content, title = :title, updated_at = NOW() WHERE id = :id";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->bindParam(':content', $content);
        $stmt->bindParam(':title', $title);

        return $stmt->execute();
    }

    public function delete(int $id): bool
    {
        $query = "DELETE FROM advertasing WHERE id = :id";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);

        return $stmt->execute();
    }
}
