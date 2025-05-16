<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\{
    Banner,
    Category,
    PriceLevel,
    Product,
    SaleDetail
};


class FrontendController extends Controller
{
    public function index(Request $request){
        return redirect()->route($request->user()->role);
    }
    
    public function home(){
        $level = 1;
        $user = auth()->user();
        if(!empty($user)) {
            $level = $user->level_id;
        }
        
        $bests = SaleDetail::with('product', 'product.category')->groupBy('product_id')->selectRaw('sum(qty) as sum, product_id')->get()->map(function($b){
            $b->sum = (int) $b->sum;
            $b->product = $b->product;
            $b->category = $b->product->category;
            return $b;
        })->sortByDesc('sum')->take(2);
        $banners = Banner::where('status',1)->limit(3)->orderBy('id','DESC')->get();
        $products = PriceLevel::where('level_id', $level)->with('product', 'product.stock')->whereHas('product', function($s){
            return $s->where('status',1)->limit(20);
        })->get()->map(function($p){
            $product = $p->product;
            $product->price = $p->price;
            $product->stock = !empty($product->stock) ? (int) $product->stock->stock : 0;
            return $product;
        })->sortByDesc('stock');
        $latests = $products->sortByDesc('id')->take(6);
        $categories = Category::where('status',1)->orderBy('title','ASC')->get();

        return view('frontend.index', compact('banners', 'products', 'bests', 'categories', 'latests'));
    }

    public function aboutUs(){
        return view('frontend.pages.about-us');
    }

