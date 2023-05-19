@extends('backend.layouts.master')

@section('main-content')

<div class="row">
  <div class="col-md-12">
     @include('backend.layouts.notification')
  </div>
</div>

<div class="card">
    <h5 class="card-header">Edit Price Level</h5>
    <div class="card-body">
      <form method="post" action="{{ route('price.update', $data['product_id']) }}">
        @csrf 
        @method('PATCH')

        <div class="form-group" style="padding-right:36px">
          <label for="product_id">Product <span class="text-danger">*</span></label>
          <select name="product_id" id="product_id" class="form-control">
              @foreach($data['products'] as $product)
                  @if ($data['product_id'] == $product->id)
                    <option value='{{ $product->id }}' selected>{{ $product->name }}</option>
                  @endif
              @endforeach
          </select>
          @error('product_id')
            <span class="text-danger">{{ $message }}</span>
          @enderror
        </div>

        <div class="col-12 row pl-0">
          @foreach ($data['prices'] as $level)
              <div class="col-md-6">
                  <div class="form-group">
                    <label for="{{  $level->level->name  }}" class="col-form-label">{{  $level->level->name  }} <span class="text-danger">*</span></label>
                    <input id="{{  $level->level->id  }}" type="number" name="price_{{  $level->level->id  }}" placeholder="Enter price"  value="{{  $level->price  }}" class="form-control">
                    @error("price_".$level->level->id)
                      <span class="text-danger">{{ $message }}</span>
                    @enderror
                  </div>
              </div>
          @endforeach
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
        height: 150
    });
    });
</script>
@endpush