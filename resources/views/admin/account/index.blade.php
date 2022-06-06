@extends('layouts.master')
@section('title', 'Categories')
@section('content')
    @include('layouts.inc.admin-title-header', [
        'name' => 'Account',
        'key' => 'List',
    ])
    <div class="row">
        <div class="col-lg-12 grid-margin">
            <div class="card">
                <div class="m-2 col-sm-12">
                </div>
                <div class="card-body">
                    <a href="{{ route('account.recycle') }}" class="btn btn-primary float-end mb-3"><i
                            class="fa-solid fa-recycle"></i></a>
                    <div class="table-responsive table-info rounded">
                        <table class="table table-striped table-bordered table-hover">
                            <thead class="thead-inverse">
                                <tr>
                                    <th width="10px">ID</th>
                                    <th>Username</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    if (isset($_GET['page']) && $_GET['page'] != 1) {
                                        $id = $_GET['page'] * 5;
                                    } else {
                                        $id = 1;
                                    }
                                @endphp
                                @forelse ($users as $user)
                                    <tr>
                                        <td>{{ $id++ }}</td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>
                                            @if ($user->admin == true)
                                                <span class="badge badge-success">Admin</span>
                                            @else
                                                <span class="badge badge-primary">User</span>
                                            @endif
                                        </td>
                                        <td>
                                            <form action="{{ route('account.destroy', [$user]) }}" method="post">
                                                @csrf
                                                @method('delete')
                                                <button class="btn btn-danger btn-sm">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6">No User</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                        <div class="m-4">
                            {{ $users->links('vendor.pagination.pages') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')

@endsection
