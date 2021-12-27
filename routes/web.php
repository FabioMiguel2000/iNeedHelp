<?php


use App\Http\Controllers\QuestionController;
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
Route::get('/', 'HomePage@show')->name('home');

// Auth
Route::get('/login', 'Auth\LoginController@index')->name('login');
Route::post('/login', 'Auth\LoginController@login');
Route::get('/register', 'Auth\RegisterController@index')->name('register');
Route::post('/register', 'Auth\RegisterController@register');
Route::post('/logout', 'Auth\LogoutController@logout')->name('logout');

// Questions
Route::get('/questions', 'QuestionController@browse')->name('questions');
Route::get('/questions/{id}', 'QuestionController@show')->name('question');
Route::get('/new-question', 'QuestionController@show_create')->middleware('auth');
Route::post('/questions/{id}/answers/new', 'AnswerController@create_answer')->name('new-answer')->middleware('auth');
Route::post('/new-question', 'QuestionController@create_question')->name('new-question')->middleware('auth');
Route::post('/questions/{question}/review/{type}', [QuestionController::class, 'review'])->name('question.review')->middleware('auth');
Route::delete('/questions/{question}/review/{type}', [QuestionController::class, 'unreview'])->name('question.review')->middleware('auth');

//Tags
Route::get('/tags', 'TagsController@index')->name('tags');
Route::get('/tags/{id}', 'TagsController@show')->name('tag');

// Static Pages
Route::get('/about', function () {
    return view('pages.about');
})->name('about');
Route::get('/faq', function () {
    return view('pages.faq');
})->name('faq');

// User
Route::get('/user/{id}', 'UserController@show')->name('user');

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
