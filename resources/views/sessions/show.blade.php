@role('admin')
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight text-right">
            تفاصيل الجلسة
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-md mx-auto sm:px-6 lg:px-8 bg-white p-6 rounded shadow">
            <h3 class="text-lg font-bold mb-4">{{ $session->title }}</h3>

            <div class="mb-4">
    <strong>المدرب:</strong>
    <p class="text-gray-700">{{ $session->trainer?->user?->name ?? '---' }}</p>
</div>

<div class="mb-4">
    <strong>الكورس:</strong>
    <p class="text-gray-700">{{ $session->course?->name ?? '---' }}</p>
</div>

<div class="mb-4">
    <strong>الفئة :</strong>
    <p class="text-gray-700">{{ $session->category?->name ?? '---' }}</p>
</div>

            <div class="mb-4">
                <strong>السعر:</strong>
                <p class="text-gray-700">{{ $session->single_price }}</p>
            </div>

            <div class="mb-4">
                <strong>السعة القصوى:</strong>
                <p class="text-gray-700">{{ $session->max_capacity }}</p>
            </div>

            <div class="mb-4">
                <strong>وقت البداية:</strong>
                <p class="text-gray-700">{{ $session->start_time }}</p>
            </div>

            <div class="mb-4">
                <strong>وقت النهاية:</strong>
                <p class="text-gray-700">{{ $session->end_time }}</p>
            </div>

            <div class="flex gap-4 mt-6">
                <a href="{{ route('gymsessions.edit', $session->id) }}"
                   class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                    تعديل
                </a>

                <form action="{{ route('gymsessions.destroy', $session->id) }}" method="POST"
                      onsubmit="return confirm('هل أنت متأكد من الحذف؟');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700">
                        حذف
                    </button>
                </form>

                <a href="{{ route('gymsessions.index') }}"
                   class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">
                    رجوع للقائمة
                </a>
            </div>
        </div>
    </div>
</x-app-layout>
@endrole