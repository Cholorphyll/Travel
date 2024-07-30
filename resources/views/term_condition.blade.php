<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Terms &amp; Conditions - Travell</title>

    <link rel="icon" type="image/x-icon" href="{{asset('/favicon.ico')}}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <!--  fontawesome -->
    <script src="https://kit.fontawesome.com/b73881b7c2.js" crossorigin="anonymous"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick-theme.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/slick-lightbox/0.2.12/slick-lightbox.css" rel="stylesheet" />
    
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

@include('Loc_nav.loc_navbar')

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
    </div>-->
    <div class="container">
        <div class="row justify-content-between mt-md-64px">

            <div class="col-md-12">
                <div class="fs-32 mb-32"><b>Term and Conditions</b></div>
                <p class="mt-3">Welcome to the Travell websites and mobile properties located at <a
                        href="https://www.travell.co/">www.travell.co</a> and applicable country top level domains
                    (including sub-domains associated with them), related software applications (sometimes referred
                    to as “apps”), data, SMS, APIs, email, chat and telephone correspondence, buttons, widgets and
                    ads (collectively, all of these items shall be referred to herein as the “Services”; more
                    generally, the Travell website and mobile properties shall hereinafter be referred to herein as
                    “websites”).</p>

                <p class="mt-3">The Services are offered to you conditioned upon your acceptance of the terms,
                    conditions, and notices set forth below (collectively, this “Agreement”). By accessing or using
                    the Services, you agree to be bound by this Agreement and represent that you have read and
                    understood its terms.</p>

                <p class="mt-3">Please read this Agreement carefully, as it contains information concerning your
                    legal rights and limitations on these rights, as well as a section regarding applicable law and
                    jurisdiction of disputes.</p>

                <p class="mt-3">If you do not accept all of these terms and conditions, you are not authorized to
                    use the Services. If you have a Travell account and wish to terminate this Agreement, you can do so
                    at any time by closing your account and no longer accessing or using the Services.</p>

                <p class="mt-3">Any information, text, links, graphics, photos, audio, videos, data, code, or other
                    materials or arrangements of materials that you can view on, access, or otherwise interact with
                    through the Services shall be referred to as “Content”. The terms “we”, “us”, “our” and “Travell”
                    refer to Travell LLC, a limited liability company located in the India (“Travell”).</p>

                <p class="mt-3">“Services” as defined above refers to those provided by Travell or our corporate
                    affiliates (Travell and such entities, when one or more are referred to, shall be collectively
                    defined as the “Travell LLC”). For the avoidance of doubt, the websites are all owned and
                    controlled by Travell.</p>

                <p class="mt-3">However, some specific Services made available via the websites may be owned and
                    controlled by Travell’s corporate affiliates, for example, Services facilitating the booking of
                    Vacation Rentals, Restaurant Reservations, and Experiences with third-party suppliers (see
                    below).</p>

                <p class="mt-3">As part of our Services, we may send you notifications about special offers,
                    products, or additional services available from us, our affiliates, or our partners, that may be
                    of interest to you. Such notifications will typically be sent through newsletters and marketing
                    communications and represent efforts to get to know you and your preferences better across our
                    Services and those of our affiliates. In turn, this enables customization of the services in
                    line with those preferences.</p>

                <p class="mt-3">The term “you” refers to the individual, company, business organization, or other
                    legal entity using the Services and/or contributing Content to them. The Content that you
                    contribute, submit, transmit and/or post to or through the Services shall be referred to
                    variously as “your Content”, “Content of yours”, and/or “Content you submit.”</p>

                <p class="mt-3">The Services are provided solely to:</p>

                <ol>
                    <li>Assist customers in gathering travel information, posting Content, and searching for and
                        booking travel services and reservations.</li>
                    <li>Assist travel, tourism, and hospitality businesses in engaging with customers and potential
                        customers, by way of free and/or paid-for services offered by or through the Travell LLC.</li>
                </ol>

                <p class="mt-3">We may change or otherwise modify this Agreement in the future in accordance with
                    the terms and conditions herein, and you understand and agree that your continued access or use
                    of the Services after such change signifies your acceptance of the updated or modified
                    Agreement.</p>

                <p class="mt-3">We will note the date that revisions were last made to this Agreement at the bottom
                    of this Agreement, and any revisions will take effect upon posting.</p>

                <p class="mt-3">We will notify registered users of our Services (such registered users to be
                    referred to as “Account Holders”) of material changes to these terms and conditions by either
                    sending a notice to the email address associated with the Account Holder’s profile or by placing
                    a notice on our websites. Be sure to return to this page periodically to review the most current
                    version of this Agreement.</p>


                <div class="fs24 mb-16 fw-500">Use of the Services</div>
                <p class="mt-3">As a condition of your use of the Services, you warrant that</p>
                <ol>
                    <li>All information supplied by via the Services to the Travell LLC is true, accurate, current and
                        complete.</li>
                    <li>If you are an Account Holder, you will safeguard your account information and will supervise
                        and be completely responsible for any use of your account by anyone other than you.</li>
                    <li>You are 13 years of age or older (in some jurisdictions, local laws may have an older age
                        requirement) in order to register for an account, use the Services and contribute to our
                        websites.</li>
                    <li>You possess the legal authority to enter into this Agreement and to use the Services,
                        including our websites in accordance with all terms and conditions herein.</li>
                </ol>

                <p class="mt-3">The Travell LLC does not knowingly collect the information of anyone under the age of
                    13. We retain the right at our sole discretion to deny anyone access to the Services, at any
                    time and for any reason, including, but not limited to, for violation of this Agreement. By
                    using the Services, including any products or services that facilitate the sharing of Content to
                    or from third-party sites, you understand that you are solely responsible for any information
                    that you share with Travell LLC. You may access the Services solely as intended through the
                    provided functionality of the Services and as permitted under this Agreement.</p>

                <p class="mt-3">Copying, transmission, reproduction, replication, posting or redistribution of</p>

                <ol>
                    <li>Content or any portion thereof and/or</li>
                    <li>the Services more generally are strictly prohibited without the prior written permission of
                        Travell LLC.</li>
                </ol>


                <p class="mt-3">To request permission, please direct your request to:</p>

                <p class="mt-3">Travell LLC</p>

                <p class="mt-3">SCO 10, Industrial Area Phase 2nd</p>
				<p class="mt-3">Chandigarh - 160002</p>

                <p class="mt-3">In order to access certain features of the Services, you will need to become an
                    Account Holder by creating an account. When you create an account, you must provide complete and
                    accurate information. You are solely responsible for the activity that occurs on your account,
                    including your interaction and communication with others, and you must safeguard your account.
                    Towards this end, if you are an Account Holder, you agree to keep your contact information up to
                    date. </p>

                <p class="mt-3">If you are creating a Travell account for commercial purposes and are accepting this
                    Agreement on behalf of a company, organization, or other legal entity, you represent and warrant
                    that you are authorized to do so and have the authority to bind such entity to this Agreement,
                    in which case the words “you” and “your” as used in this Agreement shall refer to such entity
                    and the individual acting on behalf of the company shall be referred to as a “Business
                    Representative.”</p>

                <p class="mt-3">Through your use of the Services, you may encounter links to third-party sites and
                    apps or be able to interact with third-party sites and apps. This may include the ability to
                    share Content from the Services, including your Content, with such third-party sites and apps.
                    Please be aware that third-party sites and apps may publicly display such shared Content. Such
                    third parties may charge a fee for the use of certain content or services provided on or by way
                    of their websites.</p>

                <p class="mt-3">Therefore, you should make whatever investigation you feel is necessary or
                    appropriate before proceeding with any transaction with any third party to determine whether a
                    charge will be incurred. Where the Travell LLC provides details of fees or charges for such
                    third-party content or services, such information is provided for convenience and information
                    purposes only.</p>

                <p class="mt-3">Any interactions with third-party sites and apps are at your own risk. You expressly
                    acknowledge and agree that Travell LLC is in no way responsible or liable for any such third-party
                    sites or apps.</p>

                <p class="mt-3">Some Content you see or otherwise access on or through the Services is used for
                    commercial purposes. You agree and understand that the Travell LLC may place advertising and
                    promotions on the Services alongside, near, adjacent, or otherwise in close proximity to your
                    Content (including, for video or other dynamic content, before, during, or after its
                    presentation), as well as the Content of others.</p>

                <div class="fs24 mb-16 fw-500">Additional Products</div>

                <p class="mt-3">The Travell LLC may, from time to time, decide to change, update, or discontinue
                    certain products and features of the Services. You agree and understand that Travell LLC has no
                    obligation to store or maintain your Content or other information you provide, except to the
                    extent required by applicable law.</p>

                <p class="mt-3">We also offer other services that may be governed by additional terms or agreements.
                    If you use any other such services, the additional terms will be made available and will become
                    part of this Agreement, except where such additional terms expressly exclude or otherwise
                    supersede this Agreement.</p>

                <p class="mt-3">For example, if you use or purchase such additional services for commercial or
                    business purposes, you must agree to the applicable additional terms. To the extent any other
                    terms conflict with the terms and conditions of this Agreement, the additional terms shall
                    govern to the extent of the conflict with respect to those specific services.</p>

                <div class="fs24 mb-16 fw-500">Prohibited Activities</div>

                <p class="mt-3">The Content and information available on and through the Services (including, but
                    not limited to, messages, data, information, text, music, sound, photos, graphics, video, maps,
                    icons, software, code, or other material), as well as the infrastructure used to provide such
                    Content and information, is proprietary to the Travell LLC or licensed to the Travell LLC by third
                    parties.</p>

                <p class="mt-3">For all Content other than your Content, you agree not to otherwise modify, copy,
                    distribute, transmit, display, perform, reproduce, publish, license, create derivative works
                    from, transfer, or sell or re-sell any information, software, products, or services obtained
                    from or through the Services. Additionally, you agree not to:</p>

                <ol>
                    <li>Use the Services or Content for any commercial purpose, outside the scope of those
                        commercial purposes explicitly permitted under this Agreement and related guidelines as made
                        available by the Travell LLC.</li>
                    <li>Access, monitor, reproduce, distribute, transmit, broadcast, display, sell, license, copy,
                        or otherwise exploit any Content of the Services, including but not limited to, user
                        profiles and photos, using any robot, spider, scraper or other automated means or any manual
                        process for any purpose not in accordance with this Agreement or without our express written
                        permission.</li>
                    <li>Violate the restrictions in any robot exclusion headers on the Services or bypass or
                        circumvent other measures employed to prevent or limit access to the Services.</li>
                    <li>Take any action that imposes, or may impose, at our discretion, an unreasonable or
                        disproportionately large load on our infrastructure.</li>
                    <li>Deep-link to any portion of the Services for any purpose without our express written
                        permission.</li>
                    <li>"frame", "mirror" or otherwise incorporate any part of the Services into any other websites
                        or service without our prior written authorization.</li>
                    <li>Attempt to modify, translate, adapt, edit, decompile, disassemble, or reverse engineer any
                        software programs used by the Travell LLC in connection with the Services.</li>
                    <li>Circumvent, disable, or otherwise interfere with security-related features of the Services
                        or features that prevent or restrict the use or copying of any Content.</li>
                    <li>Download any Content unless it’s expressly made available for download by the Travell LLC.</li>
                </ol>

                <div class="fs24 mb-16 fw-500">Privacy Policy and Discloser</div>


                <p class="mt-3">Any personal information you post on or otherwise submit in connection with the
                    Services will be used in accordance with our Privacy Policy. View our <a
                        href="https://www.travell.co/privacy">Privacy Policy</a>.</p>

                <div class="fs24 mb-16 fw-500">Review, Comments and Use of other Interactive Areas; Licence grant
                </div>

                <p class="mt-3">We appreciate hearing from you. Please be aware that by providing your Content to or
                    through the Services, be it via email, posting via any Travell synchronization product, via the
                    services and applications of others, or otherwise, including any of your Content that is
                    transmitted to your Travell account by virtue of any Travell LLC product or service, reviews,
                    questions, photographs or videos, comments, suggestions, ideas or the like contained in any of
                    your Content, you grant the Travell LLC a nonexclusive, royalty-free, perpetual, transferable,
                    irrevocable and fully sublicensable right to</p>

                <ol>
                    <li>Host, use, reproduce, modify, run, adapt, translate, distribute, publish, create derivative
                        works from, and publicly display and perform such Content of yours throughout the world in
                        any media, now known or hereafter devised.</li>
                    <li>Make your Content available to the rest of the world and let others do the same.</li>
                    <li>To provide, promote, and improve the Services and to make your Content shared on the
                        Services available to other companies, organizations, or individuals for the syndication,
                        broadcast, distribution, promotion, or publication of such Content of yours on other media
                        and services, subject to our Privacy Policy and this Agreement.</li>
                    <li>Use the name and/or trademark that you submit in connection with such Content of yours. You
                        acknowledge that Travell may choose to provide attribution of your Content at our discretion.
                        You further grant the Travell LLC the right to pursue at law any person or entity that violates
                        your or the Travell LLC’s rights in your Content by a breach of this Agreement. You acknowledge
                        and agree that your Content is non-confidential and non-proprietary. You affirm, represent,
                        and warrant that you own or have the necessary licenses, rights (including copyright and
                        other proprietary rights), consents, and permissions to publish and otherwise use (and for
                        the Travell LLC to publish and otherwise use) your Content as authorized under this Agreement.
                    </li>
                </ol>

                <p class="mt-3">If it is determined that you retain moral rights (including rights of attribution or
                    integrity) in your Content, you hereby declare that, to the extent permitted by applicable law
                </p>

                <ol>
                    <li>You do not require that any personally identifying information be used in connection with
                        the Content, or any derivative works of or upgrades or updates thereto.</li>
                    <li>You have no objection to the publication, use, modification, deletion, and exploitation of
                        your Content by the Travell LLC or their licensees, successors, and assigns.</li>

                    <li>You forever waive and agree not to claim or assert any entitlement to any and all moral
                        rights of an author in any of your Content.</li>

                    <li>You forever release the Travell LLC and their licensees, successors, and assigns, from any
                        claims that you could otherwise assert against the Travell LLC by virtue of any such moral
                        rights.</li>
                </ol>


                <p class="mt-3">Note that any feedback and other suggestions you provide may be used at any time and
                    we are under no obligation to keep them confidential.</p>

                <p class="mt-3">The Services may contain discussion forums, bulletin boards, review services, travel
                    feeds, or other forums in which you may post your Content, such as reviews of travel
                    experiences, messages, materials, or other items ("Interactive Areas"). If Travell provides such
                    Interactive Areas on the websites, you are solely responsible for your use of such Interactive
                    Areas and use them at your own risk. The Travell LLC does not guarantee any confidentiality with
                    respect to any of the Content you provide to the Services or in any Interactive Area.</p>



                <p class="mt-3">To the extent that any entity that is one of the Travell LLC provides any form of
                    private communication channel between Account Holders, you agree that such entity(ies) may
                    monitor the substance of such communications in order to help safeguard our community and the
                    Services.</p>

                <p class="mt-3">You understand that Travell LLC does not edit or control the user messages posted to or
                    distributed through the Services, including through any chat rooms, bulletin boards, or other
                    communications forums, and will not be in any way responsible or liable for such messaging. In
                    particular, Travell does not edit or control users’ Content that appears on the websites.</p>

                <p class="mt-3">The Travell LLC nevertheless reserves the right to remove without notice any such
                    messaging or other Content from the Services, where they believe in good faith that such Content
                    breaches this Agreement or otherwise believe the removal is reasonably necessary to safeguard
                    the rights of the Travell LLC and/or other users of the Services.</p>

                <p class="mt-3">Should you disagree with the removal of your Content from the websites, you may
                    contact Travell using the Help Center to make your objections. By using any Interactive Areas, you
                    expressly agree only to submit Content that complies with Travell’s published guidelines, as are in
                    force at the time of submission and made available to you by Travell. You expressly agree not to
                    post, upload to, transmit, distribute, store, create or otherwise publish through the Services
                    any Content of yours that:</p>

                <ol>
                    <li>Is false, unlawful, misleading, libelous, defamatory, obscene, pornographic, indecent, lewd,
                        suggestive, harassing (or advocates harassment of another person), threatening, invasive of
                        privacy or publicity rights, abusive, inflammatory, fraudulent or otherwise objectionable.
                    </li>
                    <li>Is patently offensive to the online community, such as that which promotes racism, bigotry,
                        hatred, or physical harm of any kind against any group or individual.</li>
                    <li>Would constitute, encourage, promote, or provide instructions for the conduct of an illegal
                        activity, a criminal offense, give rise to civil liability, violate the rights of any party
                        in any country of the world, or that would otherwise create liability or violate any local,
                        state, national or international law, including, without limitation, the regulations of the
                        U.S. Securities and Exchange Commission (SEC) or any rules of any securities exchange,
                        including but not limited to, the New York Stock Exchange (NYSE), the NASDAQ or the London
                        Stock Exchange.</li>
                    <li>Provides instructional information about illegal activities such as making or buying illegal
                        weapons, violating someone’s privacy, or providing or creating computer viruses.</li>
                    <li>May infringe any patent, trademark, trade secret, copyright, or other intellectual or
                        proprietary right of any party. In particular, content that promotes an illegal or
                        unauthorized copy of another’s copyrighted work, such as providing pirated computer programs
                        or links to them, providing information to circumvent manufacturer-installed copy-protect
                        devices, or providing pirated music or links to pirated music files.</li>
                    <li>Constitutes mass mailings or “spamming”, “junk mail”, “chain letters” or “pyramid schemes”.
                    </li>
                    <li>Impersonates any person or entity or otherwise misrepresents your affiliation with a person
                        or entity, including the Travell LLC.</li>
                    <li>Is private information of any third party, including, without limitation, addresses, phone
                        numbers, email addresses, Social Security numbers, and credit card numbers. Note that an
                        individual’s surname (family name) may be posted to our websites, but only where express
                        permission of the identified individual has been secured beforehand.</li>
                    <li>Contains restricted or password-only access pages, or hidden pages or images (those not
                        linked to or from another accessible page).</li>
                    <li>Include or are intended to facilitate viruses, corrupted data, or other harmful, disruptive,
                        or destructive files;</li>
                    <li>Is unrelated to the topic of the Interactive Area(s) in which such Content is posted.</li>
                    <li>In the sole judgment of Travell</li>
                </ol>

                <ul>
                    <li>(a) violates the previous subsections herein</li>
                    <li>(b) violates Travell’s related guidelines as made available to you by Travell</li>
                    <li>(c) is objectionable</li>
                    <li>(d) restricts or inhibits any other person from using or enjoying the Interactive Areas or
                        any other aspect of the Services</li>
                    <li>(e) may expose any of the Travell LLC or their users to any harm or liability of any type.</li>
                </ul>

                <p class="mt-3">The Travell LLC take no responsibility and assume no liability for any Content posted,
                    stored, transmitted or uploaded to the Services by you (in the case of your Content) or any
                    third party (in the case of any and all Content more generally), or for any loss or damage
                    thereto, nor are the Travell LLC liable for any mistakes, defamation, slander, libel, omissions,
                    falsehoods, obscenity, pornography or profanity you may encounter.</p>
                <p class="mt-3">As a provider of interactive services, Travell is not liable for any statements,
                    representations or any other Content provided by its users (including you as to your Content) in
                    the websites or any other forum.</p>
                <p class="mt-3">Although the Travell has no obligation to screen, edit or monitor any of the Content
                    posted to or distributed through any Interactive Area, Travell reserves the right, and has absolute
                    discretion, to remove, screen, translate or edit without notice any Content posted or stored on
                    the Services at any time and for any reason, or to have such actions performed by third parties
                    on their behalf, and you are solely responsible for creating backup copies of and replacing any
                    Content you post or otherwise submit to us or store on the Services at your sole cost and
                    expense.</p>
                <p class="mt-3">Any use of the Interactive Areas or other aspects of the Services in violation of
                    the foregoing violates the terms of this Agreement and may result in, among other things,
                    termination or suspension of your rights to use the Interactive Areas and/or the Services more
                    generally.</p>

                <ul>
                    <li>Restricting Travell’s Licence Rights</li>
                    <p class="mt-3">You may elect on a going forward basis to limit the Travell LLC’ use of your
                        Content under this Agreement (as described above) by opting to provide the Travell LLC with a
                        more limited license as described further below (such limited license to be referred to
                        herein as a “Restricted License”).</p>
                    <p class="mt-3">You may make this election by selecting such Restricted License grant here (note
                        that to do so you shall need to be logged into your account).</p>
                    <p class="mt-3">If you make this election, the rights you grant the Travell LLC to your Content
                        pursuant to the license terms set forth above (referred to as the “Standard License”) shall
                        be limited in some important ways described in paragraphs 1 through 6 directly below, such
                        that the Travell LLC shall not hold a Standard License to any of your Content other than the
                        text-based reviews and associated bubble ratings you post (as to which the Travell LLC shall
                        continue to be granted a Standard License), but shall be granted a “Restricted License” as
                        to the balance of your Content as defined below: </p>

                    <ol>
                        <li>When you post your Content to the Services, the license you grant the Travell LLC in Your
                            Content shall be limited to a nonexclusive, royalty-free, transferable, sublicensable,
                            and worldwide license to host, use, distribute, modify, run, reproduce, publicly display
                            or perform, translate, and create derivative works of your Content for purposes of
                            displaying such on the Services, as well as using your name and/or trademark in
                            connection with that Content. Subject to Paragraph 6 below, the Restricted License
                            applies to any of your Content (again, other than text-based reviews and associated
                            bubble ratings) you or another on your behalf (e.g., a third party that contributes to
                            or otherwise manages your account) make available on or in connection with the Services.
                        </li>
                        <li>As to any individual item of your Content that is subject to the Restricted License, you
                            can terminate the Travell LLC’ license rights hereunder to such by deleting such post from
                            the Services. Correspondingly, you may terminate the Travell LLC’ license rights in all of
                            your Content that is subject to the Restricted License by terminating your account (a
                            description of how to do so is available here). Notwithstanding anything to the
                            contrary, your Content (a) shall remain on the Services to the extent you shared it with
                            others and they copied it or stored it prior to you deleting it or terminating your
                            account, (b) may continue to be displayed upon the Services for a reasonable amount of
                            time after you delete it or terminate your account as we seek to remove it, and/or (c)
                            may be retained (but not publicly displayed) for technical, fraud moderation, regulatory
                            or legal reasons in backup copy form for a period of time.</li>
                        <li>The Travell LLC will not use your Content in advertisements for the products and services
                            of third parties to others without your separate consent (including sponsored Content),
                            although you agree and understand that the Travell LLC may place advertising and promotions
                            on the Services alongside, near, adjacent, or otherwise in close proximity to your
                            Content (including, for video or other dynamic content, before, during or after its
                            presentation), as well as the Content of others. In all instances in which your Content
                            is displayed on the Services, we shall provide attribution by using the name and/or
                            trademark that you submit in connection with your Content.</li>
                        <li>The Travell LLC will not give third parties the right to publish your Content beyond the
                            Services. However, sharing your Content on the Services (save for our “Trips” feature,
                            which can be made private) shall result in your Content being made "public" and we will
                            enable a feature that allows other users to share (by way of embedding that public post
                            or otherwise) such Content of yours (save, as noted, Trips you configure to be private)
                            onto third-party services, and we will enable search engines to make that public Content
                            of yours findable through their services.</li>
                        <li>Except as modified by paragraphs 1 through 6 of this section of this Agreement, your and
                            our rights and obligations shall remain subject to the balance of the terms of this
                            Agreement. The license you grant the Travell LLC as modified by paragraphs 1-6 shall be
                            referred to as a “Restricted License”.</li>
                        <li>For the sake of clarity, the Content you submit to the Services in connection with other
                            Travell LLC services or programs is not subject to the Restricted License, but shall
                            instead be governed by the terms and conditions associated with that specific Travell
                            service or program.</li>
                    </ol>

                </ul>
                <div class="fs24 mb-16 fw-500">Booking with Third-Party Suppliers through Travell</div>
                <ul>
                    <li>Use of Travell Booking Services</li>
                    <p class="mt-3">The Travell LLC offers you the ability to search for, select, and book travel
                        reservations with third-party suppliers without leaving the Services. By booking travel
                        reservations via the websites, you will become an Account Holder if you are not one already.
                    </p>
                    <p class="mt-3">By booking via the websites, you acknowledge that you accept the practices
                        described in our Privacy Policy and this Agreement. In addition, you warrant, either in your
                        individual capacity or as a Business Representative, that you are 18 years of age or older,
                        that you possess the legal authority to enter into this Agreement and use the Services
                        (including the Travell LLC’ booking facilitation services) in accordance with this Agreement,
                        and that all information you supply is true and accurate.</p>
                    <p class="mt-3">You further agree that you will use the Travell LLC’ booking facilitation services
                        only to make legitimate reservations for you or others for whom you are legally authorized
                        to act. Any false or fraudulent reservation is prohibited, and any user who attempts such a
                        reservation may have his or her account terminated.</p>
                    <p class="mt-3">AS A USER OF THE SERVICES, INCLUDING Travell COMPANIES’ BOOKING FACILITATION
                        SERVICES, YOU UNDERSTAND AND AGREE THAT:
                    </p>
                    <ol>

                        <li>THE Travell COMPANIES WILL NOT HAVE ANY LIABILITY TO YOU OR OTHERS FOR ANY UNAUTHORIZED
                            TRANSACTIONS MADE USING YOUR PASSWORD OR ACCOUNT.</li>
                        <li>THE UNAUTHORIZED USE OF YOUR PASSWORD OR ACCOUNT COULD CAUSE YOU TO INCUR LIABILITY TO
                            Travell, ITS CORPORATE AFFILIATES AND/OR OTHERS.</li>

                    </ol>
                    <p class="mt-3">When you book a reservation facilitated by Travell LLC, your payment information
                        will be collected and transmitted to the supplier to complete the transaction, as described
                        in our Privacy Policy. Please note that the supplier, not the Travell LLC, is responsible for
                        processing your payment and fulfilling your reservation</p>
                    <p class="mt-3">The Travell LLC will not interfere with reservations arbitrarily but reserve the
                        right to withdraw booking facilitation services because of certain extenuating
                        circumstances, such as when a reservation is no longer available or when we have reasonable
                        cause to suspect that a reservation request may be fraudulent. The Travell LLC also reserves
                        the right to take steps to verify your identity to process your reservation request.</p>
                    <p class="mt-3">In the unlikely event that a reservation is available when you place an order
                        but become unavailable prior to check-in, your sole remedy will be to contact the supplier
                        to make alternative arrangements or to cancel your reservation.</p>

                    <li>Third-Party Suppliers</li>
                    <p class="mt-3">The Travell LLC is not a travel agency and does not provide or own transportation
                        services, accommodations, restaurants, tours, activities, or experiences. Although the Travell
                        LLC displays information about properties owned by third-party suppliers and facilitates
                        reservations with certain suppliers on or through the Travell LLC’s websites, such actions do
                        not in any way imply, suggest, or constitute the Travell LLC’s sponsorship or approval of
                        third-party suppliers, or any affiliation between the Travell LLC and third-party suppliers.
                    </p>

                    <p class="mt-3">Although Account Holders may rate and review particular transportation services,
                        accommodations, restaurants, tours, activities, or experiences based on their own
                        experiences, the Travell LLC does not endorse or recommend the products or services of any
                        third-party suppliers, save that Travell does issue certain businesses awards that are based on
                        the reviews posted by Account Holders.</p>

                    <p class="mt-3">The Travell LLC does not endorse any Content posted, submitted, or otherwise
                        provided by any user or business, or any opinion, recommendation, or advice expressed
                        therein, and the Travell LLC expressly disclaims any and all liability in connection with such
                        Content. You agree that Travell LLC is not responsible for the accuracy or completeness of
                        information they obtain from third-party suppliers and display on the Services.</p>

                    <p class="mt-3">If you book a reservation with a third-party supplier, then in addition to this
                        Agreement, you agree to review and be bound by the supplier’s terms and conditions of
                        purchase and website use, privacy policy, and any other rules or policies related to the
                        supplier’s site or property.</p>

                    <p class="mt-3">Your interactions with third-party suppliers are at your own risk. The Travell LLC
                        will have no liability with respect to the acts, omissions, errors, representations,
                        warranties, breaches, or negligence of any third-party suppliers or for any personal
                        injuries, death, property damage, or other damages or expenses resulting from your
                        interactions with third-party suppliers.</p>

                    <p class="mt-3">The Services may link you to supplier sites or other sites that Travell does not
                        operate or control. For further information, please refer to the “Links to Third-Party
                        Sites” section below.</p>


                    <li>Booking Holiday Rentals, Restaurant Reservations and Experiences with Third- Party Suppliers
                        Listed on Corporate Affiliate Sites</li>

                    <p class="mt-3">Some of Travell’s corporate affiliates act as marketplaces to facilitate travelers’
                        ability to</p>

                    <ol>
                        <li>Enter into vacation rental agreements with property owners and managers (“Vacation
                            Rentals”)</li>
                        <li>Make reservations for restaurants (“Restaurants”) and/or</li>
                        <li>Make reservations for tours, activities and attractions (variously, “Experiences”) with
                            third-party suppliers of such Experiences (each such supplier of a vacation rental
                            and/or Experience to be referred to as an “Advertiser”).</li>
                    </ol>

                    <p class="mt-3">Those corporate affiliates of Travell syndicate their advertisements to other
                        entities within the Travell LLC group and that is why you see them on the Travell LLC’ websites.
                        As a user, you must be responsible for your use of the Services (including, in particular,
                        the Travell LLC’ websites), and any transaction involving Vacation Rentals, Restaurants or
                        Experiences facilitated by Travell’s corporate affiliates. We do not own, manage, or contract
                        for any Vacation Rental, Restaurant or Experience listed on the Services.</p>

                    <p class="mt-3">Because neither Travell nor its corporate affiliates are parties to Vacation Rental
                        transactions, Restaurant reservations or Experience-related transactions between travelers
                        and Advertisers, any dispute or conflict involving an actual or potential transaction
                        between you and an Advertiser, including the quality, condition(s), safety or legality of a
                        listed Vacation Rental, Restaurant or Experience, the accuracy of the listing Content, the
                        Advertiser’s ability to rent a Vacation Rental property, provide you with a reservation,
                        meal or other service at a Restaurant or provide an Experience, or your ability to pay for a
                        Vacation Rental property, a Restaurant meal or service or an Experience, is solely the
                        responsibility of each user.</p>

                    <p class="mt-3">One of Travell’ corporate affiliates may act as an Advertiser’s limited agent
                        solely for the purpose of transmitting your payment to the Advertiser. You agree to pay an
                        Advertiser, or a Travell corporate affiliate acting as limited payment collection agent on
                        behalf of an Advertiser, any specified fee(s) charged by the Advertiser for any Vacation
                        Rental reservation or Experience.</p>

                    <p class="mt-3">For further information on Vacation Rental fees, security deposits, fees for
                        Experiences, payment processing, refunds and the like, please consult our affiliates’ terms
                        and conditions. By making a Vacation Rental reservation, Restaurant reservation or
                        Experience reservation facilitated by one of our corporate affiliates, you will have to
                        acknowledge and agree to its terms and conditions, as well as its privacy policy.</p>

                    <p class="mt-3">If you enter into a dispute with an Advertiser in the EU, alternative methods
                        for resolving that dispute are available online here.</p>


                    <div class="fs24 mb-16 fw-500">TRAVEL DESTINATIONS</div>
                    <ul>
                        <li>International Travel</li>
                        <p class="mt-3">When you book international travel reservations with third-party suppliers
                            or plan international trips using the Services, you are responsible for ensuring that
                            you meet all foreign entry requirements and that your travel documents, including
                            passports and visas, are in order.
                            For passport and visa requirements, please consult the relevant embassy or consulate for
                            information. Because requirements may change at any time, be sure to check for
                            up-to-date information before booking and departure.</p>
                        <p class="mt-3">The Travell LLC accepts no liability for travelers who are refused entry onto a
                            flight or into any country because of the traveler’s failure to carry the travel
                            documents required by any airline, authority, or country, including countries the
                            traveler may just be passing through en route to his or her destination.
                            It is also your responsibility to consult your physician for current recommendations on
                            inoculations before you travel internationally and to ensure that you meet all health
                            entry requirements and follow all medical guidance related to your trip.</p>
                        <p class="mt-3">Although most travel, including travel to international destinations, is
                            completed without incident, travel to certain destinations may involve greater risk than
                            others. Travell urges travelers to investigate and review travel prohibitions, warnings,
                            announcements, and advisories issued by their own governments and destination country
                            governments prior to booking travel to international destinations.</p>
                    
                        <p class="mt-3">BY LISTING INFORMATION RELEVANT TO TRAVEL TO PARTICULAR INTERNATIONAL
                            DESTINATIONS, THE Travell COMPANIES DO NOT REPRESENT OR WARRANT THAT TRAVEL TO SUCH POINTS
                            IS ADVISABLE OR WITHOUT RISK, AND IS NOT LIABLE FOR DAMAGES OR LOSSES THAT MAY RESULT
                            FROM TRAVEL TO SUCH DESTINATIONS.</p>
                    </ul>

                    <div class="fs24 mb-16 fw-500">LIABILITY DISCLAIMER</div>
                    <p class="mt-3">PLEASE READ THIS SECTION CAREFULLY. THIS SECTION LIMITS THE Travell COMPANIES’
                        LIABILITY TO YOU FOR ISSUES THAT MAY ARISE IN CONNECTION WITH YOUR USE OF THE SERVICES. IF
                        YOU DO NOT UNDERSTAND THE TERMS IN THIS SECTION OR ELSEWHERE IN THIS AGREEMENT, PLEASE
                        CONSULT A LAWYER FOR CLARIFICATION BEFORE ACCESSING OR USING THE SERVICES.</p>
                    <p class="mt-3">THE INFORMATION, SOFTWARE, PRODUCTS, AND SERVICES PUBLISHED ON OR OTHERWISE
                        PROVIDED VIA THE SERVICES MAY INCLUDE INACCURACIES OR ERRORS, INCLUDING RESERVATION
                        AVAILABILITY AND PRICING ERRORS.</p>
                    <p class="mt-3">THE Travell COMPANIES DO NOT GUARANTEE THE ACCURACY OF, AND DISCLAIMS ALL LIABILITY
                        FOR, ANY ERRORS OR OTHER INACCURACIES RELATING TO THE INFORMATION AND DESCRIPTION OF THE
                        ACCOMODATION, EXPERIENCES, AIR, CRUISE, RESTAURANT OR ANY OTHER TRAVEL PRODUCTS DISPLAYED ON
                        THE SERVICES (INCLUDING, WITHOUT LIMITATION, THE PRICING, AVAILABILITY, PHOTOGRAPHS, LIST OF
                        ACCOMODATION, EXPERIENCE, AIR, CRUISE, RESTAURANT OR OTHER TRAVEL PRODUCT AMENITIES, GENERAL
                        PRODUCT DESCRIPTIONS, REVIEWS AND RATINGS, ETC.).</p>
                    <p class="mt-3">IN ADDITION, THE Travell COMPANIES EXPRESSLY RESERVE THE RIGHT TO CORRECT ANY
                        AVAILABILITY AND PRICING ERRORS ON THE SERVICES AND/OR ON PENDING RESERVATIONS MADE UNDER AN
                        INCORRECT PRICE.</p>
                    <p class="mt-3">Travell MAKES NO REPRESENTATIONS OF ANY KIND ABOUT THE SUITABILITY OF THE SERVICES,
                        INCLUDING THE INFORMATION CONTAINED ON ITS WEBSITES OR ANY PORTION THEREOF, FOR ANY PURPOSE,
                        AND THE INCLUSION OR OFFERING OF ANY PRODUCTS OR SERVICE OFFERINGS ON ITS WEBSITES OR
                        OTHERWISE THROUGH THE SERVICES DOES NOT CONSTITUTE ANY ENDORSEMENT OR RECOMMENDATION OF SUCH
                        PRODUCTS OR SERVICE OFFERINGS BY Travell, NOTWITHSTANDING ANY AWARDS DISTRIBUTED BASED ON USER
                        REVIEWS. ALL SUCH INFORMATION, SOFTWARE, PRODUCTS, AND SERVICE OFFERINGS MADE AVAILABLE BY
                        OR THROUGH THE SERVICES ARE PROVIDED "AS IS" WITHOUT WARRANTY OF ANY KIND.</p>
                    <p class="mt-3">Travell DISCLAIMS ALL WARRANTIES, CONDITIONS, OR OTHER TERMS OF ANY KIND THAT THE
                        SERVICES, ITS SERVERS OR ANY DATA (INCLUDING EMAIL) SENT FROM Travell, ARE FREE OF VIRUSES OR
                        OTHER HARMFUL COMPONENTS.</p>
                    <p class="mt-3">TO THE MAXIMUM EXTENT PERMITTED UNDER APPLICABLE LAW, Travell HEREBY DISCLAIMS ALL
                        WARRANTIES AND CONDITIONS WITH REGARD TO THIS INFORMATION, SOFTWARE, PRODUCTS, AND THE
                        SERVICES, INCLUDING ALL IMPLIED WARRANTIES AND CONDITIONS OR TERMS OF ANY KIND AS TO OF
                        MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE, TITLE, QUIET POSSESSION AND
                        NONINFRINGEMENT.</p>
                    <p class="mt-3">THE Travell COMPANIES ALSO EXPRESSLY DISCLAIM ANY WARRANTY, REPRESENTATION, OR
                        OTHER TERM OF ANY KIND AS TO THE ACCURACY OR PROPRIETARY CHARACTER OF THE CONTENT AVAILABLE
                        BY AND THROUGH THE SERVICES.</p>
                    <p class="mt-3">THE THIRD PARTY SUPPLIERS PROVIDING ACCOMMODATIONS, FLIGHT, RENTALS,
                        EXPERIENCES, RESTAURANTS, OR CRUISE INFORMATION, TRAVEL OR OTHER SERVICES ON OR THROUGH THE
                        SERVICES ARE INDEPENDENT CONTRACTORS AND NOT AGENTS OR EMPLOYEES OF THE Travell COMPANIES.</p>
                    <p class="mt-3">THE Travell COMPANIES ARE NOT LIABLE FOR THE ACTS, ERRORS, OMISSIONS,
                        REPRESENTATIONS, WARRANTIES, BREACHES OR NEGLIGENCE OF ANY SUCH SUPPLIERS OR FOR ANY
                        PERSONAL INJURIES, DEATH, PROPERTY DAMAGE, OR OTHER DAMAGES OR EXPENSES RESULTING THEREFROM.
                        Travell HAS NO LIABILITY AND WILL MAKE NO REFUND IN THE EVENT OF ANY DELAY, CANCELLATION,
                        OVERBOOKING, STRIKE, FORCE MAJEURE OR OTHER CAUSES BEYOND ITS DIRECT CONTROL, AND IT HAS NO
                        RESPONSIBILITY FOR ANY ADDITIONAL EXPENSE, OMISSIONS, DELAYS, RE-ROUTING OR ACTS OF ANY
                        GOVERNMENT OR AUTHORITY.
                        SUBJECT TO THE FOREGOING, YOU USE THE SERVICES AT YOUR OWN RISK AND IN NO EVENT SHALL THE
                        Travell COMPANIES (OR THEIR OFFICERS, DIRECTORS AND/OR EMPLOYEES) BE LIABLE FOR ANY DIRECT,
                        INDIRECT, PUNITIVE, INCIDENTAL, SPECIAL, OR CONSEQUENTIAL LOSSES OR DAMAGES OR ANY LOSS OF
                        INCOME, PROFITS, GOODWILL, DATA, CONTRACTS, USE OF MONEY, OR LOSS OR DAMAGES ARISING FROM OR
                        CONNECTED IN ANY WAY TO BUSINESS INTERRUPTION OF ANY TYPE ARISING OUT OF, OR IN ANY WAY
                        CONNECTED WITH, YOUR ACCESS TO, DISPLAY OF OR USE OF THE SERVICES OR WITH THE DELAY OR
                        INABILITY TO ACCESS, DISPLAY OR USE THE SERVICES (INCLUDING, BUT NOT LIMITED TO, YOUR
                        RELIANCE UPON REVIEWS AND OPINIONS APPEARING ON OR THROUGH THE SERVICES; ANY VIRUSES, BUGS,
                        TROJAN HORSES, INFORMATION, SOFTWARE, LINKED SITES, PRODUCTS, AND SERVICES OBTAINED THROUGH
                        THE SERVICES (INCLUDING, BUT NOT LIMITED TO ANY Travell COMPANIES’ SYNCRONIZATION PRODUCT);
                        PERSONAL INJURY OR PROPERTY DAMAGE, OF ANY NATURE WHATSOEVER, RESULTING FROM YOUR USE OF THE
                        SERVICES’ SERVERS AND/OR ANY AND ALL PERSONAL INFORMATION AND/OR FINANCIAL INFORMATION
                        STORED THEREIN; ANY ERRORS OR OMISSIONS IN ANY CONTENT OR FOR ANY LOSS OR DAMAGE OF ANY KIND
                        INCURRED AS A RESULT OF THE USE OF ANY CONTENT; OR OTHERWISE ARISING OUT OF THE ACCESS TO,
                        DISPLAY OF OR USE OF THE SERVICES) WHETHER BASED ON A THEORY OF NEGLIGENCE, CONTRACT, TORT,
                        STRICT LIABILITY, OR OTHERWISE, AND EVEN IF Travell OR ITS CORPORATE AFFILIATES HAS BEEN
                        ADVISED OF THE POSSIBILITY OF SUCH DAMAGES.</p>
                    <p class="mt-3">If the Travell LLC are found liable for any loss or damage that arises out of or is
                        in any way connected with your use of the Services, then the Travell LLC’ liability will in no
                        event exceed, in the aggregate, the greater of</p>

                    <ol>
                        <li>The transaction fees paid to the Travell LLC for the transaction(s) on or through the
                            Services giving rise to the claim, or</li>
                        <li>One-Hundred Dollars (US $100.00).</li>
                    </ol>
                    <p class="mt-3">The limitation of liability reflects the allocation of risk between the parties.
                        The limitations specified in this section will survive and apply even if any limited remedy
                        specified in these terms is found to have failed of its essential purpose. The limitations
                        of liability provided in these terms inure to the benefit of Travell LLC.</p>
                    <p class="mt-3">THESE TERMS AND CONDITIONS AND FOREGOING LIABLITY DISCLAIMER DO NOT AFFECT
                        MANDATORY LEGAL RIGHTS THAT CANNOT BE EXCLUDED UNDER APPLICABLE LAW, FOR EXAMPLE UNDER
                        CONSUMER PROTECTION LAWS IN PLACE IN CERTAIN COUNTRIES.</p>
                    <p class="mt-3">IF THE LAW OF THE COUNTRY WHERE YOU LIVE DOES NOT ALLOW ANY PARTICULAR
                        LIMITATION OR EXCLUSION OF LIABILITY PROVIDED FOR IN THIS CLAUSE, THAT LIMITATION WILL NOT
                        APPLY. THE LIABILITY DISCLAIMER WILL OTHERWISE APPLY TO THE MAXIMUM EXTENT ALLOWED BY YOUR
                        LOCAL LAW.</p>

                    <div class="fs24 mb-16 fw-500">INDEMNIFICATION</div>
                    <p class="mt-3">You agree to defend and indemnify the Travell LLC and any of their officers,
                        directors, employees and agents from and against any claims, causes of action, demands,
                        recoveries, losses, damages, fines, penalties or other costs or expenses of any kind or
                        nature including but not limited to reasonable legal and accounting fees, brought by third
                        parties as a result of:</p>

                    <ol>
                        <li>Your breach of this Agreement or the documents referenced herein;</li>
                        <li>Your violation of any law or the rights of a third party; or</li>
                        <li>Your use of the Services, including the Travell LLC’ websites.</li>
                    </ol>



                    <div class="fs24 mb-16 fw-500">LINKS TO THIRD-PARTY WEBSITES</div>
                    <p class="mt-3">The Services may contain hyperlinks to websites operated by parties other than
                        the Travell LLC. Such hyperlinks are provided for your reference only. The Travell LLC do not
                        control such websites and are not responsible for their contents or the privacy or other
                        practices of such websites.
                        Further, it is up to you to take precautions to ensure that whatever links you select or
                        software you download (whether from this or any other website) is free of such items as
                        viruses, worms, trojan horses, defects and other items of a destructive nature. The Travell
                        LLC’ inclusion of hyperlinks to such websites does not imply any endorsement of the material
                        on such third party websites or apps or any association with their operators.</p>
                    <p class="mt-3">In some cases, you may be asked by a third party site or app to link your Travell
                        account profile to a profile on another third party site. You are responsible for deciding
                        if you choose to do so, it is purely optional, and the decision to allow this information to
                        be linked can be disabled (with the third party site or app) at any time.</p>
                    <p class="mt-3">If you do choose to link your Travell account to a third party site or app, the
                        third party site or app will be able to access the information you have stored on your Travell
                        account, including information regarding other users with whom you share information. You
                        should read the terms and conditions and privacy policy of the third party sites and apps
                        that you visit as they have rules and permissions about how they use your information that
                        may differ from the Services, including our websites.</p>
                    <p class="mt-3">We encourage you to review these third party sites and apps and to use them at
                        your own risk.</p>


                    <div class="fs24 mb-16 fw-500">SOFTWARE AS PART OF SERVICES; ADDITIONAL MOBILE LICENSES</div>
                    <p class="mt-3">Software from the Services is further subject to India export controls.
                        No software from the Services may be downloaded or otherwise exported or re-exported</p>

                    <ol>
                        <li>Into (or to a national or resident of) Cuba, Iraq, Sudan, North Korea, Iran, Syria, or
                            any other country to which the U.S. has embargoed goods, or</li>
                        <li>To anyone on the U.S. Treasury Department list of Specially Designated Nationals or the
                            U.S. Commerce Department's Table of Deny Orders. By using the Services, you represent
                            and warrant that you are not located in, under the control of, or a national or resident
                            of any such country or on any such list.
                            As noted above, the Services include software, which at times may be referred to as
                            “apps”. Any software that is made available to download from the Services ("Software")
                            is the copyrighted work of Travell or other party as identified.</li>
                    </ol>
                    <p class="mt-3">Your use of such Software is governed by the terms of the end user license
                        agreement, if any, which accompanies, or is included with, the Software. You may not install
                        or use any Software that is accompanied by or includes a license agreement unless you first
                        agree to the terms of such license agreement.
                        For any Software made available for download by way of the Services and which is not
                        accompanied by a license agreement, we hereby grant to you, the user, a limited, personal,
                        nontransferable license to use the Software for viewing and otherwise using the Services in
                        accordance with this Agreement’s terms and conditions (including those policies referenced
                        herein) and for no other purpose.</p>
                    <p class="mt-3">Please note that the Software, including, without limitation, all HTML, XML,
                        Java code and Active X controls contained in the Services, is owned or licensed by Travell, and
                        is protected by copyright laws and international treaty provisions. Any reproduction or
                        redistribution of the Software is expressly prohibited, and may result in severe civil and
                        criminal penalties. Violators will be prosecuted to the maximum extent possible.</p>
                    <p class="mt-3">Portions of Travell mobile software may use copyrighted material, the use of which
                        Travell acknowledges. In addition, there are specific terms that apply to use of certain Travell
                        mobile applications. Please visit the Mobile Licenses page for notices specific to Travell
                        mobile applications.</p>
                    <p class="mt-3">WITHOUT LIMITING THE FOREGOING, COPYING OR REPRODUCTION OF THE SOFTWARE TO ANY
                        OTHER SERVER OR LOCATION FOR FURTHER REPRODUCTION OR REDISTRIBUTION IS EXPRESSLY PROHIBITED.
                        THE SOFTWARE IS WARRANTED, IF AT ALL, ONLY ACCORDING TO THE TERMS OF THE LICENSE AGREEMENT
                        OR THIS AGREEMENT (AS APPLICABLE).</p>


                    <div class="fs24 mb-16 fw-500">COPYRIGHT AND TRADEMARK NOTICES</div>
                    <p class="mt-3">Travell, the owl logo, the ratings bubbles and all other product or service names
                        or slogans displayed on the Services are registered and/or common law trademarks of Travell LLC
                        and/or its suppliers or licensors, and may not be copied, imitated or used, in whole or in
                        part, without the prior written permission of Travell or the applicable trademark holder.</p>
                    <p class="mt-3">In addition, the look and feel of the Services, including our websites, as well
                        as all page headers, custom graphics, button icons and scripts related to same, is the
                        service mark, trademark and/or trade dress of Travell and may not be copied, imitated or used,
                        in whole or in part, without the prior written permission of Travell.</p>
                    <p class="mt-3">All other trademarks, registered trademarks, product names and company names or
                        logos mentioned on the Services are the property of their respective owners. Except to the
                        extent noted elsewhere in this Agreement, reference to any products, services, processes or
                        other information, by trade name, trademark, manufacturer, supplier or otherwise does not
                        constitute or imply endorsement, sponsorship or recommendation thereof by Travell.</p>
                    <p class="mt-3">All rights reserved. Travell is not responsible for content on websites operated by
                        parties other than Travell.</p>

                    <ul>
                        <li>Notice and Take-Down Policy for Illegal Content</li>
                        <ul>
                            <p class="mt-3">Travell operates on a "notice and takedown" basis. If you have any
                                complaints or objections to Content, including user messages posted on the Services,
                                or if you believe that material or content posted on the Services infringes a
                                copyright that you hold, please contact us immediately by following our notice and
                                takedown procedure.</p>
                            <p class="mt-3">Click here to view the Copyright Policy and procedure. Once this
                                procedure has been followed, Travell will respond to valid and properly substantiated
                                complaints by making all reasonable efforts to remove manifestly illegal content
                                within a reasonable time.</p>

                            <div class="fs24 mb-16 fw-500">MODIFICATIONS TO THE SERVICES; TERMINATION</div>
                            <p class="mt-3">Travell may change, add or delete these terms and conditions of this
                                Agreement or any portion thereof from time to time in its sole discretion where we
                                deem it necessary for legal, general regulatory and technical purposes, or due to
                                changes in the Services provided or nature or layout of Services. Thereafter, you
                                expressly agree to be bound by the terms and conditions of this Agreement as
                                amended.</p>
                            <p class="mt-3">The Travell LLC may change, suspend or discontinue any aspect of the
                                Services at any time, including availability of any of the Services’ features,
                                databases or Content. The Travell LLC may also impose limits or otherwise restrict your
                                access to all or parts of the Services without notice or liability for technical or
                                security reasons, to prevent against unauthorized access, loss of, or destruction of
                                data or where Travell and/or its corporate affiliates consider(s) in its/their sole
                                discretion that you are in breach of any provision of this Agreement or of any law
                                or regulation and where Travell and/or its corporate affiliates decide to discontinue
                                providing any aspect of the Services.</p>
                            <p class="mt-3">YOUR CONTINUED USE OF THE SERVICES NOW, OR FOLLOWING THE POSTING OF ANY
                                SUCH NOTICE OF ANY CHANGES, WILL INDICATE ACCEPTANCE BY YOU OF SUCH MODIFICATIONS.
                            </p>
                            <p class="mt-3">Travell may terminate this Agreement with you at any time, without advanced
                                notice, where it believes in good faith that you have breached this Agreement or
                                otherwise believes that termination is reasonably necessary to safeguard the rights
                                of the Travell LLC and/or others users of the Services. That means that we may stop
                                providing you with Services.</p>

                            <div class="fs24 mb-16 fw-500">JURISDICTION AND GOVERNING LAW</div>
                            <p class="mt-3">This website is owned and controlled by Travell LLC, a U.S. limited
                                liability company. This Agreement and any dispute or claim (including
                                non-contractual disputes or claims) arising out of or in connection with it or its
                                subject matter or formation shall be governed by and construed in accordance with
                                the law of the Commonwealth of Massachusetts, USA.</p>
                            <p class="mt-3">You hereby consent to the exclusive jurisdiction and venue of courts in
                                Massachusetts, USA and stipulate to the fairness and convenience of proceedings in
                                such courts for all disputes, both contractual and non-contractual, arising out of
                                or relating to the use of the Services by you or any third party.</p>
                            <p class="mt-3">You agree that all claims you may have against Travell LLC arising from or
                                relating to the Services must be heard and resolved in a court of competent subject
                                matter jurisdiction located in the Commonwealth of Massachusetts. Use of the
                                Services is unauthorized in any jurisdiction that does not give effect to all
                                provisions of these terms and conditions, including, without limitation, this
                                paragraph. Nothing in this clause shall limit the right of Travell LLC to take
                                proceedings against you in any other court, or courts, of competent jurisdiction.
                            </p>
                            <p class="mt-3">The foregoing shall not apply to the extent that applicable law in your
                                country of residence requires application of another law and/or jurisdiction – in
                                particular, if you are using the Services as a consumer - and this cannot be
                                excluded by contract and will not be governed by the United Nations Conventions on
                                Contracts for the International Sale of Goods, if otherwise applicable.</p>
                            <p class="mt-3">If you use the Services as a consumer, and not as business or Business
                                Representative, you may be entitled to bring claims against Travell in the Courts of
                                your country of residence. This clause shall otherwise apply to the maximum extent
                                allowed in your country or residence.</p>

                            <div class="fs24 mb-16 fw-500">CURRENCY CONVERTER</div>
                            <p class="mt-3">Currency rates are based on various publicly available sources and
                                should be used as guidelines only. Rates are not verified as accurate, and actual
                                rates may vary. Currency quotes may not be updated on a daily basis. The information
                                supplied is believed to be accurate, but the Travell LLC do not warrant or guarantee
                                such accuracy.</p>
                            <p class="mt-3">When using this information for any financial purpose, we advise you to
                                consult a qualified professional to verify the accuracy of the currency rates. We do
                                not authorize the use of this information for any purpose other than your personal
                                use and you are expressly prohibited from the resale, redistribution, and use of
                                this information for commercial purposes.</p>

                            <div class="fs24 mb-16 fw-500">GENERAL PROVISIONS</div>
                            <p class="mt-3">We reserve the right to reclaim any username, account name, nickname,
                                handle or any other user identifier for any reason without liability to you.</p>
                            <p class="mt-3">You agree that no joint venture, agency, partnership, or employment
                                relationship exists between you and Travell and/or its corporate affiliates as a result
                                of this Agreement or use of the Services.</p>
                            <p class="mt-3">Our performance of this Agreement is subject to existing laws and legal
                                process, and nothing contained in this Agreement limits our right to comply with law
                                enforcement or other governmental or legal requests or requirements relating to your
                                use of the Services or information provided to or gathered by us with respect to
                                such use.</p>
                            <p class="mt-3">To the extent allowed by applicable law, you agree that you will bring
                                any claim or cause of action arising from or relating to your access or use of the
                                Services within two (2) years from the date on which such claim or action arose or
                                accrued or such claim or cause of action will be irrevocably waived.
                            <p class="mt-3">If any part of this Agreement is determined to be invalid or
                                unenforceable pursuant to applicable law including, but not limited to, the warranty
                                disclaimers and liability limitations set forth above, then the invalid or
                                unenforceable provision will be deemed superseded by a valid, enforceable provision
                                that most closely matches the intent of the original provision and the remaining
                                provisions in this Agreement shall continue in effect.</p>
                            <p class="mt-3">This Agreement (and any other terms and conditions referenced herein)
                                constitutes the entire agreement between you and Travell with respect to the Services
                                and it supersedes all prior or contemporaneous communications and proposals, whether
                                electronic, oral, or written, between you and Travell with respect to the Services.</p>
                            <p class="mt-3">A printed version of this Agreement and of any notice given in
                                electronic form shall be admissible in judicial or administrative proceedings based
                                upon or relating to this Agreement to the same extent and subject to the same
                                conditions as other business documents and records originally generated and
                                maintained in printed form.</p>
                            <p class="mt-3">The following sections shall survive any termination of this Agreement:
                            </p>
                            <ol>
                                <li>Additional Products</li>
                                <li>Prohibited Activities</li>
                                <li>Reviews, Comments and Use of Other Interactive Areas; License Grant</li>
                                <li>o Restricting Travell’s License Rights</li>
                                <li>Travel Destinations</li>
                                <li>o International Travel</li>
                                <li>Liability Disclaimer</li>
                                <li>Indemnification</li>
                                <li>Software as Part of Services; Additional Mobile Licenses</li>
                                <li>Copyright and Trademark Notices</li>
                                <li>o Notice and Take-Down Policy for Illegal Content</li>
                                <li>Modifications to the Services; Termination</li>
                                <li>Jurisdictions and Governing Law</li>
                                <li>General Provisions</li>
                                <li>Service Help</li>
                            </ol>
                            <p class="mt-3">The terms and conditions of this Agreement are available in the language
                                of the Travell websites and/or apps on which Services may be accessed.
                                The websites and/or apps on which Services may be accessed may not always be updated
                                on a periodic or regular basis and consequently are not required to register as
                                editorial products under any relevant law.
                                Fictitious names of companies, products, people, characters, and/or data mentioned
                                in, on, or through the Services are not intended to represent any real individual,
                                company, product, or event.
                                Nothing in this Agreement shall be deemed to confer any third-party rights or
                                benefits, save that Travell’s corporate affiliates shall be deemed express third-party
                                beneficiaries of this Agreement.
                                You are prohibited from transferring any of your rights or obligations under this
                                Agreement to anyone else without our consent.
                                Any rights not expressly granted herein are reserved.
                            </p>
                            <div class="fs24 mb-16 fw-500">SERVICE HELP</div>
                            <p class="mt-3">For answers to your questions or ways to contact us, visit our Help
                                Center. Or, you can write to us at:</p>
                            <p class="mt-3">Travell LLC</p>
                            <p class="mt-3">SCO 10, Industrial Area Phase 2nd</p>
							<p class="mt-3">Chandigarh - 160002</p>
                            <p class="mt-3">Please note that Travell LLC does not accept legal notices or service of
                                legal process by any means other than hard copy post delivered to the address
                                immediately above. For the avoidance of doubt and without limitation, we therefore
                                do not accept notices or legal services deposited upon any of our affiliates or
                                subsidiaries.</p>
                            <p class="mt-3">©2023 Travell LLC. All rights reserved. </p>
                        </ul>
                    </ul>
                </ul>
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