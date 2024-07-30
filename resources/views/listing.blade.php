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
  @if(!empty($locationPatent)) @php $locationPatent = array_reverse($locationPatent); @endphp @endif
@php $month = date('F'); $year = date('Y'); $lname ="";  @endphp
@if(!empty($searchresults)) @php  $lname = $location_name @endphp  @endif 
  <title>Things to do in {{$lname}}@if(!empty($locationPatent)), @foreach($locationPatent as $location){{$location['Name']}}@if(!$loop->last),@endif @endforeach @endif– {{ $month }}, {{ $year }} - Travell</title>

<meta name="description" 
 content="Planning to visit {{$lname}}? Yaan will find you the top things to do in {{$lname}}@if(!empty($locationPatent)), @foreach ($locationPatent as $location){{$location['Name']}}@if(!$loop->last),@endif @endforeach @endif and plan your trip for you when visiting {{$lname}}.">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
  <!--  fontawesome -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
  <script src="https://kit.fontawesome.com/b73881b7c2.js" crossorigin="anonymous"></script> 


  <link rel="stylesheet" href="{{ asset('/public/css/style.css')}}">
  <link rel="stylesheet" href="{{ asset('/public/css/custom.css')}}">
	 <link rel="stylesheet" href="{{ asset('/public/css/map_leaflet.css')}}">

        <!-- nav css -->
  <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" /> 
  <link href="{{ asset('/public/css/hotel-css/t-datepicker.min.css')}}" rel="stylesheet" type="text/css">
  <link rel="stylesheet" href="{{ asset('/public/css/hotel-css/autoComplete.min.css')}}"> 
  <script src="{{ asset('/public/css/hotel-css/autoComplete.js')}}"></script>
      <!-- end nav css -->


  <!--<link rel="stylesheet" href="https://cdn.leafletjs.com/leaflet-0.7.3/leaflet.css" />-->

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
        "item": "@if(!empty($breadcumb)){{ route('search.results',[$breadcumb[0]->LocationId.'-'.strtolower($breadcumb[0]->Lslug).'-'.str_replace(' ','_',strtolower($breadcumb[0]->CountryName))]) }} @endif"
      },
    
      @if(!empty($locationPatents))
      @foreach($locationPatents as $location) {
        "@type": "ListItem",
        "position": {{$n}},
       
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
<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-PTHP3JH4"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->
 
    @include('Loc_nav.loc_navbar')
    <div class="container mt-3"> 
  <div class="container">
  <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
            @if(!empty($breadcumb))
              <ol class="breadcrumb">  
				  @if($breadcumb[0]->ccName !="")
				      <li class="breadcrumb-item active" aria-current="page">
        			 	 <a href="{{ route('explore_continent_list',[$breadcumb[0]->contid,$breadcumb[0]->ccName])}}" target="_blank"> {{$breadcumb[0]->ccName}}</a>
      			    </li> 
				  @endif
                <li class="breadcrumb-item">
                  <a
                    href="{{ route('explore_country_list',[$breadcumb[0]->CountryId,$breadcumb[0]->cslug])}}">
                    @if(!empty($breadcumb)) {{$breadcumb[0]->CountryName}} @endif</a>
                </li>

                @if(!empty($locationPatent))
                <?php
                $locationPatent = $locationPatent;
				  
                ?>
                @foreach ($locationPatent as $location)
                <li class="breadcrumb-item">
                <a
                    href="{{ route('search.results',[$location['LocationId'].'-'.strtolower($location['slug'])]) }}">
                    {{ $location['Name'] }}</a>
                </li>
                @endforeach
                @endif
                <li class="breadcrumb-item active" aria-current="page">{{$breadcumb[0]->LName}}</li>               
              </ol>
              @endif
            </nav>
           
    <div class="row justify-content-center flex-md-row">
      <div class="col-md-5">
		  <h1 class="fs24 fw-500 mb-16">    @if(!empty($searchresults)) Things to do in {{$lname}}  
      <!-- {{$searchresults[0]->LName}} -->
                                         @endif</h1>
        <div class="body mx-auto" align="center">
          <div class="explore-search" style="z-index: 2;">
            <div class="search-box-icon">
              <img src="{{asset('public/images/search.svg')}}" class="search-icon" alt="">
            </div>
            <!-- <input type="text" id="autocompleteFive" placeholder="Search a Restaurant" class="searchrest">
                        <ul id="results" class="autoCompletewrapper"></ul> -->
            <!-- <input id="autoCompletetwo" type="text" tabindex="1" placeholder="&#xF002; Search"> -->
            <input type="text" 
              placeholder="Where are you goining?" autocomplete="off" class="serch_sights" id="serch_sights">
           
          </div>
        </div>

        <div class="quick-searches mb-24" id="items-container">

          @if($ismustsee == 1)
       
            <div class="quick-search activ"><a href="javascript:void(0)" data-catid="mustsee"
                class="text-deco filter_sightbycat"> Must See </a></div>
     
          @endif
          @if($rest_avail == 1)
          <div class="slide">
            <div class="circle-search"><a href="javascript:void(0)" data-catid="isrestaurant" class="text-deco filter_sightbycat">
                Restuarents </a></div>
          </div>
          @endif
          @if(!empty($getSightCat))
          @foreach($getSightCat as $getSightCat)
        
            <div class="quick-search"><a href="javascript:void(0)" class="text-deco filter_sightbycat" data-name="{{$getSightCat->Title}}"
                data-catid="{{$getSightCat->CategoryId}}"> {{$getSightCat->Title}}</a></div>
          
          @endforeach
          @endif
        </div>
      

<?php $url = request()->route('id'); 
   $parts = explode('-', $url,2);
   $lastPart = $parts[1];
?>

        <span id="locid" class="d-none">@if(!empty($searchresults)) {{$searchresults[0]->LocationId}} @endif</span>

        <span id="slug" class="d-none"> {{$lastPart}}</span>
          <span class="d-none sightlist">sightlist</span>


<span id="getcatfilterdata">

<!-- new category session data -->
<?php  
$categoryArray = [];
$lid = request()->session()->get('locId');
$cloc = null;
if(!empty($searchresults)){
  $cloc = $searchresults[0]->LocationId;
}
if($lid == $cloc){
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
}

 //return print_r($categoryArray);
      ?>

@if(!empty($categoryArray) || request()->session()->has('mustSee'))

<div class="mb-24" id="">
    <div class="show-selected-cat">
      <span class="q-ch mb-3" style="display: inline-block;">
            <a href="javascript:void(0)" class="text-deco filter_sightbycat" data-clear_all="1">
            clear all filter
            </a>
        </span>
        @if(!empty($categoryArray))
        @foreach($categoryArray as $category)
        @if($category['name'] !="")
        <span class="q-ch mb-3" style="display: inline-block;">
            <a href="javascript:void(0)" class="text-deco" >
                {{$category['name']}}
            </a>
        </span>
        <span class="delete-icon filter_sightbycat" style="display: inline-block;" data-delcatid="{{$category['id']}}" title="Remove filter">&#10006;</span>
        @endif
        @endforeach
		@endif
		@if(request()->session()->has('IsRestaurant'))
		 <span class="q-ch mb-3" style="display: inline-block;">
            <a href="javascript:void(0)" class="text-deco" >
                Restaurant
            </a>
        </span>
        <span class="delete-icon filter_sightbycat" style="display: inline-block;" data-delcatid="IsRestaurant" title="Remove filter">&#10006;</span>
		
		@endif
			@if(request()->session()->has('mustSee'))
		 <span class="q-ch mb-3" style="display: inline-block;">
            <a href="javascript:void(0)" class="text-deco" >
                must See
            </a>
        </span>
        <span class="delete-icon filter_sightbycat" style="display: inline-block;" data-delcatid="mustsee" title="Remove filter">&#10006;</span>
		
		@endif
    </div>
</div>

@endif

<!-- end category sesstion data -->
    <?php $i = 1; $j = 0; ?>
    @php
    $markers = [];
    @endphp
 
@if(!empty($searchresults))
@foreach($searchresults as $searchresult)
   
	
        <div class="attraction mb-8" data-sid="{{$searchresult->SightId}}" data-ismustsee="{{$searchresult->IsMustSee}}">
          <svg xmlns="https://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 14 14" fill="none">
            <g clip-path="url(#clip0_1563_10259)">
              <path
                d="M0.4375 7C0.4375 8.74048 1.1289 10.4097 2.35961 11.6404C3.59032 12.8711 5.25952 13.5625 7 13.5625C8.74048 13.5625 10.4097 12.8711 11.6404 11.6404C12.8711 10.4097 13.5625 8.74048 13.5625 7C13.5625 5.25952 12.8711 3.59032 11.6404 2.35961C10.4097 1.1289 8.74048 0.4375 7 0.4375C5.25952 0.4375 3.59032 1.1289 2.35961 2.35961C1.1289 3.59032 0.4375 5.25952 0.4375 7Z"
                stroke="#6A6A6A" stroke-linecap="round" stroke-linejoin="round" />
              <path
                d="M7.39422 3.6015L8.25432 5.37383H9.92856C10.013 5.37087 10.0963 5.39397 10.1672 5.44001C10.2381 5.48604 10.293 5.55278 10.3246 5.63114C10.3563 5.70951 10.363 5.79571 10.3439 5.87803C10.3248 5.96035 10.2809 6.0348 10.218 6.09127L8.76461 7.60983L9.56984 9.46172C9.60493 9.54638 9.61264 9.6399 9.59189 9.72916C9.57114 9.81843 9.52298 9.89896 9.45415 9.95947C9.38532 10.02 9.29928 10.0574 9.2081 10.0666C9.11691 10.0757 9.02515 10.0561 8.94569 10.0104L6.99915 8.91507L5.0533 10.0125C4.97382 10.0584 4.88196 10.0782 4.79062 10.0692C4.69929 10.0602 4.61307 10.0228 4.54411 9.9622C4.47515 9.90164 4.4269 9.82099 4.40616 9.73158C4.38541 9.64218 4.39321 9.54852 4.42846 9.46378L5.23369 7.61188L3.78098 6.09127C3.71828 6.03492 3.67439 5.96066 3.65526 5.87854C3.63613 5.79643 3.64269 5.71042 3.67404 5.63216C3.70539 5.55389 3.76003 5.48714 3.83055 5.44094C3.90108 5.39474 3.9841 5.37131 4.06837 5.37383H5.74261L6.60477 3.6015C6.64222 3.52913 6.69885 3.46845 6.76847 3.42609C6.83808 3.38373 6.918 3.36133 6.99949 3.36133C7.08098 3.36133 7.1609 3.38373 7.23052 3.42609C7.30013 3.46845 7.35676 3.52913 7.39422 3.6015Z"
                stroke="#6A6A6A" stroke-linecap="round" stroke-linejoin="round" />
            </g>
            <defs>
              <clipPath id="clip0_1563_10259">
                <rect width="14" height="14" fill="white" />
              </clipPath>
            </defs>
          </svg>


          <span>
            Attraction
          </span>
          @if($searchresult->IsMustSee == 1)
          <svg xmlns="https://www.w3.org/2000/svg" width="5" height="6" viewBox="0 0 5 6" fill="none">
            <circle cx="2.5" cy="3" r="2.5" fill="#D9D9D9" />
          </svg>        
          <span>
            Must See
          </span>
          @endif

        </div>

        <div class="card mb-50 card-img-scale border-0 overflow-hidden bg-transparent" >
          <!-- Image and overlay -->
          <div class="card-img-scale-wrapper rounded-3" @if($searchresult->IsMustSee == 1) style="width: 509px; height: 310px; overflow: hidden; position: relative;"  @endif>

            <!-- Image -->
      
           @if($searchresult->IsMustSee == 1) 
            
            <img src="{{asset('public/images/pinned.svg')}}" alt="" class="pinned">            
              @if($searchresult->Image !="")  
                   <img src="{{ asset('public/sight-images/'. $searchresult->Image) }}" class="card-img br-10 mb-12" alt="hotel image" style="width: 100%; height: 100%; object-fit: cover; position: absolute; ">         
              @else
              <img src="{{asset('public/images/Hotel lobby.svg')}}" class="card-img br-10 mb-12" alt="hotel image">     
              @endif
            @else
               @if($searchresult->Image !="")  
                   <img src="{{ asset('public/sight-images/'. $searchresult->Image) }}" class="card-img br-10 mb-12" alt="hotel image">         
               @else
                  <img src="{{asset('public/images/Hotellobby-nmustsee-compressed.svg')}}" class="card-img" alt="hotel image">
                @endif
             @endif
          </div>   
               

              
          <!-- Card body -->
          <div class="">
            <!-- Title -->
         
            <div class="d-flex align-items-center justify-content-between" onmouseover="highlightMarker(this)" onmouseout="unhighlightMarker(this)">
            <!-- <input type="hidden" class="sid" value="{{$searchresult->SightId}}"> -->
            <span class="sid d-none">{{$searchresult->SightId}}</span>
				
				 <span class="sight d-none" data-sight-id="{{$searchresult->SightId}}">
            <span class="sname d-none">{{$searchresult->Title}}</span>
        
              <!-- get cat -->
               @if(!$searchresult->Sightcat->isEmpty())

              @foreach ($searchresult->Sightcat as $category)
                     
                <span  class="catname_<?php echo $j; ?> d-none">@if($category->Title !== "") {{ $category->Title }} @else notavail @endif</span>
              @endforeach
              @else
              <span  class="catname_<?php echo $j; ?> d-none">notavail</span>
              @endif
                  <!-- end cat -->

             @if(!empty($searchresult->timing))
              @foreach ($searchresult->timing as $tm)
                
                @if (!empty($tm->timings))
          
                <div class="text-secondary fs-sm-14"><i class="far fa-clock"></i></div>
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
                @if ($isOpen)
                    {{ $formatetime }}
                    <span  class="timing_<?php echo $j;?>"> Open Now</span>
                @else
                    <span class="timing_<?php echo $j;?>">Closed Today</span>
                @endif

                @else
                <span class="timing_<?php echo $j;?>"></span>
            @endif
        @endforeach
                
            @else
            <span class="timing_<?php echo $j;?>"></span>
            @endif
           {{ $searchresult->TAAggregateRating}}

            @if($searchresult->TAAggregateRating != "" && $searchresult->TAAggregateRating != 0)<?php $result = rtrim($searchresult->TAAggregateRating, '.0') * 20;  ?>                

                <span class="isrecomd_<?php echo $j;?> d-none"> {{$result}}%</span>

                @else 
                <span class="isrecomd_<?php echo $j;?> d-none"></span>
              @endif

            </span>

          <?php  $j++?>

            <!-- More sight elements... -->
              <a href="{{ asset('at-'.$searchresult->slugid.'-'.$searchresult->SightId.'-'.strtolower($searchresult->Slug)) }}"
                class="stretched-link text-decoration-none fs18 " target="_blank"><b>{{$searchresult->Title}}</b></a>
              <li class="d-flex align-items-center"><i class="fa  fa-heart" aria-hidden="true"></i>
                <span>     @if($searchresult->TAAggregateRating != "" && $searchresult->TAAggregateRating != 0)<?php $result = rtrim($searchresult->TAAggregateRating, '.0') * 20;  ?> 
                {{$result}}%  @else 
                  --
              @endif</span>
              </li>
            </div>
          
            <a href="" class="mb-12 d-block text-decoration-none text-neutral-2">{{$searchresult->Address}}</a>


          </div>
        </div>
		<!-- new data -->
		@if(!empty($restaurantdata) && is_array($restaurantdata) && in_array($searchresult->SightId, array_column($restaurantdata, 'SightId')))

        <div class="nearby-restaurant mb-20">
          <div class="attraction mb-15">
            <img src="{{asset('public/images/forks.svg')}}" alt="">
            <span>
              Restaurant
            </span>
          </div>

               
          <div class="row align-items-center">
			
            
     
            @foreach($restaurantdata as $resta)
       

            @if($resta['SightId'] == $searchresult->SightId)

    
            <div class="attraction mb-8">
          <svg xmlns="https://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 14 14" fill="none">
          <g clip-path="url(#clip0_1563_10259)">
            <path
              d="M0.4375 7C0.4375 8.74048 1.1289 10.4097 2.35961 11.6404C3.59032 12.8711 5.25952 13.5625 7 13.5625C8.74048 13.5625 10.4097 12.8711 11.6404 11.6404C12.8711 10.4097 13.5625 8.74048 13.5625 7C13.5625 5.25952 12.8711 3.59032 11.6404 2.35961C10.4097 1.1289 8.74048 0.4375 7 0.4375C5.25952 0.4375 3.59032 1.1289 2.35961 2.35961C1.1289 3.59032 0.4375 5.25952 0.4375 7Z"
              stroke="#6A6A6A" stroke-linecap="round" stroke-linejoin="round" />
            <path
              d="M7.39422 3.6015L8.25432 5.37383H9.92856C10.013 5.37087 10.0963 5.39397 10.1672 5.44001C10.2381 5.48604 10.293 5.55278 10.3246 5.63114C10.3563 5.70951 10.363 5.79571 10.3439 5.87803C10.3248 5.96035 10.2809 6.0348 10.218 6.09127L8.76461 7.60983L9.56984 9.46172C9.60493 9.54638 9.61264 9.6399 9.59189 9.72916C9.57114 9.81843 9.52298 9.89896 9.45415 9.95947C9.38532 10.02 9.29928 10.0574 9.2081 10.0666C9.11691 10.0757 9.02515 10.0561 8.94569 10.0104L6.99915 8.91507L5.0533 10.0125C4.97382 10.0584 4.88196 10.0782 4.79062 10.0692C4.69929 10.0602 4.61307 10.0228 4.54411 9.9622C4.47515 9.90164 4.4269 9.82099 4.40616 9.73158C4.38541 9.64218 4.39321 9.54852 4.42846 9.46378L5.23369 7.61188L3.78098 6.09127C3.71828 6.03492 3.67439 5.96066 3.65526 5.87854C3.63613 5.79643 3.64269 5.71042 3.67404 5.63216C3.70539 5.55389 3.76003 5.48714 3.83055 5.44094C3.90108 5.39474 3.9841 5.37131 4.06837 5.37383H5.74261L6.60477 3.6015C6.64222 3.52913 6.69885 3.46845 6.76847 3.42609C6.83808 3.38373 6.918 3.36133 6.99949 3.36133C7.08098 3.36133 7.1609 3.38373 7.23052 3.42609C7.30013 3.46845 7.35676 3.52913 7.39422 3.6015Z"
              stroke="#6A6A6A" stroke-linecap="round" stroke-linejoin="round" />
          </g>
          <defs>
            <clipPath id="clip0_1563_10259">
              <rect width="14" height="14" fill="white" />
            </clipPath>
          </defs>
        </svg>


        <span>
        Restaurant
        </span>

        </div>
            <div class="col-4 mb-3">  <a href="{{route('restaurant_detail',[$resta['slugid'].'-'.$resta['RestaurantId'].'-'.$resta['Slug']])}}"
                class=" text-decoration-none  " target="_blank"> <img src="{{asset('public/images/unsplash_QGPmWrclELg.png')}}" alt=""
                  class="restaurant-img w-100"></a></div>

            <div class="col-8 ps-2 d-flex align-items-start justify-content-between">


              <div>
                <div class="mb-4px fw-700">
                  <b> <a href="{{route('restaurant_detail',[$resta['slugid'].'-'.$resta['RestaurantId'].'-'.$resta['Slug']])}}"
                class=" text-decoration-none " target="_blank">
                      {{$resta['Title']}}</a></b>
                    
                
                    </div>
                <div class="text-neutral-2 mb-4px">{{$resta['Address']}}</div>
                <div class="text-neutral-2">{{$resta['PriceRange']}} </div>
              </div>


              <li class=" d-flex align-items-center fs12"><i class="fa fa-heart" aria-hidden="true"
                  style="margin-right: 6px;"></i>
                <span>89%</span>
              </li>
            </div>
            @endif
            @endforeach
          
        


          </div>



        </div>
    @endif
        <!-- end new data -->
        <!-- tt -->
		 

      @if(!empty($getexp) && is_array($getexp) && in_array($searchresult->SightId, array_column($getexp, 'SightId')))
      
        <div class="nearby-restaurant ">
          <div class="attraction mb-15">
            <img src="{{asset('public/images/forks.svg')}}" alt="">
            <span>
              Experience
            </span>
          </div>

               
          <div class="row align-items-center">
        
          @foreach($getexp as $expen)

         @if($expen['SightId'] == $searchresult->SightId)
          <div class="attraction mb-8">
            <svg xmlns="https://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 14 14" fill="none">
            <g clip-path="url(#clip0_1563_10259)">
              <path
                d="M0.4375 7C0.4375 8.74048 1.1289 10.4097 2.35961 11.6404C3.59032 12.8711 5.25952 13.5625 7 13.5625C8.74048 13.5625 10.4097 12.8711 11.6404 11.6404C12.8711 10.4097 13.5625 8.74048 13.5625 7C13.5625 5.25952 12.8711 3.59032 11.6404 2.35961C10.4097 1.1289 8.74048 0.4375 7 0.4375C5.25952 0.4375 3.59032 1.1289 2.35961 2.35961C1.1289 3.59032 0.4375 5.25952 0.4375 7Z"
                stroke="#6A6A6A" stroke-linecap="round" stroke-linejoin="round" />
              <path
                d="M7.39422 3.6015L8.25432 5.37383H9.92856C10.013 5.37087 10.0963 5.39397 10.1672 5.44001C10.2381 5.48604 10.293 5.55278 10.3246 5.63114C10.3563 5.70951 10.363 5.79571 10.3439 5.87803C10.3248 5.96035 10.2809 6.0348 10.218 6.09127L8.76461 7.60983L9.56984 9.46172C9.60493 9.54638 9.61264 9.6399 9.59189 9.72916C9.57114 9.81843 9.52298 9.89896 9.45415 9.95947C9.38532 10.02 9.29928 10.0574 9.2081 10.0666C9.11691 10.0757 9.02515 10.0561 8.94569 10.0104L6.99915 8.91507L5.0533 10.0125C4.97382 10.0584 4.88196 10.0782 4.79062 10.0692C4.69929 10.0602 4.61307 10.0228 4.54411 9.9622C4.47515 9.90164 4.4269 9.82099 4.40616 9.73158C4.38541 9.64218 4.39321 9.54852 4.42846 9.46378L5.23369 7.61188L3.78098 6.09127C3.71828 6.03492 3.67439 5.96066 3.65526 5.87854C3.63613 5.79643 3.64269 5.71042 3.67404 5.63216C3.70539 5.55389 3.76003 5.48714 3.83055 5.44094C3.90108 5.39474 3.9841 5.37131 4.06837 5.37383H5.74261L6.60477 3.6015C6.64222 3.52913 6.69885 3.46845 6.76847 3.42609C6.83808 3.38373 6.918 3.36133 6.99949 3.36133C7.08098 3.36133 7.1609 3.38373 7.23052 3.42609C7.30013 3.46845 7.35676 3.52913 7.39422 3.6015Z"
                stroke="#6A6A6A" stroke-linecap="round" stroke-linejoin="round" />
            </g>
            <defs>
              <clipPath id="clip0_1563_10259">
                <rect width="14" height="14" fill="white" />
              </clipPath>
            </defs>
          </svg>


          <span>
          Experience
          </span>
        
        </div>
          <div class="card mb-50 card-img-scale border-0 overflow-hidden bg-transparent">
            <!-- Image and overlay -->
			    <a href="@if($expen['viator_url'] !='') {{$expen['viator_url']}} @else {{route('experince',[$expen['slugid'].'-'.$expen['ExperienceId'].'-'.$expen['Slug']])}} @endif"
                  class=" text-decoration-none  " target="_blank">
            <div class="card-img-scale-wrapper rounded-3">     
                     <div class="hotel-gallery">

                      <div class="row overflow-borderradius position-relative">

                        <div class="col-lg-6 ">
                          @if($expen['Img1'] !="")
                          <img src="{{$expen['Img1']}}" class="h-100 p1" alt="hotel image">
                          @else
                          <img src="{{asset('public/images/Hotel lobby.svg')}}" class="h-100 p1" alt="hotel image">
                          @endif
                        </div>


                        <div class="col-lg-6 d-none d-md-inline-block">

                          <div class="row">

                            <div class=" p1">
                              @if($expen['Img2'] !="")
                              <img src="{{$expen['Img2']}}" alt="hotel image">
                              @else
                              <img src="{{asset('public/images/Hotel lobby.svg')}}" alt="hotel image">
                              @endif
                            </div>

                            <div class=" p1">
                              @if($expen['Img3'] !="")
                              <!-- <img src="{{ asset('public/images/image 3.png') }}" alt=""> -->
                              <img src="{{$expen['Img3']}}" alt="hotel image" style="width: 251px;">
                              @else
                              <img src="{{asset('public/images/Hotel lobby.svg')}}" alt="hotel image" style="width: 251px;">
                              @endif
                            </div>
                        

                        </div>


                      </div>


                      </div>

                      </div>
            </div>
</a>
            <!-- Card body -->
            <div class=""> 
              <!-- Title -->
              <div class="d-flex align-items-center justify-content-between">
              <a href="@if($expen['viator_url'] !='') {{$expen['viator_url']}} @else {{route('experince',[$expen['slugid'].'-'.$expen['ExperienceId'].'-'.$expen['Slug']])}} @endif"
                  class=" text-decoration-none  " target="_blank"> <b>{{$expen['Name']}}</b></a>
                <li class="d-flex align-items-center"><i class="fa  fa-heart" aria-hidden="true"></i>
                  <span>89%</span>
                </li>
              </div>

              <a href="" class=" d-block text-decoration-none text-neutral-2">7 Hours</a>

              <a href="" class="mb-12 d-block text-decoration-none text-neutral-2"> @if($expen['adult_price'] != "")From {{$expen['adult_price']}}
                per person
              @else Price not available. @endif
              </a>
              <p class="text-neutral-2">Distance from attraction {{round($expen['distance'],2)}} </p>


            </div>

          </div>
          @endif
          @endforeach
        
         


          </div>



        </div>
		 @endif
        <!-- tt -->
	  <!-- start hotel -->
	
		<!---end hotel ---->
        @endforeach
    
    @else
      <li>No results found.</li>
      @endif
        </span>
        <div id="loading" style="display: none;">
          <!-- Loading... -->
      </div>

    <!-- start restaurant and exp code -->
        <!-- <span class="get_result">

          <div class="nearby-restaurant mb-50">
            <div class="attraction mb-15">
              <img src="{{asset('public/images/forks.svg')}}" alt="">
              <span>
                Restaurant
              </span>
            </div>


            <div class="row align-items-center">
              @if(!$getrest->isEmpty())
              @foreach($getrest as $rest)
              <div class="attraction mb-8">
            <svg xmlns="https://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 14 14" fill="none">
            <g clip-path="url(#clip0_1563_10259)">
              <path
                d="M0.4375 7C0.4375 8.74048 1.1289 10.4097 2.35961 11.6404C3.59032 12.8711 5.25952 13.5625 7 13.5625C8.74048 13.5625 10.4097 12.8711 11.6404 11.6404C12.8711 10.4097 13.5625 8.74048 13.5625 7C13.5625 5.25952 12.8711 3.59032 11.6404 2.35961C10.4097 1.1289 8.74048 0.4375 7 0.4375C5.25952 0.4375 3.59032 1.1289 2.35961 2.35961C1.1289 3.59032 0.4375 5.25952 0.4375 7Z"
                stroke="#6A6A6A" stroke-linecap="round" stroke-linejoin="round" />
              <path
                d="M7.39422 3.6015L8.25432 5.37383H9.92856C10.013 5.37087 10.0963 5.39397 10.1672 5.44001C10.2381 5.48604 10.293 5.55278 10.3246 5.63114C10.3563 5.70951 10.363 5.79571 10.3439 5.87803C10.3248 5.96035 10.2809 6.0348 10.218 6.09127L8.76461 7.60983L9.56984 9.46172C9.60493 9.54638 9.61264 9.6399 9.59189 9.72916C9.57114 9.81843 9.52298 9.89896 9.45415 9.95947C9.38532 10.02 9.29928 10.0574 9.2081 10.0666C9.11691 10.0757 9.02515 10.0561 8.94569 10.0104L6.99915 8.91507L5.0533 10.0125C4.97382 10.0584 4.88196 10.0782 4.79062 10.0692C4.69929 10.0602 4.61307 10.0228 4.54411 9.9622C4.47515 9.90164 4.4269 9.82099 4.40616 9.73158C4.38541 9.64218 4.39321 9.54852 4.42846 9.46378L5.23369 7.61188L3.78098 6.09127C3.71828 6.03492 3.67439 5.96066 3.65526 5.87854C3.63613 5.79643 3.64269 5.71042 3.67404 5.63216C3.70539 5.55389 3.76003 5.48714 3.83055 5.44094C3.90108 5.39474 3.9841 5.37131 4.06837 5.37383H5.74261L6.60477 3.6015C6.64222 3.52913 6.69885 3.46845 6.76847 3.42609C6.83808 3.38373 6.918 3.36133 6.99949 3.36133C7.08098 3.36133 7.1609 3.38373 7.23052 3.42609C7.30013 3.46845 7.35676 3.52913 7.39422 3.6015Z"
                stroke="#6A6A6A" stroke-linecap="round" stroke-linejoin="round" />
            </g>
            <defs>
              <clipPath id="clip0_1563_10259">
                <rect width="14" height="14" fill="white" />
              </clipPath>
            </defs>
          </svg>


          <span>
          Restaurant
          </span>
        
        </div>
              <div class="col-4 mb-3"> <a href="{{route('restaurant_detail',[$rest->RestaurantId.'-'.$rest->Slug])}}"
                  class=" text-decoration-none  "> <img src="{{asset('public/images/unsplash_QGPmWrclELg.png')}}" alt=""
                    class="restaurant-img w-100"></a></div>

              <div class="col-8 ps-2 d-flex align-items-start justify-content-between">


                <div>
                  <div class="mb-4px fw-700">
                    <b> <a href="{{route('restaurant_detail',[$rest->RestaurantId.'-'.$rest->LocationId.'-'.$rest->Slug])}}"
                  class=" text-decoration-none  ">
                        {{$rest->Title}}</a></b>
                       
                  
                      </div>
                  <div class="text-neutral-2 mb-4px">{{$rest->Address}}</div>
                  <div class="text-neutral-2">{{$rest->PriceRange}} </div>
                </div>


                <li class=" d-flex align-items-center fs12"><i class="fa fa-heart" aria-hidden="true"
                    style="margin-right: 6px;"></i>
                  <span>89%</span>
                </li>
              </div>
              @endforeach
              @else
              <p>Restaurant not available.</p>
              @endif

            </div>



          </div>


          <div class="attraction mb-8">
            <svg xmlns="https://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 14 14" fill="none">
              <path
                d="M5.25 10.9375H8.75V12.9792C8.75 13.1339 8.68854 13.2822 8.57915 13.3916C8.46975 13.501 8.32138 13.5625 8.16667 13.5625H5.83333C5.67862 13.5625 5.53025 13.501 5.42085 13.3916C5.31146 13.2822 5.25 13.1339 5.25 12.9792V10.9375Z"
                stroke="#6A6A6A" stroke-width="0.875" stroke-linecap="round" stroke-linejoin="round" />
              <path d="M4.375 10.9375H9.625" stroke="#6A6A6A" stroke-width="0.875" stroke-linecap="round"
                stroke-linejoin="round" />
              <path d="M5.68677 10.9382L4.86719 8.8125" stroke="#6A6A6A" stroke-width="0.875" stroke-linecap="round"
                stroke-linejoin="round" />
              <path d="M8.3125 10.9382L9.13208 8.8125" stroke="#6A6A6A" stroke-width="0.875" stroke-linecap="round"
                stroke-linejoin="round" />
              <path
                d="M1.75 4.8125C1.75 5.38703 1.8858 5.95594 2.14963 6.48674C2.41347 7.01754 2.80018 7.49984 3.28769 7.90609C3.7752 8.31235 4.35395 8.63461 4.99091 8.85447C5.62787 9.07434 6.31056 9.1875 7 9.1875C7.68944 9.1875 8.37213 9.07434 9.00909 8.85447C9.64605 8.63461 10.2248 8.31235 10.7123 7.90609C11.1998 7.49984 11.5865 7.01754 11.8504 6.48674C12.1142 5.95594 12.25 5.38703 12.25 4.8125C12.25 4.23797 12.1142 3.66906 11.8504 3.13826C11.5865 2.60746 11.1998 2.12516 10.7123 1.71891C10.2248 1.31265 9.64605 0.990391 9.00909 0.770527C8.37213 0.550663 7.68944 0.4375 7 0.4375C6.31056 0.4375 5.62787 0.550663 4.99091 0.770527C4.35395 0.990391 3.7752 1.31265 3.28769 1.71891C2.80018 2.12516 2.41347 2.60746 2.14963 3.13826C1.8858 3.66906 1.75 4.23797 1.75 4.8125Z"
                stroke="#6A6A6A" stroke-width="0.875" stroke-linecap="round" stroke-linejoin="round" />
              <path
                d="M4.375 4.8125C4.375 5.97282 4.65156 7.08562 5.14384 7.90609C5.63613 8.72656 6.30381 9.1875 7 9.1875C7.69619 9.1875 8.36387 8.72656 8.85615 7.90609C9.34844 7.08562 9.625 5.97282 9.625 4.8125C9.625 3.65218 9.34844 2.53938 8.85615 1.71891C8.36387 0.898436 7.69619 0.4375 7 0.4375C6.30381 0.4375 5.63613 0.898436 5.14384 1.71891C4.65156 2.53938 4.375 3.65218 4.375 4.8125Z"
                stroke="#6A6A6A" stroke-width="0.875" stroke-linecap="round" stroke-linejoin="round" />
            </svg>
            <span>
              Experience
            </span>
          </div>

          @if(!$experience->isEmpty())
          @foreach($experience as $exp)
          <div class="attraction mb-8">
            <svg xmlns="https://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 14 14" fill="none">
            <g clip-path="url(#clip0_1563_10259)">
              <path
                d="M0.4375 7C0.4375 8.74048 1.1289 10.4097 2.35961 11.6404C3.59032 12.8711 5.25952 13.5625 7 13.5625C8.74048 13.5625 10.4097 12.8711 11.6404 11.6404C12.8711 10.4097 13.5625 8.74048 13.5625 7C13.5625 5.25952 12.8711 3.59032 11.6404 2.35961C10.4097 1.1289 8.74048 0.4375 7 0.4375C5.25952 0.4375 3.59032 1.1289 2.35961 2.35961C1.1289 3.59032 0.4375 5.25952 0.4375 7Z"
                stroke="#6A6A6A" stroke-linecap="round" stroke-linejoin="round" />
              <path
                d="M7.39422 3.6015L8.25432 5.37383H9.92856C10.013 5.37087 10.0963 5.39397 10.1672 5.44001C10.2381 5.48604 10.293 5.55278 10.3246 5.63114C10.3563 5.70951 10.363 5.79571 10.3439 5.87803C10.3248 5.96035 10.2809 6.0348 10.218 6.09127L8.76461 7.60983L9.56984 9.46172C9.60493 9.54638 9.61264 9.6399 9.59189 9.72916C9.57114 9.81843 9.52298 9.89896 9.45415 9.95947C9.38532 10.02 9.29928 10.0574 9.2081 10.0666C9.11691 10.0757 9.02515 10.0561 8.94569 10.0104L6.99915 8.91507L5.0533 10.0125C4.97382 10.0584 4.88196 10.0782 4.79062 10.0692C4.69929 10.0602 4.61307 10.0228 4.54411 9.9622C4.47515 9.90164 4.4269 9.82099 4.40616 9.73158C4.38541 9.64218 4.39321 9.54852 4.42846 9.46378L5.23369 7.61188L3.78098 6.09127C3.71828 6.03492 3.67439 5.96066 3.65526 5.87854C3.63613 5.79643 3.64269 5.71042 3.67404 5.63216C3.70539 5.55389 3.76003 5.48714 3.83055 5.44094C3.90108 5.39474 3.9841 5.37131 4.06837 5.37383H5.74261L6.60477 3.6015C6.64222 3.52913 6.69885 3.46845 6.76847 3.42609C6.83808 3.38373 6.918 3.36133 6.99949 3.36133C7.08098 3.36133 7.1609 3.38373 7.23052 3.42609C7.30013 3.46845 7.35676 3.52913 7.39422 3.6015Z"
                stroke="#6A6A6A" stroke-linecap="round" stroke-linejoin="round" />
            </g>
            <defs>
              <clipPath id="clip0_1563_10259">
                <rect width="14" height="14" fill="white" />
              </clipPath>
            </defs>
          </svg>


          <span>
          Experience
          </span>
        
        </div>
          <div class="card mb-50 card-img-scale border-0 overflow-hidden bg-transparent">
          
            <div class="card-img-scale-wrapper rounded-3">

              <img src="{{ asset('public/images/pinned.svg') }}" alt="" class="pinned">
             
              <img src="{{ asset('public/images/image 24.png') }}" class="card-img br-10 mb-12" alt="hotel image">

            </div>

        
            <div class="">
             
              <div class="d-flex align-items-center justify-content-between">
              <a href="{{route('restaurant_detail',[$exp->ExperienceId.'-'.$exp->LocationId.'-'.$exp->Slug])}}"
                  class=" text-decoration-none  "> <b>{{$exp->Name}}</b></a>
                <li class="d-flex align-items-center"><i class="fa  fa-heart" aria-hidden="true"></i>
                  <span>89%</span>
                </li>
              </div>

              <a href="" class=" d-block text-decoration-none text-neutral-2">7 Hours</a>

              <a href="" class="mb-12 d-block text-decoration-none text-neutral-2"> @if($exp->adult_price != "")From {{$exp->adult_price}}
                per person
              @else Price not available. @endif
              </a>


            </div>

          </div>
          @endforeach
          @else
          <p>Experience not available.</p>
          @endif -->
<!-- nearby hotel -->

          <!-- end nearby hotel -->
			
		          <!-- start about -->
                <hr>
          <div class="about py-4  mb-5">
                <h5 class="mb-4  fs-22 ">About The Location</h5>
			    @if(!empty($searchresults))
				  @if($searchresults[0]->About != "")
					<?php
					// Assume $searchresults[0]->About contains the full content
					$fullContent = $searchresults[0]->About;
					$shortenedContent = implode(' ', array_slice(str_word_count($fullContent, 2), 0, 100));
				  ?>
				  <span id="aboutContent" style="display: inline;"><?php echo $shortenedContent; ?></span>
				  <span id="moreContent" style="display: none;"><?php echo substr($fullContent, strlen($shortenedContent)); ?></span>
				  <br>
				  <button onclick="toggleContent()" class="show-btn btn btn-outline-secondary btn-dark-outline mt-md-80px" style="float: right;">Show More</button>
				  @else
					Not available.
				  @endif
			  @endif
			


              </div>

          <!-- end nearby hotel -->
          <div class="white">
      <div class="col-md-12" id="faqdata">
        <div class="asked-questions py-4 border-top">

          @if(!empty($searchresults))
          <h5 class="mb-3 heading fs-26">Frequently Asked Questions about {{$lname}}</h5>

          @foreach($faq as $value)
          <?php $listing = json_decode($value->listing, true); ?>
          <div class="question py-3">
            <h6 class="fs-18">
              <span>Q.{{$value->Question}}?</span>
            </h6>

            <div class="mb-0">
              <div>
                <p>A.{{$value->Answer}}</p>

                @if(!empty($listing ))
                <ul style=" margin-left: 29px;">
                  @foreach ($listing as $index => $item)
                  <?php $name = $item['name'];
          $url = $item['url']; ?>

                  <li>
                  <a href="{{ asset('at-'. $value->slugid.'-'.$url) }}" target="_blank"> {{$name}}</a>@if($index < count($listing)-1)<span
                      class="d-none" >,</span>@endif
                  </li>
                  @endforeach
                </ul>
                @endif
              </div>
            </div>

            <!-- <a href="#" class="text-dark">See all nearby attractions.</a> -->
          </div>
          @endforeach
        </div>
     
        @endif


      </div>

    </div>
      </div>
      </span>
      <div class="col-md-7">
      @if(!empty($searchresults))
        <div class="mapsticky">
          <div id="map1" class="listmap" style="width: 100%; height: 1000px"></div>
        </div>
       @endif 
      </div>




    </div>
  </div>
  </div>
 <!-- start footer  -->
   @include('footer')
  <!-- end footer  -->



  <script src="https://code.jquery.com/jquery-3.6.0.js"></script>

<script type="application/ld+json">
@if(!empty($searchresults))
{
  "@context": "https://schema.org",
  "@type": "ItemList",
  "name":  "Things to do in {{$searchresults[0]->LName}}",
  "description": "300+ Things to do in {{$searchresults[0]->LName}}, {{ $searchresults[0]->CountryName }}",
  "ItemListOrder": "https://schema.org/ItemListOrderAscending",
  "itemListElement": [
    @forelse($searchresults as $searchresult) {
      "@type": "ListItem",
      "position": "{{ $loop->index + 1 }}",
      "name": "{{ $searchresult->CategoryTitle }}",
      "url": "{{ asset('at-' . $searchresult->LocationId . '-' . $searchresult->SightId . '-' . strtolower($searchresult->Slug)) }}",
      "image": "{{ asset('/public/images/park.jpg') }}"
    }
    @if(!$loop -> last), @endif
    @empty
    // Handle empty search results
    @endforelse
  ]
}
@endif
</script>
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "FAQPage",
  "mainEntity": [
    @if(!empty($faq))
    @foreach($faq as $faqItem)
    <?php $listing = json_decode($faqItem->listing, true); ?> {
      "@type": "Question",
      "name": "{{$faqItem->Question}}",
      "acceptedAnswer": {
        "@type": "Answer",
        "text": "{{$faqItem->Answer}} @if(!empty($listing)) @foreach ($listing as $index => $listingItem) {{$listingItem['name']}} @if($index < count($listing)-1) , @endif @endforeach @endif"
      }
    }
    @if(!$loop->last),
    @endif
    @endforeach
    @endif
  ]
}
</script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
  <script src="{{ asset('/public/js/jquery.min.js')}}"></script> 

  <script src="{{ asset('/public/js/restaurant.js')}}"></script> 
  <script src="{{ asset('/public/js/header.js')}}"></script>  
  <!--map-->
  <script src="{{ asset('/public/js/map_leaflet.js')}}"></script>
  <!--nav bar-->
  <script src="{{ asset('/public/js/index.js')}}"></script>
  <script src="{{ asset('/public/css/hotel-css/t-datepicker.min.js')}}"></script>
  <script src="{{ asset('/public/js/datepicker-homepage.js')}}"></script>
  
  <script src="{{ asset('/public/js/custom.js')}}"></script>

  <script>
