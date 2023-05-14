<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Level;

use Illuminate\Support\Str;

class LevelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $levels = Level::get();

        $total = Level::orderBy('created_at', 'ASC');
        $total = $this->filter($total,false)->count();
        $pagination = $this->pagination($total);

        return view('backend.level.index', compact('levels', 'pagination'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.level.create');
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
            'name'=>'string|required',
            'description'=>'string|nullable',
        ]);
        $data= $request->all();

        $status=Level::create($data);
        if($status){
            request()->session()->flash('success','Level Successfully added');
        }
        else{
            request()->session()->flash('error','Please try again!!');
        }
        return redirect()->route('level.index');

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
        $level = Level::findOrFail($id);
        // return $items;
        return view('backend.level.edit', compact('level'));
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
        $level = Level::findOrFail($id);
        $this->validate($request,[
            'status'=>'required|in:1,0',
            'name'=>'string|required',
            'description'=>'string|nullable',
        ]);
        $data= $request->all();

        $status=$level->fill($data)->save();
        if($status){
            request()->session()->flash('success','Level Successfully updated');
        }
        else{
            request()->session()->flash('error','Please try again!!');
        }
        return redirect()->route('level.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $level = Level::findOrFail($id);
        $status=$level->delete();
        
        if($status){
            request()->session()->flash('success','Level successfully deleted');
        }
        else{
            request()->session()->flash('error','Error while deleting level');
        }
        return redirect()->route('level.index');
    }
}
