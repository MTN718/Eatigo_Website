<script>
    function onCancelAdd()
    {
        location.href = "index.php?c=main&m=welcomes";
    }
    function previewFile(i) {
        var preview = document.getElementById('itemImage' + i); //selects the query named img
        var file = document.getElementById('upload' + i).files[0]; //sames as here
        var reader = new FileReader();
        reader.onloadend = function() {
            //uploadImage1();
            preview.src = reader.result;
        }
        if (file) {
            reader.readAsDataURL(file); //reads the data as a URL
        } else {
            //preview.src = "";
        }
    }
    function onAddItem()
    {
        var nameElement = document.getElementById('itemName');        
        var formAdd = document.getElementById('formAddItem');
        if (nameElement.value == '')
        {
            alert('Empty name');
            return;
        }        
        formAdd.submit();
    }
</script>
<div class="box">
    <div class="box-header">
        <h3 class="box-title">Edit Welcome Screen</h3>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
        <form id='formAddItem' name='formAddItem' method='post' enctype="multipart/form-data" action='index.php?c=Main&m=onUpdateWelcome'>
            <div class="row">				
                <div class="col-md-2" >
                    <input class='form-control' name='categoryName' id='itemName' value='<?php echo $category->te; ?>' placeholder='Welcome Text'/></a>
                </div>                
                
            </div>
            <?php
            $image = base_url() . $category->image;
            ?>
            <input type='hidden' name='cid'  value='<?php echo $category->no; ?>'/></a>
            <div class="row" style='margin-top:10px;height:200px;' >
                <div class="col-md-3" style='width:250px;' >
                    <input type="file" accept="image/*" name="uploadLogo0" id="upload0" style="visibility: hidden; width: 1px; height: 1px" multiple onchange="previewFile(0)">
                    <img  id='itemImage0' src='<?php echo $image; ?>' name='itemImage0' onclick="document.getElementById('upload0').click();
                            return false" style='height:100%;width:100%' src='img/addphoto.png'/>
                </div>				
            </div>
            <div class="row" style='margin-top:10px'>				
                <div class="col-md-2" >
                    <button type="button" class ="btn btn-block btn-primary" onclick='onAddItem()'>Update Category</button>
                </div>
                <div class="col-md-2" >
                    <button type="button" class ="btn btn-block btn-danger" onclick='onCancelAdd()'>Cancel</button>
                </div>				
            </div>
        </form>
    </div>
    <!-- /.box-body -->
</div>