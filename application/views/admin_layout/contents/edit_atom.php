<script>
    function onCancel()
    {
        location.href = "<?php echo base_url() . ADMIN_PAGE_ATMOSPHERES; ?>";
    }
    function onUpdateLanguage()
    {
        var nameElement = document.getElementById('atomName');
        var form = document.getElementById('formAtom');
        if (nameElement.value == '')
        {            
            swal('Atmosphere is Empty', '', 'error');
            return;
        }
        form.submit();
    }
</script>
<div class="box">
    <div class="box-header">
        <h3 class="box-title">Edit Atmosphere</h3>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
        <form id='formAtom' name='formAtom' method='post' enctype="multipart/form-data" action='<?php echo base_url().ADMIN_ACTION_UPDATEATOM;?>'>
            <div class="row">				
                <div class="col-md-5" >
                    <input class='form-control' name='atomName' id='atomName' value='<?php echo $atom->name; ?>' placeholder='Atmosphere'/></a>
                </div>				
            </div>            
            <input type='hidden' name='cid'  value='<?php echo $atom->no; ?>'/>
            <div class="row" style='margin-top:10px'>				
                <div class="col-md-2" >
                    <button type="button" class ="btn btn-block btn-primary" onclick='onUpdateLanguage()'>Update Atmosphere</button>
                </div>
                <div class="col-md-2" >
                    <button type="button" class ="btn btn-block btn-danger" onclick='onCancel()'>Cancel</button>
                </div>				
            </div>
        </form>
    </div>
    <!-- /.box-body -->
</div>