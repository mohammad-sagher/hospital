@extends('layout.dashboard')

@section('content')
<div class="container">
    <a href="{{ route('apointments.create') }}" class="btn btn-primary">Create New Appointment</a>
    <h1>Appointments</h1>
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <table class="table">
        <thead>
            <tr>
                <th>Doctor</th>
                <th>Patient</th>
                <th>Available Time</th>
                <th>Reason for Visit</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($apointments as $apointment)
                <tr>
                    <td>{{ $apointment->doctor->name }}</td>
                    <td>{{ $apointment->patient->name }}</td>
                    <td>{{ $apointment->available_time }}</td>
                    <td>{{ $apointment->reason_for_visit }}</td>
                    <td>{{ $apointment->appointment_status }}</td>
                    <td>
                        <a href="{{ route('apointments.show', $apointment->id) }}" class="btn btn-info">View</a>
                        <a href="{{ route('apointments.edit', $apointment->id) }}" class="btn btn-info">Edit</a>
                        <form action="{{ route('apointments.destroy', $apointment->id) }}" method="POST" style="display:inline;">
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
