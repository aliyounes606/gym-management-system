<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight text-right">
            تفاصيل المعدة
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-md mx-auto sm:px-6 lg:px-8 bg-white p-6 rounded shadow">
            <h3 class="text-lg font-bold mb-4">{{ $equipment->name }}</h3>

            <div class="mb-4">
                <strong>الحالة:</strong>
                <p class="text-gray-700">{{ $equipment->status }}</p>
            </div>

               <div class="mb-4">
                <strong>التصنيفات:</strong>
                <div class="mt-1">
                    @forelse($equipment->categories as $category)
                        <span class="inline-block bg-gray-200 px-2 py-1 rounded text-sm">
                            {{ $category->name }}
                        </span>
                    @empty
                        <span class="text-gray-500">لا يوجد تصنيفات</span>
                    @endforelse
                </div>
            </div>

            <div class="flex gap-4 mt-6">
                <a href="{{ route('equipment.edit', $equipment->id) }}"
                   class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                    تعديل
                </a>

                <form action="{{ route('equipment.destroy', $equipment->id) }}" method="POST"
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
