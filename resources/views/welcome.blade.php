
<!doctype html>
<html lang="en">

<head>
<!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-PTHP3JH4');</script>
<!-- End Google Tag Manager -->
	
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Travell - Things to do, Activities, Events, Flights and Hotels</title>
    <meta name="description"
        content="Find attractions, tours, events, hotels, flights and more. Discover and create amazing travel experiences with Travell.">
	
	
  
	 <link rel="apple-touch-icon" sizes="57x57" href="{{asset('/favicon.ico')}}">
    <link rel="apple-touch-icon" sizes="60x60" href="{{asset('/favicon.ico')}}">
    <link rel="apple-touch-icon" sizes="72x72" href="{{asset('/favicon.ico')}}">
    <link rel="apple-touch-icon" sizes="76x76" href="{{asset('/favicon.ico')}}">
    <link rel="apple-touch-icon" sizes="114x114" href="{{asset('/favicon.ico')}}">
    <link rel="apple-touch-icon" sizes="120x120" href="{{asset('/favicon.ico')}}">
    <link rel="apple-touch-icon" sizes="144x144" href="{{asset('/favicon.ico')}}">
    <link rel="apple-touch-icon" sizes="152x152" href="{{asset('/favicon.ico')}}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{asset('/favicon.ico')}}">
    <link rel="icon" type="image/png" sizes="192x192"  href="{{asset('/favicon.ico')}}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{asset('/favicon.ico')}}">
    <link rel="icon" type="image/png" sizes="96x96" href="{{asset('/favicon.ico')}}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{asset('/favicon.ico')}}">
    <link rel="manifest" href="/manifest.json">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="/ms-icon-144x144.png">
    <meta name="theme-color" content="#ffffff">
	
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <!--  fontawesome -->
    <script src="https://kit.fontawesome.com/b73881b7c2.js" crossorigin="anonymous"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick-theme.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/slick-lightbox/0.2.12/slick-lightbox.css" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
    <link rel="stylesheet" href="{{ asset('/public/css/hotel-css/autoComplete.min.css')}}">
    <link href="{{ asset('/public/css/hotel-css/t-datepicker.min.css')}}" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="{{ asset('/public/css/style.css')}}">
    <link rel="stylesheet" href="{{ asset('/public/css/custom.css')}}">
    <!-- nav css -->
    <link rel="stylesheet" href="{{ asset('/public/css/hotel-css/autoComplete.min.css')}}">
    <script src="{{ asset('/public/css/hotel-css/autoComplete.js')}}"></script>
</head>

