<x-app-layout>
    <div class="py-12">
        <div class="max-w-md mx-auto sm:px-6 lg:px-8 bg-white p-6 rounded shadow">
            <h2 class="mb-4">إكمال بيانات المدرب: {{ $user->name }}</h2>

            <form action="{{ route('trainers.store') }}" method="POST">
                @csrf
                <input type="hidden" name="user_id" value="{{ $user->id }}">

                <div class="mb-4">
                    <label>التخصص</label>
                    <input type="text" name="specialization" class="w-full border-gray-300 rounded" required>
                </div>

                <div class="mb-4">
                    <label>سنوات الخبرة</label>
                    <input type="number" name="experience_years" class="w-full border-gray-300 rounded" required>
                </div>

                <div class="mb-4">
                    <label>السيرة الذاتية</label>
                    <textarea name="bio" class="w-full border-gray-300 rounded"></textarea>
                </div>

                <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded">حفظ والترقية</button>
            </form>
        </div>
    </div>
</x-app-layout>
