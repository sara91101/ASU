@extends("manage.menu")

@section('content')

<div class="row">
    <div class="col-lg-12">
        <div class="card custom-card">
            <div class="card-header justify-content-between">
                <div class="card-title">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb breadcrumb-style1 mb-0">
                            <li class="breadcrumb-item"><a href="javascript:void(0);"> الإستفسارات</a></li>
                            <li class="breadcrumb-item active" aria-current="page"> عرض</li>
                        </ol>
                    </nav>
                </div>
            </div>

            <div class="card-body">
                @if(count($contacts) > 0)
                    <div class="table-responsive">
                        <table class="table table-responsive-lg">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>الإسم </th>
                                    <th>نوع الزائر </th>
                                    <th>البريد الإلكتروني </th>
                                    <th>الإستفسار </th>
                                    <th>الرد </th>
                                    <th>العمليات</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $i=1; @endphp
                                @foreach ($contacts as $j)
                                <span id="idd{{ $j->id }}" style="display: none;">{{ $j->id }}</span>
                                <tr>
                                    <th>{{ $i }}</th>
                                    <td id="ar_question{{ $j->id }}">{{ $j->name }}</td>
                                    <td >{{ $j->visitor_type }}</td>
                                    <td id="ar_answer{{ $j->id }}">{{ $j->email }}</td>
                                    <td id="ar_answer{{ $j->id }}">{{ $j->msg }}</td>
                                    @if(!is_null($j->reply))
                                    <td id="ar_answer{{ $j->id }}">
                                        <span class="btn btn-sm btn-success">
                                            <i class="la la-check"></i>
                                        </span>
                                    </td>
                                    @else
                                    <td id="ar_answer{{ $j->id }}">
                                        <span class="btn btn-sm btn-warning">
                                            <i class="la la-close"></i>
                                        </span>
                                    </td>
                                    @endif
                                    <td>
                                        <a onclick="destroy('destroyContact',{{ $j->id }})" href="javascript:void(0);" class="btn btn-sm btn-danger"><i class="la la-trash-o"></i></a>
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
                    {{ $contacts->links("pagination::bootstrap-5") }}
                </div>
            </div>
        </div>
    </div>
</div>


@endsection
