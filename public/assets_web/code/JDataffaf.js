this.CY_init = function () {
    "use strict";
    LoadLib();
    LoadSrvc();
    LoadFetchSrvc();

    if ($(window).width() < 769) {
        LoadForMobile();
        fn_loadSlider_Mobile();
    } 

    return true;
}
var w_Width = $(window).width();
var ismobile = $(window).width() <= 769 ? true : false;
var cls_mobile_op_search = '';
$(document).ready(function () {
    setInterval(function () {
        $('#loading').css('display', 'none');
    }, 300)
    $(document).ajaxStart(function () {
        $('#loading').css('display', 'block');
    }).ajaxStop(function () {
        $('#loading').css('display', 'none');
    });
})
var CUrl = location.protocol + '//' + location.host;
function LoadLib() {
    var css = ['/Code/CY_Style.css']
    var js = ['https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js', 'https://cdn.jsdelivr.net/npm/sweetalert2@11'];
    $.each(css, function (i, v) {
        var aa = v;
        if (v.indexOf('http') === -1)
            aa = CUrl + v;
        $('#srvc').append('<link rel="stylesheet" href="' + aa + '" type="text/css" />');
    });
    $.each(js, function (i, v) {
        $('#srvc').append('  <script src="' + v + '"></script>');
    });
    $("body").append('<div class="new_Loader" id="loading"><div><img src="../../code/Loader_image.gif" /></div></div>');
    var aaa = '<div class="div_wrapper"><div class="col-md-12"><div class="row"><div class="col-md-2"><div class="div_rc_Category"><ul class="srvc" id="srvcCatData"></ul></div></div><div class="col-md-10" ><div class="div_rc_Service" id="rcSrvc"></div></div></div></div></div>';
    $('#srvc').append(aaa);
}

function MakeDropdown() {
    var a = $('select');
    $.each(a, function (i, v) {
        var ol = '<ul>'
        $.each($(v).children('option'), function (i, v) {
            ol = ol + '<li data-value="' + $(v).val() + '">' + $(v).text() + '<li>'
        })
        ol = ol + '</ul>';
        $(v).hide().parent('div').addClass('select_parent_X').append('<input type="text" class="txtbox txtbox_select_X" id="txt_' + $(v).attr('id') + '" data-target="#div_' + $(v).attr('id') + '"/><div id="div_' + $(v).attr('id') + '"  class="select_div"  style="display: none;">' + ol + '</div>')
    });
}
function LoadForMobile() {
    var a = $('#srvcCatData li a');
    var bb = $('.div_rc_Service>div')
    $.each(bb, function (i, v) {
        var x = $(v).attr('id').replace('tab_', '');
        $.each(a, function (j, vv) {
            var y = $(vv).attr('data-target').replace('#tab_', '');
            if (x == y) {
                $(vv).parent('li').append($(v))
            }
        });
    });


}
function fn_getcatIcon(icons) {
    var caticon = [
        { name: 'recharge', icon: 'fa fa-mobile' },
        { name: 'bbps', icon: 'fa fa-address-book' },
        { name: 'banking', icon: 'fa fa-credit-card' },
        { name: 'travel', icon: 'fa fa-plane' },
        { name: 'other', icon: 'fa fa-info' },
        { name: 'affiliate links', icon: 'fa fa-link' }
    ];
    var a = $.grep(caticon, function (n, i) {
        return n.name == icons.toLowerCase();
    });
    if (a.length > 0) {
        return '<i class="' + a[0].icon + '"></i>';
    }

}
var countnoofshowServices = 5;
function LoadSrvc() {
    var uu = CUrl + '/Code/CYService.asmx/GetServices'
    $.ajax({
        type: "POST",
        url: uu,
        data: JSON.stringify({}),
        contentType: "application/json; charset=utf-8",
        dataType: "json",
        async: false,
        success: function (response) {
            response = JSON.parse(response.d);
            if (response.length > 0) {

                var cls_poweredby = '<div  class="_poweredby"><img src="../../code/bbps-approved.png" /></div>';
                $.each(response, function (i, v) {
                    var srvc = '';
                    var status = i == 0 ? (w_Width > 769 ? 'active' : '') : '';
                    var icons = fn_getcatIcon(v.catname);
                    if (v.catname.toLowerCase() == 'recharge') {
                        icons = '<img src="../../code/recharge.jpg" style="height:28px;" class="cls_bbps"/>';
                    }else
                    if (v.catname.toLowerCase() == 'bbps') {
                        icons = '<img src="../../code/bbps.png" style="height:28px;" class="cls_bbps"/>';
                    }
                    else if (v.catname.toLowerCase() == 'banking') {
                        icons = '<img src="../../code/banking1.jpg" style="height:28px;" class="cls_bbps"/>';
                    }
                    else if (v.catname.toLowerCase() == 'travel') {
                        icons = '<img src="../../code/travel.jpg" style="height:28px;" class="cls_bbps"/>';
                    }
                    else if (v.catname.toLowerCase() == 'other') {
                        icons = '<img src="../../code/other.jpg" style="height:28px;" class="cls_bbps"/>';
                    }
                    else if (v.catname.toLowerCase() == 'affiliate links') {
                        icons = '<img src="../../code/link.png" style="height:28px;" class="cls_bbps"/>';
                    }
                    else if (v.catname.toLowerCase() == 'verifyfetch') {
                        icons = '<img src="../../code/verify.png" style="height:28px;" class="cls_bbps"/>';
                    }
                    else {
                        //icons = icons == undefined ? '' : icons;
                        //icons = icons + v.catname;
                    }

                    srvc = '<li><a class="cls_srvcIterms ' + status + '" data-value="' + v.id + '" data-target="#tab_' + (v.catname).replace(' ', '') + '">' + icons + '</a></li>'
                    $("#srvcCatData").append(srvc);
                    $("#rcSrvc").append('<div class="_srvc_tabs ' + status + '" id="tab_' + (v.catname).replace(' ', '') + '"><ul id="ULSrvc_' + i + '"></ul></div>');
                    var count = 0;

                    $.each(v.servicename, function (ii, vv) {
                        var ServiceName = (vv.name).replaceAll(' ', '').replaceAll('-', '');
                        var localurl = window.location.href.toLowerCase().indexOf('/member/') > 0 ? '' : 'root/member/';
                        var pageurl = vv.PAGEURL == '#' ? 'data-target="#' + ServiceName + '"' : (vv.ISFORLOGIN == 1 ? 'data-href="' : 'href="') + localurl + vv.PAGEURL + '"';
                        //var imgicon = '/images/appicon/' + (vv.ImageIcon == undefined ? "icons_mobile.png" : vv.ImageIcon);
                        var imgicon = '/images/appicon/' + (vv.id == undefined ? "1" : vv.id) + '.png';
                        if (ismobile) {
                            cls_mobile_op_search = '<div class="div_operator_search"><input type="text" id="txt_search_operator' + ii + '" placeholder="Search Operator" onkeyup="fn__search_operator(this)" data-target="#ddl_opertor_' + ServiceName + '" class="txtbox cls_search_operator" /></div>';
                        }
                        var slider = ''
                        if (w_Width > 769) {
                            slider = '<div class="_slider_service">' + fn_loadServicewiseSlider(vv.id) + '</div>';
                        }
                        var x = '<li><a class="_tab_service_lnk ' + (ii == 0 ? 'active' : '') + ' " data-value="' + vv.id + '" ' + pageurl + '><img class="img_icon" src="' + CUrl + '' + imgicon + '"/> <br /><span>' + vv.name + '</span></a></li>';
                        $('#ULSrvc_' + i).append(x);
                        var b = '', backbtn = '';
                        if (w_Width < 769) {
                            backbtn = '<a class="backbtn"><i  class="fa fa-arrow-left"></i></a>';
                        }
                        if (ServiceName == 'PrepaidMobile') {
                            b = '<div class="cls_tbl_tab_service ' + (ii == 0 ? (w_Width > 769 ? 'active' : '') : '') + '" id="' + ServiceName + '"><div class="tab_PrepaidMobile"><div class="row"><div class="col-md-4"><h3>' + backbtn + '&nbsp;' + vv.name + '</h3><div class="row">' + GetOtherData(ServiceName) + '</div></div><div class="col-md-8">' + slider + '</div></div></div>';
                        } else {
                            var oprtr = '<div class="col-md-12 col-sm-12 div_optr_parent"><div class="form-group">' + cls_mobile_op_search + '<label>Operator</label><select class="txtbox ddlop x_select2" id="ddl_opertor_' + ServiceName + '" onchange="onchange_oprator_bill(this)"></select></div></div>';
                            b = '<div class="cls_tbl_tab_service ' + (ii == 0 ? (w_Width > 769 ? 'active' : '') : '') + '" id="' + ServiceName + '"><div class="tab_' + ServiceName + '"><div class="row"><div class="col-md-4"><h3>' + backbtn + '&nbsp;' + vv.name + '</h3><div class="row">' + oprtr + '</div></div><div class="col-md-8">' + slider + '</div></div></div>';
                        }
                        $('#tab_' + (v.catname).replace(' ', '')).append(b);
                        if (vv.ISFORLOGIN == 0) {
                            if (ii == 0) {
                                LoadOperator(vv.id, ('#ddl_opertor_' + ServiceName.replace('#', '')));
                            }
                        }
                        count++;
                    });
                    if (w_Width > 769) {
                        if (count > countnoofshowServices) {
                            x = '<li class="cls_more_list"><a class="_tab_service_lnk" data-value="0" data-target="#MoreServices' + i + '"><img class="img_icon" src="' + CUrl + '/images/appicon/plus.png"><br><span>More</span></a><ul class="cls_otherMenus" id="MoreServices' + i + '"></ul></li>';
                            $('#ULSrvc_' + i).append(x);
                        }
                    }

                });
                $.each($(".div_rc_Service>div"), function (i, v) {
                    var li = $(v).children('ul').children('li');
                    if (li.length >= countnoofshowServices) {
                        var count = 0;
                        for (var i = 0; i < li.length; i++) {
                            if (i >= countnoofshowServices) {
                                if (!$($(li)[i]).hasClass('cls_more_list'))
                                    $(v).children('ul').find('.cls_otherMenus').append($(li)[i]);
                            }
                        }
                    }
                });
                $('#tab_BBPS._srvc_tabs').append(cls_poweredby)
            }
        }
    });
}

