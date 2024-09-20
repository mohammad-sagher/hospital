@extends('layout.dashboard')

@section('content')
<div class="container mt-5">
    <h1 class="mb-4">Add New Examination</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('examinations.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="patient_id" class="form-label">Patient</label>
            <select class="form-select" id="patient_id" name="patient_id" required>
                @foreach($patients as $patient)
                    <option value="{{ $patient->id }}">{{ $patient->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="doctor_id" class="form-label">Doctor</label>
            <select class="form-select" id="doctor_id" name="doctor_id" required>
                @foreach($doctors as $doctor)
                    <option value="{{ $doctor->id }}">{{ $doctor->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="examination_date" class="form-label">Examination Date</label>
            <input type="date" class="form-control" id="examination_date" name="examination_date" required>
        </div>

        <div class="mb-3">
            <label for="diagnosis" class="form-label">Diagnosis</label>
            <textarea class="form-control" id="diagnosis" name="diagnosis" rows="3"></textarea>
        </div>
        <div class="mb-3">
            <label for="result" class="form-label">Result</label>
            <textarea class="form-control" id="result" name="result" rows="3"></textarea>
        </div>

        <div class="mb-3">
            <label for="treatment_diraction" class="form-label">Treatment Direction</label>
            <textarea class="form-control" id="treatment_diraction" name="treatment_diraction" rows="3"></textarea>
        </div>

        <div class="mb-3">
            <label for="medications" class="form-label">Medications</label>
            <select multiple class="form-select" id="medications" name="medications[]">
                @foreach($medications as $medication)
                    <option value="{{ $medication->id }}">{{ $medication->name }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Save Examination</button>
    </form>
</div>
@endsection
