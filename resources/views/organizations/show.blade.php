@extends('layout.dashboard')

@section('content')
<div class="container mt-5">
    <h1 class="mb-4">Organization Details</h1>

    <div class="card mb-4">
        <div class="card-header">
            Organization Information
        </div>
        <div class="card-body">
            <p><strong>Organization Name:</strong> {{ $organization->name }}</p>
            <p><strong>Organization Type:</strong> {{ $organization->type }}</p>
            <p><strong>Contact:</strong> {{ $organization->contact }}</p>
            <p><strong>Associated Patients:</strong>
                @foreach($organization->patients as $patient)
                    <span class="badge bg-info text-dark">{{ $patient->name }}</span>
                @endforeach
            </p>
        </div>
    </div>

    <a href="{{ route('organizations.edit', $organization->id) }}" class="btn btn-warning">Edit</a>
    <form action="{{ route('organizations.destroy', $organization->id) }}" method="POST" style="display:inline-block;">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger">Delete</button>
    </form>
    <a href="{{ route('organizations.index') }}" class="btn btn-secondary">Back</a>
</div>
@endsection
