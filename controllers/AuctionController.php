<?php
namespace App\Controllers;

use App\Providers\View;
use App\Models\Auction;
use App\Models\User;
use App\Models\Stamp;
use App\Models\StampImage;
/**
 * Responsable du traitement pour rendre disponible certaines pages de ce site
 */
class AuctionController {

    public function create() {
        // Check if the stamp ID is present and valid in the URL
        if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
            return View::redirect('catalog'); // Redirect if no valid ID is provided
        }

        $stampId = intval($_GET['id']);

        // Retrieve the stamp details using the findOne() method from the Stamp model
        $stampModel = new Stamp();
        $stamp = $stampModel->findOne($stampId);

        // Check if the stamp exists
        if (!$stamp) {
            return View::redirect('catalog'); // Redirect if stamp not found
        }

        //Check if user is logged in
        if (!isset($_SESSION['user_id'])) {
            return View::redirect('login');
        }

        // Check if the logged-in user is the creator of the stamp
        if ($stamp['user_id'] != $_SESSION['user_id']) {
            return View::redirect('catalog'); // Redirect if the user is not the owner of the stamp
        }

        // Pass stamp data to the auction creation view
        View::render('auction/create', [
            'scripts' => ['active-link.js'],
            'stamp' => $stamp, // Pass the stamp data for display if needed
            'stamp_id' => $stampId // Pass the stamp_id to the form
        ]);
    }
    

    public function store() {
        // Validate the incoming stamp_id
        if (!isset($_POST['stamp_id']) || !is_numeric($_POST['stamp_id'])) {
            return View::render('error', ['message' => 'Le ID du timbre est manquant ou invalide.']);
        }
    
        $data = [
            'stamp_id' => intval($_POST['stamp_id']),
            'start_date' => $_POST['start_date'],
            'end_date' => $_POST['end_date'],
            'starting_price' => floatval($_POST['starting_price']),
        ];
    
        // Insert auction data into the auctions table
        $auctionModel = new Auction();
        $insert = $auctionModel->insert($data);
    
        if ($insert) {
            return View::redirect('user/collection'); // Redirect back to the user's collection page
        } else {
            return View::render('error', ['message' => "Impossible de créer l'enchère."]);
        }
    }



    /**
     * EDIT VIEW
     */

     public function edit() {
        // Check if auction ID is present and valid
        if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
            return View::redirect('user/collection'); // Redirect if no valid ID is provided
        }
    
        $auctionId = intval($_GET['id']);
        $auctionModel = new Auction();
        $auction = $auctionModel->findOne($auctionId); // Fetch auction details
    
        if (!$auction) {
            return View::redirect('user/collection'); // Redirect if auction is not found
        }
    
        // Check if the user is logged in
        if (!isset($_SESSION['user_id'])) {
            return View::redirect('login');
        }
    
        // Retrieve the stamp details to validate the creator
        $stampModel = new Stamp();
        $stamp = $stampModel->findOne($auction['stamp_id']);
        
        // Ensure the logged-in user is the creator of the stamp
        if ($stamp['user_id'] != $_SESSION['user_id']) {
            return View::redirect('user/collection');
        }
    
        View::render('auction/edit', [
            'auction' => $auction,
            'scripts' => ['active-link.js']
        ]);
    }


    public function update() {
        if (!isset($_POST['auction_id']) || !is_numeric($_POST['auction_id'])) {
            return View::render('error', ['message' => 'L\'ID de l\'enchère est manquant ou invalide.']);
        }
    
        $auctionId = intval($_POST['auction_id']);
    
        $data = [
            'start_date' => $_POST['start_date'],
            'end_date' => $_POST['end_date'],
            'starting_price' => floatval($_POST['starting_price'])
        ];
    
        $auctionModel = new Auction();
        $update = $auctionModel->updateAuction($data, $auctionId);
    
        if ($update) {
            return View::redirect('user/collection');
        } else {
            return View::render('error', ['message' => "Impossible de mettre à jour l'enchère."]);
        }
    }
    


    public function userAuctions() {
        // Check if the user is logged in
        if (!isset($_SESSION['user_id'])) {
            return View::redirect('login'); // Redirect to login if not logged in
        }
    
        $userId = $_SESSION['user_id']; // Get the logged-in user's ID
    
        $auctionModel = new Auction();
        $stampImageModel = new StampImage();
        $stampModel = new Stamp();
    
        // Fetch all auctions created by the logged-in user
        $auctions = $auctionModel->findByUserId($userId);
    
        // Retrieve the associated stamps and images for each auction
        foreach ($auctions as &$auction) {
            $stamp = $stampModel->findOne($auction['stamp_id']);
            $auction['stamp'] = $stamp;
    
            $images = $stampImageModel->findByStampId($auction['stamp_id']);
            $auction['images'] = $images;
        }

        View::render('auction/collection', [
            'auctions' => $auctions,
            'stamp' => $stamp,
            'scripts' => ['product-card-slider.js']
        ]);
    }
    
    
    
}
