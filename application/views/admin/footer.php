<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Footer</title>
</head>
<body>
    <footer>
        <!-- Scripts -->
        <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery-1.11.2.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/materialize.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/perfect-scrollbar/perfect-scrollbar.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/plugins/data-tables/js/jquery.dataTables.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/plugins/data-tables/data-tables-script.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/plugins.js"></script>
        <script>
            $('#alert_close').click(function() {
                $("#alert_box").fadeOut("slow", function() {});
            });
        </script>
    </footer>
</body>
</html>
