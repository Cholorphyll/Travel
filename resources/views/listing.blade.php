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
  @if(!empty($locationPatent)) @php $locationPatent = array_reverse($locationPatent); @endphp @endif
  @php $month = date('F'); $year = date('Y'); $lname =""; @endphp
  @if(!empty($searchresults)) @php $lname = $location_name @endphp @endif
  <title> Things to do in {{$lname}}
    @if(!empty($locationPatent))
    , @foreach($locationPatent as $location)
    {{$location['Name']}}@if(!$loop->last), @endif
    @endforeach
    @endif
    – {{ $month }}, {{ $year }} - Travell
  </title>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Figtree:ital,wght@0,300..900;1,300..900&display=swap"
    rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <script type="text/javascript" src="{{ asset('/public/frontend/hotel-detail/js/jquery.min.js')}}"></script>
  <script type="text/javascript" src="{{ asset('/public/frontend/hotel-detail/js/bootstrap.bundle.min.js')}}"></script>
  <script type="text/javascript" src="{{ asset('/public/frontend/hotel-detail/js/jquery-ui-datepicker.min.js')}}">
  </script>
  <script type="text/javascript" src="{{ asset('/public/frontend/hotel-detail/js/slick.min.js')}}"></script>


  <link rel="stylesheet" href="{{ asset('/public/frontend/hotel-detail/css/bootstrap.min.css')}}">
  <link rel="stylesheet" href="{{ asset('/public/frontend/hotel-detail/css/style.css')}}">
  <link rel="stylesheet" href="{{ asset('/public/frontend/hotel-detail/css/custom.css')}}">
  <link rel="stylesheet" href="{{ asset('/public/frontend/hotel-detail/css/calendar.css')}}" media="screen">
  <link rel="stylesheet" href="{{ asset('/public/frontend/hotel-detail/css/slick.css')}}">
  <link rel="stylesheet" href="{{ asset('/public/frontend/hotel-detail/css/responsive.css')}}">

  <link rel="stylesheet" href="{{ asset('/public/css/map_leaflet.css')}}">
  <link rel="stylesheet" href="{{ asset('/public/css/custom.css')}}">
  <style>
  .leaflet-popup-tip-container {
    display: none;
  }	
  </style>

  <script type="text/javascript">
  $(document).ready(function() {
    $('.tr-search-by-category').slick({
      autoplay: true,
      autoplaySpeed: 2000,
      dots: false,
      arrows: false,
      infinite: false,
      slidesToShow: 1,
      slidesToScroll: 1,
      vertical: true,
    });
    $('.tr-tickets-silder').slick({
      autoplay: false,
      autoplaySpeed: 2000,
      dots: false,
      arrows: true,
      infinite: false,
      slidesToShow: 2.1,
      slidesToScroll: 1,
      responsive: [{
        breakpoint: 768,
        settings: {
          arrows: false,
          slidesToShow: 1.5,
          slidesToScroll: 1
        }
      }]
    });
    $('.tr-explore-filter-slider').slick({
      autoplay: false,
      autoplaySpeed: 2000,
      dots: false,
      arrows: true,
      infinite: false,
      slidesToShow: 3,
      slidesToScroll: 1,
      variableWidth: true,
      responsive: [{
        breakpoint: 768,
        settings: {
          arrows: false,
        }
      }]
    });
    $('.tr-experience-slider').slick({
      autoplay: false,
      autoplaySpeed: 2000,
      dots: true,
      arrows: false,
      infinite: true,
      slidesToShow: 3,
      slidesToScroll: 1
    });
    $('.tr-market-slider').slick({
      autoplay: false,
      autoplaySpeed: 2000,
      dots: false,
      arrows: true,
      infinite: false,
      slidesToShow: 3,
      slidesToScroll: 1,
      responsive: [{
        breakpoint: 768,
        settings: {
          arrows: false,
          slidesToShow: 2.5,
          slidesToScroll: 1
        }
      }]
    });

  });
  </script>
  <?php
      $locationPatents = $locationPatent;
       $n = 2;
      ?>
  <script type="application/ld+json">
  {
    "@context": "https://schema.org/",
    "@type": "BreadcrumbList",
    "itemListElement": [{
        "@type": "ListItem",
        "position": 1,
        "name": "@if(!empty($breadcumb)) {{$breadcumb[0]->CountryName}} @endif",
        "item": "@if(!empty($breadcumb)){{ route('search.results',[$breadcumb[0]->LocationId.'-'.strtolower($breadcumb[0]->Lslug).'-'.str_replace(' ','_',strtolower($breadcumb[0]->CountryName))])}} @endif"
      },

      @if(!empty($locationPatents))
      @foreach($locationPatents as $location) {
        "@type": "ListItem",
        "position": {{ $n }},

        "name": "{{ $location['Name'] }}",
        "item": "@if(!empty($searchresults)){{ route('search.results',[ $location['LocationId'] .'-'.strtolower($location['slug'])]) }} @endif"
      },
      <?php $n++; ?>
      @endforeach
      @endif

      {
        "@type": "ListItem",
        "position": {{$n}},
        "name": "@if(!empty($breadcumb)) {{$breadcumb[0]->LName}} @endif",
        "item": ""
      }
    ]
  }
  </script>
</head>

