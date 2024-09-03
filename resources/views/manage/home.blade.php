@extends("manage.menu")

@section('content')
<script>
    let typesArray = [];
    let membersArray = [];

    @foreach($types as $type)
        typesArray.push("{{ $type->type_ar }}");
        membersArray.push({{ count($type->university) }});
    @endforeach

    @if(Session("NoAccess") > 0)
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script>
        toastr.options=
        {
            positionClass: "toast-center-center"
        }
        toastr.error("{!! Session::get('NoAccess') !!}","عٌذرا");
        sessionStorage.clear();
    </script>
@endif


</script>
    <div class="row">
        <div class="col-xl-3 col-xxl-3 col-sm-6">
            <div class="card custom-card card-bg-primary text-fixed-white">
                <div class="card-body p-0">
                    <div class="d-flex align-items-top p-4 flex-wrap">
                        <div class="me-3 lh-1">
                            <span class="avatar avatar-md avatar-rounded bg-white text-primary shadow-sm">
                                <i class="bx bx-menu fs-18"></i>
                            </span>
                        </div>
                        <div class="flex-fill">
                            <h5 class="fw-semibold mb-1 text-fixed-white">{{ $services }}</h5>
                            <p class="op-7 mb-0 fs-12">الخدمات</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-xxl-3 col-sm-6">
            <div class="card custom-card card-bg-primary text-fixed-white">
                <div class="card-body p-0">
                    <div class="d-flex align-items-top p-4 flex-wrap">
                        <div class="me-3 lh-1">
                            <span class="avatar avatar-md avatar-rounded bg-white text-primary shadow-sm">
                                <i class="bx bx-male-female fs-18"></i>
                            </span>
                        </div>
                        <div class="flex-fill">
                            <h5 class="fw-semibold mb-1 text-fixed-white">{{ $memebers }}</h5>
                            <p class="op-7 mb-0 fs-12"> الأعضاء</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-xxl-3 col-sm-6">
            <div class="card custom-card card-bg-primary text-fixed-white">
                <div class="card-body p-0">
                    <div class="d-flex align-items-top p-4 flex-wrap">
                        <div class="me-3 lh-1">
                            <span class="avatar avatar-md avatar-rounded bg-white text-primary shadow-sm">
                                <i class="bx bx-git-pull-request fs-18"></i>
                            </span>
                        </div>
                        <div class="flex-fill">
                            {{--  <h5 class="fw-semibold mb-1 text-fixed-white">{{ $demands }}</h5>  --}}
                            <p class="op-7 mb-0 fs-12">الطلبات</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-xxl-3 col-sm-6">
            <div class="card custom-card card-bg-primary text-fixed-white">
                <div class="card-body p-0">
                    <div class="d-flex align-items-top p-4 flex-wrap">
                        <div class="me-3 lh-1">
                            <span class="avatar avatar-md avatar-rounded bg-white text-primary shadow-sm">
                                <i class="la la-dollar fs-18"></i>
                            </span>
                        </div>
                        <div class="flex-fill">
                            {{--  <h5 class="fw-semibold mb-1 text-fixed-white">{{ number_format($earns,0) }} .س</h5>  --}}
                            <p class="op-7 mb-0 fs-12">الإيرادات</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-12 col-xxl-12 col-lg-12 col-sm-12">
            <div class="card custom-card">
                <div class="card-header">
                    <div class="card-title">
                        <h3>إحصائية الأعضاء بالتصنيف </h3>
                    </div>
                </div>
                <div class="card-body">
                    <div id="columns-distributed"></div>
                </div>
            </div>
        </div>

        {{--  <div class="col-xl-6 col-xxl-6 col-lg-12 col-sm-12">
            <div class="card custom-card">
                <div class="card-header">
                    <div class="card-title">
                        <h3>إحصائية الطلبات بالمدينة</h3>
                    </div>
                </div>
                <div class="card-body">
                    <div id="donut-simple"></div>
                </div>
            </div>
        </div>  --}}

        <div class="col-xl-12 col-xxl-12 col-lg-12 col-md-12 col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title"> الطلبات لحديثة</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-responsive-lg">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th></th>
                                    <th>التصنف</th>
                                    <th>الإسم بالعربية</th>
                                    {{--  <th>الإسم بالإنجليزي</th>  --}}
                                    {{--  <th>المليات</th>  --}}
                                </tr>
                            </thead>
                            <tbody>
                                @php $i=1; @endphp
                                @foreach ($universities as $university)
                                <span id="idd{{ $university->id }}" style="display: none;">{{ $university->id }}</span>
                                <span id="uni_type_id{{ $university->id }}" style="display: none;">{{ $university->type_id }}</span>
                                <tr>
                                    <th>{{ $i }}</th>
                                    <th>
                                        @if(!is_null($university->logo))
                                            <span class="avatar avatar-xs me-2 avatar-rounded">
                                                <img src="/public/logos/{{ $university->logo }}" alt="img">
                                            </span>
                                        @endif
                                    </th>
                                    <td>{{ $university->type_ar }}</td>
                                    <td id="ar_name{{ $university->id }}">{{ $university->ar_name }}</td>
                                    {{--  <td id="en_name{{ $university->id }}">{{ $university->en_name }}</td>  --}}
                                    {{--  <td>
                                        <a href="/editUniversity/{{ $university->id }}" class="btn btn-sm btn-primary"><i class="la la-pencil"></i></a>
                                        <a onclick="destroy('destroyUniversity',{{ $university->id }})" href="javascript:void(0);" class="btn btn-sm btn-danger"><i class="la la-trash-o"></i></a>
                                    </td>  --}}
                                </tr>
                                @php $i++; @endphp
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
