<!DOCTYPE html>
<html lang="en-US">

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
  <meta name="csrf-token" content="{{ csrf_token() }}">
<meta charset="utf-8">
  @if($pagetype=="withoutdate")

  @php
          $metaTitle = "";
  @endphp
  @if(!$metadata->isEmpty() && !empty(trim($metadata[0]->HotelTitleTag)))
      @php
          $metaTitle = trim($metadata[0]->HotelTitleTag);
      @endphp
  @else
      @php
    $metaTitle = "Compare Hotel Prices in $lname | Best Deals on Stays for Every Budget";
    @endphp
  @endif

  @php
        $metaDescription ="";
  @endphp
  @if(!$metadata->isEmpty() && !empty(trim($metadata[0]->HotelMetaDescription)))
    @php
        $metaDescription = trim($metadata[0]->HotelMetaDescription);
    @endphp
  @else
      @php
          $metaDescription = "Find and compare the best hotel prices in $lname. Discover deals on luxury, mid-range, and budget accommodations with our easy-to-use price comparison. Get the lowest rates for your ideal stay, tailored to any travel style and budget.";
      @endphp
  @endif
   <title>{{ $metaTitle }}</title>
  <meta name="description" content='{{$metaDescription }}'>
  @endif
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Figtree:ital,wght@0,300..900;1,300..900&display=swap"
    rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

  <script type="text/javascript" src="{{ asset('/public/frontend/hotel-detail/js/jquery.min.js')}}"></script>
  <script type="text/javascript" src="{{ asset('/public/frontend/hotel-detail/js/bootstrap.bundle.min.js')}}"></script>
  <script type="text/javascript" src="{{ asset('/public/frontend/hotel-detail/js/jquery-ui-datepicker.min.js')}}">
  </script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <link rel="stylesheet" href="{{ asset('/public/frontend/hotel-detail/css/bootstrap.min.css')}}">
  <link rel="stylesheet" href="{{ asset('/public/frontend/hotel-detail/css/style.css')}}">
  <link rel="stylesheet" href="{{ asset('/public/frontend/hotel-detail/css/calendar.css')}}" media="screen">
  <link rel="stylesheet" href="{{ asset('/public/frontend/hotel-detail/css/responsive.css')}}">
  <link rel="stylesheet" href="{{ asset('/public/frontend/hotel-detail/css/custom.css')}}">
  <!-- <link rel="stylesheet" href="{{ asset('/public/css/custom.css')}}"> -->

  <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
  <style>
    #map {
      height: 100%; /* Set a fixed height */
      width: 100%;
    }

    .tr-filter-label {
    margin-top: -30px; /* Adjust this value to control how much you move it up */
}
    .tr-filter-label + .unique-h5 {
    margin-top: 25px;
}


.tr-more-facilities .short-description-content {
    text-align: justify; /* Justifies the text alignment */
    max-height: 92px;
    overflow: hidden;
    position: relative;
    line-height: 1.5;
}

.tr-more-facilities .short-description-content.show-more {
    max-height: none; /* Shows full content when toggled */
}

.tr-anchor-btn.toggle-list {
    display: block; /* Ensures the button is visible */
    margin-top: 10px;
}
/* Transition for smoother expansion */
.tr-more-facilities.expanded .paragraph-content {
    max-height: none; /* Remove height restriction when expanded */
}

/* "Read More" button styling */
/* Force visibility for troubleshooting */
.custom-read-more {
    font-weight: 600;
  font-size: 16px;
  line-height: 19px;
  letter-spacing: 0.01em;
  color: #FF4B01;
  border: none;
  border-bottom: 1px solid #FF4B01;
  background: transparent;
}

/* Hide "Read More" button when content is fully expanded */
.tr-more-facilities.expanded .custom-read-more {
    display: none;
}
.tr-price-range-section {
  position: relative;
}

#maxPrice {
  position: absolute;
  top: -25px; /* Adjust vertical position to place it above the slider */
  white-space: nowrap;
  text-overflow: ellipsis;
  transition: left 0.1s ease; /* Smooth transition */
  right: 0; /* Initially align the max price to the right */
}
.tr-price-range-section {
  position: relative;
}

#maxPrice {
  position: absolute;
  top: -25px; /* Adjust this value to move the label above the slider */
  left: 0;
  white-space: nowrap;
  text-overflow: ellipsis;
  transition: left 0.1s ease;  /* Smooth transition when moving */
}

#minPrice {
  position: absolute;
  top: -25px; /* Same for the min price */
  left: 0;
  white-space: nowrap;
  text-overflow: ellipsis;
}

.tr-price-slider {
  position: relative;
  width: 100%; /* Ensure slider takes the full width */
}

.tr-price-slider input[type=range] {
  -webkit-appearance: none;
  appearance: none;
  background: transparent;
  width: 100%;
  height: 5px;
  pointer-events: none;
  position: absolute;
}

.tr-price-slider input[type=range]::-webkit-slider-thumb {
  -webkit-appearance: none;
  appearance: none;
  background-color: #FFFFFF;
  border-radius: 50%;
  border: 1px solid #000000;
  width: 20px;
  height: 20px;
  cursor: pointer;
  pointer-events: auto;
}

.tr-price-slider input[type=range]::-moz-range-thumb {
  background: #4CAF50;
  cursor: pointer;
  border-radius: 50%;
  width: 15px;
  height: 15px;
  pointer-events: auto;
}

  </style>
   <?php
      $locationPatents = $locationPatent;
       $n = 2;
	  if(!empty($locationPatents)){
       $locationPatents = array_reverse($locationPatent);
	   }
      ?>
 <script type="application/ld+json">
{
  "@context": "https://schema.org/",
  "@type": "BreadcrumbList",
  "itemListElement": [
    {
      "@type": "ListItem",
      "position": 1,
      "name": "@if(!$getcontlink->isEmpty()){{$getcontlink[0]->cName}}@endif",
      "item": "@if(!$getcontlink->isEmpty()){{ route('explore_continent_list',[$getcontlink[0]->contid,$getcontlink[0]->cName])}}@endif"
    },
    {
      "@type": "ListItem",
      "position": 1,
      "name": "@if(!$getcontlink->isEmpty()){{$getcontlink[0]->Name}}@endif",
      "item": "@if(!$getcontlink->isEmpty()){{ route('explore_country_list',[$getcontlink[0]->CountryId,$getcontlink[0]->slug])}}@endif"
    }
    @if(!empty($locationPatents))
      @foreach ($locationPatents as $location)
      ,{
        "@type": "ListItem",
        "position": {{ $n }},
        "name": "{{ $location['Name'] }}",
        "item": "@if(!empty($location)){{ route('search.results',[$location['LocationId'].'-'.strtolower($location['slug'])]) }}@endif"
      }
      <?php $n++; ?>
      @endforeach
    @endif
    @if(!$getlocationexp->isEmpty())
    ,{
      "@type": "ListItem",
      "position": {{$n}},
      "name": "{{$getlocationexp[0]->Name}}",
      "item": "{{ route('search.results', [$getlocationexp[0]->slugid.'-'.strtolower($getlocationexp[0]->Slug)]) }}"
    }
    <?php $n++; ?>
    @endif
    ,{
      "@type": "ListItem",
      "position": {{$n}},
      "name": "Hotels",
      "item": ""
    }
  ]
}

</script>

<?php if ($pagetype == "withdate") {

    $chekin = request()->get('checkin');
    $chkout = request()->get('checkout');

    // Validating and formatting check-in and check-out dates
    $checkin = preg_match('/^\d{4}-\d{2}-\d{2}$/', $chekin) ? $chekin : date('Y-m-d', strtotime(str_replace('-', ' ', $chekin)));
    $checkout = preg_match('/^\d{4}-\d{2}-\d{2}$/', $chkout) ? $chkout : date('Y-m-d', strtotime(str_replace('-', ' ', $chkout)));

    $guest = request('guest') ?: 1; // Default guest to 1 if not set

    // Meta Title and Meta Description
    $metaTitle = "";
    $metaDescription = "";

    if (!$metadata->isEmpty() && !empty(trim($metadata[0]->HotelTitleTag))) {
        $metaTitle = trim($metadata[0]->HotelTitleTag);
    } else {
        $metaTitle = "Compare Hotel Prices in $lname | Best Deals on Stays for Every Budget";
    }

    if (!$metadata->isEmpty() && !empty(trim($metadata[0]->HotelMetaDescription))) {
        $metaDescription = trim($metadata[0]->HotelMetaDescription);
    } else {
        $metaDescription = "Find and compare the best hotel prices in $lname. Discover deals on luxury, mid-range, and budget accommodations with our easy-to-use price comparison. Get the lowest rates for your ideal stay, tailored to any travel style and budget.";
    }
    ?>
    <title><?php echo $metaTitle; ?></title>
    <meta name="description" content="<?php echo $metaDescription; ?>">
<?php } ?>

	<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "ItemList",
  "name": "Hotels in {{$lname}}",
  "description": "Hotels in {{$lname}}, {{$getcontlink[0]->Name}}",
  "itemListOrder": "https://schema.org/ItemListOrderAscending",
  "itemListElement": [
    @if(!$searchresults->isEmpty())
      <?php  $z = 1;   $totalItems = $searchresults->count(); ?>
      @foreach($searchresults as $searchresult)
        <?php if ($pagetype == "withdate") { $ctName = $lname; $cityname = str_replace(' ', '_', $ctName);$CountryName = str_replace(' ', '_', $countryname); $url = $cityname . '-' . $CountryName; $hotel_url = url('hd-' . $searchresult->slugid . '-' . $searchresult->id . '-' . strtolower(str_replace(' ', '_', str_replace('#', '!', $searchresult->slug))) . "?checkin={$checkin}&checkout={$checkout}"); } else {  $hotel_url = url('hd-' . $searchresult->slugid . '-' . $searchresult->id . '-' . strtolower(str_replace(' ', '_', str_replace('#', '!', $searchresult->slug)))); } ?>
        {
          "@type": "ListItem",
          "position": {{$z}},
          "name": "{{ $searchresult->name }}",
          "url": "{{ $hotel_url }}",
          "image": "https://photo.hotellook.com/image_v2/crop/h{{ $searchresult->hotelid }}_0/520/460.jpg"
        }@if($z < $totalItems),@endif <?php $z++; ?> @endforeach @endif ]
}
</script>

