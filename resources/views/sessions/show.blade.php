<x-app-layout>
    <div class="py-12">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">

            {{-- Header & Back Button --}}
            <div class="flex items-center justify-between">
                <div>
                    <h2 class="text-3xl font-bold text-gray-100 mb-2">تفاصيل الجلسة</h2>
                    <p class="text-gray-400">عرض المعلومات الكاملة للحصة التدريبية.</p>
                </div>
                <a href="{{ route('gymsessions.index') }}"
                    class="text-gray-400 hover:text-white transition flex items-center gap-2 group">
                    <div
                        class="p-2 bg-gray-800 rounded-lg group-hover:bg-gray-700 transition border border-gray-700 group-hover:border-gray-600">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M10 18a8 8 0 100-16 8 8 0 000 16zm.707-10.293a1 1 0 00-1.414-1.414l-3 3a1 1 0 000 1.414l3 3a1 1 0 001.414-1.414L9.414 11H13a1 1 0 100-2H9.414l1.293-1.293z"
                                clip-rule="evenodd" />
                        </svg>
                    </div>
                    <span>عودة للقائمة</span>
                </a>
            </div>

            {{-- Session Details Card --}}
            <div class="bg-gray-900 border border-gray-800 rounded-2xl overflow-hidden shadow-2xl">

                {{-- 1. Hero Section: Title & Price --}}
                <div class="relative p-8 border-b border-gray-800 bg-gray-800/30">
                    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
                        <div>
                            <span class="text-indigo-400 text-xs font-bold tracking-wider uppercase mb-1 block">عنوان
                                الجلسة</span>
                            <h1 class="text-3xl font-black text-white">{{ $session->title }}</h1>
                        </div>
                        <div class="flex flex-col items-end">
                            <span class="text-gray-400 text-xs font-bold tracking-wider uppercase mb-1">سعر
                                الحضور</span>
                            <span class="text-4xl font-black text-emerald-400 drop-shadow-sm">
                                ${{ number_format($session->single_price, 2) }}
                            </span>
                        </div>
                    </div>
                </div>

                <div class="p-8 grid grid-cols-1 md:grid-cols-2 gap-8">

                    {{-- 2. General Info --}}
                    <div class="space-y-6">
                        <h4 class="text-lg font-bold text-white flex items-center gap-2 border-b border-gray-800 pb-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-indigo-500" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            المعلومات الأساسية
                        </h4>

                        <div class="space-y-4">
                            {{-- Course --}}
                            <div
                                class="flex justify-between items-center bg-gray-800/50 p-4 rounded-xl border border-gray-700">
                                <span class="text-gray-400 text-sm">الكورس التابع له</span>
                                <span class="text-white font-bold">{{ $session->course->name ?? 'غير محدد' }}</span>
                            </div>

                            {{-- Category --}}
                            <div
                                class="flex justify-between items-center bg-gray-800/50 p-4 rounded-xl border border-gray-700">
                                <span class="text-gray-400 text-sm">الفئة</span>
                                <span
                                    class="bg-indigo-500/10 text-indigo-300 px-3 py-1 rounded-lg text-sm font-bold border border-indigo-500/20">
                                    {{ $session->category->name ?? 'عام' }}
                                </span>
                            </div>

                            {{-- Capacity --}}
                            <div
                                class="flex justify-between items-center bg-gray-800/50 p-4 rounded-xl border border-gray-700">
                                <span class="text-gray-400 text-sm">السعة القصوى</span>
                                <div class="flex items-center gap-2 text-white font-bold">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0z" />
                                    </svg>
                                    {{ $session->max_capacity }} شخص
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- 3. Timing & Trainer --}}
                    <div class="space-y-6">
                        <h4 class="text-lg font-bold text-white flex items-center gap-2 border-b border-gray-800 pb-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-indigo-500" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            التوقيت والمدرب
                        </h4>

                        {{-- Time Card --}}
                        <div class="bg-gray-800/50 p-4 rounded-xl border border-gray-700 flex flex-col gap-4">
                            <div class="flex justify-between items-center border-b border-gray-700 pb-3">
                                <span class="text-gray-400 text-sm">يبدأ في</span>
                                <span class="text-white font-mono dir-ltr">
                                    {{ \Carbon\Carbon::parse($session->start_time)->format('Y-m-d h:i A') }}
                                </span>
                            </div>
                            <div class="flex justify-between items-center">
                                <span class="text-gray-400 text-sm">ينتهي في</span>
                                <span class="text-white font-mono dir-ltr">
                                    {{ \Carbon\Carbon::parse($session->end_time)->format('Y-m-d h:i A') }}
                                </span>
                            </div>
                        </div>

                        {{-- Trainer Card --}}
                        <div class="bg-gray-800 p-4 rounded-xl border border-gray-700 flex items-center gap-4">
                            <div
                                class="w-12 h-12 rounded-full bg-indigo-600 flex items-center justify-center text-white text-xl font-bold shadow-lg">
                                {{ substr($session->trainer->user->name ?? '؟', 0, 1) }}
                            </div>
                            <div>
                                <span class="text-xs text-indigo-400 font-bold block uppercase">المدرب المسؤول</span>
                                <h5 class="text-lg font-bold text-white">
                                    {{ $session->trainer->user->name ?? 'غير محدد' }}
                                </h5>
                            </div>
                        </div>
                    </div>

                </div>

                {{-- 4. Actions Footer --}}
                <div class="p-6 bg-gray-800/50 border-t border-gray-800 flex justify-end gap-4">
                    {{-- Edit --}}
                    <a href="{{ route('gymsessions.edit', $session->id) }}"
                        class="bg-indigo-600 hover:bg-indigo-500 text-white px-6 py-3 rounded-xl font-bold transition duration-300 shadow-lg shadow-indigo-500/20 flex items-center gap-2 transform hover:-translate-y-1">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                            <path
                                d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                        </svg>
                        تعديل البيانات
                    </a>

                    {{-- Delete --}}
                    <form action="{{ route('gymsessions.destroy', $session->id) }}" method="POST"
                        onsubmit="return confirm('هل أنت متأكد من حذف هذه الجلسة؟');">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                            class="bg-red-500/10 hover:bg-red-500 text-red-500 hover:text-white border border-red-500/50 px-6 py-3 rounded-xl font-bold transition duration-300 flex items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
                                fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                                    clip-rule="evenodd" />
                            </svg>
                            حذف
                        </button>
                    </form>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
