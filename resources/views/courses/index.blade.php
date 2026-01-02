<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight text-right">
            قائمة الكورسات
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm rounded-lg p-6">
                @if (session('success'))
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4 text-center">
                        {{ session('success') }}
                    </div>
                @endif

                <div class="flex justify-end mb-4">
                    <a href="{{ route('courses.create') }}"
                       class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                        إضافة كورس جديد
                    </a>
                </div>

                <table class="min-w-full divide-y divide-gray-200 text-right">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase">#</th>
                            <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase">اسم الكورس</th>
                            <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase">الوصف</th>
                            <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase">المدرب</th>
                            <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase">السعر</th>
                            <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase">الإجراءات</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($courses as $course)
                            <tr>
                                <td class="px-6 py-4">{{ $loop->iteration }}</td>
                                <td class="px-6 py-4">{{ $course->name }}</td>
                                <td class="px-6 py-4">{{ $course->description }}</td>
                               <td class="px-6 py-4">
                           {{ $course->trainerProfile ? $course->trainerProfile->user->name : 'بدون مدرب' }}
                              </td>

                                <td class="px-6 py-4">{{ $course->total_price }}</td>
                                <td class="px-6 py-4 flex gap-2 justify-end">
                                    <a href="{{ route('courses.edit', $course->id) }}"
                                       class="text-indigo-600 hover:text-indigo-900">تعديل</a>
                                    <form action="{{ route('courses.destroy', $course->id) }}" method="POST"
                                          onsubmit="return confirm('هل أنت متأكد من الحذف؟');">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-900">حذف</button>
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
