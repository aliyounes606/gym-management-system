<x-app-layout>
    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 overflow-hidden shadow-sm sm:rounded-lg">
                <h3 class="text-lg font-bold mb-4 text-right">إضافة دور جديد</h3>
                <form action="{{ route('roles.store') }}" method="POST">
                    @csrf
                    <div class="mb-4 text-right">
                        <label class="block text-gray-700">اسم الدور (مثلاً: محرر)</label>
                        <input type="text" name="name"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500"
                            required>
                    </div>

                    <div class="mb-4 text-right text-right">
                        <label class="block text-gray-700 font-bold mb-2">تخصيص الصلاحيات:</label>
                        <div class="grid grid-cols-2 gap-4">
                            @foreach ($permissions as $permission)
                                <label class="inline-flex items-center">
                                    <input type="checkbox" name="permissions[]" value="{{ $permission->name }}"
                                        class="rounded border-gray-300 text-indigo-600 shadow-sm">
                                    <span class="mr-2 text-sm text-gray-600">{{ $permission->name }}</span>
                                </label>
                            @endforeach
                        </div>
                    </div>

                    <div class="flex justify-end mt-4">
                        <button type="submit"
                            class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">حفظ
                            الدور</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
