<nav x-data="{ open: false }" class="bg-gray-950 border-b border-gray-800 sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-20">
            <div class="flex">
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}" class="group flex items-center gap-2 transition duration-300">
                        <div
                            class="relative w-9 h-9 flex items-center justify-center bg-indigo-600 rounded-lg transform rotate-3 group-hover:rotate-0 transition duration-300 shadow-lg shadow-indigo-500/20">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-white" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13 10V3L4 14h7v7l9-11h-7z" />
                            </svg>
                        </div>
                        <span
                            class="text-2xl font-black tracking-tighter text-white uppercase italic font-['Black_Ops_One']">
                            GYM<span class="text-indigo-500">PRO</span>
                        </span>
                    </a>
                </div>

                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">

                    {{-- 1. Dashboard --}}
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')"
                        class="transition duration-150 ease-in-out {{ request()->routeIs('dashboard') ? 'text-white border-indigo-500' : 'text-gray-400 hover:text-gray-200 hover:border-gray-700' }}">
                        {{ __('Dashboard') }}
                    </x-nav-link>

                    {{-- 2. طلبات الدفع (تم إصلاح الوضوح عند التفعيل) --}}
                    {{-- إذا كان الرابط نشطاً: لون أبيض وخط سفلي ملون. غير نشط: رمادي --}}
                    <x-nav-link :href="route('admin.payments.index')" :active="request()->routeIs('admin.payments.*')"
                        class="transition duration-150 ease-in-out {{ request()->routeIs('admin.payments.*') ? 'text-white border-indigo-500 font-bold' : 'text-gray-400 hover:text-gray-200 hover:border-gray-700' }}">
                        {{ __('طلبات الدفع') }}
                    </x-nav-link>

                    {{-- 3. تسجيل الحضور (تم جعله يشبه باقي الروابط تماماً) --}}
                    <x-nav-link :href="route('daily.attendance')" :active="request()->routeIs('daily.attendance')"
                        class="transition duration-150 ease-in-out {{ request()->routeIs('daily.attendance') ? 'text-white border-indigo-500 font-bold' : 'text-gray-400 hover:text-gray-200 hover:border-gray-700' }}">
                        {{ __('تسجيل الحضور') }}
                    </x-nav-link>

                    {{-- بقية الروابط (Dropdowns/Includes) --}}
                    <div class="flex space-x-8">
                        @include('layouts.partials._admin_links')
                    </div>

                    <div class="flex space-x-8">
                        @include('layouts.partials._trainer_links')
                    </div>

                    <div class="flex space-x-8">
                        @include('layouts.partials._member_links')
                    </div>

                    <div class="flex space-x-8">
                        @include('layouts.partials._course_links')
                    </div>

                    <div class="flex space-x-8">
                        @include('layouts.partials._session_links')
                    </div>

                    <div class="flex space-x-8">
                        @include('layouts.partials._equipment_links')
                    </div>
                </div>
            </div>

            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button
                            class="inline-flex items-center px-4 py-2 border border-gray-700 text-sm leading-4 font-bold rounded-xl text-gray-300 bg-gray-900 hover:text-white hover:bg-gray-800 hover:border-indigo-500/50 focus:outline-none transition ease-in-out duration-150 shadow-sm">
                            <div>{{ Auth::user()->name }}</div>
                            <div class="ms-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')">
                            {{ __('Profile') }}
                        </x-dropdown-link>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')"
                                onclick="event.preventDefault(); this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open"
                    class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-white hover:bg-gray-800 focus:outline-none focus:bg-gray-800 focus:text-white transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{ 'hidden': open, 'inline-flex': !open }" class="inline-flex"
                            stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{ 'hidden': !open, 'inline-flex': open }" class="hidden" stroke-linecap="round"
                            stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <div :class="{ 'block': open, 'hidden': !open }" class="hidden sm:hidden bg-gray-900 border-t border-gray-800">
        <div class="pt-2 pb-3 space-y-1">

            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" class="text-gray-300 hover:text-white">
                {{ __('Dashboard') }}
            </x-responsive-nav-link>

            <x-responsive-nav-link :href="route('admin.payments.index')" :active="request()->routeIs('admin.payments.*')" class="text-gray-300 hover:text-white">
                {{ __('طلبات الدفع') }}
            </x-responsive-nav-link>

            <x-responsive-nav-link :href="route('daily.attendance')" :active="request()->routeIs('daily.attendance')" class="text-gray-300 hover:text-white">
                {{ __('تسجيل الحضور') }}
            </x-responsive-nav-link>

            @include('layouts.partials._admin_links')
            @include('layouts.partials._trainer_links')
            @include('layouts.partials._member_links')
            @include('layouts.partials._course_links')
            @include('layouts.partials._session_links')
            @include('layouts.partials._equipment_links')
        </div>

        <div class="pt-4 pb-1 border-t border-gray-800 bg-gray-950">
            <div class="px-4">
                <div class="font-medium text-base text-white">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm text-gray-400">{{ Auth::user()->email }}</div>
            </div>

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')" class="text-gray-300 hover:text-white">
                    {{ __('Profile') }}
                </x-responsive-nav-link>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-responsive-nav-link :href="route('logout')" class="text-gray-300 hover:text-red-400"
                        onclick="event.preventDefault(); this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>
