<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background: #e0e0e0;
            font-family: 'Arial', sans-serif;
            padding: 0px;
        }

        .content {
            background: #e0e0e0;
            box-shadow: 9px 9px 16px #bebebe, -9px -9px 16px #ffffff;
            border-radius: 15px;
            padding: 30px;
            width: 500px;
            box-sizing: border-box;
        }

        .text {
            text-align: center;
            font-size: 24px;
            font-weight: bold;
            color: #333;
            margin-bottom: 20px;
        }

        .alert-success,
        .alert-error {
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 20px;
        }

        .alert-success {
            background-color: #8BC34A;
            color: white;
        }

        .alert-error {
            background-color: #F44336;
            color: white;
        }

        .field {
            position: relative;
            margin-bottom: 15px;
        }

        .field input {
            width: 100%;
            padding: 10px;
            font-size: 14px;
            border: none;
            outline: none;
            border-radius: 10px;
            background: #e0e0e0;
            box-shadow: inset 5px 5px 10px #bebebe, inset -5px -5px 10px #ffffff;
        }

        .field label {
            position: absolute;
            top: -10px;
            left: 10px;
            background: #e0e0e0;
            padding: 0 5px;
            font-size: 12px;
            color: #666;
        }

        button {
            width: 200px;
            padding: 10px;
            font-size: 16px;
            border: none;
            border-radius: 10px;
            background: #e0e0e0;
            box-shadow: 5px 5px 10px #bebebe, -5px -5px 10px #ffffff;
            cursor: pointer;
            margin-top: 10px;
        }

        button:hover {
            background-color: #d4d4d4;
        }

        .btn-custom-width {
            width: 150px;
        }

        /* Center change password section */
        .change-password-section {
            display: flex;
            justify-content: center;
            margin-top: 20px;
            flex-direction: column;
            align-items: center;
        }

        .toggle-password {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
        }
    </style>
</head>

<body>
    <div class="content">
        <div class="text">User Dashboard</div>

        <!-- Display success message -->
        @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        @endif

        <!-- Display error message -->
        @if (session('error'))
        <div class="alert alert-error">
            {{ session('error') }}
        </div>
        @endif

        <!-- Display user information -->
        <form action="{{ route('user.update') }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-row">
                <div class="col">
                    <div class="field">
                        <input type="text" name="name" value="{{ old('name', $user->name) }}" required>
                        <label>Name</label>
                    </div>
                </div>
                <div class="col">
                    <div class="field">
                        <input type="text" name="age" value="{{ old('age', $user->age) }}" required>
                        <label>Age</label>
                    </div>
                </div>
                <div class="col">
                    <div class="field">
                        <input type="text" name="mobile_number" value="{{ old('mobile_number', $user->mobile_number) }}" required>
                        <label>Mobile Number</label>
                    </div>
                </div>
            </div>

            <div class="field mb-3">
                <input type="email" name="email" value="{{ old('email', $user->email) }}" required>
                <label>Email</label>
            </div>

            <div class="field mb-2">
                <input type="text" name="address" value="{{ old('address', $user->address) }}" required>
                <label>Address</label>
            </div>

            <div class="text-center mb-4">
                <button type="submit">Update</button>
            </div>
        </form>

        <!-- Change Password Form -->
        <div class="change-password-section">
            <form action="{{ route('user.changePassword') }}" method="POST">
                @csrf
                <div class="field mb-1 mt-3">
                    <input type="password" name="current_password" id="current_password" required>
                    <label>Current Password</label>
                    <i class="fas fa-eye toggle-password" id="toggleCurrentPassword"></i>
                </div>
                <div class="field mb-1">
                    <input type="password" name="new_password" id="new_password" required>
                    <label>New Password</label>
                    <i class="fas fa-eye toggle-password" id="toggleNewPassword"></i>
                </div>
                <div class="field mb-1">
                    <input type="password" name="new_password_confirmation" id="new_password_confirmation" required>
                    <label>Confirm New Password</label>
                    <i class="fas fa-eye toggle-password" id="toggleConfirmPassword"></i>
                </div>
                <div class="button-group text-center mb-3">
                    <button type="submit">Change Password</button>
                </div>
            </form>
        </div>

        <!-- Button group for Delete and Logout -->
        <div class="button-group d-flex justify-content-between mt-2">
            <form action="{{ route('user.destroy') }}" method="POST" class="d-inline">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger btn-custom-width">Delete User</button>
            </form>

            <form action="{{ route('logout') }}" method="POST" class="d-inline">
                @csrf
                <button type="submit" class="btn btn-outline-secondary btn-custom-width">Logout</button>
            </form>
        </div>
    </div>

    <!-- Bootstrap JS (optional, for dropdowns, etc.) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        // JavaScript to toggle password visibility
        const togglePasswordVisibility = (toggleId, inputId) => {
            const toggle = document.getElementById(toggleId);
            const input = document.getElementById(inputId);

            toggle.addEventListener('click', () => {
                const type = input.getAttribute('type') === 'password' ? 'text' : 'password';
                input.setAttribute('type', type);
                toggle.classList.toggle('fa-eye-slash');
            });
        }

        togglePasswordVisibility('toggleCurrentPassword', 'current_password');
        togglePasswordVisibility('toggleNewPassword', 'new_password');
        togglePasswordVisibility('toggleConfirmPassword', 'new_password_confirmation');
    </script>
</body>

</html>