@extends('admin.layouts.app')

@section('title')
Profil | ESAR
@stop

<!--================== ICON VERIFIKASI EMAIL ==================-->
<style>
    .input-container {
        position: relative;
    }

    .input-container input {
        padding-right: 2.5rem;
        /* Adjust space for the icon */
    }

    .input-container .icon-container {
        position: absolute;
        right: 0.5rem;
        top: 75%;
        transform: translateY(-50%);
        display: flex;
        align-items: center;
        justify-content: center;
        width: 20px;
        /* Size of the badge */
        height: 20px;
        /* Size of the badge */
        background-color: lightblue;
        /* Badge color */
        border-radius: 50%;
        /* Circular badge */
        box-shadow: 0 0 0 0.2rem rgba(0, 0, 0, 0.2);
        /* Optional shadow */
    }

    .icon-container .icon {
        font-size: 1rem;
        /* Icon size */
        color: blue;
        /* Color for the checkmark icon */
    }
</style>
<!--================== END ==================-->

<!--================== RESET PASSWORD ==================-->
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

    /* Danger color */
    .border-danger {
        border-color: #dc3545 !important;
        box-shadow: 0 0 0 0.2rem rgba(220, 53, 69, .25) !important;
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
<!--================== END ==================-->


@section('content')
<div class="content-wrapper">
    <div class="col-sm-12 card">
        <h3 class="ml-3" style="font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; margin-top:10px; margin-bottom:10px;">PROFIL</h3>
    </div>
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-3">

                    <!--================== FOTO PROFIL ==================-->
                    <div class="card card-primary card-outline">
                        <div class="card-body box-profile">
                            <div class="text-center">
                                @if ($userData->foto == null)
                                <img alt="User profile picture" id="image-preview" src="{{ asset('assets/public/img/profil/no-image.jpg') }}" class="profile-user-img img-fluid img-circle" style="width: 128px; height: 128px; border-radius: 50%;">
                                @else
                                <img id="image-preview" class="profile-user-img img-fluid img-circle" src="{{ asset('assets/public/img/profil/' . $userData->foto) }}" alt="User profile picture" style="width: 128px; height: 128px; border-radius: 50%;">
                                @endif
                            </div>

                            <h3 class="profile-username text-center">{{ $userData->name }}</h3>
                            <p class="text-muted text-center">{{ $userData->role }}</p>

                            <form action="{{ route('auth.update.fotoprofil') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label for="foto">Update Foto</label>
                                    <input type="file" name="foto" class="form-control-file" id="foto" onchange="toggleSubmitButton()">
                                </div>
                                <button type="submit" id="updateButton" class="btn btn-primary btn-block" disabled><b>Update Foto</b></button>
                            </form>
                        </div>
                    </div>
                    <!--================== END ==================-->

                    <!--================== DATA PROFIL ==================-->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Tentang Saya</h3>
                        </div>
                        <div class="card-body">
                            <!-- Email Section -->
                            <strong><i class="fas fa-envelope-open mr-1"></i> Email</strong>
                            <p class="text-muted">
                                {{ $userData->email }}
                                @if (Auth::user()->role === 'Administrator')
                                <button class="btn btn-sm btn-warning float-right" data-toggle="modal" data-target="#editEmailModal">
                                    <i class="fas fa-pencil-alt"></i>
                                </button>
                                @endif
                            </p>
                            <hr>

                            <!-- Alamat Section -->
                            <strong><i class="fas fa-map-marker-alt mr-1"></i> Alamat</strong>
                            <p class="text-muted">
                                {{ Str::words($userData->alamat, 5, '...') }}
                                @if ($userData->email_verified_at == null)
                                <button class="btn btn-sm btn-warning float-right" data-toggle="modal" data-target="#editAlamatModal" disabled>
                                    <i class="fas fa-pencil-alt"></i>
                                </button>
                                @else
                                <button class="btn btn-sm btn-warning float-right" data-toggle="modal" data-target="#editAlamatModal">
                                    <i class="fas fa-pencil-alt"></i>
                                </button>
                                @endif
                            </p>
                            <hr>

                            <!-- No Telp Section -->
                            <strong><i class="fas fa-phone mr-1"></i> No Telp</strong>
                            <p class="text-muted">
                                {{ $userData->telp }}
                                @if ($userData->email_verified_at == null)
                                <button class="btn btn-sm btn-warning float-right" data-toggle="modal" data-target="#editTelpModal" disabled>
                                    <i class="fas fa-pencil-alt"></i>
                                </button>
                                @else
                                <button class="btn btn-sm btn-warning float-right" data-toggle="modal" data-target="#editTelpModal">
                                    <i class="fas fa-pencil-alt"></i>
                                </button>
                                @endif
                            </p>
                            <hr>

                            <!-- Lama Kerja Section -->
                            <strong><i class="far fa-file-alt mr-1"></i> Lama Kerja</strong>
                            <p class="text-muted">
                                @if ($years === null || $years === 'off')
                                Tidak Aktif
                                @else
                                {{ $years }} tahun {{ $months }} bulan {{ $days }} hari
                                @endif
                            </p>
                        </div>
                    </div>
                    <!--================== END ==================-->
                </div>

                <!--================== MODAL DATA PROFIL ==================-->
                <!-- Modal for updating email -->
                <div class="modal fade" id="editEmailModal" tabindex="-1" role="dialog" aria-labelledby="editEmailModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="editEmailModalLabel">Update Email</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form action="{{ route('auth.update.dataprofil') }}" method="POST">
                                @csrf
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input type="email" class="form-control" id="email" name="email" value="{{ $userData->email }}" maxlength="30" minlength="5" onkeypress="return/[a-zA-Z0-9@.]/i.test(event.key)" required>
                                    </div>
                                </div>
                                <div class="modal-footer d-flex justify-content-between">
                                    <button type="button" class="btn btn-danger flex-fill" data-dismiss="modal">CANCEL</button>
                                    <button type="submit" class="btn btn-info flex-fill">SIMPAN</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Modal for updating alamat -->
                <div class="modal fade" id="editAlamatModal" tabindex="-1" role="dialog" aria-labelledby="editAlamatModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="editAlamatModalLabel">Update Alamat</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form action="{{ route('auth.update.dataprofil') }}" method="POST">
                                @csrf
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label for="alamat">Alamat</label>
                                        <input type="text" class="form-control" id="alamat" name="alamat" value="{{ $userData->alamat }}" required>
                                    </div>
                                </div>
                                <div class="modal-footer d-flex justify-content-between">
                                    <button type="button" class="btn btn-danger flex-fill" data-dismiss="modal">CANCEL</button>
                                    <button type="submit" class="btn btn-info flex-fill">SIMPAN</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Modal for updating telp -->
                <div class="modal fade" id="editTelpModal" tabindex="-1" role="dialog" aria-labelledby="editTelpModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="editTelpModalLabel">Update No Telp</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form action="{{ route('auth.update.dataprofil') }}" method="POST">
                                @csrf
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label for="telp">No Telp</label>
                                        <input type="text" class="form-control" id="telp" name="telp" value="{{ $userData->telp }}" maxlength="15" minlength="8" onkeypress="return event.charCode >= 48 && event.charCode <=57" oninput="formatPhoneNumber(this)" required>
                                    </div>
                                </div>
                                <div class="modal-footer d-flex justify-content-between">
                                    <button type="button" class="btn btn-danger flex-fill" data-dismiss="modal">CANCEL</button>
                                    <button type="submit" class="btn btn-info flex-fill">SIMPAN</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!--================== END ==================-->

                <div class="col-md-9">
                    <div class="card">
                        <div class="card-header p-2">
                            <ul class="nav nav-pills">
                                <li class="nav-item"><a class="nav-link active" href="#activity" data-toggle="tab">Data Profil</a></li>
                                <li class="nav-item"><a class="nav-link" href="#settings" data-toggle="tab">Reset Password</a></li>
                            </ul>
                        </div>
                        <div class="card-body">
                            <div class="tab-content">

                                <!--================== TAB DATA DIRI ==================-->
                                <div class="active tab-pane" id="activity">
                                    <!-- NOTIF EMAIL BELUM DI VERIFIKASI -->
                                    @if ($userData->email_verified_at == null)
                                    <div class="alert alert-warning" role="alert">
                                        Email anda <b>Belum Terverifikasi</b>, Silahkan verifikasi sekarang untuk melengkapi data diri.
                                    </div>
                                    @endif
                                    <!-- END -->
                                    <div class="post">
                                        <div class="user-block d-flex justify-content-between align-items-center">
                                            <div class="d-flex align-items-center">
                                                @if ($userData->foto == null)
                                                <img class="img-circle img-bordered-sm" src="{{ asset('assets/public/img/profil/no-image.jpg') }}" alt="user image">
                                                @else
                                                <img class="img-circle img-bordered-sm" src="{{ asset('assets/public/img/profil/' . $userData->foto) }}" alt="user image">
                                                @endif
                                                <span class="username ml-2">
                                                    <a href="#">{{ $userData->name }}</a>
                                                </span>
                                            </div>
                                            @php
                                            $lastActiveStatus = $userData->lastActive();
                                            @endphp

                                            @if($lastActiveStatus === 'Tidak Pernah Terlihat')
                                            <div class="alert alert-danger" role="alert" style="display: inline-block; font-size: 15px; padding: 2px 8px; margin-top: 5px; margin-bottom: 5px; width: auto;">
                                                {{ $lastActiveStatus }}
                                            </div>
                                            @elseif($lastActiveStatus === 'Pengguna Sedang Online')
                                            <div class="alert alert-success" role="alert" style="display: inline-block; font-size: 15px; padding: 2px 8px; margin-top: 5px; margin-bottom: 5px; width: auto;">
                                                {{ $lastActiveStatus }}
                                            </div>
                                            @else
                                            <div class="alert alert-warning" role="alert" style="display: inline-block; font-size: 15px; padding: 2px 8px; margin-top: 5px; margin-bottom: 5px; width: auto;">
                                                Terakhir Online: {{ $lastActiveStatus }}
                                            </div>
                                            @endif
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>Nama</label>
                                                <input class="form-control form-control-sm" type="text" value="{{ $userData->name }}" placeholder="Nama" readonly>
                                            </div>
                                            <div class="col-md-6">
                                                <label>Username</label>
                                                <input class="form-control form-control-sm" type="text" placeholder="Username" value="{{ $userData->username }}" readonly>
                                            </div>
                                        </div>

                                        <!-- BUTTON VERIFIKASI EMAIL -->
                                        <form id="verify-email-form" action="{{ route('verify.email') }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="code_verified_mail" value="{{ $userData->code_verified_mail }}">
                                            <div class="row mt-4">
                                                @if($userData->email_verified_at)
                                                <div class="col-md-6 d-flex align-items-center">
                                                    <div class="w-100 input-container">
                                                        <label>Email</label>
                                                        <input class="form-control form-control-sm" type="text" value="{{ $userData->email }}" placeholder="Email" readonly>
                                                        <div class="icon-container">
                                                            <i class="fas fa-check icon"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                                @else
                                                <div class="col-md-4 d-flex align-items-center">
                                                    <div class="w-100 input-container">
                                                        <label>Email</label>
                                                        <input class="form-control form-control-sm" type="text" value="{{ $userData->email }}" placeholder="Email" readonly>
                                                    </div>
                                                </div>
                                                <div class="col-md-2 d-flex align-items-center mt-4">
                                                    <button type="submit" class="btn btn-info w-100" style="height:fit-content">Verifikasi</button>
                                                </div>
                                                @endif
                                                <div class="col-md-6 d-flex align-items-center">
                                                    <div class="w-100">
                                                        <label>No Telp</label>
                                                        <input class="form-control form-control-sm" type="text" placeholder="No Telp" value="{{ $userData->telp }}" readonly>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                        <!-- END -->
                                    </div>

                                    <!--================== MODAL VERIFIKASI EMAIL ==================-->
                                    <div class="modal fade" id="verificationModal" tabindex="-1" aria-labelledby="verificationModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="verificationModalLabel" style="text-align: center;">Verifikasi Email</h5>
                                                </div>
                                                <div class="modal-body">
                                                    <form id="verification-form" action="{{ route('verify.code') }}" method="POST">
                                                        @csrf
                                                        <div class="mb-3">
                                                            <label for="verification-code" class="form-label">Masukan Kode Verifikasi Email</label>
                                                            <input type="text" class="form-control" id="verification-code" name="verification_code" required>
                                                        </div>
                                                        <button type="submit" class="btn btn-primary" style="width: 100%;">Verifikasi Sekarang!</button>
                                                        <div id="countdown" class="mt-3"></div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--================== END ==================-->

                                    <div class="post">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>Role</label>
                                                <input class="form-control form-control-sm" type="text" placeholder="Role" value="{{ strtoupper($userData->role) }}" readonly>
                                            </div>
                                            <div class="col-md-6">
                                                <label>Status</label>
                                                <input class="form-control form-control-sm {{ $userData->status === 'active' ? 'bg-success text-white' : 'bg-danger text-white' }} text-uppercase" type="text" placeholder="Username" value="{{ strtoupper($userData->status) }}" readonly>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12 mt-4">
                                                <label>Alamat</label>
                                                <textarea class="form-control form-control-sm" type="text" placeholder="alamat" readonly>{{ $userData->alamat }}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--================== END TAB DATA DIRI ==================-->

                                <!--================== TAB RESET PASSWORD ==================-->
                                <div class="tab-pane" id="settings">
                                    <form class="form-horizontal" id="register-form" action="{{ route('reset.password') }}" method="POST">
                                        @csrf
                                        <div class="row">
                                            <div class="col-md-12 mt-4">
                                                <label>Masukan Password Lama</label>
                                                <div class="password-group">
                                                    <input type="password" class="form-control" id="old-password" name="old_password" placeholder="Masukan Password Lama"
                                                        pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}"
                                                        title="Harus berisi setidaknya satu angka dan satu huruf besar dan kecil, dan setidaknya 8 karakter atau lebih"
                                                        required>
                                                    <i class="fas fa-eye password-toggle" id="old-password-toggle"></i>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6 mt-4">
                                                <label>Masukan Password Baru</label>
                                                <div class="password-group">
                                                    <input type="password" class="form-control" name="password" id="password"
                                                        placeholder="Masukan Password Baru"
                                                        pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}"
                                                        title="Harus berisi setidaknya satu angka dan satu huruf besar dan kecil, dan setidaknya 8 karakter atau lebih"
                                                        required>
                                                    <i class="fas fa-eye password-toggle" id="password-toggle"></i>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mt-4">
                                                <label>Ulangi Password Baru</label>
                                                <div class="password-group">
                                                    <input type="password" class="form-control" name="password_confirmation"
                                                        id="password_confirmation" placeholder="Ulangi Password Baru"
                                                        pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}"
                                                        title="Harus berisi setidaknya satu angka dan satu huruf besar dan kecil, dan setidaknya 8 karakter atau lebih"
                                                        required>
                                                    <i class="fas fa-eye password-toggle" id="password-confirmation-toggle"></i>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-md-12 mt-4">
                                                <button type="submit" class="btn btn-info" style="width: 100%;">Simpan</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <!--================== END TAB RESET PASSWORD ==================-->

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<!--================== FOTO PROFIL ==================-->
<script>
    function toggleSubmitButton() {
        var fileInput = document.getElementById('foto');
        var submitButton = document.getElementById('updateButton');
        submitButton.disabled = !fileInput.files.length; // Disable button if no file selected
    }

    document.addEventListener('DOMContentLoaded', function() {
        @if(session('success'))
        Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: '{{ session("success") }}',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true
        }).then(() => {
            location.reload(); // Automatically refresh the page after the alert
        });
        @endif
    });
