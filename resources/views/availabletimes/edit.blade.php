@extends('layout.dashboard')

@section('content')
<div class="container mt-5">
    <h2>Edit Doctor's Available Times</h2>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('availabletimes.update', $availableTime->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="doctor_id" class="form-label">Select Doctor</label>
            <select name="doctor_id" class="form-select" required>
                @foreach($doctors as $doctor)
                    <option value="{{ $doctor->id }}" {{ $doctor->id == $availableTime->doctor_id ? 'selected' : '' }}>
                        {{ $doctor->name }}
                    </option>
                @endforeach
            </select>
        </div>

        @foreach(['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'] as $day)
            <div class="mb-3">
                <label for="available_times[{{ $day }}]" class="form-label">Available Time for {{ $day }}</label>
                <input type="time" class="form-control" name="available_times[{{ $day }}]" value="{{ $availableTimes[$day] ?? '' }}">
            </div>
        @endforeach

        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
@endsection
