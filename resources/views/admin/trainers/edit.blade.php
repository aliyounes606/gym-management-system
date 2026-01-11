<x-app-layout>
    <div class="py-12">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">

            {{-- Header & Back Button --}}
            <div class="flex items-center justify-between">
                <div>
                    <h2 class="text-3xl font-bold text-gray-100 mb-2">تعديل بيانات المدرب</h2>
                    <p class="text-gray-400">تحديث المعلومات المهنية للمدرب.</p>
                </div>
                <a href="{{ route('admin.trainers.index') }}"
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

            {{-- Edit Card --}}
            <div class="bg-gray-900 border border-gray-800 rounded-2xl overflow-hidden shadow-2xl">

                {{-- Trainer Info Badge (للتأكيد على هوية المدرب) --}}
                <div class="p-6 border-b border-gray-800 bg-gray-800/30 flex items-center gap-4">
                    <div
                        class="w-16 h-16 rounded-full bg-indigo-600 flex items-center justify-center text-white text-2xl font-bold border-4 border-gray-900 shadow-lg">
                        {{ substr($trainer->user->name, 0, 1) }}
                    </div>
                    <div>
                        <h3 class="text-xl font-bold text-white">{{ $trainer->user->name }}</h3>
                        <p class="text-indigo-400 text-sm">{{ $trainer->user->email }}</p>
                    </div>
                </div>

                <div class="p-8">
                    <form action="{{ route('admin.trainers.update', $trainer->id) }}"
                        method="POST"enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">

                            {{-- Specialization --}}
                            <div class="space-y-2">
                                <label class="text-sm font-bold text-gray-300 flex items-center gap-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-indigo-500"
                                        viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd"
                                            d="M17.707 9.293a1 1 0 010 1.414l-7 7a1 1 0 01-1.414 0l-7-7A.997.997 0 012 10V5a3 3 0 013-3h5c.256 0 .512.098.707.293l7 7zM5 6a1 1 0 100-2 1 1 0 000 2z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    التخصص
                                </label>
                                <input type="text" name="specialization"
                                    value="{{ old('specialization', $trainer->specialization) }}"
                                    placeholder="مثال: كمال أجسام"
                                    class="w-full bg-gray-800 border border-gray-700 text-white rounded-xl focus:border-indigo-500 focus:ring-indigo-500 py-3 px-4 transition duration-200">
                            </div>

                            {{-- Experience --}}
                            <div class="space-y-2">
                                <label class="text-sm font-bold text-gray-300 flex items-center gap-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-indigo-500"
                                        viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd"
                                            d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    سنوات الخبرة
                                </label>
                                <div class="relative">
                                    <input type="number" name="experience_years"
                                        value="{{ old('experience_years', $trainer->experience_years) }}"
                                        class="w-full bg-gray-800 border border-gray-700 text-white rounded-xl focus:border-indigo-500 focus:ring-indigo-500 py-3 px-4 pl-12 transition duration-200">
                                    <span
                                        class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-500 text-sm font-bold">سنة</span>
                                </div>
                            </div>

                            {{-- Bio --}}
                            <div class="md:col-span-2 space-y-2">
                                <label class="text-sm font-bold text-gray-300 flex items-center gap-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-indigo-500"
                                        viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd"
                                            d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    السيرة الذاتية (Bio)
                                </label>
                                <textarea name="bio" rows="5"
                                    class="w-full bg-gray-800 border border-gray-700 text-white rounded-xl focus:border-indigo-500 focus:ring-indigo-500 py-3 px-4 transition duration-200">{{ old('bio', $trainer->bio) }}</textarea>
                            </div>
                            {{-- Current Image Preview --}}
                            <div class="space-y-2">
                                <label class="text-sm font-bold text-gray-300">الصورة الحالية</label>
                                <div
                                    class="p-4 border border-gray-700 bg-gray-800 rounded-xl flex items-center justify-center h-48">
                                    @if ($trainer->image)
                                        <img src="{{ Storage::url($trainer->image->path) }}" alt="Current Image"
                                            class="max-h-full max-w-full rounded shadow-lg object-contain">
                                    @else
                                        <div class="flex flex-col items-center text-gray-500">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mb-2 opacity-50"
                                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                            </svg>
                                            <span class="text-xs">لا توجد صورة حالياً</span>
                                        </div>
                                    @endif
                                </div>
                            </div>
                            {{-- Upload New Image --}}
                            <div class="space-y-2">
                                <label class="text-sm font-bold text-gray-300">تحديث الصورة (اختياري)</label>
                                <label
                                    class="flex flex-col items-center justify-center w-full h-48 border-2 border-gray-700 border-dashed rounded-xl cursor-pointer bg-gray-800 hover:bg-gray-750 hover:border-indigo-500 transition duration-300 group">
                                    <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                        <svg class="w-10 h-10 mb-3 text-gray-400 group-hover:text-indigo-400 transition"
                                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12">
                                            </path>
                                        </svg>
                                        <p class="mb-2 text-sm text-gray-400"><span
                                                class="font-bold text-indigo-400">اضغط لرفع صورة جديدة</span></p>
                                        <p class="text-xs text-gray-500">سيتم استبدال الصورة القديمة</p>
                                    </div>
                                    <input type="file" name="image" accept="image/*" class="hidden"
                                        onchange="document.getElementById('file-name-edit').innerText = this.files[0].name">
                                </label>
                                <p id="file-name-edit" class="text-xs text-indigo-400 text-center h-4"></p>
                            </div>

                        </div>

                        {{-- Action Buttons --}}
                        <div class="mt-8 pt-6 border-t border-gray-800 flex justify-end gap-4">

                            {{-- Save Button --}}
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
