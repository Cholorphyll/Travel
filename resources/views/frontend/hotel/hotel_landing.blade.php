<!doctype html>
<html lang="en">

<head>
  <!-- Google Tag Manager -->
  <script>
  (function(w, d, s, l, i) {
    w[l] = w[l] || [];
    w[l].push({
      'gtm.start': new Date().getTime(),
      event: 'gtm.js'
    });
    var f = d.getElementsByTagName(s)[0],
      j = d.createElement(s),
      dl = l != 'dataLayer' ? '&l=' + l : '';
    j.async = true;
    j.src =
      'https://www.googletagmanager.com/gtm.js?id=' + i + dl;
    f.parentNode.insertBefore(j, f);
  })(window, document, 'script', 'dataLayer', 'GTM-PTHP3JH4');
  </script>
  <!-- End Google Tag Manager -->

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>BEST Hotels in @if(!empty($countryname)){{$countryname}} , {{$sname}} @endif - Travell</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
  <!--  fontawesome -->

  <script src="https://kit.fontawesome.com/b73881b7c2.js" crossorigin="anonymous"></script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.css" rel="stylesheet" />
  <link href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick-theme.css" rel="stylesheet" />
  <link href="https://cdnjs.cloudflare.com/ajax/libs/slick-lightbox/0.2.12/slick-lightbox.css" rel="stylesheet" />

  <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
  <!-- <script src="assets/autoComplete.js"></script>
    <link rel="stylesheet" href="assets/autoComplete.min.css"> -->



 
  <link rel="stylesheet"
    href="https://htmlstream.com/preview/front-v2.1/assets/vendor/ion-rangeslider/css/ion.rangeSlider.css">
  <link rel="stylesheet" href="{{asset('/public/css/datarange.css')}}">

  <script src="{{asset('/public/js/datepicker.js')}}"></script>
  <link rel="stylesheet" href="{{asset('/public/css/renge.css')}}">

  <link rel="stylesheet" href="{{ asset('/public/css/hotel_listing.css')}}">

  <!-- <link rel="stylesheet" href="{{ asset('/public/css/hotel-css/style.css')}}"> -->
  <link rel="stylesheet" href="{{ asset('/public/css/hotel-css/chart.css')}}">
  <link rel="stylesheet" href="{{asset('/public/css/header.css')}}">

  <!-- nav css -->
  <!-- <link rel="stylesheet" href="{{ asset('/public/css/style.css')}}"> -->
  <link rel="stylesheet" href="{{ asset('/public/css/custom.css')}}">


  <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
  <link href="{{ asset('/public/css/hotel-css/t-datepicker.min.css')}}" rel="stylesheet" type="text/css">


  <link rel="stylesheet" href="{{ asset('/public/css/hotel-css/autoComplete.min.css')}}">
  <script src="{{ asset('/public/css/hotel-css/autoComplete.js')}}"></script>

  <style>
  .recent-his {
    margin-top: 53px;
  }
  </style>
  <!-- end nav css -->

</head>

