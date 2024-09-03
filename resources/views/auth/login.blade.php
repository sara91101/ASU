<!doctype html>

<html lang="ar" dir="rtl" data-nav-layout="horizontal" data-vertical-style="overlay" data-theme-mode="light" data-header-styles="light" data-menu-styles="light" data-toggled="close">

    <head>

        <!-- Meta Data -->
        <meta charset="UTF-8">
        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>إتحاد الجامعات السودانية</title>
        <meta name="Description" content="Bootstrap Responsive Admin Web Dashboard HTML5 Template">
        <meta name="Author" content="Spruko Technologies Private Limited">
        <meta name="keywords" content="admin,admin dashboard,admin panel,admin template,bootstrap,clean,dashboard,flat,jquery,modern,responsive,premium admin templates,responsive admin,ui,ui kit.">

        <!-- Favicon -->
        <link rel="icon" href="/web/img/asu_logo.jpeg" type="image/x-icon">

        <!-- Main Theme Js -->
        <script src="/assets/js/authentication-main.js"></script>

        <!-- Bootstrap Css -->
        <link id="style" href="/assets/libs/bootstrap/css/bootstrap.min.css" rel="stylesheet" >

        <!-- Style Css -->
        <link href="/assets/css/styles.min.css" rel="stylesheet" >

        <!-- Icons Css -->
        <link href="/assets/css/icons.min.css" rel="stylesheet" >

        <link href="/kufi/kufi.css" rel="stylesheet">

        <style>
            *{
               font-family: "Droid Arabic Kufi";
             }
        </style>


    </head>

    <body>
        <div class="container">
            <div class="row justify-content-center align-items-center authentication authentication-basic h-100">
                <div class="col-xxl-4 col-xl-5 col-lg-5 col-md-6 col-sm-8 col-12">
                    <div class="my-5 d-flex justify-content-center">
                        <a href="/">
                            <img src="/web/img/asu_logo.jpeg" alt="logo" class="desktop-logo">
                            <img src="/web/img/asu_logo.jpeg" alt="logo" class="desktop-dark">
                        </a>
                    </div>
                    <div class="card custom-card">
                        <div class="card-body p-5">
                            <p class="h5 fw-semibold mb-2 text-center">إتحاد الجامعات السودانية</p>
                            <p class="h5 fw-semibold mb-2 text-center">الأمانة العامة</p>

                            <form method="POST" action="{{ route('login') }}">
                                @csrf
                                <div class="row gy-3">
                                    <div class="col-xl-12">
                                        <label for="signin-username" class="form-label text-default">البريد الإلكتروني</label>
                                        <input type="email" class="form-control form-control-lg @error('email') is-invalid @enderror" id="signin-username" name="email" value="{{ old('email') }}">
                                        @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="col-xl-12 mb-2">
                                        <label for="signin-password" class="form-label text-default d-block">كلمة المرور</label>
                                        <div class="input-group">
                                            <input type="password" class="form-control form-control-lg  @error('password') is-invalid @enderror" id="signin-password" name="password" required autocomplete="current-password">
                                        </div>
                                    </div>
                                    <div class="col-xl-12 d-grid mt-2">
                                        <input type="submit" class="btn btn-lg btn-primary" value="تسجيل الدخول">
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <script src="/assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>

        <!-- Show Password JS -->
        <script src="/assets/js/show-password.js"></script>
    </body>

</html>


