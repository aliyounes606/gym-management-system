@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Course details</h1>
    <p><strong>course Name:</strong> {{ $course->name }}</p>
    <p><strong>description</strong> {{ $course->description }}</p>
    {{-- جلب اسم المدرب  --}}
    <p><strong>trainer:</strong> {{ $course->trainer_id }}</p>
    <p><strong>total price:</strong> {{ $course->total_price }}</p>
    <a href="{{ route('courses.index') }}" class="btn btn-secondary">back</a>
</div>
@endsection
