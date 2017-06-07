var popdeal = Array();
var hereAndNow = Array();
var deatdealPage = 1;
var error_txt = 'Oops! Something went wrong, Please try again later.';
var LocationData = Array();
var search_result = Array();
var fillter_result = Array();
var recommTOTAL = 0;
var recomm_st1_all = Array();
var bestdealTOTAL = 0;
var bestdeal = Array();
var mostFamousTOTAL = 0;
var mostFamous = Array();
var newonTOTAL = 0;
var newon = Array();
var mostBookedTOTAL = 0;
var mostBooked = Array();
var aroundmeTOTAL = 0;
var aroundme = Array();

var search_cuisine = Array();
var search_atmosphere = Array();
var search_area = Array();
var search_neighborhood = Array();
var search_deals = Array();
var search_price = Array();
var search_rating = Array();

var html_cuisine = '';
var html_atmosphere = '';
var html_search_area = '';
var html_deals = '';
var html_price = '';
var html_price_img = '';
var html_rating = '';
var html_rating_img = '';

var cuisine_active = 1;
var location_active = 1;

var cuisine_count = 0;
var location_count = 0;
var month_th = ['', 'ม.ค.', 'ก.พ.', 'มี.ค.', 'เม.ย.', 'พ.ค.', 'มิ.ย.', 'ก.ค.', 'ส.ค.', 'ก.ย.', 'ต.ค.', 'พ.ย.', 'ธ.ค.'];
var month_zh = ['', '一月', '二月', '三月', '四月', '五月', '六月', '七月', '八月', '九月', '十月', '十一月', '十二月'];
var month_en = ["", "jan", "feb", "mar", "apr", "may", "jun", "jul", "aug", "sep", "oct", "nov", "dec"];

var txt_search = '';

function doNothing() {
}

function donothing() {
}

function grouploadmore(page) {
    var url = basePath + '/' + countryCodeAlias + '/' + lang + '/' + city_select_alias + '/category/';
    var data = {
        page: page
    };
    var html = '';
    var count = 0;
    var total = 0;

    $('#bdm-img-resto-group').show();
    $.post(url, data, function (Data) {

        var total = parseInt(Data.items.total);

        if (Data.status == 200) {
            $.each(Data.items.item, function (index, items) {
                if (items.imgm != 'https://static.eatigo.com/' && items.imgm != '') {
                    html += '<div class="home-recom-wrap">';
                    html += '<a class="home-group-img" href="' + basePath + '/' + countryCodeAlias + '/' + lang + '/' + city_select_alias + '/category/id/' + items.id + '/?from=' + from + '">';

                    html += '<div class="home-group-img lazy" style="background:url(' + items.imgm + ') center no-repeat;background-size:cover;"></div>';
                    html += '<div class="group-resto-name">';
                    html += '<div class="name-txt"><h2>' + items.name + '</h2></div>';
                    html += '<div class="total-txt small-font">' + items.total + ' ' + txt_resto + '</div>';
                    html += '</div>';
                    html += '</a>';
                    html += '</div>';
                    count++;
                }
            });
        }
        if (html) {
            $('#group-resto-list').append(html);
        }
        var p = parseInt(12 * page);

        if (p < total) {
            $('#loadmore-group-resto').html('<div class="home-box-loadmore" id="loadmore-group-resto"><a href="javascript:void(0);" onClick="grouploadmore(' + (page + 1) + ');$(\'#loadmore-group-resto\').hide();" class="btn-home-more"><h2>+' + btn_more + '</h2></a></div>');
            $('#loadmore-group-resto').show();
        }
        setTimeout(function () {
            $('#bdm-img-resto-group').hide();
        }, 200);
    }, 'json');
}

function usersubscribe() {
    var email = $('#email-subscribe').val();
    var regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    var url = basePath + '/' + countryCodeAlias + '/' + lang + '/usersubscribe/';
    if (!regex.test(email)) {
        if (lang == 'th') {
            alert('กรุณากรอกอีเมลให้ถูกต้องด้วยนะค่ะ!');
        } else if (lang == 'zh') {
            alert('無效的郵件地址');
        } else {
            alert('Invalid email address');
        }
    } else {
        var data = {
            email: email
        };
        $.post(url, data, function (Data) {
            console.log(Data);
            if (Data.status == 200) {
                $('#email-subscribe').val('');
            }
            alert(Data.items);
        }, 'json');
    }
}


$(document).ready(function () {
    $("#searchbar").keyup(function () {
        alert($("#searchbar").val());
    });
    $('.slides').bxSlider({
        controls: true,
        nextText: 'Next',
        prevText: 'Prev',
        animation: "slide",
        auto: true,
        speed: 1000,
        pause: 5000,
        touchEnabled: true,
        captions: true
    });

    $('.test_slider').bxSlider({
        auto: true,
        pager: false,
        width: 620,
        speed: 1000,
        pause: 8000,
        infiniteLoop: false,
        touchEnabled: true,
        randomStart: true,
        controls: true,
        nextText: 'Next',
        prevText: 'Prev'
    });


    $.getScript('//connect.facebook.net/en_UK/all.js', function () {
        FB.init({
            appId: '788361524525617',
            status: true,
            xfbml: true
        });
        FB.Event.subscribe('auth.statusChange', function () {
            FB.getLoginStatus(function (response) {
            }, true);
        });
    });
    if ((action == 'hereandnow')) {
        getLocation();
    } else if (action == 'search') {
        var location = $('.location').val();

        if ((location == 'สถานที่ของฉัน') || (location == 'My location')) {
            navigator.geolocation.getCurrentPosition(function (position) {
                lat = position.coords.latitude;
                lon = position.coords.longitude;

            }, showError);
        } else {

            goNewSearch();
        }
    }
});

function getLocation() {
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(showPosition, showError);
    } else {
        showError();
    }
}

function showPosition(position) {
    lat = position.coords.latitude;
    lon = position.coords.longitude;

    if (lat && lon) {
        if (action == 'hereandnow') {
            goHereAndNow();
        } else if (action == 'search') {
            if (mapDown == 1) {
                initializeHN(LocationData);
                $(".content_map").fadeIn('slow');
                $(".down_map").hide();
                $(".up_map").show();
                $('#closemap').removeClass('active');
                $('#openmap').addClass('active');
            }
        } else if (action == 'index') {
            moreRacomm('6', '30', 'yes');
        }
    } else {
        showError();
    }
}

function showError(error) {
    var url = apiURL + 'location/?jsoncallback=?';

    $.ajax({
        url: url,
        type: "GET",
        dataType: "jsonp",

        success: function (jsonData) {
            if (jsonData) {
                lat = jsonData[0];
                lon = jsonData[1];
                if (action == 'hereandnow') {
                    goHereAndNow();
                } else if (action == 'search') {
                    if (mapDown == 1) {
                        initializeHN(LocationData);

                        $(".down_map").hide();
                        $(".up_map").show();
                        $('#closemap').removeClass('active');
                        $('#openmap').addClass('active');
                    }
                } else if (action == 'index') {
                    moreRacomm('6', '12', 'yes');
                }
            } else {
                getLocation()
            }
        },
        error: function (e) {
            getLocation()
        }
    });
}

function loadBG(viewportWidth) {
    var iBig = 'big';
    if (viewportWidth > 1024) {
        iBig = 'big';
    } else {
        iBig = '1024';
    }
    var html = '';
    html += '<div style="background:url(' + host + 'themes/default/images/slider/' + countryCode + '/' + iBig + '/01.jpg) center;" class="home-bg"></div>';
    html += '<div style="background:url(' + host + 'themes/default/images/slider/' + countryCode + '/' + iBig + '/02.jpg) center;" class="home-bg"></div>';
    html += '<div style="background:url(' + host + 'themes/default/images/slider/' + countryCode + '/' + iBig + '/03.jpg) center;" class="home-bg"></div>';
    $('#bxslider').html(html);

}

function resize() {
    $(window).resize(function () {
        viewportWidth = $(window).width();
        loadBG(viewportWidth);
    });
}

function swipper(k, pp, i) {
    var mySwiper = new Swiper('#timeslot-' + i + '-' + k, {
        slidesPerView: 3,
        speed: 500,
        freeMode: true,
        freeModeFluid: true,
        grabCursor: true
    })
    $('#arrow-left-' + i + '-' + k).on('click', function (e) {
        e.preventDefault();
        mySwiper.swipePrev();
    })
    $('#arrow-right-' + i + '-' + k).on('click', function (e) {
        e.preventDefault();
        mySwiper.swipeNext();
    })
    mySwiper.swipeTo(pp, 200, true);
}

$(function () {
    $("#header-change-lang").overlay({
        mask: {
            color: '#000',
            loadSpeed: 200,
            opacity: 0.5
        },
        top: '25%',
        opacity: 0.8
    });
});

function getPOP() {
    if (popdeal.length != 0) {
        popHTML(popdeal);
    } else {
        var url = apiURL + 'recommended/lat//lon//time/' + time + '/rc/yes/page/1/pp/21/?jsoncallback=?';

        $.ajax({
            url: url,
            type: "GET",
            dataType: "jsonp",

            success: function (jsonData) {
                if (jsonData.status == 200) {
                    popdeal = jsonData.items;
                    popHTML(popdeal);
                } else {

                }
            },
            error: function (e) {

            }
        });
    }
}

function popHTML(json) {
    var html = '';
    $.each(json, function (index, item) {
        html += '<div class="home-recom-wrap" id="resto-id-' + item.resto_id + '">';
        if (item.day == 1) {
            var td = today;
        } else {
            var td = tomorrow;
        }
        var togoLink = '';
        if (from) {
            togoLink = basePath + '/' + countryCodeAlias + '/' + lang + '/' + city_select_alias + '/restaurant/name/' + item.name_url + '/?from=' + from + '&';
        } else {
            togoLink = basePath + '/' + countryCodeAlias + '/' + lang + '/' + city_select_alias + '/restaurant/name/' + item.name_url + '/?';
        }
        html += '<a class="recom-box-img" href="' + togoLink + 'date=' + td + '&time=' + time + '"';
        html += '>';

        if (item.imgm != 'https://static.eatigo.com/') {
            html += '<img class="recom-box-img lazy" data-original="' + item.imgm + '" />';
        } else {
            html += '<img class="recom-box-img lazy" data-original="' + item.restoImg + '" />';
        }
        html += '<div class="logo-resto" style="background:url(' + item.logo + ') no-repeat;"></div>';

        if (item.new == 'yes') {
            if (lang == 'th') {
                html += '<div class="home-new-' + lang + '">ใหม่</div>';
            } else if (lang == 'zh') {
                html += '<div class="home-new-' + lang + '">新</div>';
            } else {
                html += '<div class="home-new-' + lang + '">new</div>';
            }

        }

        if (item.day > 1) {
            html += '<div class="home-p1">';
            html += ' +' + home_p1;
            html += '</div>';
        }

        if (item.booked_count > 0) {
            var bc = addCommas(item.booked_count);
            if (item.day > 1) {
                html += '<div class="home-p1" style="right: 75px;">';
            } else {
                html += '<div class="home-p1">';
            }
            if (lang == 'th') {
                html += bc + ' ' + booking_made;
            } else {

                if (item.booked_count == 1) {
                    html += bc + ' ' + booking_made;
                } else {
                    html += bc + ' ' + bookings_made;
                }

            }
            html += '</div>';
        }

        html += '</a>';
        html += '<div class="float-left">';
        html += '<div class="box-detail">';

        html += '<div class="box-detail-name"><a href="' + togoLink + 'date=' + td + '&time=' + time + '"><h2 class="font-weight-bold">' + item.name + '</h2></a></div>';
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

        html += '<div class="device">';
        html += '<a class="arrow-left" id="arrow-left-1-' + index + '" href="javascript:doNothing();"></a>';
        html += '<a class="arrow-right" id="arrow-right-1-' + index + '" href="javascript:doNothing();"></a>';
        html += '<div class="swiper-container" id="timeslot-1-' + index + '">';
        html += '<div class="swiper-wrapper">';
        if (item.timeSlot.length == 1) {
            html += '<a href="' + togoLink + 'date=' + td + '&time=' + item.timeSlot[0].time + '" class="swiper-slide red-slide">';
            html += '<div class="home-slot-time normal-font font-weight-bold">' + item.timeSlot[0].time.replace(".", ":") + '</div>';
            html += '<div class="home-slot-discount"><h1 class="font-weight-bold"><span>-</span>' + item.timeSlot[0].detail.discount + '</h1></div>';
            html += '<div class="home-slot-discount-pc">%</div><div class="home-slot-off">off</div></a>';
            html += '<a href="javascript:doNothing();" class="swiper-slide home-close-slide ' + lang + '"></a><a href="javascript:doNothing();" class="swiper-slide home-close-slide ' + lang + '"></a>';
        } else if (item.timeSlot.length == 2) {
            $.each(item.timeSlot, function (index2, slotlist) {
                html += '<a href="' + togoLink + 'date=' + td + '&time=' + slotlist.time + '" class="swiper-slide red-slide">';
                html += '<div class="home-slot-time normal-font font-weight-bold">' + slotlist.time.replace(".", ":") + '</div>';
                html += '<div class="home-slot-discount"><h1 class="font-weight-bold"><span>-</span>' + slotlist.detail.discount + '</h1></div>';
                html += '<div class="home-slot-discount-pc">%</div><div class="home-slot-off">off</div></a>';
            });
            html += '<a href="javascript:doNothing();" class="swiper-slide home-close-slide ' + lang + '"></a>';
        } else {
            $.each(item.timeSlot, function (index2, slotlist) {
                html += '<a href="' + togoLink + 'date=' + td + '&time=' + slotlist.time + '" class="swiper-slide red-slide">';
                html += '<div class="home-slot-time normal-font font-weight-bold">' + slotlist.time.replace(".", ":") + '</div>';
                html += '<div class="home-slot-discount"><h1 class="font-weight-bold"><span>-</span>' + slotlist.detail.discount + '</h1></div>';
                html += '<div class="home-slot-discount-pc">%</div><div class="home-slot-off">off</div></a>';
            });
        }
        html += '</div></div></div></div>';
        html += '<div  class="box-banner-bottom" style="display:none;"><center><img src="' + basePath + '/themes/default/images/index/eatigo_icon.png"></center></div></div>';
    });
    $('#pop-deal').html(html);
    $.each(json, function (index, item) {
        var pp2 = 0;
        $.each(item.timeSlot, function (index2, slotlist) {
            if (slotlist.index == 1) {
                pp2 = index2;
            }
        });
        swipper(index, pp2, '1');
    });
    $("img.lazy").lazyload({
        effect: "fadeIn"
    });
}

var mTop = 0;
function openTopMenu() {

    if (mTop == 0) {
        mTop = 1;
        $('.btn-group').toggle();
    } else {
        mTop = 0;
        $('.btn-group').hide();
    }
}

//detail page
function detailMore(t) {
    if (t == 1) {
        $(".moreDetail").fadeToggle();
        $(".shotDetail").hide();
        $(".moreDetail").show();
        $("#detailLess").show();
    } else {
        $(".shotDetail").fadeToggle();
        $(".moreDetail").hide();
        $(".shotDetail").show();
    }
}

function menuMore() {
    $(".hide_menu").fadeToggle();
    $("#btn_menu_list_more").hide();
    $(".more-menu-resto").show();
    $("#btn_menu_more_list_h").show();
}

function menuHide() {
    $(".hide_menu").fadeToggle();
    $("#btn_menu_more_list_h").hide();
    $(".more-menu-resto").hide();
    $("#btn_menu_list_more").show();
}

//favorite
function doFav() {
    $("#notfavorite").hide();
    $("#favorite").show();
    makeFav('yes');
}

function noFav() {
    $("#favorite").hide();
    $("#notfavorite").show();
    makeFav('no');
}


$("#notfavorite").click(function () {
    $("#notfavorite").hide();
    $("#favorite").show();
    makeFav('yes');
});

$("#favorite").click(function () {
    $("#favorite").hide();
    $("#notfavorite").show();
    makeFav('no');
});

function facebookAutoLogin() {
    FB.api('/me', function (response) {
        if (response.email) {
            var email = escape(response.email);
            var url = apiURL + 'login/email/' + email + '/fbAccessToken/' + FB.getAuthResponse()['accessToken'] + '/fbUserID/' + response.id + '/?jsoncallback=?';

            $.ajax({
                url: url,
                type: "GET",
                dataType: "jsonp",

                success: function (jsonData) {
                    if (jsonData.status == 200) {
                        //make session
                        var fb_img = 'https://graph.facebook.com/' + response.id + '/picture';
                        makeSession(jsonData.items.id, jsonData.items.userType, jsonData.items.userFirstName, response.id, jsonData, jsonData.items.user_lang);
                    } else {
                        regis(response.first_name, email, FB.getAuthResponse()['accessToken'], response.id);
                    }
                },
                error: function (e) {

                }
            });
        } else {
            if (response.id && FB.getAuthResponse()['accessToken']) {
                var url = apiURL + 'login/email/' + response.id + '@facebook.com/fbAccessToken/' + FB.getAuthResponse()['accessToken'] + '/fbUserID/' + response.id + '/?jsoncallback=?';
                $.ajax({
                    url: url,
                    type: "GET",
                    dataType: "jsonp",

                    success: function (jsonData) {
                        if (jsonData.status == 200) {
                            //make session
                            var fb_img = 'https://graph.facebook.com/' + response.id + '/picture';
                            makeSession(jsonData.items.id, jsonData.items.userType, jsonData.items.userFirstName, response.id, jsonData, jsonData.items.user_lang);
                        } else {
                            regis(response.name, response.id + '@facebook.com', FB.getAuthResponse()['accessToken'], response.id);
                        }
                    },
                    error: function (e) {

                    }
                });
            }
        }
    });
}

function regis(name, email, fbAccessToken, fbUserID) {
    var email = escape(email);
    name = name.replace(' ', '');
    var url = apiURL + 'regis/fname/' + name + '/lname//email/' + email + '/fbAccessToken/' + fbAccessToken + '/fbUserID/' + fbUserID + '/uPassword//gender//?jsoncallback=?';


    $.ajax({
        url: url,
        type: "GET",
        dataType: "jsonp",

        success: function (jsonData) {
            if (jsonData.status == 200) {
                facebookAutoLogin();
            }
        },
        error: function (e) {
        }
    });
}

$.loginFb = function () {
    if(!FB) {
        return;
    }
    $('#login-loader').show();
    FB.login(function (loginResponse) {
        if (loginResponse.status == 'connected' && loginResponse.authResponse != null) {
            facebookAutoLogin();
        }
    }, {
        scope: 'email,user_birthday'
    });
};

function makeSession(id, userType, name, fb_img, userDetail, uLang) {
    if (uLang == '2') {
        uLang = 'th';
    } else if (uLang == '1') {
        uLang = 'en';
    } else {
        uLang = uLang;
    }
    $('#uid').val(id);
    $('#promocode-box').show();
    $('#promocode-box').show();
    var href = '';
    if (from) {
        href = basePath + '/' + countryCodeAlias + '/' + uLang + '/' + city_select_alias + '/user/?from=' + from;
    } else {
        href = basePath + '/' + countryCodeAlias + '/' + uLang + '/' + city_select_alias + '/user/';
    }

    var src = 'https://graph.facebook.com/' + fb_img + '/picture';

    var html = '<a href="' + href + '" id="header-user" target="_top" title="' + name + '"><img id="header-userPicHeader" class="header-userPicHeader" src="' +
         src + '" alt="' + name + '" onerror="var blankImgPath = \''+basePath+'/themes/default/images/index/img-blank.jpg\'; if(this.src != blankImgPath) this.src = blankImgPath;"></a>';
    $('#head-login').html(html);
    $('#head-login').show();

    $(".nolog,.facebook_icon").hide();
    $('.box-login-regis').html(html);
    var url = basePath + '/index/makesessionbyemail/fb_img/' + fb_img + '/';
    $.ajax({
        url: url,
        type: "POST",
        data: userDetail,
        dataType: "json",
        success: function (html) {
            if (action == 'login' || action == 'register') {
                if (countryCode == 'th') {
                    window.location.replace(href);
                } else {
                    window.location.replace(href);
                }
            }
        },
        error: function (e) {
        }
    });
}

function getBestDeal() {
    if (bestdeal.length != 0) {
        bestDealHTML(bestdeal, bestdealTOTAL);
    } else {
        var url = apiURL + 'recommended/lat//lon//time/' + time + '/rc//page/1/pp/21/?jsoncallback=?';

        $.ajax({
            url: url,
            type: "GET",
            dataType: "jsonp",

            success: function (jsonData) {
                if (jsonData.status == 200) {
                    bestdealTOTAL = jsonData.total;
                    bestdeal = jsonData.items;
                    deatdealPage = deatdealPage + 1;
                    bestDealHTML(bestdeal, bestdealTOTAL);
                } else {

                }
            },
            error: function (e) {

            }
        });
    }
}

