<!DOCTYPE html>
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

  <title>@if(!empty($searchresult)){{$searchresult[0]->metaTagTitle}} @endif</title>
  <meta name="description" content="@if(!empty($searchresult)){{$searchresult[0]->MetaTagDescription}}@endif">
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <meta charset="utf-8">
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

  <link rel="stylesheet" href="{{ asset('/public/frontend/hotel-detail/css/bootstrap.min.css')}}">
  <link rel="stylesheet" href="{{ asset('/public/frontend/hotel-detail/css/style.css')}}">
  <link rel="stylesheet" href="{{ asset('/public/frontend/hotel-detail/css/calendar.css')}}" media="screen">
  <link rel="stylesheet" href="{{ asset('/public/frontend/hotel-detail/css/responsive.css')}}">
  <!-- start custom css -->
  <link rel="stylesheet" href="{{ asset('/public/css/map_leaflet.css')}}">
  <!-- end custom css -->
	
  <link rel="stylesheet" href="{{ asset('/public/css/hotel-css/style.css')}}">
  <link rel="stylesheet" href="{{ asset('/public/css/custom.css')}}">
</head>

<body>
  <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-PTHP3JH4" height="0" width="0"
      style="display:none;visibility:hidden"></iframe></noscript>
  <!--HEADER-->
  <header>
    <div class="container">
      <div class="row">
        <div class="col-sm-12">
          <div class="tr-header">
            <div class="tr-hamburgers-logo">
              <div class="tr-hamburgers"></div>
              <div class="tr-logo">
                <a href="/">
                  <img  src="{{ asset('/public/frontend/hotel-detail/images/travell-small-logo.png')}}"
                    alt="travell-logo">
                </a>
              </div>
            </div>
            <div class="tr-logo tr-desktop">
              <a href="/">
                <img  src=" {{ asset('/public/frontend/hotel-detail/images/travell-logo.png')}}"
                  alt="travell-logo">
              </a>
            </div>
            <div class="tr-search-info-section" id="hotelSearchInfos">
              <div class="tr-utility-nav">
                <div class="nav-item tr-location">Add location</div>
                <div class="nav-item tr-dates">Add date</div>
                <div class="nav-item tr-guest">Add guests</div>
                <div class="nav-item tr-search-btn-icon">
                  <button class="tr-btn tr-serach-modal"></button>
                </div>
                <button class="tr-edit-btn tr-mobile"></button>
              </div>
            </div>
            <div class="tr-nav-tabs">
              <div class="tr-explore-tab active" data-tab="exploreForm"><span><img
                    src="{{asset('public/frontend/hotel-detail/images/icons/compass-icon.svg')}}"
                    alt="Compass Icon">Explore</span></div>
              <div class="tr-hotel-tab" data-tab="hotelForm"><span><img
                    src="{{asset('public/frontend/hotel-detail/images/icons/clarity_building-line-black-icon.svg')}}"
                    alt="Clarity Building Line Icon" />Hotel</span></div>
            </div>
            <div class="tr-login-section">
              <!--Below Button for signin - currently it hide-->
              <button class="tr-login" style="display: none;">Sign in</button>
              <button class="tr-logged">
                <div class="tr-username">R</div>
              </button>
              <div class="tr-myaccount-modal">
                <div class="tr-mz-myaccount-info">
                  <ul>
                    <li class="tr-my-profile-link"><a href="javascript:void(0);">My profile</a></li>
                    <li class="tr-my-trip-link"><a href="javascript:void(0);">My trips</a></li>
                  </ul>
                </div>
                <div class="tr-mz-myaccount-info">
                  <ul>
                    <li class="tr-my-settings-link"><a href="javascript:void(0);">Settings</a></li>
                    <li class="tr-logout-link"><a href="javascript:void(0);">Logout</a></li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="tr-find-hotels">
      <div class="tr-explore-and-hotel-form">
        <button type="button" class="btn-close" id="btnClose"></button>
        <div class="tr-nav-tabs tr-mobile">
          <div class="tr-explore-tab active" data-tab="exploreForm"><span><img src="{{asset('public/frontend/hotel-detail/images/icons/compass-icon.svg')}}"
                alt="Compass Icon">Explore</span></div>
          <div class="tr-hotel-tab" data-tab="hotelForm"><span><img
                src="images/icons/clarity_building-line-black-icon.svg" alt="Clarity Building Line Icon" />Hotel</span>
          </div>
        </div>
        <form class="tr-explore-form open" id="exploreForm">
          <div class="tr-form-section">
            <div class="tr-form-fields">
              <div class="col tr-mobile">
                <div class="tr-mobile-where">
                  <label class="tr-lable">Where to?</label>
                  <div class="tr-location-label">Search location</div>
                </div>
              </div>
              <div class="col tr-form-where">
                <div class="tr-mobile tr-close-btn">Where are you going?</div>
               <input type="text" id="searchlocation" type="search"
                                                    value="{{request('search')}}" name="search" placeholder="Search Destination" autocomplete="off">

                  <div
                      class="recent-his search-box-info  d-none bg-white px-4 b-20 shadow-1 position-absolute"   id="recentSearchLocation">
                      
                      <p id="loc-list" class="px-4 autoCompletewrapper" style="width: fit-content;"></p>
                  </div>
                <div class="col tr-form-btn">
                  <button type="button" class="tr-btn tr-mobile">Countinue</button>
                </div>
              </div>
            </div>
            <div class="col tr-form-btn">
              <button type="submit" class="tr-btn tr-popup-btn" id="hotelSearchSubmit">Search</button>
            </div>
          </div>
        </form>
        <form class="tr-hotel-form" id="hotelForm">
          <div class="tr-form-section">
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
                <input id="searchDestinations" type="hidden" tabindex="1" placeholder="&#xF002; Search"  autocomplete="off">
                <input id="searchhotel" type="text" tabindex="1" placeholder="&#xF002; Search"  autocomplete="off">
              <div class="hotel_recent_his search-box-info  d-none  px-4 b-20 shadow-1 position-absolute"  id="recentSearchsDestination">
              
                <p id="hotel_loc_list" class="px-4 autoCompletewrapper" style="width: max-content;"></p>
              </div>
              <span  id="slug" class="d-none"></span> 
                <span  id="hotel" class="d-none"></span> 
                <span  id="location_id" class="d-none">@if(isset($gethotellistiid) && !$gethotellistiid->isEmpty()){{$gethotellistiid[0]->locationId}} @elseif(isset($hlid) && $hlid !="") {{$hlid}} @elseif(isset($getloclink) && !$getloclink->isEmpty()) {{$getloclink[0]->LocationId }}@else 373 @endif</span>
                
                <div class="col tr-form-btn">
                  <button type="button" class="tr-btn tr-mobile">Countinue</button>
                </div>
              </div>
				<?php date_default_timezone_set('Asia/Kolkata'); 
											
				$checkinDate = date('Y-m-d', strtotime(' +1 day'));  
				$checkoutDate = date('Y-m-d', strtotime(' +4 day'));  
				?>
              <div class="col tr-form-booking-date">
                <div class="tr-form-checkin">
                  <label for="checkIn">Check in</label>
                  <input type="text" value="{{ $checkinDate}}" class="form-control dateInput t-input-check-in" id="checkIn" placeholder="Add dates"
                    name="" autocomplete="off" readonly>
                </div>
                <div class="tr-form-checkout">
                  <label for="checkOut">Check out</label>
                  <input type="text" value="{{ $checkoutDate}}" class="form-control dateInput t-input-check-out" id="checkOut" placeholder="Add dates"
                    name="checkOut" autocomplete="off" readonly>
                </div>
                <div class="tr-calenders-modal" id="calendarsModal">
                    <div class="navigation">
                      <button class="prevMonth">Previous</button>
                      <button class="nextMonth">Next</button>
                    </div>
                    <div id="calendar1" class="custom-calendar">  
                      <div class="monthYear"></div>
                      <div class="calendarBody"></div>
                    </div>
                    <div id="calendar2" class="custom-calendar">
                      <div class="monthYear"></div>
                      <div class="calendarBody"></div>
                    </div>
                 </div>
                <div class="col tr-form-btn">
                  <button type="button" class="tr-btn tr-mobile">Next</button>
                </div>
              </div>
				
              <div class="col tr-form-who">
                <label for="totalRoomAndGuest">Who</label>
                <input type="text" class="form-control " id="totalRoomAndGuest" placeholder="Add guests" name=""
                  autocomplete="off" readonly>
                <div class="tr-guests-modal" id="guestQtyModal">
                  <div class="tr-add-edit-guest tr-total-num-of-rooms">
                  
                    <label class="tr-guest">Room</label>
                    <div class="tr-qty-box">
                      <button class="minus disabled" value="minus">-</button>
                      <input type="text" id="totalRoom"  class="totalRoom" value="0" id="" min="1" max="10" name="" readonly />
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
                      <input type="text" id="totalAdultsGuest" class="totalguest" value="0" id="" min="1" max="10" name="" readonly />
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
                      <input type="text" id="totalChildrenGuest" class="totalguest" value="0" id="" min="1" max="10" name="" readonly />
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
                      <input type="text" id="totalChildrenInfants" value="0" id="" min="1" max="10" name="" readonly />
                      <button class="plus" value="plus">+</button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col tr-form-btn">
              <button type="submit" class="tr-btn tr-popup-btn filter-chackinout" id="hotelSearchSubmit">Search</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </header>

  <!-- Refresh Banner -->
 @php
  // Convert current time to milliseconds since epoch (for JavaScript)
  $currentTimeMillis = $currentTime->timestamp * 1000;
@endphp

<div id="refresh-banner" class="tr-refresh-banner d-none"> 
  <p>Unfortunately, the search results are no longer valid.</p>
  <button class="tr-refresh-btn"><a href="">Refresh now</a></button>
