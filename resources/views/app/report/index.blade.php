@extends('layouts.app')

@section('content')
    <div class="flex justify-between items-start">
        @include('partials.breadcrumb', [
            'current' => $title,
        ])
        {{-- <a href="{{ route('admin.product.create') }}"
            class="text-white bg-gray-600 border border-gray-600 hover:bg-gray-700 focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5">
            <i class="fas fa-plus mr-1.5"></i> Tambah Produk
        </a> --}}
        <button type="button" data-modal-target="export-transaksi-modal" data-modal-toggle="export-transaksi-modal"
            class="btn-detail text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 cursor-pointer">
            <i class="fa-regular fa-file-pdf mr-1"></i>
            Export Laporan
            {{-- <i class="fa-solid fa-caret-down ml-2"></i> --}}
        </button>

        <!-- Dropdown menu -->
        {{-- <div id="dropdown" class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow-sm w-44 ">
            <ul class="py-2 text-sm text-gray-700" aria-labelledby="btn-export">
                <li>
                    <a href="#" class="block px-4 py-2 hover:bg-gray-100">Harian</a>
                </li>
                <li>
                    <a href="#" class="block px-4 py-2 hover:bg-gray-100">Bulanan</a>
                </li>
                <li>
                    <a href="#" class="block px-4 py-2 hover:bg-gray-100">Tahunan</a>
                </li>
            </ul>
        </div> --}}
    </div>

    <div class="mt-5">
        <div class="relative overflow-x-auto rounded-md bg-white shadow-md w-full">
            <table id="data-table" class="whitespace-nowrap w-full text-sm text-left rtl:text-right text-gray-700">
                <thead class="text-xs text-gray-600 uppercase bg-white">
                    <tr class="bg-white border-b border-t border-gray-200">
                        <th scope="col" class="px-6 py-4">
                            No
                        </th>
                        <th scope="col" class="px-6 py-4">
                            Invoice
                        </th>
                        <th scope="col" class="px-6 py-4">
                            Nama Pembeli
                        </th>
                        <th scope="col" class="px-6 py-4 w-[300px]">
                            Barang Dibeli
                        </th>
                        <th scope="col" class="px-6 py-4">
                            Total
                        </th>
                        <th scope="col" class="px-6 py-4">
                            Tanggal dan Waktu
                        </th>
                        <th scope="col" class="px-6 py-4">
                            #
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($transactions as $transaction)
                        <tr class="bg-white border-b border-gray-200">
                            <td class="px-6 py-4">
                                {{ $loop->iteration }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $transaction->invoice }}
                            </td>
                            <td class="px-6 py-4 ">
                                {{ $transaction->name }}
                            </td>
                            <td class="px-6 py-4">
                                @foreach ($transaction->transactionDetails as $detail)
                                    <div class="border border-gray-300 rounded-md p-2 flex gap-3 mb-2">
                                        <img src="{{ $detail->product_image }}"
                                            class="w-[50px] h-[50px] object-cover rounded-md">
                                        <div class="flex flex-col gap-1 w-[calc(100%-70px)]">
                                            <span
                                                class="poppins-medium text-sm leading-[20px]">{{ $detail->product_name }}</span>
                                            <div class="flex justify-between text-xs poppins-medium text-gray-700">
                                                <div class="flex gap-1 items-center">
                                                    @php
                                                        $price = $detail->discount
                                                            ? $detail->product_new_price
                                                            : $detail->product_price;
                                                    @endphp
                                                    <span class="">{{ format_rupiah($price) }}</span>
                                                    <span class="">
                                                        x
                                                        {{ $detail->qty }}
                                                        {{ $detail->abbr }}
                                                    </span>
                                                </div>
                                                <span class="">{{ format_rupiah($detail->total) }}</span>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </td>
                            <td class="px-6 py-4 w-fit">
                                {{ format_rupiah($transaction->total) }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $transaction->created_at->format('d-m-Y H:i:s') }}
                            </td>
                            <td class="px-6 py-4">
                                <button type="button" data-modal-target="default-modal" data-modal-toggle="default-modal"
                                    data-id="{{ $transaction->id }}"
                                    class="btn-detail text-white bg-gray-700 hover:bg-gray-800 focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-xs px-5 py-2.5 cursor-pointer">
                                    Detail
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    {{-- Detail Order --}}
    <div id="default-modal" tabindex="-1" aria-hidden="true"
        class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full close-modal-detail-order">
        <div class="relative p-4 w-full max-w-2xl max-h-full" id="TESSS">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow-sm">
                <!-- Modal header -->
                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-900">
                        Detail Transaksi
                    </h3>
                    <button type="button"
                        class="close-modal-detail-order text-gray-400 cursor-pointer bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center"
                        data-modal-hide="default-modal">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <!-- Modal body -->
                <div class="h-[400px] overflow-y-auto scrollbar" id="container-detail-order">
                    {{--  --}}
                </div>
                <!-- Modal footer -->
                <div class="p-4 md:p-5 border-t border-gray-200 rounded-b">
                    <button type="button" id="btn-print"
                        class="text-white bg-emerald-700 hover:bg-emerald-800 focus:ring-4 focus:outline-none focus:ring-emerald-300 font-medium rounded-lg cursor-pointer text-sm px-5 py-2.5 text-center w-full">
                        <i class="fa-regular fa-print mr-1"></i>
                        Cetak
                    </button>
                </div>
            </div>
        </div>
    </div>

    {{-- Export Transaksi Modal --}}
    <div id="export-transaksi-modal" tabindex="-1" aria-hidden="true"
        class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full close-modal-detail-order">
        <div class="relative p-4 w-full max-w-2xl max-h-full">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow-sm">
                <!-- Modal header -->
                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-900">
                        Export Laporan
                    </h3>
                    <button type="button"
                        class="close-modal-detail-order text-gray-400 cursor-pointer bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center"
                        data-modal-hide="export-transaksi-modal">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <!-- Modal body -->
                <form id="form-report" action="{{ route('admin.report.export') }}" method="POST">
                    @csrf
                    <div class="p-4 md:p-5 space-y-4" id="container-detail-order">
                        <div class="text-gray-700">
                            <label for="start" class="block mb-2 text-sm font-medium">Tanggal Awal</label>
                            <div class="w-full">
                                <input type="date" id="start" name="start"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-gray-500 focus:border-gray-500 block w-full p-2.5"
                                    required />
                            </div>
                        </div>
                        <div class="text-gray-700 mt-4">
                            <label for="end" class="block mb-2 text-sm font-medium">Tanggal Akhir</label>
                            <div class="w-full">
                                <input type="date" id="end" name="end"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-gray-500 focus:border-gray-500 block w-full p-2.5"
                                    required />
                            </div>
                        </div>
                        <button type="submit" id="btn-export"
                            class="btn-detail text-white bg-emerald-700 hover:bg-emerald-800 focus:ring-4 focus:ring-emerald-300 font-medium rounded-lg text-sm px-5 py-2.5 cursor-pointer w-full mt-3">
                            <i class="fa-solid fa-download mr-1"></i>
                            Export Laporan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $(".btn-detail").click(detailOrder);

        function detailOrder() {
            const transactionID = $(this).data("id");
            $.ajax({
                type: "GET",
                url: "{{ route('admin.report.show', ':id') }}".replace(":id", transactionID),
                beforeSend: function() {
                    $("#container-detail-order").html(`
                    <div class="flex justify-center items-center h-full py-5">
                        <div role="status">
                            <svg aria-hidden="true" class="w-8 h-8 text-gray-200 animate-spin fill-gray-700" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor"/><path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentFill"/></svg>
                            <span class="sr-only">Loading...</span>
                        </div>
                    </div>
                    `);
                    $("#btn-print")
                        .removeClass("bg-emerald-700 hover:bg-emerald-800 cursor-pointer")
                        .addClass("bg-gray-300 cursor-not-allowed")
                        .attr("disabled", true);
                },
                success: function(response) {
                    $("#btn-print")
                        .removeClass("bg-gray-300 cursor-not-allowed")
                        .addClass("bg-emerald-700 hover:bg-emerald-800 cursor-pointer")
                        .attr("disabled", false);
                    $("#container-detail-order").html(response.view);
                }
            });
        }
    </script>
@endsection
