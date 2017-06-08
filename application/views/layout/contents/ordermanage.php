<script>
	function onAddSubject()
	{
		var formElement = document.getElementById('formAddCategory');
		formElement.submit();
	}
</script>
<div class="box">
    <div class="box-header">
        <h3 class="box-title">Orders</h3>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
		<div class="row" style="margin-bottom: 10px"> 
			<form id='formAddCategory' name='formAddCategory' method='post' action='index.php?c=Main&m=onAddAdminEmail' enctype="multipart/form-data">			
				<input type="hidden" name='adminNo' value='<?php echo $admin->no;?>' />
				<div class="col-md-3" >
					<input class='form-control' name='emailAddress' id='categoryName' placeholder='Email Address' value='<?php echo $admin->email;?>'/>
				</div>				
				<div class="col-md-2" >
					<button type="button" class ="btn btn-block btn-success" onclick='onAddSubject()' >Update Email</button>
				</div>
			</form>
		</div>
        <table id="example1" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Name</th>
					<th>User</th>
					<th>Phone</th>
					<th>Location</th>
					<th>Item Infos</th>
                    <th>Price</th>                   
                    <th>Status</th>
					<th>Detail</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $i = 0;
                foreach ($orders as $order) {
                    $i++;
                    ?>
                    <tr>
                        <td><?php echo $i; ?></td>
                        <td><?php echo $order->name; ?></td>
						<td><?php echo $order->uname; ?></td>
						<td><?php echo $order->phone; ?></td>
						<td>
							<?php 
								if ($order->lat == "-1" && $order->lon == "-1")
									echo "Private"; 
								else echo "(".$order->lat." , ".$order->lon.")"; 
							?>
						</td>
						<td>
							<?php
								$itemInfo = $itemInfos[$i - 1];
								foreach($itemInfo as $item)
								{								
									echo $item->iname.":&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp".$item->sname."<br>";
								}				
							?>
						</td>
                        <td><?php echo $order->price."$"; ?></td>
						<!--
						<td>
							<?php
								if ($order->payment == 0)
									echo "Cash";
								else echo "Paid"; 
							?>
						</td>    						
						-->
						<td>
							<?php
								if ($order->status == 0) echo "Request";
								else if ($order->status == 1) echo "Transport"; 
								else if ($order->status == 2) echo "Delivered"; 
								else if ($order->status == 3) echo "Reviewed"; 
								else if ($order->status == 4) echo "Cancelled"; 
							?>
						</td>
                        <td>
							<?php
								if ($order->status == 0) echo "<a href='index.php?c=main&m=sendDelivery&id=".$order->no."'>Send Delivery</a>";
								else if ($order->status == 4) echo "Cancelled"; 
							?>
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