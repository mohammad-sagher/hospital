@extends('layout.dashboard')

@section('title', 'Add New Doctor')

@section('content')
<div class="container">
    <h1>Add New Doctor</h1>
    <form action="{{ route('doctors.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" name="name" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="specialization">Specialization</label>
            <input type="text" name="specialization" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="working_hours">Working Hours</label>
            <input type="text" name="working_hours" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="phone_number">Phone Number</label>
            <input type="text" name="phone_number" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="department_id">Department</label>
            <select name="department_id" class="form-control" required>
                @foreach($departments as $department)
                <option value="{{ $department->id }}">{{ $department->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="year_of_experience">Years of Experience</label>
            <input type="text" name="year_of_experience" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary">Save</button>
    </form>
</div>

<script>
    let appointmentIndex = 1;
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
