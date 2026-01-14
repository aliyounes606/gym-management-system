@role('trainer')
    <x-app-layout>
        <div class="py-12">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">

                {{-- Header --}}
                <div class="flex items-center justify-between">
                    <div>
                        <h2 class="text-3xl font-bold text-gray-100 mb-2">الجدول الزمني للمدرب</h2>
                        <p class="text-gray-400">
                            استعراض وإدارة الجلسات الخاصة بالمدرب:
                            <span class="text-indigo-400 font-bold">{{ $trainer->user->name }}</span>
                        </p>
                    </div>
                </div>

                {{-- Alerts --}}
                @if (session('success'))
                    <div
                        class="p-4 rounded-xl bg-green-900/80 border border-green-700 text-green-100 flex items-center gap-3 shadow-lg animate-fade-in-down">
                        <svg class="w-6 h-6 flex-shrink-0 text-green-400" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <div>{{ session('success') }}</div>
                    </div>
                @endif

                {{-- Sessions Table Card --}}
                <div class="bg-gray-900 border border-gray-800 rounded-2xl overflow-hidden shadow-2xl">
                    <div class="p-6 border-b border-gray-800 bg-gray-800/50 flex justify-between items-center">
                        <h3 class="text-lg font-bold text-white flex items-center gap-2">
                            <span class="w-2 h-6 bg-indigo-500 rounded-full"></span>
                            الجلسات المجدولة
                        </h3>
                        <span
                            class="bg-gray-800 text-indigo-400 text-xs font-bold px-3 py-1 rounded-full border border-gray-700">{{ $sessions->count() }}
                            جلسة</span>
                    </div>

                    <table class="min-w-full divide-y divide-gray-200 text-right">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase">العنوان</th>
                                <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase">الكورس</th>
                                {{-- <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase">الفئة</th> --}}
                                {{-- <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase">السعر</th> --}}
                                <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase">السعة</th>
                                <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase">من</th>
                                <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase">إلى</th>
                                {{-- <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase">عدد الأعضاء</th> --}}
                                <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase">الحالة</th>
                                {{-- <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase">الإجراءات</th> --}}
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($sessions as $session)
                                <tr>
                                    <td class="px-6 py-4">{{ $session->title }}</td>
                                    <td class="px-6 py-4">{{ $session->course?->name ?? '---' }}</td>
                                    {{-- <td class="px-6 py-4">{{ $session->category?->name ?? '---' }}</td> --}}
                                    {{-- <td class="px-6 py-4">{{ $session->single_price }}</td> --}}
                                    <td class="px-6 py-4">{{ $session->max_capacity }}</td>
                                    <td class="px-6 py-4">{{ $session->start_time }}</td>
                                    <td class="px-6 py-4">{{ $session->end_time }}</td>
                                    {{-- <td class="px-6 py-4">{{ $session->members_count ?? 0 }}</td> --}}

                                    {{-- Course --}}
                                    <td class="p-5 text-gray-300">
                                        @if ($session->course)
                                            <span
                                                class="inline-flex items-center px-2.5 py-0.5 rounded-lg text-xs font-medium bg-blue-900/50 text-blue-300 border border-blue-800">
                                                {{ $session->course->name }}
                                            </span>
                                        @else
                                            <span class="text-gray-500 text-xs italic">---</span>
                                        @endif
                                    </td>

                                    {{-- Capacity --}}
                                    <td class="p-5 text-center">
                                        <div class="flex flex-col items-center justify-center">
                                            <span
                                                class="text-lg font-bold text-white">{{ $session->members_count ?? 0 }}</span>
                                            <span class="text-xs text-gray-500">من أصل
                                                {{ $session->max_capacity }}</span>
                                        </div>
                                    </td>

                                    <!-- الإجراءات
                                            <td class="px-6 py-4 flex gap-2 justify-end">
                                                <a href="{{ route('gymsessions.show', $session->id) }}"
                                                   class="text-indigo-600 hover:text-indigo-900">عرض</a>
                                                <a href="{{ route('gymsessions.edit', $session->id) }}"
                                                   class="text-yellow-600 hover:text-yellow-900">تعديل</a>
                                                <form action="{{ route('gymsessions.destroy', $session->id) }}" method="POST"
                                                      onsubmit="return confirm('هل أنت متأكد من الحذف؟');">
                                                    @csrf @method('DELETE')
                                                    <button type="submit" class="text-red-600 hover:text-red-900">حذف</button>
                                                </form>
                                            </td>
                                            -->
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    {{-- Actions --}}
                    <td class="p-5 text-center">
                        <div class="flex justify-center gap-2">
                            <a href="{{ route('gymsessions.show', $session->id) }}"
                                class="p-2 bg-gray-800 text-indigo-400 rounded-lg hover:bg-indigo-500 hover:text-white transition shadow border border-gray-700 hover:border-indigo-500"
                                title="عرض">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                </svg>
                            </a>
                            <a href="{{ route('gymsessions.edit', $session->id) }}"
                                class="p-2 bg-gray-800 text-amber-500 rounded-lg hover:bg-amber-500 hover:text-white transition shadow border border-gray-700 hover:border-amber-500"
                                title="تعديل">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                </svg>
                            </a>
                            <form action="{{ route('gymsessions.destroy', $session->id) }}" method="POST"
                                onsubmit="return confirm('هل أنت متأكد؟');">
                                @csrf @method('DELETE')
                                <button type="submit"
                                    class="p-2 bg-gray-800 text-red-400 rounded-lg hover:bg-red-500 hover:text-white transition shadow border border-gray-700 hover:border-red-500"
                                    title="حذف">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                    </svg>
                                </button>
                            </form>
                        </div>
                    </td>
                    </tr>
                    @endforeach
                    </tbody>
                    </table>
                </div>
            </div>
        </div>
        </div>
    </x-app-layout>
@endrole
