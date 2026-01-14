@role('admin')
<x-app-layout>
    <div class="py-12">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">

            {{-- Header & Back Button --}}
            <div class="flex items-center justify-between">
                <div>
                    <h2 class="text-3xl font-bold text-gray-100 mb-2">إضافة مدرب جديد</h2>
                    <p class="text-gray-400">قم بترقية مستخدم موجود ليصبح مدرباً.</p>
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

            {{-- Create Form Card --}}
            <div class="bg-gray-900 border border-gray-800 rounded-2xl overflow-hidden shadow-2xl">

                {{-- Form Header --}}
                <div class="p-6 border-b border-gray-800 bg-gray-800/30 flex items-center gap-3">
                    <div class="p-2 bg-indigo-500/20 rounded-lg text-indigo-400">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
                        </svg>
                    </div>
                    <h3 class="text-lg font-bold text-white">بيانات المدرب الجديد</h3>
                </div>

                <div class="p-8">
                    <form action="{{ route('admin.trainers.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">

                            {{-- User Select --}}
                            <div class="space-y-2 md:col-span-2">
                                <label class="text-sm font-bold text-gray-300 flex items-center gap-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-indigo-500"
                                        viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd"
                                            d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    اختر العضو للترقية
                                </label>
                                <select name="user_id"
                                    class="w-full bg-gray-800 border border-gray-700 text-white rounded-xl focus:border-indigo-500 focus:ring-indigo-500 py-3 px-4 transition duration-200">
                                    <option value="" disabled selected>-- اختر عضواً من القائمة --</option>
                                    @foreach ($availableUsers as $u)
                                        <option value="{{ $u->id }}"
                                            {{ old('user_id') == $u->id ? 'selected' : '' }}>
                                            {{ $u->name }} ({{ $u->email }})
                                        </option>
                                    @endforeach
                                </select>
                                <p class="text-xs text-gray-500">ملاحظة: تظهر هنا فقط حسابات الأعضاء التي لم يتم ترقيتها
                                    بعد.</p>
                            </div>

                            {{-- Specialization --}}
                            <div class="space-y-2">
                                <label class="text-sm font-bold text-gray-300">التخصص</label>
                                <input type="text" name="specialization" value="{{ old('specialization') }}"
                                    placeholder="مثال: كمال أجسام، لياقة..."
                                    class="w-full bg-gray-800 border border-gray-700 text-white rounded-xl focus:border-indigo-500 focus:ring-indigo-500 py-3 px-4 transition duration-200 placeholder-gray-500">
                            </div>

                            {{-- Experience --}}
                            <div class="space-y-2">
                                <label class="text-sm font-bold text-gray-300">سنوات الخبرة</label>
                                <div class="relative">
                                    <input type="number" name="experience_years" value="{{ old('experience_years') }}"
                                        placeholder="0" min="0"
                                        class="w-full bg-gray-800 border border-gray-700 text-white rounded-xl focus:border-indigo-500 focus:ring-indigo-500 py-3 px-4 pl-12 transition duration-200 placeholder-gray-500">
                                    <span
                                        class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-500 text-sm font-bold">سنة</span>
                                </div>
                            </div>

                            {{-- Bio --}}
                            <div class="md:col-span-2 space-y-2">
                                <label class="text-sm font-bold text-gray-300">نبذة تعريفية (Bio)</label>
                                <textarea name="bio" rows="4" placeholder="اكتب وصفاً مختصراً لخبرات وشهادات المدرب..."
                                    class="w-full bg-gray-800 border border-gray-700 text-white rounded-xl focus:border-indigo-500 focus:ring-indigo-500 py-3 px-4 transition duration-200 placeholder-gray-500">{{ old('bio') }}</textarea>
                            </div>

                            {{-- Image Upload (Optional) --}}
                            {{-- أضفت هذا الحقل لأنه موجود في الكود السابق، يمكنك حذفه إذا لم يكن مطلوباً --}}
                            <div class="md:col-span-2 space-y-2">
                                <label class="text-sm font-bold text-gray-300">صورة شخصية (اختياري)</label>
                                <label
                                    class="flex flex-col items-center justify-center w-full h-32 border-2 border-gray-700 border-dashed rounded-xl cursor-pointer bg-gray-800 hover:bg-gray-750 hover:border-indigo-500 transition duration-300 group">
                                    <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                        <svg class="w-10 h-10 mb-3 text-gray-400 group-hover:text-indigo-400 transition"
                                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                                            </path>
                                        </svg>
                                        <p class="mb-2 text-sm text-gray-400"><span
                                                class="font-bold text-indigo-400">اضغط لرفع الصورة</span></p>
                                        <p class="text-xs text-gray-500">PNG, JPG (MAX. 2MB)</p>
                                    </div>
                                    <input type="file" name="image" id="image" accept="image/*" class="hidden"
                                        onchange="document.getElementById('file-name').innerText = this.files[0].name">
                                </label>
                                <p id="file-name" class="text-xs text-indigo-400 text-center h-4 mt-2"></p>
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
                                حفظ وإضافة المدرب
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
@endrole