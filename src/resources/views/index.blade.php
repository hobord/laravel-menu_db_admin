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
    <form action="{{route('admin.menu')}}" method="post">{{ csrf_field() }}
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">Menus</h3>
                <div class="box-tools pull-right">
                    <!-- Buttons, labels, and many other things can be placed here! -->
                    <a href="{{route('admin.menu')}}" class="btn btn-success">Create Menu</a>
                </div><!-- /.box-tools -->
            </div><!-- /.box-header -->
            <div class="box-body">
                <table class="table table-striped table-condensed">
                    <thead>
                    <tr>
                        <th>Name</th>
                        <th>Machine name</th>
                        <th>Description</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($menus as $menu)
                        <tr>
                            <td><i class="fa fa-sitemap"></i> {{$menu->display_name}}</td>
                            <td>{{$menu->machine_name}}</td>
                            <td>{{$menu->description}}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div><!-- /.box-body -->
            <div class="box-footer text-right">

            </div><!-- box-footer -->
        </div><!-- /.box -->
    </form>

@endsection
