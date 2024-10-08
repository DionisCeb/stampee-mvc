<?php
namespace App\Models;
use App\Models\DB\CRUD;

class User extends CRUD{
    protected $table = "user";
    protected $primaryKey = "id";
    protected $fillable = ['name', 'surname', 'username', 'password', 'email', 'privilege_id'];
    private $salt = "H4@1&";

    public function hashPassword($password, $cost = 10){
        $options = [
            'cost' => $cost
        ];
        
        return password_hash($password.$this->salt, PASSWORD_BCRYPT, $options);
    }

    public function checkuser($username, $password){
        $user = $this->unique('username', $username);
        if($user){
            if(password_verify($password.$this->salt, $user['password'])){
                session_regenerate_id();
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['name'] = $user['name'];
                $_SESSION['surname'] = $user['surname'];
                $_SESSION['privilege_id'] = $user['privilege_id'];
                $_SESSION['fingerPrint'] = md5($_SERVER['HTTP_USER_AGENT'].$_SERVER['REMOTE_ADDR']);
                 return true;
            }else{
                return false;
            }
        }else{
            return false;
        }
        

    }

    public function findOne($id) {
        $sql = "SELECT * FROM $this->table WHERE $this->primaryKey = :id";
        $stmt = $this->prepare($sql);
        $stmt->bindValue(':id', $id, \PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch();
    }
    

}