<?php

namespace App\Http\Controllers;
use App\Categori;
use App\Novosti;

use Illuminate\Http\Request;

class IndexController extends Controller
{
    //

    public function Show(){
        $news = Novosti::orderBy('created_at','DESC')->where('published','1')->paginate(5);
        return view('index', [
            'title'=>'Новости сайта',
            'news'=>$news,
        ]);
    }

}
