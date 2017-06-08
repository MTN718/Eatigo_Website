<script>
	function onCancelAdd()
	{
		location.href = "index.php?c=main&m=items";
	}
	function previewFile(i) {
		var preview = document.getElementById('itemImage' + i); //selects the query named img
		var file = document.getElementById('upload' + i).files[0]; //sames as here
		var reader = new FileReader();
		reader.onloadend = function() {
			//uploadImage1();
			preview.src = reader.result;
		}
		if (file) {
			reader.readAsDataURL(file); //reads the data as a URL
		} else {
			//preview.src = "";
		}
	}
	function onAddItem()
	{
		var nameElement = document.getElementById('itemName');
		var brandElement = document.getElementById('itemBrand');
		var priceElement = document.getElementById('itemPrice');
		var amountElement = document.getElementById('itemAmount');
		var phoneElement = document.getElementById('itemPhone');
		var mailElement = document.getElementById('itemEmail');
		var formAdd = document.getElementById('formAddItem');
		if (nameElement.value == '')
		{
			alert('Empty name');
			return;
		}
		else if (brandElement.value == '')
		{
			alert('Empty Brand');
			return;
		}
		else if (priceElement.value == '')
		{
			alert('Empty Price');
			return;
		}
		else if (amountElement.value == '')
		{
			alert('Empty Item Count');
			return;
		}
		else if (phoneElement.value == '')
		{
			alert('Empty Phone number');
			return;
		}
		else if (mailElement.value == '')
		{
			alert('Empty Email Address');
			return;
		}
		formAdd.submit();
	}
