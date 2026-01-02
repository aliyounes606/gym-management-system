<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight text-right">
            قائمة الكورسات
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm rounded-lg p-6">

                <table class="min-w-full divide-y divide-gray-200 text-right">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase">الاسم</th>
                            <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase">الوصف</th>
                            <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase">المدرب</th>
                            <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase">السعر الكلي</th>
                        </tr>
                    </thead>

                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($courses as $course)
                            <tr>
                                <td class="px-6 py-4">
                                    {{ $course->name }}
                                </td>

                                <td class="px-6 py-4">
                                    {{ $course->description }}
                                </td>

                                <td class="px-6 py-4">
                                    {{ $course->trainerProfile->user->name ?? 'لا يوجد مدرب' }}
                                </td>

                                <td class="px-6 py-4">
                                    {{ $course->total_price }}
                                </td>
                                 <td class="px-6 py-4 flex gap-2 justify-end">
                                <!-- زر تأكيد الحجز -->
                              <form action="{{ route('bookings.bookCorse') }}" method="POST">
                                    @csrf
                                    <button
                                        type="submit"
                                        class="bg-green-600 text-white px-3 py-1 rounded hover:bg-green-700"
                                        
                                    >
                                        حجز
                                    </button>
                                </form>
                            </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>
        </div>
    </div>
</x-app-layout>
