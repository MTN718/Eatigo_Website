<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
        <meta property="al:web:url" content="index.html"/>
        <meta property="al:web:should_fallback" content="true"/>
        <meta property="og:type" content="website"/>
        <meta name="robots" content="All"/>
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <title>Burped</title>
        <!-- Bootstrap -->
        <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/customer/bootstrap.min.css">
        <!-- Template style.css -->
        <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/customer/style.css">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/customer/owl.carousel.css">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/customer/owl.theme.css">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/customer/owl.transitions.css">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/customer/bootstrap-select.min.css">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/customer/hover.css">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/customer/animate.css">
        <!-- Font used in template -->
        <link href='https://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
        <link href='https://fonts.googleapis.com/css?family=Istok+Web:400,400italic,700,700italic' rel='stylesheet' type='text/css'>
        <!--font awesome icon -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        <!-- favicon icon -->
        <link rel="shortcut icon" href="<?php echo base_url();?>images/lo1go.png" type="image/x-icon">

        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
              <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
              <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
              <![endif]-->

        <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/customer/theme111ba.css?v=20141226-1">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/customer/jquery-ui.css">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/customer/idangerous.swiper.css">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/customer/timeslot.css">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/customer/jquery.share079c.css?v=20141017-1">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/customer/new-home.css">
        <link href="<?php echo base_url();?>css/customer/vitality-red.css" rel="stylesheet" type="text/css">
    </head>
    <body>
        <?php
        include('customer_layout/header.php');
        include('customer_layout/content.php');
        include('customer_layout/footer.php');
        ?>
        <script src="<?php echo base_url();?>js/customer/jquery.min.js"></script> 
        <!-- Include all compiled plugins (below), or include individual files as needed --> 
        <script src="<?php echo base_url();?>js/customer/bootstrap.min.js"></script> 
        <script src="<?php echo base_url();?>js/customer/nav.js"></script> 
        <script src="<?php echo base_url();?>js/customer/bootstrap-select.js"></script> 
        <script src="<?php echo base_url();?>js/customer/owl.carousel.min.js"></script> 
        <script src="<?php echo base_url();?>js/customer/slider.js"></script> 
        <script src="<?php echo base_url();?>js/customer/testimonial.js"></script> 
        <script src="<?php echo base_url();?>js/customer/jquery.sticky.js"></script> 
        <script src="<?php echo base_url();?>js/customer/header-sticky.js"></script>
        <script>
    var myCenter=new google.maps.LatLng(23.0203458,72.5797426);

    function initialize()
    {
      var mapProp = {
        center:myCenter,
        zoom:9,
        scrollwheel: false,
        mapTypeId:google.maps.MapTypeId.ROADMAP
      };

      var map=new google.maps.Map(document.getElementById("googleMap"),mapProp);

      var marker=new google.maps.Marker({
        position:myCenter,

        icon:'images/pinkball.png'
      });

      marker.setMap(map);
      var infowindow = new google.maps.InfoWindow({
        content:"Hello Address"
      });
    }

    google.maps.event.addDomListener(window, 'load', initialize);
  </script>
    </body>
</html>
