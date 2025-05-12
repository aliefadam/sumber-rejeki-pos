<?php

use App\Models\Transaction;
use Illuminate\Support\Facades\Route;

Route::get('/transaction/print/{id}', function ($id) {
    $transaction = Transaction::find($id);
    $items = [];

    // Header
    $items[] = [
        'type' => 0,
        'content' => 'Sumber Rejeki',
        'bold' => 1,
        'align' => 1,
        'format' => 2,
    ];
    $items[] = [
        'type' => 0,
        'content' => 'JL. Raya Bandarejo, Sememi, Kec. Benowo, Surabaya',
        'bold' => 0,
        'align' => 1,
        'format' => 0,
    ];

    $items[] = ['type' => 0, 'content' => '---------------------------------', 'bold' => 0, 'align' => 1, 'format' => 0];

    // Info transaksi
    $items[] = ['type' => 0, 'content' => "No Order : {$transaction->invoice}", 'bold' => 0, 'align' => 0, 'format' => 0];
    $items[] = ['type' => 0, 'content' => "Tanggal  : " . date('Y-m-d H:i:s', strtotime($transaction->created_at)), 'bold' => 0, 'align' => 0, 'format' => 0];
    $items[] = ['type' => 0, 'content' => "Nama     : {$transaction->name}", 'bold' => 0, 'align' => 0, 'format' => 0];

    $items[] = ['type' => 0, 'content' => '---------------------------------', 'bold' => 0, 'align' => 1, 'format' => 0];

    // Detail produk
    foreach ($transaction->transactionDetails as $detail) {
        $price = $detail->discount ? $detail->product_new_price : $detail->product_price;
        $items[] = ['type' => 0, 'content' => "{$detail->product_name} x{$detail->qty} {$detail->abbr}", 'bold' => 0, 'align' => 0, 'format' => 0];
        $items[] = ['type' => 0, 'content' => "@" . number_format($price) . " = " . number_format($detail->total), 'bold' => 0, 'align' => 2, 'format' => 0];
    }

    $items[] = ['type' => 0, 'content' => '---------------------------------', 'bold' => 0, 'align' => 1, 'format' => 0];

    // Total
    $items[] = ['type' => 0, 'content' => "Grand Total: " . number_format($transaction->total), 'bold' => 1, 'align' => 2, 'format' => 0];
    $items[] = ['type' => 0, 'content' => "Bayar: " . number_format($transaction->amount_paid), 'bold' => 0, 'align' => 2, 'format' => 0];
    $items[] = ['type' => 0, 'content' => "Kembalian: " . number_format($transaction->change), 'bold' => 0, 'align' => 2, 'format' => 0];

    $items[] = ['type' => 0, 'content' => '---------------------------------', 'bold' => 0, 'align' => 1, 'format' => 0];

    // Footer
    $items[] = ['type' => 0, 'content' => 'Terimakasih', 'bold' => 1, 'align' => 1, 'format' => 0];
    $items[] = ['type' => 0, 'content' => 'Silahkan berkunjung kembali', 'bold' => 0, 'align' => 1, 'format' => 0];

    echo json_encode($items, JSON_FORCE_OBJECT);
    exit;
});
