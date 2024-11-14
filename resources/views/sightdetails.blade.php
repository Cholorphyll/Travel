<!DOCTYPE html>
<html lang="en-US">
  <head>
  <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-PTHP3JH4');</script>
   @php $title = '';$lname=''; @endphp
@if(!empty($searchresult)) @php $title = $searchresult[0]->Title; $lname=$searchresult[0]->Name; @endphp @endif
  <title>{{$title}}, {{$lname}}@if(!empty($locationPatent)), @foreach($locationPatent as $location){{$location['Name']}}@if(!$loop->last),@endif @endforeach @endif– Reviews, Hours, and Photos - Travell</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Planning to visit {{$title}}? Read Reviews, check hours, and see traveler photos of {{$title}}, {{$lname}}.">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Figtree:ital,wght@0,300..900;1,300..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    
 

    <script type="text/javascript" src="{{ asset('/public/frontend/hotel-detail/js/jquery.min.js')}}"></script>
  <script type="text/javascript" src="{{ asset('/public/frontend/hotel-detail/js/bootstrap.bundle.min.js')}}"></script>
  <script type="text/javascript" src="{{ asset('/public/frontend/hotel-detail/js/jquery-ui-datepicker.min.js')}}">
  </script>
 


  <link rel="stylesheet" href="{{ asset('/public/frontend/hotel-detail/css/bootstrap.min.css')}}">
  <link rel="stylesheet" href="{{ asset('/public/frontend/hotel-detail/css/style.css')}}">


  <link rel="stylesheet" href="{{ asset('/public/frontend/hotel-detail/css/calendar.css')}}" media="screen">
  <link rel="stylesheet" href="{{ asset('/public/frontend/hotel-detail/css/responsive.css')}}">
  <link rel="stylesheet" href="{{ asset('/public/frontend/hotel-detail/css/custom.css')}}">
  <link rel="stylesheet" href="{{ asset('/public/css/map_leaflet.css')}}">

  </head>
  
<?php
      $locationPatents = array_reverse($locationPatent);
       $n = 2;
      ?>
