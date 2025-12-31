<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight text-right">
            {{ __('إدارة الصلاحيات (Permissions)') }}
        </h2>
    </x-slot>

    <div class="py-12 text-right" dir="rtl">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 rounded-lg shadow-sm mb-6">
                <form action="{{ route('permissions.store') }}" method="POST" class="flex items-center gap-4">
                    @csrf
                    <div class="flex-1">
                        <input type="text" name="name" placeholder="اسم الصلاحية (مثلاً: edit_posts)"
                            class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500" required>
                    </div>
                    <button type="submit"
                        class="bg-blue-600 text-white px-6 py-2 rounded-md hover:bg-blue-700 transition">
                        إضافة صلاحية
                    </button>
                </form>
            </div>

            @if (session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4 text-center">
                    {{ session('success') }}</div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase">الرقم</th>
                            <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase">اسم الصلاحية
                            </th>
                            <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase">الإجراءات</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($permissions as $permission)
                            <tr>
                                <td class="px-6 py-4">{{ $loop->iteration }}</td>
                                <td class="px-6 py-4 font-medium text-gray-900">{{ $permission->name }}</td>
                                <td class="px-6 py-4 flex gap-4">
                                    <a href="{{ route('permissions.edit', $permission->id) }}"
                                        class="text-indigo-600 hover:text-indigo-900">تعديل</a>
                                    <form action="{{ route('permissions.destroy', $permission->id) }}" method="POST"
                                        onsubmit="return confirm('هل أنت متأكد من حذف هذه الصلاحية؟ سيتم إزالتها من جميع الأدوار المرتبطة بها.');">
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
