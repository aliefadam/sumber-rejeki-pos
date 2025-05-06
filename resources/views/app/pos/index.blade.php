@extends('layouts.app')

@section('content')
    <div class="flex gap-3 h-[calc(100vh-110px)]">
        <div class="w-full h-full overflow-y-auto scrollbar pr-5">
            <div class="relative w-full">
                <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                    <i class="fa-regular fa-magnifying-glass"></i>
                </div>
                <input type="text" id="search-product" name="search"
                    class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-transparent focus:border-gray-800 block w-full ps-10 p-2.5"
                    placeholder="Cari produk..." required autocomplete="off" />
            </div>
            <div class="mt-5 grid grid-cols-4 gap-5" id="container-product">
                {{-- <div class="mt-5 grid grid-cols-3 gap-5" id="container-product"> --}}
                {{-- Javascript --}}
            </div>
        </div>
        <div class="w-[500px] bg-white shadow-md rounded-md">
            <div class="p-4 border-b border-gray-300">
                <h1 class="text-center poppins-medium">Daftar Pesanan</h1>
            </div>
            <div class="p-4 h-[calc(100vh-280px)] space-y-3 overflow-auto scrollbar" id="list-order-container">
                {{-- Javascript --}}
            </div>
            <div class="p-4 border-t border-gray-300">
                <div class="flex justify-between poppins-medium">
                    <h1>Total</h1>
                    <h1 id="total">Rp. 0</h1>
                </div>
                <div class="mt-3">
                    <button type="button" id="btn-detail-order" data-modal-target="default-modal"
                        data-modal-toggle="default-modal"
                        class="focus:outline-none text-white cursor-pointer bg-gray-700 hover:bg-gray-800 focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 w-full">
                        Bayar
                    </button>
                </div>
            </div>
        </div>
    </div>

    {{-- Add and Edit Modal --}}
    <div id="crud-modal" tabindex="-1" aria-hidden="true"
        class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full max-w-md max-h-full">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow-sm">
                <!-- Modal header -->
                <div class="flex items-center justify-between p-4 border-b rounded-t border-gray-200">
                    <h3 class="font-semibold text-gray-900">
                        Atur Jumlah
                    </h3>
                    <button type="button"
                        class="cursor-pointer text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center"
                        data-modal-toggle="crud-modal">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <!-- Modal body -->
                <form class="p-4 md:p-5" id="form-preview">
                    <input type="hidden" name="input-id" id="input-id">
                    <input type="hidden" name="input-name" id="input-name">
                    <input type="hidden" name="input-price" id="input-price">
                    <input type="hidden" name="input-image" id="input-image">
                    <input type="hidden" name="input-unit" id="input-unit">
                    <input type="hidden" name="input-type" id="input-type">

                    <div class="grid gap-4 mb-4 grid-cols-2">
                        <div class="col-span-2">
                            <img id="image-preview" src=""
                                class="w-full h-[250px] rounded-md shadow-md object-cover">
                            <h1 id="name-preview" class="mt-3 text-center poppins-medium"></h1>
                        </div>
                        <div class="col-span-2">
                            <label for="name" class="block mb-2 text-sm font-medium text-gray-900">Jumlah</label>
                            <div class="flex items-center gap-2">
                                <input id="qty-preview" type="number" name="qty" id="qty"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-gray-600 focus:border-gray-600 block w-full p-2.5">
                                <div id="unit-preview"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 p-2.5 text-sm rounded-lg poppins-medium">
                                </div>
                            </div>
                        </div>
                    </div>
                    <button type="submit" id="btn-confirm-order" data-modal-hide="crud-modal"
                        class="text-white inline-flex items-center bg-gray-700 hover:bg-gray-800 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center cursor-pointer">
                        Konfirmasi
                    </button>
                </form>
            </div>
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
                        Detail Pesanan
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
                <div class="p-4 md:p-5 space-y-4 h-[350px] overflow-y-auto scrollbar" id="container-detail-order">

                </div>
                <!-- Modal footer -->
                <div class="p-4 md:p-5 border-t border-gray-200 rounded-b">
                    <div class="">
                        <div class="flex justify-between poppins-medium text-emerald-700">
                            <h1>Total Akhir</h1>
                            <h1 id="total-akhir">Rp. 0</h1>
                        </div>
                        <div class="grid grid-cols-2 gap-5 poppins-medium mt-5">
                            <div class="">
                                <label for="nama-pembeli" class="block mb-2 text-sm font-medium text-gray-700">Nama
                                    Pembeli</label>
                                <input type="text" name="nama-pembeli" id="nama-pembeli"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-gray-500 focus:border-gray-500 block w-full p-2.5"
                                    value="{{ $buyer_name }}" />
                            </div>
                            <div class="">
                                <label for="uang-pembeli" class="block mb-2 text-sm font-medium text-gray-700">Uang
                                    Pembeli</label>
                                <input type="text" name="uang-pembeli" id="uang-pembeli"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-gray-500 focus:border-gray-500 block w-full p-2.5" />
                            </div>
                        </div>
                        <div class="flex justify-between poppins-medium mt-5 text-red-700">
                            <h1>Uang Kembalian</h1>
                            <h1 id="kembalian">Rp. 0</h1>
                        </div>
                    </div>
                    <div class="flex items-center gap-2 mt-5">
                        <button type="button" id="btn-payment-now"
                            class="text-white bg-gray-700 hover:bg-gray-800 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-lg cursor-pointer text-sm px-5 py-2.5 text-center w-full">
                            Bayar Sekarang
                        </button>
                        <button data-modal-hide="default-modal" type="button"
                            class="close-modal-detail-order py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg cursor-pointer border border-gray-200 hover:bg-gray-100 hover:text-gray-700 focus:z-10 focus:ring-4 focus:ring-gray-100 w-full">
                            Batal
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        initProduct();
        const listOrder = [];

        $(document).on("click", ".btn-add-order", addOrder);
        $(document).on("click", ".btn-delete-order", deleteOrder);
        $(document).on("click", "#btn-confirm-order", confirmOrder);
        $(document).on("click", "#btn-detail-order", detailOrder);
        $(document).on("click", ".btn-add-discount", addDiscount);
        $(document).on("input", "#uang-pembeli", hitungKembalian);
        $(document).on("click", "#btn-payment-now", paymentNow);
        $(document).on("input", "#search-product", searchProduct);

        $(document).on("click", "#TESSS", function(e) {
            e.stopPropagation();
        });
        $(document).on("click", ".close-modal-detail-order", function(e) {
            initFlowbite();
        });

        $('#uang-pembeli').on('input', function(e) {
            let value = e.target.value;
            value = value.replace(/[^\d]/g, '');
            const formatted = value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
            e.target.value = formatted;
        });

        function initProduct() {
            $.ajax({
                type: "GET",
                url: "{{ route('admin.transaction.init') }}",
                beforeSend: function() {
                    $("#container-product").html(loadingSearchProduct());
                },
                success: function(response) {
                    $("#container-product").html(response.view);
                    initFlowbite();
                }
            });
        }

        function searchProduct() {
            const keyword = $(this).val();
            if (keyword != "") {
                $.ajax({
                    type: "GET",
                    url: "{{ route('admin.product.search', ':keyword') }}".replace(":keyword", keyword),
                    beforeSend: function() {
                        $("#container-product").html(loadingSearchProduct());
                    },
                    success: function(response) {
                        const view = response.view;
                        if (view == "") {
                            $("#container-product").html(notFoundProduct());
                        } else {
                            $("#container-product").html(response.view);
                        }
                        initFlowbite();
                    }
                });
            } else {
                initProduct();
            }
        }

        function loadingSearchProduct() {
            let html = "";
            for (let i = 0; i < 6; i++) {
                html += `
                    <div class="bg-white rounded-md shadow-md p-3">
                        <div src="" alt="" class="h-[200px] bg-gray-300 animate-pulse w-full object-cover rounded-md"></div>
                        <div class="mt-3 flex flex-col">
                            <span class="poppins-medium text-transparent bg-gray-200 animate-pulse">Beras Pinpin</span>
                            <span class="text-gray-600 mt-2 poppins-medium text-sm text-transparent bg-gray-200 animate-pulse w-1/2">
                                Rp. 10,00000
                            </span>
                        </div>
                        <div class="mt-3">
                            <button type="button"
                                class="btn-add-order focus:outline-none text-white cursor-pointer bg-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 w-full cursor-default">
                                <i class="fa-regular fa-cart-plus mr-1 text-transparent"></i>
                                <span class="text-transparent">Tambah</span>
                            </button>
                        </div>
                    </div>
                `;
            }
            return html;
        }

        function notFoundProduct() {
            return `
            <div class="col-span-3 flex justify-center">
                <span class="text-gray-600 poppins-medium">
                    Tidak ada produk yang cocok
                </span>
            </div>
            `;
        }

        function addOrder() {
            const id = $(this).data("id");
            const image = $(this).data("image");
            const name = $(this).data("name");
            const price = $(this).data("price");
            const abbr = $(this).data("abbr");
            const type = $(this).data("type");
            const qty = $(this).data("qty") ?? 1;

            $("#qty-preview").val(qty);
            $("#image-preview").attr("src", image);
            $("#name-preview").text(name);
            $("#unit-preview").text(abbr);

            $("#input-id").val(id);
            $("#input-name").val(name);
            $("#input-price").val(price);
            $("#input-image").val(image);
            $("#input-unit").val(abbr);
            $("#input-type").val(type);
        }

        function confirmOrder(e) {
            e.preventDefault();
            const formData = $("#form-preview").serializeArray();

            const id = formData.find(item => item.name === "input-id").value;
            const name = formData.find(item => item.name === "input-name").value;
            const price = formData.find(item => item.name === "input-price").value;
            const image = formData.find(item => item.name === "input-image").value;
            const abbr = formData.find(item => item.name === "input-unit").value;
            const type = formData.find(item => item.name === "input-type").value;
            const qty = +formData.find(item => item.name === "qty").value;

            const existingOrder = listOrder.find(item => item.id === id);
            if (existingOrder) {
                if (type == "add") {
                    existingOrder.qty = parseInt(existingOrder.qty) + qty;
                } else {
                    existingOrder.qty = qty;
                }
                if (existingOrder.discount) {
                    existingOrder.total = existingOrder.newPrice * existingOrder.qty;
                } else {
                    existingOrder.total = existingOrder.price * existingOrder.qty;
                }
            } else {
                listOrder.push({
                    id: id,
                    name: name,
                    qty: qty,
                    price: price,
                    total: price * qty,
                    image: image,
                    abbr: abbr,
                });
            }

            updateListOrder();
            initFlowbite();
        }

        function deleteOrder() {
            const id = $(this).data("id").toString();

            const index = listOrder.findIndex(item => item.id === id);
            listOrder.splice(index, 1);

            updateListOrder();
            initFlowbite();
        }

        function updateListOrder() {
            let total = 0;
            let html = "";

            listOrder.forEach((item, index) => {
                total += item.total;
                html += `
                <div class="border border-gray-300 rounded-md p-2 flex gap-3">
                    <img src="${item.image}"
                        class="w-[70px] h-[70px] object-cover rounded-md">
                    <div class="flex flex-col gap-1 w-[calc(100%-70px)]">
                        <span class="poppins-medium text-sm leading-[20px]">${item.name}</span>
                        <div class="flex justify-between text-xs poppins-medium text-gray-700">
                            <div class="flex gap-1 items-center">
                                <span class="">${item.discount ? formatRupiah(item.newPrice) : formatRupiah(item.price)}</span>
                                <span class="">x ${item.qty} ${item.abbr}</span>
                            </div>
                            <span class="">${formatRupiah(item.total)}</span>
                        </div>
                        <div class="flex items-center mt-1.5 gap-3">
                            <a href="javascript:void(0)" data-id="${item.id}" data-image="${item.image}"
                                data-name="${item.name}" data-price="${item.price}"
                                data-abbr="${item.abbr}" data-qty="${item.qty}" data-type="edit" data-modal-target="crud-modal"
                                data-modal-toggle="crud-modal" class="btn-add-order text-xs text-blue-700 poppins-medium hover:underline">
                                <i class="fa-regular fa-pen-to-square"></i> Edit
                            </a>
                            <a href="javascript:void(0)" data-id="${item.id}"
                                class="btn-delete-order text-xs text-red-700 poppins-medium hover:underline">
                                <i class="fa-regular fa-trash"></i> Hapus
                            </a>
                        </div>
                    </div>
                </div>
                `;
            });

            $("#list-order-container").html(html);
            $("#total").text(formatRupiah(total));
        }

        function detailOrder() {
            let totalAkhir = 0;
            let html = "";

            listOrder.forEach((item, index) => {
                totalAkhir += item.total;
                html += `
                <div class="border border-gray-300 rounded-md p-2 flex gap-3">
                    <img src="${item.image}"
                        class="w-[70px] h-[70px] object-cover rounded-md">
                    <div class="flex flex-col gap-1 w-[calc(100%-70px)]">
                        <span class="poppins-medium leading-[20px]">${item.name}</span>
                        <div class="flex justify-between text-sm poppins-medium text-gray-700">
                            <div class="flex gap-1 items-center">
                                <span class="${item.discount ? "line-through text-red-600" : ""}">${formatRupiah(item.price)}</span>
                                ${isDiscount(item.discount, item.newPrice)}
                                <span class="">x ${item.qty} ${item.abbr}</span>
                            </div>
                            <span class="">
                                ${formatRupiah(item.total)}
                            </span>
                        </div>
                        <div class="flex items-center justify-between mt-1.5 gap-3">
                            <a href="javascript:void(0)" data-id="${item.id}" data-name="${item.name}" data-price="${item.price}"
                                class="btn-add-discount text-sm text-amber-700 poppins-medium">
                                <i class="fa-regular fa-tags"></i> Tambahkan potongan harga
                            </a>
                        </div>
                    </div>
                </div>
                `;
            });

            $("#container-detail-order").html(html);
            $("#total-akhir").html(formatRupiah(totalAkhir));


            if ($("#uang-pembeli").val() != "") {
                hitungKembalian();
            }
        }

        function isDiscount(discount, newPrice) {
            if (discount) {
                return `
                 <span>${discount ? formatRupiah(newPrice) : ""}</span>
                `;
            }
            return "";
        }

        function addDiscount() {
            const id = $(this).data("id").toString();
            const name = $(this).data("name");
            const price = $(this).data("price");

            Swal.fire({
                title: "Masukkan potongan harga",
                text: `Harga ${name} per item : ${formatRupiah(price)}`,
                input: "number",
                showCancelButton: true,
                confirmButtonText: "Konfirmasi",
                showLoaderOnConfirm: true,
                allowOutsideClick: () => !Swal.isLoading()
            }).then((result) => {
                if (result.isConfirmed) {
                    const existingOrder = listOrder.find(item => item.id === id);

                    if (existingOrder) {
                        existingOrder.discount = +result.value;

                        // Fitur Sementara
                        existingOrder.newPrice = +existingOrder.price - +result.value;
                        existingOrder.total = existingOrder.newPrice * existingOrder.qty;
                        detailOrder();
                        updateListOrder();
                    }
                }
            });
        }

        function hitungKembalian() {
            const uangPembeli = +$("#uang-pembeli").val().replace(/,/g, '');
            const totalAkhir = +$("#total-akhir").text().replace(/[^0-9]/g, '');
            const kembalian = uangPembeli - totalAkhir;
            $("#kembalian").html(formatRupiah(kembalian));
        }

        function paymentNow() {
            if (listOrder.length == 0) {
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal',
                    text: 'List order masih kosong',
                });
                return;
            }

            if ($("#nama-pembeli").val() == "") {
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal',
                    text: 'Nama pembeli harus diisi',
                });
                return;
            }

            if ($("#uang-pembeli").val() == "") {
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal',
                    text: 'Uang pembeli harus diisi',
                });
                return;
            }
            $.ajax({
                type: "POST",
                url: "{{ route('admin.transaction.store') }}",
                beforeSend: function() {
                    Swal.fire({
                        title: 'Loading',
                        text: 'Tunggu sebentar...',
                        didOpen: () => {
                            Swal.showLoading()
                        }
                    });
                },
                data: {
                    _token: "{{ csrf_token() }}",
                    name: $("#nama-pembeli").val(),
                    amount_paid: $("#uang-pembeli").val().replace(/,/g, ''),
                    total: unformatRupiah($("#total-akhir").text()),
                    change: unformatRupiah($("#kembalian").text()),
                    listOrder: listOrder,
                },
                success: function(response) {
                    window.open(response.url, "_blank");
                    location.reload();
                }
            });
        }

        function formatRupiah(number) {
            return new Intl.NumberFormat('id-ID', {
                style: 'currency',
                currency: 'IDR',
                maximumFractionDigits: 0,
            }).format(number);
        }

        function unformatRupiah(number) {
            return +number.replace("Rp", "").replace(".", "").trim();
        }
    </script>
@endsection
