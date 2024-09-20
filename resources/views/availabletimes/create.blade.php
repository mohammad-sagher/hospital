@extends('layout.dashboard')

@section('content')
<div class="container mt-5">
    <h2>Add New Available Time for Doctor</h2>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('availabletimes.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="doctor_id" class="form-label">Select Doctor</label>
            <select name="doctor_id" class="form-select" required>
                @foreach($doctors as $doctor)
                    <option value="{{ $doctor->id }}">{{ $doctor->name }}</option>
                @endforeach
            </select>
        </div>

        @foreach(['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'] as $day)
            <div class="mb-3">
                <label for="available_times[{{ $day }}][time]" class="form-label">Available Time for {{ $day }}</label>
                <input type="time" class="form-control" name="available_times[{{ $day }}][time]">
            </div>
        @endforeach

        <button type="submit" class="btn btn-primary">Add</button>
    </form>
</div>
@endsection
