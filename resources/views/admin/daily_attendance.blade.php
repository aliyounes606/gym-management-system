<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">

            {{-- Header --}}
            <div class="flex items-center justify-between">
                <div>
                    <h2 class="text-3xl font-bold text-gray-100 mb-2">
                        📅 قائمة الحضور اليومي
                    </h2>
                    <p class="text-gray-400">
                        التاريخ: <span
                            class="text-indigo-400 font-bold font-mono">{{ \Carbon\Carbon::now()->format('Y-m-d') }}</span>
                    </p>
                </div>

                {{-- Stats Badge --}}
                <div class="bg-indigo-900/50 border border-indigo-700/50 px-6 py-2 rounded-xl flex items-center gap-3">
                    <span class="text-indigo-300 text-sm font-bold">إجمالي الحجوزات</span>
                    <span class="bg-indigo-600 text-white text-xs font-bold px-2 py-1 rounded-lg">
                        {{ $bookings->count() }}
                    </span>
                </div>
            </div>

            {{-- Attendance Table Card --}}
            <div class="bg-gray-900 border border-gray-800 rounded-2xl overflow-hidden shadow-2xl">

                <div class="p-6 border-b border-gray-800 bg-gray-800/50 flex justify-between items-center">
                    <h3 class="text-lg font-bold text-white flex items-center gap-2">
                        <span class="w-2 h-6 bg-green-500 rounded-full"></span>
                        سجل الحضور
                    </h3>
                </div>

                @if ($bookings->isEmpty())
                    <div class="p-16 text-center">
                        <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-gray-800 mb-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-gray-500" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-white mb-1">لا توجد جلسات اليوم</h3>
                        <p class="text-gray-500">لم يتم جدولة أي حصص تدريبية لهذا التاريخ حتى الآن.</p>
                    </div>
                @else
                    <div class="overflow-x-auto">
                        <table class="w-full text-right">
                            <thead class="bg-black/40 text-gray-400 uppercase text-xs font-bold tracking-wider">
                                <tr>
                                    <th class="p-5">اللاعب المشترك</th>
                                    <th class="p-5">تفاصيل الجلسة</th>
                                    <th class="p-5 text-center">الوقت</th>
                                    <th class="p-5 text-center">حالة الحضور</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-800">
                                @foreach ($bookings as $booking)
                                    <tr class="hover:bg-white/5 transition duration-200 group">

                                        {{-- User --}}
                                        <td class="p-5">
                                            <div class="flex items-center gap-3">
                                                <div
                                                    class="w-10 h-10 rounded-full bg-gradient-to-br from-indigo-600 to-blue-700 flex items-center justify-center text-white font-bold text-sm shadow-lg">
                                                    {{ substr($booking->users->name, 0, 1) }}
                                                </div>
                                                <div>
                                                    <div class="font-bold text-white">{{ $booking->users->name }}</div>
                                                    <div class="text-xs text-gray-500">مشترك</div>
                                                </div>
                                            </div>
                                        </td>

                                        {{-- Session Info --}}
                                        <td class="p-5">
                                            <div class="font-bold text-gray-200 mb-1">
                                                {{ $booking->gymsessions->title }}
                                            </div>
                                            @if ($booking->gymsessions->course)
                                                <span
                                                    class="inline-flex items-center px-2 py-0.5 rounded text-[10px] font-bold bg-gray-800 text-gray-400 border border-gray-700">
                                                    {{ $booking->gymsessions->course->name }}
                                                </span>
                                            @endif
                                        </td>

                                        {{-- Time --}}
                                        <td class="p-5 text-center">
                                            <div
                                                class="inline-flex items-center px-3 py-1 rounded-lg bg-gray-800 border border-gray-700 text-gray-300 font-mono text-sm">
                                                {{ \Carbon\Carbon::parse($booking->gymsessions->start_time)->format('h:i A') }}
                                            </div>
                                        </td>

                                        {{-- Status Badge --}}
                                        <td class="p-5 text-center">
                                            @if ($booking->status == 'attended')
                                                <span
                                                    class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-green-500/10 text-green-400 border border-green-500/20">
                                                    <span
                                                        class="w-1.5 h-1.5 rounded-full bg-green-500 ml-2 shadow-[0_0_10px_rgba(34,197,94,0.5)]"></span>
                                                    تم الحضور ✅
                                                </span>
                                            @else
                                                <span
                                                    class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-amber-500/10 text-amber-400 border border-amber-500/20">
                                                    <span
                                                        class="w-1.5 h-1.5 rounded-full bg-amber-500 ml-2 animate-pulse"></span>
                                                    لم يحضر بعد ⏳
                                                </span>
                                            @endif
                                        </td>

                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif

            </div>
        </div>
    </div>
</x-app-layout>
