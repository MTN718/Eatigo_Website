 <script type="text/javascript">
  errorItems = self.form.find(":invalid");
  errorItems.each(function(index, node) {
      var item = $(this);     
      var message = (node.validity.patternMismatch ? node.dataset.patternError : node.dataset.error) || "Invalid value.";
      item.get(0).setCustomValidity(message);
  });
</script>

       <div class="main-container">
          <div class="container">
            <div class="row">
              <div class="col-md-4 page-sidebar">
                <div class="row">
                  <div class="col-md-12 vendor-profile-block">
                    <div class="vendor-profile">

                      <form class="text-center" action="<?php echo base_url();?>index.php/CustomerController/update_picture" method="post" enctype="multipart/form-data">

                        <div class="fileinput fileinput-new text-center" data-provides="fileinput">
                          <div class="fileinput-new thumbnail" style="width: 317px; height: 236px; border:none;" data-trigger="fileinput">
                            <?php if($customer->image != "") { ?>
                            <img src="<?php echo base_url();?><?php echo $customer->image; ?>" alt="">
                            <?php } else { ?> 
                            <img src="http://placehold.it/300x250" alt="">                           
                            <?php } ?>
                          </div>
                          <div class="fileinput-preview fileinput-exists thumbnail" style="height: 236px; border:none;"></div>
                          <div>
                            <span class="btn tp-btn-default btn-file">
                              <span class="fileinput-new">Change image</span>
                              <span class="fileinput-exists">Change</span>
                              <input type="file" name="image" accept="image/*" style="left: 295px;">
                            </span>
                            <button type="submit" class="btn tp-btn-primary fileinput-exists" style="height: 33px;">Save</button>
                          </div>
                        </div>

                      </form>

                    </div>
                  </div>

                  <div class="col-md-12 ">
                    <div class="social-sidebar side-box">
                      <p class="profile-address"><i class="fa fa-user"></i> <?php echo $customer->name; ?>
                        <a href="" data-toggle="modal" data-target="#editProfile"><i class="fa fa-pencil findhover2" style="float: right;color: #000;"></i></a>
                      </p>
                      <p class="profile-address"><i class="fa fa-envelope"></i> <?php echo $customer->email; ?> </p>
                      <p class="profile-address"><i class="fa fa-mobile" style="font-size: 22px;"></i> <?php echo $customer->mobile; ?> </p>
                    </div>
                  </div>

                </div>
              </div>
              <div class="col-md-8 page-description">

                <div class="container-fluid">
                  <div class="row st-tabs woo-product-tabs"> 
                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs" role="tablist">
                      <li role="presentation" class="<?php if( $active == 1) echo "active"; ?>"><a href="#previous" aria-controls="recentproducts" role="tab" data-toggle="tab">History</a></li>
                      <li role="presentation" class="<?php if( $active == 2) echo "active"; ?>"><a href="#current" aria-controls="featuredproduct" role="tab" data-toggle="tab">Upcoming Reservation</a></li>
                      <li role="presentation" class="<?php if( $active == 3) echo "active"; ?>"><a href="#cancel" aria-controls="toprated" role="tab" data-toggle="tab">Reservation</a></li>
                      <li role="presentation" class="<?php if( $active == 4 || $active == 5) echo "active"; ?>"><a href="#credit" aria-controls="toprated" role="tab" data-toggle="tab" style="width: 177px;">Credit card</a></li>
                    </ul>
                    <!-- Tab panes -->
                    <div class="tab-content">
                      <div role="tabpanel" class="tab-pane fade in <?php if( $active == 1 ) echo "active"; ?>" id="previous">                 

                        <div class="container">
                          <div class="row products">

                            <?php if(isset($previousorder) and $previousorder != NULL) {
                              foreach ($previousorder as $previous) {
                                $restaurant = $this->db->get_where('tbl_restaurant', array('no' => $previous->rid))->row();
                                $resto_image = $this->db->get_where('tbl_image_restaurant', array('rid' => $previous->rid))->row();
                                $discount = $this->db->get_where('tbl_map_discount_restaurant', array('no' => $previous->did))->row();
                                $percent = $this->db->get_where('tbl_base_discount', array('no' => $discount->did))->row();
                                ?>

                                <div id="bookinglist">
                                  <div class="display_booking" style="display:block;width: 715px;">
                                    <div class="history-Left vendor-image">
                                      <a href="">
                                        <?php if(isset($resto_image) and $resto_image->image != "") { ?>
                                        <img class="colforheight" src="<?php echo base_url();?><?php echo $resto_image->image; ?>">
                                        <?php } else { ?> 
                                        <img src="http://placehold.it/300x250" alt="">                           
                                        <?php } ?>
                                      </a>
                                      <div class="offerDiv">
                                        <small class="timeStyle"><strong><?php echo $discount->rtime; ?></strong></small>
                                        <small class="offPrice"><?php echo $percent->percent; ?><sup class="offpercent">%</sup></small>
                                        <span class="offStyle">off&nbsp;</span>
                                      </div>
                                    </div>
                                    <div class="history-Right">
                                      <ul class="right_title_history">
                                        <li class="imgdollar_h">
                                          <p>price</p>
                                          <div class="prRatingDiv_h">
                                            <div class="dollarVal_h" style="width:
                                            <?php $review = $restaurant->reviews; 
                                            if ($review == 1) echo "20%";
                                            if ($review == 2) echo "40%";
                                            if ($review == 3) echo "60%";
                                            if ($review == 4) echo "80%";
                                            if ($review == 5) echo "100%"; 
                                            ?> ;"> 
                                          </div>
                                        </div>
                                      </li>
                                      <li class="imgrating_h">
                                        <p>rating:</p>
                                        <div class="ratingDiv_h">
                                          <div class="ratingVal_h" style="width:
                                          <?php $level = $restaurant->level; 
                                          if ($level == 1) echo "20%";
                                          if ($level == 2) echo "40%";
                                          if ($level == 3) echo "60%";
                                          if ($level == 4) echo "80%";
                                          if ($level == 5) echo "100%"; 
                                          ?> ;">
                                        </div>
                                      </div>
                                    </li>
                                    <li class="imgheart_h">
                                      <p>reservation code:</p>
                                      <small class="bkNumber"> <?php echo $previous->code; ?></small>
                                    </li>
                                  </ul>
                                  <div class="resto-detail-h">
                                    <h3><?php echo $restaurant->name; ?></h3>
                                    <p><?php echo $restaurant->address; ?></p>
                                  </div>
                                  <a href="<?php echo base_url();?>index.php/CustomerController/restaurantdetails/<?php echo $restaurant->no; ?>/4" style="margin-left: 309px;margin-top: -110px;background-color: #8E203E;border: #8E203E;" class="btn btn-primary findhover">Review</a>
                                  <div class="schedule">
                                    <ul class="scheduleRow">
                                      <li class="date">
                                        <p>1</p>
                                        <small>
                                          <strong><?php echo $date = date('M',strtotime($previous->date)); ?></strong>
                                          <span style="color:red; font-weight: 600;"> <?php echo $date = date('d,',strtotime($previous->date)); ?></span>
                                          <?php echo $date = date('Y',strtotime($previous->date)); ?>
                                        </small>
                                      </li>
                                      <li class="time">
                                        <p>at</p>
                                        <small><span style="color:red; font-weight: 600;" ><?php echo $discount->rtime; ?></span></small>
                                      </li>
                                      <li class="people">
                                        <p>for</p>
                                        <small><span style="color:red; font-weight: 600;"><?php echo $previous->people; ?> </span>person</small>
                                      </li>
                                    </ul>
                                  </div>
                                </div>
                              </div>                                
                            </div>
                            <?php }
                          } else { ?>
                          No order Yet
                          <?php } ?>

                        </div>
                      </div>
                    </div>
                    <div role="tabpanel" class="tab-pane fade <?php if( $active == 2) echo "in active"; ?>" id="current">
                      <div class="container">
                        <div class="row products">
                          <?php if(isset($currentorder) and $currentorder != NULL) {
                            foreach ($currentorder as $current) { 
                              if(isset($current) and $current != NULL) {
                              $restaurant = $this->db->get_where('tbl_restaurant', array('no' => $current->rid))->row();
                              $resto_image = $this->db->get_where('tbl_image_restaurant', array('rid' => $current->rid))->row();
                              $discount = $this->db->get_where('tbl_map_discount_restaurant', array('no' => $current->did))->row();
                              if(isset($discount) and $discount != NULL) {
                                $percent = $this->db->get_where('tbl_base_discount', array('no' => $discount->did))->row();
                              }
                              }
                              ?>
                              <div id="bookinglist">
                                <div class="display_booking" style="display:block;width: 715px;">
                                  <div class="history-Left vendor-image">
                                    <a href="">
                                      <?php if(isset($resto_image) and $resto_image->image != "") { ?>
                                      <img class="colforheight" src="<?php echo base_url();?><?php echo $resto_image->image; ?>">
                                      <?php } else { ?> 
                                      <img src="http://placehold.it/300x250" alt="">                           
                                      <?php } ?>
                                    </a>
                                    <div class="offerDiv">
                                      <small class="timeStyle"><strong><?php if(isset($discount) and $discount->rtime != "") echo $discount->rtime; ?></strong></small>
                                      <small class="offPrice"><?php if(isset($percent) and $percent->percent != "") echo $percent->percent; ?><sup class="offpercent">%</sup></small>
                                      <span class="offStyle">off&nbsp;</span>
                                    </div>
                                  </div>
                                  <div class="history-Right">
                                    <ul class="right_title_history">
                                      <li class="imgdollar_h">
                                        <p>price</p>
                                        <div class="prRatingDiv_h">
                                          <div class="dollarVal_h" style="width:
                                          <?php $review = $restaurant->reviews; 
                                          if ($review == 1) echo "20%";
                                          if ($review == 2) echo "40%";
                                          if ($review == 3) echo "60%";
                                          if ($review == 4) echo "80%";
                                          if ($review == 5) echo "100%"; 
                                          ?> ;"> 
                                        </div>
                                      </div>
                                    </li>
                                    <li class="imgrating_h">
                                      <p>rating:</p>
                                      <div class="ratingDiv_h">
                                        <div class="ratingVal_h" style="width:
                                        <?php $level = $restaurant->level; 
                                        if ($level == 1) echo "20%";
                                        if ($level == 2) echo "40%";
                                        if ($level == 3) echo "60%";
                                        if ($level == 4) echo "80%";
                                        if ($level == 5) echo "100%"; 
                                        ?> ;">
                                      </div>
                                    </div>
                                  </li>
                                  <li class="imgheart_h">
                                    <p>reservation code:</p>
                                    <small class="bkNumber"> <?php if(isset($current) and $current->code != "") echo $current->code; ?></small>
                                  </li>
                                </ul>
                                <div class="resto-detail-h">
                                  <h3><?php if(isset($restaurant) and $restaurant->name != "") echo $restaurant->name; ?></h3>
                                  <p><?php if(isset($restaurant) and $restaurant->address != "") echo $restaurant->address; ?></p>
                                </div>
                                <a href="<?php echo base_url();?>index.php/CustomerController/cancel_order/<?php echo $current->no;?>" style="margin-left: 309px;margin-top: -110px;background-color: #8E203E;border: #8E203E;" class="btn btn-primary findhover">cancel</a>
                                <div class="schedule">
                                  <ul class="scheduleRow">
                                    <li class="date">
                                      <p>1</p>
                                      <small>
                                        <strong><?php echo $date = date('M',strtotime($current->date)); ?></strong>
                                        <span style="color:red; font-weight: 600;"> <?php echo $date = date('d,',strtotime($current->date)); ?></span>
                                        <?php echo $date = date('Y',strtotime($current->date)); ?>
                                      </small>
                                    </li>
                                    <li class="time">
                                      <p>at</p>
                                      <small><span style="color:red; font-weight: 600;" ><?php if(isset($discount) and $discount->rtime != "") echo $discount->rtime; ?></span></small>
                                    </li>
                                    <li class="people">
                                      <p>for</p>
                                      <small><span style="color:red; font-weight: 600;"><?php echo $current->people; ?> </span>person</small>
                                    </li>
                                  </ul>
                                </div>
                              </div>
                            </div>
                          </div> 
                          <?php }
                        } else { ?>
                        No order Yet
                        <?php } ?>
                      </div>
                    </div>
                  </div>
                  <div role="tabpanel" class="tab-pane fade <?php if( $active == 3) echo "in active"; ?>" id="cancel">
                    <div class="container">
                      <div class="row products">

                        <?php if(isset($canceldorder) and $canceldorder != NULL) {
                          foreach ($canceldorder as $cancel) { 
                            if(isset($cancel) and $cancel != NULL) {
                              $restaurant = $this->db->get_where('tbl_restaurant', array('no' => $cancel->rid))->row();
                              $resto_image = $this->db->get_where('tbl_image_restaurant', array('rid' => $cancel->rid))->row();
                              $discount = $this->db->get_where('tbl_map_discount_restaurant', array('no' => $cancel->did))->row();
                              if(isset($discount) and $discount != NULL) {
                                $percentdata = $this->db->get_where('tbl_base_discount', array('no' => $discount->did))->row();
                                }
                              }
                              ?>
                              
                            <div id="bookinglist">
                              <div class="display_booking" style="display:block;width: 715px;">
                                <div class="history-Left vendor-image">
                                  <a href="">
                                    <?php if(isset($resto_image) and $resto_image->image != "") { ?>
                                    <img class="colforheight" src="<?php echo base_url();?><?php echo $resto_image->image; ?>">
                                    <?php } else { ?> 
                                    <img src="http://placehold.it/300x250" alt="">                           
                                    <?php } ?>
                                  </a>
                                  <div class="offerDiv">
                                    <small class="timeStyle"><strong><?php if(isset($discount) and $discount->rtime != "") echo $discount->rtime; ?></strong></small>
                                    <small class="offPrice"><?php if(isset($percentdata) and $percentdata->percent != "") echo $percentdata->percent; ?><sup class="offpercent">%</sup></small>
                                    <span class="offStyle">off&nbsp;</span>
                                  </div>
                                </div>
                                <div class="history-Right">
                                  <ul class="right_title_history">
                                    <li class="imgdollar_h">
                                      <p>price</p>
                                      <div class="prRatingDiv_h">
                                        <div class="dollarVal_h" style="width:
                                        <?php $review = $restaurant->reviews; 
                                        if ($review == 1) echo "20%";
                                        if ($review == 2) echo "40%";
                                        if ($review == 3) echo "60%";
                                        if ($review == 4) echo "80%";
                                        if ($review == 5) echo "100%"; 
                                        ?> ;"> 
                                      </div>
                                    </div>
                                  </li>
                                  <li class="imgrating_h">
                                    <p>rating:</p>
                                    <div class="ratingDiv_h">
                                      <div class="ratingVal_h" style="width:
                                      <?php $level = $restaurant->level; 
                                      if ($level == 1) echo "20%";
                                      if ($level == 2) echo "40%";
                                      if ($level == 3) echo "60%";
                                      if ($level == 4) echo "80%";
                                      if ($level == 5) echo "100%"; 
                                      ?> ;">
                                    </div>
                                  </div>
                                </li>
                                <li class="imgheart_h">
                                  <p>reservation code:</p>
                                  <small class="bkNumber"> <?php echo $cancel->code; ?></small>
                                </li>
                              </ul>
                              <div class="resto-detail-h" style="width:95%;">
                                <h3><?php echo $restaurant->name; ?>
                                <?php if($cancel->by_owner != 0) { ?>
                                    <small style="color:red; float:right;">Canceled By Restaurant</small>
                                <?php } else { ?>    
                                    <small style="color:red; float:right;">Canceled By User</small>
                                <?php } ?>
                                </h3>
                                <p><?php echo $restaurant->address; ?></p>
                              </div>
                              <div class="schedule">
                                <ul class="scheduleRow">
                                  <li class="date">
                                    <p>1</p>
                                    <small>
                                      <strong><?php echo $date = date('M',strtotime($cancel->date)); ?></strong>
                                      <span style="color:red; font-weight: 600;"> <?php echo $date = date('d,',strtotime($cancel->date)); ?></span>
                                      <?php echo $date = date('Y',strtotime($cancel->date)); ?>
                                    </small>
                                  </li>
                                  <li class="time">
                                    <p>at</p>
                                    <small><span style="color:red; font-weight: 600;" ><?php if(isset($discount) and $discount->rtime != "") echo $discount->rtime; ?></span></small>
                                  </li>
                                  <li class="people">
                                    <p>for</p>
                                    <small><span style="color:red; font-weight: 600;"><?php echo $cancel->people; ?> </span>person</small>
                                  </li>
                                </ul>
                              </div>
                            </div>
                          </div>
                        </div>  
                        <?php }
                      } else { ?>
                      No order Yet
                      <?php } ?>                             
                    </div>
                  </div>
                </div>

                <div role="tabpanel" class="tab-pane fade <?php if( $active == 4) echo "in active"; ?>" id="credit">
                 <div class="container-fluid">
                  <div class="row products">

                  <?php if(isset($cardlist) and $cardlist != NULL) {
                    foreach ($cardlist as $card) { ?>
                    <div id="bookinglist">
                      <div class="display_booking" style="display:block;width: 715px; height:61px">
                        <div class="history-Right" style="width:703px;min-height: 57px;">
                          <div class="schedule" style="width: 711px; ">
                            <ul class="scheduleRow">
                              <li class="date" style="width:50%">
                                <p>Card Number</p>
                                <small>
                                  <strong><?php echo $card->cardnumber; ?></strong>
                                </small>
                              </li>
                              <li class="time" style="width:15%">
                                <p>Expiry Date</p>
                                <small><span style="color:red; font-weight: 600;"><?php echo $card->expirymonth; ?>/<?php echo $card->expiryyear  ; ?> </span></small>
                              </li>
                              <li class="people">
                                <p>Action</p>
                                <small><a href="<?php echo base_url();?>index.php/CustomerController/card_delete/<?php echo $card->no; ?>" onclick="return confirm('Are you sure you want to Delete your Card ?');"><i style="color:red;" class="fa fa-trash"></i></a></small>
                              </li>
                            </ul>
                          </div>
                        </div>
                      </div>                                
                    </div>
                    <?php } } else { echo "No Card Now"; } ?>

                    <form action="<?php echo base_url();?>index.php/CustomerController/profile/5">
                      <button type="submit" onclick="" class="btn tp-btn-default" style="margin-top:15px;  width:140px;float: right;">Add Credits</button>
                    </form>   
                  </div>    
                </div>
              </div>


              <div role="tabpanel" class="tab-pane fade <?php if( $active == 5) echo "in active"; ?>" id="add_card">
                <form action="<?php echo base_url();?>index.php/CustomerController/add_card" method="post">
                  <div class="row"> 
                      <div class="form-group col-md-6">
                        <label class="control-label" for="fname">Card Number<span class="required">*
                          <?php if ($this->session->flashdata('error_card') != ""){ ?>                    
                            <?php echo $this->session->flashdata('error_card');?>                    
                          <?php } ?>
                      </span> </label>
                        <input type="text" pattern="[0-9]{16}" class="form-control" id="cnumber" name="cnumber" placeholder="Card Number" required="required">
                      </div>
                      <div class="form-group col-md-6">
                        <label class="control-label" for="address">Expiry Date<span class="required">*</span></label>
                        <div class="row">
                          <div class="col-md-6" style="padding-right:7px;">
                            <select class="form-control" name="emonth" required="required">
                            <option value="">Select Month</option>
                              <option value="01">1</option>
                              <option value="02">2</option>
                              <option value="03">3</option>
                              <option value="04">4</option>
                              <option value="05">5</option>
                              <option value="06">6</option>
                              <option value="07">7</option>
                              <option value="08">8</option>
                              <option value="09">9</option>
                              <option value="10">10</option>
                              <option value="11">11</option>
                              <option value="12">12</option>
                            </select>
                          </div>
                          <div class="col-md-6" style="padding-left:7px;">
                            <select class="form-control" name="eyear" required="required">
                            <option value="">Select Month</option>
                              <option value="2017">2017</option>
                              <option value="2018">2018</option>
                              <option value="2019">2019</option>
                              <option value="2020">2020</option>
                              <option value="2021">2021</option>
                              <option value="2022">2022</option>
                              <option value="2023">2023</option>
                              <option value="2024">2024</option>
                              <option value="2025">2025</option>
                              <option value="2026">2026</option>
                              <option value="2027">2027</option>
                              <option value="2028">2028</option>
                              <option value="2029">2029</option>
                              <option value="2030">2030</option>
                            </select>
                          </div>  
                        </div>
                      </div>

                      <div class="form-group col-md-6">
                        <label class="control-label" for="town">CVV<span class="required">*</span><span class="required">*</span></label>
                        <input type="text" class="form-control" id="cvv" pattern="[0-9]{3,4}" name="cvv" placeholder="CVV Number" required="required">
                      </div>

                       <div class="form-group col-md-12">
                         <button type="submit" class="btn tp-btn-default findhover" style="margin-top:15px;  width:140px;float: right;">Add Credits</button>
                      </div>              
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
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
<div class="modal fade" id="editProfile" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h3 class="modal-title">Edit Profile</h3>
      </div>
      <form class="form-horizontal"> action="<?php echo base_url();?>index.php/CustomerController/update_profile" method="post">        
        <div class="modal-body">



          <!-- Text input-->
          <div class="form-group">
            <div class="">
              <input id="name" name="name" type="text" placeholder="Name" value="<?php echo $customer->name ?>" class="form-control" required>
            </div>
          </div>
          <!-- Text input--> 
          <div class="form-group col-md-6 no-padding">
            <div class="">
              <input id="email" name="email" type="text" placeholder="Email Address" value="<?php echo $customer->email ?>" class="form-control" required>
            </div>
          </div>
          <!-- Text input--> 
          <div class="form-group col-md-6 no-padding">
            <div class="">
              <input name="mobile" type="text" placeholder="Mobile Number" pattern="[789][0-9]{9}" value="<?php echo $customer->mobile ?>" class="form-control" required>
            </div>
          </div>



        </div>
        <div class="modal-footer">
          <a href="#" type="button" class="btn tp-btn-default" data-dismiss="modal">Close</a>
          <button type="submit" class="btn tp-btn-primary btn-lg">Update</button>
        </div>
      </form>
    </div>

  </div>
</div>



<script src="<?php echo base_url();?>js/customer/jquery.min.js"></script>
<div id="googleMap" class="map" style="margin-top:40px;"></div>
