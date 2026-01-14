@role('admin')
<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">

            {{-- Header & Add Button --}}
            <div class="flex items-center justify-between">
                <div>
                    <h2 class="text-3xl font-bold text-gray-100 mb-2">قائمة الكورسات</h2>
                    <p class="text-gray-400">إدارة البرامج التدريبية المتاحة للأعضاء.</p>
                </div>
                <a href="{{ route('courses.create') }}"
                    class="bg-indigo-600 hover:bg-indigo-500 text-white px-6 py-3 rounded-xl font-bold transition duration-300 shadow-lg shadow-indigo-500/20 flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-11a1 1 0 10-2 0v2H7a1 1 0 100 2h2v2a1 1 0 102 0v-2h2a1 1 0 100-2h-2V7z"
                            clip-rule="evenodd" />
                    </svg>
                    إضافة كورس جديد
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
                    <div>{{ session('success') }}</div>
                </div>
            @endif

            {{-- Courses Table Card --}}
            <div class="bg-gray-900 border border-gray-800 rounded-2xl overflow-hidden shadow-2xl">
                <div class="p-6 border-b border-gray-800 bg-gray-800/50 flex justify-between items-center">
                    <h3 class="text-lg font-bold text-white flex items-center gap-2">
                        <span class="w-2 h-6 bg-indigo-500 rounded-full"></span>
                        البرامج الحالية
                    </h3>
                    <span
                        class="bg-gray-800 text-indigo-400 text-xs font-bold px-3 py-1 rounded-full border border-gray-700">{{ $courses->count() }}
                        كورس</span>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-right">
                        <thead class="bg-black/40 text-gray-400 uppercase text-xs font-bold tracking-wider">
                            <tr>
                                <th class="p-5">#</th>
                                <th class="p-5">اسم الكورس</th>
                                <th class="p-5">المدرب</th>
                                <th class="p-5">الوصف</th>
                                <th class="p-5 text-center">السعر</th>
                                <th class="p-5 text-center">الإجراءات</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-800">
                            @forelse ($courses as $course)
                                <tr class="hover:bg-white/5 transition duration-200 group">
                                    {{-- ID --}}
                                    <td class="p-5 text-gray-500 font-mono text-sm">
                                        {{ $loop->iteration }}
                                    </td>

                                    {{-- Name --}}
                                    <td class="p-5">
                                        <div class="font-bold text-gray-100 text-lg">{{ $course->name }}</div>
                                    </td>

                                    {{-- Trainer --}}
                                    <td class="p-5">
                                        @if ($course->trainerProfile)
                                            <div class="flex items-center gap-2">
                                                <div
                                                    class="w-8 h-8 rounded-full bg-indigo-900/50 flex items-center justify-center text-indigo-300 font-bold border border-indigo-500/30 text-xs">
                                                    {{ substr($course->trainerProfile->user->name, 0, 1) }}
                                                </div>
                                                <span
                                                    class="text-gray-300 text-sm">{{ $course->trainerProfile->user->name }}</span>
                                            </div>
                                        @else
                                            <span
                                                class="text-gray-500 text-sm italic bg-gray-800 px-2 py-1 rounded">بدون
                                                مدرب</span>
                                        @endif
                                    </td>

                                    {{-- Description --}}
                                    <td class="p-5 text-gray-400 text-sm max-w-xs truncate"
                                        title="{{ $course->description }}">
                                        {{ Str::limit($course->description, 50) }}
                                    </td>

                                    {{-- Price --}}
                                    <td class="p-5 text-center">
                                        <span class="font-black text-emerald-400 text-lg">
                                            ${{ number_format($course->total_price, 2) }}
                                        </span>
                                    </td>

                                    {{-- Actions --}}
                                    <td class="p-5 text-center">
                                        <div class="flex justify-center gap-3">
                                            <a href="{{ route('courses.edit', $course->id) }}"
                                                class="p-2 bg-gray-800 text-indigo-400 rounded-lg hover:bg-indigo-500 hover:text-white transition shadow border border-gray-700 hover:border-indigo-500"
                                                title="تعديل">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                                    viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                </svg>
                                            </a>

                                            <form action="{{ route('courses.destroy', $course->id) }}" method="POST"
                                                onsubmit="return confirm('هل أنت متأكد من حذف هذا الكورس؟');">
                                                @csrf @method('DELETE')
                                                <button type="submit"
                                                    class="p-2 bg-gray-800 text-red-400 rounded-lg hover:bg-red-500 hover:text-white transition shadow border border-gray-700 hover:border-red-500"
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
                                    <td colspan="6" class="p-16 text-center text-gray-500">
                                        <div class="flex flex-col items-center justify-center">
                                            <svg class="w-16 h-16 mb-4 opacity-20" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253">
                                                </path>
                                            </svg>
                                            <p class="text-lg">لا توجد كورسات متاحة حالياً.</p>
                                            <a href="{{ route('courses.create') }}"
                                                class="text-indigo-400 hover:text-indigo-300 underline mt-2">ابدأ بإنشاء
                                                أول كورس</a>
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
@endrole