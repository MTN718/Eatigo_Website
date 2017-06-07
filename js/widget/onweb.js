//js
var date_th = new Array('มค', 'กพ', 'มีค', 'เม.ษ', 'พค', 'มิย', 'กค', 'สค', 'กย', 'ตค', 'พย', 'ธค'),
    date_en = new Array('jan', 'feb', 'mar', 'apr', 'may', 'jun', 'jul', 'aug', 'sep', 'oct', 'nov', 'dec'),
    date_zh = new Array('1月', '2月', '3月', '4月', '5月', '6月', '7月', '8月', '9月', '10月', '11月', '12月'),
    iStamp = '',
    matime = '',
    api_url = basePath + '/api/index/un/api/pa/deveatigo2013/key/TonyWilliamKong/',
    login = 'no',
    cs = 0,
    Path_icon = basePath + '/themes/default/images/new_icon_detail/',
    Path_img = basePath + '/themes/default/images/',
    emailfackbook = 'yes',
    regis_name = '',
    regis_email = '',
    regis_fbAccessToken = '',
    regis_fbUserID = '',
    discount_v,
    time_select,
    time_stamp = '',
    result_stamp = '',
    id_stamp = '',
    dc_stamp = '',
    seat_stamp = '',
    rSeat_stamp = '',
    ar_dd = Array();

function isValidEmail(str) {
    var filter = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i;
    return (filter.test(str));
}

function isValidPhone(phone) {
    var filter = /^[(]{0,1}[0-9]{3}[)]{0,1}[-\s\.]{0,1}[0-9]{3}[-\s\.]{0,1}[0-9]{1,6}$/;
    return (filter.test(phone));
}

$(document).ready(function () {

    getTimeSlot('no'); //'yes'
    $.ajaxSetup({cache: true});
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

    $("input").keyup(function () {
        var v1 = $("#name").val();
        var v2 = $("#email").val();
        var v3 = $("#cell").val();
        var v4 = $("#promo-code").val();
        var emailFormat = false;
        var PhoneFormat = false;

        if (v1 != '') {
            $('#name').css('color', '#000');
            if (!$('#uid').val()) {
                $("#facebook-tab").hide();
                $('#check-f4').show();
            }
            $("#check-f4").switchClass('checked-notactive', 'checked-active');
        } else {
            $('#name').css('color', '#b8b8b8');
            if (!$('#uid').val()) {
                $("#facebook-tab").show();
                $('#check-f4').hide();
            }
            $("#check-f4").switchClass('checked-active', 'checked-notactive');
        }

        if (v2.length > 0) {
            $("#check-f5").removeClass('checked-notactive');
            emailFormat = isValidEmail(v2);
            $('#email').css('color', '#000');
            if (emailFormat == true) {
                $("#check-f5").removeClass('checked-validation');
                $("#check-f5").addClass('checked-active');
            } else {
                $("#check-f5").removeClass('checked-active');
                $("#check-f5").addClass('checked-validation');
            }
        } else {
            $('#email').css('color', '#b8b8b8');
            $("#check-f5").removeClass('checked-active');
            $("#check-f5").removeClass('checked-validation');
        }

        if (v3 != '') {
            $("#check-f6").removeClass('checked-notactive');
            PhoneFormat = isValidPhone(v3);
            $('#cell').css('color', '#000');
            if (PhoneFormat == true) {
                $("#check-f6").removeClass('checked-validation');
                $("#check-f6").addClass('checked-active');
            } else {
                $("#check-f6").removeClass('checked-active');
                $("#check-f6").addClass('checked-validation');
            }
        } else {
            $('#cell').css('color', '#b8b8b8');
            $("#check-f6").removeClass('checked-active');
            $("#check-f6").removeClass('checked-validation');
        }
        if (v4 != '') {
            $('#promo-code').css('color', '#000');
            $("#check-f7").switchClass('checked-notactive', 'checked-active');
        } else {
            $('#promo-code').css('color', '#b8b8b8');
            $("#check-f7").switchClass('checked-active', 'checked-notactive');
        }
    });
});