var GETfetch = {};
function LoadFetchSrvc() {
    var uu = CUrl + '/Code/CYService.asmx/GETFETCHSERVICE'
    $.ajax({
        type: "POST",
        url: uu,
        data: JSON.stringify({}),
        contentType: "application/json; charset=utf-8",
        dataType: "json",
        async: false,
        success: function (response) {
            response = JSON.parse(response.d);
            if (response.length > 0) {
                // sessionStorage.setItem("response", response);
                // fetch = sessionStorage.getItem("response");
                GETfetch = response;
                if (GETfetch[1]["status"] == 0) {
                    $('.cls_planFetch').attr('cls_planFetchs');
                }
            }
            else {
            }
        }
    });
}
$(document).on("click", ".backbtn", function (i, v) {
    var xx = $(".backbtn").parent().parent('div').parent('div').parent('div').parent('div').attr('id');
    $("._srvc_tabs>ul ._tab_service_lnk").removeClass('active');
    $(this).parent().parent('div').parent('div').parent('div').parent('div').removeClass('active');
})

$(document).on('click', '.cls_srvcIterms', function () {
    if (w_Width > 769) {
        $('.cls_srvcIterms,._srvc_tabs').removeClass('active');
        var attr = $($(this).addClass('active').attr('data-target')).children('ul').children('li:first-child').children('a').is('[href]');
        if (attr == false)
            $($(this).addClass('active').attr('data-target')).addClass('active').children('ul').children('li:first-child').children('a').click();
        else {
            var vxc = $($(this).addClass('active').attr('data-target')).children('ul').children('li:first-child').children('a').attr('href').trim();
            if (vxc == '') {
                $($(this).addClass('active').attr('data-target')).addClass('active').children('ul').children('li:first-child').children('a').click();
            } else {
                $($(this).addClass('active').attr('data-target')).addClass('active').children('ul').children('li:first-child').children('a');
                $($(this).addClass('active').attr('data-target')).find('.cls_tbl_tab_service').removeClass('active')
            }
        }
    }
});
$(document).on('click', '._tab_service_lnk', function () {
    var x = $(this).attr('data-target');
    var dataurl = $(this).attr('data-href');
    if (dataurl != undefined && dataurl != '' && dataurl != null) {
        var status = fn_checksessonLogin();
        if (status == false) {
            fn_show_popup();
        } else {
            window.location = $(this).attr('data-href');
        }
    } else
        if (x.toLowerCase().indexOf('moreservices') > 0) {
            if ($(x).hasClass('active'))
                $(x).removeClass('active');
            else
                $(x).addClass('active')
        }
        else {
            $('._tab_service_lnk,.cls_tbl_tab_service').removeClass('active');
            var parent = $('._tab_service_lnk[data-target="' + x + '"]').closest('._srvc_tabs').attr('id').replace('tab_', '')
            $(this).addClass('active');
            LoadOperator($(this).addClass('active').attr('data-value'), ('#ddl_opertor_' + x.replace('#', '')));
            $(x).addClass('active').attr('parent', parent);
            $(".cls_otherMenus").removeClass('active');

            if (x.toLowerCase() == '#prepaidmobile') {
                $('#txtPrePaidMobile').val('')
                $('#txtPrePaidAmount').val('')
                $('.cls_Pdyn_m').css('display', 'block');
                $('.cls_prepaid_amoun').css('display', 'none');
                if (ismobile == false) {
                    $('.cls_prepaid_amount').css('display', 'block');
                } else {
                    $('.cls_Pdyn').css('display', 'none');
                }
            }
        }
    $('.operatordetails').remove();
    $('.cls_amt').siblings(':not(.div_optr_parent)').remove();
    $('.ddlop').empty();
    fn_ddl_tolist();
});

