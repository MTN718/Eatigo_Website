//Search
var lat = '';
var lon = '';
var searchdate = '';

function goNewSearch(fromSearch) {

    $('.image-loder-han').html(rTxt);
    $(".bar_result").hide();
    $('.search-waiting').show();
    $('#search-result').hide();
    $('.fillter-search-box').hide();

    var strDate = $('#date').val();
    var Date_ar = strDate.split(",");
    var dd = parseInt($.trim(Date_ar[0]));
    var mm = $.trim(Date_ar[1]);
    var yy = $.trim(Date_ar[2]);
    mm = mm.toLowerCase();

    if (lang == 'th') {
        mm = parseInt($.inArray(mm, month_th));
        if (mm < 10) {
            mm = '0' + mm;
        }
    } else if (lang == 'zh') {
        mm = parseInt($.inArray(mm, month_zh));
        if (mm < 10) {
            mm = '0' + mm;
        }
    } else {
        mm = parseInt($.inArray(mm, month_en));
        if (mm < 10) {
            mm = '0' + mm;
        }
    }
    if (dd < 10) {
        dd = '0' + dd;
    }
    date = yy + '-' + mm + '-' + dd;
    searchdate = date;
    var time = search_time;
    var ppl = search_ppl;
    var location = '';
    var cuis_c = 0;
    var loc_c = 0;

    if (search_today != date) {
        $('#time1').hide();
        $('#time2').show();
        var t = $('#timeday2').text().trim();
        time = t.replace(":", ".");
    } else {
        $('#time2').hide();
        $('#time1').show();
        var t = $('#timeday1').text().trim();
        time = t.replace(":", ".");
    }

    /**
     * Get the search text in case it exists and the search doesn't come from the Search Page
     * For example the case when we come from HomePage and we're going to perform a search fetching the data from the Home
     */
    if (fromSearch === undefined) {
        var homeUrl = window.location.href, iniPos = homeUrl.indexOf('?search=');
        if (iniPos !== -1) {
            var endPos = homeUrl.indexOf('&date=');
            // Add the search params into a new String
            search_text = homeUrl.slice(iniPos + 8, endPos);
        }
    }
    
    var location_ar = [];

    //Get the cuisine ids from the html
    var cuisine_ids_ar = [];
    var cuisine_names_ar = [];
    $('.cuisine_search:checked').each(function() {
        cuisine_ids_ar.push($(this).data('cuisine-id'));
        cuisine_names_ar.push($(this).val());
    });

    /**
     * Check if exists any previous search parameters (i.e: coming from HP)
     * Check both, first the cuisines and after the locations
     */
    if (search_text) {
        location = search_text;
        // Check cuisines selected
        $(".cuisine_search").each(function () {
            var val = $(this).val();
            var id = $(this).attr("id");
            var n = location.indexOf(val);
            if (n != -1) {
                $('#' + id).prop('checked', true);
                cuis_c++;
            }
        });
        // Check locations selected
        $(".location_search").each(function () {
            var val = $(this).val();
            var id = $(this).attr("id");
            var n = location.indexOf(val);
            if (n > -1) {
                $('#' + id).prop('checked', true);
                loc_c++;
            }
        });
        search_text = '';

        /* In case there're not any previous search parameter we check in the Search Bar the new params checked by the user */
    } else {

        cuis_c = $(".cuisine_search:checked").length;

        $(".location_search:checked").each(function () {
            location_ar.push($(this).val().split("/"));
            loc_c++;
        });

        location = location_ar.toString();
    }

    // Check if all the cuisine types have been selected. In that case we select the value #cuisine-all
    if (cuisine_count == cuis_c) {
        $('#cuisine-all').prop('checked', true);
    }
    // Check if all the locations have been selected. In that case we select the value #location-all
    if (location_count == loc_c) {
        $('#location-all').prop('checked', true);
    }

    /**
     * Check if the user has selected some location. Just to make the plural: location => locations.
     * Check if it's English language or another one.
     */
    if (loc_c > 0) {
        if (loc_c > 1 && lang == 'en') {
            $('#txt-bylocation').html(loc_c + ' ' + _location + 's');
        } else {
            $('#txt-bylocation').html(loc_c + ' ' + _location);
        }
    } else {
        $('#txt-bylocation').html(anylocation);
    }

    /**
     * Check if the user has selected at least one type of Cuisine. Just to make the plural: Cuisine => Cuisines
     * Check if it's English language or another one.
     */
    if (cuis_c > 0) {
        if (cuis_c > 1 && lang == 'en') {
            $('#txt-bycuisine').html(cuis_c + ' ' + _cuisine + 's');
        } else {
            $('#txt-bycuisine').html(cuis_c + ' ' + _cuisine);
        }
    } else {
        $('#txt-bycuisine').html(anycuisine);
    }

    /**
     * Check if the input search_resto has any value. Mean that we're looking for some specific Restaurant?
     * If has a value, then trigger a search with this Restaurant Name Value
     */
    var search_resto = $('#search_resto').val();
    if (search_resto) {
        $('.header-tab-search2').trigger('click');
    }

    /**
     * SEO purpose
     * Update the title and metas according to location selected
     */
    if (location) {
        if (city_select) {
            if (lang == 'th') {
                $("title").html(title1 + ' ' + location + ' ' + title + ' พัทยา');
                $('meta[property="og:title"]').attr('content', title1 + ' ' + location + ' ' + title + ' พัทยา');
                $('meta[property="og:description"]').attr('content', dec1 + ' ' + location + dec2 + ' พัทยา ' + dec3);
                $('meta[name=description]').attr('content', dec1 + ' ' + location + dec2 + ' พัทยา ' + dec3);
            } else {
                $("title").html(location + ' ' + title + ' ' + city_select);
                $('meta[property="og:title"]').attr('content', location + ' ' + title + ' ' + city_select);
                $('meta[property="og:description"]').attr('content', dec1 + ' ' + location + dec2 + ' ' + city_select + ' ' + dec3);
                $('meta[name=description]').attr('content', dec1 + ' ' + location + dec2 + ' ' + city_select + ' ' + dec3);
            }

        } else {
            if (lang == 'th') {
                $("title").html(title1 + ' ' + location + ' ' + title + ' พัทยา');
                $('meta[property="og:title"]').attr('content', title1 + ' ' + location + ' ' + title + ' พัทยา');
                $('meta[name=description]').attr('content', dec1 + ' ' + location + dec2 + ' พัทยา ' + dec3);
                $('meta[property="og:description"]').attr('content', dec1 + ' ' + location + dec2 + ' พัทยา ' + dec3);
            } else {
                $("title").html(location + ' ' + title + ' ' + city);
                $('meta[property="og:title"]').attr('content', location + ' ' + title + ' ' + city);
                $('meta[name=description]').attr('content', dec1 + ' ' + location + dec2 + ' ' + city + ' ' + dec3);
                $('meta[property="og:description"]').attr('content', dec1 + ' ' + location + dec2 + ' ' + city + ' ' + dec3);
            }

        }
        // In case doesn't exist any current/selected location we setup the new values for title, metas,... for SEO purpose
    } else {
        if (city_select) {
            if (lang == 'th') {
                $("title").html(search_title + ' ' + title + ' พัทยา');
                $('meta[name=description]').attr('content', search_dec);
                $('meta[property="og:title"]').attr('content', search_title + ' ' + title + ' พัทยา');
                $('meta[property="og:description"]').attr('content', search_dec);
            } else {
                $("title").html(search_title + ' ' + title + ' ' + city_select);
                $('meta[name=description]').attr('content', search_dec);
                $('meta[property="og:title"]').attr('content', search_title + ' ' + title + ' ' + city_select);
                $('meta[property="og:description"]').attr('content', search_dec);
            }
        } else {
            $("title").html(search_title + ' ' + title + ' ' + city);
            $('meta[name=description]').attr('content', search_dec);
            $('meta[property="og:title"]').attr('content', search_title + ' ' + title + ' ' + city);
            $('meta[property="og:description"]').attr('content', search_dec);
        }
    }
    // End of SEO purpose code

    /**
     * Check if exists the 'from' variable.
     * Then push a new url to the window.history object just for history purpose
     * pushState DOESN'T refresh the page
     */
    var url_to_push = basePath + "/" + countryCodeAlias + "/" + lang + "/" + city_select_alias + "/search/?search=" + location + "&date=" + searchdate + "&time=" + time + "&ppl=" + search_ppl + "&name=" + search_resto;

    if (from) {
        url_to_push += "&from=" + from;
    }

    window.history.pushState("object or string", "Title", url_to_push);

    /**
     * Check if search_resto has any value. Mean that we're looking for some specific Restaurant?
     * In that case we modifiy the location value accordingly
     * Not sure it has sens as previously if search_resto exists we trigger a new search. Look backwards in this file
     */
    var resto_name = '';
    if (search_resto) {
        if (location) {
            location = search_resto + ',' + location;
        } else {
            location = search_resto;
        }
    }

    /**
     * Setup the Ajax URL along with the needed parameters
     * stype: Search type
     */
    var url = apiURL + 'search/?jsoncallback=?';
    if (location == '' && cuisine_ids_ar.length == 0) {
        stype = 3;
    } else {
        stype = 1;
    }

    // Special case for Pattaya city
    if (city_select == 'pattaya') {
        sid = 9;
    }

    // Data object sent along with the Ajax request with Search Params
    var postData = {
        stype: stype,
        date: date,
        time: $.trim(time),
        ppl: ppl,
        id: sid,
        sortby: sortby,
        lat: lat,
        lon: lon,
        search: location,
        page: '1',
        pp: '1000',
        cu: cuisine_ids_ar
    };

    // Do the Search Ajax request
    $.ajax({
        url: url,
        type: "POST",
        data: postData,
        dataType: "jsonp",
        crossDomain: true,
        //async:false,
        success: function (jsonData) {
            if (jsonData.status == 200) {
                if (jsonData.items != 'no result') {
                    search_result = jsonData.items;
                    fillter_result = jsonData.items;
                    // searchNewHTML will render the restaurant search results into the page
                    searchNewHTML(search_result, lat, lon);
                } else {
                    $('#h-result').html('0');
                    if (location_ar.length + cuisine_names_ar.length > 0) {
                        var txt = cannot_find_resto + $.merge(location_ar, cuisine_names_ar);
                    } else {
                        var txt = cannot_find_resto;
                    }
                    var html = txt;
                    $('#search-result').html(html);
                    $('.search-waiting').hide();
                    $('#search-result').show();
                    up_map();
                }
            } else {
                $('#h-result').html('0');
                if (location) {
                    var txt = cannot_find_resto + location;
                } else {
                    var txt = cannot_find_resto;
                }
                var html = txt;
                $('#search-result').html(html);
                $('.search-waiting').hide();
                $('#search-result').show();
                up_map();
            }
        },
        error: function (e) {
            $('#h-result').html('0');
            if (location) {
                var txt = cannot_find_resto + location;
            } else {
                var txt = cannot_find_resto;
            }
            var html = txt;
            $('#search-result').html(html);
            $('.search-waiting').hide();
            $('#search-result').show();
            up_map();
        }
    });
}

