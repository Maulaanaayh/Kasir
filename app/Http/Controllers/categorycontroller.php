<?php

namespace App\Http\Controllers;

use App\Models\category;
use Illuminate\Http\Request;

class categorycontroller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     public function __construct()
     {
         $this->middleware('auth');
     }

    public function index()
    {
        $categories = category::all();
        return view('category', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $message=[
            'required' => ':attribute harus di isi',
            'min'      => ':attribute minimal :min karakter',
            'max'      => ':attribute maksimal :max karakter',
            'numeric'  => ':attribute harus berupa angka',
            'mimes'    => ':attribute harus berupa format gambar',
          ];
          $this->validate($request,[
              'name'   => 'required|min:1|max:30',

          ], $message);

        category::create([
            'name'=> $request->name
        ]);

       return redirect('/category')->with('status','Kategory Berhasil Ditambahkan');
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category=category::find($id);
        return view('editcategory', compact('category'));
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
        $message= [
            'required' => ':attribute harus di isi',
            'min'      => ':attribute minimal :min karakter',
            'max'      => ':attribute maksimal :max karakter',
            'numeric'  => ':attribute harus berupa angka',
            'mimes'    => ':attribute harus berupa format gambar',
          ];
          $this->validate($request,[
              'name'   => 'required|min:1|max:30',
          ], $message);
          $category = category::find($id);
          $category->update([
            'name'=> $request->name
        ]);

       return redirect('/category')->with('status','Berhasil Diedit');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category=category::find($id);
        $category->delete();
        return redirect('/category')->with('status','Berhasil Dihapus');
    }
}
