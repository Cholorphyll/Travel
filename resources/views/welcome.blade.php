<!DOCTYPE html>
<html lang="en-US">
  <head>
     <title>Travell : Travell Like a Local</title>

    <!-- Google Tag Manager -->
    <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
    new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
    j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
    'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
    })(window,document,'script','dataLayer','GTM-PTHP3JH4');</script>
    <!-- End Google Tag Manager -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description"
    content="Discover authentic travel experiences with Travell. Compare prices, find hidden gems, and explore local favorites across top destinations worldwide. Plan your next adventure with insider insights and make every trip unforgettable.">

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Figtree:ital,wght@0,300..900;1,300..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

  <link rel="apple-touch-icon" sizes="57x57" href="{{asset('/favicon.ico')}}">
  <link rel="apple-touch-icon" sizes="60x60" href="{{asset('/favicon.ico')}}">
  <link rel="apple-touch-icon" sizes="72x72" href="{{asset('/favicon.ico')}}">
  <link rel="apple-touch-icon" sizes="76x76" href="{{asset('/favicon.ico')}}">
  <link rel="apple-touch-icon" sizes="114x114" href="{{asset('/favicon.ico')}}">
  <link rel="apple-touch-icon" sizes="120x120" href="{{asset('/favicon.ico')}}">
  <link rel="apple-touch-icon" sizes="144x144" href="{{asset('/favicon.ico')}}">
  <link rel="apple-touch-icon" sizes="152x152" href="{{asset('/favicon.ico')}}">
  <link rel="apple-touch-icon" sizes="180x180" href="{{asset('/favicon.ico')}}">
  <link rel="icon" type="image/png" sizes="192x192" href="{{asset('/favicon.ico')}}">
  <link rel="icon" type="image/png" sizes="32x32" href="{{asset('/favicon.ico')}}">
  <link rel="icon" type="image/png" sizes="96x96" href="{{asset('/favicon.ico')}}">
  <link rel="icon" type="image/png" sizes="16x16" href="{{asset('/favicon.ico')}}">

    <script type="text/javascript" src="{{ asset('/public/frontend/hotel-detail/js/jquery.min.js')}}"></script>
    <script type="text/javascript" src="{{ asset('/public/frontend/hotel-detail/js/bootstrap.bundle.min.js')}}"></script>
    <script type="text/javascript" src="{{ asset('/public/frontend/hotel-detail/js/jquery-ui-datepicker.min.js')}}"></script>
    <link rel="stylesheet" href="{{ asset('/public/frontend/hotel-detail/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{ asset('/public/frontend/hotel-detail/css/style.css')}}">
    <link rel="stylesheet" href="{{ asset('/public/frontend/hotel-detail/css/calendar.css')}}" media="screen">
    <link rel="stylesheet" href="{{ asset('/public/frontend/hotel-detail/css/responsive.css')}}">
    <link rel="stylesheet" href="{{ asset('/public/frontend/hotel-detail/css/custom.css')}}">
  </head>
  <body>
    <!--HEADER-->
    <header id="header">
      <div class="container">
        <div class="row">
          <div class="col-sm-12">
            <div class="tr-header">
              <div class="tr-hamburgers-logo">
                <div class="tr-hamburgers"></div>
                <div class="tr-logo">
                  <a href="/">
                    <img loading="lazy" src="{{ asset('public/frontend/hotel-detail/images/travell-small-logo.png') }}" alt="travell-logo">
                  </a>
                </div>
              </div>
              <div class="tr-logo tr-desktop">
                <a href="/">
                  <img loading="lazy" src="{{ asset('public/images/logo.png') }}" alt="travell-logo">
                </a>
              </div>
              <?php
                 if (session()->has('frontend_user')) {
                    $userData = session('frontend_user');
                    $Username = $userData['Username'];
                    $user_image = $userData['user_image'];

                 }
                ?>
              <div class="tr-login-section">
              @if (session()->has('frontend_user'))
                <!--Below Button for signin - currently it hide-->
                <button class="tr-logged"><div class="tr-username"> {{$Username}}</div></button>
                <div class="tr-myaccount-modal">
                  <div class="tr-mz-myaccount-info">
                    <ul>
                      <li class="tr-my-profile-link"><a href="{{route('user_dashboard')}}">Dashboard</a></li>
                      <!-- <li class="tr-my-trip-link"><a href="javascript:void(0);">My trips</a></li> -->
                    </ul>
                  </div>
                  <div class="tr-mz-myaccount-info">
                    <ul>
                      <!-- <li class="tr-my-settings-link"><a href="javascript:void(0);">Settings</a></li> -->
                      <li class="tr-logout-link"><a href="{{route('userlogout')}}">Logout</a></li>
                    </ul>
                  </div>
                </div>
            @else
            <button class="tr-login" data-bs-toggle="modal" data-bs-target="#signInModal">Sign in</button>
            @endif
              </div>

            </div>
          </div>
        </div>
      </div>
    </header>

    <!-- Mobile Navigation-->
    @include('frontend.mobile_nav')

    <div class="tr-home-page">
      <div class="container">
        <div class="row">
          <div class="col-sm-12">
            <div class="tr-heading-section">
              <h1>Travell the World</h1>
              <h2>Compare prices from 70+ Hotels websites in just a single click</h2>
            </div>

            <!--HOTEL SEARCHES FORM- START-->
            <div class="tr-search-hotel tr-search-home-page">
              <div class="tr-header">
                <div class="tr-nav-tabs show">
                  <div class="tr-explore-tab active" data-tab="exploreForm"><span><img src="{{ asset('public/frontend/hotel-detail/images/icons/compass-icon.svg')}}" alt="Compass Icon">Explore</span></div>
                  <div class="tr-hotel-tab" data-tab="hotelForm"><span><img src="{{ asset('public/frontend/hotel-detail/images/icons/clarity_building-line-black-icon.svg')}}" alt="Clarity Building Line Icon"/>Hotel</span></div>
                </div>
              </div>

              <div class="tr-find-hotels show">
                <div class="tr-explore-and-hotel-form">
                  <button type="button" class="btn-close" id="btnClose"></button>
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

                          <input type="text" class="form-control search_explore" id="searchLocation" placeholder="Search location" name="search" autocomplete="off">

                          <div class="tr-recent-searchs-modal tr-custom-scrollbar"  id="recentSearchLocation">
                            <div id="loc-list" class="autoCompletewrapper">
                              <!-- Results will be populated here -->
                            </div>
                          </div>
                          <div class="col tr-form-btn">
                            <button type="button" class="tr-btn tr-mobile">Continue</button>
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
                      <div class="tr-date-section">
                        <input type="text" class="tr-room-guest" placeholder="1 room, 2 guests" id="totalRoomAndGuest" value="" name="" readonly="">
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
                            <div class="tr-location-label location-name-mobile">Search destinations</div>
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
                          <input type="text" class="form-control" id="searchhotel" placeholder="Search destinations" name="hsearch" autocomplete="off">
                          <div class="tr-recent-searchs-modal tr-custom-scrollbar" id="recentSearchsDestination">
                            <!--
                            search-box-info
                            <p class="small my-3" id="recent-search">@if (Session::has('lastsearch')) RECENTLY VIEWED @else POPULAR DESTINATIONS @endif</p>
                            -->
                            <p id="hotel_loc_list" class="autoCompletewrapper"></p>
                          </div>
                          <span id="slug" class="d-none"></span>
                          <span id="location_id" class="d-none"></span>
                          <span id="hotel" class="d-none"></span>
                          <div class="col tr-form-btn">
                            <button type="button" class="tr-btn tr-mobile">Continue</button>
                          </div>
                        </div>
                        <div class="col tr-form-booking-date">
                          <div class="tr-form-checkin">
                            <label for="checkInInput1">Check in</label>
                            <input type="text" value="" class="form-control checkIn t-input-check-in" id="checkInInput1" placeholder="Add dates" name="" autocomplete="off" readonly>
                          </div>
                          <div class="tr-form-checkout">
                            <label for="checkOutInput1">Check out</label>
                            <input type="text" value=""class="form-control checkOut t-input-check-out" id="checkOutInput1" placeholder="Add dates" name="checkOut" autocomplete="off" readonly>
                          </div>
                          <div class="tr-calenders-modal" id="calendarsModal">
                            <div id="calendarPair1" class="calendarPair">
                              <div class="navigation">
                                <button type="button" class="prevMonth" id="prevMonth1">Previous</button>
                                <button type="button" class="nextMonth" id="nextMonth1">Next</button>
                              </div>
                              <div class="custom-calendar checkInCalendar" id="checkInCalendar1">
                                <div class="monthYear"></div>
                                <div class="calendarBody"></div>
                              </div>
                              <div class="custom-calendar checkOutCalendar" id="checkOutCalendar1">
                                <div class="monthYear"></div>
                                <div class="calendarBody"></div>
                              </div>
                              <button type="button" class="tr-clear-details" hidden id="reset1">Clear dates</button>
                            </div>
                          </div>
                          <div class="col tr-form-btn">
                            <button type="button" class="tr-btn tr-mobile">Next</button>
                          </div>
                        </div>
                        <div class="col tr-form-who">
                          <label for="totalRoomAndGuest">Who</label>
                          <input type="text" class="form-control" id="homeTotalRoomAndGuest" placeholder="Add guests" name="" autocomplete="off" readonly>
                          <!-- Don't delete below element - guestQtyModal  -->
                          <div class="tr-guests-modal" id="guestQtyModal"></div>
                        </div>
                      </div>
                      <div class="col tr-form-btn">
                        <button type="submit" class="tr-btn tr-popup-btn filter-chackinout" id="hotelSearchSubmit">Search</button>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
            </div>
            <!--HOTEL SEARCHES FORM- START-->

            <!--PARTNERS - START-->
            <div class="tr-partners-section tr-partners-home-section">
              <div class="tr-partners-title">70+ Partners :</div>
              <div class="tr-partners-lists">
                <div class="tr-partners-list">
                  <img src="{{ asset('public/frontend/hotel-detail/images/booking.png') }}" alt="Booking"/>
                </div>
                <div class="tr-partners-list">
                  <img src="{{ asset('public/frontend/hotel-detail/images/expedia.png') }}" alt="expedia"/>
                </div>
                <div class="tr-partners-list">
                  <img src="{{ asset('public/frontend/hotel-detail/images/agoda.png') }}" alt="agoda"/>
                </div>
                <div class="tr-partners-list">
                  <img src="{{ asset('public/frontend/hotel-detail/images/trip.png') }}" alt="trip"/>
                </div>
              </div>
            </div>
            <!--PARTNERS - END-->

            <!--Popular Destination - START-->
            <div class="tr-popular-destination">
              <h3>Popular Destination</h3>
              <div class="row tr-popular-destination-lists">
                <div class="tr-popular-destination-list">
                  <a href="{{ url('lo-12810004-' .strtolower( str_replace(' ', '_', 'bangkok-thailand'))) }}">
                    <div class="tr-destination-img">
                        <img loading="lazy" src="{{ asset('public/frontend/hotel-detail/images/popular-destination-1.jpg')}}" alt="Popular Destination">
                    </div>
                    <h3 class="tr-destination-name">Bangkok</h3>
                  </a>
                </div>
                <div class="tr-popular-destination-list">
                  <a href="{{ url('lo-129700020031-' .strtolower( str_replace(' ', '_', 'london-england'))) }}">
                    <div class="tr-destination-img">
                        <img loading="lazy" src="{{ asset('public/frontend/hotel-detail/images/popular-destination-2.jpg')}}" alt="Popular Destination">
                    </div>
                    <h3 class="tr-destination-name">London</h3>
                  </a>
                </div>
                <div class="tr-popular-destination-list">
                  <a href="{{ url('lo-113600100005-' .strtolower( str_replace(' ', '_', 'paris-ile-de-france'))) }}">
                    <div class="tr-destination-img">
                        <img loading="lazy" src="{{ asset('public/frontend/hotel-detail/images/popular-destination-3.jpg')}}" alt="Popular Destination">
                    </div>
                    <h3 class="tr-destination-name">Paris</h3>
                  </a>
                </div>
                <div class="tr-popular-destination-list">
                  <a href="{{ url('lo-129600030001-' .strtolower( str_replace(' ', '_', 'Dubai-emirate-of-Dubai'))) }}">
                    <div class="tr-destination-img">
                        <img loading="lazy" src="{{ asset('public/frontend/hotel-detail/images/popular-destination-4.jpg')}}" alt="Popular Destination">
                    </div>
                    <h3 class="tr-destination-name">Dubai</h3>
                  </a>
                </div>
              </div>
            </div>
            <!--Popular Destination - END-->

            <!--About Us/FAQ's - START-->
            <div class="tr-single-page">
              <div class="tr-about-us-home-section">
                <h1>About Us – A Journey Awaits with Travell.co</h1>
                <p>Welcome to Travell.co, where your travel dreams come to life! Our passion for exploration and storytelling drives everything we do. Here, you'll find a one-stop platform packed with tailored guides, expert insights, and exclusive travel tips that transform any trip into a life-changing experience.</p>

                <h2>Our Story</h2>
                <p>Travel isn't just about seeing new places—it's about transformation. At Travell.co, we were founded by Rishi K. in 2020, with a simple belief: everyone deserves an extraordinary travel experience. What began as a personal travel diary has now flourished into a trusted resource for fellow explorers, guiding them to discover their own journeys in unique ways.</p>
                <p>Over the years, we’ve ventured into 100+ countries, connecting with locals, uncovering hidden gems, and experiencing life beyond tourist attractions. Today, we are proud to share those experiences with you, offering insights into places often overlooked, cultural subtleties rarely discussed, and eco-friendly travel that leaves the world a better place for future generations.</p>

                <h2>Our Unique Offerings:</h2>
                <h3>What sets Travell.co apart from others? Here’s a glimpse of what you’ll only find here:</h3>
                <ul>
                  <li>Interactive Travel Maps: Pin your favorite destinations, view customizable itineraries, and get personalized travel suggestions based on your interests.</li>
                  <li>Behind-the-Scenes Cultural Insights: From local customs and traditions to hidden neighborhood gems, our in-depth guides go beyond the tourist attractions.</li>
                  <li>Sustainability Tracker: Helping you measure the eco-impact of your trips, with tips for making more responsible choices.</li>
                  <li>Travel by Season: Curated itineraries and travel recommendations tailored to every season, ensuring the best experience year-round.</li>
                </ul>
                <p>Pro Tip: Make sure to create a free account to unlock features like saving itineraries, customizing your personal dashboard, and getting personalized trip suggestions based on your travel history.</p>

                <h2>Our Mission: More Than Travel</h2>
                <p>We don’t just book trips; we build connections. Our mission is to bring you closer to the world, helping you experience diverse cultures and hidden gems. Whether it’s sharing a meal with a local family in Morocco or learning the art of silk weaving in Thailand, we believe in immersive travel that transcends the ordinary.</p>

                <p>At the heart of this mission is our commitment to sustainable tourism. We know the world is fragile, and we encourage our readers to be conscious of their impact—supporting local businesses, reducing waste, and leaving no trace wherever they go.</p>

                <h2>Why Trust Us?</h2>
                <p>Our dedicated team of explorers, bloggers, and content creators live and breathe travel. Each destination guide you read comes from real, lived experiences, ensuring authenticity and practical advice. We’ve partnered with travel experts, locals, and environmentalists across the globe to bring you exclusive content that goes beyond what you’ll find elsewhere. When you visit Travell.co, you’re tapping into a global community of explorers just like you.</p>

                <div class="tr-faqs-section">
                  <h2>Exclusive FAQs: Everything You Need to Know Before You Travel</h2>

                  <h3>Q1: How is Travell.co different from other travel websites?</h3>
                  <p>We dive deeper into every destination, offering authentic travel experiences you won’t find on mainstream sites. Our expert travel writers provide hidden gems, personal stories, and real cultural insights. Plus, we prioritize sustainability, ensuring your travels have a positive impact on the environment and local communities.</p>

                  <h3>Q2: Do you offer personalized travel plans?</h3>
                  <p>Absolutely! With our Interactive Travel Maps and tailored recommendations, we help you design the perfect trip based on your preferences, budget, and timing. You can also get personalized seasonal itineraries to make the most out of your travels.</p>

                  <h3>Q3: What are your tips for eco-friendly travel?</h3>
                  <p>We’ve dedicated an entire section of our site to sustainable tourism! From carbon-offset flights to zero-waste packing tips, we help you travel more responsibly. You’ll find our Sustainability Tracker useful for minimizing your footprint while enjoying the beauty of the world.</p>

                  <h3>Q4: How do I get the most out of my travel experience?</h3>
                  <p>Planning is key, and we’re here to help. Our site offers everything from cultural etiquette guides to seasonal travel advice that will ensure you’re prepared for any adventure. Plus, don't miss out on local experiences that we feature in our destination-specific guides.</p>
                </div>

                <h2>Join the Adventure!</h2>
                <p>The world is waiting for you, and we're here to help you discover it. Ready to unlock hidden travel experiences and embark on journeys you’ll remember forever? Whether you're planning your next getaway or just seeking inspiration, dive into our expertly crafted guides, explore our interactive maps, and make your travel dreams a reality.</p>
                <p>Start Your Journey Today! Let’s explore the world together—one unforgettable trip at a time.</p>
              </div>
            </div>
            <!--About Us/FAQ's - END-->
          </div>
        </div>
      </div>
    </div>

    <!--FOOTER-->
    @include('frontend.footer')
    @include('frontend.login_models')

    <div class="overlay" id="overLay"></div>
  </body>
</html>
<script type="application/ld+json">
{ "@context" : "https://schema.org",
  "@type" : "Organization",
  "url" : "https://www.travell.co/",
  "contactPoint" : [
    { "@type" : "ContactPoint",
      "contactType" : "customer service"
    } ] }
</script>
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "WebSite",
  "url": "https://www.travell.co/",
  "potentialAction": [
    {
      "@type": "SearchAction",
      "target": "https://www.travell.co/list-location?search={search_term_string}",
      "query-input": {
        "@type": "PropertyValueSpecification",
        "valueName": "search_term_string"
      },
      "query": "required"
    },
	{
      "@type": "SearchAction",
      "target": "https://www.travell.co/list_hotelsloc?search={search_term_string}",
       "query-input": {
        "@type": "PropertyValueSpecification",
        "valueName": "search_term_string"
      },
        "query": "required"

    }
  ]
}
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/lodash.js/4.17.21/lodash.min.js"></script>
<!-- Axios -->
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script type="text/javascript" src="{{ asset('/public/frontend/hotel-detail/js/common.js')}} "></script>
<script src="{{ asset('/public/js/custom.js')}}"></script>
<!--<script src="{{ asset('/public/js/index.js')}}"></script>-->
