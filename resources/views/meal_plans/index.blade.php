<x-app-layout>
    {{-- الخلفية بيضاء/رمادية فاتحة للصفحة كاملة --}}
    <div class="py-12 bg-gray-50 min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-10">

            {{-- 1. الهيدر (العنوان والأزرار) --}}
            <div class="flex flex-col md:flex-row justify-between items-center gap-4 pb-6 border-b border-gray-200">
                <div class="text-right">
                    <h2 class="text-3xl font-black text-gray-800 tracking-tight">
                        مكتبة الوجبات الغذائية 🥗
                    </h2>
                    <p class="text-gray-500 mt-2 text-lg">
                        تصفح الأنظمة الغذائية وأرسل التوصيات للمتدربين.
                    </p>
                </div>

                @hasanyrole('admin|trainer')
                    <a href="{{ route('meal-plans.create') }}"
                        class="inline-flex items-center justify-center px-6 py-3 bg-gray-900 hover:bg-black text-white font-bold rounded-xl shadow-lg transition transform hover:-translate-y-0.5 border border-gray-700">
                        <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                        </svg>
                        إضافة وجبة جديدة
                    </a>
                @endhasanyrole
            </div>

            {{-- 2. رسائل النجاح --}}
            @if (session('success'))
                <div
                    class="bg-gray-900 border-r-4 border-emerald-500 p-4 rounded-lg shadow-lg flex items-center justify-between">
                    <div class="flex items-center text-white">
                        <svg class="w-6 h-6 text-emerald-500 ml-3" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <span class="font-bold">{{ session('success') }}</span>
                    </div>
                </div>
            @endif

            {{-- 3. بانر المتدرب (بطاقة داكنة مميزة) --}}
            @role('member')
                <div class="bg-gray-900 rounded-2xl p-8 shadow-2xl border border-gray-800 relative overflow-hidden group">
                    {{-- تأثير إضاءة خلفي --}}
                    <div
                        class="absolute top-0 right-0 w-64 h-64 bg-indigo-600/20 rounded-full blur-3xl -mr-16 -mt-16 pointer-events-none">
                    </div>

                    <div class="relative z-10 flex flex-col md:flex-row items-center justify-between gap-6 text-right">
                        <div>
                            <span
                                class="inline-block px-3 py-1 rounded-full bg-indigo-500/20 text-indigo-300 text-xs font-bold border border-indigo-500/30 mb-3">
                                خاص بك
                            </span>
                            <h3 class="text-2xl font-bold text-white mb-2">الوجبات الموصى بها لك</h3>
                            <p class="text-gray-400 max-w-lg">
                                قام مدربك باختيار هذه الوجبات خصيصاً لتناسب احتياجاتك.
                            </p>
                        </div>
                        <a href="{{ route('meal-plans.my-recommended') }}"
                            class="bg-indigo-600 text-white px-8 py-3 rounded-xl font-bold hover:bg-indigo-500 transition shadow-lg shadow-indigo-900/50 flex items-center border border-indigo-500">
                            عرض خطتي
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                            </svg>
                        </a>
                    </div>
                </div>
            @endrole

            {{-- 4. شبكة الوجبات (البطاقات الداكنة) --}}
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @forelse($plans as $plan)
                    {{-- البطاقة: خلفية داكنة (نظامنا السابق) --}}
                    <div x-data="{ recommendOpen: false }"
                        class="bg-gray-900 rounded-2xl border border-gray-800 shadow-xl flex flex-col overflow-hidden hover:border-gray-600 transition-colors duration-300">

                        {{-- صورة الوجبة --}}
                        <div class="h-56 w-full relative bg-gray-800">
                            @if ($plan->image)
                                <img src="{{ Storage::url($plan->image->path) }}" alt="{{ $plan->name }}"
                                    class="w-full h-full object-cover opacity-90 group-hover:opacity-100 transition">
                            @else
                                <div class="w-full h-full flex items-center justify-center text-gray-600">
                                    <svg class="w-16 h-16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                            d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z">
                                        </path>
                                    </svg>
                                </div>
                            @endif
                        </div>

                        {{-- محتوى البطاقة --}}
                        <div class="p-6 flex-1 flex flex-col">

                            {{-- شريط المعلومات (لمنع تداخل الكتابة) --}}
                            <div class="flex flex-wrap items-center gap-2 mb-3">
                                <span
                                    class="bg-emerald-500/10 text-emerald-400 px-3 py-1 rounded-lg text-sm font-bold border border-emerald-500/20 flex items-center gap-1">
                                    <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M13 10V3L4 14h7v7l9-11h-7z" />
                                    </svg>
                                    {{ $plan->calories }} سعرة
                                </span>
                                <span
                                    class="bg-indigo-500/10 text-indigo-300 px-3 py-1 rounded-lg text-sm font-bold border border-indigo-500/20">
                                    ${{ $plan->price }}
                                </span>
                            </div>

                            <h3 class="text-xl font-bold text-white mb-2 leading-snug">
                                {{ $plan->name }}
                            </h3>

                            <p class="text-gray-400 text-sm leading-relaxed mb-6 line-clamp-3">
                                {{ $plan->description }}
                            </p>

                            <div class="mt-auto pt-4 border-t border-gray-800">
                                {{-- أزرار التحكم --}}
                                <div class="flex gap-3">
                                    <a href="{{ route('meal-plans.show', $plan->id) }}"
                                        class="flex-1 bg-gray-800 hover:bg-gray-700 text-white font-bold py-2.5 rounded-lg text-sm text-center transition border border-gray-700">
                                        التفاصيل
                                    </a>

                                    @hasanyrole('admin|trainer')
                                        {{-- زر التوصية (يفتح القائمة) --}}
                                        <button @click="recommendOpen = !recommendOpen"
                                            :class="recommendOpen ? 'bg-indigo-600 text-white border-indigo-500' :
                                                'bg-gray-800 text-indigo-400 hover:bg-gray-700 border-gray-700'"
                                            class="flex-1 font-bold py-2.5 rounded-lg text-sm text-center transition border flex items-center justify-center gap-2">
                                            <span x-text="recommendOpen ? 'إغلاق' : 'توصية'"></span>
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z">
                                                </path>
                                            </svg>
                                        </button>

                                        {{-- أزرار التعديل والحذف --}}
                                        <div class="flex gap-1">
                                            <a href="{{ route('meal-plans.edit', $plan->id) }}"
                                                class="p-2.5 text-gray-400 hover:text-white bg-gray-800 hover:bg-gray-700 rounded-lg border border-gray-700 transition">
                                                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24"
                                                    stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                                                    </path>
                                                </svg>
                                            </a>
                                            <form action="{{ route('meal-plans.destroy', $plan->id) }}" method="POST"
                                                onsubmit="return confirm('هل أنت متأكد؟')">
                                                @csrf @method('DELETE')
                                                <button type="submit"
                                                    class="p-2.5 text-gray-400 hover:text-red-500 bg-gray-800 hover:bg-gray-700 rounded-lg border border-gray-700 transition">
                                                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24"
                                                        stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                                        </path>
                                                    </svg>
                                                </button>
                                            </form>
                                        </div>
                                    @endhasanyrole
                                </div>
                            </div>

                            {{-- قسم التوصية المنزلق (مدمج وواسع) --}}
                            @hasanyrole('admin|trainer')
                                <div x-show="recommendOpen" style="display: none;"
                                    x-transition:enter="transition ease-out duration-200"
                                    x-transition:enter-start="opacity-0 -translate-y-2"
                                    x-transition:enter-end="opacity-100 translate-y-0"
                                    class="mt-4 pt-4 border-t border-gray-700">
                                    <form action="{{ route('meal-plans.recommend') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="meal_plan_id" value="{{ $plan->id }}">

                                        <label class="block text-xs font-bold text-gray-400 mb-2">اختر المتدربين:</label>

                                        {{-- قائمة اختيار داكنة وواسعة --}}
                                        <select name="user_ids[]" required multiple
                                            class="w-full bg-gray-800 border border-gray-700 text-gray-300 text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block p-2.5 min-h-[120px] mb-3 scrollbar-dark">
                                            @foreach ($trainees as $trainee)
                                                <option value="{{ $trainee->id }}"
                                                    class="py-1 px-2 hover:bg-gray-700 rounded cursor-pointer">
                                                    {{ $trainee->name }}</option>
                                            @endforeach
                                        </select>

                                        <button type="submit"
                                            class="w-full bg-indigo-600 hover:bg-indigo-500 text-white font-bold py-2.5 px-4 rounded-lg shadow-lg transition flex justify-center items-center gap-2">
                                            <span>إرسال التوصية الآن</span>
                                            <svg class="w-4 h-4 rtl:rotate-180" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            @endhasanyrole

                        </div>
                    </div>
                @empty
                    {{-- حالة عدم وجود بيانات --}}
                    <div
                        class="col-span-full py-16 text-center bg-gray-900 rounded-2xl border border-gray-800 shadow-xl">
                        <div
                            class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-gray-800 mb-4 border border-gray-700">
                            <svg class="w-8 h-8 text-gray-500" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4">
                                </path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-white">المكتبة فارغة</h3>
                        <p class="text-gray-400 mt-2">لا توجد وجبات حالياً. ابدأ بإضافة أول وجبة.</p>
                    </div>
                @endforelse
            </div>

            {{-- 5. التصفح (Pagination) --}}
            <div class="mt-8 flex justify-center dir-ltr">
                {{ $plans->links() }}
            </div>

        </div>
    </div>
</x-app-layout>
