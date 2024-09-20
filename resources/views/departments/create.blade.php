@extends('layout.dashboard')

@section('content')
<div class="container mt-5">
    <h1 class="mb-4">Add New Department</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('departments.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Department Name</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" required>
        </div>

        <div class="mb-3">
            <label for="contact_info" class="form-label">Contact Information</label>
            <input type="text" class="form-control" id="contact_info" name="contact_info" value="{{ old('contact_info') }}">
        </div>

        <div class="mb-3">
            <label for="head" class="form-label">Department Head</label>
            <input type="text" class="form-control" id="head" name="head" value="{{ old('head') }}" required>
        </div>

        <button type="submit" class="btn btn-primary">Save Department</button>
    </form>
</div>
@endsection