</head>
<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-PTHP3JH4" height="0" width="0"
    style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->

<body>
  <!--HEADER-->
  @if($pagetype=="withoutdate")
  @include('frontend.header_without_search')
  <span class="d-none ptype">withoutdate</span>
  @else
  @include('frontend.header')
  <span class="d-none ptype">withdate</span>
  @endif


  <!-- Mobile Navigation-->
   @include('frontend.mobile_nav')

  <div @if($pagetype=='withoutdate' ) class="tr-listing-without-dates-1" @else class="tr-listing-with-dates-1" @endif>
    <div class="container">
      <div class="row">
        <div class="col-sm-12">
          @if($pagetype=="withoutdate")
          <div class="tr-heading-section">
            <h1>Hotels in {{$lname}}</h1>
            <h2>Compare prices from 70+ Hotels websites in just a single click</h2>
          </div>
          <!--HOTEL SEARCHES FORM- START-->
          <div class="tr-search-hotel">
            <form class="tr-hotel-form" id="hotelForm3">
              <div class="tr-form-section">
                <div class="tr-date-section">
                  <input type="text" class="tr-room-guest" placeholder="1 room, 2 guests" id="totalRoomAndGuest"
                    value="" name="" readonly="">
                  <div class="tr-add-edit-guest-count">
                    <div class="tr-guests-modal">
                      <div class="tr-add-edit-guest tr-total-num-of-rooms">
                        <div class="tr-guest-type">
                          <label class="tr-guest">Room</label>
                        </div>
                        <div class="tr-qty-box">
                          <button class="minus disabled" value="minus">-</button>
                          <input type="text" id="totalRoom" value="1" min="1" max="10" name="" readonly="">
                          <button class="plus" value="plus">+</button>
                        </div>
                      </div>
                      <div class="tr-add-edit-guest tr-total-guest">
                        <div class="tr-guest-type">
                          <label class="tr-guest">Adults</label>
                          <div class="tr-age">Ages 13 or above</div>
                        </div>
                        <div class="tr-qty-box">
                          <button class="minus disabled" value="minus">-</button>
                          <input type="text" id="totalAdultsGuest" value="2" min="1" max="10" name="" readonly="">
                          <button class="plus" value="plus">+</button>
                        </div>
                      </div>
                      <div class="tr-add-edit-guest tr-total-children">
                        <div class="tr-guest-type">
                          <label class="tr-guest">Children</label>
                          <div class="tr-age">Ages 2 - 12</div>
                        </div>
                        <div class="tr-qty-box">
                          <button class="minus disabled" value="minus">-</button>
                          <input type="text" id="totalChildrenGuest" value="0" min="1" max="10" name="" readonly="">
                          <button class="plus" value="plus">+</button>
                        </div>
                      </div>
                      <div class="tr-add-edit-guest tr-total-infants">
                        <div class="tr-guest-type">
                          <label class="tr-guest">Infants</label>
                          <div class="tr-age">Under 2</div>
                        </div>
                        <div class="tr-qty-box">
                          <button class="minus disabled" value="minus">-</button>
                          <input type="text" id="totalChildrenInfants" value="0" min="1" max="10" name="" readonly="">
                          <button class="plus" value="plus">+</button>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="tr-form-fields">
                  <div class="col tr-mobile">
                    <div class="tr-mobile-where">
                      <label class="tr-lable">Where to?</label>
                      <div class="tr-location-label">Search destinations</div>
                    </div>
                  </div>
                  <div class="col tr-mobile">
                    <div class="tr-mobile-when">
                      <label class="tr-lable">When</label>
                      <div class="tr-add-dates">Add dates</div>
                    </div>
                  </div>
                  <div class="col tr-form-where">
                    <div class="tr-mobile tr-close-btn">Where are you going?</div>
                    <label for="searchDestinations">Where</label>

                    <input id="searchDestinations" type="hidden" tabindex="1" placeholder="&#xF002; Search"
                      autocomplete="off">
                    <input type="text" class="form-control fffffff" id="searchhotel"  value="@if($lname !=''){{$lname}}@endif" placeholder="Search Location"
                      name="" autocomplete="off">

                    <div class="tr-recent-searchs-modal" id="recentSearchsDestination">
                      <p id="hotel_loc_list" class="autoCompletewrapper tr-custom-scrollbar"></p>
                    </div>
                    <span id="slug" class="d-none">{{$slgid}}-{{$slugdata}}</span>
                    <span id="hotel" class="d-none">0</span>
                    <span id="location_id" class="d-none">{{$slgid}}</span>

                    <div class="tr-form-btn tr-mobile">
                      <button type="button" class="tr-btn">Countinue</button>
                    </div>
                  </div>
                  <?php date_default_timezone_set('Asia/Kolkata');

                      $checkinDate = date('Y-m-d', strtotime(' +1 day'));
                      $checkoutDate = date('Y-m-d', strtotime(' +4 day'));
                      ?>
                  <div class="col tr-form-booking-date">
                    <div class="tr-form-checkin">
                      <label for="checkInInput3">Check in</label>
                      <input type="text" value="{{ $checkinDate}}" class="form-control checkIn t-input-check-in"
                        id="checkInInput3" placeholder="Add dates" name="" autocomplete="off" readonly>
                    </div>
                    <div class="tr-form-checkout">
                      <label for="checkOutInput3">Check out</label>
                      <input type="text" value="{{ $checkoutDate}}" class="form-control checkOut t-input-check-out"
                        id="checkOutInput3" placeholder="Add dates" name="checkOut" autocomplete="off" readonly>
                    </div>
                    <div class="tr-calenders-modal" id="calendarsModal3" style="display: none">
                      <div id="calendarPair3" class="calendarPair">
                        <div class="navigation">
                          <button type="button" class="prevMonth" id="prevMonth3">Previous</button>
                          <button type="button" class="nextMonth" id="nextMonth3">Next</button>
                        </div>
                        <div class="custom-calendar checkInCalendar" id="checkInCalendar3">
                          <div class="monthYear"></div>
                          <div class="calendarBody"></div>
                        </div>
                        <div class="custom-calendar checkOutCalendar" id="checkOutCalendar3">
                          <div class="monthYear"></div>
                          <div class="calendarBody"></div>
                        </div>
                        <button type="button" class="tr-clear-details" hidden id="reset3">Clear dates</button>
                      </div>
                    </div>
                    <div class="col tr-form-btn">
                      <button type="button" class="tr-btn tr-mobile">Next</button>
                    </div>
                  </div>
                  <div class="col tr-form-who">
                    <label for="totalRoomAndGuest">Who</label>
                    <input type="text" class="form-control tr-total-room-and-guest" id="totalRoomAndGuest3"
                      placeholder="Add guests" name="" autocomplete="off" readonly>
                    <div class="tr-guests-modal" id="guestQtyModal">
                      <div class="tr-add-edit-guest tr-total-num-of-rooms">
                        <div class="tr-guest-type">
                          <label class="tr-guest">Room</label>
                        </div>
                        <div class="tr-qty-box">
                          <button class="minus disabled" value="minus">-</button>
                          <input type="text" id="totalRoom" value="1" id="" min="1" max="10" name="" readonly />
                          <button class="plus" value="plus">+</button>
                        </div>
                      </div>
                      <div class="tr-add-edit-guest tr-total-guest">
                        <div class="tr-guest-type">
                          <label class="tr-guest">Adults</label>
                          <div class="tr-age">Ages 13 or above</div>
                        </div>
                        <div class="tr-qty-box">
                          <button class="minus disabled" value="minus">-</button>
                          <input type="text" id="totalAdultsGuest" value="2" id="" min="1" max="10" name="" readonly />
                          <button class="plus" value="plus">+</button>
                        </div>
                      </div>
                      <div class="tr-add-edit-guest tr-total-children">
                        <div class="tr-guest-type">
                          <label class="tr-guest">Children</label>
                          <div class="tr-age">Ages 2 - 12</div>
                        </div>
                        <div class="tr-qty-box">
                          <button class="minus disabled" value="minus">-</button>
                          <input type="text" id="totalChildrenGuest" value="0" id="" min="1" max="10" name=""
                            readonly />
                          <button class="plus" value="plus">+</button>
                        </div>
                      </div>
                      <div class="tr-add-edit-guest tr-total-infants">
                        <div class="tr-guest-type">
                          <label class="tr-guest">Infants</label>
                          <div class="tr-age">Under 2</div>
                        </div>
                        <div class="tr-qty-box">
                          <button class="minus disabled" value="minus">-</button>
                          <input type="text" id="totalChildrenInfants" value="0" id="" min="1" max="10" name=""
                            readonly />
                          <button class="plus" value="plus">+</button>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col tr-form-btn">
                  <button class="tr-btn tr-popup-btn filter-chackinouts" id=""><span class="tr-desktop">Get
                      Price</span><span class="tr-mobile">Search</span></button>
                </div>
              </div>
            </form>
          </div>
          <!--HOTEL SEARCHES FORM- START-->
          <!--PARTNERS - START-->
          <div class="tr-partners-section">
            <div class="tr-partners-title">70+ Partners :</div>
            <div class="tr-partners-lists">
              <div class="tr-partners-list">
                <img src="{{ asset('public/frontend/hotel-detail/images/booking.png')}}" alt="Booking" />
              </div>
              <div class="tr-partners-list">
                <img src="{{ asset('public/frontend/hotel-detail/images/expedia.png')}}" alt="expedia" />
              </div>
              <div class="tr-partners-list">
                <img src="{{ asset('public/frontend/hotel-detail/images/agoda.png')}}" alt="agoda" />
              </div>
              <div class="tr-partners-list">
                <img src="{{ asset('public/frontend/hotel-detail/images/trip.png')}}" alt="trip" />
              </div>
            </div>
          </div>
          <!--PARTNERS - end-->
          @endif
          @if($pagetype=="withdate")
          <?php            $chekin = request()->get('checkin');
                         $chkout = request()->get('checkout');


                          if (preg_match('/^\d{4}-\d{2}-\d{2}$/', $chekin)) {
                              $checkin = $chekin;
                          } else {
                            $chekin =  str_replace('-',' ',$chekin);
                            $chekin = strtotime($chekin);
                            $checkin = date('Y-m-d', $chekin);


                          }


                          if (preg_match('/^\d{4}-\d{2}-\d{2}$/', $chkout)) {
                              $checkout = $chkout;
                          } else {
                            $chkout =  str_replace('-',' ',$chkout);
                            $chkout = strtotime($chkout);
                            $checkout = date('Y-m-d', $chkout);
                          }
                          if(request('guest') == 0 || request('guest') ==" "){
                            $guest = 1;
                          }else{
                           $guest = request('guest');
                          }

                ?>

          <span id="withdate" class="d-none">withdate</span>
          <span id="Tplocid" class="d-none">{{$locationid}}</span>
          <span id="Cin" class="d-none">{{$checkin}}</span>
          <span id="Cout" class="d-none">{{$checkout}}</span>
          <span id="rooms" class="d-none">{{request('rooms')}}</span>
          <span id="guest" class="d-none">{{$guest}}</span>
          <span class="d-none Tid">{{$Tid}}</span>
          <span class="d-none slugid">{{$slgid}}</span>

          <span class="d-none lname" id="lname">{{$lname}}</span>
          <div class="tr-shortmap-and-shotby-section">
            <div class="tr-short-map">
              <img src="{{ asset('public/frontend/hotel-detail/images/icons/map-pin-filled-black-icon.svg')}}"
                alt="map-pin" />
              <button class="tr-btn" data-bs-toggle="modal" data-bs-target="#mapModal">Show on map</button>
            </div>
            <div class="tr-title-filter-section">
              <div class="tr-row">
                <h1 class="d-none d-md-block">{{$lname}}: <span class="hotel_count"></span></h1>
                <h1 class="d-block d-sm-block d-md-none">{{$lname}}: hotels &amp; places to stay</h1>
                <div class="tr-share-section">
                  <a href="javascript:void(0);" class="tr-share" data-bs-toggle="modal"
                    data-bs-target="#shareModal">Share</a>
                </div>
              </div>
              <div class="tr-row">
                <div class="tr-shotby">
                  <div class="custom-select">
                    <label>Sort by:</label>
                    <select class="hl-filter" id="sort_by">
                      <option value="">Relevance</option>
                      <option value="recommended">Recommended</option>
                      <option value="top-rated">Top-rated</option>
                      <option value="price_desc">Price: High to Low</option>
                      <option value="price_asc">Price: Low to High</option>
                    </select>
                  </div>
                </div>
                <div class="d-none d-md-block">
                  <div class="tr-filter-selected-section selected-data" data-section="1"></div>
                </div>
              </div>
            </div>
          </div>
          @endif
          <div class="tr-hotel-info-section">

            <!--Filter - START-->
            @if($pagetype=="withoutdate")
            <div class="tr-filters-section">
              <h4 class="tr-filter-label">Filter:</h4>
              <div class="tr-filter-lists">
                <h5>Search by</h5>
                <ul>
                  <li class="tr-filter-list"><a href="{{ url('ho-'.$slgid .'-fls2-'.$slugdata ) }}">2+ Star</a></li>
                  <li class="tr-filter-list"><a href="{{ url('ho-'.$slgid .'-fls3-'.$slugdata ) }}">3+ Star</a></li>
                  <li class="tr-filter-list"><a href="{{ url('ho-'.$slgid .'-fls4-'.$slugdata ) }}">4+ Star</a></li>
                  <li class="tr-filter-list"><a href="{{ url('ho-'.$slgid .'-fls5-'.$slugdata ) }}">5 Star</a></li>
                </ul>
              </div>
              <div class="tr-filter-lists">
                <h5>Search by review score</h5>
                <ul>
                  <li class="tr-filter-list"><a href="#">6+ Okay</a></li>
                  <li class="tr-filter-list"><a href="#">7+ Good</a></li>
                  <li class="tr-filter-list"><a href="#">8+ Great</a></li>
                  <li class="tr-filter-list"><a href="#">9+ Excellent</a></li>
                </ul>
              </div>
              <div class="tr-filter-lists">
                <h5>Search by price</h5>
                <ul>
                  <li class="tr-filter-list"><a href="#">$32 - $223</a></li>
                  <li class="tr-filter-list"><a href="#">$223 - $415</a></li>
                  <li class="tr-filter-list"><a href="#">$415 - $607</a></li>
                  <li class="tr-filter-list"><a href="#">$607 - $799</a></li>
                  <li class="tr-filter-list"><a href="#">$799+ per night</a></li>
                </ul>
              </div>
              <div class="tr-filter-lists">
                <h5>Search by freebies</h5>
                <ul>
                  <li class="tr-filter-list"><a href="#">Free cancellation</a></li>
                  <li class="tr-filter-list"><a href="#">Free breakfast</a></li>
                  <li class="tr-filter-list"><a href="{{ url('ho-'.$slgid .'-flmparking-'.$slugdata ) }}">Free
                      parking</a></li>
                  <li class="tr-filter-list"><a href="{{ url('ho-'.$slgid .'-flmwifi-'.$slugdata ) }}">Free internet</a>
                  </li>
                </ul>
              </div>
            </div>

            @else
            <!-- without data -->
            <div class="tr-filters-section" data-section="1">
                <h4 class="tr-filter-label" style="display: block !important; visibility: visible !important; color:black  !important; background-color: white !important; z-index: 9999 !important; font-size: 20px !important;">
              <h4 class="tr-filter-label d-block d-sm-block d-md-none">Filters</h4>
              <div class="d-block d-sm-block d-md-none">
                <div class="tr-filter-selected-section selected-data" data-section="1"></div>
              </div>
              <div class="tr-filter-lists">
               <h4 class="tr-filter-label">Filter by:</h4>
                <h5 class="unique-h5">Pricing</h5>
                <div class="tr-price-graph">
                  <div class="tr-price-graph-col" style="height: 45px;"></div>
                  <div class="tr-price-graph-col" style="height: 64px;"></div>
                  <div class="tr-price-graph-col" style="height: 64px;"></div>
                  <div class="tr-price-graph-col" style="height: 73px;"></div>
                  <div class="tr-price-graph-col" style="height: 84px;"></div>
                  <div class="tr-price-graph-col" style="height: 76px;"></div>
                  <div class="tr-price-graph-col" style="height: 87px;"></div>
                  <div class="tr-price-graph-col" style="height: 81px;"></div>
                </div>
                <div class="tr-price-range-section">
                    <div class="tr-price-slider">
                      <input type="range" min="0" max="5000" value="0" class="min-range" step="1" id="minRange">
                      <input type="range" min="0" max="5000" value="5000" class="max-range" step="1" id="maxRange">
                    </div>
                    <div class="tr-title min-price-title" id="minPrice">$0</div>
                    <div class="tr-title max-price-title" id="maxPrice">$5000</div>
                    <div class="tr-range-values">
                      <div class="min-price hl-filter">Min Price</div>
                      <span>-</span>
                      <div class="max-price hl-filter">Max Price</div>
                    </div>
                  </div>
              <div class="tr-filter-lists mnt">
                <h5>Facilities</h5>
                <ul>

                  <li class="tr-filter-list hl-filter"><label class="tr-check-box"><input type="checkbox" name="mnt"
                        id="" class="filter" value="Wi-Fi in public areas">Free Wi-Fi in public areas<span
                        class="checkmark"></span></label></li>
                  <li class="tr-filter-list hl-filter"><label class="tr-check-box"><input type="checkbox" name="smnt"
                        id="" class="filter" value="breakfast">Free Breakfast<span class="checkmark"></span></label>
                  </li>
                  <li class="tr-filter-list hl-filter"><label class="tr-check-box"><input type="checkbox" name="smnt"
                        id="" class="filter" value="freeWifi">Free Wifi<span class="checkmark"></span></label></li>

                  <li class="tr-filter-list hl-filter"><label class="tr-check-box"><input type="checkbox" name="mnt"
                        id="" class="filter" value="Parking">Parking<span class="checkmark"></span></label></li>
                  <li class="tr-filter-list hl-filter"><label class="tr-check-box"><input type="checkbox" name="mnt"
                        id="" class="filter" value="Gym">Gym<span class="checkmark"></span></label></li>
                  <!-- <li class="tr-filter-list"><label class="tr-check-box"><input type="checkbox" name="" id=""
                        class="filter" value="Streaming service (like Netflix)">Streaming service (like Netflix)<span
                        class="checkmark"></span></label></li> -->
                  <li class="tr-filter-list hl-filter"><label class="tr-check-box"><input type="checkbox" name="mnt"
                        id="" class="filter" value="Laundry service"> Laundry service<span
                        class="checkmark"></span></label></li>
                  <li class="tr-filter-list hl-filter"><label class="tr-check-box"><input type="checkbox" name="mnt"
                        id="" class="filter" value="Bar">Bar<span class="checkmark"></span></label></li>
                  <li class="tr-filter-list hl-filter"><label class="tr-check-box"><input type="checkbox" name="mnt"
                        id="" class="filter" value="Restaurant/cafe">Restaurant/cafe<span
                        class="checkmark"></span></label></li>
                </ul>
              </div>
              <div class="tr-filter-lists star-rating">
                <h5>Hotel class</h5>
                <ul>
                  <li class="tr-filter-list hl-filter"><label class="tr-check-box"><input type="checkbox" name="rating"
                        id="" class="filter" value="5">5 Star<span class="checkmark"></span></label></li>
                  <li class="tr-filter-list hl-filter"><label class="tr-check-box"><input type="checkbox" name="rating"
                        id="" class="filter" value="4">4 Star<span class="checkmark"></span></label></li>
                  <li class="tr-filter-list hl-filter"><label class="tr-check-box"><input type="checkbox" name="rating"
                        id="" class="filter" value="3">3 Star<span class="checkmark"></span></label></li>
                  <li class="tr-filter-list hl-filter"><label class="tr-check-box"><input type="checkbox" name="rating"
                        id="" class="filter" value="2">2 Star<span class="checkmark"></span></label></li>

                </ul>
              </div>
              @if(!$gethoteltype->isEmpty())
              <div class="tr-filter-lists hoteltype">
                <h5>Property types</h5>
                <ul>
                  @foreach($gethoteltype as $val)
                  <li class="tr-filter-list hl-filter"><label class="tr-check-box"><input type="checkbox"
                        name="hoteltypes" id="" class="filter" value="{{$val->hid}}">{{$val->type}}<span
                        class="checkmark"></span></label></li>
                  @endforeach
                </ul>
              </div>
              @endif


              <!--Neighbourhoods-->


              <div class="tr-filter-lists agencies" id="agencies">
                @if(!empty($agencyData))
                <h5>Booking Providers</h5>
                  <ul>
                      @foreach($agencyData as $agency)
                          <li class="tr-filter-list hl-filter">
                              <label class="tr-check-box">
                                  <input type="checkbox" name="agency" class="filter" value="{{ $agency }}">
                                  {{ $agency }}
                                  <span class="checkmark"></span>
                              </label>
                          </li>
                      @endforeach
                  </ul>
                @endif
              </div>
              <!-- <div class="tr-filter-lists">
                <h5>Other</h5>
                <ul>
                  <li class="tr-filter-list"><label class="tr-check-box"><input type="checkbox" name="" id=""
                        class="filter" value="Properties without prices">Properties without prices<span
                        class="checkmark"></span></label></li>
                  <li class="tr-filter-list"><label class="tr-check-box"><input type="checkbox" name="" id=""
                        class="filter" value="Properties without photos">Properties without photos<span
                        class="checkmark"></span></label></li>
                </ul>
              </div> -->
            </div>
            @endif
            <!--Filter - END-->
            <!--ROOM - START-->
            <div class="tr-room-section-2 filter-listing responsive-container" >
              @if($pagetype=="withoutdate")
              <div class="tr-title-filter-section">
                <div class="tr-row">
                  <span class="d-none slugdata">{{$slugdata}}</span>
                  <span class="d-none slugid">{{$slgid}}</span>
                  <span class="d-none lname">{{$lname}}</span>
                  <span class="d-none filter-st">{{$st}}</span>
                  <span class="d-none filter-amenity">{{$amenity}}</span>
                  <h1 class="d-none d-md-block">Showing hotels in {{$lname}}</h1>
                  <h1 class="d-block d-sm-block d-md-none">Top hotels</h1>
                  <div class="tr-share-section">
                    <a href="javascript:void(0);" class="tr-share" data-bs-toggle="modal"
                      data-bs-target="#shareModal">Share</a>
                  </div>
                </div>
                <!--
                <div class="tr-row">
                  <p>{{$count_result}} results found</p>
                </div>
                -->
              </div>
              @endif
              @if(!$searchresults->isEmpty())

              <?php $a = 1;?>
              @foreach($searchresults as $searchresult)
              <div class="tr-hotel-deatils" data-id="{{ $searchresult->id }}">
              @if($pagetype=="withdate")
              <?php    $ctName = $lname;
                                $cityname = str_replace(' ', '_', $ctName);
                                $CountryName = str_replace(' ', '_', $countryname);
                                $url = $cityname .'-'.$CountryName;
                                $hotel_url = url('hd-'.$searchresult->slugid.'-' .$searchresult->id .'-'.strtolower( str_replace(' ', '_',  str_replace('#', '!',$searchresult->slug."?checkin={$checkin}&checkout={$checkout}") )) );
                          ?>
                <div class="tr-hotal-image">
                  <div id="roomSlider{{$a}}" class="carousel slide" data-bs-touch="false" data-bs-interval="false">
                    <!-- Indicators/dots -->
                    <div class="carousel-indicators">
                      <button type="button" data-bs-target="#roomSlider{{$a}}" data-bs-slide-to="0"
                        class="active">1</button>
                      <button type="button" data-bs-target="#roomSlider{{$a}}" data-bs-slide-to="1">2</button>
                      <button type="button" data-bs-target="#roomSlider{{$a}}" data-bs-slide-to="2">3</button>
                    </div>
                    <!-- The slideshow/carousel -->
                    <div class="carousel-inner">
                      <div class="carousel-item active">
                      <a href="{{ $hotel_url }}" target="_blank" title="{{$searchresult->name}}"><img src="https://photo.hotellook.com/image_v2/crop/h{{ $searchresult->hotelid }}_0/520/460.jpg" alt="{{$searchresult->name}}"></a>
                      </div>
                      <div class="carousel-item">
                      <a href="{{ $hotel_url }}" target="_blank" title="{{$searchresult->name}}"><img src="https://photo.hotellook.com/image_v2/crop/h{{ $searchresult->hotelid }}_1/520/460.jpg" alt="{{$searchresult->name}}"></a>
                      </div>
                      <div class="carousel-item">
                      <a href="{{ $hotel_url }}" target="_blank" title="{{$searchresult->name}}"><img src="https://photo.hotellook.com/image_v2/crop/h{{ $searchresult->hotelid }}_2/520/460.jpg" alt="{{$searchresult->name}}"></a>aa
                      </div>
                    </div>
                    <!-- Left and right controls/icons -->
                    <button class="carousel-control-prev" type="button" data-bs-target="#roomSlider{{$a}}" data-bs-slide="prev"><span class="carousel-control-prev-icon"></span></button>
                    <button class="carousel-control-next" type="button" data-bs-target="#roomSlider{{$a}}" data-bs-slide="next"><span class="carousel-control-next-icon"></span></button>
                  </div>
                  <button class="tr-anchor-btn tr-save">Save</button>
                </div>

              @else
               <!-- without date--->
              <div class="tr-hotal-image">
                  <div id="roomSlider{{$a}}" class="carousel slide" data-bs-touch="false" data-bs-interval="false">
                    <!-- Indicators/dots -->
                    <div class="carousel-indicators">
                      <button type="button" data-bs-target="#roomSlider{{$a}}" data-bs-slide-to="0"
                        class="active">1</button>
                      <button type="button" data-bs-target="#roomSlider{{$a}}" data-bs-slide-to="1">2</button>
                      <button type="button" data-bs-target="#roomSlider{{$a}}" data-bs-slide-to="2">3</button>
                    </div>
                    <!-- The slideshow/carousel -->
                    <div class="carousel-inner">
                      <div class="carousel-item active">
                      <a href="{{ url('hd-'.$searchresult->slugid .'-' .$searchresult->id .'-'.strtolower( str_replace(' ', '_',  str_replace('#', '!',$searchresult->slug) )) ) }}"
                      target="_blank" title="{{$searchresult->name}}"> <img src="https://photo.hotellook.com/image_v2/crop/h{{ $searchresult->hotelid }}_0/520/460.jpg" alt="{{$searchresult->name}}"></a>
                      </div>
                      <div class="carousel-item">
                      <a href="{{ url('hd-'.$searchresult->slugid .'-' .$searchresult->id .'-'.strtolower( str_replace(' ', '_',  str_replace('#', '!',$searchresult->slug) )) ) }}"
                      target="_blank" title="{{$searchresult->name}}"><img src="https://photo.hotellook.com/image_v2/crop/h{{ $searchresult->hotelid }}_1/520/460.jpg" alt="{{$searchresult->name}}"></a>
                      </div>
                      <div class="carousel-item">
                      <a href="{{ url('hd-'.$searchresult->slugid .'-' .$searchresult->id .'-'.strtolower( str_replace(' ', '_',  str_replace('#', '!',$searchresult->slug) )) ) }}"
                      target="_blank" title="{{$searchresult->name}}"><img src="https://photo.hotellook.com/image_v2/crop/h{{ $searchresult->hotelid }}_2/520/460.jpg" alt="{{$searchresult->name}}"></a>
                      </div>
                    </div>
                    <!-- Left and right controls/icons -->
                    <button class="carousel-control-prev" type="button" data-bs-target="#roomSlider{{$a}}" data-bs-slide="prev"><span class="carousel-control-prev-icon"></span></button>
                    <button class="carousel-control-next" type="button" data-bs-target="#roomSlider{{$a}}" data-bs-slide="next"><span class="carousel-control-next-icon"></span></button>
                  </div>
                  <button class="tr-anchor-btn tr-save">Save</button>
                </div>
                @endif
                @if($pagetype=="withdate")
                <div class="tr-hotel-deatil">
                  <div class="tr-heading-with-rating">
                    <h2>
                      <a href="{{ $hotel_url }}" target="_blank" title="{{$searchresult->name}}">{{$searchresult->name}}</a>
                    </h2>
                    <div class="tr-rating">
                      @for ($i = 0; $i < 5; $i++)
                        @if($i < $searchresult->stars )
                        <span class="tr-star">
                          <img src="{{asset('public/frontend/hotel-detail/images/icons/star-fill-icon.svg')}}">
                        </span>
                        @endif
                      @endfor
                    </div>
                  </div>
                @if($searchresult->CityName != "")
                  <div class="tr-hotel-location">
                      <a href="{{ request()->fullUrlWithQuery(['location' => urlencode($searchresult->CityName)]) }}"
                        title="{{ $searchresult->CityName }}"
                        style="color: #333333; font-size: 14px; font-weight: 500; text-decoration: none;">
                          {{ $searchresult->CityName }}
                      </a>
                  </div>
                  @endif

                  <div class="tr-like-review">
                    @if($searchresult->rating !="" && $searchresult->rating !=0)
                    <?php

                        $rating = (float)$searchresult->rating;
                         $result = round($rating * 10);

                          if ($result > 95) {
                            $ratingtext = 'Superb';
                            $color = '#29857A';
                            $bgcolor = 'rgba(41, 133, 122, 0.11)';

                        } elseif ($result >= 91 && $result <= 95) {
                            $ratingtext = 'Excellent';
                            $color = '#29857A';
                            $bgcolor = 'rgba(41, 133, 122, 0.11)';
                        } elseif ($result >= 81 && $result <= 90) {
                            $ratingtext = 'Great';
                            $color = '#29857A';
                            $bgcolor = 'rgba(41, 133, 122, 0.11)';
                        } elseif ($result >= 71 && $result <= 80) {
                            $ratingtext = 'Good';
                            $color = '#FFE135';
                            $bgcolor = '#fafab2';
                        } elseif ($result >= 61 && $result <= 70) {
                            $ratingtext = 'Okay';
                            $color = '#FFE135';
                            $bgcolor = '#fafab2';
                        } elseif ($result >= 51 && $result <= 60) {
                            $ratingtext = 'Average';
                            $color = '#FFE135';
                            $bgcolor = '#fafab2';
                        } elseif ($result >= 41 && $result <= 50) {
                            $ratingtext = 'Poor';
                            $color = 'red';
                            $bgcolor = '#ff000026';
                        } elseif ($result >= 21 && $result <= 40) {
                            $ratingtext = 'Disappointing';
                            $color = 'red';
                            $bgcolor = '#ff000026';
                        } else {
                            $ratingtext = 'Bad';
                            $color = 'red';
                            $bgcolor = '#ff000026';
                        }

                      ?>
                    <div class="tr-heart">
                      <svg width="12" height="11" viewBox="0 0 12 11" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" clip-rule="evenodd"
                          d="M5.99604 2.28959C5.02968 1.20745 3.41823 0.916356 2.20745 1.90727C0.996677 2.89818 0.826217 4.55494 1.77704 5.7269L5.99604 9.63412L10.215 5.7269C11.1659 4.55494 11.0162 2.88776 9.78463 1.90727C8.55304 0.92678 6.96239 1.20745 5.99604 2.28959Z"
                          fill="white" stroke="white" stroke-linecap="round" stroke-linejoin="round"></path>
                      </svg>
                    </div>

                    <div class="tr-ranting-percent">{{$result}}% </div>
                    <div class="tr-vgood" style="color:{{$color}};background: {{$bgcolor}};">{{$ratingtext}}</div>
                    @endif
                    <!-- <div class="tr-vgood">Very Good</div> -->
                  </div>
          <div class="tr-hotel-facilities">
    <?php
        // Define an array to map each selected amenity to its specific icon path
        $amenityIconPaths = [
            'A/C' => 'public/frontend/hotel-detail/images/amenities/A/C.svg',
            'Parking' => 'public/frontend/hotel-detail/images/amenities/Parking.svg',
            'Wi-Fi' => 'public/frontend/hotel-detail/images/amenities/Wi-Fi.svg',
            'Laundry' => 'public/frontend/hotel-detail/images/amenities/Laundry.svg',
            'Smoke-free' => 'public/frontend/hotel-detail/images/amenities/Smoke-free.svg',
            'Pool' => 'public/frontend/hotel-detail/images/amenities/Pool.svg',
            'Gym' => 'public/frontend/hotel-detail/images/amenities/Gym.svg',
            'Food' => 'public/frontend/hotel-detail/images/amenities/Food.svg',
            'Pets' => 'public/frontend/hotel-detail/images/amenities/Pets.svg',
            'Bar' => 'public/frontend/hotel-detail/images/amenities/Bar.svg',
            'Spa' => 'public/frontend/hotel-detail/images/amenities/Spa.svg',
            // Add additional amenities as needed
        ];

        // Define your selected amenities by name
        $selectedAmenities = array_keys($amenityIconPaths); // Fetch keys directly from icon paths

        $amenities = [];
        if ($searchresult->amenity_info != "") {
            $amenityData = explode(',', $searchresult->amenity_info);
            foreach ($amenityData as $item) {
                if (strpos($item, '|') !== false) {
                    list($name, $available) = explode('|', $item);
                    $name = trim($name);
                    $available = (int) trim($available);

                    // Only include amenities from the selected list
                    if (in_array($name, $selectedAmenities)) {
                        $amenities[] = [
                            'name' => $name,
                            'available' => $available,
                        ];
                    }
                }
            }

            // Remove duplicates and limit to 5
            $uniqueAmenities = [];
            foreach ($amenities as $amenity) {
                if (!in_array($amenity['name'], array_column($uniqueAmenities, 'name'))) {
                    $uniqueAmenities[] = $amenity;
                }
            }
            $uniqueAmenities = array_slice($uniqueAmenities, 0, 5); // Limit to the first 5 amenities
        }
    ?>

    <!-- Display Amenities on the Page -->
    @if (!empty($uniqueAmenities))
        <ul>
            @foreach ($uniqueAmenities as $mnt)
                <li>
                    @php
                        // Assign icon path from predefined list; if unavailable, use a default
                        $iconPath = $amenityIconPaths[$mnt['name']] ?? 'public/frontend/hotel-detail/images/amenities/wifi.svg';
                    @endphp
                    <img src="{{ asset($iconPath) }}" alt="{{ $mnt['name'] }}">
                    <span>{{ $mnt['name'] }}</span> <!-- Display the amenity name -->
                </li>
            @endforeach
        </ul>
    @endif
