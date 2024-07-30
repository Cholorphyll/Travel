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
                <li class="breadcrumb-item" aria-current="page">Edit Hotel</li>
              </ul>
            </div>
            <div class="col-md-12">
              <div class="page-header-title">
                <h2 class="mb-0">Edit Hotel</h2>
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

                    <form class="" action="{{ route('updateHotel',[$gethotel[0]->id])}}" method="POST">
                      @csrf
                      <div class="row">
                        <div class="col-md-12">

                          <div class="col-md-6">
                            <div class="form-group">
                              <strong>Hotel Name</strong>
                              <input type="text" name="hotel_name" value="{{$gethotel[0]->name}}"
                                class="form-control rounded-3" placeholder="Hotel Name" required>
                            </div>

                          </div>
                          <div class="col-md-6">
                            <div class="form-group">
                              <strong>Page Slug</strong>
                              <input type="text" name="slug" class="form-control rounded-3"
                                value="{{$gethotel[0]->slug}}" placeholder="Page slug" required>
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="form-group mt-3">
                              <strong>Meta Title</strong>
                              <input type="text" name='MetaTagTitle' value="{{$gethotel[0]->metaTagTitle}}"
                                class="form-control rounded-3" placeholder="">
                              <input type="hidden" value="" id="sightid">
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-md-6">  
                              <div class="form-group mt-3">
                                <strong>Meta Description</strong>
                                <textarea type="text" name='MetaTagDescription' class="form-control rounded-3"
                                  placeholder="">{{$gethotel[0]->MetaTagDescription}} </textarea>
                              </div>
                            </div>
                            <div class="col-md-6">
                              <div class="form-group mt-3">
                                <strong>About Hotel</strong>
                                <textarea type="text" name='about' value="" class="form-control rounded-3"
                                  placeholder="">{{$gethotel[0]->about}}</textarea>
                              </div>
                            </div>
                          </div>

                          <div class="row">
                           
                            <div class="col-md-6">
                              <div class="form-group mt-3">
                                <strong>Short Description</strong>
                                <textarea type="text" name='short_description' value="" class="form-control rounded-3"
                                  placeholder="">{{$gethotel[0]->short_description}}</textarea>
                              </div>
                            </div>
                          </div>
                          <h3><u>Location Info</u></h3>
                          <div class="row">
                            <div class="col-md-6">
                              <div class="form-group mt-3">
                                <strong>Address Line 1</strong>
                                <?php  $address = explode(',',$gethotel[0]->address);
                              //  print_r($address);
                                ?>
                                <textarea type="text" name='addressline1' class="form-control rounded-3"
                                  placeholder="">@if(isset($address[0])) {{$address[0]}} @else $gethotel[0]->address @endif</textarea>
                              </div>
                            </div>
                            <div class="col-md-6">
                              <div class="form-group mt-3">
                                <strong>Address Line 2</strong>
                                <input type="text" name='addressline2' value="@if(isset($address[1])) {{$address[1]}} @endif" class="form-control rounded-3"
                                  placeholder="addressline2">
                              </div>
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-md-6">
                              <div class="form-group mt-3">
                                <strong>Neighborhood</strong>     <br>
                               @if(!$TPneighborhood->isEmpty())
                               <!-- <input type="text" value="{{$TPneighborhood[0]->display_name}}" class="form-control" name="county" > -->
                               <textarea name="" class="form-control" id="" cols="10" rows="4">{{$TPneighborhood[0]->display_name}}</textarea>

                               <br>
                              <strong>Select Neighborhood To Update </strong> 
                              <?php if(!$neighborhoodlist->isEmpty()){  ?>
                                    <select class="form-select" aria-label="Default select example" name='neighborhood'>
                                    <option value="" selected>Select Neighborhood</option>
                                      @foreach($neighborhoodlist as $nlist)                                   
                                      <option value="{{$nlist->NeighborhoodId}}" >{{$nlist->Name}}</option>
                                      @endforeach                                   
                                    </select>
                                <?php }else{ ?>                                 
                                  <input type="text" placeholder="Neighborhood not available" class="form-control" disabled>
                                  <?php    } ?>
                              @else
                              
                                 <?php if(!$neighborhoodlist->isEmpty()){  ?>
                                    <select class="form-select" aria-label="Default select example" name='neighborhood'>
                                    <option value="" selected>Select Neighborhood</option>
                                      @foreach($neighborhoodlist as $nlist)                                   
                                      <option value="{{$nlist->NeighborhoodId}}" >{{$nlist->Name}}</option>
                                      @endforeach                                   
                                    </select>
                                <?php }else{ ?>                                 
                                  <input type="text" placeholder="Neighborhood not available" class="form-control" disabled>
                                  <?php    } ?>
                              @endif
                             
                              </div>  
                            </div>
                          <div class="col-md-6">
                            <div class="form-group mt-3">
                            <strong>City</strong>
							                <div class="form-search form-search-icon-right">
                              <input type="text" id="searchHotelcity" name="ctname" class="form-control rounded-3"
                                value="{{$gethotel[0]->Lname}}" placeholder=""><i class="ti ti-search"></i> </div>
                          
                              <span id="citylisth"></span>
                               
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-6">
                            <div class="form-group mt-3">                             
                              <strong>Country</strong>
                               <input type="text" value="{{$gethotel[0]->countryName}}" id="country" class="form-control" name="country">
                            </div>
                          </div>

                          <div class="col-md-6">
                            <div class="form-group mt-3">
                              <strong>Pincode</strong>
                              <input type="number" name='pincode' class="form-control rounded-3"
                                value="{{$gethotel[0]->Pincode}}" placeholder="Pincode">
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-6">
                            <div class="form-group mt-3">
                              <strong>Latitude</strong>
                              <input type="text" name='Latitude' value="{{$gethotel[0]->Latitude}}"
                                class="form-control rounded-3" placeholder="Enter Latitude">
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="form-group mt-3">
                              <strong>Longitude</strong>
                              <input type="text" name='Longitude' value="{{$gethotel[0]->longnitude}}"
                                class="form-control rounded-3" placeholder="Enter Longitude">
                            </div>
                          </div>                        
                        </div>
                        <div class="row">
                          <div class="col-md-6">
                            <div class="form-group mt-3">
                              <strong>stars</strong>
                              <input type="text" name='stars' value="{{$gethotel[0]->stars}}"
                                class="form-control rounded-3" placeholder="Enter stars">
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="form-group mt-3">
                              <strong>Price</strong>
                              <input type="text" name='pricefrom' value="{{$gethotel[0]->pricefrom}}"
                                class="form-control rounded-3" placeholder="Enter pricefrom">
                            </div>
                          </div>                        
                        </div>
                        <div class="row">
                          <div class="col-md-6">
                            <div class="form-group mt-3">
                              <strong>Property Type</strong>
                              <!-- <input type="text" name='propertyType' value="{{$gethotel[0]->propertyType}}"
                                class="form-control rounded-3" placeholder="Enter Property Type"> -->
                                  <?php $propertyType = $gethotel[0]->propertyType ?>

                                <select class="form-select" aria-label="Default select example" name='propertyType'>
                                  <option value="" selected>Select Property Type</option>
                                    @foreach($TPHotel_types as $tp)                                   
                                    <option value="{{$tp->hid}}" @if($tp->hid == $propertyType) selected @endif >{{$tp->type}}</option>
                                    
                                    @endforeach                                   
                                  </select>
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="form-group mt-3">
                              <strong>Amenities</strong>                             
                                <textarea type="text" name='amenities' class="form-control rounded-3"
                                  placeholder="">{{$gethotel[0]->amenities}} </textarea>
                            </div>
                          </div>                        
                        </div>
                        <div class="row">
                          <div class="col-md-6">
                            <div class="form-group mt-3">
                              <strong>Short Facilities</strong>                          
                                <textarea type="text" name='shortFacilities' class="form-control rounded-3"
                                  placeholder="">{{$gethotel[0]->shortFacilities}} </textarea>
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="form-group mt-3">
                              <strong>Language</strong>
                              <textarea type="text" name='Languages' class="form-control rounded-3"
                                  placeholder="">{{$gethotel[0]->Languages}} </textarea>
                            </div>
                          </div>                        
                        </div>
                        <div class="row">
                          <div class="col-md-6">
                            <div class="form-group mt-3">
                              <strong>Room Amenitiy</strong>                      
                                <textarea type="text" name='room_aminities' class="form-control rounded-3"
                                  placeholder="">{{$gethotel[0]->room_aminities}} </textarea>
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="form-group mt-3">
                              <strong>Location Score</strong>
                              <input type="text" name='location_score' value="{{$gethotel[0]->location_score}}"
                                class="form-control rounded-3" placeholder="Enter Location Score">
                            
                            </div>
                          </div>                        
                        </div>

                        @if($gethotel[0]->Latitude != "" && $gethotel[0]->longnitude !="")
                        <div class="col-md-12 mt-3 mb-3">
                        <div id = "map1" style = "width: 1634px; height: 300px"></div>
                        </div>
                        @endif
                        <h3 class="mt-5"><u>Contact Info</u></h3>

                        <div class="row">
                          <div class="col-md-6">
                            <div class="form-group mt-3">
                              <strong>Website</strong>
                              <input type="text" name='website' value="{{$gethotel[0]->Website}}"
                                class="form-control rounded-3" placeholder="Enter website url">
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="form-group mt-3">
                              <strong>Phone</strong>
                              <input type="number" name='phone' value="{{$gethotel[0]->Phone}}"
                                class="form-control rounded-3" placeholder="Enter Phone Number">
                            </div>
                          </div>

                        </div>
                        <div class="col-md-6">
                          <div class="form-group mt-3">
                            <strong>Email</strong>
                            <input type="email" name='email' value="{{$gethotel[0]->Email}}"
                              class="form-control rounded-3" placeholder="Enter Email Address">
                          </div>
                        </div>
                        @php
                        $nearestStations = json_decode($gethotel[0]->NearestStations);
                        @endphp
                     
                        <h3 class="mt-3"><u>Nearest Stations</u></h3>
                        @if(!empty($nearestStations ))
                        @foreach($nearestStations as $station)

                        <div class="row">
                          <div class="col-md-6">
                            <div class="form-group mt-3">
                              <strong>Station Name</strong>
                              <input type="text" name='station_name[]' class="form-control rounded-3"
                                value="{{$station->station_name}}" placeholder="Station Name">
                            
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="form-group mt-3">
                              <strong>Time</strong>  
                              <input type="text" name='time[]' class="form-control rounded-3" value="{{$station->time}}"
                                placeholder="15 minute walk">
                            </div>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group mt-3">
                            <strong>Duration</strong>
                            <input type="number" name='duration[]' class="form-control rounded-3"
                              value="{{$station->duration}}" placeholder="Duration">
                          </div>
                        </div>
                        @endforeach
                      @else

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

                        @endif
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
  <script src="{{ asset('/public/js/map_leaflet.js')}}"></script>
  <script src="https://cdn.leafletjs.com/leaflet-0.7.3/leaflet.js"></script>
  <script>
  // Creating map options
  
  var mapOptions = {
    center: [{{$gethotel[0]->Latitude}} ,{{$gethotel[0]->longnitude}}],
    zoom: 8
  }

  // Creating a map object
  var map = new L.map('map1', mapOptions);

  // Creating a Layer object
  var layer = new L.TileLayer('http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png');

  // Adding layer to the map
  map.addLayer(layer);

  let marker = new L.Marker([{{$gethotel[0]->Latitude}} ,{{$gethotel[0]->longnitude}}]);
 
  marker.addTo(map);
  marker.addTo(new L.Marker([{{$gethotel[0]->Latitude}} ,{{$gethotel[0]->longnitude}}]));
  </script>


</x-app-layout>