  @if(!$nearby_hotel->isEmpty())
  @foreach($nearby_hotel as $nearby_hotel)
     <div class="col-md-6  ">
            <!-- Card START -->
            <div class="card card-img-scale border-0 overflow-hidden bg-transparent">
              <!-- Image and overlay -->
              <div class="card-img-scale-wrapper rounded-3">
                <!-- Image -->
				  
				  
                <img src="https://photo.hotellook.com/image_v2/limit/h{{$nearby_hotel->hotel_id}}_1/376/229.jpg" class="card-img br-10 mb-12" alt="hotel image">
                <!--  <img src="{{asset('public/images/Hotel lobby.svg')}}" class="card-img br-10 mb-12" alt="hotel image"> -->
              </div>

              <!-- Card body -->
              <div class="">
                <!-- Title -->
                <div class="d-flex align-items-center justify-content-between">
                  <a href="{{route('hotel.detail',[$nearby_hotel->location_id.'-'.$nearby_hotel->hotelid.'-'.$nearby_hotel->slug])}}"
                    class="stretched-link text-decoration-none fs18 "><b>{{$nearby_hotel->name}}</b></a>
                </div>
                <div class="d-flex justify-content-between align-items-start locationandothers">
               
                  <p class="mb-3">Distance {{ round($nearby_hotel->distance,2) }}  Km</p>

                </div>
                <a href="" class="mb-12 d-block acme">{{$nearby_hotel->address}}</a>
                @if($nearby_hotel->pricefrom !="")
                <button type="button" class="btn btn-outline-secondary btn-dark-outline mt-44">$
                  {{$nearby_hotel->pricefrom}}</button>
                @endif

              </div>
            </div>
            <!-- Card END -->
          </div>


  @endforeach
  @else
  <p>Nearby Hotels not found.</p>
  @endif