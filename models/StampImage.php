<?php
namespace App\Models;

use App\Models\DB\CRUD;

class StampImage extends CRUD {

    // Table associée au modèle
    protected $table = "stamp_images";
    // Clé primaire de la table
    protected $primaryKey = "id";
    // Champs pour remplir lors de l'insertion
    protected $fillable = [
        'stamp_id',
        'image_path',
        'is_main',
        'image_order'
    ];

    /**
     * Récupère toutes les images pour un timbre spécifique
     * 
     * @param int $stampId ID du timbre
     * @return array Liste des images du timbre
     */
    public function findByStampId($stampId) {
        // Requête SQL pour obtenir toutes les images pour un timbre
        $sql = "SELECT * FROM " . $this->table . " WHERE stamp_id = :stamp_id ORDER BY image_order";
        
        // Préparer la requête
        $stmt = $this->prepare($sql);
        
        // Lier les paramètres
        $stmt->bindParam(':stamp_id', $stampId, \PDO::PARAM_INT);
        
        // Exécuter la requête
        $stmt->execute();
        
        // Récupérer les images
        $images = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        
        return $images;
    }
    


}
?>
