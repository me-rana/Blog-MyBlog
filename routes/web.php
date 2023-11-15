<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ViewController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\VisitorController;

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

Route::get('/', [ViewController::class,'index'])->name('home');
Route::get('/posts/{slug}', [ViewController::class,'singlePost'])->name('singlepost');
Route::get('/category/{slug}', [ViewController::class,'category'])->name('singlecategory');
Route::get('/about', [ViewController::class,'about'])->name('about');
Route::get('/contact', [ViewController::class,'contact'])->name('contact');
Route::post('/submit-contact', [ViewController::class,'form_submit'])->name('contact.submit');
Route::get('/search',[ViewController::class, 'myquery'])->name('search.result');
Route::get('/access', [ViewController::class,'access'])->name('access');
Route::post('/submit-comment',[ViewController::class,'comment'])->name('comment.submit');

//Use it for User Profile Management
Route::middleware([
    'auth:sanctum',
    'role:0',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

//Author
Route::middleware([
    'auth:sanctum',
    'role:1',
    config('jetstream.auth_session'),
    'verified',
    ])->group(function () {
        Route::get('author/',[AuthorController::class,'index'])->name('author.index');
        Route::get('author/dashboard',[AuthorController::class,'dashboard'])->name('author.dashboard');
        Route::get('author/categories',[AuthorController::class,'categories'])->name('author.category');
        Route::get('author/posts',[AuthorController::class,'posts'])->name('author.post');
        Route::get('author/add-post',[AuthorController::class,'addpost'])->name('author.newpost');
        Route::get('author/update-post/{id}',[AuthorController::class,'updatepost'])->name('author.updatepost');
        Route::get('author/add-category',[AuthorController::class,'newcategory'])->name('author.newcategory');
        Route::post('author/submit-post',[AuthorController::class,'storepost'])->name('author.storepost');
        Route::post('author/submit-category',[AuthorController::class,'storecategory'])->name('author.storecategory');
        Route::post('author/delete-post/{id}',[AuthorController::class,'delete_post'])->name('author.deletepost');
        Route::post('author/delete-category/{id}',[AuthorController::class,'delete_category'])->name('author.deletecategory');
        Route::get('author/getslug',[AuthorController::class,'getslug'])->name('author.getslug');
        Route::get('author/getcatslug',[AuthorController::class,'getCatslug'])->name('author.getCatslug');
        Route::get('author/contact',[AuthorController::class,'contact'])->name('author.contact');
        Route::get('author/faq',[AuthorController::class,'faq'])->name('author.faq');

    });

    //Admin
Route::middleware([
    'auth:sanctum',
    'role:2',
    config('jetstream.auth_session'),
    'verified',
    ])->group(function () {
        Route::get('admin/',[AdminController::class,'index'])->name('admin.index');
        Route::get('admin/dashboard',[AdminController::class,'dashboard'])->name('admin.dashboard');
        Route::get('admin/categories',[AdminController::class,'categories'])->name('admin.category');
        Route::get('admin/posts',[AdminController::class,'posts'])->name('admin.posts');
        Route::get('admin/add-post',[AdminController::class,'addpost'])->name('admin.newpost');
        Route::get('admin/update-post/{id}',[AdminController::class,'updatepost'])->name('admin.updatepost');
        Route::get('admin/add-category',[AdminController::class,'newcategory'])->name('admin.newcategory');
        Route::get('admin/update-category/{id}',[AdminController::class,'updatecategory'])->name('admin.updatecategory');
        Route::post('admin/submit-post',[AdminController::class,'storepost'])->name('admin.storepost');
        Route::post('admin/submit-category',[AdminController::class,'storecategory'])->name('admin.storecategory');
        Route::post('admin/delete-post/{id}',[AdminController::class,'delete_post'])->name('admin.deletepost');
        Route::post('admin/delete-category/{id}',[AdminController::class,'delete_category'])->name('admin.deletecategory');
        Route::get('admin/getslug',[AdminController::class,'getslug'])->name('admin.getslug');
        Route::get('admin/getcatslug',[AdminController::class,'getCatslug'])->name('admin.getCatslug');
        Route::get('admin/contact',[AdminController::class,'contact'])->name('admin.contact');
        Route::get('admin/faq',[AdminController::class,'faq'])->name('admin.faq');
        Route::get('admin/users',[AdminController::class,'users'])->name('admin.users');
        Route::get('admin/new-user',[AdminController::class,'newuser'])->name('admin.newuser');
        Route::post('admin/user-role',[AdminController::class,'userRole'])->name('admin.userRole');

    });


    //Author
Route::middleware([
    'auth:sanctum',
    'role:3',
    config('jetstream.auth_session'),
    'verified',
    ])->group(function () {
        Route::get('visitor/dashboard',[VisitorController::class,'dashboard'])->name('visitor.dashboard');
        Route::get('visitor/comments',[VisitorController::class,'comments'])->name('visitor.comments');
    });