function bestDealHTML(jsonBD, bestdealTOTAL) {
    var html = '';
    $.each(jsonBD, function (index, item) {
        html += '<div class="home-recom-wrap" id="resto-id-' + item.resto_id + '">';
        if (item.day == 1) {
            var td = today;
        } else {
            var td = tomorrow;
        }
        var togoLink = '';
        if (from) {
            togoLink = basePath + '/' + countryCodeAlias + '/' + lang + '/' + city_select_alias + '/restaurant/name/' + item.name_url + '/?from=' + from + '&';
        } else {
            togoLink = basePath + '/' + countryCodeAlias + '/' + lang + '/' + city_select_alias + '/restaurant/name/' + item.name_url + '/?';
        }
        html += '<a class="recom-box-img" href="' + togoLink + 'date=' + td + '&time=' + time + '"';
        html += '>';

        if (item.imgm != 'https://static.eatigo.com/') {
            html += '<img class="recom-box-img lazy" data-original="' + item.imgm + '" />';
        } else {
            html += '<img class="recom-box-img lazy" data-original="' + item.restoImg + '" />';
        }
        html += '<div class="logo-resto" style="background:url(' + item.logo + ') no-repeat;"></div>';

        if (item.new == 'yes') {
            if (lang == 'th') {
                html += '<div class="home-new-' + lang + '">ใหม่</div>';
            } else if (lang == 'zh') {
                html += '<div class="home-new-' + lang + '">新</div>';
            } else {
                html += '<div class="home-new-' + lang + '">new</div>';
            }
        }

        if (item.day > 1) {
            html += '<div class="home-p1">';
            html += ' +' + home_p1;
            html += '</div>';
        }

        if (item.booked_count > 0) {
            var bc = addCommas(item.booked_count);
            if (item.day > 1) {
                html += '<div class="home-p1" style="right: 75px;">';
            } else {
                html += '<div class="home-p1">';
            }
            if (lang == 'th') {
                html += bc + ' ' + booking_made;
            } else {

                if (item.booked_count == 1) {
                    html += bc + ' ' + booking_made;
                } else {
                    html += bc + ' ' + bookings_made;
                }

            }
            html += '</div>';
        }

        html += '</a>';
        html += '<div class="float-left">';

        html += '<div class="box-detail">';
        html += '<div class="box-detail-name"><a href="' + togoLink + 'date=' + td + '&time=' + time + '"><h2 class="font-weight-bold">' + item.name + '</h2></a></div>';
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

        html += '<div class="device">';
        html += '<a class="arrow-left" id="arrow-left-2-' + index + '" href="javascript:doNothing();"></a>';
        html += '<a class="arrow-right" id="arrow-right-2-' + index + '" href="javascript:doNothing();"></a>';
        html += '<div class="swiper-container" id="timeslot-2-' + index + '">';
        html += '<div class="swiper-wrapper">';

        if (item.timeSlot.length == 1) {
            html += '<a href="' + togoLink + 'date=' + td + '&time=' + item.timeSlot[0].time + '" class="swiper-slide red-slide">';
            html += '<div class="home-slot-time normal-font font-weight-bold">' + item.timeSlot[0].time.replace(".", ":") + '</div>';
            html += '<div class="home-slot-discount"><h1 class="font-weight-bold"><span>-</span>' + item.timeSlot[0].detail.discount + '</h1></div>';
            html += '<div class="home-slot-discount-pc">%</div><div class="home-slot-off">off</div></a>';
            html += '<a href="javascript:doNothing();" class="swiper-slide home-close-slide ' + lang + '"></a><a href="javascript:doNothing();" class="swiper-slide home-close-slide ' + lang + '"></a>';
        } else if (item.timeSlot.length == 2) {
            $.each(item.timeSlot, function (index2, slotlist) {
                html += '<a href="' + togoLink + 'date=' + td + '&time=' + slotlist.time + '" class="swiper-slide red-slide">';
                html += '<div class="home-slot-time normal-font font-weight-bold">' + slotlist.time.replace(".", ":") + '</div>';
                html += '<div class="home-slot-discount"><h1 class="font-weight-bold"><span>-</span>' + slotlist.detail.discount + '</h1></div>';
                html += '<div class="home-slot-discount-pc">%</div><div class="home-slot-off">off</div></a>';
            });
            html += '<a href="javascript:doNothing();" class="swiper-slide home-close-slide ' + lang + '"></a>';
        } else {
            $.each(item.timeSlot, function (index2, slotlist) {
                html += '<a href="' + togoLink + 'date=' + td + '&time=' + slotlist.time + '" class="swiper-slide red-slide">';
                html += '<div class="home-slot-time normal-font font-weight-bold">' + slotlist.time.replace(".", ":") + '</div>';
                html += '<div class="home-slot-discount"><h1 class="font-weight-bold"><span>-</span>' + slotlist.detail.discount + '</h1></div>';
                html += '<div class="home-slot-discount-pc">%</div><div class="home-slot-off">off</div></a>';
            });
        }
        html += '</div></div></div></div>';
        html += '<div  class="box-banner-bottom" style="display:none;"><center><img src="' + basePath + '/themes/default/images/index/eatigo_icon.png"></center></div></div>';
    });

    if (jsonBD.length < bestdealTOTAL) {
        var txt_more = 'more';
        if (lang == 'th') {
            txt_more = 'เพิ่มเติม';
        } else if (lang == 'zh') {
            txt_more = '更多';
        }
        html += '<a href="javascript:doNothing();" onClick="moreBestDeal();" class="more-resto">' + txt_more + '</a>';
    }
    $('#home-best-deal').html(html);

    $.each(jsonBD, function (index, item) {
        var pp2 = 1;
        $.each(item.timeSlot, function (index2, slotlist) {
            if (slotlist.index == 1) {
                pp2 = index2;
            }
        });
        swipper(index, pp2, '2');
    });
    $("img.lazy").lazyload({
        effect: "fadeIn"
    });
}

function moreBestDeal() {
    $("#bdm-img").show();
    $(".more-resto").hide();
    var url = apiURL + 'recommended/lat//lon//time/' + time + '/rc//page/1/pp/100/?jsoncallback=?';

    $.ajax({
        url: url,
        type: "GET",
        dataType: "jsonp",
        success: function (jsonData) {
            if (jsonData.status == 200) {
                bestdealTOTAL = jsonData.total;
                bestdeal = jsonData.items;
                $("#bdm-img").hide();
                bestDealHTML(bestdeal, bestdealTOTAL);
            } else {

            }
        },
        error: function (e) {

        }
    });
}

function addHomePopup() {
    var name = document.getElementById('name').value;
    var email = document.getElementById('email').value;
    var emailFormat = isValidEmail(email);
    if (name.length == 0) {
        document.getElementById('name').style.background = '#F00';
        document.getElementById('name').focus();
        return false;
    } else if (email.length == 0) {
        document.getElementById('email').style.background = '#F00';
        document.getElementById('email').focus();
        return false;
    } else if (emailFormat == false) {
        document.getElementById('email').style.background = '#F00';
        document.getElementById('email').focus();
        return false;
    } else {
        document.getElementById('name').style.background = '#FFF';
        document.getElementById('email').style.background = '#FFF';

        var url = basePath + '/index/addhomepopup/name/' + name + '/email/' + email + '/lang/' + lang + '/';
        $.ajax({
            url: url,
            type: "GET",

            success: function (html) {

            },
            error: function (e) {
            }
        });
        close_popup();
    }
}

function close_popup() {

    var url = basePath + '/index/makesessionbyjavascript/';
    $.ajax({
        url: url,
        type: "GET",

        success: function (html) {

        },
        error: function (e) {
            alert(e);
        }
    });
}

function checkPopup() {
    $('#popup').hide();

}

function isValidEmail(str) {
    var filter = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i
    return (filter.test(str));
}

$(function () {

    $("a[rel]").overlay({
        mask: {
            color: '#000',
            loadSpeed: 10,
            opacity: 0.5
        },
        opacity: 0.5,
        speed: 700,
        onBeforeLoad: function () {
            var wrap = this.getOverlay().find(".contentWrap");
            wrap.load(this.getTrigger().attr("href"));
            $('body').scrollTop(0);
        },
        onBeforeClose: function () {
            $('.contentWrap').html('');
        }
    });
    $('#closevideo').click(function () {
        $('.contentWrap').html('');
    });
});

function toggleBounce() {
    if (marker.getAnimation() != null) {
        marker.setAnimation(null);
    } else {
        marker.setAnimation(google.maps.Animation.BOUNCE);
    }
}

//detail
function showTooltip(sr) {
    if (sr == 0) {
        sr = 1;
        $('#detail-tooltip').show();

    } else {
        $('#detail-tooltip').hide();

    }
}

function makeFav(act) {
    var rid = document.getElementById('rid').value;
    var uid = document.getElementById('uid').value;
    if (act == 'no') {
        var url = apiURL + 'delFav/id/' + uid + '/rid/' + rid + '/lang/' + lang + '/?jsoncallback=?';
        $.ajax({
            url: url,
            type: "GET",
            dataType: "jsonp",

            success: function (jsonData) {
            },
            error: function (e) {

            }
        });
    } else {
        var url = apiURL + 'makeFav/id/' + uid + '/rid/' + rid + '/lang/' + lang + '/?jsoncallback=?';
        $.ajax({
            url: url,
            type: "GET",
            dataType: "jsonp",

            success: function (jsonData) {
            },
            error: function (e) {

            }
        });
    }
}

function showPR(sr) {
    if (sr == 0) {
        sr = 1;
        $('#detail-pr').show();

    } else {
        sr = 0;
        $('#detail-pr').hide();

    }
}

function changeDCprice(c, v) {
    var pc = v;
    var m = c;
    var p = 0;
    var price = 0;
    var nprice = 0;

    for (var i = 0; i < m; i++) {
        p = document.getElementById("menu-price-" + i).value;
        price = (pc * p) / 100;
        nprice = p - price;
        if (isNaN(nprice)) {
            document.getElementById("menu-dc-" + i).innerHTML = 0;
        } else {
            nprice = nprice.toString();
            var inin = nprice.indexOf('.');
            if (inin) {
                var n = nprice.split(".");
                var n0 = n[0].toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                var n1 = n[1];
                if (n1) {
                    nprice = n0 + '.' + n1.substring(0, 2);
                } else {
                    nprice = n0;
                }
            } else {
                nprice = nprice.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
            }
            document.getElementById("menu-dc-" + i).innerHTML = nprice;
        }
    }
}

function goHereAndNow() {
    $(".bar_result").hide();
    $(".content_map").hide();
    $(".down_map").hide();
    $(".testimonial").hide();
    $(".han-a-game-box").hide();
    $("#hn-map").hide();
    $('#h-result').html('0');
    if (lang == 'th') {
        var rTxt = 'กำลังค้นหาดีลใกล้ตัวคุณ...';
    } else {
        var rTxt = 'finding the best deals around you...';
    }

    var time = document.getElementById('time').value;
    var ppl = document.getElementById('ppl').value;
    var url = apiURL + 'search/stype/2/date/' + today + '/time/' + time + '/ppl/' + ppl + '/partner/2,17/lat/' + lat + '/lon/' + lon + '/sortby/5/page/1/pp/9/?jsoncallback=?';

    $.ajax({
        url: url,
        type: "GET",
        dataType: "jsonp",

        success: function (jsonData) {
            if (jsonData.status == 200) {
                if (jsonData.items != 'no result') {
                    $(".content_map").show();
                    //$(".han-a-game-box").show();
                    hereAndNow = jsonData.items;
                    hereandnowHTML(hereAndNow, lat, lon);
                } else {
                    $('#h-result').html('0');
                    if (lang == 'th') {
                        var txt = 'ยังไม่มีร้านอาหารใกล้คุณ ณ ช่วงเวลานี้ ลองทำการค้นหาร้านอาหารอีกครั้ง <a href=\"' + basePath + '/' + countryCodeAlias + '/' + lang + '/search/date/' + tomorrow + '/time/10.00/from/' + from + '/\" style="color:#F00; font-weight:bold;"> ที่นี้ </a>';
                    } else if (lang == 'zh') {
                        var txt = "很抱歉，我們目前沒有找到任何餐廳。 您可以使用不同時間或日期搜索可用的餐廳 <a href=\"" + basePath + "/" + countryCodeAlias + "/" + lang + "/search/date/" + tomorrow + "/time/10.00/country/from/" + from + "/\" style=\"color:#F00; font-weight:bold;\"> 搜索頁面 </a> .";
                    } else {
                        var txt = "We're sorry, we did not find any restaurant available at this time. You may search for available restaurant at a different time or day, using our <a href=\"" + basePath + "/" + countryCodeAlias + "/" + lang + "/search/date/" + tomorrow + "/time/10.00/country/from/" + from + "/\" style=\"color:#F00; font-weight:bold;\"> search page </a> .";
                    }

                    var html = txt;
                    $(".up_map").hide();
                    $('#hereAnow').html(html);

                    $("#hn-map").hide();
                    $(".down_map").hide();
                    $(".testimonial").hide();
                    $(".han-a-game-box").hide();
                }
            } else {

                $('#h-result').html('0');
                if (lang == 'th') {
                    var txt = 'ยังไม่มีร้านอาหารใกล้คุณ ณ ช่วงเวลานี้ ลองทำการค้นหาร้านอาหารอีกครั้ง <a href=\"' + basePath + '/' + countryCodeAlias + '/' + lang + '/search/date/' + tomorrow + '/time/10.00/country/from/' + from + '/\" style="color:#F00; font-weight:bold;"> ที่นี้ </a>';
                } else if (lang == 'zh') {
                    var txt = "很抱歉，我們目前沒有找到任何餐廳，您可以在不同的時間或日期搜索可用的餐廳，使用我們的 <a href=\"" + basePath + "/" + countryCodeAlias + "/" + lang + "/search/date/" + tomorrow + "/time/10.00/from/" + from + "/\" style=\"color:#F00; font-weight:bold;\"> 搜索页面 </a> .";
                } else {
                    var txt = "We're sorry, we did not find any restaurant available at this time. You may search for available restaurant at a different time or day, using our <a href=\"" + basePath + "/" + countryCodeAlias + "/" + lang + "/search/date/" + tomorrow + "/time/10.00/from/" + from + "/\" style=\"color:#F00; font-weight:bold;\"> search page </a> .";
                }
                $(".up_map").hide();
                var html = txt;
                $("#hereAnow").css("padding-top", "100px");
                $("#hereAnow").css("padding-bottom", "100px");
                $('#hereAnow').html(html);

                $("#hn-map").hide();
                $(".down_map").hide();
                $(".testimonial").hide();
                $(".han-a-game-box").hide();
            }
        },
        error: function (e) {
            $('#h-result').html('0');
            if (lang == 'th') {
                var txt = 'ยังไม่มีร้านอาหารใกล้คุณ ณ ช่วงเวลานี้';
            } else if (lang == 'zh') {
                var txt = "很抱歉，我們在您的位置附近沒有找到任何餐廳。";
            } else {
                var txt = "We're sorry, we did not find any restaurant near your location.";
            }

            var html = txt;
            $('#hereAnow').html(html);

            $("#hn-map").hide();
            $(".content_map").hide();
            $(".testimonial").hide();
            $(".han-a-game-box").hide();
        }
    });
    //}
}

