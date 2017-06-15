    <!-- /.page header -->
    <div class="main-container">
      <div class="container">
        <div class="row">
          <div class="col-md-8 tp-title">
          </div>
          <div class="col-md-4 text-right" style="padding-right: 23px;">
            <div class="btn-group"> <a href="<?php echo base_url();?>index.php/CustomerController/restaurantlist" id="list" class="btn list-btn btn-sm" style="color:#706a68"><span class="fa fa-th-list"> </span> </a> <a href="#" id="grid" class="btn  grid-btn active  btn-sm"><span class="fa fa-th"></span> </a> </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-3">
            <div class="filter-sidebar">
              <div class="col-md-12 form-title">
                <h2>Refine Your Search</h2>
              </div>
              <form>
                <div class="col-md-12 form-group">
                  <label class="control-label" for="venuetype">Venue Type</label>
                  <select id="venuetype" name="venuetype" class="form-control">
                    <option value="">Select Venue</option>
                    <option value="Barn">Barn</option>
                    <option value="Boutique">Boutique</option>
                    <option value="Castle">Castle</option>
                    <option value="Country House">Country House</option>
                    <option value="Exclusive use">Exclusive use</option>
                    <option value="Garden weddings">Garden weddings</option>
                    <option value="Gay friendly">Gay friendly</option>
                    <option value="Gothic">Gothic</option>
                    <option value="Hotel">Hotel</option>
                    <option value="Intimate">Intimate</option>
                    <option value="Manor House">Manor House</option>
                    <option value="Marquee">Marquee</option>
                    <option value="Minimalist">Minimalist</option>
                    <option value="Modern">Modern</option>
                    <option value="Outside Weddings">Outside Weddings</option>
                    <option value="Palace">Palace</option>
                    <option value="Private School">Private School</option>
                    <option value="Romantic">Romantic</option>
                    <option value="Small">Small</option>
                    <option value="Waterside">Waterside</option>
                    <option value="Weekend">Weekend</option>
                  </select>
                </div>
                <div class="col-md-12 form-group">
                  <label class="control-label" for="capacity">Discount</label>
                  <select id="capacity" name="capacity" class="form-control">
                    <option value="">Select Discount</option>
                    <option value="0 - 99">10%</option>
                    <option value="0 - 99">20%</option>
                    <option value="0 - 99">30%</option>
                    <option value="0 - 99">40%</option>
                    <option value="0 - 99">50%</option>
                  </select>
                </div>
                <div class="col-md-12 form-group">
                  <label class="control-label" for="price">Price</label>
                  <select id="price" name="price" class="form-control">
                    <option value=""> Select Price</option>
                    <option value="$35 - $50">$35 - $50</option>
                    <option value="$50 - $60">$50 - $60</option>
                    <option value="$60 - $70">$60 - $70</option>
                    <option value="$70 - $80">$70 - $80</option>
                    <option value="$80 - $90">$80 - $90</option>
                  </select>
                </div>
                <div class="col-md-12 form-group rating">
                  <label class="control-label">Select Rating </label>
                  <div class="checkbox checkbox-success">
                    <input type="checkbox" name="checkbox" id="checkbox-0" value="1" class="styled">
                    <label for="checkbox-0" class="control-label"> <i class="fa fa-star"></i> </label>
                  </div>
                  <div class="checkbox checkbox-success">
                    <input type="checkbox" name="checkbox" id="checkbox-1" value="2" class="styled">
                    <label for="checkbox-1" class="control-label"> <i class="fa fa-star"></i> <i class="fa fa-star"></i> </label>
                  </div>
                  <div class="checkbox checkbox-success">
                    <input type="checkbox" name="checkbox" id="checkbox-2" value="3" class="styled">
                    <label for="checkbox-2" class="control-label"> <i class="fa fa-star"></i> <i class="fa fa-star"></i><i class="fa fa-star"></i> </label>
                  </div>
                  <div class="checkbox checkbox-success">
                    <input type="checkbox" name="checkbox" id="checkbox-3" value="4" class="styled">
                    <label for="checkbox-3" class="control-label"> <i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i> </label>
                  </div>
                  <div class="checkbox checkbox-success">
                    <input type="checkbox" name="checkbox" id="checkbox-4" value="5" class="styled">
                    <label for="checkbox-4" class="control-label"> <i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i> </label>
                  </div>
                </div>
                <div class="col-md-12 form-group">
                  <label class="control-label">Categories</label>
                  <div class="checkbox checkbox-success">
                    <input type="checkbox" name="checkbox" id="weddinghall" value="Wedding Hall" class="styled">
                    <label for="weddinghall" class="control-label"> Wedding Hall </label>
                  </div>
                  <div class="checkbox checkbox-success">
                    <input type="checkbox" name="checkbox" id="dining" value="Dining" class="styled">
                    <label for="dining" class="control-label"> Dining </label>
                  </div>
                  <div class="checkbox checkbox-success">
                    <input type="checkbox" name="checkbox" id="insurance" value="Liability Insurance" class="styled">
                    <label for="insurance" class="control-label"> Liability Insurance </label>
                  </div>
                  <div class="checkbox checkbox-success">
                    <input type="checkbox" name="checkbox" id="catering" value="In House Catering" class="styled">
                    <label for="catering" class="control-label"> In House Catering </label>
                  </div>
                  <div class="checkbox checkbox-success">
                    <input type="checkbox" name="checkbox" id="djfacilities" value="5" class="styled">
                    <label for="djfacilities" class="control-label"> DJ Facilities </label>
                  </div>
                  <div class="checkbox checkbox-success">
                    <input type="checkbox" name="checkbox" id="dancefloor" value="Dance Foor" class="styled">
                    <label for="dancefloor" class="control-label"> Dance Foor </label>
                  </div>
                </div>
                <div class="col-md-12 form-group">
                  <button type="submit" class="btn tp-btn-primary tp-btn-lg btn-block findhover" style="background-color:#8E203E">Refine Your Search</button>
                </div>
              </form>
            </div>
          </div>
          <div class="col-md-9">
            <div class="row">





             <div class="col-md-4 vendor-box"><!-- venue box start-->

               <a href="<?php echo base_url();?>index.php/CustomerController/restaurantdetails">    

                 <div class="home-recom-wrap">

                  <div class="vendor-image">

                    <a href="<?php echo base_url();?>index.php/CustomerController/restaurantdetails"><img class="recom-box-img lazy" alt="" src="<?php echo base_url();?>images/pica.jpg" /></a>

                    <div class="favourite-bg" style="background: rgba(0, 0, 0, 0.6);font-size: 13px;bottom: 5px;right: 6px;padding: 5px 12px 5px 12px;">
                     <a href="#" class="">310 reservations recently</a>
                   </div>

                 </div>


                 <div class="float-left">
                  <div class="box-detail">
                    <div class="box-detail-name">
                      <a href="restaurant/name/ten-yuu-grand-sathon/indexa672.html?date=2017-06-06&amp;time=15.30&amp;source=eatigo_recommended">
                        <h2 class="font-weight-bold">Ten Yuu Grand @ Sathon Soi 6</h2></a>
                      </div>
                      <div class="restro-title-box-left">
                        <div class="box-detail-cuisine normal-font">
                          japanese
                        </div>
                        <div class="box-detail-cuisine normal-font">
                          sathon
                        </div>
                      </div>
                      <div class="restro-title-box-right">
                        <div class="box-detail-rating-gray">
                          <div class="box-detail-rating-yellow_b"
                          style="width:92%;"></div>
                        </div>
                        <div class="box-price-gray">
                          <div class="box-detail-price-yellow_b"
                          style="width:100%;"></div>
                        </div>
                      </div>
                    </div>
                    <div class="device">
                      <a class="arrow-left" id="arrow-left-2-8" href="javascript:doNothing();"></a>
                      <a class="arrow-right" id="arrow-right-2-8"
                      href="javascript:doNothing();"></a>
                      <div class="swiper-container" id="timeslot-2-8">
                        <div class="swiper-wrapper">
                          <script>
                            var pp = 0;
                          </script>

                          <a href="restaurant/name/ten-yuu-grand-sathon/indexa796.html?date=2017-06-06&amp;time=17.30"
                          class="swiper-slide red-slide">
                          <div class="home-slot-time normal-font font-weight-bold">
                            17:30
                          </div>
                          <div class="home-slot-discount">
                            <h1 class="font-weight-bold">
                              <span>-</span>10</h1>
                            </div>
                            <div class="home-slot-discount-pc">
                              %
                            </div>
                            <div class="home-slot-off">
                              off
                            </div>
                          </a>

                          <a href="restaurant/name/ten-yuu-grand-sathon/index588b.html?date=2017-06-06&amp;time=19.00"
                          class="swiper-slide red-slide">
                          <div class="home-slot-time normal-font font-weight-bold">
                            19:00
                          </div>
                          <div class="home-slot-discount">
                            <h1 class="font-weight-bold">
                              <span>-</span>10</h1>
                            </div>
                            <div class="home-slot-discount-pc">
                              %
                            </div>
                            <div class="home-slot-off">
                              off
                            </div>
                          </a>
                          <a href="restaurant/name/ten-yuu-grand-sathon/indexc3e9.html?date=2017-06-06&amp;time=19.30"
                          class="swiper-slide red-slide">
                          <div class="home-slot-time normal-font font-weight-bold">
                            19:30
                          </div>
                          <div class="home-slot-discount">
                            <h1 class="font-weight-bold">
                              <span>-</span>10</h1>
                            </div>
                            <div class="home-slot-discount-pc">
                              %
                            </div>
                            <div class="home-slot-off">
                              off
                            </div>
                          </a>

                        </div>
                      </div>
                    </div>
                  </div>
                </a> 
                <script>
                  var k = '8';
                  swipper(k, pp, '2');
                </script>
              </div>

              <!-- venue details --> 
            </div>
            <!-- /.venue box start-->
            <div class="col-md-4 vendor-box"><!-- venue box start-->

             <a href="<?php echo base_url();?>index.php/CustomerController/restaurantdetails">    

               <div class="home-recom-wrap">

                <div class="vendor-image">

                  <a href="#"><img class="recom-box-img lazy" alt="" src="<?php echo base_url();?>images/pica.jpg" /></a>

                  <div class="favourite-bg" style="background: rgba(0, 0, 0, 0.6);font-size: 13px;bottom: 5px;right: 6px;padding: 5px 12px 5px 12px;">
                   <a href="#" class="">310 reservations recently</a>
                 </div>

               </div>


               <div class="float-left">
                <div class="box-detail">
                  <div class="box-detail-name">
                    <a href="restaurant/name/ten-yuu-grand-sathon/indexa672.html?date=2017-06-06&amp;time=15.30&amp;source=eatigo_recommended">
                      <h2 class="font-weight-bold">Ten Yuu Grand @ Sathon Soi 6</h2></a>
                    </div>
                    <div class="restro-title-box-left">
                      <div class="box-detail-cuisine normal-font">
                        japanese
                      </div>
                      <div class="box-detail-cuisine normal-font">
                        sathon
                      </div>
                    </div>
                    <div class="restro-title-box-right">
                      <div class="box-detail-rating-gray">
                        <div class="box-detail-rating-yellow_b"
                        style="width:92%;"></div>
                      </div>
                      <div class="box-price-gray">
                        <div class="box-detail-price-yellow_b"
                        style="width:100%;"></div>
                      </div>
                    </div>
                  </div>
                  <div class="device">
                    <a class="arrow-left" id="arrow-left-2-8" href="javascript:doNothing();"></a>
                    <a class="arrow-right" id="arrow-right-2-8"
                    href="javascript:doNothing();"></a>
                    <div class="swiper-container" id="timeslot-2-8">
                      <div class="swiper-wrapper">
                        <script>
                          var pp = 0;
                        </script>

                        <a href="restaurant/name/ten-yuu-grand-sathon/indexa796.html?date=2017-06-06&amp;time=17.30"
                        class="swiper-slide red-slide">
                        <div class="home-slot-time normal-font font-weight-bold">
                          17:30
                        </div>
                        <div class="home-slot-discount">
                          <h1 class="font-weight-bold">
                            <span>-</span>10</h1>
                          </div>
                          <div class="home-slot-discount-pc">
                            %
                          </div>
                          <div class="home-slot-off">
                            off
                          </div>
                        </a>

                        <a href="restaurant/name/ten-yuu-grand-sathon/index588b.html?date=2017-06-06&amp;time=19.00"
                        class="swiper-slide red-slide">
                        <div class="home-slot-time normal-font font-weight-bold">
                          19:00
                        </div>
                        <div class="home-slot-discount">
                          <h1 class="font-weight-bold">
                            <span>-</span>10</h1>
                          </div>
                          <div class="home-slot-discount-pc">
                            %
                          </div>
                          <div class="home-slot-off">
                            off
                          </div>
                        </a>
                        <a href="restaurant/name/ten-yuu-grand-sathon/indexc3e9.html?date=2017-06-06&amp;time=19.30"
                        class="swiper-slide red-slide">
                        <div class="home-slot-time normal-font font-weight-bold">
                          19:30
                        </div>
                        <div class="home-slot-discount">
                          <h1 class="font-weight-bold">
                            <span>-</span>10</h1>
                          </div>
                          <div class="home-slot-discount-pc">
                            %
                          </div>
                          <div class="home-slot-off">
                            off
                          </div>
                        </a>

                      </div>
                    </div>
                  </div>
                </div>
              </a> 
              <script>
                var k = '8';
                swipper(k, pp, '2');
              </script>
            </div>

            <!-- venue details --> 
          </div>
          <!-- /.venue box start-->
          <div class="col-md-4 vendor-box"><!-- venue box start-->

           <a href="<?php echo base_url();?>index.php/CustomerController/restaurantdetails">    

             <div class="home-recom-wrap">

              <div class="vendor-image">

                <a href="#"><img class="recom-box-img lazy" alt="" src="<?php echo base_url();?>images/pica.jpg" /></a>

                <div class="favourite-bg" style="background: rgba(0, 0, 0, 0.6);font-size: 13px;bottom: 5px;right: 6px;padding: 5px 12px 5px 12px;">
                 <a href="#" class="">310 reservations recently</a>
               </div>

             </div>


             <div class="float-left">
              <div class="box-detail">
                <div class="box-detail-name">
                  <a href="restaurant/name/ten-yuu-grand-sathon/indexa672.html?date=2017-06-06&amp;time=15.30&amp;source=eatigo_recommended">
                    <h2 class="font-weight-bold">Ten Yuu Grand @ Sathon Soi 6</h2></a>
                  </div>
                  <div class="restro-title-box-left">
                    <div class="box-detail-cuisine normal-font">
                      japanese
                    </div>
                    <div class="box-detail-cuisine normal-font">
                      sathon
                    </div>
                  </div>
                  <div class="restro-title-box-right">
                    <div class="box-detail-rating-gray">
                      <div class="box-detail-rating-yellow_b"
                      style="width:92%;"></div>
                    </div>
                    <div class="box-price-gray">
                      <div class="box-detail-price-yellow_b"
                      style="width:100%;"></div>
                    </div>
                  </div>
                </div>
                <div class="device">
                  <a class="arrow-left" id="arrow-left-2-8" href="javascript:doNothing();"></a>
                  <a class="arrow-right" id="arrow-right-2-8"
                  href="javascript:doNothing();"></a>
                  <div class="swiper-container" id="timeslot-2-8">
                    <div class="swiper-wrapper">
                      <script>
                        var pp = 0;
                      </script>

                      <a href="restaurant/name/ten-yuu-grand-sathon/indexa796.html?date=2017-06-06&amp;time=17.30"
                      class="swiper-slide red-slide">
                      <div class="home-slot-time normal-font font-weight-bold">
                        17:30
                      </div>
                      <div class="home-slot-discount">
                        <h1 class="font-weight-bold">
                          <span>-</span>10</h1>
                        </div>
                        <div class="home-slot-discount-pc">
                          %
                        </div>
                        <div class="home-slot-off">
                          off
                        </div>
                      </a>

                      <a href="restaurant/name/ten-yuu-grand-sathon/index588b.html?date=2017-06-06&amp;time=19.00"
                      class="swiper-slide red-slide">
                      <div class="home-slot-time normal-font font-weight-bold">
                        19:00
                      </div>
                      <div class="home-slot-discount">
                        <h1 class="font-weight-bold">
                          <span>-</span>10</h1>
                        </div>
                        <div class="home-slot-discount-pc">
                          %
                        </div>
                        <div class="home-slot-off">
                          off
                        </div>
                      </a>
                      <a href="restaurant/name/ten-yuu-grand-sathon/indexc3e9.html?date=2017-06-06&amp;time=19.30"
                      class="swiper-slide red-slide">
                      <div class="home-slot-time normal-font font-weight-bold">
                        19:30
                      </div>
                      <div class="home-slot-discount">
                        <h1 class="font-weight-bold">
                          <span>-</span>10</h1>
                        </div>
                        <div class="home-slot-discount-pc">
                          %
                        </div>
                        <div class="home-slot-off">
                          off
                        </div>
                      </a>

                    </div>
                  </div>
                </div>
              </div>
            </a> 
            <script>
              var k = '8';
              swipper(k, pp, '2');
            </script>
          </div>

          <!-- venue details --> 
        </div>
        <div class="col-md-4 vendor-box"><!-- venue box start-->

         <a href="<?php echo base_url();?>index.php/CustomerController/restaurantdetails">    

           <div class="home-recom-wrap">

            <div class="vendor-image">

              <a href="#"><img class="recom-box-img lazy" alt="" src="<?php echo base_url();?>images/pica.jpg" /></a>

              <div class="favourite-bg" style="background: rgba(0, 0, 0, 0.6);font-size: 13px;bottom: 5px;right: 6px;padding: 5px 12px 5px 12px;">
               <a href="#" class="">310 reservations recently</a>
             </div>

           </div>


           <div class="float-left">
            <div class="box-detail">
              <div class="box-detail-name">
                <a href="restaurant/name/ten-yuu-grand-sathon/indexa672.html?date=2017-06-06&amp;time=15.30&amp;source=eatigo_recommended">
                  <h2 class="font-weight-bold">Ten Yuu Grand @ Sathon Soi 6</h2></a>
                </div>
                <div class="restro-title-box-left">
                  <div class="box-detail-cuisine normal-font">
                    japanese
                  </div>
                  <div class="box-detail-cuisine normal-font">
                    sathon
                  </div>
                </div>
                <div class="restro-title-box-right">
                  <div class="box-detail-rating-gray">
                    <div class="box-detail-rating-yellow_b"
                    style="width:92%;"></div>
                  </div>
                  <div class="box-price-gray">
                    <div class="box-detail-price-yellow_b"
                    style="width:100%;"></div>
                  </div>
                </div>
              </div>
              <div class="device">
                <a class="arrow-left" id="arrow-left-2-8" href="javascript:doNothing();"></a>
                <a class="arrow-right" id="arrow-right-2-8"
                href="javascript:doNothing();"></a>
                <div class="swiper-container" id="timeslot-2-8">
                  <div class="swiper-wrapper">
                    <script>
                      var pp = 0;
                    </script>

                    <a href="restaurant/name/ten-yuu-grand-sathon/indexa796.html?date=2017-06-06&amp;time=17.30"
                    class="swiper-slide red-slide">
                    <div class="home-slot-time normal-font font-weight-bold">
                      17:30
                    </div>
                    <div class="home-slot-discount">
                      <h1 class="font-weight-bold">
                        <span>-</span>10</h1>
                      </div>
                      <div class="home-slot-discount-pc">
                        %
                      </div>
                      <div class="home-slot-off">
                        off
                      </div>
                    </a>

                    <a href="restaurant/name/ten-yuu-grand-sathon/index588b.html?date=2017-06-06&amp;time=19.00"
                    class="swiper-slide red-slide">
                    <div class="home-slot-time normal-font font-weight-bold">
                      19:00
                    </div>
                    <div class="home-slot-discount">
                      <h1 class="font-weight-bold">
                        <span>-</span>10</h1>
                      </div>
                      <div class="home-slot-discount-pc">
                        %
                      </div>
                      <div class="home-slot-off">
                        off
                      </div>
                    </a>
                    <a href="restaurant/name/ten-yuu-grand-sathon/indexc3e9.html?date=2017-06-06&amp;time=19.30"
                    class="swiper-slide red-slide">
                    <div class="home-slot-time normal-font font-weight-bold">
                      19:30
                    </div>
                    <div class="home-slot-discount">
                      <h1 class="font-weight-bold">
                        <span>-</span>10</h1>
                      </div>
                      <div class="home-slot-discount-pc">
                        %
                      </div>
                      <div class="home-slot-off">
                        off
                      </div>
                    </a>

                  </div>
                </div>
              </div>
            </div>
          </a> 
          <script>
            var k = '8';
            swipper(k, pp, '2');
          </script>
        </div>

        <!-- venue details --> 
      </div>
      <div class="col-md-4 vendor-box"><!-- venue box start-->

       <a href="<?php echo base_url();?>index.php/CustomerController/restaurantdetails">    

         <div class="home-recom-wrap">

          <div class="vendor-image">

            <a href="#"><img class="recom-box-img lazy" alt="" src="<?php echo base_url();?>images/pica.jpg" /></a>

            <div class="favourite-bg" style="background: rgba(0, 0, 0, 0.6);font-size: 13px;bottom: 5px;right: 6px;padding: 5px 12px 5px 12px;">
             <a href="#" class="">310 reservations recently</a>
           </div>

         </div>


         <div class="float-left">
          <div class="box-detail">
            <div class="box-detail-name">
              <a href="restaurant/name/ten-yuu-grand-sathon/indexa672.html?date=2017-06-06&amp;time=15.30&amp;source=eatigo_recommended">
                <h2 class="font-weight-bold">Ten Yuu Grand @ Sathon Soi 6</h2></a>
              </div>
              <div class="restro-title-box-left">
                <div class="box-detail-cuisine normal-font">
                  japanese
                </div>
                <div class="box-detail-cuisine normal-font">
                  sathon
                </div>
              </div>
              <div class="restro-title-box-right">
                <div class="box-detail-rating-gray">
                  <div class="box-detail-rating-yellow_b"
                  style="width:92%;"></div>
                </div>
                <div class="box-price-gray">
                  <div class="box-detail-price-yellow_b"
                  style="width:100%;"></div>
                </div>
              </div>
            </div>
            <div class="device">
              <a class="arrow-left" id="arrow-left-2-8" href="javascript:doNothing();"></a>
              <a class="arrow-right" id="arrow-right-2-8"
              href="javascript:doNothing();"></a>
              <div class="swiper-container" id="timeslot-2-8">
                <div class="swiper-wrapper">
                  <script>
                    var pp = 0;
                  </script>

                  <a href="restaurant/name/ten-yuu-grand-sathon/indexa796.html?date=2017-06-06&amp;time=17.30"
                  class="swiper-slide red-slide">
                  <div class="home-slot-time normal-font font-weight-bold">
                    17:30
                  </div>
                  <div class="home-slot-discount">
                    <h1 class="font-weight-bold">
                      <span>-</span>10</h1>
                    </div>
                    <div class="home-slot-discount-pc">
                      %
                    </div>
                    <div class="home-slot-off">
                      off
                    </div>
                  </a>

                  <a href="restaurant/name/ten-yuu-grand-sathon/index588b.html?date=2017-06-06&amp;time=19.00"
                  class="swiper-slide red-slide">
                  <div class="home-slot-time normal-font font-weight-bold">
                    19:00
                  </div>
                  <div class="home-slot-discount">
                    <h1 class="font-weight-bold">
                      <span>-</span>10</h1>restaurant
                    </div>
                    <div class="home-slot-discount-pc">
                      %
                    </div>
                    <div class="home-slot-off">
                      off
                    </div>
                  </a>
                  <a href="restaurant/name/ten-yuu-grand-sathon/indexc3e9.html?date=2017-06-06&amp;time=19.30"
                  class="swiper-slide red-slide">
                  <div class="home-slot-time normal-font font-weight-bold">
                    19:30
                  </div>
                  <div class="home-slot-discount">
                    <h1 class="font-weight-bold">
                      <span>-</span>10</h1>
                    </div>
                    <div class="home-slot-discount-pc">
                      %
                    </div>
                    <div class="home-slot-off">
                      off
                    </div>
                  </a>

                </div>
              </div>
            </div>
          </div>
        </a> 
        <script>
          var k = '8';
          swipper(k, pp, '2');
        </script>
      </div>

      <!-- venue details --> 
    </div>
    <div class="col-md-4 vendor-box"><!-- venue box start-->

     <a href="<?php echo base_url();?>index.php/CustomerController/restaurantdetails">    

       <div class="home-recom-wrap">

        <div class="vendor-image">

          <a href="#"><img class="recom-box-img lazy" alt="" src="<?php echo base_url();?>images/pica.jpg" /></a>

          <div class="favourite-bg" style="background: rgba(0, 0, 0, 0.6);font-size: 13px;bottom: 5px;right: 6px;padding: 5px 12px 5px 12px;">
           <a href="#" class="">310 reservations recently</a>
         </div>

       </div>


       <div class="float-left">
        <div class="box-detail">
          <div class="box-detail-name">
            <a href="restaurant/name/ten-yuu-grand-sathon/indexa672.html?date=2017-06-06&amp;time=15.30&amp;source=eatigo_recommended">
              <h2 class="font-weight-bold">Ten Yuu Grand @ Sathon Soi 6</h2></a>
            </div>
            <div class="restro-title-box-left">
              <div class="box-detail-cuisine normal-font">
                japanese
              </div>
              <div class="box-detail-cuisine normal-font">
                sathon
              </div>
            </div>
            <div class="restro-title-box-right">
              <div class="box-detail-rating-gray">
                <div class="box-detail-rating-yellow_b"
                style="width:92%;"></div>
              </div>
              <div class="box-price-gray">
                <div class="box-detail-price-yellow_b"
                style="width:100%;"></div>
              </div>
            </div>
          </div>
          <div class="device">
            <a class="arrow-left" id="arrow-left-2-8" href="javascript:doNothing();"></a>
            <a class="arrow-right" id="arrow-right-2-8"
            href="javascript:doNothing();"></a>
            <div class="swiper-container" id="timeslot-2-8">
              <div class="swiper-wrapper">
                <script>
                  var pp = 0;
                </script>

                <a href="restaurant/name/ten-yuu-grand-sathon/indexa796.html?date=2017-06-06&amp;time=17.30"
                class="swiper-slide red-slide">
                <div class="home-slot-time normal-font font-weight-bold">
                  17:30
                </div>
                <div class="home-slot-discount">
                  <h1 class="font-weight-bold">
                    <span>-</span>10</h1>
                  </div>
                  <div class="home-slot-discount-pc">
                    %
                  </div>
                  <div class="home-slot-off">
                    off
                  </div>
                </a>

                <a href="restaurant/name/ten-yuu-grand-sathon/index588b.html?date=2017-06-06&amp;time=19.00"
                class="swiper-slide red-slide">
                <div class="home-slot-time normal-font font-weight-bold">
                  19:00
                </div>
                <div class="home-slot-discount">
                  <h1 class="font-weight-bold">
                    <span>-</span>10</h1>
                  </div>
                  <div class="home-slot-discount-pc">
                    %
                  </div>
                  <div class="home-slot-off">
                    off
                  </div>
                </a>
                <a href="restaurant/name/ten-yuu-grand-sathon/indexc3e9.html?date=2017-06-06&amp;time=19.30"
                class="swiper-slide red-slide">
                <div class="home-slot-time normal-font font-weight-bold">
                  19:30
                </div>
                <div class="home-slot-discount">
                  <h1 class="font-weight-bold">
                    <span>-</span>10</h1>
                  </div>
                  <div class="home-slot-discount-pc">
                    %
                  </div>
                  <div class="home-slot-off">
                    off
                  </div>
                </a>

              </div>
            </div>
          </div>
        </div>
      </a> 
      <script>
        var k = '8';
        swipper(k, pp, '2');
      </script>
    </div>

    <!-- venue details --> 
  </div>


</div>
</div>
</div>
</div>
</div>
