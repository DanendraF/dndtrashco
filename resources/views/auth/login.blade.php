<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TrashCo Login</title>
    <link href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="{{ asset('css/auth/login.css') }}">
</head>
<body>
    <div class="container">
        <div class="login-form">
            <div class="logo">
                <h1>TrashCo</h1>
            </div>
            <h2>Welcome Back</h2>

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="form-group">
                    <label for="email">Email Address :</label>
                    <input type="email" id="email" name="email" required value="{{ old('email') }}">
                </div>

                <div class="form-group">
                    <label for="password">Password :</label>
                    <input type="password" id="password" name="password" required>
                </div>

                <div class="forgot-password">
                    <a href="{{ route('register') }}">Don't have an account? Register</a>
                </div>

                <button type="submit">Login</button>

                <!-- Pesan error -->
                @error('email')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </form>
        </div>
        <div class="image-container">
            <img src="{{ asset('assets/bgloginkanan.jpg') }}" alt="Decorative Image">
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
