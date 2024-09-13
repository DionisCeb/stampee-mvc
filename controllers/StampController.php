<?php
namespace App\Controllers;

use App\Providers\View;

class StampController{
    public function index(){
        
        View::render('stamp/index', ['scripts'=> [
            'product-card-slider.js',
        ]]);
    }

}
?>