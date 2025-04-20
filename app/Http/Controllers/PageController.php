<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Transaction;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function direct()
    {
        return to_route("admin.dashboard");
    }

    public function dashboard()
    {
        return view("dashboard", [
            "title" => "Dashboard",
            "product_count" => Product::count(),
            "transaction_count" => Transaction::count(),
            "income" => Transaction::sum("total"),
            "transaction_per_month" => getTransactionOneYear(),
        ]);
    }
}
