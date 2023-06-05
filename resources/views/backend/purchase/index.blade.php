@extends('backend.layouts.master')

@section('title',"Bening's || Purchase Page")
@section('main-content')
 <!-- DataTales Example -->
 <div class="card shadow mb-4">
     <div class="row">
         <div class="col-md-12">
            @include('backend.layouts.notification')
         </div>
     </div>
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary float-left">Purchase Lists</h6>
      <a href="{{ route('purchase.create') }}" class="btn btn-primary btn-sm float-right" data-toggle="tooltip" data-placement="bottom" title="Add User"><i class="fas fa-plus"></i> Buy Product</a>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        @if(count($purchases)>0)
          <table class="table table-bordered" id="product-dataTable" width="100%" cellspacing="0">
            <thead>
              <tr>
                <th width='10px'>ID</th>
                <th>Supplier</th>
                <th>Recipient</th>
                <th>Product</th>
                <th>Qty</th>
                <th>Price</th>
                <th>Amount</th>
                <th>Purchase Date</th>
              </tr>
            </thead>
            <tfoot>
              <tr>
                <th>ID</th>
                <th>Supplier</th>
                <th>Recipient</th>
                <th>Product</th>
                <th>Qty</th>
                <th>Price</th>
                <th>Amount</th>
                <th>Purchase Date</th>
              </tr>
            </tfoot>
            <tbody>

              @foreach($purchases as $purchase)
                  <tr>
                      <td>{{$purchase->id}}</td>
                      <td>{{$purchase->purchase->supplier->name}}</td>
                      <td>{{$purchase->purchase->recipient}}</td>
                      <td>{{$purchase->product->name}}</td>
                      <td>{{$purchase->qty}}</td>
                      <td>{{$purchase->price}}</td>
                      <td>{{$purchase->purchase->amount}}</td>
                      <td>{{$purchase->purchase->purchase_date}}</td>
                  </tr>
              @endforeach
            </tbody>
          </table>

          {{-- @include('backend.layouts.pagination'); --}}

        @else
          <h6 class="text-center">No Products found!!! Please create Product</h6>
        @endif
      </div>
    </div>
</div>
@endsection

@push('styles')
  <link href="{{asset('backend/vendor/datatables/datatables.min.css')}}" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css" />
  <style>
      /* div.dataTables_wrapper div.dataTables_paginate{
          display: none;
      } */
      .zoom {
        transition: transform .2s; /* Animation */
      }

      .zoom:hover {
        transform: scale(5);
      }
  </style>
@endpush

@push('scripts')

  <!-- Page level plugins -->
  <script src="{{asset('backend/vendor/datatables/jquery.dataTables.min.js')}}"></script>
  <script src="{{asset('backend/vendor/datatables/datatables.min.js')}}"></script>
  <script>

      $('#product-dataTable').DataTable( {
        "paging": false,
        "info" : false
      });

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