</script>
<div class="box">
    <div class="box-header">
        <h3 class="box-title">Edit Item</h3>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
		<form id='formAddItem' name='formAddItem' method='post' enctype="multipart/form-data" action='index.php?c=Main&m=onEditItem'>
			<div class="row">
				<div class="col-md-3" >
					<select class='form-control' id='itemCategory' name='itemCategory'>
						<?php
							foreach($category as $cItem)
							{								
								if ($cItem->no == $itemInfo->category)
									echo "<option value='".$cItem->no."' selected>".$cItem->category."</option>";
								else 
									echo "<option value='".$cItem->no."'>".$cItem->category."</option>";
							}
						?>
					</select>
				</div>
				<input class='form-control' name='itemNo' id='itemNo' type='hidden' value='<?php echo $itemInfo->no;?>'/></a>
				<div class="col-md-3" >
					<input class='form-control' name='itemName' id='itemName' placeholder='Item Name' value='<?php echo $itemInfo->name;?>'/></a>
				</div>
				<div class="col-md-2" >
					<input class='form-control' name='itemBrand' id='itemBrand' placeholder='Brand Name' value='<?php echo $itemInfo->brand;?>'/></a>
				</div>
				<div class="col-md-2" >
					<input class='form-control' name='itemPrice' id='itemPrice' type='number' value='<?php echo $itemInfo->price;?>' placeholder='Item Price in USD'/></a>
				</div>				
				<div class="col-md-2" >
					<input class='form-control' value='<?php echo $itemInfo->amount;?>' name='itemAmount' id='itemAmount' type='number' placeholder='Item Count'/></a>
				</div>
			</div>
			<div class="row" style='margin-top:10px;height:100px;' >
				<div class="col-md-12" >
					<textarea class='form-control' style='height:100%' name='itemDescription' placeholder='Item Description'><?php echo $itemInfo->description;?></textarea>
				</div>
			</div>
			<div class="row" style='margin-top:10px'>				
				<div class="col-md-4" >
					<input class='form-control' name='itemPhone' id='itemPhone' placeholder='Phone Number for Owner' value='<?php echo $itemInfo->phone;?>' /></a>
				</div>
				<div class="col-md-4" >
					<input class='form-control' name='itemEmail' id='itemEmail' placeholder='Email Address for Owner' value='<?php echo $itemInfo->email;?>' /></a>
				</div>				
				<div class="col-md-2" >
					<select class='form-control' name='featured'>
						<?php
							if ($itemInfo->feature == '0')
								echo "<option value='0' selected>None</option>";
							else
								echo "<option value='0'>None</option>";

							if ($itemInfo->feature == '1')
								echo "<option value='1' selected>Featured</option>";
							else
								echo "<option value='1'>Featured</option>";

							
						?>
					</select>
				</div>
			</div>
			<label style='margin-top:10px'>Colors</label>
			<div class="row" >				
				<?php
					foreach($colors as $color)
					{
						?>
						<div class="col-md-2" >
							<div class="checkbox">
							  <label>
							  <?php					
							  if (strpos( $itemInfo->color, $color->no.",") !== false)
								  echo "<input type='checkbox' name='itemColor".$color->no."' value='".$color->no."' checked>".$color->name;
							  else 
								  echo "<input type='checkbox' name='itemColor".$color->no."' value='".$color->no."'>".$color->name;

							  ?>								
							  </label>
							</div>							
						</div>
						<?php
					}
				?>				
			</div>
			<label style='margin-top:10px'>Sizes</label>
			<div class="row">				
				<?php
					foreach($sizes as $size)
					{
						?>
						<div class="col-md-2" >
							<div class="checkbox">
							  <label>
							  <?php
							 $k = 0;
							  for ($i = 0;$i < count($sizeInfo);$i++)
							  {

									if ($sizeInfo[$i]->sz == $size->no)
									{
										echo "<input type='checkbox' name='itemSize".$size->no."' value='".$size->no."' checked>".$size->name;
										$k++;										
									}									
							  }							  
							  if ($k == 0)
								echo "<input type='checkbox' name='itemSize".$size->no."' value='".$size->no."'>".$size->name;
							  ?>								
							  </label>
							</div>							
						</div>
						<?php
					}
				?>				
			</div>
			<?php
				$path1 = 'img/addphoto.png';
				if ($itemInfo->image1 != "") 
					$path1 = $itemInfo->image1;
				$path2 = 'img/addphoto.png';
				if ($itemInfo->image2 != "") 
					$path2 = $itemInfo->image2;
				$path3 = 'img/addphoto.png';
				if ($itemInfo->image3 != "") 
					$path3 = $itemInfo->image3;
				$path4 = 'img/addphoto.png';
				if ($itemInfo->image4 != "") 
					$path4 = $itemInfo->image4;
			?>
			<div class="row" style='margin-top:10px;height:200px;' >
				<div class="col-md-3" >
					<input type="file" accept="image/*" name="uploadLogo0" id="upload0" style="visibility: hidden; width: 1px; height: 1px" multiple onchange="previewFile(0)">					
					<img  id='itemImage0' name='itemImage0' onclick="document.getElementById('upload0').click();
						return false" style='height:100%;width:100%' src='<?php echo base_url().$path1;?>'/>
				</div>
				<div class="col-md-3" >
					<input type="file" accept="image/*" name="uploadLogo1" id="upload1" style="visibility: hidden; width: 1px; height: 1px" multiple onchange="previewFile(1)">
					<img  id='itemImage1' name='itemImage1' onclick="document.getElementById('upload1').click();
						return false" style='height:100%;width:100%' src='<?php echo base_url().$path2;?>'/>
				</div>
				<div class="col-md-3" >
					<input  type="file" accept="image/*" name="uploadLogo2" id="upload2" style="visibility: hidden; width: 1px; height: 1px" multiple onchange="previewFile(2)">
					<img id='itemImage2' name='itemImage2' onclick="document.getElementById('upload2').click();
						return false" style='height:100%;width:100%' src='<?php echo base_url().$path3;?>'/>
				</div>
				<div class="col-md-3" >
					<input type="file" accept="image/*" name="uploadLogo3" id="upload3" style="visibility: hidden; width: 1px; height: 1px" multiple onchange="previewFile(3)">
					<img  id='itemImage3' name='itemImage3' onclick="document.getElementById('upload3').click();
						return false" style='height:100%;width:100%' src='<?php echo base_url().$path4;?>'/>
				</div>
			</div>
			<div class="row" style='margin-top:10px'>				
				<div class="col-md-2" >
					<button type="button" class ="btn btn-block btn-primary" onclick='onAddItem()'>Update Item</button>
				</div>
				<div class="col-md-2" >
					<button type="button" class ="btn btn-block btn-danger" onclick='onCancelAdd()'>Cancel</button>
				</div>				
			</div>
		</form>
    </div>
    <!-- /.box-body -->
</div>