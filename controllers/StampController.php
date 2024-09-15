<?php
namespace App\Controllers;

use App\Providers\View;
use App\Models\Stamp;

class StampController{

    public function index(){
        
        View::render('stamp/details', ['scripts'=> [
            'product-card-slider.js',
        ]]);
    }
    

    public function list() {
        $stampModel = new Stamp();
        $stamps = $stampModel->findAll(); // Fetch all stamps
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
    
    

}
?>