<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{
    Level,
    PriceLevel,
    Product
};

use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class PriceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if(!isset($request['_page'])) $request['_page'] = 1;
        if(!isset($request['_limit'])) $request['_limit'] = 10;
        $raw_products = PriceLevel::with('product', 'level')->orderBy('level_id', 'ASC')->get()->groupBy('product_id');
        $products = $raw_products->slice(((int)$request['_page'] * (int)$request['_limit']) - 10, (int)$request['_limit']);

        $customer_prices = PriceLevel::has('level')->whereHas('level', function($l){
            return $l->where('type',1);
        })->get();

        $total = $raw_products->count();
        $pagination = $this->pagination($total);

        return view('backend.price.index', compact('products', 'customer_prices', 'pagination'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   $assignedProducts = PriceLevel::select('product_id')->distinct()->get()->pluck('product_id');
        $products = Product::select('id', 'name')->whereNotIn('id',$assignedProducts)->get();
        $levels = Level::select('id', 'name')->where('status', 1)->get();

        return view('backend.price.create', compact('products', 'levels'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       
        $data = $request->all();
        $data_levels = Level::select('id')->where('status',1)->get();
        // dd($data_levels);
        $fields = [
            'product_id'=>'required',
        ];
        foreach ($data_levels as $key => $l) {
           $fields['price_'.$l->id] = 'required|numeric';
        }

        $this->validate($request,$fields, [
            'required' => 'This field cannot be null'
        ]);

        DB::beginTransaction();

        /**
         * Hapus dulus semua price level product
         */

         $priceLevels = [];

         foreach ($data as $key => $v) {
            if(str_contains($key, 'price_')) array_push($priceLevels,[
                'product_id' => $data['product_id'],
                'level_id' => explode('_',$key)[1],
                'price' => $v
            ]);
         }

        PriceLevel::where('product_id',$data['product_id'])->delete();
        
        if(PriceLevel::insert($priceLevels)){
            DB::commit();
            request()->session()->flash('success','Price Level Successfully updated');
        } else {
            DB::rollback();
            request()->session()->flash('error','Please try again!!');
        }


        return redirect()->route('price.index');

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
        $prices = PriceLevel::with('level')->where('product_id',$id)->get();
        $products = Product::where('status', 1)->get();

        $data = [
            'prices' => $prices,
            'products' => $products,
            'product_id' => $id
        ];
        
        return view('backend.price.edit', compact('data'));
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
        $data = $request->all();
        $data_levels = Level::select('id')->where('status',1)->get();
        
        $fields = [
            'product_id'=>'required',
        ];
        foreach ($data_levels as $key => $l) {
           $fields['price_'.$l->id] = 'required|numeric';
        }

        $this->validate($request,$fields, [
            'required' => 'This field cannot be null'
        ]);

        DB::beginTransaction();

        /**
         * Hapus dulus semua price level product
         */

         $priceLevels = [];

         foreach ($data as $key => $v) {
            if(str_contains($key, 'price_')) array_push($priceLevels,[
                'product_id' => $data['product_id'],
                'level_id' => explode('_',$key)[1],
                'price' => $v
            ]);
         }

        PriceLevel::where('product_id',$data['product_id'])->delete();
        
        if(PriceLevel::insert($priceLevels)){
            DB::commit();
            request()->session()->flash('success','Price Level Successfully updated');
        } else {
            DB::rollback();
            request()->session()->flash('error','Please try again!!');
        }

        // if(!isset($request['_page'])) $request['_page'] = 1;
        // if(!isset($request['_limit'])) $request['_limit'] = 10;
        // $raw_products = PriceLevel::with('product', 'level')->orderBy('level_id', 'ASC')->get()->groupBy('product_id');
        // $products = $raw_products->slice(((int)$request['_page'] * (int)$request['_limit']) - 10, (int)$request['_limit']);

        // $customer_prices = PriceLevel::has('level')->whereHas('level', function($l){
        //     return $l->where('type',1);
        // })->get();

        // $total = $raw_products->count();
        // $pagination = $this->pagination($total);

        // return view('backend.price.index', compact('products', 'customer_prices', 'pagination'));
        return redirect()->route('price.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $status = PriceLevel::where('product_id', $id)->delete($id);
        
        if($status){
            request()->session()->flash('success','Level successfully deleted');
        }
        else{
            request()->session()->flash('error','Error while deleting level');
        }
        return redirect()->route('price.index');
    }
}
