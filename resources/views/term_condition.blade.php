<!doctype html>
<html lang="en">

<head>
     <title>Terms and Conditions for Travell</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">


    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('/favicon.ico') }}">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">

    <!-- FontAwesome -->
    <script src="https://kit.fontawesome.com/b73881b7c2.js" crossorigin="anonymous"></script>

    <!-- Slick Carousel CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick-theme.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/slick-lightbox/0.2.12/slick-lightbox.css" rel="stylesheet" />
	    <!-- nav css -->
    <link rel="stylesheet" href="{{ asset('/public/css/style.css')}}">
    <!-- Datepicker CSS -->
    <link href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" rel="stylesheet" />

    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('/public/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('/public/css/custom.css') }}">
    <link rel="stylesheet" href="{{ asset('/public/frontend/hotel-detail/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{ asset('/public/frontend/hotel-detail/css/style.css')}}">
    <link rel="stylesheet" href="{{ asset('/public/frontend/hotel-detail/css/calendar.css')}}" media="screen">
    <link rel="stylesheet" href="{{ asset('/public/frontend/hotel-detail/css/responsive.css')}}">

    <!-- Additional Hotel Styles -->
    <link href="{{ asset('/public/css/hotel-css/autoComplete.min.css') }}" rel="stylesheet">
    <link href="{{ asset('/public/css/hotel-css/t-datepicker.min.css') }}" rel="stylesheet" type="text/css">

	
	    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Figtree:ital,wght@0,300..900;1,300..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    
    <script type="text/javascript" src="js/jquery.min.js"></script>
    <script type="text/javascript" src="js/bootstrap.bundle.min.js"></script>
    <script type="text/javascript" src="js/jquery-ui-datepicker.min.js"></script>

    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/calendar.css" media="screen">
    <link rel="stylesheet" href="css/responsive.css">
    <style>
        /* Custom styles applied only to the main content, excluding navbar */
        .main-content h2,
        .main-content h4  {
            font-size: 26px;
            margin-top: 40px;
            margin-bottom: 20px;
            font-weight: bold;
            color: #000000;
            text-align: left;
        }


        .main-content p,{
            font-size: 20px;
            margin-top: 20px;
            margin-bottom: 20px;
            line-height: 1.9;
            color: #000000;
        }

        .main-content ul {
    margin-top: 20px;
    margin-bottom: 20px;
    list-style-type: disc;
    margin-left: 20px;
    color: #000000;
}

.main-content li {
    list-style-position: inside;
    padding-left: 0;
    text-indent: -1.5em;
    font-size: 1.1em;
    margin: 0; /* Remove margin to eliminate space between bullet points */
    line-height: 1.6;
}

.main-content li:before {
    content: '• ';
    margin-left: 0;
}
.main-content h2 {
    text-align: left !important;
    margin-left: 0;
}

    </style>

</head>

<body>

    <!-- Include Navbar -->
    @include('Loc_nav.navbar')


        <!-- Mobile Navigation-->
        <div class="tr-mobile-nav-section">
          <div class="tr-mobile-nav-content">
            <button type="button" class="btn-nav-close" id=""></button>
            <div class="tr-nav-header">
              <div class="tr-logo">
                <img src="images/travell-small-logo.png" alt="travell small logo">
              </div>
              <div class="tr-location">London</div>
            </div>
            <div class="tr-mobile-nav-lists">
              <ul>
                <li><svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M2.5 7.49984L10 1.6665L17.5 7.49984V16.6665C17.5 17.1085 17.3244 17.5325 17.0118 17.845C16.6993 18.1576 16.2754 18.3332 15.8333 18.3332H4.16667C3.72464 18.3332 3.30072 18.1576 2.98816 17.845C2.67559 17.5325 2.5 17.1085 2.5 16.6665V7.49984Z" stroke="#222222" stroke-linecap="round" stroke-linejoin="round"/><path d="M7.5 18.3333V10H12.5V18.3333" stroke="#222222" stroke-linecap="round" stroke-linejoin="round"/></svg>Explore</li>
                <li><svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M2.5 7.49984L10 1.6665L17.5 7.49984V16.6665C17.5 17.1085 17.3244 17.5325 17.0118 17.845C16.6993 18.1576 16.2754 18.3332 15.8333 18.3332H4.16667C3.72464 18.3332 3.30072 18.1576 2.98816 17.845C2.67559 17.5325 2.5 17.1085 2.5 16.6665V7.49984Z" stroke="#222222" stroke-linecap="round" stroke-linejoin="round"/><path d="M7.5 18.3333V10H12.5V18.3333" stroke="#222222" stroke-linecap="round" stroke-linejoin="round"/></svg>Hotels</li>
                <li><svg width="18" height="17" viewBox="0 0 18 17" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M11.6677 8.21686L11.4782 8.25293L11.4075 8.43241L8.58835 15.5894L7.6097 15.7757L8.3748 9.30726L8.4309 8.83302L7.96178 8.92232L3.5739 9.75759L3.37156 9.79611L3.30699 9.99171L2.47522 12.5116L1.87823 12.6253L1.98228 9.2217L1.98466 9.14395L1.95388 9.07252L0.606627 5.94522L1.20367 5.83157L2.90392 7.86957L3.03583 8.02769L3.23812 7.98919L7.626 7.15392L8.09517 7.0646L7.86869 6.64412L4.77982 0.909331L5.75841 0.723048L11.0099 6.34373L11.1416 6.48469L11.3311 6.44861L15.7902 5.59979C16.0247 5.55515 16.2673 5.60549 16.4647 5.73973L16.6615 5.45033L16.4647 5.73973C16.6621 5.87398 16.798 6.08113 16.8426 6.31561C16.8873 6.55009 16.8369 6.79271 16.7027 6.99007L16.9921 7.18692L16.7027 6.99007C16.5685 7.18744 16.3613 7.3234 16.1268 7.36803L11.6677 8.21686Z" stroke="black" stroke-width="0.7"></path></svg>Flights</li>
                <li><svg width="20" height="17" viewBox="0 0 20 17" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M17.0835 9.43359H14.8335M3.58349 9.43359H5.83349M17.4116 5.68359L15.9485 1.78191C15.7289 1.19645 15.1693 0.808594 14.544 0.808594H6.12299C5.49773 0.808594 4.93804 1.19645 4.7185 1.78191L3.25537 5.68359M17.4116 5.68359L17.6299 6.26568C17.7524 6.59225 18.0646 6.80859 18.4133 6.80859C18.9068 6.80859 19.293 7.23341 19.2463 7.72462L18.8335 12.0586M17.4116 5.68359H18.9585M3.25537 5.68359L3.03708 6.26568C2.91462 6.59225 2.60243 6.80859 2.25366 6.80859C1.76023 6.80859 1.37395 7.23341 1.42073 7.72462L1.83349 12.0586M3.25537 5.68359H1.70849M1.83349 12.0586L1.95418 13.3258C2.0275 14.0957 2.67408 14.6836 3.44742 14.6836H3.5835M1.83349 12.0586V12.0586C1.55735 12.0586 1.3335 12.2824 1.3335 12.5586V15.0586C1.3335 15.4728 1.66928 15.8086 2.0835 15.8086H2.8335C3.24771 15.8086 3.5835 15.4728 3.5835 15.0586V14.6836M3.5835 14.6836H17.0835M17.0835 14.6836H17.2196C17.9929 14.6836 18.6395 14.0957 18.7128 13.3258L18.8335 12.0586M17.0835 14.6836V15.0586C17.0835 15.4728 17.4193 15.8086 17.8335 15.8086H18.5835C18.9977 15.8086 19.3335 15.4728 19.3335 15.0586V12.5586C19.3335 12.2825 19.1096 12.0586 18.8335 12.0586V12.0586M6.24161 3.33425L5.41255 5.82142C5.25067 6.30707 5.61214 6.80859 6.12406 6.80859H14.5429C15.0548 6.80859 15.4163 6.30707 15.2544 5.82142L14.4254 3.33425C14.2212 2.72174 13.648 2.68359 13.0024 2.68359H7.66463C7.01899 2.68359 6.44578 2.72174 6.24161 3.33425Z" stroke="black" stroke-width="0.7" stroke-linecap="round" stroke-linejoin="round"></path></svg>Cars</li>
              </ul>
            </div>
            <div class="tr-mobile-nav-lists">
              <ul>
                <li><svg width="20" height="21" viewBox="0 0 20 21" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M16.6719 6.14307H3.33854C2.41807 6.14307 1.67188 6.88926 1.67188 7.80973V16.1431C1.67188 17.0635 2.41807 17.8097 3.33854 17.8097H16.6719C17.5923 17.8097 18.3385 17.0635 18.3385 16.1431V7.80973C18.3385 6.88926 17.5923 6.14307 16.6719 6.14307Z" stroke="#222222" stroke-linecap="round" stroke-linejoin="round"></path><path d="M13.3385 17.8091V4.47575C13.3385 4.03372 13.1629 3.6098 12.8504 3.29724C12.5378 2.98468 12.1139 2.80908 11.6719 2.80908H8.33854C7.89651 2.80908 7.47259 2.98468 7.16003 3.29724C6.84747 3.6098 6.67188 4.03372 6.67188 4.47575V17.8091" stroke="#222222" stroke-linecap="round" stroke-linejoin="round"></path></svg>Write a review</li>
                <li><svg width="20" height="21" viewBox="0 0 20 21" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M16.6719 6.14307H3.33854C2.41807 6.14307 1.67188 6.88926 1.67188 7.80973V16.1431C1.67188 17.0635 2.41807 17.8097 3.33854 17.8097H16.6719C17.5923 17.8097 18.3385 17.0635 18.3385 16.1431V7.80973C18.3385 6.88926 17.5923 6.14307 16.6719 6.14307Z" stroke="#222222" stroke-linecap="round" stroke-linejoin="round"></path><path d="M13.3385 17.8091V4.47575C13.3385 4.03372 13.1629 3.6098 12.8504 3.29724C12.5378 2.98468 12.1139 2.80908 11.6719 2.80908H8.33854C7.89651 2.80908 7.47259 2.98468 7.16003 3.29724C6.84747 3.6098 6.67188 4.03372 6.67188 4.47575V17.8091" stroke="#222222" stroke-linecap="round" stroke-linejoin="round"></path></svg>Trips</li>
              </ul>
            </div>
            <div class="tr-mobile-nav-lists">
              <h4>Company</h4>
              <ul>
                <li><a href="javascript:void(0);">About us</a></li>
                <li><a href="javascript:void(0);">Contact us</a></li>
                <li><a href="javascript:void(0);">Traveller’s Choice</a></li>
                <li><a href="javascript:void(0);">Travel stories</a></li>
                <li><a href="javascript:void(0);">Help</a></li>
              </ul>
            </div>
            <div class="tr-actions">
              <button class="tr-btn tr-write-review">Sign up / Log in</button>
            </div>
          </div>
        </div>

        <div class="container">
          <div class="row">
            <div class="col-sm-12">
              <!--Terms and Conditions - START-->
              <div class="tr-single-page">
                <div class="tr-terms-and-conditions-section">
                  <h1>Terms and Conditions for Travell</h1>
                  <p>Welcome to Travell! These Terms and Conditions govern your use of our website, located at www.travell.co (referred to as "the Site"), and our services. By accessing or using our website, you agree to comply with and be bound by the following terms. Please read them carefully.</p>

                  <h2 style="text-align: left;">1. Use of the Services</h2>
                  <p>Travell is an online platform that provides travel-related information and links to third-party services such as accommodation, flights, car rentals, and tours. We act solely as affiliates for third-party suppliers and do not sell any products or services directly. By using our services, you agree to be bound by these Terms and Conditions.</p>

                  <h3>You agree to:</h3>
                  <ul>
                    <li>Use the Site for personal, non-commercial purposes only.</li>
                    <li>Provide accurate and up-to-date information when submitting any details on the Site.</li>
                    <li>Not use any robot, spider, scraper, or other automated means to access the Site for any purpose.</li>
                  </ul>

                  <h2 style="text-align: left;">2. Affiliate Relationships and Third-Party Links</h2>
                  <p>Travell provides links to third-party websites where users can book travel services. These links are affiliate links, meaning we may receive a commission for purchases made through them. However, Travell does not own or operate these third-party services and is not responsible for the content, availability, or quality of services provided by third parties.</p>

                  <p>When you make a booking or purchase through a third-party website, the contract is between you and the third party. Travell is not involved in the booking process, and any disputes or issues must be resolved directly with the third-party supplier.</p>

                  <h2 style="text-align: left;">3. Prohibited Activities</h2>
                  <h3>When using the Site, you agree not to:</h3>
                  <ul>
                    <li>Engage in any unlawful, fraudulent, or abusive activity.</li>
                    <li>Violate any applicable local, national, or international laws or regulations.</li>
                    <li>Use the Site to distribute unsolicited advertisements or spam.</li>
                    <li>Reproduce, distribute, or modify any content from the Site without prior written permission from Travell.</li>
                  </ul>

                  <h2 style="text-align: left;">4. Content and Intellectual Property</h2>
                  <p>All content on the Site, including text, images, graphics, and logos, is the property of Travell or its affiliates and is protected by intellectual property laws. You may not copy, distribute, or create derivative works based on the content without prior written consent.</p>

                  <h2 style="text-align: left;">5. Liability Disclaimer</h2>
                  <p>Travell does not guarantee the accuracy, completeness, or reliability of the information on the Site. The content provided is for informational purposes only and is subject to change at any time.</p>

                  <h3>You acknowledge that Travell is not responsible for any damages, losses, or liabilities arising from:</h3>
                  <ul>
                    <li>The use of third-party websites or services.</li>
                    <li>Errors or inaccuracies in the content provided on the Site.</li>
                    <li>Any issues or disputes that arise between you and third-party suppliers.</li>
                  </ul>

                  <h2 style="text-align: left;">6. Booking with Third-Party Suppliers</h2>
                  <p>When you make bookings through third-party links on our Site, you agree to review and be bound by the supplier’s terms and conditions, privacy policy, and other applicable rules. Travell is not responsible for booking errors, cancellations, or changes to reservations made with third-party suppliers.</p>

                  <h2 style="text-align: left;">7. Travel Responsibilities</h2>
                  <h3>When planning and booking travel, it is your responsibility to:</h3>
                  <ul>
                    <li>Ensure your travel documents (e.g., passport, visa) are in order.</li>
                    <li>Confirm the entry and exit requirements of the destination country.</li>
                    <li>Comply with health and safety regulations, including vaccinations and other medical advice.</li>
                  </ul>

                  <p>Travell is not liable for any travel disruptions, including denied entry, missed flights, or unplanned expenses.</p>

                  <h2 style="text-align: left;">8. Indemnification</h2>
                  <p>You agree to indemnify and hold harmless Travell, its affiliates, and employees from any claims, liabilities, damages, or expenses arising out of your use of the Site, your violation of these terms, or your violation of any third-party rights.</p>

                  <h2 style="text-align: left;">9. Modifications to Terms</h2>
                  <p>We may update these Terms and Conditions at any time, and any changes will be posted on this page with the updated date. By continuing to use the Site after modifications, you agree to the revised terms.</p>

                  <h2 style="text-align: left;">10. Jurisdiction and Governing Law</h2>
                  <p>These Terms and Conditions are governed by the laws of Chandigarh, India. Any legal disputes will be subject to the exclusive jurisdiction of the courts of Chandigarh, India.</p>

                  <h2 style="text-align: left;">11. Contact Information</h2>
                  <h3>For any questions or concerns regarding these Terms and Conditions, please contact us at:</h3>
                  <address>
                    Travell<br>
                    SCO. 10, Industrial Area Phase – 2, Chandigarh - 160002<br>
                    Email: <a href="mailto:travell@outlook.in">travell@outlook.in</a>
                  </address>
                </div>
              </div>
              <!--Terms and Conditions - END-->
            </div>
          </div>
        </div>


        <!--FOOTER-->
        @include('footer')

      </body>

</html>

<!-- Scripts -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
<script src="{{ asset('/public/css/hotel-css/t-datepicker.min.js') }}"></script>
<script src="{{ asset('/public/js/datepicker-homepage.js') }}"></script>
<script src="{{ asset('/public/js/custom.js') }}"></script>
