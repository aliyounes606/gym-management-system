<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight text-right">
            قائمة الجلسات
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm rounded-lg p-6">

               

                <table class="min-w-full divide-y divide-gray-200 text-right">
                    <thead class="bg-gray-50">
                        <tr>
                            <th>العنوان</th>
                            <th>المدرب</th>
                            <th>الكورس</th>
                            <th>السعر</th>
                            <th>السعة</th>
                            <th>من</th>
                            <th>إلى</th>
                        </tr>
                    </thead>

                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($gymSessions as $session)
                            <tr>
                                <td class="px-6 py-4">{{ $session->title }}</td>

                                <td class="px-6 py-4">
                                    {{ $session->trainer->user->name ?? 'لا يوجد مدرب' }}
                                </td>

                                <td class="px-6 py-4">
                                    {{ $session->course->name ?? 'لا يوجد كورس' }}
                                </td>

                                <td class="px-6 py-4">{{ $session->single_price }}</td>
                                <td class="px-6 py-4">{{ $session->max_capacity }}</td>
                                <td class="px-6 py-4">{{ $session->start_time }}</td>
                                <td class="px-6 py-4">{{ $session->end_time }}</td>
                            </tr>
                            <td class="px-6 py-4 flex gap-2 justify-end">
                                <!-- زر تأكيد الحجز -->
                              <form action="{{ route('bookings.bookSession', $session->id) }}" method="POST">
                                    @csrf
                                    <button
                                        type="submit"
                                        class="bg-green-600 text-white px-3 py-1 rounded hover:bg-green-700"
                                        {{ $session->max_capacity <= 0 ? 'disabled' : '' }}
                                    >
                                        حجز
                                    </button>
                                </form>
                            </td>

                        @endforeach
                    </tbody>
                </table>

            </div>
        </div>
    </div>
</x-app-layout>