</div>

  <!-- Mobile Navigation-->
  <div class="tr-mobile-nav-section">
    <div class="tr-mobile-nav-content">
      <button type="button" class="btn-nav-close" id=""></button>
      <div class="tr-nav-header">
        <div class="tr-logo">
          <img src="images/travell-small-logo.png" alt="travell small logo">
        </div>
        <div class="tr-location">London</div>
      </div>
      <div class="tr-mobile-nav-lists">
        <ul>
          <li><svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path
                d="M2.5 7.49984L10 1.6665L17.5 7.49984V16.6665C17.5 17.1085 17.3244 17.5325 17.0118 17.845C16.6993 18.1576 16.2754 18.3332 15.8333 18.3332H4.16667C3.72464 18.3332 3.30072 18.1576 2.98816 17.845C2.67559 17.5325 2.5 17.1085 2.5 16.6665V7.49984Z"
                stroke="#222222" stroke-linecap="round" stroke-linejoin="round" />
              <path d="M7.5 18.3333V10H12.5V18.3333" stroke="#222222" stroke-linecap="round" stroke-linejoin="round" />
            </svg>Explore</li>
          <li><svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path
                d="M2.5 7.49984L10 1.6665L17.5 7.49984V16.6665C17.5 17.1085 17.3244 17.5325 17.0118 17.845C16.6993 18.1576 16.2754 18.3332 15.8333 18.3332H4.16667C3.72464 18.3332 3.30072 18.1576 2.98816 17.845C2.67559 17.5325 2.5 17.1085 2.5 16.6665V7.49984Z"
                stroke="#222222" stroke-linecap="round" stroke-linejoin="round" />
              <path d="M7.5 18.3333V10H12.5V18.3333" stroke="#222222" stroke-linecap="round" stroke-linejoin="round" />
            </svg>Hotels</li>
          <li><svg width="18" height="17" viewBox="0 0 18 17" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path
                d="M11.6677 8.21686L11.4782 8.25293L11.4075 8.43241L8.58835 15.5894L7.6097 15.7757L8.3748 9.30726L8.4309 8.83302L7.96178 8.92232L3.5739 9.75759L3.37156 9.79611L3.30699 9.99171L2.47522 12.5116L1.87823 12.6253L1.98228 9.2217L1.98466 9.14395L1.95388 9.07252L0.606627 5.94522L1.20367 5.83157L2.90392 7.86957L3.03583 8.02769L3.23812 7.98919L7.626 7.15392L8.09517 7.0646L7.86869 6.64412L4.77982 0.909331L5.75841 0.723048L11.0099 6.34373L11.1416 6.48469L11.3311 6.44861L15.7902 5.59979C16.0247 5.55515 16.2673 5.60549 16.4647 5.73973L16.6615 5.45033L16.4647 5.73973C16.6621 5.87398 16.798 6.08113 16.8426 6.31561C16.8873 6.55009 16.8369 6.79271 16.7027 6.99007L16.9921 7.18692L16.7027 6.99007C16.5685 7.18744 16.3613 7.3234 16.1268 7.36803L11.6677 8.21686Z"
                stroke="black" stroke-width="0.7"></path>
            </svg>Flights</li>
          <li><svg width="20" height="17" viewBox="0 0 20 17" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path
                d="M17.0835 9.43359H14.8335M3.58349 9.43359H5.83349M17.4116 5.68359L15.9485 1.78191C15.7289 1.19645 15.1693 0.808594 14.544 0.808594H6.12299C5.49773 0.808594 4.93804 1.19645 4.7185 1.78191L3.25537 5.68359M17.4116 5.68359L17.6299 6.26568C17.7524 6.59225 18.0646 6.80859 18.4133 6.80859C18.9068 6.80859 19.293 7.23341 19.2463 7.72462L18.8335 12.0586M17.4116 5.68359H18.9585M3.25537 5.68359L3.03708 6.26568C2.91462 6.59225 2.60243 6.80859 2.25366 6.80859C1.76023 6.80859 1.37395 7.23341 1.42073 7.72462L1.83349 12.0586M3.25537 5.68359H1.70849M1.83349 12.0586L1.95418 13.3258C2.0275 14.0957 2.67408 14.6836 3.44742 14.6836H3.5835M1.83349 12.0586V12.0586C1.55735 12.0586 1.3335 12.2824 1.3335 12.5586V15.0586C1.3335 15.4728 1.66928 15.8086 2.0835 15.8086H2.8335C3.24771 15.8086 3.5835 15.4728 3.5835 15.0586V14.6836M3.5835 14.6836H17.0835M17.0835 14.6836H17.2196C17.9929 14.6836 18.6395 14.0957 18.7128 13.3258L18.8335 12.0586M17.0835 14.6836V15.0586C17.0835 15.4728 17.4193 15.8086 17.8335 15.8086H18.5835C18.9977 15.8086 19.3335 15.4728 19.3335 15.0586V12.5586C19.3335 12.2825 19.1096 12.0586 18.8335 12.0586V12.0586M6.24161 3.33425L5.41255 5.82142C5.25067 6.30707 5.61214 6.80859 6.12406 6.80859H14.5429C15.0548 6.80859 15.4163 6.30707 15.2544 5.82142L14.4254 3.33425C14.2212 2.72174 13.648 2.68359 13.0024 2.68359H7.66463C7.01899 2.68359 6.44578 2.72174 6.24161 3.33425Z"
                stroke="black" stroke-width="0.7" stroke-linecap="round" stroke-linejoin="round"></path>
            </svg>Cars</li>
        </ul>
      </div>
      <div class="tr-mobile-nav-lists">
        <ul>
          <li><svg width="20" height="21" viewBox="0 0 20 21" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path
                d="M16.6719 6.14307H3.33854C2.41807 6.14307 1.67188 6.88926 1.67188 7.80973V16.1431C1.67188 17.0635 2.41807 17.8097 3.33854 17.8097H16.6719C17.5923 17.8097 18.3385 17.0635 18.3385 16.1431V7.80973C18.3385 6.88926 17.5923 6.14307 16.6719 6.14307Z"
                stroke="#222222" stroke-linecap="round" stroke-linejoin="round"></path>
              <path
                d="M13.3385 17.8091V4.47575C13.3385 4.03372 13.1629 3.6098 12.8504 3.29724C12.5378 2.98468 12.1139 2.80908 11.6719 2.80908H8.33854C7.89651 2.80908 7.47259 2.98468 7.16003 3.29724C6.84747 3.6098 6.67188 4.03372 6.67188 4.47575V17.8091"
                stroke="#222222" stroke-linecap="round" stroke-linejoin="round"></path>
            </svg>Write a review</li>
          <li><svg width="20" height="21" viewBox="0 0 20 21" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path
                d="M16.6719 6.14307H3.33854C2.41807 6.14307 1.67188 6.88926 1.67188 7.80973V16.1431C1.67188 17.0635 2.41807 17.8097 3.33854 17.8097H16.6719C17.5923 17.8097 18.3385 17.0635 18.3385 16.1431V7.80973C18.3385 6.88926 17.5923 6.14307 16.6719 6.14307Z"
                stroke="#222222" stroke-linecap="round" stroke-linejoin="round"></path>
              <path
                d="M13.3385 17.8091V4.47575C13.3385 4.03372 13.1629 3.6098 12.8504 3.29724C12.5378 2.98468 12.1139 2.80908 11.6719 2.80908H8.33854C7.89651 2.80908 7.47259 2.98468 7.16003 3.29724C6.84747 3.6098 6.67188 4.03372 6.67188 4.47575V17.8091"
                stroke="#222222" stroke-linecap="round" stroke-linejoin="round"></path>
            </svg>Trips</li>
        </ul>
      </div>
      <div class="tr-mobile-nav-lists">
        <h4>Company</h4>
        <ul>
          <li><a href="javascript:void(0);">About us</a></li>
          <li><a href="javascript:void(0);">Contact us</a></li>
          <li><a href="javascript:void(0);">Traveller’s Choice</a></li>
          <li><a href="javascript:void(0);">Travel stories</a></li>
          <li><a href="javascript:void(0);">Help</a></li>
        </ul>
      </div>
      <div class="tr-actions">
        <button class="tr-btn tr-write-review">Sign up / Log in</button>
      </div>
    </div>
  </div>

  <!--Hotel Destails - Like Name, rating, address, gallries and etc...-->
  <div class="container">
    <div class="row">
      <div class="col-sm-12">
        <div class="tr-hotel-informations">
          <div class="tr-hotel-info">
            <h1 class="tr-hotel-name">{{$searchresult[0]->name}}</h1>
            <div class="tr-hotel-address">{{$searchresult[0]->address}}</div>
            <div class="tr-raiting">
              <a href="javascript:void(0);" class="tr-excellent">89% &nbsp;Excellent</a>
              <a href="javascript:void(0);" class="tr-share" data-bs-toggle="modal"
                data-bs-target="#shareModal">Share</a>
              <a href="javascript:void(0);" class="tr-save">Save</a>
            </div>
          </div>
          <!--Gallery-->
          <div class="tr-hotel-galleries">
            <div class="tr-desktop d-none d-sm-block d-md-block"  id="hotel-galary-image" >
             @if(!empty($searchresult[0]->hotelid))
            <?php $hoteid =$searchresult[0]->hotelid ;?>


              <div class="tr-main-image">
                @if(isset($images[$hoteid][0] ) && $images[$hoteid][0] !="")
                <img 
                  src="https://photo.hotellook.com/image_v2/limit/{{ $images[$hoteid][0] }}/628/567.auto" alt="Room Image" style="height: 400px;width: 460px;">
                @else
                <img src="{{asset('public/images/Hotel lobby.svg')}}" alt="">
                @endif
              </div>
              <div class="tr-thumb-images">
                <ul>
                  @php
                  $remainingImages = array_slice($images[$hoteid], 1);
                  @endphp

                  @for ($i = 0; $i < 6; $i++)
                   @if ($i < count($remainingImages)) @php $image=$remainingImages[$i];
                    @endphp <li>
                    @if(!empty($image))
                    <img src="https://photo.hotellook.com/image_v2/limit/{{ $image }}/312/234.auto" alt="">
                    @else
                    <img src="{{ asset('public/images/Hotel lobby.svg') }}" alt="">
                    @endif
                    </li>

                    @else
                    <li>
                      <img  src="{{ asset('public/images/Hotel lobby.svg') }}" alt="Room Image">
                    </li>
                    @endif
                    @endfor
                </ul>
                <a href="javascript:void(0);" class="tr-show-all-photos">Show all photos</a>
              </div>

              @endif
            </div>
            <div class="tr-mobile-galleries d-block d-sm-none d-md-none">
              <div id="demo" class="carousel slide" data-bs-ride="carousel" data-interval="false">
                <!-- Indicators/dots -->
                <div class="carousel-indicators">
                  <button type="button" data-bs-target="#demo" data-bs-slide-to="0" class="active"></button>
                  <button type="button" data-bs-target="#demo" data-bs-slide-to="1"></button>
                  <button type="button" data-bs-target="#demo" data-bs-slide-to="2"></button>
                  <button type="button" data-bs-target="#demo" data-bs-slide-to="3"></button>
                  <button type="button" data-bs-target="#demo" data-bs-slide-to="4"></button>
                  <button type="button" data-bs-target="#demo" data-bs-slide-to="5"></button>
                  <button type="button" data-bs-target="#demo" data-bs-slide-to="6"></button>
                </div>
                <!-- The slideshow/carousel -->
                <div class="carousel-inner">

                  @if(!empty($searchresult[0]->hotelid))
                <?php $hoteid =$searchresult[0]->hotelid ;?>
                
                  <div class="carousel-item active">
                  @if(isset($images[$hoteid][0] ) && $images[$hoteid][0] !="")
                  <img 
                    src="https://photo.hotellook.com/image_v2/limit/{{ $images[$hoteid][0] }}/628/567.auto" alt="Room Image" style="height: 400px;">
                  @else
                      <img  src="{{ asset('public/images/Hotel lobby.svg') }}" alt="" class="d-block w-100">
                  @endif
                  </div>
                  @php
                  $remainingImages = array_slice($images[$hoteid], 1);
                  @endphp

                  @for ($i = 0; $i < 6; $i++) 
                  @if ($i < count($remainingImages)) @php $image=$remainingImages[$i];
                    @endphp
                    @if(!empty($image))
                  <div class="carousel-item">
                    <img  src="https://photo.hotellook.com/image_v2/limit/{{ $image }}/312/234.auto" alt="" class="d-block w-100">
                  </div>
                  @else
                  <div class="carousel-item">
                    <img  src="{{ asset('public/images/Hotel lobby.svg') }}" alt="" class="d-block w-100">
                  </div>
                    @endif
                  @else
                  <div class="carousel-item">
                    <img  src="{{ asset('public/images/Hotel lobby.svg') }}" alt="" class="d-block w-100">
                  </div>
                   
                  @endif
                 @endfor
                
                @endif
                </div>
                <!-- The thumbs/carousel -->
                <div class="carousel-thumbs">
                  <!-- <div class="carousel-thumb">
                    <img  src="images/room-image-2.png" alt="">
                  </div>
                  <div class="carousel-thumb">
                    <img  src="images/room-image-3.png" alt="">
                  </div>
                  <div class="carousel-thumb">
                    <img  src="images/room-image-4.png" alt="">
                  </div> -->
                  <div class="tr-thumbs-count tr-show-all-photos">Show all 12+</div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="container">
    <div class="row">
      <div class="col-lg-7 col-md-12 tr-left-col">
        <div class="tr-content-section">
          <div class="tr-hotel-deatils">
            <div class="tr-hotel-certificated">
              <div class="tr-families-favourite tr-f-left">
                <img  src="{{ asset('/public/frontend/hotel-detail/images/leaf.png')}}" alt="leaf">
                <span>Families Favourite</span>
                <p>The hotel is praised for its great location near the city c'enter and attractions in London City.
                  Guests appreciate the convenient and easy access to nearby n exclusive all-suite hotel at London City
                  providing 4-star facilities...</p>
              </div>
              <div class="tr-f-right">
                <div class="tr-spotlight">
                  <div class="tr-heading"><svg width="24" height="7" viewBox="0 0 24 7" fill="none"
                      xmlns="http://www.w3.org/2000/svg">
                      <path d="M23.3868 3.5L20.5 0.613249L17.6132 3.5L20.5 6.38675L23.3868 3.5ZM0.5 4H20.5V3H0.5V4Z"
                        fill="#09707A" />
                    </svg>IN THE SPORTLIGHT<svg width="24" height="7" viewBox="0 0 24 7" fill="none"
                      xmlns="http://www.w3.org/2000/svg">
                      <path d="M0.613249 3.5L3.5 0.613249L6.38675 3.5L3.5 6.38675L0.613249 3.5ZM23.5 4H3.5V3H23.5V4Z"
                        fill="#09707A" />
                    </svg></div>
                  <div>Batch View. Delicious Food.</div>
                  <div>Kids- Friendly</div>
                </div>
                <div class="tr-business-rated">
                  <div class="tr-title">Great for</div>
                  <div class="tr-business">Business</div>
                  <div class="tr-rated">Rated 4.0</div>
                  <img  src="images/icons/marketeq-icon.svg" alt="">
                </div>
              </div>
            </div>
            <!--TAB - HOTEL DETAILS - START-->
            <div class="tr-hotel-info-tabs d-none d-md-block d-lg-blobk" id="hotelInfoTabs">
              <ul>
                <li><a href="#overviewTab" class="active">Overview</a></li>
                <li><a href="#roomTab">Room</a></li>
                <li><a href="#amenitiesTab">Amenities</a></li>
                <li><a href="#reviewTab">Review</a></li>
                <li><a href="#locationTab">Location</a></li>
              </ul>
            </div>
            <!--TAB - HOTEL DETAILS - END-->
            <span class="d-none" id="hotelid">{{$searchresult[0]->hotelid}}</span>
            <span class="d-none" id="locationid">{{$searchresult[0]->location_id}}</span>
            <span class="d-none" id="cityName">{{$searchresult[0]->cityName}}</span>

            <span class="d-none" id="Latitude">{{$searchresult[0]->Latitude}}</span>
            <span class="d-none" id="longnitude">{{$searchresult[0]->longnitude}}</span>


            <span class="d-none" id="stars">{{$searchresult[0]->stars}}</span>
            <span class="d-none" id="propertyTypeId">{{$searchresult[0]->propertyTypeId}}</span>
            <span class="d-none" id="hid">{{$searchresult[0]->id}}</span>
            <span class="d-none" id="hname">{{$searchresult[0]->name}}</span>
            <span class="d-none" id="tid">{{$tid}}</span>

            <span class="d-none" id="photoCount">{{$searchresult[0]->photoCount}}</span>
            <!--OVERVIEW SECTION - START-->
            <div class="tr-overview-section tr-tab-section" id="overviewTab">
              <h3>Overview</h3>
              <div class="tr-overview-details">
                <ul>
                  <li>
                    <div class="tr-rating">4.2</div>
                    <div class="tr-rating-type">Very Good</div>
                    <div class="tr-review">371 review</div>
                  </li>
                  <li><svg width="25" height="25" viewBox="0 0 25 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                      <path
                        d="M5.16406 9.47949C5.16406 8.37492 6.05949 7.47949 7.16406 7.47949H17.6641C18.7686 7.47949 19.6641 8.37492 19.6641 9.47949V17.9795C19.6641 19.0841 18.7686 19.9795 17.6641 19.9795H7.16406C6.05949 19.9795 5.16406 19.0841 5.16406 17.9795V9.47949Z"
                        stroke="#222222" stroke-width="1.28571" stroke-linecap="round" stroke-linejoin="round" />
                      <path d="M8.41406 5.48145V8.98144" stroke="#222222" stroke-width="1.28571" stroke-linecap="round"
                        stroke-linejoin="round" />
                      <path d="M16.4141 5.48145V8.98144" stroke="#222222" stroke-width="1.28571" stroke-linecap="round"
                        stroke-linejoin="round" />
                      <path d="M8.16406 11.4814H16.6641" stroke="#222222" stroke-width="1.28571" stroke-linecap="round"
                        stroke-linejoin="round" />
                    </svg>
                    <div class="tr-sub-title">Free Cancellation</div>
                  </li>
                  <li><svg width="25" height="25" viewBox="0 0 25 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                      <path
                        d="M6.96777 19.7314L4.96777 21.7314M18.9678 19.7314L20.9678 21.7314M9.96777 15.7314H9.97677M15.9588 15.7314H15.9678M5.96777 9.73145C9.96777 13.7314 16.4678 13.7314 19.9678 9.73145"
                        stroke="#222222" stroke-width="1.44" stroke-linecap="round" stroke-linejoin="round" />
                      <path
                        d="M6.24068 8.62544C7.06168 4.44745 8.19768 3.73145 12.4227 3.73145H13.5127C17.7377 3.73145 18.8727 4.44745 19.6947 8.62544L20.2477 11.4414C21.0027 15.2814 21.3797 17.2014 20.2797 18.4664C19.1797 19.7314 17.1097 19.7314 12.9677 19.7314C8.82668 19.7314 6.75568 19.7314 5.65568 18.4664C4.55568 17.2014 4.93268 15.2814 5.68768 11.4414L6.24068 8.62544Z"
                        stroke="#222222" stroke-width="1.44" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                    <div class="tr-sub-title">Near to metro</div>
                  </li>
                  <li><svg width="25" height="25" viewBox="0 0 25 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                      <path
                        d="M15.5283 5.48242C15.5283 8.24385 14.0397 10.7324 11.2783 10.7324C14.0397 10.7324 15.5283 13.221 15.5283 15.9824C15.5283 13.221 17.0169 10.7324 19.7783 10.7324C17.0169 10.7324 15.5283 8.24385 15.5283 5.48242Z"
                        stroke="#222222" stroke-width="1.10625" stroke-linecap="round" stroke-linejoin="round" />
                      <path
                        d="M8.52832 13.4824C8.52832 15.1393 6.93517 16.7324 5.27832 16.7324C6.93517 16.7324 8.52832 18.3256 8.52832 19.9824C8.52832 18.3256 10.1215 16.7324 11.7783 16.7324C10.1215 16.7324 8.52832 15.1393 8.52832 13.4824Z"
                        stroke="#222222" stroke-width="1.10625" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                    <div class="tr-sub-title">Clean hotel</div>
                  </li>
                  <li><svg width="25" height="25" viewBox="0 0 25 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                      <path
                        d="M15.5283 5.48242C15.5283 8.24385 14.0397 10.7324 11.2783 10.7324C14.0397 10.7324 15.5283 13.221 15.5283 15.9824C15.5283 13.221 17.0169 10.7324 19.7783 10.7324C17.0169 10.7324 15.5283 8.24385 15.5283 5.48242Z"
                        stroke="#222222" stroke-width="1.10625" stroke-linecap="round" stroke-linejoin="round" />
                      <path
                        d="M8.52832 13.4824C8.52832 15.1393 6.93517 16.7324 5.27832 16.7324C6.93517 16.7324 8.52832 18.3256 8.52832 19.9824C8.52832 18.3256 10.1215 16.7324 11.7783 16.7324C10.1215 16.7324 8.52832 15.1393 8.52832 13.4824Z"
                        stroke="#222222" stroke-width="1.10625" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                    <div class="tr-sub-title">Clean hotel</div>
                  </li>
                </ul>
              </div>
              <p> @if($searchresult[0]->about != "") {{$searchresult[0]->about}} @else Not available. @endif</p>
              <!-- static content 1 -->
              <!-- <div class="tr-things-know">
                <h3>Things to Know</h3>
                <ul>
                  <li><svg width="25" height="25" viewBox="0 0 25 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                      <path
                        d="M5.16406 9.47949C5.16406 8.37492 6.05949 7.47949 7.16406 7.47949H17.6641C18.7686 7.47949 19.6641 8.37492 19.6641 9.47949V17.9795C19.6641 19.0841 18.7686 19.9795 17.6641 19.9795H7.16406C6.05949 19.9795 5.16406 19.0841 5.16406 17.9795V9.47949Z"
                        stroke="#222222" stroke-width="1.28571" stroke-linecap="round" stroke-linejoin="round" />
                      <path d="M8.41406 5.48145V8.98144" stroke="#222222" stroke-width="1.28571" stroke-linecap="round"
                        stroke-linejoin="round" />
                      <path d="M16.4141 5.48145V8.98144" stroke="#222222" stroke-width="1.28571" stroke-linecap="round"
                        stroke-linejoin="round" />
                      <path d="M8.16406 11.4814H16.6641" stroke="#222222" stroke-width="1.28571" stroke-linecap="round"
                        stroke-linejoin="round" />
                    </svg>Cancellation till check-in available, with Travell</li>
                  <li><svg width="24" height="26" viewBox="0 0 24 26" fill="none" xmlns="http://www.w3.org/2000/svg">
                      <path
                        d="M3.44531 19.6211C3.33594 19.6211 3.23047 19.5977 3.12891 19.5508C3.02734 19.5039 2.9375 19.4336 2.85938 19.3398C2.76562 19.2617 2.69922 19.1719 2.66016 19.0703C2.62109 18.9688 2.60156 18.8555 2.60156 18.7305V17.8633C2.60156 17.6289 2.63281 17.4141 2.69531 17.2188C2.75781 17.0234 2.85156 16.8398 2.97656 16.668C3.10156 16.5117 3.24609 16.3711 3.41016 16.2461C3.57422 16.1211 3.75781 16.0117 3.96094 15.918C4.36719 15.7148 4.78516 15.5352 5.21484 15.3789C5.64453 15.2227 6.08594 15.082 6.53906 14.957C6.99219 14.8477 7.47656 14.7617 7.99219 14.6992C8.50781 14.6367 9.07031 14.6055 9.67969 14.6055C10.2734 14.6055 10.832 14.6367 11.3555 14.6992C11.8789 14.7617 12.3672 14.8555 12.8203 14.9805C13.2578 15.1055 13.6914 15.2461 14.1211 15.4023C14.5508 15.5586 14.9766 15.7305 15.3984 15.918C15.6016 16.0117 15.7852 16.1211 15.9492 16.2461C16.1133 16.3711 16.2578 16.5117 16.3828 16.668C16.5078 16.8398 16.6016 17.0234 16.6641 17.2188C16.7266 17.4141 16.7578 17.6289 16.7578 17.8633V18.7305C16.7578 18.8555 16.7344 18.9688 16.6875 19.0703C16.6406 19.1719 16.5781 19.2617 16.5 19.3398C16.4062 19.4336 16.3086 19.5039 16.207 19.5508C16.1055 19.5977 15.9922 19.6211 15.8672 19.6211H3.44531ZM18.5156 19.6211C18.5625 19.5586 18.5977 19.4922 18.6211 19.4219C18.6445 19.3516 18.6562 19.2852 18.6562 19.2227C18.6719 19.1445 18.6836 19.0664 18.6914 18.9883C18.6992 18.9102 18.7031 18.832 18.7031 18.7539V17.8164C18.7031 17.5508 18.6758 17.2891 18.6211 17.0312C18.5664 16.7734 18.4922 16.5117 18.3984 16.2461C18.3047 15.9805 18.1758 15.7344 18.0117 15.5078C17.8477 15.2812 17.6641 15.0742 17.4609 14.8867C17.7109 14.9336 17.957 14.9922 18.1992 15.0625C18.4414 15.1328 18.6719 15.2148 18.8906 15.3086C19.1094 15.4023 19.332 15.5 19.5586 15.6016C19.7852 15.7031 20.0156 15.8086 20.25 15.918C20.4688 16.0273 20.6562 16.1523 20.8125 16.293C20.9688 16.4336 21.0859 16.5898 21.1641 16.7617C21.2422 16.9336 21.3008 17.125 21.3398 17.3359C21.3789 17.5469 21.3984 17.7773 21.3984 18.0273V18.7305C21.3984 18.8555 21.3789 18.9688 21.3398 19.0703C21.3008 19.1719 21.2344 19.2617 21.1406 19.3398C21.0625 19.4336 20.9727 19.5039 20.8711 19.5508C20.7695 19.5977 20.6641 19.6211 20.5547 19.6211H18.5156ZM9.67969 12.332C9.24219 12.332 8.84375 12.2617 8.48438 12.1211C8.125 11.9805 7.80469 11.7695 7.52344 11.4883C7.24219 11.207 7.03125 10.8867 6.89062 10.5273C6.75 10.168 6.67969 9.76953 6.67969 9.33203C6.67969 8.91016 6.75 8.51953 6.89062 8.16016C7.03125 7.80078 7.24219 7.48047 7.52344 7.19922C7.80469 6.91797 8.125 6.70312 8.48438 6.55469C8.84375 6.40625 9.24219 6.33203 9.67969 6.33203C10.1016 6.33203 10.4922 6.40625 10.8516 6.55469C11.2109 6.70312 11.5312 6.91797 11.8125 7.19922C12.0938 7.48047 12.3086 7.80078 12.457 8.16016C12.6055 8.51953 12.6797 8.91016 12.6797 9.33203C12.6797 9.76953 12.6055 10.168 12.457 10.5273C12.3086 10.8867 12.0938 11.207 11.8125 11.4883C11.5312 11.7695 11.2109 11.9805 10.8516 12.1211C10.4922 12.2617 10.1016 12.332 9.67969 12.332ZM16.9453 9.33203C16.9453 9.76953 16.875 10.168 16.7344 10.5273C16.5938 10.8867 16.375 11.207 16.0781 11.4883C15.7969 11.7695 15.4766 11.9805 15.1172 12.1211C14.7578 12.2617 14.3672 12.332 13.9453 12.332C13.9297 12.332 13.9023 12.332 13.8633 12.332C13.8242 12.332 13.7734 12.3242 13.7109 12.3086C13.6641 12.3086 13.6211 12.3047 13.582 12.2969C13.543 12.2891 13.5156 12.2852 13.5 12.2852C13.6562 12.082 13.7969 11.8633 13.9219 11.6289C14.0469 11.3945 14.1562 11.1523 14.25 10.9023C14.3438 10.6523 14.4141 10.3984 14.4609 10.1406C14.5078 9.88281 14.5312 9.62109 14.5312 9.35547C14.5312 9.08984 14.5078 8.82812 14.4609 8.57031C14.4141 8.3125 14.3438 8.05859 14.25 7.80859C14.1406 7.57422 14.0273 7.33984 13.9102 7.10547C13.793 6.87109 13.6562 6.65234 13.5 6.44922C13.5312 6.43359 13.5664 6.42188 13.6055 6.41406C13.6445 6.40625 13.6875 6.39453 13.7344 6.37891C13.7656 6.36328 13.8008 6.35156 13.8398 6.34375C13.8789 6.33594 13.9141 6.33203 13.9453 6.33203C14.3672 6.33203 14.7578 6.40625 15.1172 6.55469C15.4766 6.70312 15.7969 6.91797 16.0781 7.19922C16.375 7.48047 16.5938 7.80078 16.7344 8.16016C16.875 8.51953 16.9453 8.91016 16.9453 9.33203ZM3.70312 18.5195H15.6562V17.8867C15.6562 17.7773 15.6406 17.6719 15.6094 17.5703C15.5781 17.4688 15.5391 17.3867 15.4922 17.3242C15.4297 17.2461 15.3516 17.1719 15.2578 17.1016C15.1641 17.0312 15.0469 16.957 14.9062 16.8789C14.5469 16.707 14.168 16.5508 13.7695 16.4102C13.3711 16.2695 12.9531 16.1445 12.5156 16.0352C12.0938 15.9258 11.6445 15.8438 11.168 15.7891C10.6914 15.7344 10.1953 15.707 9.67969 15.707C9.16406 15.707 8.66797 15.7344 8.19141 15.7891C7.71484 15.8438 7.25781 15.9258 6.82031 16.0352C6.39844 16.1289 5.98828 16.25 5.58984 16.3984C5.19141 16.5469 4.8125 16.707 4.45312 16.8789C4.3125 16.957 4.19141 17.0312 4.08984 17.1016C3.98828 17.1719 3.91406 17.2461 3.86719 17.3242C3.80469 17.3867 3.76172 17.4688 3.73828 17.5703C3.71484 17.6719 3.70312 17.7773 3.70312 17.8867V18.5195ZM9.67969 11.2305C9.94531 11.2305 10.1953 11.1875 10.4297 11.1016C10.6641 11.0156 10.8672 10.8789 11.0391 10.6914C11.2109 10.5195 11.3438 10.3203 11.4375 10.0938C11.5312 9.86719 11.5781 9.61328 11.5781 9.33203C11.5781 9.06641 11.5312 8.82031 11.4375 8.59375C11.3438 8.36719 11.2109 8.16016 11.0391 7.97266C10.8672 7.80078 10.6641 7.66797 10.4297 7.57422C10.1953 7.48047 9.94531 7.43359 9.67969 7.43359C9.39844 7.43359 9.14453 7.48047 8.91797 7.57422C8.69141 7.66797 8.49219 7.80078 8.32031 7.97266C8.13281 8.16016 7.99609 8.36719 7.91016 8.59375C7.82422 8.82031 7.78125 9.06641 7.78125 9.33203C7.78125 9.61328 7.82422 9.86719 7.91016 10.0938C7.99609 10.3203 8.13281 10.5195 8.32031 10.6914C8.49219 10.8789 8.69141 11.0156 8.91797 11.1016C9.14453 11.1875 9.39844 11.2305 9.67969 11.2305Z"
                        fill="#222222" />
                    </svg>Unmarried couples allowed</li>
                  <li><svg width="24" height="26" viewBox="0 0 24 26" fill="none" xmlns="http://www.w3.org/2000/svg">
                      <path
                        d="M12 21.543C10.8125 21.543 9.70312 21.3164 8.67188 20.8633C7.64062 20.4102 6.73828 19.7969 5.96484 19.0234C5.19141 18.25 4.57812 17.3477 4.125 16.3164C3.67188 15.2852 3.44531 14.1758 3.44531 12.9883C3.44531 11.8008 3.67188 10.6914 4.125 9.66016C4.57812 8.62891 5.19141 7.72656 5.96484 6.95312C6.73828 6.17969 7.64062 5.56641 8.67188 5.11328C9.70312 4.66016 10.8125 4.43359 12 4.43359C13.1719 4.43359 14.2812 4.66016 15.3281 5.11328C16.3594 5.56641 17.2617 6.17969 18.0352 6.95312C18.8086 7.72656 19.4219 8.62891 19.875 9.66016C20.3281 10.6914 20.5547 11.8008 20.5547 12.9883C20.5547 14.1758 20.3281 15.2852 19.875 16.3164C19.4219 17.3477 18.8086 18.25 18.0352 19.0234C17.2617 19.7969 16.3594 20.4102 15.3281 20.8633C14.2812 21.3164 13.1719 21.543 12 21.543ZM12 22.6211C13.3281 22.6211 14.5781 22.3633 15.75 21.8477C16.9219 21.3477 17.9414 20.6641 18.8086 19.7969C19.6758 18.9297 20.3594 17.9102 20.8594 16.7383C21.375 15.5664 21.6328 14.3164 21.6328 12.9883C21.6328 11.6602 21.375 10.4102 20.8594 9.23828C20.3594 8.06641 19.6758 7.04688 18.8086 6.17969C17.9414 5.3125 16.9219 4.62891 15.75 4.12891C14.5781 3.61328 13.3281 3.35547 12 3.35547C10.6719 3.35547 9.42188 3.61328 8.25 4.12891C7.07812 4.62891 6.05859 5.3125 5.19141 6.17969C4.32422 7.04688 3.64062 8.06641 3.14062 9.23828C2.625 10.4102 2.36719 11.6602 2.36719 12.9883C2.36719 14.3164 2.625 15.5664 3.14062 16.7383C3.64062 17.9102 4.32422 18.9297 5.19141 19.7969C6.05859 20.6641 7.07812 21.3477 8.25 21.8477C9.42188 22.3633 10.6719 22.6211 12 22.6211ZM9.67969 9.30859V16.668H8.57812V10.4336H8.53125L6.77344 11.582V10.5039L8.60156 9.30859H9.67969ZM13.9688 16.7617C13.7188 16.7617 13.4805 16.7383 13.2539 16.6914C13.0273 16.6445 12.8125 16.582 12.6094 16.5039C12.4219 16.4102 12.25 16.3008 12.0938 16.1758C11.9375 16.0508 11.8047 15.9102 11.6953 15.7539C11.5859 15.5977 11.5039 15.4336 11.4492 15.2617C11.3945 15.0898 11.3672 14.9023 11.3672 14.6992C11.3672 14.543 11.3828 14.3945 11.4141 14.2539C11.4453 14.1133 11.4922 13.9805 11.5547 13.8555C11.6172 13.7148 11.6953 13.5898 11.7891 13.4805C11.8828 13.3711 11.9844 13.2773 12.0938 13.1992C12.2031 13.1055 12.3203 13.0312 12.4453 12.9766C12.5703 12.9219 12.7031 12.8789 12.8438 12.8477V12.8008C12.6562 12.7695 12.4883 12.7031 12.3398 12.6016C12.1914 12.5 12.0625 12.3711 11.9531 12.2148C11.8438 12.0742 11.7617 11.9141 11.707 11.7344C11.6523 11.5547 11.6328 11.3711 11.6484 11.1836C11.6328 10.9961 11.6523 10.8164 11.707 10.6445C11.7617 10.4727 11.8359 10.3164 11.9297 10.1758C12.0391 10.0195 12.1641 9.88281 12.3047 9.76562C12.4453 9.64844 12.6016 9.55078 12.7734 9.47266C12.9453 9.37891 13.1328 9.3125 13.3359 9.27344C13.5391 9.23438 13.75 9.21484 13.9688 9.21484C14.2031 9.21484 14.418 9.23828 14.6133 9.28516C14.8086 9.33203 15 9.39453 15.1875 9.47266C15.3594 9.55078 15.5156 9.64844 15.6562 9.76562C15.7969 9.88281 15.9141 10.0195 16.0078 10.1758C16.1172 10.3164 16.1953 10.4727 16.2422 10.6445C16.2891 10.8164 16.3125 10.9961 16.3125 11.1836C16.3125 11.3711 16.2852 11.5547 16.2305 11.7344C16.1758 11.9141 16.0938 12.0742 15.9844 12.2148C15.875 12.3711 15.7461 12.5 15.5977 12.6016C15.4492 12.7031 15.2891 12.7695 15.1172 12.8008V12.8477C15.2578 12.8789 15.3906 12.9219 15.5156 12.9766C15.6406 13.0312 15.7578 13.1055 15.8672 13.1992C15.9766 13.2773 16.0742 13.3711 16.1602 13.4805C16.2461 13.5898 16.3203 13.7148 16.3828 13.8555C16.4609 13.9805 16.5156 14.1133 16.5469 14.2539C16.5781 14.3945 16.5938 14.543 16.5938 14.6992C16.5938 14.9023 16.5664 15.0898 16.5117 15.2617C16.457 15.4336 16.375 15.5977 16.2656 15.7539C16.1406 15.9102 16.0039 16.0508 15.8555 16.1758C15.707 16.3008 15.5312 16.4102 15.3281 16.5039C15.1406 16.582 14.9336 16.6445 14.707 16.6914C14.4805 16.7383 14.2344 16.7617 13.9688 16.7617ZM13.9688 15.8477C14.125 15.8477 14.2695 15.8359 14.4023 15.8125C14.5352 15.7891 14.6562 15.7539 14.7656 15.707C14.875 15.6602 14.9727 15.5977 15.0586 15.5195C15.1445 15.4414 15.2188 15.3633 15.2812 15.2852C15.3438 15.1914 15.3906 15.0898 15.4219 14.9805C15.4531 14.8711 15.4688 14.7539 15.4688 14.6289C15.4688 14.5039 15.4531 14.3828 15.4219 14.2656C15.3906 14.1484 15.3438 14.043 15.2812 13.9492C15.2031 13.8555 15.1211 13.7695 15.0352 13.6914C14.9492 13.6133 14.8516 13.543 14.7422 13.4805C14.6328 13.4336 14.5156 13.3945 14.3906 13.3633C14.2656 13.332 14.125 13.3164 13.9688 13.3164C13.8281 13.3164 13.6953 13.332 13.5703 13.3633C13.4453 13.3945 13.3281 13.4336 13.2188 13.4805C13.0938 13.543 12.9883 13.6133 12.9023 13.6914C12.8164 13.7695 12.7422 13.8555 12.6797 13.9492C12.6172 14.043 12.5703 14.1484 12.5391 14.2656C12.5078 14.3828 12.4922 14.5039 12.4922 14.6289C12.4922 14.7539 12.5039 14.8711 12.5273 14.9805C12.5508 15.0898 12.5938 15.1914 12.6562 15.2852C12.7188 15.3633 12.793 15.4414 12.8789 15.5195C12.9648 15.5977 13.0625 15.6602 13.1719 15.707C13.2969 15.7539 13.4258 15.7891 13.5586 15.8125C13.6914 15.8359 13.8281 15.8477 13.9688 15.8477ZM13.9688 12.4258C14.0938 12.4258 14.2109 12.4141 14.3203 12.3906C14.4297 12.3672 14.5312 12.332 14.625 12.2852C14.7188 12.2383 14.8047 12.1797 14.8828 12.1094C14.9609 12.0391 15.0234 11.9648 15.0703 11.8867C15.1328 11.793 15.1758 11.6953 15.1992 11.5938C15.2227 11.4922 15.2344 11.3867 15.2344 11.2773C15.2344 11.1523 15.2227 11.0391 15.1992 10.9375C15.1758 10.8359 15.1328 10.7461 15.0703 10.668C15.0234 10.5742 14.9609 10.4961 14.8828 10.4336C14.8047 10.3711 14.7188 10.3164 14.625 10.2695C14.5312 10.2227 14.4297 10.1875 14.3203 10.1641C14.2109 10.1406 14.0938 10.1289 13.9688 10.1289C13.8438 10.1289 13.7266 10.1406 13.6172 10.1641C13.5078 10.1875 13.4062 10.2227 13.3125 10.2695C13.2188 10.3164 13.1367 10.3711 13.0664 10.4336C12.9961 10.4961 12.9297 10.5742 12.8672 10.668C12.8203 10.7461 12.7852 10.8359 12.7617 10.9375C12.7383 11.0391 12.7266 11.1523 12.7266 11.2773C12.7266 11.3867 12.7383 11.4922 12.7617 11.5938C12.7852 11.6953 12.8203 11.793 12.8672 11.8867C12.9297 11.9648 12.9961 12.0391 13.0664 12.1094C13.1367 12.1797 13.2188 12.2383 13.3125 12.2852C13.4062 12.332 13.5078 12.3672 13.6172 12.3906C13.7266 12.4141 13.8438 12.4258 13.9688 12.4258Z"
                        fill="#222222" />
                    </svg>Guests below 18 years of age allowed</li>
                  <li><svg width="24" height="25" viewBox="0 0 24 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                      <path
                        d="M20.3172 19.009L19.4162 18.106L20.4732 7.87305H11.4622L11.3272 6.87305H15.9422V2.87305H16.9422V6.87305H21.5582L20.3172 19.009ZM20.0912 23.019L0.867188 3.79805L1.58119 3.08405L20.8042 22.307L20.0912 23.019ZM2.44219 19.182V18.182H15.6732V19.182H2.44219ZM3.05819 22.489C2.87752 22.489 2.72985 22.4284 2.61519 22.307C2.49985 22.1857 2.44219 22.041 2.44219 21.873V21.489H15.6732V21.874C15.6732 22.0414 15.6192 22.1857 15.5112 22.307C15.4032 22.4284 15.2522 22.489 15.0582 22.489H3.05819ZM10.2042 11.706V12.706C10.0182 12.6807 9.83019 12.664 9.64019 12.656C9.45019 12.648 9.25619 12.6437 9.05819 12.643C7.63819 12.643 6.47152 12.8577 5.55819 13.287C4.64485 13.7164 4.03652 14.2454 3.73319 14.874H13.3712L14.3712 15.874H2.44219C2.44219 14.716 3.03885 13.7214 4.23219 12.89C5.42552 12.0587 7.03419 11.643 9.05819 11.643C9.25685 11.643 9.45119 11.647 9.64119 11.655C9.83052 11.6637 10.0182 11.6807 10.2042 11.706Z"
                        fill="#222222" />
                    </svg>Alcohol consumption allowed within the premises</li>
                  <li><svg width="24" height="26" viewBox="0 0 24 26" fill="none" xmlns="http://www.w3.org/2000/svg">
                      <path
                        d="M4.07812 21.9883V20.9805H5.71875V17.5586C5.46875 17.4961 5.24219 17.3984 5.03906 17.2656C4.83594 17.1328 4.66406 16.9727 4.52344 16.7852C4.36719 16.5977 4.25391 16.3945 4.18359 16.1758C4.11328 15.957 4.07812 15.7305 4.07812 15.4961V8.62891H8.36719V15.4961C8.36719 15.7305 8.33203 15.957 8.26172 16.1758C8.19141 16.3945 8.08594 16.5977 7.94531 16.7852C7.78906 16.9727 7.61328 17.1328 7.41797 17.2656C7.22266 17.3984 6.99219 17.4961 6.72656 17.5586V20.9805H8.36719V21.9883H4.07812ZM5.08594 13.0352H7.38281V9.63672H5.08594V13.0352ZM6.23438 16.6445C6.39062 16.6445 6.53906 16.6172 6.67969 16.5625C6.82031 16.5078 6.94531 16.4258 7.05469 16.3164C7.16406 16.207 7.24609 16.082 7.30078 15.9414C7.35547 15.8008 7.38281 15.6523 7.38281 15.4961V14.043H5.08594V15.4961C5.08594 15.6523 5.11328 15.8008 5.16797 15.9414C5.22266 16.082 5.30469 16.207 5.41406 16.3164C5.52344 16.4258 5.64453 16.5078 5.77734 16.5625C5.91016 16.6172 6.0625 16.6445 6.23438 16.6445ZM12.9375 21.9883C12.7812 21.9883 12.6445 21.9648 12.5273 21.918C12.4102 21.8711 12.3047 21.8008 12.2109 21.707C12.1172 21.6133 12.0469 21.5039 12 21.3789C11.9531 21.2539 11.9297 21.1211 11.9297 20.9805V11.4414C11.9297 11.332 11.9453 11.2305 11.9766 11.1367C12.0078 11.043 12.0547 10.9492 12.1172 10.8555C12.1953 10.7773 12.2734 10.707 12.3516 10.6445C12.4297 10.582 12.5234 10.5273 12.6328 10.4805L13.5469 10.1289C13.7656 10.0664 13.9609 9.98438 14.1328 9.88281C14.3047 9.78125 14.4453 9.66016 14.5547 9.51953C14.6797 9.39453 14.7734 9.23047 14.8359 9.02734C14.8984 8.82422 14.9297 8.57422 14.9297 8.27734V4.99609C14.9297 4.88672 14.9492 4.78516 14.9883 4.69141C15.0273 4.59766 15.0781 4.51172 15.1406 4.43359C15.2188 4.35547 15.3047 4.30078 15.3984 4.26953C15.4922 4.23828 15.5938 4.22266 15.7031 4.22266H17.1562C17.2656 4.22266 17.3633 4.23828 17.4492 4.26953C17.5352 4.30078 17.6172 4.35547 17.6953 4.43359C17.7734 4.51172 17.832 4.59766 17.8711 4.69141C17.9102 4.78516 17.9297 4.88672 17.9297 4.99609V8.27734C17.9297 8.57422 17.9609 8.82422 18.0234 9.02734C18.0859 9.23047 18.1719 9.39453 18.2812 9.51953C18.4062 9.66016 18.5547 9.78125 18.7266 9.88281C18.8984 9.98438 19.1016 10.0664 19.3359 10.1289L20.2734 10.4805C20.3672 10.5273 20.4531 10.582 20.5312 10.6445C20.6094 10.707 20.6797 10.7773 20.7422 10.8555C20.8047 10.9492 20.8516 11.043 20.8828 11.1367C20.9141 11.2305 20.9297 11.332 20.9297 11.4414V20.9805C20.9297 21.1211 20.9023 21.2539 20.8477 21.3789C20.793 21.5039 20.7188 21.6133 20.625 21.707C20.5312 21.8008 20.4258 21.8711 20.3086 21.918C20.1914 21.9648 20.0625 21.9883 19.9219 21.9883H12.9375ZM15.9375 6.28516H16.9219V5.20703H15.9375V6.28516ZM12.9375 13.6914H19.9219V11.4414L18.9844 11.0898C18.6562 10.9648 18.3672 10.8242 18.1172 10.668C17.8672 10.5117 17.6562 10.3242 17.4844 10.1055C17.2969 9.90234 17.1562 9.64844 17.0625 9.34375C16.9688 9.03906 16.9219 8.68359 16.9219 8.27734V7.29297H15.9375V8.27734C15.9375 8.68359 15.8906 9.03906 15.7969 9.34375C15.7031 9.64844 15.5625 9.90234 15.375 10.1055C15.1875 10.3242 14.9688 10.5117 14.7188 10.668C14.4688 10.8242 14.1875 10.9648 13.875 11.0898L12.9375 11.4414V13.6914ZM12.9375 20.9805H19.9219V18.332H12.9375V20.9805ZM12.9375 17.3477H19.9219V14.6992H12.9375V17.3477Z"
                        fill="#222222" />
                    </svg>Food from outside NOT allowed within the premises</li>
                  <li><svg width="24" height="26" viewBox="0 0 24 26" fill="none" xmlns="http://www.w3.org/2000/svg">
                      <path
                        d="M14.6953 12.0039L13.9219 12.7773C14 12.8711 14.0703 12.9766 14.1328 13.0938C14.1953 13.2109 14.25 13.3242 14.2969 13.4336C14.4062 13.7461 14.5664 14.0391 14.7773 14.3125C14.9883 14.5859 15.2422 14.8086 15.5391 14.9805C15.9766 15.2461 16.3281 15.6094 16.5938 16.0703C16.8594 16.5312 16.9922 17.0352 16.9922 17.582C16.9922 18.4102 16.6992 19.1172 16.1133 19.7031C15.5273 20.2891 14.8203 20.582 13.9922 20.582H10.0312C9.48438 20.582 8.98828 20.457 8.54297 20.207C8.09766 19.957 7.74219 19.6211 7.47656 19.1992L6.70312 19.9727C7.07812 20.4883 7.55469 20.8984 8.13281 21.2031C8.71094 21.5078 9.34375 21.6602 10.0312 21.6602H13.9922C15.1172 21.6602 16.0781 21.2617 16.875 20.4648C17.6719 19.668 18.0703 18.707 18.0703 17.582C18.0703 16.832 17.8906 16.1484 17.5312 15.5312C17.1719 14.9141 16.6953 14.4258 16.1016 14.0664C15.9141 13.957 15.7539 13.8164 15.6211 13.6445C15.4883 13.4727 15.3828 13.2852 15.3047 13.082C15.2422 12.8789 15.1562 12.6875 15.0469 12.5078C14.9375 12.3281 14.8203 12.1602 14.6953 12.0039ZM3.51562 21.4727L2.67188 20.6289L5.92969 17.3711C5.96094 16.668 6.15625 16.0273 6.51562 15.4492C6.875 14.8711 7.33594 14.4102 7.89844 14.0664C8.07031 13.957 8.22656 13.8164 8.36719 13.6445C8.50781 13.4727 8.60938 13.2852 8.67188 13.082C8.92188 12.4102 9.34766 11.8516 9.94922 11.4062C10.5508 10.9609 11.2344 10.7383 12 10.7383C12.0781 10.7383 12.1602 10.7422 12.2461 10.75C12.332 10.7578 12.4219 10.7695 12.5156 10.7852L13.8281 9.47266C13.4688 9.26953 13.1719 8.94531 12.9375 8.5C12.7031 8.05469 12.5859 7.55078 12.5859 6.98828C12.5859 6.25391 12.7812 5.625 13.1719 5.10156C13.5625 4.57812 14.0391 4.31641 14.6016 4.31641C15.1172 4.31641 15.5664 4.54297 15.9492 4.99609C16.332 5.44922 16.5469 6.01172 16.5938 6.68359L19.6406 3.66016L20.4844 4.50391L3.51562 21.4727ZM9.70312 13.457C9.82812 13.0664 10.043 12.7344 10.3477 12.4609C10.6523 12.1875 11 12.0039 11.3906 11.9102L9.58594 13.6914C9.61719 13.6602 9.64062 13.6211 9.65625 13.5742C9.67188 13.5273 9.6875 13.4883 9.70312 13.457ZM14.6016 8.58203C14.6172 8.58203 14.6367 8.58203 14.6602 8.58203C14.6836 8.58203 14.7031 8.57422 14.7188 8.55859L15.3047 7.97266C15.3828 7.84766 15.4414 7.69922 15.4805 7.52734C15.5195 7.35547 15.5391 7.17578 15.5391 6.98828C15.5391 6.72266 15.5 6.48438 15.4219 6.27344C15.3438 6.0625 15.2578 5.88672 15.1641 5.74609C15.0547 5.60547 14.9492 5.51172 14.8477 5.46484C14.7461 5.41797 14.6641 5.39453 14.6016 5.39453C14.5391 5.39453 14.457 5.41797 14.3555 5.46484C14.2539 5.51172 14.1484 5.60547 14.0391 5.74609C13.9297 5.88672 13.8398 6.0625 13.7695 6.27344C13.6992 6.48438 13.6641 6.72266 13.6641 6.98828C13.6641 7.25391 13.6992 7.49219 13.7695 7.70312C13.8398 7.91406 13.9297 8.08984 14.0391 8.23047C14.1484 8.37109 14.2539 8.46484 14.3555 8.51172C14.457 8.55859 14.5391 8.58203 14.6016 8.58203ZM16.6875 9.98828C16.6719 10.1133 16.6562 10.2383 16.6406 10.3633C16.625 10.4883 16.6172 10.6133 16.6172 10.7383C16.6172 11.4883 16.8125 12.125 17.2031 12.6484C17.5938 13.1719 18.0703 13.4336 18.6328 13.4336C19.1797 13.4336 19.6484 13.1719 20.0391 12.6484C20.4297 12.125 20.625 11.4883 20.625 10.7383C20.625 10.0039 20.4297 9.375 20.0391 8.85156C19.6484 8.32812 19.1797 8.06641 18.6328 8.06641H18.6094L16.6875 9.98828ZM19.5469 10.7383C19.5469 11.0039 19.5117 11.2461 19.4414 11.4648C19.3711 11.6836 19.2812 11.8633 19.1719 12.0039C19.0781 12.1445 18.9805 12.2383 18.8789 12.2852C18.7773 12.332 18.6953 12.3555 18.6328 12.3555C18.5547 12.3555 18.4688 12.332 18.375 12.2852C18.2812 12.2383 18.1797 12.1445 18.0703 12.0039C17.9609 11.8633 17.8711 11.6836 17.8008 11.4648C17.7305 11.2461 17.6953 11.0039 17.6953 10.7383C17.6953 10.4727 17.7305 10.2344 17.8008 10.0234C17.8711 9.8125 17.9609 9.63672 18.0703 9.49609C18.1797 9.35547 18.2812 9.26172 18.375 9.21484C18.4688 9.16797 18.5547 9.14453 18.6328 9.14453C18.6953 9.14453 18.7773 9.16797 18.8789 9.21484C18.9805 9.26172 19.0781 9.35547 19.1719 9.49609C19.2812 9.63672 19.3711 9.8125 19.4414 10.0234C19.5117 10.2344 19.5469 10.4727 19.5469 10.7383ZM9.39844 9.66016C8.85156 9.66016 8.37891 9.39844 7.98047 8.875C7.58203 8.35156 7.38281 7.72266 7.38281 6.98828C7.38281 6.25391 7.58203 5.625 7.98047 5.10156C8.37891 4.57812 8.85156 4.31641 9.39844 4.31641C9.96094 4.31641 10.4375 4.57812 10.8281 5.10156C11.2188 5.625 11.4141 6.25391 11.4141 6.98828C11.4141 7.72266 11.2188 8.35156 10.8281 8.875C10.4375 9.39844 9.96094 9.66016 9.39844 9.66016ZM9.96094 8.23047C10.0703 8.08984 10.1602 7.91406 10.2305 7.70312C10.3008 7.49219 10.3359 7.25391 10.3359 6.98828C10.3359 6.72266 10.3008 6.48438 10.2305 6.27344C10.1602 6.0625 10.0703 5.88672 9.96094 5.74609C9.85156 5.60547 9.75 5.51172 9.65625 5.46484C9.5625 5.41797 9.47656 5.39453 9.39844 5.39453C9.33594 5.39453 9.25391 5.41797 9.15234 5.46484C9.05078 5.51172 8.94531 5.60547 8.83594 5.74609C8.74219 5.88672 8.65625 6.0625 8.57812 6.27344C8.5 6.48438 8.46094 6.72266 8.46094 6.98828C8.46094 7.25391 8.5 7.49219 8.57812 7.70312C8.65625 7.91406 8.74219 8.08984 8.83594 8.23047C8.94531 8.37109 9.05078 8.46484 9.15234 8.51172C9.25391 8.55859 9.33594 8.58203 9.39844 8.58203C9.47656 8.58203 9.5625 8.55859 9.65625 8.51172C9.75 8.46484 9.85156 8.37109 9.96094 8.23047ZM7.38281 10.7383C7.38281 10.0039 7.1875 9.375 6.79688 8.85156C6.40625 8.32812 5.9375 8.06641 5.39062 8.06641C4.82812 8.06641 4.35156 8.32812 3.96094 8.85156C3.57031 9.375 3.375 10.0039 3.375 10.7383C3.375 11.4883 3.57031 12.125 3.96094 12.6484C4.35156 13.1719 4.82812 13.4336 5.39062 13.4336C5.9375 13.4336 6.40625 13.1719 6.79688 12.6484C7.1875 12.125 7.38281 11.4883 7.38281 10.7383ZM6.30469 10.7383C6.30469 11.0039 6.26953 11.2461 6.19922 11.4648C6.12891 11.6836 6.03906 11.8633 5.92969 12.0039C5.83594 12.1445 5.73828 12.2383 5.63672 12.2852C5.53516 12.332 5.45312 12.3555 5.39062 12.3555C5.3125 12.3555 5.22656 12.332 5.13281 12.2852C5.03906 12.2383 4.9375 12.1445 4.82812 12.0039C4.71875 11.8633 4.62891 11.6836 4.55859 11.4648C4.48828 11.2461 4.45312 11.0039 4.45312 10.7383C4.45312 10.4727 4.48828 10.2344 4.55859 10.0234C4.62891 9.8125 4.71875 9.63672 4.82812 9.49609C4.9375 9.35547 5.03906 9.26172 5.13281 9.21484C5.22656 9.16797 5.3125 9.14453 5.39062 9.14453C5.45312 9.14453 5.53516 9.16797 5.63672 9.21484C5.73828 9.26172 5.83594 9.35547 5.92969 9.49609C6.03906 9.63672 6.12891 9.8125 6.19922 10.0234C6.26953 10.2344 6.30469 10.4727 6.30469 10.7383Z"
                        fill="#222222" />
                    </svg>Pets NOT allowed within the premises</li>
                  <li><svg width="25" height="25" viewBox="0 0 25 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                      <path
                        d="M5.16406 9.47949C5.16406 8.37492 6.05949 7.47949 7.16406 7.47949H17.6641C18.7686 7.47949 19.6641 8.37492 19.6641 9.47949V17.9795C19.6641 19.0841 18.7686 19.9795 17.6641 19.9795H7.16406C6.05949 19.9795 5.16406 19.0841 5.16406 17.9795V9.47949Z"
                        stroke="#222222" stroke-width="1.28571" stroke-linecap="round" stroke-linejoin="round" />
                      <path d="M8.41406 5.48145V8.98144" stroke="#222222" stroke-width="1.28571" stroke-linecap="round"
                        stroke-linejoin="round" />
                      <path d="M16.4141 5.48145V8.98144" stroke="#222222" stroke-width="1.28571" stroke-linecap="round"
                        stroke-linejoin="round" />
                      <path d="M8.16406 11.4814H16.6641" stroke="#222222" stroke-width="1.28571" stroke-linecap="round"
                        stroke-linejoin="round" />
                    </svg>AAA</li>
                  <li><svg width="25" height="25" viewBox="0 0 25 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                      <path
                        d="M5.16406 9.47949C5.16406 8.37492 6.05949 7.47949 7.16406 7.47949H17.6641C18.7686 7.47949 19.6641 8.37492 19.6641 9.47949V17.9795C19.6641 19.0841 18.7686 19.9795 17.6641 19.9795H7.16406C6.05949 19.9795 5.16406 19.0841 5.16406 17.9795V9.47949Z"
                        stroke="#222222" stroke-width="1.28571" stroke-linecap="round" stroke-linejoin="round" />
                      <path d="M8.41406 5.48145V8.98144" stroke="#222222" stroke-width="1.28571" stroke-linecap="round"
                        stroke-linejoin="round" />
                      <path d="M16.4141 5.48145V8.98144" stroke="#222222" stroke-width="1.28571" stroke-linecap="round"
                        stroke-linejoin="round" />
                      <path d="M8.16406 11.4814H16.6641" stroke="#222222" stroke-width="1.28571" stroke-linecap="round"
                        stroke-linejoin="round" />
                    </svg>AAA</li>
                  <li><svg width="25" height="25" viewBox="0 0 25 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                      <path
                        d="M5.16406 9.47949C5.16406 8.37492 6.05949 7.47949 7.16406 7.47949H17.6641C18.7686 7.47949 19.6641 8.37492 19.6641 9.47949V17.9795C19.6641 19.0841 18.7686 19.9795 17.6641 19.9795H7.16406C6.05949 19.9795 5.16406 19.0841 5.16406 17.9795V9.47949Z"
                        stroke="#222222" stroke-width="1.28571" stroke-linecap="round" stroke-linejoin="round" />
                      <path d="M8.41406 5.48145V8.98144" stroke="#222222" stroke-width="1.28571" stroke-linecap="round"
                        stroke-linejoin="round" />
                      <path d="M16.4141 5.48145V8.98144" stroke="#222222" stroke-width="1.28571" stroke-linecap="round"
                        stroke-linejoin="round" />
                      <path d="M8.16406 11.4814H16.6641" stroke="#222222" stroke-width="1.28571" stroke-linecap="round"
                        stroke-linejoin="round" />
                    </svg>AAA</li>
                </ul>
                <button type="button" class="tr-anchor-btn" id="moreButton" value="Show all" />Show all</button>
                <button type="button" class="tr-anchor-btn" id="lessButton" value="Show less" />Show less</button>
              </div> -->
            </div>
            <!--OVERVIEW SECTION - END-->

            <!--ROOM SECTION - START-->
            <div class="tr-room-section tr-tab-section" id="roomTab">
              <h3   @if(empty($amenitiesListroom)) mb-3 @endif>Room</h3>
			 <?php  
				  $checkin="";
                  $checkout="";
                  $checkin1 = request()->query('checkin');
                  $checkout1 = request()->get('checkout');
                  if( $checkin1 !=""  && $checkout1 !=""){
                      $checkin =  DateTime::createFromFormat('Y-m-d', $checkin1)->format('d M Y') ;
                      $checkout =  DateTime::createFromFormat('Y-m-d', $checkout1)->format('d M Y') ;
			
                  }
			

               ?>
             
			 @if(!empty($amenitiesListroom))
              <div class="tr-room-filters">
            
               
                <span class="tr-filter-label">Filter rooms by</span> 
                <form class="tr-filter-lists"  id="tr-filter-lists">
                  @if(!empty($amenitiesListroom))
                  @foreach($amenitiesListroom as $val)

                  <span class="d-none" id="pagetype">
                  @if($pgtype == 'withoutdate')
                  withoutdate
                  @elseif($pgtype == 'withdate') 
                  withdate
                  @endif
                  </span>
                
                  <div class="tr-filter-list @if($pgtype == 'withoutdate') filter_hotel_room @elseif($pgtype == 'withdate') filter_hotel_room_with_date @endif">                
                      <input type="checkbox" name="" id="filter1-{{ $val }}"
                        class="filter allamenities {{ $val }} "
                        data-value="{{ $val }}" value="category1">

                      <label for="filter1-{{ $val }}" class="filter-col filter1-{{ $val }}">

                      <svg width="20" height="22" viewBox="0 0 20 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                          d="M4.13994 4.40234L15.7907 16.0531C16.0117 16.2742 16.1359 16.574 16.1359 16.8866C16.1359 17.1993 16.0117 17.4991 15.7907 17.7202C15.5695 17.9412 15.2697 18.0653 14.9571 18.0653C14.6445 18.0653 14.3446 17.9412 14.1235 17.7202L11.2775 14.8252C11.0912 14.636 10.9867 14.3813 10.9866 14.1159V13.941C10.9866 13.807 10.96 13.6743 10.9083 13.5506C10.8566 13.4269 10.7809 13.3148 10.6855 13.2206L10.318 12.8813C10.1933 12.7662 10.0416 12.6843 9.87695 12.6432C9.71227 12.6021 9.5399 12.6031 9.3757 12.646C9.11676 12.7136 8.84465 12.7123 8.58638 12.6423C8.3281 12.5722 8.09264 12.4358 7.90335 12.2467L5.20183 9.54482C3.59919 7.94218 3.00943 5.5221 4.13994 4.40234Z"
                          stroke="#222222" stroke-linejoin="round"></path>
                        <path
                          d="M14.9728 3.9043L12.5299 6.34714C12.342 6.53508 12.1929 6.75821 12.0911 7.00379C11.9894 7.24936 11.937 7.51257 11.937 7.77838V8.2483C11.937 8.31478 11.9239 8.38062 11.8985 8.44204C11.873 8.50346 11.8357 8.55927 11.7887 8.60627L11.4311 8.96392M12.443 9.97584L12.8006 9.61819C12.8476 9.57116 12.9034 9.53386 12.9649 9.50841C13.0263 9.48296 13.0921 9.46987 13.1586 9.46988H13.6285C13.8943 9.46988 14.1575 9.41752 14.4031 9.31578C14.6487 9.21405 14.8718 9.06493 15.0598 8.87695L17.5026 6.43411M16.2377 5.1692L13.7079 7.69901M8.64827 14.5295L5.49486 17.7006C5.25766 17.9377 4.93598 18.071 4.60057 18.071C4.26516 18.071 3.94349 17.9377 3.70628 17.7006C3.46915 17.4634 3.33594 17.1417 3.33594 16.8063C3.33594 16.4709 3.46915 16.1492 3.70628 15.912L6.37144 13.2646"
                          stroke="#222222" stroke-linecap="round" stroke-linejoin="round"></path>
                      </svg>@if($val == 'cardRequired') Card Required @elseif($val == 'breakfast') Free breakfast @elseif($val == 'privateBathroom') Private Bathroom @else {{$val}} @endif</label>
                  </div>
                  @endforeach
                  @endif
            
                </form>
              
              
              </div>
            @endif
              <div class="tr-hotel-lists-first"  id="get_room_result">
                <?php  
                if(!$TPRoomtype->isEmpty()){
                      $Roomdesc = $TPRoomtype[0]->Roomdesc;
                      $Roomdesc = json_decode($Roomdesc);
                }

                if(!empty($searchresult)){
                      $hotelid =  $searchresult[0]->hotelid; 
                      $photoCount =  $searchresult[0]->photoCount;
                }
				   $countRoomdescKeys =null;
				  $countRoomdescKeys1 =null;
              ?>

                @if(!$TPRoomtype->isEmpty())    
                <?php  $countRoomdescKeys = count(array_keys((array)$Roomdesc));
                $countRoomdescKeys -= 2;
                $countRoomdescKeys1 = count(array_keys((array)$Roomdesc));
              ?>        
                @foreach ($Roomdesc as $keys=>$value)
                <div class="tr-hotel-deatils">
                  <div class="tr-hotal-image">
                    <?php
                        $matchedRoom = collect($getroomtype)->first(function ($room) use ($keys) {
                            return stripos($keys, $room->type) !== false;
                        });

                        $matchedImageId = $matchedRoom ? $matchedRoom->imageid : 0;
                        ?>
                    <div id="roomSlider1" class="carousel slide" data-bs-ride="carousel">
                      <!-- Indicators/dots -->
                      <div class="carousel-indicators">
                        <button type="button" data-bs-target="#roomSlider1" data-bs-slide-to="0"
                          class="active">1</button>
                        <button type="button" data-bs-target="#roomSlider1" data-bs-slide-to="1">2</button>
                        <button type="button" data-bs-target="#roomSlider1" data-bs-slide-to="2">3</button>
                      </div>
                      <!-- The slideshow/carousel -->
                      <div class="carousel-inner" >
                        <div class="carousel-item active" style="height: 203px;">
                          <img  src="@if($matchedImageId <= $photoCount)https://photo.hotellook.com/image_v2/limit/h{{$hotelid}}_{{$matchedImageId}}/350.jpg           @else
                   https://photo.hotellook.com/image_v2/limit/h{{$hotelid}}_{{$rtp->imageid}}/300.jpg
                  @endif" alt="">
                        </div>
                        <div class="carousel-item" style="height: 203px;">
                          <img  src="@if($matchedImageId <= $photoCount)https://photo.hotellook.com/image_v2/limit/h{{$hotelid}}_{{$matchedImageId}}/300.jpg           @else
                   https://photo.hotellook.com/image_v2/limit/h{{$hotelid}}_{{$rtp->imageid}}/300.jpg
                  @endif" alt="">
                        </div>
                        <div class="carousel-item" style="height: 203px;">
                          <img  src="@if($matchedImageId <= $photoCount)https://photo.hotellook.com/image_v2/limit/h{{$hotelid}}_{{$matchedImageId}}/300.jpg    @else
                   https://photo.hotellook.com/image_v2/limit/h{{$hotelid}}_{{$rtp->imageid}}/300.jpg
                  @endif" alt="">
                        </div>
                      </div>
                      <!-- Left and right controls/icons -->
                      <button class="carousel-control-prev" type="button" data-bs-target="#roomSlider1"
                        data-bs-slide="prev"><span class="carousel-control-prev-icon"></span></button>
                      <button class="carousel-control-next" type="button" data-bs-target="#roomSlider1"
                        data-bs-slide="next"><span class="carousel-control-next-icon"></span></button>
                    </div>
                  </div>
                  <div class="tr-hotel-deatil">
                    <h2>{{ $keys }}</h2>
                    <div class="tr-hotel-location">215.0 sq.ft · City view</div>
                    <ul class="tr-desktop">
                      <?php // return print_r($value);?>
                      @foreach($value as $key=>$val)
                      @if($key == 'breakfast' && $val != '')
                      <li><svg width="16" height="16" viewBox="0 0 16 16" fill="none"
                          xmlns="http://www.w3.org/2000/svg">
                          <path
                            d="M2.13994 1.40332L13.7907 13.054C14.0117 13.2751 14.1359 13.575 14.1359 13.8876C14.1359 14.2003 14.0117 14.5001 13.7907 14.7212C13.5695 14.9422 13.2697 15.0663 12.9571 15.0663C12.6445 15.0663 12.3446 14.9422 12.1235 14.7212L9.27748 11.8261C9.09123 11.637 8.98675 11.3823 8.98655 11.1168V10.942C8.98658 10.8079 8.95998 10.6752 8.9083 10.5516C8.85662 10.4279 8.78089 10.3158 8.68551 10.2216L8.31805 9.8823C8.19331 9.7672 8.04162 9.68532 7.87695 9.64421C7.71227 9.60309 7.5399 9.60406 7.3757 9.64702C7.11676 9.7146 6.84465 9.7133 6.58638 9.64324C6.3281 9.57318 6.09264 9.43679 5.90335 9.24763L3.20183 6.54579C1.59919 4.94316 1.00943 2.52308 2.13994 1.40332Z"
                            stroke="#222222" stroke-linejoin="round" />
                          <path
                            d="M12.9728 0.905273L10.5299 3.34812C10.342 3.53606 10.1929 3.75919 10.0911 4.00476C9.98938 4.25034 9.93702 4.51355 9.93702 4.77936V5.24927C9.93703 5.31576 9.92394 5.38159 9.89849 5.44302C9.87304 5.50444 9.83574 5.56024 9.78871 5.60724L9.43106 5.96489M10.443 6.97682L10.8006 6.61917C10.8476 6.57214 10.9034 6.53483 10.9649 6.50939C11.0263 6.48394 11.0921 6.47084 11.1586 6.47086H11.6285C11.8943 6.47086 12.1575 6.41849 12.4031 6.31676C12.6487 6.21502 12.8718 6.06591 13.0598 5.87793L15.5026 3.43508M14.2377 2.17018L11.7079 4.69999M6.64827 11.5305L3.49486 14.7016C3.25766 14.9387 2.93598 15.0719 2.60057 15.0719C2.26516 15.0719 1.94349 14.9387 1.70628 14.7016C1.46915 14.4644 1.33594 14.1427 1.33594 13.8073C1.33594 13.4719 1.46915 13.1502 1.70628 12.913L4.37144 10.2656"
                            stroke="#222222" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>Breakfast included</li>
                      @endif
						  @if($key == 'privateBathroom' && $val != '')
                      <li><svg width="16" height="16" viewBox="0 0 16 16" fill="none"
                          xmlns="http://www.w3.org/2000/svg">
                          <path
                            d="M2.13994 1.40332L13.7907 13.054C14.0117 13.2751 14.1359 13.575 14.1359 13.8876C14.1359 14.2003 14.0117 14.5001 13.7907 14.7212C13.5695 14.9422 13.2697 15.0663 12.9571 15.0663C12.6445 15.0663 12.3446 14.9422 12.1235 14.7212L9.27748 11.8261C9.09123 11.637 8.98675 11.3823 8.98655 11.1168V10.942C8.98658 10.8079 8.95998 10.6752 8.9083 10.5516C8.85662 10.4279 8.78089 10.3158 8.68551 10.2216L8.31805 9.8823C8.19331 9.7672 8.04162 9.68532 7.87695 9.64421C7.71227 9.60309 7.5399 9.60406 7.3757 9.64702C7.11676 9.7146 6.84465 9.7133 6.58638 9.64324C6.3281 9.57318 6.09264 9.43679 5.90335 9.24763L3.20183 6.54579C1.59919 4.94316 1.00943 2.52308 2.13994 1.40332Z"
                            stroke="#222222" stroke-linejoin="round" />
                          <path
                            d="M12.9728 0.905273L10.5299 3.34812C10.342 3.53606 10.1929 3.75919 10.0911 4.00476C9.98938 4.25034 9.93702 4.51355 9.93702 4.77936V5.24927C9.93703 5.31576 9.92394 5.38159 9.89849 5.44302C9.87304 5.50444 9.83574 5.56024 9.78871 5.60724L9.43106 5.96489M10.443 6.97682L10.8006 6.61917C10.8476 6.57214 10.9034 6.53483 10.9649 6.50939C11.0263 6.48394 11.0921 6.47084 11.1586 6.47086H11.6285C11.8943 6.47086 12.1575 6.41849 12.4031 6.31676C12.6487 6.21502 12.8718 6.06591 13.0598 5.87793L15.5026 3.43508M14.2377 2.17018L11.7079 4.69999M6.64827 11.5305L3.49486 14.7016C3.25766 14.9387 2.93598 15.0719 2.60057 15.0719C2.26516 15.0719 1.94349 14.9387 1.70628 14.7016C1.46915 14.4644 1.33594 14.1427 1.33594 13.8073C1.33594 13.4719 1.46915 13.1502 1.70628 12.913L4.37144 10.2656"
                            stroke="#222222" stroke-linecap="round" stroke-linejoin="round" />
                        </svg> Private Bathroom</li>

                      @endif
                      @if($key == 'Free Cancellation' && $val != '')
                      <li><svg width="16" height="16" viewBox="0 0 16 16" fill="none"
                          xmlns="http://www.w3.org/2000/svg">
                          <path
                            d="M2.13994 1.40332L13.7907 13.054C14.0117 13.2751 14.1359 13.575 14.1359 13.8876C14.1359 14.2003 14.0117 14.5001 13.7907 14.7212C13.5695 14.9422 13.2697 15.0663 12.9571 15.0663C12.6445 15.0663 12.3446 14.9422 12.1235 14.7212L9.27748 11.8261C9.09123 11.637 8.98675 11.3823 8.98655 11.1168V10.942C8.98658 10.8079 8.95998 10.6752 8.9083 10.5516C8.85662 10.4279 8.78089 10.3158 8.68551 10.2216L8.31805 9.8823C8.19331 9.7672 8.04162 9.68532 7.87695 9.64421C7.71227 9.60309 7.5399 9.60406 7.3757 9.64702C7.11676 9.7146 6.84465 9.7133 6.58638 9.64324C6.3281 9.57318 6.09264 9.43679 5.90335 9.24763L3.20183 6.54579C1.59919 4.94316 1.00943 2.52308 2.13994 1.40332Z"
                            stroke="#222222" stroke-linejoin="round" />
                          <path
                            d="M12.9728 0.905273L10.5299 3.34812C10.342 3.53606 10.1929 3.75919 10.0911 4.00476C9.98938 4.25034 9.93702 4.51355 9.93702 4.77936V5.24927C9.93703 5.31576 9.92394 5.38159 9.89849 5.44302C9.87304 5.50444 9.83574 5.56024 9.78871 5.60724L9.43106 5.96489M10.443 6.97682L10.8006 6.61917C10.8476 6.57214 10.9034 6.53483 10.9649 6.50939C11.0263 6.48394 11.0921 6.47084 11.1586 6.47086H11.6285C11.8943 6.47086 12.1575 6.41849 12.4031 6.31676C12.6487 6.21502 12.8718 6.06591 13.0598 5.87793L15.5026 3.43508M14.2377 2.17018L11.7079 4.69999M6.64827 11.5305L3.49486 14.7016C3.25766 14.9387 2.93598 15.0719 2.60057 15.0719C2.26516 15.0719 1.94349 14.9387 1.70628 14.7016C1.46915 14.4644 1.33594 14.1427 1.33594 13.8073C1.33594 13.4719 1.46915 13.1502 1.70628 12.913L4.37144 10.2656"
                            stroke="#222222" stroke-linecap="round" stroke-linejoin="round" />
                        </svg> Free Cancellation</li>

                      @endif
                      @if($key == 'freeWifi' && $val != '')
                      <li><svg width="16" height="16" viewBox="0 0 16 16" fill="none"
                          xmlns="http://www.w3.org/2000/svg">
                          <path
                            d="M2.13994 1.40332L13.7907 13.054C14.0117 13.2751 14.1359 13.575 14.1359 13.8876C14.1359 14.2003 14.0117 14.5001 13.7907 14.7212C13.5695 14.9422 13.2697 15.0663 12.9571 15.0663C12.6445 15.0663 12.3446 14.9422 12.1235 14.7212L9.27748 11.8261C9.09123 11.637 8.98675 11.3823 8.98655 11.1168V10.942C8.98658 10.8079 8.95998 10.6752 8.9083 10.5516C8.85662 10.4279 8.78089 10.3158 8.68551 10.2216L8.31805 9.8823C8.19331 9.7672 8.04162 9.68532 7.87695 9.64421C7.71227 9.60309 7.5399 9.60406 7.3757 9.64702C7.11676 9.7146 6.84465 9.7133 6.58638 9.64324C6.3281 9.57318 6.09264 9.43679 5.90335 9.24763L3.20183 6.54579C1.59919 4.94316 1.00943 2.52308 2.13994 1.40332Z"
                            stroke="#222222" stroke-linejoin="round" />
                          <path
                            d="M12.9728 0.905273L10.5299 3.34812C10.342 3.53606 10.1929 3.75919 10.0911 4.00476C9.98938 4.25034 9.93702 4.51355 9.93702 4.77936V5.24927C9.93703 5.31576 9.92394 5.38159 9.89849 5.44302C9.87304 5.50444 9.83574 5.56024 9.78871 5.60724L9.43106 5.96489M10.443 6.97682L10.8006 6.61917C10.8476 6.57214 10.9034 6.53483 10.9649 6.50939C11.0263 6.48394 11.0921 6.47084 11.1586 6.47086H11.6285C11.8943 6.47086 12.1575 6.41849 12.4031 6.31676C12.6487 6.21502 12.8718 6.06591 13.0598 5.87793L15.5026 3.43508M14.2377 2.17018L11.7079 4.69999M6.64827 11.5305L3.49486 14.7016C3.25766 14.9387 2.93598 15.0719 2.60057 15.0719C2.26516 15.0719 1.94349 14.9387 1.70628 14.7016C1.46915 14.4644 1.33594 14.1427 1.33594 13.8073C1.33594 13.4719 1.46915 13.1502 1.70628 12.913L4.37144 10.2656"
                            stroke="#222222" stroke-linecap="round" stroke-linejoin="round" />
                        </svg> Free Wifi</li>
                      @endif

                      @if(isset($val) && $key == 'beds' && is_object($val))

                      @foreach ($val as $bedType => $bedCount)
                      <li><svg width="16" height="16" viewBox="0 0 16 16" fill="none"
                          xmlns="http://www.w3.org/2000/svg">
                          <path
                            d="M2.13994 1.40332L13.7907 13.054C14.0117 13.2751 14.1359 13.575 14.1359 13.8876C14.1359 14.2003 14.0117 14.5001 13.7907 14.7212C13.5695 14.9422 13.2697 15.0663 12.9571 15.0663C12.6445 15.0663 12.3446 14.9422 12.1235 14.7212L9.27748 11.8261C9.09123 11.637 8.98675 11.3823 8.98655 11.1168V10.942C8.98658 10.8079 8.95998 10.6752 8.9083 10.5516C8.85662 10.4279 8.78089 10.3158 8.68551 10.2216L8.31805 9.8823C8.19331 9.7672 8.04162 9.68532 7.87695 9.64421C7.71227 9.60309 7.5399 9.60406 7.3757 9.64702C7.11676 9.7146 6.84465 9.7133 6.58638 9.64324C6.3281 9.57318 6.09264 9.43679 5.90335 9.24763L3.20183 6.54579C1.59919 4.94316 1.00943 2.52308 2.13994 1.40332Z"
                            stroke="#222222" stroke-linejoin="round" />
                          <path
                            d="M12.9728 0.905273L10.5299 3.34812C10.342 3.53606 10.1929 3.75919 10.0911 4.00476C9.98938 4.25034 9.93702 4.51355 9.93702 4.77936V5.24927C9.93703 5.31576 9.92394 5.38159 9.89849 5.44302C9.87304 5.50444 9.83574 5.56024 9.78871 5.60724L9.43106 5.96489M10.443 6.97682L10.8006 6.61917C10.8476 6.57214 10.9034 6.53483 10.9649 6.50939C11.0263 6.48394 11.0921 6.47084 11.1586 6.47086H11.6285C11.8943 6.47086 12.1575 6.41849 12.4031 6.31676C12.6487 6.21502 12.8718 6.06591 13.0598 5.87793L15.5026 3.43508M14.2377 2.17018L11.7079 4.69999M6.64827 11.5305L3.49486 14.7016C3.25766 14.9387 2.93598 15.0719 2.60057 15.0719C2.26516 15.0719 1.94349 14.9387 1.70628 14.7016C1.46915 14.4644 1.33594 14.1427 1.33594 13.8073C1.33594 13.4719 1.46915 13.1502 1.70628 12.913L4.37144 10.2656"
                            stroke="#222222" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                        @if(is_array($bedCount)) @foreach($bedCount as $bdct) {{$bdct}} @if(!$loop->last) , @endif
                        @endforeach @else {{ $bedCount }} @endif @if(isset($bedType)) {{ ucfirst($bedType) }} @endif

                        @if($bedCount == 1) Bed @elseif($bedCount == 0)
                        @else
                        beds
                        @endif

                      </li>

                      @endforeach

                      @endif
                      @if($key == 'refundable' && $val != '')
                      <li><svg width="16" height="16" viewBox="0 0 16 16" fill="none"
                          xmlns="http://www.w3.org/2000/svg">
                          <path
                            d="M2.13994 1.40332L13.7907 13.054C14.0117 13.2751 14.1359 13.575 14.1359 13.8876C14.1359 14.2003 14.0117 14.5001 13.7907 14.7212C13.5695 14.9422 13.2697 15.0663 12.9571 15.0663C12.6445 15.0663 12.3446 14.9422 12.1235 14.7212L9.27748 11.8261C9.09123 11.637 8.98675 11.3823 8.98655 11.1168V10.942C8.98658 10.8079 8.95998 10.6752 8.9083 10.5516C8.85662 10.4279 8.78089 10.3158 8.68551 10.2216L8.31805 9.8823C8.19331 9.7672 8.04162 9.68532 7.87695 9.64421C7.71227 9.60309 7.5399 9.60406 7.3757 9.64702C7.11676 9.7146 6.84465 9.7133 6.58638 9.64324C6.3281 9.57318 6.09264 9.43679 5.90335 9.24763L3.20183 6.54579C1.59919 4.94316 1.00943 2.52308 2.13994 1.40332Z"
                            stroke="#222222" stroke-linejoin="round" />
                          <path
                            d="M12.9728 0.905273L10.5299 3.34812C10.342 3.53606 10.1929 3.75919 10.0911 4.00476C9.98938 4.25034 9.93702 4.51355 9.93702 4.77936V5.24927C9.93703 5.31576 9.92394 5.38159 9.89849 5.44302C9.87304 5.50444 9.83574 5.56024 9.78871 5.60724L9.43106 5.96489M10.443 6.97682L10.8006 6.61917C10.8476 6.57214 10.9034 6.53483 10.9649 6.50939C11.0263 6.48394 11.0921 6.47084 11.1586 6.47086H11.6285C11.8943 6.47086 12.1575 6.41849 12.4031 6.31676C12.6487 6.21502 12.8718 6.06591 13.0598 5.87793L15.5026 3.43508M14.2377 2.17018L11.7079 4.69999M6.64827 11.5305L3.49486 14.7016C3.25766 14.9387 2.93598 15.0719 2.60057 15.0719C2.26516 15.0719 1.94349 14.9387 1.70628 14.7016C1.46915 14.4644 1.33594 14.1427 1.33594 13.8073C1.33594 13.4719 1.46915 13.1502 1.70628 12.913L4.37144 10.2656"
                            stroke="#222222" stroke-linecap="round" stroke-linejoin="round" />
                        </svg> Refundable</li>
                      @endif

                      @if($key == 'deposit' && $val != '' && $val == 1 )
                      <li><svg width="16" height="16" viewBox="0 0 16 16" fill="none"
                          xmlns="http://www.w3.org/2000/svg">
                          <path
                            d="M2.13994 1.40332L13.7907 13.054C14.0117 13.2751 14.1359 13.575 14.1359 13.8876C14.1359 14.2003 14.0117 14.5001 13.7907 14.7212C13.5695 14.9422 13.2697 15.0663 12.9571 15.0663C12.6445 15.0663 12.3446 14.9422 12.1235 14.7212L9.27748 11.8261C9.09123 11.637 8.98675 11.3823 8.98655 11.1168V10.942C8.98658 10.8079 8.95998 10.6752 8.9083 10.5516C8.85662 10.4279 8.78089 10.3158 8.68551 10.2216L8.31805 9.8823C8.19331 9.7672 8.04162 9.68532 7.87695 9.64421C7.71227 9.60309 7.5399 9.60406 7.3757 9.64702C7.11676 9.7146 6.84465 9.7133 6.58638 9.64324C6.3281 9.57318 6.09264 9.43679 5.90335 9.24763L3.20183 6.54579C1.59919 4.94316 1.00943 2.52308 2.13994 1.40332Z"
                            stroke="#222222" stroke-linejoin="round" />
                          <path
                            d="M12.9728 0.905273L10.5299 3.34812C10.342 3.53606 10.1929 3.75919 10.0911 4.00476C9.98938 4.25034 9.93702 4.51355 9.93702 4.77936V5.24927C9.93703 5.31576 9.92394 5.38159 9.89849 5.44302C9.87304 5.50444 9.83574 5.56024 9.78871 5.60724L9.43106 5.96489M10.443 6.97682L10.8006 6.61917C10.8476 6.57214 10.9034 6.53483 10.9649 6.50939C11.0263 6.48394 11.0921 6.47084 11.1586 6.47086H11.6285C11.8943 6.47086 12.1575 6.41849 12.4031 6.31676C12.6487 6.21502 12.8718 6.06591 13.0598 5.87793L15.5026 3.43508M14.2377 2.17018L11.7079 4.69999M6.64827 11.5305L3.49486 14.7016C3.25766 14.9387 2.93598 15.0719 2.60057 15.0719C2.26516 15.0719 1.94349 14.9387 1.70628 14.7016C1.46915 14.4644 1.33594 14.1427 1.33594 13.8073C1.33594 13.4719 1.46915 13.1502 1.70628 12.913L4.37144 10.2656"
                            stroke="#222222" stroke-linecap="round" stroke-linejoin="round" />
                        </svg> Payment directly on the site </li>


                      @endif

                      @if($key == 'deposit' && $val == '' && $val != 1)
                      <li><svg width="16" height="16" viewBox="0 0 16 16" fill="none"
                          xmlns="http://www.w3.org/2000/svg">
                          <path
                            d="M2.13994 1.40332L13.7907 13.054C14.0117 13.2751 14.1359 13.575 14.1359 13.8876C14.1359 14.2003 14.0117 14.5001 13.7907 14.7212C13.5695 14.9422 13.2697 15.0663 12.9571 15.0663C12.6445 15.0663 12.3446 14.9422 12.1235 14.7212L9.27748 11.8261C9.09123 11.637 8.98675 11.3823 8.98655 11.1168V10.942C8.98658 10.8079 8.95998 10.6752 8.9083 10.5516C8.85662 10.4279 8.78089 10.3158 8.68551 10.2216L8.31805 9.8823C8.19331 9.7672 8.04162 9.68532 7.87695 9.64421C7.71227 9.60309 7.5399 9.60406 7.3757 9.64702C7.11676 9.7146 6.84465 9.7133 6.58638 9.64324C6.3281 9.57318 6.09264 9.43679 5.90335 9.24763L3.20183 6.54579C1.59919 4.94316 1.00943 2.52308 2.13994 1.40332Z"
                            stroke="#222222" stroke-linejoin="round" />
                          <path
                            d="M12.9728 0.905273L10.5299 3.34812C10.342 3.53606 10.1929 3.75919 10.0911 4.00476C9.98938 4.25034 9.93702 4.51355 9.93702 4.77936V5.24927C9.93703 5.31576 9.92394 5.38159 9.89849 5.44302C9.87304 5.50444 9.83574 5.56024 9.78871 5.60724L9.43106 5.96489M10.443 6.97682L10.8006 6.61917C10.8476 6.57214 10.9034 6.53483 10.9649 6.50939C11.0263 6.48394 11.0921 6.47084 11.1586 6.47086H11.6285C11.8943 6.47086 12.1575 6.41849 12.4031 6.31676C12.6487 6.21502 12.8718 6.06591 13.0598 5.87793L15.5026 3.43508M14.2377 2.17018L11.7079 4.69999M6.64827 11.5305L3.49486 14.7016C3.25766 14.9387 2.93598 15.0719 2.60057 15.0719C2.26516 15.0719 1.94349 14.9387 1.70628 14.7016C1.46915 14.4644 1.33594 14.1427 1.33594 13.8073C1.33594 13.4719 1.46915 13.1502 1.70628 12.913L4.37144 10.2656"
                            stroke="#222222" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>Reserve Now, Pay Later</li>

                      @endif
                      @if($key == 'viewSentence')
                      <li><svg width="16" height="16" viewBox="0 0 16 16" fill="none"
                          xmlns="http://www.w3.org/2000/svg">
                          <path
                            d="M2.13994 1.40332L13.7907 13.054C14.0117 13.2751 14.1359 13.575 14.1359 13.8876C14.1359 14.2003 14.0117 14.5001 13.7907 14.7212C13.5695 14.9422 13.2697 15.0663 12.9571 15.0663C12.6445 15.0663 12.3446 14.9422 12.1235 14.7212L9.27748 11.8261C9.09123 11.637 8.98675 11.3823 8.98655 11.1168V10.942C8.98658 10.8079 8.95998 10.6752 8.9083 10.5516C8.85662 10.4279 8.78089 10.3158 8.68551 10.2216L8.31805 9.8823C8.19331 9.7672 8.04162 9.68532 7.87695 9.64421C7.71227 9.60309 7.5399 9.60406 7.3757 9.64702C7.11676 9.7146 6.84465 9.7133 6.58638 9.64324C6.3281 9.57318 6.09264 9.43679 5.90335 9.24763L3.20183 6.54579C1.59919 4.94316 1.00943 2.52308 2.13994 1.40332Z"
                            stroke="#222222" stroke-linejoin="round" />
                          <path
                            d="M12.9728 0.905273L10.5299 3.34812C10.342 3.53606 10.1929 3.75919 10.0911 4.00476C9.98938 4.25034 9.93702 4.51355 9.93702 4.77936V5.24927C9.93703 5.31576 9.92394 5.38159 9.89849 5.44302C9.87304 5.50444 9.83574 5.56024 9.78871 5.60724L9.43106 5.96489M10.443 6.97682L10.8006 6.61917C10.8476 6.57214 10.9034 6.53483 10.9649 6.50939C11.0263 6.48394 11.0921 6.47084 11.1586 6.47086H11.6285C11.8943 6.47086 12.1575 6.41849 12.4031 6.31676C12.6487 6.21502 12.8718 6.06591 13.0598 5.87793L15.5026 3.43508M14.2377 2.17018L11.7079 4.69999M6.64827 11.5305L3.49486 14.7016C3.25766 14.9387 2.93598 15.0719 2.60057 15.0719C2.26516 15.0719 1.94349 14.9387 1.70628 14.7016C1.46915 14.4644 1.33594 14.1427 1.33594 13.8073C1.33594 13.4719 1.46915 13.1502 1.70628 12.913L4.37144 10.2656"
                            stroke="#222222" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>{{$val}}</li>
                      @endif
                      @if($key == 'available')
                     
                      <li><svg width="16" height="16" viewBox="0 0 16 16" fill="none"
                          xmlns="http://www.w3.org/2000/svg">
                          <path
                            d="M2.13994 1.40332L13.7907 13.054C14.0117 13.2751 14.1359 13.575 14.1359 13.8876C14.1359 14.2003 14.0117 14.5001 13.7907 14.7212C13.5695 14.9422 13.2697 15.0663 12.9571 15.0663C12.6445 15.0663 12.3446 14.9422 12.1235 14.7212L9.27748 11.8261C9.09123 11.637 8.98675 11.3823 8.98655 11.1168V10.942C8.98658 10.8079 8.95998 10.6752 8.9083 10.5516C8.85662 10.4279 8.78089 10.3158 8.68551 10.2216L8.31805 9.8823C8.19331 9.7672 8.04162 9.68532 7.87695 9.64421C7.71227 9.60309 7.5399 9.60406 7.3757 9.64702C7.11676 9.7146 6.84465 9.7133 6.58638 9.64324C6.3281 9.57318 6.09264 9.43679 5.90335 9.24763L3.20183 6.54579C1.59919 4.94316 1.00943 2.52308 2.13994 1.40332Z"
                            stroke="#222222" stroke-linejoin="round" />
                          <path
                            d="M12.9728 0.905273L10.5299 3.34812C10.342 3.53606 10.1929 3.75919 10.0911 4.00476C9.98938 4.25034 9.93702 4.51355 9.93702 4.77936V5.24927C9.93703 5.31576 9.92394 5.38159 9.89849 5.44302C9.87304 5.50444 9.83574 5.56024 9.78871 5.60724L9.43106 5.96489M10.443 6.97682L10.8006 6.61917C10.8476 6.57214 10.9034 6.53483 10.9649 6.50939C11.0263 6.48394 11.0921 6.47084 11.1586 6.47086H11.6285C11.8943 6.47086 12.1575 6.41849 12.4031 6.31676C12.6487 6.21502 12.8718 6.06591 13.0598 5.87793L15.5026 3.43508M14.2377 2.17018L11.7079 4.69999M6.64827 11.5305L3.49486 14.7016C3.25766 14.9387 2.93598 15.0719 2.60057 15.0719C2.26516 15.0719 1.94349 14.9387 1.70628 14.7016C1.46915 14.4644 1.33594 14.1427 1.33594 13.8073C1.33594 13.4719 1.46915 13.1502 1.70628 12.913L4.37144 10.2656"
                            stroke="#222222" stroke-linecap="round" stroke-linejoin="round" />
                        </svg> 
                      
                        @if(is_array($val))
                        @foreach($val as $vals){{$vals}} @if($loop->last)   Rooms  @endif @if(!$loop->last)  , @endif
                        @endforeach 
                        @else 
                        {{$val}} @if($val == 1) Room @else Rooms @endif
                        @endif Available</li>
                        @endif
                      @if($key == 'balcony' && $val ==1)
                      <li><svg width="16" height="16" viewBox="0 0 16 16" fill="none"
                          xmlns="http://www.w3.org/2000/svg">
                          <path
                            d="M2.13994 1.40332L13.7907 13.054C14.0117 13.2751 14.1359 13.575 14.1359 13.8876C14.1359 14.2003 14.0117 14.5001 13.7907 14.7212C13.5695 14.9422 13.2697 15.0663 12.9571 15.0663C12.6445 15.0663 12.3446 14.9422 12.1235 14.7212L9.27748 11.8261C9.09123 11.637 8.98675 11.3823 8.98655 11.1168V10.942C8.98658 10.8079 8.95998 10.6752 8.9083 10.5516C8.85662 10.4279 8.78089 10.3158 8.68551 10.2216L8.31805 9.8823C8.19331 9.7672 8.04162 9.68532 7.87695 9.64421C7.71227 9.60309 7.5399 9.60406 7.3757 9.64702C7.11676 9.7146 6.84465 9.7133 6.58638 9.64324C6.3281 9.57318 6.09264 9.43679 5.90335 9.24763L3.20183 6.54579C1.59919 4.94316 1.00943 2.52308 2.13994 1.40332Z"
                            stroke="#222222" stroke-linejoin="round" />
                          <path
                            d="M12.9728 0.905273L10.5299 3.34812C10.342 3.53606 10.1929 3.75919 10.0911 4.00476C9.98938 4.25034 9.93702 4.51355 9.93702 4.77936V5.24927C9.93703 5.31576 9.92394 5.38159 9.89849 5.44302C9.87304 5.50444 9.83574 5.56024 9.78871 5.60724L9.43106 5.96489M10.443 6.97682L10.8006 6.61917C10.8476 6.57214 10.9034 6.53483 10.9649 6.50939C11.0263 6.48394 11.0921 6.47084 11.1586 6.47086H11.6285C11.8943 6.47086 12.1575 6.41849 12.4031 6.31676C12.6487 6.21502 12.8718 6.06591 13.0598 5.87793L15.5026 3.43508M14.2377 2.17018L11.7079 4.69999M6.64827 11.5305L3.49486 14.7016C3.25766 14.9387 2.93598 15.0719 2.60057 15.0719C2.26516 15.0719 1.94349 14.9387 1.70628 14.7016C1.46915 14.4644 1.33594 14.1427 1.33594 13.8073C1.33594 13.4719 1.46915 13.1502 1.70628 12.913L4.37144 10.2656"
                            stroke="#222222" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>Balcony</li>

                      @endif

                      @if($key == 'refundable' && $val ==1)
                      <li><svg width="16" height="16" viewBox="0 0 16 16" fill="none"
                          xmlns="http://www.w3.org/2000/svg">
                          <path
                            d="M2.13994 1.40332L13.7907 13.054C14.0117 13.2751 14.1359 13.575 14.1359 13.8876C14.1359 14.2003 14.0117 14.5001 13.7907 14.7212C13.5695 14.9422 13.2697 15.0663 12.9571 15.0663C12.6445 15.0663 12.3446 14.9422 12.1235 14.7212L9.27748 11.8261C9.09123 11.637 8.98675 11.3823 8.98655 11.1168V10.942C8.98658 10.8079 8.95998 10.6752 8.9083 10.5516C8.85662 10.4279 8.78089 10.3158 8.68551 10.2216L8.31805 9.8823C8.19331 9.7672 8.04162 9.68532 7.87695 9.64421C7.71227 9.60309 7.5399 9.60406 7.3757 9.64702C7.11676 9.7146 6.84465 9.7133 6.58638 9.64324C6.3281 9.57318 6.09264 9.43679 5.90335 9.24763L3.20183 6.54579C1.59919 4.94316 1.00943 2.52308 2.13994 1.40332Z"
                            stroke="#222222" stroke-linejoin="round" />
                          <path
                            d="M12.9728 0.905273L10.5299 3.34812C10.342 3.53606 10.1929 3.75919 10.0911 4.00476C9.98938 4.25034 9.93702 4.51355 9.93702 4.77936V5.24927C9.93703 5.31576 9.92394 5.38159 9.89849 5.44302C9.87304 5.50444 9.83574 5.56024 9.78871 5.60724L9.43106 5.96489M10.443 6.97682L10.8006 6.61917C10.8476 6.57214 10.9034 6.53483 10.9649 6.50939C11.0263 6.48394 11.0921 6.47084 11.1586 6.47086H11.6285C11.8943 6.47086 12.1575 6.41849 12.4031 6.31676C12.6487 6.21502 12.8718 6.06591 13.0598 5.87793L15.5026 3.43508M14.2377 2.17018L11.7079 4.69999M6.64827 11.5305L3.49486 14.7016C3.25766 14.9387 2.93598 15.0719 2.60057 15.0719C2.26516 15.0719 1.94349 14.9387 1.70628 14.7016C1.46915 14.4644 1.33594 14.1427 1.33594 13.8073C1.33594 13.4719 1.46915 13.1502 1.70628 12.913L4.37144 10.2656"
                            stroke="#222222" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>Card Required</li>
                      @endif

                      @endforeach

                    </ul>
                    <ul class="tr-mobile">
                      <li><svg width="16" height="17" viewBox="0 0 16 17" fill="none"
                          xmlns="http://www.w3.org/2000/svg">
                          <path d="M13.3385 4.30908L6.00521 11.6424L2.67188 8.30908" stroke="#222222"
                            stroke-linecap="round" stroke-linejoin="round"></path>
                        </svg>Air conditioning</li>
                      <li><svg width="16" height="17" viewBox="0 0 16 17" fill="none"
                          xmlns="http://www.w3.org/2000/svg">
                          <path d="M13.3385 4.30908L6.00521 11.6424L2.67188 8.30908" stroke="#222222"
                            stroke-linecap="round" stroke-linejoin="round"></path>
                        </svg>Heating</li>
                    </ul>
                  </div>
                  <div class="tr-hotel-price-lists">
                    <ul>
                      <?php  

                      $modikeys = str_replace(' ', '-', $keys);  
                      $modikeys = str_replace(['(', ')'], '', $modikeys); 

                      ?>
                      <span class="hotelroomprice-{{$modikeys}}">
                       
                      </span>
                     
                    </ul>
                    <button class="tr-show-all">Show all</button>
                  </div>
                </div>
                @endforeach
                @else
                not available.
                @endif
           
              @if($countRoomdescKeys1 >2)
                <div class="tr-show-all">
                  <button type="button" class="tr-anchor-btn" id="firstShowMoreHotel" value="3 more options available">{{$countRoomdescKeys}}
                    more options available</button>
                  <button type="button" class="tr-anchor-btn" id="firstShowLessHotel"
                    value="show less options available">Show less options available</button>
                </div>
              @endif
              </div>


            </div>
            <!--ROOM SECTION - END-->

            <!--FACILITIES SECTION - START-->
            <div class="tr-facilities-section tr-tab-section" id="amenitiesTab">
              <h3>Facilities</h3>
              <?php

       
          $popamenities = [
            "City view" => "City view",
            "Lake view" => "Lake view",
            "Mountain view" => "Mountain view",
            "River view" => "River view",
            "Sea view" => "Sea view",
            "View" => "View",
            "Apartments" => "Apartments",
            "Garden" => "Garden",
            "Pets allowed" => "Pets allowed",
            "Swimming Pool" => "Swimming Pool",
            "Outdoor Swimming Pool" => "Outdoor Swimming Pool",
            "Free WiFi" => "Free WiFi",
            "Air conditioning" => "Air conditioning",
            "24-hour front desk" => "24-hour front desk",
            "Free parking" => "Free parking",
            "Car parking" => "Parking",
            "parking" => "Parking",
            "Parking on site" => "Parking on site",
            "Shuttle service (free)" => "Shuttle service (free)",
            "Airport shuttle (free)" => "Airport shuttle (free)",
            "Key card access" => "Key card access",
            "Balcony" => "Balcony",
            "Luggage storage" => "Luggage storage",
            "Non-smoking rooms" => "Non-smoking rooms",
            "Terrace" => "Terrace",
            "BBQ facilities" => "BBQ facilities",
            "Bath" => "Bath",
            "Daily housekeeping" => "Daily housekeeping",
            "Entire apartment" => "Entire apartment",
            "Entire home" => "Entire home",
            "Facilities for disabled guests" => "Facilities for disabled guests",
            "Grocery deliveries" => "Grocery deliveries",
            "Heating" => "Heating",
            "Kitchen" => "Kitchen",
            "Lift" => "Lift",
            "Private bathroom" => "Private bathroom",
            "Safety deposit box" => "Safety deposit box",
            "Sauna" => "Sauna",
            "Washing machine" => "Washing machine",
            "Laundry service" => "Laundry service",
            "Laundry" => "Laundry service",
           
        ];

       
    

          $room_string = $searchresult[0]->room_aminities; 
          $amenitiesString = $searchresult[0]->amenities; 
          $shortFacilities = json_decode($searchresult[0]->shortFacilities);
                
       
          $availableAmenities = [];
          if($amenitiesString !=""){
          
            $amenities = array_map('trim', explode(',', $amenitiesString));
             foreach ($amenities as $amenity) {
              if (isset($popamenities[$amenity])) {
                  $availableAmenities[$amenity] = $popamenities[$amenity];
              }
             }
          }
          $flroom_aminities ="";
            if (!function_exists('is_json_string')) {
            function is_json_string($string) {
                return is_string($string) && is_array(json_decode($string, true)) && (json_last_error() == JSON_ERROR_NONE);
            }
        }
        
        // Now you can use is_json_string() safely
        if (!is_json_string($room_string)) {
            $flroom_aminities = $searchresult[0]->room_aminities;
        }
          $availableAmenities_room = [];
          if($room_string !=""){          
            $room_amenity = array_map('trim', explode(',', $flroom_aminities));
            $popamenities_lower = array_change_key_case($popamenities, CASE_LOWER);         
            foreach ($room_amenity as $amr) {
                $amr_lower = strtolower($amr); 
                if (isset($popamenities_lower[$amr_lower])) {                
                    $availableAmenities_room[$amr_lower] = $popamenities_lower[$amr_lower];
                }
             }
           
          }
          
    
          
         $short_fac_avail= [];          
          $popamenities_lower = array_change_key_case($popamenities, CASE_LOWER);  
          if(!empty($shortFacilities)) {
             foreach ($shortFacilities as $sf) {
              $sf_lower = strtolower($sf); 
              if (isset($popamenities_lower[$sf_lower])) {                
                  $short_fac_avail[$sf_lower] = $popamenities_lower[$sf_lower];
              }
          }
          }   
       
          $mergedAmenities = array_unique(array_merge($availableAmenities_room, $availableAmenities));
          $amenities_array = array_unique(array_merge($mergedAmenities, $short_fac_avail));
          $room_amenity1 =[];
          $amenities2 =[];
          $room_amenity1 = $searchresult[0]->room_aminities; 
          $amenities2 = $searchresult[0]->amenities;
        
     
            ?>
              <div class="tr-facilities-details">
                @if(!empty($amenities_array))
                <ul class="tr-facilities-box-lists">
                  @foreach ($amenities_array as $mnt)

                  @if($mnt =="Free WiFi" || $mnt == "Wi-Fi in public areas")
                  <li>
                    <svg width="25" height="25" viewBox="0 0 25 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                      <path
                        d="M6.93879 7.76202C7.47417 6.46926 8.74762 5.56152 10.2318 5.56152C11.716 5.56152 12.9895 6.46926 13.5248 7.76202C13.6437 8.04903 13.9727 8.18535 14.2597 8.06649C14.5468 7.94762 14.6831 7.61859 14.5642 7.33156C13.8608 5.63307 12.1867 4.43652 10.2318 4.43652C8.27692 4.43652 6.6028 5.63307 5.89939 7.33156C5.78053 7.61859 5.91685 7.94762 6.20387 8.06649C6.49089 8.18535 6.81992 8.04903 6.93879 7.76202Z"
                        fill="#222222" />
                      <path
                        d="M6.41895 14.749C6.41895 15.1632 6.08316 15.499 5.66895 15.499C5.25474 15.499 4.91895 15.1632 4.91895 14.749C4.91895 14.3348 5.25474 13.999 5.66895 13.999C6.08316 13.999 6.41895 14.3348 6.41895 14.749Z"
                        fill="#222222" />
                      <path
                        d="M8.66895 14.749C8.66895 15.1632 8.33316 15.499 7.91895 15.499C7.50474 15.499 7.16895 15.1632 7.16895 14.749C7.16895 14.3348 7.50474 13.999 7.91895 13.999C8.33316 13.999 8.66895 14.3348 8.66895 14.749Z"
                        fill="#222222" />
                      <path
                        d="M11.1064 14.749C11.1064 14.4384 11.3583 14.1865 11.6689 14.1865H14.6689C14.9796 14.1865 15.2314 14.4384 15.2314 14.749C15.2314 15.0597 14.9796 15.3115 14.6689 15.3115H11.6689C11.3583 15.3115 11.1064 15.0597 11.1064 14.749Z"
                        fill="#222222" />
                      <path fill-rule="evenodd" clip-rule="evenodd"
                        d="M3.13987 6.01073C3.4096 5.8566 3.75321 5.95031 3.90734 6.22004L6.74538 11.1866H13.5925L16.4305 6.22004C16.5847 5.95031 16.9283 5.8566 17.198 6.01073C17.4677 6.16487 17.5615 6.50847 17.4073 6.77819L14.8882 11.1867C15.4826 11.1871 15.9841 11.192 16.3898 11.2465C16.8607 11.3098 17.2858 11.4491 17.6273 11.7907C17.9689 12.1323 18.1082 12.5574 18.1715 13.0282C18.2315 13.4743 18.2314 14.0362 18.2314 14.7101V14.7881C18.2314 15.462 18.2315 16.0239 18.1715 16.47C18.1082 16.9408 17.9689 17.3659 17.6273 17.7075C17.2858 18.0491 16.8607 18.1884 16.3898 18.2517C15.9438 18.3117 15.3819 18.3116 14.7081 18.3116H5.62995C4.95616 18.3116 4.39414 18.3117 3.94809 18.2517C3.47724 18.1884 3.05214 18.0491 2.71054 17.7075C2.36894 17.3659 2.22969 16.9408 2.16638 16.47C2.10641 16.0239 2.10642 15.462 2.10645 14.7881V14.7101C2.10642 14.0362 2.10641 13.4743 2.16638 13.0282C2.22969 12.5574 2.36894 12.1323 2.71054 11.7907C3.05214 11.4491 3.47724 11.3098 3.94809 11.2465C4.35379 11.192 4.85529 11.1871 5.44968 11.1867L2.93056 6.77819C2.77643 6.50847 2.87014 6.16487 3.13987 6.01073ZM13.908 12.3116C13.915 12.3118 13.9219 12.3118 13.9288 12.3116H14.6689C15.3919 12.3116 15.8776 12.3128 16.2399 12.3615C16.586 12.4081 16.7341 12.4885 16.8319 12.5862C16.9296 12.6839 17.01 12.832 17.0566 13.1782C17.1052 13.5404 17.1064 14.0261 17.1064 14.7491C17.1064 15.4721 17.1052 15.9578 17.0566 16.3201C17.01 16.6662 16.9296 16.8143 16.8319 16.912C16.7341 17.0098 16.586 17.0902 16.2399 17.1367C15.8776 17.1854 15.3919 17.1866 14.6689 17.1866H5.66895C4.94594 17.1866 4.46027 17.1854 4.098 17.1367C3.75189 17.0902 3.60378 17.0098 3.50604 16.912C3.4083 16.8143 3.32788 16.6662 3.28135 16.3201C3.23265 15.9578 3.23145 15.4721 3.23145 14.7491C3.23145 14.0261 3.23265 13.5404 3.28135 13.1782C3.32788 12.832 3.4083 12.6839 3.50604 12.5862C3.60378 12.4885 3.75189 12.4081 4.098 12.3615C4.46027 12.3128 4.94594 12.3116 5.66895 12.3116H6.40907C6.416 12.3118 6.42293 12.3118 6.42987 12.3116H13.908Z"
                        fill="#222222" />
                      <path
                        d="M10.2356 7.43652C9.46876 7.43652 8.82009 7.94835 8.61532 8.65017C8.5283 8.9484 8.21599 9.11961 7.91777 9.03258C7.61955 8.94556 7.44834 8.63325 7.53536 8.33503C7.87641 7.16629 8.95539 6.31152 10.2356 6.31152C11.5157 6.31152 12.5947 7.16629 12.9357 8.33503C13.0227 8.63325 12.8515 8.94556 12.5533 9.03258C12.2551 9.11961 11.9428 8.9484 11.8558 8.65017C11.651 7.94835 11.0023 7.43652 10.2356 7.43652Z"
                        fill="#222222" />
                      <path
                        d="M10.2314 9.49902C10.6457 9.49902 10.9814 9.16323 10.9814 8.74902C10.9814 8.33481 10.6457 7.99902 10.2314 7.99902C9.81722 7.99902 9.48145 8.33481 9.48145 8.74902C9.48145 9.16323 9.81722 9.49902 10.2314 9.49902Z"
                        fill="#222222" />
                    </svg>
                    <div class="tr-sub-title">Free Wifi</div>
                  </li>
                  @elseif($mnt =="Car parking" || $mnt =="parking")
                  <li>
                    <svg width="25" height="25" viewBox="0 0 25 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                      <path
                        d="M17.3882 4.49902H4.94379C3.96195 4.49902 3.16602 5.29496 3.16602 6.2768V18.7212C3.16602 19.7031 3.96195 20.499 4.94379 20.499H17.3882C18.3701 20.499 19.166 19.7031 19.166 18.7212V6.2768C19.166 5.29496 18.3701 4.49902 17.3882 4.49902Z"
                        stroke="#222222" stroke-linecap="round" stroke-linejoin="round" />
                      <path
                        d="M8.50195 16.9426V8.05371H12.0575C12.7648 8.05371 13.443 8.33466 13.9431 8.83476C14.4432 9.33486 14.7242 10.0131 14.7242 10.7204C14.7242 11.4276 14.4432 12.1059 13.9431 12.606C13.443 13.1061 12.7648 13.387 12.0575 13.387H8.50195"
                        stroke="#222222" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                    <div class="tr-sub-title">Parking</div>
                  </li>
                  @elseif($mnt =="Restaurant/cafe")
                  <li>
                    <svg width="25" height="25" viewBox="0 0 25 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                      <path
                        d="M5.1398 5.09668L19.1207 19.0775C19.386 19.3428 19.535 19.7027 19.535 20.0778C19.535 20.453 19.386 20.8128 19.1207 21.0781C18.8553 21.3433 18.4955 21.4923 18.1204 21.4923C17.7452 21.4923 17.3854 21.3433 17.1201 21.0781L13.7049 17.6041C13.4814 17.3771 13.356 17.0714 13.3557 16.7529V16.5431C13.3558 16.3822 13.3239 16.223 13.2618 16.0746C13.1998 15.9262 13.1089 15.7916 12.9945 15.6786L12.5535 15.2714C12.4038 15.1333 12.2218 15.0351 12.0242 14.9857C11.8266 14.9364 11.6198 14.9376 11.4227 14.9891C11.112 15.0702 10.7855 15.0687 10.4755 14.9846C10.1656 14.9005 9.88304 14.7368 9.65589 14.5098L6.41407 11.2676C4.4909 9.34448 3.78319 6.44039 5.1398 5.09668Z"
                        stroke="#222222" stroke-width="1.2" stroke-linejoin="round" />
                      <path
                        d="M18.1361 4.49902L15.2047 7.43044C14.9791 7.65597 14.8002 7.92372 14.6781 8.21841C14.556 8.5131 14.4932 8.82895 14.4932 9.14793V9.71182C14.4932 9.79161 14.4775 9.87061 14.4469 9.94432C14.4164 10.018 14.3716 10.085 14.3152 10.1414L13.886 10.5706M15.1003 11.7849L15.5295 11.3557C15.5859 11.2993 15.6529 11.2545 15.7266 11.224C15.8003 11.1934 15.8793 11.1777 15.9591 11.1777H16.523C16.8419 11.1777 17.1578 11.1149 17.4525 10.9928C17.7472 10.8707 18.0149 10.6918 18.2405 10.4662L21.1719 7.5348M19.654 6.01691L16.6182 9.05268M10.5467 17.2493L6.76258 21.0546C6.47794 21.3392 6.09193 21.499 5.68944 21.499C5.28695 21.499 4.90094 21.3392 4.61629 21.0546C4.33173 20.77 4.17188 20.384 4.17188 19.9815C4.17188 19.579 4.33173 19.193 4.61629 18.9083L7.81448 15.7314"
                        stroke="#222222" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                    <div class="tr-sub-title">Restaurant</div>
                  </li>
                  @elseif($mnt =="Bar")
                  <li>
                    <svg width="25" height="25" viewBox="0 0 25 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                      <path
                        d="M8.97692 20.499V19.499H11.7849V14.976C10.3516 14.756 9.22392 14.131 8.40192 13.101C7.58059 12.0717 7.16992 10.871 7.16992 9.49902V4.49902H17.3999V9.49902C17.3999 10.871 16.9893 12.0717 16.1679 13.101C15.3459 14.1304 14.2183 14.7554 12.7849 14.976V19.499H15.5929V20.499H8.97692ZM8.16992 8.99902H16.3999V5.49902H8.16992V8.99902Z"
                        fill="#222222" />
                    </svg>
                    <div class="tr-sub-title">Bar/Lounge</div>
                  </li>
                  @elseif($mnt =="Swimming Pool")
                  <li>
                    <svg width="25" height="25" viewBox="0 0 25 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                      <path
                        d="M18.0865 5.25393C18.4133 5.25393 18.7267 5.38614 18.9577 5.62148C19.1887 5.85682 19.3185 6.17601 19.3185 6.50883V7.13628C19.3185 7.30269 19.3834 7.46229 19.499 7.57996C19.6145 7.69763 19.7712 7.76374 19.9345 7.76374C20.0979 7.76374 20.2546 7.69763 20.3701 7.57996C20.4856 7.46229 20.5505 7.30269 20.5505 7.13628V6.50883C20.5505 5.84319 20.2909 5.20481 19.8289 4.73413C19.3668 4.26345 18.74 3.99902 18.0865 3.99902C17.4331 3.99902 16.8063 4.26345 16.3442 4.73413C15.8821 5.20481 15.6225 5.84319 15.6225 6.50883V9.64609H9.46256V6.50883C9.46256 6.17601 9.59236 5.85682 9.82341 5.62148C10.0545 5.38614 10.3678 5.25393 10.6946 5.25393C11.0213 5.25393 11.3347 5.38614 11.5657 5.62148C11.7968 5.85682 11.9266 6.17601 11.9266 6.50883V7.13628C11.9266 7.30269 11.9915 7.46229 12.107 7.57996C12.2225 7.69763 12.3792 7.76374 12.5426 7.76374C12.7059 7.76374 12.8626 7.69763 12.9781 7.57996C13.0937 7.46229 13.1586 7.30269 13.1586 7.13628V6.50883C13.1586 5.84319 12.899 5.20481 12.4369 4.73413C11.9748 4.26345 11.3481 3.99902 10.6946 3.99902C10.0411 3.99902 9.41434 4.26345 8.95225 4.73413C8.49016 5.20481 8.23057 5.84319 8.23057 6.50883V13.9241C8.63695 14.0003 9.04934 14.0385 9.46256 14.0383V10.901H15.6225V12.0731C16.0279 11.9755 16.4396 11.908 16.8545 11.871V6.50883C16.8545 6.17601 16.9843 5.85682 17.2154 5.62148C17.4464 5.38614 17.7598 5.25393 18.0865 5.25393ZM20.1427 14.8514C20.2648 14.9621 20.425 15.0188 20.5881 15.0092C20.7512 14.9995 20.9039 14.9243 21.0125 14.8C21.1212 14.6757 21.1769 14.5125 21.1674 14.3463C21.1579 14.1802 21.0841 14.0247 20.962 13.914H20.9608V13.9128L20.9589 13.9115L20.9546 13.9077L20.9442 13.8983L20.9115 13.8707C20.8848 13.8486 20.8481 13.8197 20.8012 13.7841C20.7082 13.7145 20.5752 13.6223 20.4033 13.5219C19.9366 13.2532 19.4334 13.0566 18.9101 12.9383C17.6005 12.6359 15.7445 12.6848 13.4394 13.9259C11.3451 15.0535 9.49583 15.0974 8.17636 14.8703C7.64198 14.7795 7.11924 14.6282 6.61788 14.4191C6.44492 14.3459 6.27571 14.2638 6.11091 14.1732L6.08997 14.1606L6.08874 14.1594H6.08689C5.94789 14.0796 5.78391 14.0578 5.62949 14.0987C5.47507 14.1396 5.34224 14.2399 5.25898 14.3786C5.17572 14.5172 5.14852 14.6833 5.1831 14.842C5.21769 15.0006 5.31136 15.1394 5.4444 15.2292L5.44687 15.231L5.45118 15.2336L5.4635 15.2411C5.52195 15.2763 5.58153 15.3096 5.64214 15.3408C5.76041 15.4036 5.93043 15.4877 6.14726 15.5793C6.5803 15.7612 7.20123 15.9746 7.97061 16.107C9.51554 16.3736 11.6463 16.3109 14.0148 15.0353C16.0698 13.9291 17.6258 13.9285 18.6372 14.1625C19.1498 14.2817 19.5372 14.4637 19.7916 14.6117C19.9101 14.6809 20.0239 14.7581 20.1323 14.8426L20.1427 14.8514ZM20.1427 18.6161C20.2648 18.7268 20.425 18.7836 20.5881 18.7739C20.7512 18.7643 20.9039 18.689 21.0125 18.5647C21.1212 18.4404 21.1769 18.2772 21.1674 18.1111C21.1579 17.9449 21.0841 17.7894 20.962 17.6787H20.9608V17.6775L20.9589 17.6762L20.9546 17.6725L20.9442 17.663L20.9115 17.6354C20.8848 17.6133 20.8481 17.5844 20.8012 17.5488C20.7082 17.4792 20.5752 17.387 20.4033 17.2866C19.9366 17.0179 19.4334 16.8213 18.9101 16.703C17.6005 16.4006 15.7445 16.4496 13.4394 17.6907C11.3451 18.8182 9.49583 18.8621 8.17636 18.635C7.64198 18.5442 7.11924 18.3929 6.61788 18.1838C6.44492 18.1106 6.27571 18.0285 6.11091 17.9379L6.08997 17.9253L6.08874 17.9241H6.08689C5.94789 17.8443 5.78391 17.8225 5.62949 17.8634C5.47507 17.9043 5.34224 18.0046 5.25898 18.1433C5.17572 18.2819 5.14852 18.448 5.1831 18.6067C5.21769 18.7654 5.31136 18.9042 5.4444 18.9939L5.44687 18.9958L5.45118 18.9983L5.4635 19.0058C5.52195 19.041 5.58153 19.0743 5.64214 19.1056C5.76041 19.1683 5.93043 19.2524 6.14726 19.344C6.5803 19.526 7.20123 19.7393 7.97061 19.8717C9.51554 20.1383 11.6463 20.0756 14.0148 18.8C16.0698 17.6938 17.6258 17.6932 18.6372 17.9272C19.1498 18.0464 19.5372 18.2284 19.7916 18.3765C19.9101 18.4457 20.0239 18.5228 20.1323 18.6074L20.1427 18.6161Z"
                        fill="#222222" />
                    </svg>
                    <div class="tr-sub-title">Outdoor pool</div>
                  </li>
                  @else
                  <li>
                    <svg width="25" height="25" viewBox="0 0 25 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                      <path
                        d="M18.0865 5.25393C18.4133 5.25393 18.7267 5.38614 18.9577 5.62148C19.1887 5.85682 19.3185 6.17601 19.3185 6.50883V7.13628C19.3185 7.30269 19.3834 7.46229 19.499 7.57996C19.6145 7.69763 19.7712 7.76374 19.9345 7.76374C20.0979 7.76374 20.2546 7.69763 20.3701 7.57996C20.4856 7.46229 20.5505 7.30269 20.5505 7.13628V6.50883C20.5505 5.84319 20.2909 5.20481 19.8289 4.73413C19.3668 4.26345 18.74 3.99902 18.0865 3.99902C17.4331 3.99902 16.8063 4.26345 16.3442 4.73413C15.8821 5.20481 15.6225 5.84319 15.6225 6.50883V9.64609H9.46256V6.50883C9.46256 6.17601 9.59236 5.85682 9.82341 5.62148C10.0545 5.38614 10.3678 5.25393 10.6946 5.25393C11.0213 5.25393 11.3347 5.38614 11.5657 5.62148C11.7968 5.85682 11.9266 6.17601 11.9266 6.50883V7.13628C11.9266 7.30269 11.9915 7.46229 12.107 7.57996C12.2225 7.69763 12.3792 7.76374 12.5426 7.76374C12.7059 7.76374 12.8626 7.69763 12.9781 7.57996C13.0937 7.46229 13.1586 7.30269 13.1586 7.13628V6.50883C13.1586 5.84319 12.899 5.20481 12.4369 4.73413C11.9748 4.26345 11.3481 3.99902 10.6946 3.99902C10.0411 3.99902 9.41434 4.26345 8.95225 4.73413C8.49016 5.20481 8.23057 5.84319 8.23057 6.50883V13.9241C8.63695 14.0003 9.04934 14.0385 9.46256 14.0383V10.901H15.6225V12.0731C16.0279 11.9755 16.4396 11.908 16.8545 11.871V6.50883C16.8545 6.17601 16.9843 5.85682 17.2154 5.62148C17.4464 5.38614 17.7598 5.25393 18.0865 5.25393ZM20.1427 14.8514C20.2648 14.9621 20.425 15.0188 20.5881 15.0092C20.7512 14.9995 20.9039 14.9243 21.0125 14.8C21.1212 14.6757 21.1769 14.5125 21.1674 14.3463C21.1579 14.1802 21.0841 14.0247 20.962 13.914H20.9608V13.9128L20.9589 13.9115L20.9546 13.9077L20.9442 13.8983L20.9115 13.8707C20.8848 13.8486 20.8481 13.8197 20.8012 13.7841C20.7082 13.7145 20.5752 13.6223 20.4033 13.5219C19.9366 13.2532 19.4334 13.0566 18.9101 12.9383C17.6005 12.6359 15.7445 12.6848 13.4394 13.9259C11.3451 15.0535 9.49583 15.0974 8.17636 14.8703C7.64198 14.7795 7.11924 14.6282 6.61788 14.4191C6.44492 14.3459 6.27571 14.2638 6.11091 14.1732L6.08997 14.1606L6.08874 14.1594H6.08689C5.94789 14.0796 5.78391 14.0578 5.62949 14.0987C5.47507 14.1396 5.34224 14.2399 5.25898 14.3786C5.17572 14.5172 5.14852 14.6833 5.1831 14.842C5.21769 15.0006 5.31136 15.1394 5.4444 15.2292L5.44687 15.231L5.45118 15.2336L5.4635 15.2411C5.52195 15.2763 5.58153 15.3096 5.64214 15.3408C5.76041 15.4036 5.93043 15.4877 6.14726 15.5793C6.5803 15.7612 7.20123 15.9746 7.97061 16.107C9.51554 16.3736 11.6463 16.3109 14.0148 15.0353C16.0698 13.9291 17.6258 13.9285 18.6372 14.1625C19.1498 14.2817 19.5372 14.4637 19.7916 14.6117C19.9101 14.6809 20.0239 14.7581 20.1323 14.8426L20.1427 14.8514ZM20.1427 18.6161C20.2648 18.7268 20.425 18.7836 20.5881 18.7739C20.7512 18.7643 20.9039 18.689 21.0125 18.5647C21.1212 18.4404 21.1769 18.2772 21.1674 18.1111C21.1579 17.9449 21.0841 17.7894 20.962 17.6787H20.9608V17.6775L20.9589 17.6762L20.9546 17.6725L20.9442 17.663L20.9115 17.6354C20.8848 17.6133 20.8481 17.5844 20.8012 17.5488C20.7082 17.4792 20.5752 17.387 20.4033 17.2866C19.9366 17.0179 19.4334 16.8213 18.9101 16.703C17.6005 16.4006 15.7445 16.4496 13.4394 17.6907C11.3451 18.8182 9.49583 18.8621 8.17636 18.635C7.64198 18.5442 7.11924 18.3929 6.61788 18.1838C6.44492 18.1106 6.27571 18.0285 6.11091 17.9379L6.08997 17.9253L6.08874 17.9241H6.08689C5.94789 17.8443 5.78391 17.8225 5.62949 17.8634C5.47507 17.9043 5.34224 18.0046 5.25898 18.1433C5.17572 18.2819 5.14852 18.448 5.1831 18.6067C5.21769 18.7654 5.31136 18.9042 5.4444 18.9939L5.44687 18.9958L5.45118 18.9983L5.4635 19.0058C5.52195 19.041 5.58153 19.0743 5.64214 19.1056C5.76041 19.1683 5.93043 19.2524 6.14726 19.344C6.5803 19.526 7.20123 19.7393 7.97061 19.8717C9.51554 20.1383 11.6463 20.0756 14.0148 18.8C16.0698 17.6938 17.6258 17.6932 18.6372 17.9272C19.1498 18.0464 19.5372 18.2284 19.7916 18.3765C19.9101 18.4457 20.0239 18.5228 20.1323 18.6074L20.1427 18.6161Z"
                        fill="#222222" />
                    </svg>
                    <div class="tr-sub-title">{{$mnt}}</div>
                  </li>
                  @endif

                  @endforeach
                </ul>
                @else
                <p>Amenities Not Available.</p>
                @endif
              </div>

              <div class="tr-facilities-lists tr-desktop">
                <h3 class="tr-mobile">Facilities</h3>
                <div class="tr-facilities-list">

                  @if(!empty($amenities2))
                  <?php $allamenities2 = explode(',',$amenities2); ?>
                  <div>
                    <h4>
                      <svg width="20" height="22" viewBox="0 0 20 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                          d="M2.875 16.4204C2.78385 16.4204 2.69596 16.4009 2.61133 16.3618C2.52669 16.3228 2.45182 16.2642 2.38672 16.186C2.30859 16.1209 2.25326 16.0461 2.2207 15.9614C2.18815 15.8768 2.17188 15.7824 2.17188 15.6782V14.9556C2.17188 14.7603 2.19792 14.5812 2.25 14.4185C2.30208 14.2557 2.38021 14.1027 2.48438 13.9595C2.58854 13.8293 2.70898 13.7121 2.8457 13.6079C2.98242 13.5037 3.13542 13.4126 3.30469 13.3345C3.64323 13.1652 3.99154 13.0155 4.34961 12.8853C4.70768 12.755 5.07552 12.6379 5.45312 12.5337C5.83073 12.4425 6.23438 12.3709 6.66406 12.3188C7.09375 12.2668 7.5625 12.2407 8.07031 12.2407C8.5651 12.2407 9.0306 12.2668 9.4668 12.3188C9.90299 12.3709 10.3099 12.4491 10.6875 12.5532C11.0521 12.6574 11.4134 12.7746 11.7715 12.9048C12.1296 13.035 12.4844 13.1782 12.8359 13.3345C13.0052 13.4126 13.1582 13.5037 13.2949 13.6079C13.4316 13.7121 13.5521 13.8293 13.6562 13.9595C13.7604 14.1027 13.8385 14.2557 13.8906 14.4185C13.9427 14.5812 13.9688 14.7603 13.9688 14.9556V15.6782C13.9688 15.7824 13.9492 15.8768 13.9102 15.9614C13.8711 16.0461 13.819 16.1209 13.7539 16.186C13.6758 16.2642 13.5944 16.3228 13.5098 16.3618C13.4251 16.4009 13.3307 16.4204 13.2266 16.4204H2.875ZM15.4336 16.4204C15.4727 16.3683 15.502 16.313 15.5215 16.2544C15.541 16.1958 15.5508 16.1405 15.5508 16.0884C15.5638 16.0233 15.5736 15.9582 15.5801 15.8931C15.5866 15.828 15.5898 15.7629 15.5898 15.6978V14.9165C15.5898 14.6951 15.5671 14.4771 15.5215 14.2622C15.4759 14.0474 15.4141 13.8293 15.3359 13.6079C15.2578 13.3866 15.1504 13.1815 15.0137 12.9927C14.877 12.8039 14.724 12.6313 14.5547 12.4751C14.763 12.5142 14.9681 12.563 15.1699 12.6216C15.3717 12.6802 15.5638 12.7485 15.7461 12.8267C15.9284 12.9048 16.1139 12.9862 16.3027 13.0708C16.4915 13.1554 16.6836 13.2433 16.8789 13.3345C17.0612 13.4256 17.2174 13.5298 17.3477 13.647C17.4779 13.7642 17.5755 13.8944 17.6406 14.0376C17.7057 14.1808 17.7546 14.3403 17.7871 14.5161C17.8197 14.6919 17.8359 14.884 17.8359 15.0923V15.6782C17.8359 15.7824 17.8197 15.8768 17.7871 15.9614C17.7546 16.0461 17.6992 16.1209 17.6211 16.186C17.556 16.2642 17.4811 16.3228 17.3965 16.3618C17.3118 16.4009 17.224 16.4204 17.1328 16.4204H15.4336ZM8.07031 10.3462C7.70573 10.3462 7.3737 10.2876 7.07422 10.1704C6.77474 10.0532 6.50781 9.87744 6.27344 9.64307C6.03906 9.40869 5.86328 9.14176 5.74609 8.84229C5.62891 8.54281 5.57031 8.21077 5.57031 7.84619C5.57031 7.49463 5.62891 7.16911 5.74609 6.86963C5.86328 6.57015 6.03906 6.30322 6.27344 6.06885C6.50781 5.83447 6.77474 5.65544 7.07422 5.53174C7.3737 5.40804 7.70573 5.34619 8.07031 5.34619C8.42188 5.34619 8.7474 5.40804 9.04688 5.53174C9.34635 5.65544 9.61328 5.83447 9.84766 6.06885C10.082 6.30322 10.2611 6.57015 10.3848 6.86963C10.5085 7.16911 10.5703 7.49463 10.5703 7.84619C10.5703 8.21077 10.5085 8.54281 10.3848 8.84229C10.2611 9.14176 10.082 9.40869 9.84766 9.64307C9.61328 9.87744 9.34635 10.0532 9.04688 10.1704C8.7474 10.2876 8.42188 10.3462 8.07031 10.3462ZM14.125 7.84619C14.125 8.21077 14.0664 8.54281 13.9492 8.84229C13.832 9.14176 13.6497 9.40869 13.4023 9.64307C13.168 9.87744 12.901 10.0532 12.6016 10.1704C12.3021 10.2876 11.9766 10.3462 11.625 10.3462C11.612 10.3462 11.5892 10.3462 11.5566 10.3462C11.5241 10.3462 11.4818 10.3397 11.4297 10.3267C11.3906 10.3267 11.3548 10.3234 11.3223 10.3169C11.2897 10.3104 11.2669 10.3071 11.2539 10.3071C11.3841 10.1379 11.5013 9.95557 11.6055 9.76025C11.7096 9.56494 11.8008 9.36312 11.8789 9.15479C11.957 8.94645 12.0156 8.73486 12.0547 8.52002C12.0938 8.30518 12.1133 8.08708 12.1133 7.86572C12.1133 7.64437 12.0938 7.42627 12.0547 7.21143C12.0156 6.99658 11.957 6.78499 11.8789 6.57666C11.7878 6.38135 11.6934 6.18604 11.5957 5.99072C11.498 5.79541 11.3841 5.61312 11.2539 5.44385C11.2799 5.43083 11.3092 5.42106 11.3418 5.41455C11.3743 5.40804 11.4102 5.39827 11.4492 5.38525C11.4753 5.37223 11.5046 5.36247 11.5371 5.35596C11.5697 5.34945 11.599 5.34619 11.625 5.34619C11.9766 5.34619 12.3021 5.40804 12.6016 5.53174C12.901 5.65544 13.168 5.83447 13.4023 6.06885C13.6497 6.30322 13.832 6.57015 13.9492 6.86963C14.0664 7.16911 14.125 7.49463 14.125 7.84619ZM3.08984 15.5024H13.0508V14.9751C13.0508 14.884 13.0378 14.7961 13.0117 14.7114C12.9857 14.6268 12.9531 14.5584 12.9141 14.5063C12.862 14.4412 12.7969 14.3794 12.7188 14.3208C12.6406 14.2622 12.543 14.2004 12.4258 14.1353C12.1263 13.992 11.8105 13.8618 11.4785 13.7446C11.1465 13.6274 10.7982 13.5233 10.4336 13.4321C10.082 13.341 9.70768 13.2726 9.31055 13.2271C8.91341 13.1815 8.5 13.1587 8.07031 13.1587C7.64062 13.1587 7.22721 13.1815 6.83008 13.2271C6.43294 13.2726 6.05208 13.341 5.6875 13.4321C5.33594 13.5103 4.99414 13.6112 4.66211 13.7349C4.33008 13.8586 4.01432 13.992 3.71484 14.1353C3.59766 14.2004 3.49674 14.2622 3.41211 14.3208C3.32747 14.3794 3.26562 14.4412 3.22656 14.5063C3.17448 14.5584 3.13867 14.6268 3.11914 14.7114C3.09961 14.7961 3.08984 14.884 3.08984 14.9751V15.5024ZM8.07031 9.42822C8.29167 9.42822 8.5 9.39242 8.69531 9.3208C8.89062 9.24919 9.0599 9.13525 9.20312 8.979C9.34635 8.83577 9.45703 8.66976 9.53516 8.48096C9.61328 8.29216 9.65234 8.08057 9.65234 7.84619C9.65234 7.62484 9.61328 7.41976 9.53516 7.23096C9.45703 7.04216 9.34635 6.86963 9.20312 6.71338C9.0599 6.57015 8.89062 6.45947 8.69531 6.38135C8.5 6.30322 8.29167 6.26416 8.07031 6.26416C7.83594 6.26416 7.62435 6.30322 7.43555 6.38135C7.24674 6.45947 7.08073 6.57015 6.9375 6.71338C6.78125 6.86963 6.66732 7.04216 6.5957 7.23096C6.52409 7.41976 6.48828 7.62484 6.48828 7.84619C6.48828 8.08057 6.52409 8.29216 6.5957 8.48096C6.66732 8.66976 6.78125 8.83577 6.9375 8.979C7.08073 9.13525 7.24674 9.24919 7.43555 9.3208C7.62435 9.39242 7.83594 9.42822 8.07031 9.42822Z"
                          fill="#222222" />
                      </svg>Hotel Services
                    </h4>
                    <ul>
                      @foreach($allamenities2 as $allmnt)
                      @if(trim($allmnt) != '24 hour Front Desk Service' && trim($allmnt) != 'Laundry service' &&
                      trim($allmnt) != 'Wi-Fi in public areas' && trim($allmnt) != 'Parking' && trim($allmnt) != 'Gym'
                      && trim($allmnt) != 'Spa' && trim($allmnt) != 'Child care/activities' && trim($allmnt) !=
                      'Babysitting' && trim($allmnt) != 'Business centre')
                      <li class="tr-available">{{$allmnt}}</li>
                      @endif
                      @endforeach
                    </ul>
                  </div>
                  @endif


                  @if(!empty($amenities2))
                  <div>
                    <h4>
                      <svg width="20" height="21" viewBox="0 0 20 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                          d="M16.6615 17.8091V16.1424C16.6615 15.2584 16.3103 14.4105 15.6851 13.7854C15.06 13.1603 14.2122 12.8091 13.3281 12.8091H6.66146C5.7774 12.8091 4.92956 13.1603 4.30444 13.7854C3.67931 14.4105 3.32813 15.2584 3.32812 16.1424V17.8091"
                          stroke="#222222" stroke-linecap="round" stroke-linejoin="round" />
                        <path
                          d="M10.0052 9.47575C11.8462 9.47575 13.3385 7.98336 13.3385 6.14242C13.3385 4.30147 11.8462 2.80908 10.0052 2.80908C8.16426 2.80908 6.67188 4.30147 6.67188 6.14242C6.67188 7.98336 8.16426 9.47575 10.0052 9.47575Z"
                          stroke="#222222" stroke-linecap="round" stroke-linejoin="round" />
                      </svg>Children
                    </h4>
                    <ul>
                      @foreach($allamenities2 as $allmnt)
                      @if(trim($allmnt) == 'Babysitting' )
                      <li class="tr-available">Baby sitting</li>
                      @elseif(trim($allmnt) =='Child care/activities')
                      <li class="tr-available">Child care/activities</li>
                      @endif
                      @endforeach
                    </ul>
                  </div>
                  @endif
                
                  @if(!empty($amenities2))
                  <div>
                    <h4>
                      <svg width="20" height="21" viewBox="0 0 20 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                          d="M7.8082 5.76153C8.25435 4.46877 9.31556 3.56104 10.5524 3.56104C11.7892 3.56104 12.8504 4.46877 13.2966 5.76153C13.3956 6.04855 13.6698 6.18487 13.909 6.066C14.1482 5.94713 14.2618 5.6181 14.1627 5.33107C13.5766 3.63259 12.1815 2.43604 10.5524 2.43604C8.92331 2.43604 7.52822 3.63259 6.94204 5.33107C6.84299 5.6181 6.95658 5.94713 7.19577 6.066C7.43495 6.18487 7.70915 6.04855 7.8082 5.76153Z"
                          fill="#222222" />
                        <path
                          d="M7.375 12.7485C7.375 13.1628 7.09518 13.4985 6.75 13.4985C6.40482 13.4985 6.125 13.1628 6.125 12.7485C6.125 12.3343 6.40482 11.9985 6.75 11.9985C7.09518 11.9985 7.375 12.3343 7.375 12.7485Z"
                          fill="#222222" />
                        <path
                          d="M9.25 12.7485C9.25 13.1628 8.97018 13.4985 8.625 13.4985C8.27982 13.4985 8 13.1628 8 12.7485C8 12.3343 8.27982 11.9985 8.625 11.9985C8.97018 11.9985 9.25 12.3343 9.25 12.7485Z"
                          fill="#222222" />
                        <path
                          d="M11.2812 12.7485C11.2812 12.4379 11.4911 12.186 11.75 12.186H14.25C14.5089 12.186 14.7188 12.4379 14.7188 12.7485C14.7188 13.0592 14.5089 13.311 14.25 13.311H11.75C11.4911 13.311 11.2812 13.0592 11.2812 12.7485Z"
                          fill="#222222" />
                        <path fill-rule="evenodd" clip-rule="evenodd"
                          d="M4.64244 4.01025C4.86721 3.85611 5.15355 3.94983 5.28199 4.21956L7.64703 9.18613H13.353L15.718 4.21956C15.8464 3.94983 16.1328 3.85611 16.3576 4.01025C16.5823 4.16438 16.6604 4.50798 16.532 4.77771L14.4327 9.18621C14.9281 9.18658 15.346 9.19153 15.6841 9.24606C16.0764 9.30936 16.4307 9.44863 16.7153 9.79026C17 10.1318 17.1161 10.5569 17.1688 11.0278C17.2188 11.4739 17.2187 12.0358 17.2187 12.7096V12.7876C17.2187 13.4615 17.2188 14.0234 17.1688 14.4695C17.1161 14.9404 17 15.3655 16.7153 15.707C16.4307 16.0486 16.0764 16.1879 15.6841 16.2512C15.3124 16.3112 14.8441 16.3111 14.2826 16.3111H6.71751C6.15601 16.3111 5.68766 16.3112 5.31595 16.2512C4.92358 16.1879 4.56933 16.0486 4.28466 15.707C3.99999 15.3655 3.88395 14.9404 3.83119 14.4695C3.78122 14.0234 3.78123 13.4615 3.78125 12.7876V12.7096C3.78123 12.0358 3.78122 11.4739 3.83119 11.0278C3.88395 10.5569 3.99999 10.1318 4.28466 9.79026C4.56933 9.44863 4.92358 9.30936 5.31595 9.24606C5.65404 9.19153 6.07196 9.18658 6.56728 9.18621L4.46801 4.77771C4.33957 4.50798 4.41766 4.16438 4.64244 4.01025ZM13.6159 10.3111C13.6217 10.3113 13.6274 10.3113 13.6332 10.3111H14.25C14.8525 10.3111 15.2572 10.3123 15.5591 10.361C15.8476 10.4076 15.971 10.488 16.0524 10.5857C16.1339 10.6834 16.2009 10.8316 16.2397 11.1777C16.2802 11.5399 16.2812 12.0256 16.2812 12.7486C16.2812 13.4716 16.2802 13.9573 16.2397 14.3196C16.2009 14.6657 16.1339 14.8138 16.0524 14.9116C15.971 15.0093 15.8476 15.0897 15.5591 15.1363C15.2572 15.1849 14.8525 15.1861 14.25 15.1861H6.75C6.14749 15.1861 5.74277 15.1849 5.44088 15.1363C5.15246 15.0897 5.02903 15.0093 4.94758 14.9116C4.86613 14.8138 4.79911 14.6657 4.76034 14.3196C4.71975 13.9573 4.71875 13.4716 4.71875 12.7486C4.71875 12.0256 4.71975 11.5399 4.76034 11.1777C4.79911 10.8316 4.86613 10.6834 4.94758 10.5857C5.02903 10.488 5.15246 10.4076 5.44088 10.361C5.74277 10.3123 6.14749 10.3111 6.75 10.3111H7.36677C7.37254 10.3113 7.37832 10.3113 7.3841 10.3111H13.6159Z"
                          fill="#222222" />
                        <path
                          d="M10.5503 5.43604C9.91131 5.43604 9.37074 5.94786 9.20011 6.64968C9.12759 6.94791 8.86733 7.11912 8.61881 7.03209C8.37029 6.94507 8.22762 6.63277 8.30014 6.33454C8.58434 5.1658 9.48349 4.31104 10.5503 4.31104C11.6171 4.31104 12.5162 5.1658 12.8004 6.33454C12.8729 6.63277 12.7302 6.94507 12.4817 7.03209C12.2332 7.11912 11.973 6.94791 11.9005 6.64968C11.7298 5.94786 11.1892 5.43604 10.5503 5.43604Z"
                          fill="#222222" />
                        <path
                          d="M10.5469 7.49854C10.8921 7.49854 11.1719 7.16275 11.1719 6.74854C11.1719 6.33433 10.8921 5.99854 10.5469 5.99854C10.2017 5.99854 9.92188 6.33433 9.92188 6.74854C9.92188 7.16275 10.2017 7.49854 10.5469 7.49854Z"
                          fill="#222222" />
                      </svg>Internet
                    </h4>
                    <ul>
                      @foreach($allamenities2 as $allmnt)
                      @if(trim($allmnt) == 'Wi-Fi in public areas')
                      <li class="tr-available">Free WIFI available</li>
                      @endif
                      @endforeach
                    </ul>
                  </div>
                  @endif
                </div>
                <!-- start tab -->
                <div class="tr-facilities-list">
                  @if(!empty($room_amenity1))
                  <div>
                    <h4>
                      <svg width="20" height="22" viewBox="0 0 20 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                          d="M4.19922 17.5532C4.14714 17.5532 4.0918 17.5435 4.0332 17.5239C3.97461 17.5044 3.92578 17.4686 3.88672 17.4165C3.83464 17.3644 3.79883 17.3123 3.7793 17.2603C3.75977 17.2082 3.75 17.1561 3.75 17.104C3.75 17.0389 3.75977 16.9803 3.7793 16.9282C3.79883 16.8761 3.83464 16.8241 3.88672 16.772C3.92578 16.7329 3.97461 16.7004 4.0332 16.6743C4.0918 16.6483 4.14714 16.6353 4.19922 16.6353H5.37109V4.93604C5.37109 4.84489 5.39062 4.757 5.42969 4.67236C5.46875 4.58773 5.52083 4.51286 5.58594 4.44775C5.65104 4.36963 5.72591 4.31429 5.81055 4.28174C5.89518 4.24919 5.98307 4.23291 6.07422 4.23291H11.3672C11.4714 4.23291 11.5658 4.24593 11.6504 4.27197C11.735 4.29801 11.8099 4.34359 11.875 4.40869C11.9401 4.4738 11.9922 4.54541 12.0312 4.62354C12.0703 4.70166 12.0898 4.7863 12.0898 4.87744V5.03369H13.9258C14.0039 5.03369 14.0853 5.05322 14.1699 5.09229C14.2546 5.13135 14.3359 5.18343 14.4141 5.24854C14.4792 5.32666 14.5312 5.40804 14.5703 5.49268C14.6094 5.57731 14.6289 5.6652 14.6289 5.75635V16.6353H15.8008C15.8529 16.6353 15.9082 16.6483 15.9668 16.6743C16.0254 16.7004 16.0742 16.7394 16.1133 16.7915C16.1654 16.8436 16.2012 16.8957 16.2207 16.9478C16.2402 16.9998 16.25 17.0519 16.25 17.104C16.25 17.1691 16.2402 17.2277 16.2207 17.2798C16.2012 17.3319 16.1654 17.3774 16.1133 17.4165C16.0742 17.4686 16.0254 17.5044 15.9668 17.5239C15.9082 17.5435 15.8529 17.5532 15.8008 17.5532H14.4141C14.3229 17.5532 14.235 17.5369 14.1504 17.5044C14.0658 17.4718 13.9909 17.4165 13.9258 17.3384C13.8477 17.2733 13.7923 17.1984 13.7598 17.1138C13.7272 17.0291 13.7109 16.9412 13.7109 16.8501V5.95166H12.0898V16.8501C12.0898 16.9412 12.0703 17.0291 12.0312 17.1138C11.9922 17.1984 11.9336 17.2733 11.8555 17.3384C11.7904 17.4165 11.7155 17.4718 11.6309 17.5044C11.5462 17.5369 11.4583 17.5532 11.3672 17.5532H4.19922ZM10.2539 10.8931C10.2539 10.8019 10.2376 10.7173 10.2051 10.6392C10.1725 10.561 10.1237 10.4894 10.0586 10.4243C9.99349 10.3592 9.92188 10.3104 9.84375 10.2778C9.76562 10.2453 9.68099 10.229 9.58984 10.229C9.4987 10.229 9.41406 10.2453 9.33594 10.2778C9.25781 10.3104 9.1862 10.3592 9.12109 10.4243C9.05599 10.4894 9.00716 10.561 8.97461 10.6392C8.94206 10.7173 8.92578 10.8019 8.92578 10.8931C8.92578 10.9842 8.94206 11.0688 8.97461 11.147C9.00716 11.2251 9.05599 11.2967 9.12109 11.3618C9.1862 11.4269 9.25781 11.4757 9.33594 11.5083C9.41406 11.5409 9.4987 11.5571 9.58984 11.5571C9.68099 11.5571 9.76562 11.5409 9.84375 11.5083C9.92188 11.4757 9.99349 11.4269 10.0586 11.3618C10.1237 11.2967 10.1725 11.2251 10.2051 11.147C10.2376 11.0688 10.2539 10.9842 10.2539 10.8931ZM6.28906 16.6353H11.1719V5.15088H6.28906V16.6353Z"
                          fill="black" />
                      </svg>Room features
                    </h4>
                    <?php $roommnt = explode(',',$room_amenity1); ?>
                    <ul>
                      @foreach($roommnt as $roomfac)
                      @if(trim($roomfac) != 'Air conditioning' && trim($roomfac) != 'TV')
                      <li class="tr-available">{{$roomfac}}</li>
                      @endif
                      @endforeach
                    </ul>
                  </div>
                  @endif

                  @if(!empty($amenities2))
                  <?php $allamenities2 = explode(',',$amenities2); ?>
                  <div>
                    <h4>
                      <svg width="20" height="21" viewBox="0 0 20 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                          d="M15.6242 5.9208V14.7208C15.6242 15.0125 15.4925 15.2923 15.2582 15.4986C15.0238 15.7049 14.7059 15.8208 14.3744 15.8208H13.1246C12.7931 15.8208 12.4752 15.7049 12.2408 15.4986C12.0064 15.2923 11.8747 15.0125 11.8747 14.7208V10.8708H8.12526V14.7208C8.12526 15.0125 7.99358 15.2923 7.75919 15.4986C7.5248 15.7049 7.2069 15.8208 6.87543 15.8208H5.6256C5.29413 15.8208 4.97623 15.7049 4.74184 15.4986C4.50745 15.2923 4.37577 15.0125 4.37577 14.7208V5.9208C4.37577 5.62906 4.50745 5.34927 4.74184 5.14298C4.97623 4.93669 5.29413 4.8208 5.6256 4.8208H6.87543C7.2069 4.8208 7.5248 4.93669 7.75919 5.14298C7.99358 5.34927 8.12526 5.62906 8.12526 5.9208V9.7708H11.8747V5.9208C11.8747 5.62906 12.0064 5.34927 12.2408 5.14298C12.4752 4.93669 12.7931 4.8208 13.1246 4.8208H14.3744C14.7059 4.8208 15.0238 4.93669 15.2582 5.14298C15.4925 5.34927 15.6242 5.62906 15.6242 5.9208ZM2.81349 6.4708H2.50103C2.16955 6.4708 1.85166 6.58669 1.61727 6.79298C1.38288 6.99927 1.2512 7.27906 1.2512 7.5708V9.7708H0.647378C0.485889 9.7687 0.329488 9.8205 0.209636 9.91578C0.0897842 10.0111 0.0153737 10.1428 0.00137305 10.2844C-0.00430267 10.3596 0.00765769 10.4351 0.0365112 10.506C0.0653648 10.577 0.110495 10.6421 0.169099 10.697C0.227704 10.752 0.29853 10.7958 0.377179 10.8257C0.455828 10.8556 0.540619 10.871 0.626287 10.8708H1.2512V13.0708C1.2512 13.3625 1.38288 13.6423 1.61727 13.8486C1.85166 14.0549 2.16955 14.1708 2.50103 14.1708H2.81349C2.89636 14.1708 2.97583 14.1418 3.03443 14.0903C3.09302 14.0387 3.12594 13.9687 3.12594 13.8958V6.7458C3.12594 6.67287 3.09302 6.60292 3.03443 6.55135C2.97583 6.49977 2.89636 6.4708 2.81349 6.4708ZM19.9986 10.2844C19.9846 10.143 19.9105 10.0115 19.7909 9.91626C19.6714 9.82101 19.5154 9.76905 19.3542 9.7708H18.7488V7.5708C18.7488 7.27906 18.6171 6.99927 18.3827 6.79298C18.1483 6.58669 17.8304 6.4708 17.499 6.4708H17.1865C17.1036 6.4708 17.0242 6.49977 16.9656 6.55135C16.907 6.60292 16.8741 6.67287 16.8741 6.7458V13.8958C16.8741 13.9687 16.907 14.0387 16.9656 14.0903C17.0242 14.1418 17.1036 14.1708 17.1865 14.1708H17.499C17.8304 14.1708 18.1483 14.0549 18.3827 13.8486C18.6171 13.6423 18.7488 13.3625 18.7488 13.0708V10.8708H19.3737C19.4594 10.871 19.5442 10.8556 19.6228 10.8257C19.7015 10.7958 19.7723 10.752 19.8309 10.697C19.8895 10.6421 19.9346 10.577 19.9635 10.506C19.9923 10.4351 20.0043 10.3596 19.9986 10.2844Z"
                          fill="#222222" />
                      </svg>Fitness
                    </h4>
                    <ul>
                      @foreach($allamenities2 as $allmnt)
                      @if(trim($allmnt) == 'Gym' )
                      <li class="tr-available">Gym</li>
                      @elseif(trim($allmnt) =='spa')
                      <li class="tr-available">spa</li>
                      @endif
                      @endforeach
                    </ul>
                  </div>
                  @endif
                  @if(!empty($room_amenity1))

                  <div>
                    <h4>
                      <svg width="20" height="21" viewBox="0 0 20 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                          d="M16.6719 6.14307H3.33854C2.41807 6.14307 1.67188 6.88926 1.67188 7.80973V16.9764C1.67188 17.8969 2.41807 18.6431 3.33854 18.6431H16.6719C17.5923 18.6431 18.3385 17.8969 18.3385 16.9764V7.80973C18.3385 6.88926 17.5923 6.14307 16.6719 6.14307Z"
                          stroke="#222222" stroke-linecap="round" stroke-linejoin="round" />
                        <path d="M14.1615 1.9751L9.99479 6.14176L5.82812 1.9751" stroke="#222222" stroke-linecap="round"
                          stroke-linejoin="round" />
                      </svg>Media &amp; Technology
                    </h4>
                    <ul>
                      @foreach($roommnt as $roomfac)
                      @if(trim($roomfac) == 'TV')
                      <li class="tr-available">TV</li>
                      @endif
                      @endforeach
                    </ul>
                  </div>

                  @endif
                  @if(!empty($amenities2))
                  <?php $allamenities2 = explode(',',$amenities2); ?>


                  <div>
                    <h4>
                      <svg width="20" height="22" viewBox="0 0 20 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                          d="M2.875 16.4204C2.78385 16.4204 2.69596 16.4009 2.61133 16.3618C2.52669 16.3228 2.45182 16.2642 2.38672 16.186C2.30859 16.1209 2.25326 16.0461 2.2207 15.9614C2.18815 15.8768 2.17188 15.7824 2.17188 15.6782V14.9556C2.17188 14.7603 2.19792 14.5812 2.25 14.4185C2.30208 14.2557 2.38021 14.1027 2.48438 13.9595C2.58854 13.8293 2.70898 13.7121 2.8457 13.6079C2.98242 13.5037 3.13542 13.4126 3.30469 13.3345C3.64323 13.1652 3.99154 13.0155 4.34961 12.8853C4.70768 12.755 5.07552 12.6379 5.45312 12.5337C5.83073 12.4425 6.23438 12.3709 6.66406 12.3188C7.09375 12.2668 7.5625 12.2407 8.07031 12.2407C8.5651 12.2407 9.0306 12.2668 9.4668 12.3188C9.90299 12.3709 10.3099 12.4491 10.6875 12.5532C11.0521 12.6574 11.4134 12.7746 11.7715 12.9048C12.1296 13.035 12.4844 13.1782 12.8359 13.3345C13.0052 13.4126 13.1582 13.5037 13.2949 13.6079C13.4316 13.7121 13.5521 13.8293 13.6562 13.9595C13.7604 14.1027 13.8385 14.2557 13.8906 14.4185C13.9427 14.5812 13.9688 14.7603 13.9688 14.9556V15.6782C13.9688 15.7824 13.9492 15.8768 13.9102 15.9614C13.8711 16.0461 13.819 16.1209 13.7539 16.186C13.6758 16.2642 13.5944 16.3228 13.5098 16.3618C13.4251 16.4009 13.3307 16.4204 13.2266 16.4204H2.875ZM15.4336 16.4204C15.4727 16.3683 15.502 16.313 15.5215 16.2544C15.541 16.1958 15.5508 16.1405 15.5508 16.0884C15.5638 16.0233 15.5736 15.9582 15.5801 15.8931C15.5866 15.828 15.5898 15.7629 15.5898 15.6978V14.9165C15.5898 14.6951 15.5671 14.4771 15.5215 14.2622C15.4759 14.0474 15.4141 13.8293 15.3359 13.6079C15.2578 13.3866 15.1504 13.1815 15.0137 12.9927C14.877 12.8039 14.724 12.6313 14.5547 12.4751C14.763 12.5142 14.9681 12.563 15.1699 12.6216C15.3717 12.6802 15.5638 12.7485 15.7461 12.8267C15.9284 12.9048 16.1139 12.9862 16.3027 13.0708C16.4915 13.1554 16.6836 13.2433 16.8789 13.3345C17.0612 13.4256 17.2174 13.5298 17.3477 13.647C17.4779 13.7642 17.5755 13.8944 17.6406 14.0376C17.7057 14.1808 17.7546 14.3403 17.7871 14.5161C17.8197 14.6919 17.8359 14.884 17.8359 15.0923V15.6782C17.8359 15.7824 17.8197 15.8768 17.7871 15.9614C17.7546 16.0461 17.6992 16.1209 17.6211 16.186C17.556 16.2642 17.4811 16.3228 17.3965 16.3618C17.3118 16.4009 17.224 16.4204 17.1328 16.4204H15.4336ZM8.07031 10.3462C7.70573 10.3462 7.3737 10.2876 7.07422 10.1704C6.77474 10.0532 6.50781 9.87744 6.27344 9.64307C6.03906 9.40869 5.86328 9.14176 5.74609 8.84229C5.62891 8.54281 5.57031 8.21077 5.57031 7.84619C5.57031 7.49463 5.62891 7.16911 5.74609 6.86963C5.86328 6.57015 6.03906 6.30322 6.27344 6.06885C6.50781 5.83447 6.77474 5.65544 7.07422 5.53174C7.3737 5.40804 7.70573 5.34619 8.07031 5.34619C8.42188 5.34619 8.7474 5.40804 9.04688 5.53174C9.34635 5.65544 9.61328 5.83447 9.84766 6.06885C10.082 6.30322 10.2611 6.57015 10.3848 6.86963C10.5085 7.16911 10.5703 7.49463 10.5703 7.84619C10.5703 8.21077 10.5085 8.54281 10.3848 8.84229C10.2611 9.14176 10.082 9.40869 9.84766 9.64307C9.61328 9.87744 9.34635 10.0532 9.04688 10.1704C8.7474 10.2876 8.42188 10.3462 8.07031 10.3462ZM14.125 7.84619C14.125 8.21077 14.0664 8.54281 13.9492 8.84229C13.832 9.14176 13.6497 9.40869 13.4023 9.64307C13.168 9.87744 12.901 10.0532 12.6016 10.1704C12.3021 10.2876 11.9766 10.3462 11.625 10.3462C11.612 10.3462 11.5892 10.3462 11.5566 10.3462C11.5241 10.3462 11.4818 10.3397 11.4297 10.3267C11.3906 10.3267 11.3548 10.3234 11.3223 10.3169C11.2897 10.3104 11.2669 10.3071 11.2539 10.3071C11.3841 10.1379 11.5013 9.95557 11.6055 9.76025C11.7096 9.56494 11.8008 9.36312 11.8789 9.15479C11.957 8.94645 12.0156 8.73486 12.0547 8.52002C12.0938 8.30518 12.1133 8.08708 12.1133 7.86572C12.1133 7.64437 12.0938 7.42627 12.0547 7.21143C12.0156 6.99658 11.957 6.78499 11.8789 6.57666C11.7878 6.38135 11.6934 6.18604 11.5957 5.99072C11.498 5.79541 11.3841 5.61312 11.2539 5.44385C11.2799 5.43083 11.3092 5.42106 11.3418 5.41455C11.3743 5.40804 11.4102 5.39827 11.4492 5.38525C11.4753 5.37223 11.5046 5.36247 11.5371 5.35596C11.5697 5.34945 11.599 5.34619 11.625 5.34619C11.9766 5.34619 12.3021 5.40804 12.6016 5.53174C12.901 5.65544 13.168 5.83447 13.4023 6.06885C13.6497 6.30322 13.832 6.57015 13.9492 6.86963C14.0664 7.16911 14.125 7.49463 14.125 7.84619ZM3.08984 15.5024H13.0508V14.9751C13.0508 14.884 13.0378 14.7961 13.0117 14.7114C12.9857 14.6268 12.9531 14.5584 12.9141 14.5063C12.862 14.4412 12.7969 14.3794 12.7188 14.3208C12.6406 14.2622 12.543 14.2004 12.4258 14.1353C12.1263 13.992 11.8105 13.8618 11.4785 13.7446C11.1465 13.6274 10.7982 13.5233 10.4336 13.4321C10.082 13.341 9.70768 13.2726 9.31055 13.2271C8.91341 13.1815 8.5 13.1587 8.07031 13.1587C7.64062 13.1587 7.22721 13.1815 6.83008 13.2271C6.43294 13.2726 6.05208 13.341 5.6875 13.4321C5.33594 13.5103 4.99414 13.6112 4.66211 13.7349C4.33008 13.8586 4.01432 13.992 3.71484 14.1353C3.59766 14.2004 3.49674 14.2622 3.41211 14.3208C3.32747 14.3794 3.26562 14.4412 3.22656 14.5063C3.17448 14.5584 3.13867 14.6268 3.11914 14.7114C3.09961 14.7961 3.08984 14.884 3.08984 14.9751V15.5024ZM8.07031 9.42822C8.29167 9.42822 8.5 9.39242 8.69531 9.3208C8.89062 9.24919 9.0599 9.13525 9.20312 8.979C9.34635 8.83577 9.45703 8.66976 9.53516 8.48096C9.61328 8.29216 9.65234 8.08057 9.65234 7.84619C9.65234 7.62484 9.61328 7.41976 9.53516 7.23096C9.45703 7.04216 9.34635 6.86963 9.20312 6.71338C9.0599 6.57015 8.89062 6.45947 8.69531 6.38135C8.5 6.30322 8.29167 6.26416 8.07031 6.26416C7.83594 6.26416 7.62435 6.30322 7.43555 6.38135C7.24674 6.45947 7.08073 6.57015 6.9375 6.71338C6.78125 6.86963 6.66732 7.04216 6.5957 7.23096C6.52409 7.41976 6.48828 7.62484 6.48828 7.84619C6.48828 8.08057 6.52409 8.29216 6.5957 8.48096C6.66732 8.66976 6.78125 8.83577 6.9375 8.979C7.08073 9.13525 7.24674 9.24919 7.43555 9.3208C7.62435 9.39242 7.83594 9.42822 8.07031 9.42822Z"
                          fill="#222222" />
                      </svg>Business
                    </h4>
                    <ul>
                      @foreach($allamenities2 as $allmnt)
                      @if(trim($allmnt) == 'Business centre')
                      <li class="tr-available">{{$allmnt}}</li>
                      @endif
                      @endforeach
                    </ul>
                  </div>
                  @endif
                </div>

                <!-- end tab -->
                <div class="tr-facilities-list">
                  @if(!empty($room_amenity1))
                  <div>
                    <h4>
                      <svg width="20" height="22" viewBox="0 0 20 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                          d="M9.66797 14.4478L6.81641 17.3188C6.77734 17.3579 6.73828 17.3872 6.69922 17.4067C6.66016 17.4263 6.62109 17.436 6.58203 17.436C6.52995 17.436 6.48438 17.4263 6.44531 17.4067C6.40625 17.3872 6.36719 17.3579 6.32812 17.3188C6.28906 17.2798 6.25977 17.2407 6.24023 17.2017C6.2207 17.1626 6.21094 17.117 6.21094 17.0649C6.21094 17.0259 6.2207 16.9868 6.24023 16.9478C6.25977 16.9087 6.28906 16.8696 6.32812 16.8306L9.66797 13.5103V11.2251H7.38281L4.04297 14.5649C4.00391 14.604 3.96484 14.6333 3.92578 14.6528C3.88672 14.6724 3.84766 14.6821 3.80859 14.6821C3.75651 14.6821 3.71094 14.6724 3.67188 14.6528C3.63281 14.6333 3.59375 14.604 3.55469 14.5649C3.51562 14.5259 3.48633 14.4868 3.4668 14.4478C3.44727 14.4087 3.4375 14.3631 3.4375 14.311C3.4375 14.272 3.44727 14.2329 3.4668 14.1938C3.48633 14.1548 3.51562 14.1157 3.55469 14.0767L6.44531 11.2251H2.73438C2.69531 11.2251 2.65951 11.2186 2.62695 11.2056C2.5944 11.1925 2.55859 11.1665 2.51953 11.1274C2.48047 11.1014 2.45443 11.0688 2.44141 11.0298C2.42839 10.9907 2.42188 10.9451 2.42188 10.8931C2.42188 10.854 2.42839 10.8182 2.44141 10.7856C2.45443 10.7531 2.48047 10.7173 2.51953 10.6782C2.54557 10.6392 2.57812 10.6099 2.61719 10.5903C2.65625 10.5708 2.70182 10.561 2.75391 10.561H6.44531L3.57422 7.729C3.53516 7.68994 3.50586 7.65088 3.48633 7.61182C3.4668 7.57275 3.45703 7.53369 3.45703 7.49463C3.45703 7.44255 3.4668 7.39697 3.48633 7.35791C3.50586 7.31885 3.53516 7.27979 3.57422 7.24072C3.61328 7.20166 3.65234 7.17236 3.69141 7.15283C3.73047 7.1333 3.77604 7.12354 3.82812 7.12354C3.86719 7.12354 3.90625 7.1333 3.94531 7.15283C3.98438 7.17236 4.02344 7.20166 4.0625 7.24072L7.38281 10.561H9.66797V8.27588L6.32812 4.9751C6.28906 4.93604 6.25977 4.89697 6.24023 4.85791C6.2207 4.81885 6.21094 4.77979 6.21094 4.74072C6.21094 4.68864 6.2207 4.64307 6.24023 4.604C6.25977 4.56494 6.28906 4.53239 6.32812 4.50635C6.36719 4.45426 6.40625 4.41846 6.44531 4.39893C6.48438 4.37939 6.52995 4.36963 6.58203 4.36963C6.62109 4.36963 6.66016 4.37939 6.69922 4.39893C6.73828 4.41846 6.77734 4.45426 6.81641 4.50635L9.66797 7.33838V3.64697C9.66797 3.60791 9.67448 3.5721 9.6875 3.53955C9.70052 3.507 9.72656 3.47119 9.76562 3.43213C9.79167 3.39307 9.82422 3.36377 9.86328 3.34424C9.90234 3.32471 9.94792 3.31494 10 3.31494C10.0391 3.31494 10.0749 3.32471 10.1074 3.34424C10.14 3.36377 10.1758 3.39307 10.2148 3.43213C10.2539 3.47119 10.2832 3.507 10.3027 3.53955C10.3223 3.5721 10.332 3.60791 10.332 3.64697V7.33838L13.1641 4.46729C13.2031 4.42822 13.2422 4.39893 13.2812 4.37939C13.3203 4.35986 13.3594 4.3501 13.3984 4.3501C13.4505 4.3501 13.4961 4.35986 13.5352 4.37939C13.5742 4.39893 13.6133 4.42822 13.6523 4.46729C13.6914 4.50635 13.7207 4.54541 13.7402 4.58447C13.7598 4.62354 13.7695 4.66911 13.7695 4.72119C13.7695 4.76025 13.7598 4.79932 13.7402 4.83838C13.7207 4.87744 13.6914 4.9165 13.6523 4.95557L10.332 8.27588V10.561H12.6172L15.918 7.24072C15.957 7.20166 15.9961 7.17236 16.0352 7.15283C16.0742 7.1333 16.1133 7.12354 16.1523 7.12354C16.2044 7.12354 16.25 7.1333 16.2891 7.15283C16.3281 7.17236 16.3672 7.20166 16.4062 7.24072C16.4453 7.27979 16.4746 7.31885 16.4941 7.35791C16.5137 7.39697 16.5234 7.44255 16.5234 7.49463C16.5234 7.53369 16.5137 7.57275 16.4941 7.61182C16.4746 7.65088 16.4453 7.68994 16.4062 7.729L13.5547 10.561H17.2461C17.2852 10.561 17.3242 10.5708 17.3633 10.5903C17.4023 10.6099 17.4349 10.6392 17.4609 10.6782C17.5 10.7173 17.5293 10.7531 17.5488 10.7856C17.5684 10.8182 17.5781 10.854 17.5781 10.8931C17.5781 10.9451 17.5684 10.9907 17.5488 11.0298C17.5293 11.0688 17.5 11.1014 17.4609 11.1274C17.4349 11.1665 17.4023 11.1925 17.3633 11.2056C17.3242 11.2186 17.2852 11.2251 17.2461 11.2251H13.5547L16.4258 14.0767C16.4648 14.1157 16.4941 14.1548 16.5137 14.1938C16.5332 14.2329 16.543 14.272 16.543 14.311C16.543 14.3631 16.5332 14.4087 16.5137 14.4478C16.4941 14.4868 16.4648 14.5259 16.4258 14.5649C16.3867 14.604 16.3477 14.6333 16.3086 14.6528C16.2695 14.6724 16.224 14.6821 16.1719 14.6821C16.1328 14.6821 16.0938 14.6724 16.0547 14.6528C16.0156 14.6333 15.9766 14.604 15.9375 14.5649L12.6172 11.2251H10.332V13.5103L13.6523 16.8501C13.6914 16.8892 13.7207 16.9282 13.7402 16.9673C13.7598 17.0063 13.7695 17.0454 13.7695 17.0845C13.7695 17.1366 13.7598 17.1821 13.7402 17.2212C13.7207 17.2603 13.6914 17.2993 13.6523 17.3384C13.6133 17.3774 13.5742 17.4067 13.5352 17.4263C13.4961 17.4458 13.4505 17.4556 13.3984 17.4556C13.3594 17.4556 13.3203 17.4458 13.2812 17.4263C13.2422 17.4067 13.2031 17.3774 13.1641 17.3384L10.332 14.4478V18.1587C10.332 18.1978 10.3223 18.2336 10.3027 18.2661C10.2832 18.2987 10.2539 18.3345 10.2148 18.3735C10.1758 18.4126 10.14 18.4386 10.1074 18.4517C10.0749 18.4647 10.0391 18.4712 10 18.4712C9.94792 18.4712 9.90234 18.4647 9.86328 18.4517C9.82422 18.4386 9.79167 18.4126 9.76562 18.3735C9.72656 18.3475 9.70052 18.3149 9.6875 18.2759C9.67448 18.2368 9.66797 18.1912 9.66797 18.1392V14.4478Z"
                          fill="black" />
                      </svg>Services
                    </h4>
                    <ul>
                      <?php $roommnt = explode(',',$room_amenity1); ?>
                      @foreach($roommnt as $roomfac)
                      @if(trim($roomfac) == 'Air conditioning')
                      <li class="tr-available">Air conditioning</li>
                      @endif
                      @endforeach
                    </ul>
                  </div>
                  @endif
                  @if(!empty($amenities2))
                  <?php $allamenities2 = explode(',',$amenities2); ?>

                  <div>
                    <h4><svg width="20" height="21" viewBox="0 0 20 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                          d="M16.6719 6.14307H3.33854C2.41807 6.14307 1.67188 6.88926 1.67188 7.80973V16.1431C1.67188 17.0635 2.41807 17.8097 3.33854 17.8097H16.6719C17.5923 17.8097 18.3385 17.0635 18.3385 16.1431V7.80973C18.3385 6.88926 17.5923 6.14307 16.6719 6.14307Z"
                          stroke="#222222" stroke-linecap="round" stroke-linejoin="round" />
                        <path
                          d="M13.3385 17.8091V4.47575C13.3385 4.03372 13.1629 3.6098 12.8504 3.29724C12.5378 2.98468 12.1139 2.80908 11.6719 2.80908H8.33854C7.89651 2.80908 7.47259 2.98468 7.16003 3.29724C6.84747 3.6098 6.67188 4.03372 6.67188 4.47575V17.8091"
                          stroke="#222222" stroke-linecap="round" stroke-linejoin="round" />
                      </svg>Reception services</h4>
                    <ul>
                      @foreach($allamenities2 as $allmnt)
                      @if(trim($allmnt) == '24 hour Front Desk Service')
                      <li class="tr-available">24 hour Front Desk Service</li>
                      @endif
                      @endforeach
                    </ul>
                  </div>
                  @endif

                  @if(!empty($amenities2))
                  <?php $allamenities2 = explode(',',$amenities2); ?>
                  <div>
                    <h4><svg width="20" height="21" viewBox="0 0 20 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                          d="M12.4948 4.26807C12.4948 6.56925 11.2543 8.64307 8.95312 8.64307C11.2543 8.64307 12.4948 10.7169 12.4948 13.0181C12.4948 10.7169 13.7353 8.64307 16.0365 8.64307C13.7353 8.64307 12.4948 6.56925 12.4948 4.26807Z"
                          stroke="#222222" stroke-width="1.10625" stroke-linecap="round" stroke-linejoin="round" />
                        <path
                          d="M6.66146 10.9347C6.66146 12.3154 5.33384 13.6431 3.95312 13.6431C5.33384 13.6431 6.66146 14.9707 6.66146 16.3514C6.66146 14.9707 7.98908 13.6431 9.36979 13.6431C7.98908 13.6431 6.66146 12.3154 6.66146 10.9347Z"
                          stroke="#222222" stroke-width="1.10625" stroke-linecap="round" stroke-linejoin="round" />
                      </svg>Cleaning Services</h4>
                    <ul>
                      @foreach($allamenities2 as $callmnt)
                      @if(trim($callmnt) == 'Laundry service')
                      <li class="tr-available">Laundry</li>
                      @endif
                      @endforeach
                    </ul>
                  </div>
                  @endif
                  @if(!empty($amenities2))
                  <?php $allamenities2 = explode(',',$amenities2); ?>
                  <div>
                    <h4>
                      <svg width="20" height="21" viewBox="0 0 20 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                          d="M14.1019 3.45947H3.73148C2.91328 3.45947 2.25 4.12275 2.25 4.94095V15.3113C2.25 16.1295 2.91328 16.7928 3.73148 16.7928H14.1019C14.9201 16.7928 15.5833 16.1295 15.5833 15.3113V4.94095C15.5833 4.12275 14.9201 3.45947 14.1019 3.45947Z"
                          stroke="#222222" stroke-linecap="round" stroke-linejoin="round" />
                        <path
                          d="M6.69531 13.8298V6.42236H9.65828C10.2476 6.42236 10.8129 6.65649 11.2296 7.07324C11.6464 7.48998 11.8805 8.05522 11.8805 8.64459C11.8805 9.23396 11.6464 9.79919 11.2296 10.2159C10.8129 10.6327 10.2476 10.8668 9.65828 10.8668H6.69531"
                          stroke="#222222" stroke-linecap="round" stroke-linejoin="round" />
                      </svg>Parking
                    </h4>
                    <ul>
                      @foreach($allamenities2 as $allmnt)
                      @if(trim($allmnt) == 'Parking')
                      <li class="tr-available">parking available</li>
                      @endif
                      @endforeach
                    </ul>
                  </div>
                  @endif
                </div>



              </div>
              <div class="tr-facilities-lists tr-mobile d-block d-md-none">
                <div class="tr-facilities-list">
                  @if(!empty($amenities_array))
                  <ul>
                    @foreach ($amenities_array as $mnt)
                    <li>{{$mnt}}</li>
                    @endforeach
                  </ul>
                  <div class="tr-show-all"><a href="javascript:void(0);">Show all</a></div>
                  @else
                  <p>Amenities Not Available.</p>
                  @endif
                </div>
              </div>
            </div>
            <!--FACILITIES SECTION - END-->

            <!--LOCATION SECTION - START-->
            <div class="tr-Location-section tr-tab-section" id="locationTab">
              <h3>Location</h3>
              <div class="tr-Location-details">
                <ul>
                  @if($searchresult[0]->address != "") <li class="tr-location-address">{{$searchresult[0]->address}}
                  </li>@endif
                  <li class="tr-phone">@if(!empty($searchresult[0]->Phone)) +{{$searchresult[0]->Phone}} @else Not
                    Available. @endif</li>
                  <li class="tr-email">@if(!empty($searchresult[0]->Email)) {{$searchresult[0]->Email}} @else Not
                    Available. @endif</li>
                  <li class="tr-website-link"><a href="@if(!empty($searchresult[0]->Website)) {{$searchresult[0]->Website}}
            @endif" target="_blank">Visit website</a></li>
                </ul>
              </div>

              <?php   
              $latitude ="";
              $longitude=""  ;

              $latitude = $searchresult[0]->Latitude;
              $longitude = $searchresult[0]->longnitude;

              ?>

              <div class="tr-location-map">
                @if($searchresult[0]->Latitude != "" && $searchresult[0]->longnitude != "")
                <!-- <img  src="{{ asset('/public/frontend/hotel-detail/images/map.png')}}" alt="Map"> -->
                <div id="map1" class="" style="width: 100%; height: 400px;"></div>

                <div id="screenshotContainer"></div>
                @endif
              </div>
              <!-- static content 3 -->
              <!-- <p>The neighborhood is a blend of ancient history and modern dynamism. Walk among towering skyscrapers and
                historic pubs, enjoying the juxtaposition of old and new. Explore the bustling Leadenhall Market,
                brimming with charm and vibrant stalls. Financial district by day, the City transforms into a tranquil
                area by night, offering unique experiences like night tours of iconic landmarks. Its rich history and
                contemporary vibrancy make the City of London a captivating destination.</p> -->
            </div>
            <!--LOCATION SECTION - END-->

            <!--EXPLORE OTHER OPTIONS IN AND AROUND SECTION - START-->
            <div class="tr-explore-section">
              <h3 class="d-none d-md-block">Explore other options in and around</h3>
              <div class="tr-tourist-places-row">
                <div class="tr-tourist-places">
                  <div class="tr-title open">
                    <h4><svg width="25" height="25" viewBox="0 0 25 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                          d="M17.3335 5.05859C17.3335 6.20565 16.2305 7.30859 15.0835 7.30859C16.2305 7.30859 17.3335 8.41154 17.3335 9.55859C17.3335 8.41154 18.4364 7.30859 19.5835 7.30859C18.4364 7.30859 17.3335 6.20565 17.3335 5.05859Z"
                          stroke="#131313" stroke-linecap="round" stroke-linejoin="round" />
                        <path
                          d="M17.3335 15.0586C17.3335 16.2056 16.2305 17.3086 15.0835 17.3086C16.2305 17.3086 17.3335 18.4115 17.3335 19.5586C17.3335 18.4115 18.4364 17.3086 19.5835 17.3086C18.4364 17.3086 17.3335 16.2056 17.3335 15.0586Z"
                          stroke="#131313" stroke-linecap="round" stroke-linejoin="round" />
                        <path
                          d="M9.3335 8.05859C9.3335 10.2252 7.25015 12.3086 5.0835 12.3086C7.25015 12.3086 9.3335 14.3919 9.3335 16.5586C9.3335 14.3919 11.4168 12.3086 13.5835 12.3086C11.4168 12.3086 9.3335 10.2252 9.3335 8.05859Z"
                          stroke="#131313" stroke-linecap="round" stroke-linejoin="round" />
                      </svg>Top attractions</h4>
                    <span class="d-none d-md-block">Sorted by nearest @if(!$nearby_sight->isEmpty()) within
                      {{$nearby_sight[0]->radius}} km @endif</span>
                  </div>
                  <div class="tr-tourist-place-lists" id="nba">

                    @if(!$nearby_sight->isEmpty())
                    @foreach($nearby_sight as $value)

                    <div class="tr-tourist-place">
                      <div class="tr-img">
                        <a href="javascript:void(0);"><img  src="images/tourist-places-1.png"
                            alt="tourist-places"></a>
                      </div>
                      <div class="tr-details">
                        <div class="tr-place-name"><a
                            href="{{ asset('at-'.$value->LocationId.'-'.$value->SightId.'-'.strtolower($value->slug)) }}">{{$value->name}}</a>
                        </div>
                        <div class="tr-place-type">Shopping area</div>
                        <div class="tr-like-review">
                          <span class="tr-likes">35% (static)</span>
                          <span class="tr-review">. 22 reviews</span>
                        </div>
                        <div class="tr-distance">{{ round($value->distance,2) }} Km</div>
                      </div>
                    </div>
                    @endforeach
                    @else
                    <div class="tr-tourist-place">
                      <p>Nearby attraction not found.</p>
                    </div>
                    @endif

                  </div>
                </div>
                <div class="tr-tourist-places" id="nearbyrest">
                  <div class="tr-title">
                    <h4><svg width="24" height="20" viewBox="0 0 19 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                          d="M1.63492 1.90625L15.6158 15.8871C15.8811 16.1524 16.0301 16.5122 16.0301 16.8874C16.0301 17.2626 15.8811 17.6224 15.6158 17.8877C15.3504 18.1529 14.9906 18.3018 14.6155 18.3018C14.2404 18.3018 13.8806 18.1529 13.6152 17.8877L10.2 14.4136C9.97647 14.1867 9.85109 13.881 9.85086 13.5625V13.3526C9.85089 13.1918 9.81897 13.0326 9.75695 12.8842C9.69494 12.7358 9.60406 12.6012 9.4896 12.4882L9.04865 12.081C8.89896 11.9429 8.71694 11.8447 8.51933 11.7953C8.32172 11.746 8.11487 11.7471 7.91783 11.7987C7.6071 11.8798 7.28058 11.8782 6.97065 11.7942C6.66071 11.7101 6.37816 11.5464 6.15101 11.3194L2.90918 8.07722C0.986021 6.15405 0.278307 3.24996 1.63492 1.90625Z"
                          stroke="#131313" stroke-linejoin="round"></path>
                        <path
                          d="M14.6312 1.30859L11.6998 4.24001C11.4742 4.46554 11.2953 4.73329 11.1732 5.02798C11.0511 5.32267 10.9883 5.63852 10.9883 5.9575V6.52139C10.9883 6.60118 10.9726 6.68018 10.9421 6.75389C10.9115 6.82759 10.8668 6.89456 10.8103 6.95096L10.3811 7.38014M11.5954 8.59445L12.0246 8.16526C12.081 8.10883 12.148 8.06407 12.2217 8.03353C12.2954 8.00299 12.3744 7.98728 12.4542 7.98729H13.0181C13.3371 7.98729 13.6529 7.92446 13.9476 7.80238C14.2423 7.6803 14.51 7.50136 14.7356 7.27578L17.667 4.34437M16.1491 2.82648L13.1133 5.86225M7.04179 14.0588L3.2577 17.8642C2.97305 18.1487 2.58704 18.3086 2.18455 18.3086C1.78207 18.3086 1.39605 18.1487 1.11141 17.8642C0.826849 17.5795 0.666992 17.1935 0.666992 16.791C0.666992 16.3885 0.826849 16.0025 1.11141 15.7179L4.30959 12.541"
                          stroke="#131313" stroke-linecap="round" stroke-linejoin="round"></path>
                      </svg>Restaurants</h4>
                    <span class="d-none d-md-block">@if(!$nearby_rest->isEmpty()) Within {{ $restradus}} KM
                      @endif</span>
                  </div>
                  <div class="tr-tourist-place-lists">
                    @if(!$nearby_rest->isEmpty())
                    @foreach($nearby_rest as $value)
                    <div class="tr-tourist-place">
                      <div class="tr-img">
                        <a href="javascript:void(0);"><img  src="images/tourist-places-4.png"
                            alt="tourist-places"></a>
                      </div>
                      <div class="tr-details">
                        <div class="tr-place-name"><a
                            href="{{ asset('rd-'.$value->slugid.'-'.$value->RestaurantId.'-'.strtolower($value->Slug)) }}">{{$value->Title}}</a>
                        </div>
                        <div class="tr-place-type">Shopping area</div>
                        <div class="tr-like-review">
                          <span class="tr-likes">{{$value->TATrendingScore}}% </span>
                          <span class="tr-review">.{{$value->review_count}} reviews</span>
                        </div>
                        <div class="tr-distance">{{ round($value->distance,2) }} km</div>
                      </div>
                    </div>
                    @endforeach
                    @else
                    <p>Nearby restaurant not found.</p>
                    @endif

                  </div>
                </div>


                <!-- end data rest -->
                <!-- <div class="tr-tourist-places">
                  <div class="tr-title">
                    <h4><svg width="25" height="25" viewBox="0 0 25 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                          d="M17.3335 5.05859C17.3335 6.20565 16.2305 7.30859 15.0835 7.30859C16.2305 7.30859 17.3335 8.41154 17.3335 9.55859C17.3335 8.41154 18.4364 7.30859 19.5835 7.30859C18.4364 7.30859 17.3335 6.20565 17.3335 5.05859Z"
                          stroke="#131313" stroke-linecap="round" stroke-linejoin="round" />
                        <path
                          d="M17.3335 15.0586C17.3335 16.2056 16.2305 17.3086 15.0835 17.3086C16.2305 17.3086 17.3335 18.4115 17.3335 19.5586C17.3335 18.4115 18.4364 17.3086 19.5835 17.3086C18.4364 17.3086 17.3335 16.2056 17.3335 15.0586Z"
                          stroke="#131313" stroke-linecap="round" stroke-linejoin="round" />
                        <path
                          d="M9.3335 8.05859C9.3335 10.2252 7.25015 12.3086 5.0835 12.3086C7.25015 12.3086 9.3335 14.3919 9.3335 16.5586C9.3335 14.3919 11.4168 12.3086 13.5835 12.3086C11.4168 12.3086 9.3335 10.2252 9.3335 8.05859Z"
                          stroke="#131313" stroke-linecap="round" stroke-linejoin="round" />
                      </svg>Getting there</h4>
                    <span class="d-none d-md-block">Walkable places</span>
                  </div>
                  <div class="tr-tourist-place-lists">
                    <div class="tr-getting-lists">
                      <div class="tr-getting-list">
                        <div class="tr-place-info">
                          <div class="tr-place-name">Great for walks</div>
                          <span>Grade: 100 out of 100</span>
                        </div>
                        <div class="tr-distance">100</div>
                      </div>
                      <div class="tr-getting-list">
                        <div class="tr-place-info">
                          <div class="tr-place-name"><svg width="18" height="17" viewBox="0 0 18 17" fill="none"
                              xmlns="http://www.w3.org/2000/svg">
                              <path
                                d="M11.6677 8.21686L11.4782 8.25293L11.4075 8.43241L8.58835 15.5894L7.6097 15.7757L8.3748 9.30726L8.4309 8.83302L7.96178 8.92232L3.5739 9.75759L3.37156 9.79611L3.30699 9.99171L2.47522 12.5116L1.87823 12.6253L1.98228 9.2217L1.98466 9.14395L1.95388 9.07252L0.606627 5.94522L1.20367 5.83157L2.90392 7.86957L3.03583 8.02769L3.23812 7.98919L7.626 7.15392L8.09517 7.0646L7.86869 6.64412L4.77982 0.909331L5.75841 0.723048L11.0099 6.34373L11.1416 6.48469L11.3311 6.44861L15.7902 5.59979C16.0247 5.55515 16.2673 5.60549 16.4647 5.73973L16.6615 5.45033L16.4647 5.73973C16.6621 5.87398 16.798 6.08113 16.8426 6.31561C16.8873 6.55009 16.8369 6.79271 16.7027 6.99007L16.9921 7.18692L16.7027 6.99007C16.5685 7.18744 16.3613 7.3234 16.1268 7.36803L11.6677 8.21686Z"
                                stroke="black" stroke-width="0.7" />
                            </svg>London city airport</div>
                          <span class="tr-distance-time"><svg width="13" height="14" viewBox="0 0 13 14" fill="none"
                              xmlns="http://www.w3.org/2000/svg">
                              <path
                                d="M2.7085 12.1211L1.3335 13.4961M10.9585 12.1211L12.3335 13.4961M4.771 9.3711H4.77718M8.88981 9.3711H8.896M2.021 5.24609C4.771 7.99609 9.23975 7.99609 11.646 5.24609"
                                stroke="#222222" stroke-width="0.8" stroke-linecap="round" stroke-linejoin="round" />
                              <path
                                d="M2.20862 4.48572C2.77305 1.61334 3.55406 1.12109 6.45874 1.12109H7.20812C10.1128 1.12109 10.8931 1.61334 11.4582 4.48572L11.8384 6.42172C12.3575 9.06172 12.6167 10.3817 11.8604 11.2514C11.1042 12.1211 9.68106 12.1211 6.83343 12.1211C3.98649 12.1211 2.56268 12.1211 1.80643 11.2514C1.05018 10.3817 1.30937 9.06172 1.82843 6.42172L2.20862 4.48572Z"
                                stroke="#222222" stroke-width="0.8" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>20 min</span>
                          <a href="javascript:void(0);" class="tr-travel-type">See all flghts</a>
                        </div>
                        <div class="tr-distance">0.88 km</div>
                      </div>
                      <div class="tr-getting-list">
                        <div class="tr-place-info">
                          <div class="tr-place-name"><svg width="18" height="17" viewBox="0 0 18 17" fill="none"
                              xmlns="http://www.w3.org/2000/svg">
                              <path
                                d="M11.6677 8.21686L11.4782 8.25293L11.4075 8.43241L8.58835 15.5894L7.6097 15.7757L8.3748 9.30726L8.4309 8.83302L7.96178 8.92232L3.5739 9.75759L3.37156 9.79611L3.30699 9.99171L2.47522 12.5116L1.87823 12.6253L1.98228 9.2217L1.98466 9.14395L1.95388 9.07252L0.606627 5.94522L1.20367 5.83157L2.90392 7.86957L3.03583 8.02769L3.23812 7.98919L7.626 7.15392L8.09517 7.0646L7.86869 6.64412L4.77982 0.909331L5.75841 0.723048L11.0099 6.34373L11.1416 6.48469L11.3311 6.44861L15.7902 5.59979C16.0247 5.55515 16.2673 5.60549 16.4647 5.73973L16.6615 5.45033L16.4647 5.73973C16.6621 5.87398 16.798 6.08113 16.8426 6.31561C16.8873 6.55009 16.8369 6.79271 16.7027 6.99007L16.9921 7.18692L16.7027 6.99007C16.5685 7.18744 16.3613 7.3234 16.1268 7.36803L11.6677 8.21686Z"
                                stroke="black" stroke-width="0.7" />
                            </svg>Heatthrow airport</div>
                          <span class="tr-distance-time"><svg width="13" height="14" viewBox="0 0 13 14" fill="none"
                              xmlns="http://www.w3.org/2000/svg">
                              <path
                                d="M2.7085 12.1211L1.3335 13.4961M10.9585 12.1211L12.3335 13.4961M4.771 9.3711H4.77718M8.88981 9.3711H8.896M2.021 5.24609C4.771 7.99609 9.23975 7.99609 11.646 5.24609"
                                stroke="#222222" stroke-width="0.8" stroke-linecap="round" stroke-linejoin="round" />
                              <path
                                d="M2.20862 4.48572C2.77305 1.61334 3.55406 1.12109 6.45874 1.12109H7.20812C10.1128 1.12109 10.8931 1.61334 11.4582 4.48572L11.8384 6.42172C12.3575 9.06172 12.6167 10.3817 11.8604 11.2514C11.1042 12.1211 9.68106 12.1211 6.83343 12.1211C3.98649 12.1211 2.56268 12.1211 1.80643 11.2514C1.05018 10.3817 1.30937 9.06172 1.82843 6.42172L2.20862 4.48572Z"
                                stroke="#222222" stroke-width="0.8" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>20 min</span>
                          <a href="javascript:void(0);" class="tr-travel-type">See all flghts</a>
                        </div>
                        <div class="tr-distance">0.88 km</div>
                      </div>
                      <div class="tr-getting-list">
                        <div class="tr-place-info">
                          <div class="tr-place-name"><svg width="20" height="17" viewBox="0 0 20 17" fill="none"
                              xmlns="http://www.w3.org/2000/svg">
                              <path
                                d="M17.0835 9.43359H14.8335M3.58349 9.43359H5.83349M17.4116 5.68359L15.9485 1.78191C15.7289 1.19645 15.1693 0.808594 14.544 0.808594H6.12299C5.49773 0.808594 4.93804 1.19645 4.7185 1.78191L3.25537 5.68359M17.4116 5.68359L17.6299 6.26568C17.7524 6.59225 18.0646 6.80859 18.4133 6.80859C18.9068 6.80859 19.293 7.23341 19.2463 7.72462L18.8335 12.0586M17.4116 5.68359H18.9585M3.25537 5.68359L3.03708 6.26568C2.91462 6.59225 2.60243 6.80859 2.25366 6.80859C1.76023 6.80859 1.37395 7.23341 1.42073 7.72462L1.83349 12.0586M3.25537 5.68359H1.70849M1.83349 12.0586L1.95418 13.3258C2.0275 14.0957 2.67408 14.6836 3.44742 14.6836H3.5835M1.83349 12.0586V12.0586C1.55735 12.0586 1.3335 12.2824 1.3335 12.5586V15.0586C1.3335 15.4728 1.66928 15.8086 2.0835 15.8086H2.8335C3.24771 15.8086 3.5835 15.4728 3.5835 15.0586V14.6836M3.5835 14.6836H17.0835M17.0835 14.6836H17.2196C17.9929 14.6836 18.6395 14.0957 18.7128 13.3258L18.8335 12.0586M17.0835 14.6836V15.0586C17.0835 15.4728 17.4193 15.8086 17.8335 15.8086H18.5835C18.9977 15.8086 19.3335 15.4728 19.3335 15.0586V12.5586C19.3335 12.2825 19.1096 12.0586 18.8335 12.0586V12.0586M6.24161 3.33425L5.41255 5.82142C5.25067 6.30707 5.61214 6.80859 6.12406 6.80859H14.5429C15.0548 6.80859 15.4163 6.30707 15.2544 5.82142L14.4254 3.33425C14.2212 2.72174 13.648 2.68359 13.0024 2.68359H7.66463C7.01899 2.68359 6.44578 2.72174 6.24161 3.33425Z"
                                stroke="black" stroke-width="0.7" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>King's Cross St. Pancras</div>
                          <span class="tr-distance-time"><svg width="13" height="14" viewBox="0 0 13 14" fill="none"
                              xmlns="http://www.w3.org/2000/svg">
                              <path
                                d="M2.7085 12.1211L1.3335 13.4961M10.9585 12.1211L12.3335 13.4961M4.771 9.3711H4.77718M8.88981 9.3711H8.896M2.021 5.24609C4.771 7.99609 9.23975 7.99609 11.646 5.24609"
                                stroke="#222222" stroke-width="0.8" stroke-linecap="round" stroke-linejoin="round" />
                              <path
                                d="M2.20862 4.48572C2.77305 1.61334 3.55406 1.12109 6.45874 1.12109H7.20812C10.1128 1.12109 10.8931 1.61334 11.4582 4.48572L11.8384 6.42172C12.3575 9.06172 12.6167 10.3817 11.8604 11.2514C11.1042 12.1211 9.68106 12.1211 6.83343 12.1211C3.98649 12.1211 2.56268 12.1211 1.80643 11.2514C1.05018 10.3817 1.30937 9.06172 1.82843 6.42172L2.20862 4.48572Z"
                                stroke="#222222" stroke-width="0.8" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>20 min</span>
                          <span class="tr-travel-type">Underground</span>
                        </div>
                        <div class="tr-distance">0.88 km</div>
                      </div>
                      <div class="tr-getting-list">
                        <div class="tr-place-info">
                          <div class="tr-place-name"><svg width="20" height="17" viewBox="0 0 20 17" fill="none"
                              xmlns="http://www.w3.org/2000/svg">
                              <path
                                d="M17.0835 9.43359H14.8335M3.58349 9.43359H5.83349M17.4116 5.68359L15.9485 1.78191C15.7289 1.19645 15.1693 0.808594 14.544 0.808594H6.12299C5.49773 0.808594 4.93804 1.19645 4.7185 1.78191L3.25537 5.68359M17.4116 5.68359L17.6299 6.26568C17.7524 6.59225 18.0646 6.80859 18.4133 6.80859C18.9068 6.80859 19.293 7.23341 19.2463 7.72462L18.8335 12.0586M17.4116 5.68359H18.9585M3.25537 5.68359L3.03708 6.26568C2.91462 6.59225 2.60243 6.80859 2.25366 6.80859C1.76023 6.80859 1.37395 7.23341 1.42073 7.72462L1.83349 12.0586M3.25537 5.68359H1.70849M1.83349 12.0586L1.95418 13.3258C2.0275 14.0957 2.67408 14.6836 3.44742 14.6836H3.5835M1.83349 12.0586V12.0586C1.55735 12.0586 1.3335 12.2824 1.3335 12.5586V15.0586C1.3335 15.4728 1.66928 15.8086 2.0835 15.8086H2.8335C3.24771 15.8086 3.5835 15.4728 3.5835 15.0586V14.6836M3.5835 14.6836H17.0835M17.0835 14.6836H17.2196C17.9929 14.6836 18.6395 14.0957 18.7128 13.3258L18.8335 12.0586M17.0835 14.6836V15.0586C17.0835 15.4728 17.4193 15.8086 17.8335 15.8086H18.5835C18.9977 15.8086 19.3335 15.4728 19.3335 15.0586V12.5586C19.3335 12.2825 19.1096 12.0586 18.8335 12.0586V12.0586M6.24161 3.33425L5.41255 5.82142C5.25067 6.30707 5.61214 6.80859 6.12406 6.80859H14.5429C15.0548 6.80859 15.4163 6.30707 15.2544 5.82142L14.4254 3.33425C14.2212 2.72174 13.648 2.68359 13.0024 2.68359H7.66463C7.01899 2.68359 6.44578 2.72174 6.24161 3.33425Z"
                                stroke="black" stroke-width="0.7" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>Rental cars</div>
                          <a href="javascript:void(0);" class="tr-travel-type">See rental cars</a>
                        </div>
                      </div>
                    </div>
                  </div>
                </div> -->

              </div>
            </div>
            <!--EXPLORE OTHER OPTIONS IN AND AROUND SECTION - END-->

            <!--TOP WAYS TO EXPERIENCE TOWER BRIDGE SECTION - START-->
            <div class="tr-top-ways-section">
              <h3>Top ways to experience {{$searchresult[0]->name}}</h3>
              <div class="tr-top-ways-lists" id="nearby_exp">
                @if(!$get_experience->isEmpty())
                @foreach($get_experience as $get_experiences)
                <div class="tr-top-ways-list">
                  <div class="tr-img">
                    <a
                      href="{{route('experince',[$get_experiences->slugid.'-'.$get_experiences->ExperienceId.'-'.$get_experiences->Slug])}}"><img
                        
                        src='  @if($get_experiences->Img1 !=""){{$get_experiences->Img1}}  @else {{asset("public/images/Hotel lobby.svg")}} @endif'
                        alt="top-places"></a>
                  </div>
                  <div class="tr-details">
                    <div class="tr-place-type">Classes</div>
                    <div class="tr-place-name"><a
                        href='@if($get_experiences->viator_url != ""){{$get_experiences->viator_url}}  @endif'>{{$get_experiences->Name}}</a>
                    </div>
                    <div class="tr-like-review">
                      <span class="tr-likes"><svg width="14" height="13" viewBox="0 0 14 13" fill="none"
                          xmlns="http://www.w3.org/2000/svg">
                          <path fill-rule="evenodd" clip-rule="evenodd"
                            d="M6.99847 2.82194C5.79052 1.46927 3.7762 1.10541 2.26273 2.34405C0.749264 3.58269 0.536189 5.65364 1.72472 7.11858L6.99847 12.0026L12.2722 7.11858C13.4607 5.65364 13.2737 3.56966 11.7342 2.34405C10.1947 1.11844 8.20641 1.46927 6.99847 2.82194Z"
                            stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>{{ $get_experiences->TAAggregationRating }}%</span>
                      <span class="tr-review">({{ $get_experiences->review_count }} reviews)</span>
                    </div>
                    <div class="tr-price-section"><span> {{ $get_experiences->Cost }}</span> /adult</div>
                  </div>
                </div>

                @endforeach
                @else
                <p>Experience not found.</p>
                @endif

              </div>
            </div>
            <!--TOP WAYS TO EXPERIENCE TOWER BRIDGE SECTION - END-->

            <!--REVIEWS SECTION - START-->
            <div class="tr-review-section tr-tab-section" id="reviewTab">
              <div class="row">
                <h3>Reviews</h3>
                @if(!$review->isEmpty())
                <div class="col-lg-7">
         
                  <div class="tr-review-content">
                    <div class="tr-power-by">
                      <ul>
                        <li><img  src="{{asset('public/frontend/hotel-detail/images/ellipse-1.png')}}"
                            alt="ellipse"></li>
                        <li><img  src="{{asset('public/frontend/hotel-detail/images/ellipse-2.png')}}"
                            alt="ellipse"></li>
                        <li><img  src="{{asset('public/frontend/hotel-detail/images/ellipse-3.png')}}"
                            alt="ellipse"></li>
                        <li><img  src="{{asset('public/frontend/hotel-detail/images/ellipse-4.png')}}"
                            alt="ellipse"></li>
                      </ul>
                      <span>Powered by AI</span>
                    </div>
                    <h4>Reviews summary</h4>
                    <div class="tr-short-decs">This summary was created by AI, based on recent reviews.</div>
                    <ul class="tr-revies-recomm">
                      <li>
                        <svg width="24" height="25" viewBox="0 0 24 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                          <path
                            d="M12 13.8086C11.2583 13.8086 10.5333 13.5887 9.91661 13.1766C9.29993 12.7646 8.81928 12.1789 8.53545 11.4937C8.25162 10.8084 8.17736 10.0544 8.32206 9.32701C8.46675 8.59958 8.8239 7.93139 9.34835 7.40695C9.8728 6.8825 10.541 6.52535 11.2684 6.38065C11.9958 6.23596 12.7498 6.31022 13.4351 6.59405C14.1203 6.87788 14.706 7.35852 15.118 7.97521C15.5301 8.59189 15.75 9.31692 15.75 10.0586C15.7488 11.0528 15.3533 12.0059 14.6503 12.7089C13.9473 13.4119 12.9942 13.8074 12 13.8086ZM12 7.8086C11.555 7.8086 11.12 7.94056 10.75 8.18779C10.38 8.43502 10.0916 8.78642 9.92127 9.19756C9.75098 9.60869 9.70642 10.0611 9.79324 10.4975C9.88005 10.934 10.0943 11.3349 10.409 11.6496C10.7237 11.9643 11.1246 12.1785 11.561 12.2654C11.9975 12.3522 12.4499 12.3076 12.861 12.1373C13.2722 11.967 13.6236 11.6786 13.8708 11.3086C14.118 10.9386 14.25 10.5036 14.25 10.0586C14.2494 9.46204 14.0122 8.89009 13.5903 8.46826C13.1685 8.04644 12.5966 7.80919 12 7.8086Z"
                            fill="#222222" />
                          <path
                            d="M12 22.8086L5.67301 15.3468C5.58509 15.2348 5.49809 15.1221 5.41201 15.0086C4.33179 13.5846 3.74799 11.8459 3.75001 10.0586C3.75001 7.87056 4.6192 5.77214 6.16637 4.22496C7.71355 2.67779 9.81197 1.80859 12 1.80859C14.188 1.80859 16.2865 2.67779 17.8336 4.22496C19.3808 5.77214 20.25 7.87056 20.25 10.0586C20.2517 11.8451 19.6682 13.5829 18.5888 15.0063L18.588 15.0086C18.588 15.0086 18.363 15.3041 18.3293 15.3438L12 22.8086ZM6.60976 14.1048C6.60976 14.1048 6.78451 14.3358 6.82426 14.3853L12 20.4896L17.1825 14.3771C17.2155 14.3358 17.391 14.1033 17.3918 14.1026C18.2747 12.9395 18.7518 11.5189 18.75 10.0586C18.75 8.26838 18.0388 6.55149 16.773 5.28562C15.5071 4.01975 13.7902 3.30859 12 3.30859C10.2098 3.30859 8.49291 4.01975 7.22703 5.28562C5.96116 6.55149 5.25001 8.26838 5.25001 10.0586C5.24815 11.5198 5.72584 12.9413 6.60976 14.1048Z"
                            fill="#222222" />
                        </svg>
                        <div>Location</div>
                        <div>Convenient</div>
                      </li>
                      <li>
                        <svg width="24" height="25" viewBox="0 0 24 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                          <path
                            d="M5.03906 19.9805C4.97656 19.9805 4.91016 19.9692 4.83984 19.9467C4.76953 19.9242 4.71094 19.883 4.66406 19.823C4.60156 19.763 4.55859 19.703 4.53516 19.643C4.51172 19.583 4.5 19.523 4.5 19.463C4.5 19.388 4.51172 19.3205 4.53516 19.2605C4.55859 19.2005 4.60156 19.1405 4.66406 19.0805C4.71094 19.0355 4.76953 18.998 4.83984 18.968C4.91016 18.938 4.97656 18.923 5.03906 18.923H6.44531V5.44547C6.44531 5.34047 6.46875 5.23922 6.51562 5.14172C6.5625 5.04422 6.625 4.95797 6.70312 4.88297C6.78125 4.79297 6.87109 4.72922 6.97266 4.69172C7.07422 4.65422 7.17969 4.63547 7.28906 4.63547H13.6406C13.7656 4.63547 13.8789 4.65047 13.9805 4.68047C14.082 4.71047 14.1719 4.76297 14.25 4.83797C14.3281 4.91297 14.3906 4.99547 14.4375 5.08547C14.4844 5.17547 14.5078 5.27297 14.5078 5.37797V5.55797H16.7109C16.8047 5.55797 16.9023 5.58047 17.0039 5.62547C17.1055 5.67047 17.2031 5.73047 17.2969 5.80547C17.375 5.89547 17.4375 5.98922 17.4844 6.08672C17.5312 6.18422 17.5547 6.28547 17.5547 6.39047V18.923H18.9609C19.0234 18.923 19.0898 18.938 19.1602 18.968C19.2305 18.998 19.2891 19.043 19.3359 19.103C19.3984 19.163 19.4414 19.223 19.4648 19.283C19.4883 19.343 19.5 19.403 19.5 19.463C19.5 19.538 19.4883 19.6055 19.4648 19.6655C19.4414 19.7255 19.3984 19.778 19.3359 19.823C19.2891 19.883 19.2305 19.9242 19.1602 19.9467C19.0898 19.9692 19.0234 19.9805 18.9609 19.9805H17.2969C17.1875 19.9805 17.082 19.9617 16.9805 19.9242C16.8789 19.8867 16.7891 19.823 16.7109 19.733C16.6172 19.658 16.5508 19.5717 16.5117 19.4742C16.4727 19.3767 16.4531 19.2755 16.4531 19.1705V6.61547H14.5078V19.1705C14.5078 19.2755 14.4844 19.3767 14.4375 19.4742C14.3906 19.5717 14.3203 19.658 14.2266 19.733C14.1484 19.823 14.0586 19.8867 13.957 19.9242C13.8555 19.9617 13.75 19.9805 13.6406 19.9805H5.03906ZM12.3047 12.308C12.3047 12.203 12.2852 12.1055 12.2461 12.0155C12.207 11.9255 12.1484 11.843 12.0703 11.768C11.9922 11.693 11.9062 11.6367 11.8125 11.5992C11.7188 11.5617 11.6172 11.543 11.5078 11.543C11.3984 11.543 11.2969 11.5617 11.2031 11.5992C11.1094 11.6367 11.0234 11.693 10.9453 11.768C10.8672 11.843 10.8086 11.9255 10.7695 12.0155C10.7305 12.1055 10.7109 12.203 10.7109 12.308C10.7109 12.413 10.7305 12.5105 10.7695 12.6005C10.8086 12.6905 10.8672 12.773 10.9453 12.848C11.0234 12.923 11.1094 12.9792 11.2031 13.0167C11.2969 13.0542 11.3984 13.073 11.5078 13.073C11.6172 13.073 11.7188 13.0542 11.8125 13.0167C11.9062 12.9792 11.9922 12.923 12.0703 12.848C12.1484 12.773 12.207 12.6905 12.2461 12.6005C12.2852 12.5105 12.3047 12.413 12.3047 12.308ZM7.54688 18.923H13.4062V5.69297H7.54688V18.923Z"
                            fill="black" />
                        </svg>
                        <div>Rooms</div>
                        <div>Comfortable</div>
                      </li>
                      <li>
                        <svg width="24" height="25" viewBox="0 0 24 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                          <path
                            d="M19.5 7.05859H4.5C3.25736 7.05859 2.25 8.06595 2.25 9.30859V18.3086C2.25 19.5512 3.25736 20.5586 4.5 20.5586H19.5C20.7426 20.5586 21.75 19.5512 21.75 18.3086V9.30859C21.75 8.06595 20.7426 7.05859 19.5 7.05859Z"
                            stroke="#222222" stroke-width="1.5" stroke-linejoin="round" />
                          <path
                            d="M19.2825 7.05784V5.65159C19.2824 5.30669 19.2062 4.96606 19.0592 4.65401C18.9123 4.34196 18.6984 4.06618 18.4326 3.84635C18.1668 3.62652 17.8558 3.46805 17.5217 3.38226C17.1877 3.29647 16.8388 3.28546 16.5 3.35003L4.155 5.45706C3.6189 5.55922 3.13526 5.84527 2.78749 6.26586C2.43972 6.68645 2.24963 7.21522 2.25 7.76096V10.0578"
                            stroke="#222222" stroke-width="1.5" stroke-linejoin="round" />
                          <path
                            d="M17.25 15.3086C16.9533 15.3086 16.6633 15.2206 16.4166 15.0558C16.17 14.891 15.9777 14.6567 15.8642 14.3826C15.7506 14.1085 15.7209 13.8069 15.7788 13.516C15.8367 13.225 15.9796 12.9577 16.1893 12.7479C16.3991 12.5382 16.6664 12.3953 16.9574 12.3374C17.2483 12.2795 17.5499 12.3092 17.824 12.4228C18.0981 12.5363 18.3324 12.7286 18.4972 12.9752C18.662 13.2219 18.75 13.5119 18.75 13.8086C18.75 14.2064 18.592 14.5879 18.3107 14.8693C18.0294 15.1506 17.6478 15.3086 17.25 15.3086Z"
                            fill="black" />
                        </svg>
                        <div>Value</div>
                        <div>Expensive</div>
                      </li>
                    </ul>
                    <!-- <p>The Pestana Chelsea Bridge hotel boasts a coveted location near Battersea Power Station,
                      celebrated by guests for its easy access to transport and local dining. While some travelers have
                      experienced rooms as dated and noisy, many praise the spacious, clean accommodations with
                      impressive views.</p> -->
                    <a href="javascript:void(0);" class="tr-jump-to-all-review">Jump to all reviews</a>
                    <div class="tr-helpful">
                      Was this helpful?
                      <button class="tr-like-button">Like</button>
                      <button class="tr-dislike-button">Dislike</button>
                    </div>
                  </div>
              
                  <div class="tr-reviews-graph">
                    <div class="tr-reviews-graph-details">
                      <h4 class="d-none d-md-block">Customers Reviews</h4>
                      <div class="tr-likes-count"><svg width="17" height="15" viewBox="0 0 17 15" fill="none"
                          xmlns="http://www.w3.org/2000/svg">
                          <path fill-rule="evenodd" clip-rule="evenodd"
                            d="M8.24504 2.98321C6.7955 1.36 4.37832 0.923362 2.56215 2.40973C0.745992 3.8961 0.490302 6.38124 1.91654 8.13917L8.24504 14L14.5735 8.13917C15.9998 6.38124 15.7753 3.88047 13.9279 2.40973C12.0805 0.938998 9.69457 1.36 8.24504 2.98321Z"
                            stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>80%</div>
                      <span class="tr-vgood">Very Good</span>
                      <div class="tr-reviews-count">(100 Reviews)</div>
                    </div>
                    <div class="tr-rating-types">
                      <div class="tr-rating-type">
                        <div class="tr-title">Cleanliness</div>
                        <div class="progress">
                          <div class="progress-bar" role="progressbar" aria-valuenow="88" aria-valuemin="0"
                            aria-valuemax="100" style="width:88%"></div>
                        </div>
                        <div class="tr-reviews-nums">88</div>
                      </div>
                      <div class="tr-rating-type">
                        <div class="tr-title">Location</div>
                        <div class="progress">
                          <div class="progress-bar" role="progressbar" aria-valuenow="30" aria-valuemin="0"
                            aria-valuemax="100" style="width:30%"></div>
                        </div>
                        <div class="tr-reviews-nums">74</div>
                      </div>
                      <div class="tr-rating-type">
                        <div class="tr-title">Service</div>
                        <div class="progress">
                          <div class="progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="0"
                            aria-valuemax="100" style="width:60%"></div>
                        </div>
                        <div class="tr-reviews-nums">14</div>
                      </div>
                      <div class="tr-rating-type">
                        <div class="tr-title">Value</div>
                        <div class="progress">
                          <div class="progress-bar" role="progressbar" aria-valuenow="30" aria-valuemin="0"
                            aria-valuemax="100" style="width:30%"></div>
                        </div>
                        <div class="tr-reviews-nums">0</div>
                      </div>
                    </div>
                  </div>
      
                  <div class="tr-reviews-mentioned">
                    <?php  // return  print_r($reviews); ?>
                    <h4>Reviews that mentioned</h4>
                    <ul>
                      <li><a href="javascript:void(0);">Cleanliness</a></li>
                      <li><a href="javascript:void(0);" class="active">Service</a></li>
                      <li><a href="javascript:void(0);">Location</a></li>
                      <li><a href="javascript:void(0);">Value</a></li>
                      <li><a href="javascript:void(0);">Value</a></li>
                    </ul>
                    <div class="tr-shotby">
                      <div class="custom-select">
                        <label>Sort by:</label>
                        <select>
                          <option>Oldest</option>
                          <option>Newest</option>
                          <option>High rated</option>
                          <option>Low rated</option>
                          <option>Cleanliness</option>
                          <option>Location</option>
                          <option>Service</option>
                          <option>Value</option>
                        </select>
                      </div>
                    </div>
                  </div>
         
                  <div class="tr-customer-reviews" id="getreview">
                  
                    @if(!$review->isEmpty())
                    @foreach($review as $reviews)
                    <div class="tr-customer-review">
                      <div class="tr-customer-details">
                        <div class="tr-customer-detail">
                          <img  src="{{asset('public/frontend/hotel-detail/images/customer.png')}}"
                            alt="customer">
                          <div class="tr-customer-name">{{$reviews->Name}}</div>
                          <div class="tr-hotel-place">London</div>
                        </div>
                        <div class="tr-report">
                          <div class="tr-report-icon"></div>
                          <div class="tr-report-popup">
                            <h5>Report this</h5>
                            <div class="tr-follow">Follow</div>
                          </div>
                        </div>
                      </div>
                      <div class="tr-ratings">
                        <span>
                          @for ($i = 0; $i < 5; $i++) @if($i < $reviews->Rating )
                            <span><i class="fa fa-star" aria-hidden="true"></i></span>
                            @else
                            <span><i class="fa fa-star-o" aria-hidden="true"></i></span>
                            @endif
                            @endfor
                        </span>
                        <span class="tr-time-ago">1 week ago</span>
                      </div>
                      <ul>
                        <li><svg width="20" height="22" viewBox="0 0 20 22" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                              d="M4.19922 17.5532C4.14714 17.5532 4.0918 17.5435 4.0332 17.5239C3.97461 17.5044 3.92578 17.4686 3.88672 17.4165C3.83464 17.3644 3.79883 17.3123 3.7793 17.2603C3.75977 17.2082 3.75 17.1561 3.75 17.104C3.75 17.0389 3.75977 16.9803 3.7793 16.9282C3.79883 16.8761 3.83464 16.8241 3.88672 16.772C3.92578 16.7329 3.97461 16.7004 4.0332 16.6743C4.0918 16.6483 4.14714 16.6353 4.19922 16.6353H5.37109V4.93604C5.37109 4.84489 5.39062 4.757 5.42969 4.67236C5.46875 4.58773 5.52083 4.51286 5.58594 4.44775C5.65104 4.36963 5.72591 4.31429 5.81055 4.28174C5.89518 4.24919 5.98307 4.23291 6.07422 4.23291H11.3672C11.4714 4.23291 11.5658 4.24593 11.6504 4.27197C11.735 4.29801 11.8099 4.34359 11.875 4.40869C11.9401 4.4738 11.9922 4.54541 12.0312 4.62354C12.0703 4.70166 12.0898 4.7863 12.0898 4.87744V5.03369H13.9258C14.0039 5.03369 14.0853 5.05322 14.1699 5.09229C14.2546 5.13135 14.3359 5.18343 14.4141 5.24854C14.4792 5.32666 14.5312 5.40804 14.5703 5.49268C14.6094 5.57731 14.6289 5.6652 14.6289 5.75635V16.6353H15.8008C15.8529 16.6353 15.9082 16.6483 15.9668 16.6743C16.0254 16.7004 16.0742 16.7394 16.1133 16.7915C16.1654 16.8436 16.2012 16.8957 16.2207 16.9478C16.2402 16.9998 16.25 17.0519 16.25 17.104C16.25 17.1691 16.2402 17.2277 16.2207 17.2798C16.2012 17.3319 16.1654 17.3774 16.1133 17.4165C16.0742 17.4686 16.0254 17.5044 15.9668 17.5239C15.9082 17.5435 15.8529 17.5532 15.8008 17.5532H14.4141C14.3229 17.5532 14.235 17.5369 14.1504 17.5044C14.0658 17.4718 13.9909 17.4165 13.9258 17.3384C13.8477 17.2733 13.7923 17.1984 13.7598 17.1138C13.7272 17.0291 13.7109 16.9412 13.7109 16.8501V5.95166H12.0898V16.8501C12.0898 16.9412 12.0703 17.0291 12.0312 17.1138C11.9922 17.1984 11.9336 17.2733 11.8555 17.3384C11.7904 17.4165 11.7155 17.4718 11.6309 17.5044C11.5462 17.5369 11.4583 17.5532 11.3672 17.5532H4.19922ZM10.2539 10.8931C10.2539 10.8019 10.2376 10.7173 10.2051 10.6392C10.1725 10.561 10.1237 10.4894 10.0586 10.4243C9.99349 10.3592 9.92188 10.3104 9.84375 10.2778C9.76562 10.2453 9.68099 10.229 9.58984 10.229C9.4987 10.229 9.41406 10.2453 9.33594 10.2778C9.25781 10.3104 9.1862 10.3592 9.12109 10.4243C9.05599 10.4894 9.00716 10.561 8.97461 10.6392C8.94206 10.7173 8.92578 10.8019 8.92578 10.8931C8.92578 10.9842 8.94206 11.0688 8.97461 11.147C9.00716 11.2251 9.05599 11.2967 9.12109 11.3618C9.1862 11.4269 9.25781 11.4757 9.33594 11.5083C9.41406 11.5409 9.4987 11.5571 9.58984 11.5571C9.68099 11.5571 9.76562 11.5409 9.84375 11.5083C9.92188 11.4757 9.99349 11.4269 10.0586 11.3618C10.1237 11.2967 10.1725 11.2251 10.2051 11.147C10.2376 11.0688 10.2539 10.9842 10.2539 10.8931ZM6.28906 16.6353H11.1719V5.15088H6.28906V16.6353Z"
                              fill="black"></path>
                          </svg>Deluxe room</li>
                        <li><svg width="25" height="25" viewBox="0 0 25 25" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                              d="M5.16406 9.47949C5.16406 8.37492 6.05949 7.47949 7.16406 7.47949H17.6641C18.7686 7.47949 19.6641 8.37492 19.6641 9.47949V17.9795C19.6641 19.0841 18.7686 19.9795 17.6641 19.9795H7.16406C6.05949 19.9795 5.16406 19.0841 5.16406 17.9795V9.47949Z"
                              stroke="#222222" stroke-width="1.28571" stroke-linecap="round" stroke-linejoin="round">
                            </path>
                            <path d="M8.41406 5.48145V8.98144" stroke="#222222" stroke-width="1.28571"
                              stroke-linecap="round" stroke-linejoin="round"></path>
                            <path d="M16.4141 5.48145V8.98144" stroke="#222222" stroke-width="1.28571"
                              stroke-linecap="round" stroke-linejoin="round"></path>
                            <path d="M8.16406 11.4814H16.6641" stroke="#222222" stroke-width="1.28571"
                              stroke-linecap="round" stroke-linejoin="round"></path>
                          </svg>1 night. {{ date('F j', strtotime($reviews->CreatedOn)) }}</li>
                        <li><svg width="20" height="21" viewBox="0 0 20 21" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                              d="M16.6615 17.8091V16.1424C16.6615 15.2584 16.3103 14.4105 15.6851 13.7854C15.06 13.1603 14.2122 12.8091 13.3281 12.8091H6.66146C5.7774 12.8091 4.92956 13.1603 4.30444 13.7854C3.67931 14.4105 3.32813 15.2584 3.32812 16.1424V17.8091"
                              stroke="#222222" stroke-linecap="round" stroke-linejoin="round"></path>
                            <path
                              d="M10.0052 9.47575C11.8462 9.47575 13.3385 7.98336 13.3385 6.14242C13.3385 4.30147 11.8462 2.80908 10.0052 2.80908C8.16426 2.80908 6.67188 4.30147 6.67188 6.14242C6.67188 7.98336 8.16426 9.47575 10.0052 9.47575Z"
                              stroke="#222222" stroke-linecap="round" stroke-linejoin="round"></path>
                          </svg>{{$reviews->go_with}} Traveller</li>
                      </ul>
                      <p>{{ $reviews->Description }}</p>
                      <a href="javascript:void(0);" class="tr-read-more">Read more</a>
                      <div class="tr-hotel-response">
                        <h5><svg width="20" height="21" viewBox="0 0 20 21" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                              d="M17.5 9.89195C17.5029 10.9918 17.2459 12.0769 16.75 13.0586C16.162 14.2351 15.2581 15.2246 14.1395 15.9164C13.021 16.6081 11.7319 16.9748 10.4167 16.9753C9.31678 16.9782 8.23176 16.7212 7.25 16.2253L2.5 17.8086L4.08333 13.0586C3.58744 12.0769 3.33047 10.9918 3.33333 9.89195C3.33384 8.57675 3.70051 7.28766 4.39227 6.16908C5.08402 5.05049 6.07355 4.14659 7.25 3.55862C8.23176 3.06273 9.31678 2.80575 10.4167 2.80862H10.8333C12.5703 2.90444 14.2109 3.63759 15.4409 4.86767C16.671 6.09775 17.4042 7.73833 17.5 9.47528V9.89195Z"
                              stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                          </svg>Hotel response :</h5>
                        <div class="tr-customer-msg">Dear guest,</div>
                        <div class="tr-customer-msg">Thank you for taking the time to share your...</div>
                        <a href="javascript:void(0)">Continue reading</a>
                      </div>
                      <div class="tr-helpful">
                        Was this helpful?
                        <button class="tr-like-button">Like</button>
                        <button class="tr-dislike-button">Dislike</button>
                      </div>
                    </div>
                    @endforeach
                    @else
                    review not found.
                    @endif
                  </div>
                  @if(!$review->isEmpty())
                  <div class="tr-pagination">
                    <nav aria-label="Page navigation example">
                      <ul class="pagination">
                        <li class="page-item">
                          <a class="page-link" href="#" aria-label="Last Previous">
                            <span aria-hidden="true"><img  src="images/left-double-arrow.png"
                                alt="Left Arrow"></span>
                          </a>
                        </li>
                        <li class="page-item">
                          <a class="page-link" href="#" aria-label="Previous">
                            <span aria-hidden="true"><img  src="images/arrow-left.png"
                                alt="Left Arrow"></span>
                          </a>
                        </li>
                        <li class="page-item"><a class="page-link active" href="javascript:void(0);">1</a></li>
                        <li class="page-item"><a class="page-link" href="javascript:void(0);">2</a></li>
                        <li class="page-item"><a class="page-link" href="javascript:void(0);">3</a></li>
                        <li class="page-item"><a class="page-link" href="javascript:void(0);">4</a></li>
                        <li class="page-item"><a class="page-link" href="javascript:void(0);">...</a></li>
                        <li class="page-item">
                          <a class="page-link" href="#" aria-label="Next">
                            <span aria-hidden="true"><img  src="images/arrow-right.png"
                                alt="Left Arrow"></span>
                          </a>
                        </li>
                        <li class="page-item">
                          <a class="page-link" href="#" aria-label="Last Next">
                            <span aria-hidden="true"><img  src="images/right-double-arrow.png"
                                alt="Left Arrow"></span>
                          </a>
                        </li>
                      </ul>
                    </nav>
                  </div>
                  @endif
                  <div class="tr-show-all d-block d-md-none">
                    <a href="javascript:void(0);">Show all reviews</a>
                  </div>
                </div>
                @endif
                <div class="col-lg-5">
                  <div class="tr-enjoyed-the-stay">
                    <h5>Enjoyed the stay?</h5>
                    <button class="tr-btn tr-write-review">Write a review</button>
                    <p>Let others know your experience here.</p>
                  </div>
                </div>
              </div>
            </div>
            <!--REVIEWS SECTION - END-->
          </div>
        </div>
      </div>

      <div class="col-lg-5 col-md-12 tr-right-col">
        <div class="tr-hotel-certificated">
          <div class="tr-families-favourite">
            <img  src="{{ asset('/public/frontend/hotel-detail/images/leaf.png')}}" alt="leaf">
            <span>Families Favourite</span>
          </div>
          <div class="tr-spotlight">
            <div class="tr-heading"><svg width="24" height="7" viewBox="0 0 24 7" fill="none"
                xmlns="http://www.w3.org/2000/svg">
                <path d="M23.3868 3.5L20.5 0.613249L17.6132 3.5L20.5 6.38675L23.3868 3.5ZM0.5 4H20.5V3H0.5V4Z"
                  fill="#09707A" />
              </svg>IN THE SPORTLIGHT<svg width="24" height="7" viewBox="0 0 24 7" fill="none"
                xmlns="http://www.w3.org/2000/svg">
                <path d="M0.613249 3.5L3.5 0.613249L6.38675 3.5L3.5 6.38675L0.613249 3.5ZM23.5 4H3.5V3H23.5V4Z"
                  fill="#09707A" />
              </svg></div>
            <div>Batch View. Delicious Food.</div>
            <div>Kids- Friendly</div>
          </div>
          <div class="tr-business-rated">
            <div class="tr-title">Great for</div>
            <div class="tr-business">Business</div>
            <div class="tr-rated">Rated 4.0</div>
            <img  src="images/icons/marketeq-icon.svg" alt="">
          </div>
        </div>
        <div class="tr-booking-deatils">
          <div class="tr-date-section">
            <label class="tr-room-guest">1 room, 2 guests</label>
            <div class="tr-add-edit-guest-count">
              <div class="tr-guests-modal">
                <div class="tr-add-edit-guest tr-total-num-of-rooms">
                  <div class="tr-guest-type">
                    <label class="tr-guest">Room</label>
                  </div>
                  <div class="tr-qty-box">
                    <button class="minus disabled" value="minus">-</button>
                    <input type="text" id="totalRoom"  class="totalRoom" value="0" id="" min="1" max="10" name="" readonly />
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
                    <input type="text" id="totalAdultsGuest" value="0" id="" min="1" max="10" name="" readonly />
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
                    <input type="text" id="totalChildrenGuest" value="0" id="" min="1" max="10" name="" readonly />
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
                    <input type="text" id="totalChildrenInfants" value="0" id="" min="1" max="10" name="" readonly />
                    <button class="plus" value="plus">+</button>
                  </div>
                </div>
              </div>
            </div>
			  
			  <?php
			  
			
			  
			  if($checkin == ""){

					if(Session::has('checkin')){
						 $dateRange = session('checkin', '');						
						$checkin = '';
						$checkout = '';
						$expdate = explode('_', $dateRange);
						$checkin =  DateTime::createFromFormat('Y-m-d', $expdate[0])->format('d M Y') ;
						$checkout =  DateTime::createFromFormat('Y-m-d', $expdate[1])->format('d M Y') ;

					}
				}  ?>
			     <span class="checkin d-none">{{$checkin}}</span>
                <span class="checkout d-none">{{$checkout}}</span>
            <div class="tr-quick-search-hotel">
              <div class="tr-quick-search">
                <div class="tr-stay-date">
                  <div class="tr-col">
                    <label>Check-in</label>
                    <input type="text" @if(Session::has('checkin')) value="{{$checkin}}" @endif id="checkInSelectDate"
                      class="checkinval2 checkin" name="" placeholder="select date" name="" autocomplete="off">
                  </div>
                  <div class="tr-col">
                    <label>Check-out</label>
                    <!-- <input type="text" @if(Session::has('checkout')) value="{{$checkout}}" @endif id="checkOutSelectDate"
                      class="checkoutval2" name="" placeholder="--/--/----" name="" autocomplete="off"> -->
                      <input type="text" @if(Session::has('checkin')) value="{{$checkout}}" @endif id="checkOutSelectDate"
                      class="checkoutval2 checkout" name="" placeholder="select date" name="" autocomplete="off">
                  </div>
                </div>
                <button type="submit" class="tr-btn filterchackinout">Get Price</button>
              </div>
              <div class="tr-calenders-modal-2">
                <div class="tr-calenders-top">
                  <div class="tr-search-info">
                      <div class="tr-total-nights" id="totalNights"></div>
                   <div class="tr-check-in-checkout-date" id="totaldates" >@if(Session::has('checkin')) {{$checkin}} @endif -
                      @if(Session::has('checkin')){{$checkout}} @endif</div>
                  </div>
                    <div class="tr-stay-date">
                    <div class="tr-col">
                        <label for="checkInDate">Check-in</label>
                       
                        <input type="text" id="checkInDate" class="dateInput checkinval2" @if(Session::has('checkin'))
                            value="{{$checkin}}" @endif placeholder="Select a date" name="" readonly autocomplete="off">
                    </div>
                    <div class="tr-col">
                        <label for="checkOutDate">Check-out</label>
                        
                        <input type="text" id="checkOutDate" class="dateInput checkoutval2" @if(Session::has('checkin'))
                            value="{{$checkout}}" @endif placeholder="Select a date" name="" readonly autocomplete="off">
                    </div>
                </div>
                </div>
               <div class="tr-calenders-section">
                    <div class="navigation">
                      <button class="prevMonth">Previous</button>
                      <button class="nextMonth">Next</button>
                    </div>
                    <div id="calendar3" class="custom-calendar">
                      <div class="monthYear"></div>
                      <div class="calendarBody"></div>
                    </div>
                    <div id="calendar4" class="custom-calendar">
                      <div class="monthYear"></div>
                      <div class="calendarBody"></div>
                    </div>
                  </div>
                  <div class="tr-action">
                    <button class="tr-clear-details">Clear dates</button>
                    <button class="tr-close-btn">Close</button>
                  </div>
              </div>
				
            </div>
          </div>

          <div class="tr-travel-sites">
            <span id="hotel_price" style="display: block;"> </span>

          </div>
          <!-- Price Sticky on Small Device -->
          <div class="tr-price-fixed-section">
            <div class="tr-price-section">
				@if($searchresult[0]->pricefrom !="")
				  <div class="tr-price">${{$searchresult[0]->pricefrom}}</div>
				  <div class="tr-sale-price">${{$searchresult[0]->pricefrom}}/night</div>
				  <div class="tr-price-tax">+850 taxes &amp; fees</div>
				@endif
            </div>
            <div class="tr-select-room-section">
              <button class="tr-btn">Select Room</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!--FAQS-->
  <div class="container">
    <div class="row">
      <div class="col-sm-12">
        <div class="tr-faqs-section">
          <h3 class="d-none d-md-block">FAQ’s about the {{$searchresult[0]->name}}</h3>
          <h3 class="d-block d-sm-block d-md-none">FAQ’s</h3>
          <span id="detailfaqdata">
            @if(!$faq->isEmpty())
            <div class="tr-faqs-ques-ans">
            </div>
            @else
            <p>No Faq found.</p>
            @endif
          </span>

          <!-- <div class="tr-faqs-ques-ans">
            <div class="tr-faqs-ques">Which facilities are available in the hotel?</div>
            <div class="tr-faqs-ans">Let’s embody your beautiful ideas together, simplify the way you visualize your
              next big things.</div>
          </div> -->

          <button class="tr-ask-a-ques d-block d-sm-block d-md-none">Ask a question</button>
          <div class="tr-popup">
            <div class="tr-popup-content">
              <h3>Ask a question</h3>
              <form>
                <label>Question</label>
                <textarea placeholder="Type your question here"></textarea>
                <button class="tr-popup-btn">Submit</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!--HOUSE RULES-->
  <div class="container">
    <div class="row">
      <div class="col-lg-7">
        <div class="tr-house-rules tr-desktop">
          <h3>House rules</h3>
          <div class="tr-rules-ques-ans">
            <div class="tr-rules-ques">Check-in</div>
            <div class="tr-rules-ans">
              <div class="tr-rules-heading"> @if(!empty($searchresult[0]->checkIn)) {{$searchresult[0]->checkIn}} @else
                Not Available. @endif</div>
              <p>Guests are required to show a photo ID and credit card at check-in</p>
            </div>
          </div>
          <div class="tr-rules-ques-ans">
            <div class="tr-rules-ques">Check-out</div>
            <div class="tr-rules-ans">
              <div class="tr-rules-heading">@if(!empty($searchresult[0]->checkOut)) {{$searchresult[0]->checkOut}} @else
                Not Available. @endif</div>
            </div>
          </div>
          <!-- <div class="tr-rules-ques-ans">
            <div class="tr-rules-ques">Cancellation/prepayment</div>
            <div class="tr-rules-ans">
              <p>Cancellation and prepayment policies vary according to accomodations type. Check what conditions might
                apply to each option when making your selection.</p>
            </div>
          </div>

          <div class="tr-rules-ques-ans">
            <div class="tr-rules-ques">Children &amp; Beds</div>
            <div class="tr-rules-ans">
              <div class="tr-rules-heading">Child policies</div>
              <ul>
                <li>Children of all ages are welcome.</li>
                <li>Children 13 and above will be charged as adults at this property</li>
              </ul>

              <div class="tr-rules-heading">Crib and extra bed policies</div>
              <ul>
                <li>Cribs and extra beds aren’t available at this property.</li>
              </ul>
            </div>
          </div>

          <div class="tr-rules-ques-ans">
            <div class="tr-rules-ques">Cards accepted at this hotel</div>
            <div class="tr-rules-ans">
              <div class="tr-rules-heading">Until 12PM</div>
            </div>
          </div>
          <div class="tr-rules-ques-ans">
            <div class="tr-rules-ques">Age restriction</div>
            <div class="tr-rules-ans">
              <p>The minimum age fo check-in is 18</p>
            </div>
          </div>
          <div class="tr-rules-ques-ans">
            <div class="tr-rules-ques">Pets</div>
            <div class="tr-rules-ans">
              <p>Pets are allowed. Charges may apply.</p>
            </div>
          </div>
          <div class="tr-rules-ques-ans">
            <div class="tr-rules-ques">Cards accepted at this hotel</div>
            <div class="tr-rules-ans">
              <svg width="224" height="30" viewBox="0 0 224 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                <rect x="0.307692" y="0.616286" width="42.4615" height="28.9231" rx="3.38461" fill="white"
                  stroke="#D9D9D9" stroke-width="0.615385" />
                <path fill-rule="evenodd" clip-rule="evenodd"
                  d="M13.0778 20.3216H10.4682L8.51131 12.8559C8.41843 12.5125 8.22121 12.2089 7.93111 12.0658C7.20714 11.7062 6.40936 11.42 5.53906 11.2757V10.9883H9.74297C10.3232 10.9883 10.7583 11.42 10.8308 11.9215L11.8462 17.3067L14.4545 10.9883H16.9916L13.0778 20.3216ZM18.4333 20.3216H15.9688L17.9982 10.9883H20.4628L18.4333 20.3216ZM23.6628 13.5743C23.7353 13.0716 24.1704 12.7842 24.6781 12.7842C25.4759 12.712 26.3449 12.8564 27.0702 13.2147L27.5053 11.2052C26.7801 10.9178 25.9823 10.7734 25.2583 10.7734C22.8663 10.7734 21.1257 12.0662 21.1257 13.8605C21.1257 15.2255 22.3586 15.9422 23.2289 16.3739C24.1704 16.8045 24.5331 17.0919 24.4605 17.5224C24.4605 18.1682 23.7353 18.4556 23.0113 18.4556C22.141 18.4556 21.2707 18.2404 20.4742 17.8808L20.0391 19.8915C20.9094 20.2499 21.8509 20.3942 22.7212 20.3942C25.4034 20.4651 27.0702 19.1736 27.0702 17.235C27.0702 14.7937 23.6628 14.6506 23.6628 13.5743ZM35.6901 20.3216L33.7332 10.9883H31.6312C31.1961 10.9883 30.7609 11.2757 30.6159 11.7062L26.9922 20.3216H29.5293L30.0357 18.9579H33.153L33.4431 20.3216H35.6901ZM31.9929 13.5L32.7169 17.0176H30.6875L31.9929 13.5Z"
                  fill="#172B85" />
                <rect x="60.6153" y="0.616286" width="42.4615" height="28.9231" rx="3.38461" fill="white"
                  stroke="#D9D9D9" stroke-width="0.615385" />
                <path fill-rule="evenodd" clip-rule="evenodd"
                  d="M82.1436 21.4293C80.6774 22.6936 78.7759 23.4568 76.6983 23.4568C72.0599 23.4568 68.2998 19.653 68.2998 14.9608C68.2998 10.2686 72.0599 6.46484 76.6983 6.46484C78.7759 6.46484 80.6774 7.22803 82.1436 8.49239C83.6098 7.22803 85.5113 6.46484 87.5889 6.46484C92.2273 6.46484 95.9874 10.2686 95.9874 14.9608C95.9874 19.653 92.2273 23.4568 87.5889 23.4568C85.5113 23.4568 83.6098 22.6936 82.1436 21.4293Z"
                  fill="#ED0006" />
                <path fill-rule="evenodd" clip-rule="evenodd"
                  d="M82.1592 21.4293C83.9663 19.8709 85.1124 17.5513 85.1124 14.9608C85.1124 12.3704 83.9663 10.0507 82.1592 8.49239C83.6254 7.22803 85.5268 6.46484 87.6045 6.46484C92.2428 6.46484 96.003 10.2686 96.003 14.9608C96.003 19.653 92.2428 23.4568 87.6045 23.4568C85.5268 23.4568 83.6254 22.6936 82.1592 21.4293Z"
                  fill="#F9A000" />
                <path fill-rule="evenodd" clip-rule="evenodd"
                  d="M82.1436 21.4293C83.9507 19.871 85.0968 17.5513 85.0968 14.9609C85.0968 12.3704 83.9507 10.0508 82.1436 8.49243C80.3365 10.0508 79.1904 12.3704 79.1904 14.9609C79.1904 17.5513 80.3365 19.871 82.1436 21.4293Z"
                  fill="#FF5E00" />
                <rect x="120.923" y="0.616286" width="42.4615" height="28.9231" rx="3.38461" fill="#1F72CD"
                  stroke="#D9D9D9" stroke-width="0.615385" />
                <path fill-rule="evenodd" clip-rule="evenodd"
                  d="M128.349 10.7734L124.318 19.6925H129.143L129.741 18.2704H131.109L131.707 19.6925H137.018V18.6071L137.491 19.6925H140.238L140.711 18.5842V19.6925H151.757L153.1 18.3074L154.357 19.6925L160.03 19.704L155.987 15.2579L160.03 10.7734H154.445L153.138 12.133L151.92 10.7734H139.904L138.872 13.0755L137.816 10.7734H133.001V11.8219L132.466 10.7734H128.349ZM144.842 12.043H151.184L153.124 14.1384L155.127 12.043H157.067L154.119 15.2596L157.067 18.4392H155.039L153.099 16.3194L151.086 18.4392H144.842V12.043ZM146.404 14.5327V13.3644V13.3633H150.362L152.089 15.2317L150.285 17.1104H146.404V15.8349H149.864V14.5327H146.404ZM129.278 12.043H131.629L134.303 18.091V12.043H136.879L138.944 16.3794L140.847 12.043H143.411V18.443H141.851L141.838 13.428L139.564 18.443H138.168L135.882 13.428V18.443H132.673L132.064 17.0082H128.778L128.17 18.4417H126.451L129.278 12.043ZM129.342 15.681L130.425 13.125L131.506 15.681H129.342Z"
                  fill="white" />
                <rect x="181.231" y="0.616286" width="42.4615" height="28.9231" rx="3.38461" fill="white"
                  stroke="#D9D9D9" stroke-width="0.615385" />
                <path fill-rule="evenodd" clip-rule="evenodd"
                  d="M193.111 19.0664H191.196C191.065 19.0664 190.954 19.1616 190.934 19.2909L190.159 24.2005C190.144 24.2974 190.219 24.3848 190.317 24.3848H191.231C191.362 24.3848 191.474 24.2895 191.494 24.16L191.703 22.8358C191.723 22.7061 191.835 22.611 191.966 22.611H192.572C193.833 22.611 194.561 22.0007 194.751 20.7913C194.836 20.2622 194.754 19.8465 194.507 19.5552C194.235 19.2356 193.752 19.0664 193.111 19.0664ZM193.332 20.8596C193.227 21.5466 192.702 21.5466 192.195 21.5466H191.906L192.109 20.2635C192.121 20.186 192.188 20.1289 192.266 20.1289H192.399C192.744 20.1289 193.071 20.1289 193.239 20.3259C193.339 20.4436 193.37 20.6182 193.332 20.8596ZM198.834 20.8376H197.917C197.839 20.8376 197.772 20.8947 197.76 20.9723L197.719 21.2287L197.655 21.1358C197.457 20.8477 197.014 20.7514 196.572 20.7514C195.559 20.7514 194.694 21.5188 194.525 22.5952C194.438 23.1321 194.562 23.6455 194.867 24.0036C195.146 24.3328 195.546 24.47 196.022 24.47C196.838 24.47 197.291 23.9451 197.291 23.9451L197.25 24.1999C197.234 24.2973 197.309 24.3846 197.407 24.3846H198.233C198.364 24.3846 198.475 24.2894 198.496 24.1599L198.991 21.0218C199.007 20.9253 198.932 20.8376 198.834 20.8376ZM197.556 22.622C197.468 23.1458 197.052 23.4974 196.522 23.4974C196.256 23.4974 196.043 23.4121 195.906 23.2503C195.771 23.0896 195.719 22.8608 195.762 22.6061C195.845 22.0867 196.268 21.7237 196.79 21.7237C197.05 21.7237 197.262 21.8101 197.401 21.9734C197.541 22.1383 197.596 22.3684 197.556 22.622ZM202.796 20.8374H203.717C203.846 20.8374 203.922 20.9821 203.848 21.088L200.784 25.5112C200.734 25.5829 200.653 25.6255 200.565 25.6255H199.645C199.516 25.6255 199.44 25.4796 199.515 25.3735L200.469 24.0267L199.454 21.0485C199.419 20.945 199.496 20.8374 199.606 20.8374H200.511C200.629 20.8374 200.732 20.9146 200.766 21.0272L201.305 22.826L202.576 20.9542C202.625 20.8811 202.708 20.8374 202.796 20.8374Z"
                  fill="#253B80" />
                <path fill-rule="evenodd" clip-rule="evenodd"
                  d="M212.785 24.2008L213.571 19.2014C213.583 19.1238 213.65 19.0667 213.728 19.0664H214.613C214.711 19.0664 214.786 19.154 214.77 19.2509L213.995 24.1602C213.975 24.2898 213.864 24.385 213.732 24.385H212.942C212.845 24.385 212.77 24.2977 212.785 24.2008ZM206.767 19.0667H204.852C204.722 19.0667 204.61 19.1619 204.59 19.2912L203.815 24.2008C203.8 24.2977 203.875 24.385 203.973 24.385H204.955C205.047 24.385 205.125 24.3184 205.139 24.2277L205.359 22.8361C205.379 22.7064 205.491 22.6113 205.621 22.6113H206.227C207.489 22.6113 208.216 22.001 208.407 20.7916C208.493 20.2625 208.41 19.8467 208.162 19.5555C207.891 19.2359 207.408 19.0667 206.767 19.0667ZM206.988 20.8598C206.884 21.5469 206.359 21.5469 205.851 21.5469H205.562L205.765 20.2638C205.777 20.1863 205.844 20.1291 205.923 20.1291H206.055C206.401 20.1291 206.727 20.1291 206.896 20.3262C206.996 20.4438 207.027 20.6185 206.988 20.8598ZM212.49 20.8378H211.574C211.495 20.8378 211.428 20.8949 211.416 20.9725L211.376 21.2289L211.312 21.136C211.113 20.8479 210.671 20.7517 210.229 20.7517C209.216 20.7517 208.351 21.519 208.182 22.5955C208.095 23.1324 208.219 23.6458 208.523 24.0039C208.803 24.3331 209.203 24.4703 209.678 24.4703C210.495 24.4703 210.947 23.9453 210.947 23.9453L210.906 24.2002C210.891 24.2976 210.966 24.3849 211.064 24.3849H211.89C212.021 24.3849 212.132 24.2897 212.152 24.1601L212.648 21.022C212.663 20.9255 212.588 20.8378 212.49 20.8378ZM211.212 22.6223C211.124 23.1461 210.708 23.4977 210.178 23.4977C209.912 23.4977 209.699 23.4123 209.562 23.2505C209.427 23.0899 209.376 22.8611 209.418 22.6064C209.501 22.087 209.923 21.724 210.446 21.724C210.706 21.724 210.918 21.8104 211.057 21.9736C211.197 22.1385 211.253 22.3686 211.212 22.6223Z"
                  fill="#179BD7" />
                <path
                  d="M200.2 17.3126L200.435 15.8175L199.911 15.8054H197.407L199.147 4.77296C199.152 4.73965 199.17 4.7086 199.196 4.68655C199.221 4.6645 199.254 4.65234 199.288 4.65234H203.51C204.912 4.65234 205.879 4.94398 206.384 5.51961C206.62 5.78965 206.771 6.07184 206.844 6.38238C206.921 6.70824 206.922 7.09754 206.847 7.57236L206.842 7.60701V7.91125L207.079 8.04537C207.278 8.15113 207.436 8.2722 207.558 8.41082C207.76 8.6417 207.891 8.93514 207.947 9.28304C208.004 9.64084 207.985 10.0666 207.891 10.5486C207.783 11.1031 207.609 11.586 207.373 11.9812C207.156 12.3453 206.88 12.6472 206.552 12.8813C206.238 13.1036 205.866 13.2724 205.445 13.3805C205.037 13.4866 204.573 13.5402 204.063 13.5402H203.734C203.499 13.5402 203.271 13.6248 203.092 13.7765C202.912 13.9314 202.793 14.1428 202.757 14.3742L202.732 14.5088L202.316 17.1438L202.298 17.2406C202.293 17.2713 202.284 17.2866 202.271 17.2969C202.26 17.3063 202.244 17.3126 202.228 17.3126H200.2Z"
                  fill="#253B80" />
                <path
                  d="M207.3 7.64453C207.287 7.72509 207.273 7.80745 207.257 7.89206C206.7 10.7504 204.795 11.7379 202.363 11.7379H201.124C200.827 11.7379 200.576 11.9539 200.53 12.2473L199.895 16.2691L199.716 17.4091C199.686 17.6017 199.834 17.7755 200.029 17.7755H202.225C202.486 17.7755 202.706 17.5864 202.747 17.3299L202.769 17.2183L203.183 14.5935L203.209 14.4495C203.25 14.1921 203.471 14.0031 203.731 14.0031H204.06C206.188 14.0031 207.854 13.139 208.341 10.6384C208.545 9.59375 208.439 8.72153 207.901 8.10809C207.738 7.92311 207.536 7.76964 207.3 7.64453Z"
                  fill="#179BD7" />
                <path
                  d="M206.72 7.41076C206.635 7.38601 206.547 7.3635 206.457 7.34325C206.367 7.32346 206.274 7.3059 206.179 7.2906C205.845 7.23659 205.479 7.21094 205.087 7.21094H201.778C201.697 7.21094 201.619 7.22939 201.55 7.26269C201.397 7.33605 201.284 7.48053 201.256 7.6574L200.552 12.1157L200.532 12.2458C200.579 11.9523 200.829 11.7363 201.127 11.7363H202.365C204.798 11.7363 206.703 10.7484 207.259 7.89053C207.276 7.80592 207.29 7.72356 207.303 7.643C207.162 7.56829 207.009 7.50438 206.845 7.44991C206.804 7.43642 206.763 7.42337 206.72 7.41076Z"
                  fill="#222D65" />
                <path
                  d="M201.25 7.65644C201.277 7.47956 201.391 7.3351 201.543 7.26218C201.613 7.22887 201.69 7.21043 201.771 7.21043H205.08C205.472 7.21043 205.838 7.23608 206.172 7.29009C206.267 7.30539 206.36 7.32294 206.451 7.34274C206.541 7.363 206.628 7.38551 206.714 7.41025C206.756 7.42286 206.798 7.4359 206.839 7.44896C207.003 7.50341 207.155 7.56778 207.296 7.64204C207.462 6.58574 207.295 5.86654 206.724 5.21529C206.094 4.49835 204.958 4.19141 203.504 4.19141H199.282C198.985 4.19141 198.732 4.40743 198.686 4.70132L196.927 15.8471C196.893 16.0676 197.063 16.2666 197.285 16.2666H199.891L200.546 12.1148L201.25 7.65644Z"
                  fill="#253B80" />
              </svg>
            </div>
          </div> -->
        </div>
        <div class="tr-house-rules tr-mobile d-block d-sm-block d-md-none">
          <h3>House rules</h3>
          <div>Check-in: 6:00 PM - 11:00 PM</div>
          <div>Checkout before 9:00 AM</div>
          <div>2 guests maximum</div>
          <button class="tr-show-more">Show more</button>
        </div>
      </div>
    </div>
  </div>

  <!--THE FINE PRINT-->

  <!-- static content 4 -->
  <!-- <div class="container">
    <div class="row">
      <div class="col-lg-7">
        <div class="tr-fine-print">
          <h3>The fine print</h3>
          <div class="tr-sub-title">Must-know information for guest at this property</div>
          <p>When booking 8 rooms or more, different policies and additional supplements may apply.</p>
          <p>Guests are required to show a photo ID and credit card upon check-in. Please note that all special requests
            are subject to availability and additional charges may apply.</p>
          <p>Please inform the cloud one new york-downtown, byy the motel one group of your expected arrival time in
            advance, You can use the special requests box when booking, or contact the property directly using the
            contact details in your confirmation.</p>
        </div>
      </div>
    </div>
  </div> -->

  <!--WHERE TO STAY-->
    <!-- static content 4 -->
  <!-- <div class="container d-none d-md-block">
    <div class="row">
      <div class="col-sm-12">
        <div class="tr-where-stay">
          <h3>Where to stay in SAN FRANCISCO</h3>
          <div class="tr-stay-locations">
            <div class="tr-stay-location">
              <h4>Cities nearby</h4>
              <ul>
                <li>Oakland</li>
                <li>190 hotels</li>
              </ul>
              <ul>
                <li>Berkeley</li>
                <li>10 hotels</li>
              </ul>
              <ul>
                <li>Pacifica</li>
                <li>36 hotels</li>
              </ul>
            </div>
            <div class="tr-stay-location">
              <h4>Convention centre</h4>
              <ul>
                <li>Moscone center</li>
                <li>366 hotels</li>
              </ul>
              <h4>Zoo</h4>
              <ul>
                <li>San Francisco zoo</li>
                <li>66 hotels</li>
              </ul>
            </div>
            <div class="tr-stay-location">
              <h4>Park</h4>
              <ul>
                <li>Golden gate park</li>
                <li>30 hotels</li>
              </ul>
              <ul>
                <li>At &amp; T Park</li>
                <li>200 hotels</li>
              </ul>
              <ul>
                <li>Marina district</li>
                <li>36 hotels</li>
              </ul>
            </div>
            <div class="tr-stay-location">
              <h4>Museum</h4>
              <ul>
                <li>Exploratorium</li>
                <li>306 hotels</li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div> -->

  <!--NEARBY HOTEL-->
  <div class="container">
    <div class="row">
      <div class="col-sm-12">
        <div class="tr-nearby-hotel">
          <h3 class="d-none d-md-block">Nearby hotel</h3>
          <h3 class="d-block d-sm-block d-md-none">You might also like</h3>
          <div class="row tr-nearby-hotel-lists" id="sim-hotel">

            @if(!$nearby_hotel->isEmpty())
            @foreach($nearby_hotel as $index =>$nearbhotel)
            @if($nearbhotel->id != $searchresult[0]->id)
            <div class="tr-nearby-hotel-list">
              <div class="tr-hotel-img">
                <a href="javascript:void(0):">
                  @if($nearbhotel->hotel_id !="")
                  <img 
                    src="https://photo.hotellook.com/image_v2/limit/h{{$nearbhotel->hotel_id}}_1/376/229.jpg"
                    alt="NearBy Hotel">
                  @else
                  <img  src="{{asset('public/images/Hotel lobby.svg')}}" alt="NearBy Hotel">
                  @endif
                </a>
              </div>
              <div class="tr-hotel-deatils">
                <div class="tr-hotel-name"><a
                    href="{{route('hotel.detail',[$nearbhotel->LocationId.'-'.$nearbhotel->hotelid.'-'.strtolower( str_replace(' ', '_', str_replace('#', '!', $nearbhotel->slug))) ])}}">{{$nearbhotel->name}}</a>
                </div>
                <!-- {{$nearbhotel->address}} -->
                <div class="tr-rating d-block d-sm-block d-md-none">
                  <span><i class="fa fa-star" aria-hidden="true"></i></span> 5.0
                </div>
                <div class="tr-like-review">
                  <span class="tr-likes"><svg width="21" height="21" viewBox="0 0 21 21" fill="none"
                      xmlns="http://www.w3.org/2000/svg">
                      <path fill-rule="evenodd" clip-rule="evenodd"
                        d="M10.6655 6.37175C9.45752 5.01908 7.44319 4.65521 5.92972 5.89385C4.41626 7.13249 4.20318 9.20344 5.39172 10.6684L10.6655 15.5524L15.9392 10.6684C17.1277 9.20344 16.9407 7.11946 15.4012 5.89385C13.8617 4.66824 11.8734 5.01908 10.6655 6.37175Z"
                        stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>94%</span>
                  <span class="tr-total-rating">4.2</span>
                  <span class="tr-vgood">Very Good</span>
                </div>
                @if($nearbhotel->pricefrom !="")
                <div class="tr-price-section"><span>${{$nearbhotel->pricefrom}}</span> /night</div>
                @endif
              </div>
            </div>
            @endif
            @endforeach

            @else
            <p>Hotel not found.</p>
            @endif
        

          </div>
          <a href="javascript:void(0);" class="tr-show-all-hotels">Show all hotels</a>
        </div>
      </div>
    </div>
  </div>

  <!--BREADCRUMB-->
  <div class="container">
    <div class="row">
      <div class="col-sm-12">
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
            @if(!empty($searchresult))


            @if(!empty($locationPatent))
            <?php
                    $locationPatents = array_reverse($locationPatent);
                    ?>
            @foreach ($locationPatents as $location)
            <li>
              <a href="@if(!empty($location)){{ route('search.results',[$location['LocationId'].'-'.strtolower($location['slug']) ]) }}@endif"
                target="_blank">
                {{ $location['Name'] }}</a>
            </li>
            @endforeach
            @endif
            @if(!$getlocationexp->isEmpty())
            <li><a
                href="{{ route('search.results', [$getlocationexp[0]->slugid.'-'.strtolower($getlocationexp[0]->Slug)]) }}"
                target="_blank">{{$getlocationexp[0]->Name}}</a>
            </li>
            @endif
            <?php
            $currentUrl = url()->current();
            preg_match('/(\d+)-/', $currentUrl, $matches);
            $firstId = $matches[1];

            ?>

            <li><a
                href="{{ route('hotel.list',[$firstId.'-'.$getlocationexp[0]->Slug]) }}"
                target="_blank">{{$searchresult[0]->cityName}}
                Hotels</a>
            </li>
            <li>{{$searchresult[0]->name}}</li>
            @endif
            <!-- <li><a href="javascript:void(0);">Home</a></li>
            <li><a href="javascript:void(0);">Hotel listing</a></li>
            <li>Hyatt Regency Houston West</li> -->
          </ul>
        </div>
      </div>
    </div>
  </div>

  <!--FOOTER-->
  <footer>
    <div class="container">
      <div class="row">
        <div class="col-sm-12">
          <div class="tr-footer-top">
            <div class="tr-footer-logo">
              <a href="javascript:void(0);"><img 
                  src="{{asset('/public/frontend/hotel-detail/images/travell-white-logo.png')}}"
                  alt="travell-white-logo"></a>
              <div class="tr-copy-right tr-mobile">&copy; 2024 Travell.co, Inc.</div>
            </div>
            <div class="tr-footer-links-section">
              <div class="tr-footer-links-left-col">
                <div class="tr-footer-links">
                  <h5>Support</h5>
                  <ul>
                    <li><a href="javascript:void(0);">Help Centre</a></li>
                    <li><a href="javascript:void(0);">Guides</a></li>
                    <li><a href="javascript:void(0);">Anti-discrimination</a></li>
                    <li><a href="javascript:void(0);">Disability support</a></li>
                    <li><a href="javascript:void(0);">Cancellation options</a></li>
                    <li><a href="javascript:void(0);">Report neighbourhood concern</a></li>
                  </ul>
                </div>
              </div>
              <div class="tr-footer-links-right-col">
                <div class="tr-footer-links">
                  <h5>Rooms</h5>
                  <ul>
                    <li><a href="javascript:void(0);">Standard</a></li>
                    <li><a href="javascript:void(0);">Deluxe</a></li>
                    <li><a href="javascript:void(0);">Family</a></li>
                  </ul>
                </div>
                <div class="tr-footer-links">
                  <h5>Nearby</h5>
                  <ul>
                    <li><a href="javascript:void(0);">Hotels</a></li>
                    <li><a href="javascript:void(0);">Restaurants</a></li>
                    <li><a href="javascript:void(0);">Top attractions</a></li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
          <div class="tr-footer-bottom">
            <div class="tr-another-links">
              <ul>
                <li>&copy; 2024 Travell.co, Inc.</li>
                <li><a href="javascript:void(0);">Privacy</a></li>
                <li><a href="javascript:void(0);">Terms</a></li>
                <li><a href="javascript:void(0);">Sitemap</a></li>
                <li><a href="javascript:void(0);">Company details</a></li>
              </ul>
            </div>
            <div class="tr-social-links">
              <ul>
                <li>English (IN)</li>
                <li>&#8377; INR</li>
                <li><a href="javascript:void(0);" class="tr-facebook" title="Facebook" target="_blank"></a></li>
                <li><a href="javascript:void(0);" class="tr-twitter" title="Twitter" target="_blank"></a></li>
                <li><a href="javascript:void(0);" class="tr-instagram" title="Instagram" target="_blank"></a></li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
  </footer>
  <div class="overlay" id="overLay"></div>

  <!-- Share Modal -->
  <div class="modal" id="shareModal">
    <div class="modal-dialog">
      <div class="modal-content">
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        <h3>Share this experience</h3>
        <div class="tr-share-infos">
          <div class="tr-hotel-img">
            <img  src="images/room-image-1.png" alt="Room Image">
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
            <a href="javascript:void(0);" class="tr-email">Email</a>
          </div>
          <div class="tr-share-option">
            <a href="javascript:void(0);" class="tr-messages">Messages</a>
          </div>
          <div class="tr-share-option">
            <a href="javascript:void(0);" class="tr-whatsapp">Whatsapp</a>
          </div>
          <div class="tr-share-option">
            <a href="javascript:void(0);" class="tr-messenger">Messenger</a>
          </div>
          <div class="tr-share-option">
            <a href="javascript:void(0);" class="tr-facebook">Facebook</a>
          </div>
          <div class="tr-share-option">
            <a href="javascript:void(0);" class="tr-twitter">Twitter</a>
          </div>
          <div class="tr-share-option">
            <a href="javascript:void(0);" class="tr-embed">Embed</a>
          </div>
        </div>
        <div class="tr-alert tr-copy-alert">Link copied</div>
      </div>
    </div>
  </div>

  <!-- Gallery Modal-->
  <div class="tr-gallery-popup">
    <div class="tr-gallery-header">
      <div class="tr-gallery-action">
        <div class="tr-close-button">
          <button type="button" class="btn-close"></button>
        </div>
        <div class="tr-share-save">
          <a href="javascript:void(0);" class="tr-share" data-bs-toggle="modal" data-bs-target="#shareModal">Share</a>
          <a href="javascript:void(0);" class="tr-save">Save</a>
        </div>
      </div>
      <ul class="tr-galleries-nav-tab">
      <li><a href="#galleryOutdoor" class="active">All Images</a></li>
      </ul>
    </div>

    <div class="tr-gallery-categories">
      <div class="tr-galleries-section" id="galleryOutdoor">
      
       <!---- new code -->
		  <h3>Indoor and Outdoor</h3>
         <!-- start -->
        <div class="tr-gallery-category">
          <div class="tr-galleries-left-column">
            <ul>
             @if($hotelid !="")
            <?php $hoteid = $hotelid; 
   $imgcount = count($images[$hoteid]);

    ?>
            <ul>
              @if(isset($images[$hoteid][0]) && $images[$hoteid][0] != "")
              <li data-bs-toggle="modal" data-bs-target="#gallerySliderModal"  class="gal-imgages">
                <img 
                  src="https://photo.hotellook.com/image_v2/limit/{{ $images[$hoteid][0] }}/800/800.auto"
                  alt="Outdoor Pictures 1">
              </li>
              @endif
              @php
              $remainingImages = array_slice($images[$hoteid], 1);
              @endphp
              <?php $a =2;?>
              @for ($i = 0; $i <$imgcount; $i++) 
              @if ($i < count($remainingImages))
               @php $image=$remainingImages[$i];

                @endphp 
              
                @if(!empty($image)) <li data-bs-toggle="modal" data-bs-target="#gallerySliderModal" class="gal-imgages">
                <img  src="https://photo.hotellook.com/image_v2/limit/{{ $image }}/800/800.auto"
                  alt="Outdoor Pictures {{$a}}">
                </li>
                @endif
                @endif
                <?php $a++;?>
                @endfor
            </ul>
            @endif

            </ul>
          </div>
       
        </div>

      <!-- end -->
		  
		  
		  
	   <!-- end all image code  -->
        
   
    
     
    </div>
  </div>
	  
