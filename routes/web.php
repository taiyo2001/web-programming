<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\TweetController;
use App\Http\Controllers\ManagementController;
use App\Http\Controllers\TargetController;


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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', function () {
    return redirect()->route('management.show');
});


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

require __DIR__.'/auth.php';

Route::get('/management', [ManagementController::class, 'show']) ->name('management.show');
Route::middleware('auth')->group(function(){

    // 共通画面
    Route::post('/management/create', [ManagementController::class, 'create']) ->name('management.create');
    Route::get('/management/update/{managementId}', [ManagementController::class, 'updateIndex'])->name('management.update.index');
    Route::put('/management/update/{managementId}', [ManagementController::class, 'updatePut'])->name('management.update.put');
    Route::delete('/management/delete/{managementId}', [ManagementController::class, 'delete'])->name('management.delete');

    // 管理者画面
    Route::post('/user/show', [UserController::class, 'show']) ->name('user.show');
    Route::post('/user/create', [UserController::class, 'create']) ->name('user.create');
    Route::post('/user/update/{managementId}', [UserController::class, 'updateIndex'])->name('user.update.index');
    Route::put('/user/update/{managementId}', [UserController::class, 'updatePut'])->name('user.update.put');
    Route::delete('/user/delete/{managementId}', [UserController::class, 'delete'])->name('user.delete');
});





Route::get('/tweet', [TweetController::class, 'show']) ->name('tweet.show');
Route::post('/tweet/create', [TweetController::class, 'create']) ->name('tweet.create');
Route::get('/tweet/update/{tweetId}', [TweetController::class, 'updateIndex'])->name('tweet.update.index');
Route::put('/tweet/update/{tweetId}', [TweetController::class, 'updatePut'])->name('tweet.update.put');
Route::delete('/tweet/delete/{tweetId}', [TweetController::class, 'delete'])->name('tweet.delete');
