<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{
    Product,
    Purchase,
    PurchaseDetail,
    Supplier
};
use Carbon\Carbon;

class PurchaseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        
        // if(!isset($request['_page'])) $request['_page'] = 0;
        $purchases = PurchaseDetail::with('purchase', 'product', 'purchase.supplier')->orderBy('id', 'DESC')->get();
        // dd($purchases);
        // $purchases = $this->filter($products)->get();

        // $total = PurchaseDetail::select('id');
        // $total = $this->filter($total,false)->count();
        // $pagination = $this->pagination($total);

        return view('backend.purchase.index', compact('purchases'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $products = Product::where('status',1)->get();
        $suppliers = Supplier::where('status', 1)->get();

        return view('backend.purchase.create', compact('products', 'suppliers'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $this->validate($request,[
            'product_id'=>'required|integer',
            'qty'=>'required|integer',
            'price'=>'required|integer',
            'supplier_id'=>'required|integer',
            'recipient'=>'required|string'
        ],[
            'required' => 'This :attribute cannot be null',
            'string' => 'This :attribute must be string',
            'integer' => 'This :attribute must be number'
        ]);

        $data = $request->all();
        $now = Carbon::now();
        $now->setTimezone(config('app.timezone'));

        $amount = (int) $data['qty'] * (int) $data['price'];

        $purchase['supplier_id'] = $data['supplier_id'];
        $purchase['purchase_date'] = $now->format('Y-m-d H:i:s');
        $purchase['recipient'] = $data['recipient'];
        $purchase['amount'] = $amount;
        $purchase['description'] = $data['description'];
        $status_purchase = Purchase::create($purchase);

        $detail['purchase_id'] = $status_purchase->id;
        $detail['product_id'] = $data['product_id'];
        $detail['qty'] = $data['qty'];
        $detail['price'] = $data['price'];
        $status_detail = PurchaseDetail::create($detail);

        
        if($status_purchase && $status_detail){
            request()->session()->flash('success','Product Successfully purchased');
        }
        else{
            request()->session()->flash('error','Please try again!!');
        }
        return redirect()->route('purchase.index');

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
        // 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
