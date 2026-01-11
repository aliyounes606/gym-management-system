<x-app-layout>
    <div class="py-12">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">

            {{-- Header & Back Button --}}
            <div class="flex items-center justify-between">
                <div>
                    <h2 class="text-3xl font-bold text-gray-100 mb-2">تعديل بيانات الكورس</h2>
                    <p class="text-gray-400">تحديث تفاصيل البرنامج التدريبي.</p>
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

            {{-- Edit Form Card --}}
            <div class="bg-gray-900 border border-gray-800 rounded-2xl overflow-hidden shadow-2xl">

                {{-- Card Header --}}
                <div class="p-6 border-b border-gray-800 bg-gray-800/30 flex items-center gap-3">
                    <div class="p-2 bg-indigo-500/20 rounded-lg text-indigo-400">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                        </svg>
                    </div>
                    <h3 class="text-lg font-bold text-white">تفاصيل الكورس: {{ $course->name }}</h3>
                </div>

                <div class="p-8">
                    <form action="{{ route('courses.update', $course->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">

                            {{-- Name --}}
                            <div class="space-y-2">
                                <label class="text-sm font-bold text-gray-300">اسم الكورس</label>
                                <input type="text" name="name" value="{{ old('name', $course->name) }}" required
                                    class="w-full bg-gray-800 border border-gray-700 text-white rounded-xl focus:border-indigo-500 focus:ring-indigo-500 py-3 px-4 transition duration-200">
                            </div>

                            {{-- Total Price --}}
                            <div class="space-y-2">
                                <label class="text-sm font-bold text-gray-300">السعر الكلي</label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <span class="text-gray-500 font-bold">$</span>
                                    </div>
                                    <input type="number" name="total_price" step="0.01"
                                        value="{{ old('total_price', $course->total_price) }}" required
                                        class="w-full bg-gray-800 border border-gray-700 text-white rounded-xl focus:border-indigo-500 focus:ring-indigo-500 py-3 px-4 pl-8 transition duration-200">
                                </div>
                            </div>

                            {{-- Trainer Select (Fixed UX) --}}
                            <div class="space-y-2 md:col-span-2">
                                <label class="text-sm font-bold text-gray-300 flex items-center gap-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-indigo-500"
                                        viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd"
                                            d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    المدرب المسؤول
                                </label>
                                <select name="trainer_profile_id"
                                    class="w-full bg-gray-800 border border-gray-700 text-white rounded-xl focus:border-indigo-500 focus:ring-indigo-500 py-3 px-4 transition duration-200">
                                    <option value="">-- اختر مدرباً (اختياري) --</option>
                                    @foreach ($trainerProfiles as $trainer)
                                        <option value="{{ $trainer->id }}"
                                            {{ old('trainer_profile_id', $course->trainer_profile_id) == $trainer->id ? 'selected' : '' }}>
                                            {{ $trainer->user->name }}
                                            @if ($trainer->specialization)
                                                - ({{ $trainer->specialization }})
                                            @endif
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            {{-- Description --}}
                            <div class="space-y-2 md:col-span-2">
                                <label class="text-sm font-bold text-gray-300">وصف الكورس</label>
                                <textarea name="description" rows="5"
                                    class="w-full bg-gray-800 border border-gray-700 text-white rounded-xl focus:border-indigo-500 focus:ring-indigo-500 py-3 px-4 transition duration-200">{{ old('description', $course->description) }}</textarea>
                            </div>

                        </div>

                        {{-- Submit Button --}}
                        <div class="mt-8 pt-6 border-t border-gray-800 flex justify-end gap-4">
                            <button type="submit"
                                class="bg-indigo-600 hover:bg-indigo-500 text-white px-8 py-3 rounded-xl font-bold transition duration-300 shadow-lg shadow-indigo-500/20 flex items-center gap-2 transform hover:-translate-y-1">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
                                    fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                        clip-rule="evenodd" />
                                </svg>
                                حفظ التعديلات
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
