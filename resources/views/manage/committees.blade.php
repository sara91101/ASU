@extends("manage.menu")

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card custom-card">
            <div class="card-header justify-content-between">
                <div class="card-title">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb breadcrumb-style1 mb-0">
                            <li class="breadcrumb-item"><a href="javascript:void(0);">اللجان</a></li>
                            <li class="breadcrumb-item active" aria-current="page"> عرض</li>
                        </ol>
                    </nav>
                </div>

                <div class="d-flex flex-wrap gap-2">
                    <div class="dropdown">
                        <a href="javascript:void(0);" class="btn btn-primary btn-sm btn-wave waves-effect waves-light" data-bs-toggle="dropdown" aria-expanded="false">
                            الخيارات<i class="ri-arrow-down-s-line align-middle ms-1 d-inline-block"></i>
                        </a>
                        <ul class="dropdown-menu" role="menu">
                            {{--  <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#search" data-whatever="@fat">بحث</a></li>  --}}
                            <li><a class="dropdown-item" href="/addCommittee">إضافة</a></li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="card-body">
                @if(count($committees) > 0)
                    <div class="table-responsive">
                        <table class="table table-responsive-lg">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>اللجنة بالعربية</th>
                                    <th>اللجنة بالإنجليزية</th>
                                    <th>العمليات</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $i=1; @endphp
                                @foreach ($committees as $committee)
                                <tr>
                                    <th>{{ $i }}</th>
                                    <td>{{ $committee->ar_name}}</td>
                                    <td>{{ $committee->en_name}}</td>
                                    <td>
                                        <a href="/showCommittee/{{ $committee->id }}" class="btn btn-sm btn-info"><i class="la la-eye"></i></a>
                                        <a href="/editCommittee/{{ $committee->id }}" class="btn btn-sm btn-primary"><i class="la la-pencil"></i></a>
                                        <a onclick="destroy('destroyCommittee',{{ $committee->id }})" href="javascript:void(0);" class="btn btn-sm btn-danger"><i class="la la-trash-o"></i></a>
                                    </td>
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
                    {{ $committees->links("pagination::bootstrap-5") }}
                </div>
            </div>
        </div>
    </div>
</div>


@endsection
