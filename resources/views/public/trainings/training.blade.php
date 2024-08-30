@extends('layouts.app')

@section('title')
Training | ESAR
@stop

<!--================== PREVIEW IMAGE ==================-->
<style>
    .photo-preview {
        width: 300px;
        height: 150px;
        border: 1px solid #ced4da;
        border-radius: 0.25rem;
        overflow: hidden;
        background-color: #ffffff;
        display: flex;
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.5);
        /* Shadow effect */
    }

    .photo-preview img {
        max-width: 100%;
        max-height: 100%;
        object-fit: cover;
    }
</style>
<!--================== END ==================-->

@section('content')
<main class="main">
    <section id="hero" class="hero section dark-background" style="background-color: 	#4682B4;">

        <div class="container" id="home">
            <div class="row gy-4">
                <div class="col-lg-8 order-2 order-lg-1 d-flex flex-column justify-content-center" data-aos="zoom-out">
                    <h1>The Best Solution for Your Manuscript Articles</h1>
                    <p>Immediately send your best articles to our journal</p>
                    <div class="d-flex">
                        <a href="#about" class="btn-get-started">Get Started</a>
                        <!-- <a href="https://www.youtube.com/watch?v=LXb3EKWsInQ" class="glightbox btn-watch-video d-flex align-items-center"><i class="bi bi-play-circle"></i><span>Watch Video</span></a> -->
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
            <h2>Training</h2>
        </div>
        <div class="container">
            <div class="row gy-4">
                <div class="col-lg-12 content" data-aos="fade-up">
                    <p>
                        International Ecsis Association also provides training services, where we will guide you to solve your problems in writing articles. one of them is problems regarding analysis and so on. If you want your article problem to be resolved quickly, you can take our training. The training will be guided by people who are professionals in their field. </p>
                </div>
            </div>
        </div>
    </section>

    <section id="pricing" class="pricing section light-background">
        <div class="container section-title" data-aos="fade-up">
            <h2>Ongoing Training</h2>
        </div>

        <!--================== FILTER SEARCH ==================-->
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <div class="d-flex align-items-center">
                        <!-- Search Form -->
                        <div class="me-3" style="flex: 1;">
                            <div class="card-body">
                                <form method="GET" action="{{ route('public.training') }}" id="searchForm">
                                    <div class="input-group">
                                        <input
                                            type="text"
                                            name="search"
                                            class="form-control rounded-pill"
                                            placeholder="Cari data..."
                                            value="{{ request('search') }}"
                                            onkeyup="toggleSearchButton(this.value)">
                                        <div class="input-group-append" style="margin-left: 10px; margin-top:5px">
                                            <button
                                                type="submit"
                                                class="btn rounded-pill"
                                                id="searchButton"
                                                onclick="handleSearchButtonClick(event)">
                                                <i class="bi bi-search" id="searchIcon"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <!-- Filter Dropdown -->
                        <div style="flex: 1;">
                            <div class="card-body" style="border-bottom: none;">
                                <div class="d-flex align-items-center justify-content-end">
                                    <h5 class="card-title mb-0 me-2" style="font-family: 'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif; color: #808080;">Filter :</h5>
                                    <form method="GET" action="{{ route('public.training') }}" class="d-inline">
                                        <select name="sort_by" onchange="this.form.submit()" class="form-select form-select-sm" style="margin-top: 13px;">
                                            <option value="latest" {{ request()->input('sort_by') == 'latest' ? 'selected' : '' }}>Terbaru</option>
                                            <option value="oldest" {{ request()->input('sort_by') == 'oldest' ? 'selected' : '' }}>Terlama</option>
                                        </select>
                                    </form>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <!--================== END ==================-->

        <div class="container mb-4">
            <div class="row gy-4">
                @foreach ($trainings as $index => $datas)
                @if ($datas->status === 'publish')
                <div class="col-lg-12" data-aos="zoom-in" data-aos-delay="{{ $index * 100 }}">
                    <div class="card" style="display: flex; flex-direction: column;">

                        <!-- tanggal di mulai & berkahir training -->
                        <div class="card-header" style="font-family: 'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif; color: #808080;">
                            {{ \Carbon\Carbon::parse($datas->tanggal_mulai)->locale('id')->format('d F Y') }}
                            -
                            {{ \Carbon\Carbon::parse($datas->tanggal_akhir)->locale('id')->format('d F Y') }}
                        </div>
                        <!-- end -->

                        <!-- biaya & lokasi -->
                        <div style="display: flex; justify-content: flex-end; align-items: center; gap: 10px; margin-top:-15px">
                            <span class="alert alert-danger" role="alert" style="display: inline-block; padding: 2px 8px;">
                                Rp. {{ number_format($datas->biaya, 0, ',', '.') }}
                            </span>
                            <span class="alert alert-warning" role="alert" style="display: inline-block; padding: 2px 8px; margin-right:10px; text-transform: uppercase;">
                                <i class="bi bi-geo-alt-fill"></i> {{ $datas->lokasi }}
                            </span>
                        </div>
                        <!-- end -->

                        <!-- nama training &deskripsi -->
                        <div class="card-body" style="display: flex; flex-direction: row; align-items: flex-start; padding: 0; margin-top:-50px">
                            <div class="text-container" style="flex: 1; padding: 20px; box-sizing: border-box;">
                                <p class="card-title text-bold mt-2" style="font-family: 'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif; font-size:30px; text-transform: uppercase;">
                                    {{ $datas->name }}
                                </p>
                                <hr style="width: 100%;">
                                <p class="card-text" style="font-family: 'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif; color: #808080; max-width: 900px;">
                                    @php
                                    $description = $datas->deskripsi;
                                    $maxLength = 200;
                                    if (strlen($description) > $maxLength) {
                                    $description = substr($description, 0, $maxLength) . '...';
                                    }
                                    echo $description;
                                    @endphp
                                </p>
                            </div>
                            <!-- end -->

                            <!-- foto training -->
                            <div class="photo-preview mb-4" style="flex-shrink: 0; margin-right: 10px; margin-top:50px">
                                @if(isset($datas->foto))
                                <img src="{{ asset('assets/public/img/training/' . $datas->foto) }}" alt="Current Photo">
                                @else
                                <img src="{{ asset('assets/public/img/profil/no-image.jpg') }}" alt="Current Photo" class="img-fluid" id="currentPhoto">
                                @endif
                            </div>
                            <!-- end -->

                        </div>
                        <div class="p-3">
                            <a href="{{ route('public.training-view', ['id' => $datas->id]) }}" class="btn btn-info" style="font-family: 'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif; font-weight: bold; width:100%;">
                                Daftar Sekarang
                            </a>
                        </div>
                    </div>
                </div>
                @endif
                @endforeach
            </div>
        </div>
        @if ($datas->status === 'publish')
        <nav aria-label="Page navigation" class="d-flex justify-content-center" style="margin-bottom: -70px;">
            {{ $trainings->links('pagination::bootstrap-4') }}
        </nav>
        @endif
    </section>
