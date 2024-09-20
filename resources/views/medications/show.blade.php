@extends('layout.dashboard')

@section('content')
<div class="container mt-5">
    <h1 class="mb-4">Medication Details</h1>

    <div class="card mb-4">
        <div class="card-header bg-primary text-white">
            Medication Information
        </div>
        <div class="card-body">
            <p><strong>Medication Name:</strong> {{ $medication->name }}</p>
            <p><strong>Dosage:</strong> {{ $medication->dosage }}</p>
            <p><strong>Instructions:</strong> {{ $medication->instruction }}</p>
            <p><strong>Side Effects:</strong> {{ $medication->side_effects }}</p>
            <p><strong>Advantages:</strong> {{ $medication->avantages }}</p>
        </div>
    </div>

    <div class="d-flex">
        <a href="{{ route('medications.edit', $medication->id) }}" class="btn btn-warning me-2">Edit</a>
        <form action="{{ route('medications.destroy', $medication->id) }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger me-2">Delete</button>
        </form>
        <a href="{{ route('medications.index') }}" class="btn btn-secondary">Back</a>
    </div>
</div>
@endsection
