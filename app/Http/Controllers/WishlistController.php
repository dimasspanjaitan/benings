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
class WishlistController extends Controller
{
    protected $product=null;
    public function __construct(Product $product){
        $this->product=$product;
    }

    public function wishlist(Request $request){
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

        $already_wishlist = Wishlist::where('user_id', $user_id)->where('cart_id', null)->where('product_id', $product->product_id)->first();
        $already_cart = Cart::where('user_id', $user_id)->where('sale_id', null)->where('product_id', $product->product_id)->first();
        if($already_wishlist) {
            request()->session()->flash('error','You already placed in wishlist');
            return back();
        }elseif ($already_cart) {
            request()->session()->flash('error','You already placed in cart');
            return back();
        }else{
            
            $wishlist = new Wishlist;
            $wishlist->user_id = $user_id;
            $wishlist->product_id = $product->product_id;
            $wishlist->price = $product->price;
            $wishlist->qty = 1;
            $wishlist->amount = $wishlist->price * $wishlist->qty;
            if ($product->stock < $wishlist->qty || $product->stock <= 0) return back()->with('error','Stock not sufficient!.');
            $wishlist->save();
        }
        request()->session()->flash('success','Product successfully added to wishlist');
        return back();       
    }  
    
    public function wishlistDelete(Request $request){
        $wishlist = Wishlist::find($request->id);
        if ($wishlist) {
            $wishlist->delete();
            request()->session()->flash('success','Wishlist successfully removed');
            return back();  
        }
        request()->session()->flash('error','Error please try again');
        return back();       
    }     
}