var locations = [];
<?php foreach ($searchresults as $result): ?>
  <?php if (!empty($result->Latitude) && !empty($result->Longitude)): ?>
    locations.push([<?php echo $result->Latitude; ?>, <?php echo $result->Longitude; ?>]);
  <?php endif; ?>
<?php endforeach; ?>

// Set default center to a location in Europe
var defaultCenter = [48.8566, 2.3522];
var center = locations.length > 0 ? locations[0] : defaultCenter;

var mapOptions = {
  center: center,
  zoom: 9
};

var map = new L.map('map1', mapOptions);
var layer = new L.TileLayer('https://{s}.tile.openstreetmap.fr/hot/{z}/{x}/{y}.png');
map.addLayer(layer);

var markers = {};

<?php for ($i = 0; $i < count($searchresults); $i++): ?>
  <?php if (!empty($searchresults[$i]->Latitude) && !empty($searchresults[$i]->Longitude)): ?>
    var name<?php echo $i; ?> = '<?php echo addslashes($searchresults[$i]->Title); ?>'; 
    var isRecommend<?php echo $i; ?> = document.querySelector('.isrecomd_<?php echo $i; ?>').textContent;
    var category<?php echo $i; ?> = document.querySelector('.catname_<?php echo $i; ?>').textContent.trim();

    if (category<?php echo $i;?> === 'notavail') {
      category<?php echo $i;?> = ''; // Assign an empty string
    }

    var timing<?php echo $i;?> = document.querySelector('.timing_<?php echo $i;?>').textContent;

    var marker<?php echo $i; ?> = new L.Marker([<?php echo $searchresults[$i]->Latitude; ?>, <?php echo $searchresults[$i]->Longitude; ?>]);
    marker<?php echo $i; ?>.addTo(map);
    marker<?php echo $i; ?>.on('mouseover', function(e) {
      showTestName(e, name<?php echo $i; ?>, isRecommend<?php echo $i; ?>, category<?php echo $i; ?>, timing<?php echo $i; ?>);
    });
    marker<?php echo $i; ?>.on('mouseout', function(e) {
      map.closePopup(); 
    });
    markers[<?php echo $searchresults[$i]->SightId; ?>] = marker<?php echo $i; ?>;
  <?php endif; ?>
