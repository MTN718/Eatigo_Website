<div class="main-container">
  <div class="container">
    <div class="row">
      
      <div class="col-md-12">
        <div class="well-box">
          <div class="coupon-info">
            <p style="color:red;">Do not go back or Referesh your page.</p>
          </div>
        </div>
      </div>
      <div class="col-md-12">
        <div class="well-box">
          <div class="order_review">
            <h2>Your order</h2>
            <table class="shop_table">
              <thead>
                <tr>
                  <th class="product-name">Booking</th>
                  <th class="product-total">Details</th>
                </tr>
              </thead>
              <tfoot>
                <tr class="shipping">
                  <th>No of People</th>
                  <td><?php if(isset($reservation) and $reservation != NULL) echo $reservation->people; ?></td>
                </tr>
                <tr class="shipping">
                  <th>Card Number</th>
                  <td>
                    <?php if(isset($reservation) and $reservation != NULL) {
                      $this->db->select('*');
                      $this->db->from('tbl_card');
                      $this->db->where('no', $reservation->cardid);
                      $query = $this->db->get();
                      if ( $query->num_rows() > 0 )
                      {
                        $row = $query->row_array();
                        echo $row['cardnumber'];
                      }
                    }
                    ?>
                  </td>
                </tr>
                <tr class="shipping">
                  <th>Restaurant Name</th>
                  <td>
                  <?php if(isset($reservation) and $reservation != NULL) {
                    $restaurant = $this->db->get_where('tbl_restaurant', array('no' => $reservation->rid))->row(); 
                    echo $restaurant->name;
                  } ?>
                  </td>
                </tr>
                <tr class="shipping">
                  <th>Time and Discount</th>
                  <td>
                  <?php if(isset($reservation) and $reservation != NULL) {
                    $discount = $this->db->get_where('tbl_map_discount_restaurant', array('no' => $reservation->did))->row();
                    $discount_percent = $this->db->get_where('tbl_base_discount', array('no' => $discount->did))->row(); 
                    echo $discount->rtime;
                    echo " / ";
                    echo $discount_percent->percent."%";
                  } ?>
                  </td>
                </tr>
                <tr class="cart-subtotal">
                  <th class="product-name">Order Total</th>
                  <?php if(isset($discount) and $discount != NULL)
                    $total = $discount->price * $reservation->people;
                  ?>
                  <td class="product-total"><?php if(isset($total) and $total != NULL) echo $total; ?></td>
                </tr>
              </tfoot>
              <tbody>
                <tr class="cart_item">
                  <td>Booking Date</td>
                  <td><?php if(isset($reservation) and $reservation != NULL) echo $reservation->date; ?></td>
                </tr>
              </tbody>
            </table>
            <form action="<?php echo base_url();?>index.php/CustomerController/profile">
                <a href="<?php echo base_url();?>index.php/CustomerController/confirm_payment/<?php echo $reservation->no; ?>/<?php echo $total; ?>/<?php echo $reservation->cardid;?>" class="btn tp-btn-primary" style="margin-top:15px;  width:100px;">Pay Now</a>
                <a href="<?php echo base_url();?>index.php/CustomerController/delete_order/<?php echo $reservation->no; ?>" onclick="return confirm('Are you sure you want to Cancel this order?');" class="btn tp-btn-default" style="margin-top:15px; background-color:black; width:100px;">cancel</a>
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