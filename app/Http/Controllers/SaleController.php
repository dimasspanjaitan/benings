<?php

namespace App\Http\Controllers;

use App\Libraries\ApiResponse;
use Illuminate\Http\Request;
use App\Models\Sale;

class SaleController extends Controller
{
    public function index(Request $request)
    {
        $sales = Sale::with('user', 'details', 'details.product', 'details.product.category')->orderBy('created_at', 'ASC');
        $sales = $this->filter($sales)->get()->map(function($row){
            $row->class = config('benings.sale_types')[$row->status]['class'];
            return $row;
        });

        $total = Sale::orderBy('created_at', 'ASC');
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

}
