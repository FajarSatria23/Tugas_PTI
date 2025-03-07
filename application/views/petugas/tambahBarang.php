<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Barang</title>
    <!-- CSS -->
    <link href="<?php echo base_url(); ?>assets/css/materialize.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/css/materialize.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col s12">
                <div class="card-panel">
                    <!-- Alert -->
                    <?php if($this->session->flashdata('info')) { ?>
                        <div class="row" id="alert_box">
                            <div class="col s12 m12">
                                <div class="card green darken-1">
                                    <div class="row">
                                        <div class="col s12 m10">
                                            <div class="card-content white-text center">
                                                <p><?php echo $this->session->flashdata('info') ?></p>
                                            </div>
                                        </div>
                                        <div class="col s12 m2">
                                            <i class="mdi-navigation-close icon_style" id="alert_close" aria-hidden="true"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                    <!-- End Alert -->
                    <h4 class="header2">Tambah Barang</h4>
                    <div class="row">
                        <form class="col s12" method="post" enctype="multipart/form-data" action="<?php echo base_url();?>barang/tambah">
                            <div class="row">
                                <div class="input-field col s1">
                                    <input id="id" type="text" name="id" value="<?= $kodeunik; ?>" readonly>
                                    <label for="id" class="active">ID</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s12">
                                    <input id="namaBarang" type="text" name="namaBarang" required>
                                    <label for="namaBarang">Nama Barang</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s8">
                                    <input id="harga" type="text" name="harga" required>
                                    <label for="harga">Harga</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s1">
                                    <input id="stok" type="text" name="stok" required>
                                    <label for="stok">Stok</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="file-field input-field col s6">
                                    <input class="file-path validate" type="text" placeholder="Foto" readonly required>
                                    <div class="btn blue">
                                        <span>Foto</span>
                                        <input type="file" accept="image/jpeg,image/png,image/JPG" title="Click untuk Foto" name="foto" />
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s12">
                                    <button class="btn blue waves-effect waves-light right" type="submit" name="action">Tambah
                                        <i class="mdi-content-send right"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Panggil JavaScript -->
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery-1.11.2.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/materialize.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/materialize.min.js"></script>
    <script>
        $('#alert_close').click(function() {
            $("#alert_box").fadeOut("slow", function() {});
        });
    </script>
</body>
</html>
