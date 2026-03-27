<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;

class MenuController extends Controller
{
   public function index()
    {
        // Mengambil semua menu BESERTA data posisi dan parent-nya
        $menus = Menu::with(['positions', 'parent'])->get(); 
        
        return view('menu.index', compact('menus'));
    }
}