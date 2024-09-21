<?php
namespace App\Controllers;

use App\Providers\View;
/**
 * Responsable du traitement pour rendre disponible certaines pages de ce site
 */
class AuctionController {

    public function create() {
        View::render('auction/create', ['scripts'=> [
            'active-link.js'
        ]]);
    }
}
