<style>
.tr-more-facilities .paragraph-content {
    max-height: 92px; /* Set max height to 92 px */
    overflow: hidden;
    position: relative;
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


</style>
  <div class="tr-title-filter-section">
                <div class="tr-row">
                  <h1 class="d-none d-md-block">Showing hotels in {{$lname}}</h1>
                  <h1 class="d-block d-sm-block d-md-none">Top hotels</h1>
                  <div class="tr-share-section">
                    <a href="javascript:void(0);" class="tr-share" data-bs-toggle="modal"
                      data-bs-target="#shareModal">Share</a>
                  </div>
                </div>
                <div class="tr-row">
                  <p>{{$count_result}} results found</p>
                </div>
              </div>
              @if(!$searchresults->isEmpty())

  <?php $a = 1;?>
  @foreach($searchresults as $searchresult)
  <div class="tr-hotel-deatils">
    <div class="tr-hotal-image">
      <div id="roomSlider{{$a}}" class="carousel slide" data-bs-touch="false" data-bs-interval="false">
        <!-- Indicators/dots -->
        <div class="carousel-indicators">
          <button type="button" data-bs-target="#roomSlider{{$a}}" data-bs-slide-to="0" class="active">1</button>
          <button type="button" data-bs-target="#roomSlider{{$a}}" data-bs-slide-to="1">2</button>
          <button type="button" data-bs-target="#roomSlider{{$a}}" data-bs-slide-to="2">3</button>
        </div>
        <!-- The slideshow/carousel -->
        <div class="carousel-inner">
          <div class="carousel-item active">
            <img src="https://photo.hotellook.com/image_v2/crop/h{{ $searchresult->hotelid }}_0/520/460.jpg" alt="{{$searchresult->name}}">
          </div>
          <div class="carousel-item">
            <img src="https://photo.hotellook.com/image_v2/crop/h{{ $searchresult->hotelid }}_1/520/460.jpg" alt="{{$searchresult->name}}">
          </div>
          <div class="carousel-item">
            <img src="https://photo.hotellook.com/image_v2/crop/h{{ $searchresult->hotelid }}_2/520/460.jpg" alt="{{$searchresult->name}}">
          </div>
        </div>
        <!-- Left and right controls/icons -->
        <button class="carousel-control-prev" type="button" data-bs-target="#roomSlider{{$a}}"
          data-bs-slide="prev"><span class="carousel-control-prev-icon"></span></button>
        <button class="carousel-control-next" type="button" data-bs-target="#roomSlider{{$a}}"
          data-bs-slide="next"><span class="carousel-control-next-icon"></span></button>
      </div>
      <button class="tr-anchor-btn tr-save">Save</button>
    </div>
    <div class="tr-hotel-deatil">
      <div class="tr-heading-with-rating">
        <h2 class="hotel-name">
          <a href="{{ url('hd-'.$searchresult->slugid .'-' .$searchresult->id .'-'.strtolower( str_replace(' ', '_',  str_replace('#', '!',$searchresult->slug) )) ) }}"
            target="_blank">{{$searchresult->name}}</a>
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
      @if($searchresult->CityName !="")
        <div class="tr-hotel-location">{{$searchresult->CityName}}</div>
      @endif
      <div class="tr-like-review">
      @if($searchresult->rating !="")
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
            <div class="tr-more-facilities list-content">
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
          <div id="collapseTwo{{$a}}" class="accordion-collapse collapse" aria-labelledby="headingAmenities{{$a}}"
            data-bs-parent="#accordion{{$a}}">
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
                            @if($mnt['available'] == 1 && is_string($mnt['name'])) <!-- Only display the image if available and valid name -->
                                <img src="{{ asset('public/frontend/hotel-detail/images/amenities/'.trim($mnt['name']).'.svg') }}" >
                            @else
                                <img src="{{ asset('public/frontend/hotel-detail/images/amenities/wifi.svg') }}" >
                            @endif
                            <span>{{ $mnt['name'] }}</span> <!-- Display the amenity name -->
                        </li>
                    @endforeach
                </ul>
            @endif
            </div>
          </div>
          <div id="collapseThree{{$a}}" class="accordion-collapse collapse" aria-labelledby="headingThree{{$a}}"
            data-bs-parent="#accordion{{$a}}">
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
        <div class="tr-hotel-facilities">
            @if (!empty($amenities))
                <ul>
                    @foreach ($amenities as $mnt)
                        <li style="">
                           <span> {{ $mnt['name'] }}</span>
                        </li>
                    @endforeach
                </ul>
            @endif
        </div>
      </div>
       -->
      <div class="tr-view-availability">
       <button class="tr-btn tr-view-availability-btn"><span class="d-none d-md-block">Enter dates for price</span><span class="d-block d-sm-block d-md-none">View availability</span></button>
      </div>
    </div>
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

@if ($count_result > 30)
@if(!$searchresults->isEmpty())

{{ $searchresults->links('hotellist_pagg.default') }}
@endif

@endif
  @else
          <p>hotels not found.</p>
  @endif
  </div>
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


