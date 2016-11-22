@extends('vendor.hobord.admin.layout.admin_layout')

@section('content_header')
    <h1>
        Menu Management
        <small>You can mage menus.</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{route('admin.index')}}"><i class="fa fa-dashboard"></i>Home</a></li>
        <li><a href="#" class="active"><i class="fa fa-sitemap"></i>Menu Management</a></li>
    </ol>
@endsection

@section('content')
    @parent


@endsection
