@extends('layouts.app')

@section('content')
    <div class="flex justify-between items-start">
        @include('partials.breadcrumb', [
            'current' => $title,
        ])
        <a href="{{ route('admin.product.create') }}"
            class="text-white bg-gray-600 border border-gray-600 hover:bg-gray-700 focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5">
            <i class="fas fa-plus mr-1.5"></i> Tambah Produk
        </a>
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
                            Nama Produk
                        </th>
                        <th scope="col" class="px-6 py-4">
                            Harga
                        </th>
                        <th scope="col" class="px-6 py-4">
                            Dijual dalam satuan
                        </th>
                        <th scope="col" class="px-6 py-4">
                            Foto
                        </th>
                        <th scope="col" class="px-6 py-4">
                            #
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $product)
                        <tr class="bg-white border-b border-gray-200">
                            <td class="px-6 py-4">
                                {{ $loop->iteration }}
                            </td>
                            <td class="px-6 py-4 capitalize">
                                {{ $product->name }}
                            </td>
                            <td class="px-6 py-4">
                                {{ format_rupiah($product->price) }}
                            </td>
                            <td class="px-6 py-4 w-fit">
                                {{ $product->unit->name }} ({{ $product->unit->abbr }})
                            </td>
                            <td class="px-6 py-4">
                                @php
                                    if ($product->image) {
                                        $image = "/uploads/products/$product->image";
                                    } else {
                                        $image = Avatar::create($product->name)->toBase64();
                                    }
                                @endphp
                                <img src="{{ $image }}" class="size-20 object-cover rounded-md shadow-md">
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-5">
                                    <a href="{{ route('admin.product.edit', $product->id) }}"
                                        class="text-sm text-blue-700 poppins-medium hover:underline">
                                        <i class="fa-regular fa-pen-to-square"></i> Edit
                                    </a>
                                    <a href="javascript:void(0)" data-product-id="{{ $product->id }}"
                                        class="btn-delete text-sm text-red-700 poppins-medium hover:underline">
                                        <i class="fa-regular fa-trash"></i> Hapus
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection

@section('script')
    <script>
        table.on('draw', function() {
            $(".btn-delete").click(deleteProduct);
        });
        $(".btn-delete").click(deleteProduct);

        function deleteProduct() {
            const productID = $(this).data("product-id");

            Swal.fire({
                title: 'Apakah anda yakin?',
                text: "Anda tidak dapat membatalkan ini!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                cancelButtonText: 'Batal',
                confirmButtonText: 'Ya, Hapus!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "{{ route('admin.product.destroy', ':id') }}".replace(':id', productID),
                        type: 'DELETE',
                        data: {
                            _token: "{{ csrf_token() }}",
                        },
                        beforeSend: function() {
                            Swal.fire({
                                title: 'Loading',
                                text: 'Please wait...',
                                didOpen: () => {
                                    Swal.showLoading()
                                }
                            });
                        },
                        success: function(data) {
                            location.reload();
                        },
                    });
                }
            });
        }
    </script>
@endsection
