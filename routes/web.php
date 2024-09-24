<?php
use App\Controllers;
use App\Routes\Route;

Route::get('/home', 'HomeController@index');
Route::get('', 'HomeController@index');



/* login page */
Route::get('/login', 'AuthController@index');
Route::post('/login', 'AuthController@store');

/* USER CREATE */
Route::get('/user/create', 'UserController@create');
Route::post('/user/create', 'UserController@store');
/* USER EDIT */
Route::get('/user/edit', 'UserController@edit');
Route::post('/user/edit', 'UserController@update');

/*logout*/
Route::get('/logout', 'AuthController@delete');

/*user collection*/
Route::get('/user/collection', 'StampController@collection');



/* product / stamp (specific wtih index) */
Route::get('/stamp/details', 'StampController@details');
Route::get('/stamp/create', 'StampController@create');
Route::post('/stamp/create', 'StampController@store');

/**
 * Stamp edit
 */
Route::get('/stamp/edit', 'StampController@edit');
Route::post('/stamp/edit', 'StampController@update');


Route::get('/catalog', 'StampController@list');



/*les pages*/
Route::get('/page/actual', 'PagesController@actual');
Route::get('/page/about', 'PagesController@about');

Route::get('/auctioning/create', 'AuctionController@create');
Route::post('/auctioning/store', 'AuctionController@store');


Route::dispatch();


/* USER CREATE */
/* Route::get('/user/create', 'UserController@create');
Route::post('/user/create', 'UserController@store'); */









?>