function LoadOperator(SID, ddl) {
    fnLoadOP(SID, ddl, 0);
}
function fnLoadOP(SID, ddl, tttt) {
    $(ddl).empty();

    $.ajax({
        type: "POST",
        url: CUrl + '/Code/CYService.asmx/GETOperator',
        data: JSON.stringify({ "SID": SID }),
        contentType: "application/json; charset=utf-8",
        dataType: "json",
        async: true,
        success: function (response) {
            response = JSON.parse(response.d);
            if (response.length > 0) {
                if (ismobile == false) {
                    $(ddl).append('<option value="0">Select Operator</option>');
                }

                $.each(response[0].oprt, function (i, v) {
                    $(ddl).append('<option value="' + v.id + '" data-image="../../images/operators/' + (v.id == undefined ? "no-image" : v.id) + '.png">' + v.operatorname + '</option>');
                });

                if (response[0].circle.length > 0) {
                    if (ismobile == false) {
                        if (tttt == 1) {
                            $("#ddlCircle").empty().append('<option value="0">Select Circle</option>');
                        }
                        else {
                            $("#ddl_PrePaidCircle").empty().append('<option value="0">Select Circle</option>');
                        }
                    }
                    $.each(response[0].circle, function (i, v) {
                        if (tttt == 1) {
                            $("#ddlCircle").append('<option value="' + v.id + '">' + v.name + '</option>');
                        } else {
                            $("#ddl_PrePaidCircle").append('<option value="' + v.id + '">' + v.name + '</option>');
                        }
                    });
                }
            }
            fn_op_setImage();
        }
    });
}
function GetOtherData(srvcName) {
    var recharge = [{ 'SERVICE': 'PrepaidMobile', 'DATA': '<div class="col-md-3 col-sm-6 cls_dyn_main"></div><div class="col-md-12 col-sm-12 cls_Pdyn_m"><div class="form-group"><label>Mobile No</label><input type="tel" class="txtbox" id="txtPrePaidMobile" maxlength="10" placeholder="" pattern="[0-9]*" inputmode="numeric"  onkeypress="return isNumber(event)" onkeyup="if(this.value.length==10) {GetPrepaid(this);}else{fn_resetprepaid()}" onc/></div></div><div class="col-md-12 col-sm-12 div_optr_parent cls_Pdyn ddl_opertor_pre_div"><div class="form-group"><label>Operator</label><select class="txtbox ddlop x_select2" id="ddl_opertor_PrepaidMobile"></select></div></div><div class="col-md-12 col-sm-12 cls_Pdyn ddl_cicle_pre_div"><div class="form-group"><label>Circle</label><select class="txtbox ddlop x_select2 ddl_circle_op" id="ddl_PrePaidCircle" ></select></div></div><div class="col-md-12 col-sm-12 cls_Pdyn cls_prepaid_amount"><div class="form-group"><label>Amount</label><a class="cls_planFetch" style="display:none" for="txtPrePaidMobile" onclick="Modal_PlanInfo(\'#txtPrePaidAmount\')">Plan Fetch </a><input type="text" class="txtbox" id="txtPrePaidAmount"  onkeypress="return validateFloatKeyPress(this, event)" onkeyup="ShowAmountPlan(this)"/></div></div><div class="col-md-12"><div class="form-group"><label>&nbsp;</label><input type="button" class="_btn" id="btn_prePaidSubmit" value="Submit"  /></div></div>' },
    { 'SERVICE': 'DTH', 'DATA': '<div class="col-md-12 col-sm-12"><div class="form-group"><label>Account Number</label><a class="cls_fetchInfo" for="txtDTHAmount" onclick="fn_custInfo(this)">Fetch Info</a><input type="text" class="txtbox" id="txtdthAccNO" maxlength="10" onkeypress="return isNumber(event)" onkeyup="if(this.value.length==10) {GetDTHPrepaid(this);}"/></div></div><div class="col-md-12 col-sm-12"><div class="form-group"><label>Amount</label><input type="text" class="txtbox" id="txtDTHAmount" onkeypress="return validateFloatKeyPress(this, event)" /><a class="cls_planFetch" style="display:none" for="txtdthAccNO" onclick="Modal_PlanInfo()">Plan Fetch </a></div></div><div class="col-md-12 col-sm-12"><div class="form-group"><label>&nbsp;</label><input type="button" class="_btn" id="btn_DTHSubmit" value="Submit" /></div></div>' }];
    var a = $.grep(recharge, function (n, i) {
        return n.SERVICE === srvcName;
    });
    a = a.length > 0 ? a[0].DATA : "";
    return a;
}
function filterItems2(items1, searchVal) {
    var abc = [];
    try {
        var filteredValue = items1.filter(function (item) {
            var status = false;
            if (item.recharge_amount.lastIndexOf(searchVal) > -1) {
                status == true;
                abc.push(item)
            }
            return status;
        });
    } catch (ex) { }
    return abc;
}
function isNumber(evt) {
    evt = (evt) ? evt : window.event;
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if (charCode > 31 && (charCode < 48 || charCode > 57)) {
        return false;
    }
    return true;
}
function validateFloatKeyPress(el, evt) {
    var charCode = (evt.which) ? evt.which : event.keyCode;
    if (charCode != 46 && charCode > 31
        && (charCode < 48 || charCode > 57)) {
        return false;
    }

    if (charCode == 46 && el.value.indexOf(".") !== -1) {
        return false;
    }

    return true;
}
function GetDTHPrepaid(evnt) {
}
function GetPrepaid(evnt) {
    var id = $(evnt).val();
    if (GETfetch[2].fetchtype == "operatorfetch" && GETfetch[2].status == 1) {
        var a = {
            Acc: id
        }
        $.ajax({
            type: "POST",
            url: CUrl + '/Code/CYService.asmx/GETOperatorFetch',
            data: JSON.stringify(a),
            contentType: "application/json; charset=utf-8",
            dataType: "json",
            success: function (response) {
                response = response.d;
                if (response.length > 0) {
                    try {
                        var x = response.split(',')
                        $("#ddl_opertor_PrepaidMobile").val(x[0]).trigger("change");
                        $("#ddl_PrePaidCircle,#ddlOpId").val(x[1]).trigger("change");
                        //$(".cls_planFetch").css('display', 'block');
                        if (ismobile) {
                            $("#ddl_opertor_PrepaidMobile option[value=" + x[0] + "]").addClass('active')
                            $("#ddl_PrePaidCircle option[value=" + x[1] + "]").addClass('active')
                            fn_prepaid_mobile_design(evnt)
                        } else {
                            $('#div_rec_desktop').css('display', 'block');
                        }
                    } catch (ex) { alert(ex) }
                }
            },
            failure: function (response) {
            },
            error: function (response) {
            }
        });
    }
    else {
        fn_edit_op_prepaid('.edit_op_prepaid');
    }
    if (GETfetch[1].fetchtype == "planfetch" && GETfetch[1].status == 1) {
        $(".cls_planFetch").css('display', 'block');
    }
    else {
        $(".cls_planFetch").css('display', 'none');
    }

}
function fn_prepaid_mobile_design(evnt) {
    $('.operatordetails').remove();
    var id = $(evnt).val();
    var imgurl = $("#ddl_opertor_PrepaidMobile option.active").attr('data-image');
    var predata = `<div class="operatordetails"><div class=""><span style="  font-size: 20px;font-weight: bold;">` + id + `</span><br/>
                        <span>Prepaid, ` + $("#ddl_opertor_PrepaidMobile option.active").text() + `, ` + $("#ddl_PrePaidCircle option.active").text() + `</span> <br />
                            <a data-target=".ddl_opertor_pre_div" class="edit_op_prepaid" onclick="fn_edit_op_prepaid(this)">change operator</a>
                        </div > <div class="text-right"><img class="img_icon_operator" src="` + imgurl + `" id="imgprepaid" onerror="this.onerror=null;this.src='../../images/operators/no-image.png'"><br />
                            </div></div ></label > `
    $('.cls_Pdyn_m').css('display', 'none');
    $('.cls_prepaid_amount').css('display', 'block');
    $('.cls_dyn_main').css('display', 'block').append(predata);

}
function fn_resetprepaid() {
    $("#ddl_opertor_PrepaidMobile").val(0);
    $("#ddl_PrePaidCircle").val(0);
    $(".cls_planFetch").css('display', 'none');
}
function PlanFatch(sid, Crcle, MODE, selectedAmttxtbox) {

    $("body").find('.PanelBox').remove();
    $("#tblRdata").empty();
    var x = '<div class="PanelBox"><center><p id="LoaderId" class="hide"></p></center><div class="box_L"><ul><li id="lstAll" style="display: block;"><a href="#" class="clsItemsss" onclick="onclick_filter(this)" data-value="All">All</a></li><li id="lst121" style="display: none"><a href="#" class="clsItemsss" onclick="onclick_filter(this)" data-value="121">121 made for you</a></li></ul></div><div class="box_R"><table id="tblRdata"></table><div class="DIVRdata"></div></div></div></div>';
    $("body").find('.rc_offer_div').append(x);
    if (w_Width < 769) {
        $(".tblClass").css('display', 'none')
    }
    $.ajax({
        type: "POST",
        url: CUrl + '/Code/CYService.asmx/GETPlanFetch',
        data: JSON.stringify({ "STID": sid, "CIRCLE": Crcle, "STYPE": MODE }),
        contentType: "application/json; charset=utf-8",
        dataType: "json",
        async: true,
        success: function (response) {
            response = JSON.parse(response.d);
            if (response.length > 0) {

                var UniqueNames = [];
                $.each(response, function (i, v) {
                    var aa = '';
                    if (w_Width > 769) {
                        aa = '<tr><td class="text-center"><span class="clstolck">' + v.recharge_type + '</span>' + v.recharge_talktime + '</td><td>' + v.recharge_validity + '</td><td>' + v.recharge_long_desc + '</td><td><a href="#" class="btnamt" onclick=clickSetAmount("' + v.recharge_amount + '",\'' + selectedAmttxtbox + '\')>' + v.recharge_amount + '</a></td></tr>';
                    } else {
                        aa = '<tr><td class="text-center"><span class="clstolck">' + v.recharge_type + '</span><table style="width:100%;" class="tblRdata_table"><tr><td>' + v.recharge_talktime + '</td><td>' + v.recharge_validity + '</td></tr><tr><td colspan="2"">' + v.recharge_long_desc + '</td></tr><tr><Td></td><td><a href="#" class="btnamt" onclick=clickSetAmount("' + v.recharge_amount + '",\'' + selectedAmttxtbox + '\')>' + v.recharge_amount + '</a></td></tr></table>'
                    }
                    $("#tblRdata").append(aa);
                    if (UniqueNames.indexOf(v.recharge_type) == -1)
                        UniqueNames.push(v.recharge_type);
                });
                $.each(UniqueNames, function (i, v) {
                    var active = '';
                    if (i = 1) {
                        active = "active";
                    }
                    $(".box_L>ul").append('<li><a class="clsItemsss" onclick="onclick_filter(this)" class="' + active + '" href="#" data-value="' + v + '">' + v + '</a></li>');
                })
            }
        }
    });
}
function Modal_PlanInfo(selectedAmttxtbox) {
    var sid = $("#ddl_opertor_PrepaidMobile option:selected").val();
    var Crcle = $("#ddl_PrePaidCircle option:selected").val();
    if (ismobile) {
        sid = $("#ddl_opertor_PrepaidMobile option.active").attr('value');
        Crcle = $("#ddl_PrePaidCircle option.active").attr('value');
    }
    LoadHeaderModal_paln();
    PlanFatch(sid, Crcle, 'PREPAID', selectedAmttxtbox);
    fnLoadOP(1, "#ddlOpId", 1);
    $('#ddlOpId').val(sid); $('#ddlCircle').val(Crcle);
    Offer121($("#txtPrePaidMobile").val(), sid);
}
function LoadHeaderModal_paln() {
    $(".rc_offer_div_Modal").remove();
    var x = '<div class="rc_offer_div_Modal"><div class="rc_offer_div_closebtn"></div><div class="rc_offer_div"><div class="col-md-12"><div class="div_browPlan">Browser Plan</div><div class="closebtn_2" id="closebtn_2"><p>x</p></div><div class="rc_offer_header" style="animation: ease-in;"><div class="row"><table class="tblClass" style="margin-top: 10px;"><tbody><tr><td><p style="margin: 0px; color: #404040; font-size: 18px;font-weight: 500;">Browse Plans</p></td><td><select name="ddlOpId" id="ddlOpId" class="txtbox ddlop x_select2" onchange="fn_planChange()"><option value="0">Select Your Operator</option></select></td><td><select name="ddlCircle" id="ddlCircle" onchange="fn_planChange()" class="txtbox x_select2"><option value="0">Select Your Circle</option>';
    x = x + '</select></div></div></td><td><input class="txtbox" id="txtSearchTraff" placeholder="Search by Amount" onkeyup="FilterTable(this)"></td></tr></tbody></table></div></div></div></div>';
    $("body").append(x);
}
function Modal_PlanInfodth(selectedAmttxtbox) {
    LoadHeaderModal_paln();
    var opid = $("#ddl_opertor_DTH option:selected").val();
    if (ismobile) {
        opid = $("#ddl_opertor_DTH .active").attr('value');
    }
    PlanFatch(opid, 1, 'DTH', selectedAmttxtbox);
}
function fn_planChange() {
    var opid = $("#ddlOpId option:selected").val();
    if (ismobile) {
        opid = $("#ddlOpId .active").attr('value');
    }
    PlanFatch(opid, $("#ddlCircle option:selected").val(), 'PREPAID');
}
function ShowAmountPlan(evnt) {
    var AMT = $(evnt).val();
    if (AMT.length > 0) {
        var left = $(evnt).offset().left;
        var width = $(evnt).outerWidth();
        $('.cls_off_div').remove();
        var RecPlans = sessionStorage.getItem("RecPlans");
        if (RecPlans != "") {
            var aa = filterItems2(JSON.parse(RecPlans), AMT);
            if (aa.length > 0) {
                var items = "";
                $.each(aa, function (i, v) {
                    aa = v;
                    items = items + '<table><tr><td colspan="2"><span>' + aa["recharge_type"] + '</span></td></tr><tr><td><p>' + aa["recharge_long_desc"] + '-' + aa["recharge_validity"] + '</p></td><td><a class="clsAmt1" onclick="fn_clsAmt1(this)" data-target="#' + $(evnt).attr('id') + '" data-value="' + aa["recharge_amount"] + '">' + aa["recharge_amount"] + '</a></td></tr></table>';
                });
                var div = '<div  class="cls_off_div">' + items + '</div>';
                $(evnt).parent().append(div);
            }
        }
    } else
        $(evnt).parent().find('.cls_off_div').remove();
}
function onclick_filter(evnt) {
    var name = $(evnt).attr('data-value');
    $(".clsItemsss").removeClass('active');
    $(evnt).addClass('active');
    var rows = $("#tblRdata").find('span');
    $.each(rows, function (i, v) {
        if (name != "All") {
            if ($(v).text().toLocaleLowerCase().indexOf(name.toLocaleLowerCase()) == 0) {
                $($(v).parent('td').parent('tr')).show();
            } else {
                $($(v).parent('td').parent('tr')).hide();
            }
        } else {
            $($(v).parent('td').parent('tr')).show();
        }
    })
};
function FilterTable(evnt) {
    var name = $(evnt).val().toLocaleLowerCase();
    $("#tblRdata tr").each(function (index) {
        $row = $(this);
        var id = $row.find("td").text().toLocaleLowerCase();
        if (name != "") {
            if (id.indexOf(name) > 0) {
                $(this).show();
            }
            else {
                $(this).hide();
            }
        } else {
            $(this).show();
        }
    });
};
function Offer121(number, sid, selectedAmttxtbox) {
    $("#lst121").css('display', 'none');
    $.ajax({
        url: CUrl + '/Code/CYService.asmx/Offer121',
        data: JSON.stringify({ "Number": "'" + number + "'", "operatorcode": sid }),
        type: "post",
        dataType: "json",
        async: false,
        contentType: "application/json; charset=utf-8",
        success: function (data) {
            try {
                if (data.d != "") {
                    var Result = JSON.parse(data.d);
                    if (Result.length > 0) {
                        $.each(Result, function (i, v) {
                            if (w_Width > 769) {
                                aa = '<tr><td class="text-center"><span class="clstolck">121</span>0</td><td>-</td><td>' + v.desc + '</td><td><a href="#" class="btnamt" onclick=clickSetAmount("' + v.rs + '",\'' + selectedAmttxtbox + '\')>' + v.rs + '</a></td></tr>';
                            }
                            else {
                                aa = '<tr><td class="text-center"><span class="clstolck">121</span></span><table style="width:100%;" class="tblRdata_table"><tr><td></td><td></td></tr><tr><td colspan="2"">' + v.desc + '</td></tr><tr><Td></td><td><a href="#" class="btnamt" onclick=clickSetAmount("' + v.rs + '",\'' + selectedAmttxtbox + '\')>' + v.rs + '</a></td></tr></table>'
                            }

                            $("#tblRdata").append(aa);
                        });

                        $("#lst121").css('display', 'block');
                    }
                }
            }
            catch (exception) { }
        }
    });
}
$(document).on("click", ".rc_offer_div_closebtn,.closebtn_2", function () {
    $(".rc_offer_div_Modal").remove();
});
function clickSetAmount(evnt, selectedAmttxtbox) {
    $(selectedAmttxtbox).val(evnt); $(".rc_offer_div_Modal").remove();
}
function fn_custInfo(evnt) {
    var aa = '<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">Open modal</button><div class="modal" id="myModal"><div class="modal-dialog">';
    aa = '<div class="modal-content"><div class="modal-header"><h4 class="modal-title">&nbsp;</h4><button type="button" class="close" data-dismiss="modal">&times;</button></div><div class="modal-body">';
    aa = '    </div><div class="modal-footer"><button type="button" class="btn btn-danger" data-dismiss="modal">Close</button></div></div></div></div>';
    aa = '</div><div class="modal-body"></div></div></div>';
    $('body').append(aa);
    $("#myModal").modal('show');
}

