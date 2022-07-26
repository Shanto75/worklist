<?php

use App\Http\Controllers\ListController;
use App\Models\Worklist;
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

// Route::get('/welcome', function () {
//     return view('welcome');
// });

// Route::get('/', function () {
//     return view('home');
// });
Route::get('/', [ ListController ::class, 'index']);
Route::get('/statusDone/{id}', [ ListController ::class, 'statusDone']);
Route::get('/statusPending/{id}', [ ListController ::class, 'statusPending']);
Route::get('/deleteList/{id}', [ ListController ::class, 'deleteList']);
Route::post('/addlist', [ ListController ::class, 'store']);
Route::post('/search', [ ListController ::class, 'search']);


