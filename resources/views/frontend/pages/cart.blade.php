@extends('frontend.layouts.master')
@section('title', "Bening's || CART Page")
@section('main-content')
	<!-- Breadcrumbs -->
	<div class="breadcrumbs">
		<div class="container">
			<div class="row">
				<div class="col-12">
					<div class="bread-inner">
						<ul class="bread-list">
							<li><a href="{{ ('home') }}">Home<i class="ti-arrow-right"></i></a></li>
							<li class="active"><a href="">Cart</a></li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- End Breadcrumbs -->

	<!-- Shopping Cart -->
	<div class="shopping-cart section">
		{{-- {{ dd(count(Helper::getAllProductFromCart())) }} --}}
		@if (count(Helper::getAllProductFromCart())>0)
			<div class="container">
				<div class="row">
					<div class="col-12">
						<!-- Shopping Summery -->
						<table class="table shopping-summery">
							<thead>
								<tr class="main-hading">
									<th>PRODUCT</th>
									<th>NAME</th>
									<th class="text-center">UNIT PRICE</th>
									<th class="text-center">QUANTITY</th>
									<th class="text-center">TOTAL</th>
									<th class="text-center">DELETE</i></th>
								</tr>
							</thead>
							<tbody id="cart_item_list">
								<form action="{{ route('checkout') }}" method="POST">
									@csrf

									@foreach(Helper::getAllProductFromCart() as $key=>$cart)
										<tr>
											@php
												$photo=explode(',',$cart->product['photo']);
											@endphp
											<td class="image" data-title="No"><img src="{{ $photo[0] }}" alt="{{ $photo[0] }}"></td>
											<td class="product-des" data-title="Description">
												<p class="product-name"><a href="{{ route('product-detail',$cart->product['slug']) }}" target="_blank">{{ $cart->product['title'] }}</a></p>
												<p class="product-des">{!!($cart->product['summary']) !!}</p>
											</td>
											<td class="price" data-title="Price"><span>Rp{{ number_format($cart['price'],2) }}</span></td>
											<td class="qty" data-title="Qty"><!-- Input Order -->
												<div class="input-group">
													<div class="button minus">
														<button type="button" class="btn btn-primary btn-number calc"  disabled="disabled" data-type="minus" data-field="qty[{{ $key }}]">
															<i class="ti-minus"></i>
														</button>
													</div>
													<input type="text" name="qty[{{ $key }}]" data-data="{{ $cart }}" class="input-number quanty" data-min="1" data-max="100" value="{{ $cart->qty }}">
													<input type="hidden" name="qty_id[]" value="{{ $cart->id }}">
													<div class="button plus">
														<button type="button" class="btn btn-primary btn-number calc"  data-type="plus" data-field="qty[{{ $key }}]">
															<i class="ti-plus"></i>
														</button>
													</div>
												</div>
												<!--/ End Input Order -->
											</td>
											<td class="total-amount cart_single_price" id="product_price_{{ $cart->product_id }}" data-title="Total"><span class="money">Rp{{ number_format($cart['amount']) }}</span></td>

											<td class="action" data-title="Remove"><a href="{{ route('cart-delete',$cart->id) }}"><i class="ti-trash remove-icon"></i></a></td>
										</tr>
									@endforeach
									<tr>
										<td colspan="3"></td>
										<td class="float-right"><strong>TOTAL : </strong></td>
										<td colspan="2" class="">
											<span id="subTotal">
												<strong>
													<h5>Rp {{ number_format(Helper::totalCartPrice(),2) }}</h5>
												</strong>
											</span>
										</td>
									</tr>
									<tr>
										<td colspan="4">
											<div class="left">
												<div class="button5">
													<a href="{{ route('product-grids') }}" class="btn text-light">Continue shopping</a>
												</div>
											</div>
										</td>
										<td colspan="2" class="">
											<button class="btn " type="submit">Checkout</button>
										</td>
									</tr>
								</form>
							</tbody>
						</table>
						<!--/ End Shopping Summery -->
					</div>
				</div>
			</div>
		@else
			<div class="d-flex justify-content-center">
				<span class="text-center">
					There are no any carts available. <a href="{{ route('product-grids') }}" style="color:blue;">Continue shopping</a>
				</span>
			</div>
		@endif
	</div>
	<!--/ End Shopping Cart -->

	<!-- Start Shop Services Area  -->
	<section class="shop-services section">
		<div class="container">
			<div class="row">
				<div class="col-lg-3 col-md-6 col-12">
					<!-- Start Single Service -->
					<div class="single-service">
						<i class="ti-rocket"></i>
						<h4>Free shiping</h4>
						<p>Orders over Rp150000</p>
					</div>
					<!-- End Single Service -->
				</div>
				<div class="col-lg-3 col-md-6 col-12">
					<!-- Start Single Service -->
					<div class="single-service">
						<i class="ti-reload"></i>
						<h4>Free Return</h4>
						<p>Within 30 days returns</p>
					</div>
					<!-- End Single Service -->
				</div>
				<div class="col-lg-3 col-md-6 col-12">
					<!-- Start Single Service -->
					<div class="single-service">
						<i class="ti-lock"></i>
						<h4>Sucure Payment</h4>
						<p>100% secure payment</p>
					</div>
					<!-- End Single Service -->
				</div>
				<div class="col-lg-3 col-md-6 col-12">
					<!-- Start Single Service -->
					<div class="single-service">
						<i class="ti-tag"></i>
						<h4>Best Peice</h4>
						<p>Guaranteed price</p>
					</div>
					<!-- End Single Service -->
				</div>
			</div>
		</div>
	</section>
	<!-- End Shop Newsletter -->

	<!-- Start Shop Newsletter  -->
	@include('frontend.layouts.newsletter')
	<!-- End Shop Newsletter -->

