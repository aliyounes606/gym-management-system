<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('تفاصيل الوجبة: ') }} {{ $mealPlan->name }}
            </h2>
            <a href="{{ route('meal-plans.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded-lg text-sm">
                عودة للمكتبة
            </a>
        </div>
    </x-slot>

    <div class="py-12" dir="rtl">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-8">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    
                    {{-- عرض الصورة --}}
                    <div>
                        @if($mealPlan->image)
                            <img src="{{ asset('storage/' . $mealPlan->image->path) }}" class="w-full h-auto rounded-2xl shadow-lg border">
                        @else
                            <div class="w-full h-64 bg-gray-100 rounded-2xl flex items-center justify-center text-gray-400">
                                لا توجد صورة متوفرة
                            </div>
                        @endif
                    </div>

                    {{-- تفاصيل الوجبة --}}
                    <div class="flex flex-col justify-center">
                        <h3 class="text-3xl font-bold text-gray-900 mb-4">{{ $mealPlan->name }}</h3>
                        
                        <div class="flex gap-4 mb-6">
                            <span class="bg-orange-100 text-orange-700 px-4 py-1 rounded-full font-bold">
                                 {{ $mealPlan->calories }} سعرة
                            </span>
                            <span class="bg-indigo-100 text-indigo-700 px-4 py-1 rounded-full font-bold">
                                 {{ $mealPlan->price }} $
                            </span>
                        </div>

                        <h4 class="font-bold text-gray-700 mb-2 italic">وصف الوجبة:</h4>
                        <p class="text-gray-600 leading-relaxed mb-6">
                            {{ $mealPlan->description }}
                        </p>

                        @role('member')
                        <div class="mt-4 p-4 bg-blue-50 border-r-4 border-blue-500 rounded">
                            <p class="text-sm text-blue-800 font-medium">
                                هذه الوجبة متوفرة في المكتبة العامة لجميع المتدربين.
                            </p>
                        </div>
                        @endrole
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>