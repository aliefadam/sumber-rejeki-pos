@extends('layouts.app')

@section('content')
    <div class="flex justify-between items-start">
        @include('partials.breadcrumb', [
            'current' => $title,
            'before' => [
                'name' => 'Data Produk',
                'url' => route('admin.product.index'),
            ],
        ])
    </div>

    <div class="bg-white w-full lg:w-1/2 rounded-md shadow-md p-5 mt-5">
        <form action="{{ route('admin.product.update', $product->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="mb-5">
                <label for="name" class="block mb-2 text-sm font-medium text-gray-900 ">
                    Nama Produk
                </label>
                <input type="text" id="name" name="name" value="{{ $product->name }}"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-gray-700 focus:border-gray-700 block w-full p-2.5"
                    required />
            </div>
            <div class="mb-5">
                <label for="unit_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                    Dijual dalam satuan
                </label>
                <select id="unit_id" name="unit_id" required
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-gray-700 focus:border-gray-700 block w-full p-2.5">
                    <option value=""> -- Pilih satuan --</option>
                    @foreach ($units as $unit)
                        <option @selected($product->unit_id == $unit->id) value="{{ $unit->id }}">{{ $unit->name }}
                            ({{ $unit->abbr }})
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="mb-5">
                <label for="price" class="block mb-2 text-sm font-medium text-gray-900 ">
                    Harga per satuan
                </label>
                <input type="number" id="price" name="price" value="{{ $product->price }}"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-gray-700 focus:border-gray-700 block w-full p-2.5"
                    required />
            </div>
            <div class="mb-5">
                <label class="block mb-2 text-sm font-medium text-gray-900" for="product_image">
                    Gambar Produk
                </label>
                <img id="image-preview"
                    src="{{ $product->image == null ? '/imgs/blank-product.png' : '/uploads/products/' . $product->image }}"
                    class="size-20 mb-3 object-cover rounded-md shadow-md">
                <input
                    class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none"
                    id="product_image" name="product_image" type="file">
            </div>
            <div class="flex justify-end">
                <button type="submit"
                    class="text-white cursor-pointer bg-gray-600 hover:bg-gray-700 focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5">
                    Simpan
                </button>
            </div>
        </form>
    </div>
@endsection

@section('script')
    <script>
        $("#product_image").change(function() {
            let reader = new FileReader();
            reader.onload = (e) => {
                $("#image-preview").attr("src", e.target.result);
            }
            reader.readAsDataURL(this.files[0]);
        });
    </script>
@endsection