</div>
                <div class="tr-more-facilities">
                    @if(!empty($searchresult->short_description))
                        <ul class="short-description-content">
                            <li>{{ $searchresult->short_description }}</li>
                        </ul>

                        @if(strlen($searchresult->short_description) > 100) <!-- Show "Read More" if the description is long -->
                            <button type="button" class="tr-anchor-btn toggle-list" onclick="toggleContent(this)">Read More</button>
                        @endif
                    @endif
                </div>

                 </div>

                <div class="tr-hotel-price-section">
                  <!--
                  <div class="tr-deal tr-offer-alert">
                    <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                      <path
                        d="M13.7263 8.9387L8.94634 13.7187C8.82251 13.8427 8.67546 13.941 8.5136 14.0081C8.35173 14.0752 8.17823 14.1097 8.00301 14.1097C7.82779 14.1097 7.65429 14.0752 7.49242 14.0081C7.33056 13.941 7.18351 13.8427 7.05967 13.7187L1.33301 7.9987V1.33203H7.99967L13.7263 7.0587C13.9747 7.30851 14.1141 7.64645 14.1141 7.9987C14.1141 8.35095 13.9747 8.68888 13.7263 8.9387Z"
                        stroke="#222222" stroke-linecap="round" stroke-linejoin="round" />
                      <path d="M4.66699 4.66797H4.67366" stroke="#222222" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                    #1 Best value of 400 places to stay
                  </div>
                  -->
                  <div class="tr-hotel-price-lists ls">
                    @if(!empty($hotels->result))
                    @foreach ($hotels->result as $hotel_result)
                    @if($hotel_result->id == $searchresult->hotelid)
                    <?php
                            $allPrices = [];

                            foreach ($hotel_result->rooms as $room) {
                                $price = $room->total;
                                $agencyId = $room->agencyId;
                                $fullurl = $room->fullBookingURL;
                                $options = $room->options;

                                // Use a unique key to prevent duplicate entries
                                $key = $price . '_' . $agencyId;

                                if (!isset($allPrices[$key])) {
                                    $allPrices[$key] = [
                                        'price' => $price,
                                        'fullBookingURL' => $fullurl,
                                        'agencyId' => $agencyId,
                                        'options' => $options,
                                    ];
                                }
                            }

                            // Convert associative array to indexed array
                            $allPricesArray = array_values($allPrices);

                            // Sort the prices in ascending order
                            usort($allPricesArray, function($a, $b) {
                                return $a['price'] - $b['price'];
                            });

                            // Split into top two and the rest
                            $topTwoPrices = array_slice($allPricesArray, 0, 2);
                            $remainingPrices = array_slice($allPricesArray, 2);
                        ?>

                    <!-- Show the two lowest prices -->
                    @foreach ($topTwoPrices as $data)
                    <div class="tr-hotel-price-list">
                      <div class="tr-row">
                        <div class="tr-hotel-facilities">
                          <ul>
                            <?php
                                            $count = 0;
                                            $priorities = ['breakfast', 'freeWifi'];
                                            foreach ($priorities as $priority) {
                                                if (!empty($data['options']->{$priority})) {
                                                    echo "<li>" . ucfirst($priority) . " included</li>";
                                                    $count++;
                                                }
                                            }
                                            foreach ($data['options'] as $key => $value) {
                                                if ($value === true && !in_array($key, $priorities)) {
                                                    echo "<li>" . ucfirst(str_replace('_', ' ', $key)) . " included</li>";
                                                    $count++;
                                                }
                                                if ($count == 2) break;
                                            }
                                        ?>
                          </ul>
                        </div>
                        <div class="tr-site-details">
                          <img src="{{ 'https://pics.avs.io/hl_gates/100/40/' . $data['agencyId'] . '.png' }}"
                            alt="agency logo">
                        </div>
                      </div>
                      <div class="tr-row">
                        <div class="tr-action" @if($count==1 || $count==0) style="margin-top: 18px;" @endif>
                          <a href="{{ $data['fullBookingURL'] }}" class="tr-btn" target="_blank">View deal</a>
                        </div>
                        <div class="tr-hotel-price"><strong>${{ $data['price'] }}</strong></div>
                      </div>
                    </div>
                    @endforeach

                    <!-- Show remaining prices under "More Price" -->
                    @if(count($remainingPrices) > 0)
                    <div class="more-prices-containers" style="display: none;">
                      @foreach ($remainingPrices as $data)
                      <div class="tr-hotel-price-list">
                        <div class="tr-row">
                          <div class="tr-hotel-facilities">
                            <ul>
                              <?php
                                                $count = 0;
                                                $priorities = ['breakfast', 'freeWifi'];
                                                foreach ($priorities as $priority) {
                                                    if (!empty($data['options']->{$priority})) {
                                                        echo "<li>" . ucfirst($priority) . " included</li>";
                                                        $count++;
                                                    }
                                                }
                                                foreach ($data['options'] as $key => $value) {
                                                    if ($value === true && !in_array($key, $priorities)) {
                                                        echo "<li>" . ucfirst(str_replace('_', ' ', $key)) . " included</li>";
                                                        $count++;
                                                    }
                                                    if ($count == 2) break;
                                                }
                                            ?>
                            </ul>
                          </div>
                          <div class="tr-site-details">
                            <img src="{{ 'https://pics.avs.io/hl_gates/100/40/' . $data['agencyId'] . '.png' }}"
                              alt="agency logo">
                          </div>
                        </div>
                        <div class="tr-row">
                          <div class="tr-action" @if($count==1 || $count==0) style="margin-top: 18px;" @endif>
                            <a href="{{ $data['fullBookingURL'] }}" class="tr-btn" target="_blank">View deal</a>
                          </div>
                          <div class="tr-hotel-price"><strong>${{ $data['price'] }}</strong></div>
                        </div>
                      </div>
                      @endforeach
                    </div>
                    <button class="tr-more-prices ls tr-anchor-btn">More price</button>
                    @endif

                    @endif
                    @endforeach
                    @endif
                  </div>
                </div>
                @else
                <!-- without date start -->
                <div class="tr-hotel-deatil">
                  <div class="tr-heading-with-rating">
                    <h2 class="hotel-name">
                      <a href="{{ url('hd-'.$searchresult->slugid .'-' .$searchresult->id .'-'.strtolower( str_replace(' ', '_',  str_replace('#', '!',$searchresult->slug) )) ) }}"
                        target="_blank" title="{{$searchresult->name}}">{{$searchresult->name}}</a>
                    </h2>
                    <div class="tr-rating">
                      @for ($i = 0; $i < 5; $i++) @if($i < $searchresult->stars )
                        <span class="tr-star"><img
                            src="{{asset('public/frontend/hotel-detail/images/icons/star-fill-icon.svg')}}"></span>

                        @endif
                        @endfor
                    </div>
                  </div>
              @if($searchresult->CityName != "")
              <div class="tr-hotel-location">
                  <a href="?location={{ urlencode($searchresult->CityName) }}" title="{{ $searchresult->CityName }}">
                      {{ $searchresult->CityName }}
                  </a>
              </div>
              @endif

                  <div class="tr-like-review">
                  @if($searchresult->rating !="" && $searchresult->rating !=0)
                    <?php

                        $rating = (float)$searchresult->rating;
                         $result = round($rating * 10);

                          if ($result > 95) {
                            $ratingtext = 'Superb';
                            $color = '#29857A';
                            $bgcolor = 'rgba(41, 133, 122, 0.11)';

                        } elseif ($result >= 91 && $result <= 95) {
                            $ratingtext = 'Excellent';
                            $color = '#29857A';
                            $bgcolor = 'rgba(41, 133, 122, 0.11)';
                        } elseif ($result >= 81 && $result <= 90) {
                            $ratingtext = 'Great';
                            $color = '#29857A';
                            $bgcolor = 'rgba(41, 133, 122, 0.11)';
                        } elseif ($result >= 71 && $result <= 80) {
                            $ratingtext = 'Good';
                            $color = '#FFE135';
                            $bgcolor = '#fafab2';
                        } elseif ($result >= 61 && $result <= 70) {
                            $ratingtext = 'Okay';
                            $color = '#FFE135';
                            $bgcolor = '#fafab2';
                        } elseif ($result >= 51 && $result <= 60) {
                            $ratingtext = 'Average';
                            $color = '#FFE135';
                            $bgcolor = '#fafab2';
                        } elseif ($result >= 41 && $result <= 50) {
                            $ratingtext = 'Poor';
                            $color = 'red';
                            $bgcolor = '#ff000026';
                        } elseif ($result >= 21 && $result <= 40) {
                            $ratingtext = 'Disappointing';
                            $color = 'red';
                            $bgcolor = '#ff000026';
                        } else {
                            $ratingtext = 'Bad';
                            $color = 'red';
                            $bgcolor = '#ff000026';
                        }

                      ?>
                    <div class="tr-heart">
                      <svg width="12" height="11" viewBox="0 0 12 11" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" clip-rule="evenodd"
                          d="M5.99604 2.28959C5.02968 1.20745 3.41823 0.916356 2.20745 1.90727C0.996677 2.89818 0.826217 4.55494 1.77704 5.7269L5.99604 9.63412L10.215 5.7269C11.1659 4.55494 11.0162 2.88776 9.78463 1.90727C8.55304 0.92678 6.96239 1.20745 5.99604 2.28959Z"
                          fill="white" stroke="white" stroke-linecap="round" stroke-linejoin="round"></path>
                      </svg>
                    </div>

                    <div class="tr-ranting-percent">{{$result}}% </div>
                    <div class="tr-vgood" style="color:{{$color}};background: {{$bgcolor}};">{{$ratingtext}}</div>
                    @endif
                  </div>

                  <div class="accordion" id="accordion{{$a}}">
                    <div class="accordion-items">
                      <div class="accordion-item">
                        <button id="headingOverview{{$a}}" class="" type="button" data-bs-toggle="collapse"
                          data-bs-target="#collapseOne{{$a}}" aria-expanded="true"
                          aria-controls="collapseOne{{$a}}">Overview</button>
                      </div>
                      <div class="accordion-item">
                        <button id="headingAmenities{{$a}}" class="" type="button" data-bs-toggle="collapse"
                          data-bs-target="#collapseTwo{{$a}}" aria-expanded="false"
                          aria-controls="collapseTwo{{$a}}">Amenities</button>
                      </div>
                      <div class="accordion-item">
                        <button id="headingThree{{$a}}" class="collapsed" type="button" data-bs-toggle="collapse"
                          data-bs-target="#collapseThree{{$a}}" aria-expanded="false"
                          aria-controls="collapseThree{{$a}}">Review</button>
                      </div>
                    </div>
                    <div class="accordion-items-content">
                      <div id="collapseOne{{$a}}" class="accordion-collapse collapse show"
                        aria-labelledby="headingOverview{{$a}}" data-bs-parent="#accordion{{$a}}">
                        <div class="tr-more-facilities list-content" style="display: block !important; visibility: visible !important;">
                            @if(!empty($searchresult->OverviewShortDesc))
                                <?php
                                  $OverviewShortDesc = explode(',', $searchresult->OverviewShortDesc);
                                ?>
                                <p class="short-description-content overviewText">
                                  @foreach($OverviewShortDesc as $index => $data)
                                      • {{ trim($data) }}
                                      @if(!$loop->last)
                                          <br> <!-- Line break between items to create paragraph-style bullets -->
                                      @endif
                                  @endforeach
                                </p>
                                <button type="button" class="custom-read-more readMoreBtn" onclick="toggleContent(this)">Read More</button>
                            @endif
                        </div>
                      </div>
                      <div id="collapseTwo{{$a}}" class="accordion-collapse collapse"
                        aria-labelledby="headingAmenities{{$a}}" data-bs-parent="#accordion{{$a}}">
                        <div class="tr-hotel-facilities">
                          <?php
                            $amenities = [];
                            if ($searchresult->amenity_info != "") {
                              $amenityData = explode(',', $searchresult->amenity_info);
                              foreach ($amenityData as $item) {
                                if (strpos($item, '|') != false) { // Ensure correct format before splitting
                                  list($name, $available) = explode('|', $item); // Split into name and availability (0 or 1)
                                  $amenities[] = [
                                    'name' => trim($name),
                                    'available' => (int) trim($available), // Store as associative array, cast available to int
                                  ];

                                }
                              }
                              $amenities = array_slice($amenities, 0, 5);
                            }
                          ?>
                          @if (!empty($amenities))
                            <ul>
                              @foreach ($amenities as $mnt)
                                <li style="">
                                  @if($mnt['available'] == 1 && is_string($mnt['name']))
                                    <!-- Only display the image if available and valid name -->
                                    <img src="{{ asset('public/frontend/hotel-detail/images/amenities/'.trim($mnt['name']).'.svg') }}" >
                                  @else
                                    <img src="{{ asset('public/frontend/hotel-detail/images/amenities/wifi.svg') }}" >
                                  @endif
                                  <span>{{ $mnt['name'] }}</span>
                                  <!-- Display the amenity name -->
                                </li>
                              @endforeach
                            </ul>
                          @endif
                        </div>
                      </div>
                      <div id="collapseThree{{$a}}" class="accordion-collapse collapse"
                        aria-labelledby="headingThree{{$a}}" data-bs-parent="#accordion{{$a}}">
                        <!--
                        <div class="tr-like-review">
                          <div class="tr-vgood">Very Good</div> (100 Review)
                        </div>
                        -->
                        <div class="tr-short-decs paragraph-content">
                          <div class="para-content">
                            <p>{{$searchresult->ReviewSummary}}</p>
                          </div>
                          <button type="button" class="tr-anchor-btn toggle-para">Read More</button>
                        </div>
                      </div>
                    </div>
                  </div>
                  <!--
                  <div class="d-block d-sm-block d-md-none tr-mobile">
                    <div class="tr-more-facilities">
                      <ul>
                        @if($searchresult->distance !="")<li>{{$searchresult->distance}} miles to city </li>@endif
                      </ul>
                    </div>
                    <div class="tr-hotel-facilities mt-3">
                    @if (!empty($amenities))
                      <ul>
                        @foreach ($amenities as $mnt)
                          <li>
                            <span>{{ $mnt['name'] }}</span>
                          </li>
                        @endforeach
                      </ul>
                    @endif
                    </div>
                  </div>
                  -->
                  <div class="tr-view-availability">
                   <button class="tr-btn tr-view-availability-btn"><span class="d-none d-md-block">Enter dates for price</span>
                       <span class="d-block d-sm-block d-md-none">View availability</span></button>
                  </div>
                </div>
                @endif

                @if ($loop->last && $count_result > 1)
                @if (!session()->has('frontend_user'))
                <div class="tr-login-for-more-options">
                  <h2>Log in/Sign up to view all listings</h2>
                  <p>Compare prices from 70+ Hotels websites all at one place</p>
                  <div class="tr-row">
                    <a href="{{route('user_login')}}"><button type="button" class="tr-btn h-sign-up">Sign
                        up</button></a>
                  </div>
                </div>
                @endif
                @endif
              </div>
              <?php $a++;?>
              @endforeach
              @else
              <div class="spinner-border" style="margin-left: 500px;margin-top: 100px;" role="status">
                <span class="visually-hidden">Loading...</span>
              </div>
              @endif
            </div>
            <!--ROOM - END-->
          </div>
          <div class="tr-map-and-filter">
            <button data-bs-toggle="modal" data-bs-target="#mapModal" class="map"><svg width="14" height="14"
                viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                <g clip-path="url(#clip0_2464_12970)">
                  <path
                    d="M0.583984 3.4974V12.8307L4.66732 10.4974L9.33398 12.8307L13.4173 10.4974V1.16406L9.33398 3.4974L4.66732 1.16406L0.583984 3.4974Z"
                    stroke="white" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round" />
                  <path d="M4.66602 1.16406V10.4974" stroke="white" stroke-width="1.2" stroke-linecap="round"
                    stroke-linejoin="round" />
                  <path d="M9.33398 3.5V12.8333" stroke="white" stroke-width="1.2" stroke-linecap="round"
                    stroke-linejoin="round" />
                </g>
                <defs>
                  <clipPath id="clip0_2464_12970">
                    <rect width="14" height="14" fill="white" />
                  </clipPath>
                </defs>
              </svg>Map</button>
            <button id="filterModal" class="filter"><svg width="14" height="14" viewBox="0 0 14 14" fill="none"
                xmlns="http://www.w3.org/2000/svg">
                <path d="M12.8327 1.75H1.16602L5.83268 7.26833V11.0833L8.16602 12.25V7.26833L12.8327 1.75Z"
                  stroke="white" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round" />
              </svg>Filter</button>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Map Modal With Filter & Hotel List - Start-->
  <div class="modal" id="mapModal">
    <div class="modal-dialog">
      <div class="modal-content">
         <button type="button" class="btn-close" data-bs-dismiss="modal" style="position: absolute; top: 10px; right: 10px; z-index: 1050;"></button>
        <div class="modal-body">
          <div class="tr-hotel-info-section">
            <div class="tr-filters-section" data-section="2">
              <div class="tr-filter-selected-section selected-data" data-section="2"></div>
            </div>
            <div class="tr-room-section-2"></div>
            <div class="tr-map-section">
              <button class="tr-hide-list" style="position: absolute; top: 10px; right: 10px; z-index: 9999;">Hide Hotel List</button>
              <div class="tr-hotel-on-map">
                <form>
                  <!--input type="text" class="form-control" id="" placeholder="Search on map" name="" autocomplete="off"-->
                  <div class="tr-recent-searchs-modal" id="">
                    <div class="tr-enable-location">Around Current Location</div>
                    <h5>Recent searches</h5>
                    <ul>
                      <li>
                        <div class="tr-place-info">
                          <div class="tr-location-icon"></div>
                          <div class="tr-location-info">
                            <div class="tr-hotel-name">London Hotels</div>
                            <div class="tr-hotel-city">England, United Kingdom</div>
                          </div>
                        </div>
                      </li>
                      <li>
                        <div class="tr-place-info">
                          <div class="tr-location-icon"></div>
                          <div class="tr-location-info">
                            <div class="tr-hotel-name">Morocco</div>
                            <div class="tr-hotel-city">North Africa</div>
                          </div>
                        </div>
                      </li>
                    </ul>
                  </div>
                  <button type="button" hidden class="tr-btn">Countinue</button>
                </form>
              </div>
              <button id="onMapFilterModal" class="filter tr-mobile"><svg width="20" height="20" viewBox="0 0 20 20"
                  fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path d="M18.3337 2.5H1.66699L8.33366 10.3833V15.8333L11.667 17.5V10.3833L18.3337 2.5Z" stroke="black"
                    stroke-linecap="round" stroke-linejoin="round" />
                </svg>Filter</button>
                <div id="map"></div>
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>
  <!-- Map Modal With Filter & Hotel List - End-->


