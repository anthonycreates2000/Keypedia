<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DataKeyboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\ViewKeyboardController;
use App\Http\Middleware\CheckAuthorizedStatus;
use App\Http\Middleware\CheckUnauthorizedStatus;
use App\Http\Middleware\CheckManagerStatus;
use App\Http\Middleware\CheckCustomerStatus;

use Illuminate\Support\Facades\Route;

Route::middleware([CheckAuthorizedStatus::class])->group(function(){
    Route::get('/home', [HomeController::class, "get_home_page"])
        ->name('home');

    Route::get('/change_password/{user}', [AuthController::class, "get_change_password_page"])
        ->name('change_password');

    // API
    Route::post('/logout', [AuthController::class, "process_logout"])
        ->name('logout');
        
    Route::post('/detail_keyboard/{keyboard}', [TransactionController::class, "process_detail_keyboard"])
        ->name('process_detail_keyboard');
});

Route::middleware([CheckUnauthorizedStatus::class])->group(function(){
    Route::get('/login', [AuthController::class, "get_login_page"])
	    ->name('login');

    Route::get('/register', [AuthController::class, "get_register_page"])
        ->name('register');

    // API
    Route::post('/register', [AuthController::class, "process_register"])
        ->name('register.process');

    Route::post('/login', [AuthController::class, "process_login"])
        ->name('login.process');
});

Route::middleware([CheckManagerStatus::class])->group(function(){
    // View
    Route::get('/edit_keyboard/{categoryID}/{keyboard}', [DataKeyboardController::class, "get_edit_keyboard_page"])
        ->name('keyboard.edit');
        
    Route::get('/add_keyboard', [DataKeyboardController::class, "get_add_keyboard_page"])
        ->name('keyboard.add');
    
    Route::get('/manage_categories', [CategoryController::class, "get_manage_categories_page"])
        ->name('category');
    
    Route::get('/edit_category/{category}', [CategoryController::class, "get_edit_category_page"])
        ->name('category.update');

    // API
    Route::post('/add_keyboard', [DataKeyboardController::class, "process_add_keyboard"])
        ->name('process_add_keyboard');
    
    Route::post('/edit_keyboard/{categoryID}/{keyboardID}', [DataKeyboardController::class, "process_edit_keyboard"])
        ->name('process_edit_keyboard');
    
    Route::post('/edit_category/{category}', [CategoryController::class, "process_edit_category"])
        ->name('process_edit_category');
    
    // delete
    Route::delete('/delete_keyboard/{category}/{keyboard}', [DataKeyboardController::class, "process_delete_keyboard"])
        ->name('process_delete_keyboard');
    
    Route::delete('/delete_category/{category}', [CategoryController::class, "process_delete_category"])
        ->name('process_delete_category');    
});

Route::middleware([CheckCustomerStatus::class])->group(function(){
    Route::get('/my_cart/{user}', [TransactionController::class, "get_my_cart_page"])
        ->name('my_cart');

    Route::get('/history_transaction/{user}', [TransactionController::class, "get_transaction_history_page"])
        ->name('history_transaction');

    Route::get('/detail_transaction/{user}/{transactionID}', [TransactionController::class, "get_transaction_detail_page"])
        ->name('detail_transaction');

    // API
    Route::post('/my_cart/{user}/{keyboard}', [TransactionController::class, "process_my_cart_update_quantity"])
        ->name('process_my_cart_update_quantity');

    Route::post('/checkout/{user}', [TransactionController::class, "process_my_cart_checkout"])
        ->name('process_my_cart_checkout');
});

Route::get('/', [HomeController::class, "get_home_page"]);

Route::get('/view_keyboard/{categoryID}', [ViewKeyboardController::class, "get_view_keyboard_page"])
    ->name('keyboard');

Route::get('/detail_keyboard/{keyboard}', [TransactionController::class, "get_detail_keyboard_page"])
    ->name('detail_keyboard');

Route::post('/change_password/{user}', [AuthController::class, "process_change_password"])
    ->name('process_change_password');

Route::post('/view_keyboard/{categoryID}', [ViewKeyboardController::class, "process_filter_keyboard"])
    ->name('keyboard.filter');
