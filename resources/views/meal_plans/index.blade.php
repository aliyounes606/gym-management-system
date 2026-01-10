<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('مكتبة الوجبات ونظام التوصيات') }}
            </h2>
          
            @role('admin')
            <div class="flex justify-end">
                <a href="{{ route('meal-plans.create') }}" class="inline-flex items-center px-5 py-2.5 bg-indigo-600 border border-transparent rounded-lg font-bold text-sm text-white hover:bg-indigo-700 shadow-lg transition">
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
            
            @if(session('success'))
                <div class="mb-4 p-4 bg-green-100 border-r-4 border-green-500 text-green-700 shadow-sm">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h3 class="text-lg font-bold mb-4 text-gray-700 border-r-4 border-indigo-500 pr-3">مكتبة الوجبات العامة</h3>
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200 text-right" dir="rtl">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase">الصورة</th>
                                    <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase">الوجبة</th>
                                    <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase">السعرات</th>
                                    <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase">السعر</th>
                                    @role('admin')
                                    <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase">المتدربين </th>
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

                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-orange-600 font-semibold">{{ $plan->calories }} سعرة</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-indigo-600 font-bold">{{ $plan->price }} $</td>
                                        
                                        @role('admin')
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <form action="{{ route('meal-plans.recommend') }}" method="POST" class="flex flex-col space-y-2">
                                                @csrf
                                                <input type="hidden" name="meal_plan_id" value="{{ $plan->id }}">
                                                <select name="user_ids[]" required multiple class="text-xs border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 min-h-[80px]">
                                                    @foreach($trainees as $trainee)
                                                        <option value="{{ $trainee->id }}">{{ $trainee->name }}</option>
                                                    @endforeach
                                                </select>
                                                <button type="submit" class="bg-green-500 hover:bg-green-600 text-white px-2 py-1 rounded text-xs transition font-bold">
                                                    إرسال للمختارين
                                                </button>
                                                <span class="text-[9px] text-gray-400">علق على Ctrl للاختيار المتعدد</span>
                                            </form>
                                        </td>

                                        <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium">
                                            <div class="flex items-center justify-center space-x-2 space-x-reverse">
                                                <a href="{{ route('meal-plans.edit', $plan->id) }}" class="text-indigo-600 hover:text-indigo-900 bg-indigo-50 px-3 py-1 rounded-full text-xs transition">تعديل</a>
                                                <form action="{{ route('meal-plans.destroy', $plan->id) }}" method="POST" onsubmit="return confirm('هل أنت متأكد من حذف هذه الوجبة؟')">
                                                    @csrf @method('DELETE')
                                                    <button type="submit" class="text-red-600 hover:text-red-900 bg-red-50 px-3 py-1 rounded-full text-xs transition">حذف</button>
                                                </form>
                                            </div>
                                        </td>
                                        @endrole
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="px-6 py-10 text-center text-gray-400 italic">لا توجد وجبات في المكتبة حالياً.</td>
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