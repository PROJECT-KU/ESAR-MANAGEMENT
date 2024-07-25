<!-- Fonts -->
<link href="https://fonts.googleapis.com" rel="preconnect">
<link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,300;1,400;1,500;1,600;1,700;1,800&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Jost:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

<!-- Vendor CSS Files -->
<link href="{{ asset('assets/public/vendor/isotope-layout/isotope.pkgd.min.js') }}">
<link href="{{ asset('assets/public/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
<link href="{{ asset('assets/public/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
<link href="{{ asset('assets/public/vendor/aos/aos.css') }}" rel="stylesheet">
<link href="{{ asset('assets/public/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
<link href="{{ asset('assets/public/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">

<!-- Main CSS File -->
<link href="{{ asset('assets/public/css/main.css') }}" rel="stylesheet">

<!-- css swiper image -->
<style>
    .swiper-slide {
        display: flex;
        justify-content: center;
        align-items: center;
        /* Menjaga gambar berada di tengah slide */
    }

    .enlarged-image {
        max-width: 100%;
        /* Memastikan gambar tidak melampaui lebar slide */
        height: auto;
    }

    @media (min-width: 768px) {
        .enlarged-image {
            max-width: 100%;
            width: 500px;
        }
    }

    @media (min-width: 992px) {
        .enlarged-image {
            max-width: 100%;
            width: 1000px;
        }
    }
</style>
<!-- end -->

<!-- set active navbar -->
<style>
    /* Menghilangkan garis bawah pada semua link dalam navigasi */
    #navmenu ul li a {
        text-decoration: none;
    }

    /* Gaya untuk link aktif */
    #navmenu ul li.active>a {
        color: #6495ED;
        /* Ubah sesuai dengan warna yang diinginkan untuk link aktif */
        font-weight: bold;
        /* Contoh: membuat teks tebal untuk link aktif */
    }

    /* Gaya untuk dropdown menu */
    .dropdown {
        position: relative;
        display: inline-block;
    }

    .dropdown-content {
        display: none;
        position: absolute;
        background-color: #f9f9f9;
        min-width: 160px;
        box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
        z-index: 1;
    }

    .dropdown-content a {
        color: black;
        padding: 12px 16px;
        text-decoration: none;
        display: block;
    }

    .dropdown-content a:hover {
        background-color: #f1f1f1;
    }

    .dropdown:hover .dropdown-content {
        display: block;
    }

    /* Gaya untuk dropdown aktif */


    /* Gaya khusus untuk "Digital Service" ketika aktif */
    .dropdown-content a.active {
        color: #6495ED;
        /* Warna untuk link aktif di dalam dropdown */
    }

    .dropdown-content a.inactive {
        color: #000;
        /* Warna untuk link tidak aktif di dalam dropdown */
    }
</style>
<!-- end -->