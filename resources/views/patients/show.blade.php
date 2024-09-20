@extends('layout.dashboard')

@section('content')
<div class="container">
    <h1>Patient Details</h1>

    <div class="card">
        <div class="card-header">Patient Information</div>
        <div class="card-body">
            <p><strong>Name:</strong> {{ $patient->name }}</p>
            <p><strong>Age:</strong> {{ $patient->age }}</p>
            <p><strong>Address:</strong> {{ $patient->address }}</p>
            <p><strong>Phone Number:</strong> {{ $patient->phone_number }}</p>
            <p><strong>Email:</strong> {{ $patient->email }}</p>
            <p><strong>Gender:</strong> {{ $patient->gender }}</p>
        </div>
    </div>

    <div class="card mt-3">
        <div class="card-header">Appointments</div>
        <div class="card-body">
            @if($patient->apointments->isEmpty())
                <p>No appointments recorded for this patient.</p>
            @else
                <ul class="list-group">
                    @foreach($patient->apointments as $appointment)
                        <li class="list-group-item">
                            <strong>Date and Time:</strong> {{ $appointment->available_time }} 
                            - <strong>Doctor's Name:</strong> {{ $appointment->doctor->name }}
                        </li>
                    @endforeach
                </ul>
            @endif
        </div>
    </div>

    <div class="card mt-3">
        <div class="card-header">Invoices</div>
        <div class="card-body">
            @if($patient->invoices->isEmpty())
                <p>No invoices recorded for this patient.</p>
            @else
                <ul class="list-group">
                    @foreach($patient->invoices as $invoice)
                        <li class="list-group-item">
                            <strong>Invoice Number:</strong> {{ $invoice->id }} 
                            - <strong>Amount:</strong> {{ $invoice->total_amount }} 
                            - <strong>Date:</strong> {{ $invoice->payment_date }}
                        </li>
                    @endforeach
                </ul>
            @endif
        </div>
    </div>

    <div class="card mt-3">
        <div class="card-header">Supporting Organizations</div>
        <div class="card-body">
            @if($patient->organizations->isEmpty())
                <p>No supporting organizations for this patient.</p>
            @else
                <ul class="list-group">
                    @foreach($patient->organizations as $organization)
                        <li class="list-group-item">{{ $organization->name }}</li>
                    @endforeach
                </ul>
            @endif
        </div>
    </div>
</div>
@endsection
