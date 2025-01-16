
var wdth = $(window).width();
var displayModex = 'browser';
const mqStandAloneX = '(display-mode: standalone)';
if (navigator.standalone || window.matchMedia(mqStandAloneX).matches) {
    displayModex = 'standalone';
    if (wdth < 769) {
        displayModex = 'mobile';
    }
}
$(document).ready(function () {

    //var aa = getCookie('sidebarBg')
    //if (aa == '' || aa == null || aa == undefined || aa == 'color_1') {

    //    body.attr('data-sibebarbg', 'color_10');
    //    setCookie('sidebarBg', 'color_10');
    //}

    if (wdth < 769) {
        $(".brand-logo,.nav-header,.header").css('display', 'none');
        getMenuName();
        fn_set_searchBar();
    } else { }
});
function getMenuName() {
    var href = document.location.href;
    var pageName = href.substr(href.lastIndexOf('/') + 1);
    //pageName = pageName.split('?');
    if (pageName.length > 0) {
        pageName = pageName[0];
    }
    pageName = document.title
    pageName = pageName.toUpperCase();
    pageName = pageName.replace('.ASPX', '').replace('#', '').replace('?', '')
    if (pageName == 'SERVICES') {
        $('.div_mobile_next_page').css('display', 'none');
        $(".brand-logo,.nav-header,.header").css('display', 'block');

    } else {
        $("#lblMenuName").text(pageName);
        fn_saveurl(location.href.split("/").pop().split("?").shift());
        $("#bckbtn").attr('onclick', 'fn_goBack()');
    }

    //var data = getCookie("C_MenuData");
    //if (data != null && data != "" && data != undefined) {
    //    data = JSON.parse(data);
    //    if (data.length > 0) {
    //        var filt = $.filter(data, function (e) {e. })

    //    }
    //}


}
function fn_saveurl(url) {
    var olddata = localStorage.getItem('pageurls');
    var _aarr = [];
    var objdata = {};
    objdata.url = url;
    if (olddata != null && olddata != undefined && olddata != '') {
        olddata = JSON.parse(olddata);
        _aarr = olddata;
        objdata.id = (_aarr.length + 1)
        var nnn = olddata.filter(function (x) { return x.url.toLowerCase().trim() == url.toLowerCase().trim(); })
        if (nnn.length == 0) {
            _aarr.push(objdata);
        }
    } else {
        objdata.id = (_aarr.length + 1);
        _aarr.push(objdata);
    }
    localStorage.setItem('pageurls', JSON.stringify(_aarr));
}

function fn_goBack() {
    try {
        var olddata = localStorage.getItem('pageurls');
        var a = 'services.aspx';
        if (olddata != null && olddata != undefined && olddata != '') {
            olddata = JSON.parse(olddata);
            var nn = olddata.sort(function (a, b) {
                return b.id - a.id
            });
            if (nn.length > 0) {
                a = nn[1].url;
                olddata = nn.filter(function (obj) {
                    return obj.id !== nn[1].id;
                });
            } localStorage.setItem('pageurls', JSON.stringify(olddata));
        }
        window.location.href = a;
    } catch (ex) {
        window.location.href = 'services.aspx';
    }
}
function getCookie(cname) {
    let name = cname + "=";
    let decodedCookie = decodeURIComponent(document.cookie);
    let ca = decodedCookie.split(';');
    for (let i = 0; i < ca.length; i++) {
        let c = ca[i];
        while (c.charAt(0) == ' ') {
            c = c.substring(1);
        }
        if (c.indexOf(name) == 0) {
            return c.substring(name.length, c.length);
        }
    }
    return "";
}
$('.search-area .form-control').keyup(function (e) {
    searchByColumn($(this).val().toLowerCase())
});
function searchByColumn(filter) {

    $.each($("#menu li:gt(0)"), function (i, v) {

        if (filter == "") {
            $(v).css("visibility", "visible");
            $(v).fadeIn();
        } else if ($(v).text().search(new RegExp(filter, "i")) < 0) {
            $(v).css("visibility", "hidden");
            $(v).fadeOut();
        } else {
            $(v).css("visibility", "visible");
            $(v).fadeIn();
        }
    });
}

