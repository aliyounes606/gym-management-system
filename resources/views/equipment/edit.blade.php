// تعديل المعدة

@extends('layouts.app')

@section('content')
    <div class="container">
        <h1> Edit Equipment </h1>

        <form action="{{ route('equipment.update', $equipment->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="name"> Name </label>
                <input type="text" name="name" id="name" class="form-control" value="{{ $equipment->name }}" required>
            </div>
            <div class="form-group">
                <label for="status"> Status </label>
                <input type="text" name="status" id="status" class="form-control" value="{{ $equipment->status }}" required>
            </div>
            <div class="form-group">
                <label for="quantity"> Quantity </label>
                <input type="number" name="quantity" id="quantity" class="form-control" value="{{ $equipment->quantity }}" required>
            </div>
            <button type="submit" class="btn btn-primary mt-3"> Update </button>
        </form>
    </div>
@endsection