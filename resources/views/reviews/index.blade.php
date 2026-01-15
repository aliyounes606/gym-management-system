<x-app-layout>
    {{-- خلفية فاتحة للصفحة كاملة --}}
    <div class="py-12 bg-gray-50 min-h-screen" dir="rtl">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-10">

            {{-- الهيدر --}}
            <div class="flex items-center justify-between border-b border-gray-200 pb-6">
                <div>
                    <h2 class="text-3xl font-black text-gray-800 tracking-tight">
                        نظام التقييمات والمراجعات ⭐
                    </h2>
                    <p class="text-gray-500 mt-1 text-lg">
                        إدارة ومتابعة آراء المتدربين في مختلف خدمات النادي.
                    </p>
                </div>
            </div>

            {{-- رسائل النجاح --}}
            @if (session('success'))
                <div class="bg-gray-900 border-r-4 border-emerald-500 p-4 rounded-lg shadow-lg flex items-center gap-3">
                    <svg class="w-6 h-6 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <span class="text-white font-bold">{{ session('success') }}</span>
                </div>
            @endif

            {{-- شبكة بطاقات التقييم (Navigation Grid) --}}
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">

                {{-- 1. تقييمات المدربين --}}
                <a href="{{ route('reviews.trainers.index') }}"
                    class="group relative overflow-hidden bg-gray-900 rounded-2xl p-6 shadow-xl border border-gray-800 hover:border-indigo-500 hover:-translate-y-1 transition-all duration-300">
                    <div
                        class="absolute top-0 right-0 w-24 h-24 bg-indigo-500/10 rounded-bl-full -mr-4 -mt-4 transition-all group-hover:bg-indigo-500/20">
                    </div>

                    <div class="relative z-10 flex flex-col items-center text-center">
                        <div
                            class="w-16 h-16 bg-indigo-900/50 rounded-2xl flex items-center justify-center mb-4 border border-indigo-500/30 group-hover:bg-indigo-600 transition-colors shadow-lg shadow-indigo-900/50">
                            <svg class="w-8 h-8 text-indigo-400 group-hover:text-white transition-colors" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-white mb-2">المدربين</h3>
                        <p class="text-sm text-gray-400 leading-relaxed">آراء المتدربين وأدائهم مع المدربين</p>
                    </div>
                </a>

                {{-- 2. تقييمات الوجبات --}}
                <a href="{{ route('reviews.mealplans.index') }}"
                    class="group relative overflow-hidden bg-gray-900 rounded-2xl p-6 shadow-xl border border-gray-800 hover:border-emerald-500 hover:-translate-y-1 transition-all duration-300">
                    <div
                        class="absolute top-0 right-0 w-24 h-24 bg-emerald-500/10 rounded-bl-full -mr-4 -mt-4 transition-all group-hover:bg-emerald-500/20">
                    </div>

                    <div class="relative z-10 flex flex-col items-center text-center">
                        <div
                            class="w-16 h-16 bg-emerald-900/50 rounded-2xl flex items-center justify-center mb-4 border border-emerald-500/30 group-hover:bg-emerald-600 transition-colors shadow-lg shadow-emerald-900/50">
                            <svg class="w-8 h-8 text-emerald-400 group-hover:text-white transition-colors"
                                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-white mb-2">وجبات الطعام</h3>
                        <p class="text-sm text-gray-400 leading-relaxed">تقييمات الأنظمة الغذائية والوجبات</p>
                    </div>
                </a>

                {{-- 3. تقييمات الكورسات --}}
                <a href="{{ route('reviews.courses.index') }}"
                    class="group relative overflow-hidden bg-gray-900 rounded-2xl p-6 shadow-xl border border-gray-800 hover:border-orange-500 hover:-translate-y-1 transition-all duration-300">
                    <div
                        class="absolute top-0 right-0 w-24 h-24 bg-orange-500/10 rounded-bl-full -mr-4 -mt-4 transition-all group-hover:bg-orange-500/20">
                    </div>

                    <div class="relative z-10 flex flex-col items-center text-center">
                        <div
                            class="w-16 h-16 bg-orange-900/50 rounded-2xl flex items-center justify-center mb-4 border border-orange-500/30 group-hover:bg-orange-600 transition-colors shadow-lg shadow-orange-900/50">
                            <svg class="w-8 h-8 text-orange-400 group-hover:text-white transition-colors" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-white mb-2">الكورسات</h3>
                        <p class="text-sm text-gray-400 leading-relaxed">مراجعات الدورات والبرامج التعليمية</p>
                    </div>
                </a>

                {{-- 4. تقييمات الجلسات --}}
                <a href="{{ route('reviews.gymsessions.index') }}"
                    class="group relative overflow-hidden bg-gray-900 rounded-2xl p-6 shadow-xl border border-gray-800 hover:border-purple-500 hover:-translate-y-1 transition-all duration-300">
                    <div
                        class="absolute top-0 right-0 w-24 h-24 bg-purple-500/10 rounded-bl-full -mr-4 -mt-4 transition-all group-hover:bg-purple-500/20">
                    </div>

                    <div class="relative z-10 flex flex-col items-center text-center">
                        <div
                            class="w-16 h-16 bg-purple-900/50 rounded-2xl flex items-center justify-center mb-4 border border-purple-500/30 group-hover:bg-purple-600 transition-colors shadow-lg shadow-purple-900/50">
                            <svg class="w-8 h-8 text-purple-400 group-hover:text-white transition-colors" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-white mb-2">الجلسات</h3>
                        <p class="text-sm text-gray-400 leading-relaxed">تقييم الجلسات التدريبية والاستشارية</p>
                    </div>
                </a>

            </div>

            {{-- قسم توضيحي (فارغ) --}}
            <div class="bg-white rounded-3xl border border-gray-200 shadow-sm p-12 text-center">
                <div class="inline-flex items-center justify-center w-20 h-20 bg-gray-100 rounded-full mb-6">
                    <svg class="w-10 h-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <h3 class="text-2xl font-bold text-gray-800">ابدأ باستعراض التقييمات</h3>
                <p class="text-gray-500 mt-2 max-w-lg mx-auto text-lg">
                    اختر أحد التصنيفات في الأعلى لعرض التفاصيل الكاملة للمراجعات والتحكم بها.
                </p>
            </div>

        </div>
    </div>
</x-app-layout>
