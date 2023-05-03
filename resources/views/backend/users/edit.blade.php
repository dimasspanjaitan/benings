@extends('backend.layouts.master')

@section('main-content')

<div class="card">
    <h5 class="card-header">Edit User</h5>
    <div class="card-body">
      <form method="post" action="{{route('users.update',$user->id)}}">
        @csrf 
        @method('PATCH')
        <div class="form-group">
          <label for="inputName" class="col-form-label">Name</label>
        <input id="inputName" type="text" name="name" placeholder="Enter name"  value="{{$user->name}}" class="form-control">
        @error('name')
        <span class="text-danger">{{$message}}</span>
        @enderror
        </div>

        <div class="form-group">
            <label for="inputEmail" class="col-form-label">Email</label>
          <input id="inputEmail" type="email" name="email" placeholder="Enter email"  value="{{$user->email}}" class="form-control">
          @error('email')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>

        <div class="form-group">
            <label for="inputPassword" class="col-form-label">Password</label>
          <input id="inputPassword" type="password" name="password" placeholder="Enter password"  value="{{ old('password') }}" class="form-control">
          @error('password')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>

        <div class="form-group">
          <label for="inputPhone" class="col-form-label">Phone</label>
        <input id="inputPhone" type="number" name="phone" placeholder="Enter phone"  value="{{$user->phone}}" class="form-control">
        @error('password')
        <span class="text-danger">{{$message}}</span>
        @enderror
      </div>

      <div class="form-group">
        <label for="level">Level <span class="text-danger">*</span></label>
        <select name="level_id" class="form-control">
            <option value="">--Select any level--</option>
            @foreach($levels as $key=>$data)
                <option value='{{$data->id}}' {{ ($data->id == $user->level_id) ? 'selected' : '' }}>{{$data->name}}</option>
            @endforeach
        </select>
      </div>

      <div class="form-group">
        <label for="region">Region <span class="text-danger">*</span></label>
        <select name="region_id" class="form-control">
            <option value="">--Select any region--</option>
            @foreach($regions as $key=>$data)
                <option value='{{$data->id}}' {{ ($data->id == $user->region_id) ? 'selected' : '' }} >{{$data->name}}</option>
            @endforeach
        </select>
      </div>

        <div class="form-group">
        <label for="inputPhoto" class="col-form-label">Photo</label>
        <div class="input-group">
            <span class="input-group-btn">
                <a id="lfm" data-input="thumbnail" data-preview="holder" class="btn btn-primary">
                <i class="fa fa-picture-o"></i> Choose
                </a>
            </span>
            <input id="thumbnail" class="form-control" type="text" name="photo" value="{{$user->photo}}">
        </div>
        <img id="holder" style="margin-top:15px;max-height:100px;">
          @error('photo')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>
        
        <div class="form-group">
          <label for="role" class="col-form-label">Role</label>
          <select name="role" class="form-control">
              <option value="1" {{ ($user->role==1) ? 'selected' : '' }}>Admin</option>
              <option value="2" {{ ($user->role==2) ? 'selected' : '' }} >User</option>
          </select>
          @error('role')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>

          <div class="form-group">
            <label for="status" class="col-form-label">Status</label>
            <select name="status" class="form-control">
                <option value="1" {{(($user->status==1) ? 'selected' : '')}}>Active</option>
                <option value="0" {{(($user->status==0) ? 'selected' : '')}}>Inactive</option>
            </select>
          @error('status')
          <span class="text-danger">{{$message}}</span>
          @enderror
          </div>
        <div class="form-group mb-3">
           <button class="btn btn-success" type="submit">Update</button>
        </div>
      </form>
    </div>
</div>

@endsection

@push('scripts')
<script src="/vendor/laravel-filemanager/js/stand-alone-button.js"></script>
<script>
    $('#lfm').filemanager('image');
</script>
@endpush