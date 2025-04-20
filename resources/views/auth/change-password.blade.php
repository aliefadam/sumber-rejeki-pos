@extends('layouts.app')

@section('content')
    <div class="flex justify-between items-start">
        @include('partials.breadcrumb', [
            'current' => $title,
        ])
    </div>

    <div class="mt-5 bg-white rounded-md shadow-md p-5 w-full lg:w-1/2">
        <form action="{{ route('change-password-post') }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-5">
                <label for="password_old" class="block mb-2 text-sm font-medium text-gray-900">
                    Password Lama
                </label>
                <input type="password" id="password_old" name="password_old"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-gray-500 focus:border-gray-500 block w-full p-2.5"
                    required />
            </div>
            <div class="mb-5">
                <label for="password" class="block mb-2 text-sm font-medium text-gray-900">
                    Password Baru
                </label>
                <input type="password" id="password" name="password"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-gray-500 focus:border-gray-500 block w-full p-2.5"
                    required />
            </div>
            <div class="mb-5">
                <label for="password_confirmation" class="block mb-2 text-sm font-medium text-gray-900">
                    Konfirmasi Password Baru
                </label>
                <input type="password" id="password_confirmation" name="password_confirmation"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-gray-500 focus:border-gray-500 block w-full p-2.5"
                    required />
            </div>
            <div class="flex justify-end">
                <button type="submit"
                    class="text-white bg-gray-700 hover:bg-gray-800 focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5">Ganti
                    Password</button>
            </div>
        </form>
    </div>
@endsection
