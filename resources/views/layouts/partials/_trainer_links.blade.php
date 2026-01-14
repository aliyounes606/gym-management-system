<div class="hidden sm:flex sm:items-center sm:ms-6">
    <x-dropdown align="right" width="48">

        {{-- 1. زر المدرب (Trigger) --}}
        <x-slot name="trigger">
            <button
                class="inline-flex items-center gap-2 px-4 py-2 border border-transparent text-sm leading-4 font-bold rounded-xl text-gray-300 hover:text-white bg-gray-900 hover:bg-gray-800 hover:border-indigo-500/30 focus:outline-none transition ease-in-out duration-150 shadow-sm group">

                {{-- أيقونة الحافظة (Clipboard) لتوحي بالتخطيط والبرامج --}}
                <svg xmlns="http://www.w3.org/2000/svg"
                    class="w-4 h-4 text-indigo-500 group-hover:text-indigo-400 transition" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
                </svg>

                <div class="font-['Cairo']">{{ __('Trainer') }}</div>

                {{-- سهم القائمة --}}
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

            {{-- عنوان فرعي --}}
            <div class="block px-4 py-2 text-xs text-gray-500 uppercase font-bold tracking-wider">
                {{ __('أدوات المدرب') }}
            </div>

  {{-- الرابط يظهر فقط للآدمن والمدرب --}}
@hasanyrole('admin|trainer')
    <x-nav-link :href="route('meal-plans.index')" :active="request()->routeIs('meal-plans.index')">
        {{ __('إدارة الوجبات') }}
    </x-nav-link>
@endhasanyrole

            {{-- التحقق من وجود ملف المدرب --}}
            @if (auth()->user()->trainerProfile)
                <div class="border-t border-gray-800 my-1"></div> {{-- فاصل --}}

                <x-dropdown-link :href="route('sessions.schedule', auth()->user()->trainerProfile->id)">
                    {{ __('الجدول الزمني') }}
                </x-dropdown-link>
            @endif
        </x-slot>
    </x-dropdown>
</div>
