@extends("manage.menu")

@section('content')

<div class="row">
    <div class="col-lg-12">
        <div class="card custom-card">
            <div class="card-header justify-content-between">
                <div class="card-title">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb breadcrumb-style1 mb-0">
                            <li class="breadcrumb-item"><a href="javascript:void(0);">التقارير</a></li>
                            <li class="breadcrumb-item active" aria-current="page"> تقرير الإستفسارات بالتصنيف</li>
                        </ol>
                    </nav>
                </div>

                <div class="d-flex flex-wrap gap-2">
                    {{--  <div class="dropdown">
                        <a href="javascript:void(0);" class="btn btn-primary btn-sm btn-wave waves-effect waves-light" data-bs-toggle="dropdown" aria-expanded="false">
                            الخيارات<i class="ri-arrow-down-s-line align-middle ms-1 d-inline-block"></i>
                        </a>
                        <ul class="dropdown-menu" role="menu">
                            {{--  <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#search" data-whatever="@fat">بحث</a></li>
                            <li><a class="dropdown-item" href="javascript:;" data-bs-toggle="modal" data-bs-target="#add" data-whatever="@fat">إضافة</a></li>
                        </ul>
                    </div>  --}}
                </div>
            </div>

            <div class="card-body">
                @if(count($types) > 0)
                    <div class="table-responsive">
                        <table class="table table-responsive-lg">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>التصنيف</th>
                                    <th>عدد الإستفسارات</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $i=1; @endphp
                                @foreach ($types as $type)
                                <tr>
                                    <td>{{ $i }}</td>
                                    <td>{{ $type->ar_name }}</td>
                                    <td>{{ count($type["universityService"]) }}</td>
                                </tr>
                                @php $i++; @endphp
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <br><br>
                @else
                <div class="alert alert-primary">
                    <strong>لا توجد بيانات</strong>
                </div>
                @endif
            </div>

            <div class="card-footer">
                <div  dir="rtl" align="center" class="pagination flat rounded rounded-flat" style="display: flex;justify-content: center;">
                    {{ $types->links("pagination::bootstrap-5") }}
                </div>
            </div>
        </div>
    </div>
</div>


@endsection
