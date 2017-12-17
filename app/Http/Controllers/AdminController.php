<?php

namespace App\Http\Controllers;
use App\Categori;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    //
    public function Show(){
        return view('admin.admin',[
            'title' => 'Админка',
            'kolich' => Categori::count()
        ]);
    }
}
