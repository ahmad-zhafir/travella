<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Travella - Login</title>
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body>
    <div class="login-container" role="main" aria-label="Login form for Travella">
        <div class="logo" aria-label="Travella logo">Travella</div>
        <div class="tagline">Malaysia's trusted accommodation booking</div>
        <form id="loginForm" method="POST" action="{{ route('login') }}" autocomplete="off" novalidate>
            @csrf  <!-- CSRF token for Laravel -->
            <label for="email">Email</label>
            <input type="email" id="email" name="email" placeholder="Enter your email" required autocomplete="email" aria-required="true" />
            <label for="password">Password</label>
                <div class="password-wrapper">
                    <input type="password" id="password" name="password" placeholder="Enter your password" required autocomplete="current-password" aria-required="true" />
                    <i class="fa-regular fa-eye toggle-eye" id="togglePassword" aria-hidden="true"></i>
                </div>
            <button type="submit" aria-label="Login to Travella">Login</button>
        </form>
        @if ($errors->has('email'))
    <script>
        alert("Email or password is incorrect.");
    </script>
@endif
        <div class="extra-links">
            Don't have an account? <a href="{{ route('register', ['redirect' => request('redirect')]) }}" tabindex="0">Sign Up</a>
        </div>
        <div class="footer-note">Explore and book your perfect stay in Malaysia with Travella.</div>
    </div>

    
</body>
<script>
    const togglePassword = document.getElementById('togglePassword');
    const passwordField = document.getElementById('password');

    togglePassword.addEventListener('click', function () {
        const type = passwordField.getAttribute('type') === 'password' ? 'text' : 'password';
        passwordField.setAttribute('type', type);

        // Toggle icon class
        this.classList.toggle('fa-eye');
        this.classList.toggle('fa-eye-slash');
    });
</script>


</html>
