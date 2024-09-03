@extends("manage.menu")

@section('content')

<script>
    function editUser(id)
    {
        var idd = "idd"+id;
        var ar = "User"+id;
        var en = "email"+id;
        var level = document.getElementById("level"+id).innerHTML;
        var drop = document.getElementById("levels");

        document.getElementById("edit_id_User").value = document.getElementById(idd).innerHTML;
        document.getElementById("name").value = document.getElementById(ar).innerHTML;
        document.getElementById("email").value = document.getElementById(en).innerHTML;

        for(let k =0; k < drop.length; k++)
        {
            if(drop[k].value == level) {drop[k].selected = true;}
            else {drop[k].selected = false;}
        }
        $("#edit").modal('show');
    }
</script>
<div class="modal fade" id="add">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-center">إضافة مستخدم</h5>
            </div>

            <form method="POST" action="/newUser">
                @csrf
                <div class="modal-body">
                    <div class="basic-form">
                        <div class="form-group">
                            <label>الإسم </label>
                            <input required type="text" name="name" class="form-control input-default " required><br><br>
                        </div>
                        <div class="form-group">
                            <label>البريد الإلكتروني</label>
                            <input type="email" name="email" class="form-control input-default " required><br><br>
                        </div>
                        <div class="form-group">
                            <label>كلمة المرور</label>
                            <input type="password" name="password" class="form-control input-default " required><br><br>
                        </div>
                        <div class="form-group">
                            <label> الصلاحية</label>
                            <select name="level_id" class="form-control">
                                @foreach ($levels as $level)
                                    <option value="{{ $level->id }}">{{ $level->level }}</option>
                                @endforeach
                            </select>
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
                <h5 class="modal-title text-center">تعديل المستخدم</h5>
            </div>

            <form method="POST" action="/updateUser">
                @csrf
                <input type="hidden" id="edit_id_User" name="User_id">
                <div class="modal-body">
                    <div class="basic-form">
                        <div class="form-group">
                            <label>الإسم </label>
                            <input required type="text" name="name" id="name" class="form-control input-default " required><br><br>
                        </div>
                        <div class="form-group">
                            <label>البريد الإلكتروني</label>
                            <input type="email" name="email" id="email" class="form-control input-default " required><br><br>
                        </div>
                        <div class="form-group">
                            <label>كلمة المرور</label>
                            <input type="password" name="password" id="password" class="form-control input-default "><br><br>
                        </div>
                        <div class="form-group">
                            <label> الصلاحية</label>
                            <select name="level_id" class="form-control" id="levels">
                                @foreach ($levels as $level)
                                    <option value="{{ $level->id }}">{{ $level->level }}</option>
                                @endforeach
                            </select>
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
                            <li class="breadcrumb-item active" aria-current="page">المستخدمين</li>
                        </ol>
                    </nav>
                </div>
                <div class="d-flex flex-wrap gap-2">
                    <div class="dropdown">
                        <a href="javascript:void(0);" class="btn btn-primary btn-sm btn-wave waves-effect waves-light"data-bs-toggle="modal" data-bs-target="#add" data-whatever="@fat">
                            إضافة<i class="bx bx-plus align-middle ms-1 d-inline-block"></i>
                        </a>
                    </div>
                </div>
            </div>

            <div class="card-body">
                @if(count($users) > 0)
                    <div class="table-responsive">
                        <table class="table table-responsive-lg">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th> الإسم</th>
                                    <th>البريد الإلكتروني</th>
                                    <th>الصلاحية</th>
                                    <th>العمليات</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $i=1; @endphp
                                @foreach ($users as $j)
                                <span id="idd{{ $j->id }}" style="display: none;">{{ $j->id }}</span>
                                <span id="level{{ $j->id }}" style="display: none;">{{ $j->level_id }}</span>
                                <tr>
                                    <th>{{ $i }}</th>
                                    <td id="User{{ $j->id }}">{{ $j->name }}</td>
                                    <td id="email{{ $j->id }}">{{ $j->email }}</td>
                                    <td>{{ $j->level }}</td>
                                    <td>
                                        <a href="javascript:void(0);" class="btn btn-sm btn-primary" onclick="editUser({{ $j->id }})"><i class="la la-pencil"></i></a>
                                        <a onclick="destroy('destroyUser',{{ $j->id }})" href="javascript:void(0);" class="btn btn-sm btn-danger"><i class="la la-trash-o"></i></a>
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
                    <strong>لا يوجد مستخدمين</strong>
                </div>
                @endif
            </div>

            <div class="card-footer">
                <div  dir="rtl" align="center" class="pagination flat rounded rounded-flat" style="display: flex;justify-content: center;">
                    {{ $users->links("pagination::bootstrap-5") }}
                </div>
            </div>
        </div>
    </div>
</div>


@endsection
