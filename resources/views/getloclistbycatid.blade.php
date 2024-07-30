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

        <div class="card mb-50 card-img-scale border-0 overflow-hidden bg-transparent">
          <!-- Image and overlay -->
          <div class="card-img-scale-wrapper rounded-3">

            <!-- Image -->
      
            @if($searchresult->IsMustSee == 1) 
            
            <img src="{{asset('public/images/pinned.svg')}}" alt="" class="pinned">
            <!-- <img src="{{asset('public/images/unsplash_7T1KOFfE1aM.png')}}" class="card-img br-10 mb-12"
              alt="hotel image">             --> 
              <img src="{{asset('public/images/Hotel lobby.svg')}}" class="card-img br-10 mb-12"
              alt="hotel image">     
            @else
            <img src="{{asset('public/images/Hotellobby-nmustsee-compressed.svg')}}" class="card-img" alt="hotel image">

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
        @endforeach
    
    @else
      <li>No results found.</li>
      @endif