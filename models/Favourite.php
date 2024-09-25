<?php
namespace App\Models;

use App\Models\DB\CRUD;
use App\Models\User;

class Favourite extends CRUD {
    protected $table = 'favourite';
    protected $primaryKey = 'id';

    protected $fillable = [
        'user_id', 
        'auction_id'
    ];

    /**
     * Retrieve all auctions marked as Lord's favorites (user with privilege_id = 1)
     */
    public function findLordFavourites() {
        $sql = "SELECT a.*, s.*, u.name as user_name
                FROM auctions AS a
                JOIN " . $this->table . " AS f ON a.id = f.auction_id
                JOIN user AS u ON f.user_id = u.id
                JOIN stamp AS s ON a.stamp_id = s.id
                WHERE u.privilege_id = 1";
        
        $stmt = $this->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function addToFavourite($userId, $stampId) {
        // Retrieve the auction_id based on the stamp_id
        $sql = "SELECT id FROM auctions WHERE stamp_id = :stamp_id";
        $stmt = $this->prepare($sql);
        $stmt->bindValue(':stamp_id', $stampId);
        $stmt->execute();
        
        $auction = $stmt->fetch(\PDO::FETCH_ASSOC);
        
        // Check if the auction exists
        if ($auction) {
            $auctionId = $auction['id'];
            
            // Insert into the favourite table using the correct auction_id
            $insertSql = "INSERT INTO " . $this->table . " (user_id, auction_id) VALUES (:user_id, :auction_id)";
            $insertStmt = $this->prepare($insertSql);
            $insertStmt->bindValue(':user_id', $userId);
            $insertStmt->bindValue(':auction_id', $auctionId);
            
            return $insertStmt->execute();
        } else {
            // If no auction exists for this stamp, return false or handle it as needed
            return false;
        }
    }
    
    

    public function removeFromFavourite($userId, $stampId) {
        // Retrieve the auction_id based on the stamp_id
        $sql = "SELECT id FROM auctions WHERE stamp_id = :stamp_id";
        $stmt = $this->prepare($sql);
        $stmt->bindValue(':stamp_id', $stampId);
        $stmt->execute();
        
        $auction = $stmt->fetch(\PDO::FETCH_ASSOC);
        
        // Check if the auction exists
        if ($auction) {
            $auctionId = $auction['id'];
            
            // Delete from the favourite table using the correct auction_id
            $deleteSql = "DELETE FROM " . $this->table . " WHERE user_id = :user_id AND auction_id = :auction_id";
            $deleteStmt = $this->prepare($deleteSql);
            $deleteStmt->bindValue(':user_id', $userId);
            $deleteStmt->bindValue(':auction_id', $auctionId);
            
            return $deleteStmt->execute();
        } else {
            // If no auction exists for this stamp, return false or handle it as needed
            return false;
        }
    }
    
    
}
