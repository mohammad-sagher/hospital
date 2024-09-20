<!-- resources/views/invoices/show.blade.php -->
@extends('layout.dashboard')

@section('content')
    <div class="container">
        <h1>Invoice Details</h1>
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Invoice #{{ $invoice->id }}</h5>
                
                <p class="card-text"><strong>Total Amount:</strong> ${{ $invoice->total_amount }}</p>
                <p class="card-text"><strong>Patient:</strong> {{ $invoice->patient->name ?? 'Not available' }}</p>
                <p class="card-text"><strong>Payment Status:</strong> {{ $invoice->paymaent_status }}</p>
                <p class="card-text"><strong>Payment Date:</strong> {{ $invoice->paymaent_date }}</p>
                <p class="card-text"><strong>Issued Date:</strong> {{ $invoice->issud_date }}</p>
                <a href="{{ route('invoices.index') }}" class="btn btn-secondary">Back to List</a>
            </div>
        </div>
    </div>
@endsection
