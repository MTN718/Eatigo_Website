<!-- /.navigation start -->
<div class="tp-page-head"><!-- page header -->
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="page-header">
          <h1>Sign Up</h1>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="main-container">
  <div class="container">
    <div class="row">
      <div class="col-md-12 tp-title-center">
        <h1>Create an account<br>
          <small>
            Burped Affiliate is a great way to earn money, bring a restaurant to us and you will recieve a percentage of the deals that has been purchased by our customers on those restaurants.</small> </h1>
      </div>
    </div>
    <div class="row">
      <div class="col-md-6 singup-couple">
        <div class="well-box">
          <h2>Sign Up for a Free Account </h2>
          <form action="<?php echo base_url();?>index.php/CustomerController/register/create" method="post">
            
            <!-- Text input-->
            <div class="form-group">
              <label class="control-label" for="name">Your Name<span class="required">*</span></label>
              <input id="name" name="name" type="text" placeholder="Your name" class="form-control input-md" required>
            </div>
            
            <!-- Text input-->
            <div class="form-group">
              <label class="control-label" for="email">E-mail<span class="required">*&nbsp;&nbsp;&nbsp;
                <?php if ($this->session->flashdata('message') != ""){ ?>                    
                  <?php echo $this->session->flashdata('message');?>                    
                <?php } ?></span></label>
              <input id="email" name="email" type="text" placeholder="E-Mail" class="form-control input-md" required>
            </div>
            
            <!-- Text input-->
            <div class="form-group">
              <label class="control-label" for="password">Password<span class="required">*</span></label>
              <input id="password" name="password" type="text" placeholder="Password" class="form-control input-md" required>
            </div>
            
            <!-- Text input-->
            <div class="form-group">
              <label class="control-label" for="phone">Phone<span class="required">*</span></label>
              <input id="phone" name="phone" type="text" placeholder="Phone" class="form-control input-md" required>
            </div>
            
            <!-- Button -->
            <div class="form-group">
              <button id="submit" name="submit" class="btn tp-btn-primary tp-btn-lg findhover">Create A Account</button>
            </div>
          </form>
        </div>
      </div>
      <div class="col-md-6">
        <div class="row">
          <div class="col-md-6 feature-block">
            <div class="well-box">
              <div class="feature-icon"> <img src="<?php echo base_url();?>images/11111.png" width="84" alt=""> </div>
              <h3>Restaurant list</h3>
              <p>Nullam porttitor lorem atdiam quis semper diam orci at neque.</p>
            </div>
          </div>
          <div class="col-md-6 feature-block">
            <div class="well-box">
              <div class="feature-icon"><img src="<?php echo base_url();?>images/33333.png" width="84" alt=""></div>
              <h3>Discounts</h3>
              <p>Nullam porttitor lorem atdiam quis semper diam orci at neque.</p>
            </div>
          </div>
          <div class="col-md-6 feature-block">
            <div class="well-box">
              <div class="feature-icon"><img src="<?php echo base_url();?>images/22222.png" width="84"  alt=""></div>
              <h3>Confirmation</h3>
              <p>Nullam porttitor lorem atdiam quis semper diam orci at neque.</p>
            </div>
          </div>
          <div class="col-md-6 feature-block">
            <div class="well-box">
              <div class="feature-icon"><img src="<?php echo base_url();?>images/44444.png" width="84"  alt=""></div>
              <h3>Everything you need</h3>
              <p>Nullam porttitor lorem atdiam quis semper diam orci at neque.</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
