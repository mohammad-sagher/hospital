<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    @include('layout.styles')
    <title>Add New Patient</title>
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: url('/images/background.jpg') no-repeat center center fixed; /* استخدام مسار ثابت */
            background-size: cover; /* جعل الصورة تغطي كامل الخلفية */
        }
        .container {
            max-width: 600px; /* زيادة الحد الأقصى للعرض */
            background-color: rgba(255, 255, 255, 0.9); /* خلفية بيضاء مع شفافية */
            padding: 40px; /* تباعد داخلي */
            border-radius: 10px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
            margin: auto; /* مركزية العنصر */
            margin-top: 50px; /* تباعد أعلى */
        }
        h1 {
            margin-bottom: 20px; /* تباعد أسفل العنوان */
            text-align: center; /* محاذاة العنوان في المركز */
        }
        .form-group {
            margin-bottom: 15px; /* تباعد بين الحقول */
        }
        .btn {
            background-color: #007bff; /* لون زر */
            color: white; /* لون نص الزر */
            width: 100%; /* جعل الزر يشغل كامل عرض الحقل */
        }
        .btn:hover {
            background-color: #0056b3; /* لون الزر عند التحويم */
        }
    </style>
</head>
<body>

<!-- Main Content -->
<div class="container">
    <h1 class="mb-4">Add New Patient</h1>
    <li><a href="{{ route('health.home') }}" class="btn btn-primary">Back to Home</a></li>

    <form action="{{ route('store.NewPatients') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ Auth::user()->name }}" required>
            @error('name')
                <span class="invalid-feedback">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="age">Age</label>
            <input type="number" class="form-control @error('age') is-invalid @enderror" id="age" name="age" value="{{ old('age') }}" required>
            @error('age')
                <span class="invalid-feedback">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="address">Address</label>
            <input type="text" class="form-control @error('address') is-invalid @enderror" id="address" name="address" value="{{ old('address') }}" required>
            @error('address')
                <span class="invalid-feedback">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="phone_number">Phone Number</label>
            <input type="text" class="form-control @error('phone_number') is-invalid @enderror" id="phone_number" name="phone_number" value="{{ old('phone_number') }}" required>
            @error('phone_number')
                <span class="invalid-feedback">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ Auth::user()->email }}" required>
            @error('email')
                <span class="invalid-feedback">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="gender">Gender</label>
            <select class="form-control @error('gender') is-invalid @enderror" id="gender" name="gender" required>
                <option value="Male" {{ old('gender') == 'Male' ? 'selected' : '' }}>Male</option>
                <option value="Female" {{ old('gender') == 'Female' ? 'selected' : '' }}>Female</option>
            </select>
            @error('gender')
                <span class="invalid-feedback">{{ $message }}</span>
            @enderror
        </div>

        <button type="submit" class="mt-3 btn btn-primary">Add</button>
    </form>
    <br>
</div>

</body>
</html>
