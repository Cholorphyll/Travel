<nav class="navbar navbar-expand-sm container align-items-start h-logo">
        <a class="navbar-brand" href=""><img src="{{ asset('public/images/logo.png') }}" alt="Travell" title="Travell"></a>
        <button class="navbar-toggler d-lg-none" type="button" data-toggle="collapse" data-target="#collapsibleNavId"
            aria-controls="collapsibleNavId" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse align-items-start" id="collapsibleNavId">
            <div class="mx-auto">
                
                
            </div>
            <?php
                 if (session()->has('frontend_user')) {
                    $userData = session('frontend_user');
                    $Username = $userData['Username'];
                    $user_image = $userData['user_image'];
                     
                 }
                ?>
            <ul class="navbar-nav mt-2 mt-lg-0">
                <!-- <li class="nav-item active">
                    <a class="nav-link p-0" href="#"> <img src="{{asset('public/images/Frame 61.svg')}}" alt="" class=""></a>
                </li> -->
                @if (session()->has('frontend_user')) 
                <!-- <span class="getuser-nav"> -->
                <p class="" style="margin-top: 16px;
    margin-right: 19px;">{{$Username}}</p>
                    <li class="nav-item active ">
                    <div class="dropdown">
                        <a class="nav-link p-0" >
							<!--   dropdown-toggle   href="#"  id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false" -->
                             <img src="@if($user_image !='') https://s3-us-west-2.amazonaws.com/s3-travell/user-images/{{$user_image}}   @else {{ asset('public/images/Frame 61.svg') }} @endif" alt=""
                            class="usericon img-fluid rounded-circle" style="height: 49px;">
                        </a>
                    <!--    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                            <li><a class="dropdown-item" href="{{route('user_dashboard')}}">Dashboard</a></li>
                            <li><a class="dropdown-item" href="{{route('user_dashboard')}}">Logout</a></li>
                        
                        </ul>--->
                    </div>

                    </li>
                    <!-- </span> -->
                 @else
                <li class="nav-item active">
                    <a class="form-control" href="{{route('user_login')}}" role="button" style="background: #CB4C14;color: white;     text-decoration: none;">Sign in</a>
                      
                 </li>
                 @endif
            </ul>
        </div>
    </nav>
 