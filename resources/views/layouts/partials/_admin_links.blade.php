@role('admin')
    <div class="hidden sm:flex sm:items-center sm:ms-6">
        <x-dropdown align="right" width="48">

            {{-- 1. زر التريجر (Trigger) بتصميم داكن --}}
            <x-slot name="trigger">
                <button
                    class="inline-flex items-center gap-2 px-4 py-2 border border-transparent text-sm leading-4 font-bold rounded-xl text-gray-300 hover:text-white bg-gray-900 hover:bg-gray-800 hover:border-indigo-500/30 focus:outline-none transition ease-in-out duration-150 shadow-sm group">

                    {{-- أيقونة الدرع (توحي بالمدير) --}}
                    <svg xmlns="http://www.w3.org/2000/svg"
                        class="w-4 h-4 text-indigo-500 group-hover:text-indigo-400 transition" viewBox="0 0 24 24"
                        fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M12.516 2.17a.75.75 0 00-1.032 0 11.209 11.209 0 01-7.877 3.08.75.75 0 00-.722.515A12.74 12.74 0 002.25 9.75c0 5.942 4.064 10.933 9.563 12.348a.749.749 0 00.374 0c5.499-1.415 9.563-6.406 9.563-12.348 0-1.352-.272-2.636-.759-3.985a.75.75 0 00-.722-.516l-.143.001c-2.996 0-5.717-1.07-7.734-3.08zm0 0l-1.032 0zm-1.032 0l1.032 0z"
                            clip-rule="evenodd" />
                    </svg>

                    <div class="font-['Cairo']">Admin</div>

                    <div class="ms-1">
                        <svg class="fill-current h-4 w-4 text-gray-500 group-hover:text-white transition"
                            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                clip-rule="evenodd" />
                        </svg>
                    </div>
                </button>
            </x-slot>

            {{-- 2. محتوى القائمة --}}
            <x-slot name="content">

                {{-- عنوان فرعي صغير --}}
                <div class="block px-4 py-2 text-xs text-gray-400 font-bold tracking-wider text-right">
                    {{ __('إدارة النظام') }}
                </div>

                <x-dropdown-link :href="route('admin.trainers.index')" :active="request()->routeIs('admin.trainers.*')" class="text-right">
                    {{ __('إدارة المدربين') }}
                </x-dropdown-link>

                <div class="border-t border-gray-100 my-1"></div>

                <x-dropdown-link :href="route('roles.index')" :active="request()->routeIs('roles.*')" class="text-right">
                    {{ __('إدارة الأدوار') }}
                </x-dropdown-link>

                <x-dropdown-link :href="route('permissions.index')" :active="request()->routeIs('permissions.*')" class="text-right">
                    {{ __('إدارة الصلاحيات') }}
                </x-dropdown-link>

                <div class="border-t border-gray-100 my-1"></div>

                <x-dropdown-link :href="route('courses.index')" :active="request()->routeIs('courses.*')" class="text-right">
                    {{ __('إدارة الكورسات') }}
                </x-dropdown-link>

                <x-dropdown-link :href="route('gymsessions.index')" :active="request()->routeIs('sessions.*')" class="text-right">
                    {{ __('إدارة الجلسات') }}
                </x-dropdown-link>


                <div class="border-t border-gray-100 my-1"></div>

                <x-dropdown-link :href="route('equipment.index')" :active="request()->routeIs('equipment.*')" class="text-right">
                    {{ __('إدارة المعدات') }}
                </x-dropdown-link>

                <x-dropdown-link :href="route('categories.index')" class="text-right">
                    {{ __('أقسام التدريبات') }}
                </x-dropdown-link>



            </x-slot>
        </x-dropdown>
    </div>
@endrole
