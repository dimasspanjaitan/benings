@extends('backend.layouts.master')

@section('title',"Bening's || Banner Edit")
@section('main-content')

<div class="card">
    <h5 class="card-header">Edit Banner</h5>
    <div class="card-body">
      <form method="post" enctype="multipart/form-data" action="{{ route('banner.update',$banner->id) }}">
        @csrf 
        @method('PATCH')
        <div class="form-group">
          <label for="inputTitle" class="col-form-label">Title <span class="text-danger">*</span></label>
        <input id="inputTitle" type="text" name="title" placeholder="Enter title"  value="{{ $banner->title }}" class="form-control">
        @error('title')
        <span class="text-danger">{{ $message }}</span>
        @enderror
        </div>

        <div class="form-group">
          <label for="inputDesc" class="col-form-label">Description</label>
          <textarea class="form-control" name="description" placeholder="Write detail description..... "> {{ $banner->description }} </textarea>
          @error('description')
          <span class="text-danger">{{ $message }}</span>
          @enderror
        </div>

        <div class="form-group">
          <label for="photo" class="col-form-label">Photo <span class="text-danger">*</span></label>
            <div class="col-12 row pl-0">
              <div class="col-md-6">
                <div class="input-group">
                    {{-- <input type="file" class="form-control-file" id="photo" name="photo" value="{{ old('photo') }}"> --}}
                    <label class="custom-file">
                      <input type="file" class="custom-file-input" id="photo" name="photo"
                        aria-describedby="photo" value="{{ $banner->photo }}">
                      @if (!empty($banner->photo))
                        <span class="custom-file-label form-control-input" for="photo">{{ $banner->photo }}</span>
                      @else
                        <span class="custom-file-label form-control-input" for="photo">Choose file</span>
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
          <label for="status" class="col-form-label">Status <span class="text-danger">*</span></label>
          <select name="status" class="form-control">
            <option value="1" {{ (( $banner->status=='active') ? 'selected' : '') }}>Active</option>
            <option value="0" {{ (($banner->status=='inactive') ? 'selected' : '') }}>Inactive</option>
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
<script>
    $('.custom-file-input').on('change',function(){
      var filePhoto = document.getElementById("photo").files[0].name;
      $(this).next('.form-control-input').addClass("selected").html(filePhoto);
    })
</script>
@endpush