<?php endfor; ?>

function showTestName(e, name, isRecommend, category, timing) {
  var marker = e.target;
  var popupContent = '<strong>' + name + '</strong>' + "<br>Recommend: " + isRecommend + "<br>" + category + "<br>" + timing;
  marker.bindPopup(popupContent, { offset: L.point(0, -20) }).openPopup(); 
}

// Function to find the parent element with a specific class
function findParentWithClass(element, className) {
  while ((element = element.parentElement) && !element.classList.contains(className));
  return element;
}

<?php
	   $lolat = null;
	   $loLongitude = null;
	  if(!empty($searchresults)){
	    $lolat = $searchresults[0]->loc_latitude;  
        $loLongitude = $searchresults[0]->loc_longitude; 
	  }
	 
?>
// Define the specific location
var specificLocation = [<?php echo $lolat; ?>, <?php echo $loLongitude; ?>];

// Create bounds array for markers
var bounds = [];
for (var i = 0; i < locations.length; i++) {
    bounds.push([locations[i][0], locations[i][1]]);
}

// Check if bounds is empty
if (bounds.length === 0) {
    // Set the specific location as the map view
    map.setView(specificLocation,10);
} else {
    // Zoom the map to fit all markers
    map.fitBounds(bounds);
}

  </script>

  <script>
 function highlightMarker(element) {
  var sid = element.querySelector(".sid").textContent;

  var attractionElements = document.querySelectorAll('.attraction');
  attractionElements.forEach(function(element) {
    var sid = element.getAttribute('data-sid');
    var marker = markers[sid];

    if (marker) {
      marker.setIcon(
        L.icon({
          iconUrl: '{{asset('public/js/images/marker-icon.png')}}',
          iconSize: [25, 41],
        })
      );
    }
  });

  var marker = markers[sid];

  if (marker) {
    marker.setIcon(
      L.icon({
        iconUrl: '{{asset('public/js/images/highlight-loc.png')}}',
        iconSize: [52, 53],
      })
    );
  } 
}

