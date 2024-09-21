<?php
namespace App\Controllers;

use App\Providers\View;
use App\Models\Auction;
use App\Models\User;
use App\Models\Stamp;
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
    
}
