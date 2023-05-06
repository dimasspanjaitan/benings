@extends('backend.layouts.master')

@section('main-content')
 <!-- DataTales Example -->
 <div class="card shadow mb-4">
     <div class="row">
         <div class="col-md-12">
            @include('backend.layouts.notification')
         </div>
     </div>
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary float-left">Sale Lists</h6>
      <a href="{{route('product.create')}}" class="btn btn-primary btn-sm float-right" data-toggle="tooltip" data-placement="bottom" title="Add User"><i class="fas fa-plus"></i> Add Product</a>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        @if(count($sales)>0)
        <table class="table table-bordered" id="product-dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th width='10px'>S.N.</th>
              <th>Status</th>
              <th>Name</th>
              <th>Total</th>
              <th>Sale Date</th>
              <th>Code</th>
              <th>Description</th>
              {{-- <th>Date</th> --}}
              {{-- <th>Weight</th> --}}
              <th>Action</th>
            </tr>
          </thead>
          <tfoot>
            <tr>
              <th>S.N.</th>
              <th>Status</th>
              <th>Name</th>
              <th>Total</th>
              <th>Sale Date</th>
              <th>Code</th>
              <th>Description</th>
              {{-- <th>Date</th> --}}
              {{-- <th>Weight</th> --}}
              <th>Action</th>
            </tr>
          </tfoot>
          <tbody>

            @foreach($sales as $sale)
                <tr>
                    {{-- <td>{{$sale->id}}</td> --}}
                    <td class="dt-control" data-data='{{ $sale->details }}'></td>
                    <td>
                        @if($sale->status==1)
                            <span class="badge badge-success">Active</span>
                        @else
                            <span class="badge badge-warning">Inactive</span>
                        @endif
                    </td>
                    <td>{{$sale->user->name}}</td>
                    <td>{{$sale->total}}</td>
                    <td>{{$sale->sale_date}}</td>
                    <td>{{$sale->code}}</td>
                    <td>{{$sale->description}}</td>
                    <td></td>
                </tr>
            @endforeach
          </tbody>
        </table>
        {{-- <span style="float:right">{{$sales->links()}}</span> --}}
        @else
          <h6 class="text-center">No sales found!!! Please create sale</h6>
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
  <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

  <!-- Page level custom scripts -->
  {{-- <script src="{{asset('backend/js/demo/datatables-demo.js')}}"></script> --}}
  <script>

      var table = $('#product-dataTable').DataTable( {
        // "scrollX": false
        //     "columnDefs":[
        //         {
        //             "orderable":false,
        //             "targets":[10,11,12]
        //         }
        //     ]
        // },
        "paging": true

        });

      function format(d) {
          // `d` is the original data object for the row
          return (
              '<table cellpadding="5" cellspacing="0" border="0" style="padding-left:50px;">' +
              '<tr>' +
              '<td>Full name:</td>' +
              '<td>' +
              d.name +
              '</td>' +
              '</tr>' +
              '<tr>' +
              '<td>Extension number:</td>' +
              '<td>' +
              d.extn +
              '</td>' +
              '</tr>' +
              '<tr>' +
              '<td>Extra info:</td>' +
              '<td>And any further details here (images etc)...</td>' +
              '</tr>' +
              '</table>'
          );
      }

      // Add event listener for opening and closing details
      $('#product-dataTable tbody').on('click', 'td.dt-control', function () {
          var tr = $(this).closest('tr');
          var row = table.row(tr);

          console.log($(this).data("data"));

          if (row.child.isShown()) {
              // This row is already open - close it
              row.child.hide();
              tr.removeClass('shown');
          } else {
              // Open this row
              row.child(format(row.data())).show();
              tr.addClass('shown');
          }
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
