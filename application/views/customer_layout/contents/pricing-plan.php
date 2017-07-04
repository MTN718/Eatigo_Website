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
      <div class="col-md-8">
        <h1>Pricing plan that best suits your business needs.</h1>
      </div>
      <?php if ($this->session->userdata('customer_login') != 1) { ?>
      <div class="col-md-4 "><a href="<?php echo base_url(); ?>index.php/CustomerController/register" class="btn tp-btn-primary tp-btn-lg pull-right"> Start Free Trial</a></div>
      <?php } ?>
    </div>
    <div class="row pricing-container">
    <?php if(isset($membershipplanlist) and $membershipplanlist != NULL) {
      foreach ($membershipplanlist as $membershipplan) { 
        if($membershipplan->no != 1) { ?>      
        <div class="col-md-4 pricing-box pricing-box-regualr">
        <div class="well-box">
          <h2 class="price-title"><?php echo $membershipplan->name; ?></h2>
          <h1 class="price-plan"><span class="dollor-sign">$</span><?php echo $membershipplan->price; ?><span class="permonth">/<?php echo $membershipplan->credit; ?> credit</span></h1>
          <p>Nullam sitamet <strong>sodales magnaorem</strong> ipsumgererit ullamcorper lacus. </p>
          <?php if ($this->session->userdata('customer_login') != 1) { ?>
          <a href="<?php echo base_url(); ?>index.php/CustomerController/selectplan" class="btn tp-btn-default">Select Plan</a> 
          <?php } else { ?>
          <a href="#" class="btn tp-btn-default" data-toggle="modal" data-target="#myModalforplancard<?php echo $membershipplan->no; ?>">Select Plan</a> 
          <?php } ?> 
        </div>
        <ul class="check-circle list-group">
          <li class="list-group-item">24/7 Email Support</li>
          <li class="list-group-item">ePayments &amp; eInvoices</li>
          <li class="list-group-item">Advanced Review Management</li>
          <li class="list-group-item">Education Webinars</li>
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
                <div class="modal-body">
                    <div class="container-fluid">
                      <div class="rating-group">
                      <?php if(isset($usercardlist) and $usercardlist != NULL) {
                        foreach ($usercardlist as $usercard) { ?>
                        <div class="radio">
                          <input type="radio" name="card_id" id="card_id" value="<?php echo $usercard->no; ?>" >
                          <label style="width: 100%;">
                            <span class="col-md-6"><?php echo $usercard->cardnumber; ?></span>
                            <!-- <span class="col-md-6"><?php echo $usercard->name; ?></span> -->
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
    <?php } 
      }
    }
    ?>
    </div>
    <div></div>
    <div class="row spacer">
      <div class="col-md-12 tp-title-center">
        <h1>Do you have a question ?</h1>
      </div>
      <div class="col-md-6 question-block">
        <div class="question-answer">
          <h2><span class="question-sign">Q</span> Which payment methods are supported?</h2>
          <p>Sed lacinia lectus sedurna luctus interdumras commodo porttitor always faucibus Nullam sollicitudin ultriciesleo non viverra neque laoreet amazin  consectetur nisl sedblandit turpis enimac urabitur.</p>
        </div>
        <div class="question-answer">
          <h2><span class="question-sign">Q</span> What uisque ulrices eficiturn interdum justo?</h2>
          <p>Sed lacinia lectus sedurna luctus interdumras commodo porttitor always faucibus Nullam sollicitudin ultriciesleo non viverra neque laoreet amazin  consectetur nisl sedblandit turpis enimac urabitur.</p>
        </div>
        <div class="question-answer">
          <h2><span class="question-sign">Q</span> How ullam diissim nisiege luctus anteui?</h2>
          <p>Mauris metus leoelemetum condimentum tellus velornare dictum ligula uisque vestibulum molestieerat euleifend turpis fermentum quisras offer massaelit potentiorbi rhoncus pellen tesque exanibus. </p>
        </div>
      </div>
      <div class="col-md-6 question-block">
        <div class="question-answer">
          <h2><span class="question-sign">Q</span> Can I cancel or refund my subscription?</h2>
          <p>Phasellus quislandit velitorbi aliquet vulputate sagittis usce lobortis velsit amet facilisis imperdiet Integer lacinia sodales eratonec dignissim felisa duivulputat a triiqu nullafelis rhoncus.</p>
        </div>
        <div class="question-answer">
          <h2><span class="question-sign">Q</span> Why tibulum consectetur lorem sagittis?</h2>
          <p>Aenean varius ornare diamquis scelerisque. umsociis natoque penatibus etmagnis disarturientsitamet augue suscipit utfringilla velit sollicitudin In velest inturpis one sagittis interdu.</p>
        </div>
        <div class="question-answer">
          <h2><span class="question-sign">Q</span> Why sociis natoque magnis diaturient montes?</h2>
          <p>Lacinia lectus sedurna luctus interdumras commodo porttitor always faucibus Nullam interdum libero utfringilla cursus tortor magna consectetur nisl sedblandit turpis urabitur.</p>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-6 feature-left">
        <div class="well-box">
          <div class="row">
            <div class="feature-icon col-md-2"><img src="images/envelop.svg" alt=""></div>
            <div class="feature-info col-md-10">
              <h3>Have questions? Contact us at</h3>
              <p>We're here to help, 24 hours a day, 7 days a week utfrit inturpis one sagittis interdu.<strong><a href="#"> support@weddingvemndor.com</a></strong></p>
            </div>
            <p></p>
          </div>
        </div>
      </div>
      <div class="col-md-6 feature-left">
        <div class="well-box">
          <div class="row">
            <div class="feature-icon col-md-2"><img src="images/ballon.svg" alt=""></div>
            <div class="col-md-10 feature-info">
              <h3>Want to know how it works ?</h3>
              <p>Lacinia lectus sedurna luctus interdumras commodo pro utfringilla cursus tortor magna consectetur nisl sedblandit turpis <a href="#">Go to How it works.</a></p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>