<?php

use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ChapterController;
use App\Http\Controllers\ComicController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\ShareButtonController;
use App\Http\Controllers\StoryController;
use App\Http\Controllers\TypeController;
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

//admin

Route::get('/admin', [HomeController::class, 'index'])->name('admin');

Route::get('/admin/dang-nhap', [App\Http\Controllers\Auth\LoginController::class, 'showLoginForm'])->name('login');

Route::get('/admin/dang-ky', [App\Http\Controllers\Auth\RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/create-user',[RegisterController::class,'create'])->name("create-user");
Route::post('/admin/dang-nhap', [App\Http\Controllers\Auth\LoginController::class, 'login']);

Route::get('/admin/doi-mat-khau', [HomeController::class, 'changePassword'])->name('doi-mat-khau');
Route::post('/change-password', [HomeController::class, 'updatePassword'])->name('change-password');
Route::get('/admin/quen-mat-khau', [App\Http\Controllers\Auth\ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');

Route::post('/admin/dat-lai-mat-khau/email', [App\Http\Controllers\Auth\ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('/admin/dat-lai-mat-khau/{token}', [App\Http\Controllers\Auth\ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('/admin/dat-lai-mat-khau', [App\Http\Controllers\Auth\ResetPasswordController::class, 'reset'])->name('password.update');
Route::get('/admin/xac-nhan-email', [App\Http\Controllers\Auth\VerificationController::class, 'show'])->name('verification.notice');
Route::get('/admin/xac-nhan-email/{id}/{hash}', [App\Http\Controllers\Auth\VerificationController::class, 'verify'])->name('verification.verify');
Route::post('/admin/xac-nhan-email/resend', [App\Http\Controllers\Auth\VerificationController::class, 'resend'])->name('verification.resend');

Route::resource('admin/quan-ly-danh-muc',CategoryController::class)->middleware('auth');
Route::resource('admin/quan-ly-truyen',StoryController::class)->middleware('auth');
Route::resource('admin/quan-ly-sach',BookController::class)->middleware('auth');
Route::resource('admin/quan-ly-chapter',ChapterController::class)->middleware('auth');
Route::resource('admin/the-loai',TypeController::class)->middleware('auth');
Route::get('/logout',[HomeController::class,'logout'])->name('dang-xuat');


// index

Route::get('/',[IndexController::class,'home']);

// truyen tranh

Route::get('/danh-sach/truyen-tranh',[ComicController::class,'index']);
Route::get('/danh-sach/truyen-tranh/{type}/{key}',[ComicController::class,'show']);
Route::get('/truyen-tranh/tim-kiem', [ComicController::class, 'search'])->name('tim-kiem-truyen-tranh');
Route::get('/truyen-tranh/{slug}',[ComicController::class,'detail']);
Route::get('/truyen-tranh/doc-truyen/{slug}',[ComicController::class,'chapter']);
Route::get('/truyen-tranh/the-loai/{slug}/{page}',[ComicController::class,'types']);

//truyen doc

Route::get('/doc-truyen/{slug}/{id}', [IndexController::class, 'chapters'])->name('doc-truyen');
Route::get('/truyen-doc/{slug}', [IndexController::class, 'readStory'])->name('truyen-doc');
Route::get('/danh-muc/{slug}/{page}', [IndexController::class, 'category'])->name('danh-muc');
Route::get('/the-loai/{slug}/{page}', [IndexController::class, 'type'])->name('the-loai');
Route::get('/tags/truyen-doc/{key}', [IndexController::class, 'tags'])->name('tags-truyen-doc');

// sach

Route::get('/sach/{id}', [IndexController::class, 'readBook'])->name('doc-sach');
Route::get('/danh-sach/sach/{page}', [IndexController::class, 'books'])->name('sach');
Route::get('/tags/sach/{key}', [IndexController::class, 'tagsBooks'])->name('tags-sach');

Route::get('/danh-sach/yeu-thich', [IndexController::class, 'favourite'])->name('yeu-thich');
Route::get('/share',[ShareButtonController::class,'shareWidget']);
Route::get('/tim-kiem', [IndexController::class, 'search'])->name('tim-kiem');
Route::post('/search', [IndexController::class, 'show'])->name('search');




