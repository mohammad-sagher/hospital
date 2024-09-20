@extends('layout.dashboard')

@section('title', 'Doctor Details')

@section('content')
<div class="container">
    <h1>Doctor Details</h1>
    <ul>
        <li><strong>Name:</strong> {{ $doctor->name }}</li>
        <li><strong>Specialization:</strong> {{ $doctor->specialization }}</li>
        <li><strong>Working Hours:</strong> {{ $doctor->working_hours }}</li>
        <li><strong>Phone Number:</strong> {{ $doctor->phone_number }}</li>
        <li><strong>Email:</strong> {{ $doctor->email }}</li>
        <li><strong>Department:</strong> {{ $doctor->department->name }}</li>
        <li><strong>Years of Experience:</strong> {{ $doctor->year_of_experience }}</li>
    </ul>

    <h3>Appointments</h3>
    <ul>
        @foreach($doctor->apointments as $apointment)
        <li>
            <strong>Patient:</strong> {{ $apointment->patient->name }}<br>
            <strong>Appointment Date and Time:</strong> {{ $apointment->appointment_datetime }}<br>
            <strong>Appointment Status:</strong> {{ $apointment->appointment_status }}
        </li>
        @endforeach
    </ul>

    <a href="{{ route('doctors.edit', $doctor->id) }}" class="btn btn-warning">Edit</a>
    <form action="{{ route('doctors.destroy', $doctor->id) }}" method="POST" style="display:inline;">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this?')">Delete</button>
    </form>
    <a href="{{ route('doctors.index') }}" class="btn btn-secondary">Back to List</a>
</div>
@endsection
