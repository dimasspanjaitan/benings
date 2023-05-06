<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sale;

class SaleController extends Controller
{
    public function index(Request $request)
    {
        if(!isset($request['_page'])) $request['_page'] = 0;
        $sales = Sale::with('user', 'details', 'details.product', 'details.product.category')->orderBy('created_at', 'ASC');
        $sales = $this->filter($sales)->get();

        $total = Sale::orderBy('created_at', 'ASC');
        $total = $this->filter($total,false)->count();

        // dd($sales->where('id', 1)->first());

        return view('backend.sale.index', compact('sales','total'));
    }

}
