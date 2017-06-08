<script>
	function onAddSubject()
	{
		location.href = "index.php?c=main&m=addItem";
	}
</script>
<div class="box">
    <div class="box-header">
        <h3 class="box-title">Item List</h3>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
		<div class="row" style="margin-bottom: 10px"> 
			<div class="col-md-2" >
				<button type="button" class ="btn btn-block btn-success" onclick='onAddSubject()'>Add Item</button>
			</div>
		</div>
        <table id="example1" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>No</th>
					<th>Name</th>
                    <th>Category</th>
                    <th>Price</th>
					<th>Amount</th>
					<th>Featured</th>
					<th>Detail</th>
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
                        <td><?php echo $user->name; ?></td>
						<td><?php echo $user->cname; ?></td>
						<td><?php echo $user->price; ?></td>
						<td><?php echo $user->amount; ?></td>
						<td>
							<?php 
								if ($user->feature == 0) echo "None";
								else if ($user->feature == 1) echo "Featured";
							?>
						</td>
                        <td>
							<a href='index.php?c=main&m=editItem&id=<?php echo $user->no;?>'>Edit</a>&nbsp;&nbsp;&nbsp;
                            <a href='index.php?c=main&m=deleteItem&id=<?php echo $user->no;?>'>Delete</a>&nbsp;&nbsp;&nbsp;
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