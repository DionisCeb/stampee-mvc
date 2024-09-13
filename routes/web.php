<?php
use App\Controllers;
use App\Routes\Route;

Route::get('/home', 'HomeController@index');
Route::get('', 'HomeController@index');

/* auctions */
Route::get('/catalog/auctions', 'CatalogController@index');

/* product / stamp (specific wtih index) */
Route::get('/stamp/index', 'StampController@index');

/*les pages*/
Route::get('/page/actual', 'PagesController@actual');
Route::get('/page/about', 'PagesController@about');
Route::dispatch();
?>