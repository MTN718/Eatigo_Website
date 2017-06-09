<script>
    function onCancel()
    {
        location.href = "<?php echo base_url() . ADMIN_PAGE_COUNTRYS; ?>";
    }
    function previewFile(i) {
        var preview = document.getElementById('itemImage' + i); //selects the query named img
        var file = document.getElementById('upload' + i).files[0]; //sames as here
        var reader = new FileReader();
        reader.onloadend = function() {
            preview.src = reader.result;
        }
        if (file) {
            reader.readAsDataURL(file); //reads the data as a URL
        } else {
        }
    }
    function onUpdateCountry()
    {
        var nameElement = document.getElementById('countryName');
        var form = document.getElementById('formCountry');
        if (nameElement.value == '')
        {
            alert('Empty name');
            return;
        }
        form.submit();
    }
</script>
<div class="box">
    <div class="box-header">
        <h3 class="box-title">Edit Country</h3>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
        <form id='formCountry' name='formCountry' method='post' enctype="multipart/form-data" action='<?php echo base_url().ADMIN_ACTION_UPDATECOUNTRY;?>'>
            <div class="row">				
                <div class="col-md-5" >
                    <input class='form-control' name='countryName' id='countryName' value='<?php echo $countryInfo->name; ?>' placeholder='Country Name'/></a>
                </div>				
            </div>
            <?php
            $image = base_url() . $countryInfo->image;
            ?>
            <input type='hidden' name='cid'  value='<?php echo $countryInfo->no; ?>'/></a>
            <div class="row" style='margin-top:10px;height:200px;' >
                <div class="col-md-3" >
                    <input type="file" accept="image/*" name="uploadLogo0" id="upload0" style="visibility: hidden; width: 1px; height: 1px" multiple onchange="previewFile(0)">
                    <img  id='itemImage0' src='<?php echo $image; ?>' name='itemImage0' onclick="document.getElementById('upload0').click();
                            return false" style='height:100%;width:100%' src='img/addphoto.png'/>
                </div>				
            </div>
            <div class="row" style='margin-top:10px'>				
                <div class="col-md-2" >
                    <button type="button" class ="btn btn-block btn-primary" onclick='onUpdateCountry()'>Update Country</button>
                </div>
                <div class="col-md-2" >
                    <button type="button" class ="btn btn-block btn-danger" onclick='onCancel()'>Cancel</button>
                </div>				
            </div>
        </form>
    </div>
    <!-- /.box-body -->
</div>