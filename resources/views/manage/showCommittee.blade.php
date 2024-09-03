@extends("manage.menu")

@section("content")
<div class="row">
    <div class="col-lg-12">
        <div class="card custom-card">
            <div class="card-header justify-content-between">
                <div class="card-title">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb breadcrumb-style1 mb-0">
                            <li class="breadcrumb-item"><a href="javascript:void(0);">اللجان</a></li>
                            <li class="breadcrumb-item active" aria-current="page">التفاصيل</li>
                        </ol>
                    </nav>
                </div>
            </div>

            <div class="card-body">
                <div class="accordion accordionicon-left accordions-items-seperate accordion-solid-primary" id="accordioniconLeftExample">
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingleftOne">
                            <button class="accordion-button justify-content-between" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapseleftOne" aria-expanded="true"
                                aria-controls="collapseleftOne">
                                إسم اللجنة
                            </button>
                        </h2>
                        <div id="collapseleftOne" class="accordion-collapse collapse show"
                            aria-labelledby="headingleftOne" data-bs-parent="#accordioniconLeftExample">
                            <div class="accordion-body row">
                                <div class="list-group col-lg-12">
                                    <label class="list-group-item">
                                        <input class="form-check-input me-1" type="radio" value=""
                                            name="list-radio1" checked>
                                            الإسم بالعربية : {{ $committee->ar_name }}
                                    </label>
                                </div>

                                <div class="list-group col-lg-12">
                                    <label class="list-group-item">
                                        <input class="form-check-input me-1" type="radio" value=""
                                            name="list-radio7" checked>
                                            الإسم بالإنجليزية : {{ $committee->en_name }}
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>




                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingleftThree1">
                            <button class="accordion-button collapsed justify-content-between" type="button"
                                data-bs-toggle="collapse" data-bs-target="#collapseLeftThree1"
                                aria-expanded="false" aria-controls="collapseLeftThree1">
                                مهام اللجنة
                            </button>
                        </h2>
                        <div id="collapseLeftThree1" class="accordion-collapse collapse"
                            aria-labelledby="headingleftThree1"
                            data-bs-parent="#accordioniconLeftExample">
                            <div class="accordion-body row">
                                @foreach ($committee["task"] as $task)
                                <div class="list-group col-lg-12">

                                    <label class="list-group-item">
                                        <input class="form-check-input me-1" type="radio" value=""
                                            name="list-radio{{ $task->ar_task }}" checked>
                                        {{ $task->ar_task }}
                                    </label>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>


                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingleftThree2">
                            <button class="accordion-button collapsed justify-content-between" type="button"
                                data-bs-toggle="collapse" data-bs-target="#collapseLeftThree2"
                                aria-expanded="false" aria-controls="collapseLeftThree2">
                                أعضاء اللجنة
                            </button>
                        </h2>
                        <div id="collapseLeftThree2" class="accordion-collapse collapse"
                            aria-labelledby="headingleftThree2"
                            data-bs-parent="#accordioniconLeftExample">
                            <div class="accordion-body row">
                                @foreach ($members as $member)
                                <div class="list-group col-lg-12">
                                    <label class="list-group-item">
                                        <input class="form-check-input me-1" type="radio" value=""
                                            name="list-radio{{ $member->id }}" checked>
                                        {{ $member->ar_name }}
                                    </label>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>
</div>

@endsection
