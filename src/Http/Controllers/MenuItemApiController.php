<?php

namespace Hobord\MenuDbAdmin\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use Hobord\MenuDb\Menu;
use Hobord\MenuDb\MenuItem;

class MenuItemApiController extends Controller
{
    public function index($menu_id)
    {
        $menu_items = MenuItem::where('menu_id',$menu_id)->orderBy('parent_id')->orderBy('weight', 'asc')->get();
        return $menu_items;
    }

    public function get($item_id)
    {
        $menu_item = MenuItem::find($item_id);
        return $menu_item;
    }

    public function create(Request $request)
    {
        return MenuItem::create($request->all());
    }

    public function update(Request $request, $item_id = null)
    {
        if($request->get('id')) {
            $menu_item = MenuItem::find($item_id);
            // @var Hobord\MenuDb\MenuItem $menu_item
            $menu_item->fill($request->all());
            $menu_item->save();
        }
        else {
            $menu_item = MenuItem::create($request->all());
        }
        return $menu_item;
    }

    public function updateAll(Request $request)
    {
        $items = $request->get('items');
        if($items) {
            foreach ($items as $item) {
                $menu_item = MenuItem::find($item['id']);
                $menu_item->fill($item);
                $menu_item->save();
            }
        }
    }

    public function delete($item_id)
    {
        MenuItem::destroy($item_id);
    }
}