<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\{
    User,
    Settings
};

class AdminController extends Controller
{
    public function index(){
        $data = User::select(\DB::raw("COUNT(*) as count"), \DB::raw("DAYNAME(created_at) as day_name"), \DB::raw("DAY(created_at) as day"))
            ->where('created_at', '>', Carbon::today()->subDay(6))
            ->groupBy('day_name','day')
            ->orderBy('day')
            ->get();
        $array[] = ['Name', 'Number'];

        foreach($data as $key => $value){
            $array[++$key] = [$value->day_name, $value->count];
        }

        return view('backend.index')->with('users', json_encode($array));
        // return view('backend.index', compact('users'));
    }

    public function profile(){
        $profile=Auth()->user();

        return view('backend.users.profile')->with('profile',$profile);
    }

    public function profileUpdate(Request $request,$id){
        // return $request->all();
        $user = User::findOrFail($id);
        $data = $request->all();
        $status = $user->fill($data)->save();
        
        if($status){
            request()->session()->flash('success','Successfully updated your profile');
        }
        else{
            request()->session()->flash('error','Please try again!');
        }

        return redirect()->back();
    }

    public function settings(){
        $data = Settings::first();
        // dd($data);

        return view('backend.setting', compact('data'));
    }

    public function settingsUpdate(Request $request){
        $this->validate($request,[
            'short_des'=>'required|string',
            'description'=>'required|string',
            'address'=>'required|string',
            'email'=>'required|email',
            'phone'=>'required|string',
        ]);
        $data=$request->all();
        $settings = Settings::first();
        $status = $settings->fill($data)->save();

        $propImages = $this->uploadImage($request,[
            'file' => 'logo',
            'size' => [500,500],
            'path' => 'uploads/products',
            'permission' => 777

        ]);
        $propImages = $this->uploadImage($request,[
            'file' => 'logo_admin',
            'size' => [500,500],
            'path' => 'uploads/products',
            'permission' => 777

        ]);
        $propImages = $this->uploadImage($request,[
            'file' => 'favicon',
            'size' => [500,500],
            'path' => 'uploads/products',
            'permission' => 777

        ]);
        $propImages = $this->uploadImage($request,[
            'file' => 'photo',
            'size' => [500,500],
            'path' => 'uploads/products',
            'permission' => 777

        ]);
        $data['logo'] = $propImages['path'];
        $data['logo_admin'] = $propImages['path'];
        $data['favicon'] = $propImages['path'];
        $data['photo'] = $propImages['path'];

        if($status){
            request()->session()->flash('success','Setting successfully updated');
        }
        else{
            request()->session()->flash('error','Please try again');
        }

        return redirect()->route('admin');
    }

    public function changePassword(){
        return view('backend.layouts.changePassword');
    }

    public function changPasswordStore(Request $request)
    {
        $request->validate([
            'current_password' => ['required', new MatchOldPassword],
            'new_password' => ['required'],
            'new_confirm_password' => ['same:new_password'],
        ]);
   
        User::find(auth()->user()->id)->update(['password'=> Hash::make($request->new_password)]);
   
        return redirect()->route('admin')->with('success','Password successfully changed');
    }

    public function userPieChart(Request $request){
        $data = User::select(\DB::raw("COUNT(*) as count"), \DB::raw("DAYNAME(created_at) as day_name"), \DB::raw("DAY(created_at) as day"))
        ->where('created_at', '>', Carbon::today()->subDay(6))
        ->groupBy('day_name','day')
        ->orderBy('day')
        ->get();

        $array[] = ['Name', 'Number'];
        foreach($data as $key => $value)
        {
        $array[++$key] = [$value->day_name, $value->count];
        }
        
        return view('backend.index')->with('course', json_encode($array));
    }

    // public function activity(){
    //     return Activity::all();
    //     $activity= Activity::all();
    //     return view('backend.layouts.activity')->with('activities',$activity);
    // }
}
