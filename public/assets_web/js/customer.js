var loc1 = window.location.pathname;
var dir1 = loc1.substring(0, loc1.lastIndexOf('/'));
var DomainUrl1 = "";
var hdnLatitude = "";
var hdnLongitude = "";
var aaaaa1 = dir1.split('/');
DomainUrl1 = DomainUrl1 + '/root/';
for (var i = 3; i < aaaaa1.length; i++) {
    DomainUrl1 = DomainUrl1 + '/root/'
}

function getLocation() {
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(showPosition, showError);
    }
    else {
        alert("Geolocation is not supported by this browser.");
    }
}
function showPosition(position) {
    var latlondata = position.coords.latitude + "," + position.coords.longitude;
    //$('#btnLogin').removeClass('btn-disabled');
    //$('#hdnLatitude').val(position.coords.latitude);
    //$('#hdnLongitude').val(position.coords.longitude);
    hdnLatitude = position.coords.latitude;
    hdnLongitude = position.coords.longitude;
}
function showError(error) {
    if (error.code == 1) {
        //$('#btnLogin').addClass('btn-disabled');
        alert("Allow location for log in");
        return;
    }
    else if (err.code == 2) {
        //$('#btnLogin').addClass('btn-disabled');
        alert("Allow location for log in");
        return;
    }
    else if (err.code == 3) {
        //$('#btnLogin').addClass('btn-disabled');
        alert("Allow location for log in");
        return;
    }
    else {
        //$('#btnLogin').addClass('btn-disabled');
        alert("Allow location for log in");
        //getLocation();
        return;
    }
    /*getLocation();*/
}
function fn_Register() {
    var x = $("#txtMobileNo").val();
    if (x.length != 10) {
        alert('Enter Valid Mobile no');
        $("#txtMobileNo").addClass('validate');
        return;
    }
    $("#txtMobileNo").removeClass('validate');
    if (hdnLatitude == "" || hdnLongitude == "") {
        getLocation();
        return;
    }
    $.ajax({
        url: DomainUrl1 + "registration.aspx/CheckNumber",
        data: JSON.stringify({ "LoginID": x, "type": "x", "email": x }),
        type: "post",
        dataType: "json",
        contentType: "application/json; charset=utf-8",
        success: function (response1) {
            response1 = JSON.parse(response1.d);
            if (response1.status == 1) {
                $("#div_LoginId").removeClass('active');
                $("#div_Login_OTP").addClass('active');
            }
            else if (response1.status == 2) {
                $("#div_LoginId").removeClass('active');
                $("#div_Login_pass").addClass('active');
            }
            else if (response1.status == 3) {
                $("#btnRegister").addClass('hide');
                $("#div_LoginId").removeClass('active');
                $("#div_Login_Register").addClass('active');
                $("#txtMobiler").val(x);
                var PTYPE = response1.PTYPE;
                if (PTYPE == 'B2B') {
                    $("#rbmembertype_C").css('display', 'none');
                    $('label[for="rbmembertype_C"]').css('display', 'none');
                    $("#rbmembertype_R").prop('checked', true);
                } else if (PTYPE == 'B2C') {
                    $("#rbmembertype_C").prop('checked', true);
                    $("#rbmembertype_R").css('display', 'none');
                    $('label[for="rbmembertype_R"]').css('display', 'none')
                    $("#div_reffid").addClass('show').removeClass('hide')
                } else if (PTYPE == 'B2BB2C') {
                    $("#rbmembertype_C").prop('checked', true);
                    $("#rbmembertype_R").css('display', 'block');
                    $("#div_reffid").addClass('show').removeClass('hide')
                }
            }
            else {
                //alert(response1.message);
                $("#txtMobileNo").addClass('validate');
            }
        }
    });
}
function fn_Register_OTP() {
    var x = $("#txtMobileNo").val();
    if (x.length != 10) {
        alert('Enter Valid Mobile no');
        $("#txtMobileNo").addClass('validate');
        return;
    }
    $("#txtMobileNo").removeClass('validate');
    var OTP = $("#txtOTP").val();
    if (OTP.length != 6) {
        alert('Enter valid OTP');
        $("#txtOTP").addClass('validate');
        return;
    }
    $.ajax({
        url: DomainUrl1 + "registration.aspx/Loginvia_OTP",
        data: JSON.stringify({ "LoginID": x, "OTP": OTP, "Password": "" }),
        type: "post",
        dataType: "json",
        contentType: "application/json; charset=utf-8",
        success: function (response1) {
            response1 = JSON.parse(response1.d);
            if (response1.status == 1) {
                $("#div_Login_OTP").removeClass('active');
                $("#div_Login_pass").addClass('active');
                //window.location.href = "dashboard.aspx";
                if (isMobileDevice) {
                    var ddd = {};
                    ddd["FCMTOKEN"] = $("#FCMToken").val();
                    ddd["LATITUDE"] = $("#hdnLatitude").val();
                    ddd["LONGITUDE"] = $("#hdnLongitude").val();
                    ddd["LOGINID"] = x;
                    ddd["PASSWORD"] = OTP;
                    setCookie('setauthdata', (JSON.stringify(ddd)), 30)
                    fn_Logindetails(x, OTP, $("#hdnLatitude").val(), $("#hdnLongitude").val());

                }
            }
            else {
                alert(response1.message);
                $("#txtOTP").addClass('validate');
            }
        }
    });
}
function fn_Register_Password() {
    getLocation();
    var x = $("#txtMobileNo").val();
    if (x.length != 10) {
        alert('Enter Valid Mobile no');
        $("#txtMobileNo").addClass('validate');
        return;
    }
    $("#txtMobileNo").removeClass('validate');
    var OTP = $("#txt_Password").val();
    if (OTP.length < 6) {
        alert('Enter valid password');
        $("#txt_Password").addClass('validate');
        return;
    }
    $.ajax({
        url: DomainUrl1 + "registration.aspx/LoginMember_VP",
        data: JSON.stringify({ "LoginID": x, "Password": OTP }),
        type: "post",
        dataType: "json",
        contentType: "application/json; charset=utf-8",
        success: function (response1) {
            response1 = JSON.parse(response1.d);
            if (response1.status == 1) {
                $("#div_Login_OTP").removeClass('active');
                $("#div_Login_pass").addClass('active');
                fn_Logindetails(x, OTP, hdnLatitude, hdnLongitude);
                fn_load_menus();
                var ddd = {};
                ddd["FCMTOKEN"] = $("#FCMToken").val();
                ddd["LATITUDE"] = hdnLatitude;
                ddd["LONGITUDE"] = hdnLongitude;
                ddd["LOGINID"] = x;
                ddd["PASSWORD"] = OTP;
                localStorage.setItem("setauthdata", (JSON.stringify(ddd)))
                fn_show_popup_close();
                fn_load_services();
                window.location.href = "Services.aspx";

            }
            else {
                if (response1.status == 2) {
                    $("#div_Login_OTP").addClass('active');
                    $("#div_Login_pass").removeClass('active');



                }


                else {
                    alert(response1.message);
                    $("#txtOTP").addClass('validate');
                }
            }
        }
    });
}
function fn_checkLogin() {
    $.ajax({
        url: DomainUrl1 + "member/dashboard.aspx/checkStatus",
        data: JSON.stringify({}),
        type: "post",
        dataType: "json",
        async: false,
        contentType: "application/json; charset=utf-8",
        success: function (response1) {
            response1 = JSON.parse(response1.d);
            if (parseInt(response1.status) == 1) { return true; } else {
                fn_show_popup();
                return false;
            }
        }
    });
}