function fn_load_menus() {
    $("#menu").empty();
    $.ajax({
        url: "../registration.aspx/getSearlizedMenu",
        data: JSON.stringify({}),
        type: "post",
        dataType: "json",
        async: false,
        contentType: "application/json; charset=utf-8",
        success: function (response1) {
            response1 = JSON.parse(response1.d);
            if (response1.length > 0) {
                var lst = response1[0].menu;
                $("#menu").append(lst);
                $("#div_login_user").css('display', 'none');
                $('#menu').metisMenu('dispose').metisMenu();
                $('#ImgProfile').bind('error', function (e) {
                    this.src = '../NewDesign/images/profile/pic1.jpg';
                });
            }
        }
    });
}
function fnchild_menu(response1, data) {
    var lst = '';
    var Lmainmenu = response1.filter(function (o) { return o.ParentID === data.MenuID; });
    if (Lmainmenu.length > 0) {
        lst += '<ul aria-expanded="false" class="mm-collapse" style="height: 16px;">';
        $.each(Lmainmenu, function (i, v) {
            if (v["MenuLink"] != "" && v["MenuLink"] != "") {
                menuurl = v["MenuLink"];
            }
            var cls = '';
            if (Lmainmenu.length > 0) {
                cls = 'has-arrow';
            }
            Icon = v.Icon;
            lst += '<li class=""><a class="' + cls + '" href="' + menuurl + '" >' + Icon + '<span class="nav-text">' + v.MenuName + '</span></a>';
            lst += fnchild_menu2(response1, v.MenuID, v);
            lst += '</li>';
        });
        lst += '</ul>';
    }
    lst += '</li>';
    return lst;
}
function fnchild_menu(response1, data) {
    var lst = '';
    var Lmainmenu = response1.filter(function (o) { return o.ParentID === data.MenuID; });
    if (Lmainmenu.length > 0) {
        lst += '<ul aria-expanded="false" class="mm-collapse" style="height: 16px;">';
        $.each(Lmainmenu, function (i, v) {
            if (v["MenuLink"] != "" && v["MenuLink"] != "") {
                menuurl = v["MenuLink"];
            }
            var cls = '';
            if (Lmainmenu.length > 0) {
                cls = 'has-arrow';
            }
            Icon = v.Icon;
            lst += '<li class=""><a class="' + cls + '" href="' + menuurl + '" >' + Icon + '<span class="nav-text">' + v.MenuName + '</span></a>';
            lst += fnchild_menu3(response1, vv.MenuID, vv);
            lst += '</li>';
        });
        lst += '</ul>';
    }
    lst += '</li>';
    return lst;
}
function fnchild_menu(response1, data) {
    var lst = '';
    var Lmainmenu = response1.filter(function (o) { return o.ParentID === data.MenuID; });
    if (Lmainmenu.length > 0) {
        lst += '<ul aria-expanded="false" class="mm-collapse" style="height: 16px;">';
        $.each(Lmainmenu, function (i, v) {
            if (v["MenuLink"] != "" && v["MenuLink"] != "") {
                menuurl = v["MenuLink"];
            }
            var cls = '';
            if (Lmainmenu.length > 0) {
                cls = 'has-arrow';
            }
            Icon = v.Icon;
            lst += '<li class=""><a class="' + cls + '" href="' + menuurl + '" >' + Icon + '<span class="nav-text">' + v.MenuName + '</span></a>';
            //lst += fnchild_menu2(response1, vv.MenuID, vv);
            lst += '</li>';
        });
        lst += '</ul>';
    }
    lst += '</li>';
    return lst;
}

function onClicktest() {
    $.ajax({
        url: "newDashboard.aspx/SendNotificationTEST",
        data: JSON.stringify({}),
        type: "post",
        dataType: "json",
        contentType: "application/json; charset=utf-8",
        success: function (response1) {
            response1 = JSON.parse(response1.d);
        }
    });
}


function fn_share(evnt, id) {
    var url = '';

    var s = $(evnt).closest('.nav-item').attr('data-value');
    if (id == 3) {

        url = 'https://api.whatsapp.com/send?text=referral code is:' + s;
        window.open(url, '_blank');
    } else { url = s; navigator.clipboard.writeText(s); }


}

function fn_set_searchBar() {
    var x = `<div class="searchbox_div"  id="searchbox_div"><input type="text" id="txtSearchBox_service" onkeyup="fn_onkeyPress_search_service(this)" placeholder="Search here" /></div>`;
    $('body').append(x);
}
function fn_onkeyPress_search_service(evnt) {
    var x = $(evnt).val().toLowerCase();
    if (x == "") {
        $("._srvc_tabs >ul li").show();
        return;
    }
    $.each($("._srvc_tabs >ul li"), function (i, v) {
        var tt = $(v).children('a').children('span').text().toLowerCase();
        if (tt.indexOf(x) >= 0) {
            $(v).show();
        }
        else {
            $(v).hide();
        }
    });
}

//$(document).click(function () {
//    let get = document.getElementById('searchbox_div');
//    if (!get.contains(event.target)) {
//        $(document).find('#searchbox_div').css('display', 'none');
//    }
//});
$('.cls_search_searvices').click(function () {
    $(document).find('#searchbox_div').css('display', 'block');
    $('#txtSearchBox_service').focus();
});

$('._tab_service_lnk').click(function () {
    $(document).find('#searchbox_div').css('display', 'none');
})




function show_alert(msg, type) {
    var _icon = 'success'
    if (type == 2) {
        _icon = 'error';
        playAudio('../wrong-answer.mp3')
        Swal.fire({
            icon: _icon,
            title: msg
        });
    }
    if (type == 3) {

        Swal.fire({
            title: "warning",
            text: msg,
            timer: 2e3,
            showConfirmButton: !1
        });
    }
    else {
        playAudio('../success.mp3')
        Swal.fire({
            icon: _icon,
            title: msg
        });
    }


}
function playAudio(tes) {

}
$(document).on('select2:open', function (e) {
    window.setTimeout(function () {
        document.querySelector('input.select2-search__field').focus();
    }, 0);
});
