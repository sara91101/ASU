@extends("website.menu")

@section("content")
    <!-- Header Start -->
    <div class="container-fluid bg-breadcrumb">
        <div class="container text-center py-5" style="max-width: 900px;">
            <h4 class="text-white display-4 mb-4 wow fadeInDown" data-wow-delay="0.1s">
                {{ $dsapceContent[trans('app.link_val')] }}
            </h4>
        </div>
    </div>
    <!-- Header end -->

    <!-- Feature Start -->
        <div class="container-fluid feature bg-light py-5 justi-content">
            <div class="container py-5">
                {{--  <div class="text-center mx-auto pb-5 wow fadeInUp" data-wow-delay="0.2s" style="max-width: 800px;">
                    <h4 class="text-primary text-center">{{ trans('app.committe') }}</h4>
                </div>  --}}
                <div class="row g-4" dir="{{ trans('app.dir') }}">
                    @foreach ($dsapceContent["dspaceLinkContent"] as $link)
                        <div class="col-md-12 col-lg-12 col-xl-6 wow fadeInUp" data-wow-delay="0.2s">
                            <div class="feature-item p-4 pt-0" align="center">
                                <div class="feature-icon p-4 mb-4">
                                    <i class="fa fa-book fa-3x"></i>
                                </div>
                                <h4 class="mb-4">{{ $link[trans('app.dspace_val')] }}</h4>
                                <a class="btn btn-primary rounded-pill py-2 px-4" href="/dspace/{{ $link->content_path }}" target="blank">{{ trans('app.view') }}</a>
                            </div>
                        </div>
                    @endforeach

                </div>
            </div>
        </div>
    <!-- Feature End -->


@endsection
