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
			alert('Color is Empty');
			return;
		}
		formElement.submit();
	}
</script>
<div class="box">
    <div class="box-header">
        <h3 class="box-title">Size List</h3>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
		<div class="row" style="margin-bottom: 10px"> 
			<form id='formAddCategory' name='formAddCategory' method='post' action='index.php?c=Main&m=onAddSize' enctype="multipart/form-data">			
				<div class="col-md-3" >
					<input class='form-control' name='colorName' id='categoryName' placeholder='New Size'/></a>
				</div>				
				<div class="col-md-2" >
					<button type="button" class ="btn btn-block btn-success" onclick='onAddSubject()'>Add Size</button>
				</div>
			</form>
		</div>
        <table id="example1" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Size</th>
                    <th>Details</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $i = 0;
                foreach ($sizes as $size) {
                    $i++;
                    ?>
                    <tr>
                        <td><?php echo $i; ?></td>
                        <td><?php echo $size->name; ?></td>
                        <td>
                            <a href='index.php?c=main&m=deleteSize&id=<?php echo $color->no;?>'>Delete</a>&nbsp;&nbsp;&nbsp;
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