@extends('layouts.app')

@section('content')
<div class="container">
    <h1> upate course</h1>
    <form action="{{ route('courses.update', $course->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label> Name</label>
            <input type="text" name="name" class="form-control" value="{{ $course->name }}">
        </div>
        <div class="form-group">
            <label>description</label>
            <textarea name="description" class="form-control">{{ $course->description }}</textarea>
        </div>
        <div class="form-group">
            {{-- remmember --}}
            <label>رقم المدرب</label>
            <input type="number" name="trainer_id" class="form-control" value="{{ $course->trainer_id }}">
        </div>
        <div class="form-group">
            <label> total price</label>
            <input type="number" name="total_price" class="form-control" value="{{ $course->total_price }}">
        </div>
        <button type="submit" class="btn btn-success">update</button>
    </form>
</div>
@endsection