function facebookAutoLogin() {
    FB.api('/me', function (response) {
        if (response.email != null) {
            var url = api_url + 'type/login/email/' + response.email + '/fbAccessToken/' + FB.getAuthResponse()['accessToken'] + '/fbUserID/' + response.id + '/?jsoncallback=?';
            $.ajax({
                url: url,
                type: "GET",
                dataType: "jsonp",
                success: function (jsonData) {
                    if (jsonData.status == 200) {
                        makeSessionwidget(jsonData.items.id, jsonData.items.userType, jsonData.items.userFirstName, response.id, jsonData, jsonData.items.user_lang);
                        $('#uid').val(jsonData.items.id);
                        $('#promocode-box').show();
                        login = 'yes';
                        if (jsonData.items.userPhone) {
                            if (jsonData.items.userPhone != null) {
                                document.getElementById("cell").disabled = true;
                                document.getElementById('cell').value = jsonData.items.userPhone;
                                $('#cell').css('color', '#000');
                                $("#check-f6").removeClass('checked-notactive');
                                $("#check-f6").removeClass('checked-validation');
                                $("#check-f6").addClass('checked-active');
                            }
                        }

                        if (jsonData.items.userPhoneCC) {
                            document.getElementById('cc').value = jsonData.items.userPhoneCC;
                            document.getElementById("cc").disabled = true;
                        }

                        var today = new Date();
                        var fullname = jsonData.items.userFirstName + ' ' + jsonData.items.userLastName;
                        var umail = jsonData.items.userEmail;
                        var uphone = jsonData.items.userPhoneCC + ' ' + jsonData.items.userPhone;

                    } else {
                        regis(response.first_name, response.email, FB.getAuthResponse()['accessToken'], response.id);
                    }
                },
                error: function (e) {
                    alert(error_txt);
                }
            });
            if (response.name != null) {
                document.getElementById('name').value = response.name;
                $('#name').css('color', '#000');
                $("#check-f4").removeClass('checked-notactive');
                $("#check-f4").removeClass('checked-validation');
                $("#check-f4").addClass('checked-active');
                $('#check-f4').show();
            }
            if (response.email != null) {
                document.getElementById('email').value = response.email;
                $('#email').css('color', '#000');
                $("#check-f5").removeClass('checked-notactive');
                $("#check-f5").removeClass('checked-validation');
                $("#check-f5").addClass('checked-active');
            }
            document.getElementById('facebook-tab').style.display = 'none';
            document.getElementById("email").disabled = true;
            $('#overlaylogin').hide();
        } else {
            if (response.id && FB.getAuthResponse()['accessToken']) {
                var url = api_url + 'type/login/email/' + response.id + '@facebook.com/fbAccessToken/' + FB.getAuthResponse()['accessToken'] + '/fbUserID/' + response.id + '/?jsoncallback=?';
                $.ajax({
                    url: url,
                    type: "GET",
                    dataType: "jsonp",
                    //async:false,
                    success: function (jsonData) {
                        if (jsonData.status == 200) {
                            makeSessionwidget(jsonData.items.id, jsonData.items.userType, jsonData.items.userFirstName, response.id, jsonData, jsonData.items.user_lang);
                            var today = new Date();
                            var fullname = jsonData.items.userFirstName + ' ' + jsonData.items.userLastName;
                            var umail = response.id + '@facebook.com';
                            var uphone = jsonData.items.userPhoneCC + ' ' + jsonData.items.userPhone;

                            emailfackbook = 'yes';
                            login = 'yes';
                            if (jsonData.items.userPhone) {
                                if (jsonData.items.userPhone != null) {
                                    document.getElementById("cell").disabled = true;
                                    document.getElementById('cell').value = jsonData.items.userPhone;
                                    $('#cell').css('color', '#000');
                                    $("#check-f6").removeClass('checked-notactive');
                                    $("#check-f6").removeClass('checked-validation');
                                    $("#check-f6").addClass('checked-active');
                                }
                            }

                            if (jsonData.items.userPhoneCC) {
                                document.getElementById('cc').value = jsonData.items.userPhoneCC;
                                document.getElementById("cc").disabled = true;
                            }
                        } else {
                            regis_fbAccessToken = FB.getAuthResponse()['accessToken'];
                            regis_fbUserID = response.id;
                            emailfackbook = 'no';
                        }
                    },
                    error: function (e) {
                        alert(error_txt);
                    }
                });
                document.getElementById('email').value = response.id + '@facebook.com';
                if (response.name != null) {
                    document.getElementById('name').value = response.name;
                    $('#name').css('color', '#000');
                    $("#check-f4").removeClass('checked-notactive');
                    $("#check-f4").removeClass('checked-validation');
                    $("#check-f4").addClass('checked-active');
                    $('#check-f4').show();
                }
                if (response.id) {
                    $('#email').css('color', '#000');
                    $("#check-f5").removeClass('checked-notactive');
                    $("#check-f5").removeClass('checked-validation');
                    $("#check-f5").addClass('checked-active');
                }
                document.getElementById('facebook-tab').style.display = 'none';
                $('#overlaylogin').hide();
            }
        }
    });
}


//------------ boy-2014/12/02 ---------------------//

function makeSessionwidget(id, userType, name, fb_img, userDetail, uLang) {
    if (uLang == '2') {
        uLang = 'th';
    } else if (uLang == '1') {
        uLang = 'en';
    } else {
        uLang = uLang;
    }
    $('#uid').val(id);
    var href = basePath + '/' + countryCode + '/' + lang + '/user/?from=' + from;
    if (city_select != '') {
        href = basePath + '/' + countryCode + '/' + lang + '/' + city_select + '/user/?from=' + from;
    }
    var src = 'https://graph.facebook.com/' + fb_img + '/picture';
    var html = '<a href="' + href + '" id="header-user" target="_top" title="' + name + '"><img id="header-userPicHeader" class="header-userPicHeader" src="' + src + '" alt="' + name + '"></a>';
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
        },
        error: function (e) {
        }
    });
}

