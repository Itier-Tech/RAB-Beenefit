<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://fonts.googleapis.com/css?family=Inter' rel='stylesheet'>
    <title>Login Beenefit</title>
    <style>
        body, html {
            height: 100%;
            margin: 0;
        }

        .container {
            display: flex;
            height: 100%;
        }

        .bg-container {
            flex: 1;
            background-image: url('/bg-login.png');
            background-size: cover;
            background-position: center;
        }

        .content-container {
            flex: 1;
            background: #F0F0F0;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .form-container {
            width: 28.125rem;
            height: 31.25rem;

            background: #FFFFFF;

            margin: 0.625rem;
            border-radius: 1.875rem;
            padding: 1.25rem;

            display: flex;
            justify-content: center;
            flex-direction:column;
            align-items: center;
        }

        .logo {
            width: 10rem;
            height: 10rem;
        }

        .masuk {
            font-family: Inter;
            font-weight: 800;
            font-size: 28px;
            margin-bottom: 20px;
        }

        input[type="email"],
        input[type="password"],
        input[type="submit"] {
            width: 18.75rem;
            padding: 0.625rem;
            margin-bottom: 1.25rem;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
            display: block;
        }

        input[type="submit"] {
            background-color: #D2D2D2;
            color: #fff;
            border: none;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        input[type="submit"]:hover {
            background-color: #848484;
        }

        input[type="checkbox"] {
            display: inline-block;
            margin-right: 5px;
            margin-top: 1.875rem;
        }

        label {
            display: block;
            margin-bottom: 0.625rem;
        }

        .forgot-password:hover {
            text-decoration: underline;
        }

        .filled-button {
            background-color: #FFD700 !important;
        }

        @media (max-width:768px) {
            .content-container {
                background-image: url('/bg-login.png');
            }

            .bg-container {
                display: none;
            }

            .form-container {
                width: 28rem;
                height: 25rem;
                padding: 2rem
            }

            .logo {
                width: 5rem;
                height: 5rem;
            }

            .masuk {
                font-size: 1.25rem;
            }

            input[type="email"],
            input[type="password"],
            input[type="submit"] {
                width: 25rem;
            }
        }

        @media (max-width:540px) {
            .content-container {
                background-image: url('/bg-login.png');
            }

            .bg-container {
                display: none;
            }

            .form-container {
                width: 14rem;
                height: 25rem;
            }

            .logo {
                width: 5rem;
                height: 5rem;
            }

            .masuk {
                font-size: 1.25rem;
            }

            input[type="email"],
            input[type="password"],
            input[type="submit"] {
                width: 13rem;
            }
        }


    </style>
</head>
<body>
    <div class="container">
        <div class="bg-container"></div>
        <div class="content-container">
            <div class="form-container">
                <img src="/beenefit-logo.png" alt="Beenefit Logo" class="logo"></img>
                <div class="masuk">
                    Masuk
                </div>
                <form action="/login" method="post">
                    @csrf
                    <label for="email" style="font-family: Inter; font-size: 12px; font-weight: 800;">Email</label>
                    @error('email')
                        <div class="invalid-feedback" style="font-family: Inter; font-size: 12px; font-weight: 800; color: red;">
                            {{ $message }}
                        </div>
                    @enderror
                    <input class="@error('email') is-invalid @enderror" type="email" id="email" name="email" placeholder="Email" required value="{{ old('email') }}">

                    <label for="password" style="font-family: Inter; font-size: 12px; font-weight: 800;">Password</label>
                    <input type="password" id="password" name="password" placeholder="Password" required style="margin-bottom: 10px;">

                    <div class="forgot-password"style="color: #FFA07A; font-family: Inter; font-size: 12px; text-align: right; cursor: pointer;">Lupa Password?</div>

                    <input type="checkbox" id="remember" name="remember">
                    <label for="remember" style="font-family: Inter; font-size: 12px; font-weight: 800; display: inline-block; align-items: center;">Ingat Saya</label>

                    <input type="submit" value="Login" id="login-button">

                </form>
                <a href="/register" style="font-family: Inter; font-size: 12px; font-weight: 200; justify-content: center">Belum punya akun? <span style="color: #228B22; cursor: pointer;" onmouseover="this.style.textDecoration='underline'">Buat Akun</span></a>

            </div>
        </div>
    </div>
    <script>
        function checkInput() {
            const emailInput = document.getElementById('email');
            const passwordInput = document.getElementById('password');
            const loginButton = document.getElementById('login-button');
            if (emailInput.value.trim() !== '' && passwordInput.value.trim() !== '') {
                loginButton.classList.add('filled-button');
            } else {
                loginButton.classList.remove('filled-button');
            }
        }

        const form = document.getElementById('login-form');
        form.addEventListener('input', checkInput);
    </script>
</body>
</html>
