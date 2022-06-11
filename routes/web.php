<?php

use App\Http\Controllers\AuthorController;
use App\Http\Controllers\BibliographyController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CirculationController;
use App\Http\Controllers\CollectionController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\PublisherController;
use Illuminate\Auth\Events\Registered;
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

Route::get('/', [PageController::class, 'redirectToHome']);

Route::get('/home', [PageController::class, 'index'])->name('index');

Route::get('/login', [LoginController::class, 'index'])->name('login.index')->middleware('guest');

Route::post('/login', [LoginController::class, 'authenticate'])->name('login.authenticate')->middleware('guest');

Route::post('/logout', [LoginController::class, 'logout'])->middleware('auth');

Route::get('/register', [RegisterController::class, 'index'])->name('register.index')->middleware('guest');

Route::post('/register', [RegisterController::class, 'store'])->name('register.store')->middleware('guest');

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index')->middleware('auth');

Route::get('/bibliographies', [PageController::class, 'bibliographies'])->name('public.bibliographies');

Route::get('/bibliographies/{bibliography:book_code}', [PageController::class, 'detailBiblio'])->name('public.bibliographies.show');

Route::get('/transaction/{collection:collection_code}/create', [PageController::class, 'borrowForm'])->name('member.borrow')->middleware('member');

Route::get('/ticket/{circulation:transaction_code}', [CirculationController::class, 'ticket'])->name('ticket');

Route::get('/transaction/{circulation:transaction_code}', [CirculationController::class, 'transaction'])->name('transaction');

Route::get('/categories', [PageController::class, 'categories'])->name('public.categories');

Route::get('/authors', [PageController::class, 'authors'])->name('public.authors');

Route::get('/publishers', [PageController::class, 'publishers'])->name('public.publishers');

// MEMBER START
// -- PROFILE -- //
Route::get('/dashboard/profile/{user:username}', [DashboardController::class, 'profile'])->name('dashboard.profile')->middleware('member');

Route::get('/dashboard/profile/{user:username}/edit', [DashboardController::class, 'editProfile'])->name('dashboard.profile.edit')->middleware('member');

// -- CHANGE PASSWORD -- //
Route::get('/dashboard/change-password', [DashboardController::class, 'viewChangePassword'])->name('dashboard.change-password')->middleware('member');

Route::post('/dashboard/change-password', [DashboardController::class, 'changePassword'])->middleware('member');

// -- TRANSACTION -- //
Route::get('/dashboard/transactions/{user:username}', [DashboardController::class, 'transaction'])->name('dashboard.transactions')->middleware('member');

// MEMBER END

// ADMIN AUTHORIZATION START //
// -- MEMBER -- //
Route::get('/dashboard/members', [MemberController::class, 'index'])->name('members.index')->middleware('admin');

Route::get('/dashboard/members/create', [MemberController::class, 'create'])->name('members.create')->middleware('admin');

Route::post('/dashboard/members', [MemberController::class, 'store'])->name('members.store')->middleware('admin');

Route::get('/dashboard/members/{user:username}', [MemberController::class, 'show'])->name('members.show')->middleware('admin');

Route::get('/dashboard/members/{user:username}/edit', [MemberController::class, 'edit'])->name('members.edit')->middleware('admin');

Route::put('/dashboard/members/{user:username}', [MemberController::class, 'update'])->name('members.update');

Route::delete('/dashboard/members/{user:username}', [MemberController::class, 'destroy'])->name('members.destroy')->middleware('admin');

// -- AUTHOR -- //
Route::get('/dashboard/authors', [AuthorController::class, 'index'])->name('authors.index')->middleware('admin');

Route::get('/dashboard/authors/create', [AuthorController::class, 'create'])->name('authors.create')->middleware('admin');

Route::post('/dashboard/authors', [AuthorController::class, 'store'])->name('authors.store')->middleware('admin');

Route::get('/dashboard/authors/{author:author_code}', [AuthorController::class, 'show'])->name('authors.show')->middleware('admin');

Route::get('/dashboard/authors/{author:author_code}/edit', [AuthorController::class, 'edit'])->name('authors.edit')->middleware('admin');

Route::put('/dashboard/authors/{author:author_code}', [AuthorController::class, 'update'])->name('authors.update')->middleware('admin');

Route::delete('/dashboard/authors/{author:author_code}', [AuthorController::class, 'destroy'])->name('authors.destroy')->middleware('admin');

// -- PUBLISHER -- //
Route::get('/dashboard/publishers', [PublisherController::class, 'index'])->name('publishers.index')->middleware('admin');

