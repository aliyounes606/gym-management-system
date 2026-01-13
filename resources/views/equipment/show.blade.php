<x-app-layout>
    <div class="py-12">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">

            {{-- Header & Back Button --}}
            <div class="flex items-center justify-between">
                <div>
                    <h2 class="text-3xl font-bold text-gray-100 mb-2">تفاصيل المعدة</h2>
                    <p class="text-gray-400">استعراض الحالة والمعلومات الخاصة بالجهاز.</p>
                </div>
                <a href="{{ route('equipment.index') }}"
                    class="text-gray-400 hover:text-white transition flex items-center gap-2 group">
                    <div
                        class="p-2 bg-gray-800 rounded-lg group-hover:bg-gray-700 transition border border-gray-700 group-hover:border-gray-600">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M10 18a8 8 0 100-16 8 8 0 000 16zm.707-10.293a1 1 0 00-1.414-1.414l-3 3a1 1 0 000 1.414l3 3a1 1 0 001.414-1.414L9.414 11H13a1 1 0 100-2H9.414l1.293-1.293z"
                                clip-rule="evenodd" />
                        </svg>
                    </div>
                    <span>عودة للقائمة</span>
                </a>
            </div>

            {{-- Main Content Card --}}
            <div
                class="bg-gray-900 border border-gray-800 rounded-2xl overflow-hidden shadow-2xl grid grid-cols-1 md:grid-cols-2">

                {{-- 1. Image Section (Right Side on RTL) --}}
                <div class="relative h-96 md:h-auto bg-gray-800 flex items-center justify-center overflow-hidden group">
                    @if ($equipment->image)
                        <img src="{{ Storage::url($equipment->image->path) }}" alt="{{ $equipment->name }}"
                            class="absolute inset-0 w-full h-full object-cover transition duration-700 group-hover:scale-105">

                        {{-- Overlay Gradient for text readability if needed --}}
                        <div
                            class="absolute inset-0 bg-gradient-to-t from-gray-900 via-transparent to-transparent opacity-60">
                        </div>
                    @else
                        <div class="flex flex-col items-center text-gray-600">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-24 w-24 mb-4 opacity-50" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                    d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            <span class="text-sm font-medium">لا توجد صورة متوفرة</span>
                        </div>
                    @endif
                </div>

                {{-- 2. Details Section (Left Side on RTL) --}}
                <div class="p-8 md:p-10 flex flex-col justify-between space-y-6">

                    <div>
                        {{-- ID Badge --}}
                        <span
                            class="inline-block bg-gray-800 text-gray-400 text-xs font-mono py-1 px-2 rounded border border-gray-700 mb-4">
                            ID: #{{ $equipment->id }}
                        </span>

                        {{-- Name --}}
                        <h1 class="text-3xl font-black text-white mb-6 leading-tight">
                            {{ $equipment->name }}
                        </h1>

                        {{-- Info Grid --}}
                        <div class="space-y-6">

                            {{-- Status --}}
                            <div>
                                <h4
                                    class="text-sm font-bold text-gray-400 uppercase tracking-wider mb-2 flex items-center gap-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    الحالة التشغيلية
                                </h4>
                                @if ($equipment->status == 'active' || $equipment->status == 'متاح')
                                    <span
                                        class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-green-500/10 text-green-400 border border-green-500/20 text-sm font-bold">
                                        <span class="w-2 h-2 rounded-full bg-green-500 animate-pulse"></span>
                                        متاح للاستخدام
                                    </span>
                                @elseif($equipment->status == 'maintenance' || $equipment->status == 'صيانة')
                                    <span
                                        class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-yellow-500/10 text-yellow-400 border border-yellow-500/20 text-sm font-bold">
                                        <span class="w-2 h-2 rounded-full bg-yellow-500"></span>
                                        في الصيانة
                                    </span>
                                @else
                                    <span
                                        class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-red-500/10 text-red-400 border border-red-500/20 text-sm font-bold">
                                        <span class="w-2 h-2 rounded-full bg-red-500"></span>
                                        {{ $equipment->status }}
                                    </span>
                                @endif
                            </div>

                            {{-- Categories --}}
                            <div>
                                <h4
                                    class="text-sm font-bold text-gray-400 uppercase tracking-wider mb-2 flex items-center gap-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                                    </svg>
                                    التصنيفات
                                </h4>
                                <div class="flex flex-wrap gap-2">
                                    @forelse($equipment->category as $category)
                                        <span
                                            class="bg-gray-800 text-indigo-300 px-3 py-1 rounded-lg text-sm font-medium border border-gray-700 shadow-sm hover:border-indigo-500 transition cursor-default">
                                            {{ $category->name }}
                                        </span>
                                    @empty
                                        <span class="text-gray-500 text-sm italic">غير مصنف</span>
                                    @endforelse
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Actions --}}
                    <div class="pt-6 border-t border-gray-800 flex flex-col sm:flex-row gap-4">
                        <a href="{{ route('equipment.edit', $equipment->id) }}"
                            class="flex-1 bg-indigo-600 hover:bg-indigo-500 text-white px-4 py-3 rounded-xl font-bold transition duration-300 shadow-lg shadow-indigo-500/20 text-center flex items-center justify-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
                                fill="currentColor">
                                <path
                                    d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                            </svg>
                            تعديل البيانات
                        </a>

                        <form action="{{ route('equipment.destroy', $equipment->id) }}" method="POST"
                            onsubmit="return confirm('هل أنت متأكد من حذف هذه المعدة؟ لا يمكن التراجع عن هذا الإجراء.');"
                            class="flex-1">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                class="w-full bg-transparent hover:bg-red-500/10 text-red-500 hover:text-red-400 border border-red-500/50 hover:border-red-500 px-4 py-3 rounded-xl font-bold transition duration-300 text-center flex items-center justify-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
                                    fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                                        clip-rule="evenodd" />
                                </svg>
                                حذف المعدة
                            </button>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
