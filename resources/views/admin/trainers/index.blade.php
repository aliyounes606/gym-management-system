<x-app-layout>
    <div class="p-6">
        @if (session('success'))
            <div class="mb-4 p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 shadow-sm border border-green-200"
                role="alert">
                <div class="flex items-center">
                    <svg class="w-4 h-4 me-2 fill-current" viewBox="0 0 20 20">
                        <path
                            d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z" />
                    </svg>
                    <span class="font-bold">تم بنجاح!</span>
                    <span class="ms-2">{{ session('success') }}</span>
                </div>
            </div>
        @endif

        @if (session('error'))
            <div class="mb-4 p-4 text-sm text-red-800 rounded-lg bg-red-50 border border-red-200" role="alert">
                {{ session('error') }}
            </div>
        @endif
        <div class="mb-8 bg-white p-4 rounded shadow">
            <h3 class="text-lg mb-4">ترقية مستخدم لمدرب</h3>
            <form action="{{ route('admin.trainers.store') }}" method="POST" class="flex gap-4">
                @csrf
                <select name="user_id" class="rounded border-gray-300">
                    @foreach ($availableUsers as $u)
                        <option value="{{ $u->id }}">{{ $u->name }}</option>
                    @endforeach
                </select>
                <input type="text" name="specialization" placeholder="التخصص" class="rounded border-gray-300">
                <input type="number" name="experience_years" placeholder="الخبرة" class="rounded border-gray-300 w-24">
                <textarea name="bio" placeholder="السيرة الذاتية للمدرب..." class="rounded border-gray-300 w-full mt-2"></textarea>
                <button class="bg-green-600 text-white px-4 py-2 rounded">إضافة</button>
            </form>
        </div>

        <div class="bg-white rounded shadow p-4">
            <h3 class="text-lg mb-4">قائمة المدربين</h3>

            <table class="w-full text-center border">
                <thead>
                    <tr class="bg-gray-200">
                        <th class="p-2">الاسم</th>
                        <th class="p-2">التخصص</th>
                        <th class="p-2">الخبرة</th>
                        <th class="p-2">السيرة الذاتية</th>
                        <th class="p-2">الإجراءات</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($trainers as $trainer)
                        <tr class="border-b">
                            <td class="p-2">{{ $trainer->user->name }}</td>
                            <td class="p-2">{{ $trainer->specialization }}</td>
                            <td class="p-2">{{ $trainer->experience_years }} سنة</td>
                            <td class="p-2">{{ Str::limit($trainer->bio, 30) }}</td>
                            <td class="p-2 flex justify-center gap-2">
                                <a href="{{ route('admin.trainers.edit', $trainer->id) }}"
                                    class="text-blue-600">تعديل</a>

                                <form action="{{ route('admin.trainers.destroy', $trainer->id) }}" method="POST">
                                    @csrf @method('DELETE')
                                    <button class="text-red-600">حذف</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
