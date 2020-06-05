<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });


// Auth::routes();
// //login
// //register
Route::get('/', function (){
    return view('main.index');
});

Route::get('/index', 'IndexController@index');

Route::get('/article/index', 'ArticleController@index')->name('article.index');

Route::post('/article/store', 'ArticleController@store')->name('article.store');



Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
