<?php

namespace App\Http\Controllers;

use App\Libraries\ApiResponse;
use Illuminate\Http\Request;
use App\Models\{
    Sale,
    Cart,
    SaleDetail,
    Settings
};
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Btx\Common\SpellNumber;

class SaleController extends Controller
{
    public function index(Request $request)
    {
        $sales = Sale::with('user', 'details', 'details.product', 'details.product.category')->orderBy('created_at', 'ASC');
        $sales = $this->filter($sales)->get()->map(function($row){
            $row->class = config('benings.sale_types')[$row->status]['class'];
            return $row;
        });

        $total = Sale::selec('id')->orderBy('id', 'ASC');
        $total = $this->filter($total,false)->count();
        $pagination = $this->pagination($total);

        return view('backend.sale.index', compact('sales','pagination'));
    }

    public function changeStatus(Request $request){
        // dd($request->all());
        $data = $request->all();
        // dd(isset($data['id']));
        if(!isset($data['id'])) return $this->response400('ID tidak boleh kosong');
        if(!isset($data['status'])) return $this->response400('Status tidak boleh kosong');

        $sale = Sale::where('id', $data['id'])->first();
        if(empty($sale)) return $this->response400('Data tidak ditemukan');

        $sale->status = $data['status'];
        if($sale->save()){
            return ApiResponse::make(200, 'Status berhasil diganti', $sale);
        }else{
            return $this->response400('Status gagal diubah');
        };
    }

    public function process(Request $request){
        $data = $request->all();
        $user = auth()->user();
        $now = Carbon::now();
        $now->setTimezone(config('app.timezone'));

        DB::beginTransaction();
        $this->validate($request,[
            'name'=>'string|required',
            'address'=>'string|required',
            'phone'=>'numeric|required',
            'email'=>'string|required'
        ]);
        $query = ['user_id' => $user->id,'sale_id' => null];
        $carts = Cart::where($query)->get();
        if(count($carts) <= 0){
            request()->session()->flash('error','Cart is Empty !');
            return back();
        }

        $total = 0;
        $preInsertDetails = [];
        foreach ($carts as $cart) {
            $total += (double) $cart->amount;
        }

        $preInsertSale = [
            'user_id' => $user->id,
            'name' => $data['name'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'address' => $data['address'],
            'total' => $total,
            'sale_date' => $now->format('Y-m-d H:i:s'),
            'code' => 'BNGDISTMDN-'.strtotime($now->format('Y-m-d H:i:s'))
        ];

        $sale = Sale::create($preInsertSale);
        if(empty($sale)) {
            DB::rollback();
            request()->session()->flash('error','Please try again!!');
        }

        foreach ($carts as $cart) {
            array_push($preInsertDetails, [
                'sale_id' => $sale->id,
                'product_id' => $cart->product_id,
                'qty' => $cart->qty,
                'price' => $cart->price
            ]);
        }
        if(!SaleDetail::insert($preInsertDetails)) {
            DB::rollback();
            request()->session()->flash('error','Please try again!!');
        }

        if(!Cart::where($query)->update(['sale_id' => $sale->id])) {
            DB::rollback();
            request()->session()->flash('error','Please try again!!');
        }else{
            DB::commit();
        }
        
        return redirect()->route('shipping');
    }

    public function shipping(Request $request){
        $user = auth()->user();
        $sales = Sale::with('details', 'details.product')->where('user_id', $user->id)->orderBy('id', 'desc')->get();
        // dd($sales);
        $confirms = [];
        $processeds = [];
        $shippeds = [];
        $succeeds = [];
        $canceleds = [];
        
        foreach ($sales as $sale) {
            if($sale->status == 1) array_push($confirms, $sale);
            if($sale->status == 2) array_push($processeds, $sale);
            if($sale->status == 3) array_push($shippeds, $sale);
            if($sale->status == 4) array_push($succeeds, $sale);
            if($sale->status == 5) array_push($canceleds, $sale);
        }
        // dd($processeds);

        return view('frontend.pages.shipping', compact('sales', 'confirms', 'processeds', 'shippeds', 'succeeds', 'canceleds'));
    }
    
    public function invoice(Request $request, $id)
    {
        $user = auth()->user();
        $setting = Settings::where('id', 1)->first();
        $sale = Sale::with('details', 'details.product')->where('user_id', $user->id)->where('id', $id)->first();
        $sale->details = $sale->details->map(function($d){
            return [
                'product_name' => $d->product->name,
                'summary' => $d->product->summary,
                'qty' => $d->qty,
                'unit' => $d->unit,
                'price' => $d->price,
                'sub_total' => (int) $d->qty * (double) $d->price
            ];
        });
        $sale->status = config('benings.sale_types')[$sale->status];
        $sale->terbilang = ucwords(SpellNumber::generate($sale->total));
        
        // dd($sale);

        return view('frontend.pages.invoice', compact('sale', 'setting'));
    }
}
