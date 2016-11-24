
<script type="text/ng-template" id="tree-dnd-template-render.html">
    <div>
        <ul tree-dnd-nodes style="min-height: 100px">
            <li tree-dnd-node="node"
                ng-repeat="node in treeData track by node.__hashKey__"
                ng-include="'tree-dnd-template-fetch.html'">
            </li>
        </ul>
    </div>
</script>

<script type="text/ng-template" id="tree-dnd-template-fetch.html">
    <div class="list-group-item" ng-click="onClick(node)">
        <a class="btn btn-default pull-left" aria-label="Justify" type="button" tree-dnd-node-handle>
            <span class="glyphicon glyphicon-align-justify" aria-hidden="true"></span>
        </a>
        <div>
            <span ng-repeat="col in colDefinitions"
                  compile="col.cellTemplate"
                  ng-bind-html="node[col.field]"
                  style="display: inline-block; margin-left: 20px;">
            </span>
        </div>
    </div>
    <ul tree-dnd-nodes>
        <li tree-dnd-node="node"
            ng-repeat="node in node.__children__ track by node.__hashKey__"
            ng-include="'tree-dnd-template-fetch.html'">
        </li>
    </ul>
</script>