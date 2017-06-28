<script>
    function changeCategory()
    {
        var value = $("#category").val();
        $.ajax({
            type: 'POST',
            data: {cid: value},
            url: '<?php echo base_url() . "index.php/AdminController/ajaxLoadSubCategory"; ?>',
            success: function(data)
            {
                var json = $.parseJSON(data);
                addChild(json);
            }
        });
    }
    function addChild(json)
    {
        $("#subcategory").empty();
        $("#subcategory").append("<option value='0'>All</option>");
        for (var i = 0; i < json.subCategory.length; i++)
        {
            $("#subcategory").append("<option value='" + json.subCategory[i].no + "'>" + json.subCategory[i].name + "</option>");
        }
        filter();
    }
    function filter()
    {
        var catValue = $("#category").val();
        var subValue = $("#subcategory").val();
        $.ajax({
            type: 'POST',
            data: {cid: catValue, sid: subValue},
            url: '<?php echo base_url() . "index.php/AdminController/ajaxFilterRestaurant"; ?>',
            success: function(data)
            {
                var json = $.parseJSON(data);
                addRestaurant(json);
            }
        });
    }
    function addRestaurant(json)
    {
        $("#tableBody").empty();
        for (var i = 0; i < json.restaurants.length; i++)
        {
            var rtInfo = json.restaurants[i];
            var featured = "Featured";
            if (rtInfo.feature == 0)
                featured = "None";
            var featureButton = "<?php echo "<a href='" . base_url() . ADMIN_ACTION_RESTAURANT_FEATURE . "/"?>" + rtInfo.no + "'>Set Non-Feature</a>&nbsp;&nbsp;&nbsp";
            var deleteButton = "<?php echo "<a href='" . base_url() . ADMIN_ACTION_RESTAURANT_DELETE . "/"?>" + rtInfo.no + "'>Delete</a>&nbsp;&nbsp;&nbsp";
     
            if (rtInfo.feature != 0)
                featureButton = "<?php echo "<a href='" . base_url() . ADMIN_ACTION_RESTAURANT_FEATURE . "/"?>" + rtInfo.no + "'>Set Non-Feature</a>&nbsp;&nbsp;&nbsp";
            $("#tableBody").append(
                    "<tr>\n\
                        <td>" + (i+1) + "</td>\n\
                        <td>" + rtInfo.name + "</td>\n\
                        <td>" + rtInfo.cname + "</td>\n\
                        <td>" + rtInfo.sname + "</td>\n\
                        <td>" + rtInfo.address + "</td>\n\
                        <td>" + rtInfo.countReservation + "</td>\n\
                        <td>" + featured + "</td>\n\
                        <td>" + featureButton + deleteButton +  "</td></tr>");
        }
        filter();
    }
</script>
<div class="box">
    <div class="box-header">
        <h3 class="box-title">Restaurants</h3>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
        <div class="row" style="margin-bottom: 10px"> 
            <form id='formAddCity' name='formAddCity' method='post' action='<?php echo base_url() . ADMIN_ACTION_ADDCITY; ?>' enctype="multipart/form-data">			                      
                <div class="col-md-3" >
                    <select class='form-control' id='category' name='category' onchange="changeCategory()">
                        <option value='0'>All</option>
                        <?php
                        foreach ($categorys as $category) {
                            echo "<option value='" . $category->no . "'>" . $category->name . "</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="col-md-3" >
                    <select class='form-control' id='subcategory' name='subcategory'>
                        <option value='0'>All</option>
                    </select>
                </div>                
            </form>
        </div>
        <div class="box-body">
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Name</th>
                        <th>Category</th>
                        <th>Sub Category</th>
                        <th>Address</th>                                           
                        <th>Reservations</th>    
                        <th>Promote</th>                    
                        <th>Details</th>
                    </tr>
                </thead>
                <tbody id="tableBody">
                    <?php
                    $i = 0;
                    foreach ($restaurants as $restaurant) {
                        $i++;
                        ?>
                        <tr>
                            <td><?php echo $i; ?></td>
                            <td><?php echo $restaurant->name; ?></td>
                            <td><?php echo $restaurant->cname; ?></td>
                            <td><?php echo $restaurant->sname; ?></td>
                            <td><?php echo $restaurant->address; ?></td>                            
                            <td><?php echo $restaurant->countReserve; ?></td>
                            <td>
                                <?php
                                if ($restaurant->feature == 0)
                                    echo "None";
                                else
                                    echo "Featured";
                                ?>
                            </td>                        
                            <td>
                                <?php
                                if ($restaurant->feature == 0) {
                                    echo "<a href='" . base_url() . ADMIN_ACTION_RESTAURANT_FEATURE . "/" . $restaurant->no . "'>Set Feature</a>&nbsp;&nbsp;&nbsp;";
                                } else {
                                    echo "<a href='" . base_url() . ADMIN_ACTION_RESTAURANT_FEATURE . "/" . $restaurant->no . "'>Set Non-Feature</a>&nbsp;&nbsp;&nbsp;";
                                }
                                ?>
                                <a href='<?php echo base_url() . ADMIN_ACTION_RESTAURANT_DELETE . "/" . $restaurant->no; ?>'>Delete</a>&nbsp;&nbsp;&nbsp;
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