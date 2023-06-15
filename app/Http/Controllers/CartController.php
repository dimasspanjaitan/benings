<?php

namespace App\Http\Controllers;
use Auth;
use Illuminate\Http\Request;
use App\Models\{
    Product,
    Wishlist,
    Cart,
    PriceLevel
};
use Illuminate\Support\Str;
use Helper;
class CartController extends Controller
{
    protected $product=null;
    public function __construct(Product $product){
        $this->product=$product;
    }

    public function addToCart(Request $request){
        $slug = $request->slug;
        if (empty($slug)) {
            request()->session()->flash('error','Invalid Products');
            return back();
        }

        $level = 0;
        $user = auth()->user();
        if(!empty($user)) {
            $level = $user->level_id;
            $user_id = $user->id;
        }
        $product = PriceLevel::where('level_id', $level)->with('product', 'product.stock')->whereHas('product', function($p) use ($slug){
            return $p->where('status',1)->where('slug', $slug);
        })->first();
        $product->product = $product->product;
        $product->stock = !empty($product->product->stock) ? (int) $product->product->stock->stock : 0;

        if (empty($product)) {
            request()->session()->flash('error','Invalid Products');
            return back();
        }

        $already_cart = Cart::with('product')->where('user_id', $user_id)->where('sale_id',null)->where('product_id', $product->product_id)->first();
        // dd($already_cart);
        if($already_cart) {
            $already_cart->qty = $already_cart->qty + 1;
            // dd($product->price);
            $already_cart->amount = $product->price + $already_cart->amount;
            if ($product->stock < $already_cart->qty || $product->stock <= 0) return back()->with('error','Stock not sufficient!.');
            $already_cart->save();
            Wishlist::where('user_id', $user_id)->where('product_id',$product->product_id)->where('cart_id',null)->update(['cart_id'=>$already_cart->id]);
        }else{
            $cart = new Cart;
            $cart->user_id = $user_id;
            $cart->product_id = $product->product_id;
            $cart->price = $product->price;
            $cart->qty = 1;
            $cart->amount = $cart->price * $cart->qty;
            if ($product->stock < $cart->qty || $product->stock <= 0) return back()->with('error','Stock not sufficient!.');
            $cart->save();
            Wishlist::where('user_id', $user_id)->where('product_id',$product->product_id)->where('cart_id',null)->update(['cart_id'=>$cart->id]);
        }
        request()->session()->flash('success','Product successfully added to cart');
        return back();       
    }  

    public function singleAddToCart(Request $request){
        $request->validate([
            'slug'      =>  'required',
            'qty'      =>  'required',
        ]);

        $slug = $request->slug;
        $level = 0;
        $user = auth()->user();
        if(!empty($user)) {
            $level = $user->level_id;
            $user_id = $user->id;
        }
        $product = PriceLevel::where('level_id', $level)->with('product', 'product.stock')->whereHas('product', function($p) use ($slug){
            return $p->where('status',1)->where('slug', $slug);
        })->first();
        $product->product = $product->product;
        $product->stock = !empty($product->product->stock) ? (int) $product->product->stock->stock : 0;

        if (empty($product)) {
            request()->session()->flash('error','Invalid Products');
            return back();
        }

        if($product->stock < $request->qty[1]){
            return back()->with('error','Out of stock, You can add other products.');
        }
        if ( ($request->qty[1] < 1) || empty($product) ) {
            request()->session()->flash('error','Invalid Products');
            return back();
        }    

        $already_cart = Cart::with('product')->where('user_id', $user_id)->where('sale_id',null)->where('product_id', $product->product_id)->first();

        if($already_cart) {
            $already_cart->qty = $already_cart->qty + $request->qty[1];
            // dd($product->price);
            $already_cart->amount = ($product->price * $request->qty[1]) + $already_cart->amount;
            if ($product->stock < $already_cart->qty || $product->stock <= 0) return back()->with('error','Stock not sufficient!.');
            $already_cart->save();
            Wishlist::where('user_id', $user_id)->where('product_id',$product->product_id)->where('cart_id',null)->update(['cart_id'=>$already_cart->id]);
        }else{
            $cart = new Cart;
            $cart->user_id = $user_id;
            $cart->product_id = $product->product_id;
            $cart->price = $product->price;
            $cart->qty = $request->qty[1];
            $cart->amount = $cart->price * $cart->qty;
            if ($product->stock < $cart->qty || $product->stock <= 0) return back()->with('error','Stock not sufficient!.');
            $cart->save();
            Wishlist::where('user_id', $user_id)->where('product_id',$product->product_id)->where('cart_id',null)->update(['cart_id'=>$cart->id]);
        }
        request()->session()->flash('success','Product successfully added to cart.');
        return back();       
    } 
    
    public function cartDelete(Request $request){
        $cart = Cart::find($request->id);
        if ($cart) {
            $cart->delete();
            request()->session()->flash('success','Cart successfully removed');
            return back();  
        }
        request()->session()->flash('error','Error please try again');
        return back();       
    }     

    private function _cartUpdate($request){
        if(!empty($request)){
            $qty = $request->qty;
            $qty_id = $request->qty_id;
        }

        $level = 0;
        $user = auth()->user();
        if(!empty($user)) {
            $level = $user->level_id;
            $user_id = $user->id;
        }

        if($qty){
            $error = array();
            $success = '';
            foreach ($qty as $k=>$qty) {
                $id = $qty_id[$k];
                $cart = Cart::find($id);
                // dd($cart);
                
                $product = PriceLevel::where('level_id', $level)->with('product', 'product.stock')->whereHas('product', function($p) use ($cart){
                    return $p->where('status',1)->where('product_id', $cart->product_id);
                })->first();
                $product->product = $product->product;
                $product->stock = !empty($product->product->stock) ? (int) $product->product->stock->stock : 0;

                if($qty > 0 && $cart) {
                    if($product->stock < $qty){
                        request()->session()->flash('error','Out of stock');
                        return back();
                    }
                    $cart->qty = ($product->stock > $qty) ? $qty  : $product->stock;
                    
                    if ($product->stock <=0) continue;
                    $after_price = $product->price;
                    $cart->amount = $after_price * $qty;
                    // dd($cart->amount);
                    $cart->save();
                    $success = 'Cart successfully updated!';
                }else{
                    $error[] = 'Cart Invalid!';
                }
            }
            return back()->with($error)->with('success', $success);
        }else{
            return back()->with('Cart Invalid!');
        } 
    }

    public function cartUpdate(Request $request){
        return $this->_cartUpdate($request);
    }

    public function checkout(Request $request){
        $this->_cartUpdate($request);
        $user = auth()->user();

        return view('frontend.pages.checkout', compact('user'));
    }
}
