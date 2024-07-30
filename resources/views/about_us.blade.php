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
  <title>About Us - Travell</title>
	<meta name="description" content="Travell is the way we seek out the happiness and beauty in our outside world, and find contentment in that experience." />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
  <!--  fontawesome -->

  <script src="https://kit.fontawesome.com/b73881b7c2.js" crossorigin="anonymous"></script>


  <link rel="icon" type="image/x-icon" href="{{asset('/favicon.ico')}}">
  <!-- nav css -->
  <link rel="stylesheet" href="{{ asset('/public/css/style.css')}}">
  <link rel="stylesheet" href="{{ asset('/public/css/custom.css')}}">


  <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
  <link href="{{ asset('/public/css/hotel-css/t-datepicker.min.css')}}" rel="stylesheet" type="text/css">


  <link rel="stylesheet" href="{{ asset('/public/css/hotel-css/autoComplete.min.css')}}">
  <script src="{{ asset('/public/css/hotel-css/autoComplete.js')}}"></script>
  <!-- end nav css -->
  <style>
  .recent-his {
    margin-top: 53px;
  }
  </style>
</head>

<body>

<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-PTHP3JH4"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->
  @include('Loc_nav.loc_navbar')


  <div class="">
    <div class="container">


      <div class="d-flex flex-column-reverse flex-md-column">
        <div class="banner-container other-sections">
          <img src="{{asset('public/images/homepagebanner.png')}}" class="img-fluid d-block w-100" alt="">
          <div class="banner-text fw-500">
            Discover New Destinations
          </div>
        </div>
      </div>

      <div class="aboutustext">
        <div class="abouttitle">
          <span>About</span> Travell
        </div>
        <!--<div class="subtext">
          YAAN or YANA- derived from DHARMASASTRA Literature means- ‘JOURNEY’ or ‘MARCHING’.
        </div>-->
		<div class="subtext">
			“Happiness is the ‘Way of Travel’ not the destination”.
		</div>
        <p class="mb-0">Imagine how stressful it can be to plan a trip and make sure everything goes smoothly. That's where Travell comes in. As the world's largest travel guidance platform, we help millions of people every month become better travelers. Our goal is to make the process of planning and booking a trip as easy and stress-free as possible. We understand that every traveller is unique, with different needs and preferences.</p>

        <p class="mb-0 mt-3"> That's why our site and app provide personalized guidance based on the experiences of
          others who have been there before. With over 1 billion reviews and opinions of nearly 8 million businesses, travelers
          turn to Travell to find the best deals on accommodations, booking experiences, reserve tables at delicious
          restaurants and discover great places nearby. Our services are available in 43 markets and 22 languages, making
          it easy for anyone to plan their dream trip.</p>
        <p class="mt-3"> We process billions of queries across our platforms every year, helping millions of travelers
          around the world make confident decisions. With every query, we search hundreds of travel sites to ensure
          travellers have all the information they need to find the right flights, hotels, car rentals and holiday
          packages. Together, we make it easier for everyone to experience the world with joy and peace of mind.</p>
      </div>
      <section class=" other-sections my-md-64px">
        <div class="secttitle">How we Work</div>


        <div class=" howwework">
          <div class="text-center card flex-1">

            <img src="{{asset('public/images/globe.svg')}}" alt="" class="mb-20 d-flex justify-content-center mx-auto">
            <p class="color707070 mt-0"> At Travell, we're the leading travel search engine, dedicated to
              making your trip planning hassle-free. Our powerful search engine scans hundreds of travel sites to find
              you the best deals on flights, hotels, car rentals, and more, all in one place.</p>

          </div>
          <div class="text-center card flex-1 centercard">

            <img src="{{asset('public/images/searchglobe.svg')}}" alt=""
              class="mb-20 d-flex justify-content-center mx-auto">
            <p class="color707070 mt-0"> You'll always get the lowest prices directly from the travel
              providers, with no added fees. We're compensated by the providers when you book through us, so our service
              is free for you.</p>
          </div>
          <div class="text-center card flex-1">

            <img src="{{asset('public/images/Planning.svg')}}" alt=""
              class="mb-20 d-flex justify-content-center mx-auto">
            <p class="color707070 mt-0"> Plus, we display travel-related ads that may interest you, and some
              companies pay us when you click on them. Whether you're an experienced traveler or planning
              your first trip, make Travell your go-to travel companion for seamless planning and booking.</p>
          </div>
        </div>
      </section>
    </div>

    <section class="listresult bg-F7F7F7 mt-md-64px">
      <div class="container">
        <div class="secttitle">How we list Results</div>
        <div class=" howwework">
          <div class="mx-auto">
            <p class="mb-1">When you initiate a search, various factors are taken into account to determine
              the
              order in which
              the results are listed. These factors include but are not limited to the price of the item
              or
              service being searched for and the ratings provided by other users who have utilized the
              same
              service or product in the past.
            </p>
            <p> For instance, when searching for flights, the duration and number of stops may be used to
              determine
              how comfortable the trip may be. To ensure that you find exactly what you are looking for,
              we
              offer
              filters that help to refine your search parameters, in addition to sorting the search
              results
              based
              on price.</p>
          </div>
        </div>
      </div>
    </section>

    <section class=" other-sections my-md-64px">
      <div class="container">
        <div class="secttitle secttitle2 me-auto">Stays</div>


        <div class=" howwework">
          <div class="card flex-1">


            <p class="color707070 mt-0 text-start"> When searching for the best deals on hotel bookings, you
              may come across multiple provider sites offering the same deal. To give you a comprehensive view of the
              options available, we display all providers for you to choose from. However, we also highlight one
              main provider based on several important factors.</p>

          </div>
          <div class="card flex-1 centercard">


            <p class="color707070 mt-0 text-start">These factors include the provider's price compared to
              the cheapest available price, as well as the average revenue potential for Travell from each hotel result. Within a
              hotel listing, you may notice that the cheapest offer is not displayed above the "View Deal" or "Select" button.</p>
          </div>
          <div class="card flex-1">


            <p class="color707070 mt-0 text-start"> Rest assured that this does not mean the cheapest option is not available.
              Instead, simply look for the price highlighted in green to easily identify the best deal. We understand that finding the best deal is important to you, and we are committed to making this process as easy and transparent as possible.</p>
          </div>
        </div>
      </div>
    </section>

    <section class=" other-sections">
      <div class="container">
        <div class="secttitle">How we get Prices</div>
        <div class="row howwework howwegetprices">
          <div class="col-md-6 mb-4">
            <div class="text-center card">
              <img src="{{asset('public/images/icon1.svg')}}" alt=""
                class="mb-20 d-flex justify-content-center mx-auto">

              <h6 class="fs20 fw-500 mb-20"> Comprehensive Search </h6>
              <p class="color707070 mt-0"> We simplify your travel deal hunt by searching hundreds of
                travel, airline, hotel, and rental car websites all at once. Our platform scours the web
                to find you the best options.</p>

            </div>
          </div>
          <div class="col-md-6 mb-4">
            <div class="text-center card ">

              <img src="{{asset('public/images/icon2.svg')}}" alt=""
                class="mb-20 d-flex justify-content-center mx-auto">

              <h6 class="fs20 fw-500 mb-20"> Accuracy Assurance</h6>
              <p class="color707070 mt-0"> While we strive for accuracy, occasional inaccuracies may
                occur, such as inventory not updating promptly. We're working to ensure providers update
                their info at least every 24 hours to improve accuracy..</p>
            </div>
          </div>
          <div class="col-md-6">
            <div class="text-center card">
              <img src="{{asset('public/images/icon3.svg')}}" alt=""
                class="mb-20 d-flex justify-content-center mx-auto">

              <h6 class="fs20 fw-500 mb-20"> Speedy Results</h6>
              <p class="color707070 mt-0"> We understand the importance of time, so we cache results to
                boost site speed. If two users search simultaneously, they'll likely see the same
                results. While we search extensively, we can't cover every site.</p>

            </div>
          </div>
          <div class="col-md-6">
            <div class="text-center card ">

              <img src="{{asset('public/images/icon4.svg')}}" alt=""
                class="mb-20 d-flex justify-content-center mx-auto">

              <h6 class="fs20 fw-500 mb-20"> Best Deals Guarantee</h6>
              <p class="color707070 mt-0"> We guarantee the best web deals, though some providers may not
                appear for various reasons. Our goal is a seamless travel experience, and we'll always
                strive for that, even if it means omitting certain options to enhance customer
                satisfaction.</p>
            </div>
          </div>
        </div>
      </div>
    </section>

    <section class="listresult">
      <div class="container">
        <div class="secttitle">How we get Reviews</div>
        <div class=" howwework">
          <div class="mx-auto">
            <p class="mb-1">It's important to note that reviews on our site are carefully curated. We
              display
              reviews and review scores only from reputable travel websites and users who have made a
              booking
              through our platform while logged in or have submitted their itinerary to us. However, we
              have
              strict guidelines and terms of review providers, which are similar to our Terms of Use,
              including
              reviews that include or refer to other things like-
            </p>
          </div>
        </div>
      </div>
    </section>

    <div class="how-we-getreviews">
      <div class="container">
        <div class="getreviews">
          <div class="getreview">
            Illegal activities
          </div>
          <div class="getreview">
            Impersonation </div>
          <div class="getreview">
            Personal or sensitive <br> information
          </div>

          <div class="getreview">
            Is unrelated to the topic or intended use of the area of our website (at our sole discretion)
            o Spam and fake content.
          </div>

          <div class="getreview">
            Is unrelated to the topic or intended use of the area of our website (at our sole discretion)
            o Spam and fake content.
          </div>

        </div>
      </div>
    </div>
  </div>
  @include('footer')


  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
  <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
  <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-lightbox/0.2.12/slick-lightbox.min.js"></script>


  <!-- nav js -->
  <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
  <script src="{{ asset('/public/css/hotel-css/t-datepicker.min.js')}}"></script>
  <script src="{{ asset('/public/js/datepicker-homepage.js')}}"></script>
  <script src="{{ asset('/public/js/custom.js')}}"></script>
  <!-- end nav js -->


</body>

</html>