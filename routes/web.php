<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\CatalogController;
use App\Http\Controllers\PublisherController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\TransactionDetailController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('test_spatie', [TransactionController::class, 'test_spatie']);

Route::resource('/catalogs', CatalogController::class);
Route::resource('/publishers', PublisherController::class);
Route::resource('/authors', AuthorController::class);
Route::resource('/members', MemberController::class);
Route::resource('/books', BookController::class);
Route::resource('/transactions', TransactionController::class);
Route::resource('/transaction_details', TransactionDetailController::class);


Route::get('/api/authors', [AuthorController::class, 'api']);
Route::get('/api/publishers', [publisherController::class, 'api']);
Route::get('/api/members', [MemberController::class, 'api']);
Route::get('/api/books', [BookController::class, 'api']);
Route::get('/api/transactions', [TransactionController::class, 'api']);
Route::get('/api/transaction_details', [TransactionDetailController::class, 'api']);