function makeCC(cc) {
    if (cc != null) {
        var url = api_url + 'type/countryinfo/?jsoncallback=?';
        $.ajax({
            url: url,
            type: "GET",
            dataType: "jsonp",
            success: function (items) {
                var html = '';
                html += '<select class="cc" id="cc" name="cc">';
                $.each(items, function (index, item) {
                    html += '<option value="' + index + '"';
                    html += ' data-img="' + item.flag + '" data-code="' + item.CountryCallingCode + '" ';
                    if (item.CountryCallingCode == cc) {
                        html += ' selected';
                    }
                    html += '>';
                    html += '+(' + item.CountryCallingCode + ')';
                    html += '</option>';
                });
                html += '</select>';
                $("#ccp").html(html);
                document.getElementById("cc").disabled = true;
            },
            error: function (e) {
            }
        });
    }
}

function format(state) {
    var src = $('.cc option:eq(' + state.id + ')').data("img");
    return "<img class='flag' src='" + src + "' alt=''/>" + state.text;
}

function regis2() {
    var name = $('#name').val();
    name = name.replace(' ', '');
    var email = $('#email').val();
    var fbAccessToken = regis_fbAccessToken;
    var fbUserID = regis_fbUserID;
    var url = api_url + 'type/regis/fname/' + name + '/lname//email/' + email + '/fbAccessToken/' + fbAccessToken + '/fbUserID/' + fbUserID + '/uPassword//gender//?jsoncallback=?';
    $.ajax({
        url: url,
        type: "GET",
        dataType: "jsonp",
        //async:false,
        success: function (jsonData) {
            if (jsonData.status == 200) {
                var today = new Date();
                var fullname = jsonData.items.userFirstName + ' ' + jsonData.items.userLastName;
                var umail = jsonData.items.userEmail;
                var uphone = jsonData.items.userPhoneCC + ' ' + jsonData.items.userPhone;

                emailfackbook = 'yes';
                facebookAutoLogin();
            } else {
                //facebookAutoLogin();
            }
        },
        error: function (e) {
            alert(error_txt);
        }
    });
}

function regis(name, email, fbAccessToken, fbUserID) {
    name = name.replace(' ', '');
    var url = api_url + 'type/regis/fname/' + name + '/lname//email/' + email + '/fbAccessToken/' + fbAccessToken + '/fbUserID/' + fbUserID + '/uPassword//gender//?jsoncallback=?';
    $.ajax({
        url: url,
        type: "GET",
        dataType: "jsonp",
        //async:false,
        success: function (jsonData) {
            if (jsonData.status == 200) {
                $('#uid').val(jsonData.items.id);
                $('#promocode-box').show();
                makeSession(jsonData.items.id, jsonData.items.userType, jsonData.items.userFirstName, response.id, jsonData, jsonData.items.user_lang);
                facebookAutoLogin();
                var today = new Date();
                var fullname = jsonData.items.userFirstName + ' ' + jsonData.items.userLastName;
                var umail = jsonData.items.userEmail;
                var uphone = jsonData.items.userPhoneCC + ' ' + jsonData.items.userPhone;
            } else {
                //facebookAutoLogin();
            }
        },
        error: function (e) {
            alert(error_txt);
        }
    });
}

function getTimeSlot(m) {
    document.getElementById('slot-loading').style.display = 'block';
    document.getElementById('slot-html').style.display = 'none';

    $('#slot-loading2').show();
    $('#slot-html2').hide();

    document.getElementById('pick').innerHTML = widget4_puurdeal;
    var date = document.getElementById('date').value;
    var ppl = document.getElementById('ppl').value;
    if (ppl == '') {
        ppl = 1;
        cs = 0;
        $('#ppl').css('color', '#b8b8b8');
        $("#check-f2").switchClass('checked-active', 'checked-notactive');
    } else {
        cs = 1;
        $('#ppl').css('color', '#000');
        $("#check-f2").switchClass('checked-notactive', 'checked-active');
    }
    var time = document.getElementById('time').value;
    if ((date != '') && (ppl != '')) {
        time_select = time;
        var rid = document.getElementById('rid').value;
        var url = api_url + 'type/timeslot/rid/' + rid + '/date/' + date + '/time/' + time + '/ppl/' + ppl + '/country/' + countryID + '/?jsoncallback=?';
        $.ajax({
            url: url,
            type: "GET",
            dataType: "jsonp",
            //async:false,
            success: function (jsonData) {
                if (jsonData.items) {
                    makeSlotHTML(jsonData, m, date);
                } else {
                    makeSlotHTML(jsonData, m, date);
                }
            },
            error: function (e) {
                alert(error_txt);
            }
        });
    }
}

function onlyUnique(value, index, self) {
    return self.indexOf(value) === index;
}

