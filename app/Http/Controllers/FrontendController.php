<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

use App\Models\{
    Category
};


class FrontendController extends Controller
{
    public function index(Request $request){
        return redirect()->route($request->user()->role);
    }
    
    public function home(){
        $banners = [];
        $product_lists = [];
        $featured = [];

        $category_lists = Category::where('status',1)->limit(3)->get();

        return view('frontend.index', compact('banners', 'product_lists', 'featured', 'category_lists'));
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
    
}
