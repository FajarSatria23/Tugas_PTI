<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Petugas</title>
    <!-- CSS -->
    <link href="<?php echo base_url(); ?>assets/css/materialize.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/css/materialize.min.css" rel="stylesheet">
</head>
<body>
    <section id="content">
        <div class="container">
            <div class="section">
                <div class="divider"></div>
                <!-- Basic Form -->
                <div id="basic-form" class="section">
                    <div id="table-datatables">
                        <h4 class="header">Tambah Petugas</h4>
                        <hr>
                        <div class="row">
                            <div class="col s12 m12 l12">
                                <div class="card-panel">
                                    <div class="row">
                                        <form class="col s12" action="<?php echo base_url();?>petugas/tambah" method="POST">
                                            <div class="row">
                                                <div class="input-field col s1">
                                                    <input id="idPetugas" name="idPetugas" type="text" value="<?= $kodeunik ?>" required readonly>
                                                    <label for="idPetugas" class="active">ID</label>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="input-field col s12">
                                                    <input id="nama" name="nama" type="text" required>
                                                    <label for="nama">Nama Petugas</label>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="input-field col s12">
                                                    <input id="email" name="email" type="email" required>
                                                    <label for="email">Email</label>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="input-field col s12">
                                                    <input id="password" name="password" type="password" required>
                                                    <label for="password">Password</label>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="input-field col s12">
                                                    <button class="btn cyan waves-effect waves-light" type="submit" name="action">Tambah
                                                        <i class="mdi-content-send right"></i>
                                                    </button>
                                                    <a href="<?php echo base_url()?>petugas/dataPetugas" class="btn red waves-effect waves-light right">Batal
                                                        <i class="mdi-content-undo right"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Panggil JavaScript -->
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery-1.11.2.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/materialize.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/materialize.min.js"></script>
</body>
</html>
