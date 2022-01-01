<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AnswerController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\UserController;
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
Route::post('/new-question', 'QuestionController@create_question')->name('new-question')->middleware('auth');
Route::patch('/questions/{question}/{answer}', [QuestionController::class, 'acceptAnswer'])->name('question.accept');
Route::post('/questions/{question}/review/{type}', [QuestionController::class, 'review'])->name('question.review')->middleware('auth');
Route::delete('/questions/{question}/review/{type}', [QuestionController::class, 'unreview'])->name('question.review')->middleware('auth');
Route::delete('/questions/{id}', [QuestionController::class, 'delete'])->name('question.delete')->middleware('auth');
Route::get('/questions/{question}/edit', [QuestionController::class, 'editQuestion'])->name('question.edit');
Route::patch('/questions/{question}', [QuestionController::class, 'updateQuestion'])->name('question.update');

// Answers
Route::post('/questions/{id}/answers/new', 'AnswerController@create_answer')->name('new-answer')->middleware('auth');
Route::post('/answers/{answer}/review/{type}', [AnswerController::class, 'review'])->name('answer.review')->middleware('auth');
Route::delete('/answers/{answer}/review/{type}', [AnswerController::class, 'unreview'])->name('answer.review')->middleware('auth');
Route::delete('/answers/{answer}', [AnswerController::class, 'delete'])->name('answer.delete')->middleware('auth');
Route::patch('/answers/{answer}', [AnswerController::class, 'updateAnswer'])->name('answer.update');


// Comments
Route::post('/comments/{comment}/review/{type}', [CommentController::class, 'review'])->name('comment.review')->middleware('auth');
Route::delete('/comments/{comment}/review/{type}', [CommentController::class, 'unreview'])->name('comment.review')->middleware('auth');
Route::post('/comments/new', [CommentController::class, 'create_comment'])->name('new-comment')->middleware('auth');
Route::delete('/comments/{comment}/', [CommentController::class, 'delete'])->name('comment.delete')->middleware('auth');



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
Route::get('/user/{username}', 'UserController@show')->name('user');
Route::get('/user/{username}/edit', 'UserController@edit')->name('user-edit');
Route::post('/user/{username}', 'UserController@update')->name('user-update');


// Admin/Moderators
Route::get('/admin/{category}', 'AdminController@show')->name('adminPage')->middleware('admin');
Route::post('/admin/block/{user}', 'AdminController@changeBlock')->name('changeBlock')->middleware('admin');
Route::delete('/admin/users/{user}', 'AdminController@deleteUser')->name('deleteUser')->middleware('admin');
Route::delete('/admin/questions/{question}', 'AdminController@deleteQuestion')->name('deleteQuestion')->middleware('admin');
Route::delete('/admin/tags/{tag}', 'AdminController@deleteTag')->name('deleteTag')->middleware('admin');






// Search
Route::get('/search-result', 'SearchController@show')->name('search-result');

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
