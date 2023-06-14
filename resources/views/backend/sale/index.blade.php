@extends('backend.layouts.master')

@section('title',"Bening's || Sale Page")
@section('main-content')

{{-- {{ dd($pagination) }} --}}
 <!-- DataTales Example -->
 <div class="card shadow mb-4">
     <div class="row">
         <div class="col-md-12">
            @include('backend.layouts.notification')
         </div>
     </div>
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary float-left">Sale Lists</h6>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        @if(count($sales)>0)
        <table class="table table-bordered" id="product-dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>Details</th>
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
              <th>Details</th>
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
                        <select class="form-control {{ $sale->class }} status-type" data-data="{{ $sale }}" name="status">
                          <option value="1" {{ $sale->status==1 ? 'selected' : '' }}>Confirm</option>
                          <option value="2" {{ $sale->status==2 ? 'selected' : '' }}>Processed</option>
                          <option value="3" {{ $sale->status==3 ? 'selected' : '' }}>Shipped</option>
                          <option value="4" {{ $sale->status==4 ? 'selected' : '' }}>Succeed</option>
                          <option value="5" {{ $sale->status==5 ? 'selected' : '' }}>Canceled</option>
                        </select>
                    </td>
                    <td>{{$sale->user->name}}</td>
                    <td>Rp{{ number_format($sale->total, 2, ",", ".") }}</td>
                    <td>{{$sale->sale_date}}</td>
                    <td>{{$sale->code}}</td>
                    <td>{{$sale->description}}</td>
                    <td></td>
                </tr>
            @endforeach
          </tbody>
        </table>
        
        {{-- Pagination --}}
        @include('backend.layouts.pagination');

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

  <!-- Page sale plugins -->
  <script src="{{asset('backend/vendor/datatables/jquery.dataTables.min.js')}}"></script>
  <script src="{{asset('backend/vendor/datatables/datatables.min.js')}}"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

  <!-- Page sale custom scripts -->
  <script>

      var table = $('#product-dataTable').DataTable( {
        "paging": false,
        "info": false
      });

      function currency(number){
        return new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR' }).format(number)
      }

      function format(d) {
          // `d` is the original data object for the row
          // console.log(d);

          let list = '<div class="table-responsive"> <table class="table"> <thead> <th style="text-align:center;">Product</th> <th style="text-align:center;">Price</th> <th style="text-align:center;">Qty</th> <th style="text-align:center;">Unit</th> <th style="text-align:center;">Total</th> </thead>';
          let grandTotal = 0;
          d.forEach((row) => {
            console.log(row);
              let total = parseInt(row.price) * parseInt(row.qty);
              let r = '<tr>' +
                '<td>' +
                row.product.name +
                '</td>' +
                '<td style="text-align:right;">' +
                currency(row.price) +
                '</td>' +
                '<td style="text-align:center;">' +
                row.qty +
                '</td>' +
                '<td style="text-align:center;">' +
                row.unit +
                '</td>' +
                '<td style="text-align:right;">' +
                currency(total) +
                '</td>' +
              '</tr>';

              list += r
              grandTotal += total;
          })

          list +=`<tfoot> <th colspan="4" style="text-align: right; padding-right: 50px;">GRAND TOTAL</th> <th style="text-align:right;">${currency(grandTotal)}</th> </tfoot> </table> </div>`;

          return list;
      }

      // Add event listener for opening and closing details
      $('#product-dataTable tbody').on('click', 'td.dt-control', function () {
          var tr = $(this).closest('tr');
          var row = table.row(tr);

          // console.log($(this).data("data"));

          if (row.child.isShown()) {
              // This row is already open - close it
              row.child.hide();
              tr.removeClass('shown');
          } else {
              // Open this row
              row.child(format($(this).data("data"))).show();
              tr.addClass('shown');
          }
      });

      $(document).ready(function(){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
          $('.status-type').change(function(e){
            let data = $(this).data('data');
            let current_status = $(this).val();

            $.ajax({
              type: "POST",
              url: '{{ route('api.sale.change-status') }}',
              data: {
                id: data.id,
                status: current_status
              },
              dataType: 'aplication/json'
            })

            window.location.reload();
          })
      })
  </script>
@endpush
