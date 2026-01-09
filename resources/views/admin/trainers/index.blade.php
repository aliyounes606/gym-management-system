<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">

            {{-- Header --}}
            <div class="flex items-center justify-between">
                <div>
                    {{-- تم تغميق النص قليلاً ليكون مريحاً أكثر أو التأكد من خلفية الصفحة --}}
                    <h2 class="text-3xl font-bold text-gray-100 mb-2">إدارة المدربين</h2>
                    <p class="text-gray-400">قم بترقية الأعضاء وإدارة فريق التدريب الاحترافي.</p>
                </div>
                <div class="p-3 bg-indigo-600 rounded-xl shadow-lg shadow-indigo-500/20">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-white" viewBox="0 0 24 24"
                        fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M8.25 6.75a3.75 3.75 0 117.5 0 3.75 3.75 0 01-7.5 0zM15.75 9.75a3 3 0 116 0 3 3 0 01-6 0zM2.25 9.75a3 3 0 116 0 3 3 0 01-6 0zM6.31 15.117A6.745 6.745 0 0112 12a6.745 6.745 0 016.709 7.498.75.75 0 01-.372.568A12.696 12.696 0 0112 21.75c-2.305 0-4.47-.612-6.337-1.684a.75.75 0 01-.372-.568 6.787 6.787 0 011.019-4.38z"
                            clip-rule="evenodd" />
                        <path
                            d="M5.082 14.254a6.79 6.79 0 00-3.431 2.903c-.517.961.033 2.126.983 2.543 2.547 1.115 5.253 1.259 7.822.348l-5.374-5.794zM16.142 14.254l5.375 5.795a9.72 9.72 0 002.483-2.903c.517-.961-.033-2.126-.983-2.543-2.548-1.115-5.253-1.259-7.822.348z" />
                    </svg>
                </div>
            </div>

            {{-- Alerts Section --}}
            @if (session('success'))
                <div
                    class="p-4 rounded-xl bg-green-900/80 border border-green-700 text-green-100 flex items-center gap-3 shadow-lg">
                    <svg class="w-6 h-6 flex-shrink-0 text-green-400" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <div>
                        <span class="font-bold">تم بنجاح!</span>
                        <span class="ms-1 opacity-90">{{ session('success') }}</span>
                    </div>
                </div>
            @endif

            @if (session('error'))
                <div
                    class="p-4 rounded-xl bg-red-900/80 border border-red-700 text-red-100 flex items-center gap-3 shadow-lg">
                    <svg class="w-6 h-6 flex-shrink-0 text-red-400" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <span>{{ session('error') }}</span>
                </div>
            @endif

            {{-- 1. Create Trainer Form --}}
            {{-- التغيير هنا: bg-gray-900 بدلاً من bg-gray-900/50 لتكون الخلفية داكنة تماماً --}}
            <div class="bg-gray-900 border border-gray-800 rounded-2xl overflow-hidden shadow-2xl">
                <div class="p-6 border-b border-gray-800 bg-gray-800/50">
                    <h3 class="text-lg font-bold text-white flex items-center gap-2">
                        <span class="w-2 h-6 bg-indigo-500 rounded-full"></span>
                        ترقية مستخدم لمدرب
                    </h3>
                </div>

                <div class="p-6">
                    <form action="{{ route('admin.trainers.store') }}" method="POST">
                        @csrf
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            {{-- User Select --}}
                            <div class="space-y-2">
                                <label class="text-sm font-bold text-gray-300">اختر المستخدم</label>
                                {{-- الخلفية هنا bg-gray-800 لتكون افتح قليلاً من الخلفية الرئيسية --}}
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
                            <div class="md:col-span-3 space-y-2">
                                <label class="text-sm font-bold text-gray-300">نبذة تعريفية (Bio)</label>
                                <textarea name="bio" rows="3" placeholder="اكتب وصفاً مختصراً لخبرات المدرب..."
                                    class="w-full bg-gray-800 border border-gray-700 text-white rounded-xl focus:border-indigo-500 focus:ring-indigo-500 py-3 placeholder-gray-500"></textarea>
                            </div>
                        </div>

                        <div class="mt-6 flex justify-end">
                            <button type="submit"
                                class="bg-indigo-600 hover:bg-indigo-500 text-white px-8 py-3 rounded-xl font-bold transition duration-300 shadow-lg shadow-indigo-500/20 flex items-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
                                    fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-11a1 1 0 10-2 0v2H7a1 1 0 100 2h2v2a1 1 0 102 0v-2h2a1 1 0 100-2h-2V7z"
                                        clip-rule="evenodd" />
                                </svg>
                                إضافة المدرب
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            {{-- 2. Trainers List --}}
            {{-- التغيير هنا: خلفية داكنة صلبة --}}
            <div class="bg-gray-900 border border-gray-800 rounded-2xl overflow-hidden shadow-2xl">
                <div class="p-6 border-b border-gray-800 flex justify-between items-center bg-gray-800/50">
                    <h3 class="text-lg font-bold text-white flex items-center gap-2">
                        <span class="w-2 h-6 bg-indigo-500 rounded-full"></span>
                        قائمة المدربين الحاليين
                    </h3>
                    <span
                        class="bg-gray-800 text-indigo-400 text-xs font-bold px-3 py-1 rounded-full border border-gray-700">{{ $trainers->count() }}
                        مدرب</span>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-right">
                        {{-- رأس الجدول بخلفية رمادية داكنة جداً --}}
                        <thead class="bg-black/40 text-gray-400 uppercase text-xs font-bold tracking-wider">
                            <tr>
                                <th class="p-5">الاسم</th>
                                <th class="p-5">التخصص</th>
                                <th class="p-5 text-center">الخبرة</th>
                                <th class="p-5">السيرة الذاتية</th>
                                <th class="p-5 text-center">الإجراءات</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-800">
                            @forelse ($trainers as $trainer)
                                <tr class="hover:bg-white/5 transition duration-200">
                                    <td class="p-5">
                                        <div class="flex items-center gap-3">
                                            <div
                                                class="w-10 h-10 rounded-full bg-indigo-900/50 flex items-center justify-center text-indigo-300 font-bold border border-indigo-500/30">
                                                {{ substr($trainer->user->name, 0, 1) }}
                                            </div>
                                            <div>
                                                <div class="font-bold text-gray-100">{{ $trainer->user->name }}</div>
                                                <div class="text-xs text-gray-500">{{ $trainer->user->email }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="p-5">
                                        <span
                                            class="bg-gray-800 text-indigo-300 px-3 py-1 rounded-lg text-sm font-bold border border-gray-700">
                                            {{ $trainer->specialization }}
                                        </span>
                                    </td>
                                    <td class="p-5 text-center text-gray-300 font-bold">
                                        {{ $trainer->experience_years }} <span
                                            class="text-xs text-gray-500 font-normal">سنة</span>
                                    </td>
                                    <td class="p-5 text-sm text-gray-400 max-w-xs truncate">
                                        {{ Str::limit($trainer->bio, 40) }}
                                    </td>
                                    <td class="p-5">
                                        <div class="flex justify-center gap-3">
                                            {{-- Edit Button --}}
                                            <a href="{{ route('admin.trainers.edit', $trainer->id) }}"
                                                class="p-2 bg-gray-800 text-amber-500 rounded-lg hover:bg-amber-600 hover:text-white transition shadow border border-gray-700"
                                                title="تعديل">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5"
                                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                </svg>
                                            </a>

                                            {{-- Delete Button --}}
                                            <form action="{{ route('admin.trainers.destroy', $trainer->id) }}"
                                                method="POST"
                                                onsubmit="return confirm('هل أنت متأكد من حذف هذا المدرب؟ سيتم إعادة رتبته إلى مستخدم عادي.');">
                                                @csrf @method('DELETE')
                                                <button type="submit"
                                                    class="p-2 bg-gray-800 text-red-500 rounded-lg hover:bg-red-600 hover:text-white transition shadow border border-gray-700"
                                                    title="حذف">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5"
                                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                    </svg>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="p-8 text-center text-gray-500">
                                        <div class="flex flex-col items-center justify-center">
                                            <svg class="w-12 h-12 mb-3 opacity-20" fill="none"
                                                stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z">
                                                </path>
                                            </svg>
                                            <p>لا يوجد مدربين مضافين حالياً.</p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
