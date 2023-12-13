<?php

namespace App\Http\Controllers;

use App\Models\category;
use App\Models\item;
use App\Models\transaction;
use Illuminate\Http\Request;

class homecontroller extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $category = category::count();
        $item = item::count();
        $transdetail = transaction::count();
        return view('home', compact('category', 'item', 'transdetail'));
    }
}
