@extends('layouts.app')

@section('title')
Home | Ecsis
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

    <section id="clients" class="clients section light-background">
        <div class="container" data-aos="zoom-in">
            <div class="swiper init-swiper">
                <script type="application/json" class="swiper-config">
                    {
                        "loop": true,
                        "speed": 600,
                        "autoplay": {
                            "delay": 5000
                        },
                        "slidesPerView": "auto",
                        "pagination": {
                            "el": ".swiper-pagination",
                            "type": "bullets",
                            "clickable": true
                        },
                        "breakpoints": {
                            "320": {
                                "slidesPerView": 2,
                                "spaceBetween": 40
                            },
                            "480": {
                                "slidesPerView": 3,
                                "spaceBetween": 60
                            },
                            "640": {
                                "slidesPerView": 4,
                                "spaceBetween": 80
                            },
                            "992": {
                                "slidesPerView": 5,
                                "spaceBetween": 120
                            },
                            "1200": {
                                "slidesPerView": 6,
                                "spaceBetween": 120
                            }
                        }
                    }
                </script>
                <div class="swiper-wrapper align-items-center">
                    <div class="swiper-slide"><a href="https://scholar.google.com/citations?hl=id&user=2Rkyx2UAAAAJ" target="_blank"><img src="{{ asset('assets/public/img/index/googlescholar.png') }}" class="img-fluid enlarged-image" alt=""></a></div>
                    <div class="swiper-slide"><a href="https://journals.indexcopernicus.com/search/journal/issue?issueId=all&journalId=122355" target="_blank"><img src="{{ asset('assets/public/img/index/copernicus.png') }}" class="img-fluid enlarged-image" alt=""></a></div>
                    <div class="swiper-slide"><a href="https://www.base-search.net/Search/Results?lookfor=Economics%2C+Business%2C+Accounting+%26+Society+Review&name=&oaboost=1&newsearch=1&refid=dcbasen" target="_blank"><img src="{{ asset('assets/public/img/index/Base_Search.png') }}" class="img-fluid enlarged-image" alt=""></a></div>
                    <div class="swiper-slide"><a href="https://garuda.kemdikbud.go.id/journal/view/30097" target="_blank"><img src="{{ asset('assets/public/img/index/garuda.png') }}" class="img-fluid enlarged-image" alt=""></a></div>
                    <div class="swiper-slide"><a href="https://app.dimensions.ai/auth/base/landing?redirect=%2Fdiscover%2Fpublication%3Fsearch_mode%3Dcontent%26or_facet_source_title%3Djour.1441322" target="_blank"><img src="{{ asset('assets/public/img/index/dimensions.png') }}" class="img-fluid enlarged-image" alt=""></a></div>
                    <div class="swiper-slide"><a href="https://portal.issn.org/resource/ISSN/2810-0115" target="_blank"><img src="{{ asset('assets/public/img/index/road.png') }}" class="img-fluid enlarged-image" alt=""></a></div>
                    <div class="swiper-slide"><a href="https://search.worldcat.org/" target="_blank"><img src="{{ asset('assets/public/img/index/worldcat.png') }}" class="img-fluid enlarged-image" alt=""></a></div>
                    <div class="swiper-slide"><a href="https://moraref.kemenag.go.id/" target="_blank"><img src="{{ asset('assets/public/img/index/moraref.png') }}" class="img-fluid enlarged-image" alt=""></a></div>
                </div>
            </div>
        </div>
    </section>

    <section id="about" class="about section">
        <div class="container section-title" data-aos="fade-up">
            <h2>About Us</h2>
        </div>
        <div class="container">
            <div class="row gy-4">
                <div class="col-lg-12 content" data-aos="fade-up">
                    <p>
                        Economics, Business, Accounting & Society Review (EBASR) is a peer-reviewed, open-access journal published three times a year. We invite you to submit your paper to EBASR for publishing. Before submission, please make sure that your paper is prepared using the journal paper template EBASR Template.
                        Submit your manuscripts through our online system. The authors should refer to the EBASR template for writing format and style. Submitted papers are evaluated by anonymous referees for contribution, originality, relevance, and presentation. The Editor shall inform you of the results of the review as soon as possible, hopefully in 2-12 weeks.
                        <br>For more information please contact <a href="mailto:ebasreviews@gmail.com">ebasreviews@gmail.com</a> or <a href="mailto:admin.ebasr@ecsis.org">admin.ebasr@ecsis.org</a>
                        <br>
                        Best Regards,
                        <br>
                        Editor.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <section id="journal" class="section why-us light-background" data-builder="section">
        <div class="container-fluid">
            <div class="row gy-4">
                <div class="col-lg-7 d-flex flex-column justify-content-center order-2 order-lg-1">
                    <div class="content px-xl-5" data-aos="fade-up" data-aos-delay="100">
                        <h3><strong>Economics, Business, Accounting & Society Review</strong></h3>
                        <p>
                            Economics, Business, Accounting & Society Review (EBASR) has been published since February 2022 by International Ecsis Association. EBASR is a multidisciplinary journal covering all aspects
                            of the economics impacts of socio-economics development. EBASR publishes scientific articles and highly appreciates creative and challenging thought to trigger the birth of economics, business,
                            accounting & social sciences innovation as well as practices. EBASR is quarterly issued on February - May, June - September, October – January. EBASR also uses LOCKSS system to ensure a secure
                            and permanent archive for the journal.
                        </p>
                    </div>
                    <div class="faq-container px-xl-5" data-aos="fade-up" data-aos-delay="200">
                        <a href="https://ecsis.org/index.php/ebasr/"><button type="button" class="btn btn-info" style="color: white; border-radius: 10px; width: 150px; font-size: 18px;">View Journal</button></a>
                        <a href="https://ecsis.org/index.php/ebasr/issue/archive"><button type="button" class="btn btn-warning" style="color: white; border-radius: 10px; width: 150px; font-size: 18px;">Current Issue</button></a>
                    </div>
                </div>
                <div class="col-lg-5 order-1 order-lg-2 why-us-img">
                    <img src="{{ asset('assets/public/img/esbar.jpg') }}" class="img-fluid" alt="" data-aos="zoom-in" data-aos-delay="100">
                </div>
            </div>
        </div>
    </section>

    <section id="why-us" class="section why-us light-background" data-builder="section" style="background-color: white;">
        <div class="container-fluid">
            <div class="row gy-4">
                <div class="col-lg-5 order-1 why-us-img">
                    <img src="{{ asset('assets/public/img/entrepreneurship.png') }}" class="img-fluid" alt="" data-aos="zoom-in" data-aos-delay="100">
                </div>
                <div class="col-lg-7 d-flex flex-column justify-content-center order-2">
                    <div class="content px-xl-5" data-aos="fade-up" data-aos-delay="100">
                        <h3><strong>Entrepreneurship and Small Business Research</strong></h3>
                        <p>
                            Entrepreneurship and Small Business Research (ESBER) has been published since April 2022 by International Ecsis Association. ESBER is a multidisciplinary journal covering all aspects of
                            the Entrepreneurship and Small Business impacts on socio-economics development. ESBER publishes scientific articles and highly appreciates creative and challenging thought to trigger the
                            birth of Entrepreneurship, Small and Medium Enterprises (SMEs) Finance, business & social science innovation as well as practices. ESBER is quarterly issued on April-July, August-November,
                            December - March. ESBER also uses LOCKSS system to ensure a secure and permanent archive for the journal.
                        </p>
                    </div>
                    <div class="faq-container px-xl-5" data-aos="fade-up" data-aos-delay="200">
                        <a href="https://ecsis.org/index.php/esber"><button type="button" class="btn btn-info" style="color: white; border-radius: 10px; width: 150px; font-size: 18px;">View Journal</button></a>
                        <a href="https://ecsis.org/index.php/esber/issue/archive"><button type="button" class="btn btn-warning" style="color: white; border-radius: 10px; width: 150px; font-size: 18px;">Current Issue</button></a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="why-us" class="section why-us light-background" data-builder="section">
        <div class="container-fluid">
            <div class="row gy-4">
                <div class="col-lg-7 d-flex flex-column justify-content-center order-2 order-lg-1">
                    <div class="content px-xl-5" data-aos="fade-up" data-aos-delay="100">
                        <h3><strong>Corporate Governance And Accountability Studies</strong></h3>
                        <p>
                            Corporate Governance And Accountability Studies (CoGAS) has been published since June 2022 by International Ecsis Association. CoGAS is a multidisciplinary journal covering all aspects of the
                            economic impacts of socio-economics development. CoGAS aims to relate to current research qualitative and quantitative on Good Corporate Governance, Accountability Studies, Good Governance,
                            Business & Social Science innovation as well as practices. CoGAS is quarterly issued on June- September, October–January, February-May. CoGAS also uses LOCKSS system to ensure a secure and
                            permanent archive for the journal.
                        </p>
                    </div>
                    <div class="faq-container px-xl-5" data-aos="fade-up" data-aos-delay="200">
                        <a href="https://ecsis.org/index.php/cogas"><button type="button" class="btn btn-info" style="color: white; border-radius: 10px; width: 150px; font-size: 18px;">View Journal</button></a>
                        <a href="https://ecsis.org/index.php/cogas/issue/archive"><button type="button" class="btn btn-warning" style="color: white; border-radius: 10px; width: 150px; font-size: 18px;">Current Issue</button></a>
                    </div>
                </div>
                <div class="col-lg-5 order-1 order-lg-2 why-us-img">
                    <img src="{{ asset('assets/public/img/corporate.jpg') }}" class="img-fluid" alt="" data-aos="zoom-in" data-aos-delay="100">
                </div>
            </div>
        </div>
    </section>


    <section id="timeperiod" class="services section">
        <div class="container section-title" data-aos="fade-up">
            <h2>Time period</h2>
        </div>
        <div class="container">
            <div class="row gy-4">
                <div class="col-xl-3 col-md-6 d-flex" data-aos="fade-up" data-aos-delay="100">
                    <div class="service-item position-relative">
                        <div class="icon"><i class="bi bi-activity icon"></i></div>
                        <h4><a href="" class="stretched-link">Lorem Ipsum</a></h4>
                        <p>Voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi</p>
                    </div>
                </div>

                <div class="col-xl-3 col-md-6 d-flex" data-aos="fade-up" data-aos-delay="200">
                    <div class="service-item position-relative">
                        <div class="icon"><i class="bi bi-bounding-box-circles icon"></i></div>
                        <h4><a href="" class="stretched-link">Sed ut perspici</a></h4>
                        <p>Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore</p>
                    </div>
                </div>

                <div class="col-xl-3 col-md-6 d-flex" data-aos="fade-up" data-aos-delay="300">
                    <div class="service-item position-relative">
                        <div class="icon"><i class="bi bi-calendar4-week icon"></i></div>
                        <h4><a href="" class="stretched-link">Magni Dolores</a></h4>
                        <p>Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia</p>
                    </div>
                </div>

                <div class="col-xl-3 col-md-6 d-flex" data-aos="fade-up" data-aos-delay="400">
                    <div class="service-item position-relative">
                        <div class="icon"><i class="bi bi-broadcast icon"></i></div>
                        <h4><a href="" class="stretched-link">Nemo Enim</a></h4>
                        <p>At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
@stop