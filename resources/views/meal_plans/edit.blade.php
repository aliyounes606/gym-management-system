<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">تعديل الوجبة: {{ $mealPlan->name }}</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <form action="{{ route('meal-plans.update', $mealPlan->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="mb-4">
                            <label class="block text-gray-700">اسم الوجبة</label>
                            <input type="text" name="name" value="{{ $mealPlan->name }}" class="w-full rounded-md border-gray-300">
                        </div>
                        <div class="mb-4">
                            <label class="block text-gray-700">السعر</label>
                            <input type="number" name="price" value="{{ $mealPlan->price }}" class="w-full rounded-md border-gray-300">
                        </div>
                        <div class="mb-4">
                            <label class="block text-gray-700">السعرات</label>
                            <input type="number" name="calories" value="{{ $mealPlan->calories }}" class="w-full rounded-md border-gray-300">
                        </div>
                        <div class="md:col-span-2 mb-4">
                            <label class="block text-gray-700">الوصف</label>
                            <textarea name="description" class="w-full rounded-md border-gray-300">{{ $mealPlan->description }}</textarea>
                        </div>
                    </div>
                    <div class="flex justify-between">
                        <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded-md">حفظ التغييرات</button>
                        <a href="{{ route('meal-plans.index') }}" class="text-gray-600">إلغاء</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>