function dropdownmenu() {
    var ar_un = ar_dd.filter(onlyUnique);
    ar_un.sort();
    ar_un.reverse();
    var html = '';
    for (var i = 0; i < ar_un.length; i++) {
        html += '<option value="' + ar_un[i] + '">' + ar_un[i] + '%</option>';
    }
    if (html) {
        $('#pcl').html(html);
        $("#pcl").val(ar_un[0]).trigger('change');
    }
}

function makeSlotHTML(jsonData, m, mdate) {
    var html = '';
    var html2 = '';
    if (jsonData.items && jsonData.items.length > 0) {
        if (mdate != date) time_select = jsonData.items[0].time;
        html += '<div class="goUp" id="goUp"></div>';
        html += '<div class="swiper-container" id="slot-box"><div class="swiper-wrapper">';//slot-box
        html2 += '<div class="goUp" id="goUp2"></div>';
        html2 += '<div class="swiper-container" id="slot-box2"><div class="swiper-wrapper">';//slot-box
        var length = jsonData.items.length;
        var loop = 0;
        $.each(jsonData.items, function (i, val) {
            ar_dd.push(parseInt(val.discount));
            loop++;
            if (i % 3 == 0) {
                html += '<div class="swiper-slide">';
                html2 += '<div class="swiper-slide">';
            } else if ((i == jsonData.items.length) && (i != '')) {
                html += '<div class="swiper-slide" style="border:#000 solid 1px;">';
                html2 += '<div class="swiper-slide" style="border:#000 solid 1px;">';
            }

            if (val.slotStatus == 'close') {
                html += '<div class="close" id="slot-' + i + '"></div>';
                html2 += '<div class="close" id="slot-' + i + '"></div>';
                if (time_select == val.time) time_select = '';
            } else if (val.slotStatus == 'Soldout') {
                html += '<div class="soldout ' + lang + '" id="slot-' + i + '"></div>';
                html2 += '<div class="soldout ' + lang + '" id="slot-' + i + '"></div>';
                if (time_select == val.time) time_select = '';
            } else {
                var nTime = val.time;
                nTime = nTime.replace(".", ":");
                html += '<div class="open track-discount" id="slot-' + i + '" onClick="stamp(';
                html += "'" + val.time + "', '" + length + "', 'slot-" + i + "', '" + val.discount + "', '" + val.seatAvailable + "', '" + val.realSeatAvailable + "');";
                html += '"><div class="slot-time normal-font font-weight-bold">' + nTime + '</div><div class="slot-discount"><h1 class="font-weight-bold"><span>-</span>' + val.discount + '</h1></div><div class="slot-p">%</div><span class="slot-o">off</span></div>';
                html2 += '<div class="open track-discount" id="slot-' + i + '" onClick="stamp(';
                html2 += "'" + val.time + "', '" + length + "', 'slot-" + i + "', '" + val.discount + "', '" + val.seatAvailable + "', '" + val.realSeatAvailable + "');";
                html2 += '"><div class="slot-time normal-font font-weight-bold">' + nTime + '</div><div class="slot-discount"><h1 class="font-weight-bold"><span>-</span>' + val.discount + '</h1></div><div class="slot-p">%</div><span class="slot-o">off</span></div>';
            }

            if (loop % 3 == 0) {
                html += '</div>';
                html2 += '</div>';
            } else if ((loop == jsonData.items.length) && (loop != '')) {
                html += '</div>';
                html2 += '</div>';
            }
        });
        html += '</div></div>';
        html2 += '</div></div>';
        if (loop > 6) {
            html += '<div class="goDown" id="goDown"></div>';
            html2 += '<div class="goDown" id="goDown2"></div>';
        }
        document.getElementById('slot-loading').style.display = 'none';
        document.getElementById('slot-html').style.display = 'block';
        document.getElementById('slot-html').innerHTML = html;

        $('#slot-loading2').hide();
        $('#slot-html2').show();
        $('#slot-html2').html(html2);
        swipper();
        if (time_stamp != '' && result_stamp != '' && id_stamp != '' && dc_stamp != '' && seat_stamp != '' && rSeat_stamp != '') {
            $('#' + id_stamp).trigger('click');
        }
        $(".percent").val(dc_stamp).trigger('change');
        dropdownmenu();
    } else {
        html = '<div class="slot-space"></div><div class="">' + widget4_atttricpsad + '</div><div class="slot-space"></div>';
        html2 = '<div class="slot-space"></div><div class="">' + widget4_atttricpsad + '</div><div class="slot-space"></div>';
        document.getElementById('slot-loading').style.display = 'none';
        document.getElementById('slot-html').style.display = 'block';
        document.getElementById('slot-html').innerHTML = html;
        $('#slot-html2').show();
        $('#slot-html2').html(html2);
        $('.move').css('margin-top', '0px');
    }
}

function swipper() {
    var mySwiper = $('#slot-box').swiper({mode: 'vertical', slidesPerView: 'auto', grabCursor: true});
    $('#goUp').on('click', function (e) {
        e.preventDefault();
        mySwiper.swipePrev();
    });
    $('#goDown').on('click', function (e) {
        e.preventDefault();
        mySwiper.swipeNext();
    });
    mySwiper.swipeTo(iStamp, 200, true);
}

