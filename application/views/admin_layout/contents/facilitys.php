<script>
    function onAddFacility()
    {
        var nameElement = document.getElementById('facilityName');
        var formElement = document.getElementById('formAddFacility');
        if (nameElement.value == '')
        {
            swal('Service Name is Empty', '', 'error');
            return;
        }
        formElement.submit();
    }
</script>
<div class="box">
    <div class="box-header">
        <h3 class="box-title">Service List</h3>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
        <div class="row" style="margin-bottom: 10px"> 
            <form id='formAddFacility' name='formAddFacility' method='post' action='<?php echo base_url() . ADMIN_ACTION_ADDFACILITY; ?>' enctype="multipart/form-data">			
                <div class="col-md-6" >
                    <input class='form-control' name='facilityName' id='facilityName' placeholder='New Service'/></a>
                </div>                
                <div class="col-md-2" >
                    <button type="button" class ="btn btn-block btn-success" onclick='onAddFacility()'>Add Service</button>
                </div>
            </form>
        </div>
        <table id="example1" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Name</th>
                    <th>Detail</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $i = 0;
                foreach ($facilitys as $facility) {
                    $i++;
                    ?>
                    <tr>
                        <td><?php echo $i; ?></td>                        
                        <td><?php echo $facility->name; ?></td>
                        <td>
                            <a href='<?php echo base_url() . ADMIN_PAGE_EDITFACILITY . "/" . $facility->no; ?>'>Edit</a>&nbsp;&nbsp;&nbsp;
                            <a href='<?php echo base_url() . ADMIN_ACTION_DELETEFACILITY . "/" . $facility->no; ?>'>Delete</a>&nbsp;&nbsp;&nbsp;
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