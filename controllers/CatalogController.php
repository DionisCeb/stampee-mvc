<?php
namespace App\Controllers;

use App\Providers\View;

class CatalogController{
    public function index(){
        
        View::render('catalog/auctions', ['scripts'=> [
            /* 'catalog.js', */
            'timer.js',
            'emailsender.js',
        ]]);
    }

}
?>