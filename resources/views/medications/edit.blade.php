<!-- resources/views/medications/edit.blade.php -->
@extends('layout.dashboard')

@section('content')
<div class="container mt-5">
    <h1 class="mb-4">Edit Medication</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('medications.update', $medication->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="name" class="form-label">Medication Name</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $medication->name) }}" required>
        </div>

        <div class="mb-3">
            <label for="dosage" class="form-label">Dosage</label>
            <input type="text" class="form-control" id="dosage" name="dosage" value="{{ old('dosage', $medication->dosage) }}" required>
        </div>

        <div class="mb-3">
            <label for="instruction" class="form-label">Instructions</label>
            <textarea class="form-control" id="instruction" name="instruction" rows="3" required>{{ old('instruction', $medication->instruction) }}</textarea>
        </div>

        <div class="mb-3">
            <label for="side_effect" class="form-label">Side Effects</label>
            <textarea class="form-control" id="side_effect" name="side_effect" rows="3" required>{{ old('side_effect', $medication->side_effect) }}</textarea>
        </div>

        <div class="mb-3">
            <label for="advantages" class="form-label">Advantages</label>
            <textarea class="form-control" id="advantages" name="advantages" rows="3" required>{{ old('advantages', $medication->advantages) }}</textarea>
        </div>

        <div class="mb-3">
            <label for="examinations" class="form-label">Associated Examinations</label>
            <select multiple class="form-select" id="examinations" name="examinations[]">
                @foreach($examinations as $examination)
                    <option value="{{ $examination->id }}" {{ in_array($examination->id, $medication->examinations->pluck('id')->toArray()) ? 'selected' : '' }}>
                        {{ $examination->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Update Medication</button>
    </form>
</div>
@endsection
