<x-app-layout>
    <div class="max-w-md mx-auto mt-10 bg-white p-6 rounded shadow">
        <h2 class="text-xl mb-4">تعديل بيانات المدرب: {{ $trainer->user->name }}</h2>
        <form action="{{ route('admin.trainers.update', $trainer->id) }}" method="POST">
            @csrf @method('PUT')
            <div class="mb-4">
                <label>التخصص</label>
                <input type="text" name="specialization" value="{{ $trainer->specialization }}"
                    class="w-full rounded border-gray-300">
            </div>
            <div class="mb-4">
                <label>سنوات الخبرة</label>
                <input type="number" name="experience_years" value="{{ $trainer->experience_years }}"
                    class="w-full rounded border-gray-300">
            </div>
            <div class="mb-4">
                <label class="block text-gray-700">السيرة الذاتية</label>
                <textarea name="bio" class="w-full rounded border-gray-300" rows="4">{{ $trainer->bio }}</textarea>
            </div>
            <button class="bg-blue-600 text-white px-4 py-2 rounded w-full">تحديث</button>
        </form>
    </div>
</x-app-layout>
