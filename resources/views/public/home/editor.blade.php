@extends('layouts.app')

@section('title')
Editorial | Ecsis
@stop

@section('content')
<main class="main">
    <section id="hero" class="hero section dark-background">

        <div class="container" id="home">
            <div class="row gy-4">
                <div class="col-lg-6 order-2 order-lg-1 d-flex flex-column justify-content-center" data-aos="zoom-out">
                    <h1>The Best Solution for Your Manuscript Articles</h1>
                    <p>Immediately send your best articles to our journal</p>
                    <div class="d-flex">
                        <a href="#about" class="btn-get-started">Get Started</a>
                        <!-- <a href="https://www.youtube.com/watch?v=LXb3EKWsInQ" class="glightbox btn-watch-video d-flex align-items-center"><i class="bi bi-play-circle"></i><span>Watch Video</span></a> -->
                    </div>
                </div>
                <div class="col-lg-6 order-1 order-lg-2 hero-img" data-aos="zoom-out" data-aos-delay="200">
                    <img src="{{ asset('assets/public/img/icon.png') }}" class="img-fluid animated" alt="">
                </div>
            </div>
        </div>
    </section>

    <section id="team" class="team section">

        <div class="container section-title" data-aos="fade-up">
            <h2>Team</h2>
        </div>
        <div class="container">
            <div class="row gy-4">
                <div class="col-lg-6" data-aos="fade-up" data-aos-delay="100">
                    <div class="team-member d-flex align-items-start">
                        <div class="pic"><img src="{{ asset('assets/public/img/team/team-1.jpg') }}" class="img-fluid" alt=""></div>
                        <div class="member-info">
                            <h4>Walter White</h4>
                            <span>Chief Executive Officer</span>
                            <p>Explicabo voluptatem mollitia et repellat qui dolorum quasi</p>
                            <div class="social">
                                <a href=""><i class="bi bi-twitter-x"></i></a>
                                <a href=""><i class="bi bi-facebook"></i></a>
                                <a href=""><i class="bi bi-instagram"></i></a>
                                <a href=""> <i class="bi bi-linkedin"></i> </a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6" data-aos="fade-up" data-aos-delay="200">
                    <div class="team-member d-flex align-items-start">
                        <div class="pic"><img src="{{ asset('assets/public/img/team/team-2.jpg') }}" class="img-fluid" alt=""></div>
                        <div class="member-info">
                            <h4>Sarah Jhonson</h4>
                            <span>Product Manager</span>
                            <p>Aut maiores voluptates amet et quis praesentium qui senda para</p>
                            <div class="social">
                                <a href=""><i class="bi bi-twitter-x"></i></a>
                                <a href=""><i class="bi bi-facebook"></i></a>
                                <a href=""><i class="bi bi-instagram"></i></a>
                                <a href=""> <i class="bi bi-linkedin"></i> </a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6" data-aos="fade-up" data-aos-delay="300">
                    <div class="team-member d-flex align-items-start">
                        <div class="pic"><img src="{{ asset('assets/public/img/team/team-3.jpg') }}" class="img-fluid" alt=""></div>
                        <div class="member-info">
                            <h4>William Anderson</h4>
                            <span>CTO</span>
                            <p>Quisquam facilis cum velit laborum corrupti fuga rerum quia</p>
                            <div class="social">
                                <a href=""><i class="bi bi-twitter-x"></i></a>
                                <a href=""><i class="bi bi-facebook"></i></a>
                                <a href=""><i class="bi bi-instagram"></i></a>
                                <a href=""> <i class="bi bi-linkedin"></i> </a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6" data-aos="fade-up" data-aos-delay="400">
                    <div class="team-member d-flex align-items-start">
                        <div class="pic"><img src="{{ asset('assets/public/img/team/team-4.jpg') }}" class="img-fluid" alt=""></div>
                        <div class="member-info">
                            <h4>Amanda Jepson</h4>
                            <span>Accountant</span>
                            <p>Dolorum tempora officiis odit laborum officiis et et accusamus</p>
                            <div class="social">
                                <a href=""><i class="bi bi-twitter-x"></i></a>
                                <a href=""><i class="bi bi-facebook"></i></a>
                                <a href=""><i class="bi bi-instagram"></i></a>
                                <a href=""> <i class="bi bi-linkedin"></i> </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="team" class="faq-2 section light-background">
        <div class="container section-title" data-aos="fade-up">
            <h2>EDITORIAL TEAM</h2>
        </div>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <div class="faq-container">
                        <div class="faq-item">
                            <i class="faq-icon bi bi-person"></i>
                            <h3>Editor in Chief</h3>
                            <div class="faq-content">
                                <p>&bull; <a href="https://www.scopus.com/authid/detail.uri?authorId=57211256690">Eka Siskawati</a> [Scopus ID 57211256690] Politeknik Negeri Padang, Indonesia</p>
                            </div>
                            <i class="faq-toggle bi bi-chevron-right"></i>
                        </div>

                        <div class="faq-item">
                            <i class="faq-icon bi bi-person"></i>
                            <h3>Editorial Board Member</h3>
                            <div class="faq-content">
                                <p>
                                    &bull; <a href="https://www.scopus.com/authid/detail.uri?authorId=56208258600">Ashish Malik</a> [Scopus ID 56208258600] The University of Newcastle, Australia<br>
                                    &bull; <a href="https://www.scopus.com/authid/detail.uri?authorId=56596730700">Iswanto - Iswanto</a> [Scopus ID 56596730700] Universitas Muhammadiyah Yogyakarta, Indonesia<br>
                                    &bull; <a href="https://www.scopus.com/authid/detail.uri?authorId=55490516000">Rahmat Heru Setianto</a> [Scopus ID 55490516000] Universitas Airlangga, Indonesia<br>
                                    &bull; <a href="https://www.scopus.com/authid/detail.uri?authorId=57192068514">M. Rizky Prima Sakti</a> [Scopus ID 57192068514] University College of Bahrain, Bahrain<br>
                                    &bull; <a href="https://www.scopus.com/authid/detail.uri?authorId=6508136735">Muhamad Abduh</a> [Scopus ID 6508136735] Universiti Brunei Darussalam, Brunei Darussalam<br>
                                    &bull; <a href="https://www.scopus.com/authid/detail.uri?authorId=57205690146">Nazliatul Aniza Abdul Aziz</a> [Scopus ID 57205690146] Universiti Utara Malaysia, Malaysia<br>
                                    &bull; <a href="https://www.scopus.com/authid/detail.uri?authorId=57224069348">Ruslee Nuh</a> [Scopus ID 57224069348 ] Prince of Songkla University, Thailand<br>
                                    &bull; <a href="https://www.scopus.com/authid/detail.uri?authorId=58039591500">Rahmawati Rahmawati</a> [SCOPUS ID: 58039591500] Universitas Sebelas Maret, Indonesia<br>
                                    &bull; <a href="https://www.scopus.com/authid/detail.uri?authorId=56426721400">Mohd Helmi Ali</a> [Scopus ID: 56426721400], UKM-Graduate School of Business, Malaysia<br>
                                    &bull; <a href="https://www.scopus.com/authid/detail.uri?authorId=57216603976">Whedy Prasetyo</a> [Scopus ID: 57216603976 ], Jember University, Indonesia<br>
                                    &bull; <a href="https://www.scopus.com/authid/detail.uri?authorId=57188874922">Syed Abdul Rehman Khan</a> [SCOPUS ID: 57188874922] Tsinghua University, China<br>
                                    &bull; <a href="https://www.scopus.com/authid/detail.uri?authorId=57215487512">Rohmawati Kusumaningtias</a> [SCOPUS ID: 57215487512] Universitas Negeri Surabaya, Indonesia<br>
                                </p>
                            </div>
                            <i class="faq-toggle bi bi-chevron-right"></i>
                        </div>

                        <div class="faq-item">
                            <i class="faq-icon bi bi-person"></i>
                            <h3>Peer Reviewers</h3>
                            <div class="faq-content">
                                <p>
                                    &bull; <a href="https://scholar.google.com/citations?user=Y3AmcnYAAAAJ&hl=en&oi=ao">Afif Syarifudin Yahya</a> Institut Pemerintahan Dalam Negeri, Indonesia<br>
                                    &bull; <a href="https://scholar.google.com/citations?user=EosuOakAAAAJ&hl=en">Ihwana As'ad</a> Universitas Muslim Indonesia, Indonesia<br>
                                    &bull; <a href="https://scholar.google.com/citations?user=acyKT0sAAAAJ&hl=en&oi=ao">Diana Widhi Rachmawati</a> Universitas PGRI Palembang, Indonesia<br>
                                    &bull; <a href="https://scholar.google.com/citations?user=Ldj60FUAAAAJ&hl=en&oi=ao">Muhammad Lukman Baihaqi Alfakihuddin</a> Universitas Sampoerna, Indonesia<br>
                                    &bull; <a href="https://scholar.google.com/citations?hl=en&user=QE2xSIUAAAAJ">Mohammad H Holle</a> Institut Agama Islam Negeri Ambon, Indonesia<br>
                                    &bull; <a href="https://scholar.google.com/citations?hl=en&user=oHTRWOEAAAAJ">Asep Kurniawan</a> Sekolah Tinggi Ilmu Ekonomi Sutaatmadja, Indonesia<br>
                                    &bull; <a href="https://scholar.google.com/citations?hl=en&user=LnzLhTsAAAAJ">Heny Sidanti</a> Universitas PGRI Madiun, Indonesia<br>
                                    &bull; <a href="https://scholar.google.com/citations?hl=en&user=Hv_0dR0AAAAJ">Galih Abdul Fatah Maulani</a> Universitas Garut, Indonesia<br>
                                    &bull; <a href="https://scholar.google.com/citations?user=RBysHYkAAAAJ&hl=en&oi=ao">Ivan Rahmat Santoso</a> Universitas Negeri Gorontalo, Indonesia<br>
                                    &bull; <a href="https://scholar.google.com/citations?user=VompTWMAAAAJ&hl=en&oi=ao">Dede Ruslan</a> Universitas Negeri Medan, Indonesia<br>
                                    &bull; <a href="https://scholar.google.com/citations?user=gvbRWakAAAAJ&hl=en&oi=ao">Firdaus Yuni Dharta</a> Universitas Singaperbangsa Karawang, Indonesia<br>
                                    &bull; <a href="https://scholar.google.com/citations?user=ibBytoQAAAAJ&hl=en&oi=ao">Sabinus Beni</a> Institut Shanti Bhuana, Indonesia<br>
                                    &bull; <a href="https://scholar.google.com/citations?user=kt0_278AAAAJ&hl=en&oi=sra">Mohd Kasturi Nor bin Abd Aziz</a> Universiti Malaysia Perlis, Malaysia<br>
                                    &bull; <a href="https://scholar.google.com/citations?hl=en&user=tZihgM4AAAAJ">Faidah Azuz</a> Universitas Bosowa Makassar, Indonesia<br>
                                    &bull; <a href="https://scholar.google.com/citations?hl=en&user=dNsOfB8AAAAJ">Prasetyono</a> Universitas Trunojoyo Madura, Indonesia<br>
                                    &bull; <a href="https://scholar.google.com/citations?user=LcZ7GbwAAAAJ&hl=en&oi=ao">Jufri Darma</a> Universitas Negeri Medan, Indonesia<br>
                                    &bull; <a href="https://scholar.google.com/citations?user=VzGEbD8AAAAJ&hl=en&oi=ao">Muhammad Rahmattullah</a> Universitas Lambung Mangkurat, Indonesia<br>
                                </p>
                            </div>
                            <i class="faq-toggle bi bi-chevron-right"></i>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
@stop