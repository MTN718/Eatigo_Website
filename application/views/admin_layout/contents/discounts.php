<div class="box">
    <div class="box-header">
        <h3 class="box-title">Discounts</h3>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
        <table id="example1" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Time</th>
                    <th>Restaurant</th>
                    <th>Percent</th>                   
                    <th>Price</th>                    
                    <th>Amount</th>                    
                    <th>Details</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $i = 0;
                foreach ($discounts as $discount) {
                    $i++;
                    ?>
                    <tr>
                        <td><?php echo $i; ?></td>
                        <td><?php echo $discount->rtime; ?></td>
                        <td><?php echo $discount->restaurant; ?></td>
                        <td></td>
                        <td><?php echo $discount->price; ?></td>                        
                        <td><?php echo $discount->amount; ?></td>                                                                      
                        <td>
                            <a href='<?php echo base_url() . ADMIN_ACTION_RESTAURANT_DELETE . "/" . $restaurant->no; ?>'>Delete</a>&nbsp;&nbsp;&nbsp;
                            <a href='<?php echo base_url() . ADMIN_ACTION_RESTAURANT_DELETE . "/" . $restaurant->no; ?>'>Delete</a>&nbsp;&nbsp;&nbsp;
                        </td>
                    </tr>
                    <?php
                }
                ?>
            </tbody>            
        </table>
    </div>
    <!-- /.box-body -->
</div>