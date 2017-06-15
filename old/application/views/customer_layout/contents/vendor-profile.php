<!-- /.navigation start -->
<div class="tp-page-head"><!-- page header -->
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="page-header">
          <h1>Vendor Details</h1>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="main-container">
  <div class="container tabbed-page st-tabs">
    <div class="row tab-page-header">
      <div class="col-md-4  vendor-profile-block">
        <div class="vendor-profile"> 

        <form class="text-center" action="<?php echo base_url();?>index.php/VendorController/update_picture" method="post" enctype="multipart/form-data">

          <div class="fileinput fileinput-new text-center" data-provides="fileinput">
            <div class="fileinput-new thumbnail" style="width: 317px; height: 236px; border:none;" data-trigger="fileinput">
              <?php if(isset($vendor) and $vendor->image != "") { ?>
              <img src="<?php echo base_url();?><?php echo $vendor->image; ?>" alt="">
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
       <hr>        
     </div>
     <div class="col-md-8 title"> 
      <h1><?php echo $vendor->name; ?>
       <a href="" data-toggle="modal" data-target="#editProfile"><i class="fa fa-pencil findhover2" style="float: right;color: #000;"></i></a>
     </h1>
     <p class="location"><i class="fa fa-user"></i><?php echo $vendor->name; ?></p>
     <p class="location"><i class="fa fa-map-marker"></i><?php echo $vendor->address; ?></p>
     <p class="location"><i class="fa fa-envelope"></i><?php echo $vendor->email; ?></p>
     <p class="location"><i class="fa fa-phone"></i><?php echo $vendor->mobile; ?></p>
     <hr>        
   </div>
   <div class="col-md-4 venue-data">
    <div class="venue-info"><!-- venue-info-->
      <div class="capacity">
        <div>No of Restaurant:</div>
        <span class="cap-people"> <?php echo $resto_no ?> </span> </div>
        <div class="pricebox">
          <div>Booking Todays</div>
          <span class="price">0</span></div>
        </div>
        <hr style="margin-top: 34px;">
      </div>

      <div class="col-md-4">
        <div class="social-sidebar side-box" style="padding: 23px;">
          <ul class="listnone follow-icon">
            <li><a href="#"><i class="fa fa-facebook-square findhover2" style="color: #000;"></i></a></li>
            <li><a href="#"><i class="fa fa-google-plus-square findhover2" style="color: #000;"></i></a></li>
            <li><a href="#"><i class="fa fa-instagram findhover2" style="color: #000;"></i></a></li>
            <li><a href="#"><i class="fa fa-flickr findhover2" style="color: #000;"></i></a></li>
            <li><a href="#"><i class="fa fa-youtube-square findhover2" style="color: #000;"></i></a></li>
            <li><a href="#"><i class="fa fa-twitter-square findhover2" style="color: #000;"></i></a></li>
          </ul>
        </div>
        <hr style="margin-top: 35px;">
      </div>

    </div>
    <div class="row">
      <div class="col-md-12"> 
        <!-- Nav tabs -->
        <ul class="nav nav-tabs" role="tablist">
          <li role="presentation" class="<?php if( $active == 1 || $active == 'update_restaurant') echo "active"; ?>"><a href="#Restaurant" title="Restaurant" aria-controls="Restaurant" role="tab" data-toggle="tab"> <i class="fa fa-home"></i> <span class="tab-title">Restaurant</span></a></li>
          <li role="presentation" class="<?php if( $active == 2 || $active == 'update_discount') echo "active"; ?>"><a href="#Discount" title="Discount" aria-controls="Discount" role="tab" data-toggle="tab"> <i class="fa fa-percent"></i> <span class="tab-title">Discount</span></a></li>
          <li role="presentation" class="<?php if( $active == 3) echo "active"; ?>"><a href="#Reservation" title="Reservation" aria-controls="Reservation" role="tab" data-toggle="tab"> <i class="fa fa-bookmark"></i> <span class="tab-title">Reservation</span></a></li>
          <li role="presentation" class="<?php if( $active == 4) echo "active"; ?>"><a href="#reviews" title="Review" aria-controls="reviews" role="tab" data-toggle="tab"> <i class="fa fa-commenting"></i> <span class="tab-title">Reviews</span></a></li>
        </ul>

        <!-- Tab panes -->
        <div class="tab-content"><!-- tab content start-->
          <div role="tabpanel" class="tab-pane fade <?php if( $active == 1) echo "in active"; ?>" id="Restaurant">
            <table class="table table-hover table-condensed" id="example">
              <thead>
                <tr>
                  <th>S. no.</th>
                  <th>Name</th>
                  <th style="width:250px;">Start Time / End Time</th>
                  <th>Category</th>
                  <th>Level</th>
                  <th>Rating</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody class="timediscount">
              <?php if(isset($restaurantlist) and $restaurantlist != NULL) { ?>
                <?php $counter = 0;
                foreach ($restaurantlist as $restaurant) 
                  $category = $this->db->get_where('tbl_category', array('no' => $restaurant->category))->row();
                  { ?>
                <tr class="odd gradeX">
                  <td><?php echo ++$counter; ?></td>
                  <td><a style="color:#e41d27;" href=""><?php echo $restaurant->name;?></a></td>
                  <td><i class="fa fa-clock-o"></i> <?php echo $restaurant->start_time;?> / <?php echo $restaurant->end_time;?></td>
                  <td><?php echo $category->name;?></td>
                  <td style="width: 120px;">
                    <?php $level = $restaurant->level; 

                    $dont_show_button1 = "";
                    $dont_show_button2 = "";
                    $dont_show_button3 = "";
                    $dont_show_button4 = "";
                    $dont_show_button5 = "";

                    if($level == 1){
                      $dont_show_button1 = 'show';
                    } 
                    else if($level == 2){
                      $dont_show_button2 = "show";
                    }
                    else if($level == 3){
                      $dont_show_button3 ="show";
                    }
                    else if($level == 4){
                      $dont_show_button4 = "show";
                    }
                    else if($level == 5){
                      $dont_show_button5 = "show";
                    }
                    ?>
                    <div class="rating dont_show <?php echo $dont_show_button1 ?>"><i class="fa fa-usd"></i></div>

                    <div class="rating dont_show <?php echo $dont_show_button2 ?>"><i class="fa fa-usd"></i> <i class="fa fa-usd"></i> </div>

                    <div class="rating dont_show <?php echo $dont_show_button3 ?>"><i class="fa fa-usd"></i> <i class="fa fa-usd"></i> <i class="fa fa-usd"></i> </div>

                    <div class="rating dont_show <?php echo $dont_show_button4 ?>"><i class="fa fa-usd"></i> <i class="fa fa-usd"></i> <i class="fa fa-usd"></i> <i class="fa fa-usd"></i></div>

                    <div class="rating dont_show <?php echo $dont_show_button5 ?>"><i class="fa fa-usd"></i> <i class="fa fa-usd"></i> <i class="fa fa-usd"></i> <i class="fa fa-usd"></i> <i class="fa fa-usd"></i></div>
                  </td>
                  <td style="width: 120px;">
                    <?php $reviews = $restaurant->reviews; 

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

                    <div class="rating dont_show <?php echo $dont_show_button5 ?>"><i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i></div>
                  </td>
                  <td>
                    <div class="dropdown">
                      <button class="btn btn-default dropdown-toggle" id="menu1" type="button" data-toggle="dropdown">Option
                        <span class="caret"></span></button>
                        <ul class="dropdown-menu" role="menu" aria-labelledby="menu1">
                          <li role="presentation"><a role="menuitem" href="<?php echo base_url();?>index.php/VendorController/view_restaurant/<?php echo $restaurant->no;?>">Update</a></li>
                          <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Active</a></li>
                          <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Deactive</a></li>
                          <li role="presentation" class="divider"></li>
                          <li role="presentation"><a role="menuitem" tabindex="-1" href="<?php echo base_url();?>index.php/VendorController/delete_restaurant/<?php echo $restaurant->no;?>">Delete</a></li>       
                        </ul>
                      </div>
                    </td>
                  </tr>
                  <?php } ?>
                  <?php } else { } ?>
                </tbody>
              </table>              
              <a href="#add_restaurant" title="add_restaurant" aria-controls="add_restaurant" role="tab" data-toggle="tab" class="btn tp-btn-primary btn-lg">Add Restaurant</a>
            </div>
            <div role="tabpanel" class="tab-pane fade <?php if( $active == 'update_restaurant') echo "in active"; ?>" id="add_restaurant">
              <div class="row no-padding">
              <?php if(isset($selected_restaurant)) { ?>
              <form action="<?php echo base_url();?>index.php/VendorController/update_restaurant/<?php echo $selected_restaurant->no;?>" method="post" enctype="multipart/form-data">
                <?php } else { ?>                            
                <form action="<?php echo base_url();?>index.php/VendorController/add_restaurant" method="post" enctype="multipart/form-data">
                  <?php } ?>
                  <!-- level -->                  
                  <div class="form-group col-md-12 no-padding">
                    <label class=" control-label" for="reviewtitle">Level<span class="required">*</span></label>
                    <div class="rating-group">
                      <div class="radio radio-success radio-inline">
                        <input type="radio" name="radio2" id="radio21" value="1" checked <?php if(isset($selected_restaurant)) { if ($selected_restaurant->level == 1) echo "checked"; }?>>
                        <label for="radio21" class="radio-inline"> <span class="rating"><i class="fa fa-usd"></i></span> </label>
                      </div>
                      <div class="radio radio-success radio-inline">
                        <input type="radio" name="radio2" id="radio22" value="2" <?php if(isset($selected_restaurant)) { if ($selected_restaurant->level == 2) echo "checked"; }?>>
                        <label for="radio22" class="radio-inline"> <span class="rating"><i class="fa fa-usd"></i><i class="fa fa-usd"></i></span> </label>
                      </div>
                      <div class="radio radio-success radio-inline">
                        <input type="radio" name="radio2" id="radio23" value="3" <?php if(isset($selected_restaurant)) { if ($selected_restaurant->level == 3) echo "checked"; }?>>
                        <label for="radio23" class="radio-inline"> <span class="rating"><i class="fa fa-usd"></i><i class="fa fa-usd"></i><i class="fa fa-usd"></i></span> </label>
                      </div>
                      <div class="radio radio-success radio-inline">
                        <input type="radio" name="radio2" id="radio24" value="4" <?php if(isset($selected_restaurant)) { if ($selected_restaurant->level == 4) echo "checked"; }?>>
                        <label for="radio24" class="radio-inline"> <span class="rating"><i class="fa fa-usd"></i><i class="fa fa-usd"></i><i class="fa fa-usd"></i><i class="fa fa-usd"></i></span> </label>
                      </div>
                      <div class="radio radio-success radio-inline">
                        <input type="radio" name="radio2" id="radio25" value="5" <?php if(isset($selected_restaurant)) { if ($selected_restaurant->level == 5) echo "checked"; }?>>
                        <label for="radio25" class="radio-inline"> <span class="rating"><i class="fa fa-usd"></i><i class="fa fa-usd"></i><i class="fa fa-usd"></i><i class="fa fa-usd"></i><i class="fa fa-usd"></i></span> </label>
                      </div>
                    </div>
                  </div>
                  <!-- Text input-->
                  <div class="form-group col-md-6 no-padding">
                    <label class=" control-label" for="name">Name<span class="required">*</span></label>
                    <div class="">
                      <?php if(isset($selected_restaurant)) { ?>
                      <input id="name" name="name" type="text" placeholder="Name" class="form-control input-md" value="<?php echo $selected_restaurant->name; ?>" required>
                      <?php } else { ?>                            
                      <input id="name" name="name" type="text" placeholder="Name" class="form-control input-md" required>
                      <?php } ?>
                    </div>
                  </div>
                  <!-- Text input--> 
                  <div class="form-group col-md-3 no-padding">
                    <label class=" control-label" for="reviewtitle">Start Time<span class="required">*</span></label>
                    <div class="input-group clockpicker-with-callbacks">
                      <?php if(isset($selected_restaurant)) { ?>
                      <input type="text" class="form-control" name="start_time" value="<?php echo $selected_restaurant->start_time; ?>" required="required">
                      <?php } else { ?>                            
                      <input type="text" class="form-control" name="start_time" value="" required="required">
                      <?php } ?>
                      <span class="input-group-addon">
                        <span class="glyphicon glyphicon-time"></span>
                      </span>
                    </div>
                  </div>
                  <!-- Text input--> 
                  <div class="form-group col-md-3 no-padding">
                    <label class=" control-label" for="reviewtitle">End Time<span class="required">*</span></label>
                    <div class="input-group clockpicker-with-callbacks">
                      <?php if(isset($selected_restaurant)) { ?>
                      <input type="text" class="form-control" name="end_time" value="<?php echo $selected_restaurant->end_time; ?>" required="required">
                      <?php } else { ?>                            
                      <input type="text" class="form-control" name="end_time" value="" required="required">
                      <?php } ?>
                      <span class="input-group-addon">
                        <span class="glyphicon glyphicon-time"></span>
                      </span>
                    </div>
                  </div>
                  <div class="row">
                    <div class="form-group col-md-6 no-padding">
                      <!-- Text input-->
                      <div class="form-group" style="padding-left: 15px;">
                        <label class="control-label" for="categ">Category</label>
                          <select id="categ" name="categ" class="form-control" required="required">                   

                            <?php if(isset($selected_category)) { ?>
                            <option value="<?php echo $selected_category->category; ?>"><?php echo $selected_category->name; ?></option>
                            <option value="<?php echo $selected_category->category; ?>">----------------------</option>
                            <?php } else { ?>                            
                            <option value="">Select Category</option>
                            <?php } ?>

                            <?php foreach ($categorytlist as $category) { ?>
                            <option value="<?php echo $category->no; ?>">
                              <?php echo $category->name; ?>
                            </option>                            
                            <?php }?>
                          </select>
                      </div>

                      <div class="form-group" style="padding-left: 15px;">
                        <label class=" control-label" for="reviewtitle">Address<span class="required">*</span></label>
                        <div class="">
                          <?php if(isset($selected_restaurant)) { ?>
                          <input id="addresspicker_map" class="form-control" placeholder="Address" name="address" value="<?php echo $selected_restaurant->address; ?>" required>
                          <?php } else { ?>                            
                          <input id="addresspicker_map" class="form-control" placeholder="Address" name="address" value="" required="required">
                          <?php } ?>
                        </div>
                      </div>

                      <div class="form-group col-md-6 no-padding" style="padding-left: 15px;">
                        <label class=" control-label" for="reviewtitle">Latitude</label>
                        <div class="">
                          <?php if(isset($selected_restaurant)) { ?>
                          <input id="lat" type="text" class="form-control" name="lat" value="<?php echo $selected_restaurant->lat; ?>" readonly required>
                          <?php } else { ?>                            
                          <input id="lat" type="text" class="form-control" name="lat" value="" required="">
                          <?php } ?>
                        </div>
                      </div>

                      <div class="form-group col-md-6 no-padding">
                        <label class=" control-label" for="reviewtitle">Longitude</label>
                        <div class="">
                          <?php if(isset($selected_restaurant)) { ?>
                          <input id="lng" type="text" class="form-control" name="lng" value="<?php echo $selected_restaurant->lng; ?>" readonly required>
                          <?php } else { ?>                            
                          <input id="lng" type="text" class="form-control" name="lng" value="" required="">
                          <?php } ?>
                        </div>
                      </div>
                      <!-- Textarea -->
                      <div class="form-group" style="padding-left: 15px;">
                        <label class=" control-label">Description</label>
                        <div class="">
                          <?php if(isset($selected_restaurant)) { ?>
                          <textarea class="form-control" name="description" rows="4" placeholder="Description"><?php echo $selected_restaurant->about; ?></textarea>
                          <?php } else { ?>                            
                          <textarea class="form-control" name="description" rows="4" placeholder="Description"></textarea>
                          <?php } ?>
                        </div>
                      </div>  
                    </div>
                    <div class="form-group col-md-6 no-padding">
                      <label class=" control-label" for="reviewtitle">Location</label> 
                      <div id="map"></div>
                    </div>
                  </div>
                  <!-- Button -->
                  <div class="form-group" style="position: absolute;margin-top: 180px;">
                    <?php if(isset($selected_restaurant)) { ?>
                      <button name="submit" class="btn tp-btn-primary btn-lg">Update</button>                              
                      <a href="<?php echo base_url();?>index.php/VendorController/index/1" title="Restaurant" class="btn tp-btn-default btn-lg" style="background:black;">Back</a>
                    <?php } else { ?>
                      <button name="submit" class="btn tp-btn-primary btn-lg">Submit</button>                              
                      <a href="#Restaurant" title="Restaurant" aria-controls="Restaurant" role="tab" data-toggle="tab" class="btn tp-btn-default btn-lg" style="background:black;">Back</a>
                    <?php } ?>
                  </div>

                </form>

                <div class="image_upload_div" style="margin-bottom: 50px;">
                  <form action="<?php echo base_url()?>index.php/VendorController/upload_resto_image/" class="dropzone">
                    <div class="dz-message">
                      Drop files here or click to upload.<br>
                      <span class="note">(Upload Restaurant Image Here.)</span>
                    </div>
                  </form>
                </div>

                <?php if(isset($selected_restaurant)) { 
                    foreach($selected_image as $img)
                    { ?>                      
                        <div style="float: left; margin-top: 30px; margin-right: 30px; ">
                          <a href="javascript:void(0);" class="file_delete" data-id="<?php echo $img->no ?>"><i class="fa fa-times" aria-hidden="true" style="position: absolute;color: #e51d27;margin-top: 10px;margin-left: 10px;z-index: 999;"></i></a>
                          <img data-dz-thumbnail=""  src="<?php echo base_url(); ?><?php echo $img->image; ?>" style="border-radius: 20px;width: 120px;height: 120px;border:1px solid;position: relative;display: block;z-index: 10;">
                        </div>
                    <?php }
                  } ?> 

                </div>
              </div>


              <div role="tabpanel" class="tab-pane fade <?php if( $active == 2) echo "in active"; ?>" id="Discount">
                <table class="table table-hover table-condensed" id="example4">
                  <thead>
                    <tr>
                      <th>S. no.</th>
                      <th>Restaurant Name</th>
                      <th>Discount Time / Discount Persent</th>
                      <th>No. of People</th>
                      <th>status</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody class="timediscount">

                    <?php $counter = 0;
                    foreach ($discountdatalist as $data) { 
                      $discount_data = $this->db->get_where('tbl_base_discount', array('no' => $data->did))->row()->percent;
                      ?>
                      <tr class="odd gradeX">
                        <td><?php echo ++$counter; ?></td>
                        <td><?php echo  $data->name; ?></td>
                        <td>
                          <div class="row">
                            <span class="col-md-6" style="width: 19%;"><i class="fa fa-clock-o"></i> <?php echo  $data->rtime; ?> </span>
                            <span class="col-md-1"><i class="fa fa-arrow-right"></i></span>
                            <span class="col-md-5"> <?php echo  $discount_data; ?> % </span>
                          </div>
                        </td>
                        <td><?php echo  $data->amount; ?></td>
                        <td>
                          <?php if($data->status == 1) { ?>
                          Active
                          <?php } else { ?>
                          Deactive
                          <?php } ?>
                        </td>
                        <td>
                          <div class="dropdown">
                            <button class="btn btn-default dropdown-toggle" id="menu1" type="button" data-toggle="dropdown">Option
                              <span class="caret"></span></button>
                              <ul class="dropdown-menu" role="menu" aria-labelledby="menu1">
                                <li role="presentation"><a role="menuitem" href="<?php echo base_url();?>index.php/VendorController/view_discount/<?php echo $data->no;?>">Update</a></li>
                                <li role="presentation" class="divider"></li>
                                <li role="presentation"><a role="menuitem" href="<?php echo base_url();?>index.php/VendorController/delete_discount/<?php echo $data->no;?>">Delete</a></li>       
                              </ul>
                            </div>
                          </td>
                        </tr>
                        <?php } ?>

                      </tbody>
                    </table>
                    <a href="#add_discount" title="add_discount" aria-controls="add_discount" role="tab" data-toggle="tab" class="btn tp-btn-primary btn-lg">Add Discount</a>
                  </div>
                  <div role="tabpanel" class="tab-pane fade <?php if( $active == 'update_discount') echo "in active"; ?>" id="add_discount"> 

                    <?php if(isset($selected_discount)) { ?>
                    <form action="<?php echo base_url();?>index.php/VendorController/update_discount/<?php echo $selected_discount->no;?>" method="post">
                      <?php } else { ?>                            
                      <form action="<?php echo base_url();?>index.php/VendorController/add_discount" method="post">
                        <?php } ?>

                        <!-- Text input-->                           
                        <div class="form-group col-md-6 no-padding">
                          <label class="control-label" for="resto">Restaurant Name</label>
                          <select id="resto" name="resto" class="form-control" required="required">                   

                            <?php if(isset($selected_discount)) { ?>
                            <option value="<?php echo $selected_discount->rid; ?>"><?php echo $selected_discount->name; ?></option>
                            <option value="<?php echo $selected_discount->rid; ?>">----------------------</option>
                            <?php } else { ?>                            
                            <option value="">Select Restaurant</option>
                            <?php } ?>

                            <?php foreach ($restaurantlist as $resto) { ?>
                            <option value="<?php echo $resto->no; ?>">
                              <?php echo $resto->name; ?>
                            </option>                            
                            <?php }?>
                          </select>
                        </div>
                        <!-- Text input-->
                        <div class="form-group col-md-6 no-padding">
                          <label class=" control-label" for="discount_time">Discount Time</label>
                          <div class="input-group clockpicker-with-callbacks">

                            <?php if(isset($selected_discount)) { ?>
                            <input type="text" class="form-control" name="discount_time" value="<?php echo $selected_discount->rtime; ?>" required="required">
                            <?php } else { ?>                            
                            <input type="text" class="form-control" name="discount_time" value="" required="required">
                            <?php } ?>

                            <span class="input-group-addon">
                              <span class="glyphicon glyphicon-time"></span>
                            </span>
                          </div>
                        </div>
                        <!-- Textarea -->
                        <div class="form-group col-md-6 no-padding">
                          <label class=" control-label">Discount %</label>
                          <select id="discount" name="discount" class="form-control" required="required">

                            <?php if(isset($selected_discount)) {
                              $discountdata = $this->db->get_where('tbl_base_discount', array('no' => $selected_discount->did))->row();
                              ?>
                              <option value="<?php echo $discountdata->no; ?>"><?php echo $discountdata->percent; ?></option>
                              <option value="<?php echo $discountdata->no; ?>">----------------------</option>
                              <?php } else { ?>                            
                              <option value="">Select Discount</option>
                              <?php } ?>

                              <?php foreach ($discountlist as $discount) { ?>
                              <option value="<?php echo $discount->no; ?>">
                                <?php echo $discount->percent; ?>
                              </option>                            
                              <?php }?>
                            </select>
                          </div> 
                          <!-- Textarea -->
                          <div class="form-group col-md-6 no-padding">
                            <label class=" control-label">NO. of People</label>
                            <div class="">
                              <?php if(isset($selected_discount)) { ?>
                              <input id="no_people" type="text" class="form-control" placeholder="Number of People" name="no_people" value="<?php echo $selected_discount->amount; ?>" required="required">
                              <?php } else { ?>                            
                              <input id="no_people" type="text" class="form-control" placeholder="Number of People" name="no_people" value="" required="required">
                              <?php } ?>
                            </div>
                          </div>   
                          <!-- Button -->
                          <div class="form-group">
                            <?php if(isset($selected_discount)) { ?>
                              <button name="submit" class="btn tp-btn-primary btn-lg">Update</button>                              
                              <a href="<?php echo base_url();?>index.php/VendorController/index/2" title="Restaurant" class="btn tp-btn-default btn-lg" style="background:black;">Back</a>
                            <?php } else { ?>
                              <button name="submit" class="btn tp-btn-primary btn-lg">Submit</button>                              
                              <a href="#Restaurant" title="Restaurant" aria-controls="Restaurant" role="tab" data-toggle="tab" class="btn tp-btn-default btn-lg" style="background:black;">Back</a>
                            <?php } ?>
                          </div>
                        </form>
                      </div>
                      <div role="tabpanel" class="tab-pane fade <?php if( $active == 4) echo "in active"; ?>" id="reviews"> 
                        <!-- comments -->
                        <div class="customer-review">
                          <div class="row">
                            <div class="col-md-12">
                              <div class="review-list"> 
                                <!-- First Comment -->
                                <div class="row">
                                  <div class="col-md-2 col-sm-2 hidden-xs">
                                    <div class="user-pic"> <img class="img-responsive img-circle" src="<?php echo base_url(); ?>images/userpic.jpg" alt=""> </div>
                                  </div>
                                  <div class="col-md-10 col-sm-10">
                                    <div class="panel panel-default arrow left">
                                      <div class="panel-body">
                                        <div class="text-left">
                                          <h3>The whole experience was Excellent</h3>
                                          <div class="rating"> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star-o"></i> </div>
                                        </div>
                                        <div class="review-post">
                                          <p> From initially being shown round through booking to breakfast the next morning. Nam eu enim mollis urna egestas interdum eget quis nisl. Ut sem velit, scelerisque nec commodo consequat, imperdiet non diam. </p>
                                        </div>
                                        <div class="review-user">By <a href="#">Jaisy and Kartin</a>, on <span class="review-date"></span>04 Apr 2015</div>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                                <!-- Second Comment -->
                                <div class="row">
                                  <div class="col-md-2 col-sm-2 hidden-xs">
                                    <div class="user-pic"> <img class="img-responsive img-circle" src="<?php echo base_url(); ?>images/userpic.jpg" alt=""> </div>
                                  </div>
                                  <div class="col-md-10 col-sm-10">
                                    <div class="panel panel-default arrow left">
                                      <div class="panel-body">
                                        <div class="text-left">
                                          <h3>The Facilities were Fantastic!</h3>
                                          <div class="rating"> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star-o"></i> </div>
                                        </div>
                                        <div class="review-post">
                                          <p> Curabitur mattis congue consectetur. Nulla facilisis dictum velit, ultrices imperdiet diam luctus quis. Vestibulum in volutpat purus, quis accumsan diam. The pastry heart on the pie was such a lovely touch that you could easily not have done. </p>
                                        </div>
                                        <div class="review-user">By <a href="#">Jaisy and Kartin</a>, on <span class="review-date"></span>04 Apr 2015</div>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                                <!-- Third Comment -->
                                <div class="row">
                                  <div class="col-md-2 col-sm-2 hidden-xs">
                                    <div class="user-pic"> <img class="img-responsive img-circle" src="<?php echo base_url(); ?>images/userpic.jpg" alt=""> </div>
                                  </div>
                                  <div class="col-md-10 col-sm-10">
                                    <div class="panel panel-default arrow left">
                                      <div class="panel-body">
                                        <div class="text-left">
                                          <h3> Aenean elementum dictum estsit amet ullamcorper</h3>
                                          <div class="rating"> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star-o"></i> </div>
                                        </div>
                                        <div class="review-post">
                                          <p> Vivamus condimentum orci non tellus tincidunt volutpat. Suspendisse gravida gravida arcu a pellentesque. Duis aliquet ut justo et accumsan. </p>
                                        </div>
                                        <div class="review-user">By <a href="#">Jaisy and Kartin</a>, on <span class="review-date"></span>04 Apr 2015</div>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div role="tabpanel" class="tab-pane fade <?php if( $active == 3) echo "in active"; ?>" id="Reservation"> 
                        <table class="table table-hover table-condensed" id="example">
                          <thead>
                            <tr>
                              <th>User Name</th>
                              <th>Menu Item</th>
                              <th>Date</th>
                              <th>Time</th>
                              <th>Discount</th>
                              <th>Price</th>
                              <th>Action</th>
                            </tr>
                          </thead>
                          <tbody class="timediscount">
                            <tr class="odd gradeX">
                              <td>aaaaa</td>
                              <td>aaaaa</td>
                              <td>12/03/2017</td>
                              <td>12 : 30 PM</td>
                              <td>20 %</td>
                              <td>$ 25</td>
                              <td>
                                <div class="dropdown">
                                  <button class="btn btn-default dropdown-toggle" id="menu1" type="button" data-toggle="dropdown">Option
                                    <span class="caret"></span></button>
                                    <ul class="dropdown-menu" role="menu" aria-labelledby="menu1">
                                      <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Message</a></li>
                                      <li role="presentation" class="divider"></li>
                                      <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Cancel Booking</a></li>       
                                    </ul>
                                  </div>
                                </td>
                              </tr>
                              <tr class="odd gradeX">
                                <td>aaaaa</td>
                                <td>aaaaa</td>
                                <td>12/03/2017</td>
                                <td>12 : 30 PM</td>
                                <td>20 %</td>
                                <td>$ 25</td>
                                <td>
                                  <div class="dropdown">
                                    <button class="btn btn-default dropdown-toggle" id="menu1" type="button" data-toggle="dropdown">Option
                                      <span class="caret"></span></button>
                                      <ul class="dropdown-menu" role="menu" aria-labelledby="menu1">
                                        <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Message</a></li>
                                        <li role="presentation" class="divider"></li>
                                        <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Cancel Booking</a></li>       
                                      </ul>
                                    </div>
                                  </td>
                                </tr>
                              </tbody>
                            </table>
                          </div>

                        </div>
                        <!-- /.tab content start--> 
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
                      <form action="<?php echo base_url();?>index.php/VendorController/update_profile" method="post">        
                        <div class="modal-body">



                          <!-- Text input-->
                          <div class="form-group">
                            <div class="">
                              <input id="name" name="name" type="text" placeholder="Name" value="<?php echo $vendor->name ?>" class="form-control" required>
                            </div>
                          </div>
                          <!-- Text input--> 
                          <div class="form-group">
                            <div class="">
                              <input id="address" name="address" type="text" placeholder="Address" value="<?php echo $vendor->address ?>" class="form-control" required>
                            </div>
                          </div>
                          <!-- Text input--> 
                          <div class="form-group col-md-6 no-padding">
                            <div class="">
                              <input id="email" name="email" type="text" placeholder="Email Address" value="<?php echo $vendor->email ?>" class="form-control" required>
                            </div>
                          </div>
                          <!-- Text input--> 
                          <div class="form-group col-md-6 no-padding">
                            <div class="">
                              <input id="mobile" name="mobile" type="text" placeholder="Mobile Number" value="<?php echo $vendor->mobile ?>" class="form-control" required>
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


<script>
  $(".file_delete").click(function(){
    var id=$(this).data("id");

    $.ajax({
      url : "<?php echo base_url(); ?>index.php/VendorController/delete_image/"+id, 
      success:function(data)
      {
        var response = JSON.parse(data);
        if(response.status == 'done')
        {
          location.reload(true);
        }
      }
    });
    
  });
</script>