<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TrashCo Register</title>
    <link href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="{{ asset('css/auth/register.css') }}">
</head>
<body>
    <div class="container">
        <div class="image-container">
            <img src="{{ asset('assets/bgloginkanan.jpg') }}" alt="Decorative Image">
        </div>
        <div class="form-container">
            <div class="logo">
                <h1>TrashCo</h1>
            </div>
            <h2>Hello, Register first</h2>
            <p>please enter your data correctly</p>

            <!-- Form Register dengan Blade dan CSRF -->
            <form method="POST" action="{{ route('register') }}">
                @csrf
                <div class="name-group">
                    <div class="form-group">
                        <label for="firstname">First Name :</label>
                        <input type="text" name="firstname" value="{{ old('firstname') }}" required>
                    </div>
                    <div class="form-group">
                        <label for="lastname">Last Name :</label>
                        <input type="text" name="lastname" value="{{ old('lastname') }}" required>
                    </div>
                </div>

                <div class="form-group">
                    <label for="username">Username :</label>
                    <input type="text" name="username" value="{{ old('username') }}" required>
                </div>

                <div class="form-group">
                    <label for="email">Email Address :</label>
                    <input type="email" name="email" value="{{ old('email') }}" required>
                </div>

                <div class="form-group">
                    <label for="password">Password :</label>
                    <input type="password" name="password" required>
                </div>

                <div class="form-group">
                    <label for="password_confirmation">Confirm Password :</label>
                    <input type="password" name="password_confirmation" required>
                </div>

                <button type="submit">Register</button>

                <div class="login-link">
                    <a href="/login">Already have an account? Login</a>
                </div>
            </form>
        </div>
    </div>
</body>
<script>
    @if(!Auth::check())
        Swal.fire({
            icon: 'warning',
            title: 'LOGIN DULU KAK',
            text: 'Kamu harus login terlebih dahulu sebelum melanjutkan!',
            confirmButtonText: 'OK'
        });
    @endif
</script>
</html>
