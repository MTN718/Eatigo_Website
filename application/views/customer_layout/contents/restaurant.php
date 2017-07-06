<script>
    function onSearch()
    {
        var formElement = document.getElementById("searchForm");
        var formData = new FormData(formElement);
        $.ajax({
            type: 'POST',
            data: formData,
            url: '<?php echo base_url() . "index.php/CustomerController/ajaxSearchRestaurant"; ?>',
            contentType: false,
            processData: false,
            success: function(data)
            {
                var json = $.parseJSON(data);
                appendRestaurantGrid(json);
            }
        });
        return false;
    }

    function appendRestaurantGrid(restaurant)
    {
        var gridContainer = document.getElementById("ias-vendor-list");
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
            aDiv.href = "<?php echo base_url(); ?>index.php/CustomerController/restaurantdetails/" + vendorUser.no;
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
            if (vendorUser.rs_image.length > 0)
            {
                img.src = "<?php echo base_url();?>/" + vendorUser.rs_image[0].image;
            }
            
            var divFav = vendorContent.createElement('div');
            divFav.className = "favourite-bg";
            divFav.style = "background: rgba(0, 0, 0, 0.6);color:'rgb(255,255,255)';font-size: 13px;bottom: 5px;right: 6px;padding: 5px 20px 0px 12px;";
            divFav.innerHTML = "<label style='color:#ffffff;font-weight: normal;font-size: 12px;height: 24px;'>" + vendorUser.countReservation + " reservations recently</label>";
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

            var divRestrotitle = vendorContent.createElement('div');
            divRestrotitle.className = "restro-title-box-left";
            divDetail.appendChild(divRestrotitle);

            var divCuisin = vendorContent.createElement('div');
            divCuisin.className = "box-detail-cuisine";
            divCuisin.innerHTML = vendorUser.address;
            divRestrotitle.appendChild(divCuisin);

            var divRestrotitle = vendorContent.createElement('div');
            divRestrotitle.className = "restro-title-box-right";
            divDetail.appendChild(divRestrotitle);

            var divGray = vendorContent.createElement('div');
            divGray.className = "box-detail-rating-gray";
            divRestrotitle.appendChild(divGray);

            var divRating = vendorContent.createElement('div');
            divRating.className = "box-detail-rating-yellow_b";
            if (vendorUser.avgrate >= 0 && vendorUser.avgrate < 0.5)
            {
                divRating.style = 'width:0%';
            }
            else if (vendorUser.avgrate >= 0.5 && vendorUser.avgrate < 1.5 )
            {
                divRating.style = 'width:20%';                
            }
            else if (vendorUser.avgrate >= 1.5 && vendorUser.avgrate < 2.5)
            {
                divRating.style = 'width:40%';                
            }
            else if (vendorUser.avgrate >= 2.5 && vendorUser.avgrate < 3.5)
            {
                divRating.style = 'width:60%';                
            }
            else if (vendorUser.avgrate >= 3.5 && vendorUser.avgrate < 4.5)
            {
                divRating.style = 'width:80%';                
            }
            else
            {
                divRating.style = 'width:100%';                
            }
            divGray.appendChild(divRating);

            var divGray = vendorContent.createElement('div');
            divGray.className = "box-price-gray";
            divRestrotitle.appendChild(divGray);

            var divRating = vendorContent.createElement('div');
            divRating.className = "box-detail-price-yellow_b";
            if (vendorUser.level == 0)
            {
                divRating.style = 'width:0%';
            }
            else if (vendorUser.level == 1)
            {
                divRating.style = 'width:20%';                
            }
            else if (vendorUser.level == 2)
            {
                divRating.style = 'width:40%';                
            }
            else if (vendorUser.level == 3)
            {
                divRating.style = 'width:60%';                
            }
            else if (vendorUser.level == 4)
            {
                divRating.style = 'width:80%';                
            }
            else
            {
                divRating.style = 'width:100%';                
            }
            divGray.appendChild(divRating);
            
            var divDevice = vendorContent.createElement('div');
            divDevice.className = "device";
            divFloat.appendChild(divDevice);
            
            var aLeft = vendorContent.createElement('a');
            aLeft.className = "arrow-left";
            aLeft.id = "arrow-left-2-8";
            aLeft.href = "javascript:doNothing();";
            
            divDevice.appendChild(aLeft);
            
            var aRight = vendorContent.createElement('a');
            aRight.className = "arrow-right";
            aRight.id = "arrow-right-2-8";
            aRight.href = "javascript:doNothing();";
            
            divDevice.appendChild(aRight);
            
            var divSwipe = vendorContent.createElement('div');
            divSwipe.className = "swiper-container";
            divSwipe.id = "timeslot-2-8";
            divDevice.appendChild(divSwipe);
            
            var divWrapper = vendorContent.createElement('div');
            divWrapper.className = "swiper-wrapper";
            
            if (vendorUser.rs_discounts.length == 0)
            {
                divWrapper.style='color:red;margin-top:24px;';
                divWrapper.innerHTML = "No Discount Offer";                    
            }
            else
            {
                for (var k = 0;k < vendorUser.rs_discounts.length;k++)
                {
                    var aSlide = vendorContent.createElement('a');
                    aSlide.className = "swiper-slide red-slide";
                    divWrapper.appendChild(aSlide);
                    
                    var divTime = vendorContent.createElement('div');
                    var divDiscount = vendorContent.createElement('div');
                    var divPercent = vendorContent.createElement('div');
                    var divOff = vendorContent.createElement('div');
                    
                    divTime.className = "home-slot-time normal-font font-weight-bold";
                    divDiscount.className = "home-slot-discount"; 
                    divPercent.className = "home-slot-discount-pc";
                    divOff.className = "home-slot-off";
                    
                    divTime.innerHTML = vendorUser.rs_discounts[k].rtime;
                    
                    var h1Ele = vendorContent.createElement('h1');
                    h1Ele.className = "font-weight-bold";
                    var spanEle = vendorContent.createElement('span');
                    spanEle.innerHTML = "-";
                    divDiscount.appendChild(h1Ele);
                    h1Ele.appendChild(spanEle);
                    h1Ele.innerHTML = h1Ele.innerHTML + vendorUser.rs_discounts[k].percent;                        
                    divPercent.innerHTML = '%';
                    divOff.innerHTML = 'Off';
                    
                    aSlide.appendChild(divTime);
                    aSlide.appendChild(divDiscount);
                    aSlide.appendChild(divPercent);
                    aSlide.appendChild(divOff);
                }
            }
            
            divSwipe.appendChild(divWrapper);
            
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
                    <form method="post" id="searchForm">
                        <div class="col-md-12 form-group">
                            <label class="control-label" for="capacity">Discount</label>
                            <select id="discount" name="discount" class="form-control">
                                <option value="">Select Discount</option>
                                <?php
                                if (isset($discount) and $discount != NULL) {
                                    foreach ($discount as $dis) {
                                        ?>
                                        <option value="<?php echo $dis->no; ?>"><?php echo $dis->percent; ?>%</option>
                                        <?php
                                    }
                                } else {
                                    echo "No Photos Now";
                                }
                                ?>
                            </select>
                        </div>
                        <div class="col-md-12 form-group rating">
                            <label class="control-label">Select Price Level </label>
                            <div class="checkbox checkbox-success">
                                <input type="checkbox" name="level[]" id="checkbox-0" value="1" class="styled">
                                <label for="checkbox-0" class="control-label"> <i class="fa fa-usd"></i> </label>
                            </div>
                            <div class="checkbox checkbox-success">
                                <input type="checkbox" name="level[]" id="checkbox-1" value="2" class="styled">
                                <label for="checkbox-1" class="control-label"> <i class="fa fa-usd"></i> <i class="fa fa-usd"></i> </label>
                            </div>
                            <div class="checkbox checkbox-success">
                                <input type="checkbox" name="level[]" id="checkbox-2" value="3" class="styled">
                                <label for="checkbox-2" class="control-label"> <i class="fa fa-usd"></i> <i class="fa fa-usd"></i><i class="fa fa-usd"></i> </label>
                            </div>
                            <div class="checkbox checkbox-success">
                                <input type="checkbox" name="level[]" id="checkbox-3" value="4" class="styled">
                                <label for="checkbox-3" class="control-label"> <i class="fa fa-usd"></i><i class="fa fa-usd"></i><i class="fa fa-usd"></i><i class="fa fa-usd"></i> </label>
                            </div>
                            <div class="checkbox checkbox-success">
                                <input type="checkbox" name="level[]" id="checkbox-4" value="5" class="styled">
                                <label for="checkbox-4" class="control-label"> <i class="fa fa-usd"></i><i class="fa fa-usd"></i><i class="fa fa-usd"></i><i class="fa fa-usd"></i><i class="fa fa-usd"></i> </label>
                            </div>
                        </div>
                        <div class="col-md-12 form-group rating">
                            <label class="control-label">Select Rating </label>
                            <div class="checkbox checkbox-success">
                                <input type="checkbox" name="rate[]" id="checkbox-01" value="1" class="styled">
                                <label for="checkbox-01" class="control-label"> <i class="fa fa-star"></i> </label>
                            </div>
                            <div class="checkbox checkbox-success">
                                <input type="checkbox" name="rate[]" id="checkbox-11" value="2" class="styled">
                                <label for="checkbox-11" class="control-label"> <i class="fa fa-star"></i> <i class="fa fa-star"></i> </label>
                            </div>
                            <div class="checkbox checkbox-success">
                                <input type="checkbox" name="rate[]" id="checkbox-21" value="3" class="styled">
                                <label for="checkbox-21" class="control-label"> <i class="fa fa-star"></i> <i class="fa fa-star"></i><i class="fa fa-star"></i> </label>
                            </div>
                            <div class="checkbox checkbox-success">
                                <input type="checkbox" name="rate[]" id="checkbox-31" value="4" class="styled">
                                <label for="checkbox-31" class="control-label"> <i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i> </label>
                            </div>
                            <div class="checkbox checkbox-success">
                                <input type="checkbox" name="rate[]" id="checkbox-41" value="5" class="styled">
                                <label for="checkbox-41" class="control-label"> <i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i> </label>
                            </div>
                        </div>
                        <div class="col-md-12 form-group">
                            <label class="control-label">Sub Categories</label>

                            <?php
                            if (isset($subcategories) and $subcategories != NULL) {
                                foreach ($subcategories as $subcategory) {
                                    $flag = "";
                                    if($subcategory->no == $subcategory_id) $flag = "checked";
                                    ?>

                                    <div class="checkbox checkbox-success">
                                        <input type="checkbox" name="subcategory[]" value="<?php echo $subcategory->no; ?>" class="styled" <?php echo $flag; ?> >
                                        <label class="control-label"><?php echo $subcategory->name; ?></label>
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
                        <button type="submit" class="btn tp-btn-primary tp-btn-lg btn-block findhover" style="background-color:#8E203E" onclick="onSearch()">Search Places</button>
                    </div>
                </div>
            </div>
            <div class="col-md-9">
                <div class="row" id="ias-vendor-list">
                    <?php
                    if (isset($restaurantlist) and $restaurantlist != NULL) {
                        foreach ($restaurantlist as $restaurant) {
                            $resto_image = $this->db->get_where('tbl_image_restaurant', array('rid' => $restaurant->no))->row();
                            $discount = $this->db->get_where('tbl_map_discount_restaurant', array('rid' => $restaurant->no, 'status' => 1))->result();
                            $reservations = $this->db->get_where('tbl_reservation', array('rid' => $restaurant->no))->num_rows();
                            ?>

                            <div class="col-md-4 vendor-box"><!-- venue box start--> 
                                <div class="mix Restaurants" title="Client Name">
                                    <a href="<?php echo base_url(); ?>index.php/CustomerController/restaurantdetails/<?php echo $restaurant->no; ?>">
                                        <div class="home-recom-wrap">
                                            <div class="vendor-image">
                                                <?php if (isset($resto_image) and $resto_image->image != NULL) { ?>
                                                <img  class="recom-box-img lazy" alt="" src="<?php echo base_url(); ?><?php echo $resto_image->image; ?>" alt="">
                                                <?php } else { ?> 
                                                <img class="recom-box-img lazy" alt="" src="http://placehold.it/300x250" />                         
                                                <?php } ?>
                                                <div class="favourite-bg" style="background: rgba(0, 0, 0, 0.6);font-size: 13px;bottom: 5px;right: 6px;padding: 5px 12px 5px 12px;">
                                                    <?php echo $reservations; ?> reservations recently
                                                </div>
                                            </div>

                                            <div class="float-left">
                                                <div class="box-detail">
                                                    <div class="box-detail-name">
                                                        <h2 class="font-weight-bold"><?php echo $restaurant->name; ?></h2>
                                                    </div>
                                                    <div class="restro-title-box-left">
                                                        <div class="box-detail-cuisine">
                                                            <?php echo $restaurant->address; ?>
                                                        </div>
                                                    </div>
                                                    <div class="restro-title-box-right">
                                                        <div class="box-detail-rating-gray">
                                                            <div class="box-detail-rating-yellow_b" style="width:
                                                            <?php
                                                            $review = $restaurant->avgrate;
                                                            if ($review == 0)
                                                                echo "0%";
                                                            if ($review == 1)
                                                                echo "20%";
                                                            if ($review == 2)
                                                                echo "40%";
                                                            if ($review == 3)
                                                                echo "60%";
                                                            if ($review == 4)
                                                                echo "80%";
                                                            if ($review == 5)
                                                                echo "100%";
                                                            ?> ;">                                          
                                                        </div>
                                                    </div>
                                                    <div class="box-price-gray">
                                                        <div class="box-detail-price-yellow_b" style="width:
                                                        <?php
                                                        $level = $restaurant->level;
                                                        if ($level == 0)
                                                            echo "0%";
                                                        if ($level == 1)
                                                            echo "20%";
                                                        if ($level == 2)
                                                            echo "40%";
                                                        if ($level == 3)
                                                            echo "60%";
                                                        if ($level == 4)
                                                            echo "80%";
                                                        if ($level == 5)
                                                            echo "100%";
                                                        ?> ;"> 
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="device">
                                            <a class="arrow-left" id="arrow-left-2-8" href="javascript:doNothing();"></a>
                                            <a class="arrow-right" id="arrow-right-2-8"href="javascript:doNothing();"></a>
                                            <div class="swiper-container" id="timeslot-2-8">
                                                <div class="swiper-wrapper" <?php if ($discount == NULL) echo "style='color:red;margin-top:24px;'" ?> >
                                                    <?php
                                                    if (isset($discount) and $discount != NULL) {
                                                        foreach ($discount as $disc) {
                                                            $disc_percent = $this->db->get_where('tbl_base_discount', array('no' => $disc->did))->row();
                                                            ?>
                                                            <a href="" class="swiper-slide red-slide">
                                                                <div class="home-slot-time normal-font font-weight-bold">
                                                                    <?php echo $disc->rtime; ?>
                                                                </div>
                                                                <div class="home-slot-discount">
                                                                    <h1 class="font-weight-bold">
                                                                        <span>-</span><?php echo $disc_percent->percent; ?></h1>
                                                                    </div>
                                                                    <div class="home-slot-discount-pc">
                                                                        %
                                                                    </div>
                                                                    <div class="home-slot-off">
                                                                        off
                                                                    </div>
                                                                </a>
                                                                <?php
                                                            }
                                                        } else {
                                                            echo "No Discount Offer";
                                                        }
                                                        ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <?php
                    }
                } else {
                    echo "No Restaurants";
                }
                ?>   

                <!-- venue details --> 
            </div>


        </div>
    </div>
</div>
</div>
</div>
