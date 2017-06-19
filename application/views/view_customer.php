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
      	
     
	
	<script src="<?php echo base_url();?>assets/client_ids.js"></script>
	<script src="<?php echo base_url();?>assets/src/hello.polyfill.js"></script>
	<script src="<?php echo base_url();?>assets/src/hello.js"></script>
	
	<script src="<?php echo base_url();?>assets/modules/facebook.js"></script>

        <link href="<?php echo base_url();?>css/select2.css" rel="stylesheet" type="text/css" media="screen" />
        <link href="<?php echo base_url();?>css/jquery.dataTables.css" rel="stylesheet" type="text/css" />

        <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/customer/bootstrap.min.css">
        <!-- Template style.css -->
        <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/customer/style.css">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/customer/owl.carousel.css">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/customer/owl.theme.css">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/customer/owl.transitions.css">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/customer/bootstrap-select.min.css">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/customer/hover.css">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/customer/animate.css">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/customer/notification.css">
        <!-- Font used in template -->
        <link href='https://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
        <link href='https://fonts.googleapis.com/css?family=Istok+Web:400,400italic,700,700italic' rel='stylesheet' type='text/css'>
        <!--font awesome icon -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        <!-- favicon icon -->
        <link rel="shortcut icon" href="<?php echo base_url();?>images/lo1go.png" type="image/x-icon">
        <!-- Time  Picker -->
        <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/customer/bootstrap-clockpicker.min.css">
        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js does not work if you view the page via file:// -->
        <!--[if lt IE 9]>
              <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
              <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
              <![endif]-->



    <!-- Add Dropzone -->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/dropzone.css" >

        <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/customer/theme111ba.css?v=20141226-1">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/customer/jquery-ui.css">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/customer/idangerous.swiper.css">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/customer/timeslot.css">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/customer/jquery.share079c.css?v=20141017-1">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/customer/new-home.css">
        <link href="<?php echo base_url();?>css/customer/vitality-red.css" rel="stylesheet" type="text/css">

        <!-- location picker -->
        <link rel="stylesheet" href="<?php echo base_url();?>map/map1/addresspicker/demos/themes/base/jquery.ui.all.css">
        <link rel="stylesheet" href="<?php echo base_url();?>map/map1/addresspicker/demos/demo.css">
        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCXXqwPwNL5lIUMr8uLpmBIEo2ncmIsEsU"></script>

        <script src="<?php echo base_url();?>map/ajax/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
        <script src="<?php echo base_url();?>map/ajax/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
        <script src="<?php echo base_url();?>map/map1/addresspicker/src/jquery.ui.addresspicker.js"></script>
      <script>
        $(function() {
          var addresspicker = $( "#addresspicker" ).addresspicker({
            componentsFilter: 'country:FR'
          });
          var addresspickerMap = $( "#addresspicker_map" ).addresspicker({
            regionBias: "fr",
            updateCallback: showCallback,
            mapOptions: {
              zoom: 5,
              center: new google.maps.LatLng(22.7195687, 75.85772580000003),
              scrollwheel: false,
              mapTypeId: google.maps.MapTypeId.ROADMAP
            },
            elements: {
              map:      "#map",
              lat:      "#lat",
              lng:      "#lng",
              street_number: '#street_number',
              route: '#route',
              locality: '#locality',
              administrative_area_level_2: '#administrative_area_level_2',
              administrative_area_level_1: '#administrative_area_level_1',
              country:  '#country',
              postal_code: '#postal_code',
              type:    '#type'
            }
          });

          var gmarker = addresspickerMap.addresspicker( "marker");
          gmarker.setVisible(true);
          addresspickerMap.addresspicker( "updatePosition");

          $('#reverseGeocode').change(function(){
            $("#addresspicker_map").addresspicker("option", "reverseGeocode", ($(this).val() === 'true'));
          });

          function showCallback(geocodeResult, parsedGeocodeResult){
            $('#callback_result').text(JSON.stringify(parsedGeocodeResult, null, 4));
          }
          // Update zoom field
          var map = $("#addresspicker_map").addresspicker("map");
          google.maps.event.addListener(map, 'idle', function(){
            $('#zoom').val(map.getZoom());
          });

        });
        </script>
        
    <script type="text/javascript" src="<?php echo base_url();?>js/dropzone.js"></script>
    </head>
   <!-- forogt light-box Section End --> 
      <div id="myModal" class="modal fade" role="dialog">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h4 class="modal-title">enter password</h4>
            </div>
            <div class="modal-body">
              <form action="<?php echo base_url(); ?>index.php/CustomerController/location" method="POST">
                <input type="password" value="" name="backup">
                <input type="submit" value="Are you Sure">
              </form>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
          </div>
        </div>
      </div>
      </head>
    <body>
    
        <?php
        include('customer_layout/header.php');
        include('customer_layout/content.php');
        include('customer_layout/footer.php');
        ?><!-- 
        <script src="<?php echo base_url();?>js/customer/jquery.min.js"></script>
        <!-- Include all compiled plugins (below), or include individual files as needed --> 
        <script src="<?php echo base_url();?>js/customer/bootstrap.min.js"></script> 
        <script src="<?php echo base_url();?>js/customer/nav.js"></script> 
        <script src="<?php echo base_url();?>js/customer/bootstrap-select.js"></script> 
        <script src="<?php echo base_url();?>js/customer/owl.carousel.min.js"></script> 
        <script src="<?php echo base_url();?>js/customer/thumbnail-slider.js"></script> 
        <script src="<?php echo base_url();?>js/customer/slider.js"></script> 
        <script src="<?php echo base_url();?>js/customer/testimonial.js"></script> 
        <script src="<?php echo base_url();?>js/customer/jquery.sticky.js"></script> 
        <script src="<?php echo base_url();?>js/customer/header-sticky.js"></script>

        <!-- datatables -->
        <script src="<?php echo base_url();?>js/select2.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url();?>js/jquery.dataTables.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url();?>js/dataTables.tableTools.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url();?>js/datatables.responsive.js"></script>
        <script src="<?php echo base_url();?>js/lodash.min.js"></script>
        <script src="<?php echo base_url();?>js/datatables.js" type="text/javascript"></script>
        <script src="<?php echo base_url();?>js/bootstrap-clockpicker.min.js"></script>
        <!-- Main Map -->
        <script src="<?php echo base_url();?>js/fileinput.js"></script>

        <script>

          <?php if(isset($restaurantdetails) and $restaurantdetails != NULL) { ?>
          var myCenter=new google.maps.LatLng( <?php echo $restaurantdetails->lat; ?>, <?php echo $restaurantdetails->lng; ?>);
          <?php } else { ?>
          var myCenter=new google.maps.LatLng(23.0203458,72.5797426);
          <?php } ?>

          function initialize()
          {
            var mapProp = {
              center:myCenter,
              zoom:12,
              scrollwheel: false,
              mapTypeId:google.maps.MapTypeId.ROADMAP
            };

            var map=new google.maps.Map(document.getElementById("googleMap"),mapProp);

            var marker=new google.maps.Marker({
              position:myCenter,

              icon:'<?php echo base_url();?>images/mapmarker.png'
            });

            marker.setMap(map);
            var infowindow = new google.maps.InfoWindow({
              content:"Hello Address"
            });
          }

          google.maps.event.addDomListener(window, 'load', initialize);
        </script>    
        <script>
      // The following example creates complex markers to indicate beaches near
      // Sydney, NSW, Australia. Note that the anchor is set to (0,32) to correspond
      // to the base of the flagpole.

      function initMap() {
        var map = new google.maps.Map(document.getElementById('googleMap'), {
          zoom: 12,

          <?php if(isset($restaurantdetails) and $restaurantdetails != NULL) { ?>
            center: {lat: <?php echo $restaurantdetails->lat; ?>, lng: <?php echo $restaurantdetails->lng; ?>}
          <?php } else { ?>
            center: {lat: 23.0204883, lng: 72.5097025}
          <?php } ?>
        });

        setMarkers(map);
      }

      // Data for the markers consisting of a name, a LatLng and a zIndex for the
      // order in which these markers should display on top of each other.
      var beaches = [

        ['Florist Vendor', 23.0676033, 72.5735364, 4, 'florist.png'],
        ['Dresses Vendor', 23.0676413, 72.560375, 5, 'dress.png'],
        ['Venue Vendor', 23.0683954, 72.5306521, 3, 'venue.png'],
        ['Venue Vendor', 23.0715393, 72.5849452, 2, 'venue.png'],
        ['Dresses Vendor', 23.0206091, 72.5026789, 1, 'dress.png'],
        ['Photography Vendor', 23.0358085, 72.6200942, 1, 'photography.png'],
        ['Videography Vendor', 22.9748713, 72.5891307, 1, 'videography.png'],
        ['Favour & gift Vendor', 23.1125045, 72.5641729, 1, 'favour-gift.png'],
        ['Music Vendor', 23.1125045, 72.5641729, 1, 'music.png'],
        ['Jwellery Vendor', 23.0384031, 72.5267135, 1, 'jwellery.png'],
        ['Cake Vendor', 23.0028003, 72.5399962, 1, 'cake.png']
        ];

      function setMarkers(map) {
        // Adds markers to the map.

        // Marker sizes are expressed as a Size of X,Y where the origin of the image
        // (0,0) is located in the top left of the image.

        // Origins, anchor positions and coordinates of the marker increase in the X
        // direction to the right and in the Y direction down.
        
        // Shapes define the clickable region of the icon. The type defines an HTML
        // <area> element 'poly' which traces out a polygon as a series of X,Y points.
        // The final coordinate closes the poly by connecting to the first coordinate.
        var shape = {
          coords: [1, 1, 1, 20, 18, 20, 18, 1],
          type: 'poly'
        };
        for (var i = 0; i < beaches.length; i++) {
          var beach = beaches[i];
          var image = {
          url: '<?php echo base_url();?>images/'+beach[4],

          // This marker is 20 pixels wide by 32 pixels high.
          size: new google.maps.Size(32, 49),
          // The origin for this image is (0, 0).
          origin: new google.maps.Point(0, 0),
          // The anchor for this image is the base of the flagpole at (0, 32).
          anchor: new google.maps.Point(0, 49)
        };
        var marker = new google.maps.Marker({
            position: {lat: beach[1], lng: beach[2]},
            map: map,
            icon: image,
            shape: shape,
            title: beach[0],
            zIndex: beach[3]
          });
        var content = "Vendor: " + beach[0];  
        var infowindow = new google.maps.InfoWindow()
        google.maps.event.addListener(marker,'mouseover', (function(marker,content,infowindow){ 
              return function() {
                 infowindow.setContent(content);
                 infowindow.open(map,marker);
              };
          })(marker,content,infowindow));


        }
      }
      </script>
      <script type="text/javascript">
