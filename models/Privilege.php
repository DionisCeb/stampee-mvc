<?php
namespace App\Models;
use App\Models\DB\CRUD;

/**
 * Le modèle pour récupérer l'identifiant de privilège
 */
class Privilege extends CRUD{
    protected $table = "privilege";
    protected $primaryKey = "id";


    public function selectWhere($field, $value) {
        $sql = "SELECT * FROM $this->table WHERE $field = :value";
        $stmt = $this->prepare($sql);
        $stmt->bindValue(':value', $value);
        $stmt->execute();

        $result = $stmt->fetchAll();
        if (count($result) > 0) {
            return $result;
        } else {
            return false;
        }
    }
}