</script>
<!--================== END ==================-->

<!--================== DATA PROFIL ==================-->
<script>
    // Function to show SweetAlert messages
    document.addEventListener('DOMContentLoaded', function() {
        @if(session('statusauthorized'))
        Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: 'You are not authorized to update the email',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true
        }).then(() => {
            location.reload(); // Automatically refresh the page after the alert
        });
        @endif

        @if(session('statusdataprofil'))
        Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: 'Data profil berhasil diperbarui',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true
        }).then(() => {
            location.reload(); // Automatically refresh the page after the alert
        });
        @endif
    });
</script>
<!--================== END ==================-->

<!--================== FORMAT NO TELP ==================-->
<script>
    function formatPhoneNumber(input) {
        // Menghapus semua karakter non-digit
        var phoneNumber = input.value.replace(/\D/g, '');

        // Menentukan panjang nomor telepon
        var phoneNumberLength = phoneNumber.length;

        // Memeriksa panjang nomor telepon dan menerapkan format yang sesuai
        if (phoneNumberLength === 11) {
            phoneNumber = phoneNumber.replace(/(\d{3})(\d{4})(\d{4})/, '$1-$2-$3');
        } else if (phoneNumberLength === 12) {
            phoneNumber = phoneNumber.replace(/(\d{4})(\d{4})(\d{4})/, '$1-$2-$3');
        } else if (phoneNumberLength === 13) {
            phoneNumber = phoneNumber.replace(/(\d{5})(\d{4})(\d{4})/, '$1-$2-$3');
        }

        // Mengatur nilai input dengan nomor telepon yang diformat
        input.value = phoneNumber;
    }
