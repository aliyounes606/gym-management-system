<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">إضافة وجبة جديدة</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form action="{{ route('meal-plans.store') }}" method="POST" class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        @csrf
                        <div>
                            <label class="block text-sm font-medium text-gray-700">اسم الوجبة</label>
                            <input type="text" name="name" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">السعر ($)</label>
                            <input type="number" name="price" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
                        </div>
                        <div>
                          <label class="block text-sm font-medium text-gray-700">السعرات الحرارية</label>
                          <input type="number" name="calories" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
                        </div>
                        <div class="md:col-span-3">
                            <label class="block text-sm font-medium text-gray-700">وصف الوجبة</label>
                            <textarea name="description" rows="4" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required></textarea>
                        </div>
                        <div class="md:col-span-3 flex justify-between">
                            <a href="{{ route('meal-plans.index') }}" class="text-gray-600 hover:underline">إلغاء والعودة</a>
                            <button type="submit" class="inline-flex items-center px-6 py-2 bg-indigo-600 text-white rounded-md font-semibold">حفظ الوجبة</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>