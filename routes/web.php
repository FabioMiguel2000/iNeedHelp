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
Route::get('/account-recovery', 'Auth\RecoverAccountController@show')->name('recover')->middleware('guest');
Route::post('/account-recovery/send-email', 'Auth\RecoverAccountController@sendRecoverEmail')->name('password.email')->middleware('guest');

Route::get('/reset-password','Auth\RecoverAccountController@showPasswordResetPage')->name('password.reset');
Route::post('/reset-password', 'Auth\RecoverAccountController@changePassword')->middleware('guest')->name('password.confirmReset');

Route::get('/login', 'Auth\LoginController@index')->name('login')->middleware('guest');
Route::post('/login', 'Auth\LoginController@login')->middleware('guest');
Route::get('/register', 'Auth\RegisterController@index')->name('register')->middleware('guest');
Route::post('/register', 'Auth\RegisterController@register')->middleware('guest');
Route::post('/logout', 'Auth\LogoutController@logout')->name('logout')->middleware('auth');


// Questions
Route::get('/questions', 'QuestionController@browse')->name('questions');
Route::get('/questions/{id}', 'QuestionController@show')->name('question');
Route::get('/new-question', 'QuestionController@show_create')->middleware('auth')->middleware('notBanned');
Route::post('/new-question', 'QuestionController@create_question')->name('new-question')->middleware('auth');
Route::post('/questions/{question}/review/{type}', [QuestionController::class, 'review'])->name('question.review')->middleware('auth');
Route::delete('/questions/{question}/review/{type}', [QuestionController::class, 'unreview'])->name('question.unreview')->middleware('auth');
Route::delete('/questions/{question}', [QuestionController::class, 'delete'])->name('question.delete')->middleware('auth');
Route::get('/questions/{question}/edit', [QuestionController::class, 'showEditQuestion'])->name('question.edit');
Route::patch('/questions/{question}', [QuestionController::class, 'updateQuestion'])->name('question.update');
Route::post('/questions/follow/{question}', [QuestionController::class, 'follow'])->name('question.follow')->middleware('auth');
Route::post('/questions/unfollow/{question}', [QuestionController::class, 'unfollow'])->name('question.unfollow')->middleware('auth');


// Answers
Route::patch('/questions/{question}/{answer}', [QuestionController::class, 'acceptAnswer'])->name('question.accept');
Route::delete('/questions/{question}/{answer}', [QuestionController::class, 'unacceptAnswer'])->name('question.unaccept');
Route::post('/questions/{id}/answers/new', 'AnswerController@create_answer')->name('new-answer')->middleware('auth')->middleware('notBanned');
Route::post('/answers/{answer}/review/{type}', [AnswerController::class, 'review'])->name('answer.review')->middleware('auth')->middleware('notBanned');
Route::delete('/answers/{answer}/review/{type}', [AnswerController::class, 'unreview'])->name('answer.unreview')->middleware('auth')->middleware('notBanned');
Route::delete('/answers/{answer}', [AnswerController::class, 'delete'])->name('answer.delete')->middleware('auth')->middleware('notBanned');
Route::patch('/answers/{answer}', [AnswerController::class, 'updateAnswer'])->name('answer.update')->middleware('notBanned');

// Comments
Route::post('/comments/{comment}/review/{type}', [CommentController::class, 'review'])->name('comment.review')->middleware('auth')->middleware('notBanned');
Route::delete('/comments/{comment}/review/{type}', [CommentController::class, 'unreview'])->name('comment.unreview')->middleware('auth')->middleware('notBanned');
Route::post('/comments/new', [CommentController::class, 'create_comment'])->name('new-comment')->middleware('auth')->middleware('notBanned');
Route::delete('/comments/{comment}/', [CommentController::class, 'delete'])->name('comment.delete')->middleware('auth')->middleware('notBanned');
Route::patch('/comments/{comment}', [CommentController::class, 'updateComment'])->name('comment.update')->middleware('notBanned');

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
Route::get('/user/{username}/edit', 'UserController@edit')->name('user-edit')->middleware('auth');
Route::post('/user/{username}', 'UserController@update')->name('user-update')->middleware('auth');
Route::get('/user/{username}/delete', 'UserController@userDelete')->name('user-delete');
Route::post('/user/{username}/confirmed-delete', 'UserController@deleteAccount')->name('confirmed-delete');

// Admin/Moderators
Route::group(['middleware' => 'admin'], function () {
    Route::get('/admin/{category}', 'AdminController@show')->name('adminPage');
    Route::post('/admin/block/{user}', 'AdminController@changeBlock')->name('changeBlock');
    Route::delete('/admin/users/{user}', 'AdminController@deleteUser')->name('deleteUser');
    Route::delete('/admin/questions/{question}', 'AdminController@deleteQuestion')->name('deleteQuestion');
    Route::delete('/admin/tags/{tag}', 'AdminController@deleteTag')->name('deleteTag');
    Route::post('/admin/users/{user}', 'AdminController@changeModerator')->name('changeModerator');
});

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
