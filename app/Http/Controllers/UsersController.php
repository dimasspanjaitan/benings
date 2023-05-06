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
class UsersController extends Controller
{
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
        // dd($users);
        
        return view('backend.users.index', compact('users'));
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
            'name'=>'string|required|max:30',
            'email'=>'string|required|unique:users',
            'password'=>'string|required',
            'upline'=>'integer|nullable',
            'phone'=>'string|nullable',
            'instagram'=>'string|nullable',
            'birth_place'=>'string|nullable',
            'birth_date'=>'string|nullable',
            'gander'=>'integer|nullable',
            'sub_district'=>'string|nullable',
            'city'=>'string|nullable',
            'address'=>'text|nullable',
            'bank_name'=>'integer|nullable',
            'bank_number'=>'string|nullable',
            'level_id'=>'integer|required',
            'region_id'=>'integer|required',
            'photo'=>'nullable|text',
            'id_card_photo'=>'nullable|text',
            'id_card_number'=>'nullable|string',
            'another_partner'=>'nullable|boolean',
            'role'=>'required|in:1,2'
        ]);
        $data=$request->all();
        $data['password']=Hash::make($request->password);
        
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
            'name'=>'string|required|max:30',
            'email'=>'string|required',
            'password'=>'string|required',
            'upline'=>'integer|nullable',
            'phone'=>'string|nullable',
            'instagram'=>'string|nullable',
            'birth_place'=>'string|nullable',
            'birth_date'=>'date|nullable',
            'gender'=>'integer|nullable',
            'sub_district'=>'string|nullable',
            'city'=>'string|nullable',
            'address'=>'text|nullable',
            'bank_name'=>'integer|nullable',
            'bank_number'=>'string|nullable',
            'level_id'=>'integer|nullable',
            'region_id'=>'integer|nullable',
            'photo'=>'nullable|text',
            'id_card_photo'=>'nullable|text',
            'id_card_number'=>'nullable|string',
            'another_partner'=>'nullable|boolean',
            'role'=>'required|in:1,2'
        ]);
        $data=$request->all();
        
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
