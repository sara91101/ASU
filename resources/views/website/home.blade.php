@extends("website.menu")

@section("content")

    <script>
        function requestService(service_id,login)
        {
            if (login == 1)
            {
                var services = document.getElementById("services_drop");
                for(let s=0; s < services.options.length; s++)
                {
                    if(services.options[s].value == service_id)
                    {
                        services.options[s].selected = true;
                        services.selectedIndex = s;
                    }
                }
                $("#ServiceRequest").modal("show");
            }

            else
                {
                    toastr.options=
                    {
                        positionClass: "toast-center-center"
                    }
                    toastr.error("{!! trans('app.service_login') !!}","{!! trans('app.robot_title') !!}");
                    event.preventDefault();
                }


        }

        function showMore(modalId)
        {
            $("#"+modalId).modal('show');
        }
        function showNew(newId)
        {
            document.getElementById("newTitle").innerHTML = document.getElementById("title"+newId).innerHTML;
            document.getElementById("newDescription").innerHTML = document.getElementById("description"+newId).innerHTML;
            $("#news").modal('show');
        }
    </script>

    <div class="modal fade" id="ServiceRequest">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header justify-content-center" align="center">
                    <h5 class="modal-title justify-content-center">{{ trans("app.apply") }}</h5>
                </div>
                <form method="POST" action="/serviceApply">
                @csrf
                    <div class="modal-body  {{ trans('app.txt') }}" dir="{{ trans('app.dir') }}">
                        <div class="form-group">
                            <label>{{ trans('app.services') }}</label><br>
                            <select class="form-control" dir="{{ trans('app.dir') }}" name="service_id" id="services_drop"  onchange="showElse(this)">
                                @foreach ($services as $service)
                                    <option value="{{ $service->id }}">{{ $service[trans('app.service_val')] }}</option>
                                @endforeach
                                <option value="1000">{{ trans('app.else') }}</option>
                            </select><br><br>
                        </div>

                        <div class="form-grop" id="elseService" style="display: none;">
                            <label>{{ trans('app.else') }}</label><br>
                            <textarea name="else" id="else" cols="30" rows="10" class="form-control"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-center" align="center">
                        <button type="submit" class="btn btn-primary">{{ trans('app.sure') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="mission">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header justify-content-center" align="center">
                    <h5 class="modal-title justify-content-center">{{ trans("app.mission") }}</h5>
                </div>
                <div class="modal-body  {{ trans('app.txt') }}" dir="{{ trans('app.dir') }}">{{ $mission[trans('app.home_fld')] }}</div>
                <div class="modal-footer justify-content-center" align="center">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">{{ trans('app.cancel') }}</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="values">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header justify-content-center" align="center">
                    <h5 class="modal-title justify-content-center">{{ trans("app.values") }}</h5>
                </div>
                <div class="modal-body {{ trans('app.txt') }}" dir="{{ trans('app.dir') }}">
                    <ul>
                        @foreach ($values as $value)
                        <p class="text-dark">
                            <i class="fa fa-check text-primary me-3"></i>
                            {{ $value[trans('app.home_fld')] }}
                        </p>
                        @endforeach
                    </ul>
                </div>
                <div class="modal-footer justify-content-center" align="center">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">{{ trans('app.cancel') }}</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="news">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header justify-content-center" align="center">
                    <h5 class="modal-title justify-content-center" id="newTitle"></h5>
                </div>
                <div class="modal-body {{ trans('app.txt') }}" dir="{{ trans('app.dir') }}" id="newDescription">
                </div>
                <div class="modal-footer justify-content-center" align="center">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">{{ trans('app.cancel') }}</button>
                </div>
            </div>
        </div>
    </div>

        <!-- Carousel Start -->
        <div class="header-carousel owl-carousel {{ trans('app.txt') }}">

            @foreach ($sliders as $slider)
            <div class="header-carousel-item bg-primary">
                <div class="carousel-caption">
                    <div class="container">
                        <div class="row g-4 align-items-center">
                            <div class="col-lg-7 animated fadeInLeft">
                                <div class="text-sm-center">
                                    <h4 class="display-1 text-white mb-4">{{ trans('app.title') }}</h4>
                                    <p class="mb-5 fs-5 {{ trans('app.txt') }}" dir="{{ trans('app.dir') }}">{{ $goals[2][trans('app.home_fld')] }}</p>
                                    <div class="d-flex justify-content-center flex-shrink-0 mb-4">
                                        <a class="btn btn-light rounded-pill py-3 px-4 px-md-5 me-2" href="https://wa.me/+249112293330"><i class="fab fa-whatsapp me-2"></i> {{ trans('app.chat') }}</a>
                                        <a class="btn btn-dark rounded-pill py-3 px-4 px-md-5 ms-2" href="/about">{{ trans('app.more') }}</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-5 animated fadeInRight">
                                <div class="calrousel-img" style="object-fit: cover;">
                                    <img src="/public{{ $slider->home_image }}" class="img-fluid w-100" alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <!-- Carousel End -->

        <!-- Feature Start -->
        <div id="FEATURES" class="container-fluid feature bg-light py-5 justi-content">
            <div class="container py-5">
                <div class="text-center mx-auto pb-5 wow fadeInUp" data-wow-delay="0.2s" style="max-width: 800px;">
                    <h4 class="text-primary text-center">{{ trans('app.about') }}</h4>
                </div>
                <div class="row g-4" dir="{{ trans('app.dir') }}">

                    <div class="col-md-12 col-lg-12 col-xl-4 wow fadeInUp" data-wow-delay="0.2s">
                        <div class="feature-item p-4 pt-0">
                            <div class="feature-icon p-4 mb-4">
                                <i class="far fa-eye fa-3x"></i>
                            </div>
                            <h4 class="mb-4">{{ trans('app.vision') }}</h4>
                            <p class="mb-4">{{ $vision[trans('app.home_fld')] }}</p>
                            {{--  <a class="btn btn-primary rounded-pill py-2 px-4" href="#">{{ trans('app.more') }}</a>  --}}
                        </div>
                    </div>

                    <div class="col-md-12 col-lg-12 col-xl-4 wow fadeInUp" data-wow-delay="0.6s">
                        <div class="feature-item p-4 pt-0">
                            <div class="feature-icon p-4 mb-4">
                                <i class="fa fa-envelope fa-3x"></i>
                            </div>
                            <h4 class="mb-4">{{ trans('app.mission') }}</h4>
                            <p class="mb-4">
                                {{ Str::of($mission[trans('app.home_fld')])->words(12,"   ...") }}
                            </p>
                            <a class="btn btn-primary rounded-pill py-2 px-4" href="javascript:;" onclick="showMore('mission')">{{ trans('app.more') }}</a>
                        </div>
                    </div>

                    <div class="col-md-12 col-lg-12 col-xl-4 wow fadeInUp" data-wow-delay="0.8s">
                        <div class="feature-item p-4 pt-0">
                            <div class="feature-icon p-4 mb-4">
                                <i class="fa fa-bullseye fa-3x"></i>
                            </div>
                            <h4 class="mb-4">{{ trans('app.values') }}</h4>
                            @foreach ($values->take(2) as $value)
                            <p class="text-dark">
                                <i class="fa fa-check text-primary me-3"></i>
                                {{ $value[trans('app.home_fld')] }}
                            </p>
                            @endforeach
                            <a class="btn btn-primary rounded-pill py-2 px-4" href="javascript:;" onclick="showMore('values')">
                                {{ trans('app.more') }}
                            </a>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <!-- Feature End -->

        <!-- About Start -->
        <div id="ABOUTASU" class="container-fluid bg-light about pb-5 {{ trans('app.txt') }} justi-content" dir="{{ trans('app.dir') }}">
            <div class="container pb-5">
                <div class="row g-5">
                    <div class="col-xl-6 wow fadeInLeft" data-wow-delay="0.2s">
                        <div class="about-item-content bg-white rounded p-5 h-100">
                            {{--  <h4 class="text-primary">About Our Company</h4>  --}}
                            <h1 class="display-4 mb-4">{{ trans('app.history') }}</h1>
                            <p>{{ $about[trans('app.home_fld')] }}</p>
                            @if(app()->getLocale() == "ar")
                                @foreach ($goals->take(2) as $goal)
                                    <p class="text-dark">
                                        <i class="fa fa-check text-primary me-3"></i>
                                        {{ $goal[trans('app.home_fld')] }}
                                    </p>
                                @endforeach
                            @endif
                            <a class="btn btn-primary rounded-pill py-3 px-5" href="/about">
                                {{ trans('app.more') }}
                            </a>
                        </div>
                    </div>

                    <div class="col-xl-6 wow fadeInRight" data-wow-delay="0.2s">
                        <div class="bg-white rounded p-5 h-100">
                            <div class="row g-4 justify-content-center">
                                <div class="col-12">
                                    <div class="rounded bg-light">
                                        <img src="/web/img/banner.jpeg" class="img-fluid rounded w-100" alt="">
                                    </div>
                                </div>
                                @foreach ($types as $type)
                                    <div class="col-sm-6">
                                        <div class="counter-item bg-light rounded p-3 h-100">
                                            <div class="counter-counting">
                                                <a href="/members/{{ $type->id }}" class="text-primary fs-2 fw-bold" data-toggle="counter-up">
                                                    {{ count($type->university) }}
                                                </a>
                                            </div>
                                            <a href="/members/{{ $type->id }}" class="mb-0 text-dark text-bold">
                                                <b>{{ $type[trans('app.type_fld')] }}</b>
                                            </a>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- About End -->

        <!-- Service Start -->
        <div id="SERVICES" class="container-fluid service py-5">
            <div class="container py-5">
                <div class="text-center mx-auto pb-5 wow fadeInUp" data-wow-delay="0.2s" style="max-width: 800px;">
                    <h4 class="text-primary">{{ trans('app.services') }}</h4>
                    {{--  <h1 class="display-4 mb-4">We Provide Best Services</h1>
                    <p class="mb-0">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Tenetur adipisci facilis cupiditate recusandae aperiam temporibus corporis itaque quis facere, numquam, ad culpa deserunt sint dolorem autem obcaecati, ipsam mollitia hic.
                    </p>  --}}
                </div>
                @php (is_null($university_user)) ? $check_user = 0 : $check_user =1;  @endphp
                <div class="row g-4 justify-content-center {{ trans('app.txt') }}" dir="{{ trans('app.dir') }}">
                    @foreach ($services as $service)
                    <div class="col-md-12 col-lg-12 col-xl-4 wow fadeInUp" data-wow-delay="0.2s">
                        <div class="service-item">
                            <div class="service-img">
                                <img src="/servicesImages/{{ $service->image }}" class="img-fluid rounded-top w-100" alt="">
                                <div class="service-icon p-3">
                                    <i class="fab fa-servicestack"></i>
                                </div>
                            </div>

                            <div class="service-content p-4">
                                <div class="service-content-inner">
                                    <a href="javascript:;" class="d-inline-block h4">
                                        {{ $service[trans('app.service_val')] }}
                                    </a>
                                    <p class="mb-4">{{ $service[trans('app.service_description')] }}</p>
                                    <label class="btn btn-primary rounded-pill py-2 px-4" onclick="requestService({{ $service->id }},{{ $check_user }})">
                                        {{ trans('app.apply') }}
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
        <!-- Service End -->

        <!-- FAQs Start -->
        <div id="FAQS" class="container-fluid faq-section bg-light py-5" dir="{{ trans('app.dir') }}">
            <div class="container py-5">
                <div class="row g-5 align-items-center">
                    <div class="col-xl-6 wow fadeInLeft" data-wow-delay="0.2s">
                        <div class="h-100">
                            <div class="mb-5">
                                <h4 class="text-primary text-center">{{ trans('app.faq') }}</h4>
                            </div>
                            <div class="accordion" id="accordionExample" dir="{{ trans('app.dir') }}">
                                @foreach ($faqs as $faq)
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="heading{{$faq->id}}">
                                        <button class="accordion-button @if($loop->first) border-0 @else collapsed @endif" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapse{{$faq->id}}" aria-expanded="@if($loop->first) true @else false @endif" aria-controls="collapse{{$faq->id}}">
                                            {{ $faq[trans('app.faq_question')] }}
                                        </button>
                                    </h2>
                                    <div id="collapse{{$faq->id}}" class="accordion-collapse collapse @if($loop->first) show active @endif" aria-labelledby="heading{{$faq->id}}" data-bs-parent="#accordionExample">
                                        <div class="accordion-body rounded">
                                            {{ $faq[trans('app.faq_answer')] }}
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6 wow fadeInRight" data-wow-delay="0.4s">
                        <img src="/web/img/carousel-2.png" class="img-fluid w-100" alt="">
                    </div>
                </div>
            </div>
        </div>
        <!-- FAQs End -->

        <!-- Blog Start -->
        @if(count($news) > 0)
        <div id="NEWS" class="container-fluid blog py-5" dir="{{ trans('app.dir') }}">
            <div class="container py-5">
                <div class="text-center mx-auto pb-5 wow fadeInUp" data-wow-delay="0.2s" style="max-width: 800px;">
                    <h4 class="text-primary">{{ trans('app.news') }} & {{ trans('app.ads') }}</h4>
                </div>
                <div class="row g-4 justify-content-center">
                    @foreach ($news as $new)
                    <div class="col-lg-6 col-xl-4 wow fadeInUp" data-wow-delay="0.2s">
                        <div class="blog-item">
                            <div class="blog-img">
                                @if(!is_null($new->image))
                                <img src="/public/news/{{ $new->image }}" class="img-fluid rounded-top w-100" alt="">
                                @else
                                <img src="/web/img/ads.jpg" class="img-fluid rounded-top w-100" alt="">
                                @endif
                            </div>
                            <div class="blog-content p-4">
                                <a href="javascript:;" class="h4 d-inline-block mb-3" id="title{{ $new->id }}">
                                    {{ $new[trans('app.ads_fld')] }}
                                </a>
                                <p class="mb-3" id="description{{ $new->id }}">{{ $new[trans('app.ads_details')] }}</p>
                                <a onclick="showNew({{ $new->id }})" href="javascript:;" class="btn p-0">{{ trans('app.more') }}  <i class="fa fa-arrow-{{ trans('app.arrow') }}"></i></a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
        @endif
        <!-- Blog End -->

        <!-- Team Start -->
        <!--div id="TEAM" class="container-fluid team pb-5 {{ trans('app.txt') }}" dir="{{ trans('app.dir') }}">
            <div-- class="container pb-5">
                <div class="text-center mx-auto pb-5 wow fadeInUp" data-wow-delay="0.2s" style="max-width: 800px;">
                    <h4 class="text-primary">{{ trans('app.team') }}</h4>
                </div>
                <div class="row g-4">
                    @foreach ($teams as $team)
                    <div class="col-md-12 col-lg-12 col-xl-4 wow fadeInUp" data-wow-delay="0.2s">
                        <div class="team-item">
                            <div class="team-img" align="center">
                                <img src="/teamImages/{{ $team->photo }}" class="img-fluid rounded-top" alt="">
                                <div class="team-icon">
                                    <a class="btn btn-primary btn-sm-square rounded-pill mb-2" href="javascript:;"><i class="fab fa-facebook-f"></i></a>
                                    <a class="btn btn-primary btn-sm-square rounded-pill mb-2" href="javascript:;"><i class="fab fa-twitter"></i></a>
                                    <a class="btn btn-primary btn-sm-square rounded-pill mb-2" href="javascript:;"><i class="fab fa-linkedin-in"></i></a>
                                    <a class="btn btn-primary btn-sm-square rounded-pill mb-0" href="javascript:;"><i class="fab fa-instagram"></i></a>
                                </div>
                            </div>
                            <div class="team-title p-4">
                                <h4 class="mb-0">{{ $team[trans('app.team_val')] }}</h4><br>
                                <p class="mb-0">{{ $team[trans('app.job_fld')] }}</p>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div-->
        </!--div>
        <!-- Team End -->


@endsection
