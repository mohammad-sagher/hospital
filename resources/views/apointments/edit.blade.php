@extends('layout.dashboard')

@section('content')
<div class="container">
    <form action="{{ route('apointments.update', $apointment->id) }}" method="POST">
        @csrf
        @method('PUT')

        <!-- Department -->
        <div class="form-group">
            <label for="department_id">Department</label>
            <select id="department_id" name="department_id" class="form-control" required>
                <option value="">Select Department</option>
                @foreach($departments as $department)
                    <option value="{{ $department->id }}" {{ $apointment->doctor->department_id == $department->id ? 'selected' : '' }}>
                        {{ $department->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Doctor -->
        <div class="form-group">
            <label for="doctor_id">Doctor</label>
            <select id="doctor_id" name="doctor_id" class="form-control" required>
                <option value="">Select Doctor</option>
                @foreach($doctors as $doctor)
                    <option value="{{ $doctor->id }}" {{ $apointment->doctor_id == $doctor->id ? 'selected' : '' }}>
                        {{ $doctor->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Available Time -->
        <div class="form-group">
            <label for="available_time">Available Time</label>
            <select id="available_time" name="available_time" class="form-control" required>
                <option value="">Select Time</option>
                @foreach($availableTimes as $time)
                    <option value="{{ $time->day_of_week }} {{ $time->available_time }}" {{ $apointment->available_time == ($time->day_of_week . ' ' . $time->available_time) ? 'selected' : '' }}>
                        {{ $time->day_of_week }} {{ $time->available_time }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Patient -->
        <div class="form-group">
            <label for="patient_id">Patient</label>
            <select id="patient_id" name="patient_id" class="form-control" required>
                <option value="">Select Patient</option>
                @foreach($patients as $patient)
                    <option value="{{ $patient->id }}" {{ $apointment->patient_id == $patient->id ? 'selected' : '' }}>
                        {{ $patient->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Reason for Visit -->
        <div class="form-group">
            <label for="reason_for_visit">Reason for Visit</label>
            <input type="text" id="reason_for_visit" name="reason_for_visit" class="form-control" value="{{ old('reason_for_visit', $apointment->reason_for_visit) }}" required>
        </div>

        <!-- Appointment Status -->
        <div class="form-group">
            <label for="appointment_status">Appointment Status</label>
            <input type="text" id="appointment_status" name="appointment_status" class="form-control" value="{{ old('appointment_status', $apointment->appointment_status) }}" required>
        </div>

        <button type="submit" class="btn btn-primary">Update Appointment</button>
    </form>
</div>

<script>
document.getElementById('department_id').addEventListener('change', function() {
    let departmentId = this.value;
    fetch(`{{ route('doctors.byDepartment') }}?department_id=${departmentId}`)
        .then(response => response.json())
        .then(data => {
            let doctorSelect = document.getElementById('doctor_id');
            doctorSelect.innerHTML = '<option value="">Select Doctor</option>';
            data.forEach(doctor => {
                doctorSelect.innerHTML += `<option value="${doctor.id}" ${doctor.id == '{{ $apointment->doctor_id }}' ? 'selected' : ''}>${doctor.name}</option>`;
            });
            // Clear available times when department changes
            document.getElementById('available_time').innerHTML = '<option value="">Select Time</option>';
        });
});

document.getElementById('doctor_id').addEventListener('change', function() {
    let doctorId = this.value;
    fetch(`{{ route('availableTimes.byDoctor') }}?doctor_id=${doctorId}`)
        .then(response => response.json())
        .then(data => {
            let timeSelect = document.getElementById('available_time');
            timeSelect.innerHTML = '<option value="">Select Time</option>';
            data.forEach(time => {
                timeSelect.innerHTML += `<option value="${time.day_of_week} ${time.available_time}" ${time.day_of_week + ' ' + time.available_time == '{{ $apointment->available_time }}' ? 'selected' : ''}>${time.day_of_week} ${time.available_time}</option>`;
            });
        });
});

// Initialize doctor and available times on page load
document.addEventListener('DOMContentLoaded', function() {
    let initialDoctorId = '{{ $apointment->doctor_id }}';
    if (initialDoctorId) {
        fetch(`{{ route('availableTimes.byDoctor') }}?doctor_id=${initialDoctorId}`)
            .then(response => response.json())
            .then(data => {
                let timeSelect = document.getElementById('available_time');
                timeSelect.innerHTML = '<option value="">Select Time</option>';
                data.forEach(time => {
                    timeSelect.innerHTML += `<option value="${time.day_of_week} ${time.available_time}" ${time.day_of_week + ' ' + time.available_time == '{{ $apointment->available_time }}' ? 'selected' : ''}>${time.day_of_week} ${time.available_time}</option>`;
                });
            });
    }
});
</script>
@endsection
