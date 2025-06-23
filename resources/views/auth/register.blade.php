@if (request()->has('redirect'))
    @php
        session(['redirect_url' => request('redirect')]);
    @endphp
@endif

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Travella - Register</title>
    <link rel="stylesheet" href="{{ asset('css/register.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
</head>
<body>
    <div class="register-container" role="main" aria-label="Registration form for Travella">
        <div class="logo" aria-label="Travella logo">Travella</div>
        <div class="tagline">Create your account to book the best stays in Malaysia</div>


        @if ($errors->any())
    <div class="error-messages">
        <ul>
            @foreach ($errors->all() as $error)
                <li style="color:red;">{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

        <form id="registerForm" method="POST" action="{{ route('register') }}" autocomplete="off" novalidate>
            @csrf

            <label for="roleGuest">Register as</label> 
            <div class="role-toggle" role="radiogroup" aria-label="User role selection">
                <input type="radio" id="roleGuest" name="userRole" value="guest" checked />
                <label for="roleGuest" tabindex="0">Guest</label>

                <input type="radio" id="roleHost" name="userRole" value="host" />
                <label for="roleHost" tabindex="0">Host</label>
            </div>

            <label for="fullname">Full Name</label>
            <input type="text" id="fullname" name="fullname" placeholder="Enter your full name" required aria-required="true" />

            <label for="email">Email</label>
            <input type="email" id="email" name="email" placeholder="Enter your email address" required aria-required="true" />

            <label for="contact_no">Contact Number</label>
            <input type="text" id="contact_no" name="contact_no" placeholder="Enter your phone number" required aria-required="true" />

            <label for="password">Password</label>
            <div class="password-wrapper">
                <input type="password" id="password" name="password" placeholder="Enter a password" required aria-required="true" />
                <i class="fa-regular fa-eye toggle-eye" data-toggle="password" aria-hidden="true"></i>
            </div>

            <label for="confirmPassword">Confirm Password</label>
            <div class="password-wrapper">
                <input type="password" id="confirmPassword" name="password_confirmation" placeholder="Confirm your password" required aria-required="true" />
                <i class="fa-regular fa-eye toggle-eye" data-toggle="confirmPassword" aria-hidden="true"></i>
            </div>

            <div class="checkbox-container">
                <input type="checkbox" id="terms" name="terms" required aria-required="true" />
                <label for="terms">I agree to the <a href="#" target="_blank" rel="noopener">Terms & Conditions</a></label>
            </div>

            <button type="submit" aria-label="Register at Travella">Register</button>
        </form>

        <div class="extra-links">
            Already have an account? <a href="{{ route('login') }}" tabindex="0">Login</a>
        </div>
    </div>
</body>
    <script>

    const toggleIcons = document.querySelectorAll('.toggle-eye');

        toggleIcons.forEach(icon => {
            icon.addEventListener('click', function () {
                const inputId = this.getAttribute('data-toggle');
                const input = document.getElementById(inputId);

                if (!input) return;

                // Toggle input type
                const type = input.getAttribute('type') === 'password' ? 'text' : 'password';
                input.setAttribute('type', type);

                // Toggle icon classes
                this.classList.toggle('fa-eye');
                this.classList.toggle('fa-eye-slash');


            });
        });

        const form = document.getElementById('registerForm');

        form.addEventListener('submit', function(e) {
            e.preventDefault();

            const userRole = form.userRole.value;
            const fullname = form.fullname.value.trim();
            const email = form.email.value.trim();
            const password = form.password.value;
            const confirmPassword = form.confirmPassword.value;
            const termsChecked = form.terms.checked;
            const contactNo = form.contact_no.value.trim();

            if (!fullname) {
                alert('Please enter your full name.');
                form.fullname.focus();
                return;
            }

            if (!email) {
                alert('Please enter your email address.');
                form.email.focus();
                return;
            }
            const emailReg = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailReg.test(email)) {
                alert('Please enter a valid email address.');
                form.email.focus();
                return;
            }

            if (!contactNo) {
                alert('Please enter your contact number.');
                form.contact_no.focus();
                return;
            }
            const contactReg = /^01\d{8,9}$/;
            if (!contactReg.test(contactNo)) {
                alert('Please enter a valid Malaysian contact number (e.g., 0123456789).');
                form.contact_no.focus();
                return;
            }

            if (!password) {
                alert('Please enter a password.');
                form.password.focus();
                return;
            }
            if (password.length < 6) {
                alert('Password should be at least 6 characters long.');
                form.password.focus();
                return;
            }

            if (!confirmPassword) {
                alert('Please confirm your password.');
                form.confirmPassword.focus();
                return;
            }
            if (password !== confirmPassword) {
                alert('Passwords do not match.');
                form.confirmPassword.focus();
                return;
            }

            if (!termsChecked) {
                alert('You must agree to the Terms & Conditions.');
                form.terms.focus();
                return;
            }

            form.submit();

        });
    </script>
</html>
