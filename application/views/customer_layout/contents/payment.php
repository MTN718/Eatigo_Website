<div class="main-container">
  <div class="container">
  	<div class="row">
    <div class="col-md-3"></div>
    	<div class="col-md-6 error-block">
      <p style="color:red;">Do not go back or Referesh your page.</p>
        <div class="well-box">
        <?php 

            $this->db->select('*');
            $this->db->from('tbl_card');
            $this->db->where('no', $cardid);
            $query = $this->db->get();
            if ( $query->num_rows() > 0 )
            {
              $row = $query->row_array();
              $cardnumber = $row['cardnumber'];
              $cardnumber = $row['expirymonth'];
              $cardnumber = $row['expiryyear'];
              $cardnumber = $row['cvv'];
            }
          ?>

          <form action="<?php echo base_url();?>index.php/CustomerController/add_card" method="post">
            <input type="hidden" name="cnumber" value="<?php echo $cardnumber;?>">
            <input type="hidden" name="emonth" value="">
            <input type="hidden" name="eyear" value="">      
            <div class="row">     
                  <div class="form-group col-md-6">
                    <label class="control-label" for="town">CVV<span class="required">*</span><span class="required">*</span></label>
                    <input type="text" class="form-control" id="cvv" pattern="[0-9]{3,4}" name="cvv" placeholder="CVV Number" required="required">
                  </div>
                   <div class="form-group col-md-12">
                     <button type="submit" class="btn tp-btn-primary findhover" style="margin-top:15px;  width:140px;">Add Credits</button>
                  </div>              
             </div>
          </form>
        </div>
      </div>
      <div class="col-md-3"></div>
    </div>
  </div>
</div>
