<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Petugas</title>
    <!-- Panggil file CSS -->
    <link href="<?php echo base_url(); ?>assets/css/materialize.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/js/plugins/dataTables/css/jquery.dataTables.min.css" rel="stylesheet">
    <style type="text/css">
        .icon_style {
            position: absolute;
            right: 10px;
            top: 10px;
            font-size: 20px;
            color: white;
            cursor: pointer;
        }
    </style>
</head>
<body>
<!-- Dropdown Structure -->
<ul id="dropdown1" class="dropdown-content">
    <li><a href="<?php echo base_url(); ?>barang/barang">Barang</a></li>
    <li class="divider"></li>
    <li><a href="<?php echo base_url(); ?>penjualan/penjualan">Penjualan</a></li>
</ul>
<ul id="dropdown2" class="dropdown-content">
    <li><a href="<?php echo base_url(); ?>petugas/profil">Profil</a></li>
    <li class="divider"></li>
    <li><a href="<?php echo base_url(); ?>login/logout">Logout</a></li>
</ul>
<nav class="blue">
    <div class="nav-wrapper container">
        <a href="<?php echo base_url(); ?>" class="brand-logo">XYZ</a>
        <a href="#" data-activates="mobile-demo" class="button-collapse"><i class="mdi-action-view-headline"></i></a>
        <ul class="right hide-on-med-and-down">
            <li><a href="<?php echo base_url(); ?>petugas"><i class="mdi-action-home" style='font-size: 40px'></i></a></li>
            <li><a class="dropdown-button" href="#!" data-activates="dropdown1"><i class="mdi-editor-format-list-bulleted" style='font-size: 40px'></i></a></li>
            <li><a class="dropdown-button" href="#!" data-activates="dropdown2"><i class="mdi-action-settings" style='font-size: 40px'></i></a></li>
        </ul>
        <ul class="side-nav" id="mobile-demo">
            <li><a href="<?php echo base_url(); ?>petugas"><i class="mdi-action-home" style='font-size: 30px'>Home</i></a></li>
            <li class="divider"></li>
            <li><a href="<?php echo base_url(); ?>barang"><i class="mdi-editor-format-list-bulleted" style='font-size: 30px'>Barang</i></a></li>
            <li><a href="<?php echo base_url(); ?>penjualan/penjualan"><i class="mdi-editor-format-list-bulleted" style='font-size: 30px'>Penjualan</i></a></li>
            <li class="divider"></li>
            <li><a href="<?php echo base_url(); ?>petugas/profil"><i class="mdi-action-face-unlock" style='font-size: 30px'>Profil</i></a></li>
            <li><a href="<?php echo base_url(); ?>login/logout"><i class="mdi-hardware-keyboard-tab" style='font-size: 30px'>Logout</i></a></li>
        </ul>
    </div>
</nav>