<body>
  <!--HEADER-->
  @include('frontend.header')

  <!-- Mobile Navigation-->
  @include('frontend.mobile_nav')

  <div class="tr-explore-listing-section">
    <div class="container">
      <div class="tr-explore-listing responsive-container">
        <div class="tr-explore-left-section">
          <div class="tr-title-section">
            @if(!empty($searchresults)) <h2 class="tr-title">@if($top_attractions == 1)Top Attractions in {{$lname}} @else Things to do in {{$lname}} @endif</h2>@endif
            <button type="button" class="tr-anchor-btn tr-share" data-bs-toggle="modal"
              data-bs-target="#shareModal">Share</button>
          </div>
          @if($totalCountResults !=0) <div class="tr-total-search">{{$totalCountResults}} Attractions found in
            {{$lname}}</div>@endif
          <!-- Below element When We don't have data - Start -->
          <div class="tr-let-us-know-more" style="display: none;">
            <p>Tell us so that we can learn and show better results to you in the future!</p>
            <button type="button" class="tr-btn tr-let-us-know-more-btn">Let us know more</button>
          </div>
          <!-- Below element When We don't have data - Start -->
          <div class="tr-explore-search">
            <div class="tr-explore-search-feild">
              <div class="tr-search-field">
                Search for
                <div class="tr-search-by-category">
                  @if(!empty($getSightCat))
                  @foreach($getSightCat as $getSightCats)
                  <div>“{{$getSightCats->Title}}”</div>
                  @endforeach
                  @endif
                </div>
              </div>
              <button type="button" class="tr-btn">Search</button>
            </div>
            <div class="tr-explore-search-modal">
              <div class="tr-explore-search-feild">   
                <input type="text" name="" class="tr-search-field serch_sights" id="serch_sights"
                  placeholder="Search for “Restaurants”" autocomplete="off">
                  <span class="res_type d-none" id="res_type"></span>
                <button type="submit" class="tr-btn" id="serch_sightsdata">Search</button>
              </div>
               <div class="tr-recent-searchs-modal search-result">
                  
                 
                </div>

            </div>


          </div>

             <?php

					$categoryArray = [];

					foreach (request()->session()->all() as $key => $value) {
						if (str_starts_with($key, 'cat_')) {
							$catInfo = explode('_', $value);
							if (count($catInfo) === 2 && !empty($catInfo[0]) && !empty($catInfo[1])) {
								$categoryArray[] = [
									'name' => $catInfo[0],
									'id' => $catInfo[1]
								];
							}
						}
					}


                  ?>

           <div class="tr-explore-filter">
            <form class="tr-filter-lists tr-explore-filter-slider">
              @if($ismustsee == 1)

              <div class="tr-filter-list filter_sightbycat" data-catid="mustsee">
                <input type="checkbox" name="" id="filter1" class="filter " value="category1"    @if(request()->session()->has('mustSee')) checked  @endif>
                <label for="filter1" class="tr-top-attractions"><span>Must See</span></label>
              </div>
              @endif
              @if($rest_avail == 1)
              <div class="tr-filter-list filter_sightbycat" data-catid="isrestaurant">
                <input type="checkbox" name="" id="filter_restaurant" class="filter" value="category1"
					   @if(request()->session()->has('IsRestaurant')) checked  @endif>
                <label for="filter_restaurant" class="top-attractions">Restaurants</label>
              </div>
              @endif

              @if(!empty($getSightCat))
              @foreach($getSightCat as $getSightCatval)


              <div class="tr-filter-list filter_sightbycat" data-name="{{$getSightCatval->Title}}"
                data-catid="{{$getSightCatval->CategoryId}}">
                <input type="checkbox" name="" id="filter_{{$getSightCatval->CategoryId}}" class="filter"
                  value="category1"    @if(!empty($categoryArray))
                @foreach($categoryArray as $category)
                @if($category['name'] !='' && $category['name'] == $getSightCatval->Title) checked  @endif
                @endforeach
                @endif>
                <label for="filter_{{$getSightCatval->CategoryId}}"
                  class="top-attractions">{{$getSightCatval->Title}}</label>
              </div>
              @endforeach
              @endif
            </form>
          </div>
          <?php $url = request()->route('id');
                $parts = explode('-', $url,2);
                $lastPart = $parts[1];
                            ?>
          <span id="locid" class="d-none">@if(!empty($searchresults)){{$searchresults[0]->LocationId}}
            @endif</span>
          <span id="slug" class="d-none"> {{$lastPart}}</span>
          <span class="d-none sightlist">sightlist</span>
          <span id="getcatfilterdata">
            <!-- new category session data -->
            <?php $i = 1; $j = 0; ?>
            @php
            $markers = [];
            @endphp
            @if(!empty($searchresults))
            @foreach($searchresults as $searchresult)
            <div class="tr-museum attraction" onmouseover="highlightMarker(this)" onmouseout="unhighlightMarker(this)"
              data-sid="{{$searchresult->SightId}}" data-ismustsee="{{$searchresult->IsMustSee}}">
            <!-- <div class="tr-heading-with-distance">
                <div class="tr-category">@if($searchresult->CategoryTitle !="") {{$searchresult->CategoryTitle}} @endif
                </div>
              <div class="tr-distance">1.2 km from {{$searchresult->LName}}</div>
              </div>-->
               <div class="tr-image">
              <div id="Slider{{$i}}" class="carousel slide" data-bs-touch="false" data-bs-interval="false">
                <!-- Indicators/dots -->
                <div class="carousel-indicators">
                  <button type="button" data-bs-target="#Slider{{$i}}" data-bs-slide-to="0" class="active">1</button>
                  <button type="button" data-bs-target="#Slider{{$i}}" data-bs-slide-to="1">2</button>
                  <button type="button" data-bs-target="#Slider{{$i}}" data-bs-slide-to="2">3</button>
                </div>
                <!-- The slideshow/carousel -->
                <div class="carousel-inner">
                  <?php $imgcount = 0; ?>
                  @if($searchresult->IsMustSee == 1)

                  @if(!$sightImages->isEmpty())
                  @foreach($sightImages as $sighimgs)
                  @if($sighimgs->Sightid == $searchresult->SightId)
                  <?php $imgcount++; ?>
                  <div class="carousel-item @if($imgcount == 1)active @endif">
                    <a href="{{ asset('at-'.$searchresult->slugid.'-'.$searchresult->SightId.'-'.strtolower($searchresult->Slug)) }}" target="_blank">
                  <img loading="lazy" src="{{ asset('public/sight-images/'. $sighimgs->Image) }}" alt="" width="475" height="320">
                </a>
                  </div>
                  <span class="imagepath_{{$j}} d-none">{{ asset('public/sight-images/'. $sightImages[0]->Image) }}</span>
                  @endif
                  @endforeach
                  @endif

                  @if($imgcount == 0)
                  <!-- Show fallback image if no matching images were found -->
                  <div class="carousel-item active">
                     <img src="{{ asset('public/images/Hotel lobby.svg') }}" class="card-img br-10 mb-12" alt="hotel image" width="475" height="320">
                  </div>
                  <span class="imagepath_{{$j}} d-none">{{ asset('public/images/Hotel lobby.svg') }}</span>
                  @endif

                  @else

                  @if(!$sightImages->isEmpty())
                  @foreach($sightImages as $sighimgs)
                  @if($sighimgs->Sightid == $searchresult->SightId)
                  <?php $imgcount++; ?>
                  <div class="carousel-item @if($imgcount == 1)active @endif">
                    <img src="{{ asset('public/sight-images/'. $sighimgs->Image) }}" class="card-img br-10 mb-12" alt="hotel image" width="475" height="189">
                  </div>
                  <span class="imagepath_{{$j}} d-none">{{ asset('public/sight-images/'. $sightImages[0]->Image) }}</span>
                  @endif
                  @endforeach
                  @endif

                  @if($imgcount == 0)
                  <!-- Show fallback image if no matching images were found -->
                  <div class="carousel-item active">
                    <img src="{{ asset('public/images/Hotellobby-nmustsee-compressed.svg') }}" class="card-img" alt="hotel image" width="475" height="189">
                  </div>
                  <span class="imagepath_{{$j}} d-none">{{ asset('public/images/Hotellobby-nmustsee-compressed.svg') }}</span>
                  @endif

                  @endif
                </div>
                @if($imgcount > 1)
                <button class="carousel-control-prev" type="button" data-bs-target="#Slider{{$i}}" data-bs-slide="prev">
                  <span class="carousel-control-prev-icon"></span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#Slider{{$i}}" data-bs-slide="next">
                  <span class="carousel-control-next-icon"></span>
                </button>
                @endif
              </div>
            </div>

              <div class="tr-details">
                @if($searchresult->CategoryTitle !="")<div class="tr-type">{{$searchresult->CategoryTitle}}</div>@endif
                <h3><a
                    href="{{ asset('at-'.$searchresult->slugid.'-'.$searchresult->SightId.'-'.strtolower($searchresult->Slug)) }}"
                    target="_blank">{{$searchresult->Title}}</a></h3>
                @if($searchresult->LName !="") <div class="tr-location">City of {{$searchresult->LName}}</div>@endif
                @if(!empty($searchresult->timing))
                @foreach ($searchresult->timing as $tm)

                @if (!empty($tm->timings))
                <?php
                date_default_timezone_set('Asia/Kolkata'); // Set to Indian Standard Time (IST)

                $currentDay = strtolower(date('D'));
                $currentTime = date('H:i');

                $schedule = json_decode($tm->timings, true);
                $isOpen = false; // Initialize isOpen as false by default
                $formatetime = '';

                if (isset($schedule['time'][$currentDay])) {
                  $openingtime = $schedule['time'][$currentDay]['start'];
                  $closingTime = $schedule['time'][$currentDay]['end'];

                  if ($openingtime == '00:00' && $closingTime == '23:59') {
                    $formatetime = '12:00' ;
                    $closingTime = '11:59';


                }

                        if ($currentTime >= $openingtime && $currentTime <= $closingTime) {

                            $isOpen = true;
                        }

                }

                ?>
                <div class="tr-more-inform">
                  <ul>
                    @if ($isOpen)
                    {{ $formatetime }}
                    <li> <span class="timing_<?php echo $j;?>">Open</span></li>
                    @else
                    <li> <span class="timing_<?php echo $j;?>">Closed Today</span></li>
                    @endif
                    <!-- <li>5 hours.</li> -->
                  </ul>
                  <!-- <ul>
                      <li>until 17:10</li>
                    </ul> -->
                </div>
                @else
                <li> <span class="timing_<?php echo $j;?>"></span> </li>
                @endif
                @endforeach
                @else
                <span class="timing_<?php echo $j;?>"></span>
                @endif
                <div class="tr-like-review">
                  <div class="tr-heart">
                    <svg width="12" height="11" viewBox="0 0 12 11" fill="none" xmlns="http://www.w3.org/2000/svg">
                      <path fill-rule="evenodd" clip-rule="evenodd"
                        d="M5.99604 2.28959C5.02968 1.20745 3.41823 0.916356 2.20745 1.90727C0.996677 2.89818 0.826217 4.55494 1.77704 5.7269L5.99604 9.63412L10.215 5.7269C11.1659 4.55494 11.0162 2.88776 9.78463 1.90727C8.55304 0.92678 6.96239 1.20745 5.99604 2.28959Z"
                        fill="white" stroke="white" stroke-linecap="round" stroke-linejoin="round"></path>
                    </svg>
                  </div>
                  <div class="tr-ranting-percent">@if($searchresult->TAAggregateRating != "" &&
                    $searchresult->TAAggregateRating !=
                    0)<?php $result = rtrim($searchresult->TAAggregateRating, '.0') * 20;  ?>
                    {{$result}}% @else
                    --
                    @endif</div>
                </div>
                <span class="sid d-none">{{$searchresult->SightId}}</span>
                <span class="sight d-none" data-sight-id="{{$searchresult->SightId}}">
                  <span class="sname d-none">{{$searchresult->Title}}</span>
                  <!-- get cat -->
                  @if(!$searchresult->Sightcat->isEmpty())
                  @foreach ($searchresult->Sightcat as $category)

                  <span class="catname_<?php echo $j; ?> d-none">@if($category->Title !== "")
                    {{ $category->Title }}@endif</span>
                  @endforeach
                  @else
                  <span class="catname_<?php echo $j; ?> d-none"></span>
                  @endif
                  @if($searchresult->TAAggregateRating != "" && $searchresult->TAAggregateRating !=
                  0)<?php $result = rtrim($searchresult->TAAggregateRating, '.0') * 20;  ?>

                  <span class="isrecomd_<?php echo $j;?> d-none"> {{$result}}%</span>

                  @else
                  <span class="isrecomd_<?php echo $j;?> d-none"></span>
                  @endif
                  @if($searchresult->LName != "" )
                  <span class="cityname_<?php echo $j;?> d-none">City of {{$searchresult->LName}}</span>

                  @else
                  <span class="cityname_<?php echo $j;?> d-none"></span>
                  @endif
                  <!-- end cat -->
                  <?php  $j++?>
                  <!--
                    @if($searchresult->ticket != null)
                    <div class="tr-tickets tr-tickets-silder">
                      <div>
                        <ul>
                          <li><span class="tr-rating">89%</span></li>
                          <li>2.5 hours.</li>
                        </ul>
                        <h5>Tickets to Tower of London</h5>
                        <span>Ticket</span>
                      </div>
                      <div>
                        <ul>
                          <li><span class="tr-rating">89%</span></li>
                          <li>2.5 hours.</li>
                        </ul>
                        <h5>Tickets to Tower of London</h5>
                        <span>Ticket</span>
                      </div>
                      <div>
                        <ul>
                          <li><span class="tr-rating">89%</span></li>
                          <li>2.5 hours.</li>
                        </ul>
                        <h5>Tickets to Tower of London</h5>
                        <span>Ticket</span>
                      </div>
                    </div>
                    @endif
                -->
              </div>
            </div>

            <!-- <div class="tr-historical-monument">
              <div class="tr-heading-with-distance">
                <div class="tr-category">Street</div>
                <div class="tr-distance">1.2 km from Tower of London</div>
              </div>
              <div class="tr-image">
                <a href="javascript:void(0);">
                  <img loading="lazy" src="images/hotel-explore-2.png" alt="">
                </a>
              </div>
              <div class="tr-details">
                <h3><a href="javascript:void(0);" target="_blank">Oxford Street</a></h3>
                <div class="tr-location">City of London</div>
                <div class="tr-more-inform">
                  <ul>
                    <li><span>Open</span>until 5 PM</li>
                    <li>5 hours.</li>
                  </ul>
                </div>
                <div class="tr-like-review">
                  <div class="tr-heart">
                    <svg width="12" height="11" viewBox="0 0 12 11" fill="none" xmlns="http://www.w3.org/2000/svg">
                      <path fill-rule="evenodd" clip-rule="evenodd"
                        d="M5.99604 2.28959C5.02968 1.20745 3.41823 0.916356 2.20745 1.90727C0.996677 2.89818 0.826217 4.55494 1.77704 5.7269L5.99604 9.63412L10.215 5.7269C11.1659 4.55494 11.0162 2.88776 9.78463 1.90727C8.55304 0.92678 6.96239 1.20745 5.99604 2.28959Z"
                        fill="white" stroke="white" stroke-linecap="round" stroke-linejoin="round"></path>
                    </svg>
                  </div>
                  <div class="tr-ranting-percent">89%</div>
                </div>
              </div>
            </div> -->

            @if(!empty($getexp) && is_array($getexp) && in_array($searchresult->SightId, array_column($getexp,
            'SightId')))
            @foreach($getexp as $expen)

            @if($expen['SightId'] == $searchresult->SightId)
            <div class="tr-experience">
              <div class="tr-heading-with-distance">
                <!-- <div class="tr-category">Tour</div> -->
                <div class="tr-distance">{{round($expen['distance'],2)}} km from {{$lname}}</div>
              </div>
              <div class="tr-experience-slider">
                <div class="tr-store">
                  <a href="javascript:void(0);">
                    @if($expen['Img1'] !="")
                    <img src="{{$expen['Img1']}}" alt="hotel image" height="185" width="155">
                    @else
                    <img src="{{asset('public/images/Hotel lobby.svg')}}" alt="hotel image"  height="185" width="155">
                    @endif
                  </a>
                </div>
                <div class="tr-store">
                  <a href="javascript:void(0);">
                    @if($expen['Img2'] !="")
                    <img src="{{$expen['Img2']}}" alt="hotel image"  height="185" width="155">
                    @else
                    <img src="{{asset('public/images/Hotel lobby.svg')}}" alt="hotel image"  height="185" width="155">
                    @endif
                  </a>
                </div>
                <div class="tr-store">
                  <a href="javascript:void(0);">
                    @if($expen['Img3'] !="")
                    <img src="{{$expen['Img3']}}" alt="hotel image"  height="185" width="155">
                    @else
                    <img src="{{asset('public/images/Hotel lobby.svg')}}" alt="hotel image"  height="185" width="155">
                    @endif</a>
                </div>
                <div class="tr-store">
                  <a href="javascript:void(0);"> @if($expen['Img2'] !="")
                    <img src="{{$expen['Img2']}}" alt="hotel image"  height="185" width="155">
                    @else
                    <img src="{{asset('public/images/Hotel lobby.svg')}}" alt="hotel image"  height="185" width="155">
                    @endif</a>
                </div>
              </div>
              <div class="tr-details">
                <h3><a
                    href="@if($expen['viator_url'] !='') {{$expen['viator_url']}} @else {{route('experince',[$expen['slugid'].'-'.$expen['ExperienceId'].'-'.$expen['Slug']])}} @endif"
                    target="_blank">{{$expen['Name']}}</a></h3>
                @if($lname !="") <div class="tr-location">City of {{$lname}}</div>@endif
                <div class="tr-more-inform">
                  <ul>
                    <li><span>Open</span>until 17:10</li>
                    <li>5 hours.</li>
                  </ul>
                </div>
                <div class="tr-like-review">
                  <div class="tr-heart">
                    <svg width="12" height="11" viewBox="0 0 12 11" fill="none" xmlns="http://www.w3.org/2000/svg">
                      <path fill-rule="evenodd" clip-rule="evenodd"
                        d="M5.99604 2.28959C5.02968 1.20745 3.41823 0.916356 2.20745 1.90727C0.996677 2.89818 0.826217 4.55494 1.77704 5.7269L5.99604 9.63412L10.215 5.7269C11.1659 4.55494 11.0162 2.88776 9.78463 1.90727C8.55304 0.92678 6.96239 1.20745 5.99604 2.28959Z"
                        fill="white" stroke="white" stroke-linecap="round" stroke-linejoin="round"></path>
                    </svg>
                  </div>
                  <div class="tr-ranting-percent">89%</div>
                </div>
              </div>
            </div>
            @endif
            @endforeach
            @endif

            <!-- <div class="tr-knights-bridge">
              <div class="tr-image">
                <a href="javascript:void(0);">
                  <img loading="lazy" src="images/knights-bridge.png" alt="">
                </a>
              </div>
              <div class="tr-details">
                <h3><a href="javascript:void(0);" target="_blank">La Dame de Pic London</a></h3>
                <div class="tr-location">Knightsbridge</div>
                <div class="tr-more-inform">
                  <ul>
                    <li><span>Open</span>until 5 PM</li>
                    <li>5 hours.</li>
                  </ul>
                </div>
                <div class="tr-like-review">
                  <div class="tr-heart">
                    <svg width="12" height="11" viewBox="0 0 12 11" fill="none" xmlns="http://www.w3.org/2000/svg">
                      <path fill-rule="evenodd" clip-rule="evenodd"
                        d="M5.99604 2.28959C5.02968 1.20745 3.41823 0.916356 2.20745 1.90727C0.996677 2.89818 0.826217 4.55494 1.77704 5.7269L5.99604 9.63412L10.215 5.7269C11.1659 4.55494 11.0162 2.88776 9.78463 1.90727C8.55304 0.92678 6.96239 1.20745 5.99604 2.28959Z"
                        fill="white" stroke="white" stroke-linecap="round" stroke-linejoin="round"></path>
                    </svg>
                  </div>
                  <div class="tr-ranting-percent">89%</div>
                </div>
              </div>
            </div>

            <div class="tr-market">
              <div class="tr-heading-with-distance">
                <div class="tr-category">Shopping Area</div>
                <div class="tr-distance">1.2 km from Tower of London</div>
              </div>
              <div class="tr-market-slider">
                <div class="tr-store">
                  <a href="javascript:void(0);"><img loading="lazy" src="images/market-1.png" alt=""></a>
                  <div class="tr-store-details">
                    <div class="tr-like-review">
                      <div class="tr-heart">
                        <svg width="12" height="11" viewBox="0 0 12 11" fill="none" xmlns="http://www.w3.org/2000/svg">
                          <path fill-rule="evenodd" clip-rule="evenodd"
                            d="M5.99604 2.28959C5.02968 1.20745 3.41823 0.916356 2.20745 1.90727C0.996677 2.89818 0.826217 4.55494 1.77704 5.7269L5.99604 9.63412L10.215 5.7269C11.1659 4.55494 11.0162 2.88776 9.78463 1.90727C8.55304 0.92678 6.96239 1.20745 5.99604 2.28959Z"
                            fill="white" stroke="white" stroke-linecap="round" stroke-linejoin="round"></path>
                        </svg>
                      </div>
                      <div class="tr-ranting-percent">89%</div>
                    </div>
                    <div class="tr-store-type">Clothing Store</div>
                    <h5 class="tr-store-name"><a href="javascript:void(0);">Louis Vuitton</a></h5>
                  </div>
                </div>
                <div class="tr-store">
                  <a href="javascript:void(0);"><img loading="lazy" src="images/market-2.png" alt=""></a>
                  <div class="tr-store-details">
                    <div class="tr-like-review">
                      <div class="tr-heart">
                        <svg width="12" height="11" viewBox="0 0 12 11" fill="none" xmlns="http://www.w3.org/2000/svg">
                          <path fill-rule="evenodd" clip-rule="evenodd"
                            d="M5.99604 2.28959C5.02968 1.20745 3.41823 0.916356 2.20745 1.90727C0.996677 2.89818 0.826217 4.55494 1.77704 5.7269L5.99604 9.63412L10.215 5.7269C11.1659 4.55494 11.0162 2.88776 9.78463 1.90727C8.55304 0.92678 6.96239 1.20745 5.99604 2.28959Z"
                            fill="white" stroke="white" stroke-linecap="round" stroke-linejoin="round"></path>
                        </svg>
                      </div>
                      <div class="tr-ranting-percent">89%</div>
                    </div>
                    <div class="tr-store-type">Clothing Store</div>
                    <h5 class="tr-store-name"><a href="javascript:void(0);">Louis Vuitton</a></h5>
                  </div>
                </div>
                <div class="tr-store">
                  <a href="javascript:void(0);"><img loading="lazy" src="images/market-3.png" alt=""></a>
                  <div class="tr-store-details">
                    <div class="tr-like-review">
                      <div class="tr-heart">
                        <svg width="12" height="11" viewBox="0 0 12 11" fill="none" xmlns="http://www.w3.org/2000/svg">
                          <path fill-rule="evenodd" clip-rule="evenodd"
                            d="M5.99604 2.28959C5.02968 1.20745 3.41823 0.916356 2.20745 1.90727C0.996677 2.89818 0.826217 4.55494 1.77704 5.7269L5.99604 9.63412L10.215 5.7269C11.1659 4.55494 11.0162 2.88776 9.78463 1.90727C8.55304 0.92678 6.96239 1.20745 5.99604 2.28959Z"
                            fill="white" stroke="white" stroke-linecap="round" stroke-linejoin="round"></path>
                        </svg>
                      </div>
                      <div class="tr-ranting-percent">89%</div>
                    </div>
                    <div class="tr-store-type">Clothing Store</div>
                    <h5 class="tr-store-name"><a href="javascript:void(0);">Louis Vuitton</a></h5>
                  </div>
                </div>
                <div class="tr-store">
                  <a href="javascript:void(0);"><img loading="lazy" src="images/market-1.png" alt=""></a>
                  <div class="tr-store-details">
                    <div class="tr-like-review">
                      <div class="tr-heart">
                        <svg width="12" height="11" viewBox="0 0 12 11" fill="none" xmlns="http://www.w3.org/2000/svg">
                          <path fill-rule="evenodd" clip-rule="evenodd"
                            d="M5.99604 2.28959C5.02968 1.20745 3.41823 0.916356 2.20745 1.90727C0.996677 2.89818 0.826217 4.55494 1.77704 5.7269L5.99604 9.63412L10.215 5.7269C11.1659 4.55494 11.0162 2.88776 9.78463 1.90727C8.55304 0.92678 6.96239 1.20745 5.99604 2.28959Z"
                            fill="white" stroke="white" stroke-linecap="round" stroke-linejoin="round"></path>
                        </svg>
                      </div>
                      <div class="tr-ranting-percent">89%</div>
                    </div>
                    <div class="tr-store-type">Clothing Store</div>
                    <h5 class="tr-store-name"><a href="javascript:void(0);">Louis Vuitton</a></h5>
                  </div>
                </div>
                <div class="tr-store">
                  <a href="javascript:void(0);"><img loading="lazy" src="images/market-2.png" alt=""></a>
                  <div class="tr-store-details">
                    <div class="tr-like-review">
                      <div class="tr-heart">
                        <svg width="12" height="11" viewBox="0 0 12 11" fill="none" xmlns="http://www.w3.org/2000/svg">
                          <path fill-rule="evenodd" clip-rule="evenodd"
                            d="M5.99604 2.28959C5.02968 1.20745 3.41823 0.916356 2.20745 1.90727C0.996677 2.89818 0.826217 4.55494 1.77704 5.7269L5.99604 9.63412L10.215 5.7269C11.1659 4.55494 11.0162 2.88776 9.78463 1.90727C8.55304 0.92678 6.96239 1.20745 5.99604 2.28959Z"
                            fill="white" stroke="white" stroke-linecap="round" stroke-linejoin="round"></path>
                        </svg>
                      </div>
                      <div class="tr-ranting-percent">89%</div>
                    </div>
                    <div class="tr-store-type">Clothing Store</div>
                    <h5 class="tr-store-name"><a href="javascript:void(0);">Louis Vuitton</a></h5>
                  </div>
                </div>
              </div>
              <div class="tr-details">
                <h3><a href="javascript:void(0);" target="_blank">Camden Market</a></h3>
                <div class="tr-location">City of London</div>
                <div class="tr-more-inform">
                  <ul>
                    <li><span>Open</span>until 17:10</li>
                    <li>5 hours.</li>
                  </ul>
                </div>
                <div class="tr-like-review">
                  <div class="tr-heart">
                    <svg width="12" height="11" viewBox="0 0 12 11" fill="none" xmlns="http://www.w3.org/2000/svg">
                      <path fill-rule="evenodd" clip-rule="evenodd"
                        d="M5.99604 2.28959C5.02968 1.20745 3.41823 0.916356 2.20745 1.90727C0.996677 2.89818 0.826217 4.55494 1.77704 5.7269L5.99604 9.63412L10.215 5.7269C11.1659 4.55494 11.0162 2.88776 9.78463 1.90727C8.55304 0.92678 6.96239 1.20745 5.99604 2.28959Z"
                        fill="white" stroke="white" stroke-linecap="round" stroke-linejoin="round"></path>
                    </svg>
                  </div>
                  <div class="tr-ranting-percent">89%</div>
                </div>
              </div>
            </div> -->

            @if(!empty($restaurantdata) && is_array($restaurantdata) && in_array($searchresult->SightId, array_column($restaurantdata, 'SightId')))
            @foreach($restaurantdata as $resta)
                @if($resta['SightId'] == $searchresult->SightId)
                    <div class="tr-restaurant" onmouseover="highlightRestaurantMarker(this)" onmouseout="unhighlightRestaurantMarker(this)" data-restaurant-id="{{ $resta['RestaurantId'] }}">
                        <!-- Restaurant Information -->
                        <div class="tr-heading-with-distance">
                            <div class="tr-distance">{{ round($resta['distance'], 2) }} km from {{ $resta['locname'] }}</div>
                        </div>
                        <div class="tr-row">
                            <div class="tr-image">
                                <a href="javascript:void(0);">
                                    <img loading="lazy" src="{{ asset('public/images/Hotel lobby-image.png') }}" alt="" width="108" height="130">
                                </a>
                            </div>
                            <div class="tr-restaurant-details">
                                <div class="tr-details">
                                    <h3>
                                        <a href="{{ route('restaurant_detail', [$resta['slugid'].'-'.$resta['RestaurantId'].'-'.$resta['Slug']]) }}" target="_blank">{{ $resta['Title'] }}</a>
                                    </h3>
                                    <div class="tr-location">City of {{ $resta['locname'] }}</div>
                                    <div class="tr-like-review">
                                        <div class="tr-heart">
                                            <svg width="12" height="11" fill="none">
                                                <path d="M5.996 2.29C5.03 1.21 3.42 0.92 2.207 1.91C0.997 2.9 0.826 4.55 1.777 5.73L5.996 9.63L10.215 5.73C11.166 4.55 11.016 2.89 9.785 1.91C8.553 0.93 6.962 1.21 5.996 2.29Z" fill="white" stroke="white"></path>
                                            </svg>
                                        </div>
                                        <div class="tr-ranting-percent">
                                            @if($resta['TAAggregateRating'] != "" && $resta['TAAggregateRating'] != 0)
                                                {{ rtrim($resta['TAAggregateRating'], '.0') * 20 }}%
                                            @else
                                                --
                                            @endif
                                        </div>
                                    </div>

                                    <!-- Timings, Price Range, Category, and Features -->
                                    <div class="tr-more-inform">
                                        <ul>
                                            <li><span>Open</span> @if($resta['Timings'] != "") {{ $resta['Timings'] }} @endif</li>
                                            <li>@if($resta['PriceRange'] != "") {{ $resta['PriceRange'] }} @endif</li>
                                        </ul>
                                    </div>

                                    @if($resta['category'] != "")
                                        <div class="tr-more-inform">
                                            <ul>
                                                @foreach(explode(',', $resta['category']) as $ct)
                                                    <li>{{ $ct }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif

                                    @if($resta['features'] != "")
                                        <div class="tr-delivery-type">
                                            <ul>
                                                @foreach(explode(',', $resta['features']) as $ft)
                                                    <li class="tr-yes">{{ ucfirst($ft) }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif

                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach
        @endif

            @endforeach

            @else
            <li>No results found.</li>
            @endif
          </span>
          <div id="loading" style="display: none;"> </div>

          <button type="button" class="tr-btn tr-load-more">Load More</button>
   <!--BREADCRUMB - START-->
            @if(!empty($breadcumb))
            <div class="tr-breadcrumb-section">
              <ul class="tr-breadcrumb">
              @if($breadcumb[0]->ccName !="")
                <li><a href="{{ route('explore_continent_list',[$breadcumb[0]->contid,$breadcumb[0]->ccName])}}">{{$breadcumb[0]->ccName}}</a></li>
                @endif
                <li><a href="{{ route('explore_country_list',[$breadcumb[0]->CountryId,$breadcumb[0]->cslug])}}">@if(!empty($breadcumb)) {{$breadcumb[0]->CountryName}} @endif</a></li>
                @if(!empty($locationPatent))
                <?php
                $locationPatent = $locationPatent;

                ?>
                  @foreach ($locationPatent as $location)
                <li><a href="{{ route('search.results',[$location['LocationId'].'-'.strtolower($location['slug'])]) }}">{{ $location['Name'] }}</a></li>
                @endforeach
                @endif
                <li>{{$breadcumb[0]->LName}}</li>
              </ul>

            </div>
            @endif
          <!--BREADCRUMB - END-->
          <div class="tr-map-and-filter">
            <button type="button" class="tr-explore-map-btn map"><svg width="14" height="14" viewBox="0 0 14 14"
                fill="none" xmlns="http://www.w3.org/2000/svg">
                <g clip-path="url(#clip0_2464_12970)">
                  <path
                    d="M0.583984 3.4974V12.8307L4.66732 10.4974L9.33398 12.8307L13.4173 10.4974V1.16406L9.33398 3.4974L4.66732 1.16406L0.583984 3.4974Z"
                    stroke="white" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"></path>
                  <path d="M4.66602 1.16406V10.4974" stroke="white" stroke-width="1.2" stroke-linecap="round"
                    stroke-linejoin="round"></path>
                  <path d="M9.33398 3.5V12.8333" stroke="white" stroke-width="1.2" stroke-linecap="round"
                    stroke-linejoin="round"></path>
                </g>
                <defs>
                  <clipPath id="clip0_2464_12970">
                    <rect width="14" height="14" fill="white"></rect>
                  </clipPath>
                </defs>
              </svg>Map</button>
          </div>

        </div>
        <div class="tr-explore-right-section" style="">
          <div class="tr-map-section">
            <button type="button" class="btn-close"></button>
            <div class="tr-hotel-on-map">
              <form>
               <!-- <div class="tr-recent-searchs-modal" id="">
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
                </div> -->
              </form>
            </div>
            <!-- <div class="tr-map-tooltip tr-explore-listing">
              <div class="tr-historical-monument">
                <div class="tr-heading-with-distance">
                  <div class="tr-category">Shopping Area</div>
                  <div class="tr-distance">1.2 km from Tower of London</div>
                </div>
                <div class="tr-image">
                  <a href="javascript:void(0);">
                    <img loading="lazy" src="images/hotel-explore-2.png" alt="">
                  </a>
                </div>
                <div class="tr-details">
                  <h3><a href="javascript:void(0);" target="_blank">Oxford Street</a></h3>
                  <div class="tr-location">City of London</div>
                  <div class="tr-like-review">
                    <div class="tr-heart">
                      <svg width="12" height="11" viewBox="0 0 12 11" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" clip-rule="evenodd"
                          d="M5.99604 2.28959C5.02968 1.20745 3.41823 0.916356 2.20745 1.90727C0.996677 2.89818 0.826217 4.55494 1.77704 5.7269L5.99604 9.63412L10.215 5.7269C11.1659 4.55494 11.0162 2.88776 9.78463 1.90727C8.55304 0.92678 6.96239 1.20745 5.99604 2.28959Z"
                          fill="white" stroke="white" stroke-linecap="round" stroke-linejoin="round"></path>
                      </svg>
                    </div>
                    <div class="tr-ranting-percent">89%</div>
                  </div>
                </div>
                <div class="tr-more-inform">
                  <ul>
                    <li><span>Open</span>until 5 PM</li>
                    <li>5 hours.</li>
                  </ul>
                </div>
              </div>
            </div> -->
            <!-- <img src="{{asset('public/frontend/hotel-detail/images/map-2.png')}}" class="tr-temp-img" alt="map" /> -->
            @if(!empty($searchresults))
            <div id="map1" class="explore-listing-map"></div>
            @endif
          </div>
          <div class="tr-explore-overlay"></div>
        </div>
      </div>
    </div>
  </div>

  <!-- Map Modal With Filter & Hotel List - Start-->

  <!-- Map Modal With Filter & Hotel List - End-->

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
            <img loading="lazy" src="images/room-image-1.png" alt="Room Image">
          </div>
          <div class="tr-share-details">
            <span class="tr-hotel-name">Things to do in London</span>
            <p>3590 Attractions found in London</p>
            <!--
              <span class="tr-rating">4.83</span>
              <span class="tr-bedrooms">
                <span>2 bedrooms</span>
                <span>3 beds</span>
                <span>2 bathrooms</span>
              </span>
              -->
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
</body>

</html>

	
    <script src="{{ asset('/public/js/header.js')}}"></script>
    <script type="text/javascript" src="{{ asset('/public/frontend/hotel-detail/js/common.js')}} "></script>
    <script src="{{ asset('/public/js/restaurant.js')}}"></script>
	<script src="{{ asset('/public/js/custom.js')}}"></script>
	
<script src="{{ asset('/public/js/map_leaflet.js')}}"></script>
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "ItemList",
  "name": "Things to do in {{$lname}}",
  "description": "Things to do in {{$lname}},@if(!empty($breadcumb)){{$breadcumb[0]->CountryName}} @endif",
  "itemListOrder": "https://schema.org/ItemListOrderAscending",
  "itemListElement": [
    @if(!empty($searchresults))
      <?php $z = 1; $totalItems = count($searchresults);  ?>

      @foreach($searchresults as $val)
	  <?php $li =1; ?>
        {
          "@type": "ListItem",
          "position": {{$z}},
          "name": "{{$val->Title}}",
          "url": "{{ asset('at-'.$val->slugid.'-'.$val->SightId.'-'.strtolower($val->Slug)) }}"
          @if(!$sightImages->isEmpty())
            @foreach($sightImages as $sighimgs)
              @if($sighimgs->Sightid == $val->SightId && $li ==1)
			  ,
                "image": "https://s3-us-west-2.amazonaws.com/s3-travell/Sight-images/{{ $sighimgs->Image }}"
				 <?php $li++; ?>
              @endif
            @endforeach
          @endif
        }

        <?php if ($z < $totalItems): ?>
          ,
        <?php endif; ?>

        <?php $z++; ?>
      @endforeach
    @endif
  ]
}
</script>
<script>
    var mapInitialized = false; // Track if the map is already initialized
    var map;
    var locations = [];
    var restaurantLocations = [];
    <?php foreach ($searchresults as $result): ?>
    <?php if (!empty($result->Latitude) && !empty($result->Longitude)): ?>
    locations.push([<?php echo $result->Latitude; ?>, <?php echo $result->Longitude; ?>]);
    <?php endif; ?>
    <?php endforeach; ?>

    @foreach($restaurantdata as $resta)
        restaurantLocations.push({
            lat: {{ $resta['Latitude'] }},
            long: {{ $resta['Longitude'] }},
            name: '{{ $resta['Title'] }}',
            city: '{{ $resta['locname'] }}',
            rating: '{{ $resta['TAAggregateRating'] }}',
            id: '{{ $resta['RestaurantId'] }}',
            image: '{{ asset("public/images/Hotel lobby-image.png") }}'
        });
    @endforeach

    var defaultCenter = [48.8566, 2.3522]; // Default location (Paris)
    var center = locations.length > 0 ? locations[0] : defaultCenter;

    // Detect if the user is on a mobile device
    var isMobile = window.innerWidth <= 768;

    var mapOptions = {
        center: center,
        zoom: isMobile ? 12 : 9 // Adjust zoom level for mobile and non-mobile devices
    };

    var map = new L.map('map1', mapOptions);
    var layer = new L.TileLayer('https://{s}.basemaps.cartocdn.com/light_all/{z}/{x}/{y}{r}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors &copy; <a href="https://carto.com/attributions">CARTO</a>',
        subdomains: 'abcd',
        maxZoom: 19
    });

    map.addLayer(layer);

    // Disable scroll zoom and dragging on the map to prevent map movement
    map.scrollWheelZoom.disable();
    map.dragging.disable();

    // Redirect scroll over the map to the hotel listing
    const mapContainer = document.querySelector('#map1');  // Map container
    const hotelListingContainer = document.querySelector('.tr-explore-left-section');  // Hotel listing container

    // Redirect scrolling when the mouse wheel is used over the map
    mapContainer.addEventListener('wheel', function(event) {
        event.preventDefault(); // Prevent the default map scroll behavior
        hotelListingContainer.scrollBy({
            top: event.deltaY, // Scroll by the amount the user scrolls
            behavior: 'auto' // You can use 'smooth' for smooth scrolling
        });
    });

    // Custom marker icons for hotels
    var defaultIcon = L.icon({
        iconUrl: '{{asset('public/js/images/3.svg')}}', // Path to your custom icon
        iconSize: [32, 40], // Adjust size as per your requirement
    });

    var highlightedIcon = L.icon({
        iconUrl: '{{asset('public/js/images/4.svg')}}', // Another custom icon for highlighted markers
        iconSize: [34, 42], // Adjust size as per your requirement
    });

    var defaultIconRes = L.icon({
        iconUrl: '{{asset('public/js/images/1.svg')}}', // Path to your custom icon
        iconSize: [32, 40], // Adjust size as per your requirement
    });

    var highlightedIconRes = L.icon({
        iconUrl: '{{asset('public/js/images/1h.svg')}}', // Another custom icon for highlighted markers
        iconSize: [34, 42], // Adjust size as per your requirement
    });
    var markers = {};

    var restaurantMarkers = {};
    // Initialize markers with custom icons on page load
    <?php for ($i = 0; $i < count($searchresults); $i++): ?>
    <?php if (!empty($searchresults[$i]->Latitude) && !empty($searchresults[$i]->Longitude)): ?>
    var name<?php echo $i; ?> = '<?php echo addslashes($searchresults[$i]->Title); ?>';
    var isRecommend<?php echo $i; ?> = document.querySelector('.isrecomd_<?php echo $i; ?>') ? document.querySelector('.isrecomd_<?php echo $i; ?>').textContent : 'N/A';
    var cityName<?php echo $i; ?> = document.querySelector('.cityname_<?php echo $i; ?>') ? document.querySelector('.cityname_<?php echo $i; ?>').textContent.trim() : 'N/A';
    var timing<?php echo $i;?> = document.querySelector('.timing_<?php echo $i;?>') ? document.querySelector('.timing_<?php echo $i;?>').textContent : 'N/A';
    var imagePath<?php echo $i; ?> = document.querySelector('.imagepath_<?php echo $i; ?>') ? document.querySelector('.imagepath_<?php echo $i; ?>').textContent.trim() : 'N/A';
    var category<?php echo $i; ?> = document.querySelector('.catname_<?php echo $i; ?>') ? document.querySelector('.catname_<?php echo $i; ?>').textContent.trim() : 'N/A';

    // Create the marker with custom icon during initialization
    var marker<?php echo $i; ?> = new L.Marker([<?php echo $searchresults[$i]->Latitude; ?>, <?php echo $searchresults[$i]->Longitude; ?>], { icon: defaultIcon });
    marker<?php echo $i; ?>.addTo(map);

