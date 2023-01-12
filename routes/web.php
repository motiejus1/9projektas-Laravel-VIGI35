<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;

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

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/students', [StudentController::class, 'index'])->name('students.index');
Route::get('/students/search', [StudentController::class, 'search'])->name('students.search');

Route::get('/students/searchAjax', [StudentController::class, 'searchAjax'])->name('students.searchAjax');
Route::post('/students/storeAjax', [StudentController::class, 'storeAjax'])->name('students.storeAjax');
Route::post('/students/destroyAjax', [StudentController::class, 'destroyAjax'])->name('students.destroyAjax');

Route::get('/students/editAjax', [StudentController::class, 'editAjax'])->name('students.editAjax');
Route::post('/students/updateAjax', [StudentController::class, 'updateAjax'])->name('students.updateAjax');


Route::get('/students/create', [StudentController::class, 'create'])->name('students.create');
Route::get('/students/createbulk', [StudentController::class, 'createBulk'])->name('students.createbulk');
Route::get('/students/createbulkajax', [StudentController::class, 'createBulkAjax'])->name('students.createbulkajax');
Route::post('/students/store', [StudentController::class, 'store'])->name('students.store');
Route::post('/students/storebulk', [StudentController::class, 'storeBulk'])->name('students.storebulk');
Route::post('/students/storebulkajax', [StudentController::class, 'storeBulkAjax'])->name('students.storebulkajax');
// Route::post('/students/destroy/{student}', [StudentController::class, 'destroyAjax'])->name('students.destroyAjax');