$('input[name="rbmembertype"]').change(function () {
    if ($(this).val() == "6") {
        $("#div_reffid").addClass('show').removeClass('hide')
    } else { $("#div_reffid").removeClass('show').addClass('hide') }

})

function fn_Register_Member() {
    var mailformat = /\S+@\S+\.\S+/;
    var mtype = $('input[name="rbmembertype"]:checked').val();
    var fname = $("#txtFirstName").val().trim();
    if (fname.length < 2) {
        $("#txtFirstName").focus();
        alert("enter first name")
        return;
    }
    var lname = $("#txtLastName").val().trim();
    if (lname.length < 3) {
        $("#txtLastName").focus();
        alert("enter last name")
        return;
    }
    var Email = $("#txtEmail").val().trim();
    if (!Email.match(mailformat)) {
        $("#txtEmail").focus();
        alert("invalid email")
        return;
    }
    var Mobile = $("#txtMobiler").val().trim();
    if (Mobile.length != 10) {
        $("#txtMobiler").focus();
        alert("invalid mobile")
        return;
    }
    var _otp = $("#txtregisterOTP").val().trim();
    if (_otp.length != 6) {
        $("#txtregisterOTP").focus();
        alert("invalid OTP")
        return;
    }
    var ReferrId = $("#txtReferrId").val().trim();
    var obj = {
        mtype: mtype,
        fname: fname,
        lname: lname,
        email: Email,
        mobile: Mobile,
        referrid: ReferrId,
        login_otp: _otp
    }
    $.ajax({
        url: DomainUrl1 + "registration.aspx/registerMember",
        data: JSON.stringify({ "data": JSON.stringify(obj) }),
        type: "post",
        dataType: "json",
        contentType: "application/json; charset=utf-8",
        success: function (response1) {
            response1 = JSON.parse(response1.d);
            if (response1.status == 1) {
                $("#div_Login_OTP").removeClass('active');
                $("#div_Login_pass").addClass('active');
                fn_load_menus();
                var ddd = {};
                ddd["FCMTOKEN"] = $("#FCMToken").val();
                ddd["LATITUDE"] = $("#hdnLatitude").val();
                ddd["LONGITUDE"] = $("#hdnLongitude").val();
                ddd["LOGINID"] = x;
                ddd["PASSWORD"] = "";
                localStorage.setItem("setauthdata", (JSON.stringify(ddd)))
                fn_show_popup_close();
            }
            else {
                alert(response1.message);
                $("#txtOTP").addClass('validate');
            }
        }
    });
}
function fn_lnkresendOTP() {
    fn_Register_Member_Send_otp();
}
function fn_Register_Member_Send_otp() {
    var mailformat = /\S+@\S+\.\S+/;
    var mtype = $('input[name="rbmembertype"]:checked').val();
    var fname = $("#txtFirstName").val().trim();
    if (fname.length < 2) {
        $("#txtFirstName").focus();
        alert("enter first name")
        return;
    }
    var lname = $("#txtLastName").val().trim();
    if (lname.length < 3) {
        $("#txtLastName").focus();
        alert("enter last name")
        return;
    }
    var Email = $("#txtEmail").val().trim();
    if (!Email.match(mailformat)) {
        $("#txtEmail").focus();
        alert("invalid email")
        return;
    }
    var Mobile = $("#txtMobiler").val().trim();
    if (Mobile.length != 10) {
        $("#txtMobiler").focus();
        alert("invalid mobile")
        return;
    }
    $.ajax({
        url: DomainUrl1 + "registration.aspx/CheckNumber",
        data: JSON.stringify({ "LoginID": Mobile, "type": "SENDOTP", "email": Email }),
        type: "post",
        dataType: "json",
        contentType: "application/json; charset=utf-8",
        success: function (response1) {
            response1 = JSON.parse(response1.d);
            if (response1.status == 1) {
                $("#btnRegister").removeClass('hide');
                $("#btnSendOTPRegister").addClass('hide');
                $("#div_otp_register").removeClass('hide');
                setTimeout(function () { $("#lnkresendOTP").css("display", "block") }, 30000)

            }
            else {
                alert(response1.message);
            }
        }

    });
}
function fn_getCompanyInfo() {
    var ddd;
    $.ajax({
        url: DomainUrl1 + "registration.aspx/GetCompnayInfo",
        data: JSON.stringify({}),
        type: "post",
        dataType: "json",
        contentType: "application/json; charset=utf-8",
        success: function (response1) {
            sessionStorage.setItem("companyinfo", response1.d)
        }
    });

}
function fn_custmerldata() {
    var x = `<div class="_Login_Div" id="registration_Login_popup">
        <div class="_Login_Div_Inner" >
                <a class="backbtn_cross danger" onclick="fn_show_popup_close()"><i class="fa fa-times"></i></a>
                <div class="form-group text-center">
                    <asp:Image ID="img_logo2" runat="server" />
                </div>
                <br />
                <div class="col-md-12 div_login_page">
                    <div class="form-group active mt-3 cls_Mobile" id="div_LoginId">
                        <h3>Login and create an account</h3>
                        <label class="enter-mobil"><b>Mobile Number</b></label>
                        <span>+91</span>
                        <input type="number" id="txtMobileNo" class="_txtbox" pattern="[0-9]*" inputmode="numeric" maxlength="10" autocomplete="off"  />
                        <div class="clearfix"></div>
                        <br />
                        <div class="col-md-6">
                            <a target="_blank" href="ForgotPassword.aspx"><span style="text-align: center; margin: 0 auto; display: block; color: #ec6b43;" runat="server" id="forgopass">Forgot Password </span></a>
                        </div>
                        <div class="col-md-6 text-right" style="float: right">
                            <div class="mt-5 ">

                                <input type="button" class="btn btn-danger" pattern="[0-9]*" inputmode="numeric" name="btnLogin" value="Go" onclick="fn_Register()" />
                            </div>
                        </div>
                    </div>
                    <div class="form-group " id="div_Login_OTP">
                        <h3>OTP Verify</h3>
                        <label class="enter-mobil">OTP</label>
                        <input type="tel" id="txtOTP" class="_txtbox" pattern="[0-9]*" inputmode="numeric" placeholder="Enter OTP" autocomplete="off" maxlength="6"  />
                        <div class="clearfix"></div>
                        <br />
                        <div class="col-md-12 text-right" style="float: right">
                            <div class="">
                                <input type="button" class="btn btn-danger" name="btnLogin" value="Submit" onclick="fn_Register_OTP()" />
                            </div>
                        </div>
                    </div>
                    <div class="form-group " id="div_Login_pass">
                        <h3>Login</h3>
                        <label class="enter-mobil">Password</label>
                        <input type="password" id="txt_Password" class="_txtbox" placeholder="Enter password" autocomplete="off" minlength="6" />
                        <div class="clearfix"></div>
                        <br />
                        <div class="col-md-12 text-right" style="float: right">
                            <div class="">
                                <input type="button" class="btn btn-danger" name="btnLogin" value="Submit" onclick="fn_Register_Password()" />
                            </div>
                        </div>
                    </div>
                    <div class="form-group" id="div_Login_Register">
                        <h3>Create an account</h3>
                        <div class="col-md-12">
                            <input type="radio" id="rbmembertype_C" name="rbmembertype" value="6" />
                            <label for="rbmembertype_C">Customer</label>
                            <input type="radio" id="rbmembertype_R" name="rbmembertype" value="5" />
                            <label for="rbmembertype_R">Retailer</label>

                        </div>
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-6 col-6">
                                    <label class="txtFirstName">First Name</label>
                                    <input type="text" id="txtFirstName" class="_txtbox" autocomplete="off" />
                                </div>
                                <div class="col-md-6 col-6">
                                    <label class="txtLastName">Last Name</label>
                                    <input type="text" id="txtLastName" class="_txtbox" autocomplete="off" />
                                </div>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                        <div class="col-md-12 col-12">
                            <label class="txtEmail">Email</label>
                            <input type="email" id="txtEmail" class="_txtbox" autocomplete="off" />
                        </div>
                        <div class="col-md-12 col-12">
                            <label class="txtMobiler">Mobile</label>
                            <input type="tel" id="txtMobiler" maxlength="10" class="_txtbox" autocomplete="off" readonly="readonly" />
                        </div>
                        <div class="clearfix"></div>
                        <div class="col-md-12 col-12 hide" id="div_reffid">
                            <label class="txtReferrId">Referral id</label>
                            <input type="email" id="txtReferrId" class="_txtbox" autocomplete="off" />
                        </div>
                        <div class="clearfix"></div>
                        <br />
                        <div class="col-md-12 text-right" style="float: right">
                            <div class="">
                                <input type="button" class="btn btn-danger" name="btnSendOTPRegister" id="btnSendOTPRegister" value="Send OTP" onclick="fn_Register_Member_Send_otp()" />
                            </div>
                        </div>
                        <div class="col-md-12 col-12 hide" id="div_otp_register">
                            <label class="txtregisterOTP">OTP</label>
                            <input type="tel" id="txtregisterOTP" class="_txtbox" maxlength="6" autocomplete="off" />
                            <a class="resendOTP" id="lnkresendOTP" style="display:none" onclick="fn_lnkresendOTP()">Resend OTP</a>   
                        </div>
                        <div class="clearfix"></div>
                        <br />
                        <div class="col-md-12 text-right" style="float: right">
                            <div class="">
                                <input type="button" class="btn btn-success" name="btnRegister" id="btnRegister" value="Register" onclick="fn_Register_Member()" />
                            </div>
                        </div>
                    </div>
                </div>
            </div >
        </div > `;
    $('body').find('#registration_Login_popup').remove();;
    $('body').append(x);
}

function fn_Logindetails(LoginID, Password, Latitude, Longitude) {
    $.ajax({
        url: DomainUrl1 + "registration.aspx/SaveLoginDetails",
        data: JSON.stringify({ "LoginID": LoginID, "Password": Password, "Latitude": Latitude, "Longitude": Longitude }),
        type: "post",
        dataType: "json",
        contentType: "application/json; charset=utf-8",
        success: function (response1) {
            response1 = JSON.parse(response1.d);
            if (response1.status == 1) {

                window.location.href = "Services.aspx";

            }
            else {

            }
        }
    });
}
