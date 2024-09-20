@extends('layout.dashboard')

@section('content')
<div class="container mt-5">
    <h1 class="mb-4">Department Details</h1>

    <div class="card mb-4">
        <div class="card-header">
            Department Information
        </div>
        <div class="card-body">
            <p><strong>Department Name:</strong> {{ $department->name }}</p>
            <p><strong>Contact Information:</strong> {{ $department->contact_info }}</p>
            <p><strong>Department Head:</strong> {{ $department->head }}</p>
        </div>
    </div>

    <a href="{{ route('departments.edit', $department->id) }}" class="btn btn-warning">Edit</a>
    <form action="{{ route('departments.destroy', $department->id) }}" method="POST" style="display:inline-block;">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger">Delete</button>
    </form>
    <a href="{{ route('departments.index') }}" class="btn btn-secondary">Back</a>
</div>
@endsection
