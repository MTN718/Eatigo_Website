<div class="slider-bg"><!-- slider start-->
    <div id="slider" class="owl-carousel owl-theme slider">
        <div class="item"><img src="<?php echo base_url();?>images/hero-image-3.png" alt="Wedding couple just married"></div>
        <div class="item"><img src="<?php echo base_url();?>images/hero-image-2.png" alt="Wedding couple just married"></div>
        <div class="item"><img src="<?php echo base_url();?>images/hero-image-1.png" alt="Wedding couple just married"></div>
        <div class="item"><img src="<?php echo base_url();?>images/hero-image.png" alt="Wedding couple just married"></div>
    </div>
    <div class="find-section"><!-- Find search section-->
        <div class="container">
            <div class="row">
                <div class="col-md-offset-1 col-md-10 finder-block">
                    <div class="finder-caption">
                        <h1 style="margin-bottom:20px;">Find your perfect Restaurant</h1>
                    </div>
                    <div class="finderform">
                        <form>
                            <div class="col-md-2 no-padding">
                                <select class="form-control selectpicker">
                                    <option class="active" value="">Select Date</option>
                                    <option value="Venue">06/08</option>
                                </select>
                            </div>
                            <div class="col-md-2 no-padding">
                                <select class="form-control selectpicker">
                                    <option class="active" value="">Select Time</option>
                                    <option value="Venue">13:00</option>
                                </select>
                            </div>
                            <div class="col-md-2 no-padding">
                                <select class="form-control selectpicker">
                                    <option class="active" value="">No. of People</option>
                                    <option value="Venue">2</option>
                                </select>
                            </div>
                            <div class="form-group col-md-4 no-padding" style="width: 274px;">
                                <input type="text" class="form-control" placeholder="Enter Restaurant Name">
                            </div>
                            <button type="submit" class="h btn tp-btn-default tp-btn-lg findhover">Find Restaurants</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- /.Find search section-->
</div>
<div class="spacer feature-section"><!-- Feature Blog Start -->
    <div class="container">
        <div class="row">
            <div class="col-md-12 tp-title-center">
                <h1>How To Do ?</h1>
            </div>
        </div>
        <div class="row feature-center"><!-- feature center -->
            <div class="hvr-bounce-in col-md-4 feature-block wow bounceInLeft" data-wow-duration="2s" data-wow-delay=".5s"><!-- feature block -->
                <div class="feature-icon"><img src="<?php echo base_url();?>images/11111.png" width="100" alt=""></div>
                <h2 style="margin-bottom: 10px; color: #000;">Find Your Favourite Restaurant</h2>
                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s.</p>
            </div><!-- /.feature block -->
            <div class="hvr-bounce-in col-md-4 feature-block wow bounceInUp" data-wow-duration="2s" data-wow-delay=".5s"><!-- feature block -->
                <div class="feature-icon"><img src="<?php echo base_url();?>images/22222.png" width="100" alt=""></div>
                <h2 style="margin-bottom: 10px; color: #000;">Choose Your Time And Discount</h2>
                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s.</p>
            </div><!-- /.feature block -->
            <div class="hvr-bounce-in col-md-4 feature-block wow bounceInRight" data-wow-duration="2s" data-wow-delay=".5s"><!-- feature block -->
                <div class="feature-icon"><img src="<?php echo base_url();?>images/44444.png" width="100" alt=""></div>
                <h2 style="margin-bottom: 10px; color: #000;">Receive Confirmation via sms & Email</h2>
                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s.</p>
            </div><!-- /.feature block -->
        </div><!-- /.feature center -->
    </div>
</div><!-- Feature Blog End -->

