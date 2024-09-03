@extends("manage.menu")

@section('content')

<script>
    function editUnit(id)
    {
        var idd = "idd"+id;
        var ar = "ar_unit"+id;
        var en = "en_unit"+id;
        //var type = document.getElementById("Unit_type"+id).innerHTML;

        var drop = document.getElementById("types");

        document.getElementById("edit_id_Unit").value = document.getElementById(idd).innerHTML;
        document.getElementById("Unit_ar").value = document.getElementById(ar).innerHTML;
        document.getElementById("Unit_details").value = document.getElementById(en).innerHTML;

        $("#edit").modal('show');
    }
</script>

<div class="modal fade" id="add">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-center">إضافة وحدة</h5>
            </div>

            <form method="POST" action="/units">
                @csrf
                <div class="modal-body">
                    <div class="basic-form">
                        <div class="form-group">
                            <label  class="form-label">الوحدة </label>
                            <textarea required name="ar_unit" class="form-control"></textarea><br><br>
                        </div>
                        <div class="form-group">
                            <label  class="form-label">التفاصيل </label>
                            <textarea required name="ar_details" class="form-control"></textarea><br><br>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">إلغاء</button>
                    <input type="submit" value="حفظ" class="btn btn-primary">
                </div>
            </form>
        </div>
    </div>
</div>


<div class="modal fade" id="edit">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-center">تعديل الوحدة</h5>
            </div>

            <form method="POST" action="/updateUnit" enctype="multipart/form-data">
                @csrf
                <input type="hidden" id="edit_id_Unit" name="unit_id">
                <div class="modal-body">
                    <div class="basic-form">
                        <div class="form-group">
                            <label  class="form-label"> الوحدة </label>
                            <textarea required id="Unit_ar" name="ar_unit" class="form-control"></textarea><br><br>

                            {{--  <input type="text" id="edit_Unit_ar" name="Unit_ar" class="form-control input-default "><br><br>  --}}
                        </div>
                        <div class="form-group">
                            <label  class="form-label">التفاصيل </label>
                            <textarea required id="Unit_details" name="ar_details" class="form-control"></textarea><br><br>

                            {{--  <input type="text" id="edit_Unit_en" name="Unit_en" class="form-control input-default "><br><br>  --}}
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">إلغاء</button>
                    <input type="submit" value="تعديل" class="btn btn-primary">
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
                            <li class="breadcrumb-item"><a href="javascript:void(0);">الوحدات</a></li>
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
                            <li><a class="dropdown-item" href="javascript:;" data-bs-toggle="modal" data-bs-target="#add" data-whatever="@fat">إضافة</a></li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="card-body">
                @if(count($units) > 0)
                    <div class="table-responsive">
                        <table class="table table-responsive-lg">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>الوحدة </th>
                                    <th>التفاصيل </th>
                                    <th>العمليات</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $i=1; @endphp
                                @foreach ($units as $j)
                                <span id="idd{{ $j->id }}" style="display: none;">{{ $j->id }}</span>
                                <tr>
                                    <th>{{ $i }}</th>
                                    <td id="ar_unit{{ $j->id }}">{{ $j->ar_unit }}</td>
                                    <td id="en_unit{{ $j->id }}">{{ $j->ar_details }}</td>
                                    <td>
                                        <a href="javascript:void(0);" class="btn btn-sm btn-primary" onclick="editUnit({{ $j->id }})"><i class="la la-pencil"></i></a>
                                        <a onclick="destroy('destroyUnit',{{ $j->id }})" href="javascript:void(0);" class="btn btn-sm btn-danger"><i class="la la-trash-o"></i></a>
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
                    {{ $units->links("pagination::bootstrap-5") }}
                </div>
            </div>
        </div>
    </div>
</div>


@endsection
