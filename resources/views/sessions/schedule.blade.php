@role('trainer')
    <x-app-layout>
        {{-- الخلفية فاتحة --}}
        <div class="py-12 bg-gray-50 min-h-screen" dir="rtl">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">

                {{-- 1. الهيدر --}}
                <div class="flex flex-col md:flex-row justify-between items-center gap-4 border-b border-gray-200 pb-6">
                    <div>
                        <h2 class="text-3xl font-black text-gray-800 tracking-tight">
                            جدولي التدريبي 📅
                        </h2>
                        <p class="text-gray-500 mt-1">
                            أهلاً كابتن <span class="text-indigo-600 font-bold">{{ $trainer->user->name }}</span>، إليك جدول
                            جلساتك القادمة.
                        </p>
                    </div>

                    {{-- إحصائية سريعة --}}
                    <div class="flex items-center gap-3 bg-white px-5 py-3 rounded-2xl shadow-sm border border-gray-200">
                        <span class="text-gray-500 font-bold text-sm">عدد الجلسات</span>
                        <span
                            class="bg-indigo-600 text-white px-3 py-1 rounded-lg text-sm font-black shadow-md shadow-indigo-200">
                            {{ $sessions->count() }}
                        </span>
                    </div>
                </div>

                {{-- رسائل التنبيه --}}
                @if (session('success'))
                    <div class="bg-gray-900 border-r-4 border-emerald-500 p-4 rounded-lg shadow-lg flex items-center gap-3">
                        <svg class="w-6 h-6 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <span class="text-white font-bold">{{ session('success') }}</span>
                    </div>
                @endif

                {{-- 2. بطاقة الجدول (داكنة) --}}
                <div class="bg-gray-900 border border-gray-800 rounded-2xl overflow-hidden shadow-2xl">

                    {{-- رأس البطاقة --}}
                    <div class="bg-gray-800/50 px-6 py-4 border-b border-gray-800 flex items-center justify-between">
                        <h3 class="text-white font-bold flex items-center gap-2">
                            <span class="w-2 h-6 bg-indigo-500 rounded-full"></span>
                            الجلسات المجدولة
                        </h3>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="w-full text-right">
                            <thead class="bg-black/40 text-gray-400 uppercase text-xs font-bold tracking-wider">
                                <tr>
                                    <th class="px-6 py-4">عنوان الجلسة</th>
                                    <th class="px-6 py-4">الكورس التابع لها</th>
                                    <th class="px-6 py-4 text-center">السعة / الحضور</th>
                                    <th class="px-6 py-4 text-center">التوقيت</th>
                                    <th class="px-6 py-4 text-center">الحالة</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-800">
                                @forelse ($sessions as $session)
                                    <tr class="hover:bg-white/5 transition-colors duration-200 group">

                                        {{-- العنوان --}}
                                        <td class="px-6 py-5">
                                            <div class="font-bold text-white text-lg">
                                                {{ $session->title }}
                                            </div>
                                        </td>

                                        {{-- الكورس --}}
                                        <td class="px-6 py-5">
                                            @if ($session->course)
                                                <span
                                                    class="inline-flex items-center px-3 py-1 rounded-lg text-xs font-bold bg-indigo-500/10 text-indigo-400 border border-indigo-500/20">
                                                    {{ $session->course->name }}
                                                </span>
                                            @else
                                                <span class="text-gray-500 text-xs italic">---</span>
                                            @endif
                                        </td>

                                        {{-- السعة --}}
                                        <td class="px-6 py-5 text-center">
                                            <div class="flex flex-col items-center justify-center">
                                                <div class="flex items-end gap-1 mb-1">
                                                    <span
                                                        class="text-xl font-bold text-white">{{ $session->members_count ?? 0 }}</span>
                                                    <span class="text-xs text-gray-500 mb-1">/
                                                        {{ $session->max_capacity }}</span>
                                                </div>
                                                {{-- شريط تقدم بسيط --}}
                                                <div class="w-24 h-1.5 bg-gray-700 rounded-full overflow-hidden">
                                                    @php
                                                        $percentage =
                                                            $session->max_capacity > 0
                                                                ? (($session->members_count ?? 0) /
                                                                        $session->max_capacity) *
                                                                    100
                                                                : 0;
                                                        $color =
                                                            $percentage >= 100
                                                                ? 'bg-red-500'
                                                                : ($percentage >= 50
                                                                    ? 'bg-yellow-500'
                                                                    : 'bg-green-500');
                                                    @endphp
                                                    <div class="h-full {{ $color }}"
                                                        style="width: {{ $percentage }}%"></div>
                                                </div>
                                            </div>
                                        </td>

                                        {{-- التوقيت --}}
                                        <td class="px-6 py-5 text-center">
                                            <div class="flex flex-col text-sm">
                                                <div class="flex items-center justify-center gap-2 text-gray-300">
                                                    <svg class="w-4 h-4 text-indigo-500" fill="none"
                                                        stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                    </svg>
                                                    <span
                                                        class="font-mono">{{ \Carbon\Carbon::parse($session->start_time)->format('h:i A') }}</span>
                                                </div>
                                                <span class="text-gray-600 text-xs my-0.5">إلى</span>
                                                <div class="flex items-center justify-center gap-2 text-gray-400">
                                                    <span
                                                        class="font-mono">{{ \Carbon\Carbon::parse($session->end_time)->format('h:i A') }}</span>
                                                </div>
                                            </div>
                                        </td>

                                        {{-- الحالة (افتراضي) --}}
                                        <td class="px-6 py-5 text-center">
                                            {{-- يمكنك إضافة منطق الحالة هنا لاحقاً، حالياً سنعرض "نشط" افتراضياً أو بناء على الوقت --}}
                                            @php
                                                $now = \Carbon\Carbon::now();
                                                $start = \Carbon\Carbon::parse($session->start_time);
                                                $end = \Carbon\Carbon::parse($session->end_time);
                                            @endphp

                                            @if ($now->between($start, $end))
                                                <span
                                                    class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-500/10 text-green-400 border border-green-500/20 animate-pulse">
                                                    جاري الآن 🔴
                                                </span>
                                            @elseif($now->gt($end))
                                                <span
                                                    class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-700 text-gray-400 border border-gray-600">
                                                    منتهية
                                                </span>
                                            @else
                                                <span
                                                    class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-500/10 text-blue-400 border border-blue-500/20">
                                                    مجدولة ⏳
                                                </span>
                                            @endif
                                        </td>

                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="py-12 text-center">
                                            <div class="flex flex-col items-center justify-center">
                                                <div
                                                    class="w-16 h-16 bg-gray-800 rounded-full flex items-center justify-center mb-4">
                                                    <svg class="w-8 h-8 text-gray-500" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                                                        </path>
                                                    </svg>
                                                </div>
                                                <h3 class="text-lg font-bold text-white">لا توجد جلسات</h3>
                                                <p class="text-gray-500 mt-1">ليس لديك أي جلسات مجدولة حالياً.</p>
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
