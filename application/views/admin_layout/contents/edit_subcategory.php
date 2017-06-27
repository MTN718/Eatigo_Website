<script>
    function onCancel()
    {
        location.href = "<?php echo base_url() . ADMIN_PAGE_CATEGORYS; ?>";
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
        var nameElement = document.getElementById('categoryName');
        var form = document.getElementById('formCategory');
        if (nameElement.value == '')
        {            
            swal('Category Name is Empty', '', 'error');
            return;
        }
        form.submit();
    }
</script>
<div class="box">
    <div class="box-header">
        <h3 class="box-title">Edit Sub Category</h3>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
        <form id='formCategory' name='formCategory' method='post' enctype="multipart/form-data" action='<?php echo base_url().ADMIN_ACTION_EDITSUBCATEGORY;?>'>
            <div class="row">				
                <div class="col-md-3" >
                    <input class='form-control' name='categoryName' id='categoryName' value='<?php echo $subcategory->name; ?>' placeholder='Category Name'/></a>
                </div>			
                <div class="col-md-3" >
                    <select class='form-control' id='categoryCountry' name='categoryCountry'>
                        <?php
                        foreach ($categorys as $category) {
                            if ($category->no == $subcategory->cid)
                                echo "<option value='" . $category->no . "' selected>" . $category->name . "</option>";
                            else
                                echo "<option value='" . $category->no . "'>" . $category->name . "</option>";
                        }
                        ?>
                    </select>
                </div>                
            </div>
            <?php
            $image = base_url() . $subcategory->image;
            ?>
            <input type='hidden' name='cid'  value='<?php echo $subcategory->no; ?>'/></a>
            <div class="row" style='margin-top:10px;height:200px;' >
                <div class="col-md-3" >
                    <input type="file" accept="image/*" name="uploadLogo0" id="upload0" style="visibility: hidden; width: 1px; height: 1px" multiple onchange="previewFile(0)">
                    <img  id='itemImage0' src='<?php echo $image; ?>' name='itemImage0' onclick="document.getElementById('upload0').click();
                            return false" style='height:100%;width:100%' src='img/addphoto.png'/>
                </div>				
            </div>
            <div class="row" style='margin-top:10px'>				
                <div class="col-md-2" >
                    <button type="button" class ="btn btn-block btn-primary" onclick='onUpdateCategory()'>Update Sub Category</button>
                </div>
                <div class="col-md-2" >
                    <button type="button" class ="btn btn-block btn-danger" onclick='onCancel()'>Cancel</button>
                </div>				
            </div>
        </form>
    </div>
    <!-- /.box-body -->
</div>