<div class="spacer container text-center home-margin-top15 wow fadeIn" style="padding-top: 0px;">
    <h1 style="margin-bottom:20px;">Categories / Restaurants</h1>
    <div class="controls mt-3" style="margin-bottom:20px;">
        <button type="button" class="control btn btn1 btn-secondary btn-sm mx-2 mb-4 active" href="#recentproducts" aria-controls="recentproducts" role="tab" data-toggle="tab">Categories</button>
        <button type="button" class="control btn btn1 btn-secondary btn-sm mx-2 mb-4 " href="#featuredproduct" aria-controls="recentproducts" role="tab" data-toggle="tab">Restaurant</button>
    </div>
    
    <!-- Tab panes -->
    <div class="tab-content">

        <div role="tabpanel" class="tab-pane fade in active" id="recentproducts">
            <div class="portfolio-grid clearfix" id="portfolioList">
                <?php foreach ($categorylist as $category) { ?>
                    <div class="mix Categories">
                        <div class="home-group-img location-block"><!-- location block -->
                            <div class="home-group-img lazy vendor-image">
                                <a href="#"><img src="<?php echo base_url();?><?php echo $category->image; ?>" alt="" class="img-responsive"></a> 
                            </div>
                            <div class="group-resto-name">
                                <div class="name-txt">
                                    <h2 style="color: white;margin: 0px;"><?php echo $category->name; ?></h2>
                                </div>
                                <div class="total-txt small-font" style="color: white;">
                                   <?php echo $category->feature; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?> 
            </div>
        </div>

        <div role="tabpanel" class="tab-pane fade" id="featuredproduct">
            <div class="portfolio-grid clearfix" id="portfolioList">
                <?php foreach ($restaurantlist as $restaurant) { ?>
                    <div class="mix Restaurants" title="Client Name">
                        <div class="home-recom-wrap">
                            <div class="vendor-image">
                                <a href="<?php echo base_url();?>index.php/CustomerController/restaurantdetails"><img class="recom-box-img lazy" alt="" src="<?php echo base_url();?>images/pica.jpg" /></a>
                                <div class="favourite-bg" style="background: rgba(0, 0, 0, 0.6);font-size: 13px;bottom: 5px;right: 6px;padding: 5px 12px 5px 12px;">
                                    <a href="#" class="">310 reservations recently</a>
                                </div>
                            </div>

                            <div class="float-left">
                              <div class="box-detail">
                                <div class="box-detail-name">
                                  <a href="restaurant/name/ten-yuu-grand-sathon/indexa672.html?date=2017-06-06&amp;time=15.30&amp;source=eatigo_recommended">
                                    <h2 class="font-weight-bold"><?php echo $restaurant->name; ?></h2></a>
                                  </div>
                                  <div class="restro-title-box-left">
                                    <div class="box-detail-cuisine normal-font">
                                      japanese
                                    </div>
                                    <div class="box-detail-cuisine normal-font">
                                      sathon
                                    </div>
                                  </div>
                                  <div class="restro-title-box-right">
                                    <div class="box-detail-rating-gray">
                                      <div class="box-detail-rating-yellow_b" style="width:
                                        <?php $review = $restaurant->reviews; 
                                            if ($review == 1) echo "20%";
                                            if ($review == 2) echo "40%";
                                            if ($review == 3) echo "60%";
                                            if ($review == 4) echo "80%";
                                            if ($review == 5) echo "100%"; 
                                        ?> ;">                                          
                                      </div>
                                    </div>
                                    <div class="box-price-gray">
                                      <div class="box-detail-price-yellow_b" style="width:
                                        <?php $level = $restaurant->level; 
                                            if ($level == 1) echo "20%";
                                            if ($level == 2) echo "40%";
                                            if ($level == 3) echo "60%";
                                            if ($level == 4) echo "80%";
                                            if ($level == 5) echo "100%"; 
                                        ?> ;"> 
                                      </div>
                                    </div>
                                  </div>
                                </div>
                                <div class="device">
                                    <a class="arrow-left" id="arrow-left-2-8" href="javascript:doNothing();"></a>
                                    <a class="arrow-right" id="arrow-right-2-8"href="javascript:doNothing();"></a>
                                    <div class="swiper-container" id="timeslot-2-8" style="width: 250px;">
                                        <div class="swiper-wrapper">

                                            <a href="restaurant/name/ten-yuu-grand-sathon/index84e6.html?date=2017-06-06&amp;time=15.30"
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
                                            </a>

                                            <a href="restaurant/name/ten-yuu-grand-sathon/index84e6.html?date=2017-06-06&amp;time=15.30"
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
                                            </a>

                                            <a href="restaurant/name/ten-yuu-grand-sathon/index84e6.html?date=2017-06-06&amp;time=15.30"
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
                                            </a>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?> 
            </div>
        </div>
    </div>
</div>

<!-- /.top location -->
<div class="spacer tp-section"><!-- Testimonial Section -->
    <div class="container">
        <div class="row">
            <div class="col-md-12 tp-title-center">
                <h1>Recent Reviews</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 tp-testimonial">
                <div id="testimonial" class="owl-carousel owl-theme">
                    <div class="item testimonial-block">
                        <div class="couple-pic"><img src="<?php echo base_url();?>images/couple-4.jpg" alt="" class="img-circle"></div>
                        <div class="col-md-12 rating-box">
                            <div class="rating"> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star-o"></i> </div>
                        </div>
                        <div class="feedback-caption">

                            <p>"check out this week’s new restaurants on eatigo here! reserve now and get up to 50% off for every restaurant everyday"
                            </p>
                        </div>
                        <div class="couple-info">
                            <div class="date">Thu, 21st June, 2017</div>
                        </div>
                    </div>
                    <div class="item testimonial-block">
                        <div class="couple-pic"><img src="<?php echo base_url();?>images/couple-4.jpg" alt="" class="img-circle"></div>
                        <div class="col-md-12 rating-box">
                            <div class="rating"> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star-o"></i> </div>
                        </div>
                        <div class="feedback-caption">
                            <p>"check out this week’s new restaurants on eatigo here! reserve now and get up to 50% off for every restaurant everyday"</p>
                        </div>
                        <div class="couple-info">
                            <div class="date">Thu, 13th July, 2017</div>
                        </div>
                    </div>
                    <div class="item testimonial-block">
                        <div class="couple-pic"><img src="<?php echo base_url();?>images/couple-4.jpg" alt="" class="img-circle"></div>
                        <div class="col-md-12 rating-box">
                            <div class="rating"> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star-o"></i> </div>
                        </div>
                        <div class="feedback-caption">
                            <p>"check out this week’s new restaurants on eatigo here! reserve now and get up to 50% off for every restaurant everyday"</p>
                        </div>
                        <div class="couple-info">
                            <div class="date">Thu, 13th July, 2017</div>
                        </div>
                    </div>
                    <div class="item testimonial-block">
                        <div class="couple-pic"><img src="<?php echo base_url();?>images/couple-4.jpg" alt="" class="img-circle"></div>
                        <div class="col-md-12 rating-box">
                            <div class="rating"> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star-o"></i> </div>
                        </div>
                        <div class="feedback-caption">
                            <p>"Etiam ut metus nisi. Sed non laoreet nisi tinciin interdum risus felis enjoyable day were Notting was a problem from "</p>
                        </div>
                        <div class="couple-info">
                            <div class="date">Thu, 12th Sept, 2017</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div><!-- /. Testimonial Section -->

<script src="<?php echo base_url();?>js/customer/jquery.min.js"></script>