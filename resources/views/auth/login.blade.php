@extends('layouts.auth')

@section('content')
    <div class="bg-white w-[600px] p-10 shadow-md rounded-md">
        <h1 class="text-center poppins-semibold text-gray-700 text-2xl">Sumber Rejeki</h1>
        <form action="{{ route('login.post') }}" method="POST" class="mt-5 space-y-5">
            @csrf
            <div class="text-gray-700">
                <label for="email" class="block mb-2 text-sm font-medium">Email</label>
                <div class="relative w-full">
                    <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                        <i class="fa-regular fa-user"></i>
                    </div>
                    <input type="text" id="email" name="email" value="{{ old('email') }}"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-gray-500 focus:border-gray-500 block w-full ps-10 p-2.5"
                        placeholder="Email" required />
                </div>
            </div>
            <div class="text-gray-700">
                <label for="password" class="block mb-2 text-sm font-medium">Password</label>
                <div class="relative w-full">
                    <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                        <i class="fa-regular fa-lock"></i>
                    </div>
                    <input type="password" id="password" name="password"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-gray-500 focus:border-gray-500 block w-full ps-10 p-2.5"
                        placeholder="Password" required />
                </div>
            </div>
            <div class="flex justify-center mt-7">
                <button type="submit"
                    class="w-1/2 text-white bg-gray-700 hover:bg-gray-800 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium rounded-full text-sm px-5 py-2.5 text-center cursor-pointer">Login</button>
            </div>
        </form>
    </div>
@endsection
