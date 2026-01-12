<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center" dir="rtl">
            <h2 class="font-black text-2xl text-gray-800 leading-tight">
                {{ __('نظام التقييمات والمراجعات') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12" dir="rtl">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            {{-- رسائل النجاح --}}
            @if(session('success'))
                <div class="mb-6 p-4 bg-green-100 border-r-4 border-green-500 text-green-700 shadow-sm rounded-lg">
                    {{ session('success') }}
                </div>
            @endif

            {{-- قسم الأزرار الأربعة الرئيسية --}}
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-12">
                
                {{-- زر تقييمات المدربين --}}
                <a href="{{ route('reviews.trainers.index') }}" class="group bg-white p-8 rounded-2xl shadow-sm border border-gray-100 hover:border-indigo-500 hover:shadow-xl transition-all duration-300 text-center">
                    <div class="w-16 h-16 bg-indigo-50 rounded-full flex items-center justify-center mx-auto mb-4 group-hover:bg-indigo-600 transition-colors">
                        <svg class="w-8 h-8 text-indigo-600 group-hover:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                    </div>
                    <h3 class="text-lg font-bold text-gray-800">تقييمات المدربين</h3>
                    <p class="text-sm text-gray-500 mt-2">عرض اراء المتدربين بكل مدرب في هذا النادي الرياضي</p>
                </a>

                {{-- زر تقييمات وجبات الطعام --}}
                <a href="" class="group bg-white p-8 rounded-2xl shadow-sm border border-gray-100 hover:border-green-500 hover:shadow-xl transition-all duration-300 text-center">
                    <div class="w-16 h-16 bg-green-50 rounded-full flex items-center justify-center mx-auto mb-4 group-hover:bg-green-600 transition-colors">
                        <svg class="w-8 h-8 text-green-600 group-hover:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                    </div>
                    <h3 class="text-lg font-bold text-gray-800">تقييمات وجبات الطعام</h3>
                    <p class="text-sm text-gray-500 mt-2">عرض اراء المتدربين بكل وجبة في هذا النادي الرياضي</p>
                </a>

                {{-- زر تقييمات الكورسات --}}
                <a href="#" class="group bg-white p-8 rounded-2xl shadow-sm border border-gray-100 hover:border-orange-500 hover:shadow-xl transition-all duration-300 text-center">
                    <div class="w-16 h-16 bg-orange-50 rounded-full flex items-center justify-center mx-auto mb-4 group-hover:bg-orange-600 transition-colors">
                        <svg class="w-8 h-8 text-orange-600 group-hover:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                        </svg>
                    </div>
                    <h3 class="text-lg font-bold text-gray-800">تقييمات الكورسات</h3>
                    <p class="text-sm text-gray-500 mt-2">آراء المشاركين في الدورات والبرامج التعليمية</p>
                </a>

                {{-- زر تقييمات الجلسات --}}
                <a href="#" class="group bg-white p-8 rounded-2xl shadow-sm border border-gray-100 hover:border-purple-500 hover:shadow-xl transition-all duration-300 text-center">
                    <div class="w-16 h-16 bg-purple-50 rounded-full flex items-center justify-center mx-auto mb-4 group-hover:bg-purple-600 transition-colors">
                        <svg class="w-8 h-8 text-purple-600 group-hover:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                    </div>
                    <h3 class="text-lg font-bold text-gray-800">تقييمات الجلسات</h3>
                    <p class="text-sm text-gray-500 mt-2">مراجعات الجلسات الاستشارية والتدريبات الخاصة</p>
                </a>

            </div>

            {{-- قسم فارغ للمعالجة المستقبلية أو عرض ملخص --}}
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-3xl border border-gray-100">
                <div class="p-12 text-center">
                    <div class="inline-flex items-center justify-center w-20 h-20 bg-gray-50 rounded-full mb-6">
                        <svg class="w-10 h-10 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-700">اختر تصنيفاً لعرض التقييمات</h3>
                    <p class="text-gray-400 mt-2 max-w-md mx-auto">بإمكانك الضغط على أي من التصنيفات أعلاه للبدء في إدارة ومراجعة تقييمات النظام المختلفة.</p>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>