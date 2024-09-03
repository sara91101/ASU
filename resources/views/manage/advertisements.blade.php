@extends("manage.menu")

@section('content')
<script>
    function editfaq(id)
    {
        var idd = "idd"+id;
        var ar = "ar_advertisement"+id;
        var en = "ar_details"+id;
        var ar2 = "en_advertisement"+id;
        var en2 = "en_details"+id;
        var timee = "datee"+id;


        document.getElementById("edit_id_faq").value = id;
        document.getElementById("faq_ar").value = document.getElementById(ar).innerHTML;
        document.getElementById("faq_details").value = document.getElementById(en).innerHTML;
        document.getElementById("faq_en").value = document.getElementById(ar2).innerHTML;
        document.getElementById("faq_details_en").value = document.getElementById(en2).innerHTML;
        document.getElementById("end_time").value = document.getElementById(timee).innerHTML;

        $("#edit").modal('show');
    }
</script>

<div class="modal fade" id="add">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-center">إضافة الإعلانات / الأخبار</h5>
            </div>

            <form method="POST" action="/advertisements" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="basic-form">
                        <div class="form-group">
                            <label  class="form-label">العنوان بالعربية </label>
                            <textarea required name="ar_advertisement" class="form-control" required></textarea><br><br>
                        </div>
                        <div class="form-group">
                            <label  class="form-label">التفاصيل بالعربية </label>
                            <textarea required name="ar_details" class="form-control" required></textarea><br><br>
                        </div>
                        <div class="form-group">
                            <label  class="form-label">العنوان بالإنجليزية </label>
                            <textarea required name="en_advertisement" class="form-control"></textarea><br><br>
                        </div>
                        <div class="form-group">
                            <label  class="form-label">التفاصيل بالإنجليزية </label>
                            <textarea required name="en_details" class="form-control"></textarea><br><br>
                        </div>
                        <div class="form-group">
                            <label  class="form-label">صورة توضيحية</label>
                            <input type="file" name="image" class="form-control" accept="image/png, image/jpeg, image/jpg">
                            <br><br>
                        </div>
                        <div class="form-group">
                            <label  class="form-label">تاريخ إنتهاء الإعلان / الخبر</label>
                            <input type="date" name="end_time" class="form-control" required>
                            <br><br>
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
                <h5 class="modal-title text-center">تعديل الإعلانات</h5>
            </div>

            <form method="POST" action="/updateAdvertisement" enctype="multipart/form-data">
                @csrf
                <input type="hidden" id="edit_id_faq" name="advertisement_id">
                <div class="modal-body">
                    <div class="basic-form">
                        <div class="form-group">
                            <label  class="form-label"> الإعلان بالعربية </label>
                            <textarea required id="faq_ar" name="ar_advertisement" class="form-control" required></textarea><br><br>
                        </div>
                        <div class="form-group">
                            <label  class="form-label">التفاصيل بالعربية </label>
                            <textarea required id="faq_details" name="ar_details" class="form-control" required></textarea><br><br>
                        </div>
                        <div class="form-group">
                            <label  class="form-label"> الإعلان بالإنجليزية </label>
                            <textarea required id="faq_en" name="en_advertisement" class="form-control" required></textarea><br><br>
                        </div>
                        <div class="form-group">
                            <label  class="form-label">التفاصيل بالإنجليزية </label>
                            <textarea required id="faq_details_en" name="en_details" class="form-control" required></textarea><br><br>
                        </div>
                        <div class="form-group">
                            <label  class="form-label">تاريخ إنتهاء الإعلان / الخبر</label>
                            <input type="date" name="end_time" id="end_time" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label  class="form-label">صورة توضيحية</label>
                            <input type="file" name="image" class="form-control" accept="image/png, image/jpeg, image/jpg">
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
                            <li class="breadcrumb-item"><a href="javascript:void(0);"> الإعلانات</a></li>
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
                @if(count($advertisements) > 0)
                    <div class="table-responsive">
                        <table class="table table-responsive-lg">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>الإعلان </th>
                                    <th>التفاصيل </th>
                                    <th>تاريخ الإنتهاء </th>
                                    <th>الحالة</th>
                                    <th>العمليات</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $i=1; @endphp
                                @foreach ($advertisements as $j)
                                <span id="en_advertisement{{ $j->id }}" style="display: none;">{{ $j->en_advertisement }}</span>
                                <span id="en_details{{ $j->id }}" style="display: none;">{{ $j->en_details }}</span>
                                <tr>
                                    <td>{{ $i }}</td>
                                    <th>
                                        @if(!is_null($j->image))
                                        <span class="avatar avatar-xs me-2 avatar-rounded">
                                            <img src="/news/{{ $j->image }}" alt="img">
                                        </span>
                                        @endif
                                    </th>
                                    <td id="ar_advertisement{{ $j->id }}">{{ $j->ar_advertisement }}</td>
                                    <td id="ar_details{{ $j->id }}">{{ $j->ar_details }}</td>
                                    <td id="datee{{ $j->id }}">{{ $j->end_time }}</td>
                                    <td>
                                        @if($j->archieve == 1)
                                            <label class="btn btn-sm btn-warning text-white">مؤرشف</label>
                                        @else
                                            <label class="btn btn-sm btn-success text-white">مفعل</label>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="javascript:void(0);" class="btn btn-sm btn-primary" onclick="editfaq({{ $j->id }})"><i class="la la-pencil"></i></a>
                                        <a onclick="destroy('destroyAdvertisement',{{ $j->id }})" href="javascript:void(0);" class="btn btn-sm btn-danger"><i class="la la-trash-o"></i></a>
                                        <a href="/archieveAdvertisement/{{ $j->id }}" class="btn btn-sm btn-warning"><i class="bi bi-archive"></i></a>
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
                    {{ $advertisements->links("pagination::bootstrap-5") }}
                </div>
            </div>
        </div>
    </div>
</div>


@endsection
