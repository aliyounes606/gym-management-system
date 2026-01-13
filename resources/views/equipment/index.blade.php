<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">

            {{-- Header & Add Button --}}
            <div class="flex items-center justify-between">
                <div>
                    <h2 class="text-3xl font-bold text-gray-100 mb-2">إدارة المعدات الرياضية</h2>
                    <p class="text-gray-400">تتبع حالة الأجهزة والمعدات وصيانتها.</p>
                </div>
                <a href="{{ route('equipment.create') }}"
                    class="bg-indigo-600 hover:bg-indigo-500 text-white px-6 py-3 rounded-xl font-bold transition duration-300 shadow-lg shadow-indigo-500/20 flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-11a1 1 0 10-2 0v2H7a1 1 0 100 2h2v2a1 1 0 102 0v-2h2a1 1 0 100-2h-2V7z"
                            clip-rule="evenodd" />
                    </svg>
                    إضافة معدة جديدة
                </a>
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

            {{-- Equipment Table Card --}}
            <div class="bg-gray-900 border border-gray-800 rounded-2xl overflow-hidden shadow-2xl">
                <div class="p-6 border-b border-gray-800 bg-gray-800/50 flex justify-between items-center">
                    <h3 class="text-lg font-bold text-white flex items-center gap-2">
                        <span class="w-2 h-6 bg-indigo-500 rounded-full"></span>
                        قائمة الأجهزة والمعدات
                    </h3>
                    <span
                        class="bg-gray-800 text-indigo-400 text-xs font-bold px-3 py-1 rounded-full border border-gray-700">{{ $equipment->count() }}
                        قطعة</span>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-right">
                        <thead class="bg-black/40 text-gray-400 uppercase text-xs font-bold tracking-wider">
                            <tr>
                                <th class="p-5">#</th>
                                <th class="p-5">اسم المعدة</th>
                                <th class="p-5 text-center">الحالة</th>
                                <th class="p-5 text-center">الكمية</th>
                                <th class="p-5 text-center">الإجراءات</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-800">
                            @forelse ($equipment as $item)
                                <tr class="hover:bg-white/5 transition duration-200 group">
                                    {{-- ID --}}
                                    <td class="p-5 text-gray-500 font-mono text-sm">
                                        {{ $loop->iteration }}
                                    </td>

                                    {{-- Name --}}
                                    <td class="p-5">
                                        <div class="font-bold text-gray-100 text-lg">{{ $item->name }}</div>
                                    </td>

                                    {{-- Status --}}
                                    <td class="p-5 text-center">
                                        @if ($item->status == 'active' || $item->status == 'متاح')
                                            {{-- افترضت أن الحالة إما active أو متاح، يمكنك تعديل الشرط --}}
                                            <span
                                                class="bg-green-500/10 text-green-400 px-3 py-1 rounded-full text-xs font-bold border border-green-500/20">
                                                متاح
                                            </span>
                                        @elseif($item->status == 'maintenance' || $item->status == 'صيانة')
                                            <span
                                                class="bg-yellow-500/10 text-yellow-400 px-3 py-1 rounded-full text-xs font-bold border border-yellow-500/20">
                                                في الصيانة
                                            </span>
                                        @else
                                            <span
                                                class="bg-red-500/10 text-red-400 px-3 py-1 rounded-full text-xs font-bold border border-red-500/20">
                                                {{ $item->status }}
                                            </span>
                                        @endif
                                    </td>

                                    {{-- Quantity --}}
                                    <td class="p-5 text-center">
                                        <span
                                            class="font-mono text-gray-300 bg-gray-800 px-2 py-1 rounded border border-gray-700">
                                            {{ $item->quantity }}
                                        </span>
                                    </td>

                                    {{-- Actions --}}
                                    <td class="p-5 text-center">
                                        <div class="flex justify-center gap-3">
                                            <a href="{{ route('equipment.show', $item->id) }}"
                                                class="p-2 bg-gray-800 text-green-400 rounded-lg hover:bg-green-500 hover:text-white transition shadow border border-gray-700 hover:border-green-500"
                                                title="عرض">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                                    viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                                </svg>
                                            </a>
                                            <a href="{{ route('equipment.edit', $item->id) }}"
                                                class="p-2 bg-gray-800 text-indigo-400 rounded-lg hover:bg-indigo-500 hover:text-white transition shadow border border-gray-700 hover:border-indigo-500"
                                                title="تعديل">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                                    viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                </svg>
                                            </a>

                                            <form action="{{ route('equipment.destroy', $item->id) }}" method="POST"
                                                onsubmit="return confirm('هل أنت متأكد من حذف هذه المعدة؟');">
                                                @csrf @method('DELETE')
                                                <button type="submit"
                                                    class="p-2 bg-gray-800 text-red-400 rounded-lg hover:bg-red-500 hover:text-white transition shadow border border-gray-700 hover:border-red-500"
                                                    title="حذف">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5"
                                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                    </svg>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="p-16 text-center text-gray-500">
                                        <div class="flex flex-col items-center justify-center">
                                            <svg class="w-16 h-16 mb-4 opacity-20" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10">
                                                </path>
                                            </svg>
                                            <h3 class="text-xl font-bold text-gray-400 mb-2">القاعة فارغة!</h3>
                                            <p class="mb-6">لم يتم إضافة أي معدات رياضية بعد.</p>
                                            <a href="{{ route('equipment.create') }}"
                                                class="text-indigo-400 hover:text-indigo-300 underline">أضف أول معدة
                                                الآن</a>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    {{-- Pagination Section --}}
                    <div class="p-4 border-t border-gray-800 bg-gray-900/50 rounded-b-2xl">
                        <div class="mt-2" dir="ltr">
                            {{ $equipment->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
