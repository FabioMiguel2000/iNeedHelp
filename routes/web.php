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

// Home
Route::get('/', 'HomePage@show');

// Auth
Route::get('/register', 'Auth\RegisterController@index');
Route::post('/register', 'Auth\RegisterController@register')->name('register');

// Questions
Route::get('/questions/{id}', 'QuestionController@show');
Route::get('/new-question', 'QuestionController@show_create');
Route::post('/new-question', 'QuestionController@create_question')->name('new-question');

// Static Pages
Route::get('/about', 'Static\AboutUsController@index');
Route::get('/faq', 'Static\FaqController@index');

// // Cards
// Route::get('cards', 'CardController@list');
// Route::get('cards/{id}', 'CardController@show');

// // API
// Route::put('api/cards', 'CardController@create');
// Route::delete('api/cards/{card_id}', 'CardController@delete');
// Route::put('api/cards/{card_id}/', 'ItemController@create');
// Route::post('api/item/{id}', 'ItemController@update');
// Route::delete('api/item/{id}', 'ItemController@delete');

// // Authentication
// Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
// Route::post('login', 'Auth\LoginController@login');
// Route::get('logout', 'Auth\LoginController@logout')->name('logout');
// Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
// Route::post('register', 'Auth\RegisterController@register');
