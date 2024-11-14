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
  <title>Contact Us - Travell</title>
	<meta name="description" content="Reach out to us at Travell. We're always here to provide you the best solutions." />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
  <!--  fontawesome -->
  <link rel="icon" type="image/x-icon" href="{{asset('/favicon.ico')}}">
  <script src="https://kit.fontawesome.com/b73881b7c2.js" crossorigin="anonymous"></script>

  <link rel="stylesheet" href="{{ asset('/public/css/contctform.css')}}">
  <!-- nav css -->
  <link rel="stylesheet" href="{{ asset('/public/css/style.css')}}">
   <link rel="stylesheet" href="{{ asset('/public/css/custom.css')}}">

 
   <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" /> 
   <link href="{{ asset('/public/css/hotel-css/t-datepicker.min.css')}}" rel="stylesheet" type="text/css">


     <link rel="stylesheet" href="{{ asset('/public/css/hotel-css/autoComplete.min.css')}}"> 
        <script src="{{ asset('/public/css/hotel-css/autoComplete.js')}}"></script>
   
      <style>
        .recent-his{
          margin-top: 53px;
        }
           
      </style>
   <!-- end nav css -->
</head>

<body>
	<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-PTHP3JH4"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->
@include('Loc_nav.loc_navbar')
<div class="contatform">
        <div class="container">
            
            <div class="row">
                
                <div class="col-md-6">
                    <div class="contact-left-column">
                        <p>Couldn’t find what you were looking for?</p>
                        <div>We’re here for you!</div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="contact-form">
                        <form action="">
                            <div class="row">
                                <div class="col-6"><input type="text" placeholder="Enter Your Name*"></div>
                                <div class="col-6"><input type="text" placeholder="Enter your Phone number*"></div>
                                <div class="col-6"><input type="text" placeholder="Enter your mail ID*"></div>
                                <div class="col-6"><input type="text" placeholder="Select your location*"></div>
                                <div class="col-12">
                                    <textarea name="" id=""
                                        placeholder="How can we help you get your good out there?"></textarea>
                                </div>
                            </div>
                            <button>Submit <img src="images/arrow-right.svg" alt=""></button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
    @include('footer')

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <!-- nav js -->
  <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
  <script src="{{ asset('/public/css/hotel-css/t-datepicker.min.js')}}"></script>
  <script src="{{ asset('/public/js/datepicker-homepage.js')}}"></script> 
  <script src="{{ asset('/public/js/custom.js')}}"></script>
 <!-- end nav js -->

</body>

</html> 