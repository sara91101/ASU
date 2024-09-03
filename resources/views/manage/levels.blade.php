@extends("manage.menu")

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card custom-card">
            <div class="card-header justify-content-between">
                <div class="card-title">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb breadcrumb-style1 mb-0">
                            <li class="breadcrumb-item"><a href="javascript:void(0);">الإعدادات</a></li>
                            <li class="breadcrumb-item active" aria-current="page"> الصلاحيات</li>
                        </ol>
                    </nav>
                </div>
                <div class="d-flex flex-wrap gap-2">
                    <div class="dropdown">
                        <a href="/createLevel" class="btn btn-primary btn-sm btn-wave waves-effect waves-light">
                            إضافة<i class="bx bx-plus align-middle ms-1 d-inline-block"></i>
                        </a>
                    </div>
                </div>
            </div>

            <div class="card-body">
                @if(count($levels) > 0)
                    <div class="table-responsive">
                        <table class="table table-responsive-lg">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th> الصلاجية</th>
                                    <th>العمليات</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $i=1; @endphp
                                @foreach ($levels as $j)
                                <tr>
                                    <th>{{ $i }}</th>
                                    <td>{{ $j->level }}</td>
                                    <td>
                                        <a href="/editLevel/{{ $j->id }}" class="btn btn-sm btn-primary"><i class="la la-pencil"></i></a>
                                        <a onclick="destroy('destroyLevel',{{ $j->id }})" href="javascript:void(0);" class="btn btn-sm btn-danger"><i class="la la-trash-o"></i></a>
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
                    <strong>لا توجد  صلاحيات</strong>
                </div>
                @endif
            </div>

            <div class="card-footer">
                <div  dir="rtl" align="center" class="pagination flat rounded rounded-flat" style="display: flex;justify-content: center;">
                    {{ $levels->links("pagination::bootstrap-5") }}
                </div>
            </div>
        </div>
    </div>
</div>


@endsection
