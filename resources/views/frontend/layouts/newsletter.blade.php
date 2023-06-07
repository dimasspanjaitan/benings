
<!-- Start Shop Newsletter  -->
<section class="shop-newsletter section">
    <div class="container">
        <div class="inner-top">
            <div class="row">
                <div class="col-lg-8 offset-lg-2 col-12">
                    <!-- Start Newsletter Inner -->
                    <div class="inner">
                        @php
                            $setting=DB::table('settings')->where('id',1)->first();
                        @endphp
                        <h4>Dropshipper</h4>
                        <p> Bingung? Mau usaha tapi tidak punya modal?<br><a href="https://wa.me/{{ $setting->phone }}" target="_blank"><span>KLIK!!</a> Untuk Join Mitra Tanpa Modal Sekarang.</span></p>
                        {{-- <form action="{{route('subscribe')}}" method="post" class="newsletter-inner">
                            @csrf
                            <input name="email" placeholder="Your email address" required="" type="email">
                            <button class="btn" type="submit">Subscribe</button>
                        </form> --}}
                    </div>
                    <!-- End Newsletter Inner -->
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End Shop Newsletter -->