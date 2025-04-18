<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\TransactionController;
use Illuminate\Support\Facades\Route;

Route::middleware("guest")->group(function () {
    Route::get('/login', [AuthController::class, "login"])->name("login");
    Route::post('/login', [AuthController::class, "login_post"])->name("login.post");
});

Route::middleware("auth")->group(function () {
    Route::get('/', [PageController::class, "direct"])->name("direct");
    Route::get('/logout', [AuthController::class, "logout"])->name("logout");
    Route::get('/dashboard', [PageController::class, "dashboard"])->name("admin.dashboard");

    Route::prefix("product")->group(function () {
        Route::get("/", [ProductController::class, "index"])->name("admin.product.index");
        Route::get('/create', [ProductController::class, "create"])->name("admin.product.create");
        Route::post('/store', [ProductController::class, "store"])->name("admin.product.store");
        Route::get('/{id}/edit', [ProductController::class, "edit"])->name("admin.product.edit");
        Route::put('/{id}', [ProductController::class, "update"])->name("admin.product.update");
        Route::delete('/{id}', [ProductController::class, "destroy"])->name("admin.product.destroy");
    });

    Route::prefix("transaction")->group(function () {
        Route::get("/", [TransactionController::class, "index"])->name("admin.transaction.index");
        Route::post('/store', [TransactionController::class, "store"])->name("admin.transaction.store");
        Route::get('/{id}/edit', [TransactionController::class, "edit"])->name("admin.transaction.edit");
        Route::put('/{id}', [TransactionController::class, "update"])->name("admin.transaction.update");
        Route::delete('/{id}', [TransactionController::class, "destroy"])->name("admin.transaction.destroy");
    });

    Route::prefix("report")->group(function () {
        Route::get("/", [ReportController::class, "index"])->name("admin.report.index");
        Route::get("/{id}", [ReportController::class, "show"])->name("admin.report.show");
    });
});