$(document).on("click", "#btn_prePaidSubmit", function () {
    if ($("#txtPrePaidMobile").val().length != 10) {
        show_alert('Invalid Mobile Number', 2)
        return;
    }
    else {          
        fn_prepaid_mobile_design($('#txtPrePaidMobile'));
    }
    var _opid, _circle;
    if (ismobile) {
        if ($("#ddl_opertor_PrepaidMobile option.active").length < 1) {
            show_alert('Operator Select', 2);
            return;
        }
        _opid = $("#ddl_opertor_PrepaidMobile option.active").attr('value');
        if ($("#ddl_PrePaidCircle option.active").length < 1) {
            show_alert('Operator Circle', 2);
            return;
        } _circle = $("#ddl_PrePaidCircle option.active").attr('value');
    }
    else {
        if ($("#ddl_opertor_PrepaidMobile ").prop('selectedIndex') < 1) {
            show_alert('Operator Select', 2);
            return;
        }
        _opid = $("#ddl_opertor_PrepaidMobile option:selected").val();

        if ($("#ddl_PrePaidCircle").prop('selectedIndex') < 1) {
            show_alert('Operator Circle', 2);
            return;
        }
        _circle = $("#ddl_PrePaidCircle option:selected").val();
    }
    if ($("#txtPrePaidAmount").val().trim() == "") {
        show_alert('Enter Plan Amount', 2);
        return;
    }
    var _btnX = $('#btn_prePaidSubmit');

    _btnX.attr('readonly', true).val('please wait...');
    $.ajax({
        type: "POST",
        url: CUrl + '/Code/CYService.asmx/Add_History_customer',
        data: JSON.stringify({ "SPID": _opid, "AMOUNT": "" + $("#txtPrePaidAmount").val() + "", "CIRCLE": _circle, "NUMBER": "" + $("#txtPrePaidMobile").val() + "", "REQDATA": "" }),
        contentType: "application/json; charset=utf-8",
        dataType: "json",
        async: true,
        success: function (response) {
            resp = JSON.parse(response.d);
            if (resp.status == 'success') {
                //$("#txtPrePaidMobile").val('');
                //$("#ddl_opertor_PrepaidMobile").prop('selectedIndex', 0);
                //$("#ddl_PrePaidCircle").prop('selectedIndex', 0);
                //$("#txtPrePaidAmount").val('');
                //show_messageOnsuccess();
                //show_alert(resp.message, 1);
                window.location.href = resp.message;
            } else
                if (resp.status == 'warning') {
                    show_alert(resp.message, 3);
                }
                else if (resp.status == "sessionexp") {
                    fn_show_popup();
                }
                else {
                    show_alert(resp.message, 2);
                }
            _btnX.attr('readonly', false).val('Submit');
        }
    });
})
function onchange_oprator_bill(evnt) {
    
    var id = $(evnt).val();
    if (ismobile)
        id = $(evnt).attr('value');
    var srvc = $(evnt).closest(".cls_tbl_tab_service").attr('id');
    var parent = $(evnt).closest(".cls_tbl_tab_service").attr('parent');
    var divId = $(evnt).closest(".cls_tbl_tab_service").children('div').children('div').children('div').children(".row");
    var v2 = $(divId).find('.cls_dyn,.cls_amt').remove();
    try {

        $.ajax({
            type: "POST",
            url: CUrl + '/Code/CYService.asmx/GETBILLERDETAILS',
            data: JSON.stringify({ "ddl": id }),
            contentType: "application/json; charset=utf-8",
            dataType: "json",
            success: function (response) {
                response = JSON.parse(response.d);
                if (response.length > 0) {
                    var billfetch = response[0].billfetch;
                    if (id == 242) {
                        billfetch = 'yes';
                    }
                    var cnt = 0;
                    var HeavyRefresh = '';
                    $.each(response, function (i, v) {
                        var tt = "";
                        var maxLength = v.maxLength == '0' ? '10' : v.maxLength;
                        var minLength = v.minLength == '0' ? '10' : v.minLength;
                        if (v.dataType.toLocaleLowerCase() == "numeric") {
                            tt = 'onkeypress="return isNumber(event)" tel="tel"';
                        } else {
                            tt = 'onkeypress="return fn_setRegex(this,event)" pattern="' + v.regEx + '" type="text"';
                            //tt = 'onkeypress="return validateFloatKeyPress(this, event)" pattern="' + v.regEx + '" type="text"';
                        }
                        var dhtcustinfo = '';
                        if (GETfetch[4].fetchtype == "dthinfofatch" && GETfetch[4].status == 1) {
                            if (srvc.toLowerCase() == "dth") {
                                if (cnt == 0) {
                                    HeavyRefresh = '<a class="cls_planFetch" style="display:block"  onclick="GetHeavuRefresh(this,' + id + ',\'#' + srvc + '\')">Heavy Refresh</a>';

                                    dhtcustinfo = '<a class="cls_planFetch" style="display:block"  onclick="GetDTHInfo(this,' + id + ',\'#' + srvc + '\')">DTH Info</a>';
                                    cnt++;
                                }
                            }
                        }
                        else {
                            if (GETfetch[4].status == 0) {
                                $('.cls_planFetch').attr('cls_planFetchs');
                            }
                        }
                        var a = '<div class="col-md-12 cls_dyn"><div class="form-group"><label>' + v.paramName + '(<span style="color:red;font-size:12px;">' + (v.isOptional == false ? '*' : '') + '</span>)</label><input  class="txtbox"  id="txtparam_' + i + '" Data-Key="' + v.paramName + '" maxlength="' + maxLength + '" minlength="' + minLength + '" ' + tt + ' data-required="' + v.isOptional + '"/>' + dhtcustinfo + '</div>';
                        $(divId).append(a);
                    });
                    var d_billfetch = '';
                    if (GETfetch[3].fetchtype == "billfetch" && GETfetch[3].status == 1) {
                        if (billfetch.toLowerCase() == "yes") {
                            d_billfetch = '<a class="cls_planFetch" style="display:block"  onclick="Modal_GetbillInfo(this,' + id + ',\'#' + srvc + '\')">Get Info</a>';
                        }
                    }
                    else {
                        if (GETfetch[3].status == 0) {
                            $('.cls_planFetch').attr('cls_planFetchs');
                        }
                    }
                    if (GETfetch[1].fetchtype == "planfetch" && GETfetch[1].status == 1) {
                        if (srvc.toLowerCase() == "dth") {
                            d_billfetch = '<a class="cls_planFetch" id="lnkdthplaninfo" style="display:block" for="ddl_opertor_DTH" onclick="Modal_PlanInfodth(\'#txt' + srvc + 'Amount\')">Plan Fetch </a>';
                        }
                    }
                    else { }
                    var a = '<div class="col-md-12 cls_amt"><div class="form-group"><label>Amount</label>' + d_billfetch + '<input type="text" class="txtbox" id="txt' + srvc + 'Amount" onkeypress="return validateFloatKeyPress(this, event)"></div></div>';
                    if (parent == "RechargeService") {
                        if (srvc.toLowerCase() == "dth") {
                            HeavyRefresh = '<a class="cls_planFetch" style="display:block"  onclick="GetHeavuRefresh(this,' + id + ',\'#' + srvc + '\')">Heavy Refresh</a>';
                        }
                        a = a + '<div class="col-md-12 cls_amt"><div class="form-group"><label>&nbsp;</label><input type="button" class="btn btn-primary" id="btnPay' + srvc + 'Amount" parent="' + srvc + '" onkeypress="return validateFloatKeyPress(this, event)" onclick="btnpay_click_recharge(this)" value="Submit">' + HeavyRefresh + '</div></div>'
                    } else {


                        a = a + '<div class="col-md-12 cls_amt"><div class="form-group"><input type="button" class="_btn" id="btnPay' + srvc + 'Amount" parent="' + srvc + '" onkeypress="return validateFloatKeyPress(this, event)" onclick="Paybill_click(this,' + id + ',\'\',' + srvc + ')" value="Submit"></div></div>'
                    }
                    $(divId).append(a);
                }
            }
        });

    } catch (ex) {
        show_alert(ex.message, 2);
    }
};
//function fn_loadServicewiseSlider(id) {
//    var abc = ` <div id="sliderX_1" class="carousel slide carousel-fade" data-bs-ride="carousel" data-bs-touch="true">
//                <div class="carousel-inner">
//                            <div class="carousel-item active">
//                                <img src='../../Images/ServiceBanner/mobile-recharge.jpg' alt="" class="d-block w-100">
//                            </div>
//                </div>
//                <button class="carousel-control-prev" type="button" data-bs-target="#sliderX_1" data-bs-slide="prev">
//                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
//                    <span class="visually-hidden">Previous</span>
//                </button>
//                <button class="carousel-control-next" type="button" data-bs-target="#sliderX_1" data-bs-slide="next">
//                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
//                    <span class="visually-hidden">Next</span>
//                </button>
//            </div>`;
//    return abc;
//}

