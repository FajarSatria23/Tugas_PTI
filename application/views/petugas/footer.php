<footer>
    <center>&copy; Copyright <?php echo date('Y'); ?></center>
</footer>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery-1.11.2.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/materialize.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/materialize.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/plugins/data-tables/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/plugins/data-tables/datatables/data-tables-script.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/plugins.js"></script>
<script>
    $(".button-collapse").sideNav();
</script>
<script type="text/javascript">
    $('#alert_close').click(function() {
        $("#alert_box").fadeOut("slow", function() {});
    });
</script>
</body>
</html>
