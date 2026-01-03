<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight text-right">
            إضافة معدة جديدة
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-md mx-auto sm:px-6 lg:px-8 bg-white p-6 rounded shadow">
            <form action="{{ route('equipment.store') }}" method="POST">
                @csrf

                <div class="mb-4">
                    <label class="block text-gray-700">اسم المعدة</label>
                    <input type="text" name="name" class="w-full border-gray-300 rounded" value="{{ old('name') }}" required>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700">الحالة</label>
                    <textarea name="status" class="w-full border-gray-300 rounded">{{ old('status') }}</textarea>
                </div>

                 <div class="mb-4">
                    <label class="block text-gray-700">الكمية</label>
                    <textarea name="quantity" class="w-full border-gray-300 rounded">{{ old('quantity') }}</textarea>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700">التصنيفات</label>
                    <select name="categories[]" multiple class="w-full border-gray-300 rounded">
                         @foreach($categories as $category)
                            <option value="{{ $category->id }}">
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" class="bg-green-600 text-white px-6 py-2 rounded hover:bg-green-700">
                    حفظ
                </button>
            </form>
        </div>
    </div>
</x-app-layout>
