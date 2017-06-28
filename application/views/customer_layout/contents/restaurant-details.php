<div id="slider" class="owl-carousel owl-theme slider">


    <?php
    if (isset($restaurantimages) and $restaurantimages != NULL) {
        foreach ($restaurantimages as $restaurantimage) {
            ?>
            <div class="item">
                <div class="slider-pic"><img src="<?php echo base_url(); ?><?php echo $restaurantimage->image; ?>" alt="Restauant pic"></div>
            </div>
            <?php
        }
    } else {
        ?>   
        <div class="item">
            <div class="slider-pic"><img src="http://placehold.it/600x250" alt="Restauant pic"></div>
        </div>                         
    <?php } ?>



</div>

<div class="container venue-header">
    <div class="row venue-head">
        <div class="col-md-12 title"> 
            <h1><?php echo $restaurantdetails->name; ?></h1>
            <p class="location"><i class="fa fa-map-marker"></i><?php echo $restaurantdetails->address; ?></p>
        </div>
        <div class="col-md-8 rating-box">
            <div class="rating">
                <?php for ($i = 0; $i < $mainrating; $i++) { ?>
                    <i class="fa fa-star"></i> 
                <?php } ?> 
                <?php for ($j = 0; $j < 5 - $mainrating; $j++) { ?>
                    <i class="fa fa-star-o"></i>  
                <?php } ?>   
                <label style="color:#ffffff;">( <?php echo $restaurantdetails->reviews;?> )</label>
            </div>            
        </div>
        <div class="col-md-4 venue-action"> <a href="#googleMap" class="btn tp-btn-primary findhover"  style="background-color: #8E203E">VIEW MAP</a> <a href="#inquiry" class="btn tp-btn-default findhover"  style="background-color: #8E203E">Book Restaurant</a> </div>
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
                            <li role="presentation" class="<?php if ($active == 1) echo "active"; ?>"><a href="#recentproducts" aria-controls="recentproducts" role="tab" data-toggle="tab">Details</a></li>
                            <li role="presentation" class="<?php if ($active == 2 || $active == 4) echo "active"; ?>"><a href="#toprated" aria-controls="toprated" role="tab" data-toggle="tab">Reviews </a></li>
                            <li role="presentation" class="<?php if ($active == 3) echo "active"; ?>"><a href="#photo" aria-controls="toprated" role="tab" data-toggle="tab">Photos </a></li>
                        </ul>
                        <!-- Tab panes -->
                        <div class="tab-content">
                            <div role="tabpanel" class="tab-pane fade <?php if ($active == 1) echo "in active"; ?>" id="recentproducts">                  
                                <div class="venue-details" style="padding:15px;">
                                    <label>About Us</label>
                                    <p><?php echo $restaurantdetails->about; ?></p>
                                    <hr>
                                    <label>Restaurant Languages</label>
                                    <p>
                                        <?php
                                        $languages_id = $this->db->get_where('tbl_map_language_restaurant', array('rid' => $restaurantdetails->no))->result();
                                        if (isset($languages_id) and $languages_id != NULL) {
                                            foreach ($languages_id as $l_id) {
                                                $language = $this->db->get_where('tbl_base_language', array('no' => $l_id->lid))->row();
                                                echo $language->name . "  ";
                                            }
                                        }
                                        ?>
                                    </p>
                                    <hr>
                                    <label>Restaurant Timing</label>
                                    <p> 
                                            <?php if(isset($restaurantdetails->mon_starttime) and $restaurantdetails->mon_starttime != NULL) { ?>
                                            <span class="col-md-4 no-padding">Monday</span>
                                            <span class="col-md-4 no-padding" > Open Time <i class="fa fa-clock-o"></i> <?php echo $restaurantdetails->mon_starttime;?></span>
                                            <span class="col-md-4 no-padding" > close Time <i class="fa fa-clock-o"></i> <?php echo $restaurantdetails->mon_endtime;?></span>
                                            <br>
                                            <?php } ?>
                                            <?php if(isset($restaurantdetails->tue_starttime) and $restaurantdetails->tue_starttime != NULL) { ?>
                                            <span class="col-md-4 no-padding">Tuesday</span>
                                            <span class="col-md-4 no-padding" > Open Time <i class="fa fa-clock-o"></i> <?php echo $restaurantdetails->tue_starttime;?></span>
                                            <span class="col-md-4 no-padding" > close Time <i class="fa fa-clock-o"></i> <?php echo $restaurantdetails->tue_endtime;?></span>
                                            <br>
                                            <?php } ?>
                                            <?php if(isset($restaurantdetails->wed_starttime) and $restaurantdetails->wed_starttime != NULL) { ?>
                                            <span class="col-md-4 no-padding">Wednesday</span>
                                            <span class="col-md-4 no-padding" > Open Time <i class="fa fa-clock-o"></i> <?php echo $restaurantdetails->wed_starttime;?></span>
                                            <span class="col-md-4 no-padding" > close Time <i class="fa fa-clock-o"></i> <?php echo $restaurantdetails->wed_endtime;?></span>
                                            <br>
                                            <?php } ?>
                                            <?php if(isset($restaurantdetails->thu_starttime) and $restaurantdetails->thu_starttime != NULL) { ?>
                                            <span class="col-md-4 no-padding">Thusday </span>
                                            <span class="col-md-4 no-padding" > Open Time <i class="fa fa-clock-o"></i> <?php echo $restaurantdetails->thu_starttime;?></span>
                                            <span class="col-md-4 no-padding" > close Time <i class="fa fa-clock-o"></i> <?php echo $restaurantdetails->thu_endtime;?></span>
                                            <br>
                                            <?php } ?>
                                            <?php if(isset($restaurantdetails->fri_starttime) and $restaurantdetails->fri_starttime != NULL) { ?>
                                            <span class="col-md-4 no-padding">Friday</span>
                                            <span class="col-md-4 no-padding" > Open Time <i class="fa fa-clock-o"></i> <?php echo $restaurantdetails->fri_starttime;?></span>
                                            <span class="col-md-4 no-padding" > close Time <i class="fa fa-clock-o"></i> <?php echo $restaurantdetails->fri_endtime;?></span>
                                            <br>
                                            <?php } ?>
                                            <?php if(isset($restaurantdetails->sat_starttime) and $restaurantdetails->sat_starttime != NULL) { ?>
                                            <span class="col-md-4 no-padding">Saturday</span>
                                            <span class="col-md-4 no-padding" > Open Time <i class="fa fa-clock-o"></i> <?php echo $restaurantdetails->sat_starttime;?></span>
                                            <span class="col-md-4 no-padding" > close Time <i class="fa fa-clock-o"></i> <?php echo $restaurantdetails->sat_endtime;?></span>
                                            <br>
                                            <?php } ?>
                                            <?php if(isset($restaurantdetails->sun_starttime) and $restaurantdetails->sun_starttime != NULL) { ?>
                                            <span class="col-md-4 no-padding">Sunday</span>
                                            <span class="col-md-4 no-padding" > Open Time <i class="fa fa-clock-o"></i> <?php echo $restaurantdetails->sun_starttime;?></span>
                                            <span class="col-md-4 no-padding" > close Time <i class="fa fa-clock-o"></i> <?php echo $restaurantdetails->sun_endtime;?></span>
                                            <br> 
                                            <?php } ?>

                                    </p>
                                </div>
                            </div>

                            <div role="tabpanel" class="tab-pane fade <?php if ($active == 3) echo "in active"; ?>" id="photo" style="padding: 16px 0 8px 0;">              
                                <div id="sync1" class="owl-carousel">
                                    <?php
                                    if (isset($restaurantimages) and $restaurantimages != NULL) {
                                        foreach ($restaurantimages as $restaurantimage) {
                                            ?>
                                            <div class="item"> <img src="<?php echo base_url(); ?><?php echo $restaurantimage->image; ?>" alt="" class="img-responsive" style="height:400px; width:100%;"> </div>
                                            <?php
                                        }
                                    } else {
                                        echo "No Photos Now";
                                    }
                                    ?>
                                </div>
                                <div id="sync2" class="owl-carousel">
                                    <?php
                                    if (isset($restaurantimages) and $restaurantimages != NULL) {
                                        foreach ($restaurantimages as $restaurantimage) {
                                            ?>
                                            <div class="item"> <img src="<?php echo base_url(); ?><?php echo $restaurantimage->image; ?>" alt="" class="img-responsive" style="height:95px; width:100%;"> </div>
                                            <?php
                                        }
                                    } else {
                                        echo "No Photos Now";
                                    }
                                    ?>
                                </div>
                            </div>

                            <div role="tabpanel" class="tab-pane fade <?php if ($active == 4) echo "in active"; ?>" id="photo" style="padding: 16px 0 8px 0;">              
                                <div class="panel panel-default">
                                    <div class="panel-body">
                                        <h1>Write Your Review</h1>
                                        <form action="<?php echo base_url(); ?>index.php/CustomerController/add_review" method="post" enctype="multipart/form-data">                              
                                            <input type="hidden" name="restaurant" value="<?php echo $restaurantdetails->no; ?>">                            

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

                            <div role="tabpanel" class="tab-pane fade <?php if ($active == 2) echo "in active"; ?>" id="toprated">
                                <div class="row" style="padding-top: 16px;">
                                    <div class="col-md-12">
                                        <div class="review-list" style="padding:10px"> 
                                            <!-- First Comment -->
                                            <?php
                                            if (isset($restaurantreviews) and $restaurantreviews != NULL) {
                                                foreach ($restaurantreviews as $restaurantreview) {
                                                    $user = $this->db->get_where('tbl_user', array('no' => $restaurantreview->uid))->row();
                                                    ?>
                                                    <div class="row">
                                                        <div class="col-md-2 col-sm-2 hidden-xs">
                                                            <div class="user-pic"> 
                                                                <?php if (isset($user) and $user->image != NULL) { ?>
                                                                    <img  class="img-responsive img-circle" src="<?php echo base_url(); ?><?php echo $user->image; ?>" alt="">
                                                                <?php } else { ?> 
                                                                    <img src="http://placehold.it/100x100" alt="">                           
                                                                <?php } ?>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-10 col-sm-10">
                                                            <div class="panel panel-default arrow left">
                                                                <div class="panel-body">
                                                                    <div class="text-left">
                                                                        <h3><?php echo $restaurantreview->title; ?></h3>
                                                                        <?php
                                                                        $reviews = $restaurantreview->rating;
                                                                        $dont_show_button1 = "";
                                                                        $dont_show_button2 = "";
                                                                        $dont_show_button3 = "";
                                                                        $dont_show_button4 = "";
                                                                        $dont_show_button5 = "";

                                                                        if ($reviews == 1) {
                                                                            $dont_show_button1 = 'show';
                                                                        } else if ($reviews == 2) {
                                                                            $dont_show_button2 = "show";
                                                                        } else if ($reviews == 3) {
                                                                            $dont_show_button3 = "show";
                                                                        } else if ($reviews == 4) {
                                                                            $dont_show_button4 = "show";
                                                                        } else if ($reviews == 5) {
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
                                                                        <strong><?php echo $date = date('M', strtotime($restaurantreview->createdate)); ?></strong>
                                                                        <span style="color:#8E203E; font-weight: 600;"> <?php echo $date = date('d,', strtotime($restaurantreview->createdate)); ?></span>
                                                                        <?php echo $date = date('Y', strtotime($restaurantreview->createdate)); ?>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <?php
                                                }
                                            } else {
                                                echo "No reviews Now";
                                            }
                                            ?>
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
                            <form action="<?php echo base_url(); ?>index.php/CustomerController/booking/<?php echo $restaurantdetails->no; ?>" method="post">
                                <!-- Text input-->
                                <div class="form-group">
                                    <label class="control-label" for="name">Name:<span class="required">*</span></label>
                                    <div class="">
                                        <?php if (isset($customerdetails) and $customerdetails != NULL) { ?>                      
                                            <input id="name" name="name" type="text" placeholder="Name" class="form-control input-md" value="<?php echo $customerdetails->name; ?>" required readonly>
                                        <?php } else { ?>                            
                                            <input id="name" name="name" type="text" placeholder="Name" class="form-control input-md" required>
                                        <?php } ?>
                                    </div>
                                </div>
                                <!-- Text input-->
                                <div class="form-group">
                                    <label class="control-label" for="phone">Phone:<span class="required">*</span></label>
                                    <div class="">
                                        <?php if (isset($customerdetails) and $customerdetails != NULL) { ?>
                                            <input id="phone" name="phone" type="text" placeholder="Phone" class="form-control input-md" value="<?php echo $customerdetails->mobile; ?>" required readonly>
                                        <?php } else { ?>                            
                                            <input id="phone" name="phone" type="text" placeholder="Phone" class="form-control input-md" required>
                                        <?php } ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label" for="guest">Pick your Time / Discount<span class="required">*</span></label>
                                    <div class="">
                                        <select id="discount" name="discount" class="form-control" required>

                                            <?php if (isset($restaurantdiscounts) and $restaurantdiscounts != NULL) { ?>
                                                <option value="">Select Time - Discount</option>
                                                <?php
                                                foreach ($restaurantdiscounts as $resto_discount) {
                                                    $discount = $this->db->get_where('tbl_base_discount', array('no' => $resto_discount->did))->row();
                                                    ?>
                                                    <option value="<?php echo $resto_discount->no; ?>">
                                                        <?php echo $resto_discount->rtime; ?> / 
                                                        <?php echo $discount->percent; ?>% off
                                                    </option>                            
                                                    <?php
                                                }
                                            } else {
                                                ?>                            
                                                <option value="">No Discount Now</option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <!-- Select Basic -->
                                <div class="form-group">
                                    <label class="control-label" for="date">Date:</label>
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="fa fa-calendar">
                                            </i>
                                        </div>
                                        <input class="form-control" id="date" name="date" placeholder="MM/DD/YYYY" type="text" value="" required="required">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label" for="people">Number of People:<span class="required">*
                                            <?php if ($this->session->flashdata('booking_error') != "") { ?>                    
                                                <?php echo $this->session->flashdata('booking_error'); ?>                    
                                            <?php } ?>
                                        </span></label>
                                    <div class="">
                                        <input id="people" name="people" type="text" placeholder="No of people" class="form-control input-md" required>
                                    </div>
                                </div>

                                <?php if ($account_type == 'customer') { ?>
                                    <div class="form-group">
                                        <label class="control-label" for="savedcard">Saved Cards<span class="required">*</label>
                                        <div class="">
                                            <select class="form-control" name="savedcard" id="savedcard" required="required">
                                                <option>Select a card</option>
                                                <?php foreach ($savedcards as $savedcard) { ?>
                                                    <option value="<?php echo $savedcard->no; ?>"><?php echo $savedcard->cardnumber; ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                <?php } ?>

                                <div class="form-group">
                                    <?php if ($this->session->userdata('customer_login') == 1) { ?>
                                        <button name="submit" class="btn tp-btn-default tp-btn-lg btn-block findhover Book_Venue" style="background-color: #8E203E">Book Restaurant</button>
                                    <?php } else { ?>
                                        <a href="<?php echo base_url(); ?>index.php/LoginController/logout" class="btn tp-btn-default tp-btn-lg btn-block findhover" style="background-color: #8E203E">Please Login</a>  
                                    <?php } ?>
                                </div>
                            </form>
                        </div>
                    </div>                
                </div>
            </div>
        </div>
    </div>
</div>
<script src="<?php echo base_url(); ?>js/customer/jquery.min.js"></script>


<!--
<script>
  $("#people").focusout(function(){
    var no_people = $('#people').val();
    var did = $('#discount').val();
    $.ajax({
      url : "<?php echo base_url(); ?>index.php/CustomerController/check_seat/<?php echo $restaurantdetails->no; ?>/",
      type: 'post',
      data : {
        people : no_people,
        people : did
      },
      dataType: 'json', 
      success:function(data)
      {
        var response = JSON.parse(data);
        if(response.status == 'true')
        {
          $("#error_block").show();
        }
        else
        {
          $("#success_block").show();
        }
      }
    });
    
  });
</script>
-->


<div id="googleMap" class="map"></div>

