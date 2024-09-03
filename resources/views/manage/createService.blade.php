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
                            <li class="breadcrumb-item"><a href="javascript:void(0);">الخدمات</a></li>
                            <li class="breadcrumb-item active" aria-current="page">إضافة</li>
                        </ol>
                    </nav>
                </div>
            </div>

            <form method="POST" action="/newService" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                    <div class="basic-form">
                        <div class="form-group">
                            <label class="form-label">الخدمة بالعربية</label>
                            <input required type="text" name="service_ar" class="form-control input-default "><br><br>
                        </div>
                        <div class="form-group">
                            <label class="form-label">الخدمة بالإنجليزية</label>
                            <input type="text" name="service_en" class="form-control input-default "><br><br>
                        </div>
                        <div class="form-group">
                            <label class="form-label">الوصف بالعربية</label>
                            <textarea required name="description_ar" class="form-control input-default "></textarea><br><br>
                        </div>
                        <div class="form-group">
                            <label class="form-label">الوصف بالإنجليزية</label>
                            <textarea name="description_en" class="form-control input-default "></textarea><br><br>
                        </div>
                        <div class="form-group">
                            <label class="form-label"> السعر</label>
                            <input type="number" min="0" step="any" name="price" class="form-control input-default "><br><br>
                        </div>
                        <div class="form-group col-lg-12">
                            <label class="form-label"> صورة توضيحية</label>
                            <input type="file" class="single-fileupload" name="image" data-max-file-size="5MB"  accept="image/png, image/jpeg, image/jpg, image/gif" required><br><br>
                        </div>
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

<div style="display: none;">
    <input type="file" class="multiple-filepond" name="filepond" multiple data-allow-reorder="true" data-max-file-size="5MB" data-max-files="6">                        </div>
</div>


@endsection
