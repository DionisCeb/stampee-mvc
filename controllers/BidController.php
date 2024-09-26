<?php

namespace App\Controllers;

use App\Providers\View;
use App\Models\Bid;
use App\Models\Auction;
use App\Providers\Auth;

class BidController {
    public function store() {
        // Ensure the user is authenticated
        Auth::session();

        if (!isset($_SESSION['user_id'])) {
            return View::redirect('login');
        }

        $userId = $_SESSION['user_id'];
        $auctionId = $_POST['auction_id'];
        $bidAmount = floatval($_POST['bid_amount']);

        // Retrieve the auction to validate the bid
        $auctionModel = new Auction();
        $auction = $auctionModel->findOne($auctionId);

        if (!$auction) {
            return View::render('error', ['message' => "L'enchère n'existe pas."]);
        }

        // Retrieve the current highest bid
        $bidModel = new Bid();
        $highestBid = $bidModel->getHighestBid($auctionId) ?? $auction['starting_price'];

        // Ensure the bid amount is higher than the current highest bid
        if ($bidAmount <= $highestBid) {
            return View::render('error/error', ['message' => "Votre mise doit être supérieure à la mise actuelle."]);
        }

        // Insert the bid
        $inserted = $bidModel->insertBid([
            'user_id' => $userId,
            'auction_id' => $auctionId,
            'bid_amount' => $bidAmount
        ]);

        if ($inserted) {
            $_SESSION['bid_status'] = 'Votre mise a été placée avec succès!';
            return View::redirect('stamp/details?id=' . $auction['stamp_id']);
        } else {
            return View::render('error/error', ['message' => "Impossible de placer la mise."]);
        }
    }
}
