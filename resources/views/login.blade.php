<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <title>Login</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <style>
        @import url('https://fonts.googleapis.com/css?family=Poppins:400,500,600,700&display=swap');

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        html,
        body {
            height: 100%;
        }

        body {
            display: grid;
            place-items: center;
            background: #dde1e7;
            text-align: center;
        }

        .content {
            width: 330px;
            padding: 40px 30px;
            background: #dde1e7;
            border-radius: 10px;
            box-shadow: -3px -3px 7px #ffffff73,
                2px 2px 5px rgba(94, 104, 121, 0.288);
        }

        .content .text {
            font-size: 33px;
            font-weight: 600;
            margin-bottom: 35px;
            color: #595959;
        }

        .field {
            height: 50px;
            width: 100%;
            display: flex;
            position: relative;
            margin-top: 20px;
        }

        .field input {
            height: 100%;
            width: 100%;
            padding-left: 45px;
            outline: none;
            border: none;
            font-size: 18px;
            background: #dde1e7;
            color: #595959;
            border-radius: 25px;
            box-shadow: inset 2px 2px 5px #BABECC,
                inset -5px -5px 10px #ffffff73;
        }

        .field input:focus {
            box-shadow: inset 1px 1px 2px #BABECC,
                inset -1px -1px 2px #ffffff73;
        }

        .field label {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            left: 45px;
            pointer-events: none;
            color: #666666;
        }

        .field input:valid~label {
            opacity: 0;
        }

        button {
            margin: 15px 0;
            width: 100%;
            height: 50px;
            font-size: 18px;
            line-height: 50px;
            font-weight: 600;
            background: #dde1e7;
            border-radius: 25px;
            border: none;
            outline: none;
            cursor: pointer;
            color: #595959;
            box-shadow: 2px 2px 5px #BABECC,
                -5px -5px 10px #ffffff73;
        }

        button:focus {
            color: #3498db;
            box-shadow: inset 2px 2px 5px #BABECC,
                inset -5px -5px 10px #ffffff73;
        }

        .sign-up {
            margin: 10px 0;
            color: #595959;
            font-size: 16px;
        }

        .sign-up a {
            color: #3498db;
            text-decoration: none;
        }

        .sign-up a:hover {
            text-decoration: underline;
        }

        .error {
            color: red;
        }

        .success {
            color: green;
        }

        .toggle-password {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            color: #595959;
        }
    </style>
</head>

<body>
    <div class="content">
        <div class="text">Login</div>

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

        <form action="{{ route('login') }}" method="POST">
            @csrf
            <div class="field">
                <input type="email" name="email" id="login-email" required>
                <label>Email</label>
            </div>
            <div class="field">
                <input type="password" name="password" id="login-password" required>
                <label>Password</label>
                <i class="fas fa-eye toggle-password" id="toggleLoginPassword"></i>

            </div>
            <button type="submit">Login</button>
            <div class="sign-up">
                Don't have an account? <a href="{{ route('user.create') }}"> <br>Create User</a>
            </div>
        </form>
    </div>
    <script>
        // JavaScript to toggle password visibility
        const toggleLoginPassword = document.getElementById('toggleLoginPassword');
        const loginPasswordField = document.getElementById('login-password');

        toggleLoginPassword.addEventListener('click', () => {
            const type = loginPasswordField.getAttribute('type') === 'password' ? 'text' : 'password';
            loginPasswordField.setAttribute('type', type);
            toggleLoginPassword.classList.toggle('fa-eye-slash');
        });
    </script>
</body>

</html>