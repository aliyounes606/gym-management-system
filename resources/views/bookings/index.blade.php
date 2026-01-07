<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight text-right">
            إدارة الحجوزات
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            {{-- صندوق الأزرار --}}
            <div class="bg-white shadow-sm rounded-lg p-6 mb-8">
                <form action="{{ route('bookings.create') }}" method="GET" class="space-y-6">

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-3">
                            نوع الحجز
                        </label>

                        <div class="flex gap-4">
                            <button
                                type="submit"
                                name="action"
                                value="sessions"
                                class="w-full bg-blue-600 text-white py-2 rounded hover:bg-blue-700"
                            >
                                حجز جلسة مفردة
                            </button>

                            <button
                                type="submit"
                                name="action"
                                value="courses"
                                class="w-full bg-green-600 text-white py-2 rounded hover:bg-green-700"
                            >
                                حجز دورة تدريبية
                            </button>
                        </div>
                    </div>

                </form>
            </div>

            {{-- جدول الحجوزات --}}
            <div class="bg-white shadow-sm rounded-lg p-6">

                <h3 class="text-lg font-bold mb-4 text-right">
                    📋 قائمة الحجوزات
                </h3>

                <table border="1" width="100%" cellpadding="10" cellspacing="0"
                       style="border-collapse: collapse; text-align: right">

                    <thead style="background:#f3f4f6">
                        <tr>
                            <th>المستخدم</th>
                            <th>نوع الحجز</th>
                            <th>الجلسة</th>
                            <th>الكورس</th>
                            <th>الدفع</th>
                            <th>المبلغ</th>
                            <th>الحضور</th>
                            <th>التاريخ</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($bookings as $booking)
                            <tr>
                                <td>{{ $booking->user->name ?? '---' }}</td>

                                <td>
                                    {{ $booking->booking_type === 'session'
                                        ? 'جلسة مفردة'
                                        : 'كورس' }}
                                </td>

                                <td>
                                    {{ $booking->gymSession->title ?? '---' }}
                                </td>

                                <td>
                                    {{ $booking->course->name ?? '---' }}
                                </td>

                                <td>
                                    @if($booking->payment_status === 'paid')
                                        <span style="color:green;font-weight:bold">مدفوع</span>
                                    @else
                                        <span style="color:red;font-weight:bold">غير مدفوع</span>
                                    @endif
                                </td>

                                <td>
                                    {{ $booking->amount_paid ?? 0 }}
                                </td>

                                <td>
                                    {{ $booking->attendance_status ? '✔ حضر' : '✖ لم يحضر' }}
                                </td>

                                <td>
                                    {{ $booking->created_at->format('Y-m-d') }}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" style="text-align:center; padding:20px">
                                    لا يوجد حجوزات
                                </td>
                            </tr>
                        @endforelse
                    </tbody>

                </table>

            </div>

        </div>
    </div>
</x-app-layout>
