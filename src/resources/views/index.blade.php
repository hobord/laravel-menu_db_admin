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
                        <th>Updated</th>
                        <th>Created</th>
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

<div  ng-controller="menuCtrl">
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">Menu items</h3>
            <div class="box-tools pull-right">
                <!-- Buttons, labels, and many other things can be placed here! -->
                <a href="#" class="btn btn-success" ng-click="createMenuItem(1)">Create Menu Item</a>
            </div><!-- /.box-tools -->
        </div><!-- /.box-header -->
        <div class="box-body">
            <tree-dnd
                tree-data="menuItems"
                callbacks="callbacks"
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


    <!-- MenuItemEditModal -->
    <div id="menuItemEditModal" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Edit Menu item</h4>
                </div>
                <div class="modal-body">
                    @include('vendor.hobord.menu_db_admin.angular_menuitem')
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger pull-left" data-dismiss="modal" ng-click="deleteMenuItem(editMenuItem)">Delete</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-success" data-dismiss="modal" ng-click="saveMenuItem(editMenuItem)">Save</button>
                </div>
            </div>

        </div>
    </div><!-- /MenuItemEditModal -->
</div>

    @include('vendor.hobord.menu_db_admin.angular_menu_tree')
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
            };

            var saveMenuItem = function (item) {
                servicesHttpFacade.saveMenuItem(item).success(function (resultData, status, headers, config) {
                    getMenuItems($scope.currentMenuId);
                }).error(function (resultData, status, headers, config) {
                    console.error('Error data:', resultData);
                });
            };

            var deleteMenuItem = function (item_id) {
                servicesHttpFacade.deleteMenuItem(item_id).success(function (resultData, status, headers, config) {
                    getMenuItems($scope.currentMenuId);
                }).error(function (resultData, status, headers, config) {
                    console.error('Error data:', resultData);
                });
            };

            var saveAllMenuItems = function (items)  {
                servicesHttpFacade.saveAllMenuItems(items).success(function (resultData, status, headers, config) {
                    getMenuItems($scope.currentMenuId);
                }).error(function (resultData, status, headers, config) {
                    console.error('Error data:', resultData);
                });
            };

            var getPermissions = function () {
                servicesHttpFacade.getPermissions().success(function (resultData, status, headers, config) {
                    $scope.permissions = resultData;
                }).error(function (resultData, status, headers, config) {
                    console.error('Error data:', resultData);
                });
            };
            var convertTreeToFlat = function(tree)
            {
                var result = [];
                for(var i=0; i<tree.length; i++)
                {
                    console.log(tree[i]);
                    var item = angular.copy(tree[i]);
                    item.parent_id = tree[i]['__parent__'];
                    if(item.parent_id===0) item.parent_id=null;
                    delete item['__children__'];
                    delete item['__dept__'];
                    delete item['__hashKey__'];
                    delete item['__icon__'];
                    delete item['__index__'];
                    delete item['__index_real__'];
                    delete item['__level__'];
                    delete item['__parent__'];
                    delete item['__parent_real__'];
                    delete item['__uid__'];
                    delete item['__visible__'];
                    delete item['__expanded__'];
                    item['weight'] = i;

                    result.push(item);
                    if(tree[i]['__children__'].length>0) {
                        result = result.concat(convertTreeToFlat(tree[i]['__children__']));
                    }
                }
                return result;
            };

            $scope.col_defs = [
                {
                    field: "menu_text"
                }, {
                    displayName:  'Edit',
                    cellTemplate: '<button ng-click="openMenuItem(node)" class="btn btn-default btn-sm">Edit</button>'
                }];

            $scope.saveMenu =  function () {
                var items = convertTreeToFlat($scope.menuItems);
                saveAllMenuItems(items);
//                for(var i=0; i<items.length; i++) {
//                    saveMenuItem(items[i]);
//                }
            };

            $scope.createMenuItem = function (menu_id) {
                    var item = {
                        id : null,
                        parent_id : null,
                        menu_id:menu_id,
                        weight : -1,
                        unique_name: 'unique_name',
                        menu_text : "new menu item name",
                        parameters: {},
                        meta_data: {}
                    }
                $scope.openMenuItem(item);
            };

            $scope.openMenuItem = function (item) {
//                angular.copy(item, $scope.editMenuItem);
                $scope.editMenuItem = item;
                $('#menuItemEditModal').modal('show');
            };

            $scope.saveMenuItem = function (item) {
                saveMenuItem(item);
                $('#menuItemEditModal').modal('hide');
            };

            $scope.deleteMenuItem = function(item) {
                deleteMenuItem(item.id);
                $('#menuItemEditModal').modal('hide');
            };


            $scope.currentMenuId = 1;
            getMenuItems(1);
            getPermissions();
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

            var _saveMenuItem = function (item) {
                return $http.post('/admin/menu/item/api/'+item.id, item);
            };

            var _saveAllMenuItems = function (items) {
                return $http.post('/admin/menu/item/api/all', {'items':items});
            };

            var _deleteMenuItem = function (item_id) {
                return $http.get('/admin/menu/item/api/delete/'+item_id);
            };

            var _getPermissions = function (menu_id) {
                return $http.get('/admin/acl/api/permission/list');
            };

            return {
                getMenuItems: _getMenuItems,
                saveMenuItem: _saveMenuItem,
                saveAllMenuItems: _saveAllMenuItems,
                deleteMenuItem: _deleteMenuItem,

                getPermissions: _getPermissions
            }

        });

        myApp.run(function() {});
    </script>
@endsection