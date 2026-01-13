<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">

            {{-- Header & Add Button --}}
            <div class="flex items-center justify-between">
                <div>
                    <h2 class="text-3xl font-bold text-gray-100 mb-2">قائمة الجلسات التدريبية</h2>
                    <p class="text-gray-400">إدارة جدول الجلسات اليومية وتفاصيلها.</p>
                </div>
                <a href="{{ route('gymsessions.create') }}"
                    class="bg-indigo-600 hover:bg-indigo-500 text-white px-6 py-3 rounded-xl font-bold transition duration-300 shadow-lg shadow-indigo-500/20 flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-11a1 1 0 10-2 0v2H7a1 1 0 100 2h2v2a1 1 0 102 0v-2h2a1 1 0 100-2h-2V7z"
                            clip-rule="evenodd" />
                    </svg>
                    إضافة جلسة جديدة
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

            {{-- Sessions Table Card --}}
            <div class="bg-gray-900 border border-gray-800 rounded-2xl overflow-hidden shadow-2xl">
                <div class="p-6 border-b border-gray-800 bg-gray-800/50 flex justify-between items-center">
                    <h3 class="text-lg font-bold text-white flex items-center gap-2">
                        <span class="w-2 h-6 bg-indigo-500 rounded-full"></span>
                        الجدول الحالي
                    </h3>
                    <span
                        class="bg-gray-800 text-indigo-400 text-xs font-bold px-3 py-1 rounded-full border border-gray-700">{{ $sessions->count() }}
                        جلسة</span>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-right">
                        <thead class="bg-black/40 text-gray-400 uppercase text-xs font-bold tracking-wider">
                            <tr>
                                <th class="p-5">العنوان</th>
                                <th class="p-5">المدرب</th>
                                <th class="p-5">التفاصيل (كورس/فئة)</th>
                                <th class="p-5 text-center">السعر</th>
                                <th class="p-5 text-center">التوقيت</th>
                                <th class="p-5 text-center">الإجراءات</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-800">
                            @forelse ($sessions as $session)
                                <tr class="hover:bg-white/5 transition duration-200 group">
                                    {{-- Title --}}
                                    <td class="p-5">
                                        <div class="font-bold text-white text-lg">{{ $session->title }}</div>
                                        <div class="text-xs text-gray-500 mt-1">سعة: {{ $session->max_capacity }} شخص
                                        </div>
                                    </td>

                                    {{-- Trainer --}}
                                    <td class="p-5">
                                        @if ($session->trainer && $session->trainer->user)
                                            <div class="flex items-center gap-2">
                                                <div
                                                    class="w-8 h-8 rounded-full bg-indigo-900/50 flex items-center justify-center text-indigo-300 font-bold border border-indigo-500/30 text-xs">
                                                    {{ substr($session->trainer->user->name, 0, 1) }}
                                                </div>
                                                <span
                                                    class="text-gray-300 text-sm">{{ $session->trainer->user->name }}</span>
                                            </div>
                                        @else
                                            <span class="text-gray-500 text-sm italic">---</span>
                                        @endif
                                    </td>

                                    {{-- Course & Category --}}
                                    <td class="p-5">
                                        <div class="flex flex-col gap-1">
                                            @if ($session->course)
                                                <span
                                                    class="inline-flex w-fit items-center px-2 py-0.5 rounded text-xs font-medium bg-blue-900/50 text-blue-300 border border-blue-800">
                                                    كورس: {{ $session->course->name }}
                                                </span>
                                            @endif
                                            @if ($session->category)
                                                <span
                                                    class="inline-flex w-fit items-center px-2 py-0.5 rounded text-xs font-medium bg-purple-900/50 text-purple-300 border border-purple-800">
                                                    فئة: {{ $session->category->name }}
                                                </span>
                                            @endif
                                            @if (!$session->course && !$session->category)
                                                <span class="text-gray-500 text-xs">---</span>
                                            @endif
                                        </div>
                                    </td>

                                    {{-- Price --}}
                                    <td class="p-5 text-center">
                                        <span class="font-mono text-emerald-400 font-bold">
                                            ${{ number_format($session->single_price, 2) }}
                                        </span>
                                    </td>

                                    {{-- Time --}}
                                    <td class="p-5 text-center">
                                        <div class="flex flex-col items-center justify-center text-sm">
                                            <span class="text-gray-300 font-bold">
                                                {{ \Carbon\Carbon::parse($session->start_time)->format('h:i A') }}
                                            </span>
                                            <span class="text-gray-500 text-xs">إلى</span>
                                            <span class="text-gray-400">
                                                {{ \Carbon\Carbon::parse($session->end_time)->format('h:i A') }}
                                            </span>
                                        </div>
                                    </td>

                                    {{-- Actions --}}
                                    <td class="p-5 text-center">
                                        <div class="flex justify-center gap-3">
                                            {{-- View --}}
                                            <a href="{{ route('gymsessions.show', $session->id) }}"
                                                class="p-2 bg-gray-800 text-blue-400 rounded-lg hover:bg-blue-500 hover:text-white transition shadow border border-gray-700 hover:border-blue-500"
                                                title="عرض التفاصيل">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                                    viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                                </svg>
                                            </a>

                                            {{-- Edit --}}
                                            <a href="{{ route('gymsessions.edit', $session->id) }}"
                                                class="p-2 bg-gray-800 text-amber-500 rounded-lg hover:bg-amber-500 hover:text-white transition shadow border border-gray-700 hover:border-amber-500"
                                                title="تعديل">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                                    viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                </svg>
                                            </a>

                                            {{-- Delete --}}
                                            <form action="{{ route('gymsessions.destroy', $session->id) }}"
                                                method="POST"
                                                onsubmit="return confirm('هل أنت متأكد من حذف هذه الجلسة؟');">
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
                                    <td colspan="6" class="p-12 text-center text-gray-500">
                                        <div class="flex flex-col items-center justify-center gap-2">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 opacity-20"
                                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                            <p>لا توجد جلسات مجدولة حالياً.</p>
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
