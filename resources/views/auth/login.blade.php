<head>
    <meta charset="utf-8">
    <title>Login | ESAR</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('assets/auth/fonts/material-icon/css/material-design-iconic-font.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/auth/css/style.css') }}">
    <!-- Favicons -->
    <link href="{{ asset('assets/public/img/logo.jpeg') }}" rel="icon">
    <link href="{{ asset('assets/public/img/logo.jpeg') }}" rel="apple-touch-icon">

    <style>
        .password-group {
            position: relative;
            display: flex;
            align-items: center;
        }

        .password-toggle {
            position: absolute;
            right: 10px;
            cursor: pointer;
            z-index: 1;
            color: #000;
            font-size: 24px;
        }

        /* Responsive adjustment */
        .form-row {
            display: flex;
            gap: 10px;
        }

        .form-group {
            flex: 1;
        }

        .form-group input {
            width: 100%;
            box-sizing: border-box;
            padding-right: 40px;
        }

        .form-control:focus {
            border-color: #007bff;
            box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, .25);
        }
    </style>
</head>

<div class="main">
    <section class="signup">
        <div class="container">
            <div class="signup-content d-flex flex-wrap">
                <!-- Gambar di sebelah kiri -->
                <div class="signin-image">
                    <figure><img src="{{ asset('assets/auth/images/signin-image.jpg') }}" alt="sign up image"></figure>
                    <a href="{{ route('auth.view.register') }}" class="signin-image-link" style="text-decoration:none">Belum Punya Akun ? Daftar Sekarang!</a>
                </div>

                <!-- Form pendaftaran di sebelah kanan -->
                <div class="signup-form">
                    <h2 class="form-title">Log In</h2>
                    <form action="{{ route('login') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="name"><i class="zmdi zmdi-account material-icons-name"></i></label>
                            <input type="text" name="username" id="username" class="form-control" placeholder="Username" value="{{ old('username') }}" maxlength="30" minlength="5" onkeypress="return/[a-zA-Z0-9 ]/i.test(event.key)">
                        </div>

                        <div class="form-group password-group">
                            <label for="pass"><i class="zmdi zmdi-lock"></i></label>
                            <input type="password" name="password" class="form-control" id="password" placeholder="Masukan Password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Harus berisi setidaknya satu angka dan satu huruf besar dan kecil, dan setidaknya 8 karakter atau lebih">
                            <i class="zmdi zmdi-eye password-toggle" id="password-toggle"></i>
                        </div>

                        <div class="form-group">
                            <input type="checkbox" name="agree-term" id="agree-term" class="agree-term">
                            <label for="agree-term" class="label-agree-term"><span><span></span></span>I agree all statements in <a href="#" class="term-service">Terms of service</a></label>
                        </div>
                        <div class="form-group form-button">
                            <input type="submit" name="signup" id="signup" class="form-submit" value="Login">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>

<!--================== SWEET ALERT  ==================-->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@if (session('success'))
<script>
    Swal.fire({
        icon: 'success',
        title: 'Register Berhasil',
        text: 'Anda Berhasil Register, Silahkan Log in Sekarang',
        confirmButtonText: 'OK'
    });
</script>
@endif

@if (session('errorakun'))
<script>
    Swal.fire({
        icon: 'error',
        title: 'Login Gagal',
        text: 'Username atau Password anda salah!',
        confirmButtonText: 'Coba Lagi'
    });
</script>
@endif

@if (session('logout'))
<script>
    Swal.fire({
        icon: 'success',
        title: 'Log Out Berhasil',
        text: 'Anda telah berhasil log out!',
        confirmButtonText: 'OK'
    });
</script>
@endif

@if(session('errorbelumterdaftar'))
<script>
    Swal.fire({
        icon: 'error',
        title: 'Oops...',
        text: 'Akun Belum Terdaftar Silahkan Daftar Akun Telebih Dahulu'
    });
</script>
@endif

<!--================== END ==================-->

<!--================== SHOW & HIDE PASSWORD ==================-->
<script>
    document.getElementById('password-toggle').addEventListener('click', function() {
        // Ambil input password
        var passwordInput = document.getElementById('password');

        // Toggle antara text dan password
        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            this.classList.remove('zmdi-eye');
            this.classList.add('zmdi-eye-off');
        } else {
            passwordInput.type = 'password';
            this.classList.remove('zmdi-eye-off');
            this.classList.add('zmdi-eye');
        }
    });
</script>
<!--================== END ==================-->