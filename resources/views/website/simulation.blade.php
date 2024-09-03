@extends("website.menu")

@section("content")
    <script>
        function showMore(modalId)
        {
            $("#"+modalId).modal('show');
        }
    </script>
    <div class="modal fade" id="goals">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header justify-content-center" align="center">
                    <h5 class="modal-title justify-content-center">{{ trans("app.goals") }}</h5>
                </div>
                <div class="modal-body {{ trans('app.txt') }}" dir="{{ trans('app.dir') }}">
                    <ul>
                        @foreach ($goals as $goal)
                        <p class="text-dark">
                            <i class="fa fa-check text-primary me-3"></i>
                            {{ $goal[trans('app.home_fld')] }}
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

    <div class="modal fade justi-content" id="mission">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header justify-content-center" align="center">
                    <h5 class="modal-title justify-content-center text-center">{{ trans("app.mission") }}</h5>
                </div>
                <div class="modal-body {{ trans('app.txt') }}" dir="{{ trans('app.dir') }}">
                    {{ $mission[trans('app.home_fld')] }}
                </div>
                <div class="modal-footer justify-content-center" align="center">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">{{ trans('app.cancel') }}</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade justi-content" id="values">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header justify-content-center" align="center">
                    <h5 class="modal-title justify-content-center">{{ trans("app.values") }}</h5>
                </div>
                <div class="modal-body {{ trans('app.txt') }}" dir="{{ trans('app.dir') }}">
                        @foreach ($values as $value)
                        <p>
                                <i class="fa fa-check text-primary me-3"></i>
                                {{ $value[trans('app.home_fld')] }}
                        </p>
                        @endforeach
                </div>
                <div class="modal-footer justify-content-center" align="center">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">{{ trans('app.cancel') }}</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Header Start -->
        <div class="container-fluid bg-breadcrumb">
            <div class="container text-center py-5" style="max-width: 900px;">
                <h4 class="text-white display-4 mb-4 wow fadeInDown" data-wow-delay="0.1s">{{ trans('app.computer') }}</h4>
            </div>
        </div>
    <!-- Header End -->

    <!-- Feature Start -->
    <div class="container-fluid feature bg-light py-5 justi-content">
        <div class="container py-5">
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
    <div class="container-fluid bg-light about pb-5 {{ trans('app.txt') }} justi-content" dir="{{ trans('app.dir') }}">
        <div class="container pb-5">
            <div class="row g-5">
                <div class="col-xl-6 wow fadeInLeft" data-wow-delay="0.2s">
                    <div class="about-item-content bg-white rounded p-5 h-100">
                        <h1 class="display-4 mb-4">{{ trans('app.about_intro') }}</h1><br>
                        <p class="justi-content">{{ $about[trans('app.home_fld')] }}</p>
                    </div>
                </div>

                <div class="col-xl-6 wow fadeInRight" data-wow-delay="0.2s">
                    <div class="bg-white rounded p-5 h-100">
                        <div class="row g-4 justify-content-center">
                            <h1 class="display-4 mb-4">{{ trans('app.goals') }}</h1>
                            @foreach ($goals->take(3) as $goal)
                                <span>
                                    <i class="fa fa-check text-primary me-3"></i>
                                    {{ $goal[trans("app.home_fld")] }}
                                </span>
                            @endforeach
                        </div><br><br>
                        <div align="center">
                            <label class="btn btn-primary rounded-pill py-3 px-5" onclick="showMore('goals')">
                                {{ trans('app.more') }}
                            </label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- About End -->
@endsection