<body>
  <!-- Google Tag Manager (noscript) -->
  <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-PTHP3JH4" height="0" width="0"
      style="display:none;visibility:hidden"></iframe></noscript>
  <!-- End Google Tag Manager (noscript) -->
  </head>

  <body>

    @include('Loc_nav.loc_navbar')

    <div class="hotel-listing-page">
      <div class="container">

        <!-- breadcrums -->
     <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
        <ol class="breadcrumb">

       @if(!empty($breadcumb))
        <li class="breadcrumb-item active" aria-current="page">
          <a href="{{ route('explore_continent_list',[$breadcumb[0]->contid,$breadcumb[0]->ccName])}}"> {{$breadcumb[0]->ccName}}</a>
        </li>              
          <li class="breadcrumb-item">
            <a
              href="{{ route('explore_country_list',[$breadcumb[0]->CountryId,$breadcumb[0]->cslug])}}">
              @if(!empty($breadcumb)) {{$breadcumb[0]->CountryName}} @endif</a>
          </li>
        @endif

          @if(!empty($locationPatent))
          <?php
                $locationPatents = array_reverse($locationPatent);
                ?>
          @foreach ($locationPatents as $location)
          <li class="breadcrumb-item">
            <a
              href="@if(!empty($location)){{ route('search.results',[$location['LocationId'].'-'.strtolower($location['slug'])]) }}@endif">
              {{ $location['Name'] }}</a>
          </li>
          @endforeach
          @endif

          @if(!$getlocationexp->isEmpty())
          <li class="breadcrumb-item active" aria-current="page"><a
              href="{{ route('search.results', [$getlocationexp[0]->slugid.'-'.strtolower($getlocationexp[0]->Slug)]) }}">{{$getlocationexp[0]->Name}}</a>
          </li>
          @endif

          <!-- <li class="breadcrumb-item active" aria-current="page">
        <a class="custom-link"          
          href=" @if(!$getloclink->isEmpty()) {{ route('search.results', [$getloclink[0]->LocationId.'-'. strtolower(str_replace('','_',$getloclink[0]->Slug))]) }} @endif">{{ $lname}}</a></li> -->


          <li class="breadcrumb-item active" aria-current="page">Hotels</li>
          <li class="breadcrumb-item active" aria-current="page">{{ $sname}}</li>
        </ol>
      </nav>


        <!-- end date and breadcrumb -->

        <div class="filters  my-5">
          <div class="row">
            <div class="col">
              <label for="">Price : Per night</label>
              <div class="dropdown">
                <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown"
                  data-bs-auto-close="outside" aria-expanded="false">
                  ₹100 -₹45,000
                </button>
                <ul class="dropdown-menu pricepernight ">
                  <div class="filter-drop-down">
                    <div class="filtertitle">
                      Set price range
                    </div>

                    <div class="perstay d-flex justify-content-between mb-3 align-items-center">
                      <div class="d-flex align-items-center">
                        <input type="radio" name="flexRadioDefault" class="btn-check" id="btn-check10">
                        <label class="btn " for="btn-check10">
                          Per night
                        </label>

                      </div>
                      <div class="d-flex align-items-center">
                        <input type="radio" name="flexRadioDefault" class="btn-check" id="btn-check11">
                        <label class="btn " for="btn-check11">
                          Total stay
                        </label>

                      </div>
                    </div>

                    <div class="filtertitle">
                      Price range
                    </div>




                    <div class="position-relative overflow-hidden" style="height: 100px;">
                      <div class="js-bar-chart position-absolute w-100" data-series='[
    [2,3,5,7,8,5,3,2,3,6,5,4,7,5,4,3,2]
 ]' data-is-show-axis-x="false" data-is-show-axis-y="false" data-is-full-width="true" data-is-stack-bars="true"
                        data-height="100px" data-high="8" data-low="0" data-distance="0" data-stroke-width="22"
                        data-stroke-color="#B0B0B0"></div>

                      <div id="foregroundBarChartDoubleResult" class="position-absolute h-100 overflow-hidden">
                        <div class="js-bar-chart position-absolute" data-series='[
    [2,3,5,7,8,5,3,2,3,6,5,4,7,5,4,3,2]
   ]' data-is-show-axis-x="false" data-is-show-axis-y="false" data-is-full-width="true" data-is-stack-bars="true"
                          data-height="100px" data-high="8" data-low="0" data-distance="0" data-stroke-width="22"
                          data-stroke-color="#707070"></div>
                      </div>
                    </div>
                    <!-- End Bar Charts -->

                    <!-- Range Slider -->
                    <input class="js-range-slider" type="text" data-extra-classes="u-range-slider" data-type="double"
                      data-foreground-target="#foregroundBarChartDoubleResult" data-min="0" data-max="1000"
                      data-from="250" data-to="750" data-result-min="#rangeSliderExample5MinResult"
                      data-result-max="#rangeSliderExample5MaxResult">

                    <div class=" minmaxprice mt-5">

                      <div class="minmaxpriceslot">
                        <label for="">Minimum price</label>
                        <div class="d-flex w-100">
                          <div class="ruppee">₹</div> <span id="rangeSliderExample5MinResult" class="ps-1"></span>
                        </div>
                      </div>

                      <svg width="24" height="2" viewBox="0 0 24 2" fill="none" xmlns="https://www.w3.org/2000/svg">
                        <line x1="0.5" y1="1" x2="23.5" y2="1" stroke="#D4D4D4" />
                      </svg>


                      <div class="minmaxpriceslot">
                        <label for="">Maximum price</label>
                        <div class="d-flex w-100">
                          <div class="ruppee">₹</div><span id="rangeSliderExample5MaxResult" class="ps-1"></span>
                        </div>
                      </div>

                    </div>
                    <hr>

                    <div class="row d-flex justify-content-between align-items-center">
                      <div class="col-md-6">
                        <div class="text-decoration-underline">
                          reset
                        </div>
                      </div>
                      <div class="col-md-6">
                        <button class="orangebutton" onclick="fetchFiltered()">
                          Apply
                        </button>
                      </div>
                    </div>
                  </div>
                </ul>
              </div>
            </div>
            <div class="col">
              <label for="">Filters</label>
              <div class="dropdown">
                <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown"
                  data-bs-auto-close="outside" aria-expanded="false">
                  Select
                </button>
                <ul class="dropdown-menu">
                  <div class="filter-drop-down">
                    <div class="filtertitle">
                      Hotel Class
                    </div>

                    <div class="reviews-toggle d-flex justify-content-between mb-3 align-items-center star-rating">
                      <div class="d-flex align-items-center">
                        <input type="checkbox" name="rating" class="btn-check" value="0,1" id="btn-check">
                        <label class="btn " for="btn-check">
                          0-1 <img src="{{asset('public/images/start.svg')}}" width="15" alt="" class="ms-1">
                        </label>

                      </div>
                      <div class="d-flex align-items-center">
                        <input type="checkbox" name="rating" class="btn-check" value="2" id="btn-check1">
                        <label class="btn " for="btn-check1">
                          2 <img src="{{asset('public/images/start.svg')}}" width="15" alt="" class="ms-1">
                        </label>

                      </div>
                      <div class="d-flex align-items-center">
                        <input type="checkbox" name="rating" class="btn-check" value="3" id="btn-check2">
                        <label class="btn " for="btn-check2">
                          3 <img src="{{asset('public/images/start.svg')}}" width="15" alt="" class="ms-1">
                        </label>

                      </div>
                      <div class="d-flex align-items-center">
                        <input type="checkbox" name="rating" class="btn-check" value="4" id="btn-check3">
                        <label class="btn " for="btn-check3">
                          4 <img src="{{asset('public/images/start.svg')}}" width="15" alt="" class="ms-1">
                        </label>

                      </div>
                      <div class="d-flex align-items-center">
                        <input type="checkbox" name="rating" class="btn-check" value="5" id="btn-check4">
                        <label class="btn " for="btn-check4">
                          5 <img src="{{asset('public/images/start.svg')}}" width="15" alt="" class="ms-1">
                        </label>

                      </div>
                    </div>
                    <div class="filtertitle">
                      Popular filters
                    </div>
                    <div class="row mnts">
                      <div class="col-md-6">
                        <div class="form-check">
                          <input class="form-check-input" type="checkbox" value="Free Cancellation" id="flexCheckDefault" name="special_mnt">
                          <label class="form-check-label" for="flexCheckDefault">Free
                            Cancellation</label>
                        </div>
                        <div class="form-check">

                      <input class="form-check-input" type="checkbox" value="freeWifi"
                        id="flexCheckDefault" name="special_mnt">
                      <label class="form-check-label" for="flexCheckDefault">Free Wifi</label>
                      </div>
                        <div class="form-check">

                          <input class="form-check-input" type="checkbox" value="breakfast"
                            id="flexCheckDefault" name="special_mnt">
                          <label class="form-check-label" for="flexCheckDefault">Breakfast
                            included</label>
                        </div>
                        <div class="form-check">

                        <input class="form-check-input" type="checkbox" value="deposit"
                          id="flexCheckDefault" name="special_mnt">
                        <label class="form-check-label" for="flexCheckDefault">Deposit</label>
                        </div>
                        <div class="form-check">

                          <input class="form-check-input" type="checkbox" value="Pool" id="flexCheckDefault" name="mnt">
                          <label class="form-check-label" for="flexCheckDefault">Pool</label>
                        </div>
                        <div class="form-check">

                        <input class="form-check-input" type="checkbox" value="24h. Reception" id="flexCheckDefault" name="mnt">
                        <label class="form-check-label" for="flexCheckDefault">24 hours Reception</label>
                        </div>
                    
                        <div class="form-check">

                          <input class="form-check-input" type="checkbox" value="Wi-Fi in public areas"
                            id="flexCheckDefault" name="mnt">
                          <label class="form-check-label" for="flexCheckDefault">Wi-Fi in public areas</label>
                        </div>
                        <div class="form-check">

                          <input class="form-check-input" type="checkbox" value="Car parking" id="flexCheckDefault"
                            name="mnt">
                          <label class="form-check-label" for="flexCheckDefault">Car parking</label>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-check">

                          <input class="form-check-input" type="checkbox" value="Air conditioning" id="flexCheckDefault"
                            name="mnt">
                          <label class="form-check-label" for="flexCheckDefault">Air conditioning</label>
                        </div>
                        <div class="form-check">

                          <input class="form-check-input" type="checkbox" value="Restaurant" id="flexCheckDefault"
                            name="mnt">
                          <label class="form-check-label" for="flexCheckDefault">Restaurant</label>
                        </div>
                        <div class="form-check">

                          <input class="form-check-input" type="checkbox" value="Per" id="flexCheckDefault" name="mnt">
                          <label class="form-check-label" for="flexCheckDefault">Per
                            friendly</label>
                        </div>
                        <div class="form-check">

                          <input class="form-check-input" type="checkbox" value="Family" id="flexCheckDefault"
                            name="mnt">
                          <label class="form-check-label" for="flexCheckDefault">Family
                            friendly</label>
                        </div>
                        <div class="form-check">

                          <input class="form-check-input" type="checkbox" value="Spa" id="flexCheckDefault" name="mnt">
                          <label class="form-check-label" for="flexCheckDefault">Spa</label>
                        </div>
                        <div class="form-check">

                          <input class="form-check-input" type="checkbox" value="Hot" id="flexCheckDefault" name="mnt">
                          <label class="form-check-label" for="flexCheckDefault">Hot
                            tub</label>
                        </div>
                        <div class="form-check">

                          <input class="form-check-input" type="checkbox" value="Wheelchair" id="flexCheckDefault"
                            name="mnt">
                          <label class="form-check-label" for="flexCheckDefault">Wheelchair
                            accessible</label>
                        </div>
                      </div>
                    </div>
                    <hr>

                    <div class="row d-flex justify-content-between align-items-center">
                      <div class="col-md-6">
                        <div class="text-decoration-underline">
                          reset
                        </div>
                      </div>
                      <div class="col-md-6">
                        <button class="orangebutton" onclick="fetchFiltered()">
                          Apply
                        </button>
                      </div>
                    </div>
                  </div>
                </ul>
              </div>
            </div>
            <div class="col">
              <label for="">Guest rating</label>
              <div class="dropdown ">
                <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown"
                  data-bs-auto-close="outside" aria-expanded="false">
                  All
                </button>
                <ul class="dropdown-menu">

                  <div class="filter-drop-down">
                    <div id="btn-check20">
                      Guest Rating
                    </div>
                    <div class="reviews-toggle mb-3 user-rating">
                      <div class="d-flex align-items-center mb-3">

                        <input type="checkbox" class="btn-check" id="btn-check22" name="use_rat" value="90">
                        <label class="btn " for="btn-check22">
                          90 <img src="{{ asset('public/images/start.svg') }}" width="15" alt="" class="ms-1">
                        </label>
                        <label for="" class="fw-500">Excellent</label>
                      </div>
                      <div class="d-flex align-items-center">
                        <input type="checkbox" class="btn-check" name="use_rat" id="btn-check21" value="80">
                        <label class="btn " for="btn-check21">
                          80 <img src="{{ asset('public/images/start.svg') }}" width="15" alt="" class="ms-1">
                        </label>
                        <label for="" class="fw-500">Very good</label>
                      </div>
                    </div>




                    <hr>

                    <div class="row d-flex justify-content-between align-items-center">
                      <div class="col-md-6">
                        <div class="text-decoration-underline">
                          reset
                        </div>
                      </div>
                      <div class="col-md-6">
                        <button class="orangebutton" onclick="fetchFiltered()">
                          Apply
                        </button>
                      </div>
                    </div>
                  </div>
                </ul>
              </div>
            </div>
            <div class="col">
              <label for="">Property type</label>
              <div class="dropdown">
                <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown"
                  data-bs-auto-close="outside" aria-expanded="false">
                  All
                </button>
                <ul class="dropdown-menu">




                  <div class="filter-drop-down  " id="hoteltype">
                    <div>
                      Property type
                    </div>


                    @foreach($gethoteltype as $hoteltype)
                    <div class="form-check d-flex align-items-center">
                      <input class="form-check-input" type="checkbox" name="hoteltypes" value="{{$hoteltype->hid}}"
                        id="hoteltype-{{$hoteltype->hid}}">
                      <label class="form-check-label" for="flexCheckCheckedDisabled">
                        {{$hoteltype->type}}
                      </label>
                    </div>
                    @endforeach


                    <hr>

                    <div class="row d-flex justify-content-between align-items-center">
                      <div class="col-md-6">
                        <div class="text-decoration-underline">
                          reset
                        </div>
                      </div>
                      <div class="col-md-6">
                        <button class="orangebutton" onclick="fetchFiltered()">
                          Apply
                        </button>
                      </div>
                    </div>
                  </div>



                </ul>
              </div>
            </div>
            <div class="col">
              <label for="">Location</label>
              <div class="dropdown">
                <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown"
                  data-bs-auto-close="outside" aria-expanded="false">
                  All
                </button>
                <ul class="dropdown-menu">

                  <div class="filter-drop-down">
                    <div class="filtertitle">
                      Find me stay close to...
                    </div>
                    <div class="mb-2">
                      this popular city:
                    </div>

                    <div class="dropdown filterdropdown">
                      <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        City centre
                      </button>
                      <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="#">Action</a></li>
                        <li><a class="dropdown-item" href="#">Another action</a></li>
                        <li><a class="dropdown-item" href="#">Something else here</a>
                        </li>
                      </ul>
                    </div>
                    <div class="mb-2">
                      or this address:
                    </div>
                    <input type="text" class="form-control" placeholder="Enter street address/zip code" id="address">
                
                    <div class="maximumdistance">
                      <span>Maximum distance</span>
                    </div>
                    <hr>

                    <div class="sliderlabels mt-md-5">
                      <div class="d-flex  justify-content-between">
                        <span>0.5</span>
                        <span>20+</span>
                      </div>
                      <input type="range" id="form_slider2" />
                      <div class="d-flex justify-content-end">
                        <div style="color: var(--neutral-600, #525252);
                            font-size: 12px;
                            font-weight: 500;">
                          <span class="rangevalue">0</span>km
                        </div>
                      </div>
                    </div>
                    <hr>
                    <div class="row d-flex justify-content-between align-items-center">
                      <div class="col-md-6">
                        <div class="text-decoration-underline">
                          reset
                        </div>
                      </div>
                      <div class="col-md-6">
                        <button class="orangebutton" onclick="fetchFiltered()">
                          Apply
                        </button>
                      </div>
                    </div>
                  </div>



                </ul>
              </div>
            </div>
          </div>
        </div>


        <div class="sortfilters d-flex justify-content-between">
          <div class="d-flex align-items-center">
            sort By :
            <div class="dropdownwithi ms-3">
              <div class="dropdown d-flex align-items-center justify-content-between w-100">
                <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown"
                  data-bs-auto-close="outside" aria-expanded="false">
                  Our recommendations
                </button>
                <div class="svg">
                  <svg xmlns="https://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
                    <path
                      d="M8.5 11V7H6.5V8H7.5V11H6V12H10V11H8.5ZM8 4C7.85166 4 7.70666 4.04399 7.58332 4.1264C7.45999 4.20881 7.36386 4.32594 7.30709 4.46299C7.25032 4.60003 7.23547 4.75083 7.26441 4.89632C7.29335 5.0418 7.36478 5.17544 7.46967 5.28033C7.57456 5.38522 7.7082 5.45665 7.85368 5.48559C7.99917 5.51453 8.14997 5.49968 8.28701 5.44291C8.42406 5.38614 8.54119 5.29001 8.6236 5.16668C8.70601 5.04334 8.75 4.89834 8.75 4.75C8.75 4.55109 8.67098 4.36032 8.53033 4.21967C8.38968 4.07902 8.19891 4 8 4Z"
                      fill="#717171" />
                    <path
                      d="M8 15C6.61553 15 5.26216 14.5895 4.11101 13.8203C2.95987 13.0511 2.06266 11.9579 1.53285 10.6788C1.00303 9.3997 0.86441 7.99224 1.13451 6.63437C1.4046 5.2765 2.07129 4.02922 3.05026 3.05026C4.02922 2.07129 5.2765 1.4046 6.63437 1.13451C7.99224 0.86441 9.3997 1.00303 10.6788 1.53285C11.9579 2.06266 13.0511 2.95987 13.8203 4.11101C14.5895 5.26216 15 6.61553 15 8C15 9.85652 14.2625 11.637 12.9497 12.9497C11.637 14.2625 9.85652 15 8 15ZM8 2C6.81332 2 5.65328 2.3519 4.66658 3.01119C3.67989 3.67047 2.91085 4.60755 2.45673 5.7039C2.0026 6.80026 1.88378 8.00666 2.11529 9.17054C2.3468 10.3344 2.91825 11.4035 3.75736 12.2426C4.59648 13.0818 5.66558 13.6532 6.82946 13.8847C7.99335 14.1162 9.19975 13.9974 10.2961 13.5433C11.3925 13.0892 12.3295 12.3201 12.9888 11.3334C13.6481 10.3467 14 9.18669 14 8C14 6.4087 13.3679 4.88258 12.2426 3.75736C11.1174 2.63214 9.5913 2 8 2Z"
                      fill="#717171" />
                  </svg>
                </div>
                <!-- <ul class="dropdown-menu pricepernight"> -->
                <ul class="dropdown-menu ">
                  <div class="filtertitle">
                    Set price range
                  </div>
                </ul>
              </div>
            </div>
          </div>

          <div class="d-flex">
            <div class="d-flex align-items-center  me-5">
              <img src="{{('public/images/Home.svg')}}" alt="">

              <div class="mx-3 fs14 color707070">Stays found:</div>
              <b class="fs12" style="border-radius: 4px;padding: 4px;
                        background: #EDF1F3;"> {{count($searchresults)}}</b>
            </div>

            <div class="d-flex align-items-center">
              <img src="{{('public/images/Schedule.svg')}}" alt="">
              <div class="mx-3 fs14 color707070">Booking sites searched:</div>
              <b class="fs12" style="border-radius: 4px;padding: 4px;
                        background: #EDF1F3;"> 188</b>
            </div>
          </div>

          <div class="view-map">
            <button><svg xmlns="https://www.w3.org/2000/svg" width="15" height="19" viewBox="0 0 15 19" fill="none">
                <path
                  d="M7.33537 8.9375C7.77707 8.9375 8.15451 8.78022 8.46771 8.46567C8.7809 8.15113 8.9375 7.77301 8.9375 7.33129C8.9375 6.8896 8.78022 6.51215 8.46567 6.19896C8.15113 5.88576 7.77301 5.72917 7.33129 5.72917C6.8896 5.72917 6.51215 5.88644 6.19896 6.201C5.88576 6.51554 5.72917 6.89366 5.72917 7.33537C5.72917 7.77707 5.88644 8.15451 6.201 8.46771C6.51554 8.7809 6.89366 8.9375 7.33537 8.9375ZM7.33333 16.5229C9.36528 14.6743 10.8663 12.9976 11.8365 11.4927C12.8066 9.98785 13.2917 8.6625 13.2917 7.51667C13.2917 5.7171 12.7165 4.24359 11.5662 3.09616C10.4159 1.94872 9.00498 1.375 7.33333 1.375C5.66168 1.375 4.25072 1.94872 3.10044 3.09616C1.95015 4.24359 1.375 5.7171 1.375 7.51667C1.375 8.6625 1.87153 9.98785 2.86458 11.4927C3.85764 12.9976 5.34722 14.6743 7.33333 16.5229ZM7.33333 18.3333C4.87361 16.2403 3.03646 14.2962 1.82188 12.501C0.607292 10.7059 0 9.04445 0 7.51667C0 5.225 0.737153 3.39931 2.21146 2.03958C3.68576 0.679861 5.39306 0 7.33333 0C9.27361 0 10.9809 0.679861 12.4552 2.03958C13.9295 3.39931 14.6667 5.225 14.6667 7.51667C14.6667 9.04445 14.0594 10.7059 12.8448 12.501C11.6302 14.2962 9.79306 16.2403 7.33333 18.3333Z"
                  fill="#222222" />
              </svg>View map</button>
          </div>

        </div>

        <hr>
        <h1 class="fs24 fw-500 mb-16">{{ $sname}}</h1>

 		@if(!empty($amenities))
        @foreach($amenities as $smnt)
        <button class="btn btn-outline-secondary">{{$smnt}}</button>
        @endforeach
        @endif

        @if(!empty($Rating))
        @foreach($Rating as $Ratings)
        <button class="btn btn-outline-secondary">{{$Ratings}} Star</button>
        @endforeach
        @endif

        @if(!$searchresults->isEmpty())
        <input type="hidden" id="location_id" value="{{$searchresults[0]->loc_id}}"> 
		           
        <span id="Cin" class="d-none">{{request('checkin')}}</span>
        <span id="Cout" class="d-none">{{request('checkout')}}</span> 
        <span id="rooms" class="d-none">{{request('rooms')}}</span>
        <span id="guest" class="d-none">{{request('guest')}}</span> 
		<span class="d-none loc_id">{{$locid}}</span>
        @endif

        <div class="hotel-listing-card  filter-listing mt-3">
         
        @if(!$searchresults->isEmpty())
          @foreach ($searchresults as $sresult)



          <div class="row mt-3">

            <div class="col-md-4">
              <div class="card-slider">

                <img src="{{('public/images/heart.svg')}}" alt="" class="heart" />

                <div class="hotel-listing-slider slick-initialized slick-slider">
                  <img src="{{('public/images/Hotel lobby.svg')}}" alt="" style="max-width: -webkit-fill-available;border-radius: 10px
