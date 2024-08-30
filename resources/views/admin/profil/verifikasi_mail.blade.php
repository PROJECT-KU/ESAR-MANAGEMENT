<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <link rel="stylesheet" href="{{ asset('assets/modules/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/modules/fontawesome/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/modules/bootstrap-social/bootstrap-social.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/components.css') }}">
    <link rel="stylesheet" href="{{ asset('path/to/sweetalert2.css') }}">
    <script src="{{ asset('path/to/sweetalert2.js') }}"></script>

    <style>
        .container {
            background-color: #5F9EA0;
            margin: 20px;
            max-width: 100%;
            max-height: 100%;
        }

        .card {
            background-color: #F8F8FF;
            border-radius: 10px;
            max-width: 90%;
            /* Lebar maksimum card */
            padding: 20px;
            margin-top: 100px;
            /* Jarak atas */
            margin-bottom: 100px;
            /* Jarak bawah */
        }

        .card_dalam {
            background-color: #F5F5F5;
            color: white;
            border-radius: 10px;
            max-width: 90%;
            /* Lebar maksimum card */
            padding: 20px;
            margin-top: 20px;
            /* Jarak atas */
            margin-bottom: 20px;
            /* Jarak bawah */
        }

        @media (max-width: 767px) {

            /* Target perangkat dengan lebar maksimum 767px */
            .container {
                background-color: transparent;
                /* Mengubah warna latar belakang menjadi transparan */
            }

            .mobile {
                font-size: 18px;
            }
        }

        @media (min-width: 768px) and (max-width: 991px) {
            .mobile {
                margin-left: 100px;
            }
        }
    </style>
</head>

<body>
    <div id="app">
        <section class="section">
            <div class="container mt-5">
                <div class="row">
                    <div class="col-12 col-sm-10 offset-sm-1 col-md-8 offset-md-2 col-lg-8 offset-lg-2 col-xl-8 offset-xl-2">
                        <center>
                            <div class="card mt-5 mb-5" style="width: 35rem;">
                                <div style="text-align: center;" class="login-brand">
                                </div>
                                <div class="card-body">
                                    <p style="font-weight: bold; font-size: 35px;">Hallo,</p>
                                    <p style="font-size: 15px;">Kode verifikasi Email kamu <b>{{ $verificationCode }}</b></p>
                                    <p style="font-size:15px">Silakan gunakan kode ini untuk memverifikasi alamat email Anda. Jika Anda tidak merasa memverifikasi email, silahkan abaikan psesan ini.</p>
                                    <p style="font-size:15px; font-weight: bold;">Hati-hati penipuan, jangan pernah bagikan kode verifikasi ke siapa pun.</p>

                                    <p>Salam,<br>

                                        Admin Esar Management<br>
                                        Rumah Scopus Foundation (RSC) <br>
                                        Bangunsari, Jl. Bangunsari, Bangunsari, Bangun Kerto, Turi,<br>
                                        Sleman Regency, Special Region of Yogyakarta 55551 <br>
                                        Telp: 0812-2688-3280</p>

                                </div>
                            </div>
                        </center>
                    </div>
                </div>
            </div>
        </section>
    </div>
</body>

</html>