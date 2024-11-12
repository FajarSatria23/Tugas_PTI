<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Petugas</title>
    <!-- Panggil file CSS -->
    <link href="<?php echo base_url(); ?>assets/css/materialize.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/css/materialize.min.css" rel="stylesheet">
</head>
<body>
    <div class="section no-pad-bot" id="index-banner">
        <div class="container">
            <br><br>
            <h1 class="header center black-text">Selamat Bekerja, <?= $petugas->nama ?></h1>
            <br><br>
            <div class="row">
                <div class="col s12 m4">
                    <div class="icon-block">
                        <a href="<?php echo base_url(); ?>barang/">
                            <h2 class="center light-blue-text"><i class="mdi-av-playlist-add" style="font-size: 200px"></i></h2>
                            <h5 class="center">NAMBAH STOK</h5>
                        </a>
                    </div>
                </div>
                <div class="col s12 m4">
                    <div class="icon-block">
                        <a href="<?php echo base_url(); ?>barang/">
                            <h2 class="center light-blue-text"><i class="mdi-content-add" style="font-size: 200px"></i></h2>
                            <h5 class="center">NAMBAH BARANG</h5>
                        </a>
                    </div>
                </div>
                <div class="col s12 m4">
                    <div class="icon-block">
                        <a href="<?php echo base_url(); ?>penjualan/tambahPenjualan">
                            <h2 class="center light-blue-text"><i class="mdi-action-shopping-cart" style="font-size: 200px"></i></h2>
                            <h5 class="center">PENJUALAN</h5>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Panggil file JavaScript -->
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery-1.11.2.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/materialize.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/materialize.min.js"></script>
</body>
</html>
