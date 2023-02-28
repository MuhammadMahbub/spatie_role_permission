<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\SocialurlController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\SubscriberController;
use App\Http\Controllers\ColorSettingController;
use App\Http\Controllers\ThemeSettingController;
use App\Http\Controllers\GeneralSettingController;

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

Route::group(['middleware' => 'visitor_log'], function(){
    Route::get('/', function () {
        return redirect('login');
    });
});

// Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
//     return view('admin.index');
// })->name('dashboard');

// Admin Group Route
Route::group(['prefix' => 'admin','middleware' => ['auth']], function(){

     // AdminController
    Route::get('dashboard', [AdminController::class, 'index'])->name('dashboard');
    Route::get('users/list', [AdminController::class, 'userList'])->name('users.index');
    Route::get('users/{id}/edit/', [AdminController::class, 'userEdit'])->name('users.edit');
    Route::put('users/{id}/update/', [AdminController::class, 'userUpdate'])->name('users.update');
    Route::get('users/{id}/destroy', [AdminController::class, 'userDestroy'])->name('users.destroy');
    Route::get('user/role/{id}/assign/', [AdminController::class, 'user_role_assign'])->name('user_role_assign');
    Route::get('/user/permission/{id}/assign/', [AdminController::class, 'user_permission_assign'])->name('user_permission_assign');
    Route::post('user/role/', [AdminController::class, 'user_role'])->name('user_role');
    Route::post('user/permission/', [AdminController::class, 'user_permission'])->name('user_permission');

    Route::resource('role', RoleController::class);
    Route::get('/role/{id}/delete', [RoleController::class, 'role_destroy'])->name('role_destroy');
    Route::get('/role/permission/{id}/assign/', [RoleController::class, 'role_permission_assign'])->name('role_permission_assign');
    Route::post('role/permission/', [RoleController::class, 'role_permission'])->name('role_permission');

    Route::resource('permission', PermissionController::class);
    Route::get('/permission/role/{id}/assign/', [PermissionController::class, 'permission_role_assign'])->name('permission_role_assign');
    Route::post('/permission/role', [PermissionController::class, 'permission_role'])->name('permission_role');

    //  GeneralSettingController
    Route::resource('generalSettings', GeneralSettingController::class);

    //  ColorSettingController
    Route::resource('colorSettings', ColorSettingController::class);

    //  SocialurlController
    Route::resource('socialurls', SocialurlController::class);

    // ThemeSettingController
    Route::get('theme-color', [ThemeSettingController::class, 'color'])->name('theme.color');
    Route::get('theme-toggle', [ThemeSettingController::class, 'toggle'])->name('theme.toggle');

});

    //  ContactController
    Route::resource('contacts', ContactController::class);

    //  SubscriberController
    Route::resource('subscribers', SubscriberController::class);
