<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight text-right">إدارة أقسام التداريب</h2>
    </x-slot>

    <div class="py-12 text-right" dir="rtl">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 rounded-lg shadow-sm mb-6">
                <form action="{{ route('categories.store') }}" method="POST" class="flex gap-4">
                    @csrf
                    <input type="text" name="name" placeholder="اسم التدريب الجديد..."
                        class="flex-1 rounded-md border-gray-300 shadow-sm" required>
                    <button type="submit"
                        class="bg-green-600 text-white px-6 py-2 rounded-md hover:bg-green-700">إضافة</button>
                </form>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <table class="w-full text-right border-collapse">
                    <thead>
                        <tr class="border-b-2">
                            <th class="p-3">اسم القسم</th>
                            <th class="p-3">الإجراءات</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($categories as $category)
                            <tr class="border-b">
                                <td class="p-3 font-bold">{{ $category->name }}</td>
                                <td class="p-3 flex gap-3">
                                    <a href="{{ route('categories.edit', $category->id) }}"
                                        class="text-blue-600">تعديل</a>
                                    <form action="{{ route('categories.destroy', $category->id) }}" method="POST">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="text-red-600"
                                            onclick="return confirm('حذف القسم؟')">حذف</button>
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
