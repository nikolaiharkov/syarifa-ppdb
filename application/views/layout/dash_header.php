<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Aplikasi Berbasis Web PPDB TK & KB AMELIA">
    <meta name="author" content="Harkovnet Indonesia">
    <title>PPDB TK & KB AMELIA</title>
    <link rel="shortcut icon" href="<?php echo base_url('img/favicon.ico'); ?>" type="image/x-icon">
    <!-- Custom fonts for this template-->
    <link href="<?= base_url('vendor/fontawesome-free/css/all.min.css') ?>" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="<?= base_url('css/sb-admin-2.min.css') ?>" rel="stylesheet">
    <link href="<?= base_url('vendor/datatables/dataTables.bootstrap4.min.css') ?>" rel="stylesheet">

<?php

// check session level if there is no session level back to base_url auth/index

if ($this->session->userdata('level') == '') {
    redirect(base_url('auth/index'));
}

?>

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?= site_url('dashboard') ?>">
                <div class="sidebar-brand-icon">
                <img src="<?= base_url('img/amelia.png') ?>" alt="Amelia" width="50" height="50">
                </div>
                <div class="sidebar-brand-text mx-3">PPDB TK & KB AMELIA</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- session 1 -->
            <?php if ($this->session->userdata('level') == 1): ?>

            <!-- Heading -->
            <div class="sidebar-heading">
    Menu Admin
</div>

<li class="nav-item">
    <a class="nav-link" href="<?= site_url('dashboard'); ?>">
        <i class="fas fa-tachometer-alt"></i>
        <span>Dasbor</span></a>
</li>

<!-- Nav Item - Pages Collapse Menu -->
<li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
        aria-expanded="true" aria-controls="collapseTwo">
        <i class="fas fa-cog"></i>
        <span>Informasi Pembayaran</span>
    </a>
    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
        <a class="collapse-item" href="<?= site_url('pembayaran/indexKategoriBiaya'); ?>">Management Biaya</a>
            <a class="collapse-item" href="<?= site_url('pembayaran/indexFormulirAdmin'); ?>">Formulir</a>
            <a class="collapse-item" href="<?= site_url('pembayaran/indexBMS'); ?>">Biaya Masuk Sekolah</a>
        </div>
    </div>
</li>

<!-- Nav Item - Utilities Collapse Menu -->
<li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
        aria-expanded="true" aria-controls="collapseUtilities">
        <i class="fas fa-wrench"></i>
        <span>Informasi Calon Siswa</span>
    </a>
    <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities"
        data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item" href="<?= site_url('siswa/indexSiswaAdmin'); ?>">Informasi Siswa</a>
            <a class="collapse-item" href="<?= site_url('siswa/indexOrtu'); ?>">Informasi Orang Tua</a>
        </div>
    </div>
</li>

<li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUsers"
        aria-expanded="true" aria-controls="collapseUsers">
        <i class="fas fa-users"></i>
        <span>Informasi Pengguna</span>
    </a>
    <div id="collapseUsers" class="collapse" aria-labelledby="headingUsers"
        data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item" href="<?= site_url('admin'); ?>">Admin</a>
            <a class="collapse-item" href="<?= site_url('pendaftar'); ?>">Pendaftar</a>
        </div>
    </div>
</li>

<li class="nav-item">
    <a class="nav-link" href="index.html">
        <i class="fas fa-sync-alt"></i>
        <span>Reset Data</span></a>
</li>


            <!-- Divider -->
            <hr class="sidebar-divider">
            <?php endif; ?>


            <!-- session 2 -->
            <?php if ($this->session->userdata('level') == 2): ?>


            <!-- Heading -->
            <div class="sidebar-heading">
                Menu User
            </div>

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
    <a class="nav-link" href="<?= site_url('dashboard'); ?>">
        <i class="fas fa-tachometer-alt"></i>
        <span>Dasbor</span></a>
</li>

            <!-- Nav Item - Charts -->
            <li class="nav-item">
    <a class="nav-link" href="<?= site_url('siswa/indexSiswa'); ?>">
        <i class="fas fa-fw fa-chart-area"></i>
        <span>Calon Siswa Baru</span>
    </a>
</li>


            <!-- Nav Item - Tables -->
            <li class="nav-item">
                <a class="nav-link" href="<?= site_url('pembayaran/indexPembayaran'); ?>">
                    <i class="fas fa-fw fa-table"></i>
                    <span>Pembayaran</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">
            <?php endif; ?>


            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">


                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">
    <?php
    $level = $this->session->userdata('level');

    if ($level == 1) {
        echo $this->session->userdata('nama');
    } elseif ($level == 2) {
        echo $this->session->userdata('nama_pendaftar');
    }
    ?>
</span>
                                <img class="img-profile rounded-circle" src="<?= base_url('img/undraw_profile.svg') ?>">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">