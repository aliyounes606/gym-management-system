<x-app-layout>
    <div class="py-12">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">

            {{-- Header & Back Button --}}
            <div class="flex items-center justify-between">
                <div>
                    <h2 class="text-3xl font-bold text-gray-100 mb-2">إضافة جلسة جديدة</h2>
                    <p class="text-gray-400">جدولة حصة تدريبية جديدة وتحديد تفاصيلها.</p>
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
                    <span>إلغاء وعودة</span>
                </a>
            </div>

            {{-- Error Alerts --}}
            @if ($errors->any())
                <div class="p-4 rounded-xl bg-red-900/80 border border-red-700 text-red-100 shadow-lg animate-pulse">
                    <ul class="list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{-- Create Session Form Card --}}
            <div class="bg-gray-900 border border-gray-800 rounded-2xl overflow-hidden shadow-2xl">

                {{-- Card Header --}}
                <div class="p-6 border-b border-gray-800 bg-gray-800/30 flex items-center gap-3">
                    <div class="p-2 bg-indigo-500/20 rounded-lg text-indigo-400">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                    </div>
                    <h3 class="text-lg font-bold text-white">تفاصيل الجلسة</h3>
                </div>

                <div class="p-8">
                    <form action="{{ route('gymsessions.store') }}" method="POST">
                        @csrf

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">

                            {{-- Title --}}
                            <div class="md:col-span-2 space-y-2">
                                <label class="text-sm font-bold text-gray-300">عنوان الجلسة</label>
                                <input type="text" name="title" value="{{ old('title') }}" required
                                    placeholder="مثال: حصة يوغا صباحية"
                                    class="w-full bg-gray-800 border border-gray-700 text-white rounded-xl focus:border-indigo-500 focus:ring-indigo-500 py-3 px-4 transition duration-200 placeholder-gray-500">
                            </div>

                            {{-- Category --}}
                            <div class="space-y-2">
                                <label class="text-sm font-bold text-gray-300">الفئة (Category)</label>
                                <select name="category_id"
                                    class="w-full bg-gray-800 border border-gray-700 text-white rounded-xl focus:border-indigo-500 focus:ring-indigo-500 py-3 px-4 transition duration-200">
                                    <option value="">-- اختر الفئة --</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}"
                                            {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            {{-- Course --}}
                            <div class="space-y-2">
                                <label class="text-sm font-bold text-gray-300">تابع لكورس (اختياري)</label>
                                <select name="course_id"
                                    class="w-full bg-gray-800 border border-gray-700 text-white rounded-xl focus:border-indigo-500 focus:ring-indigo-500 py-3 px-4 transition duration-200">
                                    <option value="">-- اختر الكورس --</option>
                                    @foreach ($courses as $course)
                                        <option value="{{ $course->id }}"
                                            {{ old('course_id') == $course->id ? 'selected' : '' }}>
                                            {{ $course->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            {{-- Trainer --}}
                            <div class="md:col-span-2 space-y-2">
                                <label class="text-sm font-bold text-gray-300">المدرب المسؤول</label>
                                <select name="trainer_profile_id"
                                    class="w-full bg-gray-800 border border-gray-700 text-white rounded-xl focus:border-indigo-500 focus:ring-indigo-500 py-3 px-4 transition duration-200">
                                    <option value="">-- بدون مدرب --</option>
                                    @foreach ($trainerProfiles as $trainer)
                                        <option value="{{ $trainer->id }}"
                                            {{ old('trainer_profile_id') == $trainer->id ? 'selected' : '' }}>
                                            {{ $trainer->user->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            {{-- Price --}}
                            <div class="space-y-2">
                                <label class="text-sm font-bold text-gray-300">سعر الجلسة</label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <span class="text-gray-500 font-bold">$</span>
                                    </div>
                                    <input type="number" name="single_price" step="0.01"
                                        value="{{ old('single_price') }}" required placeholder="0.00"
                                        class="w-full bg-gray-800 border border-gray-700 text-white rounded-xl focus:border-indigo-500 focus:ring-indigo-500 py-3 px-4 pl-8 transition duration-200 placeholder-gray-500">
                                </div>
                            </div>

                            {{-- Capacity --}}
                            <div class="space-y-2">
                                <label class="text-sm font-bold text-gray-300">السعة القصوى</label>
                                <div class="relative">
                                    <input type="number" name="max_capacity" value="{{ old('max_capacity') }}"
                                        required placeholder="0"
                                        class="w-full bg-gray-800 border border-gray-700 text-white rounded-xl focus:border-indigo-500 focus:ring-indigo-500 py-3 px-4 pl-12 transition duration-200 placeholder-gray-500">
                                    <span
                                        class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-500 text-sm font-bold">شخص</span>
                                </div>
                            </div>

                            {{-- Start Time --}}
                            <div class="space-y-2">
                                <label class="text-sm font-bold text-gray-300">وقت البداية</label>
                                <input type="datetime-local" name="start_time" value="{{ old('start_time') }}" required
                                    class="w-full bg-gray-800 border border-gray-700 text-white rounded-xl focus:border-indigo-500 focus:ring-indigo-500 py-3 px-4 transition duration-200 [color-scheme:dark]">
                            </div>

                            {{-- End Time --}}
                            <div class="space-y-2">
                                <label class="text-sm font-bold text-gray-300">وقت النهاية</label>
                                <input type="datetime-local" name="end_time" value="{{ old('end_time') }}" required
                                    class="w-full bg-gray-800 border border-gray-700 text-white rounded-xl focus:border-indigo-500 focus:ring-indigo-500 py-3 px-4 transition duration-200 [color-scheme:dark]">
                            </div>

                        </div>

                        {{-- Submit Button --}}
                        <div class="mt-8 pt-6 border-t border-gray-800 flex justify-end">
                            <button type="submit"
                                class="bg-indigo-600 hover:bg-indigo-500 text-white px-8 py-3 rounded-xl font-bold transition duration-300 shadow-lg shadow-indigo-500/20 flex items-center gap-2 transform hover:-translate-y-1">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
                                    fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-11a1 1 0 10-2 0v2H7a1 1 0 100 2h2v2a1 1 0 102 0v-2h2a1 1 0 100-2h-2V7z"
                                        clip-rule="evenodd" />
                                </svg>
                                حفظ الجلسة
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