function fn_loadServicewiseSlider(id) {
    var imgurl = ""; var abc = ``;
    $.ajax({
        type: "POST",
        url: CUrl + '/Code/CYService.asmx/serviceslider',
        data: "{'id':'" + id + "'}",
        contentType: "application/json;",
        dataType: "json",
        async: false,
        success: function (response) {
            var obj = JSON.parse(response.d);
            if (obj.length > 0) {
                var sssss = '';
                if (obj[0].TT != null && !obj[0].TT != "undefined") {
                    var imgurl = (obj[0].TT).split(',');
                }
                $.each(imgurl, function (i, v) {
                    sssss = sssss + '<div class="carousel-item ' + (i === 0 ? ' active ' : '') + '"><img src="../../Images/ServiceBanner/medium/' + v + '" alt="" width="100%" height="400" class="d-block w-00"></div>'
                });
                abc = ` <div id="sliderX1_` + id + `" class="carousel slide" data-bs-ride="carousel">
                                       <div class="carousel-inner">
                                                   `+ sssss + `
                                       </div>
                                       <button class="carousel-control-prev" type="button" data-bs-target="#sliderX1_`+ id + `" data-bs-slide="prev">
                                           <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                           <span class="visually-hidden">Previous</span>
                                       </button>
                                       <button class="carousel-control-next" type="button" data-bs-target="#sliderX1_`+ id + `" data-bs-slide="next">
                                           <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                           <span class="visually-hidden">Next</span>
                                       </button>
                                                </div>`;
            }
        }

    })

    return abc;
}



