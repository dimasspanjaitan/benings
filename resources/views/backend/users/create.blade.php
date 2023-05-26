@extends('backend.layouts.master')

@section('title',"Bening's || User Create")
@section('main-content')

<div class="card">
    <h5 class="card-header">Add User</h5>
    <div class="card-body">
      <form method="post" enctype="multipart/form-data" action="{{ route('users.store') }}">
        {{ csrf_field() }}
        
        <div class="form-group">
            <label for="inputName" class="col-form-label">Name <span class="text-danger">*</span></label>
            <input id="inputName" type="text" name="name" placeholder="Enter name"  value="{{ old('name') }}" class="form-control">
            @error('name')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="inputEmail" class="col-form-label">Email <span class="text-danger">*</span></label>
            <input id="inputEmail" type="email" name="email" placeholder="Enter email"  value="{{ old('email') }}" class="form-control">
            @error('email')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="inputPhone" class="col-form-label">Phone <span class="text-danger">*</span></label>
            <input id="inputPhone" type="number" name="phone" placeholder="Enter phone"  value="{{ old('phone') }}" class="form-control">
            @error('phone')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="col-12 row pl-0">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="level">Level <span class="text-danger">*</span></label>
                    <select name="level_id" class="form-control">
                        <option value="">--Select any level--</option>
                        @foreach($levels as $key=>$data)
                            <option value='{{ $data->id }}'>{{ $data->name }}</option>
                        @endforeach
                    </select>
                    @error('level_id')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="region">Region <span class="text-danger">*</span></label>
                    <select name="region_id" class="form-control">
                        <option value="">--Select any region--</option>
                        @foreach($regions as $key=>$data)
                            <option value='{{ $data->id }}'>{{ $data->name }}</option>
                        @endforeach
                    </select>
                    @error('region_id')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
        </div>

        <div class="col-12 row pl-0">
          <div class="col-md-6">
              <div class="form-group">
                  <label for="role" class="col-form-label">Role <span class="text-danger">*</span></label>
                  <select name="role" class="form-control">
                      <option value="1">Admin</option>
                      <option value="2">User</option>
                  </select>
                  @error('role')
                      <span class="text-danger">{{ $message }}</span>
                  @enderror
              </div>
          </div>
          <div class="col-md-6">
              <div class="form-group">
                  <label for="status" class="col-form-label">Status <span class="text-danger">*</span></label>
                  <select name="status" class="form-control">
                      <option value="1">Active</option>
                      <option value="0">Inactive</option>
                  </select>
                  @error('status')
                      <span class="text-danger">{{ $message }}</span>
                  @enderror
              </div>
          </div>
        </div>

        <div class="form-group">
            <label for="photo" class="col-form-label">Photo </label>
            <div class="col-12 row pl-0">
              <div class="col-md-6">
                <div class="input-group">
                    {{-- <input type="file" class="form-control-file" id="photo" name="photo" value="{{ old('photo') }}"> --}}
                    <label class="custom-file">
                      <input type="file" class="custom-file-input" id="photo" name="photo"
                         value="{{ old('photo') }}">
                      <span class="custom-file-label form-control-input" for="photo">Choose file</span>
                    </label>
                </div>
              </div>
              <div class="col-md-6"></div>
            </div>
            @error('photo')
              <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="inputPassword" class="col-form-label">Password <span class="text-danger">*</span></label>
            <input id="inputPassword" type="password" name="password" placeholder="Enter password"  value="{{ old('password') }}" class="form-control">
            @error('password')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group mb-3">
            <button type="reset" class="btn btn-warning">Reset</button>
            <button class="btn btn-success" type="submit">Submit</button>
        </div>
      </form>
    </div>
</div>

@endsection

@push('scripts')
<script>
  $('.custom-file-input').on('change',function(){
    var filePhoto = document.getElementById("photo").files[0].name;
    $(this).next('.form-control-input').addClass("selected").html(filePhoto);
  })
</script>
@endpush