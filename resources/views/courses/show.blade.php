@role('admin')
<x-app-layout>
    <div class="py-12">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">

            {{-- Header & Back Button --}}
            <div class="flex items-center justify-between">
                <div>
                    <h2 class="text-3xl font-bold text-gray-100 mb-2">تفاصيل الكورس</h2>
                    <p class="text-gray-400">استعراض المعلومات الكاملة للبرنامج التدريبي.</p>
                </div>
                <a href="{{ route('courses.index') }}"
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

            {{-- Course Details Card --}}
            <div class="bg-gray-900 border border-gray-800 rounded-2xl overflow-hidden shadow-2xl">

                {{-- 1. Hero Section: Name & Price --}}
                <div class="relative p-8 border-b border-gray-800 bg-gray-800/30 overflow-hidden">
                    {{-- Decorative Background Blur --}}
                    <div
                        class="absolute top-0 left-0 w-32 h-32 bg-indigo-600/10 rounded-full blur-3xl pointer-events-none">
                    </div>

                    <div
                        class="relative z-10 flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
                        <div>
                            <span class="text-indigo-400 text-xs font-bold tracking-wider uppercase mb-1 block">اسم
                                البرنامج</span>
                            <h1 class="text-3xl font-black text-white">{{ $course->name }}</h1>
                        </div>
                        <div class="flex flex-col items-end">
                            <span class="text-gray-400 text-xs font-bold tracking-wider uppercase mb-1">السعر
                                الكلي</span>
                            <span class="text-4xl font-black text-emerald-400 drop-shadow-sm">
                                ${{ number_format($course->total_price, 2) }}
                            </span>
                        </div>
                    </div>
                </div>

                <div class="p-8 grid grid-cols-1 md:grid-cols-3 gap-8">

                    {{-- 2. Description (Takes 2/3 width) --}}
                    <div class="md:col-span-2 space-y-4">
                        <h4 class="text-lg font-bold text-white flex items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-indigo-500" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 6h16M4 12h16M4 18h7" />
                            </svg>
                            وصف الكورس
                        </h4>
                        <div class="p-6 bg-gray-800/50 rounded-xl border border-gray-700/50">
                            <p class="text-gray-300 leading-relaxed whitespace-pre-line">
                                {{ $course->description ?: 'لا يوجد وصف متاح لهذا الكورس.' }}
                            </p>
                        </div>
                    </div>

                    {{-- 3. Trainer Info (Takes 1/3 width) --}}
                    <div class="space-y-4">
                        <h4 class="text-lg font-bold text-white flex items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-indigo-500" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                            المدرب المسؤول
                        </h4>

                        <div
                            class="p-5 bg-gray-800 rounded-xl border border-gray-700 flex flex-col items-center text-center">
                            @if ($course->trainerProfile)
                                <div
                                    class="w-20 h-20 rounded-full bg-indigo-600 flex items-center justify-center text-white text-3xl font-bold mb-3 shadow-lg border-4 border-gray-700">
                                    {{ substr($course->trainerProfile->user->name, 0, 1) }}
                                </div>
                                <h5 class="text-xl font-bold text-white mb-1">{{ $course->trainerProfile->user->name }}
                                </h5>
                                <span
                                    class="text-indigo-400 text-sm font-medium bg-indigo-500/10 px-3 py-1 rounded-full border border-indigo-500/20">
                                    {{ $course->trainerProfile->specialization ?? 'مدرب عام' }}
                                </span>
                                <p class="text-gray-500 text-sm mt-3">{{ $course->trainerProfile->user->email }}</p>
                            @else
                                <div
                                    class="w-20 h-20 rounded-full bg-gray-700 flex items-center justify-center text-gray-500 mb-3 border-4 border-gray-600">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636" />
                                    </svg>
                                </div>
                                <h5 class="text-gray-400 font-bold">غير محدد</h5>
                                <p class="text-gray-500 text-sm mt-1">لم يتم تعيين مدرب بعد</p>
                            @endif
                        </div>
                    </div>

                </div>

                {{-- 4. Actions Footer --}}
                <div class="p-6 bg-gray-800/50 border-t border-gray-800 flex justify-end gap-4">
                    {{-- Edit --}}
                    <a href="{{ route('courses.edit', $course->id) }}"
                        class="bg-indigo-600 hover:bg-indigo-500 text-white px-6 py-3 rounded-xl font-bold transition duration-300 shadow-lg shadow-indigo-500/20 flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                            <path
                                d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                        </svg>
                        تعديل الكورس
                    </a>

                    {{-- Delete --}}
                    <form action="{{ route('courses.destroy', $course->id) }}" method="POST"
                        onsubmit="return confirm('هل أنت متأكد من حذف هذا الكورس نهائياً؟');">
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
                            حذف الكورس
                        </button>
                    </form>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
@endrole