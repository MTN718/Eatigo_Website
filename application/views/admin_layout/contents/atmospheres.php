<script>
    function onAddAtom()
    {
        var nameElement = document.getElementById('atomName');
        var formElement = document.getElementById('formAddAtom');
        if (nameElement.value == '')
        {
            swal('Atmosphere is Empty', '', 'error');
            return;
        }
        formElement.submit();
    }
</script>
<div class="box">
    <div class="box-header">
        <h3 class="box-title">Atmosphere List</h3>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
        <div class="row" style="margin-bottom: 10px"> 
            <form id='formAddAtom' name='formAddAtom' method='post' action='<?php echo base_url() . ADMIN_ACTION_ADDATOM; ?>' enctype="multipart/form-data">			
                <div class="col-md-6" >
                    <input class='form-control' name='atomName' id='atomName' placeholder='New Atmosphere'/></a>
                </div>                
                <div class="col-md-2" >
                    <button type="button" class ="btn btn-block btn-success" onclick='onAddAtom()'>Add Atmosphere</button>
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
                foreach ($atoms as $atom) {
                    $i++;
                    ?>
                    <tr>
                        <td><?php echo $i; ?></td>                        
                        <td><?php echo $atom->name; ?></td>
                        <td>
                            <a href='<?php echo base_url() . ADMIN_PAGE_EDITATOM . "/" . $atom->no; ?>'>Edit</a>&nbsp;&nbsp;&nbsp;
                            <a href='<?php echo base_url() . ADMIN_ACTION_DELETEATOM . "/" . $atom->no; ?>'>Delete</a>&nbsp;&nbsp;&nbsp;
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
