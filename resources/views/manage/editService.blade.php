@extends("manage.menu")

@section('content')
<br><br>
<div class="row">
    <div class="col-lg-12">
        <div class="card custom-card">
            <div class="card-header justify-content-between">
                <div class="card-title">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb breadcrumb-style1 mb-0">
                            <li class="breadcrumb-item"><a href="javascript:void(0);">الخدمات</a></li>
                            <li class="breadcrumb-item active" aria-current="page">تعديل</li>
                        </ol>
                    </nav>
                </div>
            </div>

            <form method="POST" action="/updateService/{{ $service->id }}" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                    <div class="basic-form">

                        <div class="form-group">
                            <label class="form-label">الخدمة بالعربية</label>
                            <input required type="text" value="{{ $service->service_ar }}"  name="service_ar" class="form-control input-default "><br><br>
                        </div>
                        <div class="form-group">
                            <label class="form-label">الخدمة بالإنجليزية</label>
                            <input type="text" value="{{ $service->service_en }}" name="service_en" class="form-control input-default "><br><br>
                        </div>
                        <div class="form-group">
                            <label class="form-label">الوصف بالعربية</label>
                            <textarea required name="description_ar" class="form-control input-default ">{{ $service->description_ar }}</textarea><br><br>
                        </div>
                        <div class="form-group">
                            <label class="form-label">الوصف بالإنجليزية</label>
                            <textarea name="description_en" class="form-control input-default ">{{ $service->description_en }}</textarea><br><br>
                        </div>
                        <div class="form-group">
                            <label class="form-label"> السعر</label>
                            <input type="number" min="0" step="any" name="price" value="{{ $service->price }}" class="form-control input-default "><br><br>
                        </div>
                        <div class="form-group">
                            <label class="form-label"> الحالة</label>
                            <select name="status" id="status_values" class="form-control">
                                <option value=0 @if(!$service->stactus) selected @endif>غير مُفعَل</option>
                                <option value=1 @if($service->stactus) selected @endif>مُفعَل</option>
                            </select><br><br>
                        </div>
                        <div class="form-group col-lg-12">
                            <label class="form-label"> صورة توضيحية</label>
                            <input type="file" class="single-fileupload" name="image" data-max-file-size="5MB"  accept="image/png, image/jpeg, image/jpg, image/gif"><br><br>
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

@endsection
