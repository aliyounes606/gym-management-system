// عرض تفاصيل المعدة

@extends('layouts.app')

@section('content')
    <div class="container">
        <h1> Equipment Details </h1>

        <div class="card">
            <div class="card-body">
                <h5 class="card-title">{{ $equipment->name }}</h5>
                <p class="card-text"><strong>Status:</strong> {{ $equipment->status }}</p>
                <p class="card-text"><strong>Quantity:</strong> {{ $equipment->quantity }}</p>
                <a href="{{ route('equipment.index') }}" class="btn btn-secondary"> Back to List </a>
            </div>
        </div>
    </div>
@endsection