@extends("manage.menu")

@section('content')

<script>
    function addTask()
    {
        var myDiv = document.createElement("div");
        myDiv.classList.add("col-lg-12");
        myDiv.classList.add("row");
        myDiv.innerHTML += '<div class="form-group col-lg-4">'+
            '<label  class="form-label">المحتوى</label>'+
            '<input type="text" name="contents[]" class="form-control"><br>'+
            '</div>'+
            '<div class="form-group col-lg-4">'+
            '<label  class="form-label">المحتوى بالإنجليزية </label>'+
            '<input type="text" required name="contents_en[]" class="form-control" required><br></div>'+
            '<div class="form-group col-lg-3">'+
            '<label  class="form-label"> المٌرفق</label>'+
            '<input type="file" name="content_paths[]" class="form-control"><br></div>'+
            '<div class="col-lg-1"><div class="form-group"><span><label class="btn btn-sm btn-danger" onclick="removeDiv(this)"><i class="bx bx-trash"></i></label></span></div></div></div>';

        var div = document.getElementById("tasks");

        div.append(myDiv);
    }
    function removePrevious(row)
    {
        var d = row.parentNode.parentNode.remove();
    }
    function removeDiv(row)
    {
        var d = row.parentNode.parentNode.parentNode.parentNode.remove();
    }
</script>
<div class="row">
    <div class="col-lg-12">
        <div class="card custom-card">
            <div class="card-header justify-content-between">
                <div class="card-title">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb breadcrumb-style1 mb-0">
                            <li class="breadcrumb-item"><a href="javascript:void(0);">المستودع الرقمي</a></li>
                            <li class="breadcrumb-item active" aria-current="page"> تعديل</li>
                        </ol>
                    </nav>
                </div>
            </div>

            <div class="card-body">
                <form method="POST" action="/updateDspaceLink/{{ $dspace->id }}" enctype="multipart/form-data">
                    @csrf
                    <div class="basic-form row">
                        <div class="form-group col-lg-6">
                            <label  class="form-label">الملف بالعربية</label>
                            <input type="text" value="{{ $dspace->link_name }}" name="name" class="form-control" required><br><br>
                        </div>
                        <div class="form-group col-lg-6">
                            <label  class="form-label">الملف بالإنجليزية</label>
                            <input type="text" value="{{ $dspace->link_name_en }}" name="name_en" class="form-control" required><br><br>
                        </div>
                    </div>

                    {{--  tasks  --}}
                    <div class="alert alert-primary justify-content-between" role="alert">
                        <label>
                            <b>المحتويات</b>
                        </label>

                        <label class="btn btn-success btn-sm float-end" onclick="addTask()">
                            <i class="bx bx-plus"></i>
                        </label>
                    </div>
                    <div class="basic-form row" id="tasks">
                        @foreach ($dspace["dspaceLinkContent"] as $link)
                            <div class="col-lg-12 row">
                                <div class="form-group col-lg-4">
                                    <label  class="form-label">المحتوى بالعربية </label>
                                    <input type="text" value="{{ $link->content_title }}" name="contents[]" class="form-control" required><br>
                                </div>
                                <div class="form-group col-lg-4">
                                    <label  class="form-label">المحتوى بالإنجليزية </label>
                                    <input type="text" value="{{ $link->content_title_en }}" name="contents_en[]" class="form-control" required><br>
                                </div>
                                <div class="form-group col-lg-3">
                                    <label  class="form-label"> المٌرفق</label>
                                    <input type="file" name="content_paths[]" class="form-control"><br>

                                    <input type="hidden" value="{{ $link->content_path }}" name="last_paths[]" class="form-control"><br>

                                </div>
                                <div class="form-group col-lg-1">
                                    <label class="btn btn-danger btn-sm" onclick="removePrevious(this)">
                                        <i class="bx bx-trash"></i>
                                    </label>
                                </div>
                            </div>
                        @endforeach

                    </div>


            </div>

            <div class="card-footer">
                <div class="col-lg-12" align="center">
                    <input type="submit" value="تعديل" class="btn btn-lg btn-primary">
                </div>
            </div>
        </form>
        </div>

    </div>
</div>
@endsection
