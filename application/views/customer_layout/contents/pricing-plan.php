<!-- /.navigation start -->
<div class="tp-page-head"><!-- page header -->
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="page-header">
          <h1>Pricing Plan</h1>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="main-container">
  <div class="container">
    <div class="row">
    <?php if(isset($membershipplanlist) and $membershipplanlist != NULL) {
      foreach ($membershipplanlist as $membershipplan) { ?>      
        <div class="col-md-4 pricing-box pricing-box-regualr">
        <div class="well-box">
          <h2 class="price-title"><?php echo $membershipplan->name; ?></h2>
          <h1 class="price-plan"><span class="dollor-sign">$</span><?php echo $membershipplan->price; ?></h1>
          <?php if ($this->session->userdata('customer_login') != 1) { ?>
              <a href="<?php echo base_url(); ?>index.php/CustomerController/selectplan" class="btn tp-btn-default">Login First</a> 
          <?php } else { 
            if($membershipplan->no == $usercurrentplan->membership) { ?>
              <button class="btn tp-btn-primary" disabled="true">Selected Plan</button> 
            <?php } else { ?>
            <a href="#" class="btn tp-btn-default" data-toggle="modal" data-target="#myModalforplancard<?php echo $membershipplan->no; ?>">Select Plan</a> 
          <?php } } ?> 
        </div>
        <ul class="check-circle list-group">
          <?php if($membershipplan->no == 3) {?>            
            <li class="list-group-item">Unlimited credit</li>
          <?php } else { ?>
            <li class="list-group-item"><?php echo $membershipplan->credit; ?> credit</li>
          <?php } ?>
        </ul>
      </div>               
          <div class="modal fade" id="myModalforplancard<?php echo $membershipplan->no; ?>" role="dialog">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                  <h4 class="modal-title">Please Select Card</h4>
                </div>
                <form action="<?php echo base_url(); ?>index.php/CustomerController/confirm_payment/add_credit" method="post"> 
                <input type="hidden" name="plan_id" value="<?php echo $membershipplan->no; ?>"> 
                <input type="hidden" name="plan_price" value="<?php echo $membershipplan->price; ?>">       
                <div class="modal-body">
                    <div class="container-fluid">
                      <div class="rating-group">
                      <?php if(isset($usercardlist) and $usercardlist != NULL) {
                        foreach ($usercardlist as $usercard) { ?>
                        <div class="radio">
                          <input type="radio" name="card_id" id="card_id" value="<?php echo $usercard->no; ?>" required="required">
                          <label style="width: 100%;">
                            <span class="col-md-6"><?php echo $usercard->cardnumber; ?></span>
                          </label>
                        </div>                        
                      <?php } } else echo "No Card Available"; ?>
                      </div>
                    </div>
                </div>
                <div class="modal-footer">
                  <?php if(isset($usercardlist) and $usercardlist != NULL) { ?>
                    <button type="submit" class="btn tp-btn-primary" style="height: 32px;">Checkout</button>
                  <?php } else { ?>                  
                    <a href="<?php echo base_url(); ?>index.php/CustomerController/profile/5" class="btn tp-btn-primary">Add Card</a> 
                  <?php } ?>
                  <button type="button" class="btn tp-btn-default" style="height: 32px;" data-dismiss="modal">Close</button>
                </div>
                </form>
              </div>      
            </div>
          </div>
    <?php
      }
    }
    ?>
    </div>
  </div>
</div>