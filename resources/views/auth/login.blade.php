<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <title>Login & Register</title>
    @laravelPWA

    <style>
        :root {
            --primary-color: #6c5ce7;
            --primary-dark: #5649c0;
            --secondary-color: #a29bfe;
            --text-color: #2d3436;
            --light-text: #636e72;
            --bg-color: #f5f6fa;
            --white: #ffffff;
            --shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            --transition: all 0.3s ease;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Montserrat', sans-serif;
        }

        body {
            background-color: var(--bg-color);
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            padding: 10px;
        }

        .container {
            background-color: var(--white);
            border-radius: 20px;
            box-shadow: var(--shadow);
            position: relative;
            overflow-y: auto;
            width: 100%;
            max-width: 900px;
            min-height: 500px;
            transition: var(--transition);
        }

        .form-container {
            position: absolute;
            top: 0;
            height: 100%;
            width: 50%;
            transition: var(--transition);
            padding: 20px;
            box-sizing: border-box;
        }

        .form-container form {
            height: auto;
            min-height: 100%;
            padding: 0 20px;
            text-align: center;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }

        .form-header {
            margin-bottom: 20px;
        }

        .form-header h1 {
            font-size: 24px;
            font-weight: 700;
            color: var(--text-color);
            margin-bottom: 8px;
        }

        .form-header p {
            font-size: 13px;
            color: var(--light-text);
        }

        .form-container span {
            display: block;
            font-size: 12px;
            color: var(--light-text);
            margin: 10px 0;
            position: relative;
        }

        .form-container span::before,
        .form-container span::after {
            content: "";
            position: absolute;
            top: 50%;
            width: 60px;
            height: 1px;
            background-color: #ddd;
        }

        .form-container span::before {
            left: -70px;
        }

        .form-container span::after {
            right: -70px;
        }

        .input-group {
            position: relative;
            width: 100%;
            margin-bottom: 15px;
        }

        .input-group i {
            position: absolute;
            top: 50%;
            left: 12px;
            transform: translateY(-50%);
            color: var(--light-text);
            font-size: 14px;
        }

        .input-group .toggle-password {
            left: auto;
            right: 12px;
            cursor: pointer;
            font-size: 14px;
        }

        .input-group input {
            width: 100%;
            padding: 12px 15px 12px 35px;
            border: 1px solid #ddd;
            border-radius: 8px;
            font-size: 14px;
            transition: var(--transition);
        }

        .input-group input:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 2px rgba(108, 92, 231, 0.2);
            outline: none;
        }

        .error-message {
            color: #dc3545;
            font-size: 12px;
            margin-top: 5px;
            text-align: left;
            width: 100%;
        }

        .options {
            display: flex;
            justify-content: space-between;
            align-items: center;
            width: 100%;
            margin: 10px 0;
        }

        .remember-me {
            display: flex;
            align-items: center;
            font-size: 12px;
            color: var(--light-text);
            cursor: pointer;
        }

        .remember-me input {
            margin-right: 6px;
        }

        .forgot-password {
            font-size: 12px;
            color: var(--primary-color);
            text-decoration: none;
            transition: var(--transition);
        }

        .forgot-password:hover {
            text-decoration: underline;
        }

        .btn {
            width: 100%;
            padding: 12px;
            background-color: var(--primary-color);
            color: var(--white);
            border: none;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            transition: var(--transition);
            touch-action: manipulation;
        }

        .btn:hover {
            background-color: var(--primary-dark);
            transform: translateY(-1px);
        }

        .sign-in {
            left: 0;
            width: 50%;
            z-index: 2;
        }

        .sign-up {
            left: 0;
            width: 50%;
            opacity: 0;
            z-index: 1;
        }

        .container.active .sign-in {
            transform: translateX(100%);
        }

        .container.active .sign-up {
            transform: translateX(100%);
            opacity: 1;
            z-index: 5;
            animation: move 0.6s;
        }

        @keyframes move {

            0%,
            49.99% {
                opacity: 0;
                z-index: 1;
            }

            50%,
            100% {
                opacity: 1;
                z-index: 5;
            }
        }

        .toggle-container {
            position: absolute;
            top: 0;
            left: 50%;
            width: 50%;
            height: 100%;
            overflow: hidden;
            transition: var(--transition);
            border-radius: 150px 0 0 100px;
            z-index: 1000;
        }

        .container.active .toggle-container {
            transform: translateX(-100%);
            border-radius: 0 150px 100px 0;
        }

        .toggle {
            background: linear-gradient(135deg, var(--primary-color), var(--primary-dark));
            height: 100%;
            color: var(--white);
            position: relative;
            left: -100%;
            width: 200%;
            transform: translateX(0);
            transition: var(--transition);
        }

        .container.active .toggle {
            transform: translateX(50%);
        }

        .toggle-panel {
            position: absolute;
            width: 50%;
            height: 100%;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 0 20px;
            text-align: center;
            top: 0;
            transform: translateX(0);
            transition: var(--transition);
        }

        .toggle-panel h1 {
            font-size: 20px;
            margin-bottom: 10px;
        }

        .toggle-panel p {
            font-size: 13px;
            margin-bottom: 15px;
            line-height: 1.4;
        }

        .toggle-left {
            transform: translateX(-200%);
        }

        .container.active .toggle-left {
            transform: translateX(0);
        }

        .toggle-right {
            right: 0;
            transform: translateX(0);
        }

        .container.active .toggle-right {
            transform: translateX(200%);
        }

        .hidden {
            background-color: transparent;
            border: 2px solid var(--white);
            color: var(--white);
            padding: 10px 20px;
            font-size: 14px;
            border-radius: 8px;
            cursor: pointer;
            transition: var(--transition);
        }

        .hidden:hover {
            background-color: var(--white);
            color: var(--primary-color);
        }

        @media (max-width: 768px) {
            .container {
                max-width: 100%;
                min-height: auto;
                border-radius: 10px;
                padding: 10px;
            }

            .form-container {
                width: 100%;
                position: relative;
                padding: 15px;
                opacity: 1;
                z-index: 5;
            }

            .sign-in,
            .sign-up {
                transform: translateX(0) !important;
                opacity: 1;
                z-index: 5;
            }

            .container.active .sign-in {
                display: none;
            }

            .container.active .sign-up {
                display: block;
            }

            .toggle-container {
                display: block;
                position: relative;
                left: 0;
                width: 100%;
                height: auto;
                border-radius: 0;
                padding: 10px 0;
                background: none;
                z-index: 10;
            }

            .toggle {
                position: static;
                width: 100%;
                left: 0;
                transform: none;
                background: none;
            }

            .toggle-panel {
                position: relative;
                width: 100%;
                padding: 15px;
                transform: none !important;
                background: linear-gradient(135deg, var(--primary-color), var(--primary-dark));
                border-radius: 10px;
                margin-bottom: 10px;
            }

            .container.active .toggle-right,
            .toggle-left {
                display: none;
            }

            .container.active .toggle-left,
            .toggle-right {
                display: flex;
            }
        }

        @media (max-width: 480px) {
            .container {
                padding: 5px;
            }

            .form-container {
                padding: 10px;
            }

            .form-container form {
                padding: 0 10px;
            }

            .form-header h1 {
                font-size: 18px;
            }

            .form-header p {
                font-size: 11px;
            }

            .input-group input {
                padding: 8px 10px 8px 30px;
                font-size: 12px;
            }

            .input-group i {
                font-size: 12px;
                left: 8px;
            }

            .input-group .toggle-password {
                right: 8px;
            }

            .btn,
            .hidden {
                padding: 8px;
                font-size: 12px;
            }

            .toggle-panel h1 {
                font-size: 16px;
            }

            .toggle-panel p {
                font-size: 11px;
            }

            .form-container span::before,
            .form-container span::after {
                width: 30px;
            }

            .form-container span::before {
                left: -40px;
            }

            .form-container span::after {
                right: -40px;
            }
        }
    </style>
