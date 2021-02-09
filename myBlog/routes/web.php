<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Front\HomepageController;
use App\Http\Controllers\back\DashboardController;
use App\Http\Controllers\back\AuthController;
use App\Http\Controllers\back\CategoryController;
use App\Http\Controllers\back\ArticleController;
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
Route::get('cikis',[AuthController::class,'logout'])->name('login.logout');

Route::prefix('admin')->name('login.')->middleware('isLogin')->group(function ()
{
    Route::get('login',[AuthController::class,'login'])->name('index');
    Route::post('login',[AuthController::class,'loginPost'])->name('index.post');
});

Route::prefix('admin')->name('admin.')->middleware('isAdmin')->group(function ()
{
    Route::get('panel', [DashboardController::class,'index'])->name('dashboard');
    /*--------------------------------------------------*/
    /*Category*/
    Route::get('category',[CategoryController::class,'index'])->name('category.index');
    Route::post('category/post',[CategoryController::class,'category_post'])->name('category.post');
    Route::get('category/edit/{id}',[CategoryController::class,'category_edit'])->name('category.edit');
    Route::post('category/edit/post',[CategoryController::class,'category_edit_post'])->name('category.edit.post');
    Route::post('category/delete',[CategoryController::class,'category_delete'])->name('category.delete');
    /*--------------------------------------------------*/
    /*Writer*/
    Route::get('article',[ArticleController::class,'index'])->name('article.index');
    Route::get('article/create',[ArticleController::class,'create'])->name('article.create');
    Route::post('article/create/post',[ArticleController::class,'create_post'])->name('article.create.post');
    Route::get('article/update/{id}',[ArticleController::class,'update'])->name('article.update');
    Route::post('article/update/post',[ArticleController::class,'update_post'])->name('article.update.post');
    Route::post('article/delete',[ArticleController::class,'delete'])->name('article.delete');
    /*--------------------------------------------------*/
    /*Writer*/
    Route::get('profile',[AuthController::class,'profile'])->name('profile');
    Route::post('profile/post',[AuthController::class,'profile_post'])->name('profile.post');
    Route::get('settings',[AuthController::class,'settings'])->name('settings');
    Route::post('settings/post',[AuthController::class,'settings_post'])->name('settings.post');
    Route::get('message',[AuthController::class,'message'])->name('message');


});




Route::get('/', [HomepageController::class,'index'])->name('home');
Route::get('/yazarlar',[HomepageController::class,'writers'])->name('writers');
Route::get('/Iletisim',[HomepageController::class,'contact'])->name('contact');
Route::post('/iletisim/post',[HomepageController::class,'contactPost'])->name('contactPost');
Route::get('/{slug}', [HomepageController::class,'category'])->name('category');
Route::get('/makale/detay/{slug}',[HomepageController::class,'ArticleDetail'])->name('articleDetail');
