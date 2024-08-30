@extends('admin.layouts.app')

@section('title')
Data Training | ESAR
@stop

<!--================== FILTER ==================-->
<style>
    .card-body.border-bottom {
        border-bottom: 1px solid #dee2e6;
        /* Light gray border */
    }

    .form-select {
        border-radius: 50px;
        /* Oval shape */
        background-color: #007bff;
        /* Blue color */
        color: white;
        padding: 2px;
        /* Text color inside the select */
    }

    .form-select option {
        background-color: #007bff;
        /* Blue color for options */
        color: white;
        /* Text color inside options */
    }

    .form-select:focus {
        box-shadow: none;
        /* Remove default focus shadow */
        border-color: #0056b3;
        /* Darker blue color on focus */
    }
</style>
<!--================== END ==================-->

@section('content')
<div class="content-wrapper">
    <div class="col-sm-12 card">
        <h3 class="ml-3" style="font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; margin-top:10px; margin-bottom:10px;">DATA TRAINING</h3>
    </div>

    <!--================== FILTER SEARCH ==================-->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title" style="font-family:'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif; color:#808080"><i class="fas fa-filter"></i> Filter</h4>
                        </div>
                        <div class="card-body">
                            <form method="GET" action="{{ route('auth.view.trainings') }}" id="searchForm">
                                <div class="input-group">
                                    <input
                                        type="text"
                                        name="search"
                                        class="form-control rounded-pill"
                                        placeholder="Cari data..."
                                        value="{{ request('search') }}"
                                        onkeyup="toggleSearchButton(this.value)">
                                    <div class="input-group-append">
                                        <button
                                            type="submit"
                                            class="btn rounded-pill"
                                            id="searchButton"
                                            onclick="handleSearchButtonClick(event)">
                                            <i class="fas fa-search" id="searchIcon"></i>
                                        </button>
                                    </div>
                                </div>
                            </form>
                            <a href="{{ route('auth.view.create') }}">
                                <button type="button" class="btn btn-info rounded-pill" style="width: 100%;">Tambah Data Training</button>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--================== END ==================-->

    <!--================== DATA PENGGUNA ==================-->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">

                        <!--================== FILTER ==================-->
                        <div class="card-body border-bottom">
                            <div class="d-flex justify-content-between align-items-center">
                                <h4 class="card-title mb-0" style="font-family: 'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif; color: #808080;">
                                    <i class="fas fa-list"></i> Data Training
                                </h4>
                                <div class="ms-auto">
                                    <form method="GET" action="{{ route('auth.view.trainings') }}" class="d-inline">
                                        <h4 class="card-title mt-1 mr-2" style="font-family: 'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif; color: #808080;">Filter :</h4>
                                        <select name="sort_by" onchange="this.form.submit()" class="form-select form-select-sm">
                                            <option value="latest" {{ request()->input('sort_by') == 'latest' ? 'selected' : '' }}>Terbaru</option>
                                            <option value="oldest" {{ request()->input('sort_by') == 'oldest' ? 'selected' : '' }}>Terlama</option>
                                        </select>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!--================== END ==================-->

                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="example2" class="table table-bordered table-hover">
                                    <thead>
                                        <tr style="text-align: center;">
                                            <th>No</th>
                                            <th>Nama Training</th>
                                            <th>Tanggal</th>
                                            <th>Biaya</th>
                                            <th>Kode Diskon</th>
                                            <th>Diskon</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($trainings as $index => $datas)
                                        <tr>
                                            <td style="text-align: center;">{{ $trainings->firstItem() + $index }}</td>
                                            <td class="text-center">{{ $datas->name }}</td>
                                            <td class="text-center">
                                                {{ \Carbon\Carbon::parse($datas->tanggal_mulai)->format('d-m-Y H:i') }} <br>
                                                S/D <br>
                                                {{ \Carbon\Carbon::parse($datas->tanggal_akhir)->format('d-m-Y H:i') }}
                                            </td>
                                            <td class="text-center">Rp. {{ number_format($datas->biaya, 0, ',', '.') }}</td>
                                            <td class="text-center">{{ $datas->name_diskon ?? '-' }}</td>
                                            <td class="text-center">Rp. {{ number_format((float) ($datas->biaya_diskon ?? 0), 0, ',', '.') }}</td>
                                            <td class="text-center">
                                                @if($datas->status === 'publish')
                                                <div class="alert alert-success" role="alert" style="display: inline-block; font-size: 15px; padding: 2px 8px; margin-top: 5px; margin-bottom: 5px; width: auto;">
                                                    PUBLISH
                                                </div>
                                                @elseif($datas->status === 'draft')
                                                <div class="alert alert-secondary" role="alert" style="display: inline-block; font-size: 15px; padding: 2px 8px; margin-top: 5px; margin-bottom: 5px; width: auto;">
                                                    DRAFT
                                                </div>
                                                @else
                                                <div class="alert alert-danger" role="alert" style="display: inline-block; font-size: 15px; padding: 2px 8px; margin-top: 5px; margin-bottom: 5px; width: auto;">
                                                    SELESAI
                                                </div>
                                                @endif
                                            </td>
                                            <td class="text-center">
                                                <div class="d-inline-block">
                                                    <a href="{{ route('auth.view.Trainings.edit', ['id' => $datas->id]) }}" class="btn btn-warning btn-sm" style="margin-top: 5px; margin-bottom: 5px;">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                </div>
                                                <div class="d-inline-block">
                                                    <form action="{{ route('auth.Trainings.delete', ['id' => $datas->id]) }}" method="POST" onsubmit="confirmDelete(event, this);">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger btn-sm" style="margin-top: 5px; margin-bottom: 5px;">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <nav aria-label="Page navigation" class="d-flex justify-content-center">
                                    {{ $trainings->links('pagination::bootstrap-4') }}
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--================== END ==================-->
</div>