</script>
<!--================== END ==================-->

<!--================== VERIFIKASI EMAIL ==================-->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const submitButton = document.querySelector('#verify-email-form .btn-info');
        const parentDiv = submitButton.parentElement;
        const codeVerifiedMail = document.querySelector('input[name="code_verified_mail"]').value;

        // Automatically clear localStorage if countdown expired or it's a new day
        clearLocalStorageIfExpired();

        // Check if there's an existing countdown and continue it
        const countdownRemaining = parseInt(localStorage.getItem('countdownRemaining')) || 0;
        if (countdownRemaining > 0) {
            startCountdown(submitButton, parentDiv, countdownRemaining);
        }

        document.getElementById('verify-email-form').addEventListener('submit', function(e) {
            e.preventDefault();

            // Check if countdown is active
            const countdownRemaining = parseInt(localStorage.getItem('countdownRemaining')) || 0;
            if (countdownRemaining > 0) {
                return; // Exit if countdown is still ongoing
            }

            // Start countdown immediately when button is clicked
            const countdown = 120; // Set your countdown duration
            localStorage.setItem('countdownRemaining', countdown);
            localStorage.setItem('countdownStartDate', new Date().toISOString()); // Store the start date

            startCountdown(submitButton, parentDiv, countdown);

            // Send verification code request
            fetch(this.action, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify({
                        _token: document.querySelector('input[name="_token"]').value
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.statusterkirim === 'success') {
                        Swal.fire({
                            title: 'Kode Verifikasi Email Terkirim',
                            text: 'Kode verifikasi telah dikirimkan ke email Anda. Silakan periksa email Anda dan masukan kode ke dalam inputan.',
                            icon: 'success',
                            confirmButtonText: 'OK'
                        }).then(() => {
                            const modal = new bootstrap.Modal(document.getElementById('verificationModal'));
                            modal.show();
                        });
                    } else {
                        Swal.fire({
                            title: 'Error',
                            text: 'Ada masalah saat mengirim kode verifikasi email.',
                            icon: 'error',
                            confirmButtonText: 'OK'
                        });
                    }
                })
                .catch(error => {
                    Swal.fire({
                        title: 'Error',
                        text: 'Terjadi kesalahan yang tidak terduga.',
                        icon: 'error',
                        confirmButtonText: 'OK'
                    });
                });
        });

        function startCountdown(button, parentDiv, countdown) {
            const countdownSpan = document.createElement('span');
            countdownSpan.className = 'btn btn-warning w-100';
            countdownSpan.style.height = 'fit-content';
            countdownSpan.textContent = `Wait ${countdown} seconds`;

            parentDiv.replaceChild(countdownSpan, button);

            const countdownInterval = setInterval(() => {
                countdown--;
                countdownSpan.textContent = `Wait ${countdown} seconds`;
                localStorage.setItem('countdownRemaining', countdown);

                if (countdown <= 0) {
                    clearInterval(countdownInterval);
                    countdownSpan.replaceWith(button);
                    button.textContent = 'Verifikasi';
                    button.disabled = false;
                    localStorage.removeItem('countdownRemaining');
                    localStorage.removeItem('countdownStartDate'); // Clear the start date
                }
            }, 1000);
        }

        function clearLocalStorageIfExpired() {
            const countdownRemaining = parseInt(localStorage.getItem('countdownRemaining')) || 0;
            const countdownStartDate = localStorage.getItem('countdownStartDate');

            if (countdownRemaining <= 0 || !countdownStartDate) {
                localStorage.removeItem('countdownRemaining');
                localStorage.removeItem('countdownStartDate');
                return;
            }

            const now = new Date();
            const startDate = new Date(countdownStartDate);

            // If the day has changed since the countdown started, clear the local storage
            if (now.toDateString() !== startDate.toDateString()) {
                localStorage.removeItem('countdownRemaining');
                localStorage.removeItem('countdownStartDate');
            }
        }
    });