<div class="container">
    <div class="row">
        <div class="col-sm-12">
            <div class="tr-single-page">
                <div class="tr-terms-and-conditions-section">
                    <h3 style="font-weight: bold; margin-bottom: 20px; font-size: 24px;">Why Book Hotels With Travell ?</h3>
                    <p style="margin-top: 20px;">Welcome to Travell's hotel search engine, whereby you can easily get your best deal. Why waste time looking at hotel prices on different sites when you can view all available options at once? We search the web for all the prices and deals available in a particular place, enabling you to select what suits you best for your stay without having to hop from one site to the other. More than 3.3 million hotels, apartments, motels, and hostels worldwide can make the choice of accommodation an easier one. There is, indeed, something to cater to every traveler, be it luxury hotels, homely apartments, budget motels, or party hostels in exciting cities. Booking through Travell means you get the best rates, and you save time as well. Travell is here to help you browse quickly and find the best deals so that you can plan your next trip easily and affordably. Travell will help you find that ideal accommodation, and from there, we will help you make the most of your journey.</p>
                </div>
            </div>
        </div>
    </div>
</div>



   <!-- breadcrums -->


   <div class="tr-breadcrumb-section">
    <ul class="tr-breadcrumb">

          @if(!$getcontlink->isEmpty())
          <li>
            <a href="{{ route('explore_continent_list',[$getcontlink[0]->contid,$getcontlink[0]->cName])}}">
              {{$getcontlink[0]->cName}}</a>
          </li>
          <li>
            <a href="{{ route('explore_country_list',[$getcontlink[0]->CountryId,$getcontlink[0]->slug])}}">
              {{$getcontlink[0]->Name}}</a>
          </li>
          @endif

          @if(!empty($locationPatent))
          <?php
                $locationPatents = array_reverse($locationPatent);
                ?>
          @foreach ($locationPatents as $location)
          <li>
            <a
              href="@if(!empty($location)){{ route('search.results',[$location['LocationId'].'-'.strtolower($location['slug'])]) }}@endif">
              {{ $location['Name'] }}</a>
          </li>
          @endforeach
          @endif

          @if(!$getlocationexp->isEmpty())
          <li><a
              href="{{ route('search.results', [$getlocationexp[0]->slugid.'-'.strtolower($getlocationexp[0]->Slug)]) }}">{{$getlocationexp[0]->Name}}</a>
          </li>
          @endif



          <li>Hotels</li>
       </ul>
    </div>

      <!-- end date and breadcrumb -->
  <!--FOOTER-->
  @include('frontend.footer')

  <div class="overlay" id="overLay"></div>

  <!-- Share Modal -->
  <div class="modal" id="shareModal">
    <div class="modal-dialog">
      <div class="modal-content">
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        <h3>Share this experience</h3>
        <div class="tr-share-infos">
          <div class="tr-hotel-img">
            <img src="{{asset('public/frontend/hotel-detail/images/room-image-1.png')}}" alt="Room Image">
          </div>
          <div class="tr-share-details">
            <span class="tr-hotel-name">Hyatt Regency Houston West</span>
            <span class="tr-rating">4.83</span>
            <span class="tr-bedrooms">
              <span>2 bedrooms</span>
              <span>3 beds</span>
              <span>2 bathrooms</span>
            </span>
          </div>
        </div>
        <div class="tr-share-options">
          <div class="tr-share-option">
            <a href="javascript:void(0);" class="tr-copy">Copy link</a>
          </div>
          <div class="tr-share-option">
          <a href="#" id="emailShare" target="_blank" class="tr-email">Email</a>
        </div>
        <div class="tr-share-option">
          <a href="#" id="smsShare" target="_blank" class="tr-messages">Messages</a>
        </div>
        <div class="tr-share-option">
          <a href="#" id="whatsappShare" target="_blank" class="tr-whatsapp">WhatsApp</a>
        </div>
        <div class="tr-share-option">
          <a href="#" id="facebookShare" target="_blank" class="tr-facebook">Facebook</a>
        </div>
        <div class="tr-share-option">
          <a href="#" id="twitterShare" target="_blank" class="tr-twitter">Twitter</a>
        </div>
        <div class="tr-share-option">
          <a href="#" id="messengerShare" target="_blank" class="tr-messenger">Messenger</a>
        </div>
        <div class="tr-share-option">
          <a href="javascript:void(0);" onclick="copyEmbedCode()" class="tr-embed">Embed</a>
        </div>
      </div>

      <!-- Feedback Alerts -->
      <div class="tr-alert tr-copy-alert" id="copyAlert">Link copied</div>
      <div class="tr-alert tr-copy-alert" id="embedAlert">Embed code copied</div>
    </div>
  </div>
