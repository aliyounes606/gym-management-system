@hasanyrole('admin|trainer')
    <x-app-layout>
        <div class="py-12 bg-gray-50 min-h-screen" dir="rtl">
            <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">

                {{-- 1. الهيدر --}}
                <div class="flex items-center justify-between border-b border-gray-200 pb-6">
                    <div>
                        <h2 class="text-3xl font-black text-gray-800 tracking-tight">
                            تعديل الوجبة ✏️
                        </h2>
                        <p class="text-gray-500 mt-1">
                            تحديث بيانات الوجبة: <span class="text-emerald-600 font-bold">{{ $mealPlan->name }}</span>
                        </p>
                    </div>
                    <a href="{{ route('meal-plans.index') }}"
                        class="text-gray-500 hover:text-gray-900 transition flex items-center gap-2 group">
                        <div
                            class="p-2 bg-white border border-gray-300 rounded-lg group-hover:bg-gray-100 transition shadow-sm">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 rtl:rotate-180" viewBox="0 0 20 20"
                                fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M12.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-2.293-2.293a1 1 0 010-1.414z"
                                    clip-rule="evenodd" />
                            </svg>
                        </div>
                        <span class="font-bold">إلغاء وعودة</span>
                    </a>
                </div>

                {{-- عرض الأخطاء --}}
                @if ($errors->any())
                    <div class="p-4 rounded-xl bg-red-100 border border-red-400 text-red-800 shadow-sm">
                        <ul class="list-disc list-inside space-y-1 text-sm">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                {{-- 2. بطاقة التعديل (داكنة) --}}
                <div class="bg-gray-900 border border-gray-800 rounded-2xl overflow-hidden shadow-2xl">

                    {{-- شريط عنوان الكارد --}}
                    <div class="bg-gray-800/50 px-8 py-4 border-b border-gray-800 flex items-center gap-3">
                        <span class="w-3 h-3 rounded-full bg-orange-500"></span> {{-- لون برتقالي للتعديل --}}
                        <h3 class="text-white font-bold">بيانات الوجبة الحالية</h3>
                    </div>

                    <div class="p-8">
                        <form action="{{ route('meal-plans.update', $mealPlan->id) }}" method="POST"
                            enctype="multipart/form-data" class="space-y-8">
                            @csrf
                            @method('PUT')

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">

                                {{-- اسم الوجبة --}}
                                <div class="col-span-1 md:col-span-2 space-y-2">
                                    <label class="text-sm font-bold text-gray-300">اسم الوجبة</label>
                                    <input type="text" name="name" value="{{ old('name', $mealPlan->name) }}" required
                                        class="w-full bg-gray-800 border border-gray-700 text-white rounded-xl focus:border-emerald-500 focus:ring-emerald-500 py-3 px-4 transition duration-200">
                                </div>

                                {{-- السعر --}}
                                <div class="space-y-2">
                                    <label class="text-sm font-bold text-gray-300">السعر ($)</label>
                                    <div class="relative">
                                        <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                            <span class="text-gray-500 font-bold">$</span>
                                        </div>
                                        <input type="number" name="price" step="0.01"
                                            value="{{ old('price', $mealPlan->price) }}"
                                            class="w-full bg-gray-800 border border-gray-700 text-white rounded-xl focus:border-emerald-500 focus:ring-emerald-500 py-3 px-4 pr-8 transition duration-200">
                                    </div>
                                </div>

                                {{-- السعرات --}}
                                <div class="space-y-2">
                                    <label class="text-sm font-bold text-gray-300">السعرات الحرارية</label>
                                    <div class="relative">
                                        <input type="number" name="calories"
                                            value="{{ old('calories', $mealPlan->calories) }}"
                                            class="w-full bg-gray-800 border border-gray-700 text-white rounded-xl focus:border-emerald-500 focus:ring-emerald-500 py-3 px-4 pl-16 transition duration-200">
                                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                            <span class="text-gray-500 text-xs font-bold">Kcal</span>
                                        </div>
                                    </div>
                                </div>

                                {{-- الوصف --}}
                                <div class="col-span-1 md:col-span-2 space-y-2">
                                    <label class="text-sm font-bold text-gray-300">الوصف / الملاحظات</label>
                                    <textarea name="description" rows="4" required
                                        class="w-full bg-gray-800 border border-gray-700 text-white rounded-xl focus:border-emerald-500 focus:ring-emerald-500 py-3 px-4 transition duration-200 resize-none">{{ old('description', $mealPlan->description) }}</textarea>
                                </div>

                                {{-- قسم الصورة --}}
                                <div class="col-span-1 md:col-span-2 space-y-4 pt-4 border-t border-gray-800">
                                    <label class="text-sm font-bold text-gray-300">صورة الوجبة</label>

                                    <div class="flex flex-col md:flex-row gap-6 items-start">
                                        {{-- الصورة الحالية --}}
                                        @if ($mealPlan->image->path)
                                            <div class="flex flex-col items-center gap-2">
                                                <span class="text-xs text-gray-500">الصورة الحالية</span>
                                                <div
                                                    class="w-32 h-32 rounded-xl overflow-hidden border border-gray-700 shadow-lg">
                                                    {{-- تأكد من المسار الصحيح للصورة --}}
                                                    <img src="{{ Storage::url($mealPlan->image->path) }}"
                                                        alt="current image" class="w-full h-full object-cover">
                                                </div>
                                            </div>
                                        @endif

                                        {{-- رفع صورة جديدة --}}
                                        <div class="flex-1 w-full">
                                            <label for="dropzone-file"
                                                class="flex flex-col items-center justify-center w-full h-32 border-2 border-gray-600 border-dashed rounded-xl cursor-pointer bg-gray-800 hover:bg-gray-700 hover:border-emerald-500 transition duration-300 group">
                                                <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                                    <svg class="w-8 h-8 mb-3 text-gray-400 group-hover:text-emerald-400 transition"
                                                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                                                        </path>
                                                    </svg>
                                                    <p class="mb-1 text-sm text-gray-400 group-hover:text-gray-200"><span
                                                            class="font-bold">تغيير الصورة</span> (اضغط أو اسحب)</p>
                                                </div>
                                                <input id="dropzone-file" type="file" name="image" accept="image/*"
                                                    class="hidden" onchange="previewImage(this)" />
                                            </label>

                                            {{-- معاينة الصورة الجديدة --}}
                                            <div id="image-preview"
                                                class="hidden mt-4 relative w-full h-48 rounded-xl overflow-hidden border border-gray-700 bg-black">
                                                <p
                                                    class="absolute top-2 right-2 z-10 bg-black/50 text-white text-xs px-2 py-1 rounded">
                                                    معاينة الجديدة</p>
                                                <img id="preview-img" src="#" alt="Preview"
                                                    class="w-full h-full object-contain">
                                                <button type="button" onclick="removeImage()"
                                                    class="absolute top-2 left-2 bg-red-600 text-white p-1.5 rounded-lg hover:bg-red-700 transition shadow-lg">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                                    </svg>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>

                            {{-- أزرار الحفظ --}}
                            <div class="pt-6 border-t border-gray-800 flex items-center justify-end gap-4">
                                <a href="{{ route('meal-plans.index') }}"
                                    class="px-6 py-3 rounded-xl border border-gray-600 text-gray-300 hover:bg-gray-800 hover:text-white transition font-bold">
                                    إلغاء
                                </a>
                                <button type="submit"
                                    class="bg-emerald-600 hover:bg-emerald-500 text-white px-8 py-3 rounded-xl font-bold transition duration-300 shadow-lg shadow-emerald-500/20 flex items-center gap-2 transform hover:-translate-y-1">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M5 13l4 4L19 7"></path>
                                    </svg>
                                    حفظ التعديلات
                                </button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>

        {{-- سكربت المعاينة --}}
        <script>
            function previewImage(input) {
                const previewContainer = document.getElementById('image-preview');
                const previewImg = document.getElementById('preview-img');

                if (input.files && input.files[0]) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        previewImg.src = e.target.result;
                        previewContainer.classList.remove('hidden');
                    }
                    reader.readAsDataURL(input.files[0]);
                }
            }

            function removeImage() {
                const input = document.getElementById('dropzone-file');
                const previewContainer = document.getElementById('image-preview');
                input.value = '';
                previewContainer.classList.add('hidden');
            }
        </script>
    </x-app-layout>
@endhasanyrole
