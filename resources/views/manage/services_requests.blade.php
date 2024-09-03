@extends("manage.menu")

@section('content')
    <div class="modal fade" id="search" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header align-self-center">
                <h3 align="center" class="modal-title"><b>البحث عن خدمة</b></h3>
            </div>
            <div class="modal-body font-weight-bold" dir="rtl">
            <form method="post" action="/requests">
                @csrf
                <div class="form-group">
                <label for="recipient-name" class="col-form-label"> الخدمة - الوصف بالعربية / بالإنجليزية</label>
                <input type="text" name="service" class="form-control"><br><br>
                </div>
                <div class="form-group">
                    <label class="col-form-label"> الحالة</label>
                    <select name="status" class="form-control">
                        <option value=0>-</option>
                        <option value=1>غير مُفعَل</option>
                        <option value=2>مُفعَل</option>
                    </select>
                </div>

            </div>
            <div class="modal-footer justify-content-between" align="center" dir="rtl">
            <input type="submit" value="بحث" class="btn btn-primary">
            <a href="{{ url('/allrequests') }}" class="btn btn-primary">إلغاء البحث</a>
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
                                <li class="breadcrumb-item"><a href="javascript:void(0);">طلبات الخدمات</a></li>
                                <li class="breadcrumb-item active" aria-current="page">عرض</li>
                            </ol>
                        </nav>
                    </div>
                    {{--  <div class="d-flex flex-wrap gap-2">
                        <div class="dropdown">
                            <a href="javascript:void(0);" class="btn btn-primary btn-sm btn-wave waves-effect waves-light" data-bs-toggle="dropdown" aria-expanded="false">
                                الخيارات<i class="ri-arrow-down-s-line align-middle ms-1 d-inline-block"></i>
                            </a>
                            <ul class="dropdown-menu" role="menu">
                                <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#search" data-whatever="@fat">بحث</a></li>
                                <li><a class="dropdown-item" href="/createService">إضافة</a></li>
                            </ul>
                        </div>
                    </div>  --}}
                </div>

                <div class="card-body">
                    @if(count($requests) > 0)
                        <div class="table-responsive">
                            <table class="table table-responsive-lg">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>العضو</th>
                                        <th>الخدمة</th>
                                        <th>السعر</th>
                                        <th>تاريخ الطلب</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $i=1; @endphp
                                    @foreach ($requests as $j)
                                    <tr>
                                        <th>{{ $i }}</th>
                                        <td>{{ $j->ar_name }}</td>
                                        <td>
                                            @if(!is_null($j->service_id))
                                                {{ $j->service_ar }}
                                            @else
                                                {{ $j->else }}
                                            @endif
                                        </td>
                                        <td>{{ $j->price }}</td>
                                        <td>{{ $j->created_at }}</td>
                                    </tr>
                                    @php $i++; @endphp
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <br><br>
                    @else
                    <div class="alert alert-primary">
                        <strong>لا توجد طلبات</strong>
                    </div>
                    @endif
                </div>

                <div class="card-footer">
                    <div  dir="rtl" align="center" class="pagination flat rounded rounded-flat" style="display: flex;justify-content: center;">
                        {{ $requests->links("pagination::bootstrap-5") }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
