@extends('layouts.master')
@section('title', 'File manager')

@section('content')
    <iframe src="{{ asset('file/dialog.php') }}" frameborder="0" class="w-100" height="400px"></iframe>
@endsection
