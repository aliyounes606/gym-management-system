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
                    class="text-gray-400 hover:text-white transition flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M10 18a8 8 0 100-16 8 8 0 000 16zm.707-10.293a1 1 0 00-1.414-1.414l-3 3a1 1 0 000 1.414l3 3a1 1 0 001.414-1.414L9.414 11H13a1 1 0 100-2H9.414l1.293-1.293z"
                            clip-rule="evenodd" />
                    </svg>
                    عودة للقائمة
                </a>
            </div>

            {{-- Error Alerts --}}
            @if ($errors->any())
                <div class="p-4 rounded-xl bg-red-900/80 border border-red-700 text-red-100 shadow-lg">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>• {{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{-- Create Form --}}
            <div class="bg-gray-900 border border-gray-800 rounded-2xl overflow-hidden shadow-2xl">
                <div class="p-6">
                    <form action="{{ route('admin.trainers.store') }}" method="POST">
                        @csrf
                        <div class="grid grid-cols-1 gap-6">
                            {{-- User Select --}}
                            <div class="space-y-2">
                                <label class="text-sm font-bold text-gray-300">اختر المستخدم</label>
                                <select name="user_id"
                                    class="w-full bg-gray-800 border border-gray-700 text-white rounded-xl focus:border-indigo-500 focus:ring-indigo-500 py-3">
                                    <option value="" disabled selected>-- اختر عضواً --</option>
                                    @foreach ($availableUsers as $u)
                                        <option value="{{ $u->id }}">{{ $u->name }} ({{ $u->email }})
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            {{-- Specialization --}}
                            <div class="space-y-2">
                                <label class="text-sm font-bold text-gray-300">التخصص</label>
                                <input type="text" name="specialization" placeholder="مثال: كمال أجسام، لياقة..."
                                    class="w-full bg-gray-800 border border-gray-700 text-white rounded-xl focus:border-indigo-500 focus:ring-indigo-500 py-3 placeholder-gray-500">
                            </div>

                            {{-- Experience --}}
                            <div class="space-y-2">
                                <label class="text-sm font-bold text-gray-300">سنوات الخبرة</label>
                                <div class="relative">
                                    <input type="number" name="experience_years" placeholder="0"
                                        class="w-full bg-gray-800 border border-gray-700 text-white rounded-xl focus:border-indigo-500 focus:ring-indigo-500 py-3 pl-10 placeholder-gray-500">
                                    <span
                                        class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 text-xs">سنة</span>
                                </div>
                            </div>

                            {{-- Bio --}}
                            <div class="space-y-2">
                                <label class="text-sm font-bold text-gray-300">نبذة تعريفية (Bio)</label>
                                <textarea name="bio" rows="4" placeholder="اكتب وصفاً مختصراً لخبرات المدرب..."
                                    class="w-full bg-gray-800 border border-gray-700 text-white rounded-xl focus:border-indigo-500 focus:ring-indigo-500 py-3 placeholder-gray-500"></textarea>
                            </div>
                        </div>

                        <div class="mt-8 flex justify-end">
                            <button type="submit"
                                class="bg-indigo-600 hover:bg-indigo-500 text-white px-8 py-3 rounded-xl font-bold transition duration-300 shadow-lg shadow-indigo-500/20 flex items-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
                                    fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-11a1 1 0 10-2 0v2H7a1 1 0 100 2h2v2a1 1 0 102 0v-2h2a1 1 0 100-2h-2V7z"
                                        clip-rule="evenodd" />
                                </svg>
                                حفظ البيانات
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
