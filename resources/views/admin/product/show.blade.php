@extends('layouts.master')
@section('title', 'Categories')
@section('content')
    @include('layouts.inc.admin-title-header', [
        'name' => 'Product',
        'key' => 'List',
    ])
    <div class="row">
        <div class="col-lg-12 grid-margin">
            <div class="card">
                <div class="m-2 col-sm-12">
                    <a href="{{ route('products.index') }}" class="btn btn-success btn-sm float-end">List Product</a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <div class="card  bg-dark text-white p-3 fw-bolder mb-1">
                            <h2>Danh mục sản phẩm: {{ $product->category->name }}</h2>
                        </div>
                        <div class="card bg-dark text-white p-3 fw-bolder">
                            @php($array = array_keys($product->toArray()))
                            @for ($i = 1; $i <= 3; $i++)
                                @php($value = $array[$i])
                                <x-input-show label="{{ ucfirst($value) }}" value="{{ $product->$value }}" />
                            @endfor
                            <div class="row w-100 p-2">
                                <div class="col-sm-2">Status</div>
                                <div class="col-sm-4">
                                    @if ($product->status == 1)
                                        <span class="badge badge-success">Public</span>
                                    @else
                                        <span class="badge badge-danger">Private</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="card bg-dark text-white p-3 mt-2">
                            <label for="">Mô tả sản phẩm</label>
                            <div class="overflow-scroll" style="height:500px">
                                {!! $product->desc !!}
                            </div>
                        </div>
                        <div class="card bg-dark text-white p-3 mt-2">
                            <div class="row d-flex m-auto">
                                <label for="" class="w-100">
                                    <h2>Hình ảnh đại diện</h2>
                                </label>
                                <img src="{{ asset($product->image) }}" class="img-thumbnail rounded w-25" alt="">
                            </div>

                        </div>
                        <div class="card bg-dark text-white p-3 mt-2">
                            <label for="" class="w-100">
                                <h2>Hình ảnh chi tiết</h2>
                            </label>
                            <input type="hidden" id="image_list" value=" {{ $product->image_list }}">
                            <div id="show_images"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        $(document).ready(
            function() {
                _links = $('input#image_list').val();
                $('#show_images').html('');
                if (_links != '') {
                    if (_links.indexOf('[') == -1) {
                        $('#show_images').append('<image src="' + _links + '" class="img-thumbnail m-2 w-100"/>');
                    } else {
                        arrs = $.parseJSON(_links);
                        $.each(arrs, function(key, value) {
                            $('#show_images').append('<image src="' + value +
                                '" class="img-fluid m-2 w-50 rounded"/>');
                        })
                    }
                }
            }
        );
    </script>
@endsection