function unhighlightMarker(element) {
  var sid = element.querySelector(".sid").textContent;
  var marker = markers[sid];

  if (marker) {
    marker.setIcon(
      L.icon({
        iconUrl: '{{asset('public/js/images/marker-icon.png')}}', 
        iconSize: [25, 41], 
      })
    );
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
            iconUrl: '{{asset('public/js/images/highlight-loc.png')}}',
            iconSize: [52, 53],
          })
        );
      } 
    }
  });

}


window.onload = function () {
  updateMarkerIcons();
};
//[28, 53]



  </script>




  <script>
  $(document).ready(function() {
    $('input').val('')
  });

  $('.bloglistingcarousel').each(function() {
    var slider = $(this);
    slider.slick({
      dots: true,
      autoplay: true,
      autoplaySpeed: 5000,
      mobileFirst: true,
      arrows: false,
      responsive: [{
        breakpoint: 480,
        settings: "unslick"
      }]
    });

  });


  $(document).ready(function() {
    $('.review-category>div').click(function() {
      $('.review-category>div').removeClass("active");
      $(this).addClass("active");
    });
  });

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


  var a = document.querySelectorAll(".quick-search");
  for (var i = 0, length = a.length; i < length; i++) {
    a[i].onclick = function() {
      var b = document.querySelector(".quick-search.active");
      if (b) b.classList.remove("active");
      this.classList.add('active');
    };
  }
  </script>

  <script>
  /* 
  this is an implementation of Wes Bos click & drag scroll algorythm. In his video, he shows how to do the horizontal scroll. I have implemented the vertical scroll for those wondering how to make it as well.
  
  Wes Bos video:
    https://www.youtube.com/watch?v=C9EWifQ5xqA
*/
  const container = document.querySelector('#items-container');

  let startY;
  let startX;
  let scrollLeft;
  let scrollTop;
  let isDown;

  container.addEventListener('mousedown', e => mouseIsDown(e));
  container.addEventListener('mouseup', e => mouseUp(e))
  container.addEventListener('mouseleave', e => mouseLeave(e));
  container.addEventListener('mousemove', e => mouseMove(e));

  function mouseIsDown(e) {
    isDown = true;
    startY = e.pageY - container.offsetTop;
    startX = e.pageX - container.offsetLeft;
    scrollLeft = container.scrollLeft;
    scrollTop = container.scrollTop;
  }

  function mouseUp(e) {
    isDown = false;
  }

  function mouseLeave(e) {
    isDown = false;
  }

  function mouseMove(e) {
    if (isDown) {
      e.preventDefault();
      //Move vertcally
      const y = e.pageY - container.offsetTop;
      const walkY = y - startY;
      container.scrollTop = scrollTop - walkY;

      //Move Horizontally
      const x = e.pageX - container.offsetLeft;
      const walkX = x - startX;
      container.scrollLeft = scrollLeft - walkX;

    }
  }
  </script>
     <script>
   // $('.clickingexplore').click(function (e) { 
    //    e.preventDefault();
    //  $('.navbar .nav-tabs').addClass('nav-tabsactive');
   // });
</script>
<script>
        $('.defaultsearchvalue2').click(function (e) {
            e.preventDefault();
          
            $('#explore-tab').removeClass('active');
            $('#explore-tab-pane').removeClass('active show');


            
            $('#profile-tab').addClass('active');
            $('#profile-tab-pane').addClass('active show');

            
        });


        $('.defaultsearch').click(function (e) {
            e.preventDefault();
          
            $('#profile-tab').removeClass('active');
            $('#profile-tab-pane').removeClass('active show');
            $('#explore-tab').addClass('active');
            $('#explore-tab-pane').addClass('active show');


            

            
        });
    </script>
</body>

</html>