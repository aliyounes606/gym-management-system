// إضافة معدة جديدة

@extends('layouts.app')

@section('content')
    <div class="container">
        <h1> Add New Equipment </h1>

        <form action="{{ route('equipment.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="name"> Name </label>
                <input type="text" name="name" id="name" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="status"> Status </label>
                <input type="text" name="status" id="status" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="quantity"> Quantity </label>
                <input type="number" name="quantity" id="quantity" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-success mt-3"> Save </button>
        </form>
    </div>
@endsection