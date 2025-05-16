@extends('frontend.layouts.master')

@section('title',"Bening's || PRODUCT PAGE")

@section('main-content')
	
		<!-- Breadcrumbs -->
		<div class="breadcrumbs">
			<div class="container">
				<div class="row">
					<div class="col-12">
						<div class="bread-inner">
							<ul class="bread-list">
								<li><a href="{{route('home')}}">Home<i class="ti-arrow-right"></i></a></li>
								<li class="active"><a href="javascript:void(0);">Shop List</a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- End Breadcrumbs -->
		<form action="{{route('shop.filter')}}" method="POST">
		@csrf
			<!-- Product Style 1 -->
			<section class="product-area shop-sidebar shop-list shop section">
				<div class="container">
					<div class="row">
						<div class="col-lg-3 col-md-4 col-12">
							<div class="shop-sidebar">
                                <!-- Single Widget -->
                                <div class="single-widget category">
                                    <h3 class="title">Categories</h3>
                                    <ul class="categor-list">
										@php
											$menu = Helper::getAllCategory();
										@endphp
										@if($menu)
										<li>
											@foreach($menu as $category)
												<li><a href="{{route('product-cat',$category->slug)}}">{{$category->title}}</a></li>
											@endforeach
										</li>
										@endif
                                        {{-- @foreach(Helper::productCategoryList('products') as $cat)
                                            @if($cat->is_parent==1)
												<li><a href="{{route('product-cat',$cat->slug)}}">{{$cat->title}}</a></li>
											@endif
                                        @endforeach --}}
                                    </ul>
                                </div>
                                <!--/ End Single Widget -->
								<!-- Shop By Price -->
								<div class="single-widget range">
									<h3 class="title">Shop by Price</h3>
									<div class="price-filter">
										<div class="price-filter-inner">
											<div id="slider-range" data-min="0" data-max="{{ max($prices) }}"></div>
											<div class="product_filter">
											<button type="submit" class="filter_button">Filter</button>
											<div class="label-input">
												<span>Range:</span>
												<input style="" type="text" id="amount" readonly/>
												<input type="hidden" name="price_range" id="price_range" value="@if(!empty($product->price)){{ $product->price }}@endif"/>
											</div>
											</div>
										</div>
									</div>

								</div>
								<!--/ End Shop By Price -->
                                <!-- Single Widget -->
                                <div class="single-widget recent-post">
                                    <h3 class="title">Recent post</h3>
                                    @foreach($recent_products as $product)
                                        <!-- Single Post -->
                                        @php 
                                            $photo=explode(',',$product->photo);
                                        @endphp
                                        <div class="single-post first">
                                            <div class="image">
                                                <img src="{{$photo[0]}}" alt="{{$photo[0]}}">
                                            </div>
                                            <div class="content">
                                                <h5><a href="{{route('product-detail',$product->slug)}}">{{$product->name}}</a></h5>
                                                <p class="price">Rp 0,-  </p>                                                
                                            </div>
                                        </div>
                                        <!-- End Single Post -->
                                    @endforeach
                                </div>
                                <!--/ End Single Widget -->
                        	</div>
						</div>
						<div class="col-lg-9 col-md-8 col-12">
							<div class="row">
								<div class="col-12">
									<!-- Shop Top -->
									<div class="shop-top">
										<div class="shop-shorter">
											<div class="single-shorter">
												<label>Show :</label>
												<select class="show" name="show" onchange="this.form.submit();">
													<option value="">Default</option>
													<option value="9" @if(!empty($_GET['show']) && $_GET['show']=='9') selected @endif>09</option>
													<option value="15" @if(!empty($_GET['show']) && $_GET['show']=='15') selected @endif>15</option>
													<option value="21" @if(!empty($_GET['show']) && $_GET['show']=='21') selected @endif>21</option>
													<option value="30" @if(!empty($_GET['show']) && $_GET['show']=='30') selected @endif>30</option>
												</select>
											</div>
											<div class="single-shorter">
												<label>Sort By :</label>
												<select class='sortBy' name='sortBy' onchange="this.form.submit();">
													<option value="">Default</option>
													<option value="name" @if(!empty($_GET['sortBy']) && $_GET['sortBy']=='name') selected @endif>Name</option>
													<option value="price" @if(!empty($_GET['sortBy']) && $_GET['sortBy']=='price') selected @endif>Price</option>
													<option value="category" @if(!empty($_GET['sortBy']) && $_GET['sortBy']=='category') selected @endif>Category</option>
												</select>
											</div>
										</div>
										<ul class="view-mode">
											<li><a href="{{route('product-grids')}}"><i class="fa fa-th-large"></i></a></li>
											<li class="active"><a href="javascript:void(0)"><i class="fa fa-th-list"></i></a></li>
										</ul>
									</div>
									<!--/ End Shop Top -->
								</div>
							</div>
							<div class="row">
								@if(count($products))
									@foreach($products as $product)
									 	{{-- {{$product}} --}}
										<!-- Start Single List -->
										<div class="col-12">
											<div class="row">
												<div class="col-lg-4 col-md-6 col-sm-6">
													<div class="single-product">
														<div class="product-img">
															<a href="{{ route('product-detail',$product->slug) }}">
															@php 
																$photo=explode(',',$product->photo);
															@endphp
															<img class="default-img" src="{{$photo[0]}}" alt="{{$photo[0]}}">
															<img class="hover-img" src="{{$photo[0]}}" alt="{{$photo[0]}}">
															</a>
															<div class="button-head">
																<div class="product-action">
																	<a data-toggle="modal" data-target="#{{$product->id}}" title="Quick View" href="#"><i class=" ti-eye"></i><span>Quick Shop</span></a>
																	<a title="Wishlist" href="#" class="wishlist" data-id="{{$product->id}}"><i class=" ti-heart "></i><span>Add to Wishlist</span></a>
																</div>
																<div class="product-action-2">
																	<a title="Add to cart" href="#">Add to cart</a>
																</div>
															</div>
														</div>
													</div>
												</div>
												<div class="col-lg-8 col-md-6 col-12">
													<div class="list-content">
														<div class="product-content">
															<div class="product-price">
																<span>Rp{{number_format($product->price,2)}}</span>
															</div>
															<h3 class="title"><a href="{{ route('product-detail',$product->slug) }}">{{ $product->name }}</a></h3>
														{{-- <p>{!! html_entity_decode($product->summary) !!}</p> --}}
														</div>
														<p class="des pt-2">{!! html_entity_decode($product->summary) !!}</p>
														<a href="javascript:void(0)" class="btn cart" data-id="{{ $product->id }}">Buy Now!</a>
													</div>
												</div>
											</div>
										</div>
										<!-- End Single List -->
									@endforeach
								@else
									<h4 class="text-warning" style="margin:100px auto;">There are no products.</h4>
								@endif
							</div>
							 <div class="row">
                            <div class="col-md-12 justify-content-center d-flex">
                                {{-- {{$products->appends($_GET)->links()}}  --}}
                            </div>
                          </div>
						</div>
					</div>
				</div>
			</section>
			<!--/ End Product Style 1  -->	
		</form>
		<!-- Modal -->
			{{-- modal review dihapus dari sini --}}
		<!-- Modal end -->
