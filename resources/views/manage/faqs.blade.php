@extends("manage.menu")

@section('content')

<script>
    function editfaq(id)
    {
        var idd = "idd"+id;
        var ar = "ar_question"+id;
        var en = "ar_answer"+id;
        var ar2 = "en_question"+id;
        var en2 = "en_answer"+id;
        //var type = document.getElementById("faq_type"+id).innerHTML;

        var drop = document.getElementById("types");

        document.getElementById("edit_id_faq").value = document.getElementById(idd).innerHTML;
        document.getElementById("faq_ar").value = document.getElementById(ar).innerHTML;
        document.getElementById("faq_details").value = document.getElementById(en).innerHTML;
        document.getElementById("faq_en").value = document.getElementById(ar2).innerHTML;
        document.getElementById("faq_details_en").value = document.getElementById(en2).innerHTML;

        $("#edit").modal('show');
    }
</script>

<div class="modal fade" id="add">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-center">إضافة الأسئلة الشائعة</h5>
            </div>

            <form method="POST" action="/faqs">
                @csrf
                <div class="modal-body">
                    <div class="basic-form">
                        <div class="form-group">
                            <label  class="form-label">السؤال بالعربية </label>
                            <textarea required name="ar_question" class="form-control"></textarea><br><br>
                        </div>
                        <div class="form-group">
                            <label  class="form-label">الإجابة بالعربية </label>
                            <textarea required name="ar_answer" class="form-control"></textarea><br><br>
                        </div>
                        <div class="form-group">
                            <label  class="form-label">السؤال بالإنجليزية </label>
                            <textarea required name="en_question" class="form-control"></textarea><br><br>
                        </div>
                        <div class="form-group">
                            <label  class="form-label">الإجابة بالإنجليزية </label>
                            <textarea required name="en_answer" class="form-control"></textarea><br><br>
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
                <h5 class="modal-title text-center">تعديل الأسئلة الشائعة</h5>
            </div>

            <form method="POST" action="/updateFAQ" enctype="multipart/form-data">
                @csrf
                <input type="hidden" id="edit_id_faq" name="faq_id">
                <div class="modal-body">
                    <div class="basic-form">
                        <div class="form-group">
                            <label  class="form-label"> السؤال </label>
                            <textarea required id="faq_ar" name="ar_question" class="form-control"></textarea><br><br>
                        </div>
                        <div class="form-group">
                            <label  class="form-label">الإجاية </label>
                            <textarea required id="faq_details" name="ar_answer" class="form-control"></textarea><br><br>
                        </div>
                        <div class="form-group">
                            <label  class="form-label"> السؤال </label>
                            <textarea required id="faq_en" name="en_question" class="form-control"></textarea><br><br>
                        </div>
                        <div class="form-group">
                            <label  class="form-label">الإجاية </label>
                            <textarea required id="faq_details_en" name="en_answer" class="form-control"></textarea><br><br>
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
                            <li class="breadcrumb-item"><a href="javascript:void(0);">الأسئلة الشائعة</a></li>
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
                @if(count($faqs) > 0)
                    <div class="table-responsive">
                        <table class="table table-responsive-lg">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>السؤال </th>
                                    <th>الإجابة </th>
                                    <th>العمليات</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $i=1; @endphp
                                @foreach ($faqs as $j)
                                <span id="idd{{ $j->id }}" style="display: none;">{{ $j->id }}</span>
                                <span id="en_question{{ $j->id }}" style="display: none;">{{ $j->en_question }}</span>
                                <span id="en_answer{{ $j->id }}" style="display: none;">{{ $j->en_answer }}</span>
                                <tr>
                                    <th>{{ $i }}</th>
                                    <td id="ar_question{{ $j->id }}">{{ $j->ar_question }}</td>
                                    <td id="ar_answer{{ $j->id }}">{{ $j->ar_answer }}</td>
                                    <td>
                                        <a href="javascript:void(0);" class="btn btn-sm btn-primary" onclick="editfaq({{ $j->id }})"><i class="la la-pencil"></i></a>
                                        <a onclick="destroy('destroyFaq',{{ $j->id }})" href="javascript:void(0);" class="btn btn-sm btn-danger"><i class="la la-trash-o"></i></a>
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
                    {{ $faqs->links("pagination::bootstrap-5") }}
                </div>
            </div>
        </div>
    </div>
</div>


@endsection
