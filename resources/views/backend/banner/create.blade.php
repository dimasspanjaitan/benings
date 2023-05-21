@extends('backend.layouts.master')

@section('title',"Bening's || Banner Create")
@section('main-content')

<div class="card">
    <h5 class="card-header">Add Banner</h5>
    <div class="card-body">
      <form method="post" enctype="multipart/form-data" action="{{route('banner.store')}}">
        {{csrf_field()}}
        <div class="form-group">
          <label for="inputTitle" class="col-form-label">Title <span class="text-danger">*</span></label>
        <input id="inputTitle" type="text" name="title" placeholder="Enter title"  value="{{old('title')}}" class="form-control">
        @error('title')
        <span class="text-danger">{{$message}}</span>
        @enderror
        </div>

        <div class="form-group">
          <label for="inputDesc" class="col-form-label">Description</label>
          <textarea class="form-control" name="description" placeholder="Write detail description..... ">{{old('description')}}</textarea>
          @error('description')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>

        <div class="form-group">
          <label for="photo" class="col-form-label">Photo <span class="text-danger">*</span></label>
            <div class="col-12 row pl-0">
              <div class="col-md-6">
                <div class="input-group">
                    {{-- <input type="file" class="form-control-file" id="photo" name="photo" value="{{ old('photo') }}"> --}}
                    <div class="custom-file">
                      <input type="file" class="custom-file-input" id="photo"
                        aria-describedby="photo" value="{{ old('photo') }}">
                      <label class="custom-file-label" for="photo">Choose file</label>
                    </div>
                </div>
              </div>
              <div class="col-md-6"></div>
            </div>
            @error('photo')
              <span class="text-danger">{{$message}}</span>
            @enderror
        </div>
        
        <div class="form-group">
          <label for="status" class="col-form-label">Status <span class="text-danger">*</span></label>
          <select name="status" class="form-control">
              <option value="1">Active</option>
              <option value="0">Inactive</option>
          </select>
          @error('status')
          <span class="text-danger">{{$message}}</span>
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