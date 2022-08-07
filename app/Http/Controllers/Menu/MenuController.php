<?php

namespace App\Http\Controllers\Menu;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MenuController extends Controller
{
    public function menu(){
        $userName = Auth::user()->name;

        return view('menu/menu')->with('userName',$userName);
    }
}