function getNextDate(m) {
    var enterDate = (document.getElementById('date').value);
    var mydate = new Date(enterDate);
    mydate.setDate(mydate.getDate() + 1);
    var maMonth = mydate.getMonth() + 1;
    maMonth = maMonth.toString();
    if (maMonth.length == 1) maMonth = '0' + maMonth;
    var md = mydate.getDate();
    md = md.toString();
    if (md.length == 1) md = '0' + md;
    var nDate = mydate.getFullYear() + '-' + maMonth + '-' + md;
    document.getElementById('date').value = nDate;
    getTimeSlot(m);
}

function move2step(id) {
    if (emailfackbook == 'no') {
        regis2();
    }
    var bh = $('#box-1').height();
    $('.alert-promocomde').css('height', bh + 'px');
    if (id == 2) {
        var name = document.getElementById('name').value;
        var cName = checkBnameNs(name);
        var email = $.trim(document.getElementById('email').value);
        var emailFormat = isValidEmail(email);
        var cell = document.getElementById('cell').value;
        var cc = $('#cc').val();
        var rid = document.getElementById('rid').value;

        if (cs == 0) {
            document.getElementById('ppl').focus();
            var html = widget4_psyps + '<br><br>' + $("#ppl2").html();
            $('.widget-tfl-txt').html(html); //console.log(html);
            document.getElementById('widget-tfl').style.display = 'block';
        } else if (matime == '') {
            $('.widget-tfl-txt').html(widget4_puurdeal);
            document.getElementById('widget-tfl').style.display = 'block';
        } else if (name.length <= 1) {
            $('.widget-tfl-txt').html(widget4_pipyn);
            document.getElementById('widget-tfl').style.display = 'block';
            document.getElementById('name').focus();
            $('.name').addClass('ma-input');
            return false;
        } else if (cName == 'no') {
            $('.widget-tfl-txt').html(widget4_pipyn);
            document.getElementById('widget-tfl').style.display = 'block';
            document.getElementById('name').focus();
            $('.name').addClass('ma-input');
            return false;
        } else if (email.length == 0) {
            $('.widget-tfl-txt').html(widget4_pipyem);
            document.getElementById('widget-tfl').style.display = 'block';
            document.getElementById('email').focus();
            $('.email').addClass('ma-input');
            return false;
        } else if (emailFormat == false) {
            $('.widget-tfl-txt').html(widget4_pipyem);
            document.getElementById('widget-tfl').style.display = 'block';
            document.getElementById('email').focus();
            $('.email').addClass('ma-input');
            return false;
        } else if (cell.length == 0) {
            $('.widget-tfl-txt').html(widget4_pipyc);
            document.getElementById('widget-tfl').style.display = 'block';
            document.getElementById('cell').focus();
            $('.cell').addClass('ma-input');
            return false;
        } else if (isNaN(cell)) {
            $('.widget-tfl-txt').html(widget4_pipyc);
            document.getElementById('widget-tfl').style.display = 'block';
            document.getElementById('cell').focus();
            $('.cell').addClass('ma-input');
            return false;
        } else if ((cc == 66) && (cell.length < 9)) {
            $('.widget-tfl-txt').html(widget4_pipyc);
            document.getElementById('widget-tfl').style.display = 'block';
            document.getElementById('cell').focus();
            $('.cell').addClass('ma-input');
            return false;
        } else if ((cc == 66) && (cell.length > 10)) {
            $('.widget-tfl-txt').html(widget4_pipyc);
            document.getElementById('widget-tfl').style.display = 'block';
            document.getElementById('cell').focus();
            $('.cell').addClass('ma-input');
            return false;
        } else {
            $('#show-name').html(name);
            $('#show-email').html(email);
            $('#show-cell').html('+(' + cc + ') ' + cell);
            var promocode = $('#promo-code').val();
            var uid = $('#uid').val();
            if (promocode) {
                $('.alert-promocomde,.w-img-promocode').hide();
                $('.alert-promocomde,.s-img-promocode').hide();
                $('#txt-promcode').html('');
                var url = apiURL + 'promoCode/code/' + promocode + '/id/' + uid + '/rid/' + rid + '/?jsoncallback=?';

                $.get(url, function (jsonData) {
                    if (jsonData.status == 200) {
                        $('#step1').hide();
                        $('#step2').show();
                        $('#txt-promcode').html(jsonData.items);
                        $('.alert-promocomde,.s-img-promocode').show();
                        var bh = $('#box-2').height();
                        $('.alert-promocomde').css('height', bh + 'px');
                    } else {
                        $('#txt-promcode').html(jsonData.items);
                        $('.alert-promocomde').css('height', bh + 'px');
                        $('.alert-promocomde,.w-img-promocode').show();
                    }
                }, 'json');
            } else {
                $('#step1').hide();
                $('#step2').show();
            }
        }
    } else {
        document.getElementById('step1').style.display = 'block';
        document.getElementById('step2').style.display = 'none';
    }
}

