@extends('layouts.app')

@section('title')
Training View| ESAR
@stop

<!--================== PREVIEW IMAGE ==================-->
<style>
    .custom-card-shadow {
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.5);
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
        <div class="d-flex justify-content-center">
            <div class="card shadow-lg" style="width: 1000px;">
                <div class="container-fluid p-0">
                    <div class="row gy-4">
                        <div class="col-lg-12 content" data-aos="fade-up">
                            @if(isset($trainingsData->foto))
                            <img src="{{ asset('assets/public/img/training/' . $trainingsData->foto) }}" alt="Current Photo" style="width: 100%; height: auto;">
                            @else
                            <img src="{{ asset('assets/public/img/profil/no-image.jpg') }}" alt="Current Photo" class="img-fluid" id="currentPhoto" style="width: 100%;">
                            @endif
                        </div>
                        <div class="card-body">
                            <div style="display: flex; justify-content: space-between; align-items: center; margin-top: -15px;">
                                <span class="alert alert-secondary" role="alert" style="display: inline-block; padding: 2px 8px; margin-left: 10px; font-weight: bold;">
                                    {{ \Carbon\Carbon::parse($trainingsData->tanggal_mulai)->locale('id')->format('d F Y') }}
                                    -
                                    {{ \Carbon\Carbon::parse($trainingsData->tanggal_akhir)->locale('id')->format('d F Y') }}
                                </span>
                                <div style="display: flex; align-items: center; gap: 10px;">
                                    <span class="alert alert-danger" role="alert" style="display: inline-block; padding: 2px 8px;">
                                        Rp. {{ number_format($trainingsData->biaya, 0, ',', '.') }}
                                    </span>
                                    <span class="alert alert-warning" role="alert" style="display: inline-block; padding: 2px 8px; margin-right: 10px; text-transform: uppercase;">
                                        <i class="bi bi-geo-alt-fill"></i> {{ $trainingsData->lokasi }}
                                    </span>
                                </div>
                            </div>
                            <p class="card-title text-center mt-2" style="font-size:50px; text-transform: uppercase; font-weight: bold;">
                                {{ $trainingsData->name }}
                            </p>
                            <p style="margin-left: 10px; margin-right:10px;">
                                {{ $trainingsData->deskripsi }}
                            </p>
                        </div>
                    </div>
                </div>
                <div class="p-3">
                    <a href="{{ route('public.training.pendaftaran.view', ['id' => $trainingsData->id]) }}" class="btn btn-info" style="font-weight: bold; width: 100%;">
                        Daftar Sekarang
                    </a>
                </div>
            </div>
        </div>
    </section>
</main>

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