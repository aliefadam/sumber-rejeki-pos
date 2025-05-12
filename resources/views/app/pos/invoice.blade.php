<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Courier+Prime:ital,wght@0,400;0,700;1,400;1,700&display=swap"
    rel="stylesheet">

<style>
    .container {
        /* width: 300px; */
        margin: 0 auto;
        width: 58mm;
        height: fit-content;
        font-family: "Courier Prime", monospace;
        font-size: 11px;
        text-transform: uppercase
    }

    .header {
        margin: 0;
        text-align: center;
    }

    h2,
    p {
        margin: 0;
    }

    .flex-container-1 {
        display: flex;
        margin-top: 10px;
    }

    .flex-container-1>div {
        text-align: left;
    }

    .flex-container-1 .right {
        text-align: right;
        width: 200px;
    }

    .flex-container-1 .left {
        width: 100px;
    }

    .flex-container {
        /* width: 300px; */
        display: flex;
    }

    .flex-container>div {
        -ms-flex: 1;
        /* IE 10 */
        flex: 1;
    }

    ul {
        display: contents;
    }

    ul li {
        display: block;
    }

    hr {
        border-style: dashed;
    }

    a {
        text-decoration: none;
        text-align: center;
        padding: 10px;
        background: #00e676;
        border-radius: 5px;
        color: white;
        font-weight: bold;
    }

    .alamat {
        padding: 5px;
        display: block;
        margin-top: 2px;
    }

    .please {
        display: block;
        margin-top: -15px;
    }

    @media print {
        body {
            margin: 0;
            padding: 0;
            height: auto !important;
            page-break-after: always !important;
            page-break-before: always !important;
        }

        * {
            visibility: visible !important;
        }
    }
</style>

<div class="container">
    <div class="header" style="margin-bottom: 20px;">
        <h2>Sumber Rejeki</h2>
        <span class="alamat">
            JL. Raya Bandarejo, Sememi, Kec. Benowo, Surabaya
        </span>
    </div>
    <hr>
    <div class="flex-container-1">
        <div class="left">
            <ul>
                <li>No Order</li>
                <li>Tanggal</li>
                <li>Nama</li>
            </ul>
        </div>
        <div class="right">
            <ul>
                <li> {{ $transaction->invoice }} </li>
                <li> {{ date('Y-m-d | H:i:s', strtotime($transaction->created_at)) }} </li>
                <li> {{ $transaction->name }} </li>
            </ul>
        </div>
    </div>
    <hr>
    <div class="flex-container" style="margin-bottom: 10px; text-align:right;">
        <div style="text-align: left;">Nama Product</div>
        <div>Harga/Qty</div>
        <div>Total</div>
    </div>
    @foreach ($transaction->transactionDetails as $detail)
        <div class="flex-container" style="text-align: right;">
            @php
                $price = $detail->discount ? $detail->product_new_price : $detail->product_price;
            @endphp
            <div style="text-align: left;">
                {{ $detail->product_name }}
                x
                {{ $detail->qty }} {{ $detail->abbr }}
            </div>
            <div>{{ number_format($price) }} </div>
            <div>{{ number_format($detail->total) }} </div>
        </div>
    @endforeach
    <hr>
    <div class="flex-container" style="text-align: right; margin-top: 10px;">
        <div></div>
        <div>
            <ul>
                <li>Grand Total</li>
                <li>Pembayaran</li>
                <li>Kembalian</li>
            </ul>
        </div>
        <div style="text-align: right;">
            <ul>
                <li>{{ number_format($transaction->total) }} </li>
                <li>{{ number_format($transaction->amount_paid) }}</li>
                <li>{{ number_format($transaction->change) }}</li>
            </ul>
        </div>
    </div>
    <hr>
    <div class="header" style="margin-top: 5px;">
        <h3 class="terima-kasih">Terimakasih</h3>
        <span class="please">Silahkan berkunjung kembali</span>
    </div>
</div>

<script>
    window.print();
    window.onafterprint = function() {
        setTimeout(() => {
            window.close();
        }, 100);
    };
</script>
