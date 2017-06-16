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
                    <th>TransID</th>
                    <th>Restaurant</th>
                    <th>User</th>                   
                    <th>Price</th>                    
                    <th>Status</th>                    
                    <th>Date</th>                    
                    <th>Details</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $i = 0;
                foreach ($transactions as $transaction) {
                    $i++;
                    ?>
                    <tr>
                        <td><?php echo $i; ?></td>
                        <td><?php echo $transaction->transaction; ?></td>
                        <td><?php echo $transaction->restaurant; ?></td>
                        <td><?php echo $transaction->user; ?></td>
                        <td><?php echo $transaction->price . "$"; ?></td>                                                
                        <td>                            
                            <?php
                            if ($transaction->status == 0)
                                echo "Checkout";
                            else
                                echo "Refund"
                                ?>
                        </td>                                                                      
                        <td><?php echo $transaction->createtime; ?></td>                        
                        <td>
                            <a href='<?php echo base_url() . ADMIN_ACTION_TRANSACTION_DELETE . "/" . $transaction->no; ?>'>Delete</a>&nbsp;&nbsp;&nbsp;
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