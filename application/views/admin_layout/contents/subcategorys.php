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
        var nameElement = document.getElementById('subcategory');
        if (nameElement.value == '')
        {
            swal('Sub Category Name is Empty', '', 'error');
            return;
        }
        document.getElementById('uploadImage').click();
    }
</script>
<div class="box">
    <div class="box-header">
        <h3 class="box-title">Sub Category List</h3>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
        <div class="row" style="margin-bottom: 10px"> 
            <form id='formAddCategory' name='formAddCategory' method='post' action='<?php echo base_url() . ADMIN_ACTION_ADDSUBCATEGORY; ?>' enctype="multipart/form-data">			
                <div class="col-md-3" >
                    <input class='form-control' name='subcategory' id='subcategory' placeholder='New Sub Category'/></a>
                </div>      
                <div class="col-md-3" >
                    <select class='form-control' id='categoryName' name='categoryName'>
                        <?php
                        foreach ($categorys as $category) {
                            echo "<option value='" . $category->no . "'>" . $category->name . "</option>";
                        }
                        ?>
                    </select>
                </div>
                <input type="file" accept="image/*" name="uploadImage" id="uploadImage" style="visibility: hidden; width: 1px; height: 1px" multiple onchange="previewFile()">                
                <div class="col-md-3" >
                    <button type="button" class ="btn btn-block btn-success" onclick='onAddCategory()'>Add Sub Category with Image</button>
                </div>
            </form>
        </div>
        <table id="example1" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Name</th>
                    <th>Category</th>
                    <th>Detail</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $i = 0;
                foreach ($subcategorys as $subcategory) {
                    $i++;
                    ?>
                    <tr>
                        <td><?php echo $i; ?></td>                        
                        <td><?php echo $subcategory->name; ?></td>
                        <td><?php echo $subcategory->category; ?></td>
                        <td>
                            <a href='<?php echo base_url() . ADMIN_PAGE_EDITSUBCATEGORY . "/" . $subcategory->no; ?>'>Edit</a>&nbsp;&nbsp;&nbsp;
                            <a href='<?php echo base_url() . ADMIN_ACTION_DELETESUBCATEGORY . "/" . $subcategory->no; ?>'>Delete</a>&nbsp;&nbsp;&nbsp;
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