function checkBnameNs(string) {
    if (/^ *$/.test(string)) {
        return ('no');
    } else {
        return ('yes');
    }
}

function chPP() {
    ppl = document.getElementById('ppp').value;
    if (ppl > 0) cs = 0;
    $('#ppl').val(ppl);
    var ppp = $('#ppp').val();
    if (ppp) {
        $('#ppp').css('color', '#000');
    } else {
        $('#ppp').css('color', '#b8b8b8');
    }
}

function doBooking() {
    if (document.getElementById('yes').checked == false) {
        document.getElementById('yes').focus();
    } else {
        var promocode = $('#promo-code').val();
        var name = document.getElementById('name').value;
        var email = document.getElementById('email').value;
        var emailFormat = isValidEmail(email);
        var cell = document.getElementById('cell').value;
        var cc = $('#cc').val();
        var rid = document.getElementById('rid').value;
        document.getElementById('step1').style.display = 'none';
        document.getElementById('step2').style.display = 'none';
        document.getElementById('loading-page').style.display = 'block';
        if (cell[0] == 0) cell = replaceStr(cell, 0, '');
        var ppl = document.getElementById('ppl').value;
        var url = apiURL + 'booking/email/' + email + '/cc/' + cc + '/phone/' + cell + '/rid/' + rid + '/date/' + date + '/time/' + time_select + '/ppl/' + ppl + '/from/' + from + '/fname/' + name + '/login/' + login + '/code/' + promocode + '/lat/' + ulat + '/lon/' + ulon + '/?jsoncallback=?';

        $.ajax({
            url: url,
            type: "GET",
            dataType: "json",
            //async:false,
            success: function (jsonData) {
                if (jsonData.status == 200) {

                    ga('ec:addProduct', {            // Provide product details in a productFieldObject.
                        'id': rId,                   // Restaurant ID (string).
                        'name': widget4_rName,       // Restaurant name (string).
                        'category': '',              // don't send or empty string if required (string).
                        'brand': '',                 // don't send or empty string if required (string).
                        'variant': '',               // don't send or empty string if required (string).
                        'price': ppl,                // Number of Guests (currency).
                        'coupon': '',                // don't send or empty string if required (string).
                        'quantity': 1                // _Always "1"_ (number).
                    });

                    ga('ec:setAction', 'purchase', {        // Transaction details are provided in an actionFieldObject.
                        'id': jsonData.items.bookingID,     // (Required) Transaction id (string).
                        'affiliation': 'Booking Form',      // Always "Booking Form" (string).
                        'revenue': ppl,                     // Number of Guests (currency).
                        'tax': discount_v,                  // Discount Percentage (currency).
                        'shipping': time_select,            // Time of Reservation (currency).
                        'coupon': ''                        // don't send or empty string if required (string).
                    });

                    ga('send', 'pageview');
                    document.getElementById('show-name2').innerHTML = name;
                    document.getElementById('show-cell2').innerHTML = '+(' + cc + ') ' + cell;
                    document.getElementById('show-email2').innerHTML = email;
                    document.getElementById('step3').style.display = 'block';
                    document.getElementById('loading-page').style.display = 'none';
                    var day = new Date();
                    var curr_date = day.getDate();
                    var curr_month = day.getMonth();
                    var curr_year = day.getFullYear();
                    var today = curr_year + '-' + curr_month + '-' + curr_date;

                    if (from == 'www.eatigo.com' || from == 'shopback') {
                        var bookingAuthToken = jsonData.items['booking_auth_token'];
                        $.each(jsonData.items, function (i, val) {
                            if (i == 'bookingID') {
                                var reUrl = basePath + '/' + countryCodeAlias + '/' + lang + '/booking-confirmation/bid/' + val + '/from//tracking/yes/cancc/yes/';
                                if (city_select != '') {
                                    var reUrl = basePath + '/' + countryCodeAlias + '/' + lang + '/' + city_select + '/booking-confirmation/bid/' + val + '/from//tracking/yes/cancc/yes/';
                                }

                                if (bookingAuthToken) {
                                    reUrl = reUrl + '?booking_auth_token=' + bookingAuthToken;
                                }

                                var shopbackOfferId = '';

                                if(countryCodeAlias == 'sg'){
                                    shopbackOfferId = '1514';
                                } else if (countryCodeAlias == 'my'){
                                    shopbackOfferId = '1636';
                                } else if (countryCodeAlias == 'th'){
                                    shopbackOfferId = '1618';
                                }

                                if(shopbackOfferId != ''){
                                    var bookDateParts = date.split('-');
                                    var year = bookDateParts[0];
                                    var month = bookDateParts[1];
                                    var day = bookDateParts[2];
                                    var newDate = day + '' + month + '' + year;
                                    var bookCode = jsonData.items.code;
                                    var restoName = widget4_rName;
                                    var restoArea = restaurant_area;

                                    var img = new Image();
                                    img.onload = function() {
                                        window.top.location.href = reUrl;
                                    };
                                    img.src = "https://shopback.go2cloud.org/aff_l?offer_id=" + shopbackOfferId + "&adv_sub=" + bookCode
                                        + "&adv_sub2=1&adv_sub3=" + restoArea + "&adv_sub4=" + restoName + "&adv_sub5=" + newDate;

                                    setTimeout(function(){
                                        window.top.location.href = reUrl;
                                    }, 5000);
                                }else{
                                    window.top.location.href = reUrl;
                                }
                            }
                        });
                    } else {
                        var interval = setInterval(function () {
                            document.getElementById('step3').style.display = 'none';
                            document.getElementById('step2').style.display = 'none';
                            document.getElementById('step1').style.display = 'block';
                            clearInterval(interval);
                        }, 6000);
                    }
                } else {
                    if (jsonData.items == 'cannot booking, user was banned') {
                        document.getElementById('show-name2').innerHTML = name;
                        document.getElementById('show-cell2').innerHTML = '+(' + cc + ') ' + cell;
                        document.getElementById('show-email2').innerHTML = email;
                        document.getElementById('step3').style.display = 'block';
                        document.getElementById('loading-page').style.display = 'none';
                    } else {
                        alert(jsonData.items);
                        document.getElementById('step2').style.display = 'block';
                        document.getElementById('loading-page').style.display = 'none';
                    }
                }
            },
            error: function (e) {
                alert(error_txt);
                document.getElementById('step2').style.display = 'block';
                document.getElementById('loading-page').style.display = 'none';
            }
        });
    }
}

