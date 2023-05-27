@extends('backend.layouts.master')

@section('title',"Bening's || Supplier Page")
@section('main-content')
 <!-- DataTales Example -->
 <div class="card shadow mb-4">
     <div class="row">
         <div class="col-md-12">
            @include('backend.layouts.notification')
         </div>
     </div>
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary float-left">Suppliers List</h6>
      <a href="{{ route('supplier.create') }}" class="btn btn-primary btn-sm float-right" data-toggle="tooltip" data-placement="bottom" title="Add User"><i class="fas fa-plus"></i> Add supplier</a>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        @if(count($suppliers)>0)
          <table class="table table-bordered" id="supplier-dataTable" width="100%" cellspacing="0">
            <thead>
              <tr>
                <th width="10px">ID</th>
                <th width="10%">Status</th>
                <th>Name</th>
                <th>Level</th>
                <th>Phone</th>
                <th>Email</th>
                <th>Description</th>
                <th width="65px">Action</th>
              </tr>
            </thead>
            <tfoot>
              <tr>
                <th>ID</th>
                <th>Status</th>
                <th>Name</th>
                <th>Level</th>
                <th>Phone</th>
                <th>Email</th>
                <th>Description</th>
                <th>Action</th>
                </tr>
            </tfoot>
            <tbody>
              @foreach($suppliers as $supplier)   
                  <tr>
                      <td>{{ $supplier->id }}</td>
                      <td>
                          @if($supplier->status==1)
                              <span class="badge badge-success">Active</span>
                          @else
                              <span class="badge badge-warning">Inactive</span>
                          @endif
                      </td>
                      <td>{{ $supplier->name }}</td>
                      <td>{{ $supplier->levels->name }}</td>
                      <td>{{ $supplier->phone }}</td>
                      <td>{{ $supplier->email }}</td>
                      <td>{{ $supplier->description }}</td>
                      <td>
                          <a href="{{ route('supplier.edit',$supplier->id) }}" class="btn btn-primary btn-sm float-left mr-1" style="height:30px; width:30px;border-radius:50%" data-toggle="tooltip" title="edit" data-placement="bottom"><i class="fas fa-edit"></i></a>
                          <form method="POST" action="{{ route('supplier.destroy',[$supplier->id]) }}">
                            @csrf 
                            @method('delete')
                                <button class="btn btn-danger btn-sm dltBtn" data-id={{ $supplier->id }} style="height:30px; width:30px;border-radius:50%" data-toggle="tooltip" data-placement="bottom" title="Delete"><i class="fas fa-trash-alt"></i></button>
                          </form>
                      </td>
                  </tr>  
              @endforeach
            </tbody>
          </table>

          {{-- Pagination --}}
          @include('backend.layouts.pagination');

        @else
          <h6 class="text-center">No suppliers found!!! Please create supplier</h6>
        @endif
      </div>
    </div>
</div>
@endsection

@push('styles')
  <link href="{{asset('backend/vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css" />
  <style>
      div.dataTables_wrapper div.dataTables_paginate{
          display: none;
      }
      .zoom {
        transition: transform .2s; /* Animation */
      }

      .zoom:hover {
        transform: scale(3.2);
      }
  </style>
@endpush

@push('scripts')

  <!-- Page level plugins -->
  <script src="{{asset('backend/vendor/datatables/jquery.dataTables.min.js')}}"></script>
  <script src="{{asset('backend/vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

  <!-- Page level custom scripts -->
  <script src="{{asset('backend/js/demo/datatables-demo.js')}}"></script>
  <script>
      
      $('#supplier-dataTable').DataTable( {
        "paging": false,
        "info": false
      } );
      
      $(document).ready(function(){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
          $('.dltBtn').click(function(e){
            var form=$(this).closest('form');
              var dataID=$(this).data('id');
              // alert(dataID);
              e.preventDefault();
              swal({
                    title: "Are you sure?",
                    text: "Once deleted, you will not be able to recover this data!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                       form.submit();
                    } else {
                        swal("Your data is safe!");
                    }
                });
          })
      })
  </script>
@endpush