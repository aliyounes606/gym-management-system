@role('admin')
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-xl text-gray-100 leading-tight flex items-center gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-emerald-400" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            {{ __('طلبات الدفع المعلقة (Pending Payments)') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            {{-- Alerts --}}
            @if (session('success'))
                <div
                    class="p-4 rounded-xl bg-emerald-500/10 border border-emerald-500/20 text-emerald-400 flex items-center gap-3 shadow-lg animate-fade-in-down">
                    <svg class="w-6 h-6 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <div>{{ session('success') }}</div>
                </div>
            @endif

            {{-- Main Content Card --}}
            <div class="bg-gray-900 border border-gray-800 rounded-2xl overflow-hidden shadow-2xl">
                <div class="p-6">

                    @if ($pendingBookings->isEmpty())
                        <div class="text-center py-16">
                            <div
                                class="inline-flex items-center justify-center w-20 h-20 rounded-full bg-gray-800 mb-4">
                                <svg class="w-10 h-10 text-gray-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <h3 class="text-xl font-bold text-gray-300">كل شيء تمام! 🎉</h3>
                            <p class="text-gray-500 mt-2">لا يوجد طلبات دفع معلقة حالياً.</p>
                        </div>
                    @else
                        <div class="overflow-x-auto">
                            <table class="w-full text-right">
                                <thead class="bg-black/40 text-gray-400 uppercase text-xs font-bold tracking-wider">
                                    <tr>
                                        <th class="py-4 px-6 text-right">رقم الفاتورة (Batch)</th>
                                        <th class="py-4 px-6 text-right">معلومات الطالب</th>
                                        <th class="py-4 px-6 text-center">التفاصيل</th>
                                        <th class="py-4 px-6 text-center">المبلغ الإجمالي</th>
                                        <th class="py-4 px-6 text-center">تاريخ الطلب</th>
                                        <th class="py-4 px-6 text-center">الإجراءات</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-800">
                                    @foreach ($pendingBookings as $batchId => $bookings)
                                        @php
                                            $firstBooking = $bookings->first();
                                            $totalPrice = $bookings->sum('price');
                                        @endphp

                                        <tr class="hover:bg-white/5 transition duration-200 group">
                                            {{-- Batch ID --}}
                                            <td class="py-4 px-6 align-middle">
                                                <div class="flex items-center gap-2">
                                                    <span
                                                        class="font-mono text-xs text-indigo-300 bg-indigo-900/30 px-2 py-1 rounded border border-indigo-500/20">
                                                        #{{ substr($batchId, 0, 8) }}
                                                    </span>
                                                </div>
                                            </td>

                                            {{-- Student Info --}}
                                            <td class="py-4 px-6 align-middle">
                                                <div class="flex items-center gap-3">
                                                    <div
                                                        class="w-10 h-10 rounded-full bg-gray-800 flex items-center justify-center text-gray-400 font-bold border border-gray-700">
                                                        {{ substr($firstBooking->users->name, 0, 1) }}
                                                    </div>
                                                    <div>
                                                        <div class="font-bold text-gray-100">
                                                            {{ $firstBooking->users->name }}</div>
                                                        <div class="text-xs text-gray-500">
                                                            {{ $firstBooking->users->email }}</div>
                                                    </div>
                                                </div>
                                            </td>

                                            {{-- Session Count --}}
                                            <td class="py-4 px-6 text-center align-middle">
                                                <span
                                                    class="bg-gray-800 text-gray-300 py-1 px-3 rounded-lg text-xs font-bold border border-gray-700">
                                                    {{ $bookings->count() }} جلسات
                                                </span>
                                            </td>

                                            {{-- Total Price --}}
                                            <td class="py-4 px-6 text-center align-middle">
                                                <div class="text-xl font-black text-emerald-400 drop-shadow-sm">
                                                    ${{ number_format($totalPrice, 2) }}
                                                </div>
                                            </td>

                                            {{-- Date --}}
                                            <td class="py-4 px-6 text-center align-middle text-sm text-gray-400">
                                                <div class="flex flex-col items-center">
                                                    <span
                                                        class="font-bold">{{ $firstBooking->created_at->format('Y-m-d') }}</span>
                                                    <span
                                                        class="text-xs opacity-70">{{ $firstBooking->created_at->format('H:i') }}</span>
                                                </div>
                                            </td>

                                            {{-- Actions --}}
                                            <td class="py-4 px-6 text-center align-middle">
                                                <div class="flex items-center justify-center gap-3">

                                                    {{-- Confirm Button --}}
                                                    <form action="{{ route('admin.payments.confirm', $batchId) }}"
                                                        method="POST"
                                                        onsubmit="return confirm('هل استلمت المبلغ ({{ $totalPrice }}) نقداً من الطالب؟');">
                                                        @csrf
                                                        <button type="submit"
                                                            class="flex items-center gap-2 bg-emerald-600 hover:bg-emerald-500 text-white font-bold py-2 px-4 rounded-xl shadow-lg shadow-emerald-500/20 transition transform hover:scale-105"
                                                            title="تأكيد الاستلام">
                                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5"
                                                                viewBox="0 0 20 20" fill="currentColor">
                                                                <path fill-rule="evenodd"
                                                                    d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                                                    clip-rule="evenodd" />
                                                            </svg>
                                                            <span>تفعيل</span>
                                                        </button>
                                                    </form>

                                                    {{-- Reject Button --}}
                                                    <form action="{{ route('admin.payments.destroy', $batchId) }}"
                                                        method="POST"
                                                        onsubmit="return confirm('هل أنت متأكد من حذف هذا الحجز؟');">
                                                        @csrf @method('DELETE')
                                                        <button type="submit"
                                                            class="p-2 bg-gray-800 text-red-400 rounded-xl hover:bg-red-500 hover:text-white transition border border-gray-700 hover:border-red-500 group-hover:border-red-500/50"
                                                            title="إلغاء وحذف">
                                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5"
                                                                fill="none" viewBox="0 0 24 24"
                                                                stroke="currentColor">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    stroke-width="2"
                                                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                            </svg>
                                                        </button>
                                                    </form>
                                                </div>
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
@endrole