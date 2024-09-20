@extends('layout.dashboard')

@section('title', 'Edit Doctor Details')

@section('content')
<div class="container">
    <h1>Edit Doctor Details</h1>
    <form action="{{ route('doctors.update', $doctor->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" name="name" class="form-control" value="{{ $doctor->name }}" required>
        </div>
        <div class="form-group">
            <label for="specialization">Specialization</label>
            <input type="text" name="specialization" class="form-control" value="{{ $doctor->specialization }}" required>
        </div>
        <div class="form-group">
            <label for="working_hours">Working Hours</label>
            <input type="text" name="working_hours" class="form-control" value="{{ $doctor->working_hours }}" required>
        </div>
        <div class="form-group">
            <label for="phone_number">Phone Number</label>
            <input type="text" name="phone_number" class="form-control" value="{{ $doctor->phone_number }}" required>
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" class="form-control" value="{{ $doctor->email }}" required>
        </div>
        <div class="form-group">
            <label for="department_id">Department</label>
            <select name="department_id" class="form-control" required>
                @foreach($departments as $department)
                <option value="{{ $department->id }}" {{ $doctor->department_id == $department->id ? 'selected' : '' }}>
                    {{ $department->name }}
                </option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="year_of_experience">Years of Experience</label>
            <input type="text" name="year_of_experience" class="form-control" value="{{ $doctor->year_of_experience }}" required>
        </div>

        <h4>Appointments</h4>
        <div id="appointments-section">
            @foreach($doctor->apointments as $index => $apointment)
            <div class="appointment-group">
                <div class="form-group">
                    <label for="apointments[{{ $index }}][patient_id]">Patient</label>
                    <input type="text" name="apointments[{{ $index }}][patient_id]" class="form-control" value="{{ $apointment->patient_id }}">
                </div>
                <div class="form-group">
                    <label for="apointments[{{ $index }}][appointment_datetime]">Appointment Date and Time</label>
                    <input type="datetime-local" name="apointments[{{ $index }}][appointment_datetime]" class="form-control" value="{{ $apointment->appointment_datetime }}">
                </div>
                <div class="form-group">
                    <label for="apointments[{{ $index }}][appointment_status]">Appointment Status</label>
                    <input type="text" name="apointments[{{ $index }}][appointment_status]" class="form-control" value="{{ $apointment->appointment_status }}">
                </div>
            </div>
            @endforeach
        </div>
        <button type="button" class="btn btn-secondary mb-3" id="add-appointment">Add Another Appointment</button>

        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>

<script>
    let appointmentIndex = {{ $doctor->apointments->count() }};
    document.getElementById('add-appointment').addEventListener('click', function () {
        const appointmentSection = document.getElementById('appointments-section');
        const newAppointment = document.createElement('div');
        newAppointment.classList.add('appointment-group');
        newAppointment.innerHTML = `
            <div class="form-group">
                <label for="apointments[${appointmentIndex}][patient_id]">Patient</label>
                <input type="text" name="apointments[${appointmentIndex}][patient_id]" class="form-control">
            </div>
            <div class="form-group">
                <label for="apointments[${appointmentIndex}][appointment_datetime]">Appointment Date and Time</label>
                <input type="datetime-local" name="apointments[${appointmentIndex}][appointment_datetime]" class="form-control">
            </div>
            <div class="form-group">
                <label for="apointments[${appointmentIndex}][appointment_status]">Appointment Status</label>
                <input type="text" name="apointments[${appointmentIndex}][appointment_status]" class="form-control">
            </div>
        `;
        appointmentSection.appendChild(newAppointment);
        appointmentIndex++;
    });
</script>
@endsection
