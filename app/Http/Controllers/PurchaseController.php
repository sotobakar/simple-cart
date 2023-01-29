<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PurchaseController extends Controller
{
    /**
     * User purchases page.
     * 
     */
    public function index(Request $request)
    {
        return view('purchases.index',[
            'purchases' => $request->user()->purchases()->orderBy('purchased_at', 'desc')->get()
        ]);
    }
}
