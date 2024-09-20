<!-- resources/views/medications/index.blade.php -->
@extends('layout.dashboard')

@section('content')
<div class="container mt-5">
    <h1 class="mb-4">Medications List</h1>
    <a href="{{ route('medications.create') }}" class="btn btn-primary mb-3">Add New Medication</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>Medication Name</th>
                <th>Dosage</th>
                <th>Instructions</th>
                <th>Side Effects</th>
                <th>Advantages</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($medications as $medication)
            <tr>
                <td>{{ $medication->name }}</td>
                <td>{{ $medication->dosage }}</td>
                <td>{{ $medication->instruction }}</td>
                <td>{{ $medication->side_effects }}</td>
                <td>{{ $medication->avantages }}</td>
                <td>
                    <a href="{{ route('medications.show', $medication->id) }}" class="btn btn-info btn-sm">View</a>
                    <a href="{{ route('medications.edit', $medication->id) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('medications.destroy', $medication->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
