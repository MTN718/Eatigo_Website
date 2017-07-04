<script>
    function onSearch()
    {
        var formElement = document.getElementById("searchForm");
        var formData = new FormData(formElement);
        $.ajax({
            type: 'POST',
            data: formData,
            url: '<?php echo base_url() . "index.php/CustomerController/ajaxSearchSubCategory"; ?>',
            contentType: false,
            processData: false,
            success: function(data)
            {
                var json = $.parseJSON(data);
                appendSubCategory(json);
            }
        });
        return false;
    }

    function appendSubCategory(restaurant)
    {

        var gridContainer = document.getElementById("ias-category-list");
        gridContainer.innerHTML = "";
        if (restaurant.restaurants.length == 0)
            gridContainer.innerHTML = "No Search Result";
        for (i = 0; i < restaurant.restaurants.length; i++)
        {
            vendorUser = restaurant.restaurants[i];
            var vendorContent = document.implementation.createHTMLDocument("New Document");
            var containerDiv = vendorContent.createElement("div");
            var mixDiv = vendorContent.createElement("div");
            containerDiv.className = "col-md-4 vendor-box";
            gridContainer.appendChild(containerDiv);
            mixDiv.className = "mix Restaurants";
            mixDiv.title = "Client Name";
            containerDiv.appendChild(mixDiv);
            
            var aDiv = vendorContent.createElement("a");
            aDiv.href = "<?php echo base_url(); ?>index.php/CustomerController/restaurants/" + vendorUser.no;
            mixDiv.appendChild(aDiv);            
            
            var recomDiv = vendorContent.createElement("div");
            recomDiv.className = "home-recom-wrap";
            aDiv.appendChild(recomDiv);
            var vendorImageDiv = vendorContent.createElement("div");
            vendorImageDiv.className = "vendor-image";
            recomDiv.appendChild(vendorImageDiv);
            
            var img = vendorContent.createElement('img');
            img.className = "recom-box-img lazy";
            vendorImageDiv.appendChild(img);
            if (vendorUser.image.length > 0)
            {
                img.src = "<?php echo base_url();?>/" + vendorUser.image;
            }
            
            var divFav = vendorContent.createElement('div');
            divFav.className = "favourite-bg";
            divFav.style = "background: rgba(0, 0, 0, 0.6);color:'rgb(255,255,255)';font-size: 13px;bottom: 5px;right: 6px;padding: 5px 20px 5px 12px;";
            divFav.innerHTML = "<label style='margin-top:5px;color:#ffffff;'>" + vendorUser.countRestaurant + " Restaurants</label>";
            vendorImageDiv.appendChild(divFav);
            
            var divFloat = vendorContent.createElement('div');
            divFloat.className = "float-left";
            recomDiv.appendChild(divFloat);
            
                var divDetail = vendorContent.createElement('div');
                divDetail.className = "box-detail";
                divFloat.appendChild(divDetail);

                var divDetailName = vendorContent.createElement('div');
                divDetailName.className = "box-detail-name";
                divDetail.appendChild(divDetailName);

                var h2Element = vendorContent.createElement("h2");
                h2Element.className = "font-weight-bold";
                h2Element.innerHTML = vendorUser.name;

                divDetailName.appendChild(h2Element);             
        }
    }


</script>

<!-- /.page header -->
<div class="main-container">
    <div class="container">        
        <div class="row">
            <div class="col-md-3">
                <div class="filter-sidebar">
                    <div class="col-md-12 form-title">
                        <h2>Filter</h2>
                    </div>
                    <!-- <?php echo base_url(); ?>index.php/CustomerController/refine_restaurants/<?php if (isset($category_id) and $category_id != NULL) echo $category_id; ?> -->
                    <form method="post" id="searchForm">
                        <div class="col-md-12 form-group">
                            <label class="control-label">Categories</label>

                            <?php
                            if (isset($categories) and $categories != NULL) {
                                foreach ($categories as $category) {
                                    ?>

                                    <div class="checkbox checkbox-success">
                                        <input type="checkbox" name="category[]" value="<?php echo $category->no; ?>" class="styled">
                                        <label class="control-label"><?php echo $category->name; ?></label>
                                    </div>

                                    <?php
                                }
                            } else {
                                echo "No Category Now";
                            }
                            ?>

                        </div>                        
                    </form>
                    <div class="col-md-12 form-group">
                        <button type="submit" class="btn tp-btn-primary tp-btn-lg btn-block findhover" style="background-color:#8E203E" onclick="onSearch()">Search Restaurant</button>
                    </div>
                </div>
            </div>
            <div class="col-md-9">
                <div class="row" id="ias-category-list">

                <?php if(isset($subcategorylist) and $subcategorylist != NULL) {

                foreach ($subcategorylist as $subcategory) { ?>




                            <div class="col-md-4 vendor-box"><!-- venue box start--> 
                                <div class="mix Restaurants" title="Client Name">
                                    <a href="<?php echo base_url(); ?>index.php/CustomerController/restaurants/<?php echo $subcategory->no; ?>">
                                        <div class="home-recom-wrap">
                                            <div class="vendor-image">
                                                <?php if (isset($subcategory) and $subcategory->image != NULL) { ?>
                                                    <img  class="recom-box-img lazy" alt="" src="<?php echo base_url(); ?><?php echo $subcategory->image; ?>" alt="">
                                                <?php } else { ?> 
                                                    <img class="recom-box-img lazy" alt="" src="http://placehold.it/300x250" />                         
                                                <?php } ?>
                                                <div class="favourite-bg" style="background: rgba(0, 0, 0, 0.6);font-size: 13px;bottom: 5px;right: 6px;padding: 5px 12px 5px 12px;">
                                                    1 Restaurant
                                                </div>
                                            </div>

                                            <div class="float-left">
                                                <div class="box-detail">
                                                    <div class="box-detail-name">
                                                        <h2 class="font-weight-bold"><?php echo $subcategory->name; ?></h2>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>





                <?php }
                } else {
                    echo "No Available";
                }?>
                </div>
            </div>
        </div>
    </div>
</div>
