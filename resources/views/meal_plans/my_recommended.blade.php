<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight text-right">وجباتي الموصى بها</h2>
    </x-slot>

    <div class="py-12" dir="rtl">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @forelse($recommendations as $rec)
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-4 border-t-4 border-indigo-500">
                        @if($rec->mealPlan->image)
                            <img src="{{ asset('storage/' . $rec->mealPlan->image->path) }}" class="w-full h-48 object-cover rounded-lg mb-4">
                        @endif
                        <h3 class="text-xl font-bold text-gray-800">{{ $rec->mealPlan->name }}</h3>
                        <p class="text-gray-600 mt-2">{{ $rec->mealPlan->description }}</p>
                        <div class="flex justify-between items-center mt-4">
                            <span class="text-orange-600 font-bold">{{ $rec->mealPlan->calories }} سعرة</span>
                            <span class="text-xs text-gray-400">بواسطة: {{ $rec->trainer->name }}</span>
                        </div>
                    </div>
                @empty
                    <div class="col-span-3 text-center py-10 bg-white rounded-lg shadow">
                        <p class="text-gray-500">لا توجد وجبات موصى بها لك حالياً.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</x-app-layout>