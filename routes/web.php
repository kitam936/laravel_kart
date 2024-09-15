<?php

use App\Http\Controllers\BasedataController;
use App\Http\Controllers\CircuitController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\EgMaintController;
use App\Http\Controllers\ChMaintController;
use App\Http\Controllers\StintController;
use App\Http\Controllers\MainteContoroller;
use App\Http\Controllers\MyKartController;
use App\Http\Controllers\MakerController;
use App\Http\Controllers\MyEngineController;
use App\Http\Controllers\EngineController;
use App\Http\Controllers\MyTireController;
use App\Http\Controllers\TireController;
use App\Models\Circuit;

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
Route::get('circuit_list', [CircuitController::class, 'circuit_list'])->name('circuit_list');
Route::get('circuit_detail/{circuit}', [CircuitController::class, 'circuit_detail'])->name('circuit_detail');
Route::get('circuit_edit/{circuit}', [CircuitController::class, 'circuit_edit'])->name('circuit_edit');
Route::post('circuit_update/{circuit}', [CircuitController::class, 'circuit_update'])->name('circuit_update');
Route::get('circuit_create', [CircuitController::class, 'circuit_create'])->name('circuit_create');
Route::post('circuit_store', [CircuitController::class, 'circuit_store'])->name('circuit_store');
Route::post('circuit_destroy/{circuit}', [CircuitController::class, 'circuit_destroy'])->name('circuit_destroy');
Route::get('favorite_edit/{circuit}', [CircuitController::class, 'favorite_edit'])->name('favorite_edit');
Route::get('favorite_edit_of/{circuit}', [CircuitController::class, 'favorite_edit_of'])->name('favorite_edit_of');
Route::post('favorite_store', [CircuitController::class, 'favorite_store'])->name('favorite_store');
Route::post('favorite_destroy/{id}', [CircuitController::class, 'favorite_destroy'])->name('favorite_destroy');

Route::get('chassis_index', [MyKartController::class, 'index'])->name('chassis_index');
Route::get('chassis_create', [MyKartController::class, 'create'])->name('chassis_create');
Route::get('chassis_show/{chassis}', [MyKartController::class, 'show'])->name('chassis_show');
Route::get('chassis_edit/{chassis}', [MyKartController::class, 'edit'])->name('chassis_edit');
Route::post('chassis_update/{chassis}', [MyKartController::class, 'update'])->name('chassis_update');
Route::post('chassis_store', [MyKartController::class, 'store'])->name('chassis_store');
Route::post('chassis_destroy/{chassis}', [MyKartController::class, 'destroy'])->name('chassis_destroy');

Route::get('maker_index', [MakerController::class, 'index'])->name('maker_index');
Route::get('maker_create', [MakerController::class, 'create'])->name('maker_create');
Route::get('maker_show/{maker}', [MakerController::class, 'show'])->name('maker_show');
Route::get('maker_edit/{maker}', [MakerController::class, 'edit'])->name('maker_edit');
Route::post('maker_update/{maker}', [MakerController::class, 'update'])->name('maker_update');
Route::post('maker_store', [MakerController::class, 'store'])->name('maker_store');
Route::post('maker_destroy/{maker}', [MakerController::class, 'destroy'])->name('maker_destroy');

Route::get('myengine_index', [MyEngineController::class, 'index'])->name('myengine_index');
Route::get('myengine_create', [MyEngineController::class, 'create'])->name('myengine_create');
Route::get('myengine_show/{engine}', [MyEngineController::class, 'show'])->name('myengine_show');
Route::get('myengine_edit/{engine}', [MyEngineController::class, 'edit'])->name('myengine_edit');
Route::post('myengine_update/{engine}', [MyEngineController::class, 'update'])->name('myengine_update');
Route::post('myengine_store', [MyEngineController::class, 'store'])->name('myengine_store');
Route::post('myengine_destroy/{engine}', [MyEngineController::class, 'destroy'])->name('myengine_destroy');

Route::get('engine_index', [EngineController::class, 'index'])->name('engine_index');
Route::get('engine_create', [EngineController::class, 'create'])->name('engine_create');
Route::get('engine_show/{engine}', [EngineController::class, 'show'])->name('engine_show');
Route::get('engine_edit/{engine}', [EngineController::class, 'edit'])->name('engine_edit');
Route::post('engine_update/{engine}', [EngineController::class, 'update'])->name('engine_update');
Route::post('engine_store', [EngineController::class, 'store'])->name('engine_store');
Route::post('engine_destroy/{engine}', [EngineController::class, 'destroy'])->name('engine_destroy');

