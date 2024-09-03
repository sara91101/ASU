@extends("manage.menu")

@section('content')
<style>
    .my-single-fileupload
    {width:8rem!important;height:8rem!important;margin:0 auto!important}
</style>
<br><br>
<div class="row">
    <div class="col-lg-12">
        <div class="card custom-card">
            <div class="card-header justify-content-between">
                <div class="card-title">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb breadcrumb-style1 mb-0">
                            <li class="breadcrumb-item"><a href="javascript:void(0);">فريق العمل</a></li>
                            <li class="breadcrumb-item active" aria-current="page">تعديل</li>
                        </ol>
                    </nav>
                </div>
            </div>

            <form method="POST" action="/updateTeam/{{ $member->id }}" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                    <div class="basic-form row">
                        <div class="form-group col-lg-6">
                            <label class="form-label">الإسم بالعربية</label>
                            <input value="{{ $member->name_ar }}" required type="text" name="name_ar" class="form-control input-default "><br><br>
                        </div>
                        <div class="form-group col-lg-6">
                            <label class="form-label">الإسم بالإنجليزية</label>
                            <input value="{{ $member->name_en }}" type="text" name="name_en" class="form-control input-default"><br><br>
                        </div>
                        <div class="form-group col-lg-6">
                            <label class="form-label">رقم الهاتف</label>
                            <input value="{{ $member->phone }}"  type="number" name="phone" class="form-control input-default "><br><br>
                        </div>
                        <div class="form-group col-lg-6">
                            <label class="form-label">البريد الإلكتروني</label>
                            <input value="{{ $member->email }}"  type="email" name="email" class="form-control input-default "><br><br>
                        </div>
                        {{--  <div class="form-group col-lg-6">
                            <label class="form-label"> العنوان</label>
                            <input value="{{ $member->address }}"  type="text" name="address" class="form-control input-default "><br><br>
                        </div>  --}}
                        <div class="form-group col-lg-6">
                            <label class="form-label"> المسمى الوظيفي</label>
                            <input value="{{ $member->Job }}" required type="text" name="job" class="form-control input-default "><br><br>
                        </div>

                        <div class="form-group col-lg-6">
                            <label class="form-label">المسمى الوظيفي بالإنجليزية</label>
                            <input type="text" required name="job_en" value="{{ $member->job_en }}" class="form-control input-default"><br><br>
                        </div>
                        <br><br>
                        <div class="form-group col-lg-12">
                            <label class="form-label"> صورة شخصية</label>
                            <input type="file" class="single-fileupload" name="image_path" data-max-file-size="5MB"  accept="image/png, image/jpeg, image/jpg, image/gif"><br><br>
                        </div>
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

<div style="display: none;">
    <input type="file" class="multiple-filepond" name="filepond" multiple data-allow-reorder="true" data-max-file-size="5MB" data-max-files="6">                        </div>
</div>


@endsection
