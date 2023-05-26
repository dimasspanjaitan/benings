@extends('backend.layouts.master')

@section('title',"Bening's || Product Edit")
@section('main-content')

<div class="card">
    <h5 class="card-header">Edit Product</h5>
    <div class="card-body">
      <form method="post" enctype="multipart/form-data" action="{{ route('product.update',$product->id) }}">
        @csrf 
        @method('PATCH')
        <div class="form-group">
          <label for="inputName" class="col-form-label">Name <span class="text-danger">*</span></label>
          <input id="inputName" type="text" name="name" placeholder="Enter name"  value="{{ $product->name }}" class="form-control">
          @error('name')
            <span class="text-danger">{{ $message }}</span>
          @enderror
        </div>

        <div class="form-group">
          <label for="summary" class="col-form-label">Summary <span class="text-danger">*</span></label>
          <textarea class="form-control" name="summary" placeholder="Write short description.....">{{ $product->summary }}</textarea>
          @error('summary')
            <span class="text-danger">{{ $message }}</span>
          @enderror
        </div>

        <div class="form-group">
          <label for="description" class="col-form-label">Description</label>
          <textarea class="form-control" name="description" placeholder="Write detail description.....">{{ $product->description }}</textarea>
          @error('description')
            <span class="text-danger">{{ $message }}</span>
          @enderror
        </div>

        <div class="form-group">
          <label for="category_id">Category <span class="text-danger">*</span></label>
          <select name="category_id" id="category_id" class="form-control">
              <option value="">--Select any category--</option>
              @foreach($categories as $key=>$cat_data)
                  <option value='{{ $cat_data->id }}' {{ (($product->category_id==$cat_data->id)? 'selected' : '') }}>{{ $cat_data->title }}</option>
              @endforeach
          </select>
          @error('category_id')
            <span class="text-danger">{{ $message }}</span>
          @enderror
        </div>
        
        {{-- <div class="form-group">
          <label for="weight">Weight</label>
          <input id="weight" type="number" name="weight" placeholder="Enter weight"  value="{{ $product->weight }}" class="form-control">
          @error('weight')
            <span class="text-danger">{{ $message }}</span>
          @enderror
          </select>
        </div> --}}

        <div class="form-group">
          <label for="photo" class="col-form-label">Photo <span class="text-danger">*</span></label>
            <div class="col-12 row pl-0">
                <div class="col-md-6">
                  <div class="input-group">
                    {{-- <input type="file" class="form-control-file" id="photo" name="photo" value="{{ $product->photo }}"> --}}
                    <label class="custom-file">
                      <input type="file" class="custom-file-input" id="photo" name="photo"
                        aria-describedby="photo" value="{{ $product->photo }}">
                      @if (!empty($product->photo))
                        <span class="custom-file-label form-control-input" for="photo">{{ $product->photo }}</span>
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
            <option value="1" {{ (($product->status==1)? 'selected' : '') }}>Active</option>
            <option value="0" {{ (($product->status==0)? 'selected' : '') }}>Inactive</option>
        </select>
          @error('status')
            <span class="text-danger">{{ $message }}</span>
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