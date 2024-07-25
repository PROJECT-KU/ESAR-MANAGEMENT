<footer id="footer" class="footer">
    <div class="container footer-top">
        <div class="row gy-4">
            <div class="col-lg-4 col-md-6 footer-about">
                <a href="#" class="d-flex align-items-center">
                    <img src="{{ asset('assets/public/img/icon.png') }}" class="img-fluid animated" alt="" style="width: 70px; height: 80px;">
                    <h1 class="sitename" style="font-size: 15px;">International <br>Ecsis <br>Association</h1>
                </a>
                <div class="footer-contact pt-3">
                    <p><strong>Email:</strong> <span><a href="mailto:admin.ebasr@ecsis.org" style="font-size: 15px;">admin.ebasr@ecsis.org</a></span></p>
                </div>
            </div>

            <div class="col-lg-2 col-md-3 footer-links">
                <h4>Useful Links</h4>
                <ul>
                    <li><i class="bi bi-chevron-right"></i> <a href="#">Home</a></li>
                    <li><i class="bi bi-chevron-right"></i> <a href="#about">About us</a></li>
                    <li><i class="bi bi-chevron-right"></i> <a href="#journal">Journal</a></li>
                    <li><i class="bi bi-chevron-right"></i> <a href="#team">Editorial Team</a></li>
                </ul>
            </div>

            <div class="col-lg-2 col-md-3 footer-links">
                <h4>Our Journal</h4>
                <ul>
                    <li><i class="bi bi-chevron-right"></i> <a href="#">Economics, Business, Accounting & Society Review</a></li>
                    <li><i class="bi bi-chevron-right"></i> <a href="#">Entrepreneurship and Small Business Research</a></li>
                    <li><i class="bi bi-chevron-right"></i> <a href="#">Corporate Governance And Accountability Studies</a></li>
                </ul>
            </div>

            <div class="col-lg-4 col-md-12">
                <h4>Help</h4>
                <p>Please contact us if there are problems when sending your best articles</p>
            </div>

        </div>
    </div>

    <div class="container copyright text-center mt-4">
        <p>© <span>Copyright</span> <span id="current-year"></span> <strong class="px-1 sitename">International Ecsis Association</strong> <span>All Rights Reserved</span></p>
        <script>
            document.getElementById("current-year").textContent = new Date().getFullYear();
        </script>
    </div>

</footer>
<!-- Scroll Top -->
<a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
<!-- Preloader -->
<div id="preloader"></div>
<!-- Vendor JS Files -->
<script src="{{ asset('assets/public/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('assets/public/vendor/php-email-form/validate.js') }}"></script>
<script src="{{ asset('assets/public/vendor/aos/aos.js') }}"></script>
<script src="{{ asset('assets/public/vendor/glightbox/js/glightbox.min.js') }}"></script>
<script src="{{ asset('assets/public/vendor/swiper/swiper-bundle.min.js') }}"></script>
<script src="{{ asset('assets/public/vendor/waypoints/noframework.waypoints.js') }}"></script>
<script src="{{ asset('assets/public/vendor/imagesloaded/imagesloaded.pkgd.min.js') }}"></script>
<script src="{{ asset('assets/public/vendor/isotope-layout/isotope.pkgd.min.js') }}"></script>
<!-- Main JS File -->
<script src="{{ asset('assets/public/js/main.js') }}"></script>

<!-- set active navbar -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const navLinks = document.querySelectorAll('#navmenu ul li a');

        navLinks.forEach(link => {
            link.addEventListener('click', function() {
                navLinks.forEach(navLink => {
                    navLink.parentElement.classList.remove('active');
                });
                this.parentElement.classList.add('active');
            });
        });
    });
</script>
<!-- end -->