@extends('layout.dashboard')

@section('content')
<div class="container mt-5">
    <h1 class="mb-4">Organizations List</h1>
    <a href="{{ route('organizations.create') }}" class="btn btn-primary mb-3">Add New Organization</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>Organization Name</th>
                <th>Organization Type</th>
                <th>Contact</th>
                <th>Associated Patients</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($organizations as $organization)
            <tr>
                <td>{{ $organization->name }}</td>
                <td>{{ $organization->type }}</td>
                <td>{{ $organization->contact }}</td>
                <td>
                    @foreach($organization->patients as $patient)
                        <span class="badge bg-info text-dark">{{ $patient->name }}</span>
                    @endforeach
                </td>
                <td>
                    <a href="{{ route('organizations.show', $organization->id) }}" class="btn btn-info btn-sm">View</a>
                    <a href="{{ route('organizations.edit', $organization->id) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('organizations.destroy', $organization->id) }}" method="POST" style="display:inline-block;">
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
