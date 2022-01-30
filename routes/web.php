<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Route as RouteAlias;
use App\Http\Controllers\UserController;

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
//
//Route::get('/', function () {
//    return view('home');
//});

Auth::routes();
Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::get('/post/{post}', [App\Http\Controllers\PostController::class, 'show'])->name('post');

Route::middleware('auth')->group(function(){

    Route::get('/admin/posts/', [App\Http\Controllers\PostController::class,'index'])->name('post.index');


    Route::get('/admin', [App\Http\Controllers\AdminsController::class, 'index'])->name('admin.index');
    Route::get('/admin/posts/create', [App\Http\Controllers\PostController::class, 'create'])->name('post.create');
    Route::post('/admin/posts/', [App\Http\Controllers\PostController::class,'store'])->name('post.store');



    Route::delete('/admin/posts/{post}/destroy', [App\Http\Controllers\PostController::class,'destroy'])->name('post.destroy');
    Route::patch('/admin/posts/{post}/update', [App\Http\Controllers\PostController::class,'update'])->name('post.update');
    Route::get('/admin/posts/{post}/edit', [App\Http\Controllers\PostController::class,'edit'])->name('post.edit');

    Route::get('admin/users/{user}/profile', [App\Http\Controllers\UserController::class,'show'])->name('user.profile.show');
    Route::put('admin/users/{user}/update', [App\Http\Controllers\UserController::class,'update'])->name('user.profile.update');
    Route::get('admin/users', [App\Http\Controllers\UserController::class,'index'])->name('users.index');

    Route::delete('admin/users', [App\Http\Controllers\UserController::class,'destroy'])->name('user.destroy');
    Route::put('/users/{user}/attach', [App\Http\Controllers\UserController::class, 'attach'])->name('user.role.attach');
    Route::put('/users/{user}/detach', [App\Http\Controllers\UserController::class, 'detach'])->name('user.role.detach');


});

Route::middleware(['role:admin', 'auth'])->group(function(){


    Route::get('admin/users',[App\Http\Controllers\UserController::class,'index'])->name('users.index');


});
 Route::middleware(['can:view,user'])->group(function(){


    Route::get('admin/users/{user}/profile',[App\Http\Controllers\UserController::class,'show'])->name('user.profile.show');


});

    Route::get('/roles', [App\Http\Controllers\RoleController::class, 'index'])->name('roles.index');

    Route::get('/permissions', [App\Http\Controllers\PermissionController::class, 'index'])->name('permissions.index');

Route::post('/roles', [App\Http\Controllers\RoleController::class, 'store'])->name('roles.store');

Route::delete('/roles/{role}/destroy', [App\Http\Controllers\RoleController::class, 'destroy'])->name('roles.destroy');
Route::get('/roles/{role}/edit', [App\Http\Controllers\RoleController::class, 'edit'])->name('roles.edit');
Route::put('/roles/{role}/update', [App\Http\Controllers\RoleController::class, 'update'])->name('roles.update');
Route::put('/roles/{role}/attach', [App\Http\Controllers\RoleController::class,'attach_permission'])->name('role.permission.attach');
Route::put('/roles/{role}/detach', [App\Http\Controllers\RoleController::class,'detach_permission'])->name('role.permission.detach');

Route::post('/permissions', [App\Http\Controllers\PermissionController::class, 'store'])->name('permissions.store');
Route::delete('/permissions/{permission}/destroy', [App\Http\Controllers\PermissionController::class, 'destroy'])->name('permissions.destroy');
Route::get('/permissions/{permission}/edit', [App\Http\Controllers\PermissionController::class, 'edit'])->name('permissions.edit');
Route::put('/permissions/{permission}/update', [App\Http\Controllers\PermissionController::class, 'update'])->name('permissions.update');





