<!--================== MENU SEDANG AKTIF ==================-->
<style>
    .nav-sidebar .nav-item>.nav-link.active {
        background-color: #007bff;
        /* Warna biru */
        color: white;
    }
</style>
<!--================== END ==================-->

<!--================== LOGO SIDEBAR ==================-->
<style>
    /* Default state: Sidebar is open, show the larger logo */
    #logo-large {
        display: none;
        justify-content: center;
        margin-bottom: -60px;
        margin-top: 20px;
    }

    #logo-small {
        display: flex;
        justify-content: center;
        margin-bottom: -60px;
        margin-top: 20px;
    }

    /* When the sidebar is collapsed, show the smaller logo and hide the larger one */
    .sidebar-collapsed #logo-large {
        display: flex;
    }

    .sidebar-collapsed #logo-small {
        display: none;
    }
</style>
<!--================== END ==================-->