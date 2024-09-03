@extends("website.menu")

@section("content")

    <head>
        <style>
            .accordion {
                .card-header{
                    margin-bottom: 8px;
                }
                .accordion-title
                {
                   // position: relative;
                    display: block;
                    padding:8px 0 8px 50px;
                    background: #015fc9;
                    border-radius: 8px;
                    overflow: hidden;
                    text-decoration: none;
                    color: #fff;
                    font-size: 16px;
                    font-weight: 700;
                    width: 100%;
                    //text-align: left;
                    transition: all .4s ease-in-out;
                }
                .accordion-body{
                    padding: 40px 55px;
                }
            }
        </style>

        <script>
            function requestService()
            {
                $("#ServiceRequest").modal("show");
            }
        </script>
    </head>



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
                            <select class="form-control" dir="{{ trans('app.dir') }}" name="service_id" onchange="showElse(this)">
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

    <div class="modal fade" id="change_password" >
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header text-center justify-content-center" align="center">
                    <h5 class="modal-title text-center" align="center">{{ trans('app.change_password') }}</h5>
                </div>

                <form method="POST" action="/university_change_password">
                    @csrf
                    <div class="modal-body" dir="{{ trans('app.dir') }}">
                        <div class="basic-form">
                            <div class="form-group">
                                <label  class="form-label">{{ trans('app.last_password') }}</label>
                                <input type="password" name="last_password" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label  class="form-label">{{ trans('app.new_password') }}</label>
                                <input type="password" name="new_password" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label  class="form-label">{{ trans('app.repeat_password') }}</label>
                                <input type="password" class="form-control" required>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-center">
                        <input type="submit" value="{{ trans('app.change_password') }}" class="btn btn-primary">
                    </div>
                </form>
            </div>
        </div>
    </div>

    <br><br>
    <div class="container-fluid bg-light about {{ trans('app.txt') }} justi-content" dir="{{ trans('app.dir-revise') }}">
        <div class="container pb-5">
            <div class="row g-5">
                <div class="col-xl-7 wow fadeInRight" data-wow-delay="0.2s">
                        <div class="accordion card border-0" dir="{{ trans('app.dir') }}">
                            <div class="card-header p-0 border-0">
                                <label class="btn btn-link accordion-title {{ trans('app.txt') }}" style="text-align: {{ trans('app.align') }} !important;">
                                    &nbsp;<i class="fa fa-university"></i>&nbsp;
                                    {{ trans('app.personal') }}


                                    <a href="/editMembership" class="btn btn-sm btn-light text-primary {{ trans('app.start_end') }}" align="{{ trans('app.align') }}">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                </label>
                            </div>
                            <div class="card-body accordion-body row">
                                <p class="text-dark col-xl-12">
                                    <i class="fa fa-dot-circle text-primary me-3"></i>
                                    <b>{{ trans('app.arabic_name') }}</b> : {{ $university->ar_name }}
                                </p>
                                <p class="text-dark col-xl-12">
                                    <i class="fa fa-dot-circle text-primary me-3"></i>
                                    <b>{{ trans('app.english_name') }}</b> : {{ $university->en_name }}
                                </p>
                                <p class="text-dark col-xl-12">
                                    <i class="fa fa-dot-circle text-primary me-3"></i>
                                    <b>{{ trans('app.birth') }}</b> : {{ $university->datee }}
                                </p>
                                <p class="text-dark col-xl-12">
                                    <i class="fa fa-dot-circle text-primary me-3"></i>
                                    <b>{{ trans('app.state') }}</b> : {{ $university[trans('app.state_fld')] }}
                                </p>
                                <p class="text-dark col-xl-12">
                                    <i class="fa fa-dot-circle text-primary me-3"></i>
                                    <b>{{ trans('app.town') }}</b> : {{ $university[trans('app.town_fld')] }}
                                </p>
                                <p class="text-dark col-xl-12">
                                    <i class="fa fa-dot-circle text-primary me-3"></i>
                                    <b>{{ trans('app.website') }}</b> : {{ $university->website }}
                                </p>
                                <p class="text-dark col-xl-12">
                                    <i class="fa fa-dot-circle text-primary me-3"></i>
                                    <b>{{ trans('app.other_details') }}</b> : {{ $university->other }}
                                </p>
                            </div>
                        </div> <br>


                        <div class="accordion card border-0" dir="{{ trans('app.dir') }}">
                            <div class="card-header p-0 border-0">
                                <label class="btn btn-link accordion-title {{ trans('app.txt') }}" style="text-align: {{ trans('app.align') }} !important;">
                                    &nbsp;<i class="fa fa-user"></i>&nbsp;
                                    {{ trans('app.manager') }}
                                </label>
                            </div>
                            <div class="card-body accordion-body row">
                                <p class="text-dark col-xl-12">
                                    <i class="fa fa-dot-circle text-primary me-3"></i>
                                    <b>{{ trans('app.name') }}</b> : {{ $university->manager_name }}
                                </p>
                                <p class="text-dark col-xl-12">
                                    <i class="fa fa-dot-circle text-primary me-3"></i>
                                    <b>{{ trans('app.address') }}</b> : {{ $university->manager_address }}
                                </p>
                                <p class="text-dark col-xl-12">
                                    <i class="fa fa-dot-circle text-primary me-3"></i>
                                    <b>{{ trans('app.phone') }}</b> : {{ $university->manager_phone }}
                                </p>
                                <p class="text-dark col-xl-12">
                                    <i class="fa fa-dot-circle text-primary me-3"></i>
                                    <b>{{ trans('app.our_email') }}</b> : {{ $university->manager_email }}
                                </p>
                            </div>
                        </div> <br>


                        <div class="accordion card border-0" dir="{{ trans('app.dir') }}">
                            <div class="card-header p-0 border-0">
                                <label class="btn btn-link accordion-title {{ trans('app.txt') }}" style="text-align: {{ trans('app.align') }} !important;">
                                    &nbsp;<i class="fa fa-user"></i>&nbsp;
                                    {{ trans('app.sub_manager') }}
                                </label>
                            </div>
                            <div class="card-body accordion-body row">
                                <p class="text-dark col-xl-12">
                                    <i class="fa fa-dot-circle text-primary me-3"></i>
                                    <b>{{ trans('app.name') }}</b> : {{ $university->sub_manager_name }}
                                </p>
                                <p class="text-dark col-xl-12">
                                    <i class="fa fa-dot-circle text-primary me-3"></i>
                                    <b>{{ trans('app.address') }}</b> : {{ $university->sub_manager_address }}
                                </p>
                                <p class="text-dark col-xl-12">
                                    <i class="fa fa-dot-circle text-primary me-3"></i>
                                    <b>{{ trans('app.phone') }}</b> : {{ $university->sub_manager_phone }}
                                </p>
                                <p class="text-dark col-xl-12">
                                    <i class="fa fa-dot-circle text-primary me-3"></i>
                                    <b>{{ trans('app.our_email') }}</b> : {{ $university->sub_manager_email }}
                                </p>
                            </div>
                        </div> <br>


                        <div class="accordion card border-0" dir="{{ trans('app.dir') }}">
                            <div class="card-header p-0 border-0">
                                <label class="btn btn-link accordion-title {{ trans('app.txt') }}" style="text-align: {{ trans('app.align') }} !important;">
                                    &nbsp;<i class="fa fa-user"></i>&nbsp;
                                    {{ trans('app.execution_manager') }}
                                </label>
                            </div>
                            <div class="card-body accordion-body row">
                                <p class="text-dark col-xl-12">
                                    <i class="fa fa-dot-circle text-primary me-3"></i>
                                    <b>{{ trans('app.name') }}</b> : {{ $university->execution_manager_name }}
                                </p>
                                <p class="text-dark col-xl-12">
                                    <i class="fa fa-dot-circle text-primary me-3"></i>
                                    <b>{{ trans('app.address') }}</b> : {{ $university->execution_manager_address }}
                                </p>
                                <p class="text-dark col-xl-12">
                                    <i class="fa fa-dot-circle text-primary me-3"></i>
                                    <b>{{ trans('app.phone') }}</b> : {{ $university->execution_manager_phone }}
                                </p>
                                <p class="text-dark col-xl-12">
                                    <i class="fa fa-dot-circle text-primary me-3"></i>
                                    <b>{{ trans('app.our_email') }}</b> : {{ $university->execution_manager_email }}
                                </p>
                            </div>
                        </div> <br>
                </div>

                <div class="col-xl-5 wow fadeInLeft" data-wow-delay="0.2s">
                    <div class="bg-white rounded p-5">

                        <div class="row g-4">
                            <div class="col-12">
                                <div class="rounded" align="center">
                                    <img src="/public/logos/{{ $university->logo }}" class="img-fluid rounded w-50" alt="">
                                </div>
                            </div>
                                <div class="col-12 text-left" dir="ltr">
                                    <div class="counter-item bg-light rounded p-3">
                                        <h6 class="mb-0 text-primary">
                                            <i class="fa fa-envelope"></i>&nbsp;&nbsp;
                                            {{ $university->email }}
                                        </h6><br>
                                        <h6 class="mb-0 text-primary">
                                            <i class="fa fa-phone"></i>&nbsp;&nbsp;
                                            {{ $university->phone }}
                                        </h6><br>
                                        <h6 class="mb-0 text-primary">
                                            <i class="fa fa-map-marker"></i>&nbsp;&nbsp;
                                            {{ $university->address }}
                                        </h6>
                                    </div><br><br>


                                    <div class="counter-item bg-light rounded p-1" align="{{ trans('app.align') }}" dir="{{ trans('app.dir') }}">
                                        <h6 onclick="requestService()" class="btn btn-sm btn-primary text-white {{ trans('app.txt') }} text-primary">
                                            <i class="fa fa-plus"></i>&nbsp;&nbsp;&nbsp;
                                            {{ trans('app.services') }}
                                        </h6>

                                        <ol align="{{ trans('app.align') }}" dir="{{ trans('app.dir') }}">
                                            @foreach ($university["universityService"] as $service)
                                            <li class="mb-0 text-primary">
                                                @if(!is_null($service->service_id))
                                                    {{ $service[trans('app.service_val')] }}
                                                @else
                                                    {{ $service->else }}
                                                @endif
                                            </li>
                                            @endforeach
                                        </ol>

                                    </div><br><br>


                                    <div class="justify-content-between">
                                        <a href="/university-logout" class="btn btn-sm btn-danger float-start" align="left">
                                            {{ trans('app.logout') }}
                                        </a>
                                        <a href="javascript:;" data-bs-toggle="modal" data-bs-target="#change_password" data-whatever="@fat" class="btn btn-sm btn-dark float-end"  align="right">
                                            {{ trans('app.change_password') }}
                                        </a>
                                    </div>
                                </div><br><br>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



@endsection
