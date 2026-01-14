         @hasanyrole('admin|trainer')
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">إرسال توصية وجبة لمتدرب</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    
                    @if ($errors->any())
                        <div class="mb-4 p-4 bg-red-50 text-red-700 rounded-md">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>- {{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('meal-plans.store') }}" method="POST" enctype="multipart/form-data" class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        @csrf
                        

                        <div>
                            <label class="block text-sm font-medium text-gray-700">اسم الوجبة</label>
                            <input type="text" name="name" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">السعر ($)</label>
                            <input type="number" name="price" step="0.01" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">السعرات الحرارية</label>
                            <input type="number" name="calories" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        </div>

                        <div class="md:col-span-3">
                            <label class="block text-sm font-medium text-gray-700">وصف الوجبة / ملاحظات للمتدرب</label>
                            <textarea name="description" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required></textarea>
                        </div>

                        <div class="md:col-span-3">
                            <label class="block text-sm font-medium text-gray-700">صورة الوجبة</label>
                            <input type="file" name="image" accept="image/*" class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100">
                            <p class="mt-1 text-xs text-gray-500"></p>
                        </div>

                        <div class="md:col-span-3 flex justify-between items-center pt-4 border-t">
                            <a href="{{ route('meal-plans.index') }}" class="text-gray-600 hover:underline text-sm">إلغاء والعودة</a>
                            <button type="submit" class="inline-flex items-center px-8 py-3 bg-indigo-600 text-white rounded-md font-bold shadow-sm hover:bg-indigo-700 focus:outline-none transition duration-150">
                               حفظ
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
   @endhasanyrole