full_result = Array();
rate_result = Array();
rate_result_1 = Array();
rate_result_2 = Array();
rate_result_3 = Array();
rate_result_4 = Array();
rate_result_5 = Array();

price_result = Array();
price_result_1 = Array();
price_result_2 = Array();
price_result_3 = Array();
price_result_4 = Array();
price_result_5 = Array();

dis_result = Array();
dis_result_50 = Array();
dis_result_45 = Array();
dis_result_40 = Array();
dis_result_35 = Array();
dis_result_30 = Array();
dis_result_25 = Array();
dis_result_20 = Array();
dis_result_15 = Array();
dis_result_10 = Array();
dis_result_5 = Array();

var atmosphere_result = Array();

rate_inter_result = Array();
price_result = Array();
discount_result = Array();
atmosphere_result = Array();
inter_result = Array();

function searchNewHTML(json, lat, lon) {
    full_result = json;
    $('.fillter-search-box').show();
    search_cuisine = Array();
    search_atmosphere = Array();
    search_area = Array();
    search_neighborhood = Array();
    search_deals = Array();
    search_price = Array();
    search_rating = Array();

    html_cuisine = '';
    html_atmosphere = '';
    html_search_area = '';
    html_deals = '';
    html_price = '';
    html_price_img = '';
    html_rating = '';
    html_rating_img = '';
    $('.image-loder-han').html(rTxt);
    $('#serch').css({'display': 'none'});
    $('.search-waiting').show();
    $('#search-result').hide();

    var html = '';

    $.each(json, function (index, item) {
        var cIndex = search_cuisine.indexOf(item.cuisine);
        if (cIndex == -1) {
            search_cuisine.push(item.cuisine);
        }

        $.each(item.atmosphere, function (index_item_atmosphere, item_item_atmosphere) {
            var ap = search_atmosphere.indexOf(item_item_atmosphere.atmosphere);
            if (ap == -1) {
                search_atmosphere.push(item_item_atmosphere.atmosphere);
                atmos_arr.push(item);
            }
        });

        var ar = search_area.indexOf(item.area);
        if (ar == -1) {
            search_area.push(item.area);
        }

        var ne = search_neighborhood.indexOf(Array(item.area, item.neighborhood));
        if (ne == -1) {
            search_neighborhood.push(Array(item.area, item.neighborhood));
        }

        var deal = search_deals.indexOf(item.timeSlot[0].detail.discount);
        if (deal == -1) {
            search_deals.push(item.timeSlot[0].detail.discount);
            //deals_arr.push(item);
        }

        var priceR = search_price.indexOf(item.priceRange);
        if (priceR == -1) {
            search_price.push(item.priceRange);
            //price_arr.push(item);
        }

        var rat = search_rating.indexOf(parseInt(item.rating));
        if (rat == -1) {
            search_rating.push(parseInt(item.rating));
        }

        //for rating
        rate_result.push(item);
        if (parseInt(item.rating) == 1) {
            rate_result_1.push(item);
        } else if (parseInt(item.rating) == 2) {
            rate_result_2.push(item);
        } else if (parseInt(item.rating) == 3) {
            rate_result_3.push(item);
        } else if (parseInt(item.rating) == 4) {
            rate_result_4.push(item);
        } else {
            rate_result_5.push(item);
        }

        //for price
        price_result.push(item);
        if (parseInt(item.priceRange) == 1) {
            price_result_1.push(item);
        } else if (parseInt(item.priceRange) == 2) {
            price_result_2.push(item);
        } else if (parseInt(item.priceRange) == 3) {
            price_result_3.push(item);
        } else if (parseInt(item.priceRange) == 4) {
            price_result_4.push(item);
        } else {
            price_result_5.push(item);
        }

        //for discount
        dis_result.push(item);
        if (parseInt(item.timeSlot[0].detail.discount) == 50) {
            dis_result_50.push(item);
        } else if (parseInt(item.timeSlot[0].detail.discount) == 45) {
            dis_result_45.push(item);
        } else if (parseInt(item.timeSlot[0].detail.discount) == 40) {
            dis_result_40.push(item);
        } else if (parseInt(item.timeSlot[0].detail.discount) == 35) {
            dis_result_35.push(item);
        } else if (parseInt(item.timeSlot[0].detail.discount) == 30) {
            dis_result_30.push(item);
        } else if (parseInt(item.timeSlot[0].detail.discount) == 25) {
            dis_result_25.push(item);
        } else if (parseInt(item.timeSlot[0].detail.discount) == 20) {
            dis_result_20.push(item);
        } else if (parseInt(item.timeSlot[0].detail.discount) == 15) {
            dis_result_15.push(item);
        } else if (parseInt(item.timeSlot[0].detail.discount) == 10) {
            dis_result_10.push(item);
        } else {
            dis_result_5.push(item);
        }

        //for atmosphere
        atmosphere_result.push(item);

        var hnHTML = '';
        html += '<div class="home-recom-wrap" id="resto-id-' + item.resto_id + '">';
        hnHTML += '<div class="home-recom-wrap-han">';
        var togoLink = '';
        if (from) {
            togoLink = basePath + '/' + countryCodeAlias + '/' + lang + '/' + city_select_alias + '/restaurant/name/' + item.name_url + '/?from=' + from + '&source=search&ppl=' + search_ppl;
        } else {
            togoLink = basePath + '/' + countryCodeAlias + '/' + lang + '/' + city_select_alias + '/restaurant/name/' + item.name_url + '/?source=search&ppl=' + search_ppl;
        }


        if (item.restaurantStatus == 'Coming-Soon') {
            html += '<div class="position-img"><a title="coming soon!" id="restaurant_img_2_146" href="' + togoLink + '&date=' + searchdate + '&time=' + time + '" ><img alt="coming soon" src="' + basePath + '/themes/default/images/index/coming_soon.png"></a></div>';
        }

        if (item.restaurantStatus == 'Coming-Soon') {
            html += '<a class="recom-box-img comingsoon" href="javascript:doNothing();"';
            hnHTML += '<a class="recom-box-img-han" style="background:url(' + item.img + ') no-repeat; background-size:cover;" href="' + togoLink + '&date=' + searchdate + '&time=' + time + '"';
            html += '>';
            hnHTML += '>';
        } else {
            html += '<a class="recom-box-img" href="' + togoLink + '&date=' + searchdate + '&time=' + time + '"';
            hnHTML += '<a class="recom-box-img-han" style="background:url(' + item.img + ') no-repeat; background-size:cover;" href="' + togoLink + '&date=' + searchdate + '&time=' + time + '"';
            html += '>';
            hnHTML += '>';
        }

        if (item.imgm != 'https://static.eatigo.com/') {
            html += '<img class="recom-box-img lazy" data-original="' + item.imgm + '" />';
        } else {
            html += '<img class="recom-box-img lazy" data-original="' + item.restoImg + '" />';
        }
        html += '<div class="logo-resto" style="background:url(' + item.logo + ') no-repeat;"></div>';

        if (item.imgm != 'https://static.eatigo.com/') {
            hnHTML += '<img class="recom-box-img lazy" data-original="' + item.imgm + '" />';
        } else {
            hnHTML += '<img class="recom-box-img lazy" data-original="' + item.restoImg + '" />';
        }
        hnHTML += '<div class="logo-resto" style="background:url(' + item.logo + ') no-repeat;"></div>';

        if (item.closeN47day != '') {
            html += '<div class="group-resto-name" style="top:18%; color:#FFF;"><div class="name-txt"><h2>';
            html += item.closeN47day[0];
            html += '</h2></div><div class="total-txt small-font">';
            html += item.closeN47day[1];
            html += '</div></div>';

            hnHTML += '<div class="group-resto-name" style="top:18%; color:#FFF;"><div class="name-txt"><h2>';
            hnHTML += item.closeN47day[0];
            hnHTML += '</h2></div><div class="total-txt small-font">';
            hnHTML += item.closeN47day[1];
            hnHTML += '</div></div>';
        }

        if (item.new == 'yes') {
            if (lang == 'th') {
                html += '<div class="home-new-' + lang + '">ใหม่</div>';
                hnHTML += '<div class="home-new-' + lang + '">ใหม่</div>';
            } else {
                html += '<div class="home-new-' + lang + '">new</div>';
                hnHTML += '<div class="home-new-' + lang + '">new</div>';
            }
        }

        if (item.day > 1) {
            html += '<div class="home-p1">';
            html += ' +' + home_p1;
            html += '</div>';

            hnHTML += '<div class="home-p1">';
            hnHTML += ' +' + home_p1;
            hnHTML += '</div>';
        }

        if (item.booked_count > 0) {
            var bc = addCommas(item.booked_count);
            if (item.day > 1) {
                html += '<div class="home-p1" style="right: 75px;">';
                hnHTML += '<div class="home-p1" style="right: 75px;">';
            } else {
                html += '<div class="home-p1">';
                hnHTML += '<div class="home-p1">';
            }
            if (lang == 'th') {
                html += bc + ' ' + booking_made;
                hnHTML += bc + ' ' + booking_made;
            } else {
                if (item.booked_count == 1) {
                    html += bc + ' ' + booking_made;
                    hnHTML += bc + ' ' + booking_made;
                } else {
                    html += bc + ' ' + bookings_made;
                    hnHTML += bc + ' ' + bookings_made;
                }

            }
            html += '</div>';
            hnHTML += '</div>';
        }

        html += '</a>';
        html += '<div class="float-left">';
        html += '<div class="box-detail">';
        //html += '<div class="box-detail-name">'+item.name+'</div>';
        html += '<div class="box-detail-name"><a href="' + togoLink + '&date=' + searchdate + '&time=' + time + '"><h2 class="font-weight-bold">' + item.name + '</h2></a></div>';
        html += '<div class="restro-title-box-left">';
        html += '<div class="box-detail-cuisine normal-font">' + item.cuisine + '</div>';
        html += '<div class="box-detail-cuisine normal-font">' + item.neighborhood + '</div>';
        html += '</div>';
        html += '<div class="restro-title-box-right">';
        html += '<div class="box-detail-rating-gray">';
        var rating = (item.rating * 100) / 5;
        html += '<div class="box-detail-rating-yellow_b" style="width:' + rating + '%;"></div>';
        html += '</div><div class="box-price-gray">';
        var price_range = (item.priceRange * 100) / 5;
        html += '<div class="box-detail-price-yellow_b" style="width:' + price_range + '%;"></div>';
        html += '</div>';
        html += '</div>';
        html += '</div>';

        hnHTML += '</a>';
        hnHTML += '<div class="float-left">';
        hnHTML += '<div class="box-detail"  style=" bottom: 90px; ">';
        hnHTML += '<div class="box-detail-name"><a href="' + togoLink + '&date=' + searchdate + '&time=' + time + '"><h2 class="font-weight-bold">' + item.name + '</h2></a></div>';
        hnHTML += '<div class="restro-title-box-left">';
        hnHTML += '<div class="box-detail-cuisine normal-font">' + item.cuisine + '</div>';
        hnHTML += '<div class="box-detail-cuisine normal-font">' + item.neighborhood + '</div>';
        hnHTML += '</div>';
        hnHTML += '<div class="restro-title-box-right">';
        hnHTML += '<div class="box-detail-rating-gray">';
        hnHTML += '<div class="box-detail-rating-yellow_b" style="width:' + rating + '%;"></div>';
        hnHTML += '</div><div class="box-price-gray">';
        hnHTML += '<div class="box-detail-price-yellow_b" style="width:' + price_range + '%;"></div>';
        hnHTML += '</div>';
        hnHTML += '</div>';
        hnHTML += '</div>';

        html += '<div class="device">';
        hnHTML += '<div class="device">';
        html += '<a class="arrow-left" id="arrow-left-hn-' + index + '" href="javascript:doNothing();"></a>';
        hnHTML += '<a class="arrow-left" id="arrow-left-hnm-' + index + '" href="javascript:doNothing();"></a>';
        html += '<a class="arrow-right" id="arrow-right-hn-' + index + '" href="javascript:doNothing();"></a>';
        hnHTML += '<a class="arrow-right" id="arrow-right-hnm-' + index + '" href="javascript:doNothing();"></a>';
        html += '<div class="swiper-container" id="timeslot-hn-' + index + '">';
        hnHTML += '<div class="swiper-container" id="timeslot-hnm-' + index + '">';

        if (item.restaurantStatus == 'Coming-Soon') {
            html += '<div class="swiper-wrapper comingsoon">';
            hnHTML += '<div class="swiper-wrapper comingsoon">';
        } else {
            html += '<div class="swiper-wrapper">';
            hnHTML += '<div class="swiper-wrapper">';
        }

        if (item.timeSlot.length == 1) {
            if (item.timeSlot[0].detail.status == 'open') {
                if (item.restaurantStatus == 'Coming-Soon') {
                    html += '<a href="javascript:doNothing();" class="swiper-slide red-slide">';
                    hnHTML += '<a href="javascript:doNothing();" class="swiper-slide red-slide">';
                } else {
                    html += '<a href="' + togoLink + '&date=' + searchdate + '&time=' + item.timeSlot[0].time + '" class="swiper-slide red-slide">';
                    hnHTML += '<a href="' + togoLink + '&date=' + searchdate + '&time=' + item.timeSlot[0].time + '" class="swiper-slide red-slide">';
                }
                html += '<div class="home-slot-time normal-font font-weight-bold">' + item.timeSlot[0].time.replace(".", ":") + '</div>';
                html += '<div class="home-slot-discount"><h1 class="font-weight-bold"><span>-</span>' + item.timeSlot[0].detail.discount + '</h1></div>';
                html += '<div class="home-slot-discount-pc">%</div><div class="home-slot-off">off</div></a>';

                hnHTML += '<div class="home-slot-time normal-font font-weight-bold">' + item.timeSlot[0].time.replace(".", ":") + '</div>';
                hnHTML += '<div class="home-slot-discount"><h1 class="font-weight-bold"><span>-</span>' + item.timeSlot[0].detail.discount + '</h1></div>';
                hnHTML += '<div class="home-slot-discount-pc">%</div><div class="home-slot-off">off</div></a>';

            }
            html += '<a href="javascript:doNothing();" class="swiper-slide home-close-slide ' + lang + '"></a><a href="javascript:doNothing();" class="swiper-slide home-close-slide ' + lang + '"></a>';
            hnHTML += '<a href="javascript:doNothing();" class="swiper-slide home-close-slide ' + lang + '"></a><a href="javascript:doNothing();" class="swiper-slide home-close-slide ' + lang + '"></a>';
            html += '<a href="javascript:doNothing();" class="swiper-slide home-close-slide ' + lang + '"></a><a href="javascript:doNothing();" class="swiper-slide home-close-slide ' + lang + '"></a>';
            hnHTML += '<a href="javascript:doNothing();" class="swiper-slide home-close-slide ' + lang + '"></a><a href="javascript:doNothing();" class="swiper-slide home-close-slide ' + lang + '"></a>';
        } else if (item.timeSlot.length == 2) {
            $.each(item.timeSlot, function (index2, slotlist) {
                if (slotlist.detail.status == 'open') {
                    if (item.restaurantStatus == 'Coming-Soon') {
                        html += '<a href="javascript:doNothing();" class="swiper-slide red-slide">';
                        hnHTML += '<a href="javascript:doNothing();" class="swiper-slide red-slide">';
                    } else {
                        html += '<a href="' + togoLink + '&date=' + searchdate + '&time=' + slotlist.time + '" class="swiper-slide red-slide">';
                        hnHTML += '<a href="' + togoLink + '&date=' + searchdate + '&time=' + slotlist.time + '" class="swiper-slide red-slide">';
                    }
                    html += '<div class="home-slot-time normal-font font-weight-bold">' + slotlist.time.replace(".", ":") + '</div>';
                    html += '<div class="home-slot-discount"><h1 class="font-weight-bold"><span>-</span>' + slotlist.detail.discount + '</h1></div>';
                    html += '<div class="home-slot-discount-pc">%</div><div class="home-slot-off">off</div></a>';

                    hnHTML += '<div class="home-slot-time normal-font font-weight-bold">' + slotlist.time.replace(".", ":") + '</div>';
                    hnHTML += '<div class="home-slot-discount"><h1 class="font-weight-bold"><span>-</span>' + slotlist.detail.discount + '</h1></div>';
                    hnHTML += '<div class="home-slot-discount-pc">%</div><div class="home-slot-off">off</div></a>';
                } else {
                    html += '<a href="javascript:doNothing();" class="swiper-slide home-close-slide ' + lang + '"></a>';
                    hnHTML += '<a href="javascript:doNothing();" class="swiper-slide home-close-slide ' + lang + '"></a>';
                }
            });
            html += '<a href="javascript:doNothing();" class="swiper-slide home-close-slide ' + lang + '"></a>';
            hnHTML += '<a href="javascript:doNothing();" class="swiper-slide home-close-slide ' + lang + '"></a>';

        } else {
            $.each(item.timeSlot, function (index2, slotlist) {
                if (slotlist.detail.status == 'open') {
                    if (item.restaurantStatus == 'Coming-Soon') {
                        html += '<a href="javascript:doNothing();" class="swiper-slide red-slide">';
                        hnHTML += '<a href="javascript:doNothing();" class="swiper-slide red-slide">';
                    } else {
                        html += '<a href="' + togoLink + '&date=' + searchdate + '&time=' + slotlist.time + '" class="swiper-slide red-slide">';
                        hnHTML += '<a href="' + togoLink + '&date/' + searchdate + '/time/' + slotlist.time + '" class="swiper-slide red-slide">';
                    }
                    html += '<div class="home-slot-time normal-font font-weight-bold">' + slotlist.time.replace(".", ":") + '</div>';
                    html += '<div class="home-slot-discount"><h1 class="font-weight-bold"><span>-</span>' + slotlist.detail.discount + '</h1></div>';
                    html += '<div class="home-slot-discount-pc">%</div><div class="home-slot-off">off</div></a>';

                    hnHTML += '<div class="home-slot-time normal-font font-weight-bold">' + slotlist.time.replace(".", ":") + '</div>';
                    hnHTML += '<div class="home-slot-discount"><h1 class="font-weight-bold"><span>-</span>' + slotlist.detail.discount + '</h1></div>';
                    hnHTML += '<div class="home-slot-discount-pc">%</div><div class="home-slot-off">off</div></a>';
                } else if (slotlist.detail.status == 'close') {
                    html += '<a href="javascript:doNothing();" class="swiper-slide home-close-slide ' + lang + '"></a>';
                    hnHTML += '<a href="javascript:doNothing();" class="swiper-slide home-close-slide ' + lang + '"></a>';
                } else if (slotlist.detail.status == 'soldout') {
                    html += '<a href="javascript:doNothing();" class="swiper-slide home-soldout-slide"></a>';
                    hnHTML += '<a href="javascript:doNothing();" class="swiper-slide home-soldout-slide"></a>';
                }
            });
        }
        html += '</div></div></div></div>';
        html += '<div  class="box-banner-bottom" style="display:none;"><center><img src="' + basePath + '/themes/default/images/index/eatigo_icon.png"></center></div></div>';

        LocationData[index] = Array(item.lat, item.lon, hnHTML, item.timeSlot[0].detail.discount, item.name);
        swipperHN(index, 'hn');
    });
    if ((lat != '') && (lon != '')) {
        var maLocation = Array();
        maLocation[0] = Array(lat, lon, '<div class="box-banner-bottom-hnm-here">You are here.</div>', 0, 'You are here.');
        LocationData = $.merge(maLocation, LocationData);
    }

    //var html_atmosphere = '';
    if (html_atmosphere == '') {
        if (search_atmosphere.length > 0) {
            search_atmosphere.sort();
            $.each(search_atmosphere, function (index_atmosphere, item_atmosphere) {
                atmos_count++;
                html_atmosphere += '<div class="checkbox-box-fillter-atmos">';
                html_atmosphere += '<input id="atmosphere' + index_atmosphere + '" onClick="onFilter(\'atmosphere\', \'' + item_atmosphere + '\');" type="checkbox" name="atmosphere[]" class="atmosphere" value="' + item_atmosphere + '">';
                html_atmosphere += '<label for="atmosphere' + index_atmosphere + '">' + item_atmosphere + '</label>';
                html_atmosphere += '</div>';
            });
        } else {
            html_atmosphere += '<div style="width:220px;">no filter for current search</div>';
        }
    }

    if (html_deals == '') {

        if (search_deals.length > 0) {
            search_deals.sort();
            search_deals.reverse();
            $.each(search_deals, function (index_deals, item_deals) {
                disc_count++;
                html_deals += '<div class="checkbox-box-fillter">';
                html_deals += '<input id="deals' + index_deals + '" onClick="onFilter(\'deals\', \'' + item_deals + '\');" type="checkbox" name="deals[]" class="deals" value="' + item_deals + '">';
                html_deals += '<label for="deals' + index_deals + '"><span>-' + item_deals + '</span>%</label>';
                html_deals += '</div>';

            });
        } else {
            html_deals += '<div style="width:220px;">no filter for current search</div>';
        }

    }

    if (html_rating == '') {

        if (search_rating.length > 0) {
            search_rating.sort();
            search_rating.reverse();
            $.each(search_rating, function (index_rating, item_rating) {
                rating_count++;
                var ret_percen = item_rating * 20;

                html_rating += '<div class="checkbox-box-fillter">';
                html_rating += '<input id="rating' + index_rating + '"  onClick="onFilter(\'rating\', \'' + item_rating + '\');" type="checkbox" name="rating[]" class="rating" value="' + item_rating + '">';
                html_rating += '<label for="rating' + index_rating + '">';
                html_rating += '<div class="box-fill-rating-white">';
                html_rating += '<div class="box-detail-rating-yellow2" style="width:' + ret_percen + '%;"></div>';
                html_rating += '</div>';
                html_rating += '</label>';
                html_rating += '</div>';

            });
        } else {
            html_rating += '<div style="width:220px;">no filter for current search</div>';
        }

    }

    if (html_price == '') {

        if (search_price.length > 0) {

            search_price.sort();

            $.each(search_price, function (index_price, item_price) {
                price_count++;
                html_price += '<div class="checkbox-box-fillter">';
                html_price += '<input id="price' + index_price + '" type="checkbox" name="price[]" class="price" onClick="onFilter(\'price\', \'' + item_price + '\');" value="' + item_price + '">';
                html_price += '<label for="price' + index_price + '">';
                for (var pri = 0; pri < item_price; pri++) {
                    html_price += '<img src="' + basePath + '/themes/default/images/detail/dollar_orange.png" alt="">';
                }
                html_price += '</label>';
                html_price += '</div>';

            });

        } else {
            html_price += '<div style="width:220px;">no filter for current search</div>';
        }

    }

    $('#search-result').html(html);
    $('.search-waiting').hide();
    $('#search-result').show();
    $("img.lazy").lazyload({
        effect: "fadeIn"
    });
    $.each(json, function (index, item) {
        swipperHN(index, 'hn');
    });
    $('#h-result').html(json.length);
    $('#atmosphere-list').html(html_atmosphere);
    $('#deals-list').html(html_deals);
    $('#price-list').html(html_price);
    $('#rating-list').html(html_rating);

    $(".bar_result").show();
    $(".search_fields").show();
}

