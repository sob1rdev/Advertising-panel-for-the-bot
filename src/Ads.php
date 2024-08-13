<?php

namespace ADPBot;
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

    public function update(int $id, string $title, string $content)
    {
        $query = "UPDATE advertasing SET content = :content, title = :title, updated_at = NOW() WHERE id = :id";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':content', $content);
        $stmt->bindParam(':title', $title);

        return $stmt->execute();
    }

    public function delete(int $id)
    {
        $query = "DELETE FROM advertasing WHERE id = :id";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':id', $id);

        return $stmt->execute();
    }
}
