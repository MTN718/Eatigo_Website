<div class="tp-page-head">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="page-header">
          <h1>Login Page</h1>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="main-container">
  <div class="container">
    <div class="row">
      <div class="col-md-12 tp-title-center"><h1>  Welcome back to your account.</h1>
        <p>We're happy to have you back.</p>
      </div>
      
    </div>

    <div class="col-md-offset-3 col-md-6 st-tabs"> 
      <!-- Nav tabs -->
      <ul class="nav nav-tabs" role="tablist">
      </ul>

      <!-- Tab panes -->
      <div class="tab-content ">
        <div role="tabpanel" class="tab-pane active vendor-login" id="home">

          <form class="form-horizontal" action="<?php echo base_url();?>index.php/LoginController/validate_user" method="post">
            <input type="hidden" name="role" value="0">

              <span <?php if ($this->session->flashdata('message') != ""){?>style="color:green;margin-left: -14px;"<?php }?> >
                <?php if ($this->session->flashdata('message') != ""){ ?>                    
                  <?php echo $this->session->flashdata('message');?>                    
                <?php } ?>
              </span>

              <span <?php if ($this->session->flashdata('loginerror') != ""){?>style="color:red;margin-left: -14px;"<?php }?> >
                <?php if ($this->session->flashdata('loginerror') != ""){ ?>                    
                  <?php echo $this->session->flashdata('loginerror');?>                    
                <?php } ?>
              </span>

            <!-- Text input-->
            <div class="form-group">
              <label class="control-label" for="email">E-mail<span class="required">*</span></label>
              <input id="email" name="email" type="email" placeholder="E-Mail" class="form-control input-md" required>
            </div>

            <!-- Text input-->
            <div class="form-group">
              <label class="control-label" for="password">Password<span class="required">*</span></label>
              <input id="password" name="password" type="password" placeholder="Password" class="form-control input-md" required>
            </div>

            <!-- Button -->
            <div class="form-group">
              <button id="submit" name="submit" class="btn tp-btn-primary tp-btn-lg findhover" style="background-color:#8E203E;">Login</button>
              <a href="forget-password.html" class="pull-right"> <small>Forgot Password ?</small></a> 
            </div>
          </form>

        </div>
      </div>
      <div class="well-box social-login"> <a href="#" class="btn facebook-btn"><i class="fa fa-facebook-square"></i>Facebook</a> <a href="#" class="btn twitter-btn"><i class="fa fa-twitter-square"></i>Twitter</a> <a href="#" class="btn google-btn"><i class="fa fa-google-plus-square"></i>Google+</a> </div>
    </div>
  </div>
</div>

