@extends("manage.menu")

@section('content')

<div class="row">
    <div class="col-lg-12">
        <div class="card custom-card">
            <div class="card-header justify-content-between">
                <div class="card-title">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb breadcrumb-style1 mb-0">
                            <li class="breadcrumb-item"><a href="javascript:void(0);">الأعضاء</a></li>
                            <li class="breadcrumb-item active" aria-current="page"> تعديل</li>
                        </ol>
                    </nav>
                </div>
            </div>

            <div class="card-body">
                <form method="POST" action="/universities/{{ $university->id }}"  enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="basic-form">
                            <div class="form-group">
                                <label  class="form-label">العضو بالعربية</label>
                                <input type="text" value="{{ $university->ar_name }}" required id="ar_name" name="ar_name" class="form-control"><br><br>
                            </div>
                            <div class="form-group">
                                <label  class="form-label">العضو بالإنجليزية</label>
                                <input type="text" value="{{ $university->en_name }}" required id="en_name" name="en_name" class="form-control"><br><br>
                            </div>
                            <div class="form-group">
                                <label  class="form-label"> التصنيف</label>
                                <select name="type_id" class="form-control" id="types">
                                    @foreach ($types as $type)
                                        <option @if($type->id == $university->type_id) selected @endif value="{{ $type->id }}">{{ $type->type_ar }}</option>
                                    @endforeach
                                </select><br><br>
                            </div>
                            <div class="form-group">
                                <label class="form-label"> تعديل الشعار </label>
                                <input type="file" class="single-fileupload" name="logo" data-max-file-size="5MB"  accept="image/png, image/jpeg, image/jpg, image/gif"><br><br>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer" align="center">
                        <input type="submit" value="تعديل" class="btn btn-primary">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


@endsection
