<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

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

    public function export(Request $request)
    {
        $start_date = $request->start;
        $end_date = Carbon::parse($request->end)->addDay();

        $transactions = Transaction::whereBetween("created_at", [$start_date, $end_date])->get();

        $pdf = Pdf::loadView('exports.pdf', [
            'start_date' => $start_date,
            'end_date' => $end_date->subDay()->format('Y-m-d'),
            'transactions' => $transactions
        ]);

        return $pdf->download('transactions.pdf');
    }
}
