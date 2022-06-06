<?php

use App\Http\Controllers\AuthorController;
use App\Http\Controllers\CategoryController;
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

// ADMIN AUTHORIZATION START
// -- MEMBER --
Route::get('/dashboard/members', [MemberController::class, 'index'])->name('members.index')->middleware('admin');

Route::get('/dashboard/members/create', [MemberController::class, 'create'])->name('members.create')->middleware('admin');

Route::post('/dashboard/members', [MemberController::class, 'store'])->name('members.store')->middleware('admin');

Route::get('/dashboard/members/{user:username}', [MemberController::class, 'show'])->name('members.show')->middleware('admin');

Route::get('/dashboard/members/{user:username}/edit', [MemberController::class, 'edit'])->name('members.edit')->middleware('admin');

Route::put('/dashboard/members/{user:username}', [MemberController::class, 'update'])->name('members.update')->middleware('admin');

Route::delete('/dashboard/members/{user:username}', [MemberController::class, 'destroy'])->name('members.destroy')->middleware('admin');

// -- AUTHOR --
Route::get('/dashboard/authors', [AuthorController::class, 'index'])->name('authors.index')->middleware('admin');

Route::get('/dashboard/authors/create', [AuthorController::class, 'create'])->name('authors.create')->middleware('admin');

Route::post('/dashboard/authors', [AuthorController::class, 'store'])->name('authors.store')->middleware('admin');

Route::get('/dashboard/authors/{author:author_code}', [AuthorController::class, 'show'])->name('authors.show')->middleware('admin');

Route::get('/dashboard/authors/{author:author_code}/edit', [AuthorController::class, 'edit'])->name('authors.edit')->middleware('admin');

Route::put('/dashboard/authors/{author:author_code}', [AuthorController::class, 'update'])->name('authors.update')->middleware('admin');

Route::delete('/dashboard/authors/{author:author_code}', [AuthorController::class, 'destroy'])->name('authors.destroy')->middleware('admin');

// -- PUBLISHER --
Route::get('/dashboard/publishers', [PublisherController::class, 'index'])->name('publishers.index')->middleware('admin');

Route::get('/dashboard/publishers/create', [PublisherController::class, 'create'])->name('publishers.create')->middleware('admin');

Route::post('/dashboard/publishers', [PublisherController::class, 'store'])->name('publishers.store')->middleware('admin');

Route::get('/dashboard/publishers/{publisher:publisher_code}', [PublisherController::class, 'show'])->name('publishers.show')->middleware('admin');

Route::get('/dashboard/publishers/{publisher:publisher_code}/edit', [PublisherController::class, 'edit'])->name('publishers.edit')->middleware('admin');

Route::put('/dashboard/publishers/{publisher:publisher_code}', [PublisherController::class, 'update'])->name('publishers.update')->middleware('admin');

Route::delete('/dashboard/publishers/{publisher:publisher_code}', [PublisherController::class, 'destroy'])->name('publishers.destroy')->middleware('admin');

// -- CATEGORY --
Route::get('/dashboard/categories', [CategoryController::class, 'index'])->name('categories.index')->middleware('admin');

Route::get('/dashboard/categories/create', [CategoryController::class, 'create'])->name('categories.create')->middleware('admin');

Route::post('/dashboard/categories', [CategoryController::class, 'store'])->name('categories.store')->middleware('admin');

Route::get('/dashboard/categories/{category:category_code}', [CategoryController::class, 'show'])->name('categories.show')->middleware('admin');

Route::get('/dashboard/categories/{category:category_code}/edit', [CategoryController::class, 'edit'])->name('categories.edit')->middleware('admin');

Route::put('/dashboard/categories/{category:category_code}', [CategoryController::class, 'update'])->name('categories.update')->middleware('admin');

Route::delete('/dashboard/categories/{category:category_code}', [CategoryController::class, 'destroy'])->name('categories.destroy')->middleware('admin');
// ADMIN AUTHORIZATION END
