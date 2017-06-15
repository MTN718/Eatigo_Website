<div id="slider" class="owl-carousel owl-theme slider">
  <div class="item">
    <div class="slider-pic"><img src="<?php echo base_url();?>images/venue-pic-3.jpg" alt="Wedding couple pic"></div>
  </div>
  <div class="item">
    <div class="slider-pic"><img src="<?php echo base_url();?>images/venue-pic.jpg" alt="The Last of us"></div>  </div>
  </div>

  <div class="container venue-header">
    <div class="row venue-head">
      <div class="col-md-12 title"> 
        <h1><?php echo $restaurantdetails->name; ?></h1>
        <p class="location"><i class="fa fa-map-marker"></i><?php echo $restaurantdetails->address; ?></p>
      </div>
      <div class="col-md-8 rating-box">

        <?php $reviews = $restaurantdetails->reviews; 

        $dont_show_button1 = "";
        $dont_show_button2 = "";
        $dont_show_button3 = "";
        $dont_show_button4 = "";
        $dont_show_button5 = "";

        if($reviews == 1){
          $dont_show_button1 = 'show';
        } 
        else if($reviews == 2){
          $dont_show_button2 = "show";
        }
        else if($reviews == 3){
          $dont_show_button3 ="show";
        }
        else if($reviews == 4){
          $dont_show_button4 = "show";
        }
        else if($reviews == 5){
          $dont_show_button5 = "show";
        }
        else if($reviews == 0){
          $dont_show_button6 = "show";
        }
        ?>
        <div class="rating dont_show <?php echo $dont_show_button6 ?>"><i class="fa fa-star-o"></i> <i class="fa fa-star-o"></i> <i class="fa fa-star-o"></i> <i class="fa fa-star-o"></i> <i class="fa fa-star-o"></i></div>

        <div class="rating dont_show <?php echo $dont_show_button1 ?>"><i class="fa fa-star"></i> <i class="fa fa-star-o"></i> <i class="fa fa-star-o"></i> <i class="fa fa-star-o"></i> <i class="fa fa-star-o"></i></div>

        <div class="rating dont_show <?php echo $dont_show_button2 ?>"><i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star-o"></i> <i class="fa fa-star-o"></i> <i class="fa fa-star-o"></i></div>

        <div class="rating dont_show <?php echo $dont_show_button3 ?>"><i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star-o"></i> <i class="fa fa-star-o"></i></div>

        <div class="rating dont_show <?php echo $dont_show_button4 ?>"><i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star-o"></i></div>

        <div class="rating dont_show <?php echo $dont_show_button5 ?>"><i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i></div>

      </div>
      <div class="col-md-4 venue-action"> <a href="#googleMap" class="btn tp-btn-primary findhover"  style="background-color: #8E203E">VIEW MAP</a> <a href="#inquiry" class="btn tp-btn-default findhover"  style="background-color: #8E203E">Book Venue</a> </div>
    </div>
  </div>
  <div class="main-container">
    <div class="container">
      <div class="row">
        <div class="col-md-8 page-description">
         <div class="container-fluid">
          <div class="row st-tabs woo-product-tabs"> 
            <!-- Nav tabs -->
            <ul class="nav nav-tabs" role="tablist">
              <li role="presentation" class="<?php if( $active == 1) echo "active"; ?>"><a href="#recentproducts" aria-controls="recentproducts" role="tab" data-toggle="tab">Details</a></li>
              <li role="presentation" class="<?php if( $active == 2) echo "active"; ?>"><a href="#toprated" aria-controls="toprated" role="tab" data-toggle="tab">Reviews </a></li>
              <li role="presentation" class="<?php if( $active == 2) echo "active"; ?>"><a href="#photos" aria-controls="toprated" role="tab" data-toggle="tab">Photos </a></li>
            </ul>
            <!-- Tab panes -->
            <div class="tab-content">
              <div role="tabpanel" class="tab-pane fade <?php if( $active == 1) echo "in active"; ?>" id="recentproducts">                  
               <div class="venue-details" style="padding:15px;">
                <p><?php echo $restaurantdetails->about; ?></p>
              </div>
            </div>

              <div role="tabpanel" class="tab-pane fade" id="photos">                  
               <div class="venue-details" style="padding:15px;">
                <p><?php echo $restaurantdetails->about; ?></p>
              </div>
            </div>

            <div role="tabpanel" class="tab-pane fade <?php if( $active == 2) echo "in active"; ?>" id="toprated">
              <div class="row" style="padding-top: 16px;">
                <div class="col-md-12">
                  <div class="review-list"> 
                    <!-- First Comment -->
                    <?php if (isset($restaurantreviews) and $restaurantreviews != NULL) { 
                      foreach ($restaurantreviews as $restaurantreview) {
                        $user = $this->db->get_where('tbl_user', array('no' => $restaurantreview->uid))->row();
                        ?>
                        <div class="row">
                          <div class="col-md-2 col-sm-2 hidden-xs">
                            <div class="user-pic"> <img class="img-responsive img-circle" src="<?php echo base_url();?>images/userpic.jpg" alt=""> </div>
                          </div>
                          <div class="col-md-10 col-sm-10">
                            <div class="panel panel-default arrow left">
                              <div class="panel-body">
                                <div class="text-left">
                                  <h3><?php echo $restaurantreview->title; ?></h3>
                                  <?php $reviews = $restaurantreview->rating; 
                                  $dont_show_button1 = "";
                                  $dont_show_button2 = "";
                                  $dont_show_button3 = "";
                                  $dont_show_button4 = "";
                                  $dont_show_button5 = "";

                                  if($reviews == 1){
                                    $dont_show_button1 = 'show';
                                  } 
                                  else if($reviews == 2){
                                    $dont_show_button2 = "show";
                                  }
                                  else if($reviews == 3){
                                    $dont_show_button3 ="show";
                                  }
                                  else if($reviews == 4){
                                    $dont_show_button4 = "show";
                                  }
                                  else if($reviews == 5){
                                    $dont_show_button5 = "show";
                                  }
                                  ?>
                                  <div class="rating dont_show <?php echo $dont_show_button1 ?>"><i class="fa fa-star"></i> <i class="fa fa-star-o"></i> <i class="fa fa-star-o"></i> <i class="fa fa-star-o"></i> <i class="fa fa-star-o"></i></div>
                                  <div class="rating dont_show <?php echo $dont_show_button2 ?>"><i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star-o"></i> <i class="fa fa-star-o"></i> <i class="fa fa-star-o"></i></div>
                                  <div class="rating dont_show <?php echo $dont_show_button3 ?>"><i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star-o"></i> <i class="fa fa-star-o"></i></div>
                                  <div class="rating dont_show <?php echo $dont_show_button4 ?>"><i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star-o"></i></div>
                                  <div class="rating dont_show <?php echo $dont_show_button5 ?>"><i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i></div>                               </div>
                                  <div class="review-post">
                                    <p> <?php echo $restaurantreview->content; ?></p>
                                  </div>
                                  <div class="review-user">
                                    By <span style="color:#8E203E; font-weight: 600;"><?php echo $user->name; ?></span>, 
                                    on <span class="review-date"><i class="fa fa-calendar-check-o"></i></span>
                                    <strong><?php echo $date = date('M',strtotime($restaurantreview->createdate)); ?></strong>
                                    <span style="color:#8E203E; font-weight: 600;"> <?php echo $date = date('d,',strtotime($restaurantreview->createdate)); ?></span>
                                    <?php echo $date = date('Y',strtotime($restaurantreview->createdate)); ?>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                          <?php }
                        } else { echo "No reviews Now";}
                        ?>
                      </div>


                      <?php if ($this->session->userdata('customer_login') == 1 ) { ?>
                      <div class="review">
                        <a class="btn tp-btn-primary btn-block tp-btn-lg findhover" role="button" data-toggle="collapse" href="#review" aria-expanded="false" aria-controls="review"  style="background-color: #8E203E"> Write A Review </a> 
                      </div>
                      <?php } ?>
                        <div class="collapse review-list review-form" id="review">
                          <div class="panel panel-default">
                            <div class="panel-body">
                              <h1>Write Your Review</h1>
                              <form action="<?php echo base_url();?>index.php/CustomerController/add_review" method="post" enctype="multipart/form-data">                              
                                <input type="hidden" name="restaurant" value="<?php echo $restaurantreview->rid; ?>">                            

                                <div class="form-group col-md-12 no-padding">
                                  <label class=" control-label" for="reviewtitle">Rating<span class="required">*</span></label>
                                  <div class="rating-group">
                                    <div class="radio radio-success radio-inline">
                                      <input type="radio" name="radio1" id="radio1" value="1" checked="">
                                      <label for="radio1" class="radio-inline"> <span class="rating"><i class="fa fa-star"></i></span> </label>
                                    </div>
                                    <div class="radio radio-success radio-inline">
                                      <input type="radio" name="radio1" id="radio2" value="2">
                                      <label for="radio2" class="radio-inline"> <span class="rating"><i class="fa fa-star"></i><i class="fa fa-star"></i></span> </label>
                                    </div>
                                    <div class="radio radio-success radio-inline">
                                      <input type="radio" name="radio1" id="radio3" value="3">
                                      <label for="radio3" class="radio-inline"> <span class="rating"><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i></span> </label>
                                    </div>
                                    <div class="radio radio-success radio-inline">
                                      <input type="radio" name="radio1" id="radio4" value="4">
                                      <label for="radio4" class="radio-inline"> <span class="rating"><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i></span> </label>
                                    </div>
                                    <div class="radio radio-success radio-inline">
                                      <input type="radio" name="radio1" id="radio5" value="5">
                                      <label for="radio5" class="radio-inline"> <span class="rating"><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i></span> </label>
                                    </div>
                                  </div>
                                </div> 

                                <!-- Text input-->
                                <div class="form-group">
                                  <label class=" control-label" for="reviewtitle">Review Title</label>
                                  <div class=" ">
                                    <input id="reviewtitle" name="title" type="text" placeholder="Review Title" class="form-control input-md" required>
                                  </div>
                                </div>
                                
                                <!-- Textarea -->
                                <div class="form-group">
                                  <label class=" control-label">Write Review</label>
                                  <div class="">
                                    <textarea class="form-control" name="review" rows="8">Write Review</textarea>
                                  </div>
                                </div>
                                <!-- Button -->
                                <div class="form-group">
                                  <button name="submit" class="btn tp-btn-default tp-btn-lg">Submit Review</button>
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










          </div>
          <div class="col-md-4 page-sidebar">
            <div class="row">

              <div class="col-md-12" >
                <div class="well-box" id="inquiry">
                  <h2>Enter Reservations Details</h2>
                  <!-- <p>Fill in your details and a Venue Specialist will get back to you shortly.</p> -->
                  <form class="" action="<?php echo base_url();?>index.php/CustomerController/booking">

                    <!-- Text input-->
                    <div class="form-group">
                      <label class="control-label" for="name-one">Name:<span class="required">*</span></label>
                      <div class="">
                        <input id="name-one" name="name" type="text" placeholder="Name" class="form-control input-md" required>
                      </div>
                    </div>

                    <!-- Text input-->
                    <div class="form-group">
                      <label class="control-label" for="phone">Phone:<span class="required">*</span></label>
                      <div class="">
                        <input id="phone" name="phone" type="text" placeholder="Phone" class="form-control input-md" required>
                        <span class="help-block"> </span> </div>
                      </div>


                      <div class="form-group">
                        <label class="control-label" for="guest">Pick your Time / Discount<span class="required">*</span></label>
                        <div class="">
                          <select id="guest" name="guest" class="form-control">
                            <option value="35 to 50"><a href="restaurant/name/ten-yuu-grand-sathon/index84e6.html?date=2017-06-06&amp;time=15.30"
                              class="swiper-slide red-slide">
                              <div class="home-slot-time normal-font font-weight-bold">
                                15:30
                              </div>
                              <div class="home-slot-discount">
                                <h1 class="font-weight-bold">
                                  <span>-</span>50</h1>
                                </div>
                                <div class="home-slot-discount-pc">
                                  %
                                </div>
                                <div class="home-slot-off">
                                  off
                                </div>
                              </a></option>
                              <option value="50  to 65"><a href="restaurant/name/ten-yuu-grand-sathon/index84e6.html?date=2017-06-06&amp;time=15.30"
                                class="swiper-slide red-slide">
                                <div class="home-slot-time normal-font font-weight-bold">
                                  15:30
                                </div>
                                <div class="home-slot-discount">
                                  <h1 class="font-weight-bold">
                                    <span>-</span>50</h1>
                                  </div>
                                  <div class="home-slot-discount-pc">
                                    %
                                  </div>
                                  <div class="home-slot-off">
                                    off
                                  </div>
                                </a></option>
                                <option value="65 to 85"><a href="restaurant/name/ten-yuu-grand-sathon/index84e6.html?date=2017-06-06&amp;time=15.30"
                                  class="swiper-slide red-slide">
                                  <div class="home-slot-time normal-font font-weight-bold">
                                    15:30
                                  </div>
                                  <div class="home-slot-discount">
                                    <h1 class="font-weight-bold">
                                      <span>-</span>50</h1>
                                    </div>
                                    <div class="home-slot-discount-pc">
                                      %
                                    </div>
                                    <div class="home-slot-off">
                                      off
                                    </div>
                                  </a></option>
                                  <option value="85 to 105"><a href="restaurant/name/ten-yuu-grand-sathon/index84e6.html?date=2017-06-06&amp;time=15.30"
                                    class="swiper-slide red-slide">
                                    <div class="home-slot-time normal-font font-weight-bold">
                                      15:30
                                    </div>
                                    <div class="home-slot-discount">
                                      <h1 class="font-weight-bold">
                                        <span>-</span>50</h1>
                                      </div>
                                      <div class="home-slot-discount-pc">
                                        %
                                      </div>
                                      <div class="home-slot-off">
                                        off
                                      </div>
                                    </a></option>
                                  </select>
                                </div>
                              </div>


                              <!-- Select Basic -->
                              <div class="form-group col-md-4 no-padding">
                                <label class="control-label" for="date">Date:</label>
                                <div class="">
                                  <select id="date" name="date" class="form-control">
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                    <option value="6">6</option>
                                    <option value="7">7</option>
                                    <option value="8">8</option>
                                    <option value="9">9</option>
                                    <option value="10">10</option>
                                  </select>
                                </div>
                              </div>
                              <div class="form-group col-md-4 no-padding">
                                <label class="control-label" for="month">Month:</label>
                                <div class="">
                                  <select id="month" name="month" class="form-control">
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                    <option value="6">6</option>
                                    <option value="7">7</option>
                                    <option value="8">8</option>
                                    <option value="9">9</option>
                                    <option value="10">10</option>
                                    <option value="11">11</option>
                                    <option value="12">12</option>
                                  </select>
                                </div>
                              </div>
                              <div class="form-group col-md-4 no-padding">
                                <label class="control-label" for="year">Year:</label>
                                <div class="">
                                  <select id="year" name="year" class="form-control">
                                    <option value="1">2016</option>
                                    <option value="2">2017</option>
                                    <option value="3">2018</option>
                                    <option value="4">2019</option>
                                    <option value="5">2020</option>
                                  </select>
                                </div>
                              </div>
                              <div class="form-group">
                                <label class="control-label" for="guest">Number of Guests:<span class="required">*</span></label>
                                <div class="">
                                  <select id="guest" name="guest" class="form-control">
                                    <option value="35 to 50">35 to 50</option>
                                    <option value="50  to 65">50  to 65</option>
                                    <option value="65 to 85">65 to 85</option>
                                    <option value="85 to 105">85 to 105</option>
                                  </select>
                                </div>
                              </div>
                              <!-- Multiple Radios -->
                              <!-- <div class="form-group">
                                <label class="control-label">Send me info via</label>
                                <div class="checkbox checkbox-success">
                                  <input type="checkbox" name="checkbox" id="checkbox-0" value="1"   class="styled">
                                  <label for="checkbox-0" class="control-label"> E-Mail </label>
                                </div>
                                <div class="checkbox checkbox-success">
                                  <input type="checkbox" name="checkbox" id="checkbox-1" value="2" class="styled" >
                                  <label for="checkbox-1" class="control-label"> Need Call back </label>
                                </div>
                              </div> -->
                              <div class="form-group">
                                <?php if ($this->session->userdata('customer_login') == 1 ) { ?>
                                  <button name="submit" class="btn tp-btn-default tp-btn-lg btn-block findhover" style="background-color: #8E203E">Book MY Venue now</button>
                                <?php } else { ?>
                                  <a href="<?php echo base_url(); ?>index.php/LoginController/logout" class="btn tp-btn-default tp-btn-lg btn-block findhover" style="background-color: #8E203E">Please Login</a>  
                                <?php } ?>
                              </div>
                            </form>
                          </div>
                        </div>

                        <!-- <div class="col-md-12 ">
                          <div class="social-sidebar side-box">
                            <ul class="listnone follow-icon">
                              <li><a href="#"><i class="fa fa-facebook-square"></i></a></li>
                              <li><a href="#"><i class="fa fa-google-plus-square"></i></a></li>
                              <li><a href="#"><i class="fa fa-instagram"></i></a></li>
                              <li><a href="#"><i class="fa fa-flickr"></i></a></li>
                              <li><a href="#"><i class="fa fa-youtube-square"></i></a></li>
                              <li><a href="#"><i class="fa fa-twitter-square"></i></a></li>
                            </ul>
                          </div>
                        </div> -->
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <script src="<?php echo base_url();?>js/customer/jquery.min.js"></script>

              <div id="googleMap" class="map"></div>

