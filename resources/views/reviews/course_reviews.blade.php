<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center" dir="rtl">
            <h2 class="font-black text-2xl text-gray-800 leading-tight">
                {{ __('سجل مراجعات الكورسات التدريبية') }}
            </h2>
            
            <div class="flex items-center gap-2 bg-indigo-50 px-4 py-2 rounded-2xl border border-indigo-100">
                <span class="text-indigo-600 font-bold text-sm">إجمالي التقييمات:</span>
                <span class="bg-indigo-600 text-white px-3 py-0.5 rounded-lg text-xs font-black">{{ count($course_reviews) }}</span>
            </div>
        </div>
    </x-slot>

    <div class="py-12" dir="rtl">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            {{-- بطاقة عرض التقييمات --}}
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-3xl border border-gray-100 shadow-xl shadow-gray-100/50">
                <div class="p-8">
                    <div class="overflow-x-auto">
                        <table class="w-full text-right border-separate border-spacing-y-3">
                            <thead>
                                <tr class="text-gray-400 text-xs font-black uppercase tracking-widest px-6">
                                    <th class="px-6 py-4">المتدرب</th>
                                    <th class="px-6 py-4">الكورس المستهدف</th>
                                    <th class="px-6 py-4">التقييم الرقمي</th>
                                    <th class="px-6 py-4">التعليق والملاحظات</th>
                                    <th class="px-6 py-4 text-center">النجوم</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-50">
                                @foreach($course_reviews as $tr)
                                    <tr class="hover:bg-indigo-50/50 transition-all duration-300 group">
                                        {{-- اسم المتدرب --}}
                                        <td class="px-6 py-5 bg-white group-hover:bg-transparent rounded-r-2xl">
                                            <div class="flex items-center gap-3">
                                                <div class="w-10 h-10 bg-indigo-100 text-indigo-600 rounded-full flex items-center justify-center font-black shadow-sm">
                                                    {{ mb_substr($tr->user->name ?? 'م', 0, 1) }}
                                                </div>
                                                <div>
                                                    <div class="font-black text-gray-800 group-hover:text-indigo-600 transition-colors">
                                                        {{ optional($tr->user)->name ?? 'مستخدم محذوف' }}
                                                    </div>
                                                    <div class="text-[10px] text-gray-400 font-bold uppercase">Trainee Profile</div>
                                                </div>
                                            </div>
                                        </td>

                                        {{-- اسم الكورس --}}
                                        <td class="px-6 py-5 bg-white group-hover:bg-transparent">
                                            <div class="flex items-center gap-2">
                                                <div class="w-2 h-2 rounded-full bg-emerald-500"></div>
                                                <span class="font-bold text-gray-700 text-sm">
                                                    {{ optional($tr->reviewable)->name ?? 'كورس غير موجود' }}
                                                </span>
                                            </div>
                                        </td>

                                        {{-- التقييم الرقمي --}}
                                        <td class="px-6 py-5 bg-white group-hover:bg-transparent text-center">
                                            <div class="inline-flex items-center px-3 py-1 bg-amber-50 border border-amber-100 rounded-lg shadow-sm">
                                                <span class="text-amber-700 font-black text-sm">{{ $tr->rating }}</span>
                                                <svg class="w-3 h-3 text-amber-500 mr-1 fill-current" viewBox="0 0 20 20">
                                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                                </svg>
                                            </div>
                                        </td>

                                        {{-- التعليق --}}
                                        <td class="px-6 py-5 bg-white group-hover:bg-transparent">
                                            <p class="text-gray-500 text-sm leading-relaxed max-w-xs truncate hover:whitespace-normal transition-all cursor-help italic">
                                                "{{ $tr->comment ?? 'بدون تعليق' }}"
                                            </p>
                                        </td>

                                        {{-- التقييم بالنجوم --}}
                                        <td class="px-6 py-5 bg-white group-hover:bg-transparent rounded-l-2xl text-center">
                                            <div class="flex items-center justify-center gap-0.5">
                                                @for($i = 1; $i <= 5; $i++)
                                                    <svg class="w-4 h-4 {{ $i <= $tr->rating ? 'text-amber-400' : 'text-gray-200' }} fill-current transition-colors duration-200" viewBox="0 0 20 20">
                                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                                    </svg>
                                                @endfor
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            {{-- حالة عدم وجود بيانات --}}
            @if($course_reviews->isEmpty())
                <div class="bg-white p-20 text-center rounded-3xl border-2 border-dashed border-gray-100 shadow-inner">
                    <div class="w-24 h-24 bg-indigo-50 rounded-full flex items-center justify-center mx-auto mb-6 text-indigo-200 animate-pulse">
                        <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" /></svg>
                    </div>
                    <h3 class="text-2xl font-black text-gray-700">لا توجد مراجعات للكورسات حالياً</h3>
                    <p class="text-gray-400 mt-2 font-bold">بمجرد قيام المتدربين بتقييم كورساتهم، ستظهر البيانات التفصيلية هنا.</p>
                </div>
            @endif

        </div>
    </div>
</x-app-layout>