<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{
    Product,
    Category
};
use App\Traits\UploadTrait;

use Illuminate\Support\Str;

class ProductController extends Controller
{
    use UploadTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if(!isset($request['_page'])) $request['_page'] = 0;
        $products = Product::with('category');
        $products = $this->filter($products)->get();

        $total = Product::orderBy('created_at', 'ASC');
        $total = $this->filter($total,false)->count();
        $pagination = $this->pagination($total);

        return view('backend.product.index', compact('products', 'pagination'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories=Category::where('status',1)->get();
        return view('backend.product.create', compact('categories'));
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
            'name'=>'required',
            'summary'=>'required|string',
            'description'=>'nullable|string',
            'product_type'=>'integer|nullable',
            'category_id'=>'required|exists:categories,id',
            'min_order'=>'integer|nullable',
            'weight' => 'integer|nullable',
            'photo' => 'required'
        ],[
            'required' => 'This :attribute cannot be null',
            'string' => 'This :attribute must be string',
            'max' => 'This :attribute maximal 50 character',

        ]);

        // dd($request->file('photo'));
        $data=$request->all();
        $slug=Str::slug($request->name);
        $count=Product::where('slug',$slug)->count();
        if($count>0){
            $slug=$slug.'-'.date('ymdis').'-'.rand(0,999);
        }
        $data['slug']=$slug;

        if (isset($data['photo'])) {
            $propImages = $this->uploadImage($request,[
                'file' => 'photo',
                'size' => [500,500],
                'path' => 'uploads/products',
                'permission' => 777
    
            ]);
            $data['photo'] = $propImages['path'];
        }

        $status=Product::create($data);
        if($status){
            request()->session()->flash('success','Product Successfully added');
        }
        else{
            request()->session()->flash('error','Please try again!!');
        }
        return redirect()->route('product.index');

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
        $product = Product::findOrFail($id);
        $product->photo = explode('/', $product->photo)[count(explode('/',$product->photo)) -1];
        $category = Category::get();
        $items = Product::where('id',$id)->get();
        // return $items;
        return view('backend.product.edit')->with('product',$product)
                    ->with('categories',$category)->with('items',$items);
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
        $product=Product::findOrFail($id);
        $this->validate($request,[
            'status'=>'required|in:1,0',
            'name'=>'string|required',
            'summary'=>'string|required',
            'description'=>'string|nullable',
            'product_type'=>'integer\|nullable',
            'category_id'=>'required|exists:categories,id',
            'min_order'=>'integer|nullable',
            'weight' => 'integer|nullable',
        ]);

        $data=$request->all();
        $slug=Str::slug($request->name);
        $count=Product::where('slug',$slug)->count();
        if($count>0){
            $slug=$slug.'-'.date('ymdis').'-'.rand(0,999);
        }
        $data['slug']=$slug;

        $old_image = explode('/', $product->photo)[count(explode('/',$product->photo)) -1];
        if (isset($data['photo'])) {
            if (!empty($product->photo)) {
                if(file_exists(public_path('uploads/products').DIRECTORY_SEPARATOR.$old_image)){
                    unlink(public_path('uploads/products').DIRECTORY_SEPARATOR.$old_image);
                } 
            }
            $propImages = $this->uploadImage($request,[
                'file' => 'photo',
                'size' => [500,500],
                'path' => 'uploads/products',
                'permission' => 777
    
            ]);
            $data['photo'] = $propImages['path'];
        }

        $status=$product->fill($data)->save();
        if($status){
            request()->session()->flash('success','Product Successfully updated');
        }
        else{
            request()->session()->flash('error','Please try again!!');
        }
        return redirect()->route('product.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product=Product::findOrFail($id);
        $status=$product->delete();
        
        if($status){
            request()->session()->flash('success','Product successfully deleted');
        }
        else{
            request()->session()->flash('error','Error while deleting product');
        }
        return redirect()->route('product.index');
    }
}