px
;" />
               
                </div>
              </div>
            </div>
            <div class="col-md-5">
              <div class="py-3 px-2 border-toend">
                <div class="d-flex text-neutral-2 align-items-center mb-2">
                  @for ($i = 0; $i < 5; $i++) @if($i < $sresult->stars )
                    <img src="{{('public/images/star.svg')}}" alt="" class="stars">
                    @else
                    <i class="far fa-star text-111"></i>
                    @endif
                    @endfor

                    <!-- <img src="{{('public/images/star.svg')}}" alt="" class="stars">
                                          <img src="{{('public/images/star.svg')}}" alt="" class="stars">
                                          <img src="{{('public/images/star.svg')}}" alt="" class="stars">
                                          <img src="{{('public/images/star.svg')}}" alt="" class="stars"> -->
                </div>
                <?php  
                                          $ctName = $getloc[0]->cityName;
                                          $cityname = str_replace(' ', '_', $ctName);
                                          $CountryName = str_replace(' ', '_', $getloc[0]->countryName);
                                          $url = $cityname .'-'.$CountryName;
                                    ?>

			  
                    
                <div class="fs20 fs-sm-14 fw-500  mb-2 hotel-link"> <a href=" {{ url('hd-'.$sresult->slugid.'-' .$sresult->id .'-'.strtolower( str_replace(' ', '_', str_replace('#', '!', $sresult->slug)))) }}" target="_blank">{{$sresult->name}}</a></div>
				  @if($sresult->rating != "")
                <div class="d-flex justify-content-between align-items-start locationandothers ">
                  <ul class="d-flex flex-wrap fs-sm-10 fs14">
                    <li class=" d-flex align-items-center"><i class="fa  fa-heart" aria-hidden="true"></i>
                      <span>{{$sresult->rating}}%</span>
						
            
                    </li>
              
                    </li>
                  </ul>
                </div>
				@endif

   @if(!empty($hotels->result))
            
            @foreach ($hotels->result as $searchresult)
            @if($searchresult->id == $sresult->hotelid)
                          <?php 
                          $i = 1;
                          $freeCancellationDisplayed = false;
                          $freeWifiDisplayed = false;
                          $depositDisplayed = false;
                          $breakfastDisplayed = false; 
                            foreach ($searchresult->rooms as $room) {
                          
                              if($i == 1){
                               echo  $room->desc.'<br>';
                              }
                              $i ++; 
                          

                              $options = $room->options;
                              $trueOptions = [];
                              $selectedOptions = "";
                              if(isset($room->options)){ 

                                  foreach ($options as $key => $value) {
                                         if (isset($value) == 1) {
                                         
                                       
                                          if (!$breakfastDisplayed && $key == "breakfast") {
                                            $breakfastDisplayed = true; // Set the flag to true
                                            echo 'Breakfast included<br>';
                                          }
                                        
                                        if (!$freeCancellationDisplayed && $key == "Free Cancellation") {
                                            $freeCancellationDisplayed = true; 
                                            echo 'Free Cancellation <br>';
                                        }
        
                                  
                                        if (!$freeWifiDisplayed && $key == "freeWifi") {
                                            $freeWifiDisplayed = true; 
                                            echo 'Free WiFi <br>';
                                        }
        
                                
                                      }
                               
                              
                                 }

                              
                              } 
                         
                            ?>
                       
               
                     <?php      }
                          ?>       
                    @endif
                    @endforeach
                    @endif

                <div class="d-flex color707070 align-items-center fs-sm-10 fs14  mb-2">
                  <div class="d-flex align-items-center">
                    <svg xmlns="https://www.w3.org/2000/svg" width="20" height="21" viewBox="0 0 20 21" fill="none">
                      <path
                        d="M10 9.25C10.6904 9.25 11.25 8.69036 11.25 8C11.25 7.30964 10.6904 6.75 10 6.75C9.30964 6.75 8.75 7.30964 8.75 8C8.75 8.69036 9.30964 9.25 10 9.25Z"
                        fill="#E86E2C" />
                      <path
                        d="M10 1.75C6.55391 1.75 3.75 4.43164 3.75 7.72656C3.75 9.2957 4.46523 11.3824 5.87578 13.9289C7.00859 15.9734 8.31914 17.8223 9.00078 18.7422C9.11596 18.8994 9.26656 19.0272 9.44037 19.1153C9.61418 19.2034 9.8063 19.2493 10.0012 19.2493C10.196 19.2493 10.3882 19.2034 10.562 19.1153C10.7358 19.0272 10.8864 18.8994 11.0016 18.7422C11.682 17.8223 12.9938 15.9734 14.1266 13.9289C15.5348 11.3832 16.25 9.29648 16.25 7.72656C16.25 4.43164 13.4461 1.75 10 1.75ZM10 10.5C9.50555 10.5 9.0222 10.3534 8.61107 10.0787C8.19995 9.80397 7.87952 9.41352 7.6903 8.95671C7.50108 8.49989 7.45157 7.99723 7.54804 7.51227C7.6445 7.02732 7.8826 6.58186 8.23223 6.23223C8.58186 5.8826 9.02732 5.6445 9.51227 5.54804C9.99723 5.45157 10.4999 5.50108 10.9567 5.6903C11.4135 5.87952 11.804 6.19995 12.0787 6.61107C12.3534 7.0222 12.5 7.50555 12.5 8C12.4993 8.66282 12.2357 9.29828 11.767 9.76697C11.2983 10.2357 10.6628 10.4993 10 10.5Z"
                        fill="#707070" />
                    </svg>
                    <div class="ms-1">
                      {{$sresult->distance}} km to City centre
                    </div>
                  </div>
                  <!-- <div class="mx-4">
                    Excellent location!
                  </div> -->
                  <!-- <div class="hotel-rating">
                    9.3
                  </div> -->
                </div>
           
                <div class="fs13 fw-500 mb-3 mb-md-2">
                  Top Amenities
                </div>
                <div class="topamenities">
                  <?php 
                $displayedAmenitiesCount = 0;
                 $amenity =explode(',',$sresult->amenities);  
                ?>
                  @if($sresult->amenities != "")
                  
                  @foreach($amenity as $mnt)
                  @if($displayedAmenitiesCount <= 10)
                  <div class="amens d-flex "> <img src="{{ asset('public/images/wifi.svg')}}" alt=""> {{ $mnt}}</div>

                  <?php   
                      $displayedAmenitiesCount++;

                   ?>
                   @else
                        @break  
                   @endif
                  @endforeach

                  @endif
                  <?php 
                $displayedAmenitiesCount = 0;
                 $rm =explode(',',$sresult->room_aminities);  
                ?>
                  @if($sresult->room_aminities != "")
                  
                  @foreach($rm as $roommnt)
                  @if($displayedAmenitiesCount <= 10)
                  <div class="amens d-flex "> <img src="{{ asset('public/images/wifi.svg')}}" alt=""> {{ $roommnt}}</div>

                  <?php   
                      $displayedAmenitiesCount++;

                   ?>
                   @else
                        @break  
                   @endif
                  @endforeach

                  @endif
                  
                  

                  <?php 
          
                 $lang =explode(',',$sresult->Languages);  
                ?>
                  @if($sresult->Languages != "")
                  
                  @foreach($lang as $lan)
               
                  <div class="amens d-flex "> <img src="{{ asset('public/images/wifi.svg')}}" alt=""> {{ $lan}}</div>

                 
                  
                  @endforeach

                  @endif
                </div>
              </div>
            </div>
