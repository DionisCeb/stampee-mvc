<?php
namespace App\Models;

use App\Models\DB\CRUD;

class Stamp extends CRUD {

    // Table associée au modèle
    protected $table = "stamp";
    // Clé primaire de la table
    protected $primaryKey = "id";
    // Champs pour remplir lors de l'insertion
    protected $fillable = [
        'name', 
        'creation_date', 
        'colors', 
        'country_of_origin', 
        'main_image', 
        'additional_images', 
        'condition', 
        'print_run', 
        'dimensions', 
        'certified'
    ];

    /**
     * Récupère toutes les timbres avec les informations associées
     * 
     * @return array Liste des timbres
     */
    public function findAll() {
        // Requête SQL pour obtenir toutes les timbres
        $sql = "SELECT * FROM " . $this->table;
        
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
        
        return $stamp;
    }
}


?>