@extends('admin.layouts.app')

@section('title')
Edit Pengguna | ESAR
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
        <h3 class="ml-3" style="font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; margin-top:10px; margin-bottom:10px;">DATA DIRI PENGGUNA</h3>
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

                            <form action="{{ route('auth.update.edit.FotoProfil', ['id' => $userData->id]) }}" method="POST" enctype="multipart/form-data">
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
                                @if (Auth::user()->role === 'administrator')
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
                                @if (Auth::user()->role === 'administrator')
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
                                @if (Auth::user()->role === 'administrator')
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
                            <form action="{{ route('auth.update.edit', ['id' => $userData->id]) }}" method="POST">
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
                            <form action="{{ route('auth.update.edit', ['id' => $userData->id]) }}" method="POST">
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
                            <form action="{{ route('auth.update.edit', ['id' => $userData->id]) }}" method="POST">
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
                                        Email pengguna ini <b>Belum Terverifikasi</b>, Silahkan di minta untuk verifikasi sekarang!
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
                                        <form action="{{ route('auth.update.edit', ['id' => $userData->id]) }}" method="POST">
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

                                    <form action="{{ route('auth.update.edit', ['id' => $userData->id]) }}" method="POST">
                                        @csrf
                                        <div class="post">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label for="role">Role</label>
                                                    <select id="role" name="role" class="form-control form-control-sm text-uppercase">
                                                        <option value="" {{ is_null($userData->role) ? 'selected' : '' }} disabled>-- SILAHKAN PILIH ROLE --</option>
                                                        <option value="administrator" {{ $userData->role === 'administrator' ? 'selected' : '' }}>Administrator</option>
                                                        <option value="member" {{ $userData->role === 'member' ? 'selected' : '' }}>Member</option>
                                                        <option value="karyawan" {{ $userData->role === 'karyawan' ? 'selected' : '' }}>Karyawan</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="status">Status</label>
                                                    <select id="status" name="status" class="form-control form-control-sm text-uppercase">
                                                        <option value="" {{ is_null($userData->status) ? 'selected' : '' }} disabled>-- SILAHKAN PILIH STATUS --</option>
                                                        <option value="active" {{ $userData->status === 'active' ? 'selected' : '' }}>Active</option>
                                                        <option value="off" {{ $userData->status === 'off' ? 'selected' : '' }}>Off</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12 mt-4">
                                                    <label>Alamat</label>
                                                    <textarea class="form-control form-control-sm" type="text" placeholder="alamat" readonly>{{ $userData->alamat }}</textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-info mt-4" style="width: 100%;">SIMPAN</button>
                                    </form>
                                </div>
                                <!--================== END TAB DATA DIRI ==================-->

                                <!--================== TAB RESET PASSWORD ==================-->
                                <div class="tab-pane" id="settings">
                                    <form class="form-horizontal" id="register-form" action="{{ route('auth.update.edit.ResetPassword', ['id' => $userData->id]) }}" method="POST">
                                        @csrf
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

<!--================== SHOW & HIDE PASSWORD ==================-->
<script>
    // Function to toggle password visibility
    function togglePasswordVisibility(inputId, toggleId) {
        const passwordInput = document.getElementById(inputId);
        const passwordToggle = document.getElementById(toggleId);

        passwordToggle.addEventListener('click', function() {
            const type = passwordInput.type === 'password' ? 'text' : 'password';
            passwordInput.type = type;
            this.classList.toggle('fa-eye');
            this.classList.toggle('fa-eye-slash');
        });
    }

    // Apply the function to each password field
    togglePasswordVisibility('password', 'password-toggle');
    togglePasswordVisibility('password_confirmation', 'password-confirmation-toggle');
</script>
<!--================== END ==================-->

<!--================== RESET PASSWORD ==================-->
<script>
    document.getElementById('register-form').addEventListener('submit', function(e) {
        e.preventDefault(); // Prevent normal form submission

        const formData = new FormData(this);

        fetch(this.action, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.statussuksesreset === 'success') {
                    Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        text: data.message,
                        timer: 3000,
                        timerProgressBar: true,
                        showConfirmButton: false,
                    }).then(() => {
                        location.reload(); // Automatically refresh the page after the alert
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: data.message,
                        confirmButtonText: 'OK'
                    });
                }
            })
            .catch(error => console.error('Error:', error));
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