</script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const verificationForm = document.getElementById('verification-form');

        verificationForm.addEventListener('submit', function(e) {
            e.preventDefault(); // Prevent the default form submission

            // Get the verification code from the input field
            const verificationCode = document.querySelector('input[name="verification_code"]').value;

            // Send the verification code to the server via AJAX
            fetch(this.action, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify({
                        verification_code: verificationCode,
                        _token: document.querySelector('input[name="_token"]').value
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.statusvalid === 'success') {
                        Swal.fire({
                            title: 'Success!',
                            text: data.message,
                            icon: 'success',
                            timer: 3000,
                            timerProgressBar: true,
                            showConfirmButton: false
                        }).then(() => {
                            // Optional: Close the modal and refresh the page or redirect
                            const verificationModal = new bootstrap.Modal(document.getElementById('verificationModal'));
                            verificationModal.hide();
                            window.location.reload(); // Refresh the page
                        });
                    } else if (data.statuskadaluarsa === 'error') {
                        Swal.fire({
                            title: 'Code Expired!',
                            text: data.message,
                            icon: 'warning',
                            timer: 3000,
                            timerProgressBar: true,
                            showConfirmButton: false
                        });
                    } else if (data.statustidakvalid === 'error') {
                        Swal.fire({
                            title: 'Invalid Code!',
                            text: data.message,
                            icon: 'error',
                            timer: 3000,
                            timerProgressBar: true,
                            showConfirmButton: false
                        });
                    }
                })
                .catch(error => {
                    Swal.fire({
                        title: 'Error!',
                        text: 'An unexpected error occurred.',
                        icon: 'error',
                        timer: 3000,
                        timerProgressBar: true,
                        showConfirmButton: false
                    });
                });
        });
    });
