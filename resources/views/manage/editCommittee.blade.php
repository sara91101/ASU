@extends("manage.menu")

@section('content')

<script>
    function addTask()
    {
        var myDiv = document.createElement("div");
        myDiv.classList.add("col-lg-12");
        myDiv.classList.add("row");
        myDiv.innerHTML += '<div class="form-group col-lg-5">'+
            '<label  class="form-label">المهمة بالعربية</label>'+
            '<input type="text" name="ar_task[]" class="form-control"><br>'+
            '</div><div class="form-group col-lg-5">'+
            '<label  class="form-label">المهمة بالإنجليزية</label>'+
            '<input type="text" name="en_task[]" class="form-control"><br></div>'+
            '<div class="col-lg-2"><div class="form-group"><span><label class="btn btn-sm btn-danger" onclick="removeDiv(this)"><i class="bx bx-trash"></i></label></span></div></div></div>';

        var div = document.getElementById("tasks");

        div.append(myDiv);
    }

    function addNews()
    {
        var myDiv = document.createElement("div");
        myDiv.classList.add("col-lg-12");
        myDiv.classList.add("row");
        myDiv.innerHTML += '<div class="form-group col-lg-5">'+
            '<label  class="form-label">الخبر </label>'+
            '<input type="text" name="ar_news[]" class="form-control"><br>'+
            '</div><div class="form-group col-lg-5">'+
            '<label  class="form-label">تفاصيل الخبر </label>'+
            '<textarea required name="ar_details[]" class="form-control"> </textarea><br>'+
            '</div>'+
            '<div class="col-lg-2"><div class="form-group"><span><label class="btn btn-sm btn-danger" onclick="removeDiv(this)"><i class="bx bx-trash"></i></label></span></div></div></div>';

        var div = document.getElementById("news");

        div.append(myDiv);
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
                            <li class="breadcrumb-item"><a href="javascript:void(0);">اللجان</a></li>
                            <li class="breadcrumb-item active" aria-current="page"> تعديل</li>
                        </ol>
                    </nav>
                </div>
            </div>

            <div class="card-body">
                <form method="POST" action="/committees/{{ $committee->id }}">
                    @csrf
                    <div class="basic-form row">
                        <div class="form-group col-lg-6">
                            <label  class="form-label">إسم اللجنة بالعربية</label>
                            <input type="text" value="{{ $committee->ar_name }}" required name="ar_name" class="form-control"><br><br>
                        </div>
                        <div class="form-group col-lg-6">
                            <label  class="form-label">إسم اللجنة بالإنجليزية</label>
                            <input type="text" value="{{ $committee->en_name }}" name="en_name" class="form-control"><br><br>
                        </div>
                    </div>

                    {{--  tasks  --}}
                    <div class="alert alert-primary" role="alert">
                        <b>مهام اللجنة</b>
                    </div>
                    <div class="basic-form" id="tasks">
                        @foreach ($committee["task"] as $task)
                        <div class="row">
                            <div class="form-group col-lg-5">
                                <label  class="form-label">المهمة بالعربية</label>
                                <input type="text" value="{{ $task->ar_task }}" required name="ar_task[]" class="form-control"><br>
                            </div>
                            <div class="form-group col-lg-5">
                                <label  class="form-label">المهمة بالإنجليزية</label>
                                <input type="text" value="{{ $task->en_task }}" name="en_task[]" class="form-control"><br>
                            </div>
                            @if($loop->first)
                            <div class="form-group col-lg-2">
                                <label class="btn btn-success btn-sm" onclick="addTask()">
                                    <i class="bx bx-plus"></i>
                                </label>
                            </div>
                            @else
                            <div class="col-lg-2">
                                <div class="form-group">
                                    <span>
                                        <label class="btn btn-sm btn-danger" onclick="removeDiv(this)">
                                            <i class="bx bx-trash"></i>
                                        </label>
                                    </span>
                                </div>
                            </div>
                            @endif
                        </div>
                        @endforeach
                    </div>

                    {{--  members  --}}
                    <div class="alert alert-primary" role="alert">
                        <b>الأعضاء</b>
                    </div>

                    <ul class="nav nav-tabs mb-3 nav-justified nav-style-1 d-sm-flex d-block" role="tablist">
                        @foreach ($types as $type)
                            <li class="nav-item @if($loop->first) active @endif">
                                <a  @if($loop->first) aria-selected="true" @endif class="nav-link @if($loop->first) active @endif" data-bs-toggle="tab" role="tab" href="#home{{ $type->id }}-justified">
                                    {{ $type->type_ar }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                    <div class="tab-content">
                        @foreach ($types as $type)
                            <div class="tab-pane text-muted row @if($loop->first) show active @endif" id="home{{ $type->id }}-justified" role="tabpanel">
                                @foreach($type["university"] as $university)
                                    <div class="col-lg-3">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="{{ $university->id }}" id="checkebox-sm" name="members[]" {{ $university->checked }}>
                                            <label class="form-check-label" for="checkebox-sm">
                                                {{ $university->ar_name }}
                                            </label>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endforeach
                    </div>
                    <br><br>

                    {{--  news  --}}
                    <div class="alert alert-primary" role="alert">
                        <b>أخبار اللجنة</b>
                    </div>
                    <div class="basic-form" id="news">
                        @foreach ($committee["news"] as $new)
                        <div class="row">
                            <div class="form-group col-lg-5">
                                <label  class="form-label">الخبر </label>
                                <input type="text" value="{{ $new->ar_news }}" name="ar_news[]" class="form-control"><br>
                            </div>
                            <div class="form-group col-lg-5">
                                <label  class="form-label">تفاصيل الخبر </label>
                                <textarea required name="ar_details[]" class="form-control">{{ $new->ar_description }} </textarea><br>
                            </div>
                            @if($loop->first)
                            <div class="form-group col-lg-2">
                                <label class="btn btn-success btn-sm" onclick="addNews()">
                                    <i class="bx bx-plus"></i>
                                </label>
                            </div>
                            @else
                            <div class="col-lg-2">
                                <div class="form-group">
                                    <span>
                                        <label class="btn btn-sm btn-danger" onclick="removeDiv(this)">
                                            <i class="bx bx-trash"></i>
                                        </label>
                                    </span>
                                </div>
                            </div>
                            @endif
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
