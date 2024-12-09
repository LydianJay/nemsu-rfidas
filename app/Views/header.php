<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title><?php echo $app_title; ?></title>


    <!-- Favicons -->
    <link href="<?php echo base_url() . 'niceadmin' ?>/assets/img/favicon.png" rel="icon">
    <link href="<?php echo base_url() . 'niceadmin' ?>/assets/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="<?php echo base_url() . 'niceadmin' ?>/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url() . 'niceadmin' ?>/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="<?php echo base_url() . 'niceadmin' ?>/assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="<?php echo base_url() . 'niceadmin' ?>/assets/vendor/quill/quill.snow.css" rel="stylesheet">
    <link href="<?php echo base_url() . 'niceadmin' ?>/assets/vendor/quill/quill.bubble.css" rel="stylesheet">
    <link href="<?php echo base_url() . 'niceadmin' ?>/assets/vendor/remixicon/remixicon.css" rel="stylesheet">
    <link href="<?php echo base_url() . 'niceadmin' ?>/assets/vendor/simple-datatables/style.css" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="<?php echo base_url() . 'niceadmin' ?>/assets/css/style.css" rel="stylesheet">
    <!-- html2pdf -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js" integrity="sha512-GsLlZN/3F2ErC5ifS5QtgpiJtWd43JWSuIgh7mbzZ8zBps+dvLusV+eNQATqgA/HdeKFVgA5v3S/cIrLF7QnIg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>


    <style>
        tr.clickable {
            cursor: pointer;
        }


        tr.clickable:hover {
            background-color: var(--bs-gray-300);
            transition: background-color 0.525s ease;
        }


        tr.clickable:hover td {
            color: var(--bs-gray-800);
            font-weight: bold;
        }

        td.clickable {
            cursor: pointer;
        }


        td.clickable:hover {
            background-color: var(--bs-gray-300);
            transition: background-color 0.525s ease;
        }


        td.clickable:hover td {
            color: var(--bs-gray-800);
            font-weight: bold;
        }

        td {
            text-align: start;
        }

        th {
            text-align: start;
        }
    </style>

    <!-- =======================================================
  * Template Name: NiceAdmin
  * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
  * Updated: Apr 20 2024 with Bootstrap v5.3.3
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

    <!-- ======= Header ======= -->
    <header id="header" class="header fixed-top d-flex align-items-center">

        <div class="d-flex align-items-center justify-content-between">
            <a href="index.html" class="logo d-flex align-items-center">
                <img src="<?php echo base_url() . 'niceadmin' ?>assets/img/logo.png" alt="">
                <span class="d-none d-lg-block"><?php echo $company_name ?></span>
            </a>
            <i class="bi bi-list toggle-sidebar-btn"></i>
        </div><!-- End Logo -->



    </header><!-- End Header -->

    <!-- ======= Sidebar ======= -->
    <aside id="sidebar" class="sidebar">

        <ul class="sidebar-nav" id="sidebar-nav">


            <?php
            $idx = 0;
            for ($i = 0; $i < count($modules); $i++) {
                $mod = $modules[$i];
                if ($i != $index) {
                    $idx = $i;
                }
            ?>
                <li class="nav-item">
                    <a class="nav-link <?php echo $i != $index ? 'collapsed' : '' ?>" href="<?php echo base_url() . $mod['uri'] ?>">
                        <i class="<?php echo $mod['icon'] ?>"></i>
                        <span><?php echo $mod['title'] ?></span>
                    </a>
                </li>

            <?php }  ?>

            <!-- <li class="nav-item">
                <a class="nav-link collapsed" href="<?php echo base_url() . 'home' ?>">
                    <i class="bi bi-grid"></i>
                    <span>Attendance</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link collapsed" href="<?php echo base_url() . 'home' ?>">
                    <i class="bi bi-grid"></i>
                    <span>Students</span>
                </a>
            </li> -->





            <li class="nav-heading">Admin</li>

            <li class="nav-item">
                <a class="nav-link collapsed" href="<?php echo base_url() . 'indev' ?>">
                    <i class="bi bi-gear-fill"></i>
                    <span>Settings</span>
                </a>
            </li><!-- End Profile Page Nav -->



        </ul>

    </aside><!-- End Sidebar-->

    <main id="main" class="main">

        <div class="pagetitle">
            <h1>RFID Attendance System</h1>

            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?php echo base_url() . 'home' ?>">Home</a></li>
                    <li class="breadcrumb-item active"><?php echo $modules[$i - 1]['title'] ?></li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section">