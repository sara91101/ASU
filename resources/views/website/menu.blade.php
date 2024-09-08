<!DOCTYPE html>
<html lang="{{ trans('app.lng') }}">

    <head>
        {!! SEO::generate() !!}
        <meta charset="utf-8">
        <title>{{ trans('app.title') }}</title>
        <meta content="width=device-width, initial-scale=1.0" name="viewport">
        <meta content="" name="keywords">
        <meta content="" name="description">

        <!-- Google Web Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,100..1000;1,9..40,100..1000&family=Inter:slnt,wght@-10..0,100..900&display=swap" rel="stylesheet">

        <!-- Icon Font Stylesheet -->
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css"/>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

        <!-- Libraries Stylesheet -->
        <link rel="stylesheet" href="/web/lib/animate/animate.min.css"/>
        <link href="/web/lib/lightbox/css/lightbox.min.css" rel="stylesheet">
        <link href="/web/lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">


        <!-- Customized Bootstrap Stylesheet -->
        <link href="/web/css/bootstrap.min.css" rel="stylesheet">

        <!-- Template Stylesheet -->
        <link href="/web/css/style.css" rel="stylesheet">
        <link href="/kufi/kufi.css" rel="stylesheet">

        <link rel="icon" href="/web/img/asu_logo.jpeg" type="image/x-icon">


        <script src='https://www.google.com/recaptcha/api.js'></script>
        @if(app()->getLocale() == "en")
        <link href="https://fonts.googleapis.com/css2?family=Poppins" rel="stylesheet">
        <style>
            *{
                font-family: 'Poppins';
            }
            .dropdown .dropdown-menu .dropdown-item {
                text-align: left !important;
                float: left !important;
            }
        </style>
        @elseif(app()->getLocale() == "ar")
        <link href="https://fonts.googleapis.com/earlyaccess/droidarabickufi.css" rel="stylesheet">
        <style>
            *{
                font-family: 'Droid Arabic Kufi';
            }
        </style>
        @endif
        <style>
            .clock
            {
                color: #fff;
                font-size: 20px;
                letter-spacing: 7px;
            }
            .justi-content
            {
                text-align:justify;
                text-justify:inter-word;
            }
            .display-1
            {
                font-size: 40px !important;
            }
            .toast-center-center
            {
                top: 50%;
                left: 50%;
                transform: translate(-50%, -50%);
                text-align: {{ trans('app.align') }} !important;
                direction: {{ trans('app.align') }} !important;
            }

            //ads
            .announcement__text {
                overflow: hidden;
                white-space: nowrap;
                background-color: #015fc9 !important;
              }

              .announcement__text ul {
                display: flex;
                padding: 0;
                margin: 0;
                animation: marquee 30s linear infinite;
              }

              .announcement__text li {
                display: flex;
                padding: 0 75px;
                width: auto;
              }

              @keyframes marquee {
                0% { transform: translateX(100%); }
                100% { transform: translateX(-100%); }
              }

              @media(max-width:991px){
                .announcement__text li{width:100%;}
                .announcement__text ul{animation: marquee 30s linear infinite;}
              }

              .accordion-button::after {
                background-image: initial;
              }

              .accordion-button:not(.collapsed)::after {
                background-image: initial;
              }
        </style>

        <script>
            function validateFrom(formName,event)
            {
                var recaptcha = document.forms[formName]["g-recaptcha-response"].value;
                if (recaptcha != "")
                {
                    document.forms[formName].submit();
                }

                else
                {
                    toastr.options=
                    {
                        positionClass: "toast-center-center"
                    }
                    toastr.error("{!! trans('app.robot') !!}","{!! trans('app.robot_title') !!}");
                    event.preventDefault();
                }
            }

            function showTime()
            {
                var date = new Date();
                var h = date.getHours(); // 0 - 23
                var m = date.getMinutes(); // 0 - 59
                var s = date.getSeconds(); // 0 - 59
                var session = "AM";

                if(h == 0){
                    h = 12;
                }

                if(h > 12){
                    h = h - 12;
                    session = "PM";
                }

                h = (h < 10) ? "0" + h : h;
                m = (m < 10) ? "0" + m : m;
                s = (s < 10) ? "0" + s : s;

                var time = h + ":" + m + ":" + s + " " + session;
                document.getElementById("MyClockDisplay").innerText = time;
                document.getElementById("MyClockDisplay").textContent = time;

                setTimeout(showTime, 1000);

            }

            function showElse(sel)
            {
                if(sel.value == 1000)
                {
                    document.getElementById("elseService").style.display = "block";
                    document.getElementById("else").required = true;
                }
                else
                {
                    document.getElementById("elseService").style.display = "none";
                    document.getElementById("else").required = false;
                }
            }
        </script>

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    </head>

    <body>
        {{--  previous url is: {{ $_SERVER['HTTP_REFERER'] }}  --}}
        @if(count($news) > 0)
            <div class="announcement__text" style="background-color: #0777f7 !important; color:white;">
                <ul>
                    @foreach ($news as $new)
                        <li>{{ $new[trans('app.ads_fld')] }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @php $url = Route::getFacadeRoot()->current()->uri(); @endphp

        @if(Session("errorNote") > 0)
            <script>
                toastr.options=
                {
                    positionClass: "toast-center-center"
                }
                toastr.error("{!! Session::get('errorNote') !!}","عٌذراً");
                sessionStorage.clear();
            </script>
        @endif
        @if(Session::has("note"))
            <script>
                toastr.options=
                {
                    positionClass: "toast-center-center"
                }
                toastr.success("{!! Session::get('note') !!}","نجاح");
                sessionStorage.clear();
            </script>
        @endif

        <!-- Modal Search Start -->
        <div class="modal fade" id="searchModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" dir="{{ trans('app.dir') }}">
            <div class="modal-dialog modal-fullscreen">
                <div class="modal-content rounded-0">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">{{ trans('app.search') }}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form method="POST" action="searchable">
                        @csrf
                        <div class="modal-body d-flex align-items-center bg-primary">
                                <div class="input-group w-75 mx-auto d-flex">
                                    <input type="search" name="field" class="form-control p-3" aria-describedby="search-icon-1">
                                    <button type="submit" id="search-icon-1" class="btn bg-light border nput-group-text p-3">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- Modal Search End -->

        <!-- Spinner Start -->
        <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        <!-- Spinner End -->

        <!-- Topbar Start -->
        <div class="container-fluid topbar px-0 px-lg-4 bg-light py-2 d-none d-lg-block">
            <div class="container">
                <div class="row gx-0 align-items-center">
                    <div class="col-lg-8 text-center text-lg-start mb-lg-0">
                        <div class="d-flex flex-wrap">
                            <div class="border-end border-primary pe-3">
                                <a href="https://wa.me/+2499112293330" class="text-muted small"><i class="fab fa-whatsapp text-primary me-2"></i>+249 911 229 3330</a>
                            </div>
                            <div class="ps-3">
                                <a href="mailto:info@asu.org.sd" class="text-muted small" target="blank"><i class="fas fa-envelope text-primary me-2"></i>info@asu.org.sd</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 text-center text-lg-end">
                        <div class="d-flex justify-content-end">
                            <div class="d-flex border-end border-primary pe-3">
                                <a class="btn p-0 text-primary me-3" target="blank" href="https://www.facebook.com/ASUsd.85?mibextid=ZbWKwL"><i class="fab fa-facebook-f"></i></a>
                                <a class="btn p-0 text-primary me-3" target="blank" href="https://x.com/i/flow/login?redirect_after_login=%2FAljamAt68294"><i class="fab fa-twitter"></i></a>
                                <a class="btn p-0 text-primary me-3" target="blank" href="https://www.instagram.com/asuorgsd/"><i class="fab fa-instagram"></i></a>
                                <a class="btn p-0 text-primary me-0" target="blank" href="https://www.linkedin.com/company/asuorgsd/"><i class="fab fa-linkedin-in"></i></a>
                            </div>
                            <div class="dropdown ms-3">
                                <a href="#" class="dropdown-toggle text-dark" data-bs-toggle="dropdown">
                                    <small>
                                        <i class="fas fa-globe-europe text-primary me-2"></i>
                                        {{ trans('app.language') }}
                                    </small>
                                </a>
                                <div class="dropdown-menu rounded">
                                    <a href="javascript:;" class="dropdown-item">{{ trans('app.language') }}</a>
                                    <a href="/change/{{  trans('app.lg') }}" class="dropdown-item">{{ trans('app.other_language') }}</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Topbar End -->

        <!-- Navbar & Hero Start -->
        <div class="container-fluid nav-bar px-0 px-lg-4 py-lg-0">
            <div class="container">
                <nav class="navbar navbar-expand-lg navbar-light" dir="{{ trans('lang/app.dir') }}">
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                        <span class="fa fa-bars"></span>
                    </button>

                    <a href="/change/{{  trans('app.lg') }}" class="navbar-toggler" type="button">
                        <span class="fas fa-globe-europe"></span>
                    </a>

                    <a href="/" class="navbar-brand p-0">
                        <img src="/web/img/asu_logo.jpeg" alt="Logo" width="85" height="50">
                    </a>

                    <div class="collapse navbar-collapse" id="navbarCollapse" dir="{{ trans('app.dir') }}">
                        <div class="navbar-nav mx-0 mx-lg-auto">
                            <a href="/" class="nav-item nav-link @if($url == '/')active @endif">{{ trans('app.home') }}</a>
                            <a href="/about" class="nav-item nav-link @if($url == 'about')active @endif">{{ trans('app.about') }}</a>
                            <a href="/members" class="nav-item nav-link @if($url == 'members' || $url == 'membership') active @endif">{{ trans('app.members') }}</a>
                            <a href="/committes" class="nav-item nav-link @if($url == 'committes' || $url == 'committee/{id}') active @endif">{{ trans('app.committe') }}</a>
                            <div class="nav-item dropdown @if(($url == 'simulation') || ($url == 'coalition')) active @endif">
                                <a href="javascript:;" class="nav-link" data-bs-toggle="dropdown">
                                    <span class="dropdown-toggle"> {{ trans('app.units') }} </span>
                                </a>
                                <div class="dropdown-menu">
                                    <a href="/simulation" class="dropdown-item @if($url == 'simulation')active @endif">{{ trans('app.computer') }}</a>
                                    <a href="/coalition" class="dropdown-item @if($url == 'coalition')active @endif">{{ trans('app.links') }}</a>
                                </div>
                            </div>
                            <div class="nav-item dropdown @if($url == 'dspaceContent/{id}') active @endif">
                                <a href="javascript:;" class="nav-link" data-bs-toggle="dropdown">
                                    <span class="dropdown-toggle"> {{ trans('app.dspace') }} </span>
                                </a>
                                <div class="dropdown-menu">
                                    @foreach($dspace as $link)
                                        <a class="dropdown-item" href="/dspaceContent/{{ $link->id }}" align="right">{{ $link[trans('app.link_val')] }}</a></li>
                                    @endforeach

                                </div>
                            </div>
                            <a href="/contact" class="nav-item nav-link @if($url == 'contact')active @endif">{{ trans('app.contact') }}</a>
                            <div class="nav-item px-3 justify-content-between" style="position: relative;display: flex;flex: none;flex-direction: row; justify-content: space-between;">
                                @if(is_null(Auth::guard('university')->user()))
                                    <a href="/universityLogin" class="btn btn-primary py-2 px-4 ms-3 flex-shrink-0" align="{{ trans('app.align') }}"> {{ trans('app.login') }}</a>
                                @else
                                    <a href="/universityProfile" class="btn btn-primary py-2 px-4 ms-3 flex-shrink-0" align="{{ trans('app.align') }}"> {{ trans('app.profile') }}</a>
                                @endif

                                <button class="btn-search btn btn-primary btn-md-square rounded-circle flex-shrink-0" data-bs-toggle="modal" data-bs-target="#searchModal" align="{{ trans('app.arrow') }}"><i class="fas fa-search"></i></button>

                            </div>
                        </div>
                    </div>
                </nav>
            </div>
        </div>
        <!-- Navbar & Hero End -->
        @yield("content")

        <script src="http://code.jquery.com/jquery-1.10.2.js"></script>
        <script src="http://code.jquery.com/ui/1.11.2/jquery-ui.js"></script>
        <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

        <!-- Footer Start -->
        <div class="container-fluid footer py-5 wow fadeIn" data-wow-delay="0.2s" dir="{{ trans('app.dir') }}">
            <div class="container py-5">
                <div class="row g-5">
                    <div class="col-xl-9">
                        <div class="mb-5">
                            <div class="row g-4">
                                <div class="col-md-6 col-lg-6 col-xl-6">
                                    <div class="footer-item">
                                        <a href="index.html" class="p-0">
                                            <img src="/web/img/asu_logo.jpeg" alt="Logo" width="85" height="50">
                                        </a>
                                        <p class="text-white mb-4">{{ $goals[0][trans('app.home_fld')] }}</p>
                                        <div class="footer-btn d-flex">
                                            <a class="btn btn-md-square rounded-circle me-3" href="https://www.facebook.com/ASUsd.85?mibextid=ZbWKwL"><i class="fab fa-facebook-f"></i></a>
                                            <a class="btn btn-md-square rounded-circle me-3" href="https://x.com/i/flow/login?redirect_after_login=%2FAljamAt68294"><i class="fab fa-twitter"></i></a>
                                            <a class="btn btn-md-square rounded-circle me-3" href="https://www.instagram.com/asuorgsd/"><i class="fab fa-instagram"></i></a>&nbsp;&nbsp;&nbsp;
                                            <a class="btn btn-md-square rounded-circle me-0" href="https://www.linkedin.com/company/asuorgsd/"><i class="fab fa-linkedin-in"></i></a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-6 col-xl-6">
                                    <div class="footer-item">
                                        <h4 class="text-white mb-4">{{ trans('app.quick') }}</h4>
                                        <a href="/home"><i class="fas fa-angle-right me-2"></i> {{ trans('app.home') }}</a>
                                        <a href="/about"><i class="fas fa-angle-right me-2"></i> {{ trans('app.about') }}</a>
                                        <a href="/members"><i class="fas fa-angle-right me-2"></i> {{ trans('app.members') }}</a>
                                        <a href="/committes"><i class="fas fa-angle-right me-2"></i> {{ trans('app.committe') }}</a>
                                        <a href="/contact"><i class="fas fa-angle-right me-2"></i> {{ trans('app.contact') }}</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="pt-5" style="border-top: 1px solid rgba(255, 255, 255, 0.08);">
                            <div class="row g-0">
                                <div class="col-12">
                                    <div class="row g-4">
                                        <div class="col-lg-6 col-xl-4">
                                            <div class="d-flex">
                                                <div class="btn-xl-square bg-primary text-white rounded p-4 me-4">
                                                    <i class="fas fa-map-marker-alt fa-2x"></i>
                                                </div>&nbsp;&nbsp;&nbsp;
                                                <div>
                                                    <h4 class="text-white">{{ trans('app.address') }}</h4>
                                                    <p class="mb-0">{{ trans('app.uofk') }}</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-xl-4">
                                            <div class="d-flex">
                                                <div class="btn-xl-square bg-primary text-white rounded p-4 me-4">
                                                    <i class="fas fa-envelope fa-2x"></i>
                                                </div>&nbsp;&nbsp;&nbsp;
                                                <div>
                                                    <h4 class="text-white">{{ trans('app.our_email') }}</h4>
                                                    <p class="mb-0">info@asu.org.sd</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-xl-4">
                                            <div class="d-flex">
                                                <div class="btn-xl-square bg-primary text-white rounded p-4 me-4">
                                                    <i class="fa fa-phone-alt fa-2x"></i>
                                                </div>&nbsp;&nbsp;&nbsp;
                                                <div>
                                                    <h4 class="text-white">{{ trans('app.phone') }}</h4>
                                                    <p class="mb-0" dir="ltr">(+249) 911 229 3330</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-3">
                        <div class="footer-item">
                            <h4 class="text-white mb-4 {{ trans('app.txt') }}" dir="{{ trans('app.dir') }}">
                                {!! Session::get('count_of_visitors') !!}  {{ trans('app.visitor') }}
                            </h4>

                            <div id="MyClockDisplay" class="clock" onload="showTime()" dir="{{ trans('app.revise') }}"></div>
                            <br>

                            <div class="d-flex flex-shrink-0">
                                <div class="footer-btn">
                                    <a href="#" class="btn btn-lg-square rounded-circle position-relative wow tada" data-wow-delay=".9s">
                                        <i class="fa fa-phone-alt fa-2x"></i>
                                        <div class="position-absolute" style="top: 2px; right: 12px;">
                                            <span><i class="fa fa-comment-dots text-secondary"></i></span>
                                        </div>
                                    </a>
                                </div>&nbsp;&nbsp;&nbsp;
                                <div class="d-flex flex-column ms-3 flex-shrink-0">
                                    <span>{{ trans('app.contact') }}</span>
                                    <a href="tel:+249 911 229 3330">
                                        <span class="text-white" dir="ltr">+249 911 229 3330</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Footer End -->

        <!-- Copyright Start -->
        <div class="container-fluid copyright py-4" align="center">
            <div class="container">
                <div class="row g-4 align-items-center">
                    <div class="col-md-12 text-center">
                        <span class="text-center text-white" dir="{{ trans('app.dir') }}">
                            <i class="fas fa-copyright text-light me-2"></i>
                                {{ trans("app.title") }}
                            ,{{ trans("app.footer") }}
                        </span>
                        <br>
                        <a class="text-center text-white" href="https://wa.me/+201554624885" target="blank">
                            <img src="/images/sarah_logo.jpeg" width="35" height="35">
                            Created By Sarah Mokhtar
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <!-- Copyright End -->

        <!-- Back to Top -->
        <a href="#" class="btn btn-primary btn-lg-square rounded-circle back-to-top"><i class="fa fa-arrow-up"></i></a>


        <!-- JavaScript Libraries -->
        <script>showTime();</script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
        <script src="/web/lib/wow/wow.min.js"></script>
        <script src="/web/lib/easing/easing.min.js"></script>
        <script src="/web/lib/waypoints/waypoints.min.js"></script>
        <script src="/web/lib/counterup/counterup.min.js"></script>
        <script src="/web/lib/lightbox/js/lightbox.min.js"></script>
        <script src="/web/lib/owlcarousel/owl.carousel.min.js"></script>


        <!-- Template Javascript -->
        <script src="/web/js/main.js"></script>
    </body>

</html>