function fn_setRegex(id, event) {
    try {
        //var rgx = $(id).attr('pattern');
        //var vvv = $(id).val();
        //var newrg = new RegExp(rgx,'g')
        //var matched = newrg.test(vvv);
        //return matched;

    }
    catch (ee) { }

}
//document.getElementById('txtparam_0').addEventListener('keypress', event => {
//    if (!`${event.target.value}${event.key}`.match(/^[0-9]{0,4}$/)) {
//        // block the input if result does not match
//        event.preventDefault();
//        event.stopPropagation();
//        return false;
//    }
//});
function getRequestdata(srvc) {
    var jsonObj = [];
    var jsonObjLast = [];
    var cls = $(srvc).find('.cls_dyn').find('input');
    var flag = true;
    $(cls).each(function () {
        var key = this.getAttribute("Data-Key");
        var data_required = this.getAttribute("data-required");
        if (key != null) {
            item = {};
            item["Key"] = this.getAttribute("Data-Key");
            item["Value"] = $(this).val().trim();
            if ($(this).val().trim() == "" && data_required == false) {
                flag = false;
            }
            jsonObj.push(item);
        }
    });
    if (flag == true) {
        item = {};
        item["Request"] = jsonObj;
        jsonObjLast.push(item);
        sessionStorage.setItem('hdnReqdata', JSON.stringify(item))
        return item;
    } else {
        return false;
    }
}

function Modal_GetbillInfo(evnt, opid, srvc) {
    var reqdata = getRequestdata(srvc);
    if (reqdata == false) {
        show_alert('fill paramter value', 2);
        return;
    } else {
        GetbillInfo(opid, '', JSON.stringify(reqdata), srvc);
    }
}

