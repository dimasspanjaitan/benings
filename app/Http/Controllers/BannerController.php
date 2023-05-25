<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Banner;
use App\Traits\UploadTrait;
use Illuminate\Support\Str;

class BannerController extends Controller
{
    use UploadTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $banners = Banner::orderBy('id','DESC');
        $banners = $this->filter($banners)->get();

        $total = Banner::select('id')->orderBy('created_at', 'ASC');
        $total = $this->filter($total,false)->count();
        $pagination = $this->pagination($total);

        return view('backend.banner.index', compact('banners', 'pagination'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.banner.create');
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
            'title' => 'required|string|max:50',
            'description' => 'string|nullable',
            'photo' => 'required',
            'status' => 'required|in:1,0',
        ],[
            'required' => 'This :attribute cannot be null',
            'string' => 'This :attribute must be string',
            'max' => 'This :attribute maximal 50 character'
        ]);
        $data=$request->all();
        $slug=Str::slug($request->title);
        $count=Banner::where('slug',$slug)->count();
        if($count>0){
            $slug=$slug.'-'.date('ymdis').'-'.rand(0,999);
        }
        $data['slug']=$slug;

        if (isset($data['photo'])) {
            $propImages = $this->uploadImage($request,[
                'file' => 'photo',
                'size' => [1200,809],
                'path' => 'uploads/banners',
                'permission' => 777
    
            ]);
            $data['photo'] = $propImages['path'];
        }

        $status=Banner::create($data);
        if($status){
            request()->session()->flash('success','Banner successfully added');
        }
        else{
            request()->session()->flash('error','Error occurred while adding banner');
        }
        return redirect()->route('banner.index');
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
        $banner = Banner::findOrFail($id);
        $banner->photo = explode('/', $banner->photo)[count(explode('/',$banner->photo)) -1];

        return view('backend.banner.edit', compact('banner'));
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
        $banner=Banner::findOrFail($id);
        $this->validate($request,[
            'title'=>'required|string|max:50',
            'description'=>'string|nullable',
            'status'=>'required|in:1,0',
        ],[
            'required' => 'This :attribute cannot be null',
            'string' => 'This :attribute must be string',
            'max' => 'This :attribute maximal 50 character'
        ]);
        $data=$request->all();

        $old_image = explode('/', $banner->photo)[count(explode('/',$banner->photo)) -1];
        if (!empty($data['photo'])) {
            if (!empty($banner->photo)) {
                if(file_exists(public_path('uploads/banners').DIRECTORY_SEPARATOR.$old_image)){
                    unlink(public_path('uploads/banners').DIRECTORY_SEPARATOR.$old_image);
                }
            }
            $propImages = $this->uploadImage($request,[
                'file' => 'photo',
                'size' => [1200,809],
                'path' => 'uploads/banners',
                'permission' => 777
    
            ]);
            $data['photo'] = $propImages['path'];
        } else {
            $data['photo'] = $banner->photo;
        }

        $status=$banner->fill($data)->save();
        if($status){
            request()->session()->flash('success','Banner successfully updated');
        }
        else{
            request()->session()->flash('error','Error occurred while updating banner');
        }
        return redirect()->route('banner.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $banner=Banner::findOrFail($id);
        $status=$banner->delete();
        if($status){
            request()->session()->flash('success','Banner successfully deleted');
        }
        else{
            request()->session()->flash('error','Error occurred while deleting banner');
        }
        return redirect()->route('banner.index');
    }
}
