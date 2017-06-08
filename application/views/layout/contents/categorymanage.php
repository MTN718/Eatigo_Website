<script>
    function previewFile() {
        var file = document.querySelector('input[type=file]').files[0]; //sames as here        
        var formElement = document.getElementById('formAddCategory');
        var reader = new FileReader();
        reader.onloadend = function() {
            formElement.submit();
            //preview.src = reader.result;
        }
        if (file) {
            reader.readAsDataURL(file); //reads the data as a URL
        } else {
        }
    }
    function onAddSubject()
    {
        var nameElement = document.getElementById('categoryName');
        var priceElement = document.getElementById('categoryPrice');
        var deliverElement = document.getElementById('categoryDeliver');
        
        var formElement = document.getElementById('formAddCategory');
        if (nameElement.value == '')
        {
            alert('Category is Empty');
            return;
        }
        if (priceElement.value == '')
        {
            alert('Price is Empty');
            return;
        }
        if (deliverElement.value == '')
        {
            alert('Deliver Date is Empty');
            return;
        }
        document.getElementById('upload').click();
        //formElement.submit();
    }
</script>
<div class="box">
    <div class="box-header">
        <h3 class="box-title">Category List</h3>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
        <div class="row" style="margin-bottom: 10px"> 
            <form id='formAddCategory' name='formAddCategory' method='post' action='index.php?c=Main&m=onAddCategory' enctype="multipart/form-data">			
                <div class="col-md-3" >
                    <input class='form-control' name='categoryName' id='categoryName' placeholder='New Category'/></a>
                </div>
                <div class="col-md-1" >
                    <input class='form-control' type='number' name='categoryDeliver' id='categoryDeliver' placeholder='Deliver'/></a>
                </div>
                <div class="col-md-1" >
                    <input class='form-control' type='number' name='categoryPrice' id='categoryPrice' placeholder='Price'/></a>
                </div>
                <div class="col-md-2">
                    <input type='checkbox' name='categoryPopular' value="1"> Is Popular?
                </div>
                <input type="file" accept="image/*" name="uploadLogo" id="upload" style="visibility: hidden; width: 1px; height: 1px" multiple onchange="previewFile()">                                
                <div class="col-md-3" >
                    <button type="button" class ="btn btn-block btn-success" onclick='onAddSubject()'>Add Category with Icon</button>
                </div>
            </form>
        </div>
        <table id="example1" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Name</th>
                    <th>Icon</th>                    
                    <th>Deliver</th>
                    <th>Price</th>
                    <th>Is Popular</th>
                    <th>Details</th>
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
                        <td><img src='<?php echo base_url().$category->icon; ?>' style='width:40px;height:40px;'/></td>                        
                        <td><?php echo $category->delivery." Days"; ?></td>                        
                        <td><?php echo $category->price."$"; ?></td>                        
                        <td>
                            <?php 
                                if ($category->popular == 0)
                                    echo "No";
                                else
                                    echo "Yes";
                            ?>
                        </td>                        
                        <td>
                            <a href='index.php?c=main&m=editCategory&id=<?php echo $category->no; ?>'>Edit</a>&nbsp;&nbsp;&nbsp;
                            <a href='index.php?c=main&m=deleteCategory&id=<?php echo $category->no; ?>'>Delete</a>&nbsp;&nbsp;&nbsp;
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