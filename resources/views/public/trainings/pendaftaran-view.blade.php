@extends('layouts.app')

@section('title')
Pendaftaran Training | ESAR
@stop

@section('content')
<main class="main mb-5">
    <section id="hero" class="hero section dark-background" style="background-color: #4682B4;">
        <div class="container" id="home">
            <div class="row gy-4">
                <div class="col-lg-8 order-2 order-lg-1 d-flex flex-column justify-content-center" data-aos="zoom-out">
                    <h1>The Best Solution for Your Manuscript Articles</h1>
                    <p>Immediately send your best articles to our journal</p>
                    <div class="d-flex">
                        <a href="#about" class="btn-get-started">Get Started</a>
                    </div>
                </div>
                <div class="col-lg-4 order-1 order-lg-2 hero-img" data-aos="zoom-out" data-aos-delay="200">
                    <img src="{{ asset('assets/public/img/logo-esar.png') }}" class="img-fluid animated" alt="">
                </div>
            </div>
        </div>
    </section>

    <section id="about" class="about section">
        <div class="container section-title" data-aos="fade-up">
            <h2>PENDAFTARAN TRAINING</h2>
        </div>
        <div class="container">
            <div class="row gy-4 justify-content-center">
                <!--================== CARD PROMO ==================-->
                <div class="col-lg-6">
                    <div class="card shadow-lg mb-4" style="width: 100%;">
                        <span class="alert alert-info" role="alert" style="text-align: center; font-size:20px; font-weight: bold;">Promo</span>
                        @if(session('error'))
                        <span class="alert alert-danger" style="margin-left: 20px; margin-right:10px;">
                            {{ session('error') }}
                        </span>
                        @endif

                        @if(session('successpromo'))
                        <span class="alert alert-success" style="margin-left: 20px; margin-right:10px;">
                            {{ session('successpromo') }}
                        </span>
                        @endif
                        <div class="container-fluid p-4">
                            <form id="promoForm" method="POST" action="{{ route('public.training.check.promo.code', ['id' => $trainingsData->id]) }}">
                                @csrf
                                <div class="row gy-4">
                                    <div class="col-md-6 form-group">
                                        <label for="kode_promo">Kode Promo</label>
                                        <input type="text" id="kode_promo" name="name_diskon" class="form-control mt-1" required>
                                    </div>
                                    <div class="col-md-6 form-group">
                                        <label for="potongan">Potongan</label>
                                        <input type="text" id="potongan" name="potongan" class="form-control mt-1" style="background-color:#D3D3D3;" value="{{ session('discount_value') ?? '0' }}" readonly>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-info mt-4" style="font-weight: bold; width: 100%;">Cek Kode Promo</button>
                            </form>
                        </div>
                    </div>
                </div>
                <!--================== END ==================-->

                <!--================== CARD METODE PEMBAYARAN ==================-->
                <div class="col-lg-6">
                    <div class="card shadow-lg mb-4" id="paymentMethodCard" style="width: 100%;">
                        <span class="alert alert-info" role="alert" style="display: block; text-align: center; font-size: 20px; font-weight: bold; width: 100%; margin: 0; border-radius: 0;">
                            Metode Pembayaran
                        </span>
                        <div class="container-fluid p-4">
                            <form id="paymentMethodForm" method="POST" action="{{ route('public.training.pendaftaran.store') }}" enctype="multipart/form-data">
                                @csrf
                                <div class="row gy-4">
                                    <div class="col-md-12 form-group">
                                        <label for="metode_pembayaran">Pilih Metode Pembayaran</label>
                                        <select class="form-control mt-1" id="metode_pembayaran" name="metode_pembayaran" required>
                                            <option value="" selected disabled>-- SILAHKAN PILIH METODE PEMBAYARAN --</option>
                                            <option value="Transfer Bank">Transfer Bank</option>
                                            <option value="Qris">Qris</option>
                                        </select>
                                    </div>
                                </div>
                                <input type="hidden" id="selected_metode_pembayaran" name="selected_metode_pembayaran">
                                <div id="paymentContent" class="mt-4">
                                    <!-- Content will be displayed here based on the selected option -->
                                </div>
                                <div id="countdown" class="mt-4 text-center" style="font-weight: bold; color: red;">
                                    <!-- Countdown will be displayed here -->
                                </div>

                        </div>
                    </div>
                </div>
                <!--================== END ==================-->
            </div>

            <!--================== CARD DATA DIRI ==================-->
            <div class="row gy-4 justify-content-center">
                <div class="col-lg-12">
                    <div class="card shadow-lg" style="width: 100%;">
                        <span class="alert alert-info" role="alert" style="text-align: center; font-size:20px; font-weight: bold;">Data Diri</span>
                        <div class="container-fluid p-4">
                            <div class="row gy-4 mt-1">
                                <div class="col-md-6 form-group">
                                    <label for="trainings_id">Nama Training</label>
                                    <input type="text" id="trainings_id" name="trainings_id" class="form-control mt-1" value="{{ $trainingsData->id }}" style="background-color:#D3D3D3;" hidden>
                                    <input type="text" id="namatraining" name="namatraining" class="form-control mt-1" value="{{ $trainingsData->name }}" style="background-color:#D3D3D3;" readonly>
                                </div>
                                <div class="col-md-6 form-group">
                                    <label for="trainings_id">Lokasi Training</label>
                                    <input type="text" id="lokasi" name="lokasi" class="form-control mt-1" value="{{ $trainingsData->lokasi }}" style="background-color:#D3D3D3;" readonly>
                                </div>
                            </div>

                            <div class="row gy-4 mt-1">
                                <div class="col-md-6 form-group">
                                    <label for="biaya">Biaya Training</label>
                                    <input type="text" id="biaya" name="biaya" class="form-control mt-1" value=" Rp. {{ number_format($trainingsData->biaya, 0, ',', '.') }}" style="background-color:#D3D3D3;" readonly>
                                </div>
                                <div class="col-md-6 form-group">
                                    <label for="kode_unik_biaya">Kode Unik</label>
                                    <input type="text" id="kode_unik_biaya" name="kode_unik_biaya" class="form-control mt-1" value="{{ $uniqueCode }}" style="background-color:#D3D3D3;" readonly>
                                </div>
                            </div>

                            <div class="row gy-4 mt-1">
                                <div class="col-md-6 form-group">
                                    <label for="nama_lengkap">Nama Lengkap</label>
                                    <input type="text" id="name" name="name" class="form-control mt-1" required>
                                </div>
                                <div class="col-md-6 form-group">
                                    <label for="email">Email</label>
                                    <input type="email" id="email" name="email" class="form-control mt-1" maxlength="30" minlength="5" onkeypress="return/[a-zA-Z0-9@.]/i.test(event.key)" required>
                                </div>
                            </div>
                            <div class="row gy-4 mt-1">
                                <div class="col-md-12 form-group">
                                    <label for="telp">Nomor Telepon</label>
                                    <input type="text" id="telp" name="telp" class="form-control mt-1" maxlength="15" minlength="8" onkeypress="return event.charCode >= 48 && event.charCode <=57" oninput="formatPhoneNumber(this)" required>
                                </div>
                            </div>

                            <div class="row gy-4 mt-1">
                                <div class="col-md-6 form-group">
                                    <label for="nama_lengkap">Sub Total</label>
                                    <input type="text" id="subtotal" name="subtotal" class="form-control mt-1" value="Rp. {{ number_format($subtotal, 0, ',', '.') }}" style="background-color:#D3D3D3;" readonly>
                                </div>
                                <div class="col-md-6 form-group">
                                    <label for="potongan">Potongan</label>
                                    <input type="text" id="biaya_diskon" name="biaya_diskon" class="form-control mt-1" style="background-color:#D3D3D3;" value="{{ session('discount_value') ?? '0' }}" readonly>
                                </div>
                            </div>

                            <div class="row gy-4 mt-1">
                                <div class="col-md-12 form-group">
                                    <label for="nama_lengkap">Total Biaya</label>
                                    <input type="text" id="total_biaya" name="total_biaya" class="form-control mt-1" value="Rp. {{ number_format($totalBiaya, 0, ',', '.') }}" style="background-color:#D3D3D3;" readonly>
                                </div>
                            </div>

                            <div class="row gy-4 mt-3">
                                <div class="col-md-12 form-group">
                                    <label for="image_upload">Upload Gambar</label>
                                    <input type="file" id="image_upload" name="foto" class="form-control mt-1" accept="image/*" onchange="previewImage(event)" required>
                                </div>
                            </div>

                            <div class="row gy-4 mt-3">
                                <div class="col-md-12 form-group">
                                    <label for="image_preview">Preview Gambar</label>
                                    <div id="image_preview" style="border: 1px solid #ccc; padding: 10px; background-color: #f8f8f8; max-width: 200px;">
                                        <img id="image_preview_img" src="" alt="Image Preview" style="max-width: 100%; display: none;">
                                    </div>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-info mt-4" style="font-weight: bold; width: 100%;">
                                Daftar Sekarang
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            </form>
            <!--================== END ==================-->
        </div>
    </section>
