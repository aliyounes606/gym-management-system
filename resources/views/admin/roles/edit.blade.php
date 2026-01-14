@role('admin')
<x-app-layout>
    <div class="py-12 text-right">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 shadow-sm sm:rounded-lg">
                <h3 class="text-lg font-bold mb-4">تعديل الدور: {{ $role->name }}</h3>
                <form action="{{ route('roles.update', $role->id) }}" method="POST">
                    @csrf @method('PUT')

                    <div class="mb-4">
                        <label class="block text-gray-700">اسم الدور</label>
                        <input type="text" name="name" value="{{ $role->name }}"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 font-bold mb-2">تحديث الصلاحيات:</label>
                        <div class="grid grid-cols-2 gap-4">
                            @foreach ($permissions as $permission)
                                <label class="inline-flex items-center">
                                    <input type="checkbox" name="permissions[]" value="{{ $permission->name }}"
                                        {{ $role->hasPermissionTo($permission->name) ? 'checked' : '' }}
                                        class="rounded border-gray-300 text-indigo-600 shadow-sm">
                                    <span class="mr-2 text-sm text-gray-600">{{ $permission->name }}</span>
                                </label>
                            @endforeach
                        </div>
                    </div>

                    <div class="flex justify-end gap-2">
                        <a href="{{ route('roles.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded">إلغاء</a>
                        <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded">تحديث
                            البيانات</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
@endrole