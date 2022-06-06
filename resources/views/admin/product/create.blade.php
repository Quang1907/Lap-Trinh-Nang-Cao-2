@extends('layouts.master')
@section('title', 'Categories')
@section('css')
    <script src="https://cdn.tiny.cloud/1/ucpkc47hvx80mrf6ntd3rsrl19vg29taofnbu61ittwzw6ih/tinymce/5/tinymce.min.js"
        referrerpolicy="origin"></script>
@endsection
@section('content')
    @include('layouts.inc.admin-title-header', [
        'name' => 'Product',
        'key' => 'Create',
    ])
    <div class="row">
        <div class="col-lg-12 grid-margin">
            <div class="card">
                <div class="m-2 col-sm-12">
                    <a href="{{ route('products.index') }}" class="btn btn-success btn-sm float-end"><i class="fa-solid fa-list-check"></i></a>
                </div>
                <div class="card-body">
                    <div class="col-12 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <form class="forms-sample" action="{{ route('products.store') }}" method="POST">
                                    @csrf
                                    <x-input name="Name" type="text" place="Nhập tên sản phẩm" id="name"
                                        value="{{ old('name') }}" />
                                    @error('name')
                                        <small class="form-text text-danger mb-3">{{ $message }}</small>
                                    @enderror
                                    <x-input name="Price" type="number" place="Nhập giá sản phẩm" id="price"
                                        value="{{ old('price') }}" />
                                    @error('price')
                                        <small class="form-text text-danger mb-3">{{ $message }}</small>
                                    @enderror
                                    <x-input name="Sale Price" type="number" place="Nhập giá sale sản phẩm" id="sale_price"
                                        value="{{ old('sale_price') }}" />
                                    @error('sale_price')
                                        <small class="form-text text-danger mb-3">{{ $message }}</small>
                                    @enderror
                                    <div class="mb-3">
                                        <label for="" class="form-label">Chọn danh mục</label>
                                        <select class="form-control" name="category_id">
                                            {!! $htmlOption !!}
                                        </select>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-4 mb-3">
                                            <label class="form-label">Hình ảnh đại diện</label>
                                            <div class="input-group-append">
                                                <input type="text" class="form-control d-none" id='image' name='image'
                                                    placeholder="Tải lên hình ảnh" value='{{ old('image') }}'>
                                                <span class="input-group-text border-0 bg-white p-0">
                                                    <button type="button" class="btn btn-primary rounded-0"
                                                        data-bs-toggle="modal" data-bs-target="#file_image">
                                                        <i class="fa-solid fa-folder-open"></i>
                                                    </button>
                                                </span>
                                            </div>
                                            <div class="mt-2 d-none" id="show_image"></div>
                                            @error('image')
                                                <small class="form-text text-danger mb-3">{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <div class="col-sm-8 mb-3">
                                            <label class="form-label">Hình ảnh chi tiết</label>
                                            <div class="input-group-append">
                                                <input type="text" class="form-control d-none" id='image_list'
                                                    name='image_list' placeholder="Tải lên hình ảnh"
                                                    value='{{ old('image_list') }}'>
                                                <span class="input-group-text border-0 bg-white p-0">
                                                    <button type="button" class="btn btn-primary rounded-0"
                                                        data-bs-toggle="modal" data-bs-target="#imageList">
                                                        <i class="fa-solid fa-folder-open"></i>
                                                    </button>
                                                </span>
                                            </div>
                                            <div class="mt-2 d-none" id="show_images"></div>
                                            @error('image_list')
                                                <small class="form-text text-danger mb-3">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Mô tả</label>
                                        <textarea name="desc" class="form-control my-editor">{{ old('desc') }}</textarea>
                                        @error('desc')
                                            <small class="form-text text-danger mt-3">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <button type="submit" class="btn btn-primary mr-2 float-end">Submit</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <x-file title='Tải lên hình ảnh chi tiết' id='imageList' fieldId='image_list' />
    <x-file title='Tải lên hình ảnh đại diện' id='file_image' fieldId='image' />

@endsection

@section('js')
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        function image() {
            $('#show_image').removeClass('d-none');
            $('#show_image').html('');
            _link = $('input#image').val();
            if (_link.indexOf('[') == -1) {
                if (_link != '') {
                    $('#show_image').append('<image src="' + _link + '" class="img-thumbnail"/>');
                }
            } else {
                toast('warning', 'Vui lòng chọn 1 hình ảnh')
                $('#image').val('');
            }
        }

        function images() {
            $('#show_images').removeClass('d-none');
            _links = $('input#image_list').val();
            $('#show_images').html('');
            if (_links != '') {
                if (_links.indexOf('[') == -1) {
                    $('#show_images').append('<image src="' + _links + '" class="img-thumbnail m-2 w-25"/>');
                } else {
                    arrs = $.parseJSON(_links);
                    $.each(arrs, function(key, value) {
                        $('#show_images').append('<image src="' + value + '" class="img-thumbnail m-2 w-25"/>');
                    })
                }
            }
        }
        images()

        image()

        $('#file_image').on('hide.bs.modal', event => {
            image()
        })

        $('#imageList').on('hide.bs.modal', event => {
            images()
        })

        function toast(icon, message) {
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
            })

            Toast.fire({
                icon: icon,
                title: message
            })
        }
    </script>
    <script>
        var editor_config = {
            path_absolute: "/",
            selector: 'textarea.my-editor',
            relative_urls: false,
            plugins: [
                "advlist autolink lists link image charmap print preview hr anchor pagebreak",
                "searchreplace wordcount visualblocks visualchars code fullscreen",
                "insertdatetime media nonbreaking save table directionality",
                "emoticons template paste textpattern"
            ],
            toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media",
            file_picker_callback: function(callback, value, meta) {
                var x = window.innerWidth || document.documentElement.clientWidth || document.getElementsByTagName(
                    'body')[0].clientWidth;
                var y = window.innerHeight || document.documentElement.clientHeight || document
                    .getElementsByTagName('body')[0].clientHeight;

                var cmsURL = editor_config.path_absolute + 'laravel-filemanager?editor=' + meta.fieldname;
                if (meta.filetype == 'image') {
                    cmsURL = cmsURL + "&type=Images";
                } else {
                    cmsURL = cmsURL + "&type=Files";
                }

                tinyMCE.activeEditor.windowManager.openUrl({
                    url: cmsURL,
                    title: 'Filemanager',
                    width: x * 0.8,
                    height: y * 0.8,
                    resizable: "yes",
                    close_previous: "no",
                    onMessage: (api, message) => {
                        callback(message.content);
                    }
                });
            }
        };

        tinymce.init(editor_config);
    </script>
@endsection
