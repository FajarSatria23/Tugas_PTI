<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Member</title>
    <!-- CSS -->
    <link href="<?php echo base_url(); ?>assets/css/materialize.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/css/materialize.min.css" rel="stylesheet">
</head>
<body>
    <section id="content">
        <div class="container">
            <div class="section">
                <div class="divider"></div>
                <div id="table-datatables">
                    <h4 class="header">Data Member</h4>
                    <hr>
                    <div class="row">
                        <?php if ($this->session->flashdata('info')) { ?>
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
                                                <i class="mdi-content-clear icon_style" id="alert_close" aria-hidden="true"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                        <!-- End Alert -->
                        <div class="col s12 m8 l11">
                            <a href="<?php echo base_url(); ?>member/import" class="btn blue">Import Data Dari Excel<i class="mdi-av-playlist-add right"></i></a>
                            <table id="data-table-simple" class="responsive-table display" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama</th>
                                        <th>Jenis Kelamin</th>
                                        <th>Alamat</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1; foreach ($member as $member) { ?>
                                        <tr>
                                            <td><?= $no ?></td>
                                            <td><?= $member->nama ?></td>
                                            <td><?= $member->jk ?></td>
                                            <td><?= $member->alamat ?></td>
                                            <td>
                                                <a href="<?php echo base_url(); ?>member/hapus/<?= $member->idMember ?>" data-target="modal1" class="modal-trigger" style="color:red" rel="tooltip" title="Hapus"><i class="mdi-action-delete"></i></a>
                                            </td>
                                        </tr>
                                        <?php $no++; } ?>
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
    <script>
        $('#alert_close').click(function() {
            $("#alert_box").fadeOut("slow", function() {});
        });
    </script>
</body>
</html>