function isValidEmail(str) {
    var filter = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i;
    return (filter.test(str));
}

function replaceStr(str, pos, value) {
    var arr = str.split('');
    arr[pos] = value;
    return arr.join('');
}

$.loginFb = function () {
    FB.login(function (loginResponse) {
        if (loginResponse.status == 'connected' && loginResponse.authResponse != null) {
            facebookAutoLogin()
        }
    }, {scope: 'email,user_birthday'});
};

function moveDown() {
    $('.move').css('margin-top', '0px');
    var l = widget4_vl;
    var html = '<a class="move-down" id="move-down" href="javascript:moveUp();">- ' + l + '</a>';
    $('.move-down').html(html);
}

function moveUp() {
    document.getElementById('move-down').style.display = 'block';
    $('.move').css('margin-top', '-200px');
    var l = widget4_md;
    var html = '<a class="move-down" id="move-down" href="javascript:doNothing();" onClick="moveDown();">+ ' + l + '</a>';
    $('.move-down').html(html);
}

function autoStamp(time, dc) {
    discount_v = dc;
    time_select = time;
    matime = '1';
    var st = time_select.split(".");
    date = document.getElementById('date').value;
    var sd = date.split("-");
    if (sd[1][0] == 0) sd[1] = sd[1][1];
    if (lang == 'th') {
        var st2 = date_th[sd[1] - 1];
    } else if (lang == 'zh') {
        var st2 = date_zh[sd[1] - 1];
    } else {
        var st2 = date_en[sd[1] - 1];
    }
    if ((sd[2].length == 2) && (sd[2][0] == 0)) sd[2] = sd[2][1];
    var show_date;
    if (lang == 'zh'){
        show_date = '<span style="color:#000000">' + sd[0] + '年</span>' + st2 + '<span style="color:#000000">' + sd[2] + '日</span>';
    } else {
        show_date = '<span style="color:#000000">' + sd[2] + '</span> ' + st2 + ' <span style="color:#000000">' + sd[0] + '</span>';
    }

    var select_ppl = $('#ppl').val();
    if (select_ppl > 1) {
        var ppl_t = $('#ppl').val() + ' <font color="#000000">' + wppl2 + '</font>';
    } else {
        var ppl_t = $('#ppl').val() + ' <font color="#000000">' + wppl + '</font>';
    }
    discount = '<font color="#000000">' + wdc + '</font> ' + dc + '<font color="#000000">%</font>';

    document.getElementById('show-date').innerHTML = show_date;
    document.getElementById('show-ppl').innerHTML = ppl_t;
    document.getElementById('show-pc').innerHTML = discount;
    var time_show = st[0] + '<font color="#000000">:' + st[1] + '</font>';
    var timeD = '<font color="#000000">' + wat + '</font> ' + time_show;
    document.getElementById('show-time').innerHTML = timeD;
    document.getElementById('show-date2').innerHTML = show_date;
    document.getElementById('show-ppl2').innerHTML = ppl_t;
    document.getElementById('show-pc2').innerHTML = discount;
    document.getElementById('show-time2').innerHTML = timeD;
    document.getElementById('pick').innerHTML = time_show + ' - ' + discount;
}

function doClear() {
    document.getElementById('widget-tfl').style.display = 'none';
}

