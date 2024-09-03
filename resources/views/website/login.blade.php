@extends("website.menu")

@section("content")

    <div class="container-fluid contact bg-light py-5">

        <!-- Header Start -->
        <div class="container-fluid bg-breadcrumb">
            <div class="container text-center py-5" style="max-width: 900px;">
                <h4 class="text-white display-4 mb-4 wow fadeInDown" data-wow-delay="0.1s">{{ trans('app.login') }}</h4>
            </div>
        </div>
        <!-- Header End -->

        <div class="container py-5">
            <div class="row g-5">
                <div class="col-3"></div>

                <div class="col-xl-6 wow fadeInRight {{ trans('app.txt') }} {{ trans('app.float') }}" data-wow-delay="0.4s" dir="{{ trans('app.dir') }}">
                        <form action="/university-Login" method="POST" class="form-floating" name="my-form" onsubmit="validateFrom('my-form',event)">
                            @csrf
                                <div class="form-floating">
                                    <span for="email">
                                        <i class="text-danger">*</i>
                                        {{ trans('app.our_email') }}
                                    </span><br>
                                    <input type="email" class="form-control border-0" name="email" placeholder="{{ trans('app.email') }}">
                                </div>

                                <br><br>

                                <div class="form-floating">
                                    <span for="password">
                                        <i class="text-danger">*</i>
                                        {{ trans('app.password') }}
                                    </span><br>
                                    <input type="password" class="form-control border-0" name="password" placeholder="{{ trans('app.password') }}">
                                </div>

                                <br><br>

                                <div class="form-group">
                                    <div class="g-recaptcha" data-sitekey="{{ env('GOOGLE_RECAPTCHA_KEY') }}"></div>
                                </div>

                                <br><br>

                                <div class="col-12">
                                    <button class="btn btn-primary w-100 py-3">{{ trans('app.login') }}</button>
                                </div>
                            </div>
                        </form>
                </div>

                <div class="col-3"></div>
            </div>
        </div>
    </div>

@endsection
