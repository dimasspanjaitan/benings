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

    public function productDetail($slug){
        $level = 0;
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
        // dd($product_detail);

        return view('frontend.pages.product_detail', compact('product_detail'));
    }

    public function productFilter(Request $request){
        $data= $request->all();
        // return $data;
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
            return redirect()->route('product-grids',$catURL.$brandURL.$priceRangeURL.$showURL.$sortByURL);
        }
        else{
            return redirect()->route('product-lists',$catURL.$brandURL.$priceRangeURL.$showURL.$sortByURL);
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
        
        $prices = [];
        foreach ($products as $item) {
            array_push($prices, $item->price);
        }
        // dd(max($price));

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
                $products=$products->where('status',1)->orderBy('title','ASC');
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
        
        $prices = [];
        foreach ($products as $item) {
            array_push($prices, $item->price);
        }

        dd($prices);
        
        if(!empty($_GET['category'])){
            $slug = explode(',',$_GET['category']);
            // dd($slug);
            $cat_ids = Category::select('id')->whereIn('slug',$slug)->pluck('id')->toArray();
            // dd($cat_ids);
            $products->whereIn('cat_id',$cat_ids)->paginate;
            // return $products;
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
            // return $price;
            // if(isset($price[0]) && is_numeric($price[0])) $price[0]=floor(Helper::base_amount($price[0]));
            // if(isset($price[1]) && is_numeric($price[1])) $price[1]=ceil(Helper::base_amount($price[1]));
            
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
        else{
            $products=$products->where('status',1)->paginate(6);
        }
        // Sort by name , price, category

      
        return view('frontend.pages.product-lists', compact('products', 'recent_products', 'prices'));
    }

    public function productSearch(Request $request){
        $recent_products=Product::where('status',1)->orderBy('id','DESC')->limit(3)->get();
        $products=Product::orwhere('title','like','%'.$request->search.'%')
                    ->orwhere('slug','like','%'.$request->search.'%')
                    ->orwhere('description','like','%'.$request->search.'%')
                    ->orwhere('summary','like','%'.$request->search.'%')
                    ->orwhere('price','like','%'.$request->search.'%')
                    ->orderBy('id','DESC')
                    ->paginate('9');
        return view('frontend.pages.product-grids')->with('products',$products)->with('recent_products',$recent_products);
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

