<h1>Data Laporan Transaksi</h1>
@if ($start_date == $end_date)
    <h3>Tanggal {{ $start_date }}</h3>
@else
    <h3>Periode {{ $start_date }} sampai {{ $end_date }}</h3>
@endif

<table id="data-table" class="" border="1" cellspacing="0" cellpadding="5">
    <thead class="">
        <tr class="">
            <th scope="" class="">
                No
            </th>
            <th scope="" class="">
                Invoice
            </th>
            <th scope="" class="">
                Nama Pembeli
            </th>
            <th scope="" class="">
                Barang Dibeli
            </th>
            <th scope="" class="">
                Total
            </th>
            <th scope="" class="">
                Tanggal dan Waktu
            </th>
        </tr>
    </thead>
    <tbody>
        @foreach ($transactions as $transaction)
            <tr class="">
                <td class="">
                    {{ $loop->iteration }}
                </td>
                <td class="">
                    {{ $transaction->invoice }}
                </td>
                <td class=" ">
                    {{ $transaction->name }}
                </td>
                <td class="">
                    <table border="0">
                        @foreach ($transaction->transactionDetails as $detail)
                            <tr style="border: 1px solid black">
                                <td>{{ $detail->product_name }}</td>
                                @php
                                    $price = $detail->discount ? $detail->product_new_price : $detail->product_price;
                                @endphp
                                <td class="">{{ format_rupiah($price) }}</td>
                                <td>
                                    x
                                    {{ $detail->qty }}
                                    {{ $detail->abbr }}
                                </td>
                                <td>{{ format_rupiah($detail->total) }}</td>
                            </tr>
                        @endforeach
                    </table>
                </td>
                <td class="">
                    {{ format_rupiah($transaction->total) }}
                </td>
                <td class="">
                    {{ $transaction->created_at->format('d-m-Y H:i:s') }}
                </td>
            </tr>
        @endforeach

        <tr style="border: 1px solid black">
            <td colspan="4" style="text-align: right; font-weight: bold">Total</td>
            <td colspan="2" style="text-align: center; font-weight: bold">
                {{ format_rupiah($transactions->sum('total')) }}
            </td>
        </tr>
    </tbody>
</table>
