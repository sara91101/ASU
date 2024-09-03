@extends("website.menu")

@section("content")
    <!-- Header Start -->
    <div class="container-fluid bg-breadcrumb">
        <div class="container text-center py-5" style="max-width: 900px;">
            <h4 class="text-white display-4 mb-4 wow fadeInDown" data-wow-delay="0.1s">
                {{ $committee[trans('app.member_val')] }}
            </h4>
        </div>
    </div><br><br>
    <!-- Header end -->

    <!-- About Start -->
        <div class="container-fluid bg-light about pb-5 {{ trans('app.txt') }} justi-content" dir="{{ trans('app.dir') }}">
            <div class="container pb-5">
                {{--  <div class="text-center mx-auto pb-5 wow fadeInUp" data-wow-delay="0.2s" style="max-width: 800px;">
                    <br><h4 class="text-primary text-center">{{ $committee[trans('app.member_val')] }}</h4>
                </div>  --}}
                <div class="row g-5">
                    <div class="col-xl-12 wow fadeInLeft" data-wow-delay="0.2s">
                        <div class="about-item-content bg-white rounded p-5 h-100">
                            <h1 class="display-4 mb-4">{{ trans('app.goals') }}</h1>
                            @foreach ($committee["task"] as $task)
                            <p class="text-dark">
                                <i class="fa fa-check text-primary me-3"></i>
                                {{ $task[trans('app.task_fld')] }}
                            </p>
                            @endforeach

                        </div>
                    </div>
                </div>
            </div>
        </div>
    <!-- About End -->

    <!-- Service Start -->
        <div class="container-fluid service py-5">
            <div class="container py-5">
                <div class="text-center mx-auto pb-5 wow fadeInUp" data-wow-delay="0.2s" style="max-width: 800px;">
                    <h4 class="text-primary">{{ trans('app.members') }}</h4>
                </div>
                <div class="row g-4 justify-content-center {{ trans('app.txt') }}" dir="{{ trans('app.dir') }}">
                    @foreach ($members as $member)
                    <div class="col-md-12 col-lg-12 col-xl-4 wow fadeInUp" data-wow-delay="0.2s">
                        <div class="service-item">
                            <div class="service-content p-4">
                                <div class="service-content-inner">
                                    <a href="javascript:;" class="d-inline-block h4">
                                        <img src="/public/logos/{{ $member->logo }}" class="img-fluid rounded-top" alt="" width="60" height="60">
                                        &nbsp;
                                        {{ $member[trans('app.member_val')] }}
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                <br><br>
                <div  dir="rtl" align="center" class="pagination flat rounded rounded-flat" style="display: flex;justify-content: center;">
                    {{ $members->links("pagination::bootstrap-5") }}
                </div>
            </div>
        </div>
    <!-- Service End -->

@endsection