<script type="application/ld+json">
{
  "@context": "https://schema.org/",
  "@type": "BreadcrumbList",
  "itemListElement": [
        {
    "@type": "ListItem",
    "position": 1,
    "name": " @if(!empty($breadcumb)) {{ $breadcumb[0]->ccName }} @endif",
    "item": " @if(!empty($breadcumb))  @if($breadcumb[0]->ccName !=""){{ route('explore_continent_list',[$breadcumb[0]->contid,$breadcumb[0]->ccName])}}@endif @endif"
  },
    {
    "@type": "ListItem",
    "position": 1,
    "name": "@if(!empty($breadcumb)) {{$breadcumb[0]->CountryName}} @endif",
    "item": " @if(!empty($breadcumb)) {{ route('explore_country_list',[$breadcumb[0]->CountryId,$breadcumb[0]->cslug])}} @endif"
  },
  @if(!empty($searchresult))
    @if(!empty($locationPatents))
      @foreach($locationPatents as $location) {
        "@type": "ListItem",
        "position": {{$n}},
       
        "name": "{{ $location['Name'] }}",
        "item": "{{ route('search.results',[$location['LocationId'].'-'.strtolower($location['slug']).'-'.str_replace(' ','_',strtolower($searchresult[0]->countryName))]) }}"
      },
      <?php $n++; ?>
      @endforeach
      @endif
    @endif
    @if(!empty($searchresult))
    {
    "@type": "ListItem",
    "position": {{$n}},
    "name": "{{$searchresult[0]->Name}}",
    "item": "{{ route('search.results',[$searchresult[0]->LocationId.'-'.strtolower($searchresult[0]->Lslug).'-'.strtolower($searchresult[0]->countryName)]) }}"
  }, {
    "@type": "ListItem",
    "position": {{$n + 1}},
    "name": "{{$searchresult[0]->Title}}",
    "item": ""
  } 
   @endif
   ]
}
</script>
  <body>
    <!--HEADER-->
    @include('frontend.header')

    <!-- Mobile Navigation-->
    @include('frontend.mobile_nav')

    <div class="tr-explore-details responsive-container">
      <div class="container">
        <div class="row tr-explore-information">
          <div class="col-lg-6 col-md-12 tr-right-col">
            <!--GALLERY - START-->
            <div class="tr-explore-galleries">
              <div class="tr-desktop d-none d-sm-block d-md-block">
                <div class="tr-thumb-images">
                  <ul>    
                  @if( isset($Sight_image[0]->Image) && $Sight_image[0]->Image !='')             
                    <li>                  
                      <img src="https://s3-us-west-2.amazonaws.com/s3-travell/Sight-images/{{$Sight_image[0]->Image}}" alt="Tower Bridge" height="445" height="360">
                    </li>
                    @else
                    <!-- Below element When We don't have data - Start -->
                    <div >
                      <img src="{{asset('public/frontend/hotel-detail/images/no-data-place-image.png')}}" alt="">      
                    </div>
                    <!-- Below element When We don't have data - End -->

                    @endif


                    @if(!$Sight_image->isEmpty() && $Sight_image->count() > 1)
                    @php                         
                          $remainingImages = $Sight_image->slice(1);
                      @endphp

                      @if(!$remainingImages->isEmpty())
                          @foreach($remainingImages as $image)
                              <li>
                                  <img src="@if(isset($image->Image) && $image->Image != '')                                 
                                               https://s3-us-west-2.amazonaws.com/s3-travell/Sight-images/{{$image->Image }}                                        
                                          @endif" 
                                      alt="Tower Bridge" height="115" width="110">
                              </li>
                          @endforeach
                          @if(count($Sight_image) < 5) 
                            @for($i=0; $i < 6 - count($Sight_image); $i++)
                              <li>
                                    <img src="{{asset('public/frontend/hotel-detail/images/no-data-place-image.png')}}" 
                                        alt="Tower Bridge" height="115" width="110">
                                </li>
                              @endfor
                          @endif
                      @endif

                    @endif
                  </ul>
              @if(!$Sight_image->isEmpty())
              <?php  $tsightimg =  count($Sight_image) - 1  ?>
                        <a href="javascript:void(0);" class="tr-show-all-photos" @if($tsightimg ==0) style="height: 41px;
    width: 48px;" @endif>@if($tsightimg ==0) Gallery View @else + {{ $tsightimg }} @endif</a>
              @endif
                </div>
              </div>
              <div class="tr-mobile-galleries d-block d-sm-none d-md-none">
                <div id="demo" class="carousel slide" data-bs-ride="carousel" data-interval="false">
                @if(!$Sight_image->isEmpty() && $Sight_image->count() > 1)
                  <!-- Indicators/dots -->
                  <div class="carousel-indicators">
                    <button type="button" data-bs-target="#demo" data-bs-slide-to="0" class="active"></button>
                    <button type="button" data-bs-target="#demo" data-bs-slide-to="1"></button>
                    <button type="button" data-bs-target="#demo" data-bs-slide-to="2"></button>
                    <button type="button" data-bs-target="#demo" data-bs-slide-to="3"></button>
                    <button type="button" data-bs-target="#demo" data-bs-slide-to="4"></button>
                  </div>
                  <!-- The slideshow/carousel -->
                   @endif
                  <div class="carousel-inner">
                    <div class="carousel-item active">
                       <img src="@if( isset($Sight_image[0]->Image) && $Sight_image[0]->Image !='')  https://s3-us-west-2.amazonaws.com/s3-travell/Sight-images/{{$Sight_image[0]->Image }}  @else {{asset('public/frontend/hotel-detail/images/no-data-place-image.png')}} @endif " alt="Tower Bridge" class="d-block w-100" height="452" width="432">                    
                    </div>
                    
                    @if(!$Sight_image->isEmpty() && $Sight_image->count() > 1)
                    @php
                          // Remove the first item from the collection
                          $remainingImages = $Sight_image->slice(1);
                      @endphp

                      @if(!$remainingImages->isEmpty())
                          @foreach($remainingImages as $image)
                          <div class="carousel-item">
                          <img src="@if(isset($image->Image) && $image->Image != '') 
                              https://s3-us-west-2.amazonaws.com/s3-travell/Sight-images/{{$image->Image }}
                                             
                                          @endif" alt="" class="d-block w-100" height="452" width="432">
                        </div>                             
                          @endforeach
                      @endif
                    @endif
                  </div>
                
                  <!-- The thumbs/carousel -->
                  @if(!$Sight_image->isEmpty() && $Sight_image->count() > 1)
                  <div class="carousel-thumbs">
                    <div class="carousel-thumb">
                      <img loading="lazy" src="images/tower-bridge-2.png" alt="">
                    </div>
                    <div class="carousel-thumb">
                      <img loading="lazy" src="images/tower-bridge-3.png" alt="">
                    </div>
                    <div class="carousel-thumb">
                      <img loading="lazy" src="images/tower-bridge-4.png" alt="">
                    </div>					  
                    <div class="tr-thumbs-count tr-show-all-photos">Show all {{$tsightimg}}+</div>
					       
                  </div>
                  @endif
                </div>
              </div>
             
            </div>
            <!--GALLERY - END-->

            <!--ADMISSION TICKETS FOR DESKTOP - START-->
            <!-- <div class="tr-admission-tickets tr-desktop">
              <h5>Admission tickets</h5>
              <div class="tr-details">
                <div class="tr-ticket-info">
                  <div class="tr-days">1 Park per Day (Multi-day)</div>
                  <div class="tr-price">$832</div>
                </div>
                <div>
                  <button type="button" class="tr-btn">Select ticket</button>
                </div>
              </div>
              <div class="tr-more-packages">
                <button type="button" class="tr-anchor-btn tr-more-packages-btn">More packages</button>
              </div>
              <div class="tr-admission-tickets tr-more-packages-modal tr-desktop">
                <div class="tr-details">
                  <div class="tr-ticket-info">
                    <div class="tr-days">1 Park per Day (Multi-day)</div>
                    <div class="tr-price">$932</div>
                  </div>
                  <div>
                    <button type="button" class="tr-btn">Select ticket</button>
                  </div>
                </div>
                <div class="tr-details">
                  <div class="tr-ticket-info">
                    <div class="tr-days">1 Park per Day (Multi-day)</div>
                    <div class="tr-price">$1032</div>
                  </div>
                  <div>
                    <button type="button" class="tr-btn">Select ticket</button>
                  </div>
                </div>
              </div>
            </div> -->
            <!--ADMISSION TICKETS FOR DESKTOP - END-->
          </div>
          <div class="col-lg-6 col-md-12 tr-left-col">
            <div class="tr-hotel-informations">
              <div class="tr-hotel-info">
                <div class="tr-place-name">
                  <h1 class="tr-hotel-name">{{$searchresult[0]->Title}}</h1>
                  @if($searchresult[0]->IsMustSee == 1)
                  <span class="d-none d-sm-block d-md-block">Must see</span>
                  @endif
                </div>
                <div class="tr-hotel-address">{{$searchresult[0]->Address}}</div>
                <input type="hidden" value="{{$searchresult[0]->SightId}}" id="sightId">
                <input type="hidden" id="LocationId" value="{{$searchresult[0]->LocationId}}">
                <span class="d-none sightId">{{$searchresult[0]->SightId}}</span>
                <span class="d-none Longitude">{{$searchresult[0]->Longitude}}</span>
                <span class="d-none Latitude">{{$searchresult[0]->Latitude}}</span>
                <div class="tr-raiting">
                  <div class="tr-review-with-perc">
                    <div class="tr-heart tr-excellent"></div>
                    <div class="tr-ranting-percent">
						<?php   $ratingtext = '';
                   				$color = ''; ?>
						@if($searchresult[0]->TAAggregateRating != "" && $searchresult[0]->TAAggregateRating != 0)
                    <?php 
                  $rating = (float)$searchresult[0]->TAAggregateRating;       
                  $result = round($rating * 20); 
                  if ($result > 95) {
                      $ratingtext = 'Superb';
                      $color = 'green';
                  } elseif ($result >= 91 && $result <= 95) {
                      $ratingtext = 'Excellent';
                      $color = 'green';
                  } elseif ($result >= 81 && $result <= 90) {
                      $ratingtext = 'Great';
                      $color = 'green';
                  } elseif ($result >= 71 && $result <= 80) {
                      $ratingtext = 'Good';
                      $color = '#FFE135';
                  } elseif ($result >= 61 && $result <= 70) {
                      $ratingtext = 'Okay';
                      $color = '#FFE135';
                  } elseif ($result >= 51 && $result <= 60) {
                      $ratingtext = 'Average';
                      $color = '#FFE135';
                  } elseif ($result >= 41 && $result <= 50) {
                      $ratingtext = 'Poor';
                      $color = 'red';
                  } elseif ($result >= 21 && $result <= 40) {
                      $ratingtext = 'Disappointing';
                      $color = 'red';
                  } else {
                      $ratingtext = 'Bad';
                      $color = 'red';
                  }

                
                ?>
                      {{$result}}% @else -- @endif</div>
                      @if($searchresult[0]->TAAggregateRating != "" && $searchresult[0]->TAAggregateRating != 0)     <div class="tr-review-name tr-excellent" style="color:{{$color}}">{{$ratingtext}}</div> @endif
                  </div>
                  <a href="javascript:void(0);" class="tr-share" data-bs-toggle="modal" data-bs-target="#shareModal">Share</a>
                  <a href="javascript:void(0);" class="tr-save">Save</a>
                </div>
              </div>
            </div>
           
            <!--CERTIFICATED SECTION - START-->
            @if($searchresult[0]->Award == 1)
            <div class="tr-hotel-certificated">
              <div class="tr-families-favourite">
                <div>
                  <img src="{{ asset('/public/frontend/hotel-detail/images/leaf.png')}}" alt="leaf">
                  <span>Travellers Favorite</span>
                </div>
                @if($searchresult[0]->Award_description != "")  <p>{{$searchresult[0]->Award_description}}</p>@endif
              </div>
            </div>
            @endif
            <!--CERTIFICATED SECTION - END-->

            <!--ADMISSION TICKETS FOR MOBILE - START-->
            <!-- <div class="tr-admission-tickets tr-mobile">
              <h5>Admission tickets</h5>
              <div class="tr-details">
                <div class="tr-ticket-info">
                  <div class="tr-days">1 Park per Day (Multi-day)</div>
                  <div class="tr-price">$832</div>
                </div>
                <div>
                  <button type="button" class="tr-btn">Select ticket</button>
                </div>
              </div>
              <div class="tr-more-packages">
                <button type="button" class="tr-anchor-btn tr-more-packages-btn">More packages</button>
              </div>
              <div class="tr-admission-tickets tr-more-packages-modal tr-desktop">
                <div class="tr-details">
                  <div class="tr-ticket-info">
                    <div class="tr-days">1 Park per Day (Multi-day)</div>
                    <div class="tr-price">$932</div>
                  </div>
                  <div>
                    <button type="button" class="tr-btn">Select ticket</button>
                  </div>
                </div>
                <div class="tr-details">
                  <div class="tr-ticket-info">
                    <div class="tr-days">1 Park per Day (Multi-day)</div>
                    <div class="tr-price">$1032</div>
                  </div>
                  <div>
                    <button type="button" class="tr-btn">Select ticket</button>
                  </div>
                </div>
              </div>
            </div> -->
            <!--ADMISSION TICKETS FOR MOBILE - END-->
           
            <!--ABOUT/OVERVIEW SECTION - START-->
            <div class="tr-about-section">
              <div class="tr-overview-section">
                <div class="tr-overview-details">
                  <ul>
                  @if($searchresult[0]->TAAggregateRating != "" && $searchresult[0]->TAAggregateRating != 0)
                  <?php 
                  $rating = (float)$searchresult[0]->TAAggregateRating;       
                  $result = round($rating * 20); 
                  if ($result > 95) {
                      $ratingtext = 'Superb';                      
                  } elseif ($result >= 91 && $result <= 95) {
                      $ratingtext = 'Excellent';                     
                  } elseif ($result >= 81 && $result <= 90) {
                      $ratingtext = 'Great';                    
                  } elseif ($result >= 71 && $result <= 80) {
                      $ratingtext = 'Good';                     
                  } elseif ($result >= 61 && $result <= 70) {
                      $ratingtext = 'Okay';                      
                  } elseif ($result >= 51 && $result <= 60) {
                      $ratingtext = 'Average';                     
                  } elseif ($result >= 41 && $result <= 50) {
                      $ratingtext = 'Poor';                     
                  } elseif ($result >= 21 && $result <= 40) {
                      $ratingtext = 'Disappointing';                     
                  } else {
                      $ratingtext = 'Bad';                    
                  }

                
                ?>
                    <li>
                      <div class="tr-rating">{{ $result }}%</div>
                      <div class="tr-rating-type">{{$ratingtext}}</div>
                      @if(count($sightreviews) !=0)<div class="tr-review">{{count($sightreviews)}} review</div>@endif
                    </li>
                  @endif
                  @if($searchresult[0]->duration !="")
                    <li>
                    @if (preg_match('/(\d+)-(\d+) hours/', $searchresult[0]->duration, $matches))
                        <div class="tr-rating">{{ $matches[1] }}-{{ $matches[2] }}</div>
                        <div class="tr-rating-type">hours</div>
                    @elseif (preg_match('/(\d+) hour/', $searchresult[0]->duration, $matches))
                        <div class="tr-rating">{{ $matches[1] }}</div>
                        <div class="tr-rating-type">hour</div>
                    @else
                        <div class="tr-rating">{{$searchresult[0]->duration}}</div>
                        <div class="tr-rating-type"></div>
                    @endif
                      <!-- <div class="tr-rating">{{$searchresult[0]->duration}}</div> -->
                      <!-- <div class="tr-rating-type">hours</div> -->
                      <div class="tr-review">DURATION</div>
                    </li>
                  @endif
                    @if(!$gettiming->isEmpty())
                    <?php
                      $data = json_decode($gettiming[0]->timings, true);
                      $daysOfWeek = ["mon", "tue", "wed", "thu", "fri", "sat", "sun"];
                      date_default_timezone_set('Asia/Kolkata'); // Set to Indian Standard Time

                      $currentDay = strtolower(date('D')); // Current day in three-letter format
                      $currentTime = date('H:i'); // Current time in 24-hour format

                      // Get today's timings
                      $todayStartTime = $data['time'][$currentDay]['start'] ?? null;
                      $todayEndTime = $data['time'][$currentDay]['end'] ?? null;
                      ?>
                    <li>
                      
                      <div class="tr-rating">
                      @if(isset($data['time'][$currentDay]))
                        <div>{{ date('h:i A', strtotime($todayStartTime)) }} - {{ date('h:i A', strtotime($todayEndTime)) }}</div>
                      @endif
                        <div class="tr-show-other-days">
                          <button type="button" class="tr-anchor-btn tr-show-other-days-btn" data-bs-toggle="modal" data-bs-target="#timingModal">Show other days</button>
                        </div>
                      </div>
                      <div class="tr-rating-type">TODAY TIMINGS</div>

                      <!-- <div class="tr-review"><span class="tr-open-circle"></span>OPEN NOW</div>
                      <div class="tr-review" style="display: none;"><span class="tr-closed-circle"></span>CLOSE NOW</div> -->

                      @if($todayStartTime == "00:00" && $todayEndTime == "23:59")
                          <div class="tr-review"><span class="tr-open-circle"></span>OPEN 24 HOURS</div>
                      @elseif($todayStartTime == "00:00" && $todayEndTime == "00:00")
                          <div class="tr-review tr-closed"><span class="tr-closed-circle"></span>CLOSED</div>
                      @elseif($currentTime >= $todayStartTime && $currentTime < $todayEndTime)
                          <div class="tr-review"><span class="tr-open-circle"></span>OPEN NOW</div>
                      @else
                          <div class="tr-review tr-closed"><span class="tr-closed-circle"></span>CLOSED NOW</div>
                      @endif

                      <button type="button" class="tr-anchor-btn tr-timing-edit-btn" data-bs-toggle="modal" data-bs-target="#timingChangeModal">
                        <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M8 13.3333H14" stroke="#222222" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/><path d="M11 2.3334C11.2652 2.06819 11.6249 1.91919 12 1.91919C12.1857 1.91919 12.3696 1.95577 12.5412 2.02684C12.7128 2.09791 12.8687 2.20208 13 2.3334C13.1313 2.46472 13.2355 2.62063 13.3066 2.79221C13.3776 2.96379 13.4142 3.14769 13.4142 3.3334C13.4142 3.51912 13.3776 3.70302 13.3066 3.8746C13.2355 4.04618 13.1313 4.20208 13 4.3334L4.66667 12.6667L2 13.3334L2.66667 10.6667L11 2.3334Z" stroke="#222222" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
                      </button>
                    </li>
                    @endif
              
              
                  </ul>
                </div>
              </div>
              <div class="tr-improve-lisitng">
                <button type="button" class="tr-anchor-btn" data-bs-toggle="modal" data-bs-target="#improveListingModal">Improve this listing</button>
              </div>
              @if($searchresult[0]->About !="")
              <h3>
                <span class="tr-desktop">About</span>
                <span class="tr-mobile">About the place</span>
              </h3>
              <div class="tr-about">
                <div class="tr-overview-content">
                  <p class="tr-content">{{$searchresult[0]->About}}</p>
                  <button class="tr-anchor-btn read-more-btn">Read More</button>
                </div>
              </div>
              @else
                <!-- Below element When We don't have data - Start   data-type="no-data" -->
                <div class="mt-41">
                    <img src="{{asset('public/frontend/hotel-detail/images/no-data-about.png')}}" alt="">
                    <div class="tr-improve-lisitng mt-41">
                      <button type="button" class="tr-anchor-btn" data-bs-toggle="modal" data-bs-target="#improveListingModal">Write something about the place</button>
                    </div>     
                  </div>
                  <!-- Below element When We don't have data - End -->
                @endif
     
            </div>
            <!--ABOUT/OVERVIEW SECTION - END-->

            <!--HIGHLIGHTED REVIEWS SECTION - START-->
            @if(!$sightreviews->isEmpty())
            <div class="tr-review-section tr-highlighted-reviews tr-tab-section">
              <h3>Highlighted Reviews</h3>
              <div class="row">
                <div class="col-sm-12">
                  <div class="tr-customer-highlighted-reviews">
                  <?php $i = 1;?>
                  @foreach($sightreviews as $val)
                  @if($val->IsRecommend ==1 && $i == 1)
                    <div class="tr-customer-review">
                      <div class="tr-recommended-title @if($val->IsRecommend == 1) tr-heart-green @elseif($val->IsRecommend == 0)tr-heart-red @endif">Recommended</div>
                      <p>{{$val->ReviewDescription}}</p>
                    </div>
                    @endif
					      <?php $i++; ?>
                    @endforeach
                    <!-- <div class="tr-customer-review">
                      <div class="tr-recommended-title tr-heart-red">Not Recommended</div>
                      <p>The tour was very well organised. One minus is that you get completely bombarded with information. The tour was very well organised. One minus is that you get completely bombarded with information.</p>
                    </div> -->

                  </div>
                  <div class="tr-show-all-review">
                    <button type="button" class="tr-show-all-review-btn">See all Reviews</button>
                  </div>
                  
                </div>
              </div>
            </div>
            @else
                  <!-- Below element When We don't have data - Start -->
                  <div class="tr-no-data-review-found" >
                    <div class="tr-no-highlighted-review-listing">
                      <div class="tr-no-review-list">
                        <div class="tr-heart">
                          <svg width="40" height="41" viewBox="0 0 40 41" fill="none" xmlns="http://www.w3.org/2000/svg"><rect x="-0.00390625" y="0.25" width="39.9873" height="39.9873" rx="19.9937" fill="#CCCCCC"/><g clip-path="url(#clip0_3966_12043)"><path d="M20.5104 28.8286C20.3283 28.8286 20.1743 28.7656 20.0483 28.6396L13.4958 22.318C13.4258 22.262 13.3295 22.171 13.207 22.045C13.0845 21.919 12.8902 21.6897 12.6242 21.3572C12.3582 21.0247 12.1201 20.6834 11.9101 20.3334C11.7001 19.9833 11.5128 19.5598 11.3483 19.0628C11.1838 18.5657 11.1016 18.0827 11.1016 17.6136C11.1016 16.0735 11.5461 14.8694 12.4352 14.0013C13.3242 13.1333 14.5529 12.6992 16.121 12.6992C16.555 12.6992 16.9978 12.7745 17.4493 12.925C17.9009 13.0755 18.3209 13.2785 18.7095 13.534C19.098 13.7896 19.4323 14.0293 19.7123 14.2533C19.9923 14.4774 20.2583 14.7154 20.5104 14.9674C20.7624 14.7154 21.0284 14.4774 21.3084 14.2533C21.5884 14.0293 21.9227 13.7896 22.3113 13.534C22.6998 13.2785 23.1198 13.0755 23.5714 12.925C24.0229 12.7745 24.4657 12.6992 24.8997 12.6992C26.4678 12.6992 27.6965 13.1333 28.5855 14.0013C29.4746 14.8694 29.9191 16.0735 29.9191 17.6136C29.9191 19.1608 29.1176 20.7359 27.5144 22.339L20.9724 28.6396C20.8464 28.7656 20.6924 28.8286 20.5104 28.8286Z" fill="white"/></g><defs><clipPath id="clip0_3966_12043"><rect width="18.8176" height="18.8176" fill="white" transform="translate(11.1016 11.3555)"/></clipPath></defs></svg>
                        </div>
                        <div class="tr-details">
                          <div class="tr-no-data-text w-70 h-14 mb-24"></div>
                          <div class="tr-no-data-text w-70 h-14 mb-24"></div>
                          <div class="tr-no-data-text w-70 h-14 tr-no-data-green"></div>
                        </div>
                      </div>
                      <div class="tr-no-review-list">
                        <div class="tr-heart">
                          <svg width="40" height="41" viewBox="0 0 40 41" fill="none" xmlns="http://www.w3.org/2000/svg"><rect x="-0.00390625" y="0.25" width="39.9873" height="39.9873" rx="19.9937" fill="#CCCCCC"/><g clip-path="url(#clip0_3966_12043)"><path d="M20.5104 28.8286C20.3283 28.8286 20.1743 28.7656 20.0483 28.6396L13.4958 22.318C13.4258 22.262 13.3295 22.171 13.207 22.045C13.0845 21.919 12.8902 21.6897 12.6242 21.3572C12.3582 21.0247 12.1201 20.6834 11.9101 20.3334C11.7001 19.9833 11.5128 19.5598 11.3483 19.0628C11.1838 18.5657 11.1016 18.0827 11.1016 17.6136C11.1016 16.0735 11.5461 14.8694 12.4352 14.0013C13.3242 13.1333 14.5529 12.6992 16.121 12.6992C16.555 12.6992 16.9978 12.7745 17.4493 12.925C17.9009 13.0755 18.3209 13.2785 18.7095 13.534C19.098 13.7896 19.4323 14.0293 19.7123 14.2533C19.9923 14.4774 20.2583 14.7154 20.5104 14.9674C20.7624 14.7154 21.0284 14.4774 21.3084 14.2533C21.5884 14.0293 21.9227 13.7896 22.3113 13.534C22.6998 13.2785 23.1198 13.0755 23.5714 12.925C24.0229 12.7745 24.4657 12.6992 24.8997 12.6992C26.4678 12.6992 27.6965 13.1333 28.5855 14.0013C29.4746 14.8694 29.9191 16.0735 29.9191 17.6136C29.9191 19.1608 29.1176 20.7359 27.5144 22.339L20.9724 28.6396C20.8464 28.7656 20.6924 28.8286 20.5104 28.8286Z" fill="white"/></g><defs><clipPath id="clip0_3966_12043"><rect width="18.8176" height="18.8176" fill="white" transform="translate(11.1016 11.3555)"/></clipPath></defs></svg>
                        </div>
                        <div class="tr-details">
                          <div class="tr-no-data-text w-70 h-14 mb-24"></div>
                          <div class="tr-no-data-text w-70 h-14 mb-24 tr-no-data-red"></div>
                          <div class="tr-no-data-text w-70 h-14 "></div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <!-- Below element When We don't have data - End -->
                  @endif
            
          
            <!--HIGHLIGHTED REVIEWS SECTION - END-->

            <!--RECOMMENDED WRITE A REVIEWS SECTION - START-->
            <!-- <div class="tr-recommended-write-review">
              <h5>Write a review</h5>
              <div class="tr-details">
                <p>Do you recommend visiting {{$searchresult[0]->Title}}?</p>
                <div class="tr-recommended-actions">
                  <label>
                    <input type="radio" class="write-review" name="recommend" value="Yes">
                    <span>Yes</span>
                  </label>
                  <label>
                    <input type="radio" class="write-review" name="recommend" value="No">
                    <span>No</span>
                  </label>
                </div>
              </div>
            </div> -->
            <!--RECOMMENDED WRITE A REVIEWS SECTION - END-->

            <!--ABOUT THE FOUNDER - START-->
            <!-- <div class="tr-about-founder">
              <h3>About the founder:</h3>
              <div class="tr-founder-details">
                <div class="tr-image">
              <img src="@if( isset($Sight_image[0]->Image) && $Sight_image[0]->Image !='') {{ asset('public/sight-images/'. $Sight_image[0]->Image) }} @else {{asset('public/images/Hotel lobby.svg')}} @endif" alt="founder-tower-bridge">
                </div>
                <div class="tr-details">
                  <div class="tr-overview-content">
                    <p class="tr-content">Tower Bridge, an iconic symbol of London, spans the River Thames near the Tower of London. Completed in 1894. Tower Bridge, an iconic symbol of London, spans the River Thames near the Tower of London. Completed in 1894, this bascule and suspension bridge was designed by Sir Horace Jones and engineered by Sir John Wolfe Barry. Tower Bridge, an iconic symbol of London, spans the River Thames near the Tower of London. Completed in 1894, this bascule and suspension bridge was designed by Sir Horace Jones and engineered by Sir John Wolfe Barry.</p>
                    <button class="tr-anchor-btn read-more-btn">Read More</button>
                  </div>
                </div>
              </div> -->
              <!-- Below element When We don't have data - Start -->
              <!-- <div class="tr-no-data-review-found" data-type="no-data">
                <div class="tr-founder-details">
                  <div class="tr-image">
                    <img src="images/no-data-explore.png" alt="">
                  </div>
                  <div class="tr-details">
                    <div class="tr-no-data-text w-100 mb-12"></div>
                    <div class="tr-no-data-text w-60 mb-12"></div>
                    <div class="tr-no-data-text w-80 mb-12"></div>
                    <div class="tr-no-data-text w-80 mb-12"></div>
                    <div class="tr-no-data-text w-60 mt-41"></div>
                  </div>
                </div>
              </div> -->
              <!-- Below element When We don't have data - End -->
            <!-- </div> -->
            <!--ABOUT THE FOUNDER - END-->

          </div>
        </div>

        <div class="row">
          <div class="col-sm-12">
            <!--TOP WAYS TO EXPERIENCE TOWER BRIDGE SECTION - START-->
            <div class="tr-top-ways-section">
              <h3>Top ways to experience {{$searchresult[0]->Title}}</h3>
              <div class="tr-top-ways-lists" id="">

               @if(!$get_experience->isEmpty())
                    @php
                      $experienceCount = count($get_experience);
                      $requiredPlaceholders = 4 - $experienceCount;
                    @endphp
                    
                    @foreach($get_experience as $get_experiences)
                      <div class="tr-top-ways-list">
                        <div class="tr-img">
                          <a href="@if($get_experiences->viator_url != '') {{ $get_experiences->viator_url }} @endif">
                            <img loading="lazy" src="@if($get_experiences->Img1 !=''){{ $get_experiences->Img1 }}@else{{ asset('public/images/Hotel lobby-image.png') }}@endif" alt="top-places" height="117" width="100" style="width: 100px; height: 117px !important;">
                          </a>                  
                        </div>
                        <div class="tr-details">
                          <div class="tr-place-type">Classes</div>
                          <div class="tr-place-name">
                            <a href="{{ route('experince', [$get_experiences->slugid . '-' . $get_experiences->ExperienceId . '-' . $get_experiences->Slug]) }}">
                              {{ $get_experiences->Name }}
                            </a>
                          </div>
                          <div class="tr-like-review">
                            <span class="tr-likes">
                              <svg width="14" height="13" viewBox="0 0 14 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M6.99847 2.82194C5.79052 1.46927 3.7762 1.10541 2.26273 2.34405C0.749264 3.58269 0.536189 5.65364 1.72472 7.11858L6.99847 12.0026L12.2722 7.11858C13.4607 5.65364 13.2737 3.56966 11.7342 2.34405C10.1947 1.11844 8.20641 1.46927 6.99847 2.82194Z" stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                              </svg>
                              @if($get_experiences->TAAggregationRating !="")
                              <?php $exprat = (float)$get_experiences->TAAggregationRating;
                                    $exprating = round($exprat * 20);
                              ?>
                              {{ $exprating }} @else -- @endif%
                            </span>
                            <span class="tr-review">({{ $get_experiences->review_count }} reviews)</span>
                          </div>
                          @if($get_experiences->Cost != "")
                          <div class="tr-price-section">{{ $get_experiences->Cost }}</div>
                          @endif
                        </div>
                      </div>
                    @endforeach

                    {{-- Add placeholders if fewer than 4 experiences are shown --}}
                    @for($i = 0; $i < $requiredPlaceholders; $i++)
                    <div class="tr-top-ways-list">
                        <div class="tr-img">
                          <img loading="lazy" src="{{asset('public/frontend/hotel-detail/images/top-way-no-data.png')}}" alt="top-places">
                        </div>
                        <div class="tr-details">
                          <div class="tr-no-data-text w-100 mb-12"></div>
                          <div class="tr-no-data-text w-60 mb-12"></div>
                          <div class="tr-no-data-text w-80 mb-12"></div>
                          <div class="tr-no-data-text w-80 mb-12"></div>
                          <div class="tr-no-data-text w-50 mt-41 mb-12"></div>
                          <div class="tr-no-data-text w-25 mb-0"></div>
                        </div>
                      </div>
                    @endfor

                  @else
                    {{-- Show placeholders if no experiences are available --}}
                    @for($i = 0; $i < 4; $i++)
                          <div class="tr-top-ways-list">
                            <div class="tr-img">
                              <img loading="lazy" src="{{asset('public/frontend/hotel-detail/images/top-way-no-data.png')}}" alt="top-places">
                            </div>
                            <div class="tr-details">
                              <div class="tr-no-data-text w-100 mb-12"></div>
                              <div class="tr-no-data-text w-60 mb-12"></div>
                              <div class="tr-no-data-text w-80 mb-12"></div>
                              <div class="tr-no-data-text w-80 mb-12"></div>
                              <div class="tr-no-data-text w-50 mt-41 mb-12"></div>
                              <div class="tr-no-data-text w-25 mb-0"></div>
                            </div>
                          </div>
                    @endfor
                  @endif
              </div>
              <!-- Below element When We don't have data - Start -->
              <div class="tr-top-ways-lists" data-type="no-data">
                <div class="tr-top-ways-list">
                  <div class="tr-img">
                    <img loading="lazy" src="images/top-way-no-data.png" alt="top-places">
                  </div>
                  <div class="tr-details">
                    <div class="tr-no-data-text w-100 mb-12"></div>
                    <div class="tr-no-data-text w-60 mb-12"></div>
                    <div class="tr-no-data-text w-80 mb-12"></div>
                    <div class="tr-no-data-text w-80 mb-12"></div>
                    <div class="tr-no-data-text w-50 mt-41 mb-12"></div>
                    <div class="tr-no-data-text w-25 mb-0"></div>
                  </div>
                </div>
                <div class="tr-top-ways-list">
                  <div class="tr-img">
                    <img loading="lazy" src="images/top-way-no-data.png" alt="top-places">
                  </div>
                  <div class="tr-details">
                    <div class="tr-no-data-text w-100 mb-12"></div>
                    <div class="tr-no-data-text w-60 mb-12"></div>
                    <div class="tr-no-data-text w-80 mb-12"></div>
                    <div class="tr-no-data-text w-80 mb-12"></div>
                    <div class="tr-no-data-text w-50 mt-41 mb-12"></div>
                    <div class="tr-no-data-text w-25 mb-0"></div>
                  </div>
                </div>
                <div class="tr-top-ways-list ">
                  <div class="tr-img">
                    <img loading="lazy" src="images/top-way-no-data.png" alt="top-places">
                  </div>
                  <div class="tr-details">
                    <div class="tr-no-data-text w-100 mb-12"></div>
                    <div class="tr-no-data-text w-60 mb-12"></div>
                    <div class="tr-no-data-text w-80 mb-12"></div>
                    <div class="tr-no-data-text w-80 mb-12"></div>
                    <div class="tr-no-data-text w-50 mt-41 mb-12"></div>
                    <div class="tr-no-data-text w-25 mb-0"></div>
                  </div>
                </div>
                <div class="tr-top-ways-list">
                  <div class="tr-img">
                    <img loading="lazy" src="images/top-way-no-data.png" alt="top-places">
                  </div>
                  <div class="tr-details">
                    <div class="tr-no-data-text w-100 mb-12"></div>
                    <div class="tr-no-data-text w-60 mb-12"></div>
                    <div class="tr-no-data-text w-80 mb-12"></div>
                    <div class="tr-no-data-text w-80 mb-12"></div>
                    <div class="tr-no-data-text w-50 mt-41 mb-12"></div>
                    <div class="tr-no-data-text w-25 mb-0"></div>
                  </div>
                </div>
              </div>
              <!-- Below element When We don't have data - End -->
            </div>
            <!--TOP WAYS TO EXPERIENCE TOWER BRIDGE SECTION - END-->

            <!--LOCATION SECTION - START-->
            <div class="tr-Location-section tr-tab-section">
              <h3>Location</h3>
              <div class="tr-Location-details">
                <ul>
                  <li class="tr-location-address">@if($searchresult[0]->Address != "") {{$searchresult[0]->Address}}
                  @else  Add location information @endif</li>
                  <li class="tr-phone">  @if($searchresult[0]->Phone != "") {{ $searchresult[0]->Phone}}
                  @else Add phone number @endif</li>
                  <!-- <li class="tr-email">towerbridge@gmail.com</li> -->
                  <li class="tr-website-link"><a href='@if($searchresult[0]->Website != "") {{ $searchresult[0]->Website}} @endif' target="_blank">Visit website</a></li>
                </ul>
              </div>
              <div class="tr-location-map">
                <!-- <img loading="lazy" src="images/map.png" alt="Map"> -->
                @if($searchresult[0]->Longitude != "" && $searchresult[0]->Latitude != "")
                <div id="map1" class="" style="width: 100%; height: 400px;"></div>

                <div id="screenshotContainer"></div>
                @else 
                  <div >
                    <img src="{{asset('public/frontend/hotel-detail/images/no-data-no-map.png')}}" alt="">
                    <div class="tr-improve-lisitng mt-24">
                      <button type="button" class="tr-anchor-btn" data-bs-toggle="modal" data-bs-target="#improveListingModal">Add location</button>
                    </div>
                  </div>
                @endif
              </div>
            
             <!-- <div class="tr-neighborhood">
                <h3>Neighborhood</h3>
                <p>The neighborhood is a blend of ancient history and modern dynamism. Walk among towering skyscrapers and historic pubs, enjoying the juxtaposition of old and new. Explore the bustling Leadenhall Market, brimming with charm and vibrant stalls. Financial district by day, the City transforms into a tranquil area by night, offering unique experiences like night tours of iconic landmarks. Its rich history and contemporary vibrancy make the City of London a captivating destination.</p>
              </div> -->
              <!-- Below element When We don't have data - Start -->
          
              <!-- Below element When We don't have data - End -->
            </div>
            <!--LOCATION SECTION - END-->

            <!--EXPLORE OTHER OPTIONS IN AND AROUND SECTION - START-->
            <div class="tr-explore-section">
              <h3 class="d-none d-md-block">Explore other options in and around</h3>
              <div class="tr-tourist-places-row" >
              
                <div class="tr-tourist-places" id="nearbyattraction">
                  <div class="tr-title open">
                    <h4><svg width="25" height="25" viewBox="0 0 25 25" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M17.3335 5.05859C17.3335 6.20565 16.2305 7.30859 15.0835 7.30859C16.2305 7.30859 17.3335 8.41154 17.3335 9.55859C17.3335 8.41154 18.4364 7.30859 19.5835 7.30859C18.4364 7.30859 17.3335 6.20565 17.3335 5.05859Z" stroke="#131313" stroke-linecap="round" stroke-linejoin="round"/><path d="M17.3335 15.0586C17.3335 16.2056 16.2305 17.3086 15.0835 17.3086C16.2305 17.3086 17.3335 18.4115 17.3335 19.5586C17.3335 18.4115 18.4364 17.3086 19.5835 17.3086C18.4364 17.3086 17.3335 16.2056 17.3335 15.0586Z" stroke="#131313" stroke-linecap="round" stroke-linejoin="round"/><path d="M9.3335 8.05859C9.3335 10.2252 7.25015 12.3086 5.0835 12.3086C7.25015 12.3086 9.3335 14.3919 9.3335 16.5586C9.3335 14.3919 11.4168 12.3086 13.5835 12.3086C11.4168 12.3086 9.3335 10.2252 9.3335 8.05859Z" stroke="#131313" stroke-linecap="round" stroke-linejoin="round"/></svg>Top attractions</h4>
                    <span class="d-none d-md-block">Sorted by nearest</span>
                  </div>
                  <div class="tr-tourist-place-lists">
                    <!-- new data -->
                    @if(!$nearbyatt->isEmpty())
                          @php
                            $nearbyCount = count($nearbyatt);
                            $requiredPlaceholders = 4 - $nearbyCount;
                          @endphp
                          
                          @foreach($nearbyatt as $nearbyatt)
                            <div class="tr-tourist-place">
                              <div class="tr-img">
                                <a href="javascript:void(0);">
                                  <img loading="lazy" src="{{ asset('public/frontend/hotel-detail/images/tourist-places-1.png') }}" alt="tourist-places">
                                </a>
                              </div>
                              <div class="tr-details">
                                <div class="tr-place-name">
                                  <a href="{{ route('sight.details', [$nearbyatt->LocationId . '-' . $nearbyatt->SightId . '-' . $nearbyatt->Slug]) }}">
                                    {{ $nearbyatt->Title }}
                                  </a>
                                </div>
                                <div class="tr-place-type">{{ $nearbyatt->ctitle }}</div>
                                <div class="tr-like-review">
                                  @if($nearbyatt->TAAggregateRating != "" && $nearbyatt->TAAggregateRating != 0)
                                    @php $result = rtrim($nearbyatt->TAAggregateRating, '.0') * 20; @endphp
                                    <span class="tr-likes">{{ $result }}%</span>
                                  @endif
                                </div>
                                <div class="tr-distance">{{ $nearbyatt->distance }} km</div>
                              </div>
                            </div>
                          @endforeach

                          {{-- Add placeholders if fewer than 4 attractions are shown --}}
                          @for($i = 0; $i < $requiredPlaceholders; $i++)
                            <div class="tr-tourist-place">
                              <div class="tr-img">
                                <img loading="lazy" src="{{asset('public/frontend/hotel-detail/images/no-data-explore.png')}}" alt="tourist-places">
                              </div>
                              <div class="tr-details">
                                <div class="tr-no-data-text w-100 mb-12"></div>
                                <div class="tr-no-data-text w-60 mb-12"></div>
                                <div class="tr-no-data-text w-80 mb-12"></div>
                                <div class="tr-no-data-text w-20 mb-12"></div>
                              </div>
                            </div>
                          @endfor

                        @else
                          {{-- Show 4 placeholders if there are no attractions --}}
                          @for($i = 0; $i < 4; $i++)
                            <div class="tr-tourist-place">
                              <div class="tr-img">
                                <img loading="lazy" src="{{asset('public/frontend/hotel-detail/images/no-data-explore.png')}}" alt="tourist-places">
                              </div>
                              <div class="tr-details">
                                <div class="tr-no-data-text w-100 mb-12"></div>
                                <div class="tr-no-data-text w-60 mb-12"></div>
                                <div class="tr-no-data-text w-80 mb-12"></div>
                                <div class="tr-no-data-text w-20 mb-12"></div>
                              </div>
                            </div>
                          @endfor
                        @endif

               <!-- end new data -->
                    <!-- Below element When We don't have data - Start -->
                    <!-- <div data-type="no-data">
                      <div class="tr-tourist-place">
                        <div class="tr-img">
                          <img loading="lazy" src="images/no-data-explore.png" alt="tourist-places">
                        </div>
                        <div class="tr-details">
                          <div class="tr-no-data-text w-100 mb-12"></div>
                          <div class="tr-no-data-text w-60 mb-12"></div>
                          <div class="tr-no-data-text w-80 mb-12"></div>
                          <div class="tr-no-data-text w-20 mb-12"></div>
                        </div>
                      </div>
                      <div class="tr-tourist-place">
                        <div class="tr-img">
                          <img loading="lazy" src="images/no-data-explore.png" alt="tourist-places">
                        </div>
                        <div class="tr-details">
                          <div class="tr-no-data-text w-100 mb-12"></div>
                          <div class="tr-no-data-text w-60 mb-12"></div>
                          <div class="tr-no-data-text w-80 mb-12"></div>
                          <div class="tr-no-data-text w-20 mb-12"></div>
                        </div>
                      </div>
                      <div class="tr-tourist-place">
                        <div class="tr-img">
                          <img loading="lazy" src="images/no-data-explore.png" alt="tourist-places">
                        </div>
                        <div class="tr-details">
                          <div class="tr-no-data-text w-100 mb-12"></div>
                          <div class="tr-no-data-text w-60 mb-12"></div>
                          <div class="tr-no-data-text w-80 mb-12"></div>
                          <div class="tr-no-data-text w-20 mb-12"></div>
                        </div>
                      </div>
                      <div class="tr-tourist-place">
                        <div class="tr-img">
                          <img loading="lazy" src="images/no-data-explore.png" alt="tourist-places">
                        </div>
                        <div class="tr-details">
                          <div class="tr-no-data-text w-100 mb-12"></div>
                          <div class="tr-no-data-text w-60 mb-12"></div>
                          <div class="tr-no-data-text w-80 mb-12"></div>
                          <div class="tr-no-data-text w-20 mb-12"></div>
                        </div>
                      </div>
                    </div> -->
                    <!-- Below element When We don't have data - End -->
                  </div>
                </div>
               
                <div class="tr-tourist-places" id="restaurant-data" >
                  
                  <div class="tr-title">
                    <h4><svg width="24" height="20" viewBox="0 0 19 19" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M1.63492 1.90625L15.6158 15.8871C15.8811 16.1524 16.0301 16.5122 16.0301 16.8874C16.0301 17.2626 15.8811 17.6224 15.6158 17.8877C15.3504 18.1529 14.9906 18.3018 14.6155 18.3018C14.2404 18.3018 13.8806 18.1529 13.6152 17.8877L10.2 14.4136C9.97647 14.1867 9.85109 13.881 9.85086 13.5625V13.3526C9.85089 13.1918 9.81897 13.0326 9.75695 12.8842C9.69494 12.7358 9.60406 12.6012 9.4896 12.4882L9.04865 12.081C8.89896 11.9429 8.71694 11.8447 8.51933 11.7953C8.32172 11.746 8.11487 11.7471 7.91783 11.7987C7.6071 11.8798 7.28058 11.8782 6.97065 11.7942C6.66071 11.7101 6.37816 11.5464 6.15101 11.3194L2.90918 8.07722C0.986021 6.15405 0.278307 3.24996 1.63492 1.90625Z" stroke="#131313" stroke-linejoin="round"></path><path d="M14.6312 1.30859L11.6998 4.24001C11.4742 4.46554 11.2953 4.73329 11.1732 5.02798C11.0511 5.32267 10.9883 5.63852 10.9883 5.9575V6.52139C10.9883 6.60118 10.9726 6.68018 10.9421 6.75389C10.9115 6.82759 10.8668 6.89456 10.8103 6.95096L10.3811 7.38014M11.5954 8.59445L12.0246 8.16526C12.081 8.10883 12.148 8.06407 12.2217 8.03353C12.2954 8.00299 12.3744 7.98728 12.4542 7.98729H13.0181C13.3371 7.98729 13.6529 7.92446 13.9476 7.80238C14.2423 7.6803 14.51 7.50136 14.7356 7.27578L17.667 4.34437M16.1491 2.82648L13.1133 5.86225M7.04179 14.0588L3.2577 17.8642C2.97305 18.1487 2.58704 18.3086 2.18455 18.3086C1.78207 18.3086 1.39605 18.1487 1.11141 17.8642C0.826849 17.5795 0.666992 17.1935 0.666992 16.791C0.666992 16.3885 0.826849 16.0025 1.11141 15.7179L4.30959 12.541" stroke="#131313" stroke-linecap="round" stroke-linejoin="round"></path></svg>Restaurants</h4>
                    <span class="d-none d-md-block">Within 1 KM</span>
                  </div>
                  @if(!$get_nearby_rest->isEmpty())
                  <div class="tr-tourist-place-lists">
                    @php
                      $nearbyRestCount = count($get_nearby_rest);
                      $requiredPlaceholders = 4 - $nearbyRestCount;
                    @endphp

                    @foreach($get_nearby_rest as $val)
                      <div class="tr-tourist-place">
                        <div class="tr-img">
                          <a href="{{ asset('rd-'.$val->slugid.'-'.$val->RestaurantId.'-'.strtolower($val->Slug)) }}">
                            <img loading="lazy" src="{{ asset('public/images/Hotel lobby-image.png') }}" alt="tourist-places">
                          </a>
                        </div>
                        <div class="tr-details">
                          <div class="tr-place-name">
                            <a href="{{ asset('rd-'.$val->slugid.'-'.$val->RestaurantId.'-'.strtolower($val->Slug)) }}">
                              {{ $val->Title }}
                            </a>
                          </div>
                          <div class="tr-like-review">
                            @if($val->TATrendingScore != "" && $val->TATrendingScore != 0)
                              @php $result = rtrim($val->TATrendingScore, '.0') * 10; @endphp
                              <span class="tr-likes">{{ $result }}%</span>
                            @endif
                            <span class="tr-review"> .{{ $val->review_count }} reviews</span>
                          </div>
                          <div class="tr-distance">{{ number_format($val->distance, 2) }} km</div>
                        </div>
                      </div>
                    @endforeach

                    {{-- Add placeholders if fewer than 4 restaurants are available --}}
                    @for($i = 0; $i < $requiredPlaceholders; $i++)
                      <div class="tr-tourist-place">
                        <div class="tr-img">
                          <img loading="lazy" src="{{ asset('public/frontend/hotel-detail/images/no-data-explore.png') }}" alt="tourist-places">
                        </div>
                        <div class="tr-details">
                          <div class="tr-no-data-text w-100 mb-12"></div>
                          <div class="tr-no-data-text w-60 mb-12"></div>
                          <div class="tr-no-data-text w-80 mb-12"></div>
                          <div class="tr-no-data-text w-20 mb-12"></div>
                        </div>
                      </div>
                    @endfor
                  </div>

                @else
                  {{-- Show 4 placeholders if there are no nearby restaurants --}}
                  <div class="tr-tourist-place-lists">
                    @for($i = 0; $i < 4; $i++)
                      <div class="tr-tourist-place">
                        <div class="tr-img">
                          <img loading="lazy" src="{{ asset('public/frontend/hotel-detail/images/no-data-explore.png') }}" alt="tourist-places">
                        </div>
                        <div class="tr-details">
                          <div class="tr-no-data-text w-100 mb-12"></div>
                          <div class="tr-no-data-text w-60 mb-12"></div>
                          <div class="tr-no-data-text w-80 mb-12"></div>
                          <div class="tr-no-data-text w-20 mb-12"></div>
                        </div>
                      </div>
                    @endfor
                  </div>
                @endif

                </div>
               
                <!-- <div class="tr-tourist-places">
                  <div class="tr-title">
                    <h4><svg width="25" height="25" viewBox="0 0 25 25" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M17.3335 5.05859C17.3335 6.20565 16.2305 7.30859 15.0835 7.30859C16.2305 7.30859 17.3335 8.41154 17.3335 9.55859C17.3335 8.41154 18.4364 7.30859 19.5835 7.30859C18.4364 7.30859 17.3335 6.20565 17.3335 5.05859Z" stroke="#131313" stroke-linecap="round" stroke-linejoin="round"/><path d="M17.3335 15.0586C17.3335 16.2056 16.2305 17.3086 15.0835 17.3086C16.2305 17.3086 17.3335 18.4115 17.3335 19.5586C17.3335 18.4115 18.4364 17.3086 19.5835 17.3086C18.4364 17.3086 17.3335 16.2056 17.3335 15.0586Z" stroke="#131313" stroke-linecap="round" stroke-linejoin="round"/><path d="M9.3335 8.05859C9.3335 10.2252 7.25015 12.3086 5.0835 12.3086C7.25015 12.3086 9.3335 14.3919 9.3335 16.5586C9.3335 14.3919 11.4168 12.3086 13.5835 12.3086C11.4168 12.3086 9.3335 10.2252 9.3335 8.05859Z" stroke="#131313" stroke-linecap="round" stroke-linejoin="round"/></svg>Getting there</h4>
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
                          <div class="tr-place-name"><svg width="18" height="17" viewBox="0 0 18 17" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M11.6677 8.21686L11.4782 8.25293L11.4075 8.43241L8.58835 15.5894L7.6097 15.7757L8.3748 9.30726L8.4309 8.83302L7.96178 8.92232L3.5739 9.75759L3.37156 9.79611L3.30699 9.99171L2.47522 12.5116L1.87823 12.6253L1.98228 9.2217L1.98466 9.14395L1.95388 9.07252L0.606627 5.94522L1.20367 5.83157L2.90392 7.86957L3.03583 8.02769L3.23812 7.98919L7.626 7.15392L8.09517 7.0646L7.86869 6.64412L4.77982 0.909331L5.75841 0.723048L11.0099 6.34373L11.1416 6.48469L11.3311 6.44861L15.7902 5.59979C16.0247 5.55515 16.2673 5.60549 16.4647 5.73973L16.6615 5.45033L16.4647 5.73973C16.6621 5.87398 16.798 6.08113 16.8426 6.31561C16.8873 6.55009 16.8369 6.79271 16.7027 6.99007L16.9921 7.18692L16.7027 6.99007C16.5685 7.18744 16.3613 7.3234 16.1268 7.36803L11.6677 8.21686Z" stroke="black" stroke-width="0.7"/></svg>London city airport</div>
                          <span class="tr-distance-time"><svg width="13" height="14" viewBox="0 0 13 14" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M2.7085 12.1211L1.3335 13.4961M10.9585 12.1211L12.3335 13.4961M4.771 9.3711H4.77718M8.88981 9.3711H8.896M2.021 5.24609C4.771 7.99609 9.23975 7.99609 11.646 5.24609" stroke="#222222" stroke-width="0.8" stroke-linecap="round" stroke-linejoin="round"/><path d="M2.20862 4.48572C2.77305 1.61334 3.55406 1.12109 6.45874 1.12109H7.20812C10.1128 1.12109 10.8931 1.61334 11.4582 4.48572L11.8384 6.42172C12.3575 9.06172 12.6167 10.3817 11.8604 11.2514C11.1042 12.1211 9.68106 12.1211 6.83343 12.1211C3.98649 12.1211 2.56268 12.1211 1.80643 11.2514C1.05018 10.3817 1.30937 9.06172 1.82843 6.42172L2.20862 4.48572Z" stroke="#222222" stroke-width="0.8" stroke-linecap="round" stroke-linejoin="round"/></svg>20 min</span>
                          <a href="javascript:void(0);" class="tr-travel-type">See all flghts</a>
                        </div>
                        <div class="tr-distance">0.88 km</div>
                      </div>
                      <div class="tr-getting-list">
                        <div class="tr-place-info">
                          <div class="tr-place-name"><svg width="18" height="17" viewBox="0 0 18 17" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M11.6677 8.21686L11.4782 8.25293L11.4075 8.43241L8.58835 15.5894L7.6097 15.7757L8.3748 9.30726L8.4309 8.83302L7.96178 8.92232L3.5739 9.75759L3.37156 9.79611L3.30699 9.99171L2.47522 12.5116L1.87823 12.6253L1.98228 9.2217L1.98466 9.14395L1.95388 9.07252L0.606627 5.94522L1.20367 5.83157L2.90392 7.86957L3.03583 8.02769L3.23812 7.98919L7.626 7.15392L8.09517 7.0646L7.86869 6.64412L4.77982 0.909331L5.75841 0.723048L11.0099 6.34373L11.1416 6.48469L11.3311 6.44861L15.7902 5.59979C16.0247 5.55515 16.2673 5.60549 16.4647 5.73973L16.6615 5.45033L16.4647 5.73973C16.6621 5.87398 16.798 6.08113 16.8426 6.31561C16.8873 6.55009 16.8369 6.79271 16.7027 6.99007L16.9921 7.18692L16.7027 6.99007C16.5685 7.18744 16.3613 7.3234 16.1268 7.36803L11.6677 8.21686Z" stroke="black" stroke-width="0.7"/></svg>Heatthrow airport</div>
                          <span class="tr-distance-time"><svg width="13" height="14" viewBox="0 0 13 14" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M2.7085 12.1211L1.3335 13.4961M10.9585 12.1211L12.3335 13.4961M4.771 9.3711H4.77718M8.88981 9.3711H8.896M2.021 5.24609C4.771 7.99609 9.23975 7.99609 11.646 5.24609" stroke="#222222" stroke-width="0.8" stroke-linecap="round" stroke-linejoin="round"/><path d="M2.20862 4.48572C2.77305 1.61334 3.55406 1.12109 6.45874 1.12109H7.20812C10.1128 1.12109 10.8931 1.61334 11.4582 4.48572L11.8384 6.42172C12.3575 9.06172 12.6167 10.3817 11.8604 11.2514C11.1042 12.1211 9.68106 12.1211 6.83343 12.1211C3.98649 12.1211 2.56268 12.1211 1.80643 11.2514C1.05018 10.3817 1.30937 9.06172 1.82843 6.42172L2.20862 4.48572Z" stroke="#222222" stroke-width="0.8" stroke-linecap="round" stroke-linejoin="round"/></svg>20 min</span>
                          <a href="javascript:void(0);" class="tr-travel-type">See all flghts</a>
                        </div>
                        <div class="tr-distance">0.88 km</div>
                      </div>
                      <div class="tr-getting-list">
                        <div class="tr-place-info">
                          <div class="tr-place-name"><svg width="20" height="17" viewBox="0 0 20 17" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M17.0835 9.43359H14.8335M3.58349 9.43359H5.83349M17.4116 5.68359L15.9485 1.78191C15.7289 1.19645 15.1693 0.808594 14.544 0.808594H6.12299C5.49773 0.808594 4.93804 1.19645 4.7185 1.78191L3.25537 5.68359M17.4116 5.68359L17.6299 6.26568C17.7524 6.59225 18.0646 6.80859 18.4133 6.80859C18.9068 6.80859 19.293 7.23341 19.2463 7.72462L18.8335 12.0586M17.4116 5.68359H18.9585M3.25537 5.68359L3.03708 6.26568C2.91462 6.59225 2.60243 6.80859 2.25366 6.80859C1.76023 6.80859 1.37395 7.23341 1.42073 7.72462L1.83349 12.0586M3.25537 5.68359H1.70849M1.83349 12.0586L1.95418 13.3258C2.0275 14.0957 2.67408 14.6836 3.44742 14.6836H3.5835M1.83349 12.0586V12.0586C1.55735 12.0586 1.3335 12.2824 1.3335 12.5586V15.0586C1.3335 15.4728 1.66928 15.8086 2.0835 15.8086H2.8335C3.24771 15.8086 3.5835 15.4728 3.5835 15.0586V14.6836M3.5835 14.6836H17.0835M17.0835 14.6836H17.2196C17.9929 14.6836 18.6395 14.0957 18.7128 13.3258L18.8335 12.0586M17.0835 14.6836V15.0586C17.0835 15.4728 17.4193 15.8086 17.8335 15.8086H18.5835C18.9977 15.8086 19.3335 15.4728 19.3335 15.0586V12.5586C19.3335 12.2825 19.1096 12.0586 18.8335 12.0586V12.0586M6.24161 3.33425L5.41255 5.82142C5.25067 6.30707 5.61214 6.80859 6.12406 6.80859H14.5429C15.0548 6.80859 15.4163 6.30707 15.2544 5.82142L14.4254 3.33425C14.2212 2.72174 13.648 2.68359 13.0024 2.68359H7.66463C7.01899 2.68359 6.44578 2.72174 6.24161 3.33425Z" stroke="black" stroke-width="0.7" stroke-linecap="round" stroke-linejoin="round"/></svg>King's Cross St. Pancras</div>
                          <span class="tr-distance-time"><svg width="13" height="14" viewBox="0 0 13 14" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M2.7085 12.1211L1.3335 13.4961M10.9585 12.1211L12.3335 13.4961M4.771 9.3711H4.77718M8.88981 9.3711H8.896M2.021 5.24609C4.771 7.99609 9.23975 7.99609 11.646 5.24609" stroke="#222222" stroke-width="0.8" stroke-linecap="round" stroke-linejoin="round"/><path d="M2.20862 4.48572C2.77305 1.61334 3.55406 1.12109 6.45874 1.12109H7.20812C10.1128 1.12109 10.8931 1.61334 11.4582 4.48572L11.8384 6.42172C12.3575 9.06172 12.6167 10.3817 11.8604 11.2514C11.1042 12.1211 9.68106 12.1211 6.83343 12.1211C3.98649 12.1211 2.56268 12.1211 1.80643 11.2514C1.05018 10.3817 1.30937 9.06172 1.82843 6.42172L2.20862 4.48572Z" stroke="#222222" stroke-width="0.8" stroke-linecap="round" stroke-linejoin="round"/></svg>20 min</span>
                          <span class="tr-travel-type">Underground</span>
                        </div>
                        <div class="tr-distance">0.88 km</div>
                      </div>
                      <div class="tr-getting-list">
                        <div class="tr-place-info">
                          <div class="tr-place-name"><svg width="20" height="17" viewBox="0 0 20 17" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M17.0835 9.43359H14.8335M3.58349 9.43359H5.83349M17.4116 5.68359L15.9485 1.78191C15.7289 1.19645 15.1693 0.808594 14.544 0.808594H6.12299C5.49773 0.808594 4.93804 1.19645 4.7185 1.78191L3.25537 5.68359M17.4116 5.68359L17.6299 6.26568C17.7524 6.59225 18.0646 6.80859 18.4133 6.80859C18.9068 6.80859 19.293 7.23341 19.2463 7.72462L18.8335 12.0586M17.4116 5.68359H18.9585M3.25537 5.68359L3.03708 6.26568C2.91462 6.59225 2.60243 6.80859 2.25366 6.80859C1.76023 6.80859 1.37395 7.23341 1.42073 7.72462L1.83349 12.0586M3.25537 5.68359H1.70849M1.83349 12.0586L1.95418 13.3258C2.0275 14.0957 2.67408 14.6836 3.44742 14.6836H3.5835M1.83349 12.0586V12.0586C1.55735 12.0586 1.3335 12.2824 1.3335 12.5586V15.0586C1.3335 15.4728 1.66928 15.8086 2.0835 15.8086H2.8335C3.24771 15.8086 3.5835 15.4728 3.5835 15.0586V14.6836M3.5835 14.6836H17.0835M17.0835 14.6836H17.2196C17.9929 14.6836 18.6395 14.0957 18.7128 13.3258L18.8335 12.0586M17.0835 14.6836V15.0586C17.0835 15.4728 17.4193 15.8086 17.8335 15.8086H18.5835C18.9977 15.8086 19.3335 15.4728 19.3335 15.0586V12.5586C19.3335 12.2825 19.1096 12.0586 18.8335 12.0586V12.0586M6.24161 3.33425L5.41255 5.82142C5.25067 6.30707 5.61214 6.80859 6.12406 6.80859H14.5429C15.0548 6.80859 15.4163 6.30707 15.2544 5.82142L14.4254 3.33425C14.2212 2.72174 13.648 2.68359 13.0024 2.68359H7.66463C7.01899 2.68359 6.44578 2.72174 6.24161 3.33425Z" stroke="black" stroke-width="0.7" stroke-linecap="round" stroke-linejoin="round"/></svg>Rental cars</div>
                          <a href="javascript:void(0);" class="tr-travel-type">See rental cars</a>
                        </div>
                      </div>
                     
                      <div data-type="no-data">
                        <div class="tr-tourist-place">
                          <div class="tr-img">
                            <img loading="lazy" src="images/no-data-explore.png" alt="tourist-places">
                          </div>
                          <div class="tr-details">
                            <div class="tr-no-data-text w-100 mb-12"></div>
                            <div class="tr-no-data-text w-60 mb-12"></div>
                            <div class="tr-no-data-text w-80 mb-12"></div>
                            <div class="tr-no-data-text w-20 mb-12"></div>
                          </div>
                        </div>
                        <div class="tr-tourist-place">
                          <div class="tr-img">
                            <img loading="lazy" src="images/no-data-explore.png" alt="tourist-places">
                          </div>
                          <div class="tr-details">
                            <div class="tr-no-data-text w-100 mb-12"></div>
                            <div class="tr-no-data-text w-60 mb-12"></div>
                            <div class="tr-no-data-text w-80 mb-12"></div>
                            <div class="tr-no-data-text w-20 mb-12"></div>
                          </div>
                        </div>
                        <div class="tr-tourist-place">
                          <div class="tr-img">
                            <img loading="lazy" src="images/no-data-explore.png" alt="tourist-places">
                          </div>
                          <div class="tr-details">
                            <div class="tr-no-data-text w-100 mb-12"></div>
                            <div class="tr-no-data-text w-60 mb-12"></div>
                            <div class="tr-no-data-text w-80 mb-12"></div>
                            <div class="tr-no-data-text w-20 mb-12"></div>
                          </div>
                        </div>
                        <div class="tr-tourist-place">
                          <div class="tr-img">
                            <img loading="lazy" src="images/no-data-explore.png" alt="tourist-places">
                          </div>
                          <div class="tr-details">
                            <div class="tr-no-data-text w-100 mb-12"></div>
                            <div class="tr-no-data-text w-60 mb-12"></div>
                            <div class="tr-no-data-text w-80 mb-12"></div>
                            <div class="tr-no-data-text w-20 mb-12"></div>
                          </div>
                        </div>
                      </div>
                      
                    </div>
                  </div>
                </div> -->
              </div>
            </div>
            <!--EXPLORE OTHER OPTIONS IN AND AROUND SECTION - END-->

            <!--NEARBY HOTEL - START-->
            <div class="tr-nearby-hotel">
              <h3 class="d-none d-md-block">What's nearby hotels</h3>
              <h3 class="d-block d-sm-block d-md-none">You might also like</h3>
              <div class="row tr-nearby-hotel-lists" id="nearby_hotel">               
                 @if(!$nearby_hotel->isEmpty())
                      @foreach($nearby_hotel as $nearby_hotels)
                          <div class="tr-nearby-hotel-list">
                              <div class="tr-hotel-img">
                                  <a href="javascript:void(0);">
                                      <img loading="lazy" src="https://photo.hotellook.com/image_v2/limit/h{{$nearby_hotels->hotel_id}}_1/290/291.jpg" alt="NearBy Hotel" height="290" width="291">
                                  </a>
                              </div>
                              <div class="tr-hotel-deatils">
                                  <div class="tr-hotel-name">
                                      <a href="{{ route('hotel.detail', [$nearby_hotels->location_id.'-'.$nearby_hotels->hotelid.'-'.$nearby_hotels->slug]) }}">
                                          {{$nearby_hotels->name}}
                                      </a>
                                  </div>
                                  <div class="tr-rating d-block d-sm-block d-md-none">
                                      <span><i class="fa fa-star" aria-hidden="true"></i></span> 5.0
                                  </div>
                                  <div class="tr-like-review">
                                      @php
                                          $ratingtext = "";
                                          $result = "";
                                          $color = "";
                                      @endphp

                                      @if($nearby_hotels->stars != "" && $nearby_hotels->stars != 0)
                                          @php
                                              $rating = (float)$nearby_hotels->stars;
                                              $result = round($rating * 20);
                                              if ($result > 95) {
                                                  $ratingtext = 'Superb';
                                                  $color = 'green';
                                              } elseif ($result >= 91 && $result <= 95) {
                                                  $ratingtext = 'Excellent';
                                                  $color = 'green';
                                              } elseif ($result >= 81 && $result <= 90) {
                                                  $ratingtext = 'Great';
                                                  $color = 'green';
                                              } elseif ($result >= 71 && $result <= 80) {
                                                  $ratingtext = 'Good';
                                                  $color = '#FFE135';
                                              } elseif ($result >= 61 && $result <= 70) {
                                                  $ratingtext = 'Okay';
                                                  $color = '#FFE135';
                                              } elseif ($result >= 51 && $result <= 60) {
                                                  $ratingtext = 'Average';
                                                  $color = '#FFE135';
                                              } elseif ($result >= 41 && $result <= 50) {
                                                  $ratingtext = 'Poor';
                                                  $color = 'red';
                                              } elseif ($result >= 21 && $result <= 40) {
                                                  $ratingtext = 'Disappointing';
                                                  $color = 'red';
                                              } else {
                                                  $ratingtext = 'Bad';
                                                  $color = 'red';
                                              }
                                          @endphp
                                          <span class="tr-likes">
                                              <svg width="21" height="21" viewBox="0 0 21 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                  <path fill-rule="evenodd" clip-rule="evenodd" d="M10.6655 6.37175C9.45752 5.01908 7.44319 4.65521 5.92972 5.89385C4.41626 7.13249 4.20318 9.20344 5.39172 10.6684L10.6655 15.5524L15.9392 10.6684C17.1277 9.20344 16.9407 7.11946 15.4012 5.89385C13.8617 4.66824 11.8734 5.01908 10.6655 6.37175Z" stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                              </svg>
                                              {{$result}}%
                                          </span>
                                          <span class="tr-total-rating">4.2</span>
                                          <span class="tr-vgood" style="color:{{$color}}">{{$ratingtext}}</span>
                                      @endif
                                  </div>
                                  @if($nearby_hotels->pricefrom != "")
                                      <div class="tr-price-section">
                                          <span>${{$nearby_hotels->pricefrom}}</span> /night
                                      </div>
                                  @endif
                              </div>
                          </div>
                      @endforeach

                      @if($nearby_hotel->count() < 4)
                          @for($i = 0; $i < 4 - $nearby_hotel->count(); $i++)
                          <div class="tr-nearby-hotel-list">
                                    <div class="tr-hotel-img">
                                      <img loading="lazy" src="{{asset('public/frontend/hotel-detail/images/no-data-nearby-hotel.png')}}" alt="NearBy Hotel">
                                    </div>
                                    <div class="tr-hotel-deatils">
                                      <div class="tr-no-data-text w-100 mb-12"></div>
                                      <div class="tr-no-data-text w-70 mb-12"></div>
                                      <div class="tr-no-data-text w-25 mb-12"></div>
                                    </div>
                                  </div>
                          @endfor
                      @endif
                  @else
                      <!-- Display 4 default hotel cards if no data is available -->
                      @for($i = 0; $i < 4; $i++)
                      <div class="tr-nearby-hotel-list">
                          <div class="tr-hotel-img">
                            <img loading="lazy" src="{{asset('public/frontend/hotel-detail/images/no-data-nearby-hotel.png')}}" alt="NearBy Hotel">
                          </div>
                          <div class="tr-hotel-deatils">
                            <div class="tr-no-data-text w-100 mb-12"></div>
                            <div class="tr-no-data-text w-70 mb-12"></div>
                            <div class="tr-no-data-text w-25 mb-12"></div>
                          </div>
                        </div>
                      @endfor
                  @endif


              </div>
              <!-- Below element When We don't have data - Start -->
              <div class="row tr-nearby-hotel-lists" data-type="no-data">
                <div class="tr-nearby-hotel-list">
                  <div class="tr-hotel-img">
                    <img loading="lazy" src="images/no-data-nearby-hotel.png" alt="NearBy Hotel">
                  </div>
                  <div class="tr-hotel-deatils">
                    <div class="tr-no-data-text w-100 mb-12"></div>
                    <div class="tr-no-data-text w-70 mb-12"></div>
                    <div class="tr-no-data-text w-25 mb-12"></div>
                  </div>
                </div>
                <div class="tr-nearby-hotel-list">
                  <div class="tr-hotel-img">
                    <img loading="lazy" src="images/no-data-nearby-hotel.png" alt="NearBy Hotel">
                  </div>
                  <div class="tr-hotel-deatils">
                    <div class="tr-no-data-text w-100 mb-12"></div>
                    <div class="tr-no-data-text w-70 mb-12"></div>
                    <div class="tr-no-data-text w-25 mb-12"></div>
                  </div>
                </div>
                <div class="tr-nearby-hotel-list">
                  <div class="tr-hotel-img">
                    <img loading="lazy" src="images/no-data-nearby-hotel.png" alt="NearBy Hotel">
                  </div>
                  <div class="tr-hotel-deatils">
                    <div class="tr-no-data-text w-100 mb-12"></div>
                    <div class="tr-no-data-text w-70 mb-12"></div>
                    <div class="tr-no-data-text w-25 mb-12"></div>
                  </div>
                </div>
                <div class="tr-nearby-hotel-list">
                  <div class="tr-hotel-img">
                    <img loading="lazy" src="images/no-data-nearby-hotel.png" alt="NearBy Hotel">
                  </div>
                  <div class="tr-hotel-deatils">
                    <div class="tr-no-data-text w-100 mb-12"></div>
                    <div class="tr-no-data-text w-70 mb-12"></div>
                    <div class="tr-no-data-text w-25 mb-12"></div>
                  </div>
                </div>
              </div>
              <!-- Below element When We don't have data - End -->
              <!-- <a href="javascript:void(0);" class="tr-show-all-hotels">Show all hotels</a> -->
            </div>
            <!--NEARBY HOTEL - END-->

            <!--REVIEWS SECTION - START-->
           
           
            <div class="tr-review-section" id="">
              <div class="row">              
                <h3>Reviews</h3>
                <div class="col-lg-7 getreviewdata" id="reviews">
                  <div class="tr-review-content">
                    <div class="tr-power-by">
                      <ul>
                        <li><img loading="lazy" src="{{asset('public/frontend/hotel-detail/images/ellipse-1.png')}}" alt="ellipse"></li>
                        <li><img loading="lazy" src="{{asset('public/frontend/hotel-detail/images/ellipse-2.png')}}" alt="ellipse"></li>
                        <li><img loading="lazy" src="{{asset('public/frontend/hotel-detail/images/ellipse-3.png')}}" alt="ellipse"></li>
                        <li>
                          <img loading="lazy" src="{{asset('public/frontend/hotel-detail/images/ellipse-4.png')}}" alt="ellipse">
                          <div class="tr-2-star-icon"></div>
                        </li>
                      </ul>
                      <span>Powered by AI</span>
                    </div>
                    <h4>Reviews summary</h4>
                    @if($searchresult[0]->ReviewSummaryLabel !="")
                    <?php $reviewSummaryLabel = $searchresult[0]->ReviewSummaryLabel;
                          $expreviewSummaryLabel = explode(',',$reviewSummaryLabel);
                          $t =1;
                    ?>
                    <div class="tr-short-decs">This summary was created by AI</div>
                    <ul class="tr-revies-recomm">
                      @foreach($expreviewSummaryLabel as $sumval)
                      @if( $t ==1)
                 
                      <li>
                        <svg width="24" height="25" viewBox="0 0 24 25" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M12 13.8086C11.2583 13.8086 10.5333 13.5887 9.91661 13.1766C9.29993 12.7646 8.81928 12.1789 8.53545 11.4937C8.25162 10.8084 8.17736 10.0544 8.32206 9.32701C8.46675 8.59958 8.8239 7.93139 9.34835 7.40695C9.8728 6.8825 10.541 6.52535 11.2684 6.38065C11.9958 6.23596 12.7498 6.31022 13.4351 6.59405C14.1203 6.87788 14.706 7.35852 15.118 7.97521C15.5301 8.59189 15.75 9.31692 15.75 10.0586C15.7488 11.0528 15.3533 12.0059 14.6503 12.7089C13.9473 13.4119 12.9942 13.8074 12 13.8086ZM12 7.8086C11.555 7.8086 11.12 7.94056 10.75 8.18779C10.38 8.43502 10.0916 8.78642 9.92127 9.19756C9.75098 9.60869 9.70642 10.0611 9.79324 10.4975C9.88005 10.934 10.0943 11.3349 10.409 11.6496C10.7237 11.9643 11.1246 12.1785 11.561 12.2654C11.9975 12.3522 12.4499 12.3076 12.861 12.1373C13.2722 11.967 13.6236 11.6786 13.8708 11.3086C14.118 10.9386 14.25 10.5036 14.25 10.0586C14.2494 9.46204 14.0122 8.89009 13.5903 8.46826C13.1685 8.04644 12.5966 7.80919 12 7.8086Z" fill="#222222"/><path d="M12 22.8086L5.67301 15.3468C5.58509 15.2348 5.49809 15.1221 5.41201 15.0086C4.33179 13.5846 3.74799 11.8459 3.75001 10.0586C3.75001 7.87056 4.6192 5.77214 6.16637 4.22496C7.71355 2.67779 9.81197 1.80859 12 1.80859C14.188 1.80859 16.2865 2.67779 17.8336 4.22496C19.3808 5.77214 20.25 7.87056 20.25 10.0586C20.2517 11.8451 19.6682 13.5829 18.5888 15.0063L18.588 15.0086C18.588 15.0086 18.363 15.3041 18.3293 15.3438L12 22.8086ZM6.60976 14.1048C6.60976 14.1048 6.78451 14.3358 6.82426 14.3853L12 20.4896L17.1825 14.3771C17.2155 14.3358 17.391 14.1033 17.3918 14.1026C18.2747 12.9395 18.7518 11.5189 18.75 10.0586C18.75 8.26838 18.0388 6.55149 16.773 5.28562C15.5071 4.01975 13.7902 3.30859 12 3.30859C10.2098 3.30859 8.49291 4.01975 7.22703 5.28562C5.96116 6.55149 5.25001 8.26838 5.25001 10.0586C5.24815 11.5198 5.72584 12.9413 6.60976 14.1048Z" fill="#222222"/></svg>
                        <div>Location</div>
                        <div>{{$sumval}}</div>
                      </li>
                      @elseif($t ==2)
                      <li>
                        <svg width="24" height="25" viewBox="0 0 24 25" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M19.5 7.05859H4.5C3.25736 7.05859 2.25 8.06595 2.25 9.30859V18.3086C2.25 19.5512 3.25736 20.5586 4.5 20.5586H19.5C20.7426 20.5586 21.75 19.5512 21.75 18.3086V9.30859C21.75 8.06595 20.7426 7.05859 19.5 7.05859Z" stroke="#222222" stroke-width="1.5" stroke-linejoin="round"/><path d="M19.2825 7.05784V5.65159C19.2824 5.30669 19.2062 4.96606 19.0592 4.65401C18.9123 4.34196 18.6984 4.06618 18.4326 3.84635C18.1668 3.62652 17.8558 3.46805 17.5217 3.38226C17.1877 3.29647 16.8388 3.28546 16.5 3.35003L4.155 5.45706C3.6189 5.55922 3.13526 5.84527 2.78749 6.26586C2.43972 6.68645 2.24963 7.21522 2.25 7.76096V10.0578" stroke="#222222" stroke-width="1.5" stroke-linejoin="round"/><path d="M17.25 15.3086C16.9533 15.3086 16.6633 15.2206 16.4166 15.0558C16.17 14.891 15.9777 14.6567 15.8642 14.3826C15.7506 14.1085 15.7209 13.8069 15.7788 13.516C15.8367 13.225 15.9796 12.9577 16.1893 12.7479C16.3991 12.5382 16.6664 12.3953 16.9574 12.3374C17.2483 12.2795 17.5499 12.3092 17.824 12.4228C18.0981 12.5363 18.3324 12.7286 18.4972 12.9752C18.662 13.2219 18.75 13.5119 18.75 13.8086C18.75 14.2064 18.592 14.5879 18.3107 14.8693C18.0294 15.1506 17.6478 15.3086 17.25 15.3086Z" fill="black"/></svg>
                        <div>Value</div>
                      <div>{{$sumval}}</div>
                      </li>
                      @endif
                      @endforeach
                    </ul>
                    @endif
                   @if($searchresult[0]->ReviewSummary !="") <p>{{$searchresult[0]->ReviewSummary}}</p>@endif
                  
                   @if(!$sightreviews->isEmpty()) <a href="javascript:void(0);" class="tr-jump-to-all-review">Jump to all reviews</a>
                    <div class="tr-helpful">
                      Do you find this helpful? 
                      <button class="tr-like-button">Like</button>
                      <button class="tr-dislike-button">Dislike</button>
                    </div>
                    @endif
                   </div>
                  @if(!$sightreviews->isEmpty()) 
					 <?php
						  $totalReviews = $sightreviews->count();
						  $recommendedCount = $sightreviews->where('IsRecommend', 1)->count();
						  $notRecommendedCount = $totalReviews - $recommendedCount;

						//  $recommendedPercentage = round(($recommendedCount / $totalReviews) * 100, 2);
						//  $notRecommendedPercentage = round(($notRecommendedCount / $totalReviews) * 100, 2);
						  $positiveReviews = $recommendedCount;
						  $negativeReviews = $notRecommendedCount;
						  $averageRating = ($positiveReviews * 5 + $negativeReviews * 1) / $totalReviews;
						  $averageRatingPercentage = round(($averageRating / 5) * 100, 2);
					  ?>
                      <div class="tr-reviews-graph">
                        <div class="tr-reviews-graph-details">
                          <h4 class="d-none d-md-block">Travellers Reviews</h4>
                            <div class="tr-likes-count review-rating-count">{{floor($averageRatingPercentage)}}%</div>
                          <div class="tr-no-review" data-type="no-data">No Review</div>
                          <div class="tr-reviews-count">({{count($sightreviews)}} Reviews)</div>
                        </div>
                        <div class="tr-rating-types">
                          <div class="tr-rating-type">  
                            <div class="tr-title">Recommended</div>
                            <div class="progress">
                              <div class="progress-bar" role="progressbar" aria-valuenow="88" aria-valuemin="0" aria-valuemax="100" style="width:88%"></div>
                            </div>
                            <div class="tr-reviews-nums rcmd-count">{{$recommendedCount}}</div>
                          </div>
                          <div class="tr-rating-type">
                            <div class="tr-title">Not Recommended</div>
                            <div class="progress">
                              <div class="progress-bar" role="progressbar" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100" style="width:30%"></div>
                            </div>
                            <div class="tr-reviews-nums notrcmd-count">{{ $notRecommendedCount }}</div>
                          </div>
                        </div>
                      </div>
                    
                      <div class="tr-reviews-mentioned">
                        <h4>Reviews that mentioned</h4>
                        <ul>
                          <li><a href="javascript:void(0);" class="filter-option" data-filter="recommended">Recommended</a></li>
                          <li><a href="javascript:void(0);" class="filter-option" data-filter="not_recommended">Not Recommended</a></li>
                        </ul>
                        <div class="tr-shotby">
                          <div class="custom-select">
                            <label>Sort by:</label>
                            <select>
                              <option>Low rating</option>
                              <option>High rating</option>
                            </select>
                          </div>
                        </div>
                      </div>
                      <!-- review-data -->
                      <div class="review-data">    
                          @if(!$sightreviews->isEmpty())           
                          <div class="tr-customer-reviews ">
                            @foreach($sightreviews as $review)
                              <div class="tr-customer-review">
                                <div class="tr-customer-details">
                                  <div class="tr-customer-detail">
                                    <img loading="lazy" src="{{asset('public/frontend/hotel-detail/images/usericon-review.png')}}" alt="customer">
                                    <div class="tr-customer-name">
                                      <div>{{$review->Name}}</div>
                                      <div class="tr-recommended-title @if($review->IsRecommend == 1) tr-heart-green @elseif($review->IsRecommend == 0) tr-heart-red @endif"> Recommended
                                        <!-- <span class="tr-time">(1 week ago)</span> -->
                                      </div>
                                    </div>
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
                                <p>{{$review->ReviewDescription}}</p>
                                <div class="tr-helpful">
                                  Was this helpful? 
                                  <button class="tr-like-button">Like</button>
                                  <button class="tr-dislike-button">Dislike</button>
                                </div>
                              </div>
                            @endforeach
                          </div>                  
                          @else
                          <div class="tr-no-review-listing mt-5">
                            <div class="tr-no-review-list">
                                  <div class="tr-no-data-text w-70 tr-no-data-dark-gray mb-12"></div>
                                  <div class="tr-no-data-text w-70 mb-12"></div>
                                  <div class="tr-no-data-text w-50 tr-no-data-red mb-12"></div>
                                  <div class="tr-no-data-text w-30 tr-no-data-green mb-12"></div>
                                  <div class="tr-no-data-text w-20 mt-41 mb-12"></div>
                                  <div class="tr-no-data-text w-10 mb-0"></div>
                            </div>
                          </div>
                          @endif
                      </div>

                   @else
                    <div class="tr-no-review-list mt-3">
                        <div class="tr-no-data-text w-70 tr-no-data-dark-gray mb-12"></div>
                        <div class="tr-no-data-text w-70 mb-12"></div>
                        <div class="tr-no-data-text w-50 tr-no-data-red mb-12"></div>
                        <div class="tr-no-data-text w-30 tr-no-data-green mb-12"></div>
                        <div class="tr-no-data-text w-20 mt-41 mb-12"></div>
                        <div class="tr-no-data-text w-10 mb-0"></div>
                      </div>
                    @endif
             <!-- review-data -->
                </div>
               

                <div class="col-lg-5">
                      <div class="tr-enjoyed-the-stay">
                        <h5>Enjoyed the stay?</h5>
                        <button class="tr-btn tr-write-review">Write a review</button>
                        <p>Let others know your experience here.</p>
                      </div>
                    </div>
                  </div>
                </div>
                         </div>      
            <!--REVIEWS SECTION - END-->

            <!--BREADCRUMB - START-->
            <div class="tr-breadcrumb-section">
            @if(!empty($searchresult))
                <ul class="tr-breadcrumb">
                   

                    @if(!empty($breadcumb))
                        @if($breadcumb[0]->ccName != "")
                            <li>
                                <a href="{{ route('explore_continent_list',[$breadcumb[0]->contid,$breadcumb[0]->ccName]) }}" target="_blank">
                                    {{$breadcumb[0]->ccName}}
                                </a>
                            </li>
                        @endif
                        <li>
                            <a href="{{ route('explore_country_list',[$breadcumb[0]->CountryId,$breadcumb[0]->cslug]) }}" target="_blank">
                                @if(!empty($breadcumb)) {{$breadcumb[0]->CountryName}} @endif
                            </a>
                        </li>
                    @endif

                    @if(!empty($locationPatent))
                        <?php $locationPatent = array_reverse($locationPatent); ?>
                        @foreach ($locationPatent as $location)
                            <li>
                                <a href="{{ route('search.results',[$location['LocationId'].'-'.strtolower($location['slug'])]) }}" target="_blank">
                                    {{ $location['Name'] }}
                                </a>
                            </li>
                        @endforeach
                    @endif

                    <li>
                        <a href="{{ route('search.results',[$searchresult[0]->slugid.'-'.strtolower($searchresult[0]->Lslug)]) }}" target="_blank">
                            <span>{{$searchresult[0]->Name}}</span>
                        </a>
                    </li>
                    <li class="active">
                        <span>{{$searchresult[0]->Title}}</span>
                    </li>
                </ul>
            @endif

            </div>
            <!--BREADCRUMB - END-->
          </div>
        </div>
      </div>
    </div>
    
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
              <img loading="lazy" src="@if( isset($Sight_image[0]->Image) && $Sight_image[0]->Image !='') https://s3-us-west-2.amazonaws.com/s3-travell/Sight-images/{{$Sight_image[0]->Image}}  @else {{asset('public/frontend/hotel-detail/images/no-data-place-image.png')}} @endif" alt="Tower Bridge">
            </div>
            <div class="tr-share-details">
              <div class="tr-hotel-name">{{$searchresult[0]->Title}}</div>
              <div>{{$searchresult[0]->Address}}</div>
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
      </div>
      
      <div class="tr-gallery-categories">
        <div class="tr-galleries-section">
          <div class="tr-gallery-category">
            <ul>
             @if(!$Sight_image->isEmpty())
            @foreach($Sight_image as $image)
              <li data-bs-toggle="modal" data-bs-target="#gallerySliderModal">
                <img loading="lazy" src="@if(isset($image->Image) && $image->Image != '') 
                https://s3-us-west-2.amazonaws.com/s3-travell/Sight-images/{{$image->Image}}                                                                              
                                          @endif" alt="Outdoor Pictures 1" height="300" height="270">
              </li>
            @endforeach
            @endif
            </ul>
          </div>
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
              <button class="carousel-control-prev" type="button" data-bs-target="#gallerySlider" data-bs-slide="prev"><span class="carousel-control-prev-icon"></span></button>
              <button class="carousel-control-next" type="button" data-bs-target="#gallerySlider" data-bs-slide="next"><span class="carousel-control-next-icon"></span></button>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!--Write a Review Modal-->
    <div class="tr-write-review-modal">
      <div class="tr-popup-content">
        <h3>Write a review</h3>
        <div class="tr-write-review-content add_review">
          <div class="tr-hotel-reviews-details">
            <div class="tr-main-image">
              <img loading="lazy" src="@if( isset($Sight_image[0]->Image) && $Sight_image[0]->Image !='') {{ asset('public/sight-images/'. $Sight_image[0]->Image) }} @else {{asset('public/frontend/hotel-detail/images/no-data-place-image.png')}} @endif" alt="Room Image">
            </div>
            <div class="tr-hotel-info">
              <h4 class="tr-hotel-name">{{$searchresult[0]->Title}}</h4>
              <div class="tr-hotel-address">{{$searchresult[0]->Address}}</div> 
            </div>
          </div>
          <form id="s-review" class="add_review">
            <div class="tr-overall-rating">
              <div class="tr-rating">
              <label>Do you recommend visiting {{$searchresult[0]->Title}}?</label>
              <div class="tr-recommended-actions">
                <label>
                  <input type="radio" class="write-review recommend selected" name="rating" value="1">
                  <span style="">Yes</span>
                </label>
                <label>
                  <input type="radio" class="write-review recommend" name="rating" value="0">
                  <span>No</span>
                </label>
              </div>
              </div>
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
            <div class="tr-review-msg">
              <label>Name</label>
              <input type="text" class="form-control" id="name" placeholder="Name" name="">
              <div class="error-msg" id="name-error"></div>
            </div>
            <div class="tr-review-msg">
              <label>Email</label>
              <input type="text" class="form-control" id="email" placeholder="Email" name="">
              <div class="error-msg" id="email-error"></div>
            </div>
            <div class="tr-review-msg">
              <label>Write a review</label>
              <textarea class="form-control" id="review" placeholder="Type your review here" name=""></textarea>
            </div>
            <div class="error-msg" id="review-error"></div>
            <div class="tr-review-image">
              <label>Add some photos (optional)</label>
              <div class="tr-file-upload">
                <!--<button class="file-upload-btn" type="button" onclick="$('.file-upload-input').trigger( 'click' )">Add Image</button>-->
                <div class="tr-image-upload-wrap">
                  <input class="tr-file-upload-input" type='file' id="files" name="files[]" onchange="readURL(this);" accept="image/*" multiple/>
                  <div class="tr-drag-image">
                    <svg width="17" height="16" viewBox="0 0 17 16" fill="none" xmlns="http://www.w3.org/2000/svg"><g clip-path="url(#clip0_441_7517)"><path d="M15.8385 12.6667C15.8385 13.0203 15.6981 13.3594 15.448 13.6095C15.198 13.8595 14.8588 14 14.5052 14H2.50521C2.15159 14 1.81245 13.8595 1.5624 13.6095C1.31235 13.3594 1.17188 13.0203 1.17188 12.6667V5.33333C1.17188 4.97971 1.31235 4.64057 1.5624 4.39052C1.81245 4.14048 2.15159 4 2.50521 4H5.17188L6.50521 2H10.5052L11.8385 4H14.5052C14.8588 4 15.198 4.14048 15.448 4.39052C15.6981 4.64057 15.8385 4.97971 15.8385 5.33333V12.6667Z" stroke="#6A6A6A" stroke-linecap="round" stroke-linejoin="round"/><path d="M8.49479 11.3333C9.96755 11.3333 11.1615 10.1394 11.1615 8.66667C11.1615 7.19391 9.96755 6 8.49479 6C7.02203 6 5.82812 7.19391 5.82812 8.66667C5.82812 10.1394 7.02203 11.3333 8.49479 11.3333Z" stroke="#6A6A6A" stroke-linecap="round" stroke-linejoin="round"/></g><defs><clipPath id="clip0_441_7517"><rect width="16" height="16" fill="white" transform="translate(0.5)"/></clipPath></defs></svg>
                    <div>Click to add photos</div>
                    <span>or drag and drop</span>
                  </div>
                </div>
                <div class="tr-file-upload-content"> 
                  <img class="tr-file-upload-image" src="#" alt="your image"  />
                  <div class="image-title-wrap">
                    <button type="button" onclick="removeUpload()" class="tr-remove-image">
                      <i class="fa fa-times" aria-hidden="true"></i>
                      <!--<span class="image-title">Uploaded Image</span>-->
                    </button>
                  </div>
                </div>
              </div>
            </div>
            <button type="submit" class="tr-popup-btn" id="addReview">Submit</button>
          </form>
        </div>
      </div>
    </div>

    <!-- Timing Modal -->
    <div class="modal" id="timingModal">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5>Timings</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
          </div>
          <div class="tr-days-time-section">
          @if(!$gettiming->isEmpty())


              <?php
              $data = json_decode($gettiming[0]->timings, true);
              $daysOfWeek = ["mon", "tue", "wed", "thu", "fri", "sat", "sun"];
              date_default_timezone_set('Asia/Kolkata'); // Set to Indian Standard Time

              $currentDay = strtolower(date('D')); // Current day in three-letter format
              $currentTime = date('H:i'); // Current time in 24-hour format
              ?>

              {{-- Display Today at the top --}}
              @if(isset($data['time'][$currentDay]))
                  <?php
                  $todayStartTime = $data['time'][$currentDay]['start'];
                  $todayEndTime = $data['time'][$currentDay]['end'];
                  ?>

                  <div class="tr-day-time">
                      <div class="tr-days">Today</div>

                    
                      @if($todayStartTime == "00:00" && $todayEndTime == "23:59")
                          <div class="tr-timing"><span class="tr-open-circle"></span>Open 24 hours</div>
                      @elseif($todayStartTime == "00:00" && $todayEndTime == "00:00")
                          <div class="tr-timing tr-closed">Closed</div>
                      @elseif($currentTime >= $todayStartTime && $currentTime <= $todayEndTime)
                          <div class="tr-timing"><span class="tr-open-circle"></span>{{ date('h:i A', strtotime($todayStartTime)) }} - {{ date('h:i A', strtotime($todayEndTime)) }} (OPEN NOW)</div>
                      @else
                          <div class="tr-timing">{{ date('h:i A', strtotime($todayStartTime)) }} - {{ date('h:i A', strtotime($todayEndTime)) }} (CLOSED NOW)</div>
                      @endif
                  </div>

              @endif

              {{-- Loop through the rest of the days --}}
              @foreach($daysOfWeek as $day)
                  {{-- Skip the current day (today) since it's already displayed separately --}}
                  @if($day === $currentDay)
                      @continue
                  @endif

                  <div class="tr-day-time">
                      <div class="tr-days">{{ ucfirst($day) }}</div>

                      @if(isset($data['time'][$day]))
                          <?php
                          $startTime = $data['time'][$day]['start'];
                          $endTime = $data['time'][$day]['end'];
                          ?>

                          @if($startTime == "00:00" && $endTime == "23:59")
                              <div class="tr-timing">Open 24 hours</div>
                          @elseif($startTime == "00:00" && $endTime == "00:00")
                              <div class="tr-timing tr-closed">Closed</div>
                          @else
                              <div class="tr-timing">{{ date('h:i A', strtotime($startTime)) }} - {{ date('h:i A', strtotime($endTime)) }}</div>
                          @endif
                      @else
                          <div class="tr-timing tr-closed">Closed</div>
                      @endif
                  </div>
              @endforeach

              @else
              <p>Timing not available.</p>
              @endif




          </div>
        </div>
      </div>
    </div>

    <!-- Timing Change Modal -->
    <div class="modal" id="timingChangeModal">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5>Select Days and Time</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
          </div>
          <div class="tr-days-time-section">
            <div class="tr-day-time">
              <div class="tr-days">Sunday</div>
              <div class="tr-timing tr-closed">
                09:00 AM - 01:30 PM
                <button type="button" class="tr-anchor-btn" data-bs-toggle="modal" data-bs-target="#timingEditModal">
                  <svg width="18" height="18" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M8 13.3333H14" stroke="#222222" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path><path d="M11 2.3334C11.2652 2.06819 11.6249 1.91919 12 1.91919C12.1857 1.91919 12.3696 1.95577 12.5412 2.02684C12.7128 2.09791 12.8687 2.20208 13 2.3334C13.1313 2.46472 13.2355 2.62063 13.3066 2.79221C13.3776 2.96379 13.4142 3.14769 13.4142 3.3334C13.4142 3.51912 13.3776 3.70302 13.3066 3.8746C13.2355 4.04618 13.1313 4.20208 13 4.3334L4.66667 12.6667L2 13.3334L2.66667 10.6667L11 2.3334Z" stroke="#222222" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path></svg>
                </button>
              </div>
            </div>
            <div class="tr-day-time">
              <div class="tr-days">Monday</div>
              <div class="tr-timing">
                9:00 AM - 05:30 PM
                <button type="button" class="tr-anchor-btn" data-bs-toggle="modal" data-bs-target="#timingEditModal">
                  <svg width="18" height="18" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M8 13.3333H14" stroke="#222222" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path><path d="M11 2.3334C11.2652 2.06819 11.6249 1.91919 12 1.91919C12.1857 1.91919 12.3696 1.95577 12.5412 2.02684C12.7128 2.09791 12.8687 2.20208 13 2.3334C13.1313 2.46472 13.2355 2.62063 13.3066 2.79221C13.3776 2.96379 13.4142 3.14769 13.4142 3.3334C13.4142 3.51912 13.3776 3.70302 13.3066 3.8746C13.2355 4.04618 13.1313 4.20208 13 4.3334L4.66667 12.6667L2 13.3334L2.66667 10.6667L11 2.3334Z" stroke="#222222" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path></svg>
                </button>
              </div>
            </div>
            <div class="tr-day-time">
              <div class="tr-days">Tuesday</div>
              <div class="tr-timing">
                Closed
                <button type="button" class="tr-anchor-btn" data-bs-toggle="modal" data-bs-target="#timingEditModal">
                  <svg width="18" height="18" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M8 13.3333H14" stroke="#222222" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path><path d="M11 2.3334C11.2652 2.06819 11.6249 1.91919 12 1.91919C12.1857 1.91919 12.3696 1.95577 12.5412 2.02684C12.7128 2.09791 12.8687 2.20208 13 2.3334C13.1313 2.46472 13.2355 2.62063 13.3066 2.79221C13.3776 2.96379 13.4142 3.14769 13.4142 3.3334C13.4142 3.51912 13.3776 3.70302 13.3066 3.8746C13.2355 4.04618 13.1313 4.20208 13 4.3334L4.66667 12.6667L2 13.3334L2.66667 10.6667L11 2.3334Z" stroke="#222222" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path></svg>
                </button>
              </div>
            </div>
            <div class="tr-day-time">
              <div class="tr-days">Wednesday</div>
              <div class="tr-timing">
                Closed
                <button type="button" class="tr-anchor-btn" data-bs-toggle="modal" data-bs-target="#timingEditModal">
                  <svg width="18" height="18" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M8 13.3333H14" stroke="#222222" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path><path d="M11 2.3334C11.2652 2.06819 11.6249 1.91919 12 1.91919C12.1857 1.91919 12.3696 1.95577 12.5412 2.02684C12.7128 2.09791 12.8687 2.20208 13 2.3334C13.1313 2.46472 13.2355 2.62063 13.3066 2.79221C13.3776 2.96379 13.4142 3.14769 13.4142 3.3334C13.4142 3.51912 13.3776 3.70302 13.3066 3.8746C13.2355 4.04618 13.1313 4.20208 13 4.3334L4.66667 12.6667L2 13.3334L2.66667 10.6667L11 2.3334Z" stroke="#222222" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path></svg>
                </button>
              </div>
            </div>
            <div class="tr-day-time">
              <div class="tr-days">Thursday</div>
              <div class="tr-timing">
                Closed
                <button type="button" class="tr-anchor-btn" data-bs-toggle="modal" data-bs-target="#timingEditModal">
                  <svg width="18" height="18" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M8 13.3333H14" stroke="#222222" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path><path d="M11 2.3334C11.2652 2.06819 11.6249 1.91919 12 1.91919C12.1857 1.91919 12.3696 1.95577 12.5412 2.02684C12.7128 2.09791 12.8687 2.20208 13 2.3334C13.1313 2.46472 13.2355 2.62063 13.3066 2.79221C13.3776 2.96379 13.4142 3.14769 13.4142 3.3334C13.4142 3.51912 13.3776 3.70302 13.3066 3.8746C13.2355 4.04618 13.1313 4.20208 13 4.3334L4.66667 12.6667L2 13.3334L2.66667 10.6667L11 2.3334Z" stroke="#222222" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path></svg>
                </button>
              </div>
            </div>
            <div class="tr-day-time">
              <div class="tr-days">Friday</div>
              <div class="tr-timing">
                Closed
                <button type="button" class="tr-anchor-btn" data-bs-toggle="modal" data-bs-target="#timingEditModal">
                  <svg width="18" height="18" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M8 13.3333H14" stroke="#222222" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path><path d="M11 2.3334C11.2652 2.06819 11.6249 1.91919 12 1.91919C12.1857 1.91919 12.3696 1.95577 12.5412 2.02684C12.7128 2.09791 12.8687 2.20208 13 2.3334C13.1313 2.46472 13.2355 2.62063 13.3066 2.79221C13.3776 2.96379 13.4142 3.14769 13.4142 3.3334C13.4142 3.51912 13.3776 3.70302 13.3066 3.8746C13.2355 4.04618 13.1313 4.20208 13 4.3334L4.66667 12.6667L2 13.3334L2.66667 10.6667L11 2.3334Z" stroke="#222222" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path></svg>
                </button>
              </div>
            </div>
            <div class="tr-day-time">
              <div class="tr-days">Saturday</div>
              <div class="tr-timing">
                Closed
                <button type="button" class="tr-anchor-btn" data-bs-toggle="modal" data-bs-target="#timingEditModal">
                  <svg width="18" height="18" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M8 13.3333H14" stroke="#222222" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path><path d="M11 2.3334C11.2652 2.06819 11.6249 1.91919 12 1.91919C12.1857 1.91919 12.3696 1.95577 12.5412 2.02684C12.7128 2.09791 12.8687 2.20208 13 2.3334C13.1313 2.46472 13.2355 2.62063 13.3066 2.79221C13.3776 2.96379 13.4142 3.14769 13.4142 3.3334C13.4142 3.51912 13.3776 3.70302 13.3066 3.8746C13.2355 4.04618 13.1313 4.20208 13 4.3334L4.66667 12.6667L2 13.3334L2.66667 10.6667L11 2.3334Z" stroke="#222222" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path></svg>
                </button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Timing Edit Modal -->
    <div class="modal" id="timingEditModal">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5>Select Time</h5>
            <button type="button" class="tr-back-btn" data-bs-toggle="modal" data-bs-target="#timingChangeModal">Back Button</button>
          </div>
          <div class="tr-days-time-section">
            <div class="tr-weekday">
              <label class="tr-day">
                <input type="checkbox" id="sunday" name="" value="">
                <span>S</span>
              </label>
              <label class="tr-day">
                <input type="checkbox" id="monday" name="" value="">
                <span>M</span>
              </label>
              <label class="tr-day">
                <input type="checkbox" id="tuesday" name="" value="">
                <span>T</span>
              </label>
              <label class="tr-day">
                <input type="checkbox" id="wednesday" name="" value="">
                <span>W</span>
              </label>
              <label class="tr-day">
                <input type="checkbox" id="thursday" name="" value="">
                <span>T</span>
              </label>
              <label class="tr-day">
                <input type="checkbox" id="friday" name="" value="">
                <span>F</span>
              </label>
              <label class="tr-day">
                <input type="checkbox" id="saturday" name="" value="">
                <span>S</span>
              </label>
            </div>
          </div>
          <div class="tr-field">
            <label class="tr-check-box">
              <input type="checkbox" id="" name="" value="">
              <span class="checkmark"></span>24 hours Open
            </label>
            <label class="tr-check-box">
              <input type="checkbox" id="" name="" value="">
              <span class="checkmark"></span>Closed
            </label>
          </div>
          <div class="tr-timing-field">
            <div>
              <label>
                <span>Open Time</span>
                <input type="text" placeholder="10:00 AM"name="">
              </label>
            </div>
            <div>
              <label>
                <span>Close Time</span>
                <input type="text" placeholder="--:-- --"name="">
              </label>
            </div>
            <div class="tr-remove-day">
              <button type="button" class="tr-anchor-btn" title="Remove"><svg width="20" height="23" viewBox="0 0 31 33" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M26.8023 10.8385L25.7209 31.1637C25.686 31.9022 25.0581 32.5 24.3256 32.5H6.67442C5.94186 32.5 5.31395 31.9022 5.27907 31.1637L4.19767 10.8385C4.16279 10.0648 4.75581 9.3967 5.52326 9.36154C6.2907 9.32637 6.95349 9.92418 6.98837 10.6978L8 29.6868H23.0349L24.0465 10.6978C24.0814 9.92418 24.7442 9.32637 25.5116 9.36154C26.2442 9.3967 26.8372 10.0648 26.8023 10.8385ZM30.5 6.12637C30.5 6.9 29.8721 7.53297 29.1047 7.53297H1.89535C1.12791 7.53297 0.5 6.9 0.5 6.12637C0.5 5.35275 1.12791 4.71978 1.89535 4.71978H9.56977V1.55495C9.56977 0.886813 10.0233 0.5 10.686 0.5H20.314C20.9767 0.5 21.4302 0.886813 21.4302 1.55495V4.71978H29.1047C29.8721 4.71978 30.5 5.35275 30.5 6.12637ZM12.0116 4.71978H18.9884V2.96154H12.0116V4.71978ZM12.6047 27.5769C13.3023 27.5769 13.8256 26.9088 13.8256 26.2407L13.4767 11.0495C13.4767 10.3813 12.9186 9.81868 12.2209 9.81868C11.5581 9.81868 11 10.3813 11.0349 11.0846L11.3837 26.311C11.3837 26.9791 11.9419 27.5769 12.6047 27.5769ZM18.3605 27.5769C19.0233 27.5769 19.5814 27.0143 19.5814 26.3462L19.9302 11.1549C19.9302 10.4868 19.407 9.88901 18.7442 9.88901C18.0465 9.88901 17.5233 10.4165 17.4884 11.0846L17.1395 26.2758C17.1047 26.9791 17.6628 27.5769 18.3605 27.5769C18.3256 27.5769 18.3256 27.5769 18.3605 27.5769Z" fill="#222222"/></svg></button>
            </div>
          </div>
          <div class="tr-timing-field">
            <div>
              <label>
                <span>Open Time</span>
                <input type="text" placeholder="10:00 AM"name="">
              </label>
            </div>
            <div>
              <label>
                <span>Close Time</span>
                <input type="text" placeholder="--:-- --"name="">
              </label>
            </div>
            <div class="tr-remove-day">
              <button type="button" class="tr-anchor-btn" title="Remove"><svg width="20" height="23" viewBox="0 0 31 33" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M26.8023 10.8385L25.7209 31.1637C25.686 31.9022 25.0581 32.5 24.3256 32.5H6.67442C5.94186 32.5 5.31395 31.9022 5.27907 31.1637L4.19767 10.8385C4.16279 10.0648 4.75581 9.3967 5.52326 9.36154C6.2907 9.32637 6.95349 9.92418 6.98837 10.6978L8 29.6868H23.0349L24.0465 10.6978C24.0814 9.92418 24.7442 9.32637 25.5116 9.36154C26.2442 9.3967 26.8372 10.0648 26.8023 10.8385ZM30.5 6.12637C30.5 6.9 29.8721 7.53297 29.1047 7.53297H1.89535C1.12791 7.53297 0.5 6.9 0.5 6.12637C0.5 5.35275 1.12791 4.71978 1.89535 4.71978H9.56977V1.55495C9.56977 0.886813 10.0233 0.5 10.686 0.5H20.314C20.9767 0.5 21.4302 0.886813 21.4302 1.55495V4.71978H29.1047C29.8721 4.71978 30.5 5.35275 30.5 6.12637ZM12.0116 4.71978H18.9884V2.96154H12.0116V4.71978ZM12.6047 27.5769C13.3023 27.5769 13.8256 26.9088 13.8256 26.2407L13.4767 11.0495C13.4767 10.3813 12.9186 9.81868 12.2209 9.81868C11.5581 9.81868 11 10.3813 11.0349 11.0846L11.3837 26.311C11.3837 26.9791 11.9419 27.5769 12.6047 27.5769ZM18.3605 27.5769C19.0233 27.5769 19.5814 27.0143 19.5814 26.3462L19.9302 11.1549C19.9302 10.4868 19.407 9.88901 18.7442 9.88901C18.0465 9.88901 17.5233 10.4165 17.4884 11.0846L17.1395 26.2758C17.1047 26.9791 17.6628 27.5769 18.3605 27.5769C18.3256 27.5769 18.3256 27.5769 18.3605 27.5769Z" fill="#222222"/></svg></button>
            </div>
          </div>
          <button type="button" class="tr-anchor-btn tr-add-more-hours"><span>Add more hours</span></button>
          <div class="tr-actions">
            <button type="button" class="tr-anchor-btn" data-bs-dismiss="modal">Cancel</button>
            <button type="submit" class="tr-btn">Save</button>
          </div>
        </div>
      </div>
    </div>

    <!-- Imprive The Lisiting Modal -->
    <div class="modal" id="improveListingModal">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5>Improve this listing</h5> listing model
            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
          </div>
          <div class="tr-place-details">
            <div class="tr-image">
              <img loading="lazy" src="@if( isset($Sight_image[0]->Image) && $Sight_image[0]->Image !='') {{ asset('public/sight-images/'. $Sight_image[0]->Image) }} @else {{asset('public/images/Hotel lobby.svg')}} @endif " alt="Tower Bridge">
            </div>
            <div class="tr-details">
              <div class="tr-name-and-address">
                <h4 class="tr-name">{{$searchresult[0]->Title}}</h4>
                <div class="tr-address">{{$searchresult[0]->Address}}</div>
              </div>
              <div class="tr-like-review">
                <div class="tr-heart">
                  <svg width="12" height="11" viewBox="0 0 12 11" fill="none" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" clip-rule="evenodd" d="M5.99604 2.28959C5.02968 1.20745 3.41823 0.916356 2.20745 1.90727C0.996677 2.89818 0.826217 4.55494 1.77704 5.7269L5.99604 9.63412L10.215 5.7269C11.1659 4.55494 11.0162 2.88776 9.78463 1.90727C8.55304 0.92678 6.96239 1.20745 5.99604 2.28959Z" fill="white" stroke="white" stroke-linecap="round" stroke-linejoin="round"></path></svg>
                </div>
                @if($searchresult[0]->TAAggregateRating != "" && $searchresult[0]->TAAggregateRating != 0)
                <?php 
                  $rating = (float)$searchresult[0]->TAAggregateRating;       
                  $result = round($rating * 20); 
                  if ($result > 95) {
                      $ratingtext = 'Superb';
                      $color = 'green';
                  } elseif ($result >= 91 && $result <= 95) {
                      $ratingtext = 'Excellent';
                      $color = 'green';
                  } elseif ($result >= 81 && $result <= 90) {
                      $ratingtext = 'Great';
                      $color = 'green';
                  } elseif ($result >= 71 && $result <= 80) {
                      $ratingtext = 'Good';
                      $color = '#FFE135';
                  } elseif ($result >= 61 && $result <= 70) {
                      $ratingtext = 'Okay';
                      $color = '#FFE135';
                  } elseif ($result >= 51 && $result <= 60) {
                      $ratingtext = 'Average';
                      $color = '#FFE135';
                  } elseif ($result >= 41 && $result <= 50) {
                      $ratingtext = 'Poor';
                      $color = 'red';
                  } elseif ($result >= 21 && $result <= 40) {
                      $ratingtext = 'Disappointing';
                      $color = 'red';
                  } else {
                      $ratingtext = 'Bad';
                      $color = 'red';
                  }

                
                ?>
                
                <div class="tr-ranting-percent">{{$result}}% @else -- @endif</div>
                <div class="tr-excellent" style="color:{{$color}}">{{$ratingtext}}</div>
              </div>
            </div>
          </div>
          <div class="tr-field-row">
            <div class="tr-field">
              <label class="tr-field-label" for="aboutPlace">About this place</label>
              <textarea placeholder="Type here" class="form-control" id="aboutPlace" name="" value=""></textarea>
            </div>
          </div>
          <div class="tr-field-row">
            <div class="tr-field">
              <label class="tr-field-label" for="suggestHours">Suggest the duration (Hours)</label>
              <input type="text" class="form-control" placeholder="2-3" id="suggestHours" name="" value="">
            </div>
          </div>
          <div class="tr-field-row">
            <div class="tr-field">
              <label class="tr-field-label" for="timing">Timing</label>
              <input type="text" class="form-control tr-timing-field" placeholder="Add open hours" id="timing" name="" value=""  data-bs-toggle="modal" data-bs-target="#timingChangeModal">
            </div>
          </div>
          <div class="tr-field-row">
            <div class="tr-field">
              <label class="tr-field-label" for="whatsNearBy">Whats nearby</label>
              <input type="text" class="form-control" id="whatsNearBy" name="" value="">
            </div>
          </div>
          <div class="tr-field-row">
            <div class="tr-field">
              <label class="tr-field-label" for=">WhatIsItKnownFor">What Is It Known For</label>
              <input type="text" class="form-control" id=">WhatIsItKnownFor" name="" value="">
            </div>
          </div>
          <div class="tr-field-row">
            <label class="tr-check-box">
              <input type="checkbox" id="" name="" value="">
              <span class="checkmark"></span>Long Island Restaurant
            </label>
          </div>
          <div class="tr-field-row">
            <label class="tr-check-box">
              <input type="checkbox" id="" name="" value="">
              <span class="checkmark"></span>Long Island Restaurant
            </label>
          </div>
          <div class="tr-field-row">
            <label class="tr-check-box">
              <input type="checkbox" id="" name="" value="">
              <span class="checkmark"></span>Long Island Restaurant
            </label>
          </div>
          <div class="tr-review-image">
            <label>Add some photos (optional)</label>
            <div class="tr-file-upload">
              <!--<button class="file-upload-btn" type="button" onclick="$('.file-upload-input').trigger( 'click' )">Add Image</button>-->
              <div class="tr-image-upload-wrap">
                <input class="tr-file-upload-input" type='file' onchange="readURL(this);" accept="image/*" />
                <div class="tr-drag-image">
                  <svg width="17" height="16" viewBox="0 0 17 16" fill="none" xmlns="http://www.w3.org/2000/svg"><g clip-path="url(#clip0_441_7517)"><path d="M15.8385 12.6667C15.8385 13.0203 15.6981 13.3594 15.448 13.6095C15.198 13.8595 14.8588 14 14.5052 14H2.50521C2.15159 14 1.81245 13.8595 1.5624 13.6095C1.31235 13.3594 1.17188 13.0203 1.17188 12.6667V5.33333C1.17188 4.97971 1.31235 4.64057 1.5624 4.39052C1.81245 4.14048 2.15159 4 2.50521 4H5.17188L6.50521 2H10.5052L11.8385 4H14.5052C14.8588 4 15.198 4.14048 15.448 4.39052C15.6981 4.64057 15.8385 4.97971 15.8385 5.33333V12.6667Z" stroke="#6A6A6A" stroke-linecap="round" stroke-linejoin="round"/><path d="M8.49479 11.3333C9.96755 11.3333 11.1615 10.1394 11.1615 8.66667C11.1615 7.19391 9.96755 6 8.49479 6C7.02203 6 5.82812 7.19391 5.82812 8.66667C5.82812 10.1394 7.02203 11.3333 8.49479 11.3333Z" stroke="#6A6A6A" stroke-linecap="round" stroke-linejoin="round"/></g><defs><clipPath id="clip0_441_7517"><rect width="16" height="16" fill="white" transform="translate(0.5)"/></clipPath></defs></svg>
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
          <div class="tr-actions">
            <button type="submit" class="tr-btn">Submit</button>
            <button type="button" class="tr-anchor-btn">Report Business as Closed</button>
          </div>
        </div>
      </div>
    </div> 
  </body>
</html>

<?php 
  
  if(!empty($searchresult)){
    $longitude = $searchresult[0]->Longitude;
    $latitude = $searchresult[0]->Latitude;
  
  }else{
    $longitude = 0;
    $latitude = 0;
  }

  ?>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous">
  </script>
 
 <script type="application/ld+json">
  {
    @if(!empty($faq))
    "@context": "https://schema.org",
    "@type": "FAQPage",
    "mainEntity": [

      @foreach($faq as $faqItem) {
        "@type": "Question",
        "name": "{{$faqItem->Faquestion}}",
        "acceptedAnswer": {
          "@type": "Answer",
          "text": "{{$faqItem->Answer}}"
        }
      }

      @endforeach

    ]
    @endif
  }
  </script>
  <script type="application/ld+json">
  @if(!empty($searchresult)) {
    "@context": "https://schema.org",
    "@type": "LocalBusiness",
    "name": "{{$searchresult[0]->Title}}",
	@if(!$Sight_image->isEmpty())
	  "image": [
		@php $count = 0; @endphp
		@foreach($Sight_image as $image)
		  @if(isset($image->Image) && $image->Image != '')
			"https://s3-us-west-2.amazonaws.com/s3-travell/Sight-images/{{$image->Image }}"

			<?php if ($count < $Sight_image->count() - 1) echo ','; ?>
			@php $count++; @endphp
		  @endif
		@endforeach
	  ],
	@endif

    "url": "",
    "address": {
      "@type": "PostalAddress",
      "streetAddress": "{{$searchresult[0]->Address}}"
    },
    @if(!empty($sightreviews)) 
    "aggregateRating": {
      "@type": "AggregateRating",
      "ratingValue": "@if($searchresult[0]->TAAggregateRating !="" && $searchresult[0]->TAAggregateRating !=0.00){{$searchresult[0]->TAAggregateRating}} @else not available @endif",
      "reviewCount": "@if(!$sightreviews->isEmpty()){{count($sightreviews)}}@endif"
    },
    @endif "openingHours": "",
    "email": "@if($searchresult[0]->Email != ""){{ $searchresult[0]->Email}} @endif",
    "telephone": "@if($searchresult[0]->Phone != ""){{ $searchresult[0]->Phone}} @endif",
    "sameAs": "@if($searchresult[0]->Website != "") {{ $searchresult[0]->Website}} @endif",
    @if(!$sightreviews->isEmpty())
    "review":[
      @foreach($sightreviews as $review)
    {
        "@type": "Review",
        "author": "{{$review->Name}}",
        "reviewBody": "{{$review->ReviewDescription}}"
    }@if(!$loop->last),@endif
    @endforeach
    ]
    @endif
  }
  @endif
  </script>


  <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
  <script src="{{ asset('/public/js/jquery3.6.js')}}"></script>


  <script src="{{ asset('/public/css/hotel-css/t-datepicker.min.js')}}"></script>
  <script src="{{ asset('/public/js/datepicker-homepage.js')}}"></script>

  <script src="{{ asset('/public/js/explore.js')}}"></script> 


<script type="text/javascript" src="{{ asset('/public/frontend/hotel-detail/js/common.js')}} "></script>


<script src="{{ asset('/public/js/map_leaflet.js')}}"></script>
  <script src="https://unpkg.com/leaflet-simple-map-screenshoter"></script>
  <script src="https://unpkg.com/file-saver/dist/FileSaver.js"></script>




  <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
  <script src="{{ asset('/public/js/custom.js')}}"></script>
<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
  <script>
  var mapOptions = {
    center: [{{ $latitude }}, {{ $longitude }}], // Use Blade echo to insert variables
    zoom: 10
  };

  var map = new L.map('map1', mapOptions);

    var layer = new L.TileLayer('https://{s}.basemaps.cartocdn.com/light_all/{z}/{x}/{y}{r}.png', {
      attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors &copy; <a href="https://carto.com/attributions">CARTO</a>',
      subdomains: 'abcd',
      maxZoom: 19
    });
    map.addLayer(layer);

  var customIcon = L.icon({
    iconUrl: '{{ asset("public/js/images/Hotel.svg") }}',
    iconSize: [62, 62], // Adjust the size as needed
    iconAnchor: [16, 32], // Adjust the anchor point if needed
  });

  var marker = L.marker([{{ $latitude }}, {{ $longitude }}], { // Correct Blade syntax
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

  <script>
  $(document).ready(function() {
    if (window.File && window.FileList && window.FileReader) {
      $("#files").on("change", function(e) {
        var files = e.target.files,
          filesLength = files.length;
        for (var i = 0; i < filesLength; i++) {
          var f = files[i]
          var fileReader = new FileReader();
          fileReader.onload = (function(e) {
            var file = e.target;
            $("<span class=\"pip\">" +
              "<img class=\"imageThumb\" src=\"" + e.target.result + "\" title=\"" + file.name + "\"/>" +
              "<br/><span class=\"remove remove-image\"></span>" +
              "</span>").insertAfter("#files");
            $(".remove").click(function() {
              $(this).parent(".pip").remove();
            });

          });
          fileReader.readAsDataURL(f);
        }
        console.log(files);
      });
    } else {
      alert("Your browser doesn't support to File API")
    }
  });
  </script>
  <script>
  $('.defaultsearchvalue2').click(function(e) {
    e.preventDefault();

    $('#explore-tab').removeClass('active');
    $('#explore-tab-pane').removeClass('active show');



    $('#profile-tab').addClass('active');
    $('#profile-tab-pane').addClass('active show');


  });


  $('.defaultsearch').click(function(e) {
    e.preventDefault();

    $('#profile-tab').removeClass('active');
    $('#profile-tab-pane').removeClass('active show');
    $('#explore-tab').addClass('active');
    $('#explore-tab-pane').addClass('active show');





  });
  </script>