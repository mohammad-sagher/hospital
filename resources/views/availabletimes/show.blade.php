@extends('layout.dashboard')

@section('content')
<div class="container mt-5">
    <h2>View Doctor's Available Time Details</h2>

    <div class="mt-4 card">
        <div class="card-header">Doctor Information</div>
        <div class="card-body">
            <h5 class="card-title">Doctor's Name: {{ $availableTime->doctor->name }}</h5>
            <p class="card-text">Specialization: {{ $availableTime->doctor->specialization }}</p>
        </div>
    </div>

    <div class="mt-4 card">
        <div class="card-header">Available Time Details</div>
        <div class="card-body">
            <p><strong>Day:</strong> {{ $availableTime->day_of_week }}</p>
            <p><strong>Time:</strong> {{ $availableTime->available_time }}</p>
        </div>
    </div>

    <a href="{{ route('availabletimes.index') }}" class="mt-3 btn btn-primary">Back to List</a>
</div>
@endsection
