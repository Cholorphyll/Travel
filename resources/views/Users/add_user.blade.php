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
                <li class="breadcrumb-item" aria-current="page">Add User</li>
              </ul>
            </div>
            <div class="col-md-12">
              <div class="page-header-title">
                <h2 class="mb-0">Add User</h2>
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

                    <span type="button" class="float-right" style="float:right">
                      <h4><u><a href="{{ route('add_landing_page') }}">Add Landing Page</a></u>
                      </h4>
                    </span>

                    <form action="{{ route('store_user') }}" method="post">
                      @csrf
                      <div class="row">
                        <div class="col-xs-6 col-sm-6 col-md-6">


                          <div class="form-group mt-3">
                            <span id="Success"></span>
                            <strong>User Details</strong>

                            <div class="form-group  mt-3">

                              <strong>First Name</strong>
                              <div id="questionmsg"></div>
                              <input type="text" name="fname" id="name" class="form-control rounded-3 name1">
                            </div>
                            <input type="hidden" value="" id="id">


                            <div class="form-group getdata- mt-3">
                              <strong>Last Name</strong>
                              <div id="questionmsg-"></div>
                              <input type="text" name="lname" id="slug" class="form-control rounded-3 name2">
                            </div>



                            <div class="form-group getdata- mt-3">

                              <strong>Username</strong>
                              <div id="questionmsg"></div>
                              <input type="text" name="username" id="metatitle" class="form-control rounded-3 name3">
                            </div>



                            <div class="form-group getdata mt-3">

                              <strong>Email</strong>
                              <div id="questionmsg"></div>
                              <input type="text" name="Email" id="metadesc" class="form-control rounded-3 name4">
                            </div>



                            <div class="form-group getdata mt-3">
                              <strong>Phone</strong>
                              <div id="questionmsg"></div>
                              <input type="text" name="phone" id="about" class="form-control rounded-3 name5">
                            </div>

                            <div class="form-group mt-3">
                              <strong>City</strong>
                              <div class="form-search form-search-icon-right">
                                <input type="text" id="search_usercity" name="ctname" class="form-control rounded-3"
                                  placeholder="Search City minimun 2 letters "><i class="ti ti-search"></i>
                              </div>
                              <input type="hidden" name='city' id="selected_city_id" class="form-control rounded-3"
                                placeholder="City">
                              <span id="citylist"></span>
                            </div>

                          </div>
                        </div>

                        <div class="form-group mt-3">
                          <button type="submit" class="btn btn-outline-dark">Save</button>

                          <a href="{{ route('users') }}" class="btn btn-outline-dark margin-l">Cancel</a>
                        </div>

                      </div>

                    </form>

                  </div>



                </div>
              </div>
            </div>

</x-app-layout>