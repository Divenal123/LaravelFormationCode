<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FilmController;

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

Route::resource('films', FilmController::class);

//Route permettant la suppression non définitive d'un élement. Après avoir ajouté un champ qui va recevoir l'element
Route::delete('films/force/{film', [filmcontroller::class, 'forceDestroy'])->name('films.force.destroy');
Route::put('films/restore/{film', [filmcontroller::class, 'restore'])->name('films.restore');
