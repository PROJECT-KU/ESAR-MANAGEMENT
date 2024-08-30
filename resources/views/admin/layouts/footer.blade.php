<footer class="main-footer">
    <strong>Copyright &copy; 2014-2019 <a href="http://adminlte.io">AdminLTE.io</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
        <b>Version</b> 1.0.0
    </div>
</footer>

<!--================== GENERAL JS ==================-->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src=" {{ asset('assets/admin/plugins/jquery/jquery.min.js') }}"></script>
<script src=" {{ asset('assets/admin/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src=" {{ asset('assets/admin/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
<script src=" {{ asset('assets/admin/dist/js/adminlte.js') }}"></script>
<script src=" {{ asset('assets/admin/dist/js/demo.js') }}"></script>
<script src=" {{ asset('assets/admin/plugins/jquery-mousewheel/jquery.mousewheel.js') }}"></script>
<script src=" {{ asset('assets/admin/plugins/raphael/raphael.min.js') }}"></script>
<script src=" {{ asset('assets/admin/plugins/jquery-mapael/jquery.mapael.min.js') }}"></script>
<script src=" {{ asset('assets/admin/plugins/jquery-mapael/maps/usa_states.min.js') }}"></script>
<script src=" {{ asset('assets/admin/plugins/chart.js/Chart.min.js') }}"></script>
<script src=" {{ asset('assets/admin/dist/js/pages/dashboard2.js') }}"></script>
<!--================== END ==================-->

<!--================== LOGO SIDEBAR ==================-->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const sidebar = document.querySelector('.main-sidebar');
        const hamburger = document.querySelector('[data-widget="pushmenu"]');

        // Function to toggle sidebar state
        function toggleSidebar() {
            sidebar.classList.toggle('sidebar-collapsed');
        }

        // Add event listener to hamburger menu
        hamburger.addEventListener('click', toggleSidebar);
    });
</script>


<!--================== END ==================-->