</head>

<body>
    <div class="container" id="container">
        <div class="form-container sign-in">
            <form action="{{ route('login.post') }}" method="POST">
                @csrf
                <div class="form-header">
                    <h1>Selamat Datang</h1>
                    <p>Silahkan login dengan akun anda</p>
                </div>
                <span>Masukan email dan password</span>
                <div class="input-group">
                    <i class="fas fa-envelope"></i>
                    <input type="email" placeholder="Email" name="email" required>
                </div>
                <div class="input-group">
                    <i class="fas fa-lock"></i>
                    <input type="password" placeholder="Password" name="password" required>
                    <i class="fas fa-eye toggle-password" onclick="togglePassword(this)"></i>
                </div>

                <button type="submit" class="btn">Masuk</button>
            </form>
        </div>
        <div class="toggle-container">
            <div class="toggle">
                <div class="toggle-panel toggle-left">
                    <h1>Sudah Register Akun!</h1>
                    <p>Silahkan login dihalaman ini</p>
                    <button class="hidden" id="login">Sign In</button>
                </div>
                <div class="toggle-panel toggle-right">
                    <h1>Selamat Datang Di Aplikasi Saya</h1>
                </div>
            </div>
        </div>
    </div>

    <script>
        const container = document.getElementById('container');
        const registerBtn = document.getElementById('register');
        const loginBtn = document.getElementById('login');

        registerBtn.addEventListener('click', () => {
            if (window.innerWidth <= 768) {
                container.classList.add("active");
            } else {
                container.classList.add("active");
            }
        });

        loginBtn.addEventListener('click', () => {
            if (window.innerWidth <= 768) {
                container.classList.remove("active");
            } else {
                container.classList.remove("active");
            }
        });

        function togglePassword(icon) {
            const input = icon.previousElementSibling;
            if (input.type === "password") {
                input.type = "text";
                icon.classList.remove("fa-eye");
                icon.classList.add("fa-eye-slash");
            } else {
                input.type = "password";
                icon.classList.remove("fa-eye-slash");
                icon.classList.add("fa-eye");
            }
        }

        function handleLogin(event) {
            event.preventDefault();
            const email = event.target.email.value;
            const password = event.target.password.value;
            alert('Login attempted with:\nEmail: ' + email + '\nPassword: ' + password);
        }

        function handleRegister(event) {
            event.preventDefault();
            const name = event.target.name.value;
            const email = event.target.email.value;
            const password = event.target.password.value;
            alert('Register attempted with:\nName: ' + name + '\nEmail: ' + email + '\nPassword: ' + password);
        }
    </script>
</body>

</html>
