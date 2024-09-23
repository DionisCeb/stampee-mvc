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


    public function uploadFile($tmpName, $fileName) {
        // Define the target directory
        $targetDir = 'uploads/stamps/';
        // Create a unique file name
        $uniqueFileName = uniqid() . '_' . basename($fileName);
        // Define the target file path
        $targetFilePath = $targetDir . $uniqueFileName;
        
        // Move the uploaded file to the target directory
        if (move_uploaded_file($tmpName, $targetFilePath)) {
            return $targetFilePath; // Return the path of the uploaded file
        } else {
            return false; // Return false if the upload fails
        }
    }

    
    public function insertImage($data) {
    // Build the insert query
    $fields = array_keys($data);
    $placeholders = array_map(function($field) {
        return ":$field";
    }, $fields);

    $sql = "INSERT INTO " . $this->table . " (" . implode(", ", $fields) . ") VALUES (" . implode(", ", $placeholders) . ")";
    
    $stmt = $this->prepare($sql);

    // Bind values
    foreach ($data as $key => $value) {
        $stmt->bindValue(":$key", $value);
    }

    // Execute the query
    return $stmt->execute();
}

    
    


}
?>