</div>
  <!-- Gallery Slider Modal -->
  <div class="modal" id="gallerySliderModal">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <div id="gallerySlider" class="carousel slide" data-bs-ride="carousel">
            <!-- Indicators/dots -->
            <div class="carousel-indicators">
              <!--Button comming from JS-->
            </div>
            <!-- The slideshow/carousel -->
            <div class="carousel-inner">
              <!--Images comming from JS-->
            </div>
            <!-- Left and right controls/icons -->
            <button class="carousel-control-prev" type="button" data-bs-target="#gallerySlider"
              data-bs-slide="prev"><span class="carousel-control-prev-icon"></span></button>
            <button class="carousel-control-next" type="button" data-bs-target="#gallerySlider"
              data-bs-slide="next"><span class="carousel-control-next-icon"></span></button>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!--Write a Review Modal-->
  <div class="tr-write-review-modal">
    <div class="tr-popup-content">
      <h3>Write a review</h3>
      <div class="tr-write-review-content">
        <div class="tr-hotel-reviews-details">
          <div class="tr-main-image">
            @if(!empty($searchresult[0]->hotelid))
            <?php $hoteid =$searchresult[0]->hotelid ;?>
            @if(isset($images[$hoteid][0] ) && $images[$hoteid][0] !="")
            <img  src="https://photo.hotellook.com/image_v2/limit/{{ $images[$hoteid][0] }}/628/567.auto"
              height="50" class="h-100" alt="" alt="Room Image">
            @else
            <img src="{{asset('public/images/Hotel lobby.svg')}}" alt="">
            @endif
            @endif
          </div>
          <div class="tr-hotel-info">
            <h4 class="tr-hotel-name">{{$searchresult[0]->name}}</h4>
            <div class="tr-hotel-address">{{$searchresult[0]->address}}</div>
            <div class="tr-rated">
              @for($i =1;$i < 5;$i++) @if($i < $searchresult[0]->address )
                <span class="tr-star"><img
                    src="{{ asset('public/frontend/hotel-detail/images/icons/star-fill-icon.svg')}}"></span>
                @else
                <span class="tr-star"><img
                    src="{{ asset('public/frontend/hotel-detail/images/icons/star-blank-icon.svg')}}"></span>
                @endif
                @endfor
                <span>Excellent</span>
            </div>
          </div>
        </div>
        <form id="addReview">
          <div class="tr-overall-rating">
            <div id="msg"></div>

            <div class="tr-rating">
              <label>How would you rate your experience?</label>
              <div class="tr-stars star-exp">
                <input type="radio" data-rating="1" class="star" name="expStar" id="expStar5" value="5"><label
                  for="expStar5"></label>
                <input type="radio" data-rating="2" class="star" name="expStar" id="expStar4" value="4"><label
                  for="expStar4"></label>
                <input type="radio" data-rating="3" class="star" name="expStar" id="expStar3" value="3"><label
                  for="expStar3"></label>
                <input type="radio" data-rating="4" class="star" name="expStar" id="expStar2" value="2"><label
                  for="expStar2"></label>
                <input type="radio" data-rating="5" class="star" name="expStar" id="expStar1" value="1"><label
                  for="expStar1"></label>
              </div>
            </div>
            <div id="rating-error"></div>
          </div>
          <div class="tr-go-with">
            <label>Who did you go with?</label>
            <ul class="go-with">
              <li onclick="selectButton(this)">Business</li>
              <li onclick="selectButton(this)" class="selected">Couple</li>
              <li onclick="selectButton(this)">Family</li>
              <li onclick="selectButton(this)">Friends</li>
              <li onclick="selectButton(this)">Solo</li>
              <div class="error-msg" id="go-with-error"></div>
            </ul>
          </div>
          <div class="tr-review-types">
            <div class="tr-rating">
              <label>Cleanliness :</label>
              <div class="tr-stars star-cleanliness">
                <input type="radio" class="star" data-rating="1" name="cleanlinessStar" id="cleanlinessStar5"
                  value="5"><label for="cleanlinessStar5"></label>
                <input type="radio" class="star" data-rating="2" name="cleanlinessStar" id="cleanlinessStar4"
                  value="4"><label for="cleanlinessStar4"></label>
                <input type="radio" class="star" data-rating="3" name="cleanlinessStar" id="cleanlinessStar3"
                  value="3"><label for="cleanlinessStar3"></label>
                <input type="radio" class="star" data-rating="4" name="cleanlinessStar" id="cleanlinessStar2"
                  value="2"><label for="cleanlinessStar2"></label>
                <input type="radio" class="star" data-rating="5" name="cleanlinessStar" id="cleanlinessStar1"
                  value="1"><label for="cleanlinessStar1"></label>
              </div>
              <div class="error-msg" id="cleanliness-rating-error"></div>
            </div>
            <div class="tr-rating">
              <label>Location :</label>
              <div class="tr-stars star-location">
                <input type="radio" class="star" data-rating="1" name="locationStar" id="locationStar5" value="5"><label
                  for="locationStar5"></label>
                <input type="radio" class="star" data-rating="2" name="locationStar" id="locationStar4" value="4"><label
                  for="locationStar4"></label>
                <input type="radio" class="star" data-rating="3" name="locationStar" id="locationStar3" value="3"><label
                  for="locationStar3"></label>
                <input type="radio" class="star" data-rating="4" name="locationStar" id="locationStar2" value="2"><label
                  for="locationStar2"></label>
                <input type="radio" class="star" data-rating="5" name="locationStar" id="locationStar1" value="1"><label
                  for="locationStar1"></label>
              </div>
              <div class="error-msg" id="location-rating-error"></div>
            </div>
          </div>
          <div class="tr-review-types">
            <div class="tr-rating star-service">
              <label>Service :</label>
              <div class="tr-stars">
                <input type="radio" class="star" data-rating="1" name="serviceStar" id="serviceStar5" value="5"><label
                  for="serviceStar5"></label>
                <input type="radio" class="star" data-rating="2" name="serviceStar" id="serviceStar4" value="4"><label
                  for="serviceStar4"></label>
                <input type="radio" class="star" data-rating="3" name="serviceStar" id="serviceStar3" value="3"><label
                  for="serviceStar3"></label>
                <input type="radio" class="star" data-rating="4" name="serviceStar" id="serviceStar2" value="2"><label
                  for="serviceStar2"></label>
                <input type="radio" class="star" data-rating="5" name="serviceStar" id="serviceStar1" value="1"><label
                  for="serviceStar1"></label>
              </div>
              <div class="error-msg" id="service-rating-error"></div>
            </div>
            <div class="tr-rating">
              <label>Value :</label>
              <div class="tr-stars star-value">
                <input type="radio" class="star" data-rating="1" name="valueStar" id="valueStar5" value="5"><label
                  for="valueStar5"></label>
                <input type="radio" class="star" data-rating="2" name="valueStar" id="valueStar4" value="4"><label
                  for="valueStar4"></label>
                <input type="radio" class="star" data-rating="3" name="valueStar" id="valueStar3" value="3"><label
                  for="valueStar3"></label>
                <input type="radio" class="star" data-rating="4" name="valueStar" id="valueStar2" value="2"><label
                  for="valueStar2"></label>
                <input type="radio" class="star" data-rating="5" name="valueStar" id="valueStar1" value="1"><label
                  for="valueStar1"></label>
              </div>
              <div class="error-msg" id="value-rating-error"></div>
            </div>
          </div>
          <div class="tr-review-msg">
            <label>Name</label>
            <input type="text" class="form-control" placeholder="Enter Name" name="name" id="name">
            <div class="error-msg" id="name-error"></div>
          </div>
          <div class="tr-review-msg">
            <label>Email</label>
            <input type="text" class="form-control" placeholder="Enter Email" name="email" id="email">
            <div class="error-msg" id="email-error"></div>
          </div>
          <div class="tr-review-msg">
            <label>Write a review</label>
            <textarea class="form-control" placeholder="Type your review here" name="review" id="review"></textarea>
          </div>
          <div class="error-msg" id="review-error"></div>
          <div class="tr-review-image">
            <label>Add some photos (optional)</label>
            <div class="tr-file-upload">
              <!--<button class="file-upload-btn" type="button" onclick="$('.file-upload-input').trigger( 'click' )">Add Image</button>-->
              <div class="tr-image-upload-wrap">
                <input class="tr-file-upload-input" type='file' onchange="readURL(this);" accept="image/*" id="files"
                  name="files[]" />
                <div class="tr-drag-image">
                  <svg width="17" height="16" viewBox="0 0 17 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <g clip-path="url(#clip0_441_7517)">
                      <path
                        d="M15.8385 12.6667C15.8385 13.0203 15.6981 13.3594 15.448 13.6095C15.198 13.8595 14.8588 14 14.5052 14H2.50521C2.15159 14 1.81245 13.8595 1.5624 13.6095C1.31235 13.3594 1.17188 13.0203 1.17188 12.6667V5.33333C1.17188 4.97971 1.31235 4.64057 1.5624 4.39052C1.81245 4.14048 2.15159 4 2.50521 4H5.17188L6.50521 2H10.5052L11.8385 4H14.5052C14.8588 4 15.198 4.14048 15.448 4.39052C15.6981 4.64057 15.8385 4.97971 15.8385 5.33333V12.6667Z"
                        stroke="#6A6A6A" stroke-linecap="round" stroke-linejoin="round" />
                      <path
                        d="M8.49479 11.3333C9.96755 11.3333 11.1615 10.1394 11.1615 8.66667C11.1615 7.19391 9.96755 6 8.49479 6C7.02203 6 5.82812 7.19391 5.82812 8.66667C5.82812 10.1394 7.02203 11.3333 8.49479 11.3333Z"
                        stroke="#6A6A6A" stroke-linecap="round" stroke-linejoin="round" />
                    </g>
                    <defs>
                      <clipPath id="clip0_441_7517">
                        <rect width="16" height="16" fill="white" transform="translate(0.5)" />
                      </clipPath>
                    </defs>
                  </svg>
                  <div>Click to add photos</div>
                  <span>or drag and drop</span>
                </div>
              </div>
              <div class="tr-file-upload-content">
                <img class="tr-file-upload-image" src="#" alt="your image" />
                <div class="image-title-wrap">
                  <button type="button" onclick="removeUpload()" class="tr-remove-image">
                    <i class="fa fa-times" aria-hidden="true"></i>
                    <!--<span class="image-title">Uploaded Image</span>-->
                  </button>
                </div>
              </div>
            </div>
          </div>
          <button type="submit" class="tr-popup-btn">Submit</button>
        </form>
      </div>
    </div>
  </div>
</body>

</html>
<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
<script type="text/javascript" src="{{ asset('/public/frontend/hotel-detail/js/common.js')}} "></script>





<!-- start map js -->

<script src="{{ asset('/public/js/map_leaflet.js')}}"></script>
<script src="{{asset('public/js/hotelDetails.js')}}"></script>

<script src="https://unpkg.com/leaflet-simple-map-screenshoter"></script>
<script src="https://unpkg.com/file-saver/dist/FileSaver.js"></script>

<script>
  let startTime = {{ $currentTimeMillis }};
  let timeDifference = 0;

  function checkTime() {
    let currentTime = Date.now();
    timeDifference = Math.floor((currentTime - startTime) / (1000 * 60));

    if (timeDifference >= 10) {
      document.getElementById("refresh-banner").classList.remove("d-none"); 
    }
  }

 
  checkTime();
  setInterval(checkTime, 60000); 
</script>
<script>
      var latitude = {{ $latitude }};
    var longitude = {{ $longitude }};

    var mapOptions = {
        center: [latitude, longitude],
        zoom: 10
    };

    var map = new L.map('map1', mapOptions);

    var layer = new L.TileLayer('https://{s}.tile.openstreetmap.fr/hot/{z}/{x}/{y}.png');
    map.addLayer(layer);

    var customIcon = L.icon({
        iconUrl: '{{ asset("public/images/map-marker-icon.png") }}',
        iconSize: [32, 32],
        iconAnchor: [16, 32],
    });

    var marker = L.marker([latitude, longitude], {
        icon: customIcon
    }).addTo(map);

    var simpleMapScreenshoter = L.simpleMapScreenshoter().addTo(map);

    function captureScreenshot() {
        simpleMapScreenshoter.takeScreen('blob', {}).then(blob => {
            const screenshotImage = new Image();
            screenshotImage.src = URL.createObjectURL(blob);
            var mapContainer = document.getElementById('map1');
            mapContainer.classList.add('d-none');
            const screenshotContainer = document.getElementById('screenshotContainer');
            screenshotContainer.appendChild(screenshotImage);
        }).catch(e => {
            console.error(e.toString());
        });
    }

    window.onload = captureScreenshot;
</script>


<!-- end map js -->
<script src="{{ asset('/public/js/custom.js')}}"></script>