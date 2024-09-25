<?php

namespace App\Controllers;

use App\Models\Favourite;
use App\Providers\View;

class FavouriteController {

    public function toggle() {
        if (!isset($_POST['stamp_id']) || !isset($_POST['is_favourite'])) {
            return View::render('error', ['message' => 'Invalid request']);
        }

        $stampId = intval($_POST['stamp_id']);
        $isFavourite = intval($_POST['is_favourite']);
        $userId = $_SESSION['user_id'];

        $favouriteModel = new Favourite();

        if ($isFavourite) {
            // Add to favorites
            $favouriteModel->addToFavourite($userId, $stampId);
        } else {
            // Remove from favorites
            $favouriteModel->removeFromFavourite($userId, $stampId);
        }

        // Redirect back to the previous page
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        exit;
    }
}
