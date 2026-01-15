@role('trainer')
<x-app-layout>
    <div class="min-h-screen bg-gray-900 py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">

            {{-- 1. العنوان والترحيب --}}
            <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
                <div>
                    <h1 class="text-3xl font-bold text-white flex items-center gap-2">
                        <span>ملخص الأداء</span>
                        <span class="text-2xl">📊</span>
                    </h1>
                    <p class="text-gray-400 mt-2 text-sm md:text-base">
                        إليك إحصائياتك المحدثة حتى اللحظة، استمر في التقدم!
                    </p>
                </div>
                {{-- يمكن إضافة زر إجراء سريع هنا إذا لزم الأمر --}}
            </div>

            {{-- 2. شبكة الإحصائيات (Grid) --}}
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

                {{-- Card 1: جلسات اليوم --}}
                <div
                    class="group bg-gray-800 rounded-2xl p-6 border-b-4 border-indigo-500 shadow-lg hover:shadow-indigo-500/10 transition-all duration-300">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-400 text-xs font-bold uppercase tracking-wider mb-1">جلسات اليوم</p>
                            <p class="text-4xl font-extrabold text-white">{{ $todaySessionsCount }}</p>
                        </div>
                        <div
                            class="p-3 bg-indigo-500/10 rounded-xl text-indigo-400 group-hover:bg-indigo-500/20 transition-colors">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                    </div>
                </div>

                {{-- Card 2: الطلاب النشطين --}}
                <div
                    class="group bg-gray-800 rounded-2xl p-6 border-b-4 border-blue-500 shadow-lg hover:shadow-blue-500/10 transition-all duration-300">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-400 text-xs font-bold uppercase tracking-wider mb-1">الطلاب النشطين</p>
                            <p class="text-4xl font-extrabold text-white">{{ $activeStudentsCount }}</p>
                        </div>
                        <div
                            class="p-3 bg-blue-500/10 rounded-xl text-blue-400 group-hover:bg-blue-500/20 transition-colors">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z">
                                </path>
                            </svg>
                        </div>
                    </div>
                </div>

                {{-- Card 3: جلسات قادمة --}}
                <div
                    class="group bg-gray-800 rounded-2xl p-6 border-b-4 border-purple-500 shadow-lg hover:shadow-purple-500/10 transition-all duration-300">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-400 text-xs font-bold uppercase tracking-wider mb-1">جلسات قادمة</p>
                            <p class="text-4xl font-extrabold text-white">{{ $upcomingCount }}</p>
                        </div>
                        <div
                            class="p-3 bg-purple-500/10 rounded-xl text-purple-400 group-hover:bg-purple-500/20 transition-colors">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                                </path>
                            </svg>
                        </div>
                    </div>
                </div>

                {{-- Card 4: تم إنجازه (شهري) --}}
                <div
                    class="group bg-gray-800 rounded-2xl p-6 border-b-4 border-emerald-500 shadow-lg hover:shadow-emerald-500/10 transition-all duration-300">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-400 text-xs font-bold uppercase tracking-wider mb-1">تم إنجازه (شهري)
                            </p>
                            <p class="text-4xl font-extrabold text-white">{{ $monthSessionsCompleted }}</p>
                        </div>
                        <div
                            class="p-3 bg-emerald-500/10 rounded-xl text-emerald-400 group-hover:bg-emerald-500/20 transition-colors">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                    </div>
                </div>

                {{-- Card 5: إجمالي الشهر --}}
                <div
                    class="group bg-gray-800 rounded-2xl p-6 border-b-4 border-orange-500 shadow-lg hover:shadow-orange-500/10 transition-all duration-300">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-400 text-xs font-bold uppercase tracking-wider mb-1">إجمالي الشهر</p>
                            <p class="text-4xl font-extrabold text-white">{{ $monthSessionsTotal }}</p>
                        </div>
                        <div
                            class="p-3 bg-orange-500/10 rounded-xl text-orange-400 group-hover:bg-orange-500/20 transition-colors">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10">
                                </path>
                            </svg>
                        </div>
                    </div>
                </div>

                {{-- Card 6: نسبة الالتزام --}}
                <div
                    class="group bg-gray-800 rounded-2xl p-6 border-b-4 border-teal-500 shadow-lg hover:shadow-teal-500/10 transition-all duration-300 relative overflow-hidden">
                    <div class="flex items-center justify-between relative z-10">
                        <div>
                            <p class="text-gray-400 text-xs font-bold uppercase tracking-wider mb-1">نسبة الالتزام</p>
                            <p class="text-4xl font-extrabold text-white">{{ $completionRate }}%</p>
                        </div>
                        <div
                            class="p-3 bg-teal-500/10 rounded-xl text-teal-400 group-hover:bg-teal-500/20 transition-colors">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                            </svg>
                        </div>
                    </div>

                    {{-- شريط التقدم --}}
                    <div class="w-full bg-gray-700 h-2 rounded-full mt-4 overflow-hidden relative z-10">
                        <div class="bg-teal-500 h-2 rounded-full transition-all duration-1000 ease-out"
                            style="width: {{ $completionRate }}%"></div>
                    </div>

                    {{-- خلفية جمالية خفيفة --}}
                    <div
                        class="absolute -bottom-4 -right-4 w-24 h-24 bg-teal-500/5 rounded-full blur-2xl group-hover:bg-teal-500/10 transition-colors">
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
@endrole