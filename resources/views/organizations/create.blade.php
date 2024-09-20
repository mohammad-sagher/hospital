@extends('layout.dashboard')

@section('content')
<div class="container mt-5">
    <h1 class="mb-4">Add New Organization</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('organizations.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Organization Name</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" required>
        </div>

        <div class="mb-3">
            <label for="type" class="form-label">Organization Type</label>
            <input type="text" class="form-control" id="type" name="type" value="{{ old('type') }}">
        </div>

        <div class="mb-3">
            <label for="contact" class="form-label">Contact</label>
            <input type="text" class="form-control" id="contact" name="contact" value="{{ old('contact') }}">
        </div>

        <div class="mb-3">
            <label for="patients" class="form-label">Associated Patients</label>
            <select multiple class="form-select" id="patients" name="patients[]">
                @foreach($patients as $patient)
                    <option value="{{ $patient->id }}">{{ $patient->name }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Save Organization</button>
    </form>
</div>
@endsection
