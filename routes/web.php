<?php
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\RecetteController;
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

Route::get('/',[AdminController::class,'connect']);
Route::get('/dashboard',[AdminController::class,'dashboard']);
//login
Route::post('/login',[AdminController::class,'connexion'])->name('login');
Route::get('/logout',[AdminController::class,'logout']);
//admin add
Route::post('/addadmin',[AdminController::class,'addadmin'])->name('addadmin');
Route::get('/ajoutadmin',[AdminController::class,'addadminn']);
Route::get('/modifadmin{id}',[AdminController::class,'updateadminn']);
Route::post('/updateadmin',[AdminController::class,'updateadmin'])->name('updateadmin');
Route::get('/supprimeradmin{id}',[AdminController::class,'deleteadmin']);
//user add
Route::post('/adduser',[AdminController::class,'adduser'])->name('adduser');
Route::get('/ajoutuser',[AdminController::class,'adduserr']);
Route::get('/modifuser{id}',[UserController::class,'updateuserr']);
Route::post('/updateuser',[UserController::class,'updateuser'])->name('updateuser');
Route::get('/supprimeruser{id}',[UserController::class,'deleteuser']);
//all
Route::get('/alladmin',[AdminController::class,'alladmin']);
Route::get('/alluser',[AdminController::class,'alluser']);
Route::get('/allrecette',[AdminController::class,'allrecette']);
//recette
Route::post('/addrecette',[RecetteController::class,'addrecette'])->name('addrecette');
Route::get('/ajoutrecette',[RecetteController::class,'addrecettee']);
Route::get('/modifrecette{id}',[RecetteController::class,'updaterecettee']);
Route::post('/updaterecette',[RecetteController::class,'updaterecette'])->name('updaterecette');
Route::get('/supprimerrecette{id}',[RecetteController::class,'deleterecette']);











