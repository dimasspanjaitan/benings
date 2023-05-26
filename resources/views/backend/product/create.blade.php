@extends('backend.layouts.master')

@section('title',"Bening's || Product Create")
@section('main-content')

<div class="card">
    <h5 class="card-header">Add Product</h5>
    <div class="card-body">
      <form method="post" enctype="multipart/form-data" action="{{ route('product.store') }}">
        {{ csrf_field() }}
        <div class="form-group">
          <label for="inputName" class="col-form-label">Name <span class="text-danger">*</span></label>
          <input id="inputName" type="text" name="name" placeholder="Enter name"  value="{{ old('name') }}" class="form-control">
          @error('name')
            <span class="text-danger">{{ $message }}</span>
          @enderror
        </div>

        <div class="form-group">
          <label for="summary" class="col-form-label">Summary <span class="text-danger">*</span></label>
          <textarea class="form-control" name="summary" placeholder="Write short description.....">{{ old('summary') }}</textarea>
          @error('summary')
            <span class="text-danger">{{ $message }}</span>
          @enderror
        </div>

        <div class="form-group">
          <label for="description" class="col-form-label">Description </label>
          <textarea class="form-control" name="description" placeholder="Write detail description.....">{{ old('description') }}</textarea>
          @error('description')
            <span class="text-danger">{{ $message }}</span>
          @enderror
        </div>

        <div class="form-group">
          <label for="category_id">Category <span class="text-danger">*</span></label>
          <select name="category_id" id="category_id" class="form-control">
              <option value="">--Select any category--</option>
              @foreach($categories as $key=>$cat_data)
                  <option value='{{ $cat_data->id }}'>{{ $cat_data->title }}</option>
              @endforeach
          </select>
          @error('category_id')
            <span class="text-danger">{{ $message }}</span>
          @enderror
        </div>

        {{-- <div class="form-group">
          <label for="weight">Weight </label>
          <input id="weight" type="number" name="weight" placeholder="Enter weight"  value="{{ old('weight') }}" class="form-control">
          @error('weight')
            <span class="text-danger">{{ $message }}</span>
          @enderror
        </div> --}}

        <div class="form-group">
          <label for="photo" class="col-form-label">Photo <span class="text-danger">*</span></label>
            <div class="col-12 row pl-0">
              <div class="col-md-6">
                <div class="input-group">
                    {{-- <input type="file" class="form-control-file" id="photo" name="photo" value="{{ old('photo') }}"> --}}
                    <label class="custom-file">
                      <input type="file" class="custom-file-input" id="photo" name="photo"
                        aria-describedby="photo" value="{{ old('photo') }}">
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
          <label for="status" class="col-form-label">Status <span class="text-danger">*</span></label>
          <select name="status" class="form-control">
              <option value="1">Active</option>
              <option value="0">Inactive</option>
          </select>
          @error('status')
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

@push('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.css" />
@endpush

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>

<script>
  $('.custom-file-input').on('change',function(){
    var filePhoto = document.getElementById("photo").files[0].name;
    $(this).next('.form-control-input').addClass("selected").html(filePhoto);
  })
</script>
@endpush