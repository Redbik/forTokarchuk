<?php

namespace App\Http\Controllers;

use App\Categori;
use App\Novosti;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //

        return view('admin.categories',[
            'categories' => Categori::paginate(5),
            'title' => 'Категории',
            'kolich' => Categori::count()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.createCategories', [
                'category' =>[],
                'title' => 'Создание категории'
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
            'name' => 'required|max:25|alpha'
         ]);
        Categori::create($request->all());
        return redirect()->route('category.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  App\Categori
     * @return \Illuminate\Http\Response
     */
    public function edit(Categori $category)
    {
        //
//        echo $category;
        return view('admin.editCategories', [
            'category' => $category,
            'title' => 'Редактирование категории'
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  App\Categori
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Categori $category)
    {
        //
        $this->validate($request,[
            'name' => 'required|max:25|alpha'
        ]);
        $category->update($request->all());
        return redirect()->route('category.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  App\Categori
     * @return \Illuminate\Http\Response
     */
    public function destroy(Categori $category)
    {
        if(Novosti::where('categoris_id',$category->id)->count() > 0){
            $test = Novosti::where('categoris_id',$category->id)->get();
            foreach ($test as $tes){
                $news = Novosti::Find($tes->id);
                $news->categoris_id = null;
                $news->save();
            }
        }
        $category->delete();
        return redirect()->route('category.index');
    }
}
