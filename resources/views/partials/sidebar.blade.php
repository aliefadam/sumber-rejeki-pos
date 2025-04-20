<aside id="sidebar"
    class="fixed top-0 left-0 z-10 w-64 h-screen pt-20 transition-transform -translate-x-full bg-white border-r border-gray-200 md:translate-x-0"
    aria-label="Sidebar">
    <div class="h-full relative px-4 pb-4 overflow-y-auto scrollbars bg-white">
        <ul class="font-medium">
            @foreach (getMenuSidebar() as $index => $menu)
                <li class="text-sm text-gray-500 mb-3 {{ $index > 0 ? 'mt-4' : '' }} capitalize">
                    {{ $menu->name }}
                </li>
                @foreach ($menu->menuDetails as $detail)
                    <li class="mb-2">
                        @php
                            $route = explode('.', $detail->route)[1];
                        @endphp
                        <a href="{{ route($detail->route) }}"
                            class="flex items-center px-3 py-3 {{ active_sidebar("$route") }} rounded-lg group text-[15px]">
                            <i class="{{ $detail->icon }} w-5 transition duration-75"></i>
                            <span class="ml-3 capitalize">{{ $detail->name }}</span>
                        </a>
                    </li>
                @endforeach
            @endforeach
        </ul>

        <div
            class="absolute bottom-0 justify-center flex items-center gap-2 text-gray-500 left-0 right-0 w-full text-sm px-5 py-7">
            <i class="fa-solid fa-user"></i>
            <h1>Developed by <span class="font-semibold">Codemate</span></h1>
        </div>
    </div>
</aside>
