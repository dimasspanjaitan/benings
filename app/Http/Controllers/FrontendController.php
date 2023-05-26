<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

use App\Models\{
    Banner,
    Category,
    PriceLevel,
    Product,
    ProductDetail
};


class FrontendController extends Controller
{
    public function index(Request $request){
        return redirect()->route($request->user()->role);
    }
    
    public function home(){
        $level = 0;
        $user = auth()->user();
        if(!empty($user)) {
            $level = $user->level_id;
        }
        
        $banners = Banner::where('status',1)->limit(3)->orderBy('id','DESC')->get();
        $featured = Product::where('status',1)->orderBy('id','ASC')->limit(2)->get();
        // dd($level);
        // $products = Product::with('prices', 'category')->whereHas('prices', function($p) use ($level){
        //     return $p->where('level_id', $level);
        // })->where('status', 1)->orderBy('id','DESC')->limit(8)->get();
        $products = PriceLevel::where('level_id', $level)->with('product', 'product.stock')->whereHas('product', function($s){
            return $s->where('status',1)->orderBy('id','DESC')->limit(50);
        })->get()->map(function($p){
            $product = $p->product;
            $product->price = $p->price;
            $product->stock = !empty($product->stock) ? (int) $product->stock->stock : 0;
            return $product;
        })->sortByDesc('stock');
        // dd($products);

        $categories = Category::where('status',1)->orderBy('title','ASC')->get();

        return view('frontend.index', compact('banners', 'products', 'featured', 'categories'));
    }

    public function register(){
        return view('frontend.pages.register');
    }
    public function registerSubmit(Request $request){
        // return $request->all();
        $this->validate($request,[
            'name'=>'string|required|min:2',
            'email'=>'string|required|unique:users,email',
            'password'=>'required|min:6|confirmed',
        ]);
        $data=$request->all();
        // dd($data);
        $check=$this->create($data);
        Session::put('user',$data['email']);
        if($check){
            request()->session()->flash('success','Successfully registered');
            return redirect()->route('home');
        }
        else{
            request()->session()->flash('error','Please try again!');
            return back();
        }
    }
    public function productGrids(){
        $level = 0;
        $user = auth()->user();
        if(!empty($user)) {
            $level = $user->level_id;
        }
        
        $products = PriceLevel::where('level_id', $level)->with('product', 'product.stock')->whereHas('product', function($s){
            return $s->where('status',1)->orderBy('id','DESC');
        })->get()->map(function($p){
            $product = $p->product;
            $product->price = $p->price;
            $product->stock = !empty($product->stock) ? (int) $product->stock->stock : 0;
            return $product;
        })->sortByDesc('stock');
        // dd($products);

        if(!empty($_GET['category'])){
            $slug=explode(',',$_GET['category']);
            // dd($slug);
            $cat_ids=Category::select('id')->whereIn('slug',$slug)->pluck('id')->toArray();
            // dd($cat_ids);
            $products->whereIn('cat_id',$cat_ids);
            // return $products;
        }
        if(!empty($_GET['sortBy'])){
            if($_GET['sortBy']=='title'){
                $products=$products->where('status','active')->orderBy('title','ASC');
            }
            if($_GET['sortBy']=='price'){
                $products=$products->orderBy('price','ASC');
            }
        }

        if(!empty($_GET['price'])){
            $price=explode('-',$_GET['price']);
            // return $price;
            // if(isset($price[0]) && is_numeric($price[0])) $price[0]=floor(Helper::base_amount($price[0]));
            // if(isset($price[1]) && is_numeric($price[1])) $price[1]=ceil(Helper::base_amount($price[1]));
            
            
        }

        $recent_products=Product::where('status','active')->orderBy('id','DESC')->limit(3)->get();

      
        return view('frontend.pages.product-grids', compact('products', 'recent_products'));
    }
}
