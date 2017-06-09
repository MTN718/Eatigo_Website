<div class="main-container">
  <div class="container">
    <div class="row">
      
      <div class="col-md-12">
        <div class="well-box">
          <div class="coupon-info">
            <p>Have a coupon? <a href="#"> </a> <a role="button" data-toggle="collapse" href="#applycoupon" aria-expanded="false" aria-controls="applycoupon" class="findhover1" style="color:#8E203E;"> Click here to enter your code </a> </p>
          </div>
          <div class="collapse" id="applycoupon">
            <div class="coupon-form">
              <form class="form-inline">
                <div class="form-group">
                  <label for="coupon" class="control-label sr-only">Name</label>
                  <input type="text" class="form-control" name="coupon" id="coupon" placeholder="Coupon Code">
                </div>
                <button type="submit" class="btn tp-btn-default">Apply Coupon</button>
              </form>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-6">
        <div class="well-box">
          <div class="billing-details">
            <h2>Billing Details</h2>
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label class="control-label" for="country">Country</label>
                  <select id="country" name="country" class="form-control">
                    <option value="1">USA</option>
                    <option value="2">Option two</option>
                  </select>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label class="control-label" for="fname">First Name<span class="required">*</span> </label>
                  <input type="text" class="form-control" id="fname" placeholder="First Name">
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label class="control-label" for="lname">Last Name<span class="required">*</span></label>
                  <input type="text" class="form-control" id="lname" placeholder="Last Name">
                </div>
              </div>
              <div class="col-md-12">
                <div class="form-group">
                  <label class="control-label" for="companyname">Company Name<span class="required">*</span></label>
                  <input type="text" class="form-control" id="companyname" placeholder="Company Name">
                </div>
              </div>
              <div class="col-md-12">
                <div class="form-group">
                  <label class="control-label" for="address">Address<span class="required">*</span></label>
                  <input type="text" class="form-control" id="address" placeholder="Street Address">
                  <input type="text" class="form-control" id="address" placeholder="Apartment, suite, unit etc. (optional)">
                </div>
              </div>
              <div class="col-md-12">
                <div class="form-group">
                  <label class="control-label" for="town">Town/City<span class="required">*</span><span class="required">*</span></label>
                  <input type="text" class="form-control" id="town" placeholder="Town/city">
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label class="control-label" for="county">State / County<span class="required">*</span></label>
                  <input type="text" class="form-control" id="county" placeholder="State / County">
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label class="control-label" for="postcode">Postcode<span class="required">*</span></label>
                  <input type="postcode" class="form-control" id="postcode" placeholder="Postcode">
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label class="control-label" for="emailaddress">Email Address<span class="required">*</span></label>
                  <input type="email" class="form-control" id="emailaddress" placeholder="Email Address">
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label class="control-label" for="phone">Phone<span class="required">*</span></label>
                  <input type="text" class="form-control" id="phone" placeholder="Phone Number">
                </div>
              </div>
              <!-- Multiple Checkboxes -->
              
            </div>
          </div>
        </div>
       
      </div>
      <div class="col-md-6">
        <div class="well-box">
          <div class="order_review">
            <h2>Your order</h2>
            <table class="shop_table">
              <thead>
                <tr>
                  <th class="product-name">Product</th>
                  <th class="product-total">Total</th>
                </tr>
              </thead>
              <tfoot>
                <tr class="cart-subtotal">
                  <th>Cart Subtotal</th>
                  <td><span class="amount">$190.00</span></td>
                </tr>
                <tr class="shipping">
                  <th>Taxes</th>
                  <td> None
                    <input type="hidden" name="shipping_method[0]" data-index="0" id="shipping_method_0" value="free_shipping" class="shipping_method"></td>
                </tr>
                <tr class="order-total">
                  <th>Order Total</th>
                  <td><strong><span class="amount">$190.00</span></strong></td>
                </tr>
              </tfoot>
              <tbody>
                <tr class="cart_item">
                  <td class="product-name"> No. of people<strong class="product-quantity">× 2</strong></td>
                  <td class="product-total"><span class="amount">$190.00</span></td>
                </tr>
              </tbody>
            </table>
            <form action="<?php echo base_url();?>index.php/CustomerController/profile">
                <button type="submit" onclick="" class="btn tp-btn-default" style="margin-top:15px;  width:100px;">Pay Now</button>
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