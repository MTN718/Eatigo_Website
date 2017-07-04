<script>
    function onCancel()
    {
        location.href = "<?php echo base_url() . ADMIN_PAGE_CITIES; ?>";
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
    function onUpdateCategory()
    {
        var nameElement = document.getElementById('cityName');
        var form = document.getElementById('formCategory');
        if (nameElement.value == '')
        {            
            swal('City Name is Empty', '', 'error');
            return;
        }
        form.submit();
    }
</script>
<div class="box">
    <div class="box-header">
        <h3 class="box-title">Edit City</h3>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
        <form id='formCategory' name='formCategory' method='post' enctype="multipart/form-data" action='<?php echo base_url().ADMIN_ACTION_UPDATECITY;?>'>
            <div class="row">				
                <div class="col-md-3" >
                    <input class='form-control' name='cityName' id='cityName' value='<?php echo $cityInfo->name; ?>' placeholder='Category Name'/></a>
                </div>			
<!--                <div class="col-md-3" >
                    <select class='form-control' id='cityCountry' name='cityCountry'>
                        <?php
                        foreach ($countrys as $country) {
                            if ($country->no == $cityInfo->cid)
                                echo "<option value='" . $country->no . "' selected>" . $country->name . "</option>";
                            else
                                echo "<option value='" . $country->no . "'>" . $country->name . "</option>";
                        }
                        ?>
                    </select>
                </div>                -->
                <div class="col-md-3" >
                    <select class='form-control' id='cityCurrency' name='cityCurrency'>
                        <?php
                        foreach ($currencys as $currency) {
                            if ($currency->no == $cityInfo->currency)
                                echo "<option value='" . $currency->no . "' selected>" . $currency->name . "</option>";
                            else
                                echo "<option value='" . $currency->no . "'>" . $currency->name . "</option>";
                        }
                        ?>
                    </select>
                </div>                
            </div>
            <?php
            $image = base_url() . $cityInfo->image;
            ?>
            <input type='hidden' name='cid'  value='<?php echo $cityInfo->no; ?>'/></a>
            <div class="row" style='margin-top:10px;height:200px;' >
                <div class="col-md-3" >
                    <input type="file" accept="image/*" name="uploadLogo0" id="upload0" style="visibility: hidden; width: 1px; height: 1px" multiple onchange="previewFile(0)">
                    <img  id='itemImage0' src='<?php echo $image; ?>' name='itemImage0' onclick="document.getElementById('upload0').click();
                            return false" style='height:100%;width:100%' src='img/addphoto.png'/>
                </div>				
            </div>
            <div class="row" style='margin-top:10px'>				
                <div class="col-md-2" >
                    <button type="button" class ="btn btn-block btn-primary" onclick='onUpdateCategory()'>Update City</button>
                </div>
                <div class="col-md-2" >
                    <button type="button" class ="btn btn-block btn-danger" onclick='onCancel()'>Cancel</button>
                </div>				
            </div>
        </form>
    </div>
    <!-- /.box-body -->
</div>