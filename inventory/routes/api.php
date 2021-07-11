<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\SalaryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PosController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;

Route::group(
    [
        'middleware' => 'api',
        'prefix' => 'auth'

    ],
    function ($router) {
        Route::post('/login', [AuthController::class, 'login']);
        Route::post('/signup', [AuthController::class, 'signup']);
        Route::post('/register', [AuthController::class, 'register']);
        Route::post('/logout', [AuthController::class, 'logout']);
        Route::post('/me', [AuthController::class, 'me']);
        Route::get('/refresh', [AuthController::class, 'refresh']);
    }
);
Route::apiResource('employee', "EmployeeController");
Route::apiResource('supplier', "SupplierController");
Route::apiResource('category', "CategoryController");
Route::apiResource('product', "ProductController");
Route::apiResource('expense', "ExpenseController");
Route::apiResource('customer', "CustomerController");

Route::post('/salary/paid/{id}', [SalaryController::class, 'Paid']);
Route::get('/salary', [SalaryController::class, 'allSalary']);
Route::get('/salary/view/{id}', [SalaryController::class, 'viewSalary']);
Route::get('/edit/salary/{id}', [SalaryController::class, 'editSalary']);
Route::post('/salary/update/{id}', [SalaryController::class, 'updateSalary']);

Route::post('/stock/update/{id}', [SalaryController::class, 'updateStock']);

Route::get('/getting/product/{id}', [PosController::class, 'getProduct']);

//add to cart
Route::get('/addToCart/{id}', [CartController::class, 'addToCart']);
Route::get('/cart/product', [CartController::class, 'cartProduct']);
Route::get('/remove/cart/{id}', [CartController::class, 'cartDelete']);
Route::get('/increment/{id}', [CartController::class, 'increment']);
Route::get('/decrement/{id}', [CartController::class, 'decrement']);

//vat routes
Route::get('/vats', [CartController::class, 'Vat']);
//order routes
Route::post('/orderdone', [PosController::class, 'orderDone']);
Route::get('/orders', [OrderController::class, 'todayOrders']);

Route::get('/order/details/{id}', [OrderController::class, 'orderDetails']);
Route::get('/order/orderdetails/{id}', [OrderController::class, 'orderDetailsAll']);
Route::post('/search/order/', [OrderController::class, 'searchOrderDate']);

//admin dashboard routes
Route::get('/today/sell', [PosController::class, 'todaySell']);
Route::get('/today/income', [PosController::class, 'todayIncome']);
Route::get('/today/due', [PosController::class, 'todayDue']);
Route::get('/today/expense', [PosController::class, 'expense']);
Route::get('/today/stockout', [PosController::class, 'stockout']);
