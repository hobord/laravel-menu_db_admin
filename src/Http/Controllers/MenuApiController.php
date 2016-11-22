<?php

namespace Hobord\MenuDbAdmin\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use Hobord\MenuDb\Menu;

class MenuApiController extends Controller
{
    public function index()
    {
        $menus = Menu::all();
        return $menus;
    }
    public function get($menu_id)
    {
        $menu = Menu::find($menu_id);
        return $menu;
    }
    public function create(Request $request)
    {
        Menu::create($request->all());
    }

    public function update(Request $request, $menu_id)
    {
        $menu = Menu::find($menu_id);
        // @var Hobord\MenuDb\Menu $menu
        $menu->fill($request->all());
        $menu->save();
    }

    public function delete($menu_id)
    {
        Menu::destroy($menu_id);
    }
}