@extends('backend.layouts.master')

@section('title',"Bening's || Product Purchase")
@section('main-content')

<div class="card">
    <h5 class="card-header">Product Purchase</h5>
    <div class="card-body">
        <form method="post" action="{{ route('purchase.store') }}">
          {{ csrf_field() }}
          
            <div class="row">
                <div class="col col-md-6">
                    <div class="form-group">
                        <label for="inputProduct">Product <span class="text-danger">*</span></label>
                        <select name="product_id" id="inputProduct" class="form-control">
                            <option value="">--Select any product--</option>
                            @foreach($products as $key=>$product)
                                <option value='{{ $product->id }}'>{{ $product->name }}</option>
                            @endforeach
                        </select>
                        @error('product_id')
                          <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="inputQty" class="col-form-label">Quantity <span class="text-danger">*</span></label>
                        <input id="inputQty" type="number" name="qty" placeholder="Enter quantity"  value="{{ old('qty') }}" class="form-control">
                        @error('qty')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="inputPrice" class="col-form-label">Price <span class="text-danger">*</span></label>
                        <input id="inputPrice" type="number" name="price" placeholder="Enter price"  value="{{ old('price') }}" class="form-control">
                        @error('price')
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
                </div>
                <div class="col col-md-6">
                    <div class="form-group">
                        <label for="inputSupplier">Supplier <span class="text-danger">*</span></label>
                        <select name="supplier_id" id="inputSupplier" class="form-control">
                            <option value="">--Select any supplier--</option>
                            @foreach($suppliers as $key=>$supplier)
                                <option value='{{ $supplier->id }}'>{{ $supplier->name }}</option>
                            @endforeach
                        </select>
                        @error('supplier_id')
                          <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="inputRecipient" class="col-form-label">Recipient <span class="text-danger">*</span></label>
                        <input id="inputRecipient" type="text" name="recipient" placeholder="Enter recipient"  value="{{ old('recipient') }}" class="form-control">
                        @error('recipient')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
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
@endpush