@endsection
@push ('styles')
<style>
	 .pagination{
        display:inline-flex;
    }
	.filter_button{
        /* height:20px; */
        text-align: center;
        background:#F7941D;
        padding:8px 16px;
        margin-top:10px;
        color: white;
    }
</style>
@endpush
@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

    {{-- <script>
        $('.cart').click(function(){
            var quantity=1;
            var pro_id=$(this).data('id');
            $.ajax({
                url:"{{route('add-to-cart')}}",
                type:"POST",
                data:{
                    _token:"{{csrf_token()}}",
                    quantity:quantity,
                    pro_id:pro_id
                },
                success:function(response){
                    console.log(response);
					if(typeof(response)!='object'){
						response=$.parseJSON(response);
					}
					if(response.status){
						swal('success',response.msg,'success').then(function(){
							document.location.href=document.location.href;
						});
					}
					else{
                        swal('error',response.msg,'error').then(function(){
							// document.location.href=document.location.href;
						}); 
                    }
                }
            })
        });
	</script> --}}
	<script>
        $(document).ready(function(){
        /*----------------------------------------------------*/
        /*  Jquery Ui slider js
        /*----------------------------------------------------*/
        if ($("#slider-range").length > 0) {
            const max_value = parseInt( $("#slider-range").data('max') ) || 500;
            const min_value = parseInt($("#slider-range").data('min')) || 0;
            const currency = $("#slider-range").data('currency') || '';
            let price_range = min_value+'-'+max_value;
            if($("#price_range").length > 0 && $("#price_range").val()){
                price_range = $("#price_range").val().trim();
            }
            
            let price = price_range.split('-');
            $("#slider-range").slider({
                range: true,
                min: min_value,
                max: max_value,
                values: price,
                slide: function (event, ui) {
                    $("#amount").val(currency + ui.values[0] + " -  "+currency+ ui.values[1]);
                    $("#price_range").val(ui.values[0] + "-" + ui.values[1]);
                }
            });
            }
        if ($("#amount").length > 0) {
            const m_currency = $("#slider-range").data('currency') || '';
            $("#amount").val(m_currency + $("#slider-range").slider("values", 0) +
                "  -  "+m_currency + $("#slider-range").slider("values", 1));
            }
        })
    </script>

@endpush