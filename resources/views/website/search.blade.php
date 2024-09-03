@extends("website.menu")

@section("content")
    <!-- Header Start -->
        <div class="container-fluid bg-breadcrumb">
            <div class="container text-center py-5" style="max-width: 900px;">
                <h4 class="text-white display-4 mb-4 wow fadeInDown" data-wow-delay="0.1s">
                    {{ trans('app.search_result') }}
                </h4>
            </div>
        </div>
        <!-- Header end -->

        <div class="container-fluid feature bg-light py-5 justi-content {{ trans('app.txt') }}" dir="{{ trans('app.dir') }}">
            <div class="container py-5">
                @if(count($searchResults) > 0)
                    @foreach($searchResults->groupByType() as $type => $modelSearchResults)
                        <h2>{{ $type }}</h2>

                        @foreach($modelSearchResults as $searchResult)
                            <ul>
                                <li><a href="{{ $searchResult->url }}">{{ $searchResult->title }}</a></li>
                            </ul>
                        @endforeach
                    @endforeach
                @else
                <div class="text-danger {{ trans('app.txt') }}">
                    {{ trans('app.no_result') }}
                </div>
                @endif
            </div>
        </div>

@endsection
