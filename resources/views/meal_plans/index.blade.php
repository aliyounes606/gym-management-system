<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('نظام إدارة وتوصية الوجبات') }}
            </h2>
          
            @role('admin')
            <div class="flex justify-end">
                <a href="{{ route('meal-plans.create') }}" class="inline-flex items-center px-5 py-2.5 bg-indigo-600 border border-transparent rounded-lg font-bold text-sm text-white hover:bg-indigo-700 shadow-lg transition">
                    <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                    </svg>
                    إضافة توصية جديدة
                </a>
            </div>
            @endrole
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            @if(session('success'))
                <div class="mb-4 p-4 bg-green-100 border-r-4 border-green-500 text-green-700 shadow-sm">
                    {{ session('success') }}
                </div>
            @endif

            @role('member')
                @if($plans->count() > 0)
                    <div class="mb-6 p-4 bg-indigo-50 border-r-4 border-indigo-500 rounded-lg shadow-sm flex items-center">
                        <div class="flex-shrink-0 bg-indigo-100 p-2 rounded-full">
                            <svg class="h-6 w-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path>
                            </svg>
                        </div>
                        <div class="mr-4">
                            <h4 class="text-sm font-bold text-indigo-900">لديك توصيات غذائية جديدة!</h4>
                            <p class="text-xs text-indigo-700">قام مدربك بإضافة {{ $plans->count() }} توصيات مخصصة لك اليوم.</p>
                        </div>
                    </div>
                @endif
            @endrole

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h3 class="text-lg font-bold mb-4 text-gray-700 border-r-4 border-indigo-500 pr-3">قائمة توصيات الوجبات</h3>
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200 text-right" dir="rtl">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase">الصورة</th>
                                    <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase">الوجبة</th>
                                    <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase">المتدرب</th>
                                    <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase">السعرات</th>
                                    <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase">السعر</th>
                                    @role('admin')
                                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase">العمليات</th>
                                    @endrole
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse($plans as $plan)
                                    <tr class="hover:bg-gray-50 transition-colors">
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            @if($plan->image)
                                                <img src="{{ asset('storage/' . $plan->image->path) }}" class="w-12 h-12 rounded-lg object-cover border shadow-sm">
                                            @else
                                                <div class="w-12 h-12 rounded-lg bg-gray-100 flex items-center justify-center text-gray-400 text-[10px]">بلا صورة</div>
                                            @endif
                                        </td>

                                        <td class="px-6 py-4">
                                            <div class="text-sm font-medium text-gray-900">{{ $plan->name }}</div>
                                            <div class="text-xs text-gray-500">{{ Str::limit($plan->description, 30) }}</div>
                                        </td>

                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="px-2 py-1 bg-blue-50 text-blue-700 rounded-md text-xs font-semibold">
                                                {{ $plan->trainee->name ?? 'غير محدد' }}
                                            </span>
                                        </td>

                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-orange-600 font-semibold">{{ $plan->calories }} سعرة</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-indigo-600 font-bold">{{ $plan->price }} $</td>
                                        
                                        @role('admin')
                                        <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium">
                                            <div class="flex items-center justify-center space-x-2 space-x-reverse">
                                                <a href="{{ route('meal-plans.edit', $plan->id) }}" class="text-indigo-600 hover:text-indigo-900 bg-indigo-50 px-3 py-1 rounded-full text-xs transition">تعديل</a>
                                                <form action="{{ route('meal-plans.destroy', $plan->id) }}" method="POST" onsubmit="return confirm('هل أنت متأكد من حذف هذه التوصية؟')">
                                                    @csrf @method('DELETE')
                                                    <button type="submit" class="text-red-600 hover:text-red-900 bg-red-50 px-3 py-1 rounded-full text-xs transition">حذف</button>
                                                </form>
                                            </div>
                                        </td>
                                        @endrole
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="px-6 py-10 text-center text-gray-400 italic">لا توجد توصيات وجبات حالياً.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>