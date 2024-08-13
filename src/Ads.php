<?php

namespace ADPBot;
use PDO;
class Ads
{
    private PDO $pdo;

    public function __construct(){
        $this->pdo=DB::connect();
    }

    public function create(string $ad){
        $query = "INSERT INTO advertasing (ad, created_at) VALUES (:ad, NOW())";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':ad', $ad);

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


    public function update(int $id, string $ad){
        $query = "UPDATE advertasing SET ad = :ad, updated_at = NOW() WHERE id = :id";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':ad', $ad);

        return $stmt->execute();
    }

    public function delete(int $id){
        $query = "DELETE FROM advertasing WHERE id = :id";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':id', $id);

        return $stmt->execute();
    }
}
