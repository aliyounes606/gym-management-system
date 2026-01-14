@role('admin')
<x-app-layout>
    <div class="py-12">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">

            {{-- Header & Back Button --}}
            <div class="flex items-center justify-between">
                <div>
                    <h2 class="text-3xl font-bold text-gray-100 mb-2">إضافة دور جديد</h2>
                    <p class="text-gray-400">تعريف دور وظيفي جديد وتخصيص صلاحياته.</p>
                </div>
                <a href="{{ route('roles.index') }}"
                    class="text-gray-400 hover:text-white transition flex items-center gap-2 group">
                    <div
                        class="p-2 bg-gray-800 rounded-lg group-hover:bg-gray-700 transition border border-gray-700 group-hover:border-gray-600">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M10 18a8 8 0 100-16 8 8 0 000 16zm.707-10.293a1 1 0 00-1.414-1.414l-3 3a1 1 0 000 1.414l3 3a1 1 0 001.414-1.414L9.414 11H13a1 1 0 100-2H9.414l1.293-1.293z"
                                clip-rule="evenodd" />
                        </svg>
                    </div>
                    <span>إلغاء وعودة</span>
                </a>
            </div>

            {{-- Create Role Form Card --}}
            <div class="bg-gray-900 border border-gray-800 rounded-2xl overflow-hidden shadow-2xl">

                {{-- Card Header --}}
                <div class="p-6 border-b border-gray-800 bg-gray-800/30 flex items-center gap-3">
                    <div class="p-2 bg-indigo-500/20 rounded-lg text-indigo-400">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                        </svg>
                    </div>
                    <h3 class="text-lg font-bold text-white">بيانات الدور والصلاحيات</h3>
                </div>

                <div class="p-8">
                    <form action="{{ route('roles.store') }}" method="POST">
                        @csrf

                        <div class="space-y-8">

                            {{-- Role Name Input --}}
                            <div class="space-y-2">
                                <label class="text-sm font-bold text-gray-300">اسم الدور (Role Name)</label>
                                <input type="text" name="name" value="{{ old('name') }}" required
                                    placeholder="مثال: مشرف مالي، مدرب أول..."
                                    class="w-full bg-gray-800 border border-gray-700 text-white rounded-xl focus:border-indigo-500 focus:ring-indigo-500 py-3 px-4 transition duration-200 placeholder-gray-500">
                                <p class="text-xs text-gray-500">استخدم اسماً واضحاً يعبر عن وظيفة هذا الدور.</p>
                            </div>

                            {{-- Permissions Section --}}
                            <div class="space-y-4">
                                <div class="flex justify-between items-end border-b border-gray-800 pb-2">
                                    <label class="text-sm font-bold text-gray-300 flex items-center gap-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-indigo-500"
                                            viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd"
                                                d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z"
                                                clip-rule="evenodd" />
                                        </svg>
                                        تخصيص الصلاحيات
                                    </label>
                                    <span class="text-xs text-gray-500">قم بتحديد الصلاحيات المسموح بها لهذا
                                        الدور</span>
                                </div>

                                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                                    @foreach ($permissions as $permission)
                                        <label
                                            class="relative flex items-start p-4 rounded-xl border border-gray-700 bg-gray-800/50 hover:bg-gray-800 hover:border-indigo-500/50 cursor-pointer transition-all duration-200 group">
                                            <div class="flex items-center h-5">
                                                <input type="checkbox" name="permissions[]"
                                                    value="{{ $permission->name }}"
                                                    class="focus:ring-indigo-500 h-5 w-5 text-indigo-600 border-gray-600 bg-gray-700 rounded transition duration-150 ease-in-out">
                                            </div>
                                            <div class="ms-3 text-sm">
                                                <span
                                                    class="font-medium text-gray-300 group-hover:text-white transition-colors">
                                                    {{ $permission->name }}
                                                </span>
                                            </div>
                                        </label>
                                    @endforeach
                                </div>
                            </div>

                        </div>

                        {{-- Submit Button --}}
                        <div class="mt-8 pt-6 border-t border-gray-800 flex justify-end">
                            <button type="submit"
                                class="bg-indigo-600 hover:bg-indigo-500 text-white px-8 py-3 rounded-xl font-bold transition duration-300 shadow-lg shadow-indigo-500/20 flex items-center gap-2 transform hover:-translate-y-1">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
                                    fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                        clip-rule="evenodd" />
                                </svg>
                                حفظ الدور الجديد
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
@endrole