</script>
<!--================== END ==================-->

<!--================== SHOW & HIDE PASSWORD ==================-->
<script>
    // Validasi konfirmasi password saat submit
    document.getElementById('register-form').addEventListener('submit', function(event) {
        const password = document.getElementById('password').value;
        const passwordConfirmation = document.getElementById('password_confirmation').value;

        if (password !== passwordConfirmation) {
            event.preventDefault(); // Cegah pengiriman form
            Swal.fire({
                icon: 'error',
                title: 'Passwords Tidak Sesuai',
                text: 'Harap pastikan password dan konfirmasi password cocok.',
                confirmButtonText: 'OK'
            });
        }
    });

    // Fungsi untuk menampilkan atau menyembunyikan password dan mengubah border warna
    function togglePasswordVisibility(inputId, toggleId) {
        const passwordInput = document.getElementById(inputId);
        const passwordToggle = document.getElementById(toggleId);

        passwordToggle.addEventListener('click', function() {
            const type = passwordInput.type === 'password' ? 'text' : 'password';
            passwordInput.type = type;

            // Toggle the icon
            this.classList.toggle('fa-eye');
            this.classList.toggle('fa-eye-slash');

            // Toggle the border color
            passwordInput.classList.toggle('border-danger');
        });
    }

    // Panggil fungsi togglePasswordVisibility untuk setiap input password
    togglePasswordVisibility('old-password', 'old-password-toggle');
    togglePasswordVisibility('password', 'password-toggle');
    togglePasswordVisibility('password_confirmation', 'password-confirmation-toggle');