$('.clockpicker').clockpicker()
  .find('input').change(function(){
    console.log(this.value);
  });
var input = $('#single-input').clockpicker({
  placement: 'bottom',
  align: 'left',
  autoclose: true,
  'default': 'now'
});

$('.clockpicker-with-callbacks').clockpicker({
    donetext: 'Done',
    init: function() { 
      console.log("colorpicker initiated");
    },
    beforeShow: function() {
      console.log("before show");
    },
    afterShow: function() {
      console.log("after show");
    },
    beforeHide: function() {
      console.log("before hide");
    },
    afterHide: function() {
      console.log("after hide");
    },
    beforeHourSelect: function() {
      console.log("before hour selected");
    },
    afterHourSelect: function() {
      console.log("after hour selected");
    },
    beforeDone: function() {
      console.log("before done");
    },
    afterDone: function() {
      console.log("after done");
    }
  })
  .find('input').change(function(){
    console.log(this.value);
  });

// Manually toggle to the minutes view
$('#check-minutes').click(function(e){
  // Have to stop propagation here
  e.stopPropagation();
  input.clockpicker('show')
      .clockpicker('toggleView', 'minutes');
});
if (/mobile/i.test(navigator.userAgent)) {
  $('input').prop('readOnly', true);
}
</script>

               
    </body>
</html>
