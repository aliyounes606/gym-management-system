@role('admin')
<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">

            {{-- Breadcrumb & Header --}}
            <div class="flex items-center justify-between">
                <div>
                    <h2 class="text-3xl font-bold text-gray-100 mb-2">الملف الشخصي للمدرب</h2>
                    <nav class="flex text-gray-400 text-sm" aria-label="Breadcrumb">
                        <ol class="inline-flex items-center space-x-1 md:space-x-3 space-x-reverse">
                            <li class="inline-flex items-center">
                                <a href="{{ route('admin.trainers.index') }}"
                                    class="hover:text-indigo-400 transition">المدربين</a>
                            </li>
                            <li>
                                <svg class="w-3 h-3 text-gray-600 mx-2 transform rotate-180" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="m1 9 4-4-4-4" />
                                </svg>
                            </li>
                            <li aria-current="page">
                                <span class="text-indigo-500 font-medium">{{ $trainer->user->name }}</span>
                            </li>
                        </ol>
                    </nav>
                </div>

                <a href="{{ route('admin.trainers.index') }}"
                    class="bg-gray-800 hover:bg-gray-700 text-gray-300 px-5 py-2.5 rounded-xl font-bold transition duration-300 border border-gray-700 flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 transform rotate-180" viewBox="0 0 20 20"
                        fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z"
                            clip-rule="evenodd" />
                    </svg>
                    عودة للقائمة
                </a>
            </div>

            {{-- Main Content Grid --}}
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

                {{-- Column 1: Image & Key Actions --}}
                <div class="lg:col-span-1 space-y-6">
                    <div
                        class="bg-gray-900 border border-gray-800 rounded-2xl overflow-hidden shadow-2xl relative group">
                        @if ($trainer->image)
                            <img src="{{ Storage::url($trainer->image->path) }}" alt="{{ $trainer->user->name }}"
                                class="w-full h-auto object-cover aspect-[3/4] group-hover:scale-105 transition duration-500">
                        @else
                            <div
                                class="w-full aspect-[3/4] bg-gray-800 flex items-center justify-center flex-col gap-4 text-gray-600">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-24 w-24" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                        d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                                <span class="font-medium">لا توجد صورة</span>
                            </div>
                        @endif

                        <div class="absolute bottom-4 right-4">
                            <span class="bg-indigo-600 text-white px-4 py-1.5 rounded-lg text-sm font-bold shadow-lg">
                                {{ $trainer->specialization }}
                            </span>
                        </div>
                    </div>

                    <div class="bg-gray-900 border border-gray-800 rounded-2xl p-6 shadow-xl">
                        <div class="flex flex-col gap-3">
                            <a href="{{ route('admin.trainers.edit', $trainer->id) }}"
                                class="w-full bg-indigo-600 hover:bg-indigo-500 text-white py-3 rounded-xl font-bold transition text-center shadow-lg shadow-indigo-500/20">
                                تعديل البيانات
                            </a>

                            <form action="{{ route('admin.trainers.destroy', $trainer->id) }}" method="POST"
                                onsubmit="return confirm('هل أنت متأكد من حذف المدرب نهائياً؟');">
                                @csrf @method('DELETE')
                                <button type="submit"
                                    class="w-full bg-gray-800 hover:bg-red-500/10 hover:text-red-500 text-gray-400 py-3 rounded-xl font-bold transition border border-gray-700 hover:border-red-500/50">
                                    حذف المدرب
                                </button>
                            </form>
                        </div>
                    </div>
                </div>

                {{-- Column 2: Details & Bio --}}
                <div class="lg:col-span-2 space-y-6">

                    <div class="bg-gray-900 border border-gray-800 rounded-2xl p-8 shadow-2xl">
                        <div
                            class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8 border-b border-gray-800 pb-6">
                            <div>
                                <h1 class="text-4xl font-bold text-white mb-2">{{ $trainer->user->name }}</h1>
                                <p class="text-indigo-400 font-medium text-lg">مدرب محترف -
                                    {{ $trainer->specialization }}</p>
                            </div>
                            <div
                                class="mt-4 md:mt-0 bg-gray-800 px-6 py-3 rounded-xl border border-gray-700 text-center">
                                <span
                                    class="block text-3xl font-bold text-white">{{ $trainer->experience_years }}</span>
                                <span class="text-gray-400 text-sm">سنوات خبرة</span>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                            <div class="space-y-4">
                                <h3 class="text-gray-500 font-bold uppercase text-sm tracking-wider">معلومات الاتصال
                                </h3>
                                <div class="flex items-center gap-3 text-gray-300">
                                    <div
                                        class="w-10 h-10 rounded-lg bg-gray-800 flex items-center justify-center text-indigo-500">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                        </svg>
                                    </div>
                                    <span class="font-mono text-lg">{{ $trainer->user->email }}</span>
                                </div>
                                <div class="flex items-center gap-3 text-gray-300">
                                    <div
                                        class="w-10 h-10 rounded-lg bg-gray-800 flex items-center justify-center text-indigo-500">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                    </div>
                                    <span>انضم في {{ $trainer->created_at->format('Y/m/d') }}</span>
                                </div>
                            </div>

                            <div class="md:col-span-2">
                                <h3 class="text-gray-500 font-bold uppercase text-sm tracking-wider mb-4">نبذة تعريفية
                                    (Bio)</h3>
                                <div
                                    class="bg-gray-800/50 rounded-xl p-6 border border-gray-800 text-gray-300 leading-relaxed">
                                    {{ $trainer->bio ?? 'لا توجد نبذة تعريفية متاحة.' }}
                                </div>
                            </div>
                        </div>
                    </div>

                    @if (isset($coursesCount))
                        <div class="grid grid-cols-2 gap-4">
                            <div
                                class="bg-indigo-900/20 border border-indigo-500/20 rounded-2xl p-6 flex items-center justify-between">
                                <div>
                                    <p class="text-indigo-400 font-bold text-sm mb-1">الكورسات النشطة</p>
                                    <h4 class="text-3xl font-bold text-white">{{ $coursesCount }}</h4>
                                </div>
                                <div class="text-indigo-500 bg-indigo-500/10 p-3 rounded-xl">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                                    </svg>
                                </div>
                            </div>

                        </div>
                    @endif

                </div>
            </div>

        </div>
    </div>
</x-app-layout>
@endrole