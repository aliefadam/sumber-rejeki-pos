<div class="space-y-2 border-b-2 border-dashed border-gray-300 text-gray-700 p-4 text-sm">
    <div class="flex justify-between">
        <span>
            Waktu dan Tanggal
        </span>
        <span>
            {{ $transaction->created_at->format('d-m-Y H:i:s') }}
        </span>
    </div>
    <div class="flex justify-between">
        <span>
            Nomor Invoice
        </span>
        <span>
            {{ $transaction->invoice }}
        </span>
    </div>
    <div class="flex justify-between">
        <span>
            Nama Pembeli
        </span>
        <span>
            {{ $transaction->name }}
        </span>
    </div>
</div>
<div class="p-4 space-y-3">
    @foreach ($transaction->transactionDetails as $detail)
        <div class="border border-gray-300 rounded-md p-2 flex gap-3">
            <img src="/uploads/products/{{ $detail->product_image }}" class="w-[50px] h-[50px] object-cover rounded-md">
            <div class="flex flex-col gap-1 w-[calc(100%-70px)]">
                <span class="poppins-medium leading-[20px] text-sm">{{ $detail->product_name }}</span>
                <div class="flex justify-between poppins-medium text-gray-700 text-xs">
                    <div class="flex gap-1 items-center">
                        <span class="{{ $detail->discount ? 'line-through text-red-600' : '' }}">
                            {{ format_rupiah($detail->product_price) }}
                        </span>
                        @if ($detail->discount)
                            <span>{{ format_rupiah($detail->product_new_price) }}</span>
                        @endif
                        <span class="">
                            x
                            {{ $detail->qty }}
                            {{ $detail->abbr }}
                        </span>
                    </div>
                    <span class="">
                        {{ format_rupiah($detail->total) }}
                    </span>
                </div>
            </div>
        </div>
    @endforeach
</div>
<div class="space-y-2 border-t-2 border-dashed border-gray-300 text-gray-700 p-4 text-sm">
    <div class="flex justify-between">
        <span>
            Total Belanja
        </span>
        <span>
            {{ format_rupiah($transaction->total) }}
        </span>
    </div>
    <div class="flex justify-between">
        <span>
            Uang Pembeli
        </span>
        <span>
            {{ format_rupiah($transaction->amount_paid) }}
        </span>
    </div>
    <div class="flex justify-between">
        <span>
            Kembalian
        </span>
        <span>
            {{ format_rupiah($transaction->change) }}
        </span>
    </div>
</div>
