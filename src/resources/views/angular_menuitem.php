<div class="form-group col-md-12">
    <label for="unique_name">Unique name</label>
    <input type="text" class="form-control" id="unique_name" ng-model="editMenuItem.unique_name" value="{{editMenuItem.unique_name}}">
</div>
<div class="form-group col-md-12">
    <label for="menu_text">Menu item text</label>
    <input type="text" class="form-control" id="menu_text" ng-model="editMenuItem.menu_text" value="{{editMenuItem.menu_text}}">
</div>
<!--<div class="form-group">-->
<!--    <label for="parameters">Parameters</label>-->
<!--    <input type="text" class="form-control" id="parameters" ng-model="editMenuItem.parameters" value="{{editMenuItem.parameters}}">-->
<!--</div>-->
<div class="form-group col-md-6">
    <label for="parameters.url">url</label>
    <input type="text" class="form-control" id="parameters.url" ng-model="editMenuItem.parameters.url" value="{{editMenuItem.parameters.url}}">
</div>
<div class="form-group col-md-6">
    <label for="parameters.route">route</label>
    <input type="text" class="form-control" id="parameters.route" ng-model="editMenuItem.parameters.route" value="{{editMenuItem.parameters.route}}">
</div>
<div class="form-group col-md-6">
    <label for="parameters.class">target</label>
    <input type="text" class="form-control" id="parameters.target" ng-model="editMenuItem.parameters.target" value="{{editMenuItem.parameters.target}}">
</div>
<div class="form-group col-md-6">
    <label for="parameters.class">class</label>
    <input type="text" class="form-control" id="parameters.class" ng-model="editMenuItem.parameters.class" value="{{editMenuItem.parameters.class}}">
</div>
<div class="form-group col-md-6">
    <label for="parameters.style">style</label>
    <input type="text" class="form-control" id="parameters.style" ng-model="editMenuItem.parameters.style" value="{{editMenuItem.parameters.style}}">
</div>
<div class="form-group col-md-6">
    <label for="parameters.onclick">onclick</label>
    <input type="text" class="form-control" id="parameters.onclick" ng-model="editMenuItem.parameters.onclick" value="{{editMenuItem.parameters.onclick}}">
</div>

<div class="form-group col-md-6">
    <label for="meta_data">Permission</label>
    <div>
        <input type="radio"
               ng-model="editMenuItem.meta_data.permission"
               value="null"
        >
        NONE
    </div>
    <select ng-model="editMenuItem.meta_data.permission" ng-init="permission = permission.name">
        <option ng-repeat="permission in permissions">
            {{permission.display_name}}
        </option>
    </select>
    <div ng-repeat="permission in permissions">
        <input type="radio"
               ng-model="editMenuItem.meta_data.permission"
               value="{{permission.name}}"
        >
        {{permission.display_name}}
    </div>
<!--    <input type="text" class="form-control" id="meta_data" ng-model="editMenuItem.meta_data" value="{{editMenuItem.meta_data}}">-->
</div>
<div class="form-group col-md-6">
    <label for="meta_data">Role</label>
<!--    <input type="text" class="form-control" id="meta_data" ng-model="editMenuItem.meta_data" value="{{editMenuItem.meta_data}}">-->
</div>