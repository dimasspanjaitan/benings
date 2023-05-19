@extends('backend.layouts.master')

@section('main-content')

<div class="row">
  <div class="col-md-12">
     @include('backend.layouts.notification')
  </div>
</div>

<div class="card">
    <h5 class="card-header">Add Price Level</h5>
    <div class="card-body">
      <form method="post" action="{{route('price.store')}}">
        {{csrf_field()}}

        <div class="form-group" style="padding-right:36px">
          <label for="product_id">Product <span class="text-danger">*</span></label>
          <select name="product_id" id="product_id" class="form-control">
              <option value="">--Select any product--</option>
              @foreach($products as $product)
                  <option value='{{$product->id}}'>{{$product->name}}</option>
              @endforeach
          </select>
          @error('product_id')
            <span class="text-danger">{{$message}}</span>
          @enderror
        </div>

        <div class="col-12 row">
          @foreach ($levels as $level)
              <div class="col-md-6 pl-0">
                  <div class="form-group">
                    <label for="{{ $level->name }}" class="col-form-label">{{ $level->name }} <span class="text-danger">*</span></label>
                    <input id="{{ $level->id }}" type="number" name="price_{{ $level->id }}" placeholder="Enter price"  value="{{old("price_".$level->id)}}" class="form-control">
                    @error("price_".$level->id)
                      <span class="text-danger">{{$message}}</span>
                    @enderror
                  </div>
              </div>
          @endforeach
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
<link rel="stylesheet" href="{{asset('backend/summernote/summernote.min.css')}}">
@endpush
@push('scripts')
<script src="/vendor/laravel-filemanager/js/stand-alone-button.js"></script>
<script src="{{asset('backend/summernote/summernote.min.js')}}"></script>
<script>
    $('#lfm').filemanager('image');

    $(document).ready(function() {
      $('#description').summernote({
        placeholder: "Write short description.....",
          tabsize: 2,
          height: 120
      });
    });
</script>x  
@endpush