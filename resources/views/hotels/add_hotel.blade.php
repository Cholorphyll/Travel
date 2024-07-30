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
                <li class="breadcrumb-item" aria-current="page">Add Hotel</li>
              </ul>
            </div>
            <div class="col-md-12">
              <div class="page-header-title">
                <h2 class="mb-0">Add Hotel</h2>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
          <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900 dark:text-gray-100">
              <div class="row justify-content-center">
                <div class="col-md-12">
                  <div class="white_shd full margin_bottom_30">
                    <div class="full graph_head">
                      <div class="heading1 margin_0">

                      </div>
                    </div>

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

                    <form class="" action="{{route('storeHotel')}}" method="POST">
                      @csrf
                      <div class="row">
                        <div class="col-md-12">

                          <div class="col-md-6">
                            <div class="form-group">
                              <strong>Hotel Name</strong>
                              <input type="text" name="hotel_name" value=""
                                class="form-control rounded-3" placeholder="Hotel Name" required>
                            </div>

                          </div>
                          <div class="col-md-6">
                            <div class="form-group">
                              <strong>Page Slug</strong>
                              <input type="text" name="slug" class="form-control rounded-3"
                                value="" placeholder="Page slug" required>
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="form-group mt-3">
                              <strong>Meta Title</strong>
                              <input type="text" name='MetaTagTitle' 
                                class="form-control rounded-3" placeholder="">
                              <input type="hidden" value="" id="sightid">
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-md-6">
                              <div class="form-group mt-3">
                                <strong>Meta Description</strong>
                                <textarea type="text" name='MetaTagDescription' class="form-control rounded-3"
                                  placeholder=""> </textarea>
                              </div>
                            </div>
                            <div class="col-md-6">
                              <div class="form-group mt-3">
                                <strong>About Hotel</strong>
                                <textarea type="text" name='about' value="" class="form-control rounded-3"
                                  placeholder=""></textarea>
                              </div>
                            </div>
                          </div>
                          <div class="row">
                           
                           <div class="col-md-6">
                             <div class="form-group mt-3">
                               <strong>Short Description</strong>
                               <textarea type="text" name='short_description' value="" class="form-control rounded-3"
                                 placeholder=""></textarea>
                             </div>
                           </div>
                         </div>
                          <h3><u>Location Info</u></h3>
                          <div class="row">
                            <div class="col-md-6">
                              <div class="form-group mt-3">
                                <strong>Address Line 1</strong>
                                <?php // $address = explode(',',$gethotel[0]->Address);
                              //  print_r($address);
                                ?>
                                <textarea type="text" name='addressline1' class="form-control rounded-3"
                                  placeholder=""></textarea>
                              </div>
                            </div>
                            <div class="col-md-6">
                              <div class="form-group mt-3">
                                <strong>Address Line 2</strong>
                                <input type="text" name='addressline2' value="" class="form-control rounded-3"
                                  placeholder="addressline2">
                              </div>
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-md-6">
                              <div class="form-group mt-3">
                                <strong>Neighborhood</strong>
                                <!-- <textarea type="text" name='neighborhood' value="" class="form-control rounded-3"
                                  ></textarea> -->

                                  <?php if(!$neighborhoodlist->isEmpty()){  ?>
                                    <select class="form-select" aria-label="Default select example" name='neighborhood'>
                                    <option value="" selected>Select Neighborhood</option>
                                      @foreach($neighborhoodlist as $nlist)                                   
                                      <option value="{{$nlist->NeighborhoodId}}" >{{$nlist->Name}}</option>
                                      @endforeach                                   
                                    </select>
                                <?php } ?>

                              </div>
                            </div>
                            <div class="col-md-6">
                            <div class="form-group mt-3">
                              <strong>City</strong>
								<div class="form-search form-search-icon-right">
                              <input type="text" id="searchHotelcity" name="ctname" class="form-control rounded-3"
                                 placeholder=""><i class="ti ti-search"></i> </div>
                          
                              <span id="citylisth"></span>
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          

                          <div class="col-md-6">
                            <div class="form-group mt-3">
                              <strong>Country</strong>
                               <input type="text"  id="country" class="form-control" name="county" disabled>
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="form-group mt-3">
                              <strong>Pincode</strong>
                              <input type="number" name='pincode' class="form-control rounded-3"
                                placeholder="Pincode">
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-6">
                            <div class="form-group mt-3">
                              <strong>Latitude</strong>
                              <input type="text" name='Latitude' 
                                class="form-control rounded-3" placeholder="Enter Latitude">
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="form-group mt-3">
                              <strong>Longitude</strong>
                              <input type="text" name='Longitude' 
                                class="form-control rounded-3" placeholder="Enter Longitude">
                            </div>
                          </div>
                        
                        </div>
                        <!-- <div class="col-md-12">
                        <div id = "map1" style = "width: 500px; height: 250px"></div>
                        </div> -->
                        <h3 class="mt-5"><u>Contact Info</u></h3>

                        <div class="row">
                          <div class="col-md-6">
                            <div class="form-group mt-3">
                              <strong>Website</strong>
                              <input type="text" name='website' 
                                class="form-control rounded-3" placeholder="Enter website url">
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="form-group mt-3">
                              <strong>Phone</strong>
                              <input type="number" name='phone'
                                class="form-control rounded-3" placeholder="Enter Phone Number">
                            </div>
                          </div>

                        </div>
                        <div class="col-md-6">
                          <div class="form-group mt-3">
                            <strong>Email</strong>
                            <input type="email" name='email' 
                              class="form-control rounded-3" placeholder="Enter Email Address">
                          </div>
                        </div>
                    
                        <h3 class="mt-5"><u>Nearest Stations</u></h3>
                   

                        <div class="row">
                          <div class="col-md-6">
                            <div class="form-group mt-3">
                              <strong>Station Name</strong>
                              <input type="text" name='station_name[]' class="form-control rounded-3"
                                value="" placeholder="Station Name">                         
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="form-group mt-3">
                              <strong>Time</strong>
                              <input type="text" name='time[]' class="form-control rounded-3" 
                                placeholder="15 minute walk">
                            </div>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group mt-3">
                            <strong>Duration</strong>
                            <input type="number" name='duration[]' class="form-control rounded-3"
                             placeholder="Duration">
                          </div>
                        </div>
                      
                        <div id="station"></div>
                        <h4 id="addstButton" class="float-right"><u>Add Nearest Station</u></h4>
                      </div>

                                <div class="form-group mt-3">
                      <button type="submit" class="btn btn-primary">Submit</button>
                      <a href="{{route('hotels')}}" class="btn btn-danger">cancel</a>
                    </div>

                    </form>
                  </div>


                </div>
              </div>
            </div>
            <!-- Start Select dateTime  -->
          </div>
       
        </div>

       
      </div>
    </div>
  </div>
  </div>
  </div>
  </div>

  <script src="http://cdn.leafletjs.com/leaflet-0.7.3/leaflet.js"></script>



</x-app-layout>