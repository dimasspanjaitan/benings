<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\{
    User,
    Settings
};
use App\Traits\UploadTrait;

class AdminController extends Controller
{
    use UploadTrait;

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
        $data->logo = explode('/', $data->logo)[count(explode('/',$data->logo)) -1];
        $data->logo_admin = explode('/', $data->logo_admin)[count(explode('/',$data->logo_admin)) -1];
        $data->favicon = explode('/', $data->favicon)[count(explode('/',$data->favicon)) -1];
        $data->photo = explode('/', $data->photo)[count(explode('/',$data->photo)) -1];

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

        $old_logo = explode('/', $settings->logo)[count(explode('/',$settings->logo)) -1];
        if (isset($data['logo'])) {
            if (!empty($settings->logo)) {
                if(file_exists(public_path('uploads/settingss').DIRECTORY_SEPARATOR.$old_logo)){
                    unlink(public_path('uploads/settingss').DIRECTORY_SEPARATOR.$old_logo);
                } 
            }
            $propImages = $this->uploadImage($request,[
                'file' => 'logo',
                'size' => [225,225],
                'path' => 'uploads/settings',
                'permission' => 777
    
            ]);
            $data['logo'] = $propImages['path'];
        }

        $old_admin = explode('/', $settings->logo_admin)[count(explode('/',$settings->logo_admin)) -1];
        if (isset($data['logo_admin'])) {
            if (!empty($settings->logo_admin)) {
                if(file_exists(public_path('uploads/settingss').DIRECTORY_SEPARATOR.$old_admin)){
                    unlink(public_path('uploads/settingss').DIRECTORY_SEPARATOR.$old_admin);
                } 
            }
            $propImages = $this->uploadImage($request,[
                'file' => 'logo_admin',
                'size' => [73,56],
                'path' => 'uploads/settings',
                'permission' => 777
    
            ]);
            $data['logo_admin'] = $propImages['path'];
        }

        $old_favicon = explode('/', $settings->favicon)[count(explode('/',$settings->favicon)) -1];
        if (isset($data['favicon'])) {
            if (!empty($settings->favicon)) {
                if(file_exists(public_path('uploads/settingss').DIRECTORY_SEPARATOR.$old_favicon)){
                    unlink(public_path('uploads/settingss').DIRECTORY_SEPARATOR.$old_favicon);
                } 
            }
            $propImages = $this->uploadImage($request,[
                'file' => 'favicon',
                'size' => [32,32],
                'path' => 'uploads/settings',
                'permission' => 777
    
            ]);
            $data['favicon'] = $propImages['path'];
        }

        $old_photo = explode('/', $settings->photo)[count(explode('/',$settings->photo)) -1];
        if (isset($data['photo'])) {
            if (!empty($settings->photo)) {
                if(file_exists(public_path('uploads/settingss').DIRECTORY_SEPARATOR.$old_photo)){
                    unlink(public_path('uploads/settingss').DIRECTORY_SEPARATOR.$old_photo);
                } 
            }
            $propImages = $this->uploadImage($request,[
                'file' => 'photo',
                'size' => [1000,1000],
                'path' => 'uploads/settings',
                'permission' => 777
    
            ]);
            $data['photo'] = $propImages['path'];
        }

        $status = $settings->fill($data)->save();

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
