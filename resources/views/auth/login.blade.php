<head>
    <meta charset="utf-8">
    <title>Login | Ecsis</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- MATERIAL DESIGN ICONIC FONT -->
    <link rel="stylesheet" href="fonts/material-design-iconic-font/css/material-design-iconic-font.min.css">

    <!-- Favicons -->
    <link href="{{ asset('assets/public/img/icon.png') }}" rel="icon">
    <link href="{{ asset('assets/public/img/icon.png') }}" rel="apple-touch-icon">

    <!-- STYLE CSS -->
    <link rel="stylesheet" href="{{ asset('assets/auth/css/style.css') }}">

    <style>
        .button-container {
            display: flex;
            gap: 10px;
            /* Jarak antara tombol */
        }

        .btn {
            padding: 10px 20px;
            border: none;
            cursor: pointer;
            font-size: 16px;
        }

        .btn-info {
            background-color: #17a2b8;
            color: white;
        }

        .btn-warning {
            background-color: #ffc107;
            color: black;
        }

        .btn-info:hover,
        .btn-warning:hover {
            opacity: 0.8;
            /* Efek hover untuk tombol */
        }
    </style>
</head>

<div class="wrapper" style="background-image: url('{{ asset('assets/auth/images/bg-registration-form-2.jpg') }}');">
    <div class="inner">
        <form action="{{ route('login') }}" method="POST">
            <h3>Log In</h3>
            <div class="form-wrapper">
                <label for="">Username</label>
                <input type="text" class="form-control">
            </div>
            <div class="form-wrapper">
                <label for="">Password</label>
                <input type="password" class="form-control">
            </div>
            <div class="checkbox">
                <label>
                    <input type="checkbox"> I caccept the Terms of Use & Privacy Policy.
                    <span class="checkmark"></span>
                </label>
            </div>
            <div class="button-container">
                <button class="btn btn-info">MASUK</button>
                <button class="btn btn-warning" style="color:white;">Reset Password</button>
            </div>
        </form>
        <P style="margin-top:30px; margin-left:50px;">Belum Punya Akun?<a href="{{ route('auth.view.register') }}"> Daftar Sekarang!</a></P>
    </div>
</div>

<!--================== SWEET ALERT  ==================-->
@if (session('success'))
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    Swal.fire({
        icon: 'success',
        title: 'Berhasil Register',
        text: 'Anda Berhasil Register, Silahkan Log in Sekarang',
        confirmButtonText: 'OK'
    });
</script>
@endif
<!--================== END ==================-->