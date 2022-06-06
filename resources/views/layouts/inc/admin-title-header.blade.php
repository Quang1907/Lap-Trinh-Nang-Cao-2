<div class="d-flex justify-content-between">
    <h3 class="font-weight-bold">{{ $name }} {{ isset($key) ? $key : '' }}</h3>
    <nav class="">
        <ol class="breadcrumb border-0">
            <li class="breadcrumb-item"><a href="#">{{ $name }}</a></li>
            @isset($key)
                <li class="breadcrumb-item active" aria-current="page">{{ $key }}</li>
            @endisset
        </ol>
    </nav>
</div>
