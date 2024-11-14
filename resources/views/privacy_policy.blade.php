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
    <title>Privacy Policy - Travell</title>
    <meta name="description"
        content="Learn about the Privacy Policy at Travell and how we keep your information always safe and secure.">
    <link rel="icon" type="image/x-icon" href="{{asset('/favicon.ico')}}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <!--  fontawesome -->
    <script src="https://kit.fontawesome.com/b73881b7c2.js" crossorigin="anonymous"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick-theme.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/slick-lightbox/0.2.12/slick-lightbox.css" rel="stylesheet" />
	    <link rel="stylesheet" href="{{ asset('/public/frontend/hotel-detail/css/style.css')}}">
    <link rel="stylesheet" href="{{ asset('/public/css/hotel-css/autoComplete.min.css')}}">
    <link href="{{ asset('/public/css/hotel-css/t-datepicker.min.css')}}" rel="stylesheet" type="text/css">

    <!-- nav css -->
    <link rel="stylesheet" href="{{ asset('/public/css/hotel-css/autoComplete.min.css')}}">
    <script src="{{ asset('/public/css/hotel-css/autoComplete.js')}}"></script>
 <!-- nav css -->
  <link rel="stylesheet" href="{{ asset('/public/css/style.css')}}">
   <link rel="stylesheet" href="{{ asset('/public/css/custom.css')}}">

   <link href="{{ asset('/public/css/hotel-css/t-datepicker.min.css')}}" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />

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
@include('Loc_nav.navbar')

    <div class="banner-container other-sections">
        <div class="container">
            <img src="{{asset('public/images/homepagebanner.png')}}" class="img-fluid d-none d-md-block w-100" alt="">
            <img src="{{asset('public/images/bannermobile.png')}}" class="img-fluid d-md-none w-100" alt="">
            <div class="banner-text">
                Discover New <br> Destinations
            </div>
        </div>
    </div>
    <!--<div class="body typeahed mx-auto" align="center">
        <div class="d-flex justify-content-center mb-20">
            <ul class="nav nav-tabs border-0 w-100 justify-content-center w-50" id="myTab" role="tablist">
                <li class="nav-item border-0 w-50" role="presentation">
                    <button class="nav-link active tab-switch" id="home-tab" data-bs-toggle="tab"
                        data-bs-target="#home-tab-pane" type="button" role="tab" aria-controls="home-tab-pane"
                        aria-selected="true"><span class="tab-switch active">
                            Explore
                        </span></button>
                </li>
                <li class="nav-item border-0 w-50" role="presentation">
                    <button class="nav-link tab-switch" id="profile-tab" data-bs-toggle="tab"
                        data-bs-target="#profile-tab-pane" type="button" role="tab" aria-controls="profile-tab-pane"
                        aria-selected="false">Hotels</button>
                </li>
            </ul>
        </div>
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="home-tab-pane" role="tabpanel" aria-labelledby="home-tab"
                tabindex="0">
                <div class="explore-search">
                    <div class="search-box-icon">
                        <img src="{{asset('public/images/search.svg')}}" class="search-icon" alt="">
                    </div>
                    <!-- <input type="text" id="autocompleteFive" placeholder="Select a color"></input>
                     <ul id="results"></ul> --
                    <input type="text" id="searchlocation" type="search" value="{{request('search')}}" name="search"
                        placeholder="Where are you goining?" autocomplete="off">
                    <div class="recent-his search-box-info  d-none bg-white px-4 b-20 shadow-1 position-absolute">
                        <!-- <p class="small my-3" id="recent-search">@if (Session::has('lastsearch')) RECENTLY VIEWED @else POPULAR
                  DESTINATIONS @endif</p> --
                        <p id="loc-list" class="px-4 autoCompletewrapper"></p>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="profile-tab-pane" role="tabpanel" aria-labelledby="profile-tab" tabindex="0">
                <div class="search-filter remove-highlight d-md-flex">
                    <div class="search-locations">
                        <img src="{{asset('public/images/search.svg')}}" class="search-iconformobile d-md-none" alt="">
                        <label for="checkout" class="label">Where</label>
                        <div class="autoComplete_wrapper">
                            <input id="autoCompletethree" type="text" tabindex="1" placeholder="&#xF002; Search">
                        </div>
                    </div>
                    <div class="t-datepicker">
                        <div class="t-check-in"></div>
                        <div class="t-check-out"></div>
                    </div>
                    <div class="dropdown-custom">
                        <div class="dropdown-custom-toggle ">
                            <img src="{{asset('public/images/usergrey.png')}}" class="user-guests d-md-none" alt="">
                            <label for="checkout" class="label">Who</label>
                            <input type="number" id="totalguests" class="border-0 totalguests"
                                placeholder="Add no. of guests" readonly>
                        </div>
                        <ul class="dropdown-menu p-0 border-0">
                            <div class="rooms-num room-info b-20 border bg-white">
                                <div class="p-24">
                                    <div class="adults counter mb-30 d-flex justify-content-between align-items-center">
                                        <div>
                                            <p class="person">Adult</p>
                                            <p class="age"> Ages 13 or above</p>
                                        </div>
                                        <div class="d-flex align-items-center">
                                            <span role="button" class="decrement dec">-</span>
                                            <input type="number"
                                                class="border d-flex align-items-center rounded-3 border-1 border-dark inputfield"
                                                placeholder="0" readonly>
                                            <span role="button" class="adultincrement incdec">+</span>
                                        </div>
                                    </div>
                                    <div class="adults counter mb-30 d-flex justify-content-between align-items-center">
                                        <div>
                                            <p class="person">Children</p>
                                            <p class="age"> Ages 2-12</p>
                                        </div>
                                        <div class="d-flex align-items-center">
                                            <span role="button" id="childrenSubtract" class="decrement dec">-</span>
                                            <input type="number"
                                                class="border d-flex align-items-center rounded-3 border-1 border-dark inputfield"
                                                placeholder="0" readonly>
                                            <span role="button" id="childrenAdd" class="adultincrement incdec">+</span>
                                        </div>
                                    </div>
                                    <div class="adults counter d-flex justify-content-between align-items-center">
                                        <div>
                                            <p class="person">Infants</p>
                                            <p class="age"> Under 2</p>
                                        </div>
                                        <div class="d-flex align-items-center">
                                            <span role="button" class="decrement dec">-</span>
                                            <input type="number"
                                                class="border d-flex align-items-center rounded-3 border-1 border-dark inputfield"
                                                placeholder="0" readonly>
                                            <span role="button" class="adultincrement incdec">+</span>
                                        </div>
                                    </div>
                                </div>
                                <div id="childrenDetails">
                                </div>
                            </div>
                        </ul>
                    </div>
                    <div class="search-icon d-none d-md-flex">
                        <div class="search">
                            <i class="fa fa-search" aria-hidden="true"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="selection d-none"></div>
        <div class="selection2 d-none"></div>
    </div> -->
    <div class="container">
        <div class="row justify-content-between mt-md-64px">

            <div class="col-md-12">
                <div class="fs-32 mb-32"><b>Privacy Policy</b></div>
                <p class="mt-3">Travell LLC (hereinafter “Travell”) recognizes the importance of the privacy of its users and also of maintaining the confidentiality of the information provided by its users as a responsible data controller and data processor.</p>

                <p class="mt-3">This Privacy Policy provides for the practices for handling and securing user's Personal Information (defined hereunder) by Travell and its subsidiaries and affiliates.</p>

                <p class="mt-3">This Privacy Policy applies to any person (‘User’) who purchases, intends to purchase, or inquire about any product(s) or service(s) made available by Travell through any of Travell’s customer interface channels including its website, mobile site, mobile app &amp; offline channels including call centers and offices (collectively referred herein as "Sales Channels").</p>

                <p class="mt-3">For this Privacy Policy, wherever the context so requires "you" or "your" shall mean User, and the terms "we", "us", and "our" shall mean Travell. For this Privacy Policy, Website means the website(s), mobile site(s), and mobile app(s).</p>

                <p class="mt-3">By using or accessing the Website or other Sales Channels, the User hereby agrees with the terms of this Privacy Policy and the contents herein. If you disagree with this Privacy Policy please do not use or access our Website or other Sales Channels.</p>

                <p class="mt-3">This Privacy Policy does not apply to any website(s), mobile sites, or mobile apps of third parties, even if their websites/products are linked to our Website.</p>

                <p class="mt-3">Users should take note that information and privacy practices of Travell’s business partners, advertisers, sponsors, or other sites to which Travell provides hyperlink(s), may be materially different from this Privacy Policy. Accordingly, it is recommended that you review the privacy statements and policies of any such third parties with whom they interact.</p>

                <p class="mt-3">This Privacy Policy is an integral part of your User Agreement with Travell and all capitalized terms used, but not otherwise defined herein, shall have the respective meanings as ascribed to them in the User Agreement.</p>

                <div class="fs24 mb-16 fw-500">TYPE OF INFORMATION WE COLLECT AND ITS LEGAL BASIS</div>
                <p class="mt-3">The information detailed below is collected for us to be able to provide the services chosen by you and also to fulfill our legal obligations as well as our obligations towards third parties as per our User Agreement.</p>
				<p class="mt-3">"Personal Information" of the User shall include the information shared by the User and collected by us for the following purposes:</p>

                <div class="fs24 mb-16 fw-500">Registration on the Website</div>

                <p class="mt-3">Information that you provide while subscribing to or registering on the Website, including but not limited to information about your personal identity such as name, gender, marital status, religion, age, etc., your contact details such as your email address, postal addresses, frequent flyer number, telephone (mobile or otherwise) and/or fax numbers. The information may also include information such as your banking details (including credit/debit card) and any other information relating to your income and/or lifestyle; billing information payment history etc. (as shared by you).</p>

                <div class="fs24 mb-16 fw-500">Other information</div>

                <p class="mt-3">We may also collect some other information and documents including but not limited to:</p>

                <ul>
                    <li>Transactional history (other than banking details) about your e-commerce activities, and buying behavior.</li>
                    <li>Your usernames, passwords, email addresses, and other security-related information used by you about our Services.</li>
                    <li>Data either created by you or by a third party and which you wish to store on our servers such as image files, documents, etc.</li>
                    <li>Data available in the public domain or received from any third party including social media channels, including but not limited to personal or non-personal information from your linked social media channels (like name, email address, friend list, profile pictures, or any other information that is permitted to be received as per your account settings) as a part of your account information.</li>
                    <li>Information pertaining to any other traveler(s) for whom you make a booking through your registered Travell account. In such case, you must confirm and represent that each of the other traveler(s) for whom a booking has been made, has agreed to have the information shared by you disclosed to us and further be shared by us with the concerned service provider(s).</li>
                    <li>If you request Travell to provide visa-related services, then copies of your passport, bank statements, originals of the filled-in application forms, photographs, and any other information that may be required by the respective embassy to process your visa application.</li>
                </ul>

                <div class="fs24 mb-16 fw-500">HOW WE USE YOUR PERSONAL INFORMATION:</div>


                <p class="mt-3">The Personal Information collected may be used in the following manner:</p>

                <div class="fs24 mb-16 fw-500">While making a booking</div>

                <p class="mt-3">While making a booking, we may use Personal Information including, payment details which include cardholder name, credit/debit card number (in encrypted form) with an expiration date, banking details, wallet details, etc. as shared and allowed to be stored by you.</p>
				<p class="mt-3">We may also use the information on the travelers' list as available in or linked with your account. This information is presented to the User at the time of making a booking to enable you to complete your bookings expeditiously.</p>

				<div class="fs24 mb-16 fw-500">We may also use your Personal Information for several reasons including but not limited to:</div>
                <ul>
					<li>Confirm your reservations with respective service providers.</li>
					<li>Keep you informed of the transaction status.</li>
					<li>Send booking confirmations either via SMS, WhatsApp, or any other messaging service.</li>
					<li>Send any updates or changes to your booking(s).</li>
					<li>Allow our customer service to contact you, if necessary.</li>
					<li>Customize the content of our website, mobile site, and mobile app.</li>
					<li>Request for reviews of products or services or any other improvements.</li>
					<li>Send verification message(s) or email(s).</li>
					<li>Validate/authenticate your account and prevent any misuse or abuse.</li>
					<li>Contact you on your birthday/anniversary to offer a special gift or offer.</li>
				</ul>

				<div class="fs24 mb-16 fw-500">Surveys:</div>
                <p class="mt-3">We value opinions and comments from our Users and frequently conduct surveys, both online and offline. Participation in these surveys is entirely optional.</p>

                <p class="mt-3">Typically, the information received is aggregated, and used to make improvements to the Website, other Sales Channels, and services and to develop appealing content, features, and promotions for members based on the results of the surveys.</p>

                <p class="mt-3">The identity of the survey participants is anonymous unless otherwise stated in the survey.</p>

                <div class="fs24 mb-16 fw-500">Marketing Promotions, Research, and Programs:</div>

                <p class="mt-3">Marketing promotions, research, and programs help us to identify your preferences, develop programs, and improve user experience.</p>
                <p class="mt-3">Travell frequently sponsors promotions to allow its Users to win great travel and travel-related prizes. Personal Information collected by us for such activities may include contact information and survey questions.</p>
                <p class="mt-3">We use such Personal Information to notify contest winners and survey information to develop promotions and product improvements.</p>
                <p class="mt-3">As a registered User, you will also occasionally receive updates from us about fare sales in your area, special offers, new Travell services, other noteworthy items (like savings and benefits on airfares, hotel reservations, holiday packages, car rentals, and other travel services) and marketing programs.</p>
				<p class="mt-3">In addition, you may look forward to receiving periodic marketing emails, newsletters, and exclusive promotions offering special deals.</p>
				<p class="mt-3">From time to time, we may add or enhance services available on the Website. To the extent these services are provided, and used by you, we will use the Personal Information you provide to facilitate the service(s) requested.</p>
				<p class="mt-3">For example, if you email us with a question, we will use your email address, name, nature of the question, etc. to respond to your question. We may also store such Personal Information to assist us in making the Website better and easier to use for our Users.</p>
				<p class="mt-3">Travell may from time to time launch reward programs by way of which users may stand to win travel-related rewards or other rewards. We may use your Personal Information to enroll you in the rewards program and the status of the same will be visible each time you log in to the Website.</p>
				<p class="mt-3">Depending on the reward program, each time you win a reward, Travell may share your Personal Information with a third party that will be responsible for fulfilling the reward to you. You may however choose to opt out of such reward programs by writing to us.</p>
				<p class="mt-3">For various purposes such as fraud detection, offering bookings on credit, etc., we at times may verify information of customers on a selective basis, including their credit information.</p>
				<p class="mt-3">Additionally, Travell may share your Personal Information, anonymized and/ or aggregated data to a third party that Travell may engage to perform certain tasks on its behalf, including but not limited to payment processing, data hosting, data processing, and assessing creditworthiness for offering bookings on credit.</p>

                <div class="fs24 mb-16 fw-500">HOW LONG DO WE KEEP YOUR PERSONAL INFORMATION?</div>
				<p class="mt-3">Travell will retain your Personal Information on its servers for as long as is reasonably necessary for the purposes listed in this policy. In some circumstances, we may retain your Personal Information for longer periods, for instance where we are required to do so under any legal, regulatory, tax, or accounting requirements.</p>
				<p class="mt-3">Where your personal data is no longer required, we will ensure it is either securely deleted or stored in a way that means it will no longer be used by the business.</p>

                <div class="fs24 mb-16 fw-500">COOKIES AND SESSION DATA</div>
				<div class="fs24 mb-16 fw-500">Cookies:</div>
				<p class="mt-3">Travell uses cookies to personalize your experience on the Website and the advertisements that may be displayed. Travell’s use of cookies is similar to that of any other reputable online company.</p>
				<p class="mt-3">Cookies are small pieces of information that are stored by your browser on your device's hard drive. Cookies allow us to serve you better and more efficiently.</p>
				<p class="mt-3">Cookies also allow ease of access, by logging you in without having to type your login name each time (only your password is needed); we may also use such cookies to display any advertisement(s) to you while you are on the Website or to send you offers (or similar emails – provided you have not opted out of receiving such emails) focusing on destinations which may be of your interest.</p>
				<p class="mt-3">A cookie may also be placed by our advertising servers or third-party advertising companies. Such cookies are used for purposes of tracking the effectiveness of advertising served by us on any website, and also to use aggregated statistics about your visits to the Website to provide advertisements in the Website or any other website about services that may be of potential interest to you.</p>
				<p class="mt-3">Third-party advertising companies or advertisement providers may also employ technology that is used to measure the effectiveness of the advertisements. All such information is anonymous. This anonymous information is collected through the use of a pixel tag, which is an industry-standard technology and is used by all major websites.</p>
				<p class="mt-3">They may use this anonymous information about your visits to the Website to provide advertisements about goods and services of potential interest to you. No Personal Information is collected during this process. The information collected during this process is anonymous and does not link online actions to a User.</p>
				<p class="mt-3">Most web browsers automatically accept cookies. Of course, by changing the options on your web browser or using certain software programs, you can control how and whether cookies will be accepted by your browser. Travell supports your right to block any unwanted Internet activity, especially that of unscrupulous websites.</p>
				<p class="mt-3">However, blocking Travell cookies may disable certain features on the Website, and may hinder an otherwise seamless experience to purchase or use certain services available on the Website. Please note that it is possible to block cookie activity from certain websites while permitting cookies from websites you trust.</p>
				<div class="fs24 mb-16 fw-500">Automatic Logging of Session Data:</div>
				<p class="mt-3">Each time you access the Website your session data gets logged. Session data may consist of various aspects like the IP address, operating system and type of browser software being used, and the activities conducted by the User while on the Website.</p>
				<p class="mt-3">We collect session data because it helps us analyze the User’s choices, and browsing patterns including the frequency of visits and duration for which a User is logged on. It also helps us diagnose problems with our servers and lets us better administer our systems.</p>
				<p class="mt-3">The aforesaid information cannot identify any User personally. However, it may be possible to determine a User's Internet Service Provider (ISP), and the approximate geographic location of the User's point of connectivity through the above session data.</p>

				<div class="fs24 mb-16 fw-500">WITH WHOM YOUR PERSONAL INFORMATION IS SHARED</div>
				<div class="fs24 mb-16 fw-500">Service Providers and Suppliers:</div>
				<p class="mt-3">Your information shall be shared with the end service providers like airlines, hotels, bus service providers, cab rentals, railways, or any other suppliers who are responsible for fulfilling your booking. You may note that while making a booking with Travell you authorize us to share your information with the said service providers and suppliers.</p>
				<p class="mt-3">It is pertinent to note that Travell does not authorize the end service provider to use your information for any other purpose(s) except as may be for fulfilling their part of the service. However, how the said service providers/suppliers use the information shared with them is beyond the purview and control of Travell as they process Personal Information as independent data controllers, and hence we cannot be made accountable for the same.</p>
				<p class="mt-3">You are therefore advised to review the privacy policies of the respective service provider or supplier whose services you choose to avail.</p>
				<p class="mt-3">Travell does not sell or rent individual customer names or other Personal Information of Users to third parties except for sharing of such information with our business/alliance partners or vendors who are engaged by us for providing various referral services and for sharing promotional and other benefits to our customers from time-to-time basis their booking history with us.</p>
				<div class="fs24 mb-16 fw-500">Companies in the Same Group:</div>
				<p class="mt-3">In the interests of improving personalization and service efficiency, we may, under controlled and secure circumstances, share your Personal Information with our affiliate or associate entities.</p>
				<p class="mt-3">If the assets of Travell are acquired, our customer information may also be transferred to the acquirer depending upon the nature of such acquisition. In addition, as part of business expansion/development/restructuring or for any other reason whatsoever, if we decide to sell/transfer/assign our business, any part thereof, any of our subsidiaries, or any business units, then as part of such restructuring exercise customer information including the Personal Information collected herein shall be transferred accordingly.</p>
				<div class="fs24 mb-16 fw-500">Business Partners and Third-Party Vendors:</div>
				<p class="mt-3">We may also share certain filtered Personal Information with our corporate affiliates or business partners who may contact the customers to offer certain products or services, which may include free or paid products/services, which will enable the customer to have a better travel experience or to avail certain benefits specially made for Travell customers.</p>
				<p class="mt-3">Examples of such partners are entities offering co-branded credit cards, travel insurance, insurance cover against loss of wallet, banking cards, or similar sensitive information, etc. If you choose to avail of any such services offered by our business partners, the services so availed will be governed by the privacy policy of the respective service provider.</p>
				<p class="mt-3">Travell may share your Personal Information with a third party that Travell may engage to perform certain tasks on its behalf, including but not limited to payment processing, data hosting, and data processing platforms.</p>
				<p class="mt-3">We use non-identifiable Personal Information of Users in aggregate or anonymized form to build higher quality, more useful online services by performing statistical analysis of the collective characteristics and behavior of our customers and visitors, and by measuring demographics and interests regarding specific areas of the Website.</p>
				<p class="mt-3">We may provide anonymous statistical information based on this data to suppliers, advertisers, affiliates, and other current and potential business partners. We may also use such aggregate data to inform these third parties as to the number of people who have seen and clicked on links to their websites.</p>
				<p class="mt-3">Any Personal Information which we collect and which we may use in an aggregated format is our property. We may use it, in our sole discretion and without any compensation to you, for any legitimate purpose including without limitation the commercial sale thereof to third parties.</p>
				<p class="mt-3">Occasionally, Travell will hire a third party for market research, surveys, etc., and will provide information to these third parties specifically for use in connection with these projects. The information (including aggregate cookie and tracking information) we provide to such third parties, alliance partners, or vendors is protected by confidentiality agreements and such information is to be used solely for completing the specific project, and in compliance with the applicable regulations.</p>
				<div class="fs24 mb-16 fw-500">Disclosure of Information</div>
				<p class="mt-3">In addition to the circumstances described above, Travell may disclose User's Personal Information if required to do so:</p>
				<ul>
					<li>By law, required by any enforcement authority for investigation, by court order, or about any legal process.</li>
					<li>To conduct our business</li>
					<li>For regulatory, internal compliance, and audit exercise(s)</li>
					<li>To secure our systems</li>
					<li>Or, to enforce or protect our rights or properties of Travell or any or all of its affiliates, associates, employees, directors, or officers or when we have reason to believe that disclosing Personal Information of User(s) is necessary to identify, contact or bring legal action against someone who may be causing interference with our rights or properties, whether intentionally or otherwise, or when anyone else could be harmed by such activities</li>
				</ul>
				<p class="mt-3">Such disclosure and storage may take place without your knowledge. In that case, we shall not be liable to you or any third party for any damages howsoever arising from such disclosure and storage.</p>

				<div class="fs24 mb-16 fw-500">USER GENERATED CONTENT</div>
				<p class="mt-3">Travell provides an option for its users to post their experiences by way of reviews, ratings, and general poll questions. The customers also have an option of posting questions w.r.t a service offered by Travell or posting answers to questions raised by other users.</p>
				<p class="mt-3">Travell may also hire a third party to contact you and gather feedback about your recent booking with Travell. Though participation in the feedback process is purely optional, you may still receive emails, and notifications (app, SMS, Whatsapp, or any other messaging service) for you to share your review(s), and answer questions posted by other users.</p>
				<p class="mt-3">Or, the reviews may be written or in a video format. The reviews written or posted may also be visible on other travel or travel-related platforms.</p>
				<p class="mt-3">The UGC that Travell collects may be of the following kinds:</p>
				<ul>
					<li>Review and Ratings</li>
					<li>Question and Answers</li>
					<li>Crowd Source Data Collection (poll questions).</li>
				</ul>
				<p class="mt-3">Each User who posts reviews or ratings, Q&amp;A, or photographs shall have a profile, which other Users will be able to access. Other Users may be able to view the number of trips, reviews written, questions asked and answered and photographs posted.</p>

				<div class="fs24 mb-16 fw-500">HOW CAN YOU OPT OUT OF RECEIVING OUR PROMOTIONAL E-MAILS?</div>
				<p class="mt-3">You will occasionally receive e-mail updates from us about fare sales in your area, special offers, new Travell services, and other noteworthy items. We hope you will find these updates interesting and informative. If you wish not to receive them, please click on the "unsubscribe" link or follow the instructions in each e-mail message.</p>

				<div class="fs24 mb-16 fw-500">PERMISSIONS REQUIRED FOR USING OUR MOBILE APPLICATIONS</div>
				<p class="mt-3">When the Travell app is installed on your phone or tablet, a list of permissions appears and is needed for the app to function effectively. There is no option to customize the list. The permissions that Travell requires and the data that shall be accessed and its use are as below:</p>
				<div class="fs24 mb-16 fw-500">Android Permissions:</div>
				<p class="mt-3">Device &amp; App history: We need your device permission to get information about your device, like OS (operating system) name, OS version, mobile network, hardware model, unique device identifier, preferred language, etc. Basis these inputs, we intend to optimize your travel booking experience, and use OS-specific capabilities to drive great in-funnel experiences using components of the device’s OS, etc.</p>
				<p class="mt-3">Identity: This permission enables us to know about the details of your account(s) on your mobile device. We use this info to auto-fill your email IDs and provide a typing-free in-funnel experience. It helps us map email IDs to a particular user to give you the benefit of exclusive travel offers, wallet cash-backs, etc. It also allows facilitating your Facebook and Google login.</p>
				<p class="mt-3">Location: This permission enables us to give you the benefit of location-specific deals and provide you with a personalized in-funnel experience. When you launch the Travell app to make a travel booking, we auto-detect your location so that your nearest airport or city is auto-filled. We also require this permission to recommend your nearest hotels in case you are running late and want to make a quick last-minute booking for the nearest hotel. Your options are personalized basis your location. For international travel, this enables us to determine your time zone and provide information accordingly.</p>
				<p class="mt-3">SMS: If you allow us to access your SMS, we read your SMS to autofill or prepopulate ‘OTP’ while making a transaction and validate your mobile number. This provides you a seamless purchase experience while making a booking and you don’t need to move out of the app to read the SMS and then enter it in the app.</p>
				<p class="mt-3">Phone: The app requires access to make phone calls so that you can make phone calls to hotels, airlines, and our customer contact centers directly through the app.</p>
				<p class="mt-3">Contacts: If you allow us to access your contacts, it enables us to provide a lot of social features to you such as sharing your hotel/ flight/ holidays with your friends, inviting your friends to try our app, sending referral links to your friends, etc. We may also use this information to make recommendations for hotels where your friends have stayed. This information will be stored on our servers and synced from your phone.</p>
				<p class="mt-3">Photo/ Media/ Files: The libraries in the app use these permissions to allow map data to be saved to your phone's external storage, like SD cards. By saving map data locally, your phone doesn't need to re-download the same map data every time you use the app. This provides you with a seamless Map-based Hotel selection experience, even on low-bandwidth networks.</p>
				<p class="mt-3">Wi-Fi connection information: When you allow us the permission to detect your Wi-Fi connection, we optimize your experience such as more detailing on maps, better image loading, more hotel/ flights/ package options to choose from, etc.</p>
				<p class="mt-3">Device ID &amp; Call information: This permission is used to detect your Android ID through which we can uniquely identify users. It also lets us know your contact details using which we pre-populate specific fields to ensure a seamless booking experience.</p>
				<p class="mt-3">Calendar: This permission enables us to put your travel plan on your calendar.</p>


				<div class="fs24 mb-16 fw-500">iOS Permissions:</div>
				<p class="mt-3">Notifications: If you have opt-in for notifications, it enables us to send exclusive deals, promotional offers, travel-related updates, etc. on your device. If you do not opt for this, updates for your travel like PNR status, booking confirmation, refund (in case of cancellation), etc. will be sent through SMS.</p>
				<p class="mt-3">Contacts: If you opt-in for contacts permission, it enables us to provide a lot of social features to you such as sharing your hotel/ flight/ holidays with your friends, inviting your friends to try our app, sending referral links to your friends, etc. We will also use this information to make recommendations for hotels where your friends have stayed. This information will be stored on our servers and synced from your phone.</p>
				<p class="mt-3">Location: This permission enables us to give you the benefit of location-specific deals and provide you with a personalized in-funnel experience. When you launch our app to make a travel booking, we auto-detect your location so that your nearest Airport or City is auto-filled. We require this permission to recommend your nearest hotels in case you are running late and want to make a quick last-minute booking for the nearest hotel. Your options are personalized basis your location. For international travel, this enables us to determine your time zone and provide information accordingly.</p>

				<div class="fs24 mb-16 fw-500">HOW WE PROTECT YOUR PERSONAL INFORMATION?</div>
				<p class="mt-3">All payments on the Website are secured. This means all Personal Information you provide is transmitted using TLS (Transport Layer Security) encryption. TSL is a proven coding system that lets your browser automatically encrypt, or scramble, data before you send it to us.</p>
				<p class="mt-3">The website has stringent security measures in place to protect the loss, misuse, and alteration of the information under our control. Whenever you change or access your account information, we offer the use of a secure server. Once your information is in our possession we adhere to strict security guidelines, protecting it against unauthorized access.</p>

				<div class="fs24 mb-16 fw-500">WITHDRAWAL OF CONSENT AND PERMISSION</div>
				<p class="mt-3">You may withdraw your consent to submit any or all Personal Information or decline to provide any permissions on its Website as covered above at any time. In case, you choose to do so then your access to the Website may be limited, or we might not be able to provide the services to you. You may withdraw your consent by sending an email to <a href="mailto:travell@outlook.in">travell@outlook.in</a>.</p>

				<div class="fs24 mb-16 fw-500">YOUR RIGHTS QUA PERSONAL INFORMATION</div>
				<p class="mt-3">You may access your Personal Information from your user account with Travell. You may also correct your personal information or delete such information (except some mandatory fields) from your user account directly. If you don’t have such a user account, then you write to <a href="mailto:travell@outlook.in">travell@outlook.in</a>.</p>

				<div class="fs24 mb-16 fw-500">ELIGIBILITY TO TRANSACT WITH Travell</div>
				<p class="mt-3">You must be at least 18 years of age to transact directly with Travell and also to consent to the processing of your personal data. We do not knowingly collect personal information from Children. If we learn that we have collected personal information from a Child, we will delete the same from our database at the earliest. If you believe that we may have collected personal information from a child, please inform us at <a href="mailto:travell@outlook.in">travell@outlook.in</a>.</p>

				<div class="fs24 mb-16 fw-500">CHANGES TO THE PRIVACY POLICY</div>
				<p class="mt-3">We reserve the right to revise the Privacy Policy from time to time to suit various legal, business, and customer requirements. We will duly notify the users as may be necessary.</p>
            </div>
        </div>
    </div>
    <!-- start footer  -->
    @include('footer')
    <!-- end footer  -->

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <!-- nav js -->
  <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
  <script src="{{ asset('/public/css/hotel-css/t-datepicker.min.js')}}"></script>
  <script src="{{ asset('/public/js/datepicker-homepage.js')}}"></script>
  <script src="{{ asset('/public/js/custom.js')}}"></script>
 <!-- end nav js -->



</body>

</html>