@endsection
@push('styles')
	<style>
		li.shipping{
			display: inline-flex;
			width: 100%;
			font-size: 14px;
		}
		li.shipping .input-group-icon {
			width: 100%;
			margin-left: 10px;
		}
		.input-group-icon .icon {
			position: absolute;
			left: 20px;
			top: 0;
			line-height: 40px;
			z-index: 3;
		}
		.form-select {
			height: 30px;
			width: 100%;
		}
		.form-select .nice-select {
			border: none;
			border-radius: 0px;
			height: 40px;
			background: #f6f6f6 !important;
			padding-left: 45px;
			padding-right: 40px;
			width: 100%;
		}
		.list li{
			margin-bottom:0 !important;
		}
		.list li:hover{
			background:#F7941D !important;
			color:white !important;
		}
		.form-select .nice-select::after {
			top: 14px;
		}
	</style>
@endpush
@push('scripts')
	<script src="{{asset('frontend/js/nice-select/js/jquery.nice-select.min.js')}}"></script>
	<script src="{{ asset('frontend/js/select2/js/select2.min.js') }}"></script>
	<script>
		$(document).ready(function() { $("select.select2").select2(); });
  		$('select.nice-select').niceSelect();
	</script>
	<script>
		$(document).ready(function(){
			$('.shipping select[name=shipping]').change(function(){
				let cost = parseFloat( $(this).find('option:selected').data('price') ) || 0;
				let subtotal = parseFloat( $('.order_subtotal').data('price') );
				$('#order_total_price span').text('Rp'+(subtotal + cost).toFixed(2));
			});

			$('.calc').click(function(e){
				let data = $(this).data('data');
				let qties = $('.quanty')
				let total = 0;
				qties.each((i,d) => {
					let data = $(d).data('data')
					let current_qty = $(d).val()
					let product_price = parseFloat(data.price)  * parseFloat(current_qty)
					let elPrice = $('#product_price_'+ data.product_id).html(currencyFormat().format(product_price))

					total += product_price
				})
				
				$('#subTotal').html(`<strong><h5>${currencyFormat().format(total)}</h5></strong>`)
			});

		});

		function currencyFormat(amount){
			return new Intl.NumberFormat('id-ID', {
				style: 'currency',
				currency: 'IDR',
			})
		}

	</script>

@endpush
