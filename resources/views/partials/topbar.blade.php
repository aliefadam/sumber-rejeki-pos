<nav class="fixed top-0 z-20 w-full shadow-md bg-white border-b border-gray-200" id="topbar">
    <div class="px-3 py-3 lg:px-5 lg:pl-3">
        <div class="flex items-center justify-between">
            <div class="flex items-center justify-start gap-3">
                <button id="toggleSidebarMobile" aria-expanded="true" aria-controls="sidebar"
                    class="p-3 text-gray-600 flex justify-center items-center rounded cursor-pointer lg:hiddens hover:text-gray-900 hover:bg-gray-100">
                    <i class="fas fa-bars"></i>
                </button>
                <div class="flex-shrink-0 flex items-center gap-2 ps-2">
                    <a href="/" class="flex items-center text-gray-700">
                        <span class="text-lg poppins-medium">
                            Sumber Rejeki • <span class="poppins-semibold">POS</span>
                        </span>
                    </a>
                </div>
            </div>
            <div class="flex items-center">
                <div class="flex items-center ml-3">
                    <div class="flex items-center">
                        <div class="mr-3 text-right">
                            <p class="text-sm font-medium">{{ auth()->user()->name }}</p>
                            <p class="text-xs text-gray-500 capitalize">{{ auth()->user()->role }}</p>
                        </div>
                        <div class="relative">
                            <button type="button" data-dropdown-toggle="dropdown-user-popup"
                                class="flex text-sm cursor-pointer rounded-full focus:ring-4 focus:ring-gray-300"
                                id="user-menu-button">
                                <img class="w-8 h-8 shadow-sm rounded-full"
                                    src="{{ auth()->user()->image ? '/uploads/users/' . auth()->user()->image : '/imgs/no-image.png' }}" />
                            </button>
                            <div id="dropdown-user-popup"
                                class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow-md w-72 !-translate-x-[20px] !translate-y-[10px]">
                                <div class="px-4 py-3 text-sm text-gray-900  flex gap-3 items-center">
                                    <img src="{{ auth()->user()->image ? '/uploads/users/' . auth()->user()->image : '/imgs/no-image.png' }}"
                                        class="w-10 h-10 rounded-full" alt="">
                                    <div class="">
                                        <div>{{ auth()->user()->name }}</div>
                                        <div class="font-medium truncate">{{ auth()->user()->email }}</div>
                                    </div>
                                </div>
                                <ul class="py-2 text-sm text-gray-700" aria-labelledby="dropdown-user">
                                    <li>
                                        <a href="{{ route('change-password') }}"
                                            class="block px-4 py-2 hover:bg-gray-100">
                                            Ganti Password
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('logout') }}" class="block px-4 py-2 hover:bg-gray-100">
                                            Keluar
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</nav>