Route::get('/dashboard/publishers/create', [PublisherController::class, 'create'])->name('publishers.create')->middleware('admin');

Route::post('/dashboard/publishers', [PublisherController::class, 'store'])->name('publishers.store')->middleware('admin');

Route::get('/dashboard/publishers/{publisher:publisher_code}', [PublisherController::class, 'show'])->name('publishers.show')->middleware('admin');

Route::get('/dashboard/publishers/{publisher:publisher_code}/edit', [PublisherController::class, 'edit'])->name('publishers.edit')->middleware('admin');

Route::put('/dashboard/publishers/{publisher:publisher_code}', [PublisherController::class, 'update'])->name('publishers.update')->middleware('admin');

Route::delete('/dashboard/publishers/{publisher:publisher_code}', [PublisherController::class, 'destroy'])->name('publishers.destroy')->middleware('admin');

// -- CATEGORY -- //
Route::get('/dashboard/categories', [CategoryController::class, 'index'])->name('categories.index')->middleware('admin');

Route::get('/dashboard/categories/create', [CategoryController::class, 'create'])->name('categories.create')->middleware('admin');

Route::post('/dashboard/categories', [CategoryController::class, 'store'])->name('categories.store')->middleware('admin');

Route::get('/dashboard/categories/{category:category_code}', [CategoryController::class, 'show'])->name('categories.show')->middleware('admin');

Route::get('/dashboard/categories/{category:category_code}/edit', [CategoryController::class, 'edit'])->name('categories.edit')->middleware('admin');

Route::put('/dashboard/categories/{category:category_code}', [CategoryController::class, 'update'])->name('categories.update')->middleware('admin');

Route::delete('/dashboard/categories/{category:category_code}', [CategoryController::class, 'destroy'])->name('categories.destroy')->middleware('admin');

// -- BIBLIOGRAPHY -- //
Route::get('/dashboard/bibliographies', [BibliographyController::class, 'index'])->name('bibliographies.index')->middleware('admin');

Route::get('/dashboard/bibliographies/create', [BibliographyController::class, 'create'])->name('bibliographies.create')->middleware('admin');

Route::post('/dashboard/bibliographies', [BibliographyController::class, 'store'])->name('bibliographies.store')->middleware('admin');

Route::get('/dashboard/bibliographies/{bibliography:book_code}', [BibliographyController::class, 'show'])->name('bibliographies.show')->middleware('admin');

Route::get('/dashboard/bibliographies/{bibliography:book_code}/edit', [BibliographyController::class, 'edit'])->name('bibliographies.edit')->middleware('admin');

Route::put('/dashboard/bibliographies/{bibliography:book_code}', [BibliographyController::class, 'update'])->name('bibliographies.update')->middleware('admin');

Route::delete('/dashboard/bibliographies/{bibliography:book_code}', [BibliographyController::class, 'destroy'])->name('bibliographies.destroy')->middleware('admin');

// -- COLLECTIONS -- //
Route::get('/dashboard/bibliographies/{bibliography:book_code}/collections/create/', [CollectionController::class, 'create'])->name('collections.create')->middleware('admin');

Route::post('/dashboard/bibliographies/{bibliography:book_code}/collections', [CollectionController::class, 'store'])->name('collections.store')->middleware('admin');

Route::get('/dashboard/collections/{collection:collection_code}/edit', [CollectionController::class, 'edit'])->name('collections.edit')->middleware('admin');

Route::put('/dashboard/collections/{collection:collection_code}', [CollectionController::class, 'update'])->name('collections.update')->middleware('admin');

Route::delete('/dashboard/collections/{collection:collection_code}', [CollectionController::class, 'destroy'])->name('collections.destroy')->middleware('admin');

// -- TRANSACTIONS -- //
Route::get('/dashboard/transactions', [CirculationController::class, 'index'])->name('circulations.index')->middleware('admin');

Route::get('/dashboard/transactions/{collection:collection_code}/create', [CirculationController::class, 'create'])->name('circulations.create')->middleware('admin');

Route::post('/dashboard/transactions/{collection:collection_code}', [CirculationController::class, 'store'])->name('circulations.store');

Route::get('/dashboard/transactions/{circulation:transaction_code}', [CirculationController::class, 'show'])->name('circulations.show')->middleware('admin');

Route::put('/dashboard/transactions/{circulation:transaction_code}', [CirculationController::class, 'update'])->name('circulations.update')->middleware('admin');

Route::get('/dashboard/requests', [CirculationController::class, 'requestToBorrow'])->name('circulations.requestToBorrow')->middleware('admin');

// ADMIN AUTHORIZATION END //