function hereandnowHTML(json, lat, lon) {
    if (lang == 'th') {
        var rTxt = 'กำลังจัดเรียงร้านอาหาร...';
    } else if (lang == 'zh') {
        var rTxt = '根據您的位置排序餐廳...';
    } else {
        var rTxt = 'sorting restaurants by your location...';
    }
    $('.image-loder-han').html(rTxt);
    var LocationData = Array();
    $('#h-result').html(json.length);

    var html = '';
    $.each(json, function (index, item) {
        var togoLink = '';
        if (from) {
            togoLink = basePath + '/' + countryCodeAlias + '/' + lang + '/' + city_select_alias + '/restaurant/name/' + item.name_url + '/?from=' + from + '&source=here-and-now';
        } else {
            togoLink = basePath + '/' + countryCodeAlias + '/' + lang + '/' + city_select_alias + '/restaurant/name/' + item.name_url + '/?source=here-and-now';
        }
        var hnHTML = '';
        html += '<div class="home-recom-wrap" id="resto-id-' + item.resto_id + '">';
        hnHTML += '<div class="home-recom-wrap-han">';
        var td = today;
        html += '<a class="recom-box-img" href="' + togoLink + '&date=' + td + '&time=' + time + '"';
        hnHTML += '<a class="recom-box-img-han" style="background:url(' + item.img + ') no-repeat; background-size:cover;" href="' + togoLink + '&date=' + td + '&time=' + time + '"';
        html += '>';
        hnHTML += '>';

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

        if (item.new == 'yes') {
            if (lang == 'th') {
                html += '<div class="home-new-' + lang + '">ใหม่</div>';
                hnHTML += '<div class="home-new-' + lang + '">ใหม่</div>';
            } else if (lang == 'zh') {
                html += '<div class="home-new-' + lang + '">新</div>';
                hnHTML += '<div class="home-new-' + lang + '">新</div>';
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
        html += '<div class="box-detail-name"><a href="' + togoLink + '&date=' + td + '&time=' + time + '"><h2 class="font-weight-bold">' + item.name + '</h2></a></div>';
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
        hnHTML += '<div class="box-detail-name"><a href="' + togoLink + '&date=' + td + '&time=' + time + '"><h2 class="font-weight-bold">' + item.name + '</h2></a></div>';
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
        html += '<div class="swiper-wrapper">';
        hnHTML += '<div class="swiper-wrapper">';
        if (item.timeSlot.length == 1) {
            if (item.timeSlot[0].detail.status == 'open') {
                html += '<a href="' + togoLink + '&date=' + td + '&time=' + item.timeSlot[0].time + '" class="swiper-slide red-slide">';
                hnHTML += '<a href="' + togoLink + '&date=' + td + '&time=' + item.timeSlot[0].time + '" class="swiper-slide red-slide">';
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
                    html += '<a href="' + togoLink + '&date=' + td + '&time=' + slotlist.time + '" class="swiper-slide red-slide">';
                    html += '<div class="home-slot-time normal-font font-weight-bold">' + slotlist.time.replace(".", ":") + '</div>';
                    html += '<div class="home-slot-discount"><h1 class="font-weight-bold"><span>-</span>' + slotlist.detail.discount + '</h1></div>';
                    html += '<div class="home-slot-discount-pc">%</div><div class="home-slot-off">off</div></a>';

                    hnHTML += '<a href="' + togoLink + '&date=' + td + '&time=' + slotlist.time + '" class="swiper-slide red-slide">';
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
                    html += '<a href="' + togoLink + '&date=' + td + '&time=' + slotlist.time + '" class="swiper-slide red-slide">';
                    html += '<div class="home-slot-time normal-font font-weight-bold">' + slotlist.time.replace(".", ":") + '</div>';
                    html += '<div class="home-slot-discount"><h1 class="font-weight-bold"><span>-</span>' + slotlist.detail.discount + '</h1></div>';
                    html += '<div class="home-slot-discount-pc">%</div><div class="home-slot-off">off</div></a>';

                    hnHTML += '<a href="' + togoLink + '&date=' + td + '&time=' + slotlist.time + '" class="swiper-slide red-slide">';
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
    var maLocation = Array();
    maLocation[0] = Array(lat, lon, '<div class="box-banner-bottom-hnm-here">You are here.</div>', 0, 'You are here.');
    LocationData = $.merge(maLocation, LocationData);
    $('#hereAnow').html(html);

    $('#loadmore').show();

    $.each(json, function (index, item) {
        swipperHN(index, 'hn');
    });
    $("#hn-map").show();
    initializeHN(LocationData);
    $(".down_map").hide();
    $("img.lazy").lazyload({
        effect: "fadeIn"
    });
    setTimeout(function () {
        $(".testimonial").show();
    }, 3000);
    $(".bar_result").show();
}

function swipperHN(k, i) {
    var mySwiper = new Swiper('#timeslot-' + i + '-' + k, {
        slidesPerView: 3,
        speed: 500,
        freeMode: true,
        freeModeFluid: true,
        grabCursor: true
    });
    $('#arrow-left-' + i + '-' + k).on('click', function (e) {
        e.preventDefault();
        mySwiper.swipePrev();
    });

    $('#arrow-right-' + i + '-' + k).on('click', function (e) {
        e.preventDefault();
        mySwiper.swipeNext();
    })
}

function show_game_box(s) {
    if (s == 1) {
        $(".han-a-game-box").show();
    } else {
        $(".han-a-game-box").hide();
    }
}

function open_game_box() {
    $(".han-a-game-box").hide();
    $(".han-game-box").show();
    goGame();
}

function close_game_box() {
    $(".han-game-box").hide();
}

var game_array = Array();
var game_result = Array();
function goGame() {
    $("#game-1").removeClass("no-han-a-game-box");
    $("#game-1").addClass("no-han-a-game-box-active");
    var url = apiURL + 'gameQuestion/?jsoncallback=?';

    $.ajax({
        url: url,
        type: "GET",
        dataType: "jsonp",

        success: function (jsonData) {
            if (jsonData.status == 200) {
                game_array = jsonData.items;
                gameHTML(jsonData.items, lat, lon);
            } else {

            }
        },
        error: function (e) {

        }
    });
}

var game = 0;
function gameHTML(jsonData, lat, lon) {
    var html = '';
    $.each(jsonData, function (index, item) {
        if (index == game) {
            $.each(item, function (k, ilist) {
                html += '<img src="' + ilist.img_web + '" class="han-game-img" alt=' + ilist.value + ' onClick="getGresult(' + ilist.questionID + ');" />';
            });
        }
    });
    $(".game-html").html(html);
}

function getGresult(id) {
    game = game + 1;

    if (game < 3) {
        game_result.push(id);

        for (var i = 1; i < 4; i++) {
            $("#game-" + game).removeClass("no-han-a-game-box-active");
            $("#game-" + game).addClass("no-han-a-game-box");
        }
        $("#game-" + (game + 1)).removeClass("no-han-a-game-box");
        $("#game-" + (game + 1)).addClass("no-han-a-game-box-active");
        gameHTML(game_array, lat, lon);
    } else {
        game_result.push(id);
        var html = '<img src="' + basePath + '/themes/default/images/widget/1/loading_bar.gif" class="image-loder" alt="loading..." />';
        $(".game-html").html(html);
        var url = apiURL + 'gameResult/lat/' + lat + '/lon/' + lon + '/time/' + time + '/gId/' + game_result + '/page/1/pp/15/?jsoncallback=?';

        $.ajax({
            url: url,
            type: "GET",
            dataType: "jsonp",

            success: function (jsonData) {
                if (jsonData.status == 200) {
                    game_array = Array();
                    game_result = Array();
                    $(".han-a-game-box").hide();
                    $(".han-game-box").hide();
                    $("#hereAnow").html(html);
                    $("#hn-map").hide();
                    game = 0;
                    hereandnowHTML(jsonData.items, lat, lon);
                } else {

                }
            },
            error: function (e) {

            }
        });
    }
}

/*--detail--*/
function show_help() {
    var location = $('.location').val();
    if (location) {
        $('.helf_text1').hide();
    } else {
        $('.helf_text1').show();
    }
}

function autocomplate(key) {
    var search_txt = $('.location').val();

    if (search_txt == null)
        search_txt = '';
    if ((search_txt == 'สถานที่ของฉัน') || (search_txt == 'My location') || (search_txt == '')) {
        stype = 2;
    } else {
        stype = 1;
    }
    var url = apiURL + 'autocomplete/search/' + search_txt + '/?jsoncallback=?';

    $.ajax({
        url: url,
        type: "GET",
        dataType: "jsonp",

        success: function (jsonData) {
            if (jsonData.status == 200) {
                autocomplateHTML(jsonData.items, key);

            } else {

            }
        },
        error: function (e) {

        }
    });
}

function remove_help() {
    $('.helf_text1').hide();
    $('.location').focus();
}

function autocomplateHTML(json, key) {
    var html = '';
    if (json.city != null) {
        if (json.city.city != 'no') {
            if (lang == 'th') {
                var city_txt = 'เมือง';
            } else if (lang == 'zh') {
                var city_txt = '城市';
            } else {
                var city_txt = 'City';
            }
            html += '<li class="ui-autocomplete-category City_cat"><strong>' + city_txt + '</strong></li>';
            $.each(json.city.item, function (index, item) {
                html += '<li class="ui-menu-item" aria-label="' + city_txt + '" role="presentation"><a href="javascript:changeStype(\'3\', \'' + item.id + '\');" class="li_hover ui-corner-all" id="city-id-' + index + '" tabindex="-1" onClick="putInbox(\'' + item.name + '\');" onMouseOver="listHover( \'city-id-' + index + '\', \'1\');"" onMouseOut="listHover(\'city-id-' + index + '\', \'0\')">' + item.name + '</a></li>';
            });
        }
    }

    if (json.area != null) {
        if (json.area.area != 'no') {
            if (lang == 'th') {
                var area_txt = 'เขต';
            } else if (lang == 'zh') {
                var area_txt = '區域';
            } else {
                var area_txt = 'Area';
            }

            html += '<li class="ui-autocomplete-category City_cat"><strong>' + area_txt + '</strong></li>';
            $.each(json.area.item, function (index, item) {
                html += '<li class="ui-menu-item" aria-label="' + area_txt + '"  role="presentation"><a href="javascript:changeStype(\'4\', \'' + item.id + '\');" class="li_hover ui-corner-all" id="area-id-' + index + '" tabindex="-1" onClick="putInbox(\'' + item.name + '\');" onMouseOver="listHover( \'area-id-' + index + '\', \'1\');"" onMouseOut="listHover(\'area-id-' + index + '\', \'0\')">' + item.name + '</a></li>';
            });
        }
    }

    if (json.neighborhood != null) {
        if (json.neighborhood.neighborhood != 'no') {
            if (lang == 'th') {
                var neighborhood_txt = 'พื้นที่';
            } else if (lang == 'zh') {
                var neighborhood_txt = '附近';
            } else {
                var neighborhood_txt = 'Neighborhood';
            }

            html += '<li class="ui-autocomplete-category City_cat"><strong>' + neighborhood_txt + '</strong></li>';
            $.each(json.neighborhood.item, function (index, item) {
                html += '<li class="ui-menu-item" aria-label="' + neighborhood_txt + '"  role="presentation"><a href="javascript:changeStype(\'5\', \'' + item.id + '\');" class="li_hover ui-corner-all" id="neighborhood-id-' + index + '" tabindex="-1" onClick="putInbox(\'' + item.name + '\');" onMouseOver="listHover( \'neighborhood-id-' + index + '\', \'1\');"" onMouseOut="listHover(\'neighborhood-id-' + index + '\', \'0\')">' + item.name + '</a></li>';
            });
        }
    }

    if (json.cuisine != null) {
        if (json.cuisine.cuisine != 'no') {
            if (lang == 'th') {
                var cuisine_txt = 'ประเภทอาหาร';
            } else if (lang == 'zh') {
                var cuisine_txt = '美食';
            } else {
                var cuisine_txt = 'Cuisine';
            }

            html += '<li class="ui-autocomplete-category City_cat"><strong>' + cuisine_txt + '</strong></li>';
            $.each(json.cuisine.item, function (index, item) {
                html += '<li class="ui-menu-item" aria-label="' + cuisine_txt + '"  role="presentation"><a href="javascript:changeStype(\'6\', \'' + item.id + '\');" class="li_hover ui-corner-all" id="cuisine-id-' + index + '" tabindex="-1" onClick="putInbox(\'' + item.name + '\');" onMouseOver="listHover( \'cuisine-id-' + index + '\', \'1\');"" onMouseOut="listHover(\'cuisine-id-' + index + '\', \'0\')">' + item.name + '</a></li>';
            });
        }
    }

    if (json.restaurant != null) {
        if (json.restaurant.restaurant != 'no') {
            if (lang == 'th') {
                var restaurant_txt = 'ร้านอาหาร';
            } else if (lang == 'zh') {
                var restaurant_txt = '餐廳';
            } else {
                var restaurant_txt = 'Restaurants';
            }

            html += '<li class="ui-autocomplete-category City_cat"><strong>' + restaurant_txt + '</strong></li>';
            $.each(json.restaurant.item, function (index, item) {
                var togoLink = '';
                if (from) {
                    togoLink = basePath + '/' + countryCodeAlias + '/' + lang + '/' + city_select_alias + '/restaurant/name/' + item.name_url + '/?from=' + from;
                } else {
                    togoLink = basePath + '/' + countryCodeAlias + '/' + lang + '/' + city_select_alias + '/restaurant/name/' + item.name_url + '/';
                }
                html += '<li class="ui-menu-item" aria-label="' + restaurant_txt + '"  role="presentation"><a href="' + togoLink + '" class="li_hover ui-corner-all" id="restaurant-id-' + index + '" tabindex="-1" onMouseOver="listHover( \'restaurant-id-' + index + '\', \'1\');"" onMouseOut="listHover(\'restaurant-id-' + index + '\', \'0\')">' + item.name + '</a></li>';
            });
        }
    }

    if (key == 'search') {
        $('#serch').html(html);
        var x = $(".location").offset().left;
        var y = $(".location").offset().top + 50;
        $("#serch").css("left", x);
        $("#serch").css("top", y);
        $("#serch").css("left", x);
        $("#serch").css("top", y);
        $('#serch').css({
            'display': 'block'
        });
        $('#location').html(html);
    } else {
        $('#serchhead').html(html);
        var x = $("#searchbar").offset().left;
        var y = $("#searchbar").offset().top + 30;
        $("#serchhead").css("left", x);
        $("#serchhead").css("top", y);
        $("#serchhead").css("left", x);
        $("#serchhead").css("top", y);
        $('#serchhead').css({
            'display': 'block'
        });
        $('#searchbar').html(html);

    }
}

function changeStype(st, ssid) {
    stype = st;
    sid = ssid;
}

function putInbox(txt) {
    $(".location,#search.search-query").trigger('click');
    $(".location").val(txt);
    $('#serch').css({
        'display': 'none'
    });
    $("#searchbar,#serchhead.search-query").trigger('click');
    $('#serchhead').css({
        'display': 'none'
    });
    $("#searchbar").focus();
}

function listHover(id, t) {
    if (t == 1) {
        $('#' + id).addClass('ui-state-focus');
    } else {
        $('#' + id).removeClass('ui-state-focus');
    }
}

function goSearch() {
    if (lang == 'th') {
        var rTxt = 'กำลังติดต่อร้านอาหาร...';
    } else if (lang == 'zh') {
        var rTxt = '聯繫餐廳...';
    } else {
        var rTxt = 'contacting restaurants...';
    }

    $('.image-loder-han').html(rTxt);
    $(".search_fields").hide();
    $(".bar_result").hide();
    $('#serch').css({
        'display': 'none'
    });
    LocationData = Array();
    $('.search-waiting').show();
    $('#search-result').hide();
    $(".testimonial").hide();

    $('#display-price').html('');
    $('#display-rating').html('');
    $('#display-deals').html('');
    $('#display-cuisine').html('');
    $('#display-checkboxlocation').html('');
    $('#display-atmosphere').html('');
    $(".filter-text").each(function () {
        $(this).remove();
    });
    $('.show-filter2').hide();
    $('#show-filter').hide();
    cuisine_array = Array();
    price_array = Array();
    rating_array = Array();
    area_array = Array();
    neighborhood_array = Array();
    deals_array = Array();
    atmosphere_array = Array();
    cfilter = 0;
    filmain = Array();

    var strDate = $('#date').val();
    var Date_ar = strDate.split(",");
    var dd = $.trim(Date_ar[0]);
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
    date = yy + '-' + mm + '-' + dd;

    if (search_today == date) {
        var time = $('#time2day').val();
    } else {
    }
    var time = $('#time2day').val();
    var ppl = $('#noofseats').val();
    var location = '';
    var cuis_c = 0;
    var loc_c = 0;

    if (search_text) {
        location = search_text;
        $(".cuisine_search").each(function () {
            var val = $(this).val();
            var id = $(this).attr("id");
            var n = location.indexOf(val);
            if (n != -1) {
                $('#' + id).prop('checked', true);
                cuis_c++;
            }
        });
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
    } else {
        var cuisine_ar = [];
        var location_ar = [];
        $(".cuisine_search:checked").each(function () {
            cuisine_ar.push($(this).val().split("/"));
            cuis_c++;
        });
        $(".location_search:checked").each(function () {
            location_ar.push($(this).val().split("/"));
            loc_c++;
        });
        location = $.merge(cuisine_ar, location_ar).toString();
    }

    if (cuisine_count == cuis_c) {
        $('#cuisine-all').prop('checked', true);
    }
    if (location_count == loc_c) {
        $('#location-all').prop('checked', true);
    }

    if (loc_c > 0) {

        if (loc_c > 1 && lang == 'en') {
            _location = _location + 's';
        }
        $('#txt-bylocation').html(loc_c + ' ' + _location);
    } else {
        $('#txt-bylocation').html(anylocation);
    }
    if (cuis_c > 0) {
        if (cuis_c > 1 && lang == 'en') {
            _cuisine = _cuisine + 's';
        }
        $('#txt-bycuisine').html(cuis_c + ' ' + _cuisine);
    } else {
        $('#txt-bycuisine').html(anycuisine);
    }

    if ((location == 'สถานที่ของฉัน') || (location == 'My location')) {
        stype = 2;
    }

    if (stype != 2) {
        lat = '';
        lon = '';

    }
    /******************* new  ****************/

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

    if (location != '') {
        if (from) {
            window.history.pushState("object or string", "Title", basePath + "/" + countryCodeAlias + "/" + lang + "/" + city_select_alias + "/search/search/" + location + "/?date=" + date + "&time=" + time + "&ppl=" + ppl + "&from=" + from + "");
        } else {
            window.history.pushState("object or string", "Title", basePath + "/" + countryCodeAlias + "/" + lang + "/" + city_select_alias + "/search/search/" + location + "/?date=" + date + "&time=" + time + "&ppl=" + ppl + "");
        }
    }

    var url = apiURL + 'search/?jsoncallback=?';

    if (location == '') {
        stype = 3;
    } else if ((location == 'สถานที่ของฉัน') || (location == 'My location')) {
        stype = 2;
    } else {
        stype = 1;
    }


    if (city_select == 'pattaya') {
        sid = 9;
    }
    var postData = {
        stype: stype,
        date: date,
        time: time,
        ppl: ppl,
        id: sid,
        sortby: sortby,
        lat: lat,
        lon: lon,
        search: location,
        page: '1',
        pp: '1000'
    };

    $.ajax({
        url: url,
        type: "POST",
        data: postData,
        dataType: "jsonp",
        crossDomain: true,

        success: function (jsonData) {
            if (jsonData.status == 200) {
                if (jsonData.items != 'no result') {
                    search_result = jsonData.items;
                    fillter_result = jsonData.items;
                    searchHTML(search_result, lat, lon);
                } else {
                    $('#h-result').html('0');
                    if (lang == 'th') {
                        if (location) {
                            var txt = 'เราไม่พบคำค้นหาของร้านอาหารที่คุณต้องการ : ' + location;
                        } else {
                            var txt = 'เราไม่พบคำค้นหาของร้านอาหารที่คุณต้องการ';
                        }
                    } else if (lang == 'zh') {
                        if (location) {
                            var txt = "很抱歉，我們沒有找到任何餐廳結果 : " + location;
                        } else {
                            var txt = "很抱歉，我們沒有找到任何餐廳結果";
                        }
                    } else {
                        if (location) {
                            var txt = "We're sorry, we did not find any restaurant results for : " + location;
                        } else {
                            var txt = "We're sorry, we did not find any restaurant results";
                        }
                    }

                    var html = txt;
                    $('#search-result').html(html);
                    $('.search-waiting').hide();
                    $('#search-result').show();
                    $(".testimonial").show();
                    up_map();
                }
            } else {
                $('#h-result').html('0');
                if (lang == 'th') {
                    if (location) {
                        var txt = 'เราไม่พบคำค้นหาของร้านอาหารที่คุณต้องการ : ' + location;
                    } else {
                        var txt = 'เราไม่พบคำค้นหาของร้านอาหารที่คุณต้องการ';
                    }
                } else if (lang == 'zh') {
                    if (location) {
                        var txt = "很抱歉，我們沒有找到任何餐廳結果 : " + location;
                    } else {
                        var txt = "很抱歉，我們沒有找到任何餐廳結果";
                    }
                } else {
                    if (location) {
                        var txt = "We're sorry, we did not find any restaurant results for : " + location;
                    } else {
                        var txt = "We're sorry, we did not find any restaurant results";
                    }
                }

                var html = txt;
                $('#search-result').html(html);
                $('.search-waiting').hide();
                $('#search-result').show();
                $(".testimonial").show();
                up_map();
            }
        },
        error: function (e) {
            $('#h-result').html('0');
            if (lang == 'th') {
                if (location) {
                    var txt = 'เราไม่พบคำค้นหาของร้านอาหารที่คุณต้องการ : ' + location;
                } else {
                    var txt = 'เราไม่พบคำค้นหาของร้านอาหารที่คุณต้องการ';
                }
            } else if (lang == 'zh') {
                if (location) {
                    var txt = "很抱歉，我們沒有找到任何餐廳結果 : " + location;
                } else {
                    var txt = "很抱歉，我們沒有找到任何餐廳結果";
                }
            } else {
                if (location) {
                    var txt = "We're sorry, we did not find any restaurant results for : " + location;
                } else {
                    var txt = "We're sorry, we did not find any restaurant results";
                }
            }

            var html = txt;
            $('#search-result').html(html);
            $('.search-waiting').hide();
            $('#search-result').show();
            $(".testimonial").show();
            up_map();
        }
    });

}

function changeSB() {
    sortby = $('#sortby').val();
    $('#rate-all,#price-all,#discount-all,#atmosphere-all').prop('checked', false);
    goNewSearch();

}

var cuisine_count = Array();
var rating_count = 0;
var price_count = 0;
var disc_count = 0;
var atmos_count = 0;

var rating_arr = Array();
var price_arr = Array();
var deals_arr = Array();
var atmos_arr = Array();

function searchHTML(json, lat, lon) {

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

    if (lang == 'th') {
        var rTxt = 'กำลังการเจรจาต่อรองส่วนลดสำหรับคุณ...';
        var lang_star = 'ดาว';
    } else if (lang == 'zh') {
        var rTxt = '正在為你談判打折...';
        var lang_star = '收藏';
    } else {
        var rTxt = 'negotiating discount for you...';
        var lang_star = 'star';
    }
    $('.image-loder-han').html(rTxt);
    $('#serch').css({
        'display': 'none'
    });
    $('.search-waiting').show();
    $('#search-result').hide();
    $(".testimonial").hide();

    var html = '';


    $.each(json, function (index, item) {
        var cIndex = search_cuisine.indexOf(item.cuisine);
        if (cIndex == -1)
            search_cuisine.push(item.cuisine);

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
            deals_arr.push(item);
        }

        var priceR = search_price.indexOf(item.priceRange);
        if (priceR == -1) {
            search_price.push(item.priceRange);
            price_arr.push(item);
        }

        var rat = search_rating.indexOf(parseInt(item.rating));
        if (rat == -1) {
            search_rating.push(parseInt(item.rating));
            rating_arr.push(item);
        }

        var hnHTML = '';
        html += '<div class="home-recom-wrap" id="resto-id-' + item.resto_id + '">';
        hnHTML += '<div class="home-recom-wrap-han">';
        var togoLink = '';
        if (from) {
            togoLink = basePath + '/' + countryCodeAlias + '/' + lang + '/' + city_select_alias + '/restaurant/name/' + item.name_url + '/?from=' + from + '&source=search';
        }
        else {
            togoLink = basePath + '/' + countryCodeAlias + '/' + lang + '/' + city_select_alias + '/restaurant/name/' + item.name_url + '/?source=search';
        }

        var td = $('#date').val();

        if (item.restaurantStatus == 'Coming-Soon') {
            html += '<div class="position-img"><a title="coming soon!" id="restaurant_img_2_146" href="' + togoLink + '&date=' + td + '&time=' + time + '" ><img alt="coming soon" src="' + basePath + '/themes/default/images/index/coming_soon.png"></a></div>';
        }

        if (item.restaurantStatus == 'Coming-Soon') {
            html += '<a class="recom-box-img comingsoon" href="javascript:doNothing();"';
            hnHTML += '<a class="recom-box-img-han" style="background:url(' + item.img + ') no-repeat; background-size:cover;" href="' + togoLink + '&date=' + td + '&time=' + time + '"';
            html += '>';
            hnHTML += '>';
        }
        else {
            html += '<a class="recom-box-img" href="' + togoLink + '&date=' + td + '&time=' + time + '" ';
            hnHTML += '<a class="recom-box-img-han" style="background:url(' + item.img + ') no-repeat; background-size:cover;" href="' + togoLink + '&date=' + td + '&time=' + time + '"';
            html += '>';
            hnHTML += '>';
        }

        if (item.imgm != 'https://static.eatigo.com/') {
            html += '<img class="recom-box-img lazy" data-original="' + item.imgm + '" />';
        }
        else {
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

        html += '<div class="box-detail-name"><a href="' + togoLink + '&date=' + td + '&time=' + time + '"><h2 class="font-weight-bold">' + item.name + '</h2></a></div>';
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

        hnHTML += '<div class="box-detail-name"><a href="' + togoLink + '&date=' + td + '&time=' + time + '"><h2 class="font-weight-bold">' + item.name + '</h2></a></div>';
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
                    html += '<a href="' + togoLink + '&date=' + td + '&time=' + item.timeSlot[0].time + '" class="swiper-slide red-slide">';
                    hnHTML += '<a href="' + togoLink + '&date=' + td + '&time=' + item.timeSlot[0].time + '" class="swiper-slide red-slide">';
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
                        html += '<a href="' + togoLink + '&date=' + td + '&time=' + slotlist.time + '" class="swiper-slide red-slide">';
                        hnHTML += '<a href="' + togoLink + '&date=' + td + '&time=' + slotlist.time + '" class="swiper-slide red-slide">';
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
                        html += '<a href="' + togoLink + '&date=' + td + '&time=' + slotlist.time + '" class="swiper-slide red-slide">';
                        hnHTML += '<a href="' + togoLink + '&date/' + td + '/time/' + slotlist.time + '" class="swiper-slide red-slide">';
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
    $(".testimonial").show();
    $('#h-result').html(json.length);

    $('#atmosphere-list').html(html_atmosphere);

    $('#deals-list').html(html_deals);

    $('#price-list').html(html_price);

    $('#rating-list').html(html_rating);


    if (mapDown == 1) {
        initializeHN(LocationData);
    }
    $(".bar_result").show();
    $(".search_fields").show();


    if (search_cuisine.length > 0) {
        $.each(search_cuisine, function (index1, item1) {
            count_cuisine = 0;
            $.each(json, function (index2, item2) {
                if (item1 == item2.cuisine) {
                    count_cuisine++;
                }
            });
            $('.cuisine-' + index1).html('( ' + count_cuisine + ' )');
        });
    }

    if (search_rating.length > 0) {
        $.each(search_rating, function (index1, item1) {
            count_rating = 0;
            $.each(json, function (index2, item2) {

                if (item1 == parseInt(item2.rating)) {
                    count_rating++;
                }
            });
            $('.rating-' + index1).html('( ' + count_rating + ' )');
        });
    }

    if (search_price.length > 0) {
        $.each(search_price, function (index1, item1) {
            count_price = 0;
            $.each(json, function (index2, item2) {
                if (item1 == parseInt(item2.priceRange)) {
                    count_price++;
                }
            });
            $('.price-' + index1).html('( ' + count_price + ' )');
        });
    }

    if (search_price.length > 0) {
        $.each(search_price, function (index1, item1) {
            count_price = 0;
            $.each(json, function (index2, item2) {
                if (item1 == parseInt(item2.priceRange)) {
                    count_price++;
                }
            });
            $('.price-' + index1).html('( ' + count_price + ' )');
        });
    }

    if (search_area.length > 0) {
        $.each(search_area, function (index1, item1) {
            count_area = 0;
            $.each(json, function (index2, item2) {
                if (item1 == item2.area) {
                    count_area++;
                }
            });
            $('.area-' + index1).html('( ' + count_area + ' )');
        });
    }

    if (search_deals.length > 0) {
        $.each(search_deals, function (index1, item1) {
            count_deals = 0;
            $.each(json, function (index2, item2) {
                if (item1 == item2.timeSlot[0].detail.discount) {
                    count_deals++;
                }
            });
            $('.deals-' + index1).html('( ' + count_deals + ' )');
        });
    }

    if (search_atmosphere.length > 0) {
        $.each(search_atmosphere, function (index1, item1) {
            count_atmosphere = 0;
            $.each(json, function (index2, item2) {
                $.each(item2.atmosphere, function (index_item_atmosphere, item_item_atmosphere) {
                    if (item1 == item_item_atmosphere.atmosphere) {
                        count_atmosphere++;
                    }
                });
            });
            $('.atmosphere-' + index1).html('( ' + count_atmosphere + ' )');
        });
    }

}

var mapDown = 0;
function down_map() {
    for (i = 0; i < 2; i++) {
        mapDown = 1;
        getLocation();
    }
}

function up_map() {
    $(".content_map").fadeOut('slow');
    $(".up_map").hide();
    $(".down_map").show()
    $('#closemap').addClass('active');
    $('#openmap').removeClass('active');
    mapDown = 0;
}

var cuisine_array = Array();
var price_array = Array();
var rating_array = Array();
var area_array = Array();
var neighborhood_array = Array();
var deals_array = Array();
var atmosphere_array = Array();
var cfilter = 0;
var filmain = Array();

var search_fillter = Array();

function onFilter_B(k, v) {

    var rate = $('.checkbox-box-fillter .rating:checked').length;
    var rate_t = $('.checkbox-box-fillter .rating').length;
    if (rate == rate_t && rate > 0) {
        $('#rate-all').prop('checked', true);
    } else {
        $('#rate-all').prop('checked', false);
    }

    var price = $('.checkbox-box-fillter .price:checked').length;
    var price_t = $('.checkbox-box-fillter .price').length;
    if (price == price_t && price > 0) {
        $('#price-all').prop('checked', true);
    } else {
        $('#price-all').prop('checked', false);
    }

    var disc = $('.checkbox-box-fillter .deals:checked').length;
    var disc_t = $('.checkbox-box-fillter .deals').length;
    if (disc == disc_t && disc > 0) {
        $('#discount-all').prop('checked', true);
    } else {
        $('#discount-all').prop('checked', false);
    }

    var atmosphere = $('.checkbox-box-fillter-atmos .atmosphere:checked').length;
    var atmosphere_t = $('.checkbox-box-fillter-atmos .atmosphere').length;
    if (atmosphere == atmosphere_t && atmosphere > 0) {
        $('#atmosphere-all').prop('checked', true);
    } else {
        $('#atmosphere-all').prop('checked', false);
    }


    if (k == 'cuisine') {

        var c = cuisine_array.indexOf(v);
        var ele = $('.cuisine').find('input');
        var cu = $('#display-cuisine').text();

        if (cu == 0) {
            cu = 0;
        }

        if (c < 0) {
            cfilter++;
            cuisine_array.push(v);
            cu++;
            $('#display-cuisine').html(cu);
            $('#show-filter2').before('<div class="filter-text cuisine"  data-type="' + k + '">' + v + '<span class="icon-del" onClick="onFilter(\'' + k + '\', \'' + v + '\');"></span></div>');
        } else {
            cuisine_array.splice(c, 1);
            $(".filter-text.cuisine").remove(':contains(\'' + v + '\')');
            $('input:checkbox[value="' + v + '"].cuisine').attr('checked', false);
            cfilter--;
            cu--;
            if (cu == 0) {
                $('#display-cuisine').html('');
            } else {
                $('#display-cuisine').html(cu);
            }

        }
    } else if (k == 'price') {

        var pc = $('#display-price').text();

        if (pc == 0) {
            pc = 0;
        }
        if (lang == 'th') {
            var pr = 'ราคา: ' + v + ' $';
        } else if (lang == 'zh') {
            var pr = '价格: ' + v + ' $';
        } else {
            var pr = 'price: ' + v + ' $';
        }
        var p = price_array.indexOf(v);
        if (p < 0) {
            cfilter++;
            price_array.push(v);
            pc++;
            $('#display-price').html(pc);
            $('#show-filter2').before('<div class="filter-text price"  data-type="' + k + '">' + pr + '<span class="icon-del" onClick="onFilter(\'' + k + '\', \'' + v + '\');"></span></div>');
        } else {
            pc--;
            price_array.splice(p, 1);
            $(".filter-text.price").remove(':contains(\'' + pr + '\')');
            $('input:checkbox[value="' + v + '"].price').attr('checked', false);

            if (pc == 0) {
                pc = 0;
                $('#display-price').html('');
            } else {
                $('#display-price').html(pc);
            }
            cfilter--;
        }
    } else if (k == 'rating') {

        var ra = $('#display-rating').text();

        if (ra == 0) {
            ra = 0;
        }
        if (lang == 'th') {
            var rat = 'ราคา: ' + v + ' ดาว';
        } else if (lang == 'zh') {
            var rat = '評分: ' + v + ' 星';
        } else {
            var rat = 'rating: ' + v + ' star';
        }

        var r = rating_array.indexOf(v);
        if (r < 0) {
            cfilter++;
            rating_array.push(v);
            ra++;
            $('#display-rating').html(ra);
            $('#show-filter2').before('<div class="filter-text rating"  data-type="' + k + '">' + rat + '<span class="icon-del" onClick="onFilter(\'' + k + '\', \'' + v + '\');"></span></div>');
        } else {
            rating_array.splice(r, 1);
            $(".filter-text.rating").remove(':contains(\'' + rat + '\')');
            $('input:checkbox[value="' + v + '"].rating').attr('checked', false);
            ra--;
            if (ra == 0) {
                ra = 0;
                $('#display-rating').html('');
            } else {
                $('#display-rating').html(ra);
            }
            cfilter--;
        }
    } else if (k == 'area') {

        var a = area_array.indexOf(v);
        var ar_nb = $('#display-checkboxlocation').text();

        if (ar_nb == 0) {
            ar_nb = 0;
        }

        if (a < 0) {
            ar_nb++;
            cfilter++;
            area_array.push(v);
            $('#display-checkboxlocation').html(ar_nb);
            $('#show-filter2').before('<div class="filter-text area"  data-type="' + k + '">' + v + '<span class="icon-del" onClick="onFilter(\'' + k + '\', \'' + v + '\');"></span></div>');
        } else {
            area_array.splice(a, 1);
            $(".filter-text.area").remove(':contains(\'' + v + '\')');
            $('input:checkbox[value="' + v + '"].area').attr('checked', false);
            cfilter--;
            ar_nb--;
            if (ar_nb == 0) {
                ar_nb = 0;
                $('#display-checkboxlocation').html('');
            } else {
                $('#display-checkboxlocation').html(ar_nb);
            }
        }
    } else if (k == 'neighborhood') {

        var n = neighborhood_array.indexOf(v);
        var ar_nb = $('#display-checkboxlocation').text();
        if (ar_nb == 0) {
            ar_nb = 0;
        }

        if (n < 0) {
            cfilter++;
            ar_nb++;
            neighborhood_array.push(v);
            $('#display-checkboxlocation').html(ar_nb);
            $('#show-filter2').before('<div class="filter-text neighborhood"  data-type="' + k + '">' + v + '<span class="icon-del" onClick="onFilter(\'' + k + '\', \'' + v + '\');"></span></div>');
        } else {
            neighborhood_array.splice(n, 1);
            $(".filter-text.neighborhood").remove(':contains(\'' + v + '\')');
            $('input:checkbox[value="' + v + '"].neighborhood').attr('checked', false);
            cfilter--;
            ar_nb--;
            if (ar_nb == 0) {
                ar_nb = 0;
                $('#display-checkboxlocation').html('');
            } else {
                $('#display-checkboxlocation').html(ar_nb);
            }
        }
    } else if (k == 'deals') {

        var de = $('#display-deals').text();

        if (de == 0) {
            de = 0;
        }
        if (lang == 'th') {
            var dea = 'ข้อเสนอ: ' + v + ' %';
        } else if (lang == 'zh') {
            var dea = '詳情: ' + v + ' %';
        } else {
            var dea = 'deals: ' + v + ' %';
        }

        var d = deals_array.indexOf(v);
        if (d < 0) {
            cfilter++;
            deals_array.push(v);
            de++;
            $('#display-deals').html(de);
            $('#show-filter2').before('<div class="filter-text deals" data-type="' + k + '">' + dea + '<span class="icon-del" onClick="onFilter(\'' + k + '\', \'' + v + '\');"></span></div>');
        } else {
            deals_array.splice(d, 1);
            $(".filter-text.deals").remove(':contains(\'' + dea + '\')');
            $('input:checkbox[value="' + v + '"].deals').attr('checked', false);
            de--;
            if (de == 0) {
                de = 0;
                $('#display-deals').html('');
            } else {
                $('#display-deals').html(de);
            }
            cfilter--;
        }
    } else if (k == 'atmosphere') {
        var atmo = $('#display-atmosphere').text();

        var ar = atmosphere_array.indexOf(v);
        if (ar < 0) {
            cfilter++;
            atmo++;
            atmosphere_array.push(v);
            $('#display-atmosphere').html(atmo);
            $('#show-filter2').before('<div class="filter-text" data-type="' + k + '">' + v + '<span class="icon-del" onClick="onFilter(\'' + k + '\', \'' + v + '\');"></span></div>');
        } else {
            atmosphere_array.splice(ar, 1);
            $(".filter-text").remove(':contains(\'' + v + '\')');
            $('input:checkbox[value="' + v + '"].atmosphere').attr('checked', false);
            cfilter--;
            atmo--;
            if (atmo == 0) {
                atmo = 0;
                $('#display-atmosphere').html('');
            } else {
                $('#display-atmosphere').html(atmo);
            }
        }
    }

    if ((cuisine_array.length == 0) && (price_array.length == 0) && (rating_array.length == 0) && (area_array.length == 0) && (neighborhood_array.length == 0) && (deals_array.length == 0) && (atmosphere_array.length == 0)) {
        searchHTML(search_result, lat, lon);
        $('.boxshow-filter').hide();
        cfilter = 0;
        filmain = Array();

    } else {
        tryFillter(k, v);
    }


}
var result = Array();

function refilter(k, v) {

    var rate = $('.checkbox-box-fillter .rating:checked').length;
    var price = $('.checkbox-box-fillter .price:checked').length;
    var disc = $('.checkbox-box-fillter .deals:checked').length;
    var atmosphere = $('.checkbox-box-fillter-atmos .atmosphere:checked').length;
    var sl = 0;

    if (rate > 0 || price > 0 || disc > 0 || atmosphere > 0) {
        sl = 1;
    }

    console.log(sl, result.length);

    if (sl == 0 && result.length > 0) {
        filterHTML(search_result, lat, lon, k, v);
    } else if (sl == 0 && result.length > 0) {
        filterHTML(result, lat, lon, k, v);
    } else if (sl == 1 && result.length > 0) {
        filterHTML(result, lat, lon, k, v);
    } else if (sl == 1 && result.length == 0) {
        filterHTML(search_result, lat, lon, k, v);
    } else if (sl == 0 && result.length == 0) {
        filterHTML(search_result, lat, lon, k, v);
    } else {
        filterHTML(search_result, lat, lon, k, v);
    }
    return false;
}

function tryFillter(k, v) {

    LocationData = Array();
    result = Array();
    if (cuisine_array.length != 0) {
        var c_result = Array();
        var i = 0;
        $.each(search_result, function (index, item) {
            var cIn = cuisine_array.indexOf(item.cuisine);
            if (cIn != -1) {
                c_result[i] = item;
                i++;
            }
        });
        result = c_result;
    }

    if (price_array.length != 0) {
        var p_result = Array();
        var i = 0;
        $.each(search_result, function (index, item) {
            var pIn = price_array.indexOf(item.priceRange);
            if (pIn != -1) {
                p_result[i] = item;
                i++;
            }
        });
        if (result.length != 0) {
            result = intersection(result, p_result);
        } else {
            result = p_result;
        }
    }

    if (rating_array.length != 0) {
        var r_result = Array();
        var i = 0;

        $.each(search_result, function (index, item) {
            var rIn = -1;
            $.each(rating_array, function (index_item_rating, item_item_rating) {
                if (item_item_rating == parseInt(item.rating)) {
                    r_result[i] = item;
                    i++;
                    return false;
                }

            });
        });
        if (result.length != 0) {
            result = intersection(result, r_result);
        } else {
            result = r_result;
        }
    }

    if (area_array.length != 0) {
        var a_result = Array();
        var i = 0;
        $.each(search_result, function (index, item) {
            var aIn = area_array.indexOf(item.area);
            if (aIn != -1) {
                a_result[i] = item;
                i++;
            }
        });
        if (result.length != 0) {
            result = intersection(result, a_result);
        } else {
            result = a_result;
        }
    }

    if (neighborhood_array.length != 0) {
        var n_result = Array();
        var i = 0;
        $.each(search_result, function (index, item) {
            var nIn = neighborhood_array.indexOf(item.neighborhood);
            if (nIn != -1) {
                n_result[i] = item;
                i++;
            }
        });
        if (result.length != 0) {
            result = intersection(result, n_result);
        } else {
            result = n_result;
        }
    }

    if (deals_array.length != 0) {
        var t_result = Array();
        var i = 0;

        $.each(search_result, function (index, item) {
            var tIn = -1;


            tIn = deals_array.indexOf(item.timeSlot[0].detail.discount);

            if (tIn != -1) {

                t_result[i] = item;
                i++;
            }
        });
        if (result.length != 0) {
            result = intersection(result, t_result);
        } else {
            result = t_result;
        }
    }

    if (atmosphere_array.length != 0) {
        var at_result = Array();
        var i = 0;
        $.each(search_result, function (index, item) {
            var atIn = -1;
            $.each(item.atmosphere, function (index_item_atmosphere, item_item_atmosphere) {
                atIn = atmosphere_array.indexOf(item_item_atmosphere.atmosphere);
                if (atIn != -1) {
                    at_result[i] = item;
                    i++;
                    return false;
                }
            });
        });
        if (result.length != 0) {
            result = intersection(result, at_result);
        } else {
            result = at_result;
        }
    }

    filterHTML(result, lat, lon, k, v);
}

function removeallfilter() {
    $('input:checkbox').removeAttr('checked');
    $('#display-price').html('');
    $('#display-rating').html('');
    $('#display-deals').html('');
    $('#display-cuisine').html('');
    $('#display-checkboxlocation').html('');
    $('#display-atmosphere').html('');
    $(".filter-text").each(function () {
        $(this).remove();
    });
    $('.show-filter2').hide();
    $('#show-filter').hide();
    searchHTML(search_result, lat, lon);
    cuisine_array = Array();
    price_array = Array();
    rating_array = Array();
    area_array = Array();
    neighborhood_array = Array();
    deals_array = Array();
    atmosphere_array = Array();
    cfilter = 0;
    filmain = Array();
}

function intersection(a, b) {
    var c = $(b).not($(b).not(a));

    return (c);
}

function filterHTML(result, lat, lon, k, v) {

    $('#search-result').hide();
    $(".testimonial").hide();
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
            html += '<div class="position-img"><a title="coming soon!" id="restaurant_img_2_146" href="' + togoLink + 'date=' + td + '&time=' + time + '" ><img alt="coming soon" src="' + basePath + '/themes/default/images/index/coming_soon.png"></a></div>';
        }
        var td = $('#date').val();
        if (item.restaurantStatus == 'Coming-Soon') {
            html += '<a class="recom-box-img comingsoon" href="javascript:doNothing();"';
            hnHTML += '<a class="recom-box-img-han" style="background:url(' + item.img + ') no-repeat; background-size:cover;" href="' + togoLink + 'date=' + td + '&time=' + time + '"';
            html += '>';
            hnHTML += '>';
        } else {
            html += '<a class="recom-box-img" href="' + togoLink + 'date=' + td + '&time=' + time + '"';
            hnHTML += '<a class="recom-box-img-han" style="background:url(' + item.img + ') no-repeat; background-size:cover;" href="' + togoLink + 'date=' + td + '&time=' + time + '"';
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

        if (item.new == 'yes') {
            html += '<div class="home-new-' + lang + '"></div>';
            hnHTML += '<div class="home-new-' + lang + '"></div>';

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

        html += '<div class="box-detail-name"><a href="' + togoLink + 'date=' + td + '&time=' + time + '"><h2 class="font-weight-bold">' + item.name + '</h2></a></div>';
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

        hnHTML += '<div class="box-detail-name"><a href="' + togoLink + 'date=' + td + '&time=' + time + '"><h2 class="font-weight-bold">' + item.name + '</h2></a></div>';
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
                    html += '<a href="' + togoLink + 'date=' + td + '&time=' + item.timeSlot[0].time + '" class="swiper-slide red-slide">';
                    hnHTML += '<a href="' + togoLink + 'date=' + td + '&time=' + item.timeSlot[0].time + '" class="swiper-slide red-slide">';
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
                        html += '<a href="' + togoLink + 'date=' + td + '&time=' + slotlist.time + '" class="swiper-slide red-slide">';
                        hnHTML += '<a href="' + togoLink + 'date=' + td + '&time=' + slotlist.time + '" class="swiper-slide red-slide">';
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
                        html += '<a href="' + togoLink + 'date=' + td + '&time=' + slotlist.time + '" class="swiper-slide red-slide">';
                        hnHTML += '<a href="' + togoLink + 'date=' + td + '&time=' + slotlist.time + '" class="swiper-slide red-slide">';
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
        if (lang == 'th')
            s_txt = 'ไม่มีร้านอาหาร';
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

    searchHTML2(result, lat, lon, k, v)
}

/****************************************** boy test ********************************************************/

function searchHTML2(json, lat, lon, filtermain, val) {

    var search_cuisine2 = Array();
    var search_atmosphere2 = Array();
    var search_area2 = Array();
    var search_neighborhood2 = Array();
    var search_deals2 = Array();
    var search_price2 = Array();
    var search_rating2 = Array();

    var html_cuisine2 = '';
    var html_atmosphere2 = '';
    var html_search_area2 = '';
    var html_deals2 = '';
    var html_price2 = '';
    var html_price_img2 = '';
    var html_rating2 = '';
    var html_rating_img2 = '';

    if (lang == 'th') {
        var lang_star = 'ดาว';
    } else {
        var lang_star = 'star';
    }

    var selects = new Array();
    $.each($('#show-filter .filter-text'), function (i, e) {
        selects.push($(e).data('type'));
    });


    var html = '';
    $.each(json, function (index, item) {
        var cIndex = search_cuisine2.indexOf(item.cuisine);

        if (cIndex == -1)
            search_cuisine2.push(item.cuisine);

        $.each(item.atmosphere, function (index_item_atmosphere, item_item_atmosphere) {
            var ap = search_atmosphere2.indexOf(item_item_atmosphere.atmosphere);
            if (ap == -1)
                search_atmosphere2.push(item_item_atmosphere.atmosphere);
        });

        var ar = search_area2.indexOf(item.area);
        if (ar == -1)
            search_area2.push(item.area);

        var ne = search_neighborhood2.indexOf(Array(item.area, item.neighborhood));
        if (ne == -1)
            search_neighborhood2.push(Array(item.area, item.neighborhood));

        var deal = search_deals2.indexOf(item.timeSlot[0].detail.discount);
        if (deal == -1)
            search_deals2.push(item.timeSlot[0].detail.discount);

        var priceR = search_price2.indexOf(item.priceRange);
        if (priceR == -1)
            search_price2.push(item.priceRange);

        var rat = search_rating2.indexOf(parseInt(item.rating));
        if (rat == -1)
            search_rating2.push(parseInt(item.rating));

    });

    if (html_atmosphere2 == '') {
        if (search_atmosphere2.length > 0) {
            search_atmosphere2.sort();
            search_atmosphere2.reverse();
            $.each(search_atmosphere2, function (index_atmosphere, item_atmosphere) {
                html_atmosphere2 += '<div class="checkbox-box-fillter-atmos">';
                html_atmosphere2 += '<input id="atmosphere' + index_atmosphere + '" onClick="onFilter(\'atmosphere\', \'' + item_atmosphere + '\');" type="checkbox" name="atmosphere[]" class="atmosphere" value="' + item_atmosphere + '">';
                html_atmosphere2 += '<label for="atmosphere' + index_atmosphere + '">' + item_atmosphere + '</label>';
                html_atmosphere2 += '</div>';
            });
        } else {
            html_atmosphere2 += '<div style="width:220px;">no filter for current search</div>';
        }
    }

    if (html_deals2 == '') {

        if (search_deals2.length > 0) {
            search_deals2.sort();
            search_deals2.reverse();
            $.each(search_deals2, function (index_deals, item_deals) {
                html_deals2 += '<div class="checkbox-box-fillter">';
                html_deals2 += '<input id="deals' + index_deals + '" onClick="onFilter(\'deals\', \'' + item_deals + '\');" type="checkbox" name="deals[]" class="deals" value="' + item_deals + '">';
                html_deals2 += '<label for="deals' + index_deals + '"><span>-' + item_deals + '</span>%</label>';
                html_deals2 += '</div>';
            });

        } else {
            html_deals2 += '<div style="width:220px;">no filter for current search</div>';
        }

    }

    if (html_rating2 == '') {

        if (search_rating2.length > 0) {
            search_rating2.sort();
            $.each(search_rating2, function (index_rating, item_rating) {

                var ret_percen = item_rating * 20;

                html_rating2 += '<div class="checkbox-box-fillter">';
                html_rating2 += '<input id="rating' + index_rating + '"  onClick="onFilter(\'rating\', \'' + item_rating + '\');" type="checkbox" name="rating[]" class="rating" value="' + item_rating + '">';
                html_rating2 += '<label for="rating' + index_rating + '">';
                html_rating2 += '<div class="box-fill-rating-white">';
                html_rating2 += '<div class="box-detail-rating-yellow2" style="width:' + ret_percen + '%;"></div>';
                html_rating2 += '</div>';
                html_rating2 += '</label>';
                html_rating2 += '</div>';

            });
        } else {
            html_rating2 += '<div style="width:220px;">no filter for current search</div>';
        }

    }

    if (html_price2 == '') {

        if (search_price2.length > 0) {

            search_price2.sort();

            $.each(search_price2, function (index_price, item_price) {

                html_price2 += '<div class="checkbox-box-fillter">';
                html_price2 += '<input id="price' + index_price + '" type="checkbox" name="price[]" class="price" onClick="onFilter(\'price\', \'' + item_price + '\');" value="' + item_price + '">';
                html_price2 += '<label for="price' + index_price + '">';
                for (var pri = 0; pri < item_price; pri++) {
                    html_price2 += '<img src="' + basePath + '/themes/default/images/detail/dollar_orange.png" alt="">';
                }
                html_price2 += '</label>';
                html_price2 += '</div>';

            });

        } else {
            html_price += '<div style="width:220px;">no filter for current search</div>';
        }

    }

    var is_area = false,
        is_atmosphere = false,
        is_cuisine = false;
    is_neighborhood = false;
    is_rating = false;
    is_price = false;
    is_deals = false;

    $.each(selects, function (i, v) {

        switch (v) {
            case'area':
                is_area = true;
                break;
            case'atmosphere':
                is_atmosphere = true;
                break;
            case'cuisine':
                is_cuisine = true;
                break;
            case'neighborhood':
                is_area = true;
                break;
            case'rating':
                is_rating = true;
                break;
            case'price':
                is_price = true;
                break;
            case'deals':
                is_deals = true;
                break;
        }
    });

    if (!is_area) {
        $('#location-list').html(html_search_area2);
    }
    if (!is_atmosphere) {
        $('#atmosphere-list').html(html_atmosphere2);
    }
    if (!is_cuisine) {
        $('#cuisine-list').html(html_cuisine2);
    }
    if (!is_rating) {
        $('#rating-list').html(html_rating2);
        $('#rating-list-img').html(html_rating_img2);
    }
    if (!is_deals) {
        $('#deals-list').html(html_deals2);
    }
    if (!is_price) {
        $('#price-list').html(html_price2);
        $('#price-list-img').html(html_price_img2);
    }


    if (search_cuisine2.length > 0 && !is_cuisine) {
        $.each(search_cuisine2, function (index1, item1) {
            count_cuisine = 0;
            $.each(json, function (index2, item2) {
                if (item1 == item2.cuisine) {
                    count_cuisine++;
                }
            });
            $('.cuisine-' + index1).html('( ' + count_cuisine + ' )');
        });
    }

    if (search_rating2.length > 0 && !is_rating) {

        $.each(search_rating2, function (index1, item1) {
            count_rating = 0;
            $.each(json, function (index2, item2) {

                if (item1 == parseInt(item2.rating)) {
                    count_rating++;
                }
            });
            $('.rating-' + index1).html('( ' + count_rating + ' )');

        });
    }

    if (search_price2.length > 0 && !is_price) {
        $.each(search_price2, function (index1, item1) {
            count_price = 0;
            $.each(json, function (index2, item2) {
                if (item1 == parseInt(item2.priceRange)) {
                    count_price++;
                }
            });
            $('.price-' + index1).html('( ' + count_price + ' )');
        });
    }

    if (search_area2.length > 0 && !is_area) {
        $.each(search_area2, function (index1, item1) {
            count_area = 0;
            $.each(json, function (index2, item2) {
                if (item1 == item2.area) {
                    count_area++;
                }
            });
            $('.area-' + index1).html('( ' + count_area + ' )');
        });
    }

    if (search_deals2.length > 0 && !is_deals) {
        $.each(search_deals2, function (index1, item1) {
            count_deals = 0;
            $.each(json, function (index2, item2) {
                if (item1 == item2.timeSlot[0].detail.discount) {
                    count_deals++;
                }
            });
            $('.deals-' + index1).html('( ' + count_deals + ' )');
        });
    }


    if (search_atmosphere2.length > 0 && !is_atmosphere) {
        $.each(search_atmosphere2, function (index1, item1) {
            count_atmosphere = 0;

            $.each(json, function (index2, item2) {
                $.each(item2.atmosphere, function (index_item_atmosphere, item_item_atmosphere) {
                    if (item1 == item_item_atmosphere.atmosphere) {
                        count_atmosphere++;
                    }
                });

            });

            $('.atmosphere-' + index1).html('( ' + count_atmosphere + ' )');
        });
    }

}

/**************************************************************************************************/

function changeSml() {
    getLocation();

    stype = 2;


    if (lang == 'th') {
        var html = 'สถานที่ของฉัน';
    } else if (lang == 'zh') {
        var html = '我的位置';
    } else {
        var html = 'My location';
    }
    $('#leble-search-list').hide();
    $('#leble-search-list').html('');

    $('.search-choice-close').trigger('click');
    $('.location').val(html);
    $("#autocom").val(html);
    $("#autocom").attr("placeholder", html);
    $(".default").val(html);

}

function checksession() {
    var url = basePath + '/index/getsession/?jsoncallback=?';
    $.get(url, function (data) {
        if (data == '1') {
            window.location.replace(basePath + '/' + countryCodeAlias + '/' + lang + '/' + city + '/');
        }
    });
}

/********************************** User Profile *****************************************/

function makeSessionByEamail(userDetail) {
    var url = basePath + '/index/makesessionbyemail/?jsoncallback=?';
    $.ajax({
        url: url,
        type: "POST",
        data: userDetail,
        dataType: "json",
        success: function (data) {

        },
        error: function (e) {
        }
    });

}

function arrayMonth(lang, m) {
    if (lang == 'th') {
        var month = new Array("ม.ค.", "ก.พ.", "มี.ค.", "เม.ย.", "พ.ค.", "มิ.ย.", "ก.ค.", "ส.ค.", "ก.ย.", "ต.ค.", "พ.ย.", "ธ.ค.");
    } else if (lang == 'zh') {
        var month = new Array("一月", "二月", "三月", "四月", "五月", "六月", "七月", "八月", "九月", "十月", "十一月", "十二月");
    } else {
        var month = new Array("Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec");
    }
    return (month[m]);
}

/**********************************  Login  *****************************************/
function loginEmail(email, pass) {
    var url = apiURL + 'loginByEmail/email/' + email + '/uPassword/' + pass + '/?jsoncallback=?';


    $.ajax({
        url: url,
        type: "GET",
        dataType: "json",

        success: function (jsonData) {

            if (jsonData.status == 200) {
                makeSessionByEamiil(jsonData.items.id, jsonData.items.userType, jsonData.items.userFirstName, jsonData.items.img, jsonData, jsonData.items.user_lang);
            } else {
                if (lang == 'th') {
                    alert('ชื่อผู้ใช้กับรหัสผ่านไม่ตรงกัน - กรุณาตรวจสอบและลองอีกครั้ง!');
                } else if (lang == 'zh') {
                    alert("用戶名或密碼不匹配 - 請檢查並重試！");
                } else {
                    alert("Username or Password don't match - Please check and try again!");
                }
                $('#login-loader').hide();
            }
        },
        error: function (e) {
            alert(error_txt);
            $('#login-loader').hide();
        }
    });
}

function checklogin() {
    $('#login-loader').show();
    var email = $('#frmUserEmail').val();
    var pass = $('#frmUserPassword').val();
    if (email == '') {
        if (lang == 'th') {
            alert('กรุณากรอกอีเมลด้วยนะค่ะ!');
        } else if (lang == 'zh') {
            alert('請輸入電子郵件地址');
        } else {
            alert('Please enter e-mail!');
        }
        $('#frmUserEmail').focus();
        $('#login-loader').hide();
        return false;
    } else if (pass == '') {
        if (lang == 'th') {
            alert('กรุณากรอกรหัสด้วยนะค่ะ!');
        } else if (lang == 'zh') {
            alert('請輸入密碼');
        } else {
            alert('Please enter password!');
        }
        $('#frmUserPassword').focus();
        $('#login-loader').hide();
        return false;
    } else {
        loginEmail(email, pass);
    }
}

function GetURLParameter(sParam) {
    var sPageURL = window.location.search.substring(1);
    var sURLVariables = sPageURL.split('&');
    for (var i = 0; i < sURLVariables.length; i++) {
        var sParameterName = sURLVariables[i].split('=');
        if (sParameterName[0] == sParam) {
            return sParameterName[1];
        }
    }
}

function makeSessionByEamiil(id, userType, name, img, userDetail, uLang) {
    if (uLang == '2') {
        uLang = 'th';
    } else if (uLang == '1') {
        uLang = 'en';
    } else {
        uLang = uLang;
    }
    var href = '';
    if (from) {
        href = basePath + '/' + countryCodeAlias + '/' + uLang + '/' + city_select_alias + '/user/?from=' + from;
    } else {
        href = basePath + '/' + countryCodeAlias + '/' + uLang + '/' + city_select_alias + '/user/';
    }
    $('#uid').val(id);
    $('#promocode-box').show();
    var html = '<a href="' + href + '" id="header-user" target="_top" title="' + name + '"><img id="header-userPicHeader" class="header-userPicHeader" src="' + img + '" alt="' + name + '" onerror="var blankImgPath =\''+basePath+'/themes/default/images/index/img-blank.jpg\'; if(this.src != blankImgPath) this.src = blankImgPath;"></a>';
    $('#head-login').html(html);
    $('#head-login').show();
    $(".nolog,.facebook_icon").hide();
    $('.box-login-regis').html(html);

    var url = basePath + '/index/makesessionbyemail/?jsoncallback=?';

    $.ajax({
        url: url,
        type: "POST",
        data: userDetail,
        success: function (data) {
            if (action == 'restaurant') {

                $('#overlaylogin').hide();
                if (userDetail.items.userPhone) {
                    if (userDetail.items.userPhone != null) {
                        document.getElementById("cell").disabled = true;
                        $('#cell').val(userDetail.items.userPhone);
                    }
                }

                if (userDetail.items.userPhoneCC) {
                    $('#cc').val(userDetail.items.userPhoneCC);
                }

                $('#email').val(userDetail.items.userEmail);
                $('#name').val(userDetail.items.userFirstName + ' ' + userDetail.items.userLastName);
                window.location.reload();

            } else {
                setTimeout(function () {
                    var redirect = GetURLParameter('redirect');
                    if (redirect) {
                        window.location.replace(decodeURIComponent(redirect));
                        return
                    }

                    if (!from) {
                        from = '';
                    }
                    if (!uLang) {
                        uLang = 'en';
                        if (countryCode == 'th') {
                            uLang = 'th';
                        } else if (countryCode == 'hk') {
                            uLang = 'zh';
                        }
                    }
                    window.location.replace(basePath + '/' + countryCodeAlias + '/' + uLang + '/' + city_select_alias + '/?from=' + from);
                }, 300);
            }

        },
        error: function (e) {
            $('#login-loader').hide();
        }
    });

}

function updatesession(url) {

    $.get(url, null, function (Data) {

    })
}

/*****************************************  resgister *************************************/

function randomString(len, charSet) {
    charSet = charSet || 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
    var randomString = '';
    for (var i = 0; i < len; i++) {
        var randomPoz = Math.floor(Math.random() * charSet.length);
        randomString += charSet.substring(randomPoz, randomPoz + 1);
    }
    return randomString;
}

function userregister() {
    $('#login-loader').show();
    var fname = $('#frmUserFirstName').val();
    var email = $('#frmUserEmail').val();
    var pass = $('#frmUserPassword').val();
    var confpass = $('#frmUserConfirmPassword').val();
    var regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    var passw = /^[A-Za-z0-9]\w{5,15}$/;
    var frmCaptch = $('#frmCaptch').val();
    var txtCaptcha = $('#txtCaptcha').val();
    if (fname == '') {
        if (lang == 'th') {
            alert('กรุณากรอกชื่อจริงด้วยนะค่ะ!');
        } else if (lang == 'zh') {
            alert('請輸入名字！');
        } else {
            alert('Please enter firstname !');
        }
        $('#frmUserFirstName').focus();
        $('#login-loader').hide();
        return false;
    }
    else if (!regex.test(email)) {
        if (lang == 'th') {
            alert('กรุณากรอกอีเมลให้ถูกต้องด้วยนะค่ะ!');
        } else if (lang == 'zh') {
            alert('無效的郵件地址 ！');
        } else {
            alert('Invalid Email Address !');
        }
        $('#login-loader').hide();
        $('#frmUserEmail').focus();
        return false;
    }
    else if (!pass.match(passw)) {
        if (lang == 'th') {
            alert('รหัสผ่านที่คุณป้อนไม่ถูกต้อง! รหัสผ่านของคุณจะต้อง 6-15 ตัวอักษร!');
        } else if (lang == 'zh') {
            alert("您輸入的密碼無效！您的密碼必須是6到15個字符");
        } else {
            alert("The password you have entered is not valid! , Your Password must be 6 to 15 Character");
        }
        $('#login-loader').hide();
        $('#frmUserPassword').focus();
        return false;
    }
    else if (!confpass.match(confpass)) {
        if (lang == 'th') {
            alert('รยืนยันรหัสผ่านที่คุณป้อนไม่ถูกต้อง !, ยืนยันรหัสผ่านของคุณจะต้อง 6-15 ตัวอักษร!');
        } else if (lang == 'zh') {
            alert("您輸入的確認密碼無效！您的確認密碼必須為6到15個字符");
        } else {
            alert("The confirm password you have entered is not valid!, Your confirm Password must be 6 to 15 Character");
        }
        $('#login-loader').hide();
        $('#frmUserConfirmPassword').focus();
        return false;
    }
    else if (pass != confpass) {
        if (lang == 'th') {
            alert('รหัสผ่านและการยืนยันรหัสผ่านเข้ากันไม่ได้โปรดลองอีกครั้ง!');
        } else if (lang == 'zh') {
            alert('密碼和確認密碼不相等，請重試！');
        } else {
            alert('Password and Confirm Password incompatible, please try again!');
        }
        $('#login-loader').hide();
        $('#frmUserConfirmPassword').focus();
        return false;
    }
    else if (frmCaptch != txtCaptcha) {
        alert('The confirmation code is incorrect, please try again!');
        $('#login-loader').hide();
        $('#frmCaptch').focus();
        return false;
    }
    else {
        var url = apiURL + 'regisByEmail/?jsoncallback=?';
        var data = {
            email: email,
            uPassword: pass,
            fname: fname
        };
        $.post(url, data, function (jsonData) {
            if (jsonData.status == 200) {
                loginEmail(email, pass);
            } else {
                alert(jsonData.items);
                $('#login-loader').hide();
            }
        }, "json");
    }
}

function forgotpassbyemail() {
    $('#loading-box').show();
    var email = $('#frmUserEmail').val();
    var url = apiURL + 'forgetpassword/?jsoncallback=?';
    var data = {
        email: email
    };
    $.post(url, data, function (jsonData) {

        if (jsonData.status == 200) {
            if (lang == 'th') {
                alert('ระบบได้ทำการส่งรหัสผ่านไปยังอีเมลของคุณเสร็จเรียบร้อยแล้วค่ะ');
            } else {
                alert(jsonData.items);
            }
            $('#loading-box').hide();
            setTimeout(function () {
                if (from) {
                    window.location = basePath + '/' + countryCodeAlias + '/' + lang + '/' + city_select_alias + '/login?from=' + from;
                } else {
                    window.location = basePath + '/' + countryCodeAlias + '/' + lang + '/' + city_select_alias + '/login/';
                }

            }, 800);
        } else {
            if (lang == 'th') {
                alert('กรุณาลองใหม่อีกครั้งค่ะ');
            } else {
                alert(jsonData.items);
            }
            $('#loading-box').hide();
        }

    }, 'json');
}

function reCaptcha() {
    var randomValue = randomString(5);
    $('#txtCaptcha').val(randomValue);
}

function cancalbookingBox() {
    $('.bookingDetail-popup').show();
}

function cancalbookingC() {
    $('.bookingDetail-popup').hide();
}

function cancalbooking(id, bid, bookingAuthCode) {
    $('#processing-box').show();
    $('#booking-red-bar').css("pointer-events", "none");
    $('#booking-red-bar').css("cursor", "default");

    var url = apiURL + 'cancelBooking/id/' + id + '/bid/' + bid + '/?jsoncallback=?';
    if (bookingAuthCode) {
        url = url + '&booking_auth_token=' + bookingAuthCode;
    }

    $.getJSON(url, null, function (jsonData) {
        if (jsonData.status == 200) {
            var url2 = apiURL + 'bookingDetail/bid/' + bid + '/?jsoncallback=?';
            if (bookingAuthCode) {
                url2 = url2 + '&booking_auth_token=' + bookingAuthCode;
            }

            $.getJSON(url2, null, function (jsonData) {

                $('#processing-box').hide();
                var html = 'Success.';
                var reUrl = basePath + '/' + countryCodeAlias + '/' + lang + '/from/' + from + '/';
                if (city != '') {
                    reUrl = basePath + '/' + countryCodeAlias + '/' + lang + '/' + city_select_alias + '/from/' + from + '/';
                }

                if (action == 'bookingDetail') {
                    $('#alert-can-success').show();
                } else {
                    window.top.location.href = reUrl;
                }
            });

        } else {
            $('#processing-box').hide();
            if (lang == 'th') {
                alert('กรุณาลองใหม่อีกครั้งค่ะ');
            } else if (lang == 'zh') {
                alert('糟糕，發生錯誤，請稍後再試！');
            } else {
                alert(error_txt);
            }
            $('.bookingDetail-popup').hide();
        }
    });
}

var t2d = 1;
function getLoopTime(today) {
    var day = $('#date').val();
    if (search_today == day) {
        t2d = 1;
        $('.allTimeSlot').hide();
        $('.todayTimeSlot').show();
    } else {
        t2d = 2;
        $('.todayTimeSlot').hide();
        $('.allTimeSlot').show();
    }
}

function moreRacomm(stype, pp, loadnew) {
    if (pp == 30) pp = 12;
    $(".more-resto").hide();
    $(".home-dd").hide();
    if (loadnew == 'yes') {
        var html = '<div id="bdm-img">';
        html += '	<div id="followingBallsG">';
        html += '	   <div id="followingBallsG_1" class="followingBallsG1"></div>';
        html += '      <div id="followingBallsG_2" class="followingBallsG1"></div>';
        html += '      <div id="followingBallsG_3" class="followingBallsG1"></div>';
        html += '      <div id="followingBallsG_4" class="followingBallsG1"></div>';
        html += '   </div>';
        html += '</div>';
        $('.home-content').html(html);
        $("#bdm-img").show();
    } else {
        $("#bdm-img").show();
    }
    if ((stype == 5) || (stype == 6)) {
        if (stype == 5) {
            var ttype = 7;
            var sb = '';
        } else {
            var ttype = 2;
            var sb = '/lat/' + lat + '/lon/' + lon + '/sortby/5/';
        }
        var url = apiURL + 'search/stype/' + ttype + '/page/1/pp/' + pp + sb + '?jsoncallback=?';
    } else {
        if (stype == 8) {
            var url = apiURL + 'newRecommended/stype/5/page/1/pp/' + pp + '/?jsoncallback=?';
        } else {
            var url = apiURL + 'newRecommended/stype/' + stype + '/page/1/pp/' + pp + '/?jsoncallback=?';
        }
    }
    $.ajax({
        url: url,
        type: "GET",
        dataType: "jsonp",
        success: function (jsonData) {
            if (jsonData.status == 200) {
                if (stype == 1) {
                    if (lang == 'th') {
                        var txt = 'ร้านแนะนำจากอีททิโก';
                    } else if (lang == 'zh') {
                        var txt = 'eatigo 推薦';
                    } else {
                        var txt = 'eatigo recommended';
                    }
                    $(".home-tap1-ti").html(txt);
                    recommTOTAL = jsonData.total;
                    recomm_st1_all = jsonData.items;
                    $("#bdm-img").hide();
                    recommHTML(recomm_st1_all, recommTOTAL, stype, loadnew);
                } else if (stype == 2) {
                    if (lang == 'th') {
                        var txt = 'ขอเสนอดีที่สุด';
                    } else if (lang == 'zh') {
                        var txt = '最好的';
                    } else {
                        var txt = 'best deal';
                    }
                    $(".home-tap1-ti").html(txt);
                    bestdealTOTAL = jsonData.total;
                    bestdeal = jsonData.items;
                    $("#bdm-img").hide();
                    recommHTML(bestdeal, bestdealTOTAL, stype, loadnew);
                } else if (stype == 3) {
                    if (lang == 'th') {
                        var txt = 'ร้านค้ายอดนิยม';
                    } else if (lang == 'zh') {
                        var txt = '最有名';
                    } else {
                        var txt = 'most famous';
                    }
                    $(".home-tap1-ti").html(txt);
                    mostFamousTOTAL = jsonData.total;
                    mostFamous = jsonData.items;
                    $("#bdm-img").hide();
                    recommHTML(mostFamous, mostFamousTOTAL, stype, loadnew);
                } else if (stype == 4) {
                    if (lang == 'th') {
                        var txt = 'ร้านอาหารใหม่';
                    } else if (lang == 'zh') {
                        var txt = 'eatigo上最新';
                    } else {
                        var txt = 'new on eatigo';
                    }
                    $(".home-tap1-ti").html(txt);
                    newonTOTAL = jsonData.total;
                    newon = jsonData.items;
                    $("#bdm-img").hide();
                    recommHTML(newon, newonTOTAL, stype, loadnew);
                } else if (stype == 5) {
                    if (lang == 'th') {
                        var txt = 'จองมากที่สุด';
                    } else if (lang == 'zh') {
                        var txt = '最受欢迎';
                    } else {
                        var txt = 'most reservation';
                    }
                    $(".home-tap1-ti").html(txt);
                    mostBookedTOTAL = jsonData.total;
                    mostBooked = jsonData.items;
                    $("#bdm-img").hide();
                    recommHTML(mostBooked, mostBookedTOTAL, stype, loadnew);
                } else if (stype == 6) {
                    if (lang == 'th') {
                        var txt = 'ร้านค้าใกล้ตัว';
                    } else if (lang == 'zh') {
                        var txt = '我附近';
                    } else {
                        var txt = 'around me';
                    }
                    $(".home-tap1-ti").html(txt);
                    aroundmeTOTAL = jsonData.total;
                    aroundme = jsonData.items;
                    $("#bdm-img").hide();
                    recommHTML(aroundme, aroundmeTOTAL, stype, loadnew);
                } else if (stype == 8) {
                    if (lang == 'th') {
                        var txt = 'ร้านอาหาร ก - ฮ';
                    } else if (lang == 'zh') {
                        var txt = 'A 到 Z';
                    } else {
                        var txt = 'A to Z';
                    }
                    $(".home-tap1-ti").html(txt);

                    aroundmeTOTAL = jsonData.total;
                    aroundme = jsonData.items;
                    $("#bdm-img").hide();
                    recommHTML(jsonData.items, aroundmeTOTAL, stype, loadnew);
                }
            } else {
            }
        },
        error: function (e) {
        }
    });
}

function addCommas(nStr) {
    nStr += '';
    x = nStr.split('.');
    x1 = x[0];
    x2 = x.length > 1 ? '.' + x[1] : '';
    var rgx = /(\d+)(\d{3})/;
    while (rgx.test(x1)) {
        x1 = x1.replace(rgx, '$1' + ',' + '$2');
    }
    return x1 + x2;
}

function recommHTML(jsonBD, total, stype, loadnew) {
    if (stype == 1) {
        var fff = 'eatigo_recommended';
    } else if (stype == 2) {
        var fff = 'eatigo_best_deal';
    } else if (stype == 3) {
        var fff = 'eatigo_most_famous';
    } else if (stype == 4) {
        var fff = 'eatigo_new';
    } else if (stype == 5) {
        var fff = 'eatigo_most_booked';
    } else if (stype == 6) {
        var fff = 'eatigo_around_me';
    } else if (stype == 8) {
        var fff = 'eatigo_a2z';
    }
    var html = '';
    $.each(jsonBD, function (index, item) {
        html += '<div class="home-recom-wrap" id="resto-id-' + item.resto_id + '">';
        if (item.day == 1) {
            var td = td_2;
        } else {
            var td = td_2;
        }
        var togoLink = '';
        if (from) {
            togoLink = basePath + '/' + countryCodeAlias + '/' + lang + '/' + city_select_alias + '/restaurant/name/' + item.name_url + '/?from=' + from + '&source=' + fff;
        } else {
            togoLink = basePath + '/' + countryCodeAlias + '/' + lang + '/' + city_select_alias + '/restaurant/name/' + item.name_url + '/?source=' + fff;
        }
        if (item.restaurantStatus == 'Coming-Soon') {
            html += '<div class="position-img"><img alt="coming soon" src="' + basePath + '/themes/default/images/index/coming_soon.png"></div>';
            html += '<a class="recom-box-img comingsoon" href="' + togoLink + '&date=' + td + '&time=' + time + '"';
            html += '>';
        } else {
            html += '<a class="recom-box-img" href="' + togoLink + '&date=' + td + '&time=' + time + '"';
            html += '>';
        }
        if (item.imgm != 'https://static.eatigo.com/') {
            html += '<img class="recom-box-img lazy" data-original="' + item.imgm + '" />';
        } else {
            html += '<img class="recom-box-img lazy" data-original="' + item.restoImg + '" />';
        }
        html += '<div class="logo-resto" style="background:url(' + item.logo + ') no-repeat;"></div>';

        if (item.new == 'yes') {
            if (lang == 'th') {
                html += '<div class="home-new-' + lang + '">ใหม่</div>';
            } else {
                html += '<div class="home-new-' + lang + '">new</div>';
            }
        }

        if (item.day > 1) {
            html += '<div class="home-p1">';
            html += ' +' + home_p1;
            html += '</div>';
        }

        if (item.closeN47day != '') {
            html += '<div class="group-resto-name" style="top:18%; color:#FFF;"><div class="name-txt"><h2>';
            html += item.closeN47day[0];
            html += '</h2></div><div class="total-txt small-font">';
            html += item.closeN47day[1];
            html += '</div></div>';
        }

        if (item.booked_count > 0) {
            var bc = addCommas(item.booked_count);
            if (item.day > 1) {
                html += '<div class="home-p1" style="right: 75px;">';
            } else {
                html += '<div class="home-p1">';
            }
            if (lang == 'th') {
                html += bc + ' ' + booking_made;
            } else {
                if (item.booked_count == 1) {
                    html += bc + ' ' + booking_made;
                } else {
                    html += bc + ' ' + bookings_made;
                }
            }
            html += '</div>';
        }

        html += '</a>';
        html += '<div class="float-left">';
        html += '<div class="box-detail">';
        html += '<div class="box-detail-name"><a href="' + togoLink + '&date=' + td + '&time=' + time + '"><h2 class="font-weight-bold">' + item.name + '</h2></a></div>';
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

        html += '<div class="device">';
        html += '<a class="arrow-left" id="arrow-left-2-' + index + '" href="javascript:doNothing();"></a>';
        html += '<a class="arrow-right" id="arrow-right-2-' + index + '" href="javascript:doNothing();"></a>';
        html += '<div class="swiper-container" id="timeslot-2-' + index + '">';
        html += '<div class="swiper-wrapper">';
        if (item.timeSlot.length == 1) {
            if (item.timeSlot[0].detail.discount != 0) {
                html += '<a href="' + togoLink + '&date=' + td + '&time=' + item.timeSlot[0].time + '" class="swiper-slide red-slide">';
                html += '<div class="home-slot-time normal-font font-weight-bold">' + item.timeSlot[0].time.replace(".", ":") + '</div>';
                html += '<div class="home-slot-discount"><h1 class="font-weight-bold"><span>-</span>' + item.timeSlot[0].detail.discount + '</h1></div>';
                html += '<div class="home-slot-discount-pc">%</div><div class="home-slot-off">off</div></a>';
            }
            html += '<a href="javascript:doNothing();" class="swiper-slide home-close-slide ' + lang + '"></a><a href="javascript:doNothing();" class="swiper-slide home-close-slide ' + lang + '"></a>';
        } else if (item.timeSlot.length == 2) {
            $.each(item.timeSlot, function (index2, slotlist) {
                if (slotlist.detail.discount != 0) {
                    html += '<a href="' + togoLink + '&date=' + td + '&time=' + slotlist.time + '" class="swiper-slide red-slide">';
                    html += '<div class="home-slot-time normal-font font-weight-bold">' + slotlist.time.replace(".", ":") + '</div>';
                    html += '<div class="home-slot-discount"><h1 class="font-weight-bold"><span>-</span>' + slotlist.detail.discount + '</h1></div>';
                    html += '<div class="home-slot-discount-pc">%</div><div class="home-slot-off">off</div></a>';
                }
            });
            html += '<a href="javascript:doNothing();" class="swiper-slide home-close-slide ' + lang + '"></a>';
        } else {
            $.each(item.timeSlot, function (index2, slotlist) {
                if (slotlist.detail.discount != 0) {
                    html += '<a href="' + togoLink + '&date=' + td + '&time=' + slotlist.time + '" class="swiper-slide red-slide">';
                    html += '<div class="home-slot-time normal-font font-weight-bold">' + slotlist.time.replace(".", ":") + '</div>';
                    html += '<div class="home-slot-discount"><h1 class="font-weight-bold"><span>-</span>' + slotlist.detail.discount + '</h1></div>';
                    html += '<div class="home-slot-discount-pc">%</div><div class="home-slot-off">off</div></a>';
                }
            });
        }
        html += '</div></div></div></div>';
        html += '<div  class="box-banner-bottom" style="display:none;"><center><img src="' + basePath + '/themes/default/images/index/eatigo_icon.png"></center></div></div>';
    });

    if (loadnew == 'yes') {
        if (jsonBD.length < total) {
            var txt_more = 'more';
            if (lang == 'th') {
                txt_more = 'เพิ่มเติม';
            }
            html += '<div id="bdm-img">';
            html += '	<div id="followingBallsG">';
            html += '	   <div id="followingBallsG_1" class="followingBallsG1"></div>';
            html += '      <div id="followingBallsG_2" class="followingBallsG1"></div>';
            html += '      <div id="followingBallsG_3" class="followingBallsG1"></div>';
            html += '      <div id="followingBallsG_4" class="followingBallsG1"></div>';
            html += '   </div>';
            html += '</div>';
            html += '<div class="home-box-loadmore">';
            html += '<a href="javascript:void(0);" onClick="moreRacomm(\'' + stype + '\', \'1000\', \'no\');" class="btn-home-more">+' + txt_more + '</a>';
            html += '</div>';
        }
    }
    $('.home-content').html(html);
    $.each(jsonBD, function (index, item) {
        var pp2 = 1;
        $.each(item.timeSlot, function (index2, slotlist) {
            if (slotlist.index == 1) {
                pp2 = index2;
            }
        });
        swipper(index, pp2, '2');
    });
    $("img.lazy").lazyload({
        effect: "fadeIn"
    });
}

function openHdd(o) {
    if (o == 1) {
        $('.home-dd').show();
    } else {
        $('.home-dd').hide();
    }
}

function moveLo4HereAndNow(map, ne, sw) {
    $(".han-a-game-box").hide();
    $('#h-result').html('0');

    var time = document.getElementById('time').value;
    if (action == 'hereandnow') {
        var ppl = document.getElementById('ppl').value;
        var url = apiURL + 'search/stype/2/date/' + today + '/time/' + time + '/ppl/' + ppl + '/partner/2,17/lat/' + lat + '/lon/' + lon + '/sortby/5/page/1/pp/1000/?jsoncallback=?';
    } else {
        var ppl = document.getElementById('noofseats').value;
        var url = apiURL + 'search/stype/2/date/' + today + '/time/' + time + '/ppl/' + ppl + '/partner/2,17/sortby/1/lat/' + lat + '/lon/' + lon + '/page/1/pp/1000/?jsoncallback=?';
    }
    $.ajax({
        url: url,
        type: "GET",
        dataType: "jsonp",

        success: function (jsonData) {
            if (jsonData.status == 200) {
                if (action == 'hereandnow') {
                    if (jsonData.items != 'no result') {
                        $(".content_map").show();
                        hereAndNow = arrayUnique(hereAndNow, jsonData.items);
                        moveLo4HereAndNowHTML(hereAndNow, lat, lon, map, ne, sw);
                    }
                } else {
                    if (jsonData.items != 'no result') {
                        hereAndNow = jsonData.items;
                        fillter_result = jsonData.items;
                        moveLo4HereAndNowHTML(hereAndNow, lat, lon, map, ne, sw);
                    } else {
                        $('#h-result').html('0');
                        if (lang == 'th') {
                            if (location) {
                                var txt = 'เราไม่พบคำค้นหาของร้านอาหารที่คุณต้องการ : ' + location;
                            } else {
                                var txt = 'เราไม่พบคำค้นหาของร้านอาหารที่คุณต้องการ';
                            }
                        } else {
                            if (location) {
                                var txt = "We're sorry, we did not find any restaurant results for : " + location;
                            } else {
                                var txt = "We're sorry, we did not find any restaurant results";
                            }
                        }

                        var html = txt;
                        $('#search-result').html(html);
                        $('.search-waiting').hide();
                    }
                }
            }
        },
        error: function (e) {
        }
    });
}

function arrayUnique(x, y) {
    for (var i = 0; i < x.length; ++i) {
        for (var j = 0; j < y.length; ++j) {
            if (x[i]['name'] == y[j]['name']) {
                y.splice(j, 1);
            }
        }
    }
    var a = x.concat(y);
    return a;
}

function inBounds(lat, lon, ne, sw) {
    var eastBound = lon < ne.lng();
    var westBound = lon > sw.lng();
    var inLong;

    if (ne.lng() < sw.lng()) {
        inLong = eastBound || westBound;
    } else {
        inLong = eastBound && westBound;
    }

    var inLat = lat > sw.lat() && lat < ne.lat();
    return inLat && inLong;
}

function moveLo4HereAndNowHTML(json, lat, lon, map, ne, sw) {
    if (lang == 'th') {
        var rTxt = 'กำลังจัดเรียงร้านอาหาร...';
    } else {
        var rTxt = 'sorting restaurants by your location...';
    }
    $('.image-loder-han').html(rTxt);
    var LocationData = Array();
    var html = '';
    var count = 0;

    search_cuisine = Array();
    search_atmosphere = Array();
    search_area = Array();
    search_neighborhood = Array();
    search_deals = Array();
    search_price = Array();
    search_rating = Array();
    $.each(json, function (index, item) {
        if ((item.lat >= sw.lat() && item.lat <= ne.lat()) && (item.lon <= ne.lng() && item.lon >= sw.lng())) {
            var hnHTML = '';
            html += '<div class="home-recom-wrap" id="resto-id-' + item.resto_id + '">';
            hnHTML += '<div class="home-recom-wrap-han">';
            var td = today;
            var togoLink = '';
            if (from) {
                togoLink = basePath + '/' + countryCodeAlias + '/' + lang + '/' + city_select_alias + '/restaurant/name/' + item.name_url + '/?from=' + from + '&';
            } else {
                togoLink = basePath + '/' + countryCodeAlias + '/' + lang + '/' + city_select_alias + '/restaurant/name/' + item.name_url + '/?';
            }
            html += '<a class="recom-box-img" href="' + togoLink + 'date=' + td + '&time=' + time + '&source=here_&_now"';
            hnHTML += '<a class="recom-box-img-han" style="background:url(' + item.img + ') no-repeat; background-size:cover;" href="' + togoLink + 'date=' + td + '&time=' + time + '&source=here_&_now"';
            html += '>';
            hnHTML += '>';

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
            html += '<div class="box-detail-name"><a href="' + togoLink + 'date=' + td + '&time=' + time + '"><h2 class="font-weight-bold">' + item.name + '</h2></a></div>';
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
            hnHTML += '<div class="box-detail-name"><a href="' + togoLink + 'date=' + td + '&time=' + time + '"><h2 class="font-weight-bold">' + item.name + '</h2></a></div>';
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
            html += '<div class="swiper-wrapper">';
            hnHTML += '<div class="swiper-wrapper">';
            if (item.timeSlot.length == 1) {
                if (item.timeSlot[0].detail.status == 'open') {
                    html += '<a href="' + togoLink + 'date=' + td + '&time=' + item.timeSlot[0].time + '&source=here_&_now" class="swiper-slide red-slide">';
                    hnHTML += '<a href="' + togoLink + 'date=' + td + '&time=' + item.timeSlot[0].time + '&source=here_&_now" class="swiper-slide red-slide">';
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
                        html += '<a href="' + togoLink + 'date=' + td + '&time=' + slotlist.time + '&source=here_&_now" class="swiper-slide red-slide">';
                        html += '<div class="home-slot-time normal-font font-weight-bold">' + slotlist.time.replace(".", ":") + '</div>';
                        html += '<div class="home-slot-discount"><h1 class="font-weight-bold"><span>-</span>' + slotlist.detail.discount + '</h1></div>';
                        html += '<div class="home-slot-discount-pc">%</div><div class="home-slot-off">off</div></a>';

                        hnHTML += '<a href="' + togoLink + 'date=' + td + '&time=' + slotlist.time + '&source=here_&_now" class="swiper-slide red-slide">';
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
                        html += '<a href="' + togoLink + 'date=' + td + '&time=' + slotlist.time + '&source=here_&_now" class="swiper-slide red-slide">';
                        html += '<div class="home-slot-time normal-font font-weight-bold">' + slotlist.time.replace(".", ":") + '</div>';
                        html += '<div class="home-slot-discount"><h1 class="font-weight-bold"><span>-</span>' + slotlist.detail.discount + '</h1></div>';
                        html += '<div class="home-slot-discount-pc">%</div><div class="home-slot-off">off</div></a>';

                        hnHTML += '<a href="' + togoLink + 'date=' + td + '&time=' + slotlist.time + '&source=here_&_now" class="swiper-slide red-slide">';
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
            count++;

            if (action != 'hereandnow') {
                var cIndex = search_cuisine.indexOf(item.cuisine);
                if (cIndex == -1)
                    search_cuisine.push(item.cuisine);

                $.each(item.atmosphere, function (index_item_atmosphere, item_item_atmosphere) {
                    var ap = search_atmosphere.indexOf(item_item_atmosphere.atmosphere);
                    if (ap == -1)
                        search_atmosphere.push(item_item_atmosphere.atmosphere);
                });

                var ar = search_area.indexOf(item.area);
                if (ar == -1)
                    search_area.push(item.area);

                var deal = search_deals.indexOf(item.timeSlot[0].detail.discount);
                if (deal == -1)
                    search_deals.push(item.timeSlot[0].detail.discount);

                var priceR = search_price.indexOf(item.priceRange);
                if (priceR == -1)
                    search_price.push(item.priceRange);

                var rat = search_rating.indexOf(parseInt(item.rating));
                if (rat == -1)
                    search_rating.push(parseInt(item.rating));
            }
        }
    });
    $('#h-result').html(count);

    if (action == 'hereandnow') {
        $('#hereAnow').html(html);
    } else {
        $('#search-result').html(html);
        html_cuisine = '';
        html_atmosphere = '';
        html_search_area = '';
        html_deals = '';
        html_price = '';
        html_price_img = '';
        html_rating = '';
        html_rating_img = '';
        if (lang == 'th') {
            var lang_star = 'ดาว';
        } else {
            var lang_star = 'star';
        }

        if (html_cuisine == '') {
            if (search_cuisine.length > 0) {
                search_cuisine.sort();
                $.each(search_cuisine, function (index_cuisine, item_cuisine) {
                    html_cuisine += '<div><input onClick="onFilter(\'cuisine\', \'' + item_cuisine + '\');" id="cuisine' + index_cuisine + '" type="checkbox" name="cuisine[]" class="cuisine" value="' + item_cuisine + '">';
                    html_cuisine += '<label for="cuisine' + index_cuisine + '" style="width:310px;">' + item_cuisine + '</label></div>';
                });
            } else {
                html_cuisine += '<div style="width:220px;">no filter for current search</div>';
            }
        }

        if (html_atmosphere == '') {
            if (search_atmosphere.length > 0) {
                search_atmosphere.sort();
                $.each(search_atmosphere, function (index_atmosphere, item_atmosphere) {
                    html_atmosphere += '<div><input id="atmosphere' + index_atmosphere + '" onClick="onFilter(\'atmosphere\', \'' + item_atmosphere + '\');" type="checkbox" name="atmosphere[]" class="atmosphere" value="' + item_atmosphere + '">';
                    html_atmosphere += '<label for="atmosphere' + index_atmosphere + '">' + item_atmosphere + '</label></div>';
                });
            } else {
                html_atmosphere += '<div style="width:220px;">no filter for current search</div>';
            }
        }

        if (html_deals == '') {
            if (search_deals.length > 0) {
                search_deals.sort();
                $.each(search_deals, function (index_deals, item_deals) {
                    html_deals += '<div><input id="deals' + index_deals + '" onClick="onFilter(\'deals\', \'' + item_deals + '\');" type="checkbox" name="deals[]" class="deals" value="' + item_deals + '">';
                    html_deals += '<label for="deals' + index_deals + '">' + item_deals + ' %</label></div>';
                });
            } else {
                html_deals += '<div style="width:220px;">no filter for current search</div>';
            }
        }

        if (html_rating == '') {
            if (search_rating.length > 0) {
                search_rating.sort();
                $.each(search_rating, function (index_rating, item_rating) {
                    html_rating += '<div><input id="rating' + index_rating + '" onClick="onFilter(\'rating\', \'' + item_rating + '\');" type="checkbox" name="rating[]" class="rating" value="' + item_rating + '">';
                    html_rating += '<label for="rating' + index_rating + '">' + item_rating + ' ' + lang_star + '</label></div>';
                    var ret_percen = item_rating * 20;
                    html_rating_img += '<div class="box-detail-rating-white2"><div class="box-detail-rating-yellow2" style="width:' + ret_percen + '%;"></div></div>';
                });
            } else {
                html_rating += '<div style="width:220px;">no filter for current search</div>';
            }
        }

        if (html_price == '') {

            if (search_price.length > 0) {
                search_price.sort();
                $.each(search_price, function (index_price, item_price) {
                    html_price_img += '<ul class="rating1 radio_sec height">';
                    for (var pri = 0; pri < item_price; pri++) {
                        html_price_img += '<li><figure><a href="javascript:donothing();"><img src="' + basePath + '/themes/default/images/detail/dollar_orange.png" alt=""></a></figure></li>'
                    }
                    html_price_img += '</ul>';
                    html_price += '<div>';
                    html_price += '<input id="price' + index_price + '" onClick="onFilter(\'price\', \'' + item_price + '\');" type="checkbox" name="price[]" class="price" value="' + item_price + '">';
                    html_price += '<label for="price' + index_price + '">' + item_price + ' $</label>';
                    html_price += '</div>';
                });
            } else {
                html_price += '<div style="width:220px;">no filter for current search</div>';
            }
        }

        if (html_search_area == '') {
            if (search_area.length > 0) {
                search_area.sort();
                $.each(search_area, function (index_area, item_area) {
                    if (index_area != null) {
                        html_search_area += '<div class="location">';
                        html_search_area += '<input id="location' + index_area + '" onClick="onFilter(\'area\', \'' + item_area + '\');" type="checkbox" name="location[]" class="checkboxlocation" value="' + item_area + '">';
                        html_search_area += '<label for="location' + index_area + '">' + item_area + '</label>';
                        html_search_area += '</div>';
                    }
                });
            } else {
                html_search_area += '<div style="width:220px;">no filter for current search</div>';
            }
        }
        $('#location-list').html(html_search_area);
        $('#atmosphere-list').html(html_atmosphere);
        $('#cuisine-list').html(html_cuisine);
        $('#deals-list').html(html_deals);
        $('#price-list').html(html_price);
        $('#price-list-img').html(html_price_img);
        $('#rating-list').html(html_rating);
        $('#rating-list-img').html(html_rating_img);

    }
    $('#loadmore').show();
    $.each(json, function (index, item) {
        swipperHN(index, 'hn');
    });
    $("#hn-map").show();
    morePIN(LocationData, map);
    $(".down_map").hide();
    $("img.lazy").lazyload({
        effect: "fadeIn"
    })
    $(".bar_result").show();
}

function toSendy() {
    if (lang == 'th') {
        alert('ลงทะเบียนสมัครเป็นสมาชิกเพื่อรับจดหมายข่าว');
        $('.dialogbox-btn').append('<input type="button" id="btn-gotoregis" onclick="gotoregis();" value="ตกลง" class="save bnt-right gotoregis" style="float: left;">');
    } else if (lang == 'zh') {
        alert('註冊訂閱通訊');
        $('.dialogbox-btn').append('<input type="button" id="btn-gotoregis" onclick="gotoregis();" value="同意" class="save bnt-right gotoregis" style="float: left;">');
    } else {
        alert('register for subscribe to newsletter');
        $('.dialogbox-btn').append('<input type="button" id="btn-gotoregis" onclick="gotoregis();" value="ok" class="save bnt-right gotoregis" style="float: left;">');
    }
}

function gotoregis() {
    window.location = basePath + '/' + countryCodeAlias + '/' + lang + '/' + city_select_alias + '/register/from/' + from + '/';
}

function cancelnote() {
    var bid = $('#bid-cancel-booking').val();
    var cbsubject = $('input[name="subject_note"]:checked').val();
    var cbnote = $('#cancel_note').val();
    var url = basePath + '/index/cancelbookingnote/';
    var datapost = {
        id: bid,
        subject: cbsubject,
        cancelnote: cbnote
    };

    $.post(url, datapost, function (data) {

        if (data == 1) {

            setTimeout(function () {
                $('#cancel_note').attr("value", "");
                $('#cancel-bookin-note').fadeOut();
            }, 1500);

        } else {
            $('#cancel-bookin-note').fadeOut();
            if (lang == 'th') {
                alert('ลองอีกครั้ง!');
            } else if (lang == 'zh') {
                alert('重試!');
            } else {
                alert('Try again !');
            }

        }

    });
}

function cancelbookingnote() {
    cancalbookinguser();
}

var searchDT = [];
var searchAm = [];
$(function () {
    var url = apiURL + 'autocomplete/search/all/?jsoncallback=?';

    $.ajax({
        url: url,
        type: "GET",
        dataType: "jsonp",

        success: function (jsonData) {
            if (jsonData.status == 200) {
                var json = jsonData.items;

                if (json.city != null) {
                    if (json.city.city != 'no') {
                        if (lang == 'th') {
                            var city_txt = 'เมือง';
                        } else {
                            var city_txt = 'City';
                        }
                        $.each(json.city.item, function (index, item) {
                            var title = json.city.title;
                            var name = item.name;
                            var id = item.id;
                            var resto = 'no';
                            if (name) {
                                searchDT.push({
                                    label: name,
                                    category: title,
                                    id: id,
                                    resto: resto,
                                    type: 'city',
                                    st: '3'
                                });
                            }
                        });
                    }
                }

                if (json.area != null) {
                    if (json.area.area != 'no') {
                        if (lang == 'th') {
                            var area_txt = 'เขต';
                        } else {
                            var area_txt = 'Area';
                        }
                        $.each(json.area.item, function (index, item) {
                            var title = json.area.title;
                            var name = item.name;
                            var id = item.id;
                            var resto = 'no';
                            if (name) {
                                searchDT.push({
                                    label: name,
                                    category: title,
                                    id: id,
                                    resto: resto,
                                    type: 'area',
                                    st: '4'
                                });
                            }

                        });
                    }
                }

                if (json.neighborhood != null) {
                    if (json.neighborhood.neighborhood != 'no') {
                        if (lang == 'th') {
                            var neighborhood_txt = 'พื้นที่';
                        } else {
                            var neighborhood_txt = 'Neighborhood';
                        }
                        $.each(json.neighborhood.item, function (index, item) {
                            var title = json.neighborhood.title;
                            var name = item.name;
                            var id = item.id;
                            var resto = 'no';
                            if (name) {
                                searchDT.push({
                                    label: name,
                                    category: title,
                                    id: id,
                                    resto: resto,
                                    type: 'neighborhood',
                                    st: '5'
                                });
                            }
                        });
                    }
                }

                if (json.cuisine != null) {
                    if (json.cuisine.cuisine != 'no') {
                        if (lang == 'th') {
                            var cuisine_txt = 'ประเภทอาหาร';
                        } else {
                            var cuisine_txt = 'Cuisine';
                        }
                        $.each(json.cuisine.item, function (index, item) {
                            var title = json.cuisine.title;
                            var name = item.name;
                            var id = item.id;
                            var resto = 'no';
                            if (name) {
                                searchDT.push({
                                    label: name,
                                    category: title,
                                    id: id,
                                    resto: resto,
                                    type: 'cuisine',
                                    st: '6'
                                });
                            }
                        });
                    }
                }

                if (json.restaurant != null) {
                    if (json.restaurant.restaurant != 'no') {
                        if (lang == 'th') {
                            var restaurant_txt = 'ร้านอาหาร';
                        } else {
                            var restaurant_txt = 'Restaurants';
                        }
                        $.each(json.restaurant.item, function (index, item) {
                            var title = json.restaurant.title;
                            var name = item.name;
                            var id = item.id;
                            var resto = 'yes';
                            if (name) {
                                searchDT.push({
                                    label: name,
                                    category: title,
                                    id: id,
                                    resto: resto,
                                    type: 'restaurant',
                                    st: ''
                                });
                            }
                        });
                    }
                }

            } else {

            }

        }
    });
});

$(function () {
    var url = apiURL + 'autocomplete/search//?jsoncallback=?';
    $.ajax({
        url: url,
        type: "GET",
        dataType: "jsonp",

        success: function (jsonData) {

            if (jsonData.status == 200) {
                var json = jsonData.items;

                if (json.city != null) {
                    if (json.city.city != 'no') {
                        if (lang == 'th') {
                            var city_txt = 'เมือง';
                        } else {
                            var city_txt = 'City';
                        }
                        $.each(json.city.item, function (index, item) {
                            var title = json.city.title;
                            var name = item.name;
                            var id = item.id;
                            var resto = 'no';
                            if (name) {
                                searchAm.push({
                                    label: name,
                                    category: title,
                                    id: id,
                                    resto: resto,
                                    type: 'city',
                                    st: '3'
                                });
                            }
                        });
                    }
                }

                if (json.area != null) {
                    if (json.area.area != 'no') {
                        if (lang == 'th') {
                            var area_txt = 'เขต';
                        } else {
                            var area_txt = 'Area';
                        }
                        $.each(json.area.item, function (index, item) {
                            var title = json.area.title;
                            var name = item.name;
                            var id = item.id;
                            var resto = 'no';
                            if (name) {
                                searchAm.push({
                                    label: name,
                                    category: title,
                                    id: id,
                                    resto: resto,
                                    type: 'area',
                                    st: '4'
                                });
                            }

                        });
                    }
                }

                if (json.neighborhood != null) {
                    if (json.neighborhood.neighborhood != 'no') {
                        if (lang == 'th') {
                            var neighborhood_txt = 'พื้นที่';
                        } else {
                            var neighborhood_txt = 'Neighborhood';
                        }
                        $.each(json.neighborhood.item, function (index, item) {
                            var title = json.neighborhood.title;
                            var name = item.name;
                            var id = item.id;
                            var resto = 'no';
                            if (name) {
                                searchAm.push({
                                    label: name,
                                    category: title,
                                    id: id,
                                    resto: resto,
                                    type: 'neighborhood',
                                    st: '5'
                                });
                            }
                        });
                    }
                }

                if (json.cuisine != null) {
                    if (json.cuisine.cuisine != 'no') {
                        if (lang == 'th') {
                            var cuisine_txt = 'ประเภทอาหาร';
                        } else {
                            var cuisine_txt = 'Cuisine';
                        }
                        $.each(json.cuisine.item, function (index, item) {
                            var title = json.cuisine.title;
                            var name = item.name;
                            var id = item.id;
                            var resto = 'no';
                            if (name) {
                                searchAm.push({
                                    label: name,
                                    category: title,
                                    id: id,
                                    resto: resto,
                                    type: 'cuisine',
                                    st: '6'
                                });
                            }
                        });
                    }
                }

                if (json.restaurant != null) {
                    if (json.restaurant.restaurant != 'no') {
                        if (lang == 'th') {
                            var restaurant_txt = 'ร้านอาหาร';
                        } else {
                            var restaurant_txt = 'Restaurants';
                        }
                        $.each(json.restaurant.item, function (index, item) {
                            var title = json.restaurant.title;
                            var name = item.name;
                            var id = item.id;
                            var resto = 'yes';
                            if (name) {
                                searchAm.push({
                                    label: name,
                                    category: title,
                                    id: id,
                                    resto: resto,
                                    type: 'restaurant',
                                    st: ''
                                });
                            }
                        });
                    }
                }
            }
        }
    });
});

$(function () {
    $.widget("custom.catcomplete", $.ui.autocomplete, {
        _create: function () {
            this._super();
            this.widget().menu("option", "items", "> :not(.ui-autocomplete-category)");
        },
        _renderMenu: function (ul, items) {
            var that = this,
                currentCategory = "";
            $.each(items, function (index, item) {
                var li;

                if (item.category != currentCategory) {
                    ul.append('<li class="ui-autocomplete-category City_cat">' + item.category + '</li>');
                    currentCategory = item.category;
                }
                li = that._renderItemData(ul, item);

                if (item.type == 'restaurant') {
                    if (city_select) {
                        if (from) {
                            var _link = basePath + '/' + countryCodeAlias + '/' + lang + '/' + city_select_alias + '/restaurant/name/' + item.name_url + '/?from=' + from;
                        } else {
                            var _link = basePath + '/' + countryCodeAlias + '/' + lang + '/' + city_select_alias + '/restaurant/name/' + item.name_url + '/';
                        }
                    } else {
                        if (from) {
                            var _link = basePath + '/' + countryCodeAlias + '/' + lang + '/restaurant/name/' + item.name_url + '/?from=' + from;
                        } else {
                            var _link = basePath + '/' + countryCodeAlias + '/' + lang + '/restaurant/name/' + item.name_url + '/';
                        }
                    }
                    li.attr("aria-label", item.category + " : " + item.label);
                    $(li).children('a').attr('href', _link);
                    $(li).addClass('resto_list');
                    $(li).children('a').addClass('resto');

                } else if (item.type == 'cuisine') {
                    var _link = 'javascript:changeStype(\'' + item.st + '\', \'' + item.id + '\')';
                    li.attr("aria-label", item.category + " : " + item.label);
                    $(li).children('a').attr('href', _link);
                    $(li).addClass('resto_list');
                    $(li).children('a').addClass('resto');
                } else if (item.type == 'area' || item.type == 'neighborhood') {
                    var _link = 'javascript:changeStype(\'' + item.st + '\', \'' + item.id + '\')';
                    li.attr("aria-label", item.category + " : " + item.label);
                    $(li).children('a').attr('href', _link);
                    $(li).addClass('area_list');
                    $(li).children('a').addClass('area');
                } else {
                    var _link = 'javascript:changeStype(\'' + item.st + '\', \'' + item.id + '\')';
                    li.attr("aria-label", item.category + " : " + item.label);
                    $(li).children('a').attr('href', _link);
                    $(li).addClass('city_list');
                    $(li).children('a').addClass('city');
                }

            });
        }
    });

    $('#autocom')
        .chosen({
            no_results_text: (lang == 'zh') ? '找不到' : 'No results match'
        })
        .change(function (e, ui) {

        var val = $("#autocom").val();
        var stype = '';
        var id = '';
        if (ui.selected) {
            var vl = val.length - 1;
            var stype = $('#autocom option[value="' + val[vl] + '"]').attr('data-stype');
            var id = $('#autocom option[value="' + val[vl] + '"]').attr('id');
            $('.search-field input').dblclick();
        }

        if (stype == 'restaurant') {
            var name_url = $('#autocom option[value="' + val[0] + '"]').attr('data-name_url');
            var togoLink = '';
            var search_option = '';
            if (action == 'index' || action == 'search') {
                var time = search_time;
                var ppl = search_ppl;
                var strDate = $('#date').val();
                var Date_ar = strDate.split(",");
                var dd = $.trim(Date_ar[0]);
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
                search_option = 'date=' + date + '&time=' + time + '&ppl=' + ppl;
            }

            if (from) {
                togoLink = basePath + '/' + countryCodeAlias + '/' + lang + '/' + city_select_alias + '/restaurant/name/' + name_url + '/?' + search_option + 'from=' + from;
            } else {
                togoLink = basePath + '/' + countryCodeAlias + '/' + lang + '/' + city_select_alias + '/restaurant/name/' + name_url + '/?' + search_option;
            }
            window.location = togoLink;
        }
    });

    $(".search-field input").focus(function (e) {
        var vl = $("#autocom").val();
        var val2 = $('.location').val();
        var val3 = $(this).val();

        if (!vl && !val2 && !val3) {
        }
        setTimeout(function () {
        }, 250);

    });

    function defaultautocom() {

        var html = '';
        var vl = $("#autocom").val();

        if (action != 'search' && action != 'index') {

            if (countryCode == 'th' && lang == 'th' && city_select == '') {

                $("ul.chosen-results li").each(function (i, el) {
                    var text = $.trim($(el).text());
                    var patt = new RegExp("(^เมือง$|^กรุงเทพมหานคร$|^พื้นที่$|^ลาดพร้าว$|^สยาม$|^สุขุมวิท$|^สีลม สาทร$|^ปทุมวัน$|^ประเภทอาหาร$|^อาหารญี่ปุ่น$|^อาหารอิตาเลียน$|^อาหารอินเดีย$|^อาหารนานาชาติ$|^อาหารไทย$)");
                    if (!patt.test(text)) {
                        $(el).remove();
                    }
                });

            } else if (countryCode == 'th' && lang == 'en' && city_select == '') {

                $("ul.chosen-results li").each(function (i, el) {
                    var text = $.trim($(el).text());
                    var patt = new RegExp("(^city$|^bangkok$|^area$|^ladprao$|^siam$|^sukhumvit$|^silom, sathon$|^patumwan$|^cuisine$|^japanese$|^italian$|^indian$|^international$|^thai$)");
                    if (!patt.test(text)) {
                        $(el).remove();
                    }
                });

            } else if (countryCode == 'th' && lang == 'en' && city_select == 'pattaya') {

                $("ul.chosen-results li").each(function (i, el) {
                    var text = $.trim($(el).text());
                    var patt = new RegExp("(^city$|^pattaya$|^area$|^central pattaya$|^north pattaya$|^south pattaya|^cuisine$|^american$|^brazilian$|^chinese$|^french$|^international$|^thai$)");
                    if (!patt.test(text)) {
                        $(el).remove();
                    }
                });

            } else if (countryCode == 'th' && lang == 'th' && city_select == 'pattaya') {

                $("ul.chosen-results li").each(function (i, el) {
                    var text = $.trim($(el).text());
                    var patt = new RegExp("(^เมือง$|^พัทยา$|^พื้นที่$|^พัทยากลาง$|^พัทยาใต้$|^พัทยาเหนือ$|^ประเภทอาหาร$|^ฝรั่งเศส$|^ยุโรปร่วมสมัย$|^อาหารบราซิล$|^อาหารญี่ปุ่น$|^อาหารฝรั่งเศส$|^อาหารไทย$)");
                    if (!patt.test(text)) {
                        $(el).remove();
                    }
                });

            } else if (countryCode == 'sg' && lang == 'en') {

                $("ul.chosen-results li").each(function (i, el) {
                    var text = $.trim($(el).text());

                    var patt = new RegExp("(^city$|^singapore$|^cuisine$|^asian$|^chinese$|^european$|^halal \/ kosher$|^indian$|^indonesian$|^international$|^italian$|^japanese$|^korean$|^mediterranean$|^thai$|^vietnamese$)");
                    if (!patt.test(text)) {
                        $(el).remove();
                    }
                });
                $("ul.chosen-results li.group-option").filter(":contains('city')").remove()

            }
        }
        if (lang == 'th') {
            var html = 'ค้นหา : ร้านอาหาร';
            $("#autocom").attr("placeholder", html);
        } else if (lang == 'zh') {
            var html = '搜索 : 餐廳';
            $("#autocom").attr("placeholder", html);
        } else {
            var html = 'search for : restaurants';
            $("#autocom").attr("placeholder", html);
        }

    }


    $('.icon-zoom-search').click(function () {
        var Sval = $(".location").val();
        if (Sval) {
            window.location = basePath + '/' + countryCodeAlias + '/' + lang + '/' + city_select_alias + '/search/search/' + Sval + '/from/' + from + '/';
        } else {
            $(".location").focus();
        }
    });

    $('.default').keypress(function (e) {
        var Sval = $(".default").val();
        if (e.which == 13) {
            if (Sval) {
                window.location = basePath + '/' + countryCodeAlias + '/' + lang + '/' + city_select_alias + '/search/search/' + Sval + '/from/' + from + '/';
            }
        }
    });
});

function goSearchpage() {
    var searchsg = $('#searchsg').val();
    var date = $('#date').val();
    if (t2d == 1) {
        var time = $('#time2day').val();
    } else {
        var time = $('#time').val();
    }
    var ppl = $('#noofseats').val();
    window.location = basePath + '/' + countryCodeAlias + '/' + lang + '/' + city_select_alias + '/search/search/' + searchsg + '/date/' + date + '/time/' + time + '/ppl/' + ppl + '/from/' + from + '/';
}

$(function () {

    $('#btn-cancel-no').click(function () {
        $('.centerpoint').fadeOut('fast');
        $('#btn-gotoregis').remove();
    });

    window.alert = function (t) {
        $('#text-alert').html(t);
        $('#alertboxs').show();
        return false;
    };

    if (action == 'restaurant' || action == 'bookingDetail') {
        if (from != 'scblife') {
            $('.btn-menu-left,.dropdown_list_page,.header-logo, .header-logo-beta').hover(function () {
                $('.dropdown_list_page').show();
                $('.btn-menu-left,.header-logo, .header-logo-beta').css('background-color', '#cd232a');
            }, function () {
                $('.dropdown_list_page').hide();
                $('.btn-menu-left,.header-logo, .header-logo-beta').css('background-color', '#bc181f');
            });
        }
    } else {
        $('.btn-menu-left,.dropdown_list_page,.header-logo, .header-logo-beta').hover(function () {
            $('.dropdown_list_page').show();
            $('.btn-menu-left,.header-logo, .header-logo-beta').css('background-color', '#cd232a');
        }, function () {
            $('.dropdown_list_page').hide();
            $('.btn-menu-left,.header-logo, .header-logo-beta').css('background-color', '#cd232a');
        });
    }

    $('.home-tap1').hover(function () {
        $('.dropdown_list_sortby').show();
    }, function () {
        $('.dropdown_list_sortby').hide();
    });

    $('.overlay-dropdown').click(function () {
        $('.dropdown_list_page').hide();
        $('.btn-menu-left,.header-logo, .header-logo-beta').css('background-color', '#bc181f');
        $('.headbar-box-right').css('background', 'none');
        $('#dropdown_list_lang').hide();
        $('#list_sortby').hide();
        $(this).hide();
    });

    $('#dropdown_city,.dropdown_list_city').hover(function () {
        if (!anotherLang) {
            $('#dropdown_list_city').css({
                'right': '5px'
            })
        }
        $('.dropdown_list_city').show();
    }, function () {
        $('.dropdown_list_city').hide();
    });

    $('.dropdown_list_lang .country_box_f#country_box_f,.dropdown_list_city .country_box_f#country_box_f').hover(function () {
        $('.pointer_lang_right').css('background', 'url(' + basePath + '/themes/default/images/newhome/for_navigate/arrow.png) 121px 0px no-repeat');
    }, function () {
        $('.pointer_lang_right').css('background', 'url(' + basePath + '/themes/default/images/newhome/for_navigate/arrow_noactive.png) 121px 0px no-repeat');
    });
});

function dellabelsearch() {

    $('#leble-search-list').hide();
    $('#leble-search-list').html('');
    $('.location').val('');
    $('.location').focus();
}


$(window).load(function () {
    $('.icon-zoom-search').css('display', 'inline-block');
    if (action == 'index') {
        var sortby = getCookie('sortby');
        if (sortby > 1) {
            $('#sortby_list' + sortby).trigger('click');
        }
    }
});

function SetCookie(cookieName, cookieValue, nDays) {
    var today = new Date();
    var expire = new Date();
    if (nDays == null || nDays == 0)
        nDays = 30;

    expire.setTime(today.getTime() + 3600000 * 24 * nDays);
    document.cookie = cookieName + "=" + escape(cookieValue) + ";expires=" + expire.toGMTString();
}

function getCookie(name) {
    var dc = document.cookie;
    var prefix = name + "=";
    var begin = dc.indexOf("; " + prefix);
    if (begin == -1) {
        begin = dc.indexOf(prefix);
        if (begin != 0)
            return null;
    } else {
        begin += 2;
    }
    var end = document.cookie.indexOf(";", begin);
    if (end == -1) {
        end = dc.length;
    }
    return unescape(dc.substring(begin + prefix.length, end));
}

function deleteCookie(name, path, domain) {
    if (getCookie(name)) {
        document.cookie = name + "=" + ((path) ? "; path=" + path : "") + ((domain) ? "; domain=" + domain : "") + "; expires=Thu, 01-Jan-70 00:00:01 GMT";
    }
}

function setActive(id) {

    $('#sortby_list1,#sortby_list2,#sortby_list3,#sortby_list4,#sortby_list5,#sortby_list6,#sortby_list7').css({
        'color': '#898989',
        'font-weight': 'normal'
    });
    $('#sortby_list' + id).css({
        'color': '#e11323',
        'font-weight': 'normal'
    });
}

function chackemail() {
    var v1 = $('#val1').val();
    var email = $('#frmUserEmail').val();
    var regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    if (!regex.test(email)) {
        if (lang == 'th') {
            alert('กรุณากรอกอีเมลให้ถูกต้องด้วยค่ะ!');
        } else if (lang == 'zh') {
            alert('無效的電子郵件地址');
        } else {
            alert('Invalid Email Address');
        }

        $('#frmUserEmail').focus();

    } else {

        var url = basePath + '/index/mailunnews/va1/' + v1 + '/va2/' + email + '/?jsoncallback=?';
        $.get(url, null, function (rs) {
            if (rs == 1) {
                cannewsletter(email);
            } else {
                if (lang == 'th') {
                    alert('กรุณาลองใหม่อีกครั้งค่ะ!');
                } else if (lang == 'zh') {
                    alert('請重試');
                } else {
                    alert('Please try again !');
                }

                $('#frmUserEmail').focus();
            }
        });
    }
}

function cannewsletter(email) {

    var url = apiURL + 'unsubscribe/email/' + email + '/?jsoncallback=?';
    $.getJSON(url, null, function (jsonData) {
        if (jsonData.status == 200) {
            if (lang == 'th') {
                alert('ระบบได้ทำการยกเลิกการรับข่าวสารเรียบร้อยแล้วค่ะ!');
            } else {
                alert(jsonData.items);
            }
            setTimeout(function () {
                window.location.replace(basePath + '/' + countryCodeAlias + '/' + lang + '/' + city_select_alias + '/from/' + from + '/');
            }, 500);

        } else {

            if (lang == 'th') {
                alert('กรุณาลองใหม่อีกครั้งค่ะ!');
            } else {
                alert(jsonData.items);
            }
            $('#frmUserEmail').focus();
        }
    });
}

function loginfav() {
    var url = basePath + '/index/chacksecsion/?jsoncallback=?';
    $.get(url, null, function (rs) {
        if (rs != 'error') {
            $('#uid').val(rs);
            doFav();
        } else {
            $('#overlaylogin').animate({
                opacity: 1
            }, 10, null, function () {
                $(this).show();
            });
        }
    });
}

$(function () {
    $('.close_overlay_login').click(function () {
        $('#overlaylogin').hide();
    });

    $('.header-tab-search1').click(function () {
        $('.header-tab-search1').css({
            'background': '#bc181f',
            'color': '#FFF'
        });
        $('.header-tab-search2').css({
            'background': '#FFF',
            'color': '#767676'
        });
        $('.bylocation').show();
        $('.byresto').hide();
    });
    $('.header-tab-search2').click(function () {
        $('.header-tab-search2').css({
            'background': '#bc181f',
            'color': '#FFF'
        });
        $('.header-tab-search1').css({
            'background': '#FFF',
            'color': '#767676'
        });
        $('.bylocation').hide();
        $('.byresto').show();
    });

    $('#location-all').click(function () {
        if ($(this).prop('checked')) {
            $('.location_search').prop('checked', true);
            if (location_count > 1 && lang == 'en') {
                $('#txt-bylocation').html(location_count + ' ' + _location + 's');
            } else {
                $('#txt-bylocation').html(location_count + ' ' + _location);
            }
        } else {
            $('.location_search').prop('checked', false);
            $('#txt-bylocation').html(anylocation);
        }
    });

    $('.location_search').click(function () {
        var id = $(this).attr("id");
        if (id)
            $('#' + id).prop('checked');
        var loca = $('.location_search:checked').length;
        if (loca == location_count) {
            $('#location-all').prop('checked', true);
        } else {
            $('#location-all').prop('checked', false);
        }
        if (loca > 0) {
            if (loca > 1 && lang == 'en') {
                $('#txt-bylocation').html(loca + ' ' + _location + 's');
            } else {
                $('#txt-bylocation').html(loca + ' ' + _location);
            }
        } else {
            $('#txt-bylocation').html(anylocation);
        }
    });

    $('#cuisine-all').click(function () {
        if ($(this).prop('checked')) {
            $('.cuisine_search').prop('checked', true);
            if (cuisine_count > 1 && lang == 'en') {
                $('#txt-bycuisine').html(cuisine_count + ' ' + _cuisine + 's');
            } else {
                $('#txt-bycuisine').html(cuisine_count + ' ' + _cuisine);
            }
        } else {
            $('.cuisine_search').prop('checked', false);
            $('#txt-bycuisine').html(anycuisine);
        }
    });

    $('.cuisine_search').click(function () {
        var id = $(this).attr("id");
        if (id)
            $('#' + id).prop('checked');
        var cui = $('.cuisine_search:checked').length;
        if (cui == location_count) {
            $('#cuisine-all').prop('checked', true);
        } else {
            $('#cuisine-all').prop('checked', false);
        }
        if (cui > 0) {
            if (cui > 1 && lang == 'en') {
                $('#txt-bycuisine').html(cui + ' ' + _cuisine + 's');
            } else {
                $('#txt-bycuisine').html(cui + ' ' + _cuisine);
            }
        } else {
            $('#txt-bycuisine').html(anycuisine);
        }
    });

    $('#rate-all').click(function () {
        if ($(this).prop('checked')) {
            $('.rating').prop('checked', true);
            onFilter('rating', 'all');
        } else {
            $('.rating').prop('checked', false);
            onFilter('rating', 0);
        }

    });

    $('#price-all').click(function () {
        if ($(this).prop('checked')) {
            $('.price').prop('checked', true);
            onFilter('price', 'all');
        } else {
            $('.price').prop('checked', false);
            onFilter('price', 0);
        }
    });

    $('#discount-all').click(function () {
        if ($(this).prop('checked')) {
            $('.deals').prop('checked', true);
            onFilter('deals', 'all');
        } else {
            $('.deals').prop('checked', false);
            onFilter('deals', 0);
        }
        $('.deals').trigger();
    });

    $('#atmosphere-all').click(function () {
        if ($(this).prop('checked')) {
            $('.atmosphere').prop('checked', true);
            onFilter('atmosphere', 'all');
        } else {
            $('.atmosphere').prop('checked', false);
            onFilter('atmosphere', 0);
        }
        $('.atmosphere').trigger('');
    });

    $('#rate-box').hover(function () {
        $('#rate-box-select').show();
        $('.fillter-search-box').css({
            'border-top-left-radius': '0px',
            'border-bottom-left-radius': '0px'
        });
    }, function () {
        $('#rate-box-select').hide();
        $('.fillter-search-box').css({
            'border-top-left-radius': '5px',
            'border-bottom-left-radius': '5px'
        });
    });

    $('#price-box').hover(function () {
        $('#price-box-select').show();
    }, function () {
        $('#price-box-select').hide();
    });

    $('#discount-box').hover(function () {
        $('#discount-box-select').show();
        $('.fillter-search-box').css({
            'border-bottom-right-radius': '0px'
        });
    }, function () {
        $('#discount-box-select').hide();
        $('.fillter-search-box').css({
            'border-bottom-right-radius': '5px'
        });
    });
});

function rewriteHurl() {
    if (from) {
        window.history.pushState("object or string", "Title", basePath + "/" + countryCodeAlias + "/" + lang + "/" + city_select_alias + "/?from=" + from);
    } else {
        window.history.pushState("object or string", "Title", basePath + "/" + countryCodeAlias + "/" + lang + "/" + city_select_alias + "/");
    }
}

if (action == 'index' || action == 'search') {
    $(function (e) {
        $('#icon-time,.select-time,.home-search-time-box').hover(function () {
            $('.home-search-time-box').show();
            $('.select-time').css({
                'border-top-right-radius': '0px'
            });
            $('.icon-search-time').css({
                'border-right': '0px solid #ccc',
                'border-top-left-radius': '0px',
                'border-right': '0px solid #ccc',
                'width': '41px'
            });
        }, function () {
            $('.home-search-time-box').hide();
            $('.select-time').css({
                'border-top-right-radius': '5px'
            });
            $('.icon-search-time').css({
                'border-top-left-radius': '5px',
                'border-right': '1px solid #ccc',
                'width': '40px'
            });
        });

        $('#icon-ppl,.select-person,.home-search-ppl-box').hover(function () {
            $('.home-search-ppl-box').show();
            $('.select-person').css({
                'border-top-right-radius': '0px'
            });
            $('#icon-ppl').css({
                'border-top-left-radius': '0px',
                'border-right': '0px solid #ccc',
                'width': '41px'
            });
        }, function () {
            $('.home-search-ppl-box').hide();
            $('.select-person').css({
                'border-top-right-radius': '5px'
            });
            $('#icon-ppl').css({
                'border-top-left-radius': '5px',
                'border-right': '1px solid #ccc',
                'width': '40px'
            });
        });


        $('#icon-bycuisine,.txt-bycuisine,.home-search-cuisine-box').hover(function () {
            $('.home-search-cuisine-box').show();
            $('.txt-bycuisine').css({
                'border-top-right-radius': '0px'
            });
            $('#icon-bycuisine').css({
                'border-top-left-radius': '0px',
                'border-right': '0px solid #ccc',
                'width': '41px'
            });
        }, function () {
            $('.home-search-cuisine-box').hide();
            $('.txt-bycuisine').css({
                'border-top-right-radius': '5px'
            });
            $('#icon-bycuisine').css({
                'border-top-left-radius': '5px',
                'border-right': '1px solid #ccc',
                'width': '40px'
            });
        });

        $('#icon-bylocation,.txt-bylocation,.home-search-location-box').hover(function () {
            $('.home-search-location-box').show();
            $('.txt-bylocation').css({
                'border-top-right-radius': '0px'
            });
            $('#icon-bylocation').css({
                'border-top-left-radius': '0px',
                'border-right': '0px solid #ccc',
                'width': '41px'
            });
        }, function () {
            $('.home-search-location-box').hide();
            $('.txt-bylocation').css({
                'border-top-right-radius': '5px'
            });
            $('#icon-bylocation').css({
                'border-top-left-radius': '5px',
                'border-right': '1px solid #ccc',
                'width': '40px'
            });
        });

        $('.select-box-time').click(function () {
            var t = $(this).text();
            $('#timeday1').html(t);
            t = t.replace(":", ".");
            search_time = t;
            $('.home-search-time-box').hide();
            $('.select-time').css({
                'border-top-right-radius': '5px'
            });
            $('.icon-search-time').css({
                'border-top-left-radius': '5px',
                'border-right': '1px solid #ccc',
                'width': '40px'
            });
        });
        $('.select-box-time2').click(function () {
            var t = $(this).text();
            $('#timeday2').html(t);
            t = t.replace(":", ".");
            search_time = t;
            $('.home-search-time-box').hide();
            $('.select-time').css({
                'border-top-right-radius': '5px'
            });
            $('.icon-search-time').css({
                'border-top-left-radius': '5px',
                'border-right': '1px solid #ccc',
                'width': '40px'
            });
        });
        $('.select-box-ppl').click(function () {
            var p = $(this).text();
            var s = p.split(" ");
            if (lang != 'th' && s[0] > 1) {
                $('.select-person').html(p + 's');
            } else {
                $('.select-person').html(p);
            }
            if (s[0]) search_ppl = s[0];
            $('.home-search-ppl-box').hide();
            $('.select-person').css({
                'border-top-right-radius': '5px'
            });
            $('#icon-ppl').css({
                'border-top-left-radius': '5px',
                'border-right': '1px solid #ccc',
                'width': '40px'
            });
        });
    });
}

$(function () {
    var now = new Date();
    var current = new Date(now.getFullYear(), now.getMonth() + 1, now.getDate());
    var d = {
        dateFormat: 'd, M, yy',
        minDate: new Date(),
        maxDate: current,
        onSelect: function (dateText) {
            var newdate = changeDateTime(dateText);
            if (search_today == newdate) {
                $('#time2').hide();
                $('#time1').show();
                var t = $('#timeday1').text();
                t = t.replace(":", ".");
                search_time = t;
            } else {
                $('#time1').hide();
                $('#time2').show();
                var t = $('#timeday2').text();
                t = t.replace(":", ".");
                search_time = t;
            }
        }
    };
    if (lang == 'th') {
        d = {
            dateFormat: 'd, M, yy',
            dayNames: ['อาทิตย์', 'จันทร์', 'อังคาร', 'พุธ', 'พฤหัสบดี', 'ศุกร์', 'เสาร์'],
            dayNamesMin: ['อา.', 'จ.', 'อ.', 'พ.', 'พฤ.', 'ศ.', 'ส.'],
            minDate: new Date(),
            maxDate: current,
            monthNames: ['มกราคม', 'กุมภาพันธ์', 'มีนาคม', 'เมษายน', 'พฤษภาคม', 'มิถุนายน', 'กรกฎาคม', 'สิงหาคม', 'กันยายน', 'ตุลาคม', 'พฤศจิกายน', 'ธันวาคม'],
            monthNamesShort: ['ม.ค.', 'ก.พ.', 'มี.ค.', 'เม.ย.', 'พ.ค.', 'มิ.ย.', 'ก.ค.', 'ส.ค.', 'ก.ย.', 'ต.ค.', 'พ.ย.', 'ธ.ค.'],
            onSelect: function (dateText) {
                var newdate = changeDateTime(dateText);

                if (search_today == newdate) {
                    $('#time2').hide();
                    $('#time1').show();
                    var t = $('#timeday1').text();
                    t = t.replace(":", ".");
                    search_time = t;
                } else {
                    $('#time1').hide();
                    $('#time2').show();
                    var t = $('#timeday2').text();
                    t = t.replace(":", ".");
                    search_time = t;
                }
            }
        };
    } else if (lang == 'zh') {
        d = {
            dateFormat: 'd, M, yy',
            dayNames: ['星期日', '星期一', '星期二', '星期三', '星期四', '星期五', '星期六'],
            dayNamesMin: ['日', '一', '二', '三', '四', '五', '六'],
            minDate: new Date(),
            maxDate: current,
            monthNames: ['一月', '二月', '三月', '四月', '五月', '六月', '七月', '八月', '九月', '十月', '十一月', '十二月'],
            monthNamesShort: ['一月', '二月', '三月', '四月', '五月', '六月', '七月', '八月', '九月', '十月', '十一月', '十二月'],
            onSelect: function (dateText) {
                var newdate = changeDateTime(dateText);

                if (search_today == newdate) {
                    $('#time2').hide();
                    $('#time1').show();
                    var t = $('#timeday1').text();
                    t = t.replace(":", ".");
                    search_time = t;
                } else {
                    $('#time1').hide();
                    $('#time2').show();
                    var t = $('#timeday2').text();
                    t = t.replace(":", ".");
                    search_time = t;
                }
            }
        };
    }

    $("#date").datepicker(d);

    if (action == 'index') {
        $('#date').datepicker('setDate', new Date());
    }

    if (action == 'restaurant') {
        var uid = $('#uid').val();
        if (!uid) {
            $('#check-f5').click(function () {
                var d = $(this).attr('class');
                if (d == 'checked-validation') {
                    $(this).removeClass('checked-validation');
                    $(this).addClass('checked-notactive');
                    $('#email').val('');
                    $('#email').focus();
                }
            });

            $('#check-f6').click(function () {
                var d = $(this).attr('class');
                if (d == 'checked-validation') {
                    $(this).removeClass('checked-validation');
                    $(this).addClass('checked-notactive');
                    $('#cell').val('');
                    $('#cell').focus();
                }
            });
        }
    }

    $('#alertboxs,#closealert').click(function () {
        $('.centerpoint').hide();
    });

    $('.default').keyup(function () {
        $('#search_resto').val($(this).val());
    });
    $('body,.bnt-go-search').click(function () {
        if ($('#search_resto').val()) {
            $('.default').val($('#search_resto').val());
            $('.default').css({'color': '#222'});
        } else {
            $('.default').css({'color': '#767676'});
        }
    });
});

function changeDateTime(strDate) {

    var Date_ar = strDate.split(",");
    var dd = $.trim(Date_ar[0]);
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
    return date;
}

function hometosearch() {
    var cuisine_ar = [];
    var location_ar = [];
    var cuisine_ids_ar = [];
    $(".cuisine_search:checked").each(function () {
        cuisine_ar.push($(this).val().split("/"));
        cuisine_ids_ar.push($(this).data('cuisine-id'));
    });
    $(".location_search:checked").each(function () {
        location_ar.push($(this).val().split("/"));
    });
    var homesearch = $.merge(cuisine_ar, location_ar).toString();
    var time = search_time;
    var ppl = search_ppl;
    var strDate = $('#date').val();
    var Date_ar = strDate.split(",");
    var dd = $.trim(Date_ar[0]);
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
    var search_resto = $('#search_resto').val();
    var resto_name = '';

    if (search_resto) resto_name = '&name=' + search_resto;

    var location = basePath + '/' + countryCodeAlias + '/' + lang + '/' + city_select_alias + '/search/?search=' + homesearch + '&date=' + date + '&time=' + time + '&ppl=' + ppl + resto_name;
    if(cuisine_ids_ar.length > 0) {
        location += '&cuisine_ids=' + cuisine_ids_ar.join(',');
    }

    if (from) {
        window.location = location + '&from=' + from;
    } else {
        window.location = location;
    }
}

function changeDate(date) {
    var r = date.match(/^\s*([0-9]+)\s*\/\s*([0-9]+)\s*\/\s*([0-9]+)(.*)$/);
    return r[3] + "-" + r[2] + "-" + r[1];
}

function boytesting() {
}

function forgotpass() {
    var email = $('#frmUserEmail').val();
    var regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    if (!email) {
        alert(regis_alert_email);
        $('#frmUserEmail').focus();
        return false;
    } else if (!regex.test(email)) {
        alert(regis_alert_email);
        $('#frmUserEmail').focus();
        return false;
    } else {
        $("#user-forgotpass").attr("disabled", "disabled");
        $("#user-forgotpass").css({cursor: "default"});
        var url = apiURL + 'forgetpassword/email/' + email + '/?jsoncallback=?';
        $.ajax({
            url: url,
            type: "GET",
            dataType: "json",

            success: function (jsonData) {
                if (jsonData.status == 200) {
                    if (lang == 'th') {
                        alert('ระบบได้ทำการส่งรหัสผ่านไปยังอีเมลของคุณเสร็จเรียบร้อยแล้วค่ะ');
                    } else {
                        alert(jsonData.items);
                    }
                    setTimeout(function () {
                        if (from) {
                            window.location = basePath + '/' + countryCodeAlias + '/' + lang + '/login/?from=' + from;
                        } else {
                            window.location = basePath + '/' + countryCodeAlias + '/' + lang + '/login/';
                        }
                    }, 800);

                } else {
                    alert(jsonData.items);
                }
            },
            error: function (e) {
                alert(error_txt);
            }
        });
    }
}

function changepass(id) {
    var np = $('#pass_new').val();
    var cfnp = $('#pass_conf_new').val();

    if (np.length < 6) {
        if (lang == 'th') {
            alert('กรุณาใส่รหัสผ่านใหม่ที่มีอย่างน้อย 6 ตัวอักษร');
        } else if (lang == 'zh') {
            alert('請輸入至少6個字符的新密碼。');
        } else {
            alert('please enter new password with at least 6 characters.');
        }
        $('#pass_new').focus();
    } else if (cfnp.length < 6) {
        if (lang == 'th') {
            alert('กรุณาใส่ยืนยันรหัสผ่านใหม่ที่มีอย่างน้อย 6 ตัวอักษร');
        } else if (lang == 'zh') {
            alert('請輸入至少6個字符的確認密碼。');
        } else {
            alert('please enter confirm password with at least 6 characters.');
        }
        $('#pass_conf_new').focus();
    } else if (np != cfnp) {
        if (lang == 'th') {
            alert('รหัสผ่านใหม่และยืนยันรหัสผ่านเข้ากันไม่ได้');
        } else if (lang == 'zh') {
            alert('新密碼和確認密碼不兼容。');
        } else {
            alert('new password and confirm password are not compatible.');
        }
        $('#pass_conf_new').focus();
    } else {
        var url = apiURL + 'editUprofile/?jsoncallback=?';
        var data = {
            id: id,
            uPassword: np
        };
        $.post(url, data, function (jsonData) {
            if (jsonData.status == 200) {
                $('#pass_new').val('');
                $('#pass_conf_new').val('');
                $('#alertboxspass').show();
                setTimeout(function () {
                    $('#change_password').hide();
                    $('.userprofile_content').show();
                    $('#btneditprofile').show();
                    $('#btnbooking').hide();
                }, 200);
            } else {
                if (lang == 'th') {
                    alert('กรุณาลองใหม่อีกครั้งค่ะ');
                } else {
                    alert(jsonData.items);
                }
            }
        }, "json");
    }
}
