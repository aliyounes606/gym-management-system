<x-app-layout>
    <div class="py-12 bg-gray-900 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="flex justify-between items-center mb-6">
                <h2 class="text-2xl font-bold text-white">
                    📅 قائمة الحضور اليومي ({{ \Carbon\Carbon::now()->format('Y-m-d') }})
                </h2>
                <span class="px-4 py-2 bg-gray-800 rounded-full text-indigo-400 text-sm border border-gray-700">
                    عدد الجلسات: {{ $bookings->count() }}
                </span>
            </div>

            <div class="bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg border border-gray-700">
                <div class="p-6 text-gray-100">

                    @if ($bookings->isEmpty())
                        <div class="text-center py-10">
                            <p class="text-gray-400 text-lg">لا توجد جلسات مجدولة لهذا اليوم. 😴</p>
                        </div>
                    @else
                        <div class="overflow-x-auto">
                            <table class="w-full text-sm text-right text-gray-400">
                                <thead class="text-xs text-gray-300 uppercase bg-gray-700">
                                    <tr>
                                        <th scope="col" class="px-6 py-3">اللاعب</th>
                                        <th scope="col" class="px-6 py-3">الجلسة</th>
                                        <th scope="col" class="px-6 py-3">الوقت</th>
                                        <th scope="col" class="px-6 py-3">حالة الحضور</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($bookings as $booking)
                                        <tr class="bg-gray-800 border-b border-gray-700 hover:bg-gray-750 transition">

                                            {{-- اسم اللاعب وصورته --}}
                                            <td class="px-6 py-4 flex items-center gap-3">
                                                <div
                                                    class="w-8 h-8 rounded-full bg-indigo-500 flex items-center justify-center text-white font-bold">
                                                    {{ substr($booking->users->name, 0, 1) }}
                                                </div>
                                                <span class="text-white font-medium">{{ $booking->users->name }}</span>
                                            </td>

                                            {{-- عنوان الجلسة --}}
                                            <td class="px-6 py-4">
                                                {{ $booking->gymsessions->title }}
                                            </td>

                                            {{-- الوقت --}}
                                            <td class="px-6 py-4 font-mono">
                                                {{ \Carbon\Carbon::parse($booking->gymsessions->start_time)->format('h:i A') }}
                                            </td>

                                            {{-- الحالة (المنطق المطلوب) --}}
                                            <td class="px-6 py-4">
                                                @if ($booking->status == 'attended')
                                                    <span
                                                        class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-900 text-green-300 border border-green-700">
                                                        <span
                                                            class="w-1.5 h-1.5 rounded-full bg-green-500 ml-1.5"></span>
                                                        حضر ✅
                                                    </span>
                                                @else
                                                    <span
                                                        class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-900/50 text-red-300 border border-red-800/50">
                                                        <span
                                                            class="w-1.5 h-1.5 rounded-full bg-red-500 ml-1.5 animate-pulse"></span>
                                                        لم يحضر بعد
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
    </div>
</x-app-layout>
