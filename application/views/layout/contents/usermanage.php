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
        var formElement = document.getElementById('formAddCategory');
        if (nameElement.value == '')
        {
            alert('Category is Empty');
            return;
        }
        formElement.submit();
    }
</script>
<div class="box">
    <div class="box-header">
        <h3 class="box-title">Users</h3>
    </div>
    <!-- /.box-header -->
    <div class="box-body">        
        <table id="example1" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>No</th>
                    <th>FirstName</th>
                    <th>LastName</th>
                    <th>Email</th>
                    <th>Type</th>
                    <th>Details</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $i = 0;
                foreach ($users as $user) {
                    $i++;
                    ?>
                    <tr>
                        <td><?php echo $i; ?></td>
                        <td><?php echo $user->firstname; ?></td>
                        <td><?php echo $user->lastname; ?></td>    
                        <td><?php echo $user->email; ?></td>
                        <td>
                            <?php
                            if ($user->type == 0)
                                echo "Email";
                            else
                                echo "Facebook";
                            ?>
                        </td>
                        <td><?php echo $user->createdate; ?></td>    						
                        <td>
                            <a href='index.php?c=main&m=deleteUser&id=<?php echo $user->no; ?>'>Delete</a>&nbsp;&nbsp;&nbsp;
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