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
                <li class="breadcrumb-item" aria-current="page">Edit Cuisine</li>
              </ul>
            </div>
            <div class="col-md-12">
              <div class="page-header-title">
                <h2 class="mb-0">EDIT Cuisine</h2>
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
                    @if ($message = Session::get('error'))
                    <div class="col-md-8 alert alert-danger mt-3">
                      {{ $message }}
                    </div>
                    @endif
                    <br>
                    <!-- Button trigger modal -->
                    <span type="button" class="float-right" data-bs-toggle="modal" data-bs-target="#staticBackdrop"
                      style="float:right">
                      <h4><u>ADD Cuisine</u></h4>
                    </span>
                    <span class="getupdatedfaq">
                      @if(!$getcus->isEmpty())

                      <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12">
                          <div class="form-group mt-3">
                            <span id="Success"></span>
                            <strong>Restaurant Name</strong>
                            <div class="col-xs-6 col-sm-6 col-md-6 mt-3">
                              <input type="text" id="search_attractionfaq" name="sightname"
                                value="{{ $getname[0]->Title }}" class="search_attractionfaqs form-control rounded-3"
                                placeholder="" disabled>
                            </div>
                            <input type="hidden" name='restname' id="restname" value="{{ $getname[0]->RestaurantId }}"
                              class="form-control rounded-3" required>
                            <div class="historical-place mt-5 mb-3">
                            <h5>Cuisines</h5>
                       
                              @foreach($getcus as $value)

                              <button class="btn btn-secondary btn-lg border-0 margin-l ml-3 "
                                style="margin-left: 40px;margin-top: 20px;">{{ $value->Name }} </button>
                              <span class="crop " style="margin-top: 20px;"> <i
                                  class="material-icons-two-tone delete-Cuisine"
                                  data-id="{{ $value->RestaurantCuisineAssociationId }}"> delete</i></span>

                              @endforeach
                            </div>

                          </div>
                        </div>
                      </div>
                      </form>
                      @else
                      <p>Cuisine Not Found.</p>
                      @endif
                    


                    <!-- Modal -->
                    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false"
                      tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                      <div class="modal-dialog">
                        <div class="modal-content" style="width: 647px;padding: 20px;">
                          <div class="modal-header">
                            <!-- <h3 class="modal-title" id="staticBackdropLabel"> -->
                            <span style="font-weight: bold; text-decoration: underline;">
                              Existing Cuisine</span>
                            <span class=" margin-l">Add
                              New</span>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                          </div>
                          <div class="modal-body">
                            <!-- <h4 class="text-center">Add New FAQ</h4> -->

                            <div class="container">
                              <p class="mt-3">Listed Categories in {{ $getname[0]->Title }}</p>
                              <p id="errorcheck "></p>
                              @if(!$getcus->isEmpty())
                              <p class="mt-3"><strong>Cuisines</strong></p>
                              @foreach($getcus as $value)
                              <div class="historical-place mt-3">
                                <button class="btn btn-secondary btn-lg border-0 margin-l ml-3">{{ $value->Name }}
                                </button>
                                <span class="crop"> <i class="material-icons-two-tone delete-Cuisine"
                                    data-id="{{ $value->RestaurantCuisineAssociationId }}"> delete</i></span>
                              </div>
                              @endforeach
                              @else
                              <p>Cuisine not found.</p>
                              @endif
                              <hr>
                              <h4 class="mb-3">Add New Cuisine</h4>
                              <p id="inputerror"></p>
                              <div class="col-md-12 form-group">
                                <strong class="form-label">Select Cuisine </strong>

                                <!-- <div class="form-search form-search-icon-right">
                                  <input type="text" name="" id="search_Cuisine" class="form-control rounded-3"
                                    aria-describedby="emailHelp" placeholder="Name" required>
                                  <i class="ti ti-search"></i>
                                </div> -->
                                <br>
                                <br>
                                @foreach($getcuisine as $getcuisine)


                                <input type="checkbox" name="fruit" value="{{$getcuisine->RestaurantCuisineId}}"
                                  class="margin-l"> {{$getcuisine->Name}}

                                @endforeach
                                <br>
                                <br>
                                <span class="mt-3  custom-faq-buttons">
                                  <button id="addcusisine" data-id="{{ $getname[0]->RestaurantId }}"
                                    class="btn btn-dark">Save</button>
                                  <button id="cancel-list" type="button" class="btn btn-dark margin-l"
                                    data-bs-dismiss="modal">Cancel</button>
                                </span>

                              </div>

                              <div class="modal-footer mt-3">
                                <!-- <button type="button" class="btn btn-dark" data-bs-dismiss="modal">Close</button> -->

                              </div>
                            </div>
                          </div>
                        </div>


                      </div>
                    </div>

                    </span>


                  </div>
                </div>
              </div>
            </div>

</x-app-layout>