</div>
</body>

</html>
<script src="{{asset('public/frontend/hotel-detail/js/jquery.min.js')}}"></script>
<script type="text/javascript" src="{{ asset('/public/frontend/hotel-detail/js/common.js')}} "></script>
<script type="text/javascript" src="{{ asset('/public/frontend/hotel-detail/js/custom.js')}} "></script>
<script src="{{asset('public/js/hotel_list.js')}} "></script>
<script src="{{ asset('/public/js/custom.js')}}"></script>
<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
@if($pagetype !="withoutdate")
<script>
  document.addEventListener("DOMContentLoaded", function() {
    var defaultCenter = [20.5937, 78.9629]; // Default fallback center (India)
    var defaultZoom = 5;

    var mapCenter = defaultCenter;
    var mapZoom = defaultZoom;
    @if($searchresults->isNotEmpty() && $searchresults->first()->Latitude && $searchresults->first()->longnitude)
      mapCenter = [{{ $searchresults->first()->Latitude }}, {{ $searchresults->first()->longnitude }}];
      mapZoom = 12;
    @endif

    var map = L.map('map', {
      center: mapCenter,
      zoom: mapZoom
    });

    var layer = new L.TileLayer('https://{s}.basemaps.cartocdn.com/light_all/{z}/{x}/{y}{r}.png', {
      attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors &copy; <a href="https://carto.com/attributions">CARTO</a>',
      subdomains: 'abcd',
      maxZoom: 19
    });
    map.addLayer(layer);

    // Custom marker with price and arrow display
    var kayakIconWithArrow = function(price, highlight = false) {
      const bgColor = highlight ? '#ff4d01' : 'white'; // Background color change on hover
      const size = highlight ? [80, 55] : [70, 50]; // Adjust size on hover
      return L.divIcon({
        className: 'kayak-div-icon',
        html: `
          <div class="marker-wrapper" style="background: ${bgColor}; border-radius: 12px; border: 1px solid #ccc; padding: 10px; width: ${size[0]}px; height: ${size[1] - 15}px; display: flex; align-items: center; justify-content: center; box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.15); position: relative;">
            <div class="price-label" style="font-weight: bold; font-size: 16px; color: #333;">$${price !== null ? price : ''}</div>
            <div class="marker-arrow" style="content: ''; position: absolute; bottom: -10px; left: 50%; transform: translateX(-50%); width: 0; height: 0; border-left: 10px solid transparent; border-right: 10px solid transparent; border-top: 10px solid ${bgColor}; filter: drop-shadow(0px 2px 5px rgba(0, 0, 0, 0.15));"></div>
          </div>
        `,
        iconSize: size,
        popupAnchor: [0, -30],
      });
    };

    var markers = {};

    @foreach($searchresults as $searchresult)
      @if($searchresult->Latitude && $searchresult->longnitude)

        <?php
          $price = null;
          if (!empty($hotels->result)) {
              foreach ($hotels->result as $hotel_result) {
                  if ($hotel_result->id == $searchresult->hotelid) {
                      if (!empty($hotel_result->rooms) && isset($hotel_result->rooms[0])) {
                          $price = $hotel_result->rooms[0]->total;
                      }
                      break;
                  }
              }
          }
        ?>

        (function() {
          var price = {{ $price !== null ? $price : 'null' }};
          var imageUrl = "https://photo.hotellook.com/image_v2/crop/h{{ $searchresult->hotelid }}_0/520/460.jpg";
          var hotelName = "{{ $searchresult->name }}";
          var city = "{{ $searchresult->CityName }}";
          var rating = "{{ $searchresult->rating }}";
          var stars = parseInt("{{ $searchresult->stars }}");

          // Calculate rating percentage
          var ratingPercentage = (stars / 5) * 100; // Now each star equals 20%
          // Add visible stars beside hotel name
          var ratingStars = '';
          if (!isNaN(stars) && stars > 0) {
            for (var i = 0; i < stars; i++) {
              ratingStars += '<img src="{{asset('public/js/images/Stars.svg')}}" alt="Star" style="width: 12px; margin-right: 2px;">';
            }
          }
          var agencyId = "{{ $data['agencyId'] }}";

          var popupContent = `
  <div style="display: flex; padding: 0; width: 250px; height: 130px; align-items: flex-start;">
    <img src="${imageUrl}" alt="${hotelName}" style="width: 100px; height: 100%; object-fit: cover; margin: 0;">
    <div style="flex: 1; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; padding-left: 10px; display: flex; flex-direction: column; justify-content: space-between;">
      <h3 style="margin: 0; font-size: 14px; font-weight: bold; line-height: 1.2;">${hotelName} ${ratingStars}</h3>
      <p style="margin: 8px 0 0; font-size: 14px; color: #555; display: flex; align-items: center;">
        <img src="{{asset('public/js/images/map.svg')}}" alt="Marker" style="width: 16px; height: 16px; margin-right: 8px;">
        ${city}
      </p>
      <div style="display: flex; align-items: center; justify-content: center; margin: 10px 0;">
        <img src="{{asset('public/js/images/Score.svg')}}" alt="Heart" style="width: 20px; height: 20px; margin-right: 5px;">
        <span style="font-weight: bold; font-size: 14px;">${ratingPercentage.toFixed(0)}%</span>
        <span style="background-color: #e6f4f4; color: #4c8076; font-weight: bold; font-size: 12px; padding: 4px 8px; border: 2px solid white; border-radius: 4px; margin-left: 5px;">Very Good</span>
      </div>
        <div style="display: flex; align-items: center; justify-content: space-between; width: 100%;">
        <img src="https://pics.avs.io/hl_gates/100/40/${agencyId}.png" alt="agency logo" style="width: 60px; height: 20px; margin-right: 5px;">
        <button style="background-color: white; color: #333; border: 1px solid grey; padding: 2px 5px; border-radius: 5px; font-weight: bold; display: flex; align-items: center; justify-content: center;">
          <span style="font-size: 16px;">$${price}</span>
          <img src="{{ asset('public/js/images/Arro.svg') }}" alt="Arrow" style="width: 20px; margin-left: 5px;">
        </button>
      </div>
    </div>
  </div>
`;
          var marker = L.marker([{{ $searchresult->Latitude }}, {{ $searchresult->longnitude }}], {
            icon: kayakIconWithArrow(price),
            riseOnHover: true
          }).addTo(map).bindPopup(popupContent);

          markers["{{ $searchresult->id }}"] = marker;
          markers["{{ $searchresult->id }}"].isHighlighted = false;

          // Show popup on click
          marker.on('click', function() {
            this.openPopup();
          });

          // Highlight on hover
          marker.on('mouseover', function() {
            if (!marker.isHighlighted) {
              this.setIcon(kayakIconWithArrow(price, true));
              this.isHighlighted = true;
            }
          });

          // Remove highlight on mouseout
          marker.on('mouseout', function() {
            if (marker.isHighlighted) {
              this.setIcon(kayakIconWithArrow(price));
              this.isHighlighted = false;
            }
          });
        })();

      @endif
    @endforeach

    document.querySelectorAll('.tr-hotel-deatils').forEach(function(listingItem) {
      var listingId = listingItem.dataset.id;

      listingItem.addEventListener('mouseover', function() {
        if (markers[listingId] && !markers[listingId].isHighlighted) {
          markers[listingId].setIcon(kayakIconWithArrow(markers[listingId].options.icon.options.html.match(/\$(\d+)/)?.[1], true));
          markers[listingId].isHighlighted = true;
          markers[listingId].openPopup();
        }
      });

      listingItem.addEventListener('mouseout', function() {
        if (markers[listingId] && markers[listingId].isHighlighted) {
          markers[listingId].setIcon(kayakIconWithArrow(markers[listingId].options.icon.options.html.match(/\$(\d+)/)?.[1]));
          markers[listingId].isHighlighted = false;
          markers[listingId].closePopup();
        }
      });
    });

    // Close popup when clicking outside
    map.on('click', function(event) {
      if (!event.originalEvent.target.closest('.leaflet-popup-content')) {
        map.closePopup();
      }
    });

    map.invalidateSize();
    $('#mapModal').on('shown.bs.modal', function () {
      map.invalidateSize();
    });

    setTimeout(function() {
      map.invalidateSize();
    }, 500);
  });
