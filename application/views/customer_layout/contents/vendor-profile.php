<link href="<?php echo base_url();?>css/jquery.multiselect.css" rel="stylesheet" type="text/css">


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
    <div class="row tab-page-header" style="<?php if ($this->session->flashdata('img_error') != "") echo "margin-bottom:-30px;";?>">
      <div class="col-md-4  vendor-profile-block">
        <div class="vendor-profile"> 
          <form class="text-center" action="<?php echo base_url();?>index.php/VendorController/update_picture" method="post" enctype="multipart/form-data">
            <div class="fileinput fileinput-new text-center" data-provides="fileinput">
              <div class="fileinput-new thumbnail" style="width: 317px; height: 236px; border:none;" data-trigger="fileinput">
                <?php if(isset($vendor) and $vendor->image != NULL) { ?>
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
     <div class="col-md-8 venue-data">
      <div class="venue-info"><!-- venue-info-->
        <div class="capacity">
          <div>Restaurants :</div>
          <span class="cap-people"> <?php echo $resto_no ?> </span> </div>
          <div class="pricebox">
            <div>Booking Todays</div>
            <span class="price">0</span></div>
          </div>
          <hr style="margin-top: 34px;">
        </div>
      </div>

      <?php if ($this->session->flashdata('img_error') != ""){ ?>
      <div class="alert alert-warning alert-dismissable" style="color:red;">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <strong>Warnig!</strong> <?php echo $this->session->flashdata('img_error');?>
      </div>
      <?php  } ?>


      <div class="row">
        <div class="col-md-12"> 
          <!-- Nav tabs -->
          <ul class="nav nav-tabs" role="tablist">
            <li role="presentation" class="<?php if( $active == 1 || $active == 'update_restaurant') echo "active"; ?>"><a href="#Restaurant" title="Restaurant" aria-controls="Restaurant" role="tab" data-toggle="tab"> <i class="fa fa-home"></i> <span class="tab-title">Restaurant</span></a></li>
            <li role="presentation" class="<?php if( $active == 2 || $active == 'update_discount') echo "active"; ?>"><a href="#Discount" title="Discount" aria-controls="Discount" role="tab" data-toggle="tab"> <i class="fa fa-percent"></i> <span class="tab-title">Discount</span></a></li>
            <li role="presentation" class="<?php if( $active == 3 || $active == 'view_reservation') echo "active"; ?>"><a href="#Reservation" title="Reservation" aria-controls="Reservation" role="tab" data-toggle="tab"> <i class="fa fa-bookmark"></i> <span class="tab-title">Reservation</span></a></li>
            <li role="presentation" class="<?php if( $active == 4) echo "active"; ?>"><a href="#reviews" title="Review" aria-controls="reviews" role="tab" data-toggle="tab"> <i class="fa fa-commenting"></i> <span class="tab-title">Reviews</span></a></li>
          </ul>

          <!-- Tab panes -->
          <div class="tab-content"><!-- tab content start-->
            <div role="tabpanel" class="tab-pane fade <?php if( $active == 1) echo "in active"; ?>" id="Restaurant">
              <table class="table table-hover table-condensed" id="example">
                <thead>
                  <tr>
                    <th>Restaurant Name</th>
                    <th>Status</th>
                    <th>Sub Category</th>
                    <th>Level</th>
                    <th>Rating</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody class="timediscount">
                  <?php if(isset($restaurantlist) and $restaurantlist != NULL) { ?>
                  <?php foreach ($restaurantlist as $restaurant) { 
                    ?>
                    <tr class="odd gradeX">
                      <td><a style="color:#e41d27;" href="<?php echo base_url();?>index.php/CustomerController/restaurantdetails/<?php echo $restaurant->no; ?>"><?php echo $restaurant->name;?></a></td>
                      <td class="row">                        
                        <?php if(isset($restaurant->status) and $restaurant->status != NULL) {
                          if($restaurant->status == 0) echo "<span style='color:green'>Open</span>";
                          else echo "<span style='color:red'>Close</span>";
                        } ?>
                      </td>
                      <td>
                        <?php
                        $subcategorylisttoshow = $this->db->get_where('tbl_map_sub_restaurant', array('rid' => $restaurant->no))->result();
                          foreach ($subcategorylisttoshow as $subcategorytoshow) { 
                            $subcategoryname = $this->db->get_where('tbl_subcategory', array('no' => $subcategorytoshow->sid))->row();
                              echo $subcategoryname->name;
                              echo "<br>";
                          }
                        ?>
                      </td>
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
                          <li role="presentation" class="divider"></li>
                          <li role="presentation"><a role="menuitem" tabindex="-1" href="<?php echo base_url();?>index.php/VendorController/delete_restaurant/<?php echo $restaurant->no;?>"  onclick="return confirm('Are you sure you want to delete this item?');">Delete</a></li> 
                          <li role="presentation" class="divider"></li>
                          <?php if(isset($restaurant->status) and $restaurant->status != NULL) { if($restaurant->status == 0) { ?>
                          <li role="presentation"><a role="menuitem" tabindex="-1" href="<?php echo base_url();?>index.php/VendorController/open_restaurant/<?php echo $restaurant->no;?>">Open</a></li>                           
                          <?php } else { ?>
                          <li role="presentation"><a role="menuitem" tabindex="-1" href="<?php echo base_url();?>index.php/VendorController/close_restaurant/<?php echo $restaurant->no;?>">Close</a></li> 
                          <?php } } ?>
                        </ul>
                      </div>
                    </td>
                  </tr>
                  <?php } ?>
                  <?php } else { } ?>
                </tbody>
              </table>              
              <a href="<?php echo base_url();?>index.php/VendorController/add_restaurant_page" title="Restaurant" class="btn tp-btn-primary btn-lg">Add Restaurant</a>

            </div>
            <div role="tabpanel" class="tab-pane fade <?php if( $active == 'update_restaurant') echo "in active"; ?>" id="add_restaurant">
              <div class="row no-padding">
                <?php if(isset($selected_restaurant)) { ?>
                <form action="<?php echo base_url();?>index.php/VendorController/update_restaurant/<?php echo $selected_restaurant->no;?>" method="post" enctype="multipart/form-data">
                  <?php } else { ?>                            
                  <form action="<?php echo base_url();?>index.php/VendorController/add_restaurant" method="post" enctype="multipart/form-data">
                    <?php } ?>
                    <!-- level -->  

                    <div class="form-group col-md-6 no-padding" style="margin-bottom: 13px;">
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

                    <div class="form-group col-md-6 no-padding">
                      <label class=" control-label" for="reviewtitle">Languages</label>
                      <div class="rating-group">

                        <?php foreach ($languagelist as $languagelist) { ?>                   
                        <label class="checkbox-inline">
                          <input type="checkbox" name="langu[]" value="<?php echo $languagelist->no; ?>"                 
                          <?php if(isset($selected_language) and $selected_language != NULL) {
                            foreach ($selected_language as $language) {
                             if($languagelist->no == $language->lid) echo "checked";
                           } } ?> 
                           >
                           <?php echo $languagelist->name; ?>
                         </label>
                         <?php  } ?>    

                       </div>
                     </div>
                     <!-- Text input-->
                     <div class="form-group col-md-9 no-padding">
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
                      <label class=" control-label" for="reviewtitle">Click For Timing<span class="required">*</span></label>
                      <div class=""> 
                        <?php if(isset($selected_restaurant) and $selected_restaurant != NULL) { ?>            
                        <button type="button" class="btn btn-success btn-lg" data-toggle="modal" data-target="#addrestauranttiming" style="width: 100%; height: 47px;padding: 14px;">Update Restaurant Timing</button>  
                        <?php } else { ?>           
                        <button type="button" class="btn btn-success btn-lg" data-toggle="modal" data-target="#addrestauranttimingnew" style="width: 100%; height: 47px;padding: 14px;">Add Restaurant Timing</button>  
                        <?php } ?>              
                      </div>  
                    </div>
                    <div id="addrestauranttimingnew" class="modal fade" role="dialog">
                        <div class="modal-dialog">
                          <!-- Modal content-->
                          <div class="modal-content">
                            <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                              <h4 class="modal-title">Modal Header</h4>
                            </div>
                            <div class="modal-body" style="padding: 22px;">
                             <div class="input-group control-group">
                              <div class="form-group col-md-2 no-padding">
                                <label class=" control-label" for="reviewtitle">Days</label>
                                <div class="input-group">
                                  <label style="padding: 11px 0 0 0;">Monday</label>
                                </div>
                              </div>
                              <div class="form-group col-md-5 no-padding">
                                <label class=" control-label" for="reviewtitle">Start Time</label>
                                <div class="input-group clockpicker-with-callbacks">
                                  <input type="text" class="form-control" name="mon_starttime" value="">
                                  <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-time"></span>
                                  </span>
                                </div>
                              </div>
                              <!-- Text input--> 
                              <div class="form-group col-md-5 no-padding">
                                <label class=" control-label" for="reviewtitle">End Time</label>
                                <div class="input-group clockpicker-with-callbacks">
                                  <input type="text" class="form-control" name="mon_endtime" value="">
                                  <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-time"></span>
                                  </span>
                                </div>
                              </div>
                              <div class="form-group col-md-2 no-padding">
                                <div class="input-group">
                                  <label style="padding: 11px 0 0 0;">Tuesday</label>
                                </div>
                              </div>
                              <div class="form-group col-md-5 no-padding">
                                <div class="input-group clockpicker-with-callbacks">
                                  <input type="text" class="form-control" name="tue_starttime" value="">
                                  <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-time"></span>
                                  </span>
                                </div>
                              </div>
                              <!-- Text input--> 
                              <div class="form-group col-md-5 no-padding">
                                <div class="input-group clockpicker-with-callbacks">   
                                  <input type="text" class="form-control" name="tue_endtime" value="">
                                  <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-time"></span>
                                  </span>
                                </div>
                              </div>
                              <div class="form-group col-md-2 no-padding">
                                <div class="input-group">
                                  <label style="padding: 11px 0 0 0;">Wednesday</label>
                                </div>
                              </div>
                              <div class="form-group col-md-5 no-padding">
                                <div class="input-group clockpicker-with-callbacks">
                                  <input type="text" class="form-control" name="wed_starttime" value="">
                                  <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-time"></span>
                                  </span>
                                </div>
                              </div>
                              <!-- Text input--> 
                              <div class="form-group col-md-5 no-padding">
                                <div class="input-group clockpicker-with-callbacks">
                                  <input type="text" class="form-control" name="wed_endtime" value="">
                                  <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-time"></span>
                                  </span>
                                </div>
                              </div>
                              <div class="form-group col-md-2 no-padding">
                                <div class="input-group">
                                  <label style="padding: 11px 0 0 0;">Thursday</label>
                                </div>
                              </div>
                              <div class="form-group col-md-5 no-padding">
                                <div class="input-group clockpicker-with-callbacks">
                                  <input type="text" class="form-control" name="thu_starttime" value="">
                                  <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-time"></span>
                                  </span>
                                </div>
                              </div>
                              <!-- Text input--> 
                              <div class="form-group col-md-5 no-padding">
                                <div class="input-group clockpicker-with-callbacks">
                                  <input type="text" class="form-control" name="thu_endtime" value="">
                                  <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-time"></span>
                                  </span>
                                </div>
                              </div>
                              <div class="form-group col-md-2 no-padding">
                                <div class="input-group">
                                  <label style="padding: 11px 0 0 0;">Friday</label>
                                </div>
                              </div>
                              <div class="form-group col-md-5 no-padding">
                                <div class="input-group clockpicker-with-callbacks">
                                  <input type="text" class="form-control" name="fri_starttime" value="">
                                  <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-time"></span>
                                  </span>
                                </div>
                              </div>
                              <!-- Text input--> 
                              <div class="form-group col-md-5 no-padding">
                                <div class="input-group clockpicker-with-callbacks">
                                  <input type="text" class="form-control" name="fri_endtime" value="">
                                  <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-time"></span>
                                  </span>
                                </div>
                              </div>
                              <div class="form-group col-md-2 no-padding">
                                <div class="input-group">
                                  <label style="padding: 11px 0 0 0;">Saturday</label>
                                </div>
                              </div>
                              <div class="form-group col-md-5 no-padding">
                                <div class="input-group clockpicker-with-callbacks">
                                  <input type="text" class="form-control" name="sat_starttime" value="">
                                  <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-time"></span>
                                  </span>
                                </div>
                              </div>
                              <!-- Text input--> 
                              <div class="form-group col-md-5 no-padding">
                                <div class="input-group clockpicker-with-callbacks">
                                  <input type="text" class="form-control" name="sat_endtime" value="">
                                  <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-time"></span>
                                  </span>
                                </div>
                              </div>
                              <div class="form-group col-md-2 no-padding">
                                <div class="input-group">
                                  <label style="padding: 11px 0 0 0;">Sunday</label>
                                </div>
                              </div>
                              <div class="form-group col-md-5 no-padding">
                                <div class="input-group clockpicker-with-callbacks">           
                                  <input type="text" class="form-control" name="sun_starttime" value="">
                                  <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-time"></span>
                                  </span>
                                </div>
                              </div>
                              <!-- Text input--> 
                              <div class="form-group col-md-5 no-padding">
                                <div class="input-group clockpicker-with-callbacks">                           
                                  <input type="text" class="form-control" name="sun_endtime" value="">
                                  <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-time"></span>
                                  </span>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn tp-btn-primary" data-dismiss="modal">Add</button>
                            <button type="button" class="btn tp-btn-default" data-dismiss="modal">Close</button>
                          </div>   
                        </div>
                      </div>
                    </div>
                    <!-- Text input--> 
                    <div class="row">
                      <div class="form-group col-md-6 no-padding">
                        <!-- Text input-->
                        <div class="form-group col-md-6 no-padding" style="padding-left: 15px;">
                          <label class="control-label" for="categ">Facilities<span class="required">*</span></label>  
                          <select class="form-control" name="factOpt[]" multiple id="factOpt" required="required">    
                            <?php foreach ($facilitylist as $facility) { 
                              $str_flag = "";                              
                              if(isset($selected_facilitylist) and $selected_facilitylist != NULL) {
                                foreach ($selected_facilitylist as $selected_facility) {
                                  if($facility->no == $selected_facility->fid) {
                                   $str_flag = "selected"; 
                                   break;
                                  }
                                  else $str_flag="";
                                }
                              }  
                            ?>
                            <option value="<?php echo $facility->no; ?>" <?php echo $str_flag; ?> ><?php echo $facility->name; ?></option>
                            <?php } ?>
                          </select>
                        </div>
                        <!-- Text input-->
                        <div class="form-group col-md-6 no-padding">
                          <label class="control-label" for="categ">Sub Category<span class="required">*</span></label>  
                          <select class="form-control" name="subcateOpt[]" multiple id="langOpt" required="required">    
                            <?php foreach ($subcategorytlist as $subcategory) { 
                              $str_flag = "";                              
                              if(isset($selected_subcategorytlist) and $selected_subcategorytlist != NULL) {
                                foreach ($selected_subcategorytlist as $selected_subcategory) {
                                  if($subcategory->no == $selected_subcategory->sid) {
                                   $str_flag = "selected"; 
                                   break;
                                  }
                                  else $str_flag="";
                                }
                              }  
                            ?>
                            <option value="<?php echo $subcategory->no; ?>" <?php echo $str_flag; ?> ><?php echo $subcategory->name; ?></option>
                            <?php } ?>
                          </select>
                        </div>
                        <div class="form-group col-md-12 no-padding" style="padding-left: 15px;">
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
                        <span class="note" style="color:red;"><small>( Please Choose Atleast one image of Restaurant* )</small></span>
                      </div>
                    </form>
                  </div>

                  <?php if(isset($selected_restaurant)) { 
                    foreach($selected_image as $img)
                      { ?>                      
                    <div id="image_block<?php echo $img->no ?>" style="float: left; margin-top: 30px; margin-right: 30px; ">
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
                      <th>Restaurant Name</th>
                      <th>Discount Time / Discount Persent</th>
                      <th>No. of People</th>
                      <th>status</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody class="timediscount">

                    <?php foreach ($discountdatalist as $data) { 
                      $discount_data = $this->db->get_where('tbl_base_discount', array('no' => $data->did))->row()->percent;
                      ?>
                      <tr class="odd gradeX">
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
                                <li role="presentation"><a role="menuitem" href="<?php echo base_url();?>index.php/VendorController/delete_discount/<?php echo $data->no;?>"  onclick="return confirm('Are you sure you want to delete this item?');">Delete</a></li>       
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
                        <div class="form-group col-md-3 no-padding">
                          <label class=" control-label" for="discount_time">Discount Date</label>
                          <div class="input-group">

                            <?php if(isset($selected_discount)) { ?>
                            <input class="form-control" id="date" name="discount_date" placeholder="MM/DD/YYYY" type="text" value="<?php echo $selected_discount->date; ?>" required="required">
                            <?php } else { ?>                            
                            <input class="form-control" id="date" name="discount_date" placeholder="MM/DD/YYYY" type="text" value="" required="required">
                            <?php } ?>

                            <span class="input-group-addon">
                              <span class="glyphicon glyphicon-calendar"></span>
                            </span>
                          </div>
                        </div>
                        <!-- Textarea -->
                        <div class="form-group col-md-3 no-padding">
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
                            <a href="#Discount" title="Restaurant" aria-controls="Restaurant" role="tab" data-toggle="tab" class="btn tp-btn-default btn-lg" style="background:black;">Back</a>
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

                                <?php foreach ($restaurantlist as $resto_data) { 
                                  $restaurantreviews = $this->db->get_where('tbl_review_restaurant', array('rid' => $resto_data->no))->result();

                                  if (isset($restaurantreviews) and $restaurantreviews != NULL) { 
                                    foreach ($restaurantreviews as $restaurantreview) {
                                      $user = $this->db->get_where('tbl_user', array('no' => $restaurantreview->uid))->row();
                                      ?>
                                      <div class="row">
                                        <div class="col-md-2 col-sm-2 hidden-xs">
                                          <div class="user-pic"> 
                                            <?php if(isset($user) and $user->image != NULL) { ?>
                                            <img  class="img-responsive img-circle" src="<?php echo base_url();?><?php echo $user->image; ?>" alt="">
                                            <?php } else { ?> 
                                            <img src="http://placehold.it/50x50" alt="">                           
                                            <?php } ?>
                                          </div>
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
                                    } ?>

                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div role="tabpanel" class="tab-pane fade <?php if( $active == 3) echo "in active"; ?>" id="Reservation"> 
                            <table class="table table-hover table-condensed" id="example3">
                              <thead>
                                <tr>
                                  <th>Restaurant</th>
                                  <th>User</th>
                                  <th>Booking Date</th>
                                  <th>Time / Discount</th>
                                  <th>Price</th>
                                  <th>Status</th>
                                  <th style="width:100px;">Action</th>
                                </tr>
                              </thead>
                              <tbody class="timediscount">
                                <?php foreach ($restaurantlist as $resto_data) { 
                                  $reservationlist = $this->db->get_where('tbl_reservation', array('rid' => $resto_data->no))->result();

                                  foreach ($reservationlist as $reservation) { 

                                    $user = $this->db->get_where('tbl_user', array('no' => $reservation->uid))->row();
                                    $rastaurant = $this->db->get_where('tbl_restaurant', array('no' => $reservation->rid))->row();
                                    $discount = $this->db->get_where('tbl_map_discount_restaurant', array('no' => $reservation->did))->row();
                                    $discount_data = $this->db->get_where('tbl_base_discount', array('no' => $discount->did))->row();

                                    ?>
                                    <tr class="odd gradeX">
                                      <td><?php echo  $rastaurant->name; ?></td>
                                      <td><?php echo  $user->name; ?></td>
                                      <td><?php echo  $reservation->date; ?></td>
                                      <td><i class="fa fa-clock-o"></i> <?php echo  $discount->rtime; ?> / <?php echo  $discount_data->percent; ?>%</td>
                                      <td><?php echo  $discount->price; ?></td>
                                      <td>
                                        <?php if($reservation->state == 0) { ?>
                                        Process
                                        <?php } else if ($reservation->state == 1) { ?>
                                        Complete
                                        <?php } else if ($reservation->state == 3) { ?>
                                        Cancel
                                        <?php } ?>
                                      </td>
                                      <td>
                                        <div class="dropdown">
                                          <button class="btn btn-default dropdown-toggle" id="menu1" type="button" data-toggle="dropdown">Option
                                            <span class="caret"></span></button>
                                            <ul class="dropdown-menu" role="menu" aria-labelledby="menu1">
                                              <li role="presentation"><a role="menuitem" href="<?php echo base_url();?>index.php/VendorController/view_reservation/<?php echo $reservation->no; ?>">View</a></li>
                                              <li role="presentation" class="divider"></li>
                                              <li role="presentation"><a role="menuitem" href="<?php echo base_url();?>index.php/VendorController/complete_reservation/<?php echo $reservation->no; ?>" onclick="return confirm('Are you sure you want to Complete this Reservation ?');">Complete Booking</a></li>   
                                              <li role="presentation" class="divider"></li>
                                              <li role="presentation"><a role="menuitem" href="<?php echo base_url();?>index.php/VendorController/cancel_reservation/<?php echo $reservation->no; ?>" onclick="return confirm('Are you sure you want to Cancel this Reservation ?');">Cancel Booking</a></li>       
                                            </ul>
                                          </div>
                                        </td>
                                      </tr>
                                      <?php }
                                    } ?>                     

                                  </tbody>
                                </table>
                              </div>
                              <div role="tabpanel" class="tab-pane fade <?php if( $active == 'view_reservation') echo "in active"; ?>" id="view_reservation"> 
                                <div class="row no-padding">
                                  <form action="" method="post" enctype="multipart/form-data">

                                    <div class="form-group col-md-4 no-padding">
                                      <label class=" control-label" for="reviewtitle">Restaurant Name</label>
                                      <div class="">
                                        <?php if(isset($restaurant) and $restaurant != NULL) { ?>
                                        <input class="form-control" value="<?php echo $restaurant->name; ?>" readonly>
                                        <?php } else { ?> 
                                        <input class="form-control" placeholder="Restaurant Name" value="" readonly>
                                        <?php } ?>
                                      </div>
                                    </div>

                                    <div class="form-group col-md-4 no-padding">
                                      <label class=" control-label" for="reviewtitle">User Name</label>
                                      <div class="">
                                        <?php if(isset($user) and $user != NULL) { ?>
                                        <input class="form-control" value="<?php echo $user->name; ?>" readonly>
                                        <?php } else { ?> 
                                        <input class="form-control" placeholder="User Name" value="" readonly>
                                        <?php } ?>
                                      </div>
                                    </div>

                                    <div class="form-group col-md-4 no-padding">
                                      <label class=" control-label" for="reviewtitle">User Moble No</label>
                                      <div class="">
                                        <?php if(isset($user) and $user != NULL) { ?>
                                        <input class="form-control" value="<?php echo $user->mobile; ?>" readonly>
                                        <?php } else { ?> 
                                        <input class="form-control" placeholder="User Mobile Number" value="" readonly>
                                        <?php } ?>
                                      </div>
                                    </div>

                                    <div class="form-group col-md-4 no-padding">
                                      <label class=" control-label" for="reviewtitle">Time and Discount</label>
                                      <div class="">
                                        <?php if(isset($selected_resto_discount) and $selected_resto_discount != NULL) { ?>
                                        <input class="form-control" value="<?php echo $selected_resto_discount->rtime; ?> / <?php echo $selected_resto_discount->percent; ?>%" readonly>
                                        <?php } else { ?> 
                                        <input class="form-control" placeholder="Restaurant Name" value="" readonly>
                                        <?php } ?>
                                      </div>
                                    </div>

                                    <div class="form-group col-md-4 no-padding">
                                      <label class=" control-label" for="reviewtitle">Price</label>
                                      <div class="">
                                        <?php if(isset($selected_resto_discount) and $selected_resto_discount != NULL) { ?>
                                        <input class="form-control" value="<?php echo $selected_resto_discount->price; ?>" readonly>
                                        <?php } else { ?> 
                                        <input class="form-control" placeholder="Price" value="" readonly>
                                        <?php } ?>
                                      </div>
                                    </div>

                                    <div class="form-group col-md-4 no-padding">
                                      <label class=" control-label" for="reviewtitle">Trasaction Id</label>
                                      <div class="">
                                        <?php if(isset($reservation) and $reservation != NULL) { ?>
                                        <input class="form-control" value="<?php echo $reservation->cardid; ?>" readonly>
                                        <?php } else { ?> 
                                        <input class="form-control" placeholder="Price" value="" readonly>
                                        <?php } ?>
                                      </div>
                                    </div>

                                    <div class="form-group col-md-3 no-padding">
                                      <label class=" control-label" for="reviewtitle">Number of people</label>
                                      <div class="">
                                        <?php if(isset($reservation) and $reservation != NULL) { ?>
                                        <input class="form-control" value="<?php echo $reservation->people; ?>" readonly>
                                        <?php } else { ?> 
                                        <input class="form-control" placeholder=" No of People" value="" readonly>
                                        <?php } ?>
                                      </div>
                                    </div>

                                    <div class="form-group col-md-3 no-padding">
                                      <label class=" control-label" for="reviewtitle">Total Amount</label>
                                      <div class="">
                                        <?php if(isset($reservation) and $reservation != NULL and isset($selected_resto_discount) and $selected_resto_discount != NULL ) { 
                                          $total_amount = $reservation->people * $selected_resto_discount->price;
                                          ?>
                                          <input class="form-control" value="<?php echo $total_amount; ?>" readonly>
                                          <?php } else { ?> 
                                          <input class="form-control" placeholder=" Total Amount of booking" value="" readonly>
                                          <?php } ?>
                                        </div>
                                      </div>

                                      <div class="form-group col-md-3 no-padding">
                                        <label class=" control-label" for="reviewtitle">Date of Booking</label>
                                        <div class="">
                                          <?php if(isset($reservation) and $reservation != NULL) { ?>
                                          <input class="form-control" value="<?php echo $reservation->date; ?>" readonly>
                                          <?php } else { ?> 
                                          <input class="form-control" placeholder="Date of Booking" value="" readonly>
                                          <?php } ?>
                                        </div>
                                      </div>

                                      <div class="form-group col-md-3 no-padding">
                                        <label class=" control-label" for="reviewtitle">Dicount Code</label>
                                        <div class="">
                                          <?php if(isset($reservation) and $reservation != NULL) { ?>
                                          <input class="form-control" value="<?php echo $reservation->code; ?>" readonly>
                                          <?php } else { ?> 
                                          <input class="form-control" placeholder=" Discount Code" value="" readonly>
                                          <?php } ?>
                                        </div>
                                      </div>
                                      <a href="<?php echo base_url();?>index.php/VendorController/index/3" title="Restaurant" class="btn tp-btn-default btn-lg" style="background:black;">Back</a>

                                    </form>
                                  </div>
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



                      <div id="addrestauranttiming" class="modal fade" role="dialog">
                        <div class="modal-dialog">

                          <!-- Modal content-->
                          <div class="modal-content">
                            <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                              <h4 class="modal-title">Modal Header</h4>
                            </div>
                            <div class="modal-body" style="padding: 22px;">
                            <?php if(isset($selected_restaurant) and $selected_restaurant != NULL) { ?>
                            <form action="<?php echo base_url();?>index.php/VendorController/update_restauranttime" method="post" enctype="multipart/form-data">
                            <input type="hidden" name="resto_id" value="<?php echo $selected_restaurant->no;?>">
                            <?php } else { ?>                            
                            <form id="addrestotime" action="<?php echo base_url();?>index.php/VendorController/add_restauranttime" method="post" enctype="multipart/form-data">
                            <?php } ?>
                             <div class="input-group control-group">
                              <div class="form-group col-md-2 no-padding">
                                <label class=" control-label" for="reviewtitle">Days<span class="required">*</span></label>
                                <div class="input-group">
                                  <label style="padding: 11px 0 0 0;">Monday</label>
                                </div>
                              </div>
                              <div class="form-group col-md-5 no-padding">
                                <label class=" control-label" for="reviewtitle">Start Time<span class="required">*</span></label>
                                <div class="input-group clockpicker-with-callbacks">
                                  <?php if(isset($selected_restaurant)) { ?>
                                  <input type="text" class="form-control" name="mon_starttime" value="<?php echo $selected_restaurant->mon_starttime; ?>">
                                  <?php } else { ?>                            
                                  <input type="text" class="form-control" name="mon_starttime" value="">
                                  <?php } ?>
                                  <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-time"></span>
                                  </span>
                                </div>
                              </div>
                              <!-- Text input--> 
                              <div class="form-group col-md-5 no-padding">
                                <label class=" control-label" for="reviewtitle">End Time<span class="required">*</span></label>
                                <div class="input-group clockpicker-with-callbacks">
                                  <?php if(isset($selected_restaurant)) { ?>
                                  <input type="text" class="form-control" name="mon_endtime" value="<?php echo $selected_restaurant->mon_endtime; ?>">
                                  <?php } else { ?>                            
                                  <input type="text" class="form-control" name="mon_endtime" value="">
                                  <?php } ?>
                                  <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-time"></span>
                                  </span>
                                </div>
                              </div>


                              <div class="form-group col-md-2 no-padding">
                                <div class="input-group">
                                  <label style="padding: 11px 0 0 0;">Tuesday</label>
                                </div>
                              </div>
                              <div class="form-group col-md-5 no-padding">
                                <div class="input-group clockpicker-with-callbacks">
                                  <?php if(isset($selected_restaurant)) { ?>
                                  <input type="text" class="form-control" name="tue_starttime" value="<?php echo $selected_restaurant->tue_starttime; ?>">
                                  <?php } else { ?>                            
                                  <input type="text" class="form-control" name="tue_starttime" value="">
                                  <?php } ?>
                                  <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-time"></span>
                                  </span>
                                </div>
                              </div>
                              <!-- Text input--> 
                              <div class="form-group col-md-5 no-padding">
                                <div class="input-group clockpicker-with-callbacks">
                                  <?php if(isset($selected_restaurant)) { ?>
                                  <input type="text" class="form-control" name="tue_endtime" value="<?php echo $selected_restaurant->tue_endtime; ?>">
                                  <?php } else { ?>                            
                                  <input type="text" class="form-control" name="tue_endtime" value="">
                                  <?php } ?>
                                  <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-time"></span>
                                  </span>
                                </div>
                              </div>



                              <div class="form-group col-md-2 no-padding">
                                <div class="input-group">
                                  <label style="padding: 11px 0 0 0;">Wednesday</label>
                                </div>
                              </div>
                              <div class="form-group col-md-5 no-padding">
                                <div class="input-group clockpicker-with-callbacks">
                                  <?php if(isset($selected_restaurant)) { ?>
                                  <input type="text" class="form-control" name="wed_starttime" value="<?php echo $selected_restaurant->wed_starttime; ?>">
                                  <?php } else { ?>                            
                                  <input type="text" class="form-control" name="wed_starttime" value="">
                                  <?php } ?>
                                  <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-time"></span>
                                  </span>
                                </div>
                              </div>
                              <!-- Text input--> 
                              <div class="form-group col-md-5 no-padding">
                                <div class="input-group clockpicker-with-callbacks">
                                  <?php if(isset($selected_restaurant)) { ?>
                                  <input type="text" class="form-control" name="wed_endtime" value="<?php echo $selected_restaurant->wed_endtime; ?>">
                                  <?php } else { ?>                            
                                  <input type="text" class="form-control" name="wed_endtime" value="">
                                  <?php } ?>
                                  <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-time"></span>
                                  </span>
                                </div>
                              </div>



                              <div class="form-group col-md-2 no-padding">
                                <div class="input-group">
                                  <label style="padding: 11px 0 0 0;">Thursday</label>
                                </div>
                              </div>
                              <div class="form-group col-md-5 no-padding">
                                <div class="input-group clockpicker-with-callbacks">
                                  <?php if(isset($selected_restaurant)) { ?>
                                  <input type="text" class="form-control" name="thu_starttime" value="<?php echo $selected_restaurant->thu_starttime; ?>" >
                                  <?php } else { ?>                            
                                  <input type="text" class="form-control" name="thu_starttime" value="">
                                  <?php } ?>
                                  <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-time"></span>
                                  </span>
                                </div>
                              </div>
                              <!-- Text input--> 
                              <div class="form-group col-md-5 no-padding">
                                <div class="input-group clockpicker-with-callbacks">
                                  <?php if(isset($selected_restaurant)) { ?>
                                  <input type="text" class="form-control" name="thu_endtime" value="<?php echo $selected_restaurant->thu_endtime; ?>">
                                  <?php } else { ?>                            
                                  <input type="text" class="form-control" name="thu_endtime" value="">
                                  <?php } ?>
                                  <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-time"></span>
                                  </span>
                                </div>
                              </div>



                              <div class="form-group col-md-2 no-padding">
                                <div class="input-group">
                                  <label style="padding: 11px 0 0 0;">Friday</label>
                                </div>
                              </div>
                              <div class="form-group col-md-5 no-padding">
                                <div class="input-group clockpicker-with-callbacks">
                                  <?php if(isset($selected_restaurant)) { ?>
                                  <input type="text" class="form-control" name="fri_starttime" value="<?php echo $selected_restaurant->fri_starttime; ?>">
                                  <?php } else { ?>                            
                                  <input type="text" class="form-control" name="fri_starttime" value="">
                                  <?php } ?>
                                  <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-time"></span>
                                  </span>
                                </div>
                              </div>
                              <!-- Text input--> 
                              <div class="form-group col-md-5 no-padding">
                                <div class="input-group clockpicker-with-callbacks">
                                  <?php if(isset($selected_restaurant)) { ?>
                                  <input type="text" class="form-control" name="fri_endtime" value="<?php echo $selected_restaurant->fri_endtime; ?>">
                                  <?php } else { ?>                            
                                  <input type="text" class="form-control" name="fri_endtime" value="">
                                  <?php } ?>
                                  <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-time"></span>
                                  </span>
                                </div>
                              </div>



                              <div class="form-group col-md-2 no-padding">
                                <div class="input-group">
                                  <label style="padding: 11px 0 0 0;">Saturday</label>
                                </div>
                              </div>
                              <div class="form-group col-md-5 no-padding">
                                <div class="input-group clockpicker-with-callbacks">
                                  <?php if(isset($selected_restaurant)) { ?>
                                  <input type="text" class="form-control" name="sat_starttime" value="<?php echo $selected_restaurant->sat_starttime; ?>">
                                  <?php } else { ?>                            
                                  <input type="text" class="form-control" name="sat_starttime" value="">
                                  <?php } ?>
                                  <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-time"></span>
                                  </span>
                                </div>
                              </div>
                              <!-- Text input--> 
                              <div class="form-group col-md-5 no-padding">
                                <div class="input-group clockpicker-with-callbacks">
                                  <?php if(isset($selected_restaurant)) { ?>
                                  <input type="text" class="form-control" name="sat_endtime" value="<?php echo $selected_restaurant->sat_endtime;?>">
                                  <?php } else { ?>                            
                                  <input type="text" class="form-control" name="sat_endtime" value="">
                                  <?php } ?>
                                  <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-time"></span>
                                  </span>
                                </div>
                              </div>



                              <div class="form-group col-md-2 no-padding">
                                <div class="input-group">
                                  <label style="padding: 11px 0 0 0;">Sunday</label>
                                </div>
                              </div>
                              <div class="form-group col-md-5 no-padding">
                                <div class="input-group clockpicker-with-callbacks">
                                  <?php if(isset($selected_restaurant)) { ?>
                                  <input type="text" class="form-control" name="sun_starttime" value="<?php echo $selected_restaurant->sun_starttime; ?>">
                                  <?php } else { ?>                            
                                  <input type="text" class="form-control" name="sun_starttime" value="">
                                  <?php } ?>
                                  <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-time"></span>
                                  </span>
                                </div>
                              </div>
                              <!-- Text input--> 
                              <div class="form-group col-md-5 no-padding">
                                <div class="input-group clockpicker-with-callbacks">
                                  <?php if(isset($selected_restaurant)) { ?>
                                  <input type="text" class="form-control" name="sun_endtime" value="<?php echo $selected_restaurant->sun_endtime;?>">
                                  <?php } else { ?>                            
                                  <input type="text" class="form-control" name="sun_endtime" value="">
                                  <?php } ?>
                                  <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-time"></span>
                                  </span>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="modal-footer">
                            <?php if(isset($selected_restaurant) and $selected_restaurant != NULL) { ?>
                            <button type="submit" class="btn tp-btn-primary">Update</button>
                            <?php } else { ?>
                            <button type="submit" class="btn tp-btn-primary">Add</button>
                            <?php } ?>
                            <button type="button" class="btn tp-btn-default" data-dismiss="modal">Close</button>
                          </div>                 
                          </form>
                        </div>

                      </div>
                    </div>



                    <script src="<?php echo base_url();?>js/jquery.multiselect.js"></script>
                    <script type="text/javascript">
                      $('#langOpt').multiselect({
                          columns: 1,
                          placeholder: 'Select Sub Category'
                      });
                      $('#factOpt').multiselect({
                          columns: 1,
                          placeholder: 'Select Restaurant Facility'
                      });
                    </script>


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
                              $("#image_block"+id).hide();
                            }
                          }
                        });

                      });
                    </script>

                    