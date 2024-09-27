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

    public function findOne($auctionId) {
        //SQL query to fetch the auction by its ID
        $sql = "SELECT * FROM " . $this->table . " WHERE " . $this->primaryKey . " = :auction_id"; 

        // Prepare the statement
        $stmt = $this->prepare($sql);

        // Bind the auction ID parameter
        $stmt->bindParam(':auction_id', $auctionId, \PDO::PARAM_INT);

        // Execute the query
        $stmt->execute();

        // Fetch the auction data
        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }

    public function updateAuction($data, $auctionId) {
        // Define the SQL query with specific fields
        $sql = "UPDATE " . $this->table . " 
                SET start_date = :start_date, 
                    end_date = :end_date, 
                    starting_price = :starting_price 
                WHERE id = :auction_id";
                
        // Prepare the statement
        $stmt = $this->prepare($sql);

        // Bind the values
        $stmt->bindParam(':start_date', $data['start_date']);
        $stmt->bindParam(':end_date', $data['end_date']);
        $stmt->bindParam(':starting_price', $data['starting_price']);
        $stmt->bindParam(':auction_id', $auctionId, \PDO::PARAM_INT);

        return $stmt->execute();
    }


    /**
     * Function to retrieve all the auctions
     */
    public function findByUserId($userId) {
        $sql = "SELECT a.* 
                FROM " . $this->table . " AS a
                JOIN stamp AS s ON a.stamp_id = s.id
                WHERE s.user_id = :user_id";
        $stmt = $this->prepare($sql);
        $stmt->bindValue(":user_id", $userId);
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    /**
     * Archieved Auctions
     */
    // In the Auction model
    public function findArchivedAuctions() {
        $sql = "SELECT a.*, s.* 
                FROM " . $this->table . " AS a
                JOIN stamp AS s ON a.stamp_id = s.id
                WHERE a.end_date < CURDATE()";
        
        $stmt = $this->prepare($sql);
        $stmt->execute();
        
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    

    /**
     * Delete the auction
     */

     public function deleteAuction($auctionId) {
        // Delete related bids first (if necessary)
        $sqlBids = "DELETE FROM bid WHERE auction_id = :auction_id"; 
        $stmtBids = $this->prepare($sqlBids);
        $stmtBids->bindParam(':auction_id', $auctionId);
        $stmtBids->execute();

        // Delete related favourite entries
        $sqlFavourite = "DELETE FROM favourite WHERE auction_id = :auction_id";
        $stmtFavourite = $this->prepare($sqlFavourite);
        $stmtFavourite->bindParam(':auction_id', $auctionId);
        $stmtFavourite->execute();

        //Delete the auction itself
        $sql = "DELETE FROM " . $this->table . " WHERE id = :auction_id";
        $stmt = $this->prepare($sql);
        $stmt->bindParam(':auction_id', $auctionId);
    
        return $stmt->execute();
     }
    

    
}