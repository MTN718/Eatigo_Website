<div class="footer"><!-- Footer -->
    <div class="container">
        <div class="row">
            <div class="col-md-5 ft-aboutus">
                <h2>Burped</h2>
                <p style="color:#B9657C;">At Wedding Vendor our purpose is tod wedding couples who use those suppliers. <a href="#">Start Find Restaurant!</a></p>
            </div>
            <div class="col-md-3 ft-link">
                <h2>Useful links</h2>
                <ul>
                    <li><a href="<?php echo base_url();?>index.php/CustomerController/about" style="color:#B9657C;">About Us</a></li>
                    <li><a href="#" style="color:#B9657C;">News</a></li>
                    <li><a href="#" style="color:#B9657C;">Career</a></li>
                    <li><a href="#" style="color:#B9657C;">Privacy Policy</a></li>
                    <li><a href="#" style="color:#B9657C;">Terms of Use</a></li>
                </ul>
            </div>
            <div class="col-md-4 newsletter">
                <h2>Newsletter</h2>
                <form  >
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Enter E-Mail Address" required>
                        <span class="input-group-btn">
                            <button class="btn tp-btn-default tp-btn-lg findhover" type="button" style="padding: 15px 20px; height:48px; background-color: #000;">Submit</button>
                        </span> </div>
                    <!-- /input-group --> 

                    <!-- /.col-lg-6 -->
                </form>
                <div class="social-icon">
                    <h2>Be Social &amp; Stay Connected</h2>
                    <ul>
                        <li><a href="#"><i class="fa fa-facebook-square"></i></a></li>
                        <li><a href="#"><i class="fa fa-twitter-square"></i></a></li>
                        <li><a href="#"><i class="fa fa-google-plus-square"></i></a></li>
                        <li><a href="#"><i class="fa fa-instagram"></i></a></li>
                        <li><a href="#"><i class="fa fa-flickr"></i></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div><!-- /.Footer -->
<div class="tiny-footer"><!-- Tiny footer -->
    <div class="container">
        <div class="row">
            <div class="col-md-12">Copyright © 2017. All Rights Reserved</div>
        </div>
    </div>
</div><!-- /. Tiny Footer -->


<script class="pre">
function login(network) {                                                                               
    var facebook = hello(network);
    facebook.login({
    scope : 'email',
    }).then(function() {
        // get user profile data
        return facebook.api('/me?fields=id,name,email');
    }).then(function(p) {
        // document.getElementById('profile').innerHTML = "<img src='"+ p.thumbnail + "' width=24/>Connected to "+ network +" as " + p.name + p.email;
        window.location = "http://www.3bhai.com/burped/index.php/CustomerController/fb_login?name=" + p.name + "&email=" + p.email; 
    });
}
</script>


<script class="pre">
function logout(network) {
    hello('facebook').logout().then(function() {
    alert('Signed out');
}, function(e) {
    alert('Signed out error: ' + e.error.message);
});
}
</script>
<script class="pre">
hello.init({
    facebook: '118510325410906'
}, {
    redirect_uri: 'http://www.3bhai.com/burped/index.php/CustomerController/login',
});
</script>