<!--   $sresult->hotelid -->
            @if(!empty($hotels->result))
            
            @foreach ($hotels->result as $searchresult)
            @if($searchresult->id == $sresult->hotelid)
            <div class="col-md-3 d-flex align-items-end py-3 selectdatesblock">
              <?php

                      $lowestPrices = [];
                      $otherPrices = [];

                    
                          foreach ($searchresult->rooms as $room) {
                              $agencyName = $room->agencyName;
                              $price = $room->price;
                              $agencyId = $room->agencyId;
							 $fullurl = $room->fullBookingURL;
							     //room count code
                               if(isset($room->options)){ 
                            
                                  $roomcount=0;
                                  foreach ($options as $key => $value) {
                                      if (isset($value)) {
                                      
                                    
                                      if (!$breakfastDisplayed && $key == "available") {
                                          $roomcount =$value;
                                      }

                                    }
                                  }
                                }

                                  //room code
                              // Check if agencyName is already in the array or if the price is lower
                              if (!isset($lowestPrices[$agencyName]) || $price < $lowestPrices[$agencyName]['price']) {
                                  $lowestPrices[$agencyName] = ['price' => $price, 'fullBookingURL' => $fullurl, 'agencyId' => $agencyId,'roomcount'=>$roomcount];
                              }

                              // Store other prices
                              $otherPrices[$agencyName][] = ['price' => $price, 'fullBookingURL' => $fullurl,'agencyId' => $agencyId];
                          }
                      
                ?>

              <div class="w-100 px-5 px-md-0">
                <div class="price">
               
                  @foreach ($lowestPrices as $agencyName => $data)
                  @if ($loop->first)
                
                  <div class="d-flex align-items-center justify-content-between p-api">
                    <img src="{{ 'https://pics.avs.io/hl_gates/100/40/' . $data['agencyId'] . '.png' }}"
                      alt="Agency Logo">
                    <div class="d-flex align-items-center ml-3" style="margin-left: 92px;">
                      <a href="{{ $data['fullBookingURL'] }}" target="_blank">
                        <div class="new">${{ $data['price'] }}</div>
                      </a>
                      <svg xmlns="https://www.w3.org/2000/svg" width="18" height="17" viewBox="0 0 18 17" fill="none">
                        <g clip-path="url(#clip0_2493_66513)">
                          <path
                            d="M7.19399 5.33294L12.143 5.24941M12.143 5.24941L12.2266 10.1984M12.143 5.24941L5.88738 11.7199"
                            stroke="#222222" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                        </g>
                        <defs>
                          <clipPath id="clip0_2493_66513">
                            <rect width="12" height="12" fill="white"
                              transform="translate(0.53125 8.62695) rotate(-45.967)" />
                          </clipPath>
                        </defs>
                      </svg>
                    </div>
                  </div>
                  @endif
                  @endforeach
                </div>
                <div class="mb-20 fs12 color707070 text-start">
					 Price Per Night   @if($data['roomcount'] <= 5 && $data['roomcount'] != 0) <span class="ml-3" style="color:red;    margin-left: 55px;"> Only {{$data['roomcount']}} rooms left</span> @endif 
                </div>
                <button class="orangebutton">
                  <a href="{{$searchresult->fullUrl}}&currency=usd">View Deal</a>
                </button>


                @foreach ($lowestPrices as $agencyName => $data)
                @if (!$loop->first)
                <!-- Rest of the records -->
                <div class="d-flex align-items-center justify-content-between p-api">
                  <img src="{{ 'https://pics.avs.io/hl_gates/100/40/' . $data['agencyId'] . '.png' }}" alt="Agency Logo">
                  <div class="d-flex align-items-center">
                    <a href="{{ $data['fullBookingURL'] }}" target="_blank">${{ $data['price'] }}</a>
                    <svg xmlns="https://www.w3.org/2000/svg" width="18" height="17" viewBox="0 0 18 17" fill="none">
                      <g clip-path="url(#clip0_2493_66513)">
                        <path
                          d="M7.19399 5.33294L12.143 5.24941M12.143 5.24941L12.2266 10.1984M12.143 5.24941L5.88738 11.7199"
                          stroke="#222222" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                      </g>
                      <defs>
                        <clipPath id="clip0_2493_66513">
                          <rect width="12" height="12" fill="white"
                            transform="translate(0.53125 8.62695) rotate(-45.967)" />
                        </clipPath>
                      </defs>
                    </svg>
                  </div>
                </div>
                @endif
                @endforeach


                @endif
                @endforeach
                </div>
                </div>
                @endif
              </div>
         
     
          @endforeach


   

          @else
          <h3 class="m-3">No Hotels available for this location.</h3>
          @endif
         
        </div>

        <div class="notification">
          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
            <path
              d="M12.0003 1C15.6813 1 19.0003 3.565 19.0003 7V11.539C19.0003 12.181 19.1893 12.808 19.5453 13.342L21.7453 16.64C21.898 16.8685 21.9858 17.1343 21.9992 17.4088C22.0127 17.6834 21.9513 17.9564 21.8216 18.1988C21.6919 18.4412 21.4987 18.6437 21.2628 18.7848C21.027 18.926 20.7571 19.0003 20.4823 19H15.5003C15.5003 19.4596 15.4097 19.9148 15.2338 20.3394C15.0579 20.764 14.8001 21.1499 14.4751 21.4749C14.1501 21.7999 13.7643 22.0577 13.3397 22.2336C12.915 22.4095 12.4599 22.5 12.0003 22.5C11.5406 22.5 11.0855 22.4095 10.6609 22.2336C10.2362 22.0577 9.85039 21.7999 9.52539 21.4749C9.20038 21.1499 8.94257 20.764 8.76668 20.3394C8.59079 19.9148 8.50026 19.4596 8.50026 19H3.51926C3.2445 19.0002 2.97483 18.9259 2.73901 18.7849C2.50319 18.6439 2.31006 18.4415 2.18021 18.1994C2.05036 17.9572 1.98867 17.6844 2.00171 17.41C2.01475 17.1355 2.10204 16.8697 2.25426 16.641L4.45426 13.342C4.81027 12.8081 5.00025 12.1807 5.00026 11.539V7C5.00026 3.565 8.31826 1 12.0003 1ZM6.50026 7V11.539C6.50052 12.4767 6.2232 13.3936 5.70326 14.174L3.50326 17.472L3.50026 17.482L3.50126 17.489L3.50526 17.495L3.51126 17.499L3.51826 17.5H20.4823L20.4893 17.499L20.4953 17.495L20.4993 17.489L20.5003 17.483C20.5003 17.4794 20.4993 17.4759 20.4973 17.473L18.2983 14.174C17.7781 13.3936 17.5005 12.4768 17.5003 11.539V7C17.5003 4.636 15.1173 2.5 12.0003 2.5C8.88326 2.5 6.50026 4.636 6.50026 7ZM14.0003 19H10.0003C10.0003 19.5304 10.211 20.0391 10.586 20.4142C10.9611 20.7893 11.4698 21 12.0003 21C12.5307 21 13.0394 20.7893 13.4145 20.4142C13.7895 20.0391 14.0003 19.5304 14.0003 19Z"
              fill="#707070" />
          </svg>
          <div>
            The prices and availability we receive from booking sites change constantly. This means you may not
            always find the exact same offer you saw on Yaan when you land on the booking site.
          </div>
        </div>

      </div>
    </div>
    @include('footer')




    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-lightbox/0.2.12/slick-lightbox.min.js"></script>
    <!-- <script src="assets/t-datepicker.min.js"></script> -->
    <!-- chart -->
    <script src="https://htmlstream.com/preview/front-v2.1/assets/vendor/jquery-migrate/dist/jquery-migrate.min.js">
    </script>

    <script src="https://htmlstream.com/preview/front-v2.1/assets/vendor/ion-rangeslider/js/ion.rangeSlider.min.js">
    </script>
    <script src="https://htmlstream.com/preview/front-v2.1/assets/vendor/chartist/dist/chartist.min.js"></script>

    <!-- JS Front -->
    <script src="https://htmlstream.com/preview/front-v2.1/assets/js/hs.core.js"></script>
    <script src="https://htmlstream.com/preview/front-v2.1/assets/js/components/hs.range-slider.js"></script>
    <script src="https://htmlstream.com/preview/front-v2.1/assets/js/components/hs.chartist-bar-chart.js"></script>
    <script src="https://htmlstream.com/preview/front-v2.1/assets/js/components/hs.chartist-area-chart.js"></script>

    <!-- <script src="{{ asset('/public/js/index.js')}}"></script> -->

    <!-- JS Plugins Init. -->
    <script>
    $(document).on('ready', function() {
      // initialization of header


      // initialization of forms
      $.HSCore.components.HSRangeSlider.init('.js-range-slider');

      // initialization of chartist bar chart
      $.HSCore.components.HSChartistBarChart.init('.js-bar-chart');

    });

    $(window).on('resize', function() {
      setTimeout(function() {
        $.HSCore.components.HSChartistBarChart.init('.js-bar-chart');
        $.HSCore.components.HSChartistAreaChart.init('.js-area-chart');
      }, 800);
    });
    </script>
    <script>
    var $sliderValue = $("#form_slider1").val(),
      $sliderCounter = $('.rangevalue'),
      $rangeSlider = $("#form_slider1");

    // set value initially
    $sliderCounter.html($sliderValue)

    // update value on scrub
    $rangeSlider.on("input", function() {
      $sliderValue = $(this).val();
      $sliderCounter.html($sliderValue)
    });

    var $sliderValue = $("#form_slider2").val(),
      $sliderCounter = $('.rangevalue'),
      $rangeSlider = $("#form_slider2");

    // set value initially
    $sliderCounter.html($sliderValue)

    // update value on scrub
    $rangeSlider.on("input", function() {
      $sliderValue = $(this).val();
      $sliderCounter.html($sliderValue)
    });
    </script>

    <script>
    var $slider = $('.hotel-listing-slider');

    if ($slider.length) {
      var currentSlide;
      var slidesCount;
      var sliderCounter = document.createElement('div');
      sliderCounter.classList.add('slider__counter');

      var updateSliderCounter = function(slick, currentIndex) {
        currentSlide = slick.slickCurrentSlide() + 1;
        slidesCount = slick.slideCount;
        $(sliderCounter).text(currentSlide + '/' + slidesCount)
      };

      $slider.on('init', function(event, slick) {
        $slider.append(sliderCounter);
        updateSliderCounter(slick);
      });

      $slider.on('afterChange', function(event, slick, currentSlide) {
        updateSliderCounter(slick, currentSlide);
      });

      $slider.slick();
    }





    if ($('.firstspan').hasClass('current-page')) {
      $('.chevron_back').hide();
    } else {
      $('.chevron_back').show();
    }
    </script>


    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script src="{{asset('public/js/hotellisting.js')}} "></script>
    <script src="{{asset('public/js/header.js')}}"></script>

    <!-- nav js -->
    <script src="{{ asset('public/css/hotel-css/t-datepicker.min.js')}}"></script>
    <script src="{{ asset('/public/js/datepicker-homepage.js')}}"></script>
    <script src="{{ asset('/public/js/custom.js')}}"></script>

    <!-- end nav js -->


  </body>

</html>