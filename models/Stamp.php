<?php
namespace App\Models;

use App\Models\DB\CRUD;
use App\Models\User;


class Stamp extends CRUD {

    // Table associée au modèle
    protected $table = "stamp";
    // Clé primaire de la table
    protected $primaryKey = "id";
    // Champs pour remplir lors de l'insertion
    protected $fillable = [
        'name', 
        'creation_date', 
        'color', 
        'country', 
        'main_image', 
        'additional_images', 
        'condition', 
        'print_run', 
        'dimensions', 
        'certified',
        'user_id'
    ];

    /**
     * Récupère toutes les timbres avec les informations associées
     * 
     * @return array Liste des timbres
     */
    public function findAllStamps() {
        // Requête SQL pour obtenir toutes les timbres
        $sql = "SELECT * FROM " . $this->table;
        
        // Exécuter la requête
        $stmt = $this->query($sql);
        
        // Récupérer toutes les timbres
        $stamps = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        
        return $stamps;
    }

    /**
     * Récupère toutes les timbres avec les informations associées dans l'enchere
     * 
     * @return array Liste des timbres dans une enchere
     */
    public function findAllStampsOfAuction() {
        // Requête SQL pour obtenir toutes les timbres dans une enchere
        $sql = "SELECT s.* 
            FROM " . $this->table . " AS s
            JOIN auctions AS a ON s.id = a.stamp_id";
        
        // Exécuter la requête
        $stmt = $this->query($sql);
        
        // Récupérer toutes les timbres
        $stamps = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        
        return $stamps;
    }

    /**
     * Récupère un timbre par son ID
     * 
     * @param int $id ID du timbre
     * @return array Détails du timbre
     */
    public function findOne($id) {
        // Requête SQL pour obtenir un timbre spécifique
        $sql = "SELECT * FROM " . $this->table . " WHERE " . $this->primaryKey . " = :id";
        
        // Préparer la requête
        $stmt = $this->prepare($sql);
        
        // Lier les paramètres
        $stmt->bindParam(':id', $id, \PDO::PARAM_INT);
        
        // Exécuter la requête
        $stmt->execute();
        
        // Récupérer les détails du timbre
        $stamp = $stmt->fetch(\PDO::FETCH_ASSOC);

        if ($stamp) {
            // Requête SQL pour récupérer les images associées
            $sqlImages = "SELECT image_path, is_main FROM stamp_images WHERE stamp_id = :id ORDER BY image_order";
            $stmtImages = $this->prepare($sqlImages);
            $stmtImages->bindParam(':id', $id, \PDO::PARAM_INT);
            $stmtImages->execute();

             // Récupérer les images associées
             $images = $stmtImages->fetchAll(\PDO::FETCH_ASSOC);
             $stamp['images'] = $images;
        }    
        return $stamp;
    }

    public function getDistinctConditions() {
        // SQL query to select distinct stamp_condition values
        $sql = "SELECT DISTINCT stamp_condition FROM " . $this->table;
        $stmt = $this->prepare($sql);
        $stmt->execute();
        
        return $stmt->fetchAll(\PDO::FETCH_COLUMN); // Fetch only the distinct condition values
    }

    /**
     * Retrieve the stamp created by a specific user
     */
    public function findByUserId($userId) {
        $sql = "SELECT * FROM $this->table WHERE user_id = :user_id";
        $stmt = $this->prepare($sql);
        $stmt->bindValue(":user_id", $userId);
        $stmt->execute();
        return $stmt->fetchAll();
    }
}


?>