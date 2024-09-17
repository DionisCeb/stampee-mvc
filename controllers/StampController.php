<?php
namespace App\Controllers;

use App\Providers\View;
use App\Models\Stamp;
use App\Models\StampImage;
use App\Models\User;
use App\Providers\Auth;
use App\Models\Privilege;

class StampController{

   
    

    



    public function create(){
        
        View::render('stamp/create', ['scripts'=> [
            'product-card-slider.js',
        ]]);
    }

    public function store() {
        // Ensure the user is authenticated
        Auth::session();
        
        if (!isset($_SESSION['user_id'])) {
            return View::redirect('login'); // Redirect to login if not authenticated
        }
    
        // Collect form data from POST request
        $data = [
            'name' => $_POST['name'],
            'creation_date' => $_POST['creation_date'],
            'color' => $_POST['color'],
            'country' => $_POST['country'],
            'stamp_condition' => $_POST['stamp_condition'],
            'print_run' => $_POST['print_run'],
            'dimensions' => $_POST['dimensions'],
            'certified' => $_POST['certified'],
            'user_id' => $_SESSION['user_id'] // Store the current user ID
        ];
    
        // Insert into Stamp table
        $stamp = new Stamp();
        $stampId = $stamp->insert($data);  // Insert stamp data and get the stamp ID
    
        if ($stampId) {
            // Handle images
            $imagePaths = $_POST['image_path'];
            $stampImage = new StampImage();
    
            // Insert the main image
            if (!empty($imagePaths['main'])) {
                $stampImage->insert([
                    'stamp_id' => $stampId,
                    'image_path' => $imagePaths['main'],
                    'is_main' => 1,
                    'image_order' => 1
                ]);
            }
    
            // Insert additional images
            if (!empty($imagePaths['additional'])) {
                foreach ($imagePaths['additional'] as $index => $additionalImagePath) {
                    if (!empty($additionalImagePath)) {
                        $stampImage->insert([
                            'stamp_id' => $stampId,
                            'image_path' => $additionalImagePath,
                            'is_main' => 0,
                            'image_order' => $index + 2  // Main image is 1, so additional images start from 2
                        ]);
                    }
                }
            }
    
            // Redirect to the catalog page if successful
            return View::redirect('catalog');
        } else {
            // Render an error page if insertion fails
            return View::render('error');
        }
    }
    

    public function list() {

        $stampModel = new Stamp();
        $userModel = new User();
        $stampImageModel = new StampImage();

        $stamps = $stampModel->findAll(); // Fetch all stamps

        foreach ($stamps as &$stamp) {
            $images = $stampImageModel->findByStampId($stamp['id']);
            $stamp['images'] = $images;

            // Fetch the user who created the stamp
            $user = $userModel->findOne($stamp['user_id']);

            //Check if user is found
            if ($user) {
                $stamp['user_name'] = $user['name'];
            } else {
                $stamp['user_name'] = 'Unknown';
            }
            
        }
        View::render('stamp/catalog', [
            'stamps' => $stamps,
            'scripts' => ['product-card-slider.js']
        ]);
    }
    

    public function edit() {
        if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
            return View::redirect('catalog'); // Redirect if no valid ID is provided
        }
        
        //Get the stamp ID
        $stampId = intval($_GET['id']);

        //Check if user is logged in
        if (!isset($_SESSION['user_id'])) {
            return View::redirect('login');
        }

        $stampModel = new Stamp;
        $stampImageModel = new StampImage();

        $stamp = $stampModel->findOne($stampId);
        
        // If stamp not found, redirect to catalog
        if (!$stamp) {
            return View::redirect('catalog'); // Redirect if the stamp is not found
        }

        // Check if the logged-in user is the creator of the stamp
        if($stamp['user_id'] != $_SESSION['user_id']) {
            return View::redirect('catalog');
        }

        // Retrieve distinct stamp conditions from the 'stamp' table
        $conditions = $stampModel->getDistinctConditions(); // New method to fetch distinct conditions

        // Retrieve additional images for the stamp
        $additionalImages = $stampImageModel->findByStampId($stampId);

        // Map additional images to a simpler structure if needed
        $imagePaths = [];
        foreach ($additionalImages as $image) {
            $imagePaths[] = $image['image_path'];
        }
        
        View::render('stamp/edit', [
            'scripts' => ['product-card-slider.js'],
            'stamp' => $stamp,
            'conditions' => $conditions,
            'additional_images' => $imagePaths // Pass additional images to the view
        ]);
    }


    public function update() {
        // Check for the stamp ID to update
        if (!isset($_POST['id']) || !is_numeric($_POST['id'])) {
            return View::redirect('catalog'); // Redirect if no valid ID is provided
        }
    
        $stampId = intval($_POST['id']); // Get the stamp ID
    
        $data = [
            'name' => $_POST['name'],
            'creation_date' => $_POST['creation_date'],
            'color' => $_POST['color'],
            'country' => $_POST['country'],
            'stamp_condition' => $_POST['stamp_condition'],
            'print_run' => $_POST['print_run'],
            'dimensions' => $_POST['dimensions'],
            'certified' => $_POST['certified']
        ];
        
        $stamp = new Stamp();
        $update = $stamp->update($data, $stampId);
    
        if ($update) {
            return View::redirect('home');
        } else {
            return View::render('error');
        }
    }

    
    public function details() {
        if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
            return View::redirect('catalog'); // Redirect if no valid ID is provided
        }
        
        $stampId = intval($_GET['id']);
        $stampModel = new Stamp;
        $userModel = new User;
        $stamp = $stampModel->findOne($stampId);
        
        if (!$stamp) {
            return View::redirect('catalog'); // Redirect if the stamp is not found
        }

        //Fetch the user who created the stamp
        $user = $userModel->findOne($stamp['user_id']);
        if ($user) {
            $stamp['user_name'] = $user['name'];
        } else {
            $stamp['user_name'] = 'Unknown';
        }
        
        View::render('stamp/details', [
            'scripts' => ['product-card-slider.js'],
            'stamp' => $stamp
        ]);
    }
    

    /**
     * USER COLLECTION
     */
    public function collection() {

        // Check if the user is logged in
        if (!isset($_SESSION['user_id'])) {
            return View::redirect('login'); // Redirect to login if not logged in
        }
    
        $userId = $_SESSION['user_id']; // Get the logged-in user's ID
    
        $stampModel = new Stamp();
        $stampImageModel = new StampImage();
    
        // Fetch all stamps created by the logged-in user
        $stamps = $stampModel->findByUserId($userId);

        // Retrieve the images:
        //Fetch all images
        foreach ($stamps as &$stamp) {
            $images = $stampImageModel->findByStampId($stamp['id']);
            $stamp['images'] = $images;
        }
    
        // Render the collection view with the user's stamps
        View::render('user/collection', [
            'stamps' => $stamps,
            'scripts' => ['product-card-slider.js']
        ]);
    }
    
    

}
?>