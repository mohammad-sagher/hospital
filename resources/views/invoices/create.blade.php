<!-- resources/views/invoices/create.blade.php -->
@extends('layout.dashboard')

@section('content')
    <div class="container">
        <h1>Add New Invoice</h1>
        <form action="{{ route('invoices.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="total_amount">Total Amount</label>
                <input type="number" step="0.01" class="form-control" id="total_amount" name="total_amount" value="{{ old('total_amount') }}" required>
            </div>
            <div class="form-group">
                <label for="patient_id">Patient</label>
                <select class="form-control" id="patient_id" name="patient_id" required>
                    @foreach($patients as $patient)
                        <option value="{{ $patient->id }}">{{ $patient->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="paymaent_status">Payment Status</label>
                <input type="text" class="form-control" id="paymaent_status" name="paymaent_status" value="{{ old('paymaent_status') }}">
            </div>
            <div class="form-group">
                <label for="paymaent_date">Payment Date</label>
                <input type="date" class="form-control" id="paymaent_date" name="paymaent_date" value="{{ old('paymaent_date') }}">
            </div>
            <div class="form-group">
                <label for="issud_date">Issued Date</label>
                <input type="date" class="form-control" id="issud_date" name="issud_date" value="{{ old('issud_date') }}">
            </div>
            <button type="submit" class="btn btn-primary">Save</button>
        </form>
    </div>
@endsection
