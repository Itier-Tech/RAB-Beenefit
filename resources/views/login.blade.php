<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://fonts.googleapis.com/css?family=Inter' rel='stylesheet'>
    <title>Login Beenefit</title>
    <link href="{{ asset('css/login.css') }}" rel="stylesheet">
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

                    <div class="forgot-password"style="font-family: Inter; font-size: 12px; text-align: right; cursor: pointer;"><a style="color: #FFA07A; text-decoration:none;" href="/forgot-password">Lupa Password?</a></div>

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
