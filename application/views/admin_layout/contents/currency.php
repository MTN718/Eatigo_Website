<script>
    function onAddCurrency()
    {
        var nameElement = document.getElementById('currencyName');
        var formElement = document.getElementById('formAddCurrency');
        if (nameElement.value == '')
        {
            swal('Currency Name is Empty', '', 'error');
            return;
        }
        formElement.submit();
    }
</script>
<div class="box">
    <div class="box-header">
        <h3 class="box-title">Currency List</h3>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
        <div class="row" style="margin-bottom: 10px"> 
            <form id='formAddCurrency' name='formAddCurrency' method='post' action='<?php echo base_url() . ADMIN_ACTION_ADDCURRENCY; ?>' enctype="multipart/form-data">			
                <div class="col-md-6" >
                    <input class='form-control' name='currencyName' id='currencyName' placeholder='New Currency'/></a>
                </div>                
                <div class="col-md-2" >
                    <button type="button" class ="btn btn-block btn-success" onclick='onAddCurrency()'>Add Currency</button>
                </div>
            </form>
        </div>
        <table id="example1" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Name</th>
                    <th>Detail</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $i = 0;
                foreach ($currencys as $currency) {
                    $i++;
                    ?>
                    <tr>
                        <td><?php echo $i; ?></td>                        
                        <td><?php echo $currency->name; ?></td>
                        <td>
                            <a href='<?php echo base_url() . ADMIN_PAGE_EDITCURRENCY . "/" . $currency->no; ?>'>Edit</a>&nbsp;&nbsp;&nbsp;
                            <a href='<?php echo base_url() . ADMIN_ACTION_DELETECURRENCY . "/" . $currency->no; ?>'>Delete</a>&nbsp;&nbsp;&nbsp;
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