function GetbillInfo(opid, cls, RequestData, srvc) {
    $("#_popUp_Modal11").remove();
    $.ajax({
        type: "POST",
        url: CUrl + '/Code/CYService.asmx/GetBiller_Data',
        data: "{ 'servicetype': '" + opid + "','operatorID':'" + opid + "','methodname':'get_billfetch','RequestData':'" + encodeURI(RequestData) + "'}",
        contentType: "application/json;",
        dataType: "json",
        success: function (response) {
            var obj = JSON.parse(response.d);
            if (obj.length > 0) {
                obj = obj[0];
                var newtd = '';
                for (var key in obj) {
                    newtd = newtd + '<tr><td><b>' + key + '<b></td><td>' + obj[key] + '</td></tr>';
                }
                $(srvc).find('.cls_amt').find('input[type="text"]').val(obj.DueAmount);
                var BTN = '', BillNumber = '';
                if (obj.statuscode.toLowerCase() == 'txn') {
                    BTN = '<input type="button" id="btnPayBill" class="btn btn-primary" onclick="PAYBILL_SELECT(this,\'' + opid + '\',\'' + cls + '\',\'' + srvc + '\');" value="Select" />';
                    BillNumber = obj["BillNumber"];
                }
                var x = ` <div class="modal fade _popUp_Modal11" id="_popUp_Modal11" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog ggggg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div>
                                            <div style="display: flex; align-items: center; width: 100%; justify-content: space-between;">
                                                <div class="col-lg-10">
                                                    <h5 class="modal-title" id="exampleModalLabel"><b>Bill Type</b></h5>
                                                </div>
                                                <div class="col-lg-2">
                                                    <img src="../../Images/BharatBillPay.png" class="img-fluid bharat-photo" alt="...">
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-12 mt-3">
                                                    <table >
                                                        <tr>
                                                            <td><b>Bill No</b></td>
                                                            <td style="text-align:right">(<b>` + BillNumber + `</b>)</td>
                                                        </tr>`+ newtd + `
                                                        <tr><td colspan="2">The service provider at times may take up to 72 hours to process your bill.</td></tr>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        `+ BTN + `
                                    </div>
                                </div>
                            </div>
                        </div>`;
                //var a = '  <div class="_popUp_Modal1"><p id="lblErrorMsg" class="red"></p><table class="table table-condensed " id="tblmydata" ><tr><td><h2>Bill Type</h2><p>Bill No (<b>' + BillNumber + '</b>)</p><p></p><p></p></td><td><img src="../Images/bharatbillpay.png" class="pull-right" height="50px" alt="" /></td></tr>' + newtd + '<tr><td colspan="2">' + BTN + '</td></tr><tr><td colspan="2" class="text-left"><ol><li>The service provider at times may take up to 72 hours to process your bill. </li><ol></td></tr><tr><td colspan="2"><input type="button" id="btnclosebill" class="btn btn-danger" data-target="#_popUp_Modal1"  value="Close" /></td></tr></table></div>'
                $('body').append(x);
                $('#_popUp_Modal11').modal('show')
            }
        },
        failure: function (response) {
            show_alert(response.d, 2);
        }
    });
}
$('body,html').click(function (e) {
    var container = $("#tblmydata");
    if (!container.is(e.target) && container.has(e.target).length === 0) {
        $("._popUp_Modal1").remove();
    }
});
function PAYBILL_SELECT(evnt, opid, cls, srvc) {

    $('#_popUp_Modal11').modal('hide')
}
function Paybill_click(evnt, opid, cls, srvc) {
    var reqdata = getRequestdata(srvc);
    if (reqdata == false) {
        show_alert('fill paramter value', 2);
        return;
    } else {
        var acc = $(srvc).find('#txtparam_0').val().trim();
        if (acc != undefined && acc != "") {
            var amt = $(srvc).find('.cls_amt').find('input[type="text"]').val().trim();
            if (amt != undefined && amt != "" && amt != "0") {
                var obj = {
                    SPID: opid,
                    AMOUNT: amt,
                    CIRCLE: "1",
                    NUMBER: acc,
                    REQDATA: JSON.stringify(reqdata)
                }
                Pay_bill(JSON.stringify(obj), srvc, evnt);
            } else {
                show_alert('Invalid Amount', 2);
                return;
            }
        } else {
            show_alert('Invalid DTH No.', 2);
            return;
        }
    }
}
function Pay_bill(obj, srvc, evnt) {
    var _btnX = $(evnt);
    _btnX.attr('readonly', true).val('please wait...');
    $.ajax({
        type: "POST",
        url: CUrl + '/Code/CYService.asmx/Add_History_customer',
        data: obj,
        contentType: "application/json; charset=utf-8",
        dataType: "json",
        async: true,
        success: function (response) {
            resp = JSON.parse(response.d);
            if (resp.status == 'success') {
                window.location.href = resp.message;
                //$(srvc).find('#txtparam_0').val('');
                //$(opid).prop('selectedIndex', 0);
                //$(srvc).find('.cls_amt').find('input[type="text"]').val('');
                //show_messageOnsuccess();
                //show_alert(resp.message, 2);

            } else
                if (resp.status == "sessionexp") {
                    fn_show_popup();
                }
                else {
                    show_alert(resp.message, 2);
                }

            _btnX.attr('readonly', false).val('Submit');
        }
    });
}
function btnpay_click_recharge(evnt) {
    var pp = $(evnt).attr('parent');
    var opid = $('#' + pp).find('select option:selected').val();
    if (ismobile)
        opid = $('#' + pp).find('.ddlop option.active').attr('value');
    var acc = $(srvc).find('#txtparam_0').val().trim();
    if (acc != undefined && acc != "") {
        var amt = $(srvc).find('.cls_amt').find('input[type="text"]').val().trim();
        if (amt != undefined && amt != "" && amt != "0") {
            var obj = {
                SPID: opid,
                AMOUNT: amt,
                CIRCLE: "1",
                NUMBER: acc,
                REQDATA: ""
            }
            Pay_bill(JSON.stringify(obj), srvc, evnt);
        } else {
            show_alert('Invalid Amount', 2);
            return;
        }
    } else {
        show_alert('Invalid no', 2);
        return;
    }
}
function GetDTHInfo(evnt, opid, srvc) {
    var reqdata = $(srvc).find('.cls_dyn').find('input').val();
    if (reqdata != undefined && reqdata != "" && reqdata != null) {
        $("._popUp_Modal1").remove();
        try {
            $.ajax({
                type: "POST",
                url: CUrl + '/Code/CYService.asmx/GETDTH_INFO',
                data: "{ 'OPID': '" + opid + "','AccNo':'" + reqdata + "'}",
                contentType: "application/json;",
                dataType: "json",
                success: function (response) {
                    if (response.d != "") {
                        var obj = JSON.parse(response.d);
                        var newtd = '<tr><td><p>operator</p></td><td><p>' + obj["operator"] + '</p></td></tr>';
                        var obj1 = obj.records[0];
                        for (var key in obj1) {
                            newtd = newtd + '<tr><td><p>' + key + '</p></td><td><p>' + obj1[key] + '</p></td></tr>';
                        }
                        var a = '  <div class="_popUp_Modal1"><p id="lblErrorMsg" class="red"></p><table class="table table-condensed " id="tblmydata" ><tr><td><h2>Bill Type</h2><p>Bill No (<b>' + obj["tel"] + '</b>)</p><p></p><p></p></td><td></td></tr>' + newtd + '<tr><td colspan="2"><input type="button" id="btnclosebill" class="btn btn-danger" data-target="#_popUp_Modal1"  value="Close" /></td></tr></table></div>'
                        $('body').append(a);
                    }
                },
                failure: function (response) {
                    show_alert(response.d, 2);
                }
            });
        } catch (ex) {
            show_alert(ex.message, 2);
        }
    } else {
        show_alert('Fill DTH No.', 2);
        return;
    }
}

