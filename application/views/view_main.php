<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>DesigPop Panel</title>
        <!-- Tell the browser to be responsive to screen width -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <!-- Bootstrap 3.3.5 -->
        <?php
        if ($pageName != "DETAILUSER") {
            ?>
            <link rel="stylesheet" href="bootstrap/<?php echo base_url();?>css/bootstrap.min.css">
            <!-- Font Awesome -->
            <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
            <!-- Ionicons -->
            <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
            <!-- Theme style -->
            <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
            <!-- AdminLTE Skins. Choose a skin from the css/skins
                 folder instead of downloading all of them to reduce the load. -->
            <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">
            <!-- iCheck -->
            <link rel="stylesheet" href="plugins/iCheck/flat/blue.css">
            <!-- Morris chart -->
            <link rel="stylesheet" href="plugins/morris/morris.css">
            <!-- jvectormap -->
            <link rel="stylesheet" href="plugins/jvectormap/jquery-jvectormap-1.2.2.css">
            <!-- Date Picker -->
            <link rel="stylesheet" href="plugins/datepicker/datepicker3.css">
            <!-- Daterange picker -->
            <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker-bs3.css">
            <!-- bootstrap wysihtml5 - text editor -->
            <link rel="stylesheet" href="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">

            <!-- DATEPICKER --> <script src="plugins/datepicker/bootstrap-datepicker.js" type="text/javascript"></script>

            <!-- datepicker --> <link href="plugins/datepicker/datepicker3.css" rel="stylesheet" type="text/css" />







            <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
            <!-- Bootstrap 3.3.5 -->
            <link rel="stylesheet" href="bootstrap/<?php echo base_url();?>css/bootstrap.min.css">
            <!-- Font Awesome -->
            <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
            <!-- Ionicons -->
            <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
            <!-- DataTables -->
            <link rel="stylesheet" href="plugins/datatables/dataTables.bootstrap.css">
            <!-- Theme style -->
            <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
            <!-- AdminLTE Skins. Choose a skin from the css/skins
                 folder instead of downloading all of them to reduce the load. -->
            <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">

            <?php
        } else {
            ?>


            <link rel="stylesheet" href="bootstrap/<?php echo base_url();?>css/bootstrap.min.css">
            <!-- Font Awesome -->
            <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
            <!-- Ionicons -->
            <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
            <!-- daterange picker -->
            <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker-bs3.css">
            <!-- iCheck for checkboxes and radio inputs -->
            <link rel="stylesheet" href="plugins/iCheck/all.css">
            <!-- Bootstrap Color Picker -->
            <link rel="stylesheet" href="plugins/colorpicker/bootstrap-colorpicker.min.css">
            <!-- Bootstrap time Picker -->
            <link rel="stylesheet" href="plugins/timepicker/bootstrap-timepicker.min.css">
            <!-- Select2 -->
            <link rel="stylesheet" href="plugins/select2/select2.min.css">
            <!-- Theme style -->
            <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
            <!-- AdminLTE Skins. Choose a skin from the css/skins
                 folder instead of downloading all of them to reduce the load. -->
            <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">


            <?php
        }
        ?>






    </head>
    <body class="hold-transition skin-blue sidebar-mini">        
        <div class="wrapper">

            <?php
            include('layout/header.php');
            include('layout/sidebar.php');
            include('layout/content.php');
            ?>
        </div>
        <?php
        if ($pageName != "DETAILUSER") {
            ?>
            <!-- jQuery UI 1.11.4 -->
            <script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
            <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
            <script>
                $.widget.bridge('uibutton', $.ui.button);
            </script>
            <!-- Bootstrap 3.3.5 -->
            <script src="bootstrap/js/bootstrap.min.js"></script>
            <!-- Morris.js charts -->
            <script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
            <script src="plugins/morris/morris.min.js"></script>
            <!-- Sparkline -->
            <script src="plugins/sparkline/jquery.sparkline.min.js"></script>
            <!-- jvectormap -->
            <script src="plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
            <script src="plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>

            <!-- jQuery Knob Chart -->


            <!-- Bootstrap WYSIHTML5 -->
            <script src="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
            <!-- Slimscroll -->
            <script src="plugins/slimScroll/jquery.slimscroll.min.js"></script>
            <!-- FastClick -->
            <script src="plugins/fastclick/fastclick.js"></script>
            <!-- AdminLTE App -->
            <script src="dist/js/app.min.js"></script>
            <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
            <script src="dist/js/pages/dashboard.js"></script>
            <!-- AdminLTE for demo purposes -->
            <script src="dist/js/demo.js"></script>
        </body>


        <!-- jQuery 2.2.0 -->
        <script src="plugins/jQuery/jQuery-2.2.0.min.js"></script>
        <!-- Bootstrap 3.3.5 -->
        <script src="bootstrap/js/bootstrap.min.js"></script>
        <!-- DataTables -->
        <script src="plugins/datatables/jquery.dataTables.js"></script>
        <script src="plugins/datatables/dataTables.bootstrap.min.js"></script>
        <!-- SlimScroll -->
        <script src="plugins/slimScroll/jquery.slimscroll.min.js"></script>
        <!-- FastClick -->
        <script src="plugins/fastclick/fastclick.js"></script>
        <!-- AdminLTE App -->
        <script src="dist/js/app.min.js"></script>
        <!-- AdminLTE for demo purposes -->
        <script src="dist/js/demo.js"></script>
        <!-- page script -->
        <script>
                $(function() {
                    $("#example1").DataTable({
						"lengthMenu": [[10, 25, 50], [10, 25, 50]]
					});
                    $('#example2').DataTable({
                        "paging": true,
                        "lengthChange": false,
                        "searching": false,
                        "ordering": true,
                        "info": true,
                        "autoWidth": false
                    });
                });
        </script>
        <?php
    } else {
        ?>
        <!-- jQuery 2.2.0 -->
        <script src="plugins/jQuery/jQuery-2.2.0.min.js"></script>
        <!-- Bootstrap 3.3.5 -->
        <script src="bootstrap/js/bootstrap.min.js"></script>
        <!-- Select2 -->
        <script src="plugins/select2/select2.full.min.js"></script>
        <!-- InputMask -->
        <script src="plugins/input-mask/jquery.inputmask.js"></script>
        <script src="plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
        <script src="/plugins/input-mask/jquery.inputmask.extensions.js"></script>
        <!-- date-range-picker -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.6/moment.min.js"></script>
        <script src="plugins/daterangepicker/daterangepicker.js"></script>
        <!-- bootstrap color picker -->
        <script src="plugins/colorpicker/bootstrap-colorpicker.min.js"></script>
        <!-- bootstrap time picker -->
        <script src="plugins/timepicker/bootstrap-timepicker.min.js"></script>
        <!-- SlimScroll 1.3.0 -->
        <script src="plugins/slimScroll/jquery.slimscroll.min.js"></script>
        <!-- iCheck 1.0.1 -->
        <script src="plugins/iCheck/icheck.min.js"></script>
        <!-- FastClick -->
        <script src="plugins/fastclick/fastclick.js"></script>
        <!-- AdminLTE App -->
        <script src="dist/js/app.min.js"></script>
        <!-- AdminLTE for demo purposes -->
        <script src="dist/js/demo.js"></script>
        <!-- Page script -->
        <script>
                $(function() {
                    //Date range picker with time picker
                    $('#reservationtime').daterangepicker({
                        timePicker: false,
                        format: 'YYYY-MM-DD',
                        singleDatePicker: true, //<==HERE
                    });
                });
        </script>
        <?php
    }
    ?>

</html>

