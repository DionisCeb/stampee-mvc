<?php
namespace App\Controllers;

use App\Providers\View;
use App\Models\Stamp;
use App\Models\StampImage;

class StampController{

   
    

    public function list() {
        $stampModel = new Stamp();
        $stampImageModel = new StampImage();

        $stamps = $stampModel->findAll(); // Fetch all stamps

        foreach ($stamps as &$stamp) {
            $images = $stampImageModel->findByStampId($stamp['id']);
            $stamp['images'] = $images;
        }
        View::render('stamp/catalog', [
            'stamps' => $stamps,
            'scripts' => ['product-card-slider.js']
        ]);
    }

    /* public function details(){
        
        View::render('stamp/details', ['scripts'=> [
            'product-card-slider.js',
            'timer.js'
        ]]);
    } */

    public function details() {
        if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
            return View::redirect('catalog'); // Redirect if no valid ID is provided
        }
        
        $stampId = intval($_GET['id']);
        $stampModel = new Stamp;
        $stamp = $stampModel->findOne($stampId);
        
        if (!$stamp) {
            return View::redirect('catalog'); // Redirect if the stamp is not found
        }
        
        View::render('stamp/details', [
            'scripts' => ['product-card-slider.js'],
            'stamp' => $stamp
        ]);
    }


    public function create(){
        
        View::render('stamp/create', ['scripts'=> [
            'product-card-slider.js',
        ]]);
    }

    public function store() {
        // Collect form data from POST request
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
    

    public function edit() {
        if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
            return View::redirect('catalog'); // Redirect if no valid ID is provided
        }
        
        //Get the stamp ID
        $stampId = intval($_GET['id']);

        $stampModel = new Stamp;
        $stampImageModel = new StampImage();

        $stamp = $stampModel->findOne($stampId);
        
        if (!$stamp) {
            return View::redirect('catalog'); // Redirect if the stamp is not found
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
    
    

}
?>