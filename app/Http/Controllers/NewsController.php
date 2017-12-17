<?php

namespace App\Http\Controllers;

use App\Novosti;
use App\Categori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function index()
    {
        //
//        $news = Categori::find($id)->Novostis;
        if(Auth::user()->role == 'admin'){
            $news = Novosti::orderBy('created_at','DESC')->paginate(10);
            return view('admin.news', [
                'title'=>'Новости',
                'categorii'=>Categori::all(),
                'news'=>$news,
            ]);
        }else{
            $news = Novosti::orderBy('created_at','DESC')->where('published','1')->paginate(10);
            return view('index', [
                'title'=>'Новости сайта',
                'categorii'=>Categori::all(),
                'news'=>$news,
            ]);
        }

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $categorii = Categori::all();
        return view('admin.createNew', [
            'title'=>'Создание новости',
            'categorii'=>$categorii
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //

        $this->validate($request,[
//            'namenew'=> 'required|max:15',
//            'shorttext'=> 'required|alpha',
//            'fultext'=> 'required|alpha',
            'file'=>'image',
        ]);

        if($request->hasFile('file')){
            $file = $request->file('file');
            $file->move(public_path().'/image',$file->getClientOriginalName());

            $Novosti = new Novosti;
            $Novosti->namenew = $request->input('namenew');
            $Novosti->shorttext = $request->input('shorttext');
            $Novosti->fultext = $request->input('fultext');
            if(Auth::user()->role == 'admin'){
                $published = 1;
            } else{
                $published = 0;
            }
            $Novosti->published = $published;
            $Novosti->categoris_id = $request->input('categoris_id');
            $Novosti->foto = $file->getClientOriginalName();
            $Novosti->AddUser = Auth::user()->name;
            $Novosti->save();
            return redirect()->route('news.index');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Novosti $novosti)
    {
        //
//        $novos = Novosti::Find($id);
        return view('layouts.new',[
           'title' => 'Новость',
           'novos'=> $novosti
        ]);
//        echo $novost;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  App\Novosti
     * @return \Illuminate\Http\Response
     */
    public function edit(Novosti $news)
    {
        //
//        echo  $news;
//        $news = Novosti::Find($news)->categories;
        return view('admin.modal', [
            'title'=>'Изменение новости',
            'news'=>$news,
            'categorii'=> Categori::all()
        ]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
            $this->validate($request, [
//            'namenew'=> 'required|max:15',
//            'shorttext'=> 'required|alpha',
//            'fultext'=> 'required|alpha',

                'file' => 'image',


            ]);

            $news = Novosti::Find($id);
            if($news->published == 0){
                $news->published = '1';
                $news->save();
                return redirect()->route('news.index');
            }
            else{
                $news->namenew = $request->input('namenew');
                $news->shorttext = $request->input('shorttext');
                $news->fultext = $request->input('fultext');
                $news->categoris_id = $request->input('categoris_id');
                if($request->hasFile('file')) {
                    $file = $request->file('file');
                    $file->move(public_path() . '/image', $file->getClientOriginalName());
                    $news->foto = $file->getClientOriginalName();
                }
//                $news->AddUser = Auth::user()->name;
                $news->save();

                return redirect()->route('news.index');
            }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Novosti $news)
    {
//        $new = Novosti::Find($id);
        $news->delete();
        return redirect()->route('news.index');
    }
}
