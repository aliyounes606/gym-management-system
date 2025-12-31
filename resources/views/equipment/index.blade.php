
// عرض جميع المعدات

@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Equipments</h1>
        <a href="{{ route('equipment.create') }}"
           class="btn btn-primary">Add New Equipment
        </a>

        @if (session('success'))
            <div class="alert alert-success"> {{ session('success') }} </div>
        @endif

        <table class="table mt-3">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Status</th>
                    <th>Quantity</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($equipments as $equipment)
                    <tr>
                        <td> {{ $equipment->name }} </td>
                        <td> {{ $equipment->status }} </td>
                        <td> {{ $equipment->quantity }} </td>
                        <td>
                            <a href="{{ route('equipment.show', $equipment->id) }}" class="btn btn-info"> View</a>
                            <a href="{{ route('equipment.edit', $equipment->id) }}" class="btn btn-warning"> Edit</a>
                            <form action="{{ route('equipment.destroy', $equipment->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger"> Delete </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection