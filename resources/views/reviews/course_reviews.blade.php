<x-app-layout>
    {{-- خلفية فاتحة للصفحة كاملة --}}
    <div class="py-12 bg-gray-50 min-h-screen" dir="rtl">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-10">

            {{-- الهيدر --}}
            <div class="flex flex-col md:flex-row justify-between items-center gap-4 border-b border-gray-200 pb-6">
                <div>
                    <h2 class="text-3xl font-black text-gray-800 tracking-tight">
                        مراجعات الكورسات التدريبية 🎓
                    </h2>
                    <p class="text-gray-500 mt-1">
                        آراء وتقييمات المتدربين للكورسات المتاحة.
                    </p>
                </div>

                {{-- إحصائية سريعة --}}
                <div class="flex items-center gap-3 bg-white px-5 py-3 rounded-2xl shadow-sm border border-gray-200">
                    <span class="text-gray-500 font-bold text-sm">إجمالي التقييمات</span>
                    <span
                        class="bg-indigo-600 text-white px-3 py-1 rounded-lg text-sm font-black shadow-md shadow-indigo-200">
                        {{ count($course_reviews) }}
                    </span>
                </div>
            </div>

            {{-- جدول التقييمات (داخل بطاقة داكنة) --}}
            <div class="bg-gray-900 border border-gray-800 rounded-2xl overflow-hidden shadow-2xl">

                {{-- رأس الجدول --}}
                <div class="bg-gray-800/50 px-6 py-4 border-b border-gray-800 flex items-center justify-between">
                    <h3 class="text-white font-bold flex items-center gap-2">
                        <span class="w-2 h-2 rounded-full bg-orange-500 animate-pulse"></span>
                        أحدث المراجعات
                    </h3>
                </div>

                @if ($course_reviews->isEmpty())
                    <div class="p-20 text-center flex flex-col items-center justify-center">
                        <div
                            class="w-20 h-20 bg-gray-800 rounded-full flex items-center justify-center mb-4 border border-gray-700">
                            <svg class="w-10 h-10 text-gray-600" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-white mb-2">لا توجد مراجعات حتى الآن</h3>
                        <p class="text-gray-500">لم يقم أي متدرب بتقييم الكورسات بعد.</p>
                    </div>
                @else
                    <div class="overflow-x-auto">
                        <table class="w-full text-right">
                            <thead class="bg-black/40 text-gray-400 uppercase text-xs font-bold tracking-wider">
                                <tr>
                                    <th class="px-6 py-4">المتدرب</th>
                                    <th class="px-6 py-4">الكورس المستهدف</th>
                                    <th class="px-6 py-4 text-center">التقييم</th>
                                    <th class="px-6 py-4">ملاحظات المتدرب</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-800">
                                @foreach ($course_reviews as $tr)
                                    <tr class="hover:bg-white/5 transition-colors duration-200 group">

                                        {{-- المتدرب --}}
                                        <td class="px-6 py-5">
                                            <div class="flex items-center gap-3">
                                                <div
                                                    class="w-10 h-10 rounded-full bg-gradient-to-br from-indigo-600 to-purple-600 flex items-center justify-center text-white font-bold text-sm shadow-lg border border-indigo-500/30">
                                                    {{ mb_substr($tr->user->name ?? 'م', 0, 1) }}
                                                </div>
                                                <div>
                                                    <div
                                                        class="text-white font-bold text-sm group-hover:text-indigo-400 transition-colors">
                                                        {{ optional($tr->user)->name ?? 'مستخدم محذوف' }}
                                                    </div>
                                                    <div class="text-xs text-gray-500">متدرب</div>
                                                </div>
                                            </div>
                                        </td>

                                        {{-- الكورس --}}
                                        <td class="px-6 py-5">
                                            <div class="flex items-center gap-2">
                                                <span class="w-1.5 h-1.5 rounded-full bg-orange-500"></span>
                                                <span class="text-gray-300 text-sm font-medium">
                                                    {{ optional($tr->reviewable)->name ?? 'كورس غير موجود' }}
                                                </span>
                                            </div>
                                        </td>

                                        {{-- التقييم والنجوم --}}
                                        <td class="px-6 py-5 text-center">
                                            <div class="flex flex-col items-center justify-center gap-1">
                                                <span class="text-2xl font-black text-white">{{ $tr->rating }}</span>
                                                <div class="flex gap-0.5">
                                                    @for ($i = 1; $i <= 5; $i++)
                                                        <svg class="w-3 h-3 {{ $i <= $tr->rating ? 'text-amber-400' : 'text-gray-700' }} fill-current"
                                                            viewBox="0 0 20 20">
                                                            <path
                                                                d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                                        </svg>
                                                    @endfor
                                                </div>
                                            </div>
                                        </td>

                                        {{-- التعليق --}}
                                        <td class="px-6 py-5">
                                            <p
                                                class="text-gray-400 text-sm italic leading-relaxed bg-gray-800/50 p-3 rounded-lg border border-gray-700/50 min-w-[200px]">
                                                "{{ $tr->comment ?? 'لا يوجد تعليق مكتوب' }}"
                                            </p>
                                        </td>

                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif

            </div>

        </div>
    </div>
</x-app-layout>
