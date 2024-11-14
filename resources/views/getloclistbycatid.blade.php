

<?php $i = 1; $j = 0; ?>
@php
$markers = [];
@endphp

@if(!empty($searchresults))
@foreach($searchresults as $searchresult)
<div class="tr-museum attraction" onmouseover="highlightMarker(this)" onmouseout="unhighlightMarker(this)"
data-sid="{{$searchresult->SightId}}" data-ismustsee="{{$searchresult->IsMustSee}}">
 <!-- <div class="tr-heading-with-distance">
    <div class="tr-category">@if($searchresult->CategoryTitle !="") {{$searchresult->CategoryTitle}} @endif</div>
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
          <img loading="lazy" src="{{ asset('public/sight-images/'. $sighimgs->Image) }}" alt="" width="475"
            height="320">
        </div>
        <span class="imagepath_{{$j}} d-none">{{ asset('public/sight-images/'. $sightImages[0]->Image) }}</span>
        @endif
        @endforeach
        @endif

        @if($imgcount == 0)
        <!-- Show fallback image if no matching images were found -->
        <div class="carousel-item active">
          <img src="{{ asset('public/images/Hotel lobby.svg') }}" class="card-img br-10 mb-12" alt="hotel image"
            width="475" height="320">
        </div>
        <span class="imagepath_{{$j}} d-none">{{ asset('public/images/Hotel lobby.svg') }}</span>
        @endif

        @else

        @if(!$sightImages->isEmpty())
        @foreach($sightImages as $sighimgs)
        @if($sighimgs->Sightid == $searchresult->SightId)
        <?php $imgcount++; ?>
        <div class="carousel-item @if($imgcount == 1)active @endif">
          <img src="{{ asset('public/sight-images/'. $sighimgs->Image) }}" class="card-img br-10 mb-12"
            alt="hotel image" width="475" height="189">
        </div>
        <span class="imagepath_{{$j}} d-none">{{ asset('public/sight-images/'. $sightImages[0]->Image) }}</span>
        @endif
        @endforeach
        @endif

        @if($imgcount == 0)
        <!-- Show fallback image if no matching images were found -->
        <div class="carousel-item active">
          <img src="{{ asset('public/images/Hotellobby-nmustsee-compressed.svg') }}" class="card-img" alt="hotel image"
            width="475" height="189">
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

  </div>
</div>

@endforeach

@else
<li>No results found.</li>
@endif