</main>

<!--================== SWEET ALERT PENDAFTARAN TRAINING ==================-->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

@if(session('successcreate'))
<script>
    Swal.fire({
        title: 'Berhasil!',
        text: 'Pendaftaran Training anda berhasil! Silahkan tunggu informasi selanjutnya melalui email yang anda daftarkan.',
        icon: 'success',
        confirmButtonText: 'OK'
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = "{{ route('public.training') }}";
        }
    });
</script>
@endif

@if(session('errorcreate'))
<script>
    Swal.fire({
        title: 'Error!',
        text: 'Pendaftaran Training anda gagal!',
        icon: 'error',
        confirmButtonText: 'OK'
    });
</script>
@endif

<!--================== END ==================-->

<!--================== SEARCH ==================-->
<script>
    function toggleSearchButton(value) {
        const searchButton = document.getElementById('searchButton');
        const searchIcon = document.getElementById('searchIcon');

        if (value.trim() !== '') {
            searchIcon.classList.remove('bi-search');
            searchIcon.classList.add('bi-trash');
            searchButton.classList.add('btn-danger');
            searchButton.classList.remove('btn-primary');
            searchButton.setAttribute('type', 'button');
        } else {
            searchIcon.classList.remove('bi-trash');
            searchIcon.classList.add('bi-search');
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
@stop