@extends('frontend.layouts.master')

@section('title', "Bening's || SHIPPING Page")

@section('main-content')
    <!-- Breadcrumbs -->
    <div class="breadcrumbs">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="bread-inner">
                        <ul class="bread-list">
                            <li><a href="{{ route('home') }}">Home<i class="ti-arrow-right"></i></a></li>
                            <li class="active"><a href="javascript:void(0);">Shipping</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Breadcrumbs -->
<section class="tracking_box_area section_gap py-5 mb-5">
    <div class="container">
        <nav>
            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                <a class="nav-item nav-link active" id="nav-all-tab" data-toggle="tab" href="#nav-all" role="tab" aria-controls="nav-all" aria-selected="true">All</a>
                <a class="nav-item nav-link" id="nav-confirm-tab" data-toggle="tab" href="#nav-confirm" role="tab" aria-controls="nav-confirm" aria-selected="false">Confirm</a>
                <a class="nav-item nav-link" id="nav-processed-tab" data-toggle="tab" href="#nav-processed" role="tab" aria-controls="nav-processed" aria-selected="false">Processed</a>
                <a class="nav-item nav-link" id="nav-shipped-tab" data-toggle="tab" href="#nav-shipped" role="tab" aria-controls="nav-shipped" aria-selected="false">Shipped</a>
                <a class="nav-item nav-link" id="nav-succeed-tab" data-toggle="tab" href="#nav-succeed" role="tab" aria-controls="nav-succeed" aria-selected="false">Succeed</a>
                <a class="nav-item nav-link" id="nav-canceled-tab" data-toggle="tab" href="#nav-canceled" role="tab" aria-controls="nav-canceled" aria-selected="false">Canceled</a>
            </div>
        </nav>
        <div class="tab-content" id="nav-tabContent">
            <div class="tab-pane fade show active" id="nav-all" role="tabpanel" aria-labelledby="nav-all-tab">
                @if (!empty($sales))
                    @foreach ($sales as $sale)
                        <div class="card mt-3">
                            <div class="card-header">
                                @if ($sale->status == 1) <span class="badge badge-secondary">Confirm</span> @endif
                                @if ($sale->status == 2) <span class="badge badge-warning">Processed</span> @endif
                                @if ($sale->status == 3) <span class="badge badge-primary">Shipped</span> @endif
                                @if ($sale->status == 4) <span class="badge badge-success">Succeed</span> @endif
                                @if ($sale->status == 5) <span class="badge badge-danger">Canceled</span> @endif

                                <span>{{ $sale->sale_date }}</span>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col col-md-9">
                                        <h5 class="card-title">
                                            @php
                                                $count = count($sale->details);
                                            @endphp
                                            @if ($count > 1)
                                                @foreach ($sale->details as $key => $detail)
                                                    {{ $detail->product->name }}
                                                    {{ ($count !== $key +1) ? '+' : '' }}
                                                @endforeach
                                            @else
                                                {{ $detail->product->name }}
                                            @endif
                                        </h5>
                                        {{-- <p class="card-text">With supporting text below as a natural lead-in to additional content.</p> --}}
                                        <a href="#" class="btn btn-primary">See details >></a>
                                    </div>
                                    <div class="col col-md-3">
                                        <div class="pull-right mr-5">
                                            <p>Total Harga</p>
                                            <h5>Rp {{ number_format($sale->total) }}</h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="card mt-3">
                        <div class="card-body">
                            <p class="text-center">No purchases yet.</p>
                        </div>
                    </div>
                @endif
            </div>
            <div class="tab-pane fade" id="nav-confirm" role="tabpanel" aria-labelledby="nav-confirm-tab">
                @if (!empty($confirms))
                    @foreach ($confirms as $confirm)
                        <div class="card mt-3">
                            <div class="card-header">
                                <span class="badge badge-secondary">Confirm</span>
                                <span>{{ $confirm->sale_date }}</span>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col col-md-9">
                                        <h5 class="card-title">
                                            @php
                                                $count = count($confirm->details);
                                            @endphp
                                            @if ($count > 1)
                                                @foreach ($confirm->details as $key => $detail)
                                                    {{ $detail->product->name }}
                                                    {{ ($count !== $key +1) ? '+' : '' }}
                                                @endforeach
                                            @else
                                                {{ $detail->product->name }}
                                            @endif
                                        </h5>
                                        {{-- <p class="card-text">With supporting text below as a natural lead-in to additional content.</p> --}}
                                        <a href="#" class="btn btn-primary">See details >></a>
                                    </div>
                                    <div class="col col-md-3">
                                        <div class="pull-right mr-5">
                                            <p>Total Harga</p>
                                            <h5>Rp {{ number_format($confirm->total) }}</h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="card mt-3">
                        <div class="card-body">
                            <p class="text-center">There no purchases to confirm yet.</p>
                        </div>
                    </div>
                @endif
            </div>
            <div class="tab-pane fade" id="nav-processed" role="tabpanel" aria-labelledby="nav-processed-tab">
                @if (!empty($processeds))
                    @foreach ($processeds as $processed)
                        <div class="card mt-3">
                            <div class="card-header">
                                <span class="badge badge-warning">Processed</span>
                                <span>{{ $processed->sale_date }}</span>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col col-md-9">
                                        <h5 class="card-title">
                                            @php
                                                $count = count($processed->details);
                                            @endphp
                                            @if ($count > 1)
                                                @foreach ($processed->details as $key => $detail)
                                                    {{ $detail->product->name }}
                                                    {{ ($count !== $key +1) ? '+' : '' }}
                                                @endforeach
                                            @else
                                                {{ $detail->product->name }}
                                            @endif
                                        </h5>
                                        {{-- <p class="card-text">With supporting text below as a natural lead-in to additional content.</p> --}}
                                        <a href="#" class="btn btn-primary">See details >></a>
                                    </div>
                                    <div class="col col-md-3">
                                        <div class="pull-right mr-5">
                                            <p>Total Harga</p>
                                            <h5>Rp {{ number_format($processed->total) }}</h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="card mt-3">
                        <div class="card-body">
                            <p class="text-center">There no purchases to process yet.</p>
                        </div>
                    </div>
                @endif
            </div>
            <div class="tab-pane fade" id="nav-shipped" role="tabpanel" aria-labelledby="nav-shipped-tab">
                @if (!empty($shippeds))
                    @foreach ($shippeds as $shipped)
                        <div class="card mt-3">
                            <div class="card-header">
                                <span class="badge badge-primary">Shipped</span>
                                <span>{{ $shipped->sale_date }}</span>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col col-md-9">
                                        <h5 class="card-title">
                                            @php
                                                $count = count($shipped->details);
                                            @endphp
                                            @if ($count > 1)
                                                @foreach ($shipped->details as $key => $detail)
                                                    {{ $detail->product->name }}
                                                    {{ ($count !== $key +1) ? '+' : '' }}
                                                @endforeach
                                            @else
                                                {{ $detail->product->name }}
                                            @endif
                                        </h5>
                                        {{-- <p class="card-text">With supporting text below as a natural lead-in to additional content.</p> --}}
                                        <a href="#" class="btn btn-primary">See details >></a>
                                    </div>
                                    <div class="col col-md-3">
                                        <div class="pull-right mr-5">
                                            <p>Total Harga</p>
                                            <h5>Rp {{ number_format($shipped->total) }}</h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="card mt-3">
                        <div class="card-body">
                            <p class="text-center">There are no purchases that need to be shipped yet.</p>
                        </div>
                    </div>
                @endif
            </div>
            <div class="tab-pane fade" id="nav-succeed" role="tabpanel" aria-labelledby="nav-succeed-tab">
                @if (!empty($succeeds))
                    @foreach ($succeeds as $succeed)
                        <div class="card mt-3">
                            <div class="card-header">
                                <span class="badge badge-success">Succeed</span>
                                <span>{{ $succeed->sale_date }}</span>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col col-md-9">
                                        <h5 class="card-title">
                                            @php
                                                $count = count($succeed->details);
                                            @endphp
                                            @if ($count > 1)
                                                @foreach ($succeed->details as $key => $detail)
                                                    {{ $detail->product->name }}
                                                    {{ ($count !== $key +1) ? '+' : '' }}
                                                @endforeach
                                            @else
                                                {{ $detail->product->name }}
                                            @endif
                                        </h5>
                                        {{-- <p class="card-text">With supporting text below as a natural lead-in to additional content.</p> --}}
                                        <a href="#" class="btn btn-primary">See details >></a>
                                    </div>
                                    <div class="col col-md-3">
                                        <div class="pull-right mr-5">
                                            <p>Total Harga</p>
                                            <h5>Rp {{ number_format($succeed->total) }}</h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="card mt-3">
                        <div class="card-body">
                            <p class="text-center">No Successful purchases yet.</p>
                        </div>
                    </div>
                @endif
            </div>
            <div class="tab-pane fade" id="nav-canceled" role="tabpanel" aria-labelledby="nav-canceled-tab">
                @if (!empty($canceleds))
                    @foreach ($canceleds as $canceled)
                        <div class="card mt-3">
                            <div class="card-header">
                                <span class="badge badge-danger">Canceled</span>
                                <span>{{ $canceled->sale_date }}</span>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col col-md-9">
                                        <h5 class="card-title">
                                            @php
                                                $count = count($canceled->details);
                                            @endphp
                                            @if ($count > 1)
                                                @foreach ($canceled->details as $key => $detail)
                                                    {{ $detail->product->name }}
                                                    {{ ($count !== $key +1) ? '+' : '' }}
                                                @endforeach
                                            @else
                                                {{ $detail->product->name }}
                                            @endif
                                        </h5>
                                        {{-- <p class="card-text">With supporting text below as a natural lead-in to additional content.</p> --}}
                                        <a href="#" class="btn btn-primary">Go somewhere</a>
                                    </div>
                                    <div class="col col-md-3">
                                        <div class="pull-right mr-5">
                                            <p>Total Harga</p>
                                            <h5>Rp {{ number_format($canceled->total) }}</h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="card mt-3">
                        <div class="card-body">
                            <p class="text-center">No failed purchases yet.</p>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</section>
@endsection

@push('script')
    <script>
        
    </script>
@endpush