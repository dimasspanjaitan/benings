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
          <textarea class="form-control" id="description" name="description">{{ $data->description }}</textarea>
          @error('description')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>

        <div class="form-group">
          <label for="logo" class="col-form-label">Logo Utama <span class="text-danger">*</span></label>
            <div class="col-12 row pl-0">
                <div class="col-md-6">
                  <div class="input-group">
                    <div class="custom-file">
                      <input type="file" class="custom-file-input" name="logo"
                        aria-describedby="logo" value="{{ $data->logo }}">
                      @if (!empty($data->logo))
                        <label class="custom-file-label" for="logo">{{ $data->logo }}</label>
                      @else
                        <label class="custom-file-label" for="logo">Choose file</label>
                      @endif
                    </div>
                </div>
              </div>
              <div class="col-md-6"></div>
            </div>
            @error('logo')
              <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
          <label for="logo_admin" class="col-form-label">Logo Admin <span class="text-danger">*</span></label>
            <div class="col-12 row pl-0">
                <div class="col-md-6">
                  <div class="input-group">
                    <div class="custom-file">
                      <input type="file" class="custom-file-input" name="logo_admin"
                        aria-describedby="logo_admin" value="{{ $data->logo_admin }}">
                      @if (!empty($data->logo_admin))
                        <label class="custom-file-label" for="logo_admin">{{ $data->logo_admin }}</label>
                      @else
                        <label class="custom-file-label" for="logo_admin">Choose file</label>
                      @endif
                    </div>
                </div>
              </div>
              <div class="col-md-6"></div>
            </div>
            @error('logo_admin')
              <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
          <label for="favicon" class="col-form-label">Logo Favicon <span class="text-danger">*</span></label>
            <div class="col-12 row pl-0">
                <div class="col-md-6">
                  <div class="input-group">
                    <div class="custom-file">
                      <input type="file" class="custom-file-input" name="favicon"
                        aria-describedby="favicon" value="{{ $data->favicon }}">
                      @if (!empty($data->favicon))
                        <label class="custom-file-label" for="favicon">{{ $data->favicon }}</label>
                      @else
                        <label class="custom-file-label" for="favicon">Choose file</label>
                      @endif
                    </div>
                </div>
              </div>
              <div class="col-md-6"></div>
            </div>
            @error('favicon')
              <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
          <label for="photo" class="col-form-label">Photo <span class="text-danger">*</span></label>
            <div class="col-12 row pl-0">
                <div class="col-md-6">
                  <div class="input-group">
                    <div class="custom-file">
                      <input type="file" class="custom-file-input" name="photo"
                        aria-describedby="photo" value="{{ $data->photo }}">
                      @if (!empty($data->photo))
                        <label class="custom-file-label" for="photo">{{ $data->photo }}</label>
                      @else
                        <label class="custom-file-label" for="photo">Choose file</label>
                      @endif
                    </div>
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
    $('#lfm').filemanager('image');
    $('#lfm1').filemanager('image');
    $(document).ready(function() {
    $('#summary').summernote({
      placeholder: "Write short description.....",
        tabsize: 2,
        height: 150
    });
    });

    $(document).ready(function() {
      $('#quote').summernote({
        placeholder: "Write short Quote.....",
          tabsize: 2,
          height: 100
      });
    });
    $(document).ready(function() {
      $('#description').summernote({
        placeholder: "Write detail description.....",
          tabsize: 2,
          height: 150
      });
    });
</script>
@endpush