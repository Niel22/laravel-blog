<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProfileController;

Route::get("/", [HomeController::class,"homepage"])->name("homepage");

Route::get("/post_details/{slug}", [HomeController::class,"post_details"])->name("post_details");


// Route::get('/dashboard', [HomeController::class,'index'])->name('dashboard')
// ->middleware(['auth', 'verified'])->name('dashboard');


Route::middleware(['auth','verified'])->group(function () {
    route::get('/home', [HomeController::class,'index'])->name('home');

});

Route::get("/add_post", function() {
    abort(404);
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get("/create_post", [HomeController::class,"create_post"])->name("create_post");
    Route::post("/user_post", [HomeController::class,"user_post"])->name("user_post");
    Route::get("/my_post", [HomeController::class,"my_post"])->name("my_post");
    Route::get("/mypost_delete/{id}", [HomeController::class,"mypost_delete"])->name("mypost_delete");
    Route::get("/mypost_edit/{slug}", [HomeController::class,"mypost_edit"])->name("mypost_edit");
    Route::post("/mypost_update/{id}", [HomeController::class,"mypost_update"])->name("mypost_update");
    
});

require __DIR__.'/auth.php';

Route::middleware(['auth','admin'])->group(function () {
    
    Route::get("/post_page", [AdminController::class,"post_page"])->name("post_page");
    
    Route::post("/add_post", [AdminController::class,"add_post"])->name("add_post");

    Route::get("/show_post", [AdminController::class,"show_post"])->name("show_post");

    Route::get("/delete_post/{id}", [AdminController::class,"delete_post"])->name("delete_post");

    Route::get("/edit_post/{id}", [AdminController::class,"edit_post"])->name("edit_post");

    Route::post("/update_post/{id}", [AdminController::class,"update_post"])->name("update_post");

    Route::get("/accept_post/{id}", [AdminController::class,"accept_post"])->name("accept_post");

    Route::get("/pend_post/{id}", [AdminController::class,"pend_post"])->name("pend_post");
    
});
