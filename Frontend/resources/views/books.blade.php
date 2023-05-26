@extends('layouts.app')

@section('content')
<div id="content-books">
        <div class="d-flex justify-content-center">
            <div class="pagination">
                <ul class="pagination">
                    <li class="page-item{{ ($members->currentPage() === 1) ? ' disabled' : '' }}">
                        <a class="page-link" href="{{ $members->previousPageUrl() }}" aria-label="Previous">
                            <span aria-hidden="true">&laquo;</span>
                            <span class="sr-only">Previous</span>
                        </a>
                    </li>

                    @php
                        $currentPage = $members->currentPage();
                        $lastPage = $members->lastPage();
                        $range = 2; // Number of pages to show before and after the current page
                        $startPage = max($currentPage - $range, 1);
                        $endPage = min($currentPage + $range, $lastPage);
                    @endphp

                    @if ($startPage > 1)
                        <li class="page-item">
                            <a class="page-link" href="{{ $members->url(1) }}">1</a>
                        </li>
                        @if ($startPage > 2)
                            <li class="page-item disabled">
                                <a class="page-link" href="#">...</a>
                            </li>
                        @endif
                    @endif

                    @foreach ($members->getUrlRange($startPage, $endPage) as $page => $url)
                        <li class="page-item{{ ($members->currentPage() === $page) ? ' active' : '' }}">
                            <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                        </li>
                    @endforeach

                    @if ($endPage < $lastPage)
                        @if ($endPage < ($lastPage - 1))
                            <li class="page-item disabled">
                                <a class="page-link" href="#">...</a>
                            </li>
                        @endif
                        <li class="page-item">
                            <a class="page-link" href="{{ $members->url($lastPage) }}">{{ $lastPage }}</a>
                        </li>
                    @endif

                    <li class="page-item{{ ($members->currentPage() === $members->lastPage()) ? ' disabled' : '' }}">
                        <a class="page-link" href="{{ $members->nextPageUrl() }}" aria-label="Next">
                            <span aria-hidden="true">&raquo;</span>
                            <span class="sr-only">Next</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>

        <div class="container">
            <div class="row">
                @foreach ($members->items() as $item)
                    <div class="col-sm-6 col-md-3 col-lg-3 col-xl-3 mb-4">
                        <div class="card text-center">
                            @if (isset($item['attributes']['Slika_platnice']['data'][0]['attributes']['url']))
                                <img src="http://localhost:1337{{ $item['attributes']['Slika_platnice']['data'][0]['attributes']['url'] }}" class="card-img-top mx-auto d-block mt-3 card-img">
                            @else
                                <img src="https://icon-library.com/images/no-profile-pic-icon/no-profile-pic-icon-7.jpg" class="card-img-top mx-auto d-block mt-3 card-img">
                            @endif
                            <div class="card-body">
                                <h5 class="card-title">
                                    <a href="knjiga/{{ $item['id'] }}">
                                        {{ $item['attributes']['Naslov'] }} ({{ $item['attributes']['Leto'] }}) <br />
                                        Zbornik: {{ $item['attributes']['Zbornik_st'] }}
                                    </a>
                                </h5>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
</div>
@endsection
