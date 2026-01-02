<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight text-right">
            إضافة جلسة جديدة
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-md mx-auto sm:px-6 lg:px-8 bg-white p-6 rounded shadow">
            
            @if ($errors->any())
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                    <ul class="mb-0 list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('gymsessions.store') }}" method="POST">
                @csrf

                <div class="mb-4">
                    <label class="block text-gray-700">العنوان</label>
                    <input type="text" name="title" class="w-full border-gray-300 rounded" value="{{ old('title') }}" required>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700">اختر الكورس</label>
                    <select name="course_id" class="w-full border-gray-300 rounded" >
                        <option value="">اختر كورس</option>
                        @foreach($courses as $course)
                            <option value="{{ $course->id }}" {{ old('course_id') == $course->id ? 'selected' : '' }}>
                                {{ $course->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700">اختر المدرب (اختياري)</label>
                    <select name="trainer_profile_id" class="w-full border-gray-300 rounded">
                        <option value="">بدون مدرب</option>
                        @foreach($trainerProfiles as $trainer)
                            <option value="{{ $trainer->id }}" {{ old('trainer_profile_id') == $trainer->id ? 'selected' : '' }}>
                                {{ $trainer->user->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700">السعر</label>
                    <input type="number" name="single_price" class="w-full border-gray-300 rounded" step="0.01" value="{{ old('single_price') }}" required>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700">السعة القصوى</label>
                    <input type="number" name="max_capacity" class="w-full border-gray-300 rounded" value="{{ old('max_capacity') }}" required>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700">وقت البداية</label>
                    <input type="datetime-local" name="start_time" class="w-full border-gray-300 rounded" value="{{ old('start_time') }}" required>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700">وقت النهاية</label>
                    <input type="datetime-local" name="end_time" class="w-full border-gray-300 rounded" value="{{ old('end_time') }}" required>
                </div>

                <div class="flex gap-4">
                    <button type="submit" class="bg-green-600 text-white px-6 py-2 rounded hover:bg-green-700">
                        حفظ الجلسة
                    </button>
                    <a href="{{ route('gymsessions.index') }}" class="bg-gray-500 text-white px-6 py-2 rounded hover:bg-gray-600">
                        رجوع
                    </a>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