</main>

<!--================== PREVIEW IMAGE ==================-->
<script>
    function previewImage(event) {
        const reader = new FileReader();
        const imageField = document.getElementById('image_preview_img');

        reader.onload = function() {
            imageField.src = reader.result;
            imageField.style.display = 'block';
        }

        reader.readAsDataURL(event.target.files[0]);
    }
</script>
<!--================== END ==================-->

<!--================== HITUNG MUNDUR ==================-->
<script>
    document.getElementById('metode_pembayaran').addEventListener('change', function() {
        var selectedValue = this.value;
        console.log('Selected Payment Method:', selectedValue); // Log selected value for debugging
        var contentDiv = document.getElementById('paymentContent');
        var countdownDiv = document.getElementById('countdown');
        var hiddenInput = document.getElementById('selected_metode_pembayaran');

        // Simpan nilai yang dipilih di input tersembunyi
        hiddenInput.value = selectedValue;

        // Clear previous content and countdown
        contentDiv.innerHTML = '';
        countdownDiv.textContent = '';

        // Display content based on selected value
        if (selectedValue === 'Transfer Bank') {
            contentDiv.innerHTML = '<p>Silakan lakukan transfer ke rekening berikut...</p>'; // Add specific content for Transfer Bank
        } else if (selectedValue === 'Qris') {
            contentDiv.innerHTML = '<p>Scan QR code berikut untuk melakukan pembayaran...</p>'; // Add specific content for Qris
        }

        // Disable the dropdown
        this.disabled = true;

        // Start countdown
        startCountdown(countdownDiv);
    });

    function startCountdown(countdownElement) {
        let timer = 5 * 60; // 5 minutes in seconds

        const interval = setInterval(() => {
            const minutes = Math.floor(timer / 60);
            const seconds = timer % 60;
            countdownElement.textContent = `Waktu tersisa: ${minutes}:${seconds < 10 ? '0' : ''}${seconds}`;

            if (timer > 0) {
                timer--;
            } else {
                clearInterval(interval);
                countdownElement.textContent = 'Waktu habis. Halaman akan di-reload.';
                setTimeout(() => {
                    location.reload(); // Reload the page after countdown ends
                }, 1000);
            }
        }, 1000);
    }
