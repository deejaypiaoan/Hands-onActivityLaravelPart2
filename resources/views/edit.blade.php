<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User</title>
    <link rel="stylesheet" href="your-css-path-here"> <!-- Use the same CSS -->
</head>

<body>
    <div class="content">
        <div class="text">Edit User</div>

        @if (session('success'))
        <div class="success">{{ session('success') }}</div>
        @endif

        @if ($errors->any())
        <div class="error">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <form action="{{ route('user.update') }}" method="POST">
            @csrf
            @method('PUT')
            <div class="field">
                <input type="text" name="age" value="{{ old('age', $user->age) }}" placeholder="Age" required>
            </div>
            <div class="field">
                <input type="text" name="address" value="{{ old('address', $user->address) }}" placeholder="Address" required>
            </div>
            <div class="field">
                <input type="text" name="mobile_number" value="{{ old('mobile_number', $user->mobile_number) }}" placeholder="Mobile Number" required>
            </div>
            <button type="submit">Update</button>
        </form>
    </div>
</body>

</html>