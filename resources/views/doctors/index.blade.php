@extends('layout.dashboard')

@section('content')
<div class="container">
    <h1 class="my-4 text-center">Doctors List</h1>
    <a href="{{ route('doctors.create') }}" class="mb-4 btn btn-success">Add New Doctor</a>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Doctor's Name</th>
                <th>Specialization</th>
                <th>Department</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($doctors as $doctor)
                <tr>
                    <td>{{ $doctor->name }}</td>
                    <td>{{ $doctor->specialization }}</td>
                    <td>{{ $doctor->department->name }}</td>
                    <td>
                        <a href="{{ route('doctors.show', $doctor->id) }}" class="btn btn-primary">View Details</a>
                        <a href="{{ route('doctors.edit', $doctor->id) }}" class="btn btn-warning">Edit</a>
                        <form action="{{ route('doctors.destroy', $doctor->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
