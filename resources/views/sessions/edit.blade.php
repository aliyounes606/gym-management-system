<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight text-right">
            تعديل الجلسة
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-md mx-auto sm:px-6 lg:px-8 bg-white p-6 rounded shadow">
            <form action="{{ route('gymsessions.update', $session->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-4">
                    <label class="block text-gray-700">العنوان</label>
                    <input type="text" name="title" class="w-full border-gray-300 rounded" value="{{ $session->title }}" required>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700">المدرب</label>
                    <select name="trainer_id" class="w-full border-gray-300 rounded" >
                        @foreach($trainers as $trainer)
                            <option value="{{ $trainer->id }}" {{ $session->trainer_id == $trainer->id ? 'selected' : '' }}>
                                {{ $trainer->user->name  }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-4">
                <label for="category_id">اختر الفئة</label>
    <select name="category_id" id="category_id" class="w-full border-gray-300 rounded">
        <option value=""> اختر الفئة </option>
        @foreach($categories as $category)
            <option value="{{ $category->id }}">{{ $category->name }}</option>
        @endforeach
    </select>
     </div>
                {{-- <div class="mb-4">
                    <label class="block text-gray-700">الكورس</label>
                    <select name="course_id" class="w-full border-gray-300 rounded" >
                        @foreach($courses as $course)
                            <option 
                            value=""
                            {{ $course->id }}"  --}}
                            {{-- {{ $session->course_id == $course->id ? 'selected' : '' }}>
                                {{ $course->name }}
                            {{-- </option> --}}
                        {{-- @endforeach
                    </select>
                </div> --}} 
                <div class="mb-4">
    <label class="block text-gray-700">الكورس</label>
    <select name="course_id" class="w-full border-gray-300 rounded">
        <option value="">اختر الكورس</option>
        @foreach($courses as $course)
            <option 
                value="{{ $course->id }}" 
                {{ $session->course_id == $course->id ? 'selected' : '' }}>
                {{ $course->name }}
            </option>
        @endforeach
    </select>
</div>

                <div class="mb-4">
                    <label class="block text-gray-700">السعر</label>
                    <input type="number" name="single_price" class="w-full border-gray-300 rounded" value="{{ $session->single_price }}" required>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700">السعة القصوى</label>
                    <input type="number" name="max_capacity" class="w-full border-gray-300 rounded" value="{{ $session->max_capacity }}" required>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700">وقت البداية</label>
                    <input type="datetime-local" name="start_time" class="w-full border-gray-300 rounded" value="{{ $session->start_time }}" required>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700">وقت النهاية</label>
                    <input type="datetime-local" name="end_time" class="w-full border-gray-300 rounded" value="{{ $session->end_time }}" required>
                </div>

                <button type="submit" class="bg-green-600 text-white px-6 py-2 rounded hover:bg-green-700">
                    تحديث
                </button>
            </form>
        </div>
    </div>
</x-app-layout>
