<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\UserDataController;
use App\Http\Controllers\PictureController;
use App\Http\Controllers\HomeController;
use App\Http\Middleware\RedirectIfNotUser;
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

Route::group(['middleware' => RedirectIfNotUser::class], function () {

  Route::get('/users/export', [UserDataController::class, 'exportView'])->name('users.export.view');
  Route::get('/users/import', [UserDataController::class, 'importView'])->name('users.import.view');
  Route::post('/users/export', [UserDataController::class, 'export'])->name('users.export');
  Route::post('/users/import', [UserDataController::class, 'import'])->name('users.import');

  Route::get('', [HomeController::class, 'index'])->name('homes');
  Route::get('/home', [HomeController::class, 'index'])->name('home');
  Route::group(['prefix' => '/users','as' => 'users.',  'controller' => UserDataController::class], function () {
      Route::get('/create', 'createalbum')->name('create');
      Route::post('/create', 'storeInformationUser')->name('store');
      Route::get('/edit/{id}', 'editUserPage')->name('edit');
      Route::put('/update/{id}', 'updateInformationUser')->name('updates');
      Route::get('/view/{id}', 'view_User_data')->name('view');
      Route::delete('/delete/{id}', 'DeleteUser')->name('destroy');
});


});