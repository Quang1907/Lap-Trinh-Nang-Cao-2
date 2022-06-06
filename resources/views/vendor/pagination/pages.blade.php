@if ($paginator->hasPages())
    <nav class="d-flex justify-items-center justify-content-between pagination-outer" aria-label="Page navigation">
        {{-- <div class="d-flex justify-content-between flex-fill d-sm-none">
            <ul class="pagination">
                @if ($paginator->onFirstPage())
                    <li class="page-item disabled" aria-disabled="true">
                        <span class="page-link">@lang('pagination.previous')</span>
                    </li>
                @else
                    <li class="page-item">
                        <a class="page-link" href="{{ $paginator->previousPageUrl() }}"
                            rel="prev">@lang('pagination.previous')</a>
                    </li>
                @endif

                @if ($paginator->hasMorePages())
                    <li class="page-item">
                        <a class="page-link" href="{{ $paginator->nextPageUrl() }}"
                            rel="next">@lang('pagination.next')</a>
                    </li>
                @else
                    <li class="page-item disabled" aria-disabled="true">
                        <span class="page-link">@lang('pagination.next')</span>
                    </li>
                @endif
            </ul>
        </div> --}}

        <div class="d-none flex-sm-fill d-sm-flex align-items-sm-center justify-content-sm-between">
            <div>
                <p class="small text-muted">
                    {!! __('Hiển thị') !!}
                    <span class="font-medium">{{ $paginator->firstItem() }}</span>
                    {!! __('đến') !!}
                    <span class="font-medium">{{ $paginator->lastItem() }}</span>
                    {!! __('của') !!}
                    <span class="font-medium">{{ $paginator->total() }}</span>
                    {!! __('kết quả') !!}
                </p>
            </div>

            <div>
                <ul class="pagination">
                    {{-- Previous Page Link --}}
                    @if ($paginator->onFirstPage())
                        <li class="page-item ">
                            <a href="#" class="page-link" aria-label="Previous">
                                <span aria-hidden="true">«</span>
                            </a>
                        </li>
                        {{-- <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.previous')">
                            <span class="page-link" aria-hidden="true">&lsaquo;</span>
                        </li> --}}
                    @else
                        <li class="page-item">
                            <a class="page-link" href="{{ $paginator->previousPageUrl() }}" rel="prev"
                                aria-label="@lang('pagination.previous')">&lsaquo;</a>
                        </li>
                    @endif

                    {{-- Pagination Elements --}}
                    @foreach ($elements as $element)
                        {{-- "Three Dots" Separator --}}
                        @if (is_string($element))
                            <li class="page-item" aria-disabled="true"><span
                                    class="page-link">{{ $element }}</span></li>
                        @endif

                        {{-- Array Of Links --}}
                        @if (is_array($element))
                            @foreach ($element as $page => $url)
                                @if ($page == $paginator->currentPage())
                                    <li class="page-item active">
                                        <a class="page-link" href="#">{{ $page }}</a>
                                    </li>
                                @else
                                    <li class="page-item"><a class="page-link"
                                            href="{{ $url }}">{{ $page }}</a></li>
                                @endif
                            @endforeach
                        @endif
                    @endforeach

                    {{-- Next Page Link --}}
                    @if ($paginator->hasMorePages())
                        <li class="page-item">
                            <a class="page-link" href="{{ $paginator->nextPageUrl() }}" rel="next"
                                aria-label="@lang('pagination.next')">&rsaquo;</a>
                        </li>
                    @else
                        <li class="page-item">
                            <a href="#" class="page-link" aria-label="Next">
                                <span aria-hidden="true">»</span>
                            </a>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>
@endif

<style>
    .pagination-outer {
        text-align: center;
    }

    .pagination {
        font-family: 'Work Sans', sans-serif;
        padding: 0 10px;
        border-radius: 0;
        display: inline-flex;
        position: relative;
    }

    .pagination:before {
        content: '';
        background: #999;
        height: 2px;
        width: 100%;
        position: absolute;
        left: 0;
        top: 7px;
    }

    .pagination li a.page-link {
        color: #fff;
        background: #555;
        font-size: 20px;
        font-weight: 700;
        line-height: 35px;
        height: 35px;
        width: 33px;
        padding: 0;
        margin: 0 7px;
        border-radius: 0;
        border: none;
        position: relative;
        z-index: 1;
        transition: all 0.3s ease 0s;
    }

    .pagination li a.page-link:hover,
    .pagination li a.page-link:focus,
    .pagination li.active a.page-link:hover,
    .pagination li.active a.page-link {
        color: #fff;
        background: #a1a1a1;
        font-size: 22px;
        line-height: 40px;
        height: 40px;
    }

    .pagination li a.page-link:before,
    .pagination li a.page-link:after {
        content: '';
        background: linear-gradient(to right bottom, transparent 50%, #111 55%);
        height: 7px;
        width: 7px;
        position: absolute;
        left: -7px;
        top: 0;
        z-index: -1;
        transition: all 0.3s ease 0.3s;
    }

    .pagination li a.page-link:after {
        transform: rotateY(180deg);
        left: auto;
        right: -7px;
    }

    .pagination li:first-child a.page-link,
    .pagination li:last-child a.page-link {
        border-radius: 0;
    }

    @media only screen and (max-width: 480px) {
        .pagination {
            font-size: 0;
            display: inline-block;
        }

        .pagination li {
            display: inline-block;
            vertical-align: top;
        }
    }

    @media only screen and (max-width: 380px) {
        .pagination:before {
            display: none;
        }

        .pagination li a.page-link {
            margin-bottom: 10px;
        }

        .pagination li a.page-link:before,
        .pagination li a.page-link:after {
            display: none;
        }
    }

</style>
