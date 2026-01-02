<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight text-right">
            تعديل بيانات الكورس
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-md mx-auto sm:px-6 lg:px-8 bg-white p-6 rounded shadow">
            <form action="{{ route('courses.update', $course->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-4">
                    <label class="block text-gray-700">اسم الكورس</label>
                    <input type="text" name="name" class="w-full border-gray-300 rounded" value="{{ $course->name }}" required>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700">الوصف</label>
                    <textarea name="description" class="w-full border-gray-300 rounded">{{ $course->description }}</textarea>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700"> المدرب</label>
                    <input type="number" name="trainer_id" class="w-full border-gray-300 rounded" value="{{ $course->trainer_id }}" >
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700">السعر الكلي</label>
                    <input type="number" name="total_price" class="w-full border-gray-300 rounded" value="{{ $course->total_price }}" required>
                </div>

                <button type="submit" class="bg-green-600 text-white px-6 py-2 rounded hover:bg-green-700">
                    تحديث
                </button>
            </form>
        </div>
    </div>
</x-app-layout>
