<script>
    function onCancel()
    {
        location.href = "<?php echo base_url() . ADMIN_PAGE_LANGUAGES; ?>";
    }
    function onUpdateLanguage()
    {
        var nameElement = document.getElementById('langName');
        var form = document.getElementById('formLanguage');
        if (nameElement.value == '')
        {            
            swal('Language Name is Empty', '', 'error');
            return;
        }
        form.submit();
    }
</script>
<div class="box">
    <div class="box-header">
        <h3 class="box-title">Edit Language</h3>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
        <form id='formLanguage' name='formLanguage' method='post' enctype="multipart/form-data" action='<?php echo base_url().ADMIN_ACTION_UPDATELANGUAGE;?>'>
            <div class="row">				
                <div class="col-md-5" >
                    <input class='form-control' name='langName' id='langName' value='<?php echo $langInfo->name; ?>' placeholder='Language Name'/></a>
                </div>				
            </div>            
            <input type='hidden' name='cid'  value='<?php echo $langInfo->no; ?>'/>
            <div class="row" style='margin-top:10px'>				
                <div class="col-md-2" >
                    <button type="button" class ="btn btn-block btn-primary" onclick='onUpdateLanguage()'>Update Language</button>
                </div>
                <div class="col-md-2" >
                    <button type="button" class ="btn btn-block btn-danger" onclick='onCancel()'>Cancel</button>
                </div>				
            </div>
        </form>
    </div>
    <!-- /.box-body -->
</div>