@extends("website.menu")

@section("content")
    <style>
        * {
            margin: 0;
            padding: 0;
        }
        i {
            margin-right: 10px;
        }

        /*------------------------*/
        input:focus,
        button:focus,
        .form-control:focus{
            outline: none;
            box-shadow: none;
        }
        .form-control:disabled, .form-control[readonly]{
            background-color: #fff;
        }
        /*----------step-wizard------------*/
        .d-flex{
            display: flex;
        }
        .justify-content-center{
            justify-content: center;
        }
        .align-items-center{
            align-items: center;
        }

        /*---------signup-step-------------*/
        .bg-color{
            background-color: #333;
        }
        .signup-step-container{
            padding: 150px 0px;
            padding-bottom: 60px;
        }
        .wizard .nav-tabs {
                position: relative;
                margin-bottom: 0;
                border-bottom-color: transparent;
            }

            .wizard > div.wizard-inner {
                    position: relative;
            margin-bottom: 50px;
            text-align: center;
            }

        .connecting-line {
            height: 2px;
            background: #e0e0e0;
            position: absolute;
            width: 75%;
            margin: 0 auto;
            left: 0;
            right: 0;
            top: 15px;
            z-index: 1;
        }

        .wizard .nav-tabs > li.active > a, .wizard .nav-tabs > li.active > a:hover, .wizard .nav-tabs > li.active > a:focus {
            color: #555555;
            cursor: default;
            border: 0;
            border-bottom-color: transparent;
        }

        span.round-tab {
            width: 30px;
            height: 30px;
            line-height: 30px;
            display: inline-block;
            border-radius: 50%;
            background: #fff;
            z-index: 2;
            position: absolute;
            left: 0;
            text-align: center;
            font-size: 16px;
            color: #0e214b;
            font-weight: 500;
            border: 1px solid #ddd;
        }
        span.round-tab i{
            color:#555555;
        }
        .wizard li.active span.round-tab {
                background: #015fc9;
            color: #fff;
            border-color: #015fc9;
        }
        .wizard li.active span.round-tab i{
            color: #5bc0de;
        }
        .wizard .nav-tabs > li.active > a i{
            color: #015fc9;
        }

        .wizard .nav-tabs > li {
            width: 50%;
        }

        .wizard li:after {
            content: " ";
            position: absolute;
            left: 46%;
            opacity: 0;
            margin: 0 auto;
            bottom: 0px;
            border: 5px solid transparent;
            border-bottom-color: red;
            transition: 0.1s ease-in-out;
        }



        .wizard .nav-tabs > li a {
            width: 30px;
            height: 30px;
            margin: 20px auto;
            border-radius: 100%;
            padding: 0;
            background-color: transparent;
            position: relative;
            top: 0;
        }
        .wizard .nav-tabs > li a i{
            position: absolute;
            top: -15px;
            font-style: normal;
            font-weight: 400;
            white-space: nowrap;
            left: 50%;
            transform: translate(-50%, -50%);
            font-size: 15px;
            font-weight: 700;
            color: #000;
        }

            .wizard .nav-tabs > li a:hover {
                background: transparent;
            }

        .wizard .tab-pane {
            position: relative;
            padding-top: 20px;
        }


        .wizard h3 {
            margin-top: 0;
        }
        .prev-step,
        .next-step{
            font-size: 15px;
            padding: 8px 24px;
            border: none;
            border-radius: 4px;
            margin-top: 30px;
        }
        .prev-step{
            background-color: #616161;
            color: white;
        }
        .next-step{
            background-color: #015fc9;
            color: white;
        }
        .skip-btn{
            background-color: #cec12d;
        }
        .step-head{
            font-size: 20px;
            text-align: center;
            font-weight: 500;
            margin-bottom: 20px;
        }
        .term-check{
            font-size: 14px;
            font-weight: 400;
        }
        .custom-file {
            position: relative;
            display: inline-block;
            width: 100%;
            height: 40px;
            margin-bottom: 0;
        }
        .custom-file-input {
            position: relative;
            z-index: 2;
            width: 100%;
            height: 40px;
            margin: 0;
            opacity: 0;
        }
        .custom-file-label {
            position: absolute;
            top: 0;
            right: 0;
            left: 0;
            z-index: 1;
            height: 40px;
            padding: .375rem .75rem;
            font-weight: 400;
            line-height: 2;
            color: #495057;
            background-color: #fff;
            border: 1px solid #ced4da;
            border-radius: .25rem;
        }
        .custom-file-label::after {
            position: absolute;
            top: 0;
            right: 0;
            bottom: 0;
            z-index: 3;
            display: block;
            height: 38px;
            padding: .375rem .75rem;
            line-height: 2;
            color: #495057;
            content: "Browse";
            background-color: #e9ecef;
            border-left: inherit;
            border-radius: 0 .25rem .25rem 0;
        }
        .footer-link{
            margin-top: 30px;
        }
        .all-info-container{

        }
        .list-content{
            margin-bottom: 10px;
        }
        .list-content a{
            padding: 10px 15px;
            width: 100%;
            display: inline-block;
            background-color: #f5f5f5;
            position: relative;
            color: #565656;
            font-weight: 400;
            border-radius: 4px;
        }
        .list-content a[aria-expanded="true"] i{
            transform: rotate(180deg);
        }
        .list-content a i{
            text-align: right;
            position: absolute;
            top: 15px;
            right: 10px;
            transition: 0.5s;
        }
        .form-control[disabled], .form-control[readonly], fieldset[disabled] .form-control {
            background-color: #fdfdfd;
        }
        .list-box{
            padding: 10px;
        }
        .signup-logo-header .logo_area{
            width: 200px;
        }
        .signup-logo-header .nav > li{
            padding: 0;
        }
        .signup-logo-header .header-flex{
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .list-inline li{
            display: inline-block;
        }
        .pull-right{
            float: right;
        }
        /*-----------custom-checkbox-----------*/
        /*----------Custom-Checkbox---------*/
        input[type="checkbox"]{
            position: relative;
            display: inline-block;
            margin-right: 5px;
        }
        input[type="checkbox"]::before,
        input[type="checkbox"]::after {
            position: absolute;
            content: "";
            display: inline-block;
        }
        input[type="checkbox"]::before{
            height: 16px;
            width: 16px;
            border: 1px solid #999;
            left: 0px;
            top: 0px;
            background-color: #fff;
            border-radius: 2px;
        }
        input[type="checkbox"]::after{
            height: 5px;
            width: 9px;
            left: 4px;
            top: 4px;
        }
        input[type="checkbox"]:checked::after{
            content: "";
            border-left: 1px solid #fff;
            border-bottom: 1px solid #fff;
            transform: rotate(-45deg);
        }
        input[type="checkbox"]:checked::before{
            background-color: #18ba60;
            border-color: #18ba60;
        }






        @media (max-width: 767px){
            .sign-content h3{
                font-size: 40px;
            }
            .wizard .nav-tabs > li a i{
                display: none;
            }
            .signup-logo-header .navbar-toggle{
                margin: 0;
                margin-top: 8px;
            }
            .signup-logo-header .logo_area{
                margin-top: 0;
            }
            .signup-logo-header .header-flex{
                display: block;
            }
        }

    </style>

    <script>
        // ------------step-wizard-------------
        $(document).ready(function () {

            //Wizard
            $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {

                var target = $(e.target);

                if (target.parent().hasClass('disabled')) {
                    return false;
                }
            });

            $(".next-step").click(function (e) {
                $("#step1").removeClass('active');
                $("#step1").addClass('disabled');

                $("#step2").removeClass('disabled');
                $("#step2").addClass('active');
            });
            $(".prev-step").click(function (e) {

                $("#step2").removeClass('active');
                $("#step2").addClass('disabled');

                $("#step1").removeClass('disabled');
                $("#step1").addClass('active');

            });
        });

    </script>


    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>


    <!-- Header Start -->
    <div class="container-fluid bg-breadcrumb">
        <div class="container text-center py-5" style="max-width: 900px;">
            <h4 class="text-white display-4 mb-4 wow fadeInDown" data-wow-delay="0.1s">
                {{ trans('app.membership_edit') }}
            </h4>
        </div>
    </div>
    <!-- Header end -->

    <section class="signup-step-container" dir="{{ trans('app.dir') }}">
        <div class="container">
            <div class="row d-flex justify-content-center">
                <div class="col-12">
                    <div class="wizard">
                        <div class="wizard-inner">
                            <div class="connecting-line"></div>
                            <ul class="nav nav-tabs" role="tablist">
                                <li role="presentation" class="active">
                                    <a href="#step1" data-toggle="tab" aria-controls="step1" role="tab" aria-expanded="true">
                                        <span class="round-tab">1 </span>
                                        <i>{{ trans('app.personal') }}</i>
                                    </a>
                                </li>
                                <li role="presentation" class="disabled">
                                    <a href="#step2" data-toggle="tab" aria-controls="step2" role="tab" aria-expanded="false">
                                        <span class="round-tab">2</span>
                                        <i>{{ trans('app.account') }}</i>
                                    </a>
                                </li>
                            </ul>
                        </div>

                        <form role="form" action="/updateMembership" class="login-box" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="tab-content" id="main_form">
                                <div class="{{ trans('app.txt') }} tab-pane active" role="tabpanel" id="step1" dir="{{ trans('app.dir') }}">
                                    <div class="row">
                                        <div class="col-lg-4 col-md-12 col-sm-12">
                                            <div class="form-group">
                                                <label><i class="text-danger">*</i> {{ trans("app.name") }}</label>
                                                <input type="name" value="{{ $university->ar_name }}" name="ar_name" id="name" class="form-control" required><br>
                                            </div>
                                        </div>

                                        <div class="col-lg-4 col-md-12 col-sm-12">
                                            <div class="form-group">
                                                <label><i class="text-danger">*</i>{{ trans("app.our_address") }}</label>
                                                <input type="text" value="{{ $university->address }}" name="address" id="address" class="form-control" required><br>
                                            </div>
                                        </div>

                                        <div class="col-lg-4 col-md-12 col-sm-12">
                                            <div class="form-group">
                                                <label><i class="text-danger">*</i> {{ trans("app.birth") }}</label>
                                                <input type="date" name="datee" value="{{ $university->datee }}" id="datee" class="form-control" required><br>
                                            </div>
                                        </div>

                                        <div class="form-group col-lg-4 col-md-12 col-sm-12">
                                            <label><i class="text-danger">*</i> {{ trans("app.type") }}</label>
                                            <select name="type_id"  class="form-control">
                                                @foreach ($types as $type)
                                                    <option value="{{ $type->id }}">{{ $type[trans('app.type_fld')] }}</option>
                                                @endforeach
                                            </select><br>
                                        </div>

                                        <div class="form-group col-lg-4 col-md-12 col-sm-12">
                                            <label><i class="text-danger">*</i>{{ trans("app.state") }}</label>
                                            <select name="state_id" class="form-control">
                                                @foreach ($states as $state)
                                                    <option value="{{ $state->id }}">{{ $state[trans('app.state_fld')] }}</option>
                                                @endforeach
                                            </select><br>
                                        </div>

                                        <div class="form-group col-lg-4 col-md-12 col-sm-12">
                                            <label>{{ trans("app.town") }}</label>
                                            <input type="text" name="town" id="town" value="{{ $university->town }}" class="form-control"><br>
                                        </div>

                                        <div class="form-group col-lg-6 col-md-12 col-sm-12">
                                            <label><i class="text-danger">*</i>{{ trans("app.phone") }}</label>
                                            <input type="text" name="phone" id="phone" value="{{ $university->phone }}" class="form-control" required><br>
                                        </div>

                                        <div class="form-group col-lg-6 col-md-12 col-sm-12">
                                            <label><i class="text-danger">*</i>{{ trans("app.our_email") }}</label>
                                            <input type="email" name="email" id="email" value="{{ $university->email }}" class="form-control" required><br>
                                        </div>

                                        <div class="form-group col-lg-6 col-md-12 col-sm-12">
                                            <label><i class="text-danger">*</i> {{ trans("app.logo") }}</label>
                                            <input type="file" name="logo" id="logo" class="form-control" accept="image/png, image/jpg, image/jpeg"><br>
                                        </div>

                                        <div class="form-group col-lg-6 col-md-12 col-sm-12">
                                            <label>{{ trans("app.website") }}</label>
                                            <input type="text" name="website" class="form-control" placeholder="https://www.google.com"><br>
                                        </div>

                                        <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                            <label>{{ trans('app.other_details') }}</label>
                                            <textarea name="others" class="form-control">{{ $university->others }}</textarea><br>
                                        </div>
                                    </div>

                                    <ul class="text-white text-center">
                                        <li><label type="button" class="text-white default-btn next-step">{{ trans('app.next') }}</label></li>
                                    </ul>
                                </div>

                                <div class="tab-pane" role="tabpanel" id="step2">
                                    <div class="row">
                                        <div class="alert alert-primary col-lg-12 col-md-12 col-sm-12">
                                            <label><b>{{ trans('app.manager') }}</b></label>
                                        </div>
                                        <div class="form-group col-lg-6 col-md-12 col-sm-12">
                                            <input type="name" value="{{ $university->manager_name }}" name="manager_name" placeholder="{{ trans('app.name') }}" class="form-control" ><br>
                                        </div>
                                        <div class="form-group col-lg-6 col-md-12 col-sm-12">
                                            <input type="text" name="manager_address" value="{{ $university->manager_address }}" placeholder="{{ trans('app.address') }}" class="form-control" ><br>
                                        </div>
                                        <div class="form-group col-lg-6 col-md-12 col-sm-12">
                                            <input type="phone" name="manager_phone" value="{{ $university->manager_phone }}" placeholder="{{ trans('app.phone') }}" class="form-control" ><br>
                                        </div>
                                        <div class="form-group col-lg-6 col-md-12 col-sm-12">
                                            <input type="email" name="manager_email" value="{{ $university->manager_email }}" placeholder='{{ trans("app.our_email") }}' class="form-control" ><br>
                                        </div>

                                        <br>
                                        <div class="alert alert-primary col-lg-12 col-md-12 col-sm-12">
                                            <label><b>{{ trans('app.sub_manager') }}</b></label>
                                        </div>
                                        <div class="form-group col-lg-6 col-md-12 col-sm-12">
                                            <input type="name" name="sub_manager_name" value="{{ $university->sub_manager_name }}" placeholder="{{ trans('app.name') }}" class="form-control" ><br>
                                        </div>
                                        <div class="form-group col-lg-6 col-md-12 col-sm-12">
                                            <input type="text" name="sub_manager_address" value="{{ $university->sub_manager_address }}" placeholder="{{ trans('app.address') }}" class="form-control" ><br>
                                        </div>
                                        <div class="form-group col-lg-6 col-md-12 col-sm-12">
                                            <input type="phone" name="sub_manager_phone" value="{{ $university->sub_manager_phone }}" placeholder="{{ trans('app.phone') }}" class="form-control" ><br>
                                        </div>
                                        <div class="form-group col-lg-6 col-md-12 col-sm-12">
                                            <input type="email" name="sub_manager_email" value="{{ $university->sub_manager_email }}" placeholder='{{ trans("app.our_email") }}' class="form-control" ><br>
                                        </div>

                                        <br>
                                        <div class="alert alert-primary col-lg-12 col-md-12 col-sm-12">
                                            <label><b>{{ trans('app.execution_manager') }}</b></label>
                                        </div>
                                        <div class="form-group col-lg-6 col-md-12 col-sm-12">
                                            <input type="name" name="execution_manager_name" value="{{ $university->execution_manager_name }}" placeholder="{{ trans('app.name') }}" class="form-control" ><br>
                                        </div>
                                        <div class="form-group col-lg-6 col-md-12 col-sm-12">
                                            <input type="text" name="execution_manager_address" value="{{ $university->execution_manager_address }}" placeholder="{{ trans('app.address') }}" class="form-control" ><br>
                                        </div>
                                        <div class="form-group col-lg-6 col-md-12 col-sm-12">
                                            <input type="phone" name="execution_manager_phone" value="{{ $university->execution_manager_phone }}" placeholder="{{ trans('app.phone') }}" class="form-control" ><br>
                                        </div>
                                        <div class="form-group col-lg-6 col-md-12 col-sm-12">
                                            <input type="email" name="execution_manager_email" value="{{ $university->execution_manager_email }}" placeholder='{{ trans("app.our_email") }}' class="form-control" ><br>
                                        </div>
                                        <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                            <div class="g-recaptcha" data-sitekey="{{ env('GOOGLE_RECAPTCHA_KEY') }}"></div>
                                        </div>
                                    </div>
                                    <div class="text-center justify-content-between">
                                        <label type="button" class="default-btn prev-step">{{ trans('app.previuos') }}</label>
                                        <input type="submit" class="default-btn next-step" value="{{ trans('app.send') }}">
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>


@endsection
