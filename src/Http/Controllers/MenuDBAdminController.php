<?php

namespace Hobord\MenuDbAdmin\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use Redirect;
use Menu;
use Hobord\MenuDb;

class MenuDBAdminController extends Controller
{
    public function index()
    {
        $menu = Menu::get('admin.left_side');
        $menu->item('admin.structure.menu')->activate();

        return view('vendor.hobord.menu_db_admin.index');
    }
}