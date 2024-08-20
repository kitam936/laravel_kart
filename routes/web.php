<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DocumentController;

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
});

require __DIR__.'/auth.php';
