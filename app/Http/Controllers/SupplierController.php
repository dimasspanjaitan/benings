<?php

namespace App\Http\Controllers;

use App\Models\{
    Supplier,
    Level
};
use Illuminate\Http\Request;
use App\Traits\UploadTrait;
use Illuminate\Support\Str;

class SupplierController extends Controller
{
    use UploadTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $suppliers = Supplier::with('levels')->orderBy('id','DESC');
        $suppliers = $this->filter($suppliers)->get();

        $total = Supplier::select('id')->orderBy('id', 'ASC');
        $total = $this->filter($total,false)->count();
        $pagination = $this->pagination($total);

        return view('backend.supplier.index', compact('suppliers', 'pagination'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $levels = Level::orderBy('id', 'ASC')->get();

        return view('backend.supplier.create', compact('levels'));
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
            'status' => 'required|in:0,1',
            'name' => 'required|string|max:50',
            'level_id' => 'required',
            'phone' => 'string|nullable',
            'email' => 'string|nullable',
            'address' => 'string|nullable',
            'description' => 'string|nullable',
        ],[
            'required' => 'This :attribute cannot be null',
            'string' => 'This :attribute must be string',
            'max' => 'This :attribute maximal 50 character'
        ]);
        $data = $request->all();

        $status = Supplier::create($data);
        if($status){
            request()->session()->flash('success','Supplier successfully added');
        }
        else{
            request()->session()->flash('error','Error occurred while adding supplier');
        }
        return redirect()->route('supplier.index');
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
        $supplier = Supplier::findOrFail($id);
        $levels = Level::orderBy('id', 'ASC')->get();

        return view('backend.supplier.edit', compact('supplier', 'levels'));
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
        $supplier = Supplier::findOrFail($id);
        $this->validate($request,[
            'status' => 'required|in:0,1',
            'name' => 'required|string|max:50',
            'level_id' => 'required',
            'phone' => 'string|nullable',
            'email' => 'string|nullable',
            'address' => 'string|nullable',
            'description' => 'string|nullable',
        ],[
            'required' => 'This :attribute cannot be null',
            'string' => 'This :attribute must be string',
            'max' => 'This :attribute maximal 50 character'
        ]);
        $data=$request->all();

        $status = $supplier->fill($data)->save();
        if($status){
            request()->session()->flash('success','Supplier successfully updated');
        }
        else{
            request()->session()->flash('error','Error occurred while updating supplier');
        }
        return redirect()->route('supplier.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $supplier = Supplier::findOrFail($id);
        $status=$supplier->delete();
        if($status){
            request()->session()->flash('success','Supplier successfully deleted');
        }
        else{
            request()->session()->flash('error','Error occurred while deleting supplier');
        }
        return redirect()->route('supplier.index');
    }
}
