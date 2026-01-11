<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">تعديل التوصية: {{ $mealPlan->name }}</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <form action="{{ route('meal-plans.update', $mealPlan->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        
              

                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700">اسم الوجبة</label>
                            <input type="text" name="name" value="{{ $mealPlan->name }}" class="w-full rounded-md border-gray-300 shadow-sm" required>
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700">السعر ($)</label>
                                <input type="number" name="price" value="{{ $mealPlan->price }}" class="w-full rounded-md border-gray-300 shadow-sm">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">السعرات</label>
                                <input type="number" name="calories" value="{{ $mealPlan->calories }}" class="w-full rounded-md border-gray-300 shadow-sm">
                            </div>
                        </div>

                        <div class="md:col-span-2 mb-4">
                            <label class="block text-sm font-medium text-gray-700">الوصف</label>
                            <textarea name="description" rows="3" class="w-full rounded-md border-gray-300 shadow-sm" required>{{ $mealPlan->description }}</textarea>
                        </div>

                        <div class="md:col-span-2 mb-4 border-t pt-4">
                            <label class="block text-sm font-medium text-gray-700 mb-2">إدارة الصورة</label>
                            
                            @if($mealPlan->image)
                                <div class="mb-3">
                                    <p class="text-xs text-gray-500 mb-1">الصورة الحالية:</p>
                                    <img src="{{ asset('storage/' . $mealPlan->image->url) }}" alt="meal image" class="w-32 h-32 object-cover rounded-lg border shadow-sm">
                                </div>
                            @endif

                            <label class="block text-xs text-indigo-600 font-semibold mb-1">رفع صورة جديدة (اختياري)</label>
                            <input type="file" name="image" accept="image/*" class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100">
                        </div>
                    </div>

                    <div class="flex justify-between items-center mt-6 border-t pt-4">
                        <a href="{{ route('meal-plans.index') }}" class="text-gray-600 hover:text-gray-900 transition">إلغاء</a>
                        <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white px-8 py-2 rounded-md font-bold shadow-md transition">
                            حفظ التغييرات
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>