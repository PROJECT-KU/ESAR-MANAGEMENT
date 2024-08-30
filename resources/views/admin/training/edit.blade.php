@extends('admin.layouts.app')

@section('title')
Data Training | ESAR
@stop

<!--================== PREVIEW IMAGE ==================-->
<style>
    .custom-file-input-wrapper {
        border: 1px solid #ced4da;
        border-radius: 0.25rem;
        padding: 6px 12px;
        width: 100%;
        display: inline-block;
        background-color: #fff;
    }

    .custom-file-input-wrapper input[type="file"] {
        width: 100%;
        outline: none;
        cursor: pointer;
    }

    .photo-preview {
        width: 200px;
        height: 200px;
        border: 1px solid #ced4da;
        border-radius: 0.25rem;
        overflow: hidden;
        background-color: #f8f9fa;
        display: flex;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        /* Shadow effect */
    }

    .photo-preview img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        /* Enforces the image to fit within the fixed dimensions */
    }
</style>
<!--================== END ==================-->

@section('content')
<div class="content-wrapper">
    <div class="col-sm-12 card">
        <h3 class="ml-3" style="font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; margin-top:10px; margin-bottom:10px;">EDIT DATA TRAINING</h3>
    </div>
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
            </div>
        </div>
    </section>

    <section class="content">
        <form action="{{ route('auth.Trainings.update', ['id' => $trainingsData->id]) }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="card">
                <div class="row">
                    <!--================== GENERAL ==================-->
                    <div class="col-md-6">
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">General</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                                        <i class="fas fa-minus"></i></button>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="inputName">Nama Training</label>
                                    <input type="text" id="inputName" class="form-control" name="name" placeholder="Masukan Nama Training" value="{{ $trainingsData->name }}">
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label for="inputDescription">Tanggal Mulai</label>
                                            <input type="datetime-local" id="inputName" class="form-control" name="tanggal_mulai" value="{{ $trainingsData->tanggal_mulai }}">
                                        </div>
                                        <div class="col-md-6">
                                            <label for="inputDescription">Tanggal Akhir</label>
                                            <input type="datetime-local" id="inputName" class="form-control" name="tanggal_akhir" value="{{ $trainingsData->tanggal_akhir }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputName">Lokasi Training</label>
                                    <input type="text" id="inputName" class="form-control" name="lokasi" placeholder="Masukan Lokasi Training" value="{{ $trainingsData->lokasi }}">
                                </div>
                                <div class="form-group">
                                    <label for="inputStatus">Status</label>
                                    <select class="form-control custom-select" name="status">
                                        <option selected disabled>-- SILAHKAN PILIH STATUS --</option>
                                        <option value="draft" {{ $trainingsData->status === 'draft' ? 'selected' : '' }}>DRAFT</option>
                                        <option value="publish" {{ $trainingsData->status === 'publish' ? 'selected' : '' }}>PUBLISH</option>
                                        <option value="selesai" {{ $trainingsData->status === 'selesai' ? 'selected' : '' }}>SELESAI</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="inputClientCompany">Deskripsi Training</label>
                                    <textarea type="text" id="inputClientCompany" class="form-control" name="deskripsi" placeholder="Masukan Deskripsi Trianing">{{ $trainingsData->deskripsi }}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--================== END ==================-->

                    <div class="col-md-6">
                        <!--================== BIAYA ==================-->
                        <div class="card card-secondary">
                            <div class="card-header">
                                <h3 class="card-title">Budget</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                                        <i class="fas fa-minus"></i></button>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <label for="inputEstimatedBudget">Biaya Training</label>
                                            <input type="text" id="inputEstimatedBudget" class="form-control" name="biaya" placeholder="Masukan Biaya Training" onkeyup="formatRupiah(this)" value="Rp {{ number_format($trainingsData->biaya, 0, ',', '.') }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label for="inputEstimatedDuration">Kode Diskon</label>
                                            <input type="text" id="inputEstimatedDuration" class="form-control" name="name_diskon" placeholder="Masukan Kode Diskon" oninput="removeSpecialChars(this)" value="{{ $trainingsData->name_diskon }}">
                                        </div>
                                        <div class="col-md-6">
                                            <label for="inputEstimatedDuration">Potongan Diskon</label>
                                            <input type="text" id="inputEstimatedDuration" class="form-control" name="biaya_diskon" placeholder="Masukan Potongan Diskon" onkeyup="formatRupiah(this)" value="Rp {{ number_format((float) ($datas->biaya_diskon ?? 0), 0, ',', '.') }}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--================== END ==================-->

                        <!--================== FILE ==================-->
                        <div class="card card-info">
                            <div class="card-header">
                                <h3 class="card-title">Files</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="photoUpload">Upload Photo</label>
                                    <div class="custom-file-input-wrapper">
                                        <input type="file" id="photoUpload" class="form-control-file" name="foto" accept="image/*" onchange="handleFileUpload(this)">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div id="photoPreview" class="photo-preview">
                                        @if(isset($trainingsData->foto))
                                        <img src="{{ asset('assets/public/img/training/' . $trainingsData->foto) }}" alt="Current Photo" class="img-fluid" id="currentPhoto" style="max-width: 200px; max-height: 200px;">
                                        @else
                                        <img src="{{ asset('assets/public/img/profil/no-image.jpg') }}" alt="Current Photo" class="img-fluid" id="currentPhoto" style="max-width: 200px; max-height: 200px;">
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--================== END ==================-->
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="d-flex justify-content-between" style="padding: 10px;">
                            <input type="submit" value="Simpan" class="btn btn-info" style="width: 50%; margin-right: 1%;">
                            <a href="#" class="btn btn-warning" style="width: 50%;">Cancel</a>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </section>
</div>

<!--================== FORMAT RUPIAH ==================-->
<script>
    function formatRupiah(input) {
        let value = input.value.replace(/[^,\d]/g, '').toString();
        let split = value.split(',');
        let remainder = split[0].length % 3;
        let rupiah = split[0].substr(0, remainder);
        let thousands = split[0].substr(remainder).match(/\d{3}/gi);

        if (thousands) {
            let separator = remainder ? '.' : '';
            rupiah += separator + thousands.join('.');
        }

        rupiah = split[1] !== undefined ? rupiah + ',' + split[1] : rupiah;
        input.value = 'Rp ' + rupiah;
    }
</script>
<!--================== END ==================-->

<!--================== REMOVE SPESIAL KARAKTER ==================-->
<script>
    function removeSpecialChars(input) {
        input.value = input.value.replace(/[^a-zA-Z0-9]/g, '');
    }
</script>
<!--================== END ==================-->

<!--================== PREVIEW IMAGE ==================-->
<script>
    function previewPhoto(input) {
        const previewContainer = document.getElementById('photoPreview');
        previewContainer.innerHTML = ''; // Clear the previous preview

        if (input.files && input.files[0]) {
            const reader = new FileReader();

            reader.onload = function(e) {
                const img = document.createElement('img');
                img.src = e.target.result;
                img.alt = "Photo Preview";

                previewContainer.appendChild(img);
            };

            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
<!--================== END ==================-->

<!--================== MAXSIMUM & JENIS FILE YANG BOLEH ==================-->
<script>
    function handleFileUpload(input) {
        const file = input.files[0];
        const allowedTypes = ['image/png', 'image/jpeg', 'image/jpg'];
        const maxSize = 3 * 1024 * 1024;
        if (file) {
            if (!allowedTypes.includes(file.type)) {
                Swal.fire({
                    icon: 'error',
                    title: 'Jenis file tidak valid',
                    text: 'Hanya file PNG, JPG, dan JPEG yang diperbolehkan.',
                });
                input.value = '';
                return;
            }

            if (file.size > maxSize) {
                Swal.fire({
                    icon: 'error',
                    title: 'File Gambar Telalu Besar',
                    text: 'Ukuran file maksimum yang diperbolehkan adalah 3 MB.',
                });
                input.value = '';
                return;
            }

            previewPhoto(input);
        }
    }

    function previewPhoto(input) {
        const previewContainer = document.getElementById('photoPreview');
        previewContainer.innerHTML = '';

        if (input.files && input.files[0]) {
            const reader = new FileReader();

            reader.onload = function(e) {
                const img = document.createElement('img');
                img.src = e.target.result;
                img.alt = "Photo Preview";
                img.style.width = '100%';
                img.style.height = '100%';
                img.style.objectFit = 'cover';

                previewContainer.appendChild(img);
            };

            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
<!--================== END ==================-->

<!--================== SWEET ALERT UPDATE ==================-->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        @if(session('successupdate'))
        Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: 'Berhasil update data training',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true
        }).then(() => {
            location.reload();
        });
        @endif
    });
    document.addEventListener('DOMContentLoaded', function() {
        @if(session('errorupdate'))
        Swal.fire({
            icon: 'error',
            title: 'Gagal!',
            text: 'Gagal update data training',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true
        }).then(() => {
            location.reload();
        });
        @endif
    });
</script>
<!--================== END ==================-->
@stop