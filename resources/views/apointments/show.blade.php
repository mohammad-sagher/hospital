@extends('layout.dashboard')

@section('content')
<div class="container">
    <h1>Appointment Details</h1>
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Appointment with {{ $apointment->doctor->name }}</h5>
            <p><strong>Patient:</strong> {{ $apointment->patient->name }}</p>
            <p><strong>Available Time:</strong> {{ $apointment->available_time }}</p>
            <p><strong>Reason for Visit:</strong> {{ $apointment->reason_for_visit }}</p>
            <p><strong>Status:</strong> {{ $apointment->appointment_status }}</p>
            <a href="{{ route('apointments.index') }}" class="btn btn-primary">Back to Appointments</a>
        </div>
    </div>
</div>
@endsection
