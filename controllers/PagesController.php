<?php
namespace App\Controllers;

use App\Providers\View;
/**
 * Responsable du traitement pour rendre disponible certaines pages de ce site
 */
class PagesController {
    public function actual() {
        View::render('page/actual', ['scripts'=> [
            'active-link.js'
        ]]);
    }

    public function about() {
        View::render('page/about', ['scripts'=> [
            'active-link.js'
        ]]);
    }
}
