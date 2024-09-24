<?php
namespace App\Controllers;

use App\Providers\View;
use App\Models\Stamp;
use App\Models\StampImage;
use App\Models\User;
use App\Providers\Auth;
use App\Models\Privilege;
use App\Models\Auction;

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
            // Handle images using the uploadFile method
            $stampImage = new StampImage();
    
            // Upload and insert the main image
            if (!empty($_FILES['image_path']['name']['main'])) {
                $uploadedMainImagePath = $stampImage->uploadFile($_FILES['image_path']['tmp_name']['main'], $_FILES['image_path']['name']['main']);
                if ($uploadedMainImagePath) {
                    $stampImage->insertImage([
                        'stamp_id' => $stampId,
                        'image_path' => $uploadedMainImagePath,
                        'is_main' => 1,
                        'image_order' => 1
                    ]);
                }
            }
    
            // Upload and insert additional images
            if (!empty($_FILES['image_path']['name']['additional'])) {
                foreach ($_FILES['image_path']['name']['additional'] as $index => $additionalImageName) {
                    if (!empty($additionalImageName)) {
                        $uploadedAdditionalImagePath = $stampImage->uploadFile($_FILES['image_path']['tmp_name']['additional'][$index], $additionalImageName);
                        if ($uploadedAdditionalImagePath) {
                            $stampImage->insertImage([
                                'stamp_id' => $stampId,
                                'image_path' => $uploadedAdditionalImagePath,
                                'is_main' => 0,
                                'image_order' => $index + 2 // Main image is 1, so additional images start from 2
                            ]);
                        }
                    }
                }
            }
            // Redirect to the catalog page if successful
            return View::redirect('catalog');
        } else {
            // Render an error page if insertion fails
            error_log("Failed to insert stamp data into the database.");
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
            $stampImage = new StampImage();
    
            // Upload and update the main image
            if (!empty($_FILES['image_path']['name']['main'])) {
                $uploadedMainImagePath = $stampImage->uploadFile($_FILES['image_path']['tmp_name']['main'], $_FILES['image_path']['name']['main']);
                if ($uploadedMainImagePath) {
                    // Check if a main image already exists
                    $existingMainImage = $stampImage->findMainImageByStampId($stampId);
                    if ($existingMainImage) {
                        // Update existing main image record
                        $stampImage->updateImage([
                            'image_path' => $uploadedMainImagePath
                        ], $existingMainImage['id']);
                    } else {
                        // Insert new main image record if not exists
                        $stampImage->insertImage([
                            'stamp_id' => $stampId,
                            'image_path' => $uploadedMainImagePath,
                            'is_main' => 1,
                            'image_order' => 1
                        ]);
                    }
                }
            }
    
            // Upload and update additional images
            if (!empty($_FILES['image_path']['name']['additional'])) {
                foreach ($_FILES['image_path']['name']['additional'] as $index => $additionalImageName) {
                    if (!empty($additionalImageName)) {
                        $uploadedAdditionalImagePath = $stampImage->uploadFile($_FILES['image_path']['tmp_name']['additional'][$index], $additionalImageName);
                        if ($uploadedAdditionalImagePath) {
                            // Check if an additional image already exists in that order
                            $existingAdditionalImage = $stampImage->findAdditionalImageByStampIdAndOrder($stampId, $index + 2);
                            if ($existingAdditionalImage) {
                                // Update existing additional image record
                                $stampImage->updateImage([
                                    'image_path' => $uploadedAdditionalImagePath
                                ], $existingAdditionalImage['id']);
                            } else {
                                // Insert new additional image record if not exists
                                $stampImage->insertImage([
                                    'stamp_id' => $stampId,
                                    'image_path' => $uploadedAdditionalImagePath,
                                    'is_main' => 0,
                                    'image_order' => $index + 2 // Main image is 1, so additional images start from 2
                                ]);
                            }
                        }
                    }
                }
            }
    
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
        $auctionModel = new Auction;
        
        $stamp = $stampModel->findOne($stampId);
        
        if (!$stamp) {
            return View::redirect('catalog'); // Redirect if the stamp is not found
        }
    
        // Fetch the user who created the stamp
        $user = $userModel->findOne($stamp['user_id']);
        $stamp['user_name'] = $user ? $user['name'] : 'Unknown';
    
        // Fetch auction details for the stamp
        $auction = $auctionModel->findByStampId($stampId);
        if ($auction) {
            $stamp['auction'] = $auction;
        } else {
            $stamp['auction'] = null;  // No auction for this stamp
        }
    
        View::render('stamp/details', [
            'scripts' => ['product-card-slider.js', 'timer.js'],  // Add timer script here
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