function GetHeavuRefresh(evnt, opid, srvc) {
    var reqdata = $(srvc).find('.cls_dyn').find('input').val();
    if (reqdata != undefined && reqdata != "" && reqdata != null) {
        $("._popUp_Modal1").remove();
        $.ajax({
            type: "POST",
            url: CUrl + '/Code/CYService.asmx/GETDTH_HEAVYREFRESH',
            data: "{ 'OPID': '" + opid + "','AccNo':'" + reqdata + "'}",
            contentType: "application/json;",
            dataType: "json",
            success: function (response) {
                if (response.d != "") {
                    var obj = JSON.parse(response.d);

                    show_alert(obj["records"]["desc"]);
                }
            },
            failure: function (response) {
                show_alert(response.d, 2);
            }
        });
    } else {
        show_alert('fill paramter value', 2);
        return;
    }
}


$(document).on("click", "#btnclosebill", function () {
    $("._popUp_Modal1").remove();
})

function fn_firebase_show_alert(heading, message) {
}
function ShowLoginPopup() {
    $("#modal_Login").modal('show');
}



function fn_ddl_tolist() {
    if (ismobile) {
        $.each($('.ddlop'), function (x, value) {
            var $select = value,
                $ul = $('<ul></ul>').attr('id', $($select).attr('id')).attr('name', $($select).attr('name'));
            if ($(value).hasClass('ddlop')) {
                $($ul).attr('class', 'ddlop').attr('onchange', $($select).attr('onchange'));
            }

            $($select).children().each(function (i, v) {
                var xx = '';
                var $option = $(this);
                var li = $('<li></li>');;
                xx = '<li value="' + $option.val() + '" data-image="' + $option.attr('data-image') + '">' + $option.text() + '</li>'
                $(this).remove();
                $($select).append(xx);
            });
            $($select).replaceWith($ul);
        })
    }
}
function fn_op_setImage() {
    if (ismobile) {
        $.each($('.cls_tbl_tab_service ul option'), function (i, option) {
            if ($(option).attr('isadded') != 1) {
                var imm = '<img class="img_icon_operator" src="' + $(option).attr('data-image') + '" onerror="this.onerror=null;this.src=\'../../images/operators/no-image.png\'"  /> ';
                $(option).prepend(imm).attr('isadded', 1);
            }
        });
    }
}
$(document).on('click', '.ddlop option', function (i, v) {
    if (ismobile) {
        var id = $(this).parent('ul').attr('id')
        $(this).addClass('active').closest('.cls_Pdyn').hide();
        if (id.toLowerCase() != 'ddl_opertor_prepaidmobile' && id.toLowerCase() != 'ddl_prepaidcircle') {
            $('.ddlop option').removeClass('active');
            onchange_oprator_bill(this);
            $(this).addClass('active').parent().hide().siblings('.div_operator_search').hide();
            var ddopname = $(this).text();
            var imm = '<img class="img_icon_operator" src="' + $(this).attr('data-image') + '"   onerror="this.onerror=null;this.src=\'../../images/operators/no-image.png\'"/> ';
            var id = $(this).parent('ul').attr('id');
            $(this).parent().parent('div').append('<div class="operatordetails"><div  class="">' + ddopname + '</div><div>' + imm + '<a data-target="#' + id + '" class="change_editop" onclick=fn_edit_op(this)>change operator</a></div></div>')
        }
        else {
            if (id.toLowerCase() == 'ddl_prepaidcircle') {
                $(this).attr('class', 'active');
                fn_prepaid_mobile_design($('#txtPrePaidMobile'));
            } else {
                $(this).attr('class', 'active')
                $('.ddl_opertor_pre_div').css('display', 'none');
                $('.ddl_cicle_pre_div').css('display', 'block');
            }
        }
    }
});
function fn_edit_op(evnt) {
    if (ismobile) {
        $('.ddlop option').removeClass('active');
        $(evnt).closest('.operatordetails').hide();
        $($(evnt).attr('data-target')).show().siblings('.div_operator_search').show();
        $(evnt).closest('.div_optr_parent').siblings(':not(.div_optr_parent)').remove();
    }
}
function fn_edit_op_prepaid(evnt) {
    if (ismobile) {
        $(evnt).closest('.operatordetails').css('display', 'none');
        $($(evnt).attr('data-target')).css('display', 'block');
        $('.ddlop option').removeClass('active');
        $('.cls_prepaid_amount').css('display', 'none');
        $('.ddl_opertor_pre_div').css('display', 'block');
        $('.ddl_cicle_pre_div').css('display', 'none');
    }
}

function fn__search_operator(e) {
    var searchStr = $(e).val().toLowerCase();
    var target = $(e).attr('data-target');
    $.each($(target).children('option'), function (i, v) {
        var tt = $(v).text().toLowerCase();
        if (tt.indexOf(searchStr) >= 0) {
            $(v).show();
        }
        else {
            $(v).hide();
        }
    });
};

function fn_loadamination() {
    $.each($('.srvc'), function (i, v) {
        var xx = $(v).find('._tab_service_lnk');
        $.each(xx, function (ii, vv) {
            var rnn = fn_getrandomnumber(xx.length)

        });

    });
}
function fn_getrandomnumber(lent) {
    const rndInt = Math.floor(Math.random() * lent) + 1;
    return rndInt;
}


function fn_checksessonLogin() {
    var status = false;
    $.ajax({
        type: "POST",
        url: CUrl + '/Code/CYService.asmx/checksession',
        data: "{}",
        contentType: "application/json;",
        dataType: "json",
        async: false,
        success: function (response) {
            resp = JSON.parse(response.d);
            if (resp.status == 'success') {
                status = true;
            }
            if (resp.status == "sessionexp") {

                status = false;
            }
        },
        failure: function (response) {
            show_alert(response.d, 2);
            status = false;
        }
    });
    return status;
}
function fn_load_services() {
    $(document).find("#srvc").empty();
    CY_init();
}

function fn_loadSlider_Mobile() {
    $.ajax({
        type: "POST",
        url: CUrl + '/Code/CYService.asmx/mobileViewSlider',
        data: "{}",
        contentType: "application/json;",
        dataType: "json",
        async: false,
        success: function (response) {
            myfunction(JSON.parse(response.d));
        },
        failure: function (response) {
            show_alert(response.d, 2);
            status = false;
        }
    });
}
function myfunction(objj) {
    
    if (objj.length > 0) {
        var lst = $("#srvcCatData").children('li')
        $.each(lst, function (i, v) {
            var id = 1 + i;
            obj1 = objj.filter(function (v) {
                return v.TYPE == id
            })
            if (obj1.length > 0) {
                var sssss = '';
                $.each(obj1, function (i, v) {
                    sssss = sssss + '<div class="carousel-item ' + (i === 0 ? ' active ' : '') + '"><img src="../../Images/banner/medium/' + v.imageurl + '" alt="" class="d-block w-100"></div>'
                });
                var abc = ` <div id="sliderX1_` + id + `" class="carousel slide" data-bs-ride="carousel">
                                       <div class="carousel-inner">
                                                   `+ sssss + `
                                       </div>
                                       <button class="carousel-control-prev" type="button" data-bs-target="#sliderX1_`+ id + `" data-bs-slide="prev">
                                           <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                           <span class="visually-hidden">Previous</span>
                                       </button>
                                       <button class="carousel-control-next" type="button" data-bs-target="#sliderX1_`+ id + `" data-bs-slide="next">
                                           <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                           <span class="visually-hidden">Next</span>
                                       </button>
                                                </div>`;
                $(lst[i]).before(abc);
            }
        });
    }
}


