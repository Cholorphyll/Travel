      <div class="d-flex  align-items-center justify-content-between">
        <h6 class="mb-0 fs-18">Things To Do</h6>
        <!-- <a href="#" class="text-dark see-all">See All</a> -->
      </div>
      @if(!empty($nearbyatt)) <p class="mb-3 distance">50+ within {{$nearbyatt[0]->radius}} km</p> @endif




      @if(!empty($nearbyatt))
      @foreach($nearbyatt as $nearbyatt)
      <div class="col-6 mb-3">
        <div class="">
          <div class="img-box position-relative">
            <i class="fas fa-bookmark position-absolute text-secondary"></i>
             <a href="{{route('sight.details',[$nearbyatt->LocationId.'-'.$nearbyatt->SightId.'-'.$nearbyatt->Slug])}}">    <img src=" {{ asset('/public/images/park.jpg') }}" class="w-100 b-20" alt="hol2"></a>
          </div>
          <div class="d-flex justify-content-between align-items-center my-2">
            <span class="text-secondary fs-sm-12 m--5">
              {{ $nearbyatt->ctitle}}
            </span>
            <div class="border rounded-pill px-lg-3 px-1 rating  py-lg-1">
              <!-- <i class="fas fa-heart text-main me-lg-3 me-1"></i><span class=" fs-18 fs-sm-14">98%</span> -->

              @if($nearbyatt->TAAggregateRating != "" && $nearbyatt->TAAggregateRating != 0)
              <?php $result = rtrim($nearbyatt->TAAggregateRating, '.0') * 20;  ?>

              <i class="fas fa-heart text-main me-lg-3 me-1"></i><span class=" fs-18 fs-sm-14">
                <span> {{$result}}% </span>

                @else


                <i class="fas fa-heart text-main me-lg-3 me-1"></i><span class="fs-18 fs-sm-14">--</span>
                @endif
            </div>
          </div>
          <h6 class=" d-lg-flex justify-content-between align-items-center fs-18">
          <a href="{{route('sight.details',[$nearbyatt->LocationId.'-'.$nearbyatt->SightId.'-'.$nearbyatt->Slug])}}"> 
							  <span class=fs-sm-16>{{$nearbyatt->Title}}</span>
							</a>

          </h6>
          <p class="fs-sm-14 mb-0">T{{$nearbyatt->Address}}</p>
          <div class="d-lg-flex justify-content-between align-items-center">


            @if(!empty($nearbyatt->timings))
            <div class="text-secondary fs-sm-14"><i class="far fa-clock    "></i></div>
            <?php 

                        $currentDay = strtolower(date('D'));
                        $schedule = json_decode($nearbyatt->timings,true);
                        if(isset($schedule['time'][$currentDay])){
                          $openingtime = $schedule['time'][$currentDay]['start'];
                          $closingTime =$schedule['time'][$currentDay]['end'];

                          if($openingtime == '00:00' && $closingTime == "23:59"){
                              $formatetime = "12:00 AM - 11:59";
                          }else{
                              $formatetime = $openingtime.' - '.$closingTime;
                          }
                          $isOpen = true;                          

                        }else{
                          $isOpen = false;
                        }
                          
                          ?>
            @if($isOpen)
            {{$formatetime}}

            <div class="text-main fs-sm-14">Open Now</div>

            @else

            <div class="text-main fs-sm-14">Closed Today</div>
            @endif
            @endif
          </div>
        </div>
      </div>
      @endforeach
      @else
      <p>Nearby Attractions not found.</p>
      @endif