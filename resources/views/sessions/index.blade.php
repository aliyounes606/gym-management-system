@role('admin')
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight text-right">
            قائمة الجلسات
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm rounded-lg p-6">

                <div class="flex justify-end mb-4">
                    <a href="{{ route('gymsessions.create') }}"
                       class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                        إضافة جلسة جديدة
                    </a>
                </div>

                @if(session('success'))
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4 text-center">
                        {{ session('success') }}
                    </div>
                @endif

                <table class="min-w-full divide-y divide-gray-200 text-right">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase">العنوان</th>
                            <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase">المدرب</th>
                            <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase">الكورس</th>
                            <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase">الفئة</th>
                            <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase">السعر</th>
                            <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase">السعة</th>
                            <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase">من</th>
                            <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase">إلى</th>
                            <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase">الإجراءات</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($sessions as $session)
                            <tr>
                                <td class="px-6 py-4">{{ $session->title }}</td>
                               <td class="px-6 py-4">{{ $session->trainer?->user?->name ?? '---' }}</td>
                               <td class="px-6 py-4">{{ $session->course?->name ?? '---' }}</td>
                               <td class="px-6 py-4">{{ $session->category?->name ?? '---' }}</td>

                                <td class="px-6 py-4">{{ $session->single_price }}</td>
                                <td class="px-6 py-4">{{ $session->max_capacity }}</td>
                                <td class="px-6 py-4">{{ $session->start_time }}</td>
                                <td class="px-6 py-4">{{ $session->end_time }}</td>
                                <td class="px-6 py-4 flex gap-2 justify-end">
                                    <a href="{{ route('gymsessions.show', $session->id) }}"
                                       class="text-indigo-600 hover:text-indigo-900">عرض</a>
                                    <a href="{{ route('gymsessions.edit', $session->id) }}"
                                       class="text-yellow-600 hover:text-yellow-900">تعديل</a>
                                    <form action="{{ route('gymsessions.destroy', $session->id) }}" method="POST"
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
@endrole