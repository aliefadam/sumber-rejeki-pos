<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index()
    {
        return view("app.report.index", [
            "title" => "Laporan Transaksi",
            "transactions" => Transaction::latest()->get(),
        ]);
    }

    public function show($id)
    {
        $transaction = Transaction::find($id);
        return response()->json([
            "view" => view("components.modal-detail-transaction", [
                "transaction" => $transaction,
            ])->render(),
        ]);
    }
}
