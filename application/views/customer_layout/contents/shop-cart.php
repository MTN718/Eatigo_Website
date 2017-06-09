<!-- /.navigation start -->
<div class="tp-page-head"><!-- page header -->
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="page-header">
          <h1>Cart</h1>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- /.page header -->
<div class="tp-breadcrumb">
  <div class="container">
    <div class="row">
      <div class="col-md-8">
        <ol class="breadcrumb">
          <li><a href="#">Home</a></li>
          <li class="active">Shopping Cart</li>
        </ol>
      </div>
    </div>
  </div>
</div>
<div class="main-container">
  <div id="shop-viewcart" class="shop-viewcart">
    <div class="container">
      <div class="row">
        <div class="col-md-12 view-cart"><!-- view cart -->
          <table class="shop_table">
            <!-- shop table -->
            <thead>
              <tr>
                <th class="product-remove">&nbsp;</th>
                <th class="product-thumbnail">Product Image</th>
                <th class="product-name">Product</th>
                <th class="product-price">Price</th>
                <th class="product-quantity">Quantity</th>
                <th class="product-subtotal">Total</th>
              </tr>
            </thead>
            <tbody>
              <tr class="cart_item">
                <td class="product-remove"><a href="#" class="remove" title="Remove this item">×</a></td>
                <td class="product-thumbnail"><a href="#"><img src="images/product-1.jpg" class="img-responsive" alt=""></a></td>
                <td class="product-name"><a href="#">Product Wedding Dress</a></td>
                <td class="product-price"><span class="amount">$95.00</span></td>
                <td class="product-quantity"><div class="quantity buttons_added">
                    <input type="button" value="-" class="minus">
                    <input type="number" step="1" min="0" max="140" name="x" value="1" title="Qty" class="">
                    <input type="button" value="+" class="plus">
                  </div></td>
                <td class="product-subtotal"><span class="amount">$190.00</span></td>
              </tr>
              <tr>
                <td colspan="6" class="actions"><div class="coupon">
                    <label for="coupon_code">Coupon:</label>
                    <input type="text" id="coupon_code" name="coupon_code" class="input-text" placeholder="Coupon code">
                    <input type="submit" class="btn button" name="apply_coupon" value="Apply Coupon">
                  </div>
                  <input type="submit" class="btn checkout-button button" name="proceed" value="Proceed to Checkout">
                  <input type="submit" class="btn button-update" name="update_cart" value="Update Cart"></td>
              </tr>
            </tbody>
          </table>
          <!-- shop table end --> 
        </div>
        <!-- view cart end --> 
      </div>
      
      <!-- cart-collaterals -->
      <div class="row cart-collaterals">
        <div class="col-md-6"><!-- cart total -->
          <div class="cart_totals">
            <h2>Cart Totals</h2>
            <table >
              <tbody>
                <tr class="cart-subtotal">
                  <th>Cart Subtotal</th>
                  <td><span class="amount">$190.00</span></td>
                </tr>
                <tr class="shipping">
                  <th>Shipping and Handling</th>
                  <td> Free Shipping
                    <input type="hidden" name="shipping_method[0]" data-index="0" id="shipping_method_0" value="free_shipping" class="shipping_method"></td>
                </tr>
                <tr class="order-total">
                  <th>Order Total</th>
                  <td><strong><span class="amount">$190.00</span></strong></td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
        <!-- cart total -->
        <div class="col-md-6"><!-- shipping_calculator -->
          <div class="shipping_calculator">
            <h2>Calculate Shipping</h2>
            <!-- Select Basic -->
            <div class="form-group">
              <label class="col-md-4 control-label" for="country"></label>
              <div class="col-md-12">
                <select id="country" name="country" class="form-control">
                  <option value="1">United states (us)</option>
                  <option value="2">United states (us)</option>
                  <option value="3">United states (us)</option>
                </select>
              </div>
            </div>
            
            <!-- Select Basic -->
            <div class="form-group">
              <div class="col-md-6">
                <select id="state" name="state" class="form-control">
                  <option value="1">Select an option</option>
                  <option value="2">Select an option</option>
                  <option value="3">Select an option</option>
                </select>
              </div>
            </div>
            <!-- Button --> 
            
            <!-- Text input-->
            <div class="form-group">
              <div class="col-md-6">
                <input id="postcode" name="postcode" type="text" placeholder="postcode" class="form-control">
              </div>
            </div>
            <div class="form-group">
              <label class="control-label"></label>
              <div class="col-md-12">
                <button class="btn tp-btn-default">update totals</button>
              </div>
            </div>
          </div>
        </div>
        <!-- shipping_calculator end --> 
        
      </div>
      <!-- cart-collaterals end --> 
      
    </div>
  </div>
</div>