<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('نظام إدارة الوجبات الصحية') }}
            </h2>
          
            @role('admin')
            <div class="flex justify-end">
                <a href="{{ route('meal-plans.create') }}" class="inline-flex items-center px-5 py-2.5 bg-indigo-600 border border-transparent rounded-lg font-bold text-sm text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 shadow-lg transition duration-150 ease-in-out">
                    <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                    </svg>
                    إضافة وجبة جديدة
                </a>
            </div>
            @endrole
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            {{-- رسالة النجاح --}}
            @if(session('success'))
                <div class="mb-4 p-4 bg-green-100 border-r-4 border-green-500 text-green-700 shadow-sm">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h3 class="text-lg font-bold mb-4 text-gray-700 border-r-4 border-green-500 pr-3">قائمة الوجبات الحالية</h3>
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">اسم الوجبة</th>
                                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">الوصف</th>
                                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">السعرات</th>
                                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">السعر</th>
                                    
                                  
                                    @role('admin')
                                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">العمليات</th>
                                    @endrole
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse($plans as $plan)
                                    <tr class="hover:bg-gray-50 transition-colors">
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $plan->name }}</td>
                                        <td class="px-6 py-4 text-sm text-gray-500">{{ Str::limit($plan->description, 50) }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-orange-600 font-semibold">{{ $plan->calories }} سعرة</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-indigo-600 font-bold">{{ $plan->price }} $</td>
                                        
                                        
                                        @role('admin')
                                        <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium">
                                            <div class="flex items-center justify-center space-x-2 space-x-reverse">
                                                <a href="{{ route('meal-plans.edit', $plan->id) }}" class="text-indigo-600 hover:text-indigo-900 bg-indigo-50 px-3 py-1 rounded-full text-xs">تعديل</a>
                                                <form action="{{ route('meal-plans.destroy', $plan->id) }}" method="POST" onsubmit="return confirm('هل أنت متأكد؟')">
                                                    @csrf @method('DELETE')
                                                    <button type="submit" class="text-red-600 hover:text-red-900 bg-red-50 px-3 py-1 rounded-full text-xs">حذف</button>
                                                </form>
                                            </div>
                                        </td>
                                        @endrole
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="px-6 py-4 text-center text-gray-400">لا يوجد وجبات مضافة بعد.</td>
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