// Event listener for showing popup on click
marker<?php echo $i; ?>.on('click', function(e) {
    showTestName(e, name<?php echo $i; ?>, isRecommend<?php echo $i; ?>, cityName<?php echo $i; ?>, timing<?php echo $i; ?>, imagePath<?php echo $i; ?>, category<?php echo $i; ?>);
});

// Close the popup when clicking outside of it
map.on('click', function(event) {
    if (!event.originalEvent.target.closest('.leaflet-popup-content')) {
        marker<?php echo $i; ?>.closePopup();
    }
});

// Add event listener for marker hover to highlight the marker
marker<?php echo $i; ?>.on('mouseover', function(e) {
    marker<?php echo $i; ?>.setIcon(highlightedIcon);
});

// Revert icon on mouseout
marker<?php echo $i; ?>.on('mouseout', function(e) {
    marker<?php echo $i; ?>.setIcon(defaultIcon);
});

    // Add the marker to the markers object
    markers[<?php echo $searchresults[$i]->SightId; ?>] = marker<?php echo $i; ?>;
    <?php endif; ?>
    <?php endfor; ?>


    // Function to show popup content
    function showTestName(e, name, isRecommend, cityName, timing, imagePath, category) {
        var marker = e.target;

        // Use default placeholders for missing data
        var popupContent = ` 
        <div class="tr-map-tooltip tr-explore-listing" style="top: -214px !important; right: 0; left: 0; margin: auto; font-size: 14px;">
            <div class="tr-historical-monument">
                <div class="tr-heading-with-distance">
                    <div class="tr-category" style="font-size: 12px;">${category || 'No Category Available'}</div>
                </div>
                <div class="tr-image">
                    <a href="javascript:void(0);">
                        <img loading="lazy" src="${imagePath || 'default-image.png'}" alt="" height="109" width="280">
                    </a>
                </div>
                <div class="tr-details" style="font-size: 14px;">
                    <h3 style="font-size: 16px;">${name || 'Unnamed Attraction'}</h3>
                    <div class="tr-location" style="font-size: 12px;">${cityName || 'Unknown City'}</div>
                    <div class="tr-like-review">
                        <div class="tr-heart">
                            <svg width="12" height="11" viewBox="0 0 12 11" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M5.99604 2.28959C5.02968 1.20745 3.41823 0.916356 2.20745 1.90727C0.996677 2.89818 0.826217 4.55494 1.77704 5.7269L5.99604 9.63412L10.215 5.7269C11.1659 4.55494 11.0162 2.88776 9.78463 1.90727C8.55304 0.92678 6.96239 1.20745 5.99604 2.28959Z" fill="white" stroke="white" stroke-linecap="round" stroke-linejoin="round"></path>
                            </svg>
                        </div>
                        <div class="tr-ranting-percent" style="font-size: 12px;">${isRecommend || ''}</div>
                    </div>
                </div>
            </div>
            <div class="tr-more-inform" style="font-size: 12px;">
                <ul>
                    <li><span>Open </span>${timing || ''}</li>
                </ul>
            </div>
        </div>`;

        marker.unbindPopup(); // Unbind existing popups to ensure no conflicts
        marker.bindPopup(popupContent, {
            offset: L.point(0, -20), // Adjust the popup offset for better positioning
            autoPan: true // Ensure the popup stays within the map bounds
        }).openPopup();
    }

    // FOR RESTAURANT

    restaurantLocations.forEach(function(location) {
		
		
        // Create marker for each restaurant location with custom icon
        var marker = L.marker([location.lat, location.long], { icon: defaultIconRes }).addTo(map);

        // Define the detailed popup content similar to the showTestName function
        var popupContent = `
            <div class="tr-map-tooltip tr-explore-listing" style="top: -214px !important; right: 0; left: 0; margin: auto; font-size: 14px;">
                <div class="tr-historical-monument">
                    <div class="tr-heading-with-distance">
                        <div class="tr-category" style="font-size: 12px;">${location.category || 'Category Not Available'}</div>
                    </div>
                    <div class="tr-image">
                        <a href="javascript:void(0);">
                            <img loading="lazy" src="${location.image || 'default-image.png'}" alt="${location.name || 'Image'}" height="109" width="280">
                        </a>
                    </div>
                    <div class="tr-details" style="font-size: 14px;">
                        <h3 style="font-size: 16px;">${location.name || 'Unnamed Location'}</h3>
                        <div class="tr-location" style="font-size: 12px;">${location.city || 'Unknown City'}</div>
                        <div class="tr-like-review">
                            <div class="tr-heart">
                                <svg width="12" height="11" viewBox="0 0 12 11" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M5.99604 2.28959C5.02968 1.20745 3.41823 0.916356 2.20745 1.90727C0.996677 2.89818 0.826217 4.55494 1.77704 5.7269L5.99604 9.63412L10.215 5.7269C11.1659 4.55494 11.0162 2.88776 9.78463 1.90727C8.55304 0.92678 6.96239 1.20745 5.99604 2.28959Z" fill="white" stroke="white" stroke-linecap="round" stroke-linejoin="round"></path>
                                </svg>
                            </div>
                            <div class="tr-ranting-percent" style="font-size: 12px;">${location.rating ? location.rating + '%' : 'No Rating Available'}</div>
                        </div>
                    </div>
                    <div class="tr-more-inform" style="font-size: 12px;">
                        <ul>
                            <li><span>Open:</span> ${location.timing || 'No Information Available'}</li>
                        </ul>
                    </div>
                </div>
            </div>
        `;

        // Bind the popup to the marker
        marker.bindPopup(popupContent, {
            offset: L.point(0, -20), // Adjust the offset for better positioning
            autoPan: true // Ensure the popup stays within the map bounds
        });

        // Store the marker in a dictionary for future reference
        restaurantMarkers[location.id] = marker;

        // Add event listener for marker click to open the popup
        marker.on('click', function(e) {
            marker.openPopup();
        });

        // Close the popup when clicking outside of it
        map.on('click', function(event) {
            if (!event.originalEvent.target.closest('.leaflet-popup-content')) {
                marker.closePopup();
            }
        });

        // Add event listener for marker hover to highlight the marker
        marker.on('mouseover', function(e) {
            marker.setIcon(highlightedIconRes);
        });

        // Revert icon on mouseout
        marker.on('mouseout', function(e) {
            marker.setIcon(defaultIconRes);
        });
    });

    // Function to adjust map zoom level
    function adjustMapZoom() {
        if (window.innerWidth <= 768) { // Check if it's mobile
            map.setZoom(13); // Adjust zoom level for mobile
        } else {
            map.setZoom(15); // Adjust zoom level for desktop
        }
    }

    // Call the function to adjust the zoom level based on the device
    adjustMapZoom();

    window.addEventListener('resize', adjustMapZoom);

    $('.tr-explore-map-btn').click(function() {
        // Show the map section
        $(".tr-explore-listing .tr-map-section").css({
            "display": "block"
        });
        $("body").addClass('modal-open');

        // Adjust the map size after it becomes visible
        setTimeout(function() {
            map.invalidateSize();
            // Adjust map zoom level on mobile after it becomes visible
            adjustMapZoom();
        }, 100); // Adding a slight delay to ensure the map is fully visible before recalculating its size
    });

    function highlightRestaurantMarker(element) {
        var restaurantId = element.getAttribute('data-restaurant-id');
        if (restaurantMarkers[restaurantId]) {
            restaurantMarkers[restaurantId].setIcon(highlightedIconRes);
            restaurantMarkers[restaurantId].openPopup();
        }
    }

    function unhighlightRestaurantMarker(element) {
        var restaurantId = element.getAttribute('data-restaurant-id');
        if (restaurantMarkers[restaurantId]) {
            restaurantMarkers[restaurantId].setIcon(defaultIconRes);
            restaurantMarkers[restaurantId].closePopup();
        }
    }

    function highlightMarker(element) {
        var sid = element.querySelector(".sid").textContent;

        var attractionElements = document.querySelectorAll('.attraction');
        attractionElements.forEach(function(element) {
            var sid = element.getAttribute('data-sid');
            var marker = markers[sid];

            if (marker) {
                marker.setIcon(
                    L.icon({
                        iconUrl: '{{asset('public/js/images/3.svg')}}',
                        iconSize: [32, 40],
                    })
                );
            }
        });

        var marker = markers[sid];

        if (marker) {
            marker.setIcon(
                L.icon({
                    iconUrl: '{{asset('public/js/images/4.svg')}}',
                    iconSize: [34, 42],
                })
            );
            marker.openPopup();
        }
    }

    function unhighlightMarker(element) {
        var sid = element.querySelector(".sid").textContent;
        var marker = markers[sid];

        if (marker) {
            marker.setIcon(
                L.icon({
                    iconUrl: '{{asset('public/js/images/3.svg')}}',
                    iconSize: [32, 40],
                })
            );
            marker.closePopup();
        }
        updateMarkerIcons();
    }

    function updateMarkerIcons() {
        var attractionElements = document.querySelectorAll('.attraction');
        attractionElements.forEach(function(element) {
            var sid = element.getAttribute('data-sid');
            var isMustSee = element.getAttribute('data-ismustsee');

            if (isMustSee === "1") {
                var marker = markers[sid];
                if (marker) {
                    marker.setIcon(
                        L.icon({
                            iconUrl: '{{asset('public/js/images/3.svg')}}',
                            iconSize: [32, 40],
                        })
                    );
                }
            }
        });
    }

    // **Handle map zoom events to ensure custom markers persist**
    map.on('zoomend', function() {
        updateMarkerIcons();  // Ensure custom markers stay updated after zoom
    });

    // **Handle move events to reapply custom markers after map moves**
    map.on('moveend', function() {
        updateMarkerIcons();  // Reapply the custom markers after the map moves
    });

    window.onload = function() {
        updateMarkerIcons(); // Initial update to ensure custom icons on load
    };
</script>
