<x-app-layout>
    <div class="py-12">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">

            {{-- Header & Back Button --}}
            <div class="flex items-center justify-between">
                <div>
                    <h2 class="text-3xl font-bold text-gray-100 mb-2">إضافة معدة جديدة</h2>
                    <p class="text-gray-400">تسجيل جهاز أو أداة رياضية جديدة في النظام.</p>
                </div>
                <a href="{{ route('equipment.index') }}"
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

            {{-- Create Equipment Form --}}
            <div class="bg-gray-900 border border-gray-800 rounded-2xl overflow-hidden shadow-2xl">
                <div class="p-8">
                    <form action="{{ route('equipment.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">

                            {{-- Name --}}
                            <div class="space-y-2 md:col-span-2">
                                <label class="text-sm font-bold text-gray-300">اسم المعدة</label>
                                <input type="text" name="name" value="{{ old('name') }}"
                                    placeholder="مثال: جهاز مشي كهربائي (Treadmill)" required
                                    class="w-full bg-gray-800 border border-gray-700 text-white rounded-xl focus:border-indigo-500 focus:ring-indigo-500 py-3 px-4 transition duration-200 placeholder-gray-500">
                            </div>

                            {{-- Quantity (Fixed: Changed from textarea to number input) --}}
                            <div class="space-y-2">
                                <label class="text-sm font-bold text-gray-300">الكمية</label>
                                <div class="relative">
                                    <input type="number" name="quantity" value="{{ old('quantity', 1) }}"
                                        min="1" required
                                        class="w-full bg-gray-800 border border-gray-700 text-white rounded-xl focus:border-indigo-500 focus:ring-indigo-500 py-3 px-4 pl-12 transition duration-200">
                                    <span
                                        class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-500 text-sm font-bold">قطعة</span>
                                </div>
                            </div>

                            {{-- Status (Fixed: Changed from textarea to Select) --}}
                            <div class="space-y-2">
                                <label class="text-sm font-bold text-gray-300">الحالة الأولية</label>
                                <div class="relative">
                                    <select name="status"
                                        class="w-full bg-gray-800 border border-gray-700 text-white rounded-xl focus:border-indigo-500 focus:ring-indigo-500 py-3 px-4 appearance-none">
                                        <option value="active" selected>🟢 متاح (Active)</option>
                                        <option value="maintenance">🟡 صيانة (Maintenance)</option>
                                        <option value="damaged">🔴 تالف/خارج الخدمة (Damaged)</option>
                                    </select>
                                    <div
                                        class="absolute left-4 top-1/2 -translate-y-1/2 pointer-events-none text-gray-500">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
                                            fill="currentColor">
                                            <path fill-rule="evenodd"
                                                d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                </div>
                            </div>

                            {{-- Categories --}}
                            <div class="space-y-2 md:col-span-2">
                                <label class="text-sm font-bold text-gray-300 flex justify-between">
                                    <span>التصنيفات</span>
                                    <span class="text-xs text-gray-500 font-normal">اضغط Ctrl لتحديد أكثر من خيار</span>
                                </label>
                                <select name="categories[]" multiple
                                    class="w-full bg-gray-800 border border-gray-700 text-white rounded-xl focus:border-indigo-500 focus:ring-indigo-500 py-3 px-4 h-32 scrollbar-thin scrollbar-thumb-gray-600">
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}"
                                            class="p-2 hover:bg-indigo-600 rounded cursor-pointer">
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            {{-- Image Upload --}}
                            <div class="md:col-span-2 space-y-2">
                                <label class="text-sm font-bold text-gray-300">صورة المعدة</label>
                                <label
                                    class="flex flex-col items-center justify-center w-full h-32 border-2 border-gray-700 border-dashed rounded-xl cursor-pointer bg-gray-800 hover:bg-gray-750 hover:border-indigo-500 transition duration-300 group">
                                    <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                        <svg class="w-10 h-10 mb-3 text-gray-400 group-hover:text-indigo-400 transition"
                                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12">
                                            </path>
                                        </svg>
                                        <p class="mb-2 text-sm text-gray-400"><span
                                                class="font-bold text-indigo-400">اضغط للرفع</span> أو اسحب الصورة هنا
                                        </p>
                                        <p class="text-xs text-gray-500">PNG, JPG (MAX. 2MB)</p>
                                    </div>
                                    <input type="file" name="image" id="image" accept="image/*" class="hidden"
                                        onchange="document.getElementById('file-name').innerText = this.files[0].name">
                                </label>
                                <p id="file-name" class="text-xs text-indigo-400 text-center h-4"></p>
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
                                حفظ المعدة الجديدة
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
