<!-- /.navigation start -->
<div class="tp-page-head"><!-- page header -->
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="page-header">
          <h1>Sign Up Vendor</h1>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="main-container">
  <div class="container">
    <div class="row">
      <div class="col-md-12 tp-title-center">
        <h1>Create an account</h1>
        <p>
            Burped Affiliate is a great way to earn money, bring a restaurant to us and you will recieve a percentage of the deals that has been purchased by our customers on those restaurants.</p>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12 st-tabs"> 
        <!-- Nav tabs -->
        <ul class="nav nav-tabs" role="tablist">
          <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">Personal Details</a></li><!-- 
          <li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">Business Details</a></li> -->
        </ul>
        
        <!-- Tab panes -->
        <div class="tab-content">
          <div role="tabpanel" class="tab-pane active" id="home">

            <form action="<?php echo base_url();?>index.php/CustomerController/signupvendor/create" method="post">
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
                <input id="email" name="email" type="email" placeholder="E-Mail" class="form-control input-md" required>
                 
              </div>
              
              <!-- Text input-->
              <div class="form-group">
                <label class="control-label" for="password">Password<span class="required">*</span></label>
                <input id="password" name="password" type="password" placeholder="Password" class="form-control input-md" required>
              </div>
              
              <!-- Text input-->
              <div class="form-group">
                <label class="control-label" for="phone">Phone<span class="required">*</span></label>
                <input id="phone" name="phone" type="text" placeholder="Phone" class="form-control input-md" required>
              </div>
              <!-- Text input-->


            <!-- Text input-->
            <div class="form-group">
              <label class="control-label" for="address">Address<span class="required">*</span></label>
              <textarea id="address" name="address" placeholder="Address" class="form-control input-md" required></textarea>
            </div> 
              
              <!-- Button -->
              <div class="form-group"><!-- 
                <button name="submit" class="btn tp-btn-primary tp-btn-lg findhover" style="background-color:#8E203E;">Continue Step</button> -->                
                <button name="submit" class="btn tp-btn-primary tp-btn-lg findhover" style="background-color:#8E203E;">Create Account</button>
              </div>
              
            </form>
          </div>

          <div role="tabpanel" class="tab-pane" id="profile"><!-- Text input-->
            <div class="form-group">
              <label class="control-label" for="businessname">Business Name:<span class="required">*</span></label>
              <input id="businessname" name="businessname" type="text" placeholder="Business name" class="form-control input-md" required>
            </div>


            <!-- Text input-->
            <div class="form-group">
              <label class="control-label" for="phone-one">Phone<span class="required">*</span></label>
              <input id="phone-one" name="phone-one" type="text" placeholder="Phone" class="form-control input-md" required>
            </div>
            <!-- Text input-->
            <div class="form-group">
              <label class="control-label" for="address">Address<span class="required">*</span></label>
              <textarea id="address" name="address" placeholder="Business Address" class="form-control input-md" required></textarea>
            </div>
            <!-- Text input-->
            <div class="form-group">
              <label class="control-label" for="postcode">Post Code<span class="required">*</span></label>
              <input id="postcode" name="postcode" type="text" placeholder="Post Code" class="form-control input-md" required>
            </div>
            <!-- Select Basic -->
            <div class="form-group">
              <label class=" control-label" for="country">Country</label>
              <div class=" ">
                <select id="country" name="country" class="form-control">
                  <option value="India">India</option>
                  <option value="Singapore">Singapore</option>
                  <option value="Australia">Australia</option>
                </select>
              </div>
            </div>
            <!-- Button -->
            <div class="form-group">
              <button name="submit" class="btn tp-btn-primary tp-btn-lg findhover" style="background-color:#8E203E;">Create Account</button>
            </div>
            <!-- Text input--> 
          </div>
        </div>

      </div>
    </div>
  </div>
</div>