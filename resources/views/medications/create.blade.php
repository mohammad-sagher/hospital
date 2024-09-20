<!-- resources/views/medications/create.blade.php -->
@extends('layout.dashboard')

@section('content')
<div class="container mt-5">
    <h1 class="mb-4">Add New Medication</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('medications.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Medication Name</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>

        <div class="mb-3">
            <label for="dosage" class="form-label">Dosage</label>
            <input type="text" class="form-control" id="dosage" name="dosage" required>
        </div>

        <div class="mb-3">
            <label for="instruction" class="form-label">Instructions</label>
            <textarea class="form-control" id="instruction" name="instruction" rows="3" required></textarea>
        </div>

        <div class="mb-3">
            <label for="side_effects" class="form-label">Side Effects</label>
            <textarea class="form-control" id="side_effects" name="side_effects" rows="3" required></textarea>
        </div>

        <div class="mb-3">
            <label for="advantages" class="form-label">Advantages</label>
            <textarea class="form-control" id="advantages" name="advantages" rows="3" required></textarea>
        </div>

        <button type="submit" class="btn btn-primary">Save Medication</button>
    </form>
</div>
@endsection
