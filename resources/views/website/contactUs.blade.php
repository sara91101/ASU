@extends("website.menu")

@section("content")
<div class="container-fluid contact bg-light py-5"  dir="{{ trans('app.dir') }}">
    <div class="container py-5">
        <div class="row g-5">
            <div class="col-xl-6 wow fadeInLeft" data-wow-delay="0.2s">
                <div class="contact-img d-flex justify-content-center" >
                    <div class="contact-img-inner">
                        <img src="/web/img/contact.jpg" class="img-fluid w-100"  alt="Image">
                    </div>
                </div>
            </div>
            <div class="col-xl-6 wow fadeInRight {{ trans('app.txt') }} {{ trans('app.float') }}" data-wow-delay="0.4s" dir="{{ trans('app.dir') }}">
                {{--  <div>  --}}
                    <form action="/contacts" method="POST" class="form-floating" name="my-form" onsubmit="validateFrom('my-form',event)">
                        @csrf
                        <div class="row g-3 {{ trans('app.txt') }}">
                            <div class="col-lg-12 col-xl-12">
                                <span>
                                    <label class="text-danger">*</label> {{ trans('app.visitor_id') }}</span><br>
                                <div class="form-floating">
                                    <select class="form-select border-0" name="visitor_type" required>
                                        <option value="طالب">{{ trans('app.student') }} </option>
                                        @foreach ($types as $type)
                                            <option value="{{ $type->type_ar }}">{{ $type[trans('app.type_fld')] }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-12 col-xl-6 {{ trans('app.float') }}" align="{{ trans('app.align') }}">
                                <span class="float:right !important;">
                                    <label class="text-danger">*</label> {{ trans('app.name') }}</span><br>
                                <div class="form-floating">
                                    <input type="text" class="floating-input form-control border-0 {{ trans('app.txt') }}" name="name" placeholder="{{ trans('app.name') }}">
                                </div>
                            </div>
                            <div class="col-lg-12 col-xl-6">
                                <div class="form-floating">
                                    <span for="email">
                                        <label class="text-danger">*</label> {{ trans('app.our_email') }}</span><br>
                                    <input type="email" class="form-control border-0" name="email" placeholder="{{ trans('app.our_email') }}">
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-floating">
                                    <span for="subject">
                                        {{ trans('app.subject') }}</span><br>
                                    <input type="text" class="form-control border-0" name="subject" placeholder="{{ trans('app.subject') }}">
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-floating">
                                    <span for="message">
                                        <label class="text-danger">*</label> {{ trans('app.message') }}</span><br>
                                    <textarea class="form-control border-0" placeholder="{{ trans('app.message') }}" name="msg" style="height: 120px"></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="g-recaptcha" data-sitekey="{{ env('GOOGLE_RECAPTCHA_KEY') }}"></div>
                            </div>
                            <div class="col-12">
                                <button class="btn btn-primary w-100 py-3">{{ trans('app.send') }}</button>
                            </div>
                        </div>
                    </form>
                {{--  </div>  --}}
            </div>
            <div class="col-12 text-center" dir="{{ trans('app.dir') }}">
                <div>
                    <div class="row g-4">
                        <div class="col-md-6 col-lg-4 wow fadeInUp" data-wow-delay="0.2s">
                            <div class="contact-add-item">
                                <div class="contact-icon text-primary mb-4">
                                    <i class="fas fa-map-marker-alt fa-2x"></i>
                                </div>
                                <div>
                                    <h4>{{ trans("app.address") }}</h4>
                                    <p class="mb-0">{{ trans("app.uofk") }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-4 wow fadeInUp" data-wow-delay="0.4s">
                            <div class="contact-add-item">
                                <div class="contact-icon text-primary mb-4">
                                    <i class="fas fa-envelope fa-2x"></i>
                                </div>
                                <div>
                                    <h4>{{ trans("app.our_email") }}</h4>
                                    <p class="mb-0">{{ $email[trans("app.home_fld")] }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-4 wow fadeInUp" data-wow-delay="0.6s">
                            <div class="contact-add-item">
                                <div class="contact-icon text-primary mb-4">
                                    <i class="fa fa-phone-alt fa-2x"></i>
                                </div>
                                <div>
                                    <h4>{{ trans("app.phone") }}</h4>
                                    <p class="mb-0">(+249) 911 229 3330</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 wow fadeInUp" data-wow-delay="0.2s">
                <div class="rounded">
                    <iframe class="rounded w-100"
                    style="height: 400px;" src="https://maps.google.com/maps?q=أمانة+الشؤون+العلمية+-+جامعة+الخرطوم&t=&z=10&ie=UTF8&iwloc=&output=embed"
                    loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Contact End -->

@endsection
