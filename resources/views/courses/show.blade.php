<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight text-right">
            تفاصيل الكورس
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-md mx-auto sm:px-6 lg:px-8 bg-white p-6 rounded shadow">
            <h3 class="text-lg font-bold mb-4">{{ $course->name }}</h3>

            <div class="mb-4">
                <strong>الوصف:</strong>
                <p class="text-gray-700">{{ $course->description }}</p>
            </div>

           <div class="mb-4"> <strong>المدرب:</strong> <p class="text-gray-700"> {{ $course->trainerProfile ? $course->trainerProfile->user->name : 'بدون مدرب' }} </p> </div>

            <div class="mb-4">
                <strong>السعر الكلي:</strong>
                <p class="text-gray-700">{{ $course->total_price }}</p>
            </div>

            <div class="flex gap-4 mt-6">
                <a href="{{ route('courses.edit', $course->id) }}"
                   class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                    تعديل
                </a>

                <form action="{{ route('courses.destroy', $course->id) }}" method="POST"
                      onsubmit="return confirm('هل أنت متأكد من الحذف؟');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700">
                        حذف
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
