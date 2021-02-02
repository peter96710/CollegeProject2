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
Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'main'])->name('index');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware('auth');
Route::get('/about', [App\Http\Controllers\HomeController::class, 'about'])->name('about');
Route::get('/profile', [App\Http\Controllers\HomeController::class, 'profile'])->name('profile')->middleware('auth');
Route::get('/orders', [App\Http\Controllers\HomeController::class, 'orders'])->name('orders')->middleware('auth');


Route::get('/menu', [App\Http\Controllers\ItemController::class, 'showAll'])->name('menu');
Route::get('/menu/category/{id}', [App\Http\Controllers\ItemController::class, 'category'])->name('item');


Route::post('/cart/add/', [App\Http\Controllers\CartController::class, 'add'])->name('intocart')->middleware('auth');
Route::get('/cart/', [App\Http\Controllers\CartController::class, 'cart'])->name('cart')->middleware('auth');
Route::post('/cart/destroy/{id}', [App\Http\Controllers\CartController::class, 'destroy'])->name('destroy')->middleware('auth');
Route::post('/cart/send', [App\Http\Controllers\CartController::class, 'send'])->name('send')->middleware('auth');

Route::get('/admin/category/new', [App\Http\Controllers\AdminController::class, 'new'])->name('category_new')->middleware('can:isAdmin');
Route::get('/admin/category/store', [App\Http\Controllers\AdminController::class, 'store'])->name('category_store')->middleware('can:isAdmin');
Route::get('/admin/category/cat', [App\Http\Controllers\AdminController::class, 'cat'])->name('admin_category')->middleware('can:isAdmin');
Route::post('/admin/category/delete', [App\Http\Controllers\AdminController::class, 'delete'])->name('category_delete')->middleware('can:isAdmin');
Route::get('/admin/category/{id}/edit', [App\Http\Controllers\AdminController::class, 'edit'])->name('category_edit')->middleware('can:isAdmin');
Route::get('/admin/category/{id}/update', [App\Http\Controllers\AdminController::class, 'update'])->name('category_update')->middleware('can:isAdmin');

Route::get('/admin/item/new', [App\Http\Controllers\ItemController::class, 'new'])->name('item_new')->middleware('can:isAdmin');
Route::get('/admin/item/store', [App\Http\Controllers\ItemController::class, 'store'])->name('item_store')->middleware('can:isAdmin');
Route::get('/admin/item/item', [App\Http\Controllers\ItemController::class, 'items'])->name('admin_items')->middleware('can:isAdmin');
Route::post('/admin/item/delete', [App\Http\Controllers\ItemController::class, 'delete'])->name('item_delete')->middleware('can:isAdmin');
Route::post('/admin/item/{id}/restore', [App\Http\Controllers\ItemController::class, 'restore'])->name('item_restore')->middleware('can:isAdmin');
Route::get('/admin/item/{id}/edit', [App\Http\Controllers\ItemController::class, 'edit'])->name('item_edit')->middleware('can:isAdmin');
Route::get('/admin/item/{id}/update', [App\Http\Controllers\ItemController::class, 'update'])->name('item_update')->middleware('can:isAdmin');


Route::get('/admin/manage/received', [App\Http\Controllers\AdminController::class, 'manage'])->name('manage_orders')->middleware('can:isAdmin');
Route::get('/admin/manage/processed', [App\Http\Controllers\AdminController::class, 'processed'])->name('processed_orders')->middleware('can:isAdmin');
Route::get('/admin/manage/proc/{id}', [App\Http\Controllers\AdminController::class, 'proc'])->name('proc_order')->middleware('can:isAdmin');
Route::get('/admin/manage/edit/{id}', [App\Http\Controllers\AdminController::class, 'edit_order'])->name('edit_order')->middleware('can:isAdmin');
Route::post('/admin/manage/accept/{id}', [App\Http\Controllers\AdminController::class, 'accept'])->name('accept_order')->middleware('can:isAdmin');
Route::post('/admin/manage/reject/{id}', [App\Http\Controllers\AdminController::class, 'reject'])->name('reject_order')->middleware('can:isAdmin');
