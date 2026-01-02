<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight text-right">
            تعديل بيانات المعدة
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-md mx-auto sm:px-6 lg:px-8 bg-white p-6 rounded shadow">
            <form action="{{ route('equipment.update', $equipment->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-4">
                    <label class="block text-gray-700">اسم المعدة</label>
                    <input type="text" name="name" class="w-full border-gray-300 rounded" value="{{ $equipment->name }}" required>
                </div>

                
                <div class="mb-4">
                    <label class="block text-gray-700"> الحالة</label>
                    <input type="text" name="status" class="w-full border-gray-300 rounded" value="{{ $equipment->status }}" required>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700"> الكمية</label>
                    <input type="number" name="quantity" class="w-full border-gray-300 rounded" value="{{ $equipment->quantity }}" required>
                </div>

                <button type="submit" class="bg-green-600 text-white px-6 py-2 rounded hover:bg-green-700">
                    تحديث
                </button>
            </form>
        </div>
    </div>
</x-app-layout>
