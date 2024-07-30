<x-app-layout>
  <div class="pc-container">
    <div class="pc-content">
      <!-- [ breadcrumb ] start -->
      <div class="page-header">
        <div class="page-block">
          <div class="row align-items-center">
            <div class="col-md-12">
              <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard')}}">Dashboard</a></li>
                <li class="breadcrumb-item" aria-current="page">Manage Landing</li>
              </ul>
            </div>
            <div class="col-md-12">
              <div class="page-header-title">


                </h2>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- [ breadcrumb ] end -->
      <div class="row">
        <div class="col-md-12">
          @if ($message = Session::get('success'))
          <div class="col-md-8 alert alert-success mt-3">
            {{ $message }}
          </div>
          @endif
          @if ($errors->any())
          <div class="col-md-8 alert alert-danger mt 3">
            <ul>
              @foreach ($errors->all() as $error) 
              <li>{{ $error }}</li>
              @endforeach
            </ul>
          </div>
          @endif
          <br>
          <div class="card">
            <div class="card-header">
              <h5>Search Landing</h5>
            </div>
            <div class="card-body">
              <div class="row">
                <div class="col-md-12">
                  <div class="col-md-12 mt-3">
                    <!-- <form method="post" action="{{route('search_location')}}"> -->
                    
                    <span type="button" class="float-right" style="float:right">
                      <h4><u><a href="{{ route('addlandingpage_search') }}" target="_blank">Add Landing Page</a></u>
                      </h4>
                    </span>
                    @csrf
                    <div class="row">
                    <span id="Success"></span>
                      <div class="landingpagetype mb-5">
                        <h5>Select Landing Page Type</h5>
                        <input type="radio" id="Attraction" name="page_type" value="Attraction" class="mt-3" checked>
                        <label for="Attraction">Attraction</label>
                        <input type="radio" id="Hotel" name="page_type" value="Hotel" class="margin-left">
                        <label for="Hotel">Hotel</label>
                        <input type="radio" id="Restaurent" name="page_type" value="Restaurent" class="margin-left">
                        <label for="Restaurent">Restaurant</label>
                        <input type="radio" id="Experience" name="page_type" value="Experience" class="margin-left">
                        <label for="Experience">Experience</label>
                      </div>


                      <div id="searchBoxes">
                        <div id="attractionBox" class="searchBox">
                          <h5 class="">Attraction Landing</h5>
                          <div class="row m-3">
                            <div class="col-md-3 form-group">
                              <strong class="form-label">Search Landing Name, Id or Url </strong>
                              <div class="form-search form-search-icon-right">
                                <input type="text" name="search_value" id="search_attinput"
                                  class="form-control rounded-3 searchlandingvalue"  placeholder="Search Attraction Landing"
                                  required><i class="ti ti-search"></i>
                              </div>
                            </div>
                            <div class="col-md-3 mt-4">
                              <button type="submit" class="btn btn-outline-secondary searchlandingpage" data-type="attraction"
                               >Search</button>
                            </div>
                          </div>
                        </div>
                        <div id="hotelBox" class="searchBox" style="display: none;">
                        <h5 class="">Hotel Landing</h5>
                          <div class="row m-3">
                            <div class="col-md-3 form-group">
                              <strong class="form-label">Search Landing Name, Id or Url </strong>
                              <div class="form-search form-search-icon-right">
                                <input type="text" name="search_value" id="search_attinput"
                                  class="form-control rounded-3 searchlandingvalue"  placeholder="Search Hotel Landing "
                                  required><i class="ti ti-search"></i>
                              </div>
                            </div>
                            <div class="col-md-3 mt-4">
                              <button type="submit" class="btn btn-outline-secondary searchlandingpage"
                              data-type="hotel">Search</button>
                            </div>
                          </div>
                        </div>
                        <div id="restaurentBox" class="searchBox" style="display: none;">
                        <h5 class="">Restaurant Landing</h5>
                          <div class="row m-3">
                            <div class="col-md-3 form-group">
                              <strong class="form-label">Search Landing Name, Id or Url </strong>
                              <div class="form-search form-search-icon-right">
                                <input type="text" name="search_value" id="search_attinput"
                                  class="form-control rounded-3 searchlandingvalue"  placeholder="Search restaurant landing"
                                  required><i class="ti ti-search"></i>
                              </div>
                            </div>
                            <div class="col-md-3 mt-4">
                              <button type="submit" class="btn btn-outline-secondary searchlandingpage"
                              data-type="restaurant" >Search</button>
                            </div>
                          </div>
                        </div>
                        <div id="experienceBox" class="searchBox" style="display: none;">
                        <h5 class="">Experience Landing</h5>
                        <div class="row">
                          <div class="col-md-3 form-group">
                            <strong class="form-label">Search Landing Name, Id or Url </strong>
                            <div class="form-search form-search-icon-right">
                              <input type="text" name="search_value" id="search_attinput" class="form-control rounded-3 searchlandingvalue"
                              placeholder="Search Experience Landing" required><i class="ti ti-search"></i>
                            </div>
                          </div>
                          <div class="col-md-3 mt-4">
                            <button type="submit" class="btn btn-outline-secondary searchlandingpage" data-type="experience"
                           >Search</button>
                          </div>
                          </div>
                        </div>
                      </div>




                    </div>
                    <!-- </form>  -->
                  </div>
                </div>
              </div>
              <div class="getfilterDataat m-3"></div>

            </div>
          </div>
        </div>
        <!-- [ form-element ] end -->
      </div>
    </div>
  </div>
</x-app-layout>