@extends('Web.layout.main')
@section('content')
<div class="content-body">
                <!-- row -->


                

    <div class="cls_bg_new">
        <div class="row11 d-none">
            <div class="col-lg-6">
                <div class="wallet-box">
                    <h2>A-Wallet</h2>
                    <p>2.38K</p>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="wallet-box wallet-box-1">
                    <h2>A-Wallet</h2>
                    <p>2.38K</p>
                </div>
            </div>
        </div>
        <div class="col-xl-12 col-xxl-4 col-lg-5 col-sm-6 text-center">
            <p>
                Recahrge, Pay Your Utitlity
                            <br>
                Bills &amp; Send Money To Any Bank
            </p>
        </div>
        <div class="row" style="align-items: center;">
            <div class="col-xl-12 col-xxl-4 col-lg-5 col-6 text-center">
                <div class="photo-shap photo-shap-a">
                    <img src="{{ asset('assets_web/images/gift-cards.png')}}" />
                </div>
            </div>
            <div class="col-xl-12 col-xxl-4 col-lg-5 col-6 text-center cls_icon-bg">
                <ul class="cls_icon_1 cls_icon_one">
                    <li style="display: none">
                        <a data-href="FundRequest.aspx" class="_tab_service_lnk">
                            <span class="plus-webnon">+</span>
                            <span class="plus-webnon-mobile">
                                <img src="{{ asset('assets_web/images/e-wallet.png')}}">
                            </span>
                            <p>E-Wallet</p>
                        </a>
                    </li>
                    <li>
                        <span id="ctl00_ContentPlaceHolder1_lblbalance" class="walletbalance">0</span>
                        <a data-href="#" class="_tab_service_lnk">
                            <p>E-Wallet</p>
                        </a>
                    </li>
                    <li style="display: none">
                        <a data-href="Payout.aspx" class="_tab_service_lnk">
                            <span class="plus-webnon">-</span>
                            <span class="plus-webnon-mobile">
                                <img src="{{ asset('assets_web/images/a-wallet.png')}}">
                            </span>
                            <p>A-Wallet</p>
                        </a>
                    </li>

                    <li>
                        <span id="ctl00_ContentPlaceHolder1_lblawbalance" class="walletbalance">0</span>
                        <a data-href="#" class="_tab_service_lnk">
                            <p>A-Wallet</p>
                        </a>
                    </li>
                </ul>
            </div>
        </div>

        <div class="col-xl-12 col-xxl-4 col-lg-5 col-sm-6 text-center">
            <div class="navigation">
                <div class="menuToggle"></div>
                <div class="menu">
                    <ul>
                        <li id="ctl00_ContentPlaceHolder1_liscan" style="--i: 0.1s">
                            <a data-href="scan_Qr_pay.aspx" class="_tab_service_lnk">
                                <i class="fa fa-qrcode" data-bs-toggle="modal" style="color: #6d4d9c;"></i>
                                <span>Scan QR</span>
                            </a>
                        </li>
                        <li id="ctl00_ContentPlaceHolder1_liaddmoney" style="--i: 0.2s">
                            <a data-href="mycash.aspx" class="_tab_service_lnk">
                                <i class="fa fa-rupee-sign" data-bs-toggle="modal" style="color: #6d4d9c;"></i>
                                <span>Add fund via PG</span>
                            </a>
                        </li>
                        
                        
                    </ul>
                </div>
            </div>
        </div>

        <div class="photo-shap">
            <img src="{{ asset('assets_web/images/plus-icon.png')}}" />
        </div>
    </div>

    <div id="baner-shap" class="baner-shap animation-a">
        <img src="{{ asset('assets_web/code/baner-shap.png')}}" alt="Add Money" />
    </div>

    <div class="col-md-12 text-center">
        
    </div>
    <div class="col-md-12">
        <div class="col-md-12" id="srvc">
        </div>
    </div>
    <div id="
        "
        class="modal fade" role="dialog" style="display: none;">
        <div class="modal-dialog width-20">
            <div class="modal-content">
                <div class="modal-body ">
                    <div class="col-md-12">
                        <div id="carouselExample1" class="carousel slide carousel-fade" data-bs-ride="carousel" data-bs-touch="true">
                            <div class="carousel-inner">
                                
                            </div>
                            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample1" data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Previous</span>
                            </button>
                            <button class="carousel-control-next" type="button" data-bs-target="#carouselExample1" data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Next</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="../../../code.jquery.com/jquery-3.5.1.js"></script>
    <script src="../../../cdn.jsdelivr.net/npm/select2%404.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="../../Code/JDataffaf.js?v=1.4"></script>
    <script src="../NewDesign/js/customer.js"></script>
    <script>
        CY_init();
        //$(document).contextmenu(function (e) {
        //    e.preventDefault();
        //    e.stopPropagation();
        //});

        //document.addEventListener('contextmenu', event => event.preventDefault());
        //document.onkeydown = function (e) {
        //    if (event.keyCode == 123) {
        //        return false;
        //    }
        //    if (e.ctrlKey && e.shiftKey && e.keyCode == 'I'.charCodeAt(0)) {
        //        return false;
        //    }
        //    if (e.ctrlKey && e.shiftKey && e.keyCode == 'J'.charCodeAt(0)) {
        //        return false;
        //    }
        //    if (e.ctrlKey && e.keyCode == 'U'.charCodeAt(0)) {
        //        return false;
        //    }
        //}
        //$(document).contextmenu(function (e) {
        //    e.preventDefault();
        //    e.stopPropagation();
        //});
    </script>
    <input type="hidden" name="ctl00$ContentPlaceHolder1$hfrefmsg2" id="hfrefmsg2" value="https://demo.erechargebyte.com?newuser=1&amp;refferid=" />
    <input type="hidden" name="ctl00$ContentPlaceHolder1$hdnurl" id="hdnurl" />
    <script>


        (function ($) {

            var touchStartX = null;

            $('.carousel').each(function () {
                var $carousel = $(this);
                $(this).on('touchstart', function (event) {
                    var e = event.originalEvent;
                    if (e.touches.length == 1) {
                        var touch = e.touches[0];
                        touchStartX = touch.pageX;
                    }
                }).on('touchmove', function (event) {
                    var e = event.originalEvent;
                    if (touchStartX != null) {
                        var touchCurrentX = e.changedTouches[0].pageX;
                        if ((touchCurrentX - touchStartX) > 60) {
                            touchStartX = null;
                            $carousel.carousel('prev');
                        } else if ((touchStartX - touchCurrentX) > 60) {
                            touchStartX = null;
                            $carousel.carousel('next');
                        }
                    }
                }).on('touchend', function () {
                    touchStartX = null;
                });
            });

        })(jQuery);
        $(window).on("navigate", function (event, data) {
            var direction = data.state.direction;
            if (direction == 'back') {
                // do something
            }
            if (direction == 'forward') {
                // do something else
            }
        });
        $(document).ready(function () {
            if ($(window).width() < 769) {
                $("#div_card").css('display', 'block');
                $("#div_sharebtn").attr("data-a2a-url", $('#hdnurl').val());
            } else {
                $('input').attr('autocomplete', 'off');
                $('input[type=text]').attr('autocomplete', 'off');
                $(".x_select2").select2();

                $("#ddl_opertor_PrepaidMobile.ddlop,#ddl_opertor_DTH.ddlop").select2({
                    templateResult: formatState_Image
                });
                $("#div_sharebtn").css('display', 'none');
            };


            $('#main-wrapper').append('<div class="js-container "></div>');

        });
        function show_messageOnsuccess() {
            $('.js-container').addClass('containerX')
            window.confettiful = new Confettiful(document.querySelector('.js-container'));
            setInterval(function () {
                $('.containerX').remove();
                window.location.href = "https://demo.erechargebyte.com/root/newlogin.aspx";
            }, 3000);

        }
        function fn_click_redirect(evnt, url) {
            if (fn_checkLogin()) {
                window.location.href = url;
            }
        }
        let menuToggle = document.querySelector('.menuToggle');
        menuToggle.onclick = function () {
            menuToggle.classList.toggle('active');
        }

        function formatState_Image(state) {
            if (!state.id) {
                return state.text;
            }
            var baseUrl = $(state.element).attr('data-image');
            if (baseUrl == undefined) {
                baseUrl = '../../images/operators/no-image.png';
            }
            var $state = $(
                '<span><img src="' + baseUrl + '" class="img-flag" /> ' + state.text + '</span>'
            );
            return $state;
        };
    </script>

    <script>
        function fn_sharebtn(evnt) {
            try {
                navigator.share({
                    title: document.title,
                    text: "reffer link",
                    url: $('#hdnurl').val(),
                });
            }
            catch {
                var clipboardText = "";
                clipboardText = $('#hdnurl').val();
                copyToClipboard(clipboardText);
                alert("Copied to Clipboard");
            }
        }

        function copyToClipboard(text) {
            var textArea = document.createElement("textarea");
            textArea.value = text;
            document.body.appendChild(textArea);
            textArea.select();

            try {
                var successful = document.execCommand('copy');
            } catch (err) {
            }
            document.body.removeChild(textArea);
        }
    </script>

            </div>

@endsection
