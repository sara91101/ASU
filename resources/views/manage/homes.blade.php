@extends("manage.menu")

@section('content')

<script>
    function edithome(id)
    {
        var idd = "idd"+id;
        var ar = "home_ar"+id;
        var en = "home_en"+id;
        //var type = document.getElementById("home_type"+id).innerHTML;

        var drop = document.getElementById("types");

        document.getElementById("edit_id_home").value = document.getElementById(idd).innerHTML;
        document.getElementById("edit_home_ar").value = document.getElementById(ar).innerHTML;
        document.getElementById("edit_home_en").value = document.getElementById(en).innerHTML;

        /*for(let k =0; k < drop.length; k++)
        {
            if(drop[k].value == type) {drop[k].selected = true;}
            else {drop[k].selected = false;}
        }*/
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
                <h5 class="modal-title text-center">إضافة بيان</h5>
            </div>

            <form method="POST" action="/newHome"  enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="basic-form">
                        <div class="form-group">
                            <label  class="form-label">البيان بالعربية</label>
                            <textarea required name="home_ar" class="form-control"></textarea><br><br>
                        </div>
                        <div class="form-group">
                            <label  class="form-label">البيان بالإنجليزية</label>
                            <textarea required name="home_en" class="form-control"></textarea><br><br>
                        </div>
                        <div class="form-group">
                            <label  class="form-label"> النوع</label>
                            <select name="home_type" class="form-control">
                                <option value="Slider">الشرائح المتحركة</option>
                                <option value="Goals">الأهداف</option>
                                <option value="Values">القيم</option>
                            </select><br><br>
                        </div>
                        <div class="form-group">
                            <label class="form-label"> صورة توضيحية</label>
                            <input type="file" class="single-fileupload" name="home_image" data-max-file-size="5MB"  accept="image/png, image/jpeg, image/jpg, image/gif"><br><br>
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
                <h5 class="modal-title text-center">تعديل البيان</h5>
            </div>

            <form method="POST" action="/updateHome" enctype="multipart/form-data">
                @csrf
                <input type="hidden" id="edit_id_home" name="home_id">
                <div class="modal-body">
                    <div class="basic-form">
                        <div class="form-group">
                            <label  class="form-label"> البيان بالعربية</label>
                            <textarea required id="edit_home_ar" name="home_ar" class="form-control"></textarea><br><br>

                            {{--  <input type="text" id="edit_home_ar" name="home_ar" class="form-control input-default "><br><br>  --}}
                        </div>
                        <div class="form-group">
                            <label  class="form-label">البيان بالإنجليزية</label>
                            <textarea required id="edit_home_en" name="home_en" class="form-control"></textarea><br><br>

                            {{--  <input type="text" id="edit_home_en" name="home_en" class="form-control input-default "><br><br>  --}}
                        </div>
                        {{--  <div class="form-group">
                            <label  class="form-label"> النوع</label>
                            <select name="home_type" class="form-control" id="types">
                                @foreach ($types as $type)
                                    <option value="{{ $type->home_type }}">{{ $type->home_type }}</option>
                                @endforeach
                            </select><br><br>
                        </div>  --}}
                        <div class="form-group">
                            <label class="form-label"> تغيير الصورة التوضيحية</label>
                            <input id="formFile" type="file" class="form-control" name="home_image" data-max-file-size="5MB"  accept="image/png, image/jpeg, image/jpg, image/gif"><br><br>
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
                            <li class="breadcrumb-item"><a href="javascript:void(0);">الإعدادات</a></li>
                            <li class="breadcrumb-item active" aria-current="page">بيانات الموقع</li>
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
                            <li><a class="dropdown-item" href="javascript:;" data-bs-toggle="modal" data-bs-target="#add" data-whatever="@fat">إضافة</a></li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="card-body">
                @if(count($homes) > 0)
                    <div class="table-responsive">
                        <table class="table table-responsive-lg">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th></th>
                                    <th>النوع</th>
                                    <th>البيان بالعربية</th>
                                    <th>البيان بالإنجليزية</th>
                                    <th>العمليات</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $i=1; @endphp
                                @foreach ($homes as $j)
                                <span id="idd{{ $j->id }}" style="display: none;">{{ $j->id }}</span>
                                <tr>
                                    <th>{{ $i }}</th>
                                    <th>
                                        @if(!is_null($j->home_image))
                                            <span class="avatar avatar-xs me-2 avatar-rounded">
                                                <img src="/public/{{ $j->home_image }}" alt="img">
                                            </span>
                                        @endif
                                    </th>
                                    <td id="home_type{{ $j->id }}">{{ $j->home_type }}</td>
                                    <td id="home_ar{{ $j->id }}">{{ $j->home_ar }}</td>
                                    <td id="home_en{{ $j->id }}">{{ $j->home_en }}</td>
                                    <td>
                                        <a href="javascript:void(0);" class="btn btn-sm btn-primary" onclick="edithome({{ $j->id }})"><i class="la la-pencil"></i></a>
                                        @if($j->home_type == "Values" ||$j->home_type == "Goals" || $j->home_type == "Slider")
                                            <a onclick="destroy('destroyHome',{{ $j->id }})" href="javascript:void(0);" class="btn btn-sm btn-danger"><i class="la la-trash-o"></i></a>
                                        @endif
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
                    {{ $homes->links("pagination::bootstrap-5") }}
                </div>
            </div>
        </div>
    </div>
</div>


@endsection
