<?php

namespace App\Http\Controllers;

use App\Models\category;
use App\Models\item;
use Illuminate\Http\Request;

class itemcontroller extends Controller
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
        $items = item::all();
        $categories = category::all();
        return view('item', compact('items', 'categories'));
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
        $message = [
            'required' => ':attribute harus di isi',
            'numeric'  => ':attribute harus berupa angka',
        ];
        $this->validate($request, [
            'category_id' => 'required',
            'name'   => 'required',
            'price'   => 'required',
            'stock'   => 'required',

        ], $message);
        item::create($request->all());

        return redirect('/item')->with('status', 'Berhasil Ditambahkan Ke Dashboard item');
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
        $item = Item::find($id);
        $categories = category::all();

        return view('edititem', compact('categories', 'item'));
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
        $message = [
            'required' => ':attribute harus di isi',
            'numeric'  => ':attribute harus berupa angka',
        ];
        $this->validate($request, [
            'category_id' => 'required',
            'name'   => 'required',
            'price'   => 'required',
            'stock'   => 'required',

        ], $message);

        Item::find($id)->update($request->all());
        return redirect('/item')->with('status', 'Berhasil Di edit');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Item::find($id)->delete();
        return redirect('/item')->with('status', 'Berhasil Dihapus');
    }
}
