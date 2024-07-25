<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Registration | Ecsis</title>

    <!-- Font Icon -->
    <link rel="stylesheet" href="{{ asset('assets/auth/fonts/material-icon/css/material-design-iconic-font.min.css') }}">

    <!-- Main css -->
    <link rel="stylesheet" href="{{ asset('assets/auth/css/style.css') }}">

    <style>
        /* Password and Confirmation password group */
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
            <div class="signup-content">
                <div class="signup-form">
                    <h2 class="form-title">Register</h2>
                    <form action="{{ route('auth.register') }}" method="POST">
                        @csrf
                        <div class="form-row">
                            <div class="form-group col-6">
                                <label for="name"><i class="zmdi zmdi-account material-icons-name"></i></label>
                                <input type="text" name="name" id="name" class="form-control" placeholder="Nama" value="{{ old('name') }}" autofocus maxlength="30" minlength="5" onkeypress="return/[a-zA-Z0-9 ]/i.test(event.key)" required>
                            </div>

                            <div class="form-group col-6">
                                <label for="name"><i class="zmdi zmdi-account material-icons-name" style="margin-bottom:30px;"></i></label>
                                <input type="text" name="username" id="username" class="form-control" placeholder="Username" value="{{ old('username') }}" maxlength="30" minlength="5" onkeypress="return/[a-zA-Z0-9 ]/i.test(event.key)" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="email"><i class="zmdi zmdi-email"></i></label>
                            <input type="email" name="email" id="email" class="form-control" placeholder="Masukan Email" maxlength="30" minlength="5" onkeypress="return/[a-zA-Z0-9@.]/i.test(event.key)" required>
                        </div>
                        <div class="form-group password-group">
                            <label for="pass"><i class="zmdi zmdi-lock"></i></label>
                            <input type="password" name="password" class="form-control" id="password" placeholder="Masukan Password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Harus berisi setidaknya satu angka dan satu huruf besar dan kecil, dan setidaknya 8 karakter atau lebih" required>
                            <i class="zmdi zmdi-eye password-toggle" id="password-toggle"></i>
                        </div>
                        <div class="form-group password-group">
                            <label for="re-pass"><i class="zmdi zmdi-lock-outline"></i></label>
                            <input type="password" name="password_confirmation" class="form-control" id="password_confirmation" placeholder="Masukan Konfirmasi Password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Harus berisi setidaknya satu angka dan satu huruf besar dan kecil, dan setidaknya 8 karakter atau lebih" required>
                            <i class="zmdi zmdi-eye password-toggle" id="password-confirmation-toggle"></i>
                        </div>
                        <div class="form-group">
                            <input type="checkbox" name="agree-term" id="agree-term" class="agree-term">
                            <label for="agree-term" class="label-agree-term"><span><span></span></span>I agree all statements in <a href="#" class="term-service">Terms of service</a></label>
                        </div>
                        <div class="form-group form-button">
                            <input type="submit" name="signup" id="signup" class="form-submit" value="Register">
                        </div>
                    </form>
                </div>
                <div class="signup-image">
                    <figure><img src="{{ asset('assets/auth/images/signup-image.jpg') }}" alt="sign up image"></figure>
                    <a href="{{ route('auth.admin') }}" class="signup-image-link">I am already member</a>
                </div>
            </div>
        </div>
    </section>
</div>

<!-- JS -->
<script src="{{ asset('assets/auth/vendor/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('assets/auth/js/main.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<!--================== SHOW & HIDE PASSWORD ==================-->
<script>
    document.getElementById('register-form').addEventListener('submit', function(event) {
        const password = document.getElementById('password').value;
        const passwordConfirmation = document.getElementById('password_confirmation').value;

        if (password !== passwordConfirmation) {
            event.preventDefault(); // Prevent form submission
            Swal.fire({
                icon: 'error',
                title: 'Passwords Tidak Sesuai',
                text: 'Harap pastikan password dan konfirmasi password cocok.',
                confirmButtonText: 'OK'
            });
        }
    });

    const passwordInput = document.getElementById('password');
    const passwordToggle = document.getElementById('password-toggle');

    passwordToggle.addEventListener('click', function() {
        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            passwordToggle.classList.remove('zmdi-eye');
            passwordToggle.classList.add('zmdi-eye-off');
        } else {
            passwordInput.type = 'password';
            passwordToggle.classList.remove('zmdi-eye-off');
            passwordToggle.classList.add('zmdi-eye');
        }
    });

    const passwordInput2 = document.getElementById('password_confirmation');
    const passwordToggle2 = document.getElementById('password-confirmation-toggle');

    passwordToggle2.addEventListener('click', function() {
        if (passwordInput2.type === 'password') {
            passwordInput2.type = 'text';
            passwordToggle2.classList.remove('zmdi-eye');
            passwordToggle2.classList.add('zmdi-eye-off');
        } else {
            passwordInput2.type = 'password';
            passwordToggle2.classList.remove('zmdi-eye-off');
            passwordToggle2.classList.add('zmdi-eye');
        }
    });
</script>
<!--================== END ==================-->