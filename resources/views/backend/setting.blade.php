@extends('backend.layouts.master')

@section('title',"Bening's || Setting")
@section('main-content')

<div class="card">
    <h5 class="card-header">Edit Post</h5>
    <div class="card-body">
    <form method="post" enctype="multipart/form-data" action="{{ route('settings.update') }}">
        @csrf 
        {{-- @method('PATCH') --}}
        {{-- {{dd($data)}} --}}
        <div class="form-group">
          <label for="short_des" class="col-form-label">Short Description <span class="text-danger">*</span></label>
          <textarea class="form-control" id="quote" name="short_des">{{ $data->short_des }}</textarea>
          @error('short_des')
            <span class="text-danger">{{$message}}</span>
          @enderror
        </div>
        <div class="form-group">
          <label for="description" class="col-form-label">Description <span class="text-danger">*</span></label>
          <textarea class="form-control" id="description" name="description" rows="10">{{ $data->description }}</textarea>
          @error('description')
            <span class="text-danger">{{$message}}</span>
          @enderror
        </div>

        <div class="form-group">
          <label for="logo" class="col-form-label">Logo Utama </label>
            <div class="col-12 row pl-0">
                <div class="col-md-6">
                  <div class="input-group">
                    <label class="custom-file">
                      <input type="file" class="custom-file-logo" id="logo" name="logo"
                        aria-describedby="logo" value="{{ $data->logo }}">
                      @if (!empty($data->logo))
                        <span class="custom-file-label form-control-logo" for="logo">{{ $data->logo }}</span>
                      @else
                        <span class="custom-file-label form-control-logo" for="logo">Choose file</span>
                      @endif
                    </label>
                </div>
              </div>
              <div class="col-md-6"></div>
            </div>
            @error('logo')
              <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
          <label for="logo_admin" class="col-form-label">Logo Admin </label>
            <div class="col-12 row pl-0">
                <div class="col-md-6">
                  <div class="input-group">
                    <label class="custom-file">
                      <input type="file" class="custom-file-logo-admin" id="logo_admin" name="logo_admin"
                        aria-describedby="logo_admin" value="{{ $data->logo_admin }}">
                      @if (!empty($data->logo_admin))
                        <span class="custom-file-label form-control-logo-admin" for="logo_admin">{{ $data->logo_admin }}</span>
                      @else
                        <span class="custom-file-label form-control-logo-admin" for="logo_admin">Choose file</span>
                      @endif
                    </label>
                </div>
              </div>
              <div class="col-md-6"></div>
            </div>
            @error('logo_admin')
              <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
          <label for="favicon" class="col-form-label">Logo Favicon </label>
            <div class="col-12 row pl-0">
                <div class="col-md-6">
                  <div class="input-group">
                    <label class="custom-file">
                      <input type="file" class="custom-file-favicon" id="favicon" name="favicon"
                        aria-describedby="favicon" value="{{ $data->favicon }}">
                      @if (!empty($data->favicon))
                        <span class="custom-file-label form-control-favicon" for="favicon">{{ $data->favicon }}</span>
                      @else
                        <span class="custom-file-label form-control-favicon" for="favicon">Choose file</span>
                      @endif
                    </label>
                </div>
              </div>
              <div class="col-md-6"></div>
            </div>
            @error('favicon')
              <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
          <label for="photo" class="col-form-label">Photo </label>
            <div class="col-12 row pl-0">
                <div class="col-md-6">
                  <div class="input-group">
                    <label class="custom-file">
                      <input type="file" class="custom-file-photo" id="photo" name="photo"
                        aria-describedby="photo" value="{{ $data->photo }}">
                      @if (!empty($data->photo))
                        <span class="custom-file-label form-control-photo" for="photo">{{ $data->photo }}</span>
                      @else
                        <span class="custom-file-label form-control-photo" for="photo">Choose file</span>
                      @endif
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
          <label for="address" class="col-form-label">Address <span class="text-danger">*</span></label>
          <input type="text" class="form-control" name="address" required value="{{$data->address}}">
          @error('address')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>
        <div class="form-group">
          <label for="email" class="col-form-label">Email <span class="text-danger">*</span></label>
          <input type="email" class="form-control" name="email" required value="{{$data->email}}">
          @error('email')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>
        <div class="form-group">
          <label for="phone" class="col-form-label">Phone Number <span class="text-danger">*</span></label>
          <input type="text" class="form-control" name="phone" required value="{{$data->phone}}">
          @error('phone')
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

@push('styles')
<link rel="stylesheet" href="{{asset('backend/summernote/summernote.min.css')}}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.css" />

@endpush
@push('scripts')
<script src="/vendor/laravel-filemanager/js/stand-alone-button.js"></script>
<script src="{{asset('backend/summernote/summernote.min.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>

<script>
    $('.custom-file-logo').on('change',function(){
      var fileLogo = document.getElementById("logo").files[0].name;
      $(this).next('.form-control-logo').addClass("selected").html(fileLogo);
    })
    $('.custom-file-logo-admin').on('change',function(){
      var fileLogoAdmin = document.getElementById("logo_admin").files[0].name;
      $(this).next('.form-control-logo-admin').addClass("selected").html(fileLogoAdmin);
    })
    $('.custom-file-favicon').on('change',function(){
      var fileFavicon = document.getElementById("favicon").files[0].name;
      $(this).next('.form-control-favicon').addClass("selected").html(fileFavicon);
    })
    $('.custom-file-photo').on('change',function(){
      var filePhoto = document.getElementById("photo").files[0].name;
      $(this).next('.form-control-photo').addClass("selected").html(filePhoto);
    })
</script>
@endpush