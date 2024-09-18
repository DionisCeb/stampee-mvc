<?php
namespace App\Controllers;

use App\Models\User;
use App\Models\Privilege;
use App\Providers\View;
use App\Providers\Validator;
use App\Providers\Auth;

class UserController{

    /* public function __construct(){
        Auth::session();
    } */
    public function create() {
        // Allow access to the create page for all users including guests
        $privilege = new Privilege;
        $privileges = $privilege->select('privilege');
    
        // Render the create view with privileges
        View::render('user/create', ['privileges' => $privileges]);
    }
    
    

   public function store($data) {
    // Ensure authentication before proceeding with storing user data
    Auth::session();

    // Validate the incoming data
    $validator = new Validator;
    $validator->field('name', $data['name'])->min(2)->max(50);
    $validator->field('username', $data['username'])->email()->required()->max(50)->isUnique('User');
    $validator->field('password', $data['password'])->min(5)->max(20);
    $validator->field('email', $data['email'])->email()->required()->max(50)->isUnique('User');
    $validator->field('privilege_id', $data['privilege_id'], 'privilege')->required()->isExist('Privilege');

    if ($validator->isSuccess()) {
        $user = new User;
        $data['password'] = $user->hashPassword($data['password']);
        $insert = $user->insert($data);
        
        if ($insert) {
            return View::redirect('login');
        } else {
            return View::render('error');
        }
    } else {
        $errors = $validator->getErrors();
        $privilege = new Privilege;
        $privileges = $privilege->select('privilege');
        return View::render('user/create', ['errors' => $errors, 'user' => $data, 'privileges' => $privileges]);
    }
}


    public function edit() {
        if ($_SESSION['privilege_id'] == 1 || $_SESSION['privilege_id'] == 2) {
            // Get user ID from session
            if (!isset($_SESSION['user_id']) || !is_numeric($_SESSION['user_id'])) {
                return View::redirect('home'); // Redirect if no valid user ID is in session
            }
    
            $userId = intval($_SESSION['user_id']);
            $userModel = new User();
            $user = $userModel->findOne($userId);
    
            if (!$user) {
                return View::redirect('home'); // Redirect if the user is not found
            }
    
            $privilegeModel = new Privilege();
            $privileges = $privilegeModel->select('privilege');
    
            View::render('user/edit', [
                'user' => $user,
                'privileges' => $privileges
            ]);
        } else {
            return View::redirect('login');
        }
    }


    /**
     * Function to update the user data
     */

     public function update() {
        Auth::session();
        
        // Get the user ID from the session
        if (!isset($_SESSION['user_id']) || !is_numeric($_SESSION['user_id'])) {
            return View::redirect('home'); // Redirect if no valid user ID is in session
        }
    
        $userId = intval($_SESSION['user_id']);
        $userModel = new User();
    
        // Prepare the incoming data
        $data = [
            'name' => $_POST['name'],
            'surname' => $_POST['surname']
        ];
    
        // Initialize Validator and perform validations
        $validator = new Validator();
        $validator->field('name', $data['name'])->min(2)->max(50)->required();
        $validator->field('surname', $data['surname'])->min(2)->max(50)->required();
    
        // Only validate the password if a new one is provided
        if (!empty($_POST['password'])) {
            $data['password'] = $_POST['password'];
            $validator->field('password', $data['password'])->min(5)->max(20);
        }
    
        // Check if validation passed
        if ($validator->isSuccess()) {
            // Hash and update the password if provided
            if (!empty($data['password'])) {
                $data['password'] = $userModel->hashPassword($data['password']);
            }
    
            // Update the user record in the database
            $update = $userModel->update($data, $userId);
    
            // If the update was successful, update the session data
            if ($update) {
                $_SESSION['name'] = $data['name'];
                $_SESSION['surname'] = $data['surname'];
    
                return View::redirect('home'); // Redirect on success
            } else {
                return View::render('error'); // Show error if update fails
            }
        } else {
            // Validation failed, handle errors
            $errors = $validator->getErrors();
            $privilegeModel = new Privilege();
            $privileges = $privilegeModel->select('privilege');
            
            // Re-render the edit view with error messages and user data
            return View::render('user/edit', [
                'errors' => $errors,
                'user' => $data,
                'privileges' => $privileges
            ]);
        }
    }
    
    
    
    
    
    
    


}