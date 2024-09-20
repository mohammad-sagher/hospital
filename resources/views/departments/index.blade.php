@extends('layout.dashboard')

@section('content')
<div class="container mt-5">
    <h1 class="mb-4">Departments List</h1>
    <a href="{{ route('departments.create') }}" class="btn btn-primary mb-3">Add New Department</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>Department Name</th>
                <th>Contact Information</th>
                <th>Department Head</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($departments as $department)
            <tr>
                <td>{{ $department->name }}</td>
                <td>{{ $department->contact_info }}</td>
                <td>{{ $department->head }}</td>
                <td>
                    <a href="{{ route('departments.show', $department->id) }}" class="btn btn-info btn-sm">View</a>
                    <a href="{{ route('departments.edit', $department->id) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('departments.destroy', $department->id) }}" method="POST" style="display:inline-block;">
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