function stamp(time, result, id, dc, seat, rSeat) {
    time_stamp = time;
    result_stamp = result;
    id_stamp = id;
    dc_stamp = dc;
    seat_stamp = seat;
    rSeat_stamp = rSeat;
    discount_v = dc;
    time_select = time;

    $(".percent").val(dc).trigger('change');
    ppl = document.getElementById('ppl').value;

    if ((ppl == '') || (ppl == null) || (ppl == 0)) {
        document.getElementById('ppl').focus();
        document.getElementById('ppl').focus();
        document.getElementById('ppl').focus();
        var html = widget4_psyps + '<br><br>' + $("#ppl2").html();
        $('.widget-tfl-txt').html(html); //console.log(html);
        document.getElementById('widget-tfl').style.display = 'block';
        document.getElementById('widget-tfl').style.display = 'block';

        $("#check-f2").switchClass('checked-active', 'checked-notactive');
        $("#check-f3").switchClass('checked-active', 'checked-notactive');

    } else {
        if (seat < 0) {
            var ppl = $('#ppl').val();
            widget4_tfl = widget4_tfl.replace('%@', rSeat);
            $('.widget-tfl-txt').html(widget4_tfl);
            document.getElementById('widget-tfl').style.display = 'block';
            $("#check-f3").switchClass('checked-active', 'checked-notactive');

            time_stamp = '';
            result_stamp = '';
            id_stamp = '';
            dc_stamp = '';
            seat_stamp = '';
            rSeat_stamp = '';
            $("#ppl").val('').trigger('change');
        } else {
            $('#pick').css('color', '#000');
            $("#check-f3").switchClass('checked-notactive', 'checked-active');

            time_select = time;
            matime = '1';
            for (var i = 0; i < result; i++) {
                if (document.getElementById('slot-' + i).className.match(/(?:^|\s)close(?!\S)/)) {
                } else if (document.getElementById('slot-' + i).className.match(/(?:^|\s)soldout(?!\S)/)) {
                } else {
                    document.getElementById('slot-' + i).className = "open track-discount";
                }
            }

            var st = time_select.split(".");
            date = document.getElementById('date').value;
            var sd = date.split("-");
            if (sd[1][0] == 0) sd[1] = sd[1][1];
            if (lang == 'th') {
                var st2 = date_th[sd[1] - 1];
            } else if (lang == 'zh') {
                var st2 = date_zh[sd[1] - 1];
            } else {
                var st2 = date_en[sd[1] - 1];
            }
            if ((sd[2].length == 2) && (sd[2][0] == 0)) sd[2] = sd[2][1];
            var show_date;
            if (lang == 'zh'){
                show_date = '<span style="color:#000000">' + sd[0] + '年</span>' + st2 + '<span style="color:#000000">' + sd[2] + '日</span>';
            } else {
                show_date = '<span style="color:#000000">' + sd[2] + '</span> ' + st2 + ' <span style="color:#000000">' + sd[0] + '</span>';
            }

            var ppl_t = document.getElementById('ppl').value + ' <font color="#000000">' + wppl + '</font>';
            discount = '<font color="#000000">' + wdc + '</font> ' + dc + '<font color="#000000">%</font>';
            document.getElementById(id).className = "click track-discount";
            document.getElementById('show-date').innerHTML = show_date;
            document.getElementById('show-ppl').innerHTML = ppl_t;
            document.getElementById('show-pc').innerHTML = discount;
            var time_show = st[0] + '<font color="#000000">:' + st[1] + '</font>';
            var timeD = '<font color="#000000">' + wat + '</font> ' + time_show;
            document.getElementById('show-time').innerHTML = timeD;
            document.getElementById('show-date2').innerHTML = show_date;
            document.getElementById('show-ppl2').innerHTML = ppl_t;
            document.getElementById('show-pc2').innerHTML = discount;
            document.getElementById('show-time2').innerHTML = timeD;
            document.getElementById('pick').innerHTML = time_show + ' - ' + discount;
        }
    }
}

function swipper2(k, pp, i) {
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
    });
    mySwiper.swipeTo(pp, 200, true);
}

function chklogin() {
    var url = basePath + '/index/chacksecsion/?jsoncallback=?';
    $.get(url, null, function (rs) {
        console.log(rs);
        if (rs != 'error') {
        } else {
            $('#promo-code').val('');
            $('#overlaylogin').animate({opacity: 1}, 10, null, function () {
                $(this).show();
            });
        }
    });
}

$(window).load(function () {
    var n = $('#name').val();
    var e = $('#email').val();
    var p = $('#cell').val();

    if (n) {
        $('#name').css('color', '#000');
        $("#check-f4").switchClass('checked-notactive', 'checked-active');
    }
    if (e) {
        $('#email').css('color', '#000');
        $("#check-f5").switchClass('checked-notactive', 'checked-active');
    }
    if (p) {
        $('#cell').css('color', '#000');
        $("#check-f6").switchClass('checked-notactive', 'checked-active');
    }
    var b = $('#select-branch').val();
    if (b) {
        $('#select-branch').css('color', '#000');
    }
});
