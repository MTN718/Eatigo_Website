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
        <h3 class="box-title">Welcome Screen Setting</h3>
    </div>
    <!-- /.box-header -->
    <div class="box-body">        
        <table id="example1" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Name</th>
                    <th>Image</th>                                        
                    <th>Details</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $i = 0;
                foreach ($welcomes as $welcome) {
                    $i++;
                    ?>
                    <tr>
                        <td><?php echo $i; ?></td>
                        <td><?php echo $welcome->te; ?></td>
                        <td><img src='<?php echo base_url().$welcome->image; ?>' style='width:40px;height:40px;'/></td>                                                          
                        <td>
                            <a href='index.php?c=main&m=editWelcome&id=<?php echo $welcome->no; ?>'>Edit</a>&nbsp;&nbsp;&nbsp;                            
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