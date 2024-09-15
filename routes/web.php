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

/* product / stamp (specific wtih index) */
Route::get('/stamp/details', 'StampController@details');
Route::get('/catalog', 'StampController@list');


/*les pages*/
Route::get('/page/actual', 'PagesController@actual');
Route::get('/page/about', 'PagesController@about');
Route::dispatch();


/* USER CREATE */
Route::get('/user/create', 'UserController@create');
Route::post('/user/create', 'UserController@store');

/*login*/
/* Route::get('/auth/index', 'AuthController@index'); */





/*logout*/
Route::get('/logout', 'AuthController@delete');
?>