@extends("manage.menu")

@section('content')
    <div class="modal fade" id="search" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header align-self-center">
                <h3 align="center" class="modal-title"><b>البحث عن فريق العمل</b></h3>
            </div>
            <div class="modal-body font-weight-bold" dir="rtl">
            <form method="post" action="/team">
                @csrf
                <div class="form-group">
                <label for="recipient-name" class="col-form-label">الإسم بالعربية / بالإنجليزية / الهاتف / البريد الإلكتروني / العنوان</label>
                <input type="text" name="member" class="form-control"><br><br>
                </div>
            </div>
            <div class="modal-footer justify-content-between" align="center" dir="rtl">
            <input type="submit" value="بحث" class="btn btn-primary">
            <a href="{{ url('/allTeam') }}" class="btn btn-primary">إلغاء البحث</a>
            </div>

        </form>
        </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="card custom-card">
                <div class="card-header justify-content-between">
                    <div class="card-title">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb breadcrumb-style1 mb-0">
                                <li class="breadcrumb-item"><a href="javascript:void(0);">فريق العمل</a></li>
                                <li class="breadcrumb-item active" aria-current="page">عرض</li>
                            </ol>
                        </nav>
                    </div>
                    <div class="d-flex flex-wrap gap-2">
                        <div class="dropdown">
                            <a href="javascript:void(0);" class="btn btn-primary btn-sm btn-wave waves-effect waves-light" data-bs-toggle="dropdown" aria-expanded="false">
                                الخيارات<i class="ri-arrow-down-s-line align-middle ms-1 d-inline-block"></i>
                            </a>
                            <ul class="dropdown-menu" role="menu">
                                <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#search" data-whatever="@fat">بحث</a></li>
                                <li><a class="dropdown-item" href="/createTeam">إضافة</a></li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    @if(count($teams) > 0)
                        <div class="table-responsive">
                            <table class="table table-responsive-lg">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th></th>
                                        <th>الإسم بالعربية</th>
                                        <th>الإسم بالإنجليزية</th>
                                        <th>الهاتف</th>
                                        <th>البريد الإلكتروني</th>
                                        <th>المسمى الوظيفي</th>
                                        <th>العمليات</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $i=1; @endphp
                                    @foreach ($teams as $j)
                                    <tr>
                                        <td>{{ $i }}</td>
                                        <td>
                                            <span class="avatar avatar-xs me-2 avatar-rounded">
                                                <img src="/public/teamImages/{{ $j->photo }}" alt="img">
                                            </span>
                                        </td>
                                        <td>{{ $j->name_ar }}</td>
                                        <td>{{ $j->name_en }}</td>
                                        <td>{{ $j->phone }}</td>
                                        <td>{{ $j->email }}</td>
                                        <td>{{ $j->Job }}</td>
                                        <td>
                                            <a href="/editTeam/{{ $j->id }}" class="btn btn-sm btn-primary"><i class="la la-pencil"></i></a>
                                            <a onclick="destroy('destroyTeam',{{ $j->id }})" href="javascript:void(0);" class="btn btn-sm btn-danger"><i class="la la-trash-o"></i></a>
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
                        <strong>لا توجد فريق العمل</strong>
                    </div>
                    @endif
                </div>

                <div class="card-footer">
                    <div  dir="rtl" align="center" class="pagination flat rounded rounded-flat" style="display: flex;justify-content: center;">
                        {{ $teams->links("pagination::bootstrap-5") }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
