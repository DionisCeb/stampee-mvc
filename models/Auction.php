<?php
namespace App\Models;

use App\Models\DB\CRUD;
use App\Models\User;

class Auction extends CRUD {
    protected $table = 'auctions';

    public function findByStampId($stampId) {
        $sql = "SELECT * FROM " . $this->table . " WHERE stamp_id = :stamp_id";
        $stmt = $this->prepare($sql);
        $stmt->bindParam(':stamp_id', $stampId);
        $stmt->execute();
        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }
}