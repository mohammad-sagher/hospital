@extends('layout.dashboard')

@section('content')
<div class="container mt-5">
    <h1 class="mb-4">Examination Details</h1>

    <div class="card mb-4">
        <div class="card-header">
            Examination Information
        </div>
        <div class="card-body">
            <p><strong>Patient:</strong> {{ $examination->patient->name }}</p>
            <p><strong>Doctor:</strong> {{ $examination->doctor->name }}</p>
            <p><strong>Examination Date:</strong> {{ $examination->examination_date }}</p>
            <p><strong>Diagnosis:</strong> {{ $examination->diagnosis }}</p>
            <p><strong>Treatment Direction:</strong> {{ $examination->treatment_diraction }}</p>
            <p><strong>Medications:</strong>
                @foreach($examination->medications as $medication)
                    <span class="badge bg-info text-dark">{{ $medication->name }}</span>
                @endforeach
            </p>
        </div>
    </div>

    <a href="{{ route('examinations.edit', $examination->id) }}" class="btn btn-warning">Edit</a>
    <form action="{{ route('examinations.destroy', $examination->id) }}" method="POST" style="display:inline-block;">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger">Delete</button>
    </form>
    <a href="{{ route('examinations.index') }}" class="btn btn-secondary">Back</a>
</div>
@endsection