</script>
<!--================== END ==================-->

<!--================== RESET PASSWORD ==================-->
<script>
    document.getElementById('register-form').addEventListener('submit', function(e) {
        e.preventDefault(); // Mencegah form submit secara normal

        const formData = new FormData(this);

        fetch('/reset-password', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.statuserrorreset === 'error') {
                    // Tampilkan SweetAlert jika password lama tidak sesuai
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: data.message,
                        confirmButtonText: 'OK'
                    });
                } else if (data.statussuksesreset === 'success') {
                    // Tampilkan SweetAlert jika password berhasil diubah dengan pengaturan timer dan progress bar
                    Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        text: data.message,
                        timer: 3000,
                        timerProgressBar: true,
                        showConfirmButton: false,
                        willClose: () => {
                            window.location.href = "{{ route('auth.view.profil') }}";
                        }
                    });
                }
            })
            .catch(error => {
                console.error('Error:', error);
            });
    });
</script>

<!-- JIKA KONFIRMASI PASSWORD TIDAK SAMA -->
<script>
    document.getElementById('register-form').addEventListener('submit', function(event) {
        const password = document.getElementById('password').value;
        const passwordConfirmation = document.getElementById('password_confirmation').value;

        if (password !== passwordConfirmation) {
            event.preventDefault(); // Cegah pengiriman form
            Swal.fire({
                icon: 'error',
                title: 'Passwords Tidak Sesuai',
                text: 'Harap pastikan password dan konfirmasi password cocok.',
                confirmButtonText: 'OK'
            });
        }
    });
</script>
<!-- END -->
<!--================== END ==================-->
@stop