</script>
<!--================== END ==================-->

<!--================== MENAMPILKAN MODAL METODE PEMBAYARAN ==================-->
<script>
    document.getElementById('metode_pembayaran').addEventListener('change', function() {
        var selectedValue = this.value;
        var contentDiv = document.getElementById('paymentContent');

        // Clear previous content
        contentDiv.innerHTML = '';

        // Show content based on selected value
        if (selectedValue === 'Transfer Bank') {
            contentDiv.innerHTML = '<p>Silakan lakukan transfer ke rekening berikut...</p>'; // Add specific content for Transfer Bank
        } else if (selectedValue === 'Qris') {
            contentDiv.innerHTML = '<p>Scan QR code berikut untuk melakukan pembayaran...</p>'; // Add specific content for Qris
        }

        // Disable the dropdown
        this.disabled = true;
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

<!--================== FORMAT RUPIAH PROMO ==================-->
<script>
    function formatRupiah(angka) {
        var number_string = angka.replace(/[^,\d]/g, '').toString(),
            split = number_string.split(','),
            sisa = split[0].length % 3,
            rupiah = split[0].substr(0, sisa),
            ribuan = split[0].substr(sisa).match(/\d{3}/gi);

        // Add thousand separators
        if (ribuan) {
            separator = sisa ? '.' : '';
            rupiah += separator + ribuan.join('.');
        }

        // Add decimal part
        rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;

        return 'Rp. ' + rupiah;
    }

    document.addEventListener('DOMContentLoaded', function() {
        var potonganField = document.getElementById('biaya_diskon');
        var discountValue = potonganField.value.replace('Rp. ', '');
        potonganField.value = formatRupiah(discountValue);
    });
</script>
<!--================== END ==================-->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@stop