    public function contact(){
        return view('frontend.pages.contact');
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

    public function productDetail($slug){
        $level = 1;
        $user = auth()->user();
        if(!empty($user)) {
            $level = $user->level_id;
        }
        $product_detail = PriceLevel::where('level_id', $level)->with('product', 'product.stock', 'product.category')->whereHas('product', function($pd) use ($slug){
            return $pd->where('status',1)->where('slug', $slug);
        })->first();
        $product_detail->product = $product_detail->product;
        $product_detail->category = $product_detail->product->category;
        $product_detail->stock = (!empty($product_detail->product->stock)) ? $product_detail->product->stock->stock : 0;

        return view('frontend.pages.product_detail', compact('product_detail'));
    }

    public function productFilter(Request $request){
        $data= $request->all();
        $showURL="";

        if(!empty($data['show'])){
            $showURL .='&show='.$data['show'];
        }

        $sortByURL='';
        if(!empty($data['sortBy'])){
            $sortByURL .='&sortBy='.$data['sortBy'];
        }

        $catURL="";
        if(!empty($data['category'])){
            foreach($data['category'] as $category){
                if(empty($catURL)){
                    $catURL .='&category='.$category;
                }
                else{
                    $catURL .=','.$category;
                }
            }
        }

        $priceRangeURL="";
        if(!empty($data['price_range'])){
            $priceRangeURL .='&price='.$data['price_range'];
        }

        if(request()->is('benings.loc/product-grids')){
            return redirect()->route('product-grids',$catURL.$priceRangeURL.$showURL.$sortByURL);
        }
        else{
            return redirect()->route('product-lists',$catURL.$priceRangeURL.$showURL.$sortByURL);
        }
    }

    public function productGrids(){
        $level = 1;
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
        
        $prices = [];
        foreach ($products as $item) {
            array_push($prices, $item->price);
        }

        if(!empty($_GET['category'])){
            $slug=explode(',',$_GET['category']);
            $cat_ids=Category::select('id')->whereIn('slug',$slug)->pluck('id')->toArray();
            $products->whereIn('cat_id',$cat_ids);
        }
        if(!empty($_GET['sortBy'])){
            if($_GET['sortBy']=='title'){
                $products=$products->where('status',1)->orderBy('title','ASC');
            }
            if($_GET['sortBy']=='price'){
                $products=$products->orderBy('price','ASC');
            }
        }

        if(!empty($_GET['price'])){
            $price=explode('-',$_GET['price']);
        }

        $recent_products = PriceLevel::where('level_id', $level)->with('product')->whereHas('product', function($s){
            return $s->where('status',1);
        })->limit(3)->orderBy('id','DESC')->get()->map(function($p){
            $product = $p->product;
            $product->price = $p->price;
            return $product;
        });

      
        return view('frontend.pages.product-grids', compact('products', 'recent_products', 'prices'));
    }

    public function productLists(){
        $level = 1;
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
        
        $prices = [];
        foreach ($products as $item) {
            array_push($prices, $item->price);
        }
        
        if(!empty($_GET['category'])){
            $slug = explode(',',$_GET['category']);
            $cat_ids = Category::select('id')->whereIn('slug',$slug)->pluck('id')->toArray();
            $products->whereIn('cat_id',$cat_ids)->paginate;
        }
        if(!empty($_GET['sortBy'])){
            if($_GET['sortBy']=='title'){
                $products=$products->where('status',1)->orderBy('title','ASC');
            }
            if($_GET['sortBy']=='price'){
                $products=$products->orderBy('price','ASC');
            }
        }

        if(!empty($_GET['price'])){
            $price = explode('-',$_GET['price']);
            $products->whereBetween('price',$price);
        }

        $recent_products = PriceLevel::where('level_id', $level)->with('product')->whereHas('product', function($s){
            return $s->where('status',1);
        })->limit(3)->orderBy('id','DESC')->get()->map(function($p){
            $product = $p->product;
            $product->price = $p->price;
            return $product;
        });

        // Sort by number
        if(!empty($_GET['show'])){
            $products=$products->where('status',1)->paginate($_GET['show']);
        }
      
        return view('frontend.pages.product-lists', compact('products', 'recent_products', 'prices'));
    }

    public function productSearch(Request $request){
        $search = $request->search;
        $level = 1;
        $user = auth()->user();
        if(!empty($user)) {
            $level = $user->level_id;
        }
        
        $recent_products = Product::where('status',1)->orderBy('id','DESC')->limit(3)->get();
        $raw_products = Product::orwhere('name','like','%'.$request->search.'%')
                    ->orwhere('slug','like','%'.$request->search.'%')
                    ->orwhere('description','like','%'.$request->search.'%')
                    ->orwhere('summary','like','%'.$request->search.'%')
                    ->orderBy('id','DESC')->get();

        $products = [];
        foreach ($raw_products as $product) {
            $product = PriceLevel::where('level_id', $level)->where('product_id', $product->id)->with('product', 'product.stock')->whereHas('product', function($s){
                return $s->where('status',1)->orderBy('id','DESC');
            })->get()->map(function($p){
                $product = $p->product;
                $product->price = $p->price;
                $product->stock = !empty($product->stock) ? (int) $product->stock->stock : 0;
                return $product;
            })->sortByDesc('stock');

            array_push($products, $product[0]);
        }

        return view('frontend.pages.product-grids', compact('recent_products', 'products'));
    }

    public function productCat(Request $request){
        $slug = $request->slug;
        $level = 0;
        $user = auth()->user();
        
        if(!empty($user)) {
            $level = $user->level_id;
        }
        
        $products = PriceLevel::where('level_id', $level)->with('product', 'product.stock', 'product.category')->whereHas('product', function($s){
            return $s->where('status',1)->orderBy('id','DESC');
        })->get()->map(function($p){
            $product = $p->product;
            $product->slug_category = $product->category->slug;
            $product->price = $p->price;
            $product->stock = !empty($product->stock) ? (int) $product->stock->stock : 0;
            return $product;
        })->where('slug_category', $slug)->sortByDesc('stock');
        
        $prices = [];
        foreach ($products as $item) {
            array_push($prices, $item->price);
        }

        $recent_products = PriceLevel::where('level_id', $level)->with('product')->whereHas('product', function($s){
            return $s->where('status',1);
        })->limit(3)->orderBy('id','DESC')->get()->map(function($p){
            $product = $p->product;
            $product->price = $p->price;
            return $product;
        });

        if(request()->is('benings.loc/product-grids')){
            return view('frontend.pages.product-grids', compact('products', 'recent_products', 'prices'));
        }
        else{
            return view('frontend.pages.product-lists', compact('products', 'recent_products', 'prices'));
        }

    }
}

