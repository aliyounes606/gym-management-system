<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight text-right">
            قائمة المعدات
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
                    <a href="{{ route('equipment.create') }}"
                       class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                        إضافة معدة جديدة
                    </a>
                </div>

                <table class="min-w-full divide-y divide-gray-200 text-right">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase">#</th>
                            <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase">اسم المعدة</th>
                            <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase">الحالة</th>
                            <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase">الكمية</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($equipment as $equipment)
                            <tr>
                                <td class="px-6 py-4">{{ $loop->iteration }}</td>
                                <td class="px-6 py-4">{{ $equipment->name }}</td>
                                <td class="px-6 py-4">{{ $equipment->status }}</td>
                                <td class="px-6 py-4">{{ $equipment->quantity }}</td>
                               <td class="px-6 py-4">
                                <td class="px-6 py-4 flex gap-2 justify-end">
                                    <a href="{{ route('equipment.edit', $equipment->id) }}"
                                       class="text-indigo-600 hover:text-indigo-900">تعديل</a>
                                    <form action="{{ route('equipment.destroy', $equipment->id) }}" method="POST"
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
