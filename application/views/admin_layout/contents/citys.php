<script>
    function previewFile() {
        var file = document.querySelector('input[type=file]').files[0]; //sames as here        
        var formElement = document.getElementById('formAddCity');
        var reader = new FileReader();
        reader.onloadend = function() {
            formElement.submit();
        }
        if (file) {
            reader.readAsDataURL(file); //reads the data as a URL
        }
    }
    function onAddCity()
    {
        var nameElement = document.getElementById('cityName');
        if (nameElement.value == '')
        {
            swal('City Name is Empty', '', 'error');
            return;
        }
        document.getElementById('uploadImage').click();
    }
</script>

<div class="box">
    <div class="box-header">
        <h3 class="box-title">City List</h3>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
        <div class="row" style="margin-bottom: 10px"> 
            <form id='formAddCity' name='formAddCity' method='post' action='<?php echo base_url() . ADMIN_ACTION_ADDCITY; ?>' enctype="multipart/form-data">			
                <div class="col-md-3" >
                    <input class='form-control' name='cityName' id='cityName' placeholder='New City'/></a>
                </div>      
                <!--                <div class="col-md-3" >
                                    <select class='form-control' id='cityCountry' name='cityCountry'>
                <?php
                foreach ($countrys as $country) {
                    echo "<option value='" . $country->no . "'>" . $country->name . "</option>";
                }
                ?>
                                    </select>
                                </div>-->
                <div class="col-md-3" >
                    <select class='form-control' id='cityCurrency' name='cityCurrency'>
                        <?php
                        foreach ($currencys as $currency) {
                            echo "<option value='" . $currency->no . "'>" . $currency->name . "</option>";
                        }
                        ?>
                    </select>
                </div>
                <input type="file" accept="image/*" name="uploadImage" id="uploadImage" style="visibility: hidden; width: 1px; height: 1px" multiple onchange="previewFile()">                
                <div class="col-md-3" >
                    <button type="button" class ="btn btn-block btn-success" onclick='onAddCity()'>Add City with Image</button>
                </div>
            </form>
        </div>


        <table id="example1" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Name</th>
                    <th>Currency</th>                    
                    <th>Details</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $i = 0;
                foreach ($citys as $city) {
                    $i++;
                    ?>
                    <tr>
                        <td><?php echo $i; ?></td>
                        <td><?php echo $city->name; ?></td>
                        <td><?php echo $city->currency; ?></td>                        
                        <td>
                            <a href='<?php echo base_url() . ADMIN_PAGE_EDITCITY . "/" . $city->no; ?>'>Edit</a>&nbsp;&nbsp;&nbsp;
                            <a href='<?php echo base_url() . ADMIN_ACTION_DELETECITY . "/" . $city->no; ?>'>Delete</a>&nbsp;&nbsp;&nbsp;
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