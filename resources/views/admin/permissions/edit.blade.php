@role('admin')
<x-app-layout>
    <div class="py-12 text-right" dir="rtl">
        <div class="max-w-xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-8 shadow-sm sm:rounded-lg">
                <h3 class="text-lg font-bold mb-6">تعديل الصلاحية</h3>
                <form action="{{ route('permissions.update', $permission->id) }}" method="POST">
                    @csrf @method('PUT')

                    <div class="mb-6">
                        <label class="block text-gray-700 mb-2 font-bold">اسم الصلاحية الجديد</label>
                        <input type="text" name="name" value="{{ $permission->name }}"
                            class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500" required>
                    </div>

                    <div class="flex justify-start gap-3">
                        <button type="submit"
                            class="bg-indigo-600 text-white px-6 py-2 rounded-md hover:bg-indigo-700">تحديث</button>
                        <a href="{{ route('permissions.index') }}"
                            class="bg-gray-200 text-gray-700 px-6 py-2 rounded-md">إلغاء</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
@endrole