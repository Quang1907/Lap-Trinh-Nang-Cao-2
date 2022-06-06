@extends('layouts.master')
@section('title', 'Categories')
@section('content')
    @include('layouts.inc.admin-title-header', ['name' => 'Category'])
    <div class="row">
        <div class="col-lg-12 grid-margin">
            <div class="card">
                <div class="d-flex m-4">
                    <input type="text" class="form-control col-sm-3 key" placeholder="Tim kiem">
                    <button class="btn btn-success search col-sm-2 rounded-0">Tim kiem</button>
                </div>
                <div class="m-2 col-sm-12">
                    <button type="button" class="btn btn-success btn-sm float-end reset" data-bs-toggle="modal"
                        data-bs-target="#create">
                        Create new a Category
                    </button>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Status</th>
                                    <th width='100px' class="text-center">Active</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <x-modal title="Create Category" name="create_name" button="btn-create" select="select_create" idModal="create" />
    <x-modal title="Edit Category" name="edit_name" button="btn-edit" select="select_edit" idModal="edit" />
@endsection

@section('js')
    <script>
        function toast(icon, title) {
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
                title: title
            })
        }

        function ajaxSetup() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        }

        function allCategory() {
            $.ajax({
                type: 'GET',
                url: '/admin/allCategory',
                success: function(response) {
                    console.log(response);
                    $('tbody').html('');
                    if (response.status == 200) {
                        var id = 1;
                        $.each(response.categories, function(key, value) {
                            var status = (value.status == 1) ?
                                '<label class="badge badge-success">Public</label>' :
                                '<label class="badge badge-danger">Private</label>'
                            var link =
                                '<button class="btn btn-warning btn-rounded btn-sm edit_category" value="' +
                                value.id + '"><i class="fa-solid fa-pen-to-square"></i></button>' +
                                '<button class="btn btn-danger btn-rounded btn-sm mx-2 delete_category" value="' +
                                value.id + '"><i class="fa-solid fa-trash"></i></button>';
                            $('tbody').append('<tr>' +
                                '<td class="py-1">' + (id++) + '</td>' +
                                '<td class="py-1">' + value.name + '</td>' +
                                '<td class="py-1">' + status + '</td>' +
                                '<td class="py-1">' + link + '</td>' +
                                '</tr>'
                            );
                        });
                    } else {
                        $('tbody').append('<tr><td colspan="4">' + response.error + '</td></tr>');
                    }
                }
            });
        }

        function recusive(categories, select, parent_id = 0, text = '') {
            $.each(categories, function(key, value) {
                if (value.parent_id == parent_id) {
                    let prefix = text + '--';
                    if (value.id != select) {
                        $('.select').append(
                            '<option value="' + value.id + '">' + prefix + value.name +
                            '</option>');
                    } else {
                        $('.select').append(
                            '<option value="' + value.id + '" selected>' + prefix + value.name +
                            '</option>');
                    }
                    recusive(categories, select, value.id, prefix);
                }
            });
        }

        function selectCategory(select = '') {
            $.ajax({
                type: 'GET',
                url: '/admin/allCategory',
                success: function(response) {
                    $('.select').html('')
                    if (response.status == 200) {
                        $('.select').append('<option selected value="0">New Category</option>')
                        recusive(response.categories, select);
                    } else {
                        $('.select').append('<option selected value="0">New Category</option>')
                    }
                }
            });
        }

        $(document).ready(function() {
            allCategory()
            ajaxSetup()

            $(document).on('click', '.btn-create', function(e) {
                e.preventDefault();
                $('#alert').addClass('d-none');
                var data = {
                    'name': $('#create_name').val(),
                    'parent_id': $('.select').val(),
                };
                $.ajax({
                    type: 'POST',
                    url: '/admin/categories',
                    data: data,
                    dataType: "json",
                    success: function(response) {
                        if (response.status == 400) {
                            $('#alert').html('');
                            $('#alert').removeClass('d-none');
                            $('#alert').append('<strong>' + response.error.name +
                                '</strong>');
                        } else {
                            allCategory()
                            selectCategory()
                            $('#create').modal('hide');
                            $('#create').find('input').val('');
                            toast('success', response.message);
                        }
                    }
                });
            });

            $(document).on('click', '.delete_category', function(e) {
                e.preventDefault()
                Swal.fire({
                    title: 'Bạn có chắc không?',
                    text: "Vui lòng xác thực",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            type: 'DELETE',
                            url: '/admin/categories/' + $(this).val(),
                            dataType: 'json',
                            success: function(response) {
                                allCategory();
                                selectCategory();
                                if (response.status == 200) {
                                    toast('success', response.message);
                                } else {
                                    toast('error', response.error);
                                }
                            }
                        });
                    }
                })
            })

            $(document).on('click', '.edit_category', function(e) {
                $('.id_hidden').val($(this).val())
                $.ajax({
                    type: 'GET',
                    url: '/admin/categories/' + $(this).val(),
                    success: function(response) {
                        selectCategory(response.category.parent_id);
                        $('#edit').modal('show');
                        $('#edit_name').val(response.category.name);
                        $('.status').removeClass('d-none');
                        if (response.category.status == 1) {
                            $(".public").prop("checked", true);
                        } else {
                            $(".private").prop("checked", true);
                        }
                    }
                });

            })

            $(document).on('click', '.search', function(e) {
                var data = {
                    'search': $('.key').val()
                };

                $.ajax({
                    type: 'GET',
                    data: data,
                    url: '/admin/categories/search/' + $('.key').val(),
                    dataType: 'json',
                    success: function(response) {
                        $('tbody').html('');
                        if (response.status == 200) {
                            var id = 1;
                            $.each(response.categories, function(key, value) {
                                var status = (value.status == 1) ?
                                    '<label class="badge badge-success">Public</label>' :
                                    '<label class="badge badge-danger">Private</label>'
                                var link =
                                    '<button class="btn btn-warning btn-rounded btn-sm edit_category" value="' +
                                    value.id +
                                    '"><i class="fa-solid fa-pen-to-square"></i></button>' +
                                    '<button class="btn btn-danger btn-rounded btn-sm mx-2 delete_category" value="' +
                                    value.id +
                                    '"><i class="fa-solid fa-trash"></i></button>';
                                $('tbody').append('<tr>' +
                                    '<td class="py-1">' + (id++) + '</td>' +
                                    '<td class="py-1">' + value.name + '</td>' +
                                    '<td class="py-1">' + status + '</td>' +
                                    '<td class="py-1">' + link + '</td>' +
                                    '</tr>'
                                );
                            });
                        } else {
                            allCategory()
                        }
                    }
                });

            })

            $(document).on('click', '.btn-edit', function(e) {
                var data = {
                    'id': $('.id_hidden').val(),
                    'name': $('#edit_name').val(),
                    'status': $('input:radio[name=status]:checked').val(),
                };
                $.ajax({
                    type: 'PUT',
                    url: '/admin/categories/' + $('.id_hidden').val(),
                    data: data,
                    dataType: 'json',
                    success: function(response) {
                        if (response.status == 200) {
                            $('#edit').modal('hide');
                            allCategory();
                            toast('success', response.message)
                        } else {
                            toast('warning', response.error.name)
                        }

                    }
                });
            })

            $('.reset').click(
                function(e) {
                    e.preventDefault()
                    selectCategory();
                    $('#alert').html('');
                    $('#alert').addClass('d-none');
                    $('.status').addClass('d-none');
                }
            )
        });
    </script>
@endsection
