@extends('backend.layouts.master')

@section('title',"Bening's || Price Page")
@section('main-content')
<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="row">
        <div class="col-md-12">
            @include('backend.layouts.notification')
        </div>
    </div>
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary float-left">Price Lists</h6>
        <a href="{{ route('price.create') }}" class="btn btn-primary btn-sm float-right" data-toggle="tooltip"
            data-placement="bottom" title="Add User"><i class="fas fa-plus"></i> Add Price</a>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            @if(count($products)>0)
            <table class="table table-bordered" id="price-dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th width='10px'>Details</th>
                        <th>Product</th>
                        <th>Price</th>
                        <th width="50px">Action</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>Details</th>
                        <th>Product</th>
                        <th>Price</th>
                        <th>Action</th>
                    </tr>
                </tfoot>
                <tbody>
                    @foreach($products as $key => $product)
                        <tr>
                            <td class="dt-control" data-data='{{ $product }}'></td>
                            <td>{{ collect($product)->first()['product']['name'] }}</td>
                            <td style="text-align: right">Rp
                                @foreach ($customer_prices as $cp)
                                    @if ($key == $cp['product_id'])
                                        {{ number_format($cp['price'], 2, ",", ".") }}
                                    @endif
                                @endforeach
                            </td>
                            <td>
                                <a href="{{ route('price.edit', $key) }}" class="btn btn-primary btn-sm float-left mr-1"
                                    style="height:30px; width:30px;border-radius:50%" data-toggle="tooltip" title="edit"
                                    data-placement="bottom"><i class="fas fa-edit"></i></a>
                                <form method="POST" action="{{ route('price.destroy', $key) }}">
                                    @csrf
                                    @method('delete')
                                    <button class="btn btn-danger btn-sm dltBtn" data-id={{ $key }}
                                        style="height:30px; width:30px;border-radius:50%" data-toggle="tooltip"
                                        data-placement="bottom" title="Delete"><i class="fas fa-trash-alt"></i></button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            @include('backend.layouts.pagination');

            @else
            <h6 class="text-center">No Prices found!!! Please create Price</h6>
            @endif
        </div>
    </div>
</div>
@endsection

@push('styles')
<link href="{{asset('backend/vendor/datatables/datatables.min.css')}}" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css" />
<style>
    .zoom {
        transition: transform .2s;
        /* Animation */
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

<!-- Page price custom scripts -->
<script>
    var table = $('#price-dataTable').DataTable({
        "paging": false,
        "info": false
    });

    function currency(number) {
        return new Intl.NumberFormat('id-ID', {
            style: 'currency',
            currency: 'IDR'
        }).format(number)
    }

    function format(d) {

        let list =
            '<div class="table-responsive"> <table class="table"> <thead> <th style="text-align:center;">Product</th> <th style="text-align:center;">Level Mitra</th> <th style="text-align:center;">Price Type</th> <th style="text-align:center;">Price</th> </thead>';
        d.forEach((row) => {
            // console.log(row)
            let price_t = '';
            if (row.level.type == 1) {
                price_t = 'Customer'
            } else price_t = 'Mitra'

            let r = '<tr>' +
                '<td>' +
                row.product.name +
                '</td>' +
                '<td>' +
                row.level.name +
                '</td>' +
                '<td style="text-align:center;">' +
                price_t +
                '</td>' +
                '<td style="text-align:right;">' +
                currency(row.price) +
                '</td>' +
                '</tr>';

            list += r
        })

        return list;
    }

    // Add event listener for opening and closing details
    $('#price-dataTable tbody').on('click', 'td.dt-control', function () {
        var tr = $(this).closest('tr');
        var row = table.row(tr);
        var dataPrice = $(this).data("data");
        // var dataProduct = $(this).data("product");

        console.log(dataPrice);

        if (row.child.isShown()) {
            // This row is already open - close it
            row.child.hide();
            tr.removeClass('shown');
        } else {
            // Open this row
            row.child(format(dataPrice)).show();
            tr.addClass('shown');
        }
    });

    $(document).ready(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $('.dltBtn').click(function (e) {
            var form = $(this).closest('form');
            var dataID = $(this).data('id');
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
