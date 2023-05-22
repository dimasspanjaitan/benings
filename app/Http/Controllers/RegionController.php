<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Region;

use Illuminate\Support\Str;

class RegionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $regions = Region::select("*");
        $regions = $this->filter($regions)->get();

        $total = Region::orderBy('created_at', 'ASC');
        $total = $this->filter($total,false)->count();
        $pagination = $this->pagination($total);

        return view('backend.region.index', compact('regions', 'pagination'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.region.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // return $request->all();
        $this->validate($request,[
            'status'=>'required|in:1,0',
            'name'=>'required|string',
            'description'=>'string|nullable',
        ],[
            'required' => 'This :attribute cannot be null',
            'string' => 'This :attribute must be a string'
        ]);
        $data = $request->all();

        $status = Region::create($data);
        if($status){
            request()->session()->flash('success','Region Successfully added');
        }
        else{
            request()->session()->flash('error','Please try again!!');
        }
        return redirect()->route('region.index');

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
        $region = Region::findOrFail($id);
        // return $items;
        return view('backend.region.edit', compact('region'));
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
        $region = Region::findOrFail($id);
        $this->validate($request,[
            'status'=>'required|in:1,0',
            'name'=>'required|string',
            'description'=>'string|nullable',
        ]);
        $data = $request->all();

        $status=$region->fill($data)->save();
        if($status){
            request()->session()->flash('success','Region Successfully updated');
        }
        else{
            request()->session()->flash('error','Please try again!!');
        }
        return redirect()->route('region.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $region = Region::findOrFail($id);
        $status = $region->delete();
        
        if($status){
            request()->session()->flash('success','Region successfully deleted');
        }
        else{
            request()->session()->flash('error','Error while deleting region');
        }
        return redirect()->route('region.index');
    }
}
