@extends('layout.dashboard')

@section('content')
<div class="container mt-5">
    <h1 class="mb-4">Examinations</h1>
    <a href="{{ route('examinations.create') }}" class="btn btn-primary mb-3">Add New Examination</a>
    
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>Patient</th>
                <th>Doctor</th>
                <th>Diagnosis</th>
                <th>Treatment Direction</th>
                <th>Examination Date</th>
                <th>Medications</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($examinations as $examination)
            <tr>
                <td>{{ $examination->patient->name }}</td>
                <td>{{ $examination->doctor->name }}</td>
                <td>{{ $examination->diagnosis }}</td>
                <td>{{ $examination->treatment_diraction }}</td>
                <td>{{ $examination->examination_date }}</td>
                <td>
                    @foreach($examination->medications as $medication)
                        <span class="badge bg-info text-dark">{{ $medication->name }}</span>
                    @endforeach
                </td>
                <td>
                    <a href="{{ route('examinations.show', $examination->id) }}" class="btn btn-info btn-sm">View</a>
                    <a href="{{ route('examinations.edit', $examination->id) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('examinations.destroy', $examination->id) }}" method="POST" style="display:inline-block;">
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
