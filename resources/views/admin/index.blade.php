@extends('layouts.master')
@section('title', 'Admin')

@section('content')
    @include('layouts.inc.admin-title-header', [
        'name' => 'Admin',
        'key' => 'Dasboard',
    ])
@endsection
