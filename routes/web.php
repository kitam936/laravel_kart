<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\StintController;
use App\Http\Controllers\MainteContoroller;

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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
Route::get('ac_info', [UserController::class, 'ac_info'])->name('ac_info');
Route::get('ac_info_edit/{user}', [UserController::class, 'ac_info_edit'])->name('ac_info_edit');
Route::get('pw_change/{user}', [UserController::class, 'pw_change'])->name('pw_change');
Route::post('pw_update/{user}', [UserController::class, 'pw_update'])->name('pw_update');
Route::get('pw_change_admin/{user}', [UserController::class, 'pw_change_admin'])->name('pw_change_admin');
Route::post('pw_update_admin/{user}', [UserController::class, 'pw_update_admin'])->name('pw_update_admin');
Route::get('memberlist', [UserController::class, 'memberlist'])->name('memberlist');
Route::get('member_detail/{user}', [UserController::class, 'show'])->name('member_detail');
Route::get('member_edit/{user}', [UserController::class, 'edit'])->name('member_edit');
Route::get('member_update1/{user}', [UserController::class, 'member_update_rs1'])->name('member_update1');
Route::post('member_update1/{user}', [UserController::class, 'member_update_rs1'])->name('member_update1');
Route::delete('user_destroy/{user}', [UserController::class, 'user_destroy'])->name('user_destroy');
Route::get('manual_download',[DocumentController::class,'manual_download'])->name('manual_download');
Route::get('my_stint', [StintController::class, 'my_stint_list'])->name('my_stint');
Route::get('my_stint_show/{stint}', [StintController::class, 'my_stint_show'])->name('my_stint_show');
Route::get('stint_list', [StintController::class, 'stint_list'])->name('stint_list');
Route::get('stint_show/{stint}', [StintController::class, 'stint_show'])->name('stint_show');
Route::get('stint_edit/{stint}', [StintController::class, 'stint_edit'])->name('stint_edit');
Route::post('stint_update/{stint}', [StintController::class, 'stint_update'])->name('stint_update');
Route::get('stint_create', [StintController::class, 'stint_create'])->name('stint_create');
Route::get('stint_create_2', [StintController::class, 'stint_create_2'])->name('stint_create_2');
Route::post('stint_store', [StintController::class, 'stint_store'])->name('stint_store');
Route::post('stint_destroy/{stint}', [StintController::class, 'stint_destroy'])->name('stint_destroy');
Route::get('mykart.index', [MainteContoroller::class, 'index'])->name('mykart.index');
Route::get('kart_mainte', [StintController::class, 'stint_show'])->name('kart_mainte');
Route::get('engine_mainte', [StintController::class, 'stint_show'])->name('engine_mainte');
Route::get('tire_mainte', [StintController::class, 'stint_show'])->name('tire_mainte');
Route::get('stint_data_edit/{stint}', [DocumentController::class, 'data_edit'])->name('stint_data_edit');
Route::post('stint_data_upload/{stint}', [DocumentController::class, 'data_upload'])->name('stint_data_upload');
Route::post('stint_data_destroy/{stint}', [DocumentController::class, 'data_destroy'])->name('stint_data_destroy');
Route::get('stint_data_download/{stint}',[DocumentController::class,'data_download'])->name('stint_data_download');
});

require __DIR__.'/auth.php';
