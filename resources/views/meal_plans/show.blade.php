<x-app-layout>
    <div class="py-12 bg-gray-50 min-h-screen" dir="rtl">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">

            {{-- 1. الهيدر --}}
            <div class="flex items-center justify-between border-b border-gray-200 pb-6">
                <div>
                    <h2 class="text-3xl font-black text-gray-800 tracking-tight">
                        تفاصيل الوجبة 🍽️
                    </h2>
                    <p class="text-gray-500 mt-1">
                        استعراض المعلومات الغذائية والسعر.
                    </p>
                </div>
                <a href="{{ route('meal-plans.index') }}"
                    class="text-gray-500 hover:text-gray-900 transition flex items-center gap-2 group">
                    <div
                        class="p-2 bg-white border border-gray-300 rounded-lg group-hover:bg-gray-100 transition shadow-sm">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 rtl:rotate-180" viewBox="0 0 20 20"
                            fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M12.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-2.293-2.293a1 1 0 010-1.414z"
                                clip-rule="evenodd" />
                        </svg>
                    </div>
                    <span class="font-bold">العودة للمكتبة</span>
                </a>
            </div>

            {{-- 2. بطاقة التفاصيل (داكنة لتمييز المحتوى) --}}
            <div
                class="bg-gray-900 border border-gray-800 rounded-3xl overflow-hidden shadow-2xl flex flex-col md:flex-row">

                {{-- قسم الصورة (يمين) --}}
                <div class="md:w-1/2 relative h-96 md:h-auto bg-gray-800 overflow-hidden group">
                    @if ($mealPlan->image)
                        <img src="{{ Storage::url($mealPlan->image->path) }}" alt="{{ $mealPlan->name }}"
                            class="absolute inset-0 w-full h-full object-cover transition duration-700 group-hover:scale-105 opacity-90 group-hover:opacity-100">
                    @else
                        <div
                            class="absolute inset-0 flex flex-col items-center justify-center text-gray-600 bg-gray-800">
                            <svg class="w-20 h-20 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                    d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z">
                                </path>
                            </svg>
                            <span class="text-sm font-bold">لا توجد صورة</span>
                        </div>
                    @endif

                    {{-- تدرج لوني فوق الصورة --}}
                    <div
                        class="absolute inset-0 bg-gradient-to-t from-gray-900 via-transparent to-transparent opacity-80 md:hidden">
                    </div>
                </div>

                {{-- قسم التفاصيل (يسار) --}}
                <div class="md:w-1/2 p-8 md:p-10 flex flex-col justify-center">

                    <div class="mb-6">
                        <span
                            class="inline-block px-3 py-1 mb-3 rounded-full bg-emerald-500/10 text-emerald-400 text-xs font-bold border border-emerald-500/20">
                            نظام غذائي صحي
                        </span>
                        <h1 class="text-4xl font-black text-white leading-tight mb-2">
                            {{ $mealPlan->name }}
                        </h1>
                    </div>

                    {{-- بطاقات المعلومات الصغيرة --}}
                    <div class="flex gap-4 mb-8">
                        <div class="flex-1 bg-gray-800 rounded-xl p-4 border border-gray-700 text-center">
                            <span class="block text-gray-400 text-xs font-bold mb-1">السعرات الحرارية</span>
                            <span class="block text-2xl font-black text-orange-400">{{ $mealPlan->calories }}</span>
                            <span class="text-xs text-gray-500">Kcal</span>
                        </div>
                        <div class="flex-1 bg-gray-800 rounded-xl p-4 border border-gray-700 text-center">
                            <span class="block text-gray-400 text-xs font-bold mb-1">سعر الوجبة</span>
                            <span class="block text-2xl font-black text-indigo-400">${{ $mealPlan->price }}</span>
                            <span class="text-xs text-gray-500">USD</span>
                        </div>
                    </div>

                    <div class="prose prose-invert mb-8">
                        <h4 class="text-white font-bold text-lg mb-2 flex items-center gap-2">
                            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                </path>
                            </svg>
                            الوصف والمكونات
                        </h4>
                        <p class="text-gray-400 leading-relaxed text-sm">
                            {{ $mealPlan->description }}
                        </p>
                    </div>

                    @hasanyrole('admin|trainer')
                        <div class="flex gap-3 pt-6 border-t border-gray-800">
                            <a href="{{ route('meal-plans.edit', $mealPlan->id) }}"
                                class="flex-1 bg-indigo-600 hover:bg-indigo-500 text-white font-bold py-3 rounded-xl text-center transition shadow-lg shadow-indigo-500/20">
                                تعديل الوجبة
                            </a>
                            <form action="{{ route('meal-plans.destroy', $mealPlan->id) }}" method="POST"
                                onsubmit="return confirm('هل أنت متأكد؟')" class="flex-1">
                                @csrf @method('DELETE')
                                <button type="submit"
                                    class="w-full bg-gray-800 hover:bg-red-600 hover:text-white text-gray-300 font-bold py-3 rounded-xl text-center transition border border-gray-700 hover:border-red-500">
                                    حذف
                                </button>
                            </form>
                        </div>
                    @endhasanyrole

                </div>
            </div>

        </div>
    </div>
</x-app-layout>
