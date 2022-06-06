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
                <div class="m-2 col-sm-12 d-flex">
                    <form action="{{ route('products.index') }}" method="get">
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Search name product"
                                aria-label="Recipient's username" name="search" value="{{ request()->search }}">
                            <div class="input-group-append">
                                <button class="btn btn-sm btn-primary" type="submit">Search</button>
                            </div>
                        </div>
                    </form>
                    <div class="col-sm-9 float-end m-1">
                        <a href="{{ route('products.create') }}" class="btn btn-success btn-sm float-end"><i
                                class="fa-solid fa-square-plus"></i></a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="table_product" class="table table-striped">
                            <thead>
                                <tr>
                                    <th width="40px">ID</th>
                                    <th>Name</th>
                                    <th width="100px">Image</th>
                                    <th>Category name</th>
                                    <th width="100px">Status</th>
                                    <th width='100px' class="text-center">Active</th>
                                </tr>
                            </thead>
                            <tbody>
                                {{-- @php
                                    if (isset($_GET['page']) && $_GET['page'] != 1) {
                                        $id = $_GET['page'] * 5;
                                    } else {
                                        $id = 1;
                                    }
                                @endphp --}}
                                {{-- @forelse ($products as $product)
                                    <tr>
                                        <th class="py-0">{{ $id++ }}</th>
                                        <th>{{ $product->name }}</th>
                                        <th><img src="{{ asset($product->image) }}" class="img-thumbnail rounded" alt="">
                                        </th>
                                        <th>{{ $product->category->name }}</th>
                                        <th>
                                            @if ($product->status == 1)
                                                <span class="badge badge-success">Public</span>
                                            @else
                                                <span class="badge badge-danger">Private</span>
                                            @endif
                                        </th>
                                        <th>
                                            <form action="{{ route('products.destroy', $product) }}" method="post"
                                                id="form">
                                                @csrf
                                                @method('delete')
                                                <a href="{{ route('products.show', $product) }}"
                                                    class="btn btn-primary btn-sm">Detail</a>
                                                <a href="{{ route('products.edit', $product) }}"
                                                    class="btn btn-warning btn-sm">Edit</a>
                                                <a class="btn btn-danger btn-sm" onclick="toast()">Delete</a>
                                            </form>
                                        </th>
                                    </tr>
                                @empty
                                    <tr>
                                        <th colspan=" 6">No product
                                        </th>
                                    </tr>
                                @endforelse --}}
                            </tbody>
                        </table>
                        <div class="m-2">
                            {{-- {!! $products->appends(request()->all())->links() !!} --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        function toast() {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $('#form').submit();
                }
            })
        }
        $(document).ready(function() {
            $('#table_product').DataTable();
        });

        function allProducts() {
            $.ajax({
                type: 'GET',
                url: '/admin/allProducts',
                success: function(response) {
                    $('tbody').html('');
                    if (response.status == 200) {
                        var id = 1;
                        console.log(response.products.data);
                        $.each(response.products.data, function(key, value) {
                            var status = (value.status == 1) ?
                                '<label class="badge badge-success">Public</label>' :
                                '<label class="badge badge-danger">Private</label>'
                            console.log(status);

                            var link =
                                '<button class="btn btn-warning btn-rounded btn-sm edit_product" value="' +
                                value.id + '"><i class="fa-solid fa-pen-to-square"></i></button>' +
                                '<button class="btn btn-danger btn-rounded btn-sm mx-2 delete_product" value="' +
                                value.id + '"><i class="fa-solid fa-trash"></i></button>';
                            $('tbody').append('<tr>' +
                                '<td class="py-1">' + (id++) + '</td>' +
                                '<td class="py-1">' + value.name + '</td>' +
                                '<th><img src="' + value.image +
                                '" class="img-thumbnail rounded" alt=""></th>' +
                                '<td class="py-1">' + value.category_id + '</td>' +
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


        $(document).ready(function() {
            allProducts();
        })
    </script>

@endsection