<body>
<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-PTHP3JH4"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->
	
    @include('navigation', ['disabled' => true])
	
    <div class="banner-container other-sections">
        <div class="container">
            <img src="{{asset('public/images/homepagebanner.png')}}" class="img-fluid d-none d-md-block w-100" alt="">
            <img src="{{asset('public/images/bannermobile.png')}}" class="img-fluid d-md-none w-100" alt="">
            <div class="banner-text">
                Discover New <br> Destinations
            </div>
        </div>
    </div>
    <div class="body typeahed mx-auto" align="center">
        <div class="d-flex justify-content-center mb-20">
            <ul class="nav nav-tabs border-0 w-100 justify-content-center w-50" id="myTab" role="tablist">
                <li class="nav-item border-0 w-50" role="presentation">
                    <button class="nav-link active tab-switch" id="home-tab" data-bs-toggle="tab"
                        data-bs-target="#home-tab-pane" type="button" role="tab" aria-controls="home-tab-pane"
                        aria-selected="true"><span class="tab-switch active">
                            Explore
                        </span></button>
                </li>
                <li class="nav-item border-0 w-50" role="presentation">
                    <button class="nav-link tab-switch" id="profile-tab" data-bs-toggle="tab"
                        data-bs-target="#profile-tab-pane" type="button" role="tab" aria-controls="profile-tab-pane"
                        aria-selected="false">Hotels</button>
                </li>
            </ul>
        </div>
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="home-tab-pane" role="tabpanel" aria-labelledby="home-tab"
                tabindex="0">
                <div class="explore-search">
                    <div class="search-box-icon">
                        <img src="{{asset('public/images/search.svg')}}" class="search-icon" alt="">
                    </div>
                    <!-- <input type="text" id="autocompleteFive" placeholder="Select a color"></input>
                     <ul id="results"></ul> -->
             <input type="text" id="searchlocation" type="search" value="{{request('search')}}" name="search"
                placeholder="Where are you goining?" autocomplete="off">
                            <div class="recent-his search-box-info  bg-white px-0 px-md-4 b-20 shadow-1 position-absolute">
                <!-- <p class="small my-3" id="recent-search">@if (Session::has('lastsearch')) RECENTLY VIEWED @else POPULAR
                  DESTINATIONS @endif</p> -->
                <p id="loc-list" class="px-0 px-md-4 autoCompletewrapper"></p>
              </div>
                </div>
            </div>
            <div class="tab-pane fade" id="profile-tab-pane" role="tabpanel" aria-labelledby="profile-tab" tabindex="0">
                <div class="search-filter remove-highlight d-md-flex">
                    <div class="search-locations">
                        <img src="{{asset('public/images/search.svg')}}" class="search-iconformobile d-md-none" alt="">
                        <label for="checkout" class="label">Where</label>
                        <div class="autoComplete_wrapper">
                                              <input id="searchhotel" type="text" tabindex="1" placeholder="&#xF002; Search" autocomplete="off">
              <div class="hotel_recent_his search-box-info  d-none bg-white px-0 px-md-4 b-20 shadow-1 position-absolute">
                <!-- <p class="small my-3" id="recent-search">@if (Session::has('lastsearch')) RECENTLY VIEWED @else POPULAR
                  DESTINATIONS @endif</p> -->
                <p id="hotel_loc_list" class="px-0 px-md-4 autoCompletewrapper" style="z-index:2;"></p>
              </div>
              <span  id="slug" class="d-none"></span> 
                                                            <span  id="location_id" class="d-none"></span>
							  <span  id="hotel" class="d-none"></span> 
                        </div>
                    </div>
                    <div class="t-datepicker">
                        <div class="t-check-in"></div>
                        <div class="t-check-out"></div>
                    </div>
                    <div class="dropdown-custom">
                        <div class="dropdown-custom-toggle ">
                            <img src="{{asset('public/images/usergrey.png')}}" class="user-guests d-md-none" alt="">
                            <label for="checkout" class="label">Who</label>
                            <input type="number" id="totalguests" class="border-0 totalguests"
                                placeholder="2" readonly>
                        </div>
                        <ul class="dropdown-menu p-0 border-0">
                            <div class="rooms-num room-info b-20 border bg-white">
                                <div class="p-24">
                                    <div class="adults counter mb-30 d-flex justify-content-between align-items-center">
                                        <div>
                                            <p class="person">Adult</p>
                                            <p class="age"> Ages 13 or above</p>
                                        </div>
                                        <div class="d-flex align-items-center">
                                            <span role="button" class="decrement dec">-</span>
                                            <input type="number"
                                                class="border d-flex align-items-center rounded-3 border-1 border-dark inputfield"
                                                placeholder="2" readonly>
                                            <span role="button" class="adultincrement incdec">+</span>
                                        </div>
                                    </div>
                                    <div class="adults counter mb-30 d-flex justify-content-between align-items-center">
                                        <div>
                                            <p class="person">Children</p>
                                            <p class="age"> Ages 2-12</p>
                                        </div>
                                        <div class="d-flex align-items-center">
                                            <span role="button" id="childrenSubtract" class="decrement dec">-</span>
                                            <input type="number"
                                                class="border d-flex align-items-center rounded-3 border-1 border-dark inputfield"
                                                placeholder="0" readonly>
                                            <span role="button" id="childrenAdd" class="adultincrement incdec">+</span>
                                        </div>
                                    </div>
                                    <div class="adults counter d-flex justify-content-between align-items-center">
                                        <div>
                                            <p class="person">Infants</p>
                                            <p class="age"> Under 2</p>
                                        </div>
                                        <div class="d-flex align-items-center">
                                            <span role="button" class="decrement dec">-</span>
                                            <input type="number"
                                                class="border d-flex align-items-center rounded-3 border-1 border-dark inputfield"
                                                placeholder="0" readonly>
                                            <span role="button" class="adultincrement incdec">+</span>
                                        </div>
                                    </div>
                                </div>
                                <div id="childrenDetails">
                                </div>
                            </div>
                        </ul>
                    </div>
                   <div class="search-icon  d-md-flex filter-chackinout" id="filterchackinout">
					   <div class="search" >
						   <i class="fa fa-search" aria-hidden="true" ></i>
					   </div>
					</div>
                </div>
            </div>
        </div>
        <div class="selection d-none"></div>
        <div class="selection2 d-none"></div>
    </div>
    <div class="container">
        <div class="partner-with-us other-sections">
            <h6>Partners with</h6>
            <div class="row d-flex justify-content-center">
                <div class="col-4 col-md-2 parnetlogo"><img src="{{ asset('public/images/bookin-sites/image 202.svg')}}"
                        alt=""></div>
                <div class="col-4 col-md-2 parnetlogo"><img src="{{ asset('public/images/bookin-sites/image 203.svg')}}"
                        alt=""></div>
                <div class="col-4 col-md-2 parnetlogo"><img src="{{ asset('public/images/bookin-sites/image 206.svg')}}"
                        alt=""></div>
                <div class="col-4 col-md-2 parnetlogo"><img src="{{ asset('public/images/bookin-sites/image 207.svg')}}"
                        alt=""></div>
                <div class="col-4 col-md-2 parnetlogo"><img src="{{ asset('public/images/bookin-sites/image 208.svg')}}"
                        alt=""></div>
                <div class="col-4 col-md-2 parnetlogo"><img src="{{ asset('public/images/bookin-sites/image 209.svg')}}"
                        alt=""></div>
            </div>
        </div>
        <section class="popular-cities other-sections">
            <h5>Top 8 Popular Cities</h5>
            <p>See what’s popular with other travellers</p>
            <div class="grid-wrapper bloglistingcarousel">
                <a href="{{ url('lo-12810004-' .strtolower( str_replace(' ', '_', 'bangkok-thailand'))) }}">
                    <div class="image-wrap">
                        <div class="text-block">
                            Bangkok
                        </div>
                        <img src="{{ asset('public/images/popular-cities/Bangkok.jpg')}}" alt="" />
                    </div>
                </a>
                <a href="{{ url('lo-129700020031-' .strtolower( str_replace(' ', '_', 'london-england'))) }}">
                    <div class="image-wrap">
                        <div class="text-block">
                            London
                        </div>
                        <img src="{{ asset('public/images/popular-cities/London.jpg')}}" alt="" />
                    </div>
                </a>
                <a href="{{ url('lo-113600100005-' .strtolower( str_replace(' ', '_', 'paris-ile-de-france'))) }}">
                    <div class="image-wrap">
                        <div class="text-block">
                            Paris
                        </div>
                        <img src="{{ asset('public/images/popular-cities/Paris.jpg')}}" alt="" />
                    </div>
                </a>
                <a href="{{ url('lo-129600030001-' .strtolower( str_replace(' ', '_', 'Dubai-emirate-of-Dubai'))) }}">
                    <div class="image-wrap">
                        <div class="text-block">
                            Dubai
                        </div>
                        <img src="{{ asset('public/images/popular-cities/Dubai.jpg')}}" alt="">
                    </div>
                </a>
                <a href="{{ url('lo-12890032-' .strtolower( str_replace(' ', '_', 'istanbul-turkey'))) }}">
                    <div class="image-wrap">
                        <div class="text-block">
                            Istanbul
                        </div>
                        <img src="{{ asset('public/images/popular-cities/Istanbul.jpg')}}" alt="" />
                    </div>
                </a>
                <a
                    href="{{ url('lo-1263001000030016-' .strtolower( str_replace(' ', '_', 'barcelona-province-of-barcelona'))) }}">
                    <div class="image-wrap mt-top">
                        <div class="text-block">
                            Barcelona
                        </div>
                        <img src="{{ asset('public/images/popular-cities/Barcelona.jpg')}}" alt="" />
                    </div>
                </a>
                <a href="{{ url('lo-12500007-' .strtolower( str_replace(' ', '_', 'singapore-singapore'))) }}">
                    <div class="image-wrap">
                        <div class="text-block">
                            Singapore
                        </div>
                        <img src="{{ asset('public/images/popular-cities/Singapore.jpg')}}" alt="">
                    </div>
                </a>
                <a href="{{ url('lo-131300160460-' .strtolower( str_replace(' ', '_', 'morocco-indiana-in'))) }}">
                    <div class="image-wrap mt-top">
                        <div class="text-block">
                            Morocco
                        </div>
                        <img src="{{ asset('public/images/popular-cities/morocco.jpg')}}" alt="" />
                    </div>
                </a>
            </div>
        </section>
        <section class="popular-cities other-sections">
            <h5>Why travel with Travell?</h5>
            <div class="row">
                <div class="col-md-4 text-center">
                    <img src="{{asset('public/images/Frame 61.svg')}}" alt=""
                        class="mb-20 d-flex justify-content-center mx-auto">
                    <b class="fs18 mb-8 d-block">Exceptional Journeys</b>
                    <p class="color707070">Looking for a travel experience that's truly exceptional? We can help you find amazing places to visit that are off the beaten path.</p>
                </div>
                <div class="col-md-4 text-center">
                    <img src="{{asset('public/images/Frame 61.svg')}}" alt=""
                        class="mb-20 d-flex justify-content-center mx-auto">
                    <b class="fs18 mb-8 d-block">Best Price Guaranteed</b>
                    <p class="color707070">Our partnerships with over 350+ websites around the world allow us to offer unbeatable value and the best possible prices.</p>
                </div>
                <div class="col-md-4 text-center">
                    <img src="{{asset('public/images/Frame 61.svg')}}" alt=""
                        class="mb-20 d-flex justify-content-center mx-auto">
                    <b class="fs18 mb-8 d-block">Vibrant Community</b>
                    <p class="color707070">You can share your travel experiences and get constructive recommendations from fellow travelers. Let us help you build the perfect travel itinerary and embark on a journey you'll never forget!</p>
                </div>
            </div>
        </section>
    </div>
    <!-- start footer  -->
    @include('footer')
    <!-- end footer  -->



  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
		<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-lightbox/0.2.12/slick-lightbox.min.js"></script>
    <script src="{{ asset('/public/css/hotel-css/t-datepicker.min.js')}}"></script>
    <script src="{{ asset('/public/js/datepicker-homepage.js')}}"></script>
    <script src="{{ asset('/public/js/welcome.js')}}"></script>
    <!-- nav css -->
    <!--end nav css -->
    <!-- <script src="{{ asset('/public/js/autocomplete1.js')}}"></script>
         <script src="{{ asset('/public/js/autocomplete2.js')}}"></script>-->
    <script src="{{ asset('/public/css/hotel-css/t-datepicker.min.js')}}"></script>
    <script src="{{ asset('/public/js/datepicker-homepage.js')}}"></script>
    <script src="{{ asset('/public/js/datepicker-hotelpage.js')}}"></script>
    <script src="{{ asset('/public/js/index.js')}}"></script>
    <!-- <script src="{{ asset('/public/js/searchpage.js')}}"></script>-->
    <script src="{{ asset('/public/js/custom.js')}}"></script>
</body>

</html>