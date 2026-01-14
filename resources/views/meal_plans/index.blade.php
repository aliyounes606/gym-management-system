<x-app-layout>
    
  
    <style>
        .pagination-container nav svg { width: 1.5rem !important; display: inline !important; }
        .pagination-container nav div:first-child { margin-bottom: 1rem; }
    </style>

    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('مكتبة الوجبات ونظام التوصيات') }}
            </h2>
          
            {{-- السماح للآدمن والمدرب برؤية زر الإضافة --}}
            @hasanyrole('admin|trainer')
            <div class="flex justify-end">
                <a href="{{ route('meal-plans.create') }}" class="inline-flex items-center px-5 py-2.5 bg-indigo-600 border border-transparent rounded-lg font-bold text-sm text-white hover:bg-indigo-700 shadow-lg transition">
                    <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                    </svg>
                    إضافة وجبة جديدة للمكتبة
                </a>
            </div>
            @endhasanyrole
        </div>
    </x-slot>

    <div class="py-12" dir="rtl">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            @if(session('success'))
                <div class="mb-4 p-4 bg-green-100 border-r-4 border-green-500 text-green-700 shadow-sm">
                    {{ session('success') }}
                </div>
            @endif

            @role('member')
            <div class="mb-8 bg-gradient-to-l from-indigo-600 to-blue-500 rounded-2xl p-6 shadow-xl transform transition hover:scale-[1.01]">
                <div class="flex flex-col md:flex-row justify-between items-center gap-4">
                    <div class="text-white text-right">
                        <h3 class="text-xl font-bold">مرحباً بك في برنامجك الغذائي!</h3>
                        <p class="text-indigo-100 opacity-90">يمكنك هنا تصفح المكتبة العامة، أو الانتقال مباشرة لمشاهدة ما اختاره لك مدربك.</p>
                    </div>
                    <a href="{{ route('meal-plans.my-recommended') }}" class="bg-white text-indigo-600 px-8 py-3 rounded-xl font-black shadow-lg hover:bg-indigo-50 transition flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                        </svg>
                        عرض وجباتي الموصى بها
                    </a>
                </div>
            </div>
            @endrole

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h3 class="text-lg font-bold mb-4 text-gray-700 border-r-4 border-indigo-500 pr-3 text-right italic">مكتبة الوجبات العامة</h3>
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200 text-right">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase">الوجبة</th>
                                    <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase">السعرات</th>
                                    <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase">السعر</th>
                                    
                                    @hasanyrole('admin|trainer')
                                    <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase">المتدربين</th>
                                    @endhasanyrole
                                    
                                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase">العمليات</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse($plans as $plan)
                                    <tr class="hover:bg-gray-50 transition-colors">

                                        <td class="px-6 py-4">
                                            <div class="text-sm font-medium text-gray-900">{{ $plan->name }}</div>
                                            <div class="text-xs text-gray-500">{{ Str::limit($plan->description, 30) }}</div>
                                        </td>

                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-orange-600 font-semibold">{{ $plan->calories }} سعرة</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-indigo-600 font-bold">{{ $plan->price }} $</td>
                                        
                                        @hasanyrole('admin|trainer')
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <form action="{{ route('meal-plans.recommend') }}" method="POST" class="flex flex-col space-y-2">
                                                @csrf
                                                <input type="hidden" name="meal_plan_id" value="{{ $plan->id }}">
                                                <select name="user_ids[]" required multiple class="text-xs border-gray-300 rounded-md shadow-sm min-h-[80px]">
                                                    @foreach($trainees as $trainee)
                                                        <option value="{{ $trainee->id }}">{{ $trainee->name }}</option>
                                                    @endforeach
                                                </select>
                                                <button type="submit" class="bg-green-500 hover:bg-green-600 text-white px-2 py-1 rounded text-xs transition font-bold">
                                                    إرسال للمختارين
                                                </button>
                                            </form>
                                        </td>
                                        @endhasanyrole

                                        <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium">
                                            <div class="flex items-center justify-center space-x-2 space-x-reverse">
                                                
                                                {{-- زر عرض التفاصيل: متاح للجميع (متدرب، مدرب، آدمن) --}}
                                                <a href="{{ route('meal-plans.show', $plan->id) }}" class="text-blue-600 hover:bg-blue-50 px-3 py-1 rounded-full text-xs font-bold border border-blue-200 transition">
                                                    عرض التفاصيل
                                                </a>

                                                @hasanyrole('admin|trainer')
                                                    <a href="{{ route('meal-plans.edit', $plan->id) }}" class="text-indigo-600 hover:text-indigo-900 bg-indigo-50 px-3 py-1 rounded-full text-xs transition">تعديل</a>
                                                    <form action="{{ route('meal-plans.destroy', $plan->id) }}" method="POST" onsubmit="return confirm('هل أنت متأكد؟')">
                                                        @csrf @method('DELETE')
                                                        <button type="submit" class="text-red-600 hover:text-red-900 bg-red-50 px-3 py-1 rounded-full text-xs transition">حذف</button>
                                                    </form>
                                                @endhasanyrole
                                                
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="px-6 py-10 text-center text-gray-400 italic font-bold">لا توجد وجبات في المكتبة حالياً.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="mt-6 pagination-container">
                        {{ $plans->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>