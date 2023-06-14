<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\{
    User,
    Level,
    Region
};
use App\Traits\UploadTrait;

class UsersController extends Controller
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
        $users = User::with('levels', 'regions')->orderBy('id','ASC');
        $users = $this->filter($users)->get();

        $total = User::select('id')->orderBy('id', 'ASC');
        $total = $this->filter($total,false)->count();
        $pagination = $this->pagination($total);
        
        return view('backend.users.index', compact('users', 'pagination'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $levels = Level::get();
        $regions = Region::get();

        return view('backend.users.create', compact('levels', 'regions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,
        [
            'status'=>'required|in:1,0',
            'name'=>'required|string|max:30',
            'email'=>'required|string|unique:users',
            'password'=>'required|string',
            'upline'=>'integer|nullable',
            'phone'=>'required|string|nullable',
            'instagram'=>'string|nullable',
            'birth_place'=>'string|nullable',
            'birth_date'=>'string|nullable',
            'gander'=>'integer|nullable',
            'sub_district'=>'string|nullable',
            'city'=>'string|nullable',
            'address'=>'string|nullable',
            'bank_name'=>'string|nullable',
            'bank_number'=>'string|nullable',
            'level_id'=>'required|integer',
            'region_id'=>'required|integer',
            'photo'=>'nullable|file',
            'id_card_photo'=>'nullable|string',
            'id_card_number'=>'nullable|string',
            'another_partner'=>'nullable|boolean',
            'role'=>'required|in:1,2'
        ],[
            'required' => 'This :attribute cannot be null',
            'max' => 'This :attribute maximal 30 character',
            'string' => 'This :attribute must be string'
        ]);
        $data = $request->all();
        $data['password'] = Hash::make($data['password']);

        if(isset($data['photo'])){
            $propImages = $this->uploadImage($request,[
                'file' => 'photo',
                'size' => [500,500],
                'path' => 'uploads/users',
                'permission' => 777
    
            ]);
            $data['photo'] = $propImages['path'];
        }

        $status=User::create($data);
        if($status){
            request()->session()->flash('success','Successfully added user');
        }
        else{
            request()->session()->flash('error','Error occurred while adding user');
        }
        return redirect()->route('users.index');

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
        $levels = Level::get();
        $regions = Region::get();
        $user = User::findOrFail($id);
        $user->photo = explode('/', $user->photo)[count(explode('/',$user->photo)) -1];

        return view('backend.users.edit', compact('user', 'levels', 'regions'));
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
        $user=User::findOrFail($id);
        $this->validate($request,
        [
            'status'=>'required|in:1,0',
            'name'=>'required|string|max:30',
            'email'=>'required|string',
            'password'=>'required|string',
            'upline'=>'integer|nullable',
            'phone'=>'required|string|nullable',
            'instagram'=>'string|nullable',
            'birth_place'=>'string|nullable',
            'birth_date'=>'string|nullable',
            'gander'=>'integer|nullable',
            'sub_district'=>'string|nullable',
            'city'=>'string|nullable',
            'address'=>'string|nullable',
            'bank_name'=>'string|nullable',
            'bank_number'=>'string|nullable',
            'level_id'=>'required|integer',
            'region_id'=>'required|integer',
            'photo'=>'nullable|file',
            'id_card_photo'=>'nullable|string',
            'id_card_number'=>'nullable|string',
            'another_partner'=>'nullable|boolean',
            'role'=>'required|in:1,2'
        ],[
            'required' => 'This :attribute cannot be null',
            'max' => 'This :attribute maximal 30 character',
            'string' => 'This :attribute must be string',
            'uploaded' => 'File size too big'
        ]);
        $data = $request->all();
        $data['password'] = Hash::make($data['password']);

        $old_image = explode('/', $user->photo)[count(explode('/',$user->photo)) -1];
        // dd($old_image);
        if (isset($data['photo'])) {
            if (!empty($user->photo)) {
                if(file_exists(public_path('uploads/users').DIRECTORY_SEPARATOR.$old_image)){
                    unlink(public_path('uploads/users').DIRECTORY_SEPARATOR.$old_image);
                }
            }
            $propImages = $this->uploadImage($request,[
                'file' => 'photo',
                'size' => [500,500],
                'path' => 'uploads/users',
                'permission' => 777
    
            ]);
            $data['photo'] = $propImages['path'];
        }
        
        $status=$user->fill($data)->save();
        if($status){
            request()->session()->flash('success','Successfully updated');
        }
        else{
            request()->session()->flash('error','Error occured while updating');
        }
        return redirect()->route('users.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $delete=User::findorFail($id);
        $status=$delete->delete();
        if($status){
            request()->session()->flash('success','User Successfully deleted');
        }
        else{
            request()->session()->flash('error','There is an error while deleting users');
        }
        return redirect()->route('users.index');
    }
}
