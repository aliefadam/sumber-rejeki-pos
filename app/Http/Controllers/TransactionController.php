<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class TransactionController extends Controller
{
    public function index()
    {
        return view("app.pos.index", [
            "title" => "Halaman Kasir",
            "products" => Product::all(),
            "buyer_name" => "Pembeli " . Transaction::count() + 1,
        ]);
    }

    public function create() {}

    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            $newTransaction = Transaction::create([
                "invoice" => "INV_" . date("Ymdhis") . "_" . strtoupper(Str::random(5)),
                "name" => $request->name,
                "total" => $request->total,
                "amount_paid" => $request->amount_paid,
                "change" => $request->change,
            ]);

            foreach ($request->listOrder as $order) {
                TransactionDetail::create([
                    "transaction_id" => $newTransaction->id,
                    "product_name" => $order["name"],
                    "product_image" => $order["image"],
                    "product_price" => $order["price"],
                    "qty" => $order["qty"],
                    "abbr" => $order["abbr"],
                    "discount" => $order["discount"] ?? null,
                    "product_new_price" => $order["newPrice"] ?? null,
                    "total" => $order["total"]
                ]);
            }

            DB::commit();
            notificationFlash("success", "Berhasil menambahkan transaksi");
        } catch (\Exception $e) {
            DB::rollBack();
            notificationFlash("error", $e->getMessage());
        }
    }

    public function edit($id) {}

    public function update(Request $request, $id) {}

    public function destroy($id) {}
}
