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
}