function onFilter(k, v) {
    inter_result = Array();
    rate_inter_result = Array();
    price_inter_result = Array();
    dis_inter_result = Array();
    inter_result = Array();
    var rate = $('.rating:checked').length;
    var rate_t = $('.rating').length;
    if (rate == rate_t) {
        $('#rate-all').prop('checked', true);
    } else {
        $('#rate-all').prop('checked', false);
    }

    var price = $('.price:checked').length;
    var price_t = $('.price').length;
    if (price == price_t) {
        $('#price-all').prop('checked', true);
    } else {
        $('#price-all').prop('checked', false);
    }

    var disc = $('.deals:checked').length;
    var disc_t = $('.deals').length;
    if (disc == disc_t) {
        $('#discount-all').prop('checked', true);
    } else {
        $('#discount-all').prop('checked', false);
    }

    var atmosphere = $('.atmosphere:checked').length;
    var atmosphere_t = $('.atmosphere').length;
    if (atmosphere == atmosphere_t) {
        $('#atmosphere-all').prop('checked', true);
    } else {
        $('#atmosphere-all').prop('checked', false);
    }
    //rate
    rating_check = Array();
    $(".rating:checked").each(function () {
        if ($(this).val()) rating_check.push(parseInt($(this).val()));
    });
    if (rating_check.length > 0) {
        $.each(rating_check, function (index1, item1) {
            var lock = '';
            if (item1 == 5) {
                lock = rate_result_5;
            } else if (item1 == 4) {
                lock = rate_result_4;
            } else if (item1 == 3) {
                lock = rate_result_3;
            } else if (item1 == 2) {
                lock = rate_result_2;
            } else {
                lock = rate_result_1;
            }
            rate_inter_result = $.merge(rate_inter_result, lock);
        });
        rate_result = intersection(rate_inter_result, full_result);
    } else {
        rate_result = full_result;
    }

    //price
    price_check = Array();
    $(".price:checked").each(function () {
        if ($(this).val()) price_check.push(parseInt($(this).val()));
    });

    if (price_check.length > 0) {
        $.each(price_check, function (index1, item1) {
            var lockp = '';
            if (item1 == 5) {
                lockp = price_result_5;
            } else if (item1 == 4) {
                lockp = price_result_4;
            } else if (item1 == 3) {
                lockp = price_result_3;
            } else if (item1 == 2) {
                lockp = price_result_2;
            } else {
                lockp = price_result_1;
            }
            price_inter_result = $.merge(price_inter_result, lockp);
        });
        price_result = intersection(price_inter_result, full_result);
    } else {
        price_result = full_result;
    }

    //discount
    dis_check = Array();
    $(".deals:checked").each(function () {
        if ($(this).val()) dis_check.push(parseInt($(this).val()));
    });
    if (dis_check.length > 0) {
        $.each(dis_check, function (index1, item1) {
            var lockd = '';
            if (item1 == 50) {
                lockd = dis_result_50;
            } else if (item1 == 45) {
                lockd = dis_result_45;
            } else if (item1 == 40) {
                lockd = dis_result_40;
            } else if (item1 == 35) {
                lockd = dis_result_35;
            } else if (item1 == 30) {
                lockd = dis_result_30;
            } else if (item1 == 25) {
                lockd = dis_result_25;
            } else if (item1 == 20) {
                lockd = dis_result_20;
            } else if (item1 == 15) {
                lockd = dis_result_15;
            } else if (item1 == 10) {
                lockd = dis_result_10;
            } else {
                lockd = dis_result_5;
            }
            dis_inter_result = $.merge(dis_inter_result, lockd);
        });
        dis_result = intersection(dis_inter_result, full_result);
    } else {
        dis_result = full_result;
    }

    //atmosphere
    var as_check = Array();
    var as_result = Array();
    $(".atmosphere:checked").each(function () {
        if ($(this).val()) as_check.push($(this).val());
    });
    if (as_check.length > 0) {
        $.each(atmosphere_result, function (index2, item2) {
            $.each(item2.atmosphere, function (index3, item3) {
                if ($.inArray(item3.atmosphere, as_check) >= 0) {
                    as_result.push(item2);
                }
            });
        });
    } else {
        as_result = atmosphere_result;
    }

    inter_result = intersection(rate_result, full_result);
    inter_result = intersection(price_result, inter_result);
    inter_result = intersection(dis_result, inter_result);
    inter_result = intersection(as_result, inter_result);
    newFilterHTML(inter_result, lat, lon, k, v);
}

