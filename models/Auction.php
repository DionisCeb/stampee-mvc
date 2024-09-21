<?php
namespace App\Models;

use App\Models\DB\CRUD;
use App\Models\User;

class Auction extends CRUD {
    protected $table = 'auctions';
    protected $primaryKey = 'id';

    protected $fillable = [
        'stamp_id', 
        'start_date', 
        'end_date', 
        'starting_price'
    ];

    public function findByStampId($stampId) {
        $sql = "SELECT * FROM " . $this->table . " WHERE stamp_id = :stamp_id";
        $stmt = $this->prepare($sql);
        $stmt->bindParam(':stamp_id', $stampId);
        $stmt->execute();
        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }

    public function createAuction($data) {
        $sql = "INSERT INTO " . $this->table . " (stamp_id, start_date, end_date, starting_price) 
                VALUES (:stamp_id, :start_date, :end_date, :starting_price)";
        $stmt = $this->prepare($sql);
        $stmt->bindParam(':stamp_id', $data['stamp_id']);
        $stmt->bindParam(':start_date', $data['start_date']);
        $stmt->bindParam(':end_date', $data['end_date']);
        $stmt->bindParam(':starting_price', $data['starting_price']);
        return $stmt->execute();
    }

    
}