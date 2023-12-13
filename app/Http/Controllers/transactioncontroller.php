<?php

namespace App\Http\Controllers;

use App\Models\cart;
use App\Models\item;
use App\Models\transaction;
use App\Models\transactiondetail;
use Illuminate\Http\Request;

class transactioncontroller extends Controller
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
        $item = Item::doesnthave('cart')->where('stock', '>', 0)->get();
        $carts = Item::has('cart')->get()->sortByDesc('cart.created_at');        
        return view('transaction', compact('item', 'carts'));
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

    public function checkout(request $request)
    {
        transaction::create([
            'user_id' => $request -> user_id,
            'date' => date("Y-m-d"),
            'total' => $request -> total,
            'pay_total' => $request -> pay_total,
        ]);

        foreach (cart::all() as $item){
            transactiondetail::create([
            'transaction_id'=> transaction::latest()->first()->id,
            'item_id'       => $item->item_id,
            'qty'           => $item->qty,
            'subtotal'      => $item->item->price * $item->qty
            ]);

        }
        cart::truncate();

        return redirect(route('transaction.show',transaction::latest()->first()->id));
    }

    public function history()
    {
        $transaksi = transaction::all();
        return view ('history', compact('transaksi'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        cart::create($request->all());

        return redirect()->back()->with('status', 'Item added to Cart');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $tran = transaction::find($id);
        $transaksi = transactiondetail::where('transaction_id', $tran->id)->get();
        return view('detailtransaction', compact('tran','transaksi'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        cart::findorfail($id)->update($request->all());
        return redirect()->back()->with('check', 'Item berhasil di edit');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $items=cart::findorfail($id);
        $items->delete();
        return redirect()->back()->with('status', 'Item removed from cart');
    }

    public function hapus($id)
    {
        $item=transaction::findorfail($id);
        $item->delete();
        return redirect('/history')->with('status', 'Berhasil Dihapus');
    }
}
