@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Add New Course</h1>
    <form action="{{ route('courses.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label>Name:</label>
            <input type="text" name="name" class="form-control">
        </div>
        <div class="form-group">
            <label>description</label>
            <textarea name="description" class="form-control"></textarea>
        </div>
        <div class="form-group">
            {{-- سيتم لاحقا التعديل بحيث يظهر اسم المدرب --}}
            <label>رقم المدرب</label>
            <input type="number" name="trainer_id" class="form-control">
        </div>
        <div class="form-group">
            <label>total price:</label>
            <input type="number" name="total_price" class="form-control">
        </div>
        <button type="submit" class="btn btn-success">save</button>
    </form>
</div>
@endsection