function newFilterHTML(result, lat, lon, k, v) {
    $('#search-result').hide();
    var html = '';
    var i = 0;

    $.each(result, function (index, item) {
        var hnHTML = '';
        html += '<div class="home-recom-wrap" id="resto-id-' + item.resto_id + '">';
        hnHTML += '<div class="home-recom-wrap-han">';
        var togoLink = '';
        if (from) {
            togoLink = basePath + '/' + countryCodeAlias + '/' + lang + '/' + city_select_alias + '/restaurant/name/' + item.name_url + '/?from=' + from + '&source=search&';
        } else {
            togoLink = basePath + '/' + countryCodeAlias + '/' + lang + '/' + city_select_alias + '/restaurant/name/' + item.name_url + '/?source=search&';
        }
        if (item.restaurantStatus == 'Coming-Soon') {
            html += '<div class="position-img"><a title="coming soon!" id="restaurant_img_2_146" href="' + togoLink + 'date=' + searchdate + '&time=' + time + '" ><img alt="coming soon" src="' + basePath + '/themes/default/images/index/coming_soon.png"></a></div>';
        }
        if (item.restaurantStatus == 'Coming-Soon') {
            html += '<a class="recom-box-img comingsoon" href="javascript:doNothing();"';
            hnHTML += '<a class="recom-box-img-han" style="background:url(' + item.img + ') no-repeat; background-size:cover;" href="' + togoLink + 'date=' + searchdate + '&time=' + time + '"';
            html += '>';
            hnHTML += '>';
        } else {
            html += '<a class="recom-box-img" href="' + togoLink + 'date=' + searchdate + '&time=' + time + '"';
            hnHTML += '<a class="recom-box-img-han" style="background:url(' + item.img + ') no-repeat; background-size:cover;" href="' + togoLink + 'date=' + searchdate + '&time=' + time + '"';
            html += '>';
            hnHTML += '>';
        }

        if (item.imgm != 'https://static.eatigo.com/') {
            html += '<img class="recom-box-img lazy" data-original="' + item.imgm + '" />';
        } else {
            html += '<img class="recom-box-img lazy" data-original="' + item.restoImg + '" />';
        }
        html += '<div class="logo-resto" style="background:url(' + item.logo + ') no-repeat;"></div>';

        if (item.imgm != 'https://static.eatigo.com/') {
            hnHTML += '<img class="recom-box-img lazy" data-original="' + item.imgm + '" />';
        } else {
            hnHTML += '<img class="recom-box-img lazy" data-original="' + item.restoImg + '" />';
        }
        hnHTML += '<div class="logo-resto" style="background:url(' + item.logo + ') no-repeat;"></div>';

        if (item.closeN47day != '') {
            html += '<div class="group-resto-name" style="top:18%; color:#FFF;"><div class="name-txt"><h2>';
            html += item.closeN47day[0];
            html += '</h2></div><div class="total-txt small-font">';
            html += item.closeN47day[1];
            html += '</div></div>';

            hnHTML += '<div class="group-resto-name" style="top:18%; color:#FFF;"><div class="name-txt"><h2>';
            hnHTML += item.closeN47day[0];
            hnHTML += '</h2></div><div class="total-txt small-font">';
            hnHTML += item.closeN47day[1];
            hnHTML += '</div></div>';
        }

        if (item.new == 'yes') {
            if (lang == 'th') {
                html += '<div class="home-new-' + lang + '">ใหม่</div>';
                hnHTML += '<div class="home-new-' + lang + '">ใหม่</div>';
            } else {
                html += '<div class="home-new-' + lang + '">new</div>';
                hnHTML += '<div class="home-new-' + lang + '">new</div>';
            }
        }

        if (item.day > 1) {
            html += '<div class="home-p1">';
            html += ' +' + home_p1;
            html += '</div>';

            hnHTML += '<div class="home-p1">';
            hnHTML += ' +' + home_p1;
            hnHTML += '</div>';
        }

        if (item.booked_count > 0) {
            var bc = addCommas(item.booked_count);
            if (item.day > 1) {
                html += '<div class="home-p1" style="right: 75px;">';
                hnHTML += '<div class="home-p1" style="right: 75px;">';
            } else {
                html += '<div class="home-p1">';
                hnHTML += '<div class="home-p1">';
            }
            if (lang == 'th') {
                html += bc + ' ' + booking_made;
                hnHTML += bc + ' ' + booking_made;
            } else {
                if (item.booked_count == 1) {
                    html += bc + ' ' + booking_made;
                    hnHTML += bc + ' ' + booking_made;
                } else {
                    html += bc + ' ' + bookings_made;
                    hnHTML += bc + ' ' + bookings_made;
                }

            }
            html += '</div>';
            hnHTML += '</div>';
        }


        html += '</a>';
        html += '<div class="float-left">';
        html += '<div class="box-detail">';
        html += '<div class="box-detail-name"><a href="' + togoLink + 'date=' + searchdate + '&time=' + time + '"><h2 class="font-weight-bold">' + item.name + '</h2></a></div>';
        html += '<div class="restro-title-box-left">';
        html += '<div class="box-detail-cuisine normal-font">' + item.cuisine + '</div>';
        html += '<div class="box-detail-cuisine normal-font">' + item.neighborhood + '</div>';
        html += '</div>';
        html += '<div class="restro-title-box-right">';
        html += '<div class="box-detail-rating-gray">';
        var rating = (item.rating * 100) / 5;
        html += '<div class="box-detail-rating-yellow_b" style="width:' + rating + '%;"></div>';
        html += '</div><div class="box-price-gray">';
        var price_range = (item.priceRange * 100) / 5;
        html += '<div class="box-detail-price-yellow_b" style="width:' + price_range + '%;"></div>';
        html += '</div>';
        html += '</div>';
        html += '</div>';

        hnHTML += '</a>';
        hnHTML += '<div class="float-left">';
        hnHTML += '<div class="box-detail"  style=" bottom: 90px; ">';
        hnHTML += '<div class="box-detail-name"><a href="' + togoLink + 'date=' + searchdate + '&time=' + time + '"><h2 class="font-weight-bold">' + item.name + '</h2></a></div>';
        hnHTML += '<div class="restro-title-box-left">';
        hnHTML += '<div class="box-detail-cuisine normal-font">' + item.cuisine + '</div>';
        hnHTML += '<div class="box-detail-cuisine normal-font">' + item.neighborhood + '</div>';
        hnHTML += '</div>';
        hnHTML += '<div class="restro-title-box-right">';
        hnHTML += '<div class="box-detail-rating-gray">';
        hnHTML += '<div class="box-detail-rating-yellow_b" style="width:' + rating + '%;"></div>';
        hnHTML += '</div><div class="box-price-gray">';
        hnHTML += '<div class="box-detail-price-yellow_b" style="width:' + price_range + '%;"></div>';
        hnHTML += '</div>';
        hnHTML += '</div>';
        hnHTML += '</div>';

        html += '<div class="device">';
        hnHTML += '<div class="device">';
        html += '<a class="arrow-left" id="arrow-left-hn-' + index + '" href="javascript:doNothing();"></a>';
        hnHTML += '<a class="arrow-left" id="arrow-left-hnm-' + index + '" href="javascript:doNothing();"></a>';
        html += '<a class="arrow-right" id="arrow-right-hn-' + index + '" href="javascript:doNothing();"></a>';
        hnHTML += '<a class="arrow-right" id="arrow-right-hnm-' + index + '" href="javascript:doNothing();"></a>';
        html += '<div class="swiper-container" id="timeslot-hn-' + index + '">';
        hnHTML += '<div class="swiper-container" id="timeslot-hnm-' + index + '">';

        if (item.restaurantStatus == 'Coming-Soon') {
            html += '<div class="swiper-wrapper comingsoon">';
            hnHTML += '<div class="swiper-wrapper comingsoon">';
        } else {
            html += '<div class="swiper-wrapper">';
            hnHTML += '<div class="swiper-wrapper">';
        }
        if (item.timeSlot.length == 1) {
            if (item.timeSlot[0].detail.status == 'open') {
                if (item.restaurantStatus == 'Coming-Soon') {
                    html += '<a href="javascript:doNothing();" class="swiper-slide red-slide">';
                    hnHTML += '<a href="javascript:doNothing();" class="swiper-slide red-slide">';
                } else {
                    html += '<a href="' + togoLink + 'date=' + searchdate + '&time=' + item.timeSlot[0].time + '" class="swiper-slide red-slide">';
                    hnHTML += '<a href="' + togoLink + 'date=' + searchdate + '&time=' + item.timeSlot[0].time + '" class="swiper-slide red-slide">';
                }
                html += '<div class="home-slot-time normal-font font-weight-bold">' + item.timeSlot[0].time.replace(".", ":") + '</div>';
                html += '<div class="home-slot-discount"><h1 class="font-weight-bold"><span>-</span>' + item.timeSlot[0].detail.discount + '</h1></div>';
                html += '<div class="home-slot-discount-pc">%</div><div class="home-slot-off">off</div></a>';

                hnHTML += '<div class="home-slot-time normal-font font-weight-bold">' + item.timeSlot[0].time.replace(".", ":") + '</div>';
                hnHTML += '<div class="home-slot-discount"><h1 class="font-weight-bold"><span>-</span>' + item.timeSlot[0].detail.discount + '</h1></div>';
                hnHTML += '<div class="home-slot-discount-pc">%</div><div class="home-slot-off">off</div></a>';
            }
            html += '<a href="javascript:doNothing();" class="swiper-slide home-close-slide ' + lang + '"></a><a href="javascript:doNothing();" class="swiper-slide home-close-slide ' + lang + '"></a>';
            hnHTML += '<a href="javascript:doNothing();" class="swiper-slide home-close-slide ' + lang + '"></a><a href="javascript:doNothing();" class="swiper-slide home-close-slide ' + lang + '"></a>';
            html += '<a href="javascript:doNothing();" class="swiper-slide home-close-slide ' + lang + '"></a><a href="javascript:doNothing();" class="swiper-slide home-close-slide ' + lang + '"></a>';
            hnHTML += '<a href="javascript:doNothing();" class="swiper-slide home-close-slide ' + lang + '"></a><a href="javascript:doNothing();" class="swiper-slide home-close-slide ' + lang + '"></a>';
        } else if (item.timeSlot.length == 2) {
            $.each(item.timeSlot, function (index2, slotlist) {
                if (slotlist.detail.status == 'open') {
                    if (item.restaurantStatus == 'Coming-Soon') {
                        html += '<a href="javascript:doNothing();" class="swiper-slide red-slide">';
                        hnHTML += '<a href="javascript:doNothing();" class="swiper-slide red-slide">';
                    } else {
                        html += '<a href="' + togoLink + 'date=' + searchdate + '&time=' + slotlist.time + '" class="swiper-slide red-slide">';
                        hnHTML += '<a href="' + togoLink + 'date=' + searchdate + '&time=' + slotlist.time + '" class="swiper-slide red-slide">';
                    }
                    html += '<div class="home-slot-time normal-font font-weight-bold">' + slotlist.time.replace(".", ":") + '</div>';
                    html += '<div class="home-slot-discount"><h1 class="font-weight-bold"><span>-</span>' + slotlist.detail.discount + '</h1></div>';
                    html += '<div class="home-slot-discount-pc">%</div><div class="home-slot-off">off</div></a>';

                    hnHTML += '<div class="home-slot-time normal-font font-weight-bold">' + slotlist.time.replace(".", ":") + '</div>';
                    hnHTML += '<div class="home-slot-discount"><h1 class="font-weight-bold"><span>-</span>' + slotlist.detail.discount + '</h1></div>';
                    hnHTML += '<div class="home-slot-discount-pc">%</div><div class="home-slot-off">off</div></a>';
                } else {
                    html += '<a href="javascript:doNothing();" class="swiper-slide home-close-slide ' + lang + '"></a>';
                    hnHTML += '<a href="javascript:doNothing();" class="swiper-slide home-close-slide ' + lang + '"></a>';
                }
            });
            html += '<a href="javascript:doNothing();" class="swiper-slide home-close-slide ' + lang + '"></a>';
            hnHTML += '<a href="javascript:doNothing();" class="swiper-slide home-close-slide ' + lang + '"></a>';
        } else {
            $.each(item.timeSlot, function (index2, slotlist) {
                if (slotlist.detail.status == 'open') {
                    if (item.restaurantStatus == 'Coming-Soon') {
                        html += '<a href="javascript:doNothing();" class="swiper-slide red-slide">';
                        hnHTML += '<a href="javascript:doNothing();" class="swiper-slide red-slide">';
                    } else {
                        html += '<a href="' + togoLink + 'date=' + searchdate + '&time=' + slotlist.time + '" class="swiper-slide red-slide">';
                        hnHTML += '<a href="' + togoLink + 'date=' + searchdate + '&time=' + slotlist.time + '" class="swiper-slide red-slide">';
                    }
                    html += '<div class="home-slot-time normal-font font-weight-bold">' + slotlist.time.replace(".", ":") + '</div>';
                    html += '<div class="home-slot-discount"><h1 class="font-weight-bold"><span>-</span>' + slotlist.detail.discount + '</h1></div>';
                    html += '<div class="home-slot-discount-pc">%</div><div class="home-slot-off">off</div></a>';

                    hnHTML += '<div class="home-slot-time normal-font font-weight-bold">' + slotlist.time.replace(".", ":") + '</div>';
                    hnHTML += '<div class="home-slot-discount"><h1 class="font-weight-bold"><span>-</span>' + slotlist.detail.discount + '</h1></div>';
                    hnHTML += '<div class="home-slot-discount-pc">%</div><div class="home-slot-off">off</div></a>';
                } else if (slotlist.detail.status == 'close') {
                    html += '<a href="javascript:doNothing();" class="swiper-slide home-close-slide ' + lang + '"></a>';
                    hnHTML += '<a href="javascript:doNothing();" class="swiper-slide home-close-slide ' + lang + '"></a>';
                } else if (slotlist.detail.status == 'soldout') {
                    html += '<a href="javascript:doNothing();" class="swiper-slide home-soldout-slide"></a>';
                    hnHTML += '<a href="javascript:doNothing();" class="swiper-slide home-soldout-slide"></a>';
                }
            });
        }
        html += '</div></div></div></div>';
        html += '<div  class="box-banner-bottom" style="display:none;"><center><img src="' + basePath + '/themes/default/images/index/eatigo_icon.png"></center></div></div>';

        LocationData[i] = Array(item.lat, item.lon, hnHTML, item.timeSlot[0].detail.discount, item.name);
        swipperHN(i, 'hn');
        i++;
    });

    if ((lat != '') && (lon != '')) {
        var maLocation = Array();
        maLocation[0] = Array(lat, lon, '<div class="box-banner-bottom-hnm-here">You are here.</div>', 0, 'You are here.');
        LocationData = $.merge(maLocation, LocationData);
    }
    if (html) {
        $('#search-result').html(html);
    } else {
        var s_txt = 'no restaurants';
        if (lang == 'th') {
            s_txt = 'ไม่มีร้านอาหาร';
        } else if (lang == 'zh') {
            var s_txt = '沒有餐廳';
        }
        $('#search-result').html('<center><h1>' + s_txt + '</h1></center>');
    }

    $('.search-waiting').hide();
    $('#search-result').show();
    $.each(result, function (index, item) {
        swipperHN(index, 'hn');
    });
    $('#h-result').html(i);
    $("img.lazy").lazyload({
        effect: "fadeIn"
    });
}

