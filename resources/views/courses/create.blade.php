<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight text-right">
            إضافة كورس جديد
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-md mx-auto sm:px-6 lg:px-8 bg-white p-6 rounded shadow">
            <form action="{{ route('courses.store') }}" method="POST">
                @csrf

                <div class="mb-4">
                    <label class="block text-gray-700">اسم الكورس</label>
                    <input type="text" name="name" class="w-full border-gray-300 rounded" value="{{ old('name') }}" required>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700">الوصف</label>
                    <textarea name="description" class="w-full border-gray-300 rounded">{{ old('description') }}</textarea>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700">المدرب</label>
                    <select name="trainer_profile_id" class="w-full border-gray-300 rounded" >
                        <option value="">اختر مدرب</option>
                        @foreach($trainerProfiles as $trainer)
                            <option value="{{ $trainer->id }}" {{ old('trainer_profile_id') == $trainer->id ? 'selected' : '' }}>
                                {{ $trainer->user->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700">السعر الكلي</label>
                    <input type="number" name="total_price" class="w-full border-gray-300 rounded" step="0.01" value="{{ old('total_price') }}" required>
                </div>

                <button type="submit" class="bg-green-600 text-white px-6 py-2 rounded hover:bg-green-700">
                    حفظ
                </button>
            </form>
        </div>
    </div>
</x-app-layout>