</script>
@endif
<script>
    const minRange = document.getElementById('minRange');
const maxRange = document.getElementById('maxRange');
const minPrice = document.getElementById('minPrice');
const maxPrice = document.getElementById('maxPrice');
const slider = document.querySelector('.tr-price-slider');  // The slider container
const sliderWidth = slider.offsetWidth;  // Get the width of the slider

// Update the min and max price dynamically
minRange.addEventListener('input', function () {
  minPrice.textContent = `$${minRange.value}`;
  updateMaxPricePosition();  // Update the position of the max price
});

maxRange.addEventListener('input', function () {
  maxPrice.textContent = `$${maxRange.value}`;
  updateMaxPricePosition();  // Update the position of the max price
});

// Function to update the position of the maxPrice
function updateMaxPricePosition() {
  const maxPosition = (maxRange.value / maxRange.max) * sliderWidth;

  // Update the left position of maxPrice to move it with the slider
  maxPrice.style.left = `${maxPosition}px`;

  // Prevent the maxPrice label from going beyond the right edge of the slider
  if (maxPosition + maxPrice.offsetWidth > sliderWidth) {
    maxPrice.style.left = `${sliderWidth - maxPrice.offsetWidth}px`;  // Prevent overflow
  }
}


</script>

<script>
  // Function to update share links with the current page URL
  function updateShareLinks() {
    var currentUrl = window.location.href;

    // Set each share button's link for direct sharing on mobile
    document.getElementById("emailShare").href = `mailto:?subject=Check this out&body=${encodeURIComponent(currentUrl)}`;
    document.getElementById("smsShare").href = `sms:?body=${encodeURIComponent("Check this out: " + currentUrl)}`;
    document.getElementById("whatsappShare").href = `https://api.whatsapp.com/send?text=${encodeURIComponent("Check this out: " + currentUrl)}`;
    document.getElementById("facebookShare").href = `https://www.facebook.com/sharer/sharer.php?u=${encodeURIComponent(currentUrl)}`;
    document.getElementById("twitterShare").href = `https://twitter.com/intent/tweet?url=${encodeURIComponent(currentUrl)}&text=${encodeURIComponent("Check this out!")}`;
    document.getElementById("messengerShare").href = `https://m.me/?link=${encodeURIComponent(currentUrl)}`;
  }

  // Event listener to update links each time the modal is shown
  document.getElementById('shareModal').addEventListener('show.bs.modal', updateShareLinks);

  // Copy link function
  function copyLink() {
    var copyText = document.createElement("textarea");
    copyText.value = window.location.href;
    document.body.appendChild(copyText);
    copyText.select();
    document.execCommand("copy");
    document.body.removeChild(copyText);

    // Show feedback alert
    var alert = document.getElementById("copyAlert");
    alert.style.display = "block";
    setTimeout(function() {
      alert.style.display = "none";
    }, 2000);
  }

  // Copy embed code function
  function copyEmbedCode() {
    var embedCode = `<iframe src="${window.location.href}" width="600" height="400"></iframe>`;
    var tempInput = document.createElement("textarea");
    document.body.appendChild(tempInput);
    tempInput.value = embedCode;
    tempInput.select();
    document.execCommand("copy");
    document.body.removeChild(tempInput);

    var alert = document.getElementById("embedAlert");
    alert.style.display = "block";
    setTimeout(function() {
      alert.style.display = "none";
    }, 2000);
  }
</script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const readMoreBtn = document.querySelector('.custom-read-more');
    const trMoreFacilities = document.querySelector('.tr-more-facilities');

    if (readMoreBtn && trMoreFacilities) {
        readMoreBtn.addEventListener('click', function() {
            trMoreFacilities.classList.toggle('expanded');

            // Optional: Change button text to "Read Less" when expanded
            if (trMoreFacilities.classList.contains('expanded')) {
                readMoreBtn.textContent = 'Read Less';
            } else {
                readMoreBtn.textContent = 'Read More';
            }
        });
    }
});
</script>
<script>
    function toggleContent(button) {
        const content = button.previousElementSibling; // Select the <p> element
        content.classList.toggle('show-more');
        button.textContent = content.classList.contains('show-more') ? 'Read Less' : 'Read More';
    }
</script>
