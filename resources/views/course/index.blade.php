@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Course list</h1>
    <a href="{{ route('courses.create') }}" class="btn btn-primary">إضافة كورس جديد</a>
    <table class="table mt-3">
        <thead>
            <tr>
                <th>Name</th>
                <th>Description</th>
                <th>trainer</th>
                <th>total price </th>
                <th>action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($courses as $course)
            <tr>
                <td>{{ $course->name }}</td>
                <td>{{ $course->description }}</td>
                <td>{{ $course->trainer_id }}</td>
                <td>{{ $course->total_price }}</td>
                <td>
                    <a href="{{ route('courses.show', $course->id) }}" class="btn btn-info">عرض</a>
                    <a href="{{ route('courses.edit', $course->id) }}" class="btn btn-warning">تعديل</a>
                    <form action="{{ route('courses.destroy', $course->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
