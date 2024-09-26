<?php

namespace App\Models;
use App\Models\DB\CRUD;

Class Bid extends CRUD {
    // Table associée au modèle
    protected $table = "bid";
    // Clé primaire de la table
    protected $primaryKey = "id";
    // Champs pour remplir lors de l'insertion
    protected $fillable = [
        'user_id', 
        'auction_id', 
        'bid_amount', 
        'bid_date'
    ];

    /**
     * Register the highest bid
     */
    public function getHighestBid($auctionId) {
        $sql = "SELECT MAX(bid_amount) as highest_bid FROM " . $this->table . " WHERE auction_id = :auction_id";
        $stmt = $this->prepare($sql);
        $stmt->bindParam(':auction_id', $auctionId, \PDO::PARAM_INT);
        $stmt->execute();
        
        return $stmt->fetch(\PDO::FETCH_ASSOC)['highest_bid'];
    }

    /**
     * Insert the current Bid
     */
    public function insertBid($data) {
        $sql = "INSERT INTO " . $this->table . " (user_id, auction_id, bid_amount, bid_date) VALUES (:user_id, :auction_id, :bid_amount, CURRENT_TIMESTAMP)";
        $stmt = $this->prepare($sql);
        $stmt->bindParam(':user_id', $data['user_id']);
        $stmt->bindParam(':auction_id', $data['auction_id']);
        $stmt->bindParam(':bid_amount', $data['bid_amount']);
        
        return $stmt->execute();
    }
}