<!--================== SEARCH ==================-->
<script>
    function toggleSearchButton(value) {
        const searchButton = document.getElementById('searchButton');
        const searchIcon = document.getElementById('searchIcon');

        if (value.trim() !== '') {
            searchIcon.classList.remove('fa-search');
            searchIcon.classList.add('fa-trash');
            searchButton.classList.add('btn-danger');
            searchButton.classList.remove('btn-primary');
            searchButton.setAttribute('type', 'button');
        } else {
            searchIcon.classList.remove('fa-trash');
            searchIcon.classList.add('fa-search');
            searchButton.classList.add('btn-primary');
            searchButton.classList.remove('btn-danger');
            searchButton.setAttribute('type', 'submit');
        }
    }

    function handleSearchButtonClick(event) {
        const searchButton = event.currentTarget;
        if (searchButton.getAttribute('type') === 'button') {
            event.preventDefault();
            document.querySelector('input[name="search"]').value = '';
            document.getElementById('searchForm').submit();
        }
    }
    document.addEventListener('DOMContentLoaded', () => {
        const inputValue = document.querySelector('input[name="search"]').value;
        toggleSearchButton(inputValue);
    });
</script>

<style>
    .rounded-pill {
        border-radius: 50rem;
    }

    .input-group .btn {
        border-radius: 50rem;
    }

    .btn-danger {
        background-color: #dc3545;
        border-color: #dc3545;
    }

    .btn-primary {
        background-color: #007bff;
        border-color: #007bff;
    }
</style>
<!--================== END ==================-->

<!--================== SWEET ALERT DELETE ==================-->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> <!-- Ensure SweetAlert2 is included -->

<script>
    function confirmDelete(event, form) {
        event.preventDefault();
        Swal.fire({
            title: 'Apakah Anda yakin?',
            text: "Data ini akan dihapus secara permanen!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                form.submit();
            }
        });
    }

    document.addEventListener('DOMContentLoaded', function() {
        // Check for success message and display SweetAlert
        @if(session('statusdatadeleted'))
        Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: '{{ session("statusdatadeleted") }}',
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

<!--================== SWEET ALERT CREATE ==================-->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        @if(session('successcreate'))
        Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: 'Berhasil menambah data training',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true
        }).then(() => {
            location.reload();
        });
        @endif
    });
    document.addEventListener('DOMContentLoaded', function() {
        @if(session('errorcreate'))
        Swal.fire({
            icon: 'error',
            title: 'Gagal!',
            text: 'Gagal menambah data training',
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