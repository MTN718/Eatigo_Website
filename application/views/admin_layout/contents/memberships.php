<script>
    function updatePlan()
    {
        var form = document.getElementById('formPlan');        
        form.submit();
    }
</script>
<div class="box">
    <div class="box-header">
        <h3 class="box-title">Membership</h3>
    </div>
    <form role="form" method="post" id="formPlan" action="<?php echo base_url(). ADMIN_ACTION_EDITMEMBERSHIP;?>">        
        <div class="box-body">            
            <div class="form-group">
                <?php
                $i = 0;
                foreach ($memberships as $membership) {
                    $i++;
                    ?>
                    <div class="row" style="margin-top:10px">
                        <div class="col-md-3">
                            <label for="exampleInputEmail1">Plan</label>                            
                            <input type='email' class='form-control' id='class_name' name='planName[]' placeholder='Name' value='<?php echo $membership->name;?>'>
                            
                        </div>
                        <div class="col-md-3">
                            <label for="exampleInputEmail1">Price</label>
                            <?php
                            if ($i == 1)                            
                                echo "<input type='email' class='form-control' id='class_value' name='planPrice[]' placeholder='Price' value='".$membership->price."' disabled>";
                            else
                                echo "<input type='email' class='form-control' id='class_value' name='planPrice[]' placeholder='Price' value='".$membership->price."'>";
                            
                            ?>                            
                        </div>                                                
                        <div class="col-md-3">
                            <label for="exampleInputEmail1">Credits</label>
                            
                            <?php
                            if ($i == 3)                            
                                echo "<input type='email' class='form-control' id='class_price' name='planCredit[]' placeholder='Credit' value='Unlimit' disabled>";
                            else
                                echo "<input type='email' class='form-control' id='class_price' name='planCredit[]' placeholder='Credit' value='".$membership->credit."'>";
                            
                            ?>    
                        </div>                                                
                    </div>  
                    <?php
                }
                ?>

            </div>                 
        </div>
    </form>
    <div class="box-footer">
        <button class="btn btn-primary" onclick="updatePlan()">Update Plan</button>
    </div>
    <!-- /.box-body -->
</div>
</div>

