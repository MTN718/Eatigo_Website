<script>
    function onCancel()
    {
        location.href = "<?php echo base_url() . ADMIN_PAGE_CURRENCYS; ?>";
    }
    function onUpdateCurrency()
    {
        var nameElement = document.getElementById('currencyName');
        var form = document.getElementById('formCurrency');
        if (nameElement.value == '')
        {
            swal('Currency is Empty', '', 'error');
            return;
        }
        form.submit();
    }
</script>
<div class="box">
    <div class="box-header">
        <h3 class="box-title">Edit Currency</h3>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
        <form id='formCurrency' name='formCurrency' method='post' enctype="multipart/form-data" action='<?php echo base_url() . ADMIN_ACTION_EDITCURRENCY; ?>'>
            <div class="row">				
                <div class="col-md-5" >
                    <input class='form-control' name='currencyName' id='currencyName' value='<?php echo $currency->name; ?>' placeholder='Currency Name'/></a>
                </div>				
            </div>            
            <input type='hidden' name='cid'  value='<?php echo $currency->no; ?>'/>
            <div class="row" style='margin-top:10px'>				
                <div class="col-md-2" >
                    <button type="button" class ="btn btn-block btn-primary" onclick='onUpdateCurrency()'>Update Currency</button>
                </div>
                <div class="col-md-2" >
                    <button type="button" class ="btn btn-block btn-danger" onclick='onCancel()'>Cancel</button>
                </div>				
            </div>
        </form>
    </div>
    <!-- /.box-body -->
</div>