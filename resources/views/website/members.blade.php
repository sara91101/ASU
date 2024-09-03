@extends("website.menu")

@section("content")

    <!-- Header Start -->
        <div class="container-fluid bg-breadcrumb">
            <div class="container text-center py-5" style="max-width: 900px;">
                <h4 class="text-white display-4 mb-4 wow fadeInDown" data-wow-delay="0.1s">
                    {{ trans('app.members') }}
                </h4>
                <a href="/membership" class="btn btn-light text-primary text-center">{{ trans('app.subscribe') }}</a>
            </div>
        </div>
    <!-- Header End -->

    <!-- Service Start -->
        <div class="container-fluid service py-5">
            <div class="container py-5">
                {{--  <div class="text-center mx-auto pb-5 wow fadeInUp" data-wow-delay="0.2s" style="max-width: 800px;">
                    <h4 class="text-primary">{{ trans('app.members') }}</h4>
                </div>  --}}
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
