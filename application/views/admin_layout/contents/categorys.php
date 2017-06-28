<script>
    function previewFile() {
        var file = document.querySelector('input[type=file]').files[0]; //sames as here        
        var formElement = document.getElementById('formAddCategory');
        var reader = new FileReader();
        reader.onloadend = function() {
            formElement.submit();            
        }
        if (file) {
            reader.readAsDataURL(file); //reads the data as a URL
        }
    }
    function onAddCategory()
    {
        var nameElement = document.getElementById('categoryName');
        if (nameElement.value == '')
        {
            swal('Category Name is Empty','','error');
            return;
        }
        document.getElementById('uploadImage').click();        
    }
</script>
<div class="box">
    <div class="box-header">
        <h3 class="box-title">Category List</h3>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
        <div class="row" style="margin-bottom: 10px"> 
            <form id='formAddCategory' name='formAddCategory' method='post' action='<?php echo base_url() . ADMIN_ACTION_ADDCATEGORY; ?>' enctype="multipart/form-data">			
                <div class="col-md-3" >
                    <input class='form-control' name='categoryName' id='categoryName' placeholder='New Category'/></a>
                </div>      
                <div class="col-md-3" >
                    <select class='form-control' id='categoryCountry' name='categoryCountry'>
                        <?php
                        foreach ($countrys as $country) {
                            echo "<option value='" . $country->no . "'>" . $country->name . "</option>";
                        }
                        ?>
                    </select>
                </div>
                <input type="file" accept="image/*" name="uploadImage" id="uploadImage" style="visibility: hidden; width: 1px; height: 1px" multiple onchange="previewFile()">
                <div class="col-md-2" >
                    <div class="checkbox" style="margin:5px;">
                        <label><input type="checkbox" name='categoryFeature' value="1"/> Is Featured?</label>
                    </div>
                </div>
                <div class="col-md-3" >
                    <button type="button" class ="btn btn-block btn-success" onclick='onAddCategory()'>Add Category with Image</button>
                </div>
            </form>
        </div>
        <table id="example1" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Name</th>
                    <th>City</th>
                    <th>Detail</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $i = 0;
                foreach ($categorys as $category) {
                    $i++;
                    ?>
                    <tr>
                        <td><?php echo $i; ?></td>                        
                        <td><?php echo $category->name; ?></td>
                        <td><?php echo $category->city; ?></td>
                        <td>
                            <a href='<?php echo base_url() . ADMIN_PAGE_EDITCATEGORY . "/" . $category->no; ?>'>Edit</a>&nbsp;&nbsp;&nbsp;
                            <a href='<?php echo base_url() . ADMIN_ACTION_DELETECATEGORY . "/" . $category->no; ?>'>Delete</a>&nbsp;&nbsp;&nbsp;
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