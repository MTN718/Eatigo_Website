<script>
    function previewFile() {
        var file = document.querySelector('input[type=file]').files[0]; //sames as here        
        var formElement = document.getElementById('formAddCountry');
        var reader = new FileReader();
        reader.onloadend = function() {
            formElement.submit();            
        }
        if (file) {
            reader.readAsDataURL(file); //reads the data as a URL
        }
    }
    function onAddCountry()
    {
        var nameElement = document.getElementById('countryName');
        if (nameElement.value == '')
        {
            swal('Country Name is Empty','','error');
            return;
        }
        document.getElementById('uploadFlag').click();        
    }
</script>
<div class="box">
    <div class="box-header">
        <h3 class="box-title">Country List</h3>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
        <div class="row" style="margin-bottom: 10px"> 
            <form id='formAddCountry' name='formAddCountry' method='post' action='<?php echo base_url().ADMIN_ACTION_ADDCOUNTRY;?>' enctype="multipart/form-data">			
                <div class="col-md-6" >
                    <input class='form-control' name='countryName' id='countryName' placeholder='New Country'/></a>
                </div>
                <input type="file" accept="image/*" name="uploadFlag" id="uploadFlag" style="visibility: hidden; width: 1px; height: 1px" multiple onchange="previewFile()">
                <div class="col-md-4" >
                    <button type="button" class ="btn btn-block btn-success" onclick='onAddCountry()'>Add Country with Flag</button>
                </div>
            </form>
        </div>
        <table id="example1" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Flag</th>
                    <th>Name</th>
                    <th>Detail</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $i = 0;
                foreach ($countrys as $country) {
                    $i++;
                    ?>
                    <tr>
                        <td><?php echo $i; ?></td>
                        <td><img src='<?php echo base_url() . $country->image; ?>' style='width:50px;height:30px;'/></td>
                        <td><?php echo $country->name; ?></td>
                        <td>
                            <a href='<?php echo base_url().ADMIN_PAGE_EDITCOUNTRY."/".$country->no;?>'>Edit</a>&nbsp;&nbsp;&nbsp;
                            <a href='<?php echo base_url().ADMIN_ACTION_DELETECOUNTRY."/".$country->no;?>'>Delete</a>&nbsp;&nbsp;&nbsp;
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