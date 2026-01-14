@role('admin')
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight text-right">
            {{ __('تعديل قسم التدريب') }}
        </h2>
    </x-slot>

    <div class="py-12 text-right" dir="rtl">
        <div class="max-w-xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-8 shadow-sm sm:rounded-lg">
                <h3 class="text-lg font-bold mb-6 border-b pb-2">تحديث بيانات القسم</h3>

                <form action="{{ route('categories.update', $category->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-6">
                        <label for="name" class="block text-gray-700 mb-2 font-bold text-sm">اسم القسم
                            (التدريب)</label>
                        <input type="text" name="name" id="name" value="{{ old('name', $category->name) }}"
                            class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                            required>
                        @error('name')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex justify-start gap-3">
                        <button type="submit"
                            class="bg-indigo-600 text-white px-8 py-2 rounded-md hover:bg-indigo-700 transition font-bold shadow-md">
                            تحديث القسم
                        </button>
                        <a href="{{ route('categories.index') }}"
                            class="bg-gray-100 text-gray-700 px-8 py-2 rounded-md hover:bg-gray-200 transition">
                            إلغاء
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
@endrole