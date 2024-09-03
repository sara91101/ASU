@extends("manage.menu")

@section('content')

<script>
    function edithome(id)
    {
        var idd = "idd"+id;
        var ar = "ar_name"+id;
        var en = "en_name"+id;
        var type = document.getElementById("uni_type_id"+id).innerHTML;
        var drop = document.getElementById("types");

        document.getElementById("idd").value = document.getElementById(idd).innerHTML;
        document.getElementById("ar_name").value = document.getElementById(ar).innerHTML;
        document.getElementById("en_name").value = document.getElementById(en).innerHTML;

        for(let k =0; k < drop.length; k++)
        {
            if(drop[k].value == type) {drop[k].selected = true;}
            else {drop[k].selected = false;}
        }
        $("#edit").modal('show');
    }
</script>
<div class="modal fade" id="search" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header align-self-center">
            <h3 align="center" class="modal-title"><b>البحث عن بيان</b></h3>
        </div>
        <div class="modal-body font-weight-bold" dir="rtl">
          <form method="post" action="/website">
            @csrf
            <div class="form-group">
                <label  class="form-label"> النوع</label>
                <select name="home" class="form-control" id="types">
                    @foreach ($types as $type)
                        <option value="{{ $type->home_type }}">{{ $type->home_type }}</option>
                    @endforeach
                </select><br><br>
            </div>
        </div>
        <div class="modal-footer justify-content-between" align="center" dir="rtl">
          <input type="submit" value="بحث" class="btn btn-primary">
          <a href="{{ url('/website') }}" class="btn btn-primary">إلغاء البحث</a>
        </div>

    </form>
      </div>
    </div>
</div>

<div class="modal fade" id="add">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-center">إضافة عضو</h5>
            </div>

            <form method="POST" action="/universities"  enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="basic-form">
                        <div class="form-group">
                            <label  class="form-label">العضو بالعربية</label>
                            <input type="text" required name="ar_name" class="form-control"><br><br>
                        </div>
                        <div class="form-group">
                            <label  class="form-label">العضو بالإنجليزية</label>
                            <input type="text" required name="en_name" class="form-control"><br><br>
                        </div>
                        <div class="form-group">
                            <label  class="form-label"> التصنيف</label>
                            <select name="type_id" class="form-control">
                                @foreach ($types as $type)
                                    <option value="{{ $type->id }}">{{ $type->type_ar }}</option>
                                @endforeach
                            </select><br><br>
                        </div>
                        <div class="form-group">
                            <label class="form-label"> الشعار </label>
                            <input type="file" class="single-fileupload" name="logo" data-max-file-size="5MB"  accept="image/png, image/jpeg, image/jpg, image/gif"><br><br>
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
                <h5 class="modal-title text-center">تعديل العضو</h5>
            </div>

            <form method="POST" action="/updateUniversity"  enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="basic-form">
                        <div class="form-group">
                            <label  class="form-label">العضو بالعربية</label>
                            <input type="hidden"  id="idd" name="idd">
                            <input type="text" required id="ar_name" name="ar_name" class="form-control"><br><br>
                        </div>
                        <div class="form-group">
                            <label  class="form-label">العضو بالإنجليزية</label>
                            <input type="text" required id="en_name" name="en_name" class="form-control"><br><br>
                        </div>
                        <div class="form-group">
                            <label  class="form-label"> التصنيف</label>
                            <select name="type_id" class="form-control" id="types">
                                @foreach ($types as $type)
                                    <option value="{{ $type->id }}">{{ $type->type_ar }}</option>
                                @endforeach
                            </select><br><br>
                        </div>
                        <div class="form-group">
                            <label class="form-label"> الشعار </label>
                            <input type="file" class="single-fileupload" name="logo" data-max-file-size="5MB"  accept="image/png, image/jpeg, image/jpg, image/gif"><br><br>
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

<div class="row">
    <div class="col-lg-12">
        <div class="card custom-card">
            <div class="card-header justify-content-between">
                <div class="card-title">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb breadcrumb-style1 mb-0">
                            <li class="breadcrumb-item"><a href="javascript:void(0);">الأعضاء</a></li>
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
                            <li><a class="dropdown-item" href="javascript:;" data-bs-toggle="modal" data-bs-target="#add" data-whatever="@fat">إضافة</a></li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="card-body">
                @if(count($universities) > 0)
                    <div class="table-responsive">
                        <table class="table table-responsive-lg">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th></th>
                                    <th>التصنيف</th>
                                    <th>الإسم بالعربية</th>
                                    <th>الإسم بالإنجليزية</th>
                                    <th>العمليات</th>
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
                                    <td id="en_name{{ $university->id }}">{{ $university->en_name }}</td>
                                    <td>
                                        <a href="/editUniversity/{{ $university->id }}" class="btn btn-sm btn-primary"><i class="la la-pencil"></i></a>
                                        <a onclick="destroy('destroyUniversity',{{ $university->id }})" href="javascript:void(0);" class="btn btn-sm btn-danger"><i class="la la-trash-o"></i></a>
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
                    {{ $universities->links("pagination::bootstrap-5") }}
                </div>
            </div>
        </div>
    </div>
</div>


@endsection
