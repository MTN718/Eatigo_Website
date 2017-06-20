<script>
    function dialogPrice(no,price)
    {
        var input = document.getElementById('priceValue');
        var inputDid = document.getElementById('did');
        input.value = price;
        inputDid.value = no;
        $('#priceDialog').modal();
    }
</script>
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
                        <td><?php echo $discount->percent."%"; ?></td>
                        <td><?php echo $discount->price."$"; ?></td>                        
                        <td><?php echo $discount->amount; ?></td>                                                                      
                        <td>
                            <a href='#' onclick='dialogPrice("<?php echo $discount->no;?>","<?php echo $discount->price;?>")'>Change Price</a>&nbsp;&nbsp;&nbsp;
                            <a href='<?php echo base_url() . ADMIN_ACTION_DISCOUNT_DELETE . "/" . $discount->no; ?>'>Delete</a>&nbsp;&nbsp;&nbsp;
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


<div class="modal fade" tabindex="-1" role="dialog" id='priceDialog'>
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Discount Price</h4>
            </div>
            <form method='post' action='<?php echo base_url().ADMIN_ACTION_DISCOUNT_CHANGEPRICE;?>'>
                <div class="modal-body">
                    <input type='hidden' class='form-control' name='did' id='did' value=''/></a>
                    <input class='form-control' name='priceValue' id='priceValue' value='' placeholder='Price'/></a>                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Change</button>
                </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->