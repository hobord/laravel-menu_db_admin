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
    <!--
    <pre><?php
        //print_r(Menu::get('admin.left_side')->all());
            ?>
    </pre>
    <ol id="dndmenu">
    {!! Menu::get('admin.left_side')->render('ol',null,['class'=>"treeview-menu"]) !!}
    </ol>-->
<div ng-app="myApp">
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
                        <th>Created</th>
                        <th>Updated</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($menus as $menu)
                        <tr>
                            <td><i class="fa fa-sitemap"></i> {{$menu->display_name}}</td>
                            <td>{{$menu->machine_name}}</td>
                            <td>{{$menu->description}}</td>
                            <td>{{$menu->updated_at}}</td>
                            <td>{{$menu->created_at}}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div><!-- /.box-body -->
            <div class="box-footer text-right">

            </div><!-- box-footer -->
        </div><!-- /.box -->
    </form>
    <div class="box" ng-controller="menuCtrl">
        <div class="box-header with-border">
            <h3 class="box-title">Menu items</h3>
            <div class="box-tools pull-right">
                <!-- Buttons, labels, and many other things can be placed here! -->
                <a href="{{route('admin.menu')}}" class="btn btn-success">Create Menu Item</a>
            </div><!-- /.box-tools -->
        </div><!-- /.box-header -->
        <div class="box-body">
            <tree-dnd
                tree-data="menuItems"
                primary-key="id"
                parent-key="parent_id"
                tree-control="my_tree"
                template-url="tree-dnd-template-render.html"
                column-defs="col_defs"
                drag-enabled="true"
                enable-drag="true"
                enable-drop="true"
            >

        </div><!-- /.box-body -->
        <div class="box-footer text-right">
            <button type="button" class="btn btn-success" ng-click="saveMenu()">Save</button>
        </div><!-- box-footer -->
    </div><!-- /.box -->
    @include('vendor.hobord.menu_db_admin.angular_template')
</div>
@endsection
@section('header_styles')
    <link rel="stylesheet" href="/hobord-admin/bower_components/angular-tree-dnd/dist/ng-tree-dnd.min.css">
@endsection

@section('footer_scripts')
    <script src="/hobord-admin/bower_components/angular/angular.min.js"></script>
    <script src="/hobord-admin/bower_components/angular-sanitize/angular-sanitize.min.js"></script>
    <script src="/hobord-admin/bower_components/angular-tree-dnd/dist/ng-tree-dnd.js"></script>

    <script>


        var menuCtrl = angular.module('menuCtrl', []);

        menuCtrl.controller('menuCtrl', ['$scope', '$http', 'servicesHttpFacade', '$TreeDnDConvert', function ($scope, $http, servicesHttpFacade, $TreeDnDConvert) {
            var getMenuItems = function (menu_id) {
                servicesHttpFacade.getMenuItems(menu_id).success(function (resultData, status, headers, config) {

                    $scope.menuItems = $TreeDnDConvert.line2tree(resultData, 'id', 'parent_id');;

                }).error(function (resultData, status, headers, config) {
                    console.error('Error data:', resultData);
                });
            }
            $scope.col_defs = [
                {
                    field: "menu_text"
                }, {
                    displayName:  'Edit',
                    cellTemplate: '<button ng-click="tree.addFunction(node)" class="btn btn-default btn-sm">Edit</button>'
                }, {
                    displayName:  'Delete',
                    cellTemplate: '<button ng-click="tree.remove_node(node)" class="btn btn-default btn-sm">Delete</button>'
                }];
            $scope.saveMenu =  function () {
                console.log($scope.menuItems);
            };

            getMenuItems(1);
        }]);

        var myApp = angular.module('myApp', [
                    'ngSanitize',
                    'ntt.TreeDnD',
                    'menuCtrl'
                ],
                function ($interpolateProvider) {
//                    $interpolateProvider.startSymbol('<%');
//                    $interpolateProvider.endSymbol('%>');
                }).controller('controller', ['$scope', function ($scope) {

        }]);

        myApp.filter('range', function() {
            return function(n) {
                var res = [];
                for (var i = 0; i < n; i++) {
                    res.push(i);
                }
                return res;
            };
        });

        myApp.service("servicesHttpFacade", function ($http) {

            var _getMenuItems = function (menu_id) {
                return $http.get('/admin/menu/item/api/list/'+menu_id);
            };

            return {
                getMenuItems: _getMenuItems
            }

        });

        myApp.run(function() {});
    </script>
@endsection