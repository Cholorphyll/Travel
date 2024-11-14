@if(!$searchresults->isEmpty())
	<?php $a = 1;?>
	<span class="d-none page_type">filter</span>
	@foreach($searchresults as $searchresult)
	<div class="tr-hotel-deatils">
	  <div class="tr-hotal-image">
			<div id="roomSlider{{$a}}" class="carousel slide" data-bs-ride="carousel">
			  <!-- Indicators/dots -->
			  <div class="carousel-indicators">
				<button type="button" data-bs-target="#roomSlider{{$a}}" data-bs-slide-to="0" class="active">1</button>
				<button type="button" data-bs-target="#roomSlider{{$a}}" data-bs-slide-to="1">2</button>
				<button type="button" data-bs-target="#roomSlider{{$a}}" data-bs-slide-to="2">3</button>
			  </div>
			  <!-- The slideshow/carousel -->
			  <div class="carousel-inner">
				<div class="carousel-item active">
				  <img src="https://photo.hotellook.com/image_v2/limit/h{{ $searchresult->hotelid }}_0/260/231.jpg" alt="">
				</div>
				<div class="carousel-item">
				  <img src="https://photo.hotellook.com/image_v2/limit/h{{ $searchresult->hotelid }}_1/260/231.jpg" alt="">
				</div>
				<div class="carousel-item">
				  <img src="https://photo.hotellook.com/image_v2/limit/h{{ $searchresult->hotelid }}_2/260/231.jpg" alt="">
				</div>
			  </div>
			  <!-- Left and right controls/icons -->
			  <button class="carousel-control-prev" type="button" data-bs-target="#roomSlider{{$a}}" data-bs-slide="prev"><span class="carousel-control-prev-icon"></span></button>
			  <button class="carousel-control-next" type="button" data-bs-target="#roomSlider{{$a}}" data-bs-slide="next"><span class="carousel-control-next-icon"></span></button>
			</div>
			<button class="tr-anchor-btn tr-save">Save</button>
	  </div>

	  <div class="tr-hotel-deatil">
			<div class="tr-heading-with-rating">
				<?php  $hurl = url('hd-'.$searchresult->slugid.'-' .$searchresult->id .'-'.strtolower( str_replace(' ', '_',  str_replace('#', '!',$searchresult->slug) )) ).'?checkin='.$chkin.'&checkout='.$checout;?>
		  	<h2><a href="{{ $hurl }}" target="_blank">{{$searchresult->name}}</a></h2>
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
			  		<path fill-rule="evenodd" clip-rule="evenodd" d="M5.99604 2.28959C5.02968 1.20745 3.41823 0.916356 2.20745 1.90727C0.996677 2.89818 0.826217 4.55494 1.77704 5.7269L5.99604 9.63412L10.215 5.7269C11.1659 4.55494 11.0162 2.88776 9.78463 1.90727C8.55304 0.92678 6.96239 1.20745 5.99604 2.28959Z" fill="white" stroke="white" stroke-linecap="round" stroke-linejoin="round"></path>
					</svg>
		  	</div>
		  	<div class="tr-ranting-percent">{{$result}}% </div>
		  	<div class="tr-vgood" style="color:{{$color}};background: {{$bgcolor}};">{{$ratingtext}}</div>
		  	@endif
			</div>
			 <div class="tr-hotel-facilities">
                    <?php
                        // Step 2: Define your selected amenities by name
                        $selectedAmenities = ['A/C', 'Parking', 'Wi-Fi', 'Laundry', 'Smoke-free', 'Pool', 'Gym', 'Food', 'Pets', 'Bar', 'Spa']; // Replace with names of your selected 15-20 amenities

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
                                    @if($mnt['available'] == 1 && is_string($mnt['name']))
                                        <img src="{{ asset('public/frontend/hotel-detail/images/amenities/'.trim($mnt['name']).'.svg') }}" >
                                    @else
                                        <img src="{{ asset('public/frontend/hotel-detail/images/amenities/wifi.svg') }}" >
                                    @endif
                                    <span> {{ $mnt['name'] }}</span> <!-- Display the amenity name -->
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </div>

			<div class="tr-more-facilities">
				@if($searchresult->short_description !="")
				<ul>
					<?php
					$short_description =[];

					$short_description =  explode('^',$searchresult->short_description);
					$b =0;
					?>
					@foreach($short_description as $data)
					@if($b != 0)
					<li>{{$data}} </li>
					@endif
					<?php $b++; ?>
					@endforeach
				</ul>
				@endif
			</div>
	  </div>

	  <div class="tr-hotel-price-section">
		 	<!--
		 	<div class="tr-deal tr-offer-alert">
			<svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
				<path d="M13.7263 8.9387L8.94634 13.7187C8.82251 13.8427 8.67546 13.941 8.5136 14.0081C8.35173 14.0752 8.17823 14.1097 8.00301 14.1097C7.82779 14.1097 7.65429 14.0752 7.49242 14.0081C7.33056 13.941 7.18351 13.8427 7.05967 13.7187L1.33301 7.9987V1.33203H7.99967L13.7263 7.0587C13.9747 7.30851 14.1141 7.64645 14.1141 7.9987C14.1141 8.35095 13.9747 8.68888 13.7263 8.9387Z" stroke="#222222" stroke-linecap="round" stroke-linejoin="round"/>
				<path d="M4.66699 4.66797H4.67366" stroke="#222222" stroke-linecap="round" stroke-linejoin="round"/>
			</svg>
			#1 Best value of 400 places to stay
			</div>
			-->
			<div class="tr-hotel-price-lists">
				@if(!$hotels->isEmpty())
					<?php
						$allPrices = [];
						foreach ($hotels as $hotel_result) {
							if ($hotel_result->hotelid == $searchresult->hotelid) {
								$price = $hotel_result->price;
								$agencyId = $hotel_result->agency_id;
								$fullurl = $hotel_result->booking_link;
								$options = explode(',', $hotel_result->amenity);

								$key = $hotel_result->hotelid . '_' . $price . '_' . $agencyId;

								if (!isset($allPrices[$key])) {
									$allPrices[$key] = [
										'price' => $price,
										'fullBookingURL' => $fullurl,
										'agencyId' => $agencyId,
										'options' => $options,
									];
								}
							}
						}

						$allPricesArray = array_values($allPrices);
						usort($allPricesArray, function($a, $b) {
							return $a['price'] - $b['price'];
						});

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
												if (in_array($priority, $data['options'])) {
													echo "<li>" . ucfirst($priority) . " included</li>";
													$count++;
												}
											}
											foreach ($data['options'] as $key) {
												if (!in_array($key, $priorities)) {
													echo "<li>" . ucfirst(str_replace('_', ' ', $key)) . " included</li>";
													$count++;
												}
												if ($count == 2) break;
											}
										?>
									</ul>
								</div>
								<div class="tr-site-details">
									<img loading="lazy" src="{{ 'https://pics.avs.io/hl_gates/100/40/' . $data['agencyId'] . '.png' }}" alt="agency logo">
								</div>
							</div>
							<div class="tr-row">
								<div class="tr-action" @if($count == 1 || $count == 0) style="margin-top: 18px;" @endif>
									<a href="{{ $data['fullBookingURL'] }}" class="tr-btn" target="_blank">View deal</a>
								</div>
								<div class="tr-hotel-price"><strong>${{ $data['price'] }}</strong></div>
							</div>
						</div>
					@endforeach

					<!-- Show remaining prices under "More Price" -->
					@if(count($remainingPrices) > 0)
						<div class="more-prices-container">
							<!-- Container for more prices -->
							@foreach ($remainingPrices as $data)
								<div class="tr-hotel-price-list" style="display: none;">
									<div class="tr-row">
										<div class="tr-hotel-facilities">
											<ul>
												<?php
													$count = 0;
													$priorities = ['breakfast', 'freeWifi'];
													foreach ($priorities as $priority) {
														if (in_array($priority, $data['options'])) {
															echo "<li>" . ucfirst($priority) . " included</li>";
															$count++;
														}
													}
													foreach ($data['options'] as $key) {
														if (!in_array($key, $priorities)) {
															echo "<li>" . ucfirst(str_replace('_', ' ', $key)) . " included</li>";
															$count++;
														}
														if ($count == 2) break;
													}
												?>
											</ul>
										</div>
										<div class="tr-site-details">
											<img loading="lazy" src="{{ 'https://pics.avs.io/hl_gates/100/40/' . $data['agencyId'] . '.png' }}" alt="agency logo">
										</div>
									</div>
									<div class="tr-row">
										<div class="tr-action" @if($count == 1 || $count == 0) style="margin-top: 18px;" @endif>
											<a href="{{ $data['fullBookingURL'] }}" class="tr-btn" target="_blank">View deal</a>
										</div>
										<div class="tr-hotel-price"><strong>${{ $data['price'] }}</strong></div>
									</div>
								</div>
							@endforeach
						</div>
						<button class="tr-more-price tr tr-anchor-btn">More price</button>
					@endif
				@endif
			</div>
		</div>
	</div>
	<?php $a++;?>
	@endforeach
@else
	<div class="tr-hotels-not-available">Hotels not available</div>
@endif

@if ($resultcount > 30)
	@if(!$searchresults->isEmpty())
		{{ $searchresults->links('hotellist_pagg.default') }}
	@endif
@endif




