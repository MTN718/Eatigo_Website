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

                  <div class="col-md-12 ">
                    <div class="social-sidebar side-box">
                      <ul class="listnone follow-icon">
                        <li><a href="#"><i style="color: #8E203E;" class="fa fa-facebook-square"></i></a></li>
                        <li><a href="#"><i style="color: #8E203E;" class="fa fa-google-plus-square"></i></a></li>
                        <li><a href="#"><i style="color: #8E203E;" class="fa fa-instagram"></i></a></li>
                        <li><a href="#"><i style="color: #8E203E;" class="fa fa-flickr"></i></a></li>
                        <li><a href="#"><i style="color: #8E203E;" class="fa fa-youtube-square"></i></a></li>
                        <li><a href="#"><i style="color: #8E203E;" class="fa fa-twitter-square"></i></a></li>
                      </ul>
                    </div>
                  </div>


                </div>
              </div>
              <div class="col-md-8 page-description">

                  <div class="container-fluid">
                    <div class="row st-tabs woo-product-tabs"> 
                      <!-- Nav tabs -->
                      <ul class="nav nav-tabs" role="tablist">
                        <li role="presentation" class="<?php if( $active == 1) echo "active"; ?>"><a href="#previous" aria-controls="recentproducts" role="tab" data-toggle="tab">Previous Orders</a></li>
                        <li role="presentation" class="<?php if( $active == 2) echo "active"; ?>"><a href="#current" aria-controls="featuredproduct" role="tab" data-toggle="tab">Current Orders</a></li>
                        <li role="presentation" class="<?php if( $active == 3) echo "active"; ?>"><a href="#cancel" aria-controls="toprated" role="tab" data-toggle="tab">Deleted Order </a></li>
                        <li role="presentation" class="<?php if( $active == 4) echo "sactive"; ?>"><a href="#credit" aria-controls="toprated" role="tab" data-toggle="tab" style="width: 177px;">Your Credit</a></li>
                      </ul>
                      <!-- Tab panes -->
                      <div class="tab-content">
                        <div role="tabpanel" class="tab-pane fade in <?php if( $active == 1 ) echo "active"; ?>" id="previous">                 

                          <div class="container">
                            <div class="row products">
                              <div id="bookinglist">

                                <?php if(isset($previousorder) and $previousorder != NULL) {
                                foreach ($previousorder as $previous) 
                                $restaurant = $this->db->get_where('tbl_restaurant', array('no' => $previous->rid))->row();
                                $resto_image = $this->db->get_where('tbl_image_restaurant', array('rid' => $previous->rid))->row();
                                $discount = $this->db->get_where('tbl_map_discount_restaurant', array('no' => $previous->did))->row();
                                $percent = $this->db->get_where('tbl_base_discount', array('no' => $discount->did))->row();
                                { ?>
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
                                    <div class="schedule">
                                      <ul class="scheduleRow">
                                        <li class="date">
                                          <p>1</p>
                                            <small>
                                              <strong><?php echo $date = date('M',strtotime($previous->createdate)); ?></strong>
                                              <span style="color:red; font-weight: 600;"> <?php echo $date = date('d,',strtotime($previous->createdate)); ?></span>
                                              <?php echo $date = date('Y',strtotime($previous->createdate)); ?>
                                            </small>
                                        </li>
                                        <li class="time">
                                          <p>at</p>
                                          <small><span style="color:red; font-weight: 600;" ><?php echo $time = date('H.i',strtotime($previous->createdate));?></span></small>
                                        </li>
                                        <li class="people">
                                          <p>for</p>
                                          <small><span style="color:red; font-weight: 600;"><?php echo $previous->people; ?> </span>person</small>
                                        </li>
                                      </ul>
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
                        </div>
                        <div role="tabpanel" class="tab-pane fade <?php if( $active == 2) echo "in active"; ?>" id="current">
                          <div class="container">
                            <div class="row products">
                              <div id="bookinglist">
                                <?php if(isset($currentorder) and $currentorder != NULL) {
                                foreach ($currentorder as $current) 
                                $restaurant = $this->db->get_where('tbl_restaurant', array('no' => $current->rid))->row();
                                $resto_image = $this->db->get_where('tbl_image_restaurant', array('rid' => $current->rid))->row();
                                $discount = $this->db->get_where('tbl_map_discount_restaurant', array('no' => $current->did))->row();
                                $percent = $this->db->get_where('tbl_base_discount', array('no' => $discount->did))->row();
                                { ?>
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
                                        <small class="bkNumber"> <?php echo $current->code; ?></small>
                                      </li>
                                    </ul>
                                    <div class="resto-detail-h">
                                      <h3><?php echo $restaurant->name; ?></h3>
                                      <p><?php echo $restaurant->address; ?></p>
                                    </div>
                                    <a href="<?php echo base_url();?>index.php/CustomerController/cancel_order/<?php echo $current->no;?>" style="margin-left: 309px;margin-top: -110px;background-color: #8E203E;border: #8E203E;" class="btn btn-primary findhover">cancel</a>
                                    <div class="schedule">
                                      <ul class="scheduleRow">
                                        <li class="date">
                                          <p>1</p>
                                            <small>
                                              <strong><?php echo $date = date('M',strtotime($current->createdate)); ?></strong>
                                              <span style="color:red; font-weight: 600;"> <?php echo $date = date('d,',strtotime($current->createdate)); ?></span>
                                              <?php echo $date = date('Y',strtotime($current->createdate)); ?>
                                            </small>
                                        </li>
                                        <li class="time">
                                          <p>at</p>
                                          <small><span style="color:red; font-weight: 600;" ><?php echo $time = date('H.i',strtotime($current->createdate));?></span></small>
                                        </li>
                                        <li class="people">
                                          <p>for</p>
                                          <small><span style="color:red; font-weight: 600;"><?php echo $previous->people; ?> </span>person</small>
                                        </li>
                                      </ul>
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
                        </div>
                        <div role="tabpanel" class="tab-pane fade <?php if( $active == 3) echo "in active"; ?>" id="cancel">
                          <div class="container">
                            <div class="row products">
                              <div id="bookinglist">
                                <?php if(isset($canceldorder) and $canceldorder != NULL) {
                                foreach ($canceldorder as $cancel) 
                                $restaurant = $this->db->get_where('tbl_restaurant', array('no' => $cancel->rid))->row();
                                $resto_image = $this->db->get_where('tbl_image_restaurant', array('rid' => $cancel->rid))->row();
                                $discount = $this->db->get_where('tbl_map_discount_restaurant', array('no' => $cancel->did))->row();
                                $percent = $this->db->get_where('tbl_base_discount', array('no' => $discount->did))->row();
                                { ?>
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
                                        <small class="bkNumber"> <?php echo $cancel->code; ?></small>
                                      </li>
                                    </ul>
                                    <div class="resto-detail-h">
                                      <h3><?php echo $restaurant->name; ?></h3>
                                      <p><?php echo $restaurant->address; ?></p>
                                    </div>
                                    <div class="schedule">
                                      <ul class="scheduleRow">
                                        <li class="date">
                                          <p>1</p>
                                            <small>
                                              <strong><?php echo $date = date('M',strtotime($cancel->createdate)); ?></strong>
                                              <span style="color:red; font-weight: 600;"> <?php echo $date = date('d,',strtotime($cancel->createdate)); ?></span>
                                              <?php echo $date = date('Y',strtotime($cancel->createdate)); ?>
                                            </small>
                                        </li>
                                        <li class="time">
                                          <p>at</p>
                                          <small><span style="color:red; font-weight: 600;" ><?php echo $time = date('H.i',strtotime($cancel->createdate));?></span></small>
                                        </li>
                                        <li class="people">
                                          <p>for</p>
                                          <small><span style="color:red; font-weight: 600;"><?php echo $cancel->people; ?> </span>person</small>
                                        </li>
                                      </ul>
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
                        </div>

                        <div role="tabpanel" class="tab-pane fade" id="credit">
                          <div class="row products">
                            <div class="col-md-12">

                                <div class="order_review">
                                  <h2></h2>
                                  <table class="shop_table">
                                    <thead>
                                      <tr>
                                        <th class="product-name">Type</th>
                                        <th class="product-total">Amount</th>
                                      </tr>
                                    </thead>
                                    <tfoot>
                                      <tr class="cart-subtotal">
                                        <th>Earned</th>
                                        <td><span class="amount">$190.00</span></td>
                                      </tr>
                                      <tr class="shipping">
                                        <th>Purchased</th>
                                        <td> $190.00</td>
                                      </tr>
                                      <tr class="order-total">
                                        <th>Total</th>
                                        <td><strong><span class="amount">$380.00</span></strong></td>
                                      </tr>
                                    </tfoot>
                                  </table>
                                  <form action="<?php echo base_url();?>index.php/CustomerController/pricingplan">
                                      <button type="submit" onclick="" class="btn tp-btn-default" style="margin-top:15px;  width:140px;float: right;">Add Credits</button>
                                  </form>    
                                  <div class="payment-option"> 
                                    <!-- Multiple Radios -->
                                    <div class="form-group">
                                      <div class="radio radio-success">
                                      </div>
                                      <div class="radio radio-success">
                                      </div>
                                      <div class="radio"></div>
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
                      <form action="<?php echo base_url();?>index.php/CustomerController/update_profile" method="post">        
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
                              <input id="mobile" name="mobile" type="text" placeholder="Mobile Number" value="<?php echo $customer->mobile ?>" class="form-control" required>
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
