<div class="main-container">
  <div class="container">
    <div class="row">
      <div class="col-md-8 tp-title">
      </div>
      <div class="col-md-4 text-right" style="padding-right: 0px;">
        <div class="btn-group">
          <a href="#" id="list" class="btn list-btn active btn-sm"><span class="fa fa-th-list">
          </span> </a> <a href="<?php echo base_url();?>index.php/CustomerController/restaurants" id="grid" style="color:#706a68;" class="btn  grid-btn btn-sm"><span class="fa fa-th"></span> </a>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-3">
        <div class="filter-sidebar">
          <div class="col-md-12 form-title">
            <h2>Refine Your Search</h2>
          </div>
          <form>
            <div class="col-md-12 form-group">
              <label class="control-label" for="venuetype">Venue Type</label>
              <select id="venuetype" name="venuetype" class="form-control">
                <option value="">Select Venue</option>
                <option value="Barn">Barn</option>
                <option value="Boutique">Boutique</option>
                <option value="Castle">Castle</option>
                <option value="Country House">Country House</option>
                <option value="Exclusive use">Exclusive use</option>
                <option value="Garden weddings">Garden weddings</option>
                <option value="Gay friendly">Gay friendly</option>
                <option value="Gothic">Gothic</option>
                <option value="Hotel">Hotel</option>
                <option value="Intimate">Intimate</option>
                <option value="Manor House">Manor House</option>
                <option value="Marquee">Marquee</option>
                <option value="Minimalist">Minimalist</option>
                <option value="Modern">Modern</option>
                <option value="Outside Weddings">Outside Weddings</option>
                <option value="Palace">Palace</option>
                <option value="Private School">Private School</option>
                <option value="Romantic">Romantic</option>
                <option value="Small">Small</option>
                <option value="Waterside">Waterside</option>
                <option value="Weekend">Weekend</option>
              </select>
            </div>
            <div class="col-md-12 form-group">
              <label class="control-label" for="capacity">Discount</label>
              <select id="capacity" name="capacity" class="form-control">
                <option value="">Select Discount</option>
                <option value="0 - 99">10%</option>
                <option value="0 - 99">20%</option>
                <option value="0 - 99">30%</option>
                <option value="0 - 99">40%</option>
                <option value="0 - 99">50%</option>
              </select>
            </div>
            <div class="col-md-12 form-group">
              <label class="control-label" for="price">Price</label>
              <select id="price" name="price" class="form-control">
                <option value=""> Select Price</option>
                <option value="$35 - $50">$35 - $50</option>
                <option value="$50 - $60">$50 - $60</option>
                <option value="$60 - $70">$60 - $70</option>
                <option value="$70 - $80">$70 - $80</option>
                <option value="$80 - $90">$80 - $90</option>
              </select>
            </div>
            <div class="col-md-12 form-group rating">
              <label class="control-label">Select Rating </label>
              <div class="checkbox checkbox-success">
                <input type="checkbox" name="checkbox" id="checkbox-0" value="1" class="styled">
                <label for="checkbox-0" class="control-label"> <i class="fa fa-star"></i> </label>
              </div>
              <div class="checkbox checkbox-success">
                <input type="checkbox" name="checkbox" id="checkbox-1" value="2" class="styled">
                <label for="checkbox-1" class="control-label"> <i class="fa fa-star"></i> <i class="fa fa-star"></i> </label>
              </div>
              <div class="checkbox checkbox-success">
                <input type="checkbox" name="checkbox" id="checkbox-2" value="3" class="styled">
                <label for="checkbox-2" class="control-label"> <i class="fa fa-star"></i> <i class="fa fa-star"></i><i class="fa fa-star"></i> </label>
              </div>
              <div class="checkbox checkbox-success">
                <input type="checkbox" name="checkbox" id="checkbox-3" value="4" class="styled">
                <label for="checkbox-3" class="control-label"> <i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i> </label>
              </div>
              <div class="checkbox checkbox-success">
                <input type="checkbox" name="checkbox" id="checkbox-4" value="5" class="styled">
                <label for="checkbox-4" class="control-label"> <i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i> </label>
              </div>
            </div>
            <div class="col-md-12 form-group">
              <label class="control-label">Categories</label>
              <div class="checkbox checkbox-success">
                <input type="checkbox" name="checkbox" id="weddinghall" value="Wedding Hall" class="styled">
                <label for="weddinghall" class="control-label"> Wedding Hall </label>
              </div>
              <div class="checkbox checkbox-success">
                <input type="checkbox" name="checkbox" id="dining" value="Dining" class="styled">
                <label for="dining" class="control-label"> Dining </label>
              </div>
              <div class="checkbox checkbox-success">
                <input type="checkbox" name="checkbox" id="insurance" value="Liability Insurance" class="styled">
                <label for="insurance" class="control-label"> Liability Insurance </label>
              </div>
              <div class="checkbox checkbox-success">
                <input type="checkbox" name="checkbox" id="catering" value="In House Catering" class="styled">
                <label for="catering" class="control-label"> In House Catering </label>
              </div>
              <div class="checkbox checkbox-success">
                <input type="checkbox" name="checkbox" id="djfacilities" value="5" class="styled">
                <label for="djfacilities" class="control-label"> DJ Facilities </label>
              </div>
              <div class="checkbox checkbox-success">
                <input type="checkbox" name="checkbox" id="dancefloor" value="Dance Foor" class="styled">
                <label for="dancefloor" class="control-label"> Dance Foor </label>
              </div>
            </div>
            <div class="col-md-12 form-group">
              <button type="submit" class="btn tp-btn-primary tp-btn-lg btn-block findhover" style="background-color:#8E203E">Refine Your Search</button>
            </div>
          </form>
        </div>
      </div>
      <div class="col-md-9">
        <div class="row">




          <?php if (isset($restaurantlist) and $restaurantlist != NULL) {
           foreach ($restaurantlist as $restaurant) { 
            $resto_image = $this->db->get_where('tbl_image_restaurant', array('rid' => $restaurant->no))->row();
            $discount = $this->db->get_where('tbl_map_discount_restaurant', array('rid' => $restaurant->no, 'status' => 1))->result();
            $reservations = $this->db->get_where('tbl_reservation', array('rid' => $restaurant->no))->num_rows();
            ?>
            


            <div class="col-md-12 vendor-box vendor-box-grid"><!-- venue box start-->

              <div class="row">
                <div class="col-md-6 no-right-pd">
                  <div class="vendor-image"><!-- venue pic --> 
                    <?php if(isset($resto_image) and $resto_image->image != NULL) { ?>
                    <img  class="img-responsive" alt="Restaurant" src="<?php echo base_url();?><?php echo $resto_image->image; ?>">
                    <?php } else { ?> 
                    <img class="img-responsive" alt="Restaurant" src="http://placehold.it/600x300" >                         
                    <?php } ?>
                    <div class="favourite-bg"><a href="#" class=""><i class="fa fa-heart"></i></a></div>
                  </div>
                </div>
                <!-- /.venue pic -->
                <div class=" col-md-6 vendor-detail"><!-- venue details -->
                  <div class="caption" style="padding: 18px;width: 430px;"><!-- caption -->
                    <div class="box-detail">
                      <div class="box-detail-name">
                        <a href="restaurant/name/ten-yuu-grand-sathon/indexa672.html?date=2017-06-06&amp;time=15.30&amp;source=eatigo_recommended">
                          <h2 class="font-weight-bold"><?php echo $restaurant->name; ?></h2></a>
                        </div>
                        <div class="restro-title-box-left">
                          <div class="box-detail-cuisine normal-font">
                            <?php echo $restaurant->address; ?>
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
                          ?> ;"> </div>
                        </div>
                      </div>
                    </div>
                    <div class="device">
                      <a class="arrow-left" id="arrow-left-2-8" href="javascript:doNothing();"></a>
                      <a class="arrow-right" id="arrow-right-2-8"
                      href="javascript:doNothing();"></a>
                      <div class="swiper-container" id="timeslot-2-8" style="width:332px;">

                        <div class="swiper-wrapper" <?php if( $discount == NULL) echo "style='color:red;margin-top:24px;'" ?> >
                          <?php if(isset($discount) and $discount != NULL) {
                            foreach ($discount as $disc) {                                             
                              $disc_percent = $this->db->get_where('tbl_base_discount', array('no' => $disc->did))->row();
                              ?>
                              

                              <a href="restaurant/name/ten-yuu-grand-sathon/index84e6.html?date=2017-06-06&amp;time=15.30"
                              class="swiper-slide red-slide">
                              <div class="home-slot-time normal-font font-weight-bold">
                                <?php echo $disc->rtime; ?>
                              </div>
                              <div class="home-slot-discount">
                                <h1 class="font-weight-bold">
                                  <span>-</span><?php echo $disc_percent->percent; ?></h1>
                                </div>
                                <div class="home-slot-discount-pc">
                                  %
                                </div>
                                <div class="home-slot-off">
                                  off
                                </div>
                              </a>

                              <?php } 
                            } else { echo "No Discount Offer";}?>

                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div><!-- venue details --> 
                
              </div>
              <?php } 
            } ?>
            

            <div class="col-md-12 tp-pagination">
              <ul class="pagination">
                <li> <a href="#" aria-label="Previous"> <span aria-hidden="true">Previous</span> </a> </li>
                <li class="active"><a href="#">1</a></li>
                <li><a href="#">2</a></li>
                <li><a href="#">3</a></li>
                <li><a href="#">4</a></li>
                <li><a href="#">5</a></li>
                <li> <a href="#" aria-label="Next"> <span aria-hidden="true">NEXT</span> </a> </li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
