<script>
    function onCancel()
    {
        location.href = "<?php echo base_url() . ADMIN_PAGE_FACILITYS; ?>";
    }
    function onUpdateService()
    {
        var nameElement = document.getElementById('facilityName');
        var form = document.getElementById('formFacility');
        if (nameElement.value == '')
        {            
            swal('Service Name is Empty', '', 'error');
            return;
        }
        form.submit();
    }
</script>
<div class="box">
    <div class="box-header">
        <h3 class="box-title">Edit Service</h3>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
        <form id='formFacility' name='formFacility' method='post' enctype="multipart/form-data" action='<?php echo base_url().ADMIN_ACTION_UPDATEFACILITY;?>'>
            <div class="row">				
                <div class="col-md-5" >
                    <input class='form-control' name='facilityName' id='facilityName' value='<?php echo $facilityInfo->name; ?>' placeholder='Service Name'/></a>
                </div>				
            </div>            
            <input type='hidden' name='cid'  value='<?php echo $facilityInfo->no; ?>'/>
            <div class="row" style='margin-top:10px'>				
                <div class="col-md-2" >
                    <button type="button" class ="btn btn-block btn-primary" onclick='onUpdateService()'>Update Service</button>
                </div>
                <div class="col-md-2" >
                    <button type="button" class ="btn btn-block btn-danger" onclick='onCancel()'>Cancel</button>
                </div>				
            </div>
        </form>
    </div>
    <!-- /.box-body -->
</div>