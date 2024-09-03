@extends("website.menu")

@section("content")

    <div class="container">
        <div class="card">
            <div class="card-body container">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Search by keyword</h5>
                    <button type="button" class="btn-close {{ trans('app.float') }}" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="POST" action="searchable">
                    <div class="modal-body d-flex align-items-center bg-primary">
                        <div class="input-group w-75 mx-auto d-flex">
                            <input type="search" name="field" class="form-control p-3" placeholder="keywords" aria-describedby="search-icon-1">
                            <button type="submit" id="search-icon-1" class="btn bg-light border nput-group-text p-3"><i class="fa fa-search"></i></button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
