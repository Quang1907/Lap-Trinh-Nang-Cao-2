@extends('layouts.master')
@section('title', 'Categories')
@section('content')
    @include('layouts.inc.admin-title-header', [
        'name' => 'Account',
        'key' => 'Recycle bin',
    ])
    <div class="row">
        <div class="col-lg-12 grid-margin">
            <div class="card">
                <div class="m-2 col-sm-12">
                </div>
                <div class="card-body">
                    <a href="{{ route('account.index') }}" class="btn btn-primary float-end mb-3"><i class="fa-solid fa-backward"></i></a>
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
                                            <div class="d-flex">
                                                <form action="{{ route('account.restore', [$user]) }}" method="post"
                                                    class="px-2">
                                                    @csrf
                                                    @method('put')
                                                    <button class="btn btn-success btn-sm">Restore</button>
                                                </form>
                                                <form action="{{ route('account.clear', [$user]) }}" method="post">
                                                    @csrf
                                                    @method('delete')
                                                    <button class="btn btn-danger btn-sm">Clear</button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6">Not found</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                        <div class="m-4">
                            {{ $users->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')

@endsection
