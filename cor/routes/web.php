<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PubController;
use App\Http\Controllers\DrinkingController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\PermissionRoleController;
use App\Http\Controllers\RoleController;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home-list', function () {
    return view('home.list');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::group(['prefix' => 'users' , 'as' => 'users.', 'middleware' => 'role:admin'], function () {
    Route::get('/', [UserController::class, 'index'])->name('index');
    Route::get('/create', [UserController::class, 'create'])->name('create');
    Route::post('/create', [UserController::class, 'store'])->name('store')->middleware('role:admin,create_post');
    Route::get('/edit/{id}', [UserController::class, 'edit'])->name('edit');
    Route::post('/edit/{id}', [UserController::class, 'update'])->name('update')->middleware('role:admin,update_post');
    Route::post('/delete/{id}', [UserController::class, 'destroy'])->name('delete');
    Route::post('/destroyAttach/{id}', [UserController::class, 'destroyAttach'])->name('delete_attach');
});


Route::group(['prefix' => 'pubs' , 'as' => 'pubs.'], function () {
    Route::get('/', [PubController::class, 'index'])->name('index');
    Route::get('/trash', [PubController::class, 'trash'])->name('trash');
    Route::get('/record/{id}', [PubController::class, 'record'])->name('record');
    Route::get('/create', [PubController::class, 'create'])->name('create');
    Route::get('/exportEx', [PubController::class, 'exportEx'])->name('exportEx');
    Route::post('/create', [PubController::class, 'store'])->name('store');
    Route::get('/edit/{id}', [PubController::class, 'edit'])->name('edit');
    Route::post('/edit/{id}', [PubController::class, 'update'])->name('update');
    Route::post('/delete/{id}', [PubController::class, 'destroy'])->name('delete');
    Route::post('/forceDelete/{id}', [PubController::class, 'forceDelete'])->name('forceDelete');
});


Route::group(['prefix' => 'drinking' , 'as' => 'drinking.'], function () {
    Route::get('/', [DrinkingController::class, 'index'])->name('index');
    Route::get('/create', [DrinkingController::class, 'create'])->name('create');
    Route::post('/create', [DrinkingController::class, 'store'])->name('store');
    Route::get('/edit/{id}', [DrinkingController::class, 'edit'])->name('edit');
    Route::post('/edit/{id}', [DrinkingController::class, 'update'])->name('update');
    Route::post('/delete/{id}', [DrinkingController::class, 'destroy'])->name('delete');
});

Route::group(['prefix' => 'permission' , 'as' => 'permission.'], function () {
    Route::get('/', [PermissionController::class, 'index'])->name('index');
    Route::get('/create', [PermissionController::class, 'create'])->name('create');
    Route::post('/create', [PermissionController::class, 'store'])->name('store');
    Route::get('/edit/{id}', [PermissionController::class, 'edit'])->name('edit');
    Route::post('/edit/{id}', [PermissionController::class, 'update'])->name('update');
    Route::post('/delete/{id}', [PermissionController::class, 'destroy'])->name('delete');
});

Route::group(['prefix' => 'permissionRole' , 'as' => 'permissionRole.'], function () {
    Route::get('/', [PermissionRoleController::class, 'index'])->name('index');
    Route::get('/create', [PermissionRoleController::class, 'create'])->name('create');
    Route::post('/create', [PermissionRoleController::class, 'store'])->name('store');
    Route::get('/edit/{id}', [PermissionRoleController::class, 'edit'])->name('edit');
    Route::post('/edit/{id}', [PermissionRoleController::class, 'update'])->name('update');
    Route::post('/delete/{id}', [PermissionRoleController::class, 'destroy'])->name('delete');
});

Route::group(['prefix' => 'role' , 'as' => 'role.'], function () {
    Route::get('/', [RoleController::class, 'index'])->name('index');
    Route::get('/create', [RoleController::class, 'create'])->name('create');
    Route::post('/create', [RoleController::class, 'store'])->name('store');
    Route::get('/edit/{id}', [RoleController::class, 'edit'])->name('edit');
    Route::post('/edit/{id}', [RoleController::class, 'update'])->name('update');
    Route::post('/delete/{id}', [RoleController::class, 'destroy'])->name('delete');
    Route::post('/destroyAttach/{id}', [RoleController::class, 'destroyAttach'])->name('delete_attach');
});
