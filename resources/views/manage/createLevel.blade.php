@extends("manage.menu")

@section('content')
<script>
    function checkAll(source,name)
    {
        checkboxes = document.getElementsByClassName(name);
        for(var i=0, n=checkboxes.length;i<n;i++)
        {
            checkboxes[i].checked = source.checked;
        }
    }
    function showMajors(sel)
    {
        var lastMajors = document.getElementsByClassName("majors");
        for (var j = 0; j < lastMajors.length; j++)
        {
            lastMajors[j].style.display = "none";
        }

        var sys = sel.value;
        var majors = document.getElementsByClassName("sys"+sys);
        for (var i = 0; i < majors.length; i++)
        {
            majors[i].classList.remove("row");
            majors[i].classList.add("row");
            majors[i].style.display = "block";
        }
    }
</script>
<br><br>
<div class="row">
    <div class="col-lg-12">
        <div class="card custom-card">
            <div class="card-header justify-content-between">
                <div class="card-title">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb breadcrumb-style1 mb-0">
                            <li class="breadcrumb-item"><a href="javascript:void(0);">الصلاحيات</a></li>
                            <li class="breadcrumb-item active" aria-current="page">إضافة</li>
                        </ol>
                    </nav>
                </div>
            </div>

            <form method="POST" action="/newLevel" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                    <div class="basic-form">
                        <div class="form-group">
                            <label class="form-label">الصلاحية </label>
                            <input required type="text" name="level" class="form-control input-default "><br><br>
                        </div>
                        @foreach ($pages as $page)
                            <div class="alert alert-primary justify-content-between text-right font-weight-bold col-lg-12 majors">
                                {{ $page->page }}
                                <input  style="float: left !important;"  class="form-check-input" type="checkbox" id="success2-check" onchange="checkAll(this,'major{{ $page->id }}')">
                            </div>

                            <div class="row majors text-right sys{{ $page->systm_id }}  col-lg-12" align="right" dir="rtl">
                                @foreach ($page["operation"] as $sub)
                                    <div class="col-lg-4" dir="rtl" style="font-size: .9375rem;">
                                        <input value="{{ $sub->id }}" name="operations[]" type="checkbox" class="form-check-input major{{ $page->id }}" style="width: 18px; height: 18px; border-radius: 2px;  border: solid #844fc1; border-width: 2px;">
                                        &nbsp;
                                        {{ $sub->operation }}
                                    </div>
                                @endforeach
                            </div>
                            <br><br>
                    @endforeach
                    </div>
                </div>

                <div class="card-footer">
                    <div class="col-lg-12" align="center">
                        <input type="submit" value="حفظ" class="btn btn-lg btn-primary">
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
