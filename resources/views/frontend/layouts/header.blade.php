<header class="header shop">
    <!-- Topbar -->
    <div class="topbar">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-12 col-12">
                    <!-- Top Left -->
                    <div class="top-left">
                        <ul class="list-main">
                            @php
                                $settings=DB::table('settings')->first();
                            @endphp
                            <li><i class="ti-headphone-alt"></i> {{$settings->phone}} </li>
                            <li><i class="ti-email"></i>  {{$settings->email}} </li>
                        </ul>
                    </div>
                    <!--/ End Top Left -->
                </div>
                <div class="col-lg-6 col-md-12 col-12">
                    <!-- Top Right -->
                    <div class="right-content">
                        <ul class="list-main">
                        {{-- <li><i class="ti-location-pin"></i> <a href="#">Track Order</a></li> --}}
                        {{-- <li><i class="ti-alarm-clock"></i> <a href="#">Daily deal</a></li> --}}
                        @auth 
                            <li><i class="ti-shopping-cart"></i> <a href="{{ route('shipping') }}">Purchase</a></li>
                            @if(Auth::user()->role==1)
                                <li><i class="ti-user"></i> <a href="{{ route('admin') }}"  target="_blank">CPanel</a></li>
                            @else 
                                <li><i class="ti-user"></i> <a href="{{ route('home') }}">{{ auth()->user()->name }}</a></li>
                            @endif
                            
                            <li><i class="ti-power-off"></i>
                                <a href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                                    document.getElementById('logout-form').submit();">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i> {{ __('Logout') }}
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </li>

                            

                        @else
                            <li><i class="ti-power-off"></i><a href="{{route('login')}}">Login /</a> <a href="{{route('register.form')}}">Register</a></li>
                        @endauth
                        </ul>
                    </div>
                    <!-- End Top Right -->
                </div>
            </div>
        </div>
    </div>
    <!-- End Topbar -->
    <div class="middle-inner">
        <div class="container">
            <div class="row">
                <div class="col-lg-2 col-md-2 col-12">
                    <!-- Logo -->
                    <div class="logo">
                        @php
                            $settings=DB::table('settings')->get();
                        @endphp                    
                        <a href="{{ route('home') }}"><img src="@foreach($settings as $data) {{ asset($data->logo) }} @endforeach" alt="logo"></a>
                    </div>
                    <!--/ End Logo -->
                    <!-- Search Form -->
                    <div class="search-top">
                        <div class="top-search"><a href="#0"><i class="ti-search"></i></a></div>
                        <!-- Search Form -->
                        <div class="search-top">
                            <form class="search-form">
                                <input type="text" placeholder="Search here..." name="search">
                                <button value="search" type="submit"><i class="ti-search"></i></button>
                            </form>
                        </div>
                        <!--/ End Search Form -->
                    </div>
                    <!--/ End Search Form -->
                    <div class="mobile-nav"></div>
                </div>
                <div class="col-lg-8 col-md-7 col-12">
                    <div class="search-bar-top">
                        <div class="search-bar">
                            <select>
                                <option >All Category</option>
                                @foreach (Helper::getAllCategory() as $category)
                                    <option value="">{{ $category->title }}</option>
                                @endforeach
                            </select>
                            <form method="post" action="{{ route('product.search') }}">
                                {{csrf_field()}}
                                <input name="search" placeholder="Search Products Here....." type="search">
                                <button class="btnn" type="submit"><i class="ti-search"></i></button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 col-md-3 col-12">
                    <div class="right-bar">
                        <!-- Search Form -->
                        <div class="sinlge-bar shopping">
                            @php 
                                $total_product=0;
                                $total_amount=0;
                            @endphp
                            @if(session('wishlist'))
                                    @foreach(session('wishlist') as $wishlist_items)
                                        @php
                                            $total_product+=$wishlist_items['qty'];
                                            $total_amount+=$wishlist_items['amount'];
                                        @endphp
                                    @endforeach
                            @endif

                            <a href="{{ (!empty(auth()->user())) ? route('wishlist') : route('login') }}" class="single-icon"><i class="fa fa-heart-o"></i> <span class="total-count">{{ Helper::wishlistCount() }}</span></a>
                            @auth
                                <div class="shopping-item">
                                    <div class="dropdown-cart-header">
                                        <span>{{ count(Helper::getAllProductFromWishlist()) }} Items</span>
                                        <a href="{{ route('wishlist') }}">View Wishlist</a>
                                    </div>
                                    <ul class="shopping-list">
                                        @foreach(Helper::getAllProductFromWishlist() as $data)
                                            @php
                                                $photo=explode(',',$data->product['photo']);
                                            @endphp
                                            <li>
                                                <a href="{{ route('wishlist-delete',$data->id) }}" class="remove" title="Remove this item"><i class="fa fa-remove"></i></a>
                                                <a class="cart-img" href="#"><img src="{{ $photo[0] }}" alt="{{ $photo[0] }}"></a>
                                                <h4><a href="{{ route('product-detail',$data->product['slug']) }}" target="_blank">{{ $data->product['name'] }}</a></h4>
                                                <p class="quantity">{{ $data->qty }} x <span class="amount">Rp {{ number_format($data->price,2) }}</span></p>
                                            </li>
                                        @endforeach
                                    </ul>
                                    <div class="bottom">
                                        <div class="total">
                                            <span>Total</span>
                                            <span class="total-amount">Rp {{ number_format(Helper::totalWishlistPrice(),2) }}</span>
                                        </div>
                                        {{-- <a href="{{ route('cart') }}" class="btn animate">Cart</a> --}}
                                    </div>
                                </div>
                            @endauth
                            
                        </div>
                        
                        <div class="sinlge-bar shopping">
                            <a href="{{ (!empty(auth()->user())) ? route('cart') : route('login') }}" class="single-icon"><i class="ti-bag"></i> <span class="total-count">{{ Helper::cartCount() }}</span></a>
                            @auth
                                <div class="shopping-item">
                                    <div class="dropdown-cart-header">
                                        <span>{{ count(Helper::getAllProductFromCart()) }} Items</span>
                                        <a href="{{ route('cart') }}">View Cart</a>
                                    </div>
                                    <ul class="shopping-list">
                                            @foreach(Helper::getAllProductFromCart() as $data)
                                                    @php
                                                        $photo=explode(',',$data->product['photo']);
                                                    @endphp
                                                    <li>
                                                        <a href="{{ route('cart-delete',$data->id) }}" class="remove" title="Remove this item"><i class="fa fa-remove"></i></a>
                                                        <a class="cart-img" href="#"><img src="{{ $photo[0] }}" alt="{{ $photo[0] }}"></a>
                                                        <h4><a href="{{ route('product-detail',$data->product['slug']) }}" target="_blank">{{ $data->product['name'] }}</a></h4>
                                                        <p class="quantity">{{ $data->qty }} x <span class="amount">Rp {{ number_format($data->price,2) }}</span></p>
                                                    </li>
                                            @endforeach
                                    </ul>
                                    <div class="bottom">
                                        <div class="total">
                                            <span>Total</span>
                                            <span class="total-amount">Rp {{ number_format(Helper::totalCartPrice(),2) }}</span>
                                        </div>
                                        {{-- <a href="{{ route('checkout') }}" class="btn animate">Checkout</a> --}}
                                    </div>
                                </div>
                            @endauth
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Header Inner -->
    <div class="header-inner">
        <div class="container">
            <div class="cat-nav-head">
                <div class="row">
                    <div class="col-lg-12 col-12">
                        <div class="menu-area">
                            <!-- Main Menu -->

                            <nav class="navbar navbar-expand-lg">
                                <div class="navbar-collapse">	
                                    <div class="nav-inner">	
                                        <ul class="nav main-menu menu navbar-nav">
                                            <li class="{{ Request::path()=='home' ? 'active' : '' }}"><a href="{{ route('home') }}">Home</a></li>
                                            <li class="{{ Request::path()=='about-us' ? 'active' : '' }}"><a href="{{ route('about-us') }}">About Us</a></li>
                                            <li class="@if(Request::path()=='product-grids'||Request::path()=='product-lists')  active  @endif">
                                                <a href="{{ route('product-grids') }}">Products</a>
                                                <span class="new">New</span>
                                            </li>												
                                                {{ Helper::getHeaderCategory() }}								
                                            <li class="{{ Request::path()=='contact' ? 'active' : '' }}"><a href="{{ route('contact') }}">Contact Us</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </nav>

                            <!--/ End Main Menu -->	
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--/ End Header Inner -->
</header>