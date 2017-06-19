<script>    
    function onAddLanguage()
    {
        var nameElement = document.getElementById('langName');
        var formElement = document.getElementById('formAddLang');
        if (nameElement.value == '')
        {
            swal('Language Name is Empty', '', 'error');
            return;
        }
        formElement.submit();
    }
</script>
<div class="box">
    <div class="box-header">
        <h3 class="box-title">Language List</h3>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
        <div class="row" style="margin-bottom: 10px"> 
            <form id='formAddLang' name='formAddLang' method='post' action='<?php echo base_url() . ADMIN_ACTION_ADDLANGUAGE; ?>' enctype="multipart/form-data">			
                <div class="col-md-6" >
                    <input class='form-control' name='langName' id='langName' placeholder='New Language'/></a>
                </div>                
                <div class="col-md-2" >
                    <button type="button" class ="btn btn-block btn-success" onclick='onAddLanguage()'>Add Language</button>
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
                foreach ($langs as $lang) {
                    $i++;
                    ?>
                    <tr>
                        <td><?php echo $i; ?></td>                        
                        <td><?php echo $lang->name; ?></td>
                        <td>
                            <a href='<?php echo base_url() . ADMIN_PAGE_EDITLANGUAGE . "/" . $lang->no; ?>'>Edit</a>&nbsp;&nbsp;&nbsp;
                            <a href='<?php echo base_url() . ADMIN_ACTION_DELETELANGUAGE . "/" . $lang->no; ?>'>Delete</a>&nbsp;&nbsp;&nbsp;
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
