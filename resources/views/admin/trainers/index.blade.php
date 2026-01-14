@role('admin')
<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">

            {{-- Header & Add Button --}}
            <div class="flex items-center justify-between">
                <div>
                    <h2 class="text-3xl font-bold text-gray-100 mb-2">إدارة المدربين</h2>
                    <p class="text-gray-400">إدارة فريق التدريب الاحترافي.</p>
                </div>

                {{-- Add Button --}}
                <a href="{{ route('admin.trainers.create') }}"
                    class="bg-indigo-600 hover:bg-indigo-500 text-white px-6 py-3 rounded-xl font-bold transition duration-300 shadow-lg shadow-indigo-500/20 flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-11a1 1 0 10-2 0v2H7a1 1 0 100 2h2v2a1 1 0 102 0v-2h2a1 1 0 100-2h-2V7z"
                            clip-rule="evenodd" />
                    </svg>
                    إضافة مدرب جديد
                </a>
            </div>

            {{-- Alerts --}}
            @if (session('success'))
                <div
                    class="p-4 rounded-xl bg-green-900/80 border border-green-700 text-green-100 flex items-center gap-3 shadow-lg animate-fade-in-down">
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
                    class="p-4 rounded-xl bg-red-900/80 border border-red-700 text-red-100 flex items-center gap-3 shadow-lg animate-fade-in-down">
                    <svg class="w-6 h-6 flex-shrink-0 text-red-400" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <div>
                        <span class="font-bold">خطأ!</span>
                        <span class="ms-1 opacity-90">{{ session('error') }}</span>
                    </div>
                </div>
            @endif

            {{-- Trainers List Table --}}
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
                                <tr class="hover:bg-white/5 transition duration-200 group">
                                    {{-- Name & Avatar --}}
                                    <td class="p-5">
                                        <div class="flex items-center gap-3">
                                            <div
                                                class="w-10 h-10 rounded-full bg-indigo-900/50 flex items-center justify-center text-indigo-300 font-bold border border-indigo-500/30 shadow-sm">
                                                {{ substr($trainer->user->name, 0, 1) }}
                                            </div>
                                            <div>
                                                <div
                                                    class="font-bold text-gray-100 group-hover:text-indigo-400 transition">
                                                    {{ $trainer->user->name }}</div>
                                                <div class="text-xs text-gray-500">{{ $trainer->user->email }}</div>
                                            </div>
                                        </div>
                                    </td>

                                    {{-- Specialization --}}
                                    <td class="p-5">
                                        <span
                                            class="bg-gray-800 text-indigo-300 px-3 py-1 rounded-lg text-sm font-bold border border-gray-700 shadow-sm">
                                            {{ $trainer->specialization }}
                                        </span>
                                    </td>

                                    {{-- Experience --}}
                                    <td class="p-5 text-center text-gray-300 font-bold">
                                        {{ $trainer->experience_years }} <span
                                            class="text-xs text-gray-500 font-normal">سنة</span>
                                    </td>

                                    {{-- Bio --}}
                                    <td class="p-5 text-sm text-gray-400 max-w-xs truncate">
                                        {{ Str::limit($trainer->bio, 40) }}
                                    </td>

                                    {{-- Actions --}}
                                    <td class="p-5">
                                        <div class="flex justify-center gap-3">
                                            {{-- Edit --}}
                                            <a href="{{ route('admin.trainers.edit', $trainer->id) }}"
                                                class="p-2 bg-gray-800 text-amber-500 rounded-lg hover:bg-amber-600 hover:text-white transition shadow border border-gray-700 hover:border-amber-500"
                                                title="تعديل">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                                    viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                </svg>
                                            </a>

                                            {{-- Show Profile (Optional) --}}
                                            @if (Route::has('admin.trainers.show'))
                                                <a href="{{ route('admin.trainers.show', $trainer->id) }}"
                                                    class="p-2 bg-gray-800 text-blue-500 rounded-lg hover:bg-blue-600 hover:text-white transition shadow border border-gray-700 hover:border-blue-500"
                                                    title="عرض الملف الشخصي">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5"
                                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                                    </svg>
                                                </a>
                                            @endif

                                            {{-- Delete --}}
                                            <form action="{{ route('admin.trainers.destroy', $trainer->id) }}"
                                                method="POST"
                                                onsubmit="return confirm('هل أنت متأكد من حذف هذا المدرب؟ سيتم إعادة رتبته إلى مستخدم عادي.');">
                                                @csrf @method('DELETE')
                                                <button type="submit"
                                                    class="p-2 bg-gray-800 text-red-500 rounded-lg hover:bg-red-600 hover:text-white transition shadow border border-gray-700 hover:border-red-500"
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
                                    <td colspan="5" class="p-16 text-center text-gray-500">
                                        <div class="flex flex-col items-center justify-center">
                                            <svg class="w-16 h-16 mb-4 opacity-20" fill="none"
                                                stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z">
                                                </path>
                                            </svg>
                                            <p class="text-lg">لا يوجد مدربين مضافين حالياً.</p>
                                            <p class="text-sm">ابدأ بإضافة مدرب جديد الآن.</p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    {{-- Pagination Section --}}
                    <div class="p-4 border-t border-gray-800 bg-gray-900/50 rounded-b-2xl">
                        <div class="mt-2" dir="ltr">
                            {{ $trainers->links() }}
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>
</x-app-layout>
@endrole