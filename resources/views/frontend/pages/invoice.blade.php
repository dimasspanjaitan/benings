@extends('frontend.layouts.master')

@section('title', "Bening's || INVOICE")

@section('main-content')
<!-- Breadcrumbs -->
<div class="breadcrumbs">
    <div class="container">
        <div class="row">
            <div class="col-8">
                <div class="bread-inner">
                    <ul class="bread-list">
                        <li><a href="{{ route('home') }}">Home<i class="ti-arrow-right"></i></a></li>
                        <li class="active"><a href="javascript:void(0);">Invoice</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-4">
                <div class="pull-right">
                    <button class="btn btn-primary" id="cmd">Download Invoice</button>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Breadcrumbs -->

<section class="tracking_box_area section_gap py-4 mb-5" id="content">
    <div class="container">
        <div class="card">
            <div class="card-header">
                Invoice
                <strong>{{ $sale->code }}</strong>
                <span class="float-right"> <strong>Status: </strong><span class="ml-2 {{ $sale->status['badge'] }}">{{ $sale->status['name'] }}</span> </span>

            </div>
            <div class="card-body">
                <div class="{{ ($sale->status['value']) == 3 ? 'watermark' : '' }}"></div>
                <div class="row no-gutters mb-4">
                    <div class="col-md-6 mt-2">
                        <div class="row ml-1">
                            <strong>From :&nbsp;</strong>
                            <strong>{{ config('app.name') }}</strong>
                        </div>
                        <div class="ml-1">
                            <p>{{ $setting->address }}</p>
                            <p>Email: {{ $setting->email }}</p>
                            <p>Phone: {{ $setting->phone }}</p>
                        </div>
                    </div>
                    <div class="col-md-6 mt-2">
                        <div class="row ml-1">
                            <strong>To :&nbsp;</strong>
                            <strong>{{ $sale->name }}</strong>
                        </div>
                        <div class="ml-1">
                            <p>{{ $sale->address }}</p>
                            <p>Email: {{ $sale->email }}</p>
                            <p>Phone: {{ $sale->phone }}</p>
                        </div>
                    </div> 
                </div>

                <div class="table-responsive-sm">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th class="center">#</th>
                                <th>Product</th>
                                <th>Description</th>
                                <th class="right">Unit Cost</th>
                                <th class="center">Qty</th>
                                <th class="right">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($sale->details as $key => $detail)
                                <tr>
                                    <td class="center">{{ $key+1 }}</td>
                                    <td class="left strong">{{ $detail['product_name'] }}</td>
                                    <td class="left">{{ $detail['summary'] }}</td>

                                    <td class="right">Rp{{ number_format($detail['price']) }}</td>
                                    <td class="center">{{ $detail['qty'] }}</td>
                                    <td class="right">Rp{{ number_format($detail['sub_total']) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="row">
                    <div class="col-lg-4 col-sm-5">

                    </div>

                    <div class="col-lg-4 col-sm-5 ml-auto">
                        <table class="table table-clear">
                            <tbody>
                                <tr>
                                    <td class="left">
                                        <strong>Total</strong>
                                    </td>
                                    <td class="right">
                                        <h5>
                                            <strong>Rp{{ number_format($sale->total) }}</strong>
                                        </h5>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="text-center mb-3">
                    <h5 style="font-family:'Courier New', Courier, monospace"><i>"{{ $sale->terbilang }}"</i></h5>
                </div>
                
            </div>
        </div>
    </div>
</section>
@endsection

@push('styles')
<style>
    .watermark {
        content: "";
        background:url(https://www.google.co.in/images/srpr/logo11w.png) no-repeat;
        opacity: 0.2;
        top: 0;
        left: 0;
        bottom: 0;
        right: 0;
        position: absolute;
        z-index: 1;  
        height:100%;
        width:100%;
    }
</style>
@endpush

@push('scripts')
<script src="{{ asset('frontend/js/printThis.js') }}"></script>
<script>
    $(document).ready(function(){
        $('#cmd').click(function(){
            $('#content').printThis({
                pageTitle: "{{ config('app.name') }} || INVOICE"
            });
        });
    });
</script>
@endpush

