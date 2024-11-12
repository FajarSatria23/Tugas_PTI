<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Barang</title>
    <!-- CSS -->
    <link href="<?php echo base_url(); ?>assets/css/materialize.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/css/materialize.min.css" rel="stylesheet">
</head>
<body>
    <section id="content">
        <div class="container">
            <div class="section">
                <div class="divider"></div>
                <!-- DataTables example -->
                <div id="table-datatables">
                    <h4 class="header">Data Barang</h4>
                    <hr>
                    <div class="row">
                        <div class="col s12 m8 l12">
                            <table id="data-table-simple" class="responsive-table display" cellspacing="1">
                                <thead>
                                    <tr>
                                        <th>ID Barang</th>
                                        <th>Foto</th>
                                        <th>Nama Barang</th>
                                        <th>Harga</th>
                                        <th>Stok</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($dataBarang as $barang) { ?>
                                        <tr>
                                            <td><?= $barang->idBarang ?></td>
                                            <td><img src="<?php echo base_url('assets/gambar/'.$barang->foto); ?>" width="100" height="100"> </td>
                                            <td><?= $barang->namaBarang ?></td>
                                            <td>Rp <?= number_format($barang->harga, 0, ',', '.') ?></td>
                                            <td><?= $barang->stok ?></td>
                                            <td>
                                                <a href="<?php echo base_url(); ?>barang/kurangStok/<?= $barang->idBarang ?>" title="Kurang" style="color:red" rel="tooltip"><i class="mdi-hardware-keyboard-arrow-left"></i></a>
                                                <a href="<?php echo base_url(); ?>barang/tambahStok/<?= $barang->idBarang ?>" title="Tambah" style="color:blue" rel="tooltip"><i class="mdi-hardware-keyboard-arrow-right"></i></a>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <br>
            </div>
        </div>
    </section>
    <!-- Panggil JavaScript -->
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery-1.11.2.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/materialize.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/materialize.min.js"></script>
</body>
</html>
