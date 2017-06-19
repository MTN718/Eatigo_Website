    <!-- /.page header -->
    <div class="main-container">
      <div class="container">
        <div class="row">
          <div class="col-md-8 tp-title">
          </div>
          <div class="col-md-4 text-right" style="padding-right: 23px;">
            <div class="btn-group"> <a href="<?php echo base_url();?>index.php/CustomerController/restaurantlist/<?php echo $category_id; ?>" id="list" class="btn list-btn btn-sm" style="color:#706a68"><span class="fa fa-th-list"> </span> </a> <a href="#" id="grid" class="btn  grid-btn active  btn-sm"><span class="fa fa-th"></span> </a> </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-3">
            <div class="filter-sidebar">
              <div class="col-md-12 form-title">
                <h2>Refine Your Search</h2>
              </div>
              <!-- <?php echo base_url();?>index.php/CustomerController/refine_restaurants/<?php if(isset($category_id) and $category_id != NULL) echo $category_id; ?> -->
              <form action="" method="post">
                <div class="col-md-12 form-group">
                  <label class="control-label" for="capacity">Discount</label>
                  <select id="discount" name="discount" class="form-control">
                    <option value="">Select Discount</option>
                    <?php if (isset($discount) and $discount != NULL) { 
                      foreach ($discount as $dis) { ?>
                      <option value="<?php echo $dis->no; ?>"><?php echo $dis->percent; ?>%</option>
                    <?php } } else { echo "No Photos Now";} ?>
                  </select>
                </div>
                <div class="col-md-12 form-group rating">
                  <label class="control-label">Select Price Level </label>
                  <div class="checkbox checkbox-success">
                    <input type="checkbox" name="level[]" id="checkbox-0" value="1" class="styled">
                    <label for="checkbox-0" class="control-label"> <i class="fa fa-usd"></i> </label>
                  </div>
                  <div class="checkbox checkbox-success">
                    <input type="checkbox" name="level[]" id="checkbox-1" value="2" class="styled">
                    <label for="checkbox-1" class="control-label"> <i class="fa fa-usd"></i> <i class="fa fa-usd"></i> </label>
                  </div>
                  <div class="checkbox checkbox-success">
                    <input type="checkbox" name="level[]" id="checkbox-2" value="3" class="styled">
                    <label for="checkbox-2" class="control-label"> <i class="fa fa-usd"></i> <i class="fa fa-usd"></i><i class="fa fa-usd"></i> </label>
                  </div>
                  <div class="checkbox checkbox-success">
                    <input type="checkbox" name="level[]" id="checkbox-3" value="4" class="styled">
                    <label for="checkbox-3" class="control-label"> <i class="fa fa-usd"></i><i class="fa fa-usd"></i><i class="fa fa-usd"></i><i class="fa fa-usd"></i> </label>
                  </div>
                  <div class="checkbox checkbox-success">
                    <input type="checkbox" name="level[]" id="checkbox-4" value="5" class="styled">
                    <label for="checkbox-4" class="control-label"> <i class="fa fa-usd"></i><i class="fa fa-usd"></i><i class="fa fa-usd"></i><i class="fa fa-usd"></i><i class="fa fa-usd"></i> </label>
                  </div>
                </div>
                <div class="col-md-12 form-group rating">
                  <label class="control-label">Select Rating </label>
                  <div class="checkbox checkbox-success">
                    <input type="checkbox" name="rate[]" id="checkbox-01" value="1" class="styled">
                    <label for="checkbox-01" class="control-label"> <i class="fa fa-star"></i> </label>
                  </div>
                  <div class="checkbox checkbox-success">
                    <input type="checkbox" name="rate[]" id="checkbox-11" value="2" class="styled">
                    <label for="checkbox-11" class="control-label"> <i class="fa fa-star"></i> <i class="fa fa-star"></i> </label>
                  </div>
                  <div class="checkbox checkbox-success">
                    <input type="checkbox" name="rate[]" id="checkbox-21" value="3" class="styled">
                    <label for="checkbox-21" class="control-label"> <i class="fa fa-star"></i> <i class="fa fa-star"></i><i class="fa fa-star"></i> </label>
                  </div>
                  <div class="checkbox checkbox-success">
                    <input type="checkbox" name="rate[]" id="checkbox-31" value="4" class="styled">
                    <label for="checkbox-31" class="control-label"> <i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i> </label>
                  </div>
                  <div class="checkbox checkbox-success">
                    <input type="checkbox" name="rate[]" id="checkbox-41" value="5" class="styled">
                    <label for="checkbox-41" class="control-label"> <i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i> </label>
                  </div>
                </div>
                <div class="col-md-12 form-group">
                  <label class="control-label">Categories</label>

                  <?php if (isset($categories) and $categories != NULL) { 
                  foreach ($categories as $category) { ?>
                  
                    <div class="checkbox checkbox-success">
                      <input type="checkbox" name="category[]" value="<?php echo $category->no; ?>" class="styled">
                      <label class="control-label"><?php echo $category->name; ?></label>
                    </div>

                  <?php }
                  } else { echo "No Category Now";} ?>

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

             <div class="col-md-4 vendor-box"><!-- venue box start--> 
                    <div class="mix Restaurants" title="Client Name">
                        <a href="<?php echo base_url();?>index.php/CustomerController/restaurantdetails/<?php echo $restaurant->no; ?>">
                        <div class="home-recom-wrap">
                            <div class="vendor-image">
                                <?php if(isset($resto_image) and $resto_image->image != NULL) { ?>
                                    <img  class="recom-box-img lazy" alt="" src="<?php echo base_url();?><?php echo $resto_image->image; ?>" alt="">
                                <?php } else { ?> 
                                    <img class="recom-box-img lazy" alt="" src="http://placehold.it/300x250" />                         
                                <?php } ?>
                                <div class="favourite-bg" style="background: rgba(0, 0, 0, 0.6);font-size: 13px;bottom: 5px;right: 6px;padding: 5px 12px 5px 12px;">
                                    <?php echo $reservations; ?> reservations recently
                                </div>
                            </div>

                            <div class="float-left">
                              <div class="box-detail">
                                <div class="box-detail-name">
                                  <h2 class="font-weight-bold"><?php echo $restaurant->name; ?></h2>
                                  </div>
                                  <div class="restro-title-box-left">
                                    <div class="box-detail-cuisine">
                                      <?php echo $restaurant->address; ?>
                                    </div>
                                  </div>
                                  <div class="restro-title-box-right">
                                    <div class="box-detail-rating-gray">
                                      <div class="box-detail-rating-yellow_b" style="width:
                                        <?php $review = $restaurant->reviews; 
                                            if ($review == 0) echo "0%"; 
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
                                            if ($level == 0) echo "0%"; 
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
                                    <div class="swiper-container" id="timeslot-2-8">
                                        <div class="swiper-wrapper" <?php if( $discount == NULL) echo "style='color:red;margin-top:24px;'" ?> >
                                        <?php if(isset($discount) and $discount != NULL) {
                                        foreach ($discount as $disc) {                                             
                                        $disc_percent = $this->db->get_where('tbl_base_discount', array('no' => $disc->did))->row();
                                        ?>
                                            <a href="" class="swiper-slide red-slide">
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
                        </a>
                    </div>
                     </div>
                <?php } 
                } else {
                  echo "No Restaurants";
              }?>   

              <!-- venue details --> 
            </div>
  

</div>
</div>
</div>
</div>
</div>
