<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @include('layout.styles')
    <title>Create Appointment</title>
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: url('/images/background.jpg') no-repeat center center fixed; /* استخدام مسار ثابت */
            background-size: cover; /* جعل الصورة تغطي كامل الخلفية */
        }
        
    </style>
</head>
<body>

<div class="container">
    <h1>Create Appointment</h1>

    <form action="{{ route('store.appointment') }}" method="POST">
        @csrf

        <!-- Department -->
        <div class="form-group">
            <label for="department_id">Department</label>
            <select id="department_id" name="department_id" class="form-control" required>
                <option value="">Select Department</option>
                @foreach($departments as $department)
                    <option value="{{ $department->id }}">{{ $department->name }}</option>
                @endforeach
            </select>
        </div>

        <!-- Doctor -->
        <div class="form-group">
            <label for="doctor_id">Doctor</label>
            <select id="doctor_id" name="doctor_id" class="form-control" required>
                <option value="">Select Doctor</option>
            </select>
        </div>

        <!-- Available Time -->
        <div class="form-group">
            <label for="available_time">Available Time</label>
            <select id="available_time" name="available_time" class="form-control" required>
                <option value="">Select Time</option>
            </select>
        </div>

        <!-- Patient Name Display -->
        <div class="form-group">
            <label for="patient_name">Patient Name</label>
            <input type="text" id="patient_name" name="patient_name" class="form-control" value="{{ $patient->name }}" readonly>
        </div>

        <!-- Hidden Patient ID Field -->
        <input type="hidden" id="patient_id" name="patient_id" value="{{ $patient->id }}">

        <!-- Reason for Visit -->
        <div class="form-group">
            <label for="reason_for_visit">Reason for Visit</label>
            <input type="text" id="reason_for_visit" name="reason_for_visit" class="form-control" required>
        </div>

        <!-- Appointment Status -->
        <div class="form-group">
            <label for="appointment_status">Appointment Status</label>
            <input type="text" id="appointment_status" name="appointment_status" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary">Create Appointment</button>
    </form>
</div>

<div class="toast" id="success-toast">
    {{ session('success') }}
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
                    doctorSelect.innerHTML += `<option value="${doctor.id}">${doctor.name}</option>`;
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
                    timeSelect.innerHTML += `<option value="${time.available_time}">${time.day_of_week} ${time.available_time}</option>`;
                });
            });
    });



</script>

</body>
</html>
