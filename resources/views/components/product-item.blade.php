@foreach ($products as $product)
    <div class="bg-white rounded-md shadow-md p-3 h-fit">
        @php
            if ($product->image) {
                $image = "/uploads/products/$product->image";
            } else {
                $image = Avatar::create($product->name)->toBase64();
            }
        @endphp
        <img src="{{ $image }}" alt="" class="h-[200px] w-full object-cover rounded-md">
        <div class="mt-3 flex flex-col h-[80px]">
            <span class="poppins-medium text-black">{{ $product->name }}</span>
            <span class="text-gray-600 mt-1 poppins-medium text-sm">
                {{ format_rupiah($product->price) }} /{{ $product->unit->abbr }}
            </span>
        </div>
        <div class="mt-3">
            <button type="button" data-id="{{ $product->id }}" data-image="{{ $image }}"
                data-name="{{ $product->name }}" data-price="{{ $product->price }}"
                data-abbr="{{ $product->unit->abbr }}" data-type="add" data-modal-target="crud-modal"
                data-modal-toggle="crud-modal"
                class="btn-add-order focus:outline-none text-white cursor-pointer bg-gray-700 hover:bg-gray-800 focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 w-full">
                <i class="fa-regular fa-cart-plus mr-1"></i>
                <span>Tambah</span>
            </button>
        </div>
    </div>
@endforeach
