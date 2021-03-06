<?php

use App\Http\Controllers\CommunityController;
use App\Http\Controllers\CommunityPostController;
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

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes(['verify' => true]);

Route::get('c/{community}', [CommunityController::class,'show'])->name('communities.show');
Route::get('p/{community}/{post}/', [CommunityPostController::class,'show'])->name('communities.posts.show');

Route::group(['middleware' => ['auth', 'verified']], function (){
    Route::resource('communities', \App\Http\Controllers\CommunityController::class)->except('show');
    Route::resource('communities.posts', \App\Http\Controllers\CommunityPostController::class)->except('show');
    Route::resource('posts.comments', \App\Http\Controllers\PostCommentController::class);
    Route::get('posts/{post_id}/vote/{vote}', [\App\Http\Controllers\CommunityPostController::class, 'vote'])->name('post.vote');
    Route::post('posts/{post_id}/report', [\App\Http\Controllers\CommunityPostController::class, 'report'])->name('post.report');
});
