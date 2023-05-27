@extends('backend.layouts.master')

@section('title',"Bening's || Supplier Edit")
@section('main-content')

<div class="card">
    <h5 class="card-header">Edit Supplier</h5>
    <div class="card-body">
      <form method="post" action="{{ route('supplier.update',$supplier->id) }}">
        @csrf 
        @method('PATCH')

        <div class="form-group">
          <label for="inputName" class="col-form-label">Name <span class="text-danger">*</span></label>
          <input id="inputName" type="text" name="name" placeholder="Enter name"  value="{{ $supplier->name }}" class="form-control">
          @error('name')
            <span class="text-danger">{{$message}}</span>
          @enderror
        </div>

        <div class="form-group">
          <label for="inputLevel">Level <span class="text-danger">*</span></label>
          <select id="inputLevel" name="level_id" class="form-control">
              <option value="">--Select any level--</option>
              @foreach($levels as $key=>$data)
                  <option value='{{ $data->id }}' {{ ($supplier->level_id == $data->id) ? 'selected' : '' }}>{{ $data->name }}</option>
              @endforeach
          </select>
          @error('level_id')
              <span class="text-danger">{{ $message }}</span>
          @enderror
        </div>

        <div class="form-group">
          <label for="inputPhone" class="col-form-label">Phone </label>
          <input id="inputPhone" type="number" name="phone" placeholder="Enter phone"  value="{{ $supplier->phone }}" class="form-control">
          @error('phone')
              <span class="text-danger">{{ $message }}</span>
          @enderror
        </div>

        <div class="form-group">
          <label for="inputEmail" class="col-form-label">Email </label>
          <input id="inputEmail" type="email" name="email" placeholder="Enter email"  value="{{ $supplier->email }}" class="form-control">
          @error('email')
              <span class="text-danger">{{ $message }}</span>
          @enderror
        </div>

        <div class="form-group">
          <label for="inputAddress" class="col-form-label">Address </label>
          <input id="inputAddress" type="text" name="address" placeholder="Enter address"  value="{{ $supplier->address }}" class="form-control">
          @error('address')
            <span class="text-danger">{{$message}}</span>
          @enderror
        </div>

        <div class="form-group">
          <label for="inputDesc" class="col-form-label">Description</label>
          <textarea id="inputDesc" class="form-control" name="description" placeholder="Write detail description..... ">{{ $supplier->description }}</textarea>
          @error('description')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>
        
        <div class="form-group">
          <label for="inputStatus" class="col-form-label">Status <span class="text-danger">*</span></label>
          <select id="inputStatus" name="status" class="form-control">
              <option value="1" {{ ($supplier->status == 1) ? 'selected' : '' }}>Active</option>
              <option value="0" {{ ($supplier->status == 0) ? 'selected' : '' }}>Inactive</option>
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