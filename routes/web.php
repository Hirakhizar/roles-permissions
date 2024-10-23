<?php

use App\Http\Controllers\AssignRolesController;
use App\Http\Controllers\PermissionsController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\rolesController;
use App\Http\Controllers\rolesPermissionsController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard',[AssignRolesController::class, 'dashboard'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
// route::get('/roles-permissions',[rolesPermissionsController::class,''])

Route::prefix('roles')->controller(RolesController::class)->group(function(){
    Route::get('/index', 'index')->name('roles'); // You might want to rename this to 'roles.index'
    Route::post('/store', 'store')->name('roles.store');
    
    // Update the edit route to accept an ID parameter
    Route::get('/edit/{id}', 'edit')->name('roles.edit'); // This should include {id} to fetch a specific role

    Route::post('/update/{id}', 'update')->name('roles.update'); // This is fine as it is
    Route::delete('/delete/{id}', 'destroy')->name('roles.destroy'); // Change to DELETE method and add {id}
});

Route::prefix('permissions')->controller(PermissionsController::class)->group(function(){
    Route::get('/index', 'index')->name('permissions'); // You might want to rename this to 'roles.index'
    Route::post('/store', 'store')->name('permissions.store');
    
    // Update the edit route to accept an ID parameter
    Route::get('/edit/{id}', 'edit')->name('permissions.edit'); // This should include {id} to fetch a specific role

    Route::post('/update/{id}', 'update')->name('permissions.update'); // This is fine as it is
    Route::delete('/delete/{id}', 'destroy')->name('permissions.destroy'); // Change to DELETE method and add {id}
});
Route::prefix('assign-roles-permissions')->controller(AssignRolesController::class)->group(function(){
    Route::get('/index', 'index')->name('manage-assignments'); // You might want to rename this to 'roles.index'
    Route::post('/store-permissions', 'assignPermissions')->name('assign.permissions.store');
    Route::post('/store-roles', 'assignRoles')->name('assign.roles.store');
    // Update the edit route to accept an ID parameter
    Route::get('/edit/{id}', 'edit')->name('permissions.edit'); // This should include {id} to fetch a specific role

    Route::post('/update/{id}', 'update')->name('permissions.update'); // This is fine as it is
    Route::delete('/delete/{id}', 'destroy')->name('permissions.destroy'); // Change to DELETE method and add {id}
});