Route::get('mytire_index', [MyTireController::class, 'index'])->name('mytire_index');
Route::get('mytire_create', [MyTireController::class, 'create'])->name('mytire_create');
Route::get('mytire_show/{tire}', [MyTireController::class, 'show'])->name('mytire_show');
Route::get('myetireedit/{tire}', [MyTireController::class, 'edit'])->name('mytire_edit');
Route::post('myetireupdate/{tire}', [MyTireController::class, 'update'])->name('mytire_update');
Route::post('mytire_store', [MyTireController::class, 'store'])->name('mytire_store');
Route::post('mytire_destroy/{tire}', [MyTireController::class, 'destroy'])->name('mytire_destroy');

Route::get('tire_index', [TireController::class, 'index'])->name('tire_index');
Route::get('tire_create', [TireController::class, 'create'])->name('tire_create');
Route::get('tire_show/{tire}', [TireController::class, 'show'])->name('tire_show');
Route::get('tire_edit/{tire}', [TireController::class, 'edit'])->name('tire_edit');
Route::post('tire_update/{tire}', [TireController::class, 'update'])->name('tire_update');
Route::post('tire_store', [TireController::class, 'store'])->name('tire_store');
Route::post('tire_destroy/{tire}', [TireController::class, 'destroy'])->name('tire_destroy');

Route::get('role_list', [UserController::class, 'role_list'])->name('role_list');
Route::get('role_edit/{user}', [UserController::class, 'role_edit'])->name('role_edit');
Route::get('role_update/{user}', [UserController::class, 'role_update'])->name('role_update');
Route::post('role_update/{user}', [UserController::class, 'role_update'])->name('role_update');
Route::post('user_destroy/{user}', [UserController::class, 'user_destroy'])->name('user_destroy');

Route::get('eg_maint_create/{eg}', [EgMaintController::class, 'create'])->name('eg_maint_create');
Route::get('eg_maint_show/{maint}', [EgMaintController::class, 'show'])->name('eg_maint_show');
Route::get('eg_maint_edit/{maint}', [EgMaintController::class, 'edit'])->name('eg_maint_edit');
Route::post('eg_maint_update/{maint}', [EgMaintController::class, 'update'])->name('eg_maint_update');
Route::post('eg_maint_store', [EgMaintController::class, 'store'])->name('eg_maint_store');
Route::post('eg_maint_destroy/{maint}', [EgMaintController::class, 'destroy'])->name('eg_maint_destroy');

Route::get('ch_maint_create/{ch}', [ChMaintController::class, 'create'])->name('ch_maint_create');
Route::get('ch_maint_show/{maint}', [ChMaintController::class, 'show'])->name('ch_maint_show');
Route::get('ch_maint_edit/{maint}', [ChMaintController::class, 'edit'])->name('ch_maint_edit');
Route::post('ch_maint_update/{maint}', [ChMaintController::class, 'update'])->name('ch_maint_update');
Route::post('ch_maint_store', [ChMaintController::class, 'store'])->name('ch_maint_store');
Route::post('ch_maint_destroy/{maint}', [ChMaintController::class, 'destroy'])->name('ch_maint_destroy');

Route::get('category_index', [MainteContoroller::class, 'category_index'])->name('category_index');

Route::get('ch_category_index', [MainteContoroller::class, 'ch_index'])->name('ch_category_index');
Route::get('ch_category_create', [MainteContoroller::class, 'ch_create'])->name('ch_category_create');
Route::get('ch_category_show/{category}', [MainteContoroller::class, 'ch_show'])->name('ch_category_show');
Route::get('ch_category_edit/{category}', [MainteContoroller::class, 'ch_edit'])->name('ch_category_edit');
Route::post('ch_category_update/{category}', [MainteContoroller::class, 'ch_update'])->name('ch_category_update');
Route::post('ch_category_store', [MainteContoroller::class, 'ch_store'])->name('ch_category_store');
Route::post('ch_category_destroy/{category}', [MainteContoroller::class, 'ch_destroy'])->name('ch_category_destroy');

Route::get('eg_category_index', [MainteContoroller::class, 'eg_index'])->name('eg_category_index');
Route::get('eg_category_create', [MainteContoroller::class, 'eg_create'])->name('eg_category_create');
Route::get('eg_category_show/{category}', [MainteContoroller::class, 'eg_show'])->name('eg_category_show');
Route::get('eg_category_edit/{category}', [MainteContoroller::class, 'eg_edit'])->name('eg_category_edit');
Route::post('eg_category_update/{category}', [MainteContoroller::class, 'eg_update'])->name('eg_category_update');
Route::post('eg_category_store', [MainteContoroller::class, 'eg_store'])->name('eg_category_store');
Route::post('eg_category_destroy/{category}', [MainteContoroller::class, 'eg_destroy'])->name('eg_category_destroy');
});

require __DIR__.'/auth.php';
