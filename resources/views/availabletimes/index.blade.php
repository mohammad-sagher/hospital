@extends('layout.dashboard')

@section('content')
<div class="container mt-5">
    <h2>List of Available Times for Doctors</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('availabletimes.create') }}" class="mb-3 btn btn-primary">Add New Available Time</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Doctor's Name</th>
                <th>Day</th>
                <th>Available Time</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($availableTimes as $availableTime)
            <tr>
                <td>{{ $availableTime->doctor->name }}</td>
                <td>{{ $availableTime->day_of_week }}</td>
                <td>{{ $availableTime->available_time }}</td>
                <td>
                    <a href="{{ route('availabletimes.show', $availableTime->id) }}" class="btn btn-info">View</a>
                    <a href="{{ route('availabletimes.edit', $availableTime->id) }}" class="btn btn-warning">Edit</a>
                    <form action="{{ route('availabletimes.destroy', $availableTime->id) }}" method="POST" style="display:inline-block;">
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
