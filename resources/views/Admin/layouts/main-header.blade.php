<div class="header">

    <!-- Logo -->
    <div class="header-left active">
        <a href="@if(auth()->user()->hasRole('cashier')) {{route('newIndex')}} @elseif(auth()->user()->hasRole('delivery')) {{route('delivery')}} @else{{route('dashboard')}}@endif" class="logo logo-normal">
            <img src="{{asset('assets/dashboard/img/logo.png')}}"  alt="">
        </a>
        <a href="@if(auth()->user()->hasRole('cashier')) {{route('newIndex')}} @elseif(auth()->user()->hasRole('delivery')) {{route('delivery')}} @else{{route('dashboard')}}@endif" class="logo logo-white">
            <img src="{{asset('assets/dashboard/img/logo-white.png')}}"  alt="">
        </a>
        <a href="@if(auth()->user()->hasRole('cashier')) {{route('newIndex')}} @elseif(auth()->user()->hasRole('delivery')) {{route('delivery')}} @else{{route('dashboard')}}@endif" class="logo-small">
            <img src="{{asset('assets/dashboard/img/logo-small.png')}}"  alt="">
        </a>

        <a id="toggle_btn" href="javascript:void(0);"    @if(auth()->user()->hasRole('delivery')) style="display: none !important;" @elseif(auth()->user()->hasRole('cashier')) style="display: none !important;"  @endif>
            <i data-feather="chevrons-left" class="feather-16"></i>
        </a>
    </div>
    <!-- /Logo -->

    <a id="mobile_btn" class="mobile_btn" href="#sidebar">
					<span class="bar-icon">
						<span></span>
						<span></span>
						<span></span>
					</span>
    </a>

    <!-- Header Menu -->
    <ul class="nav user-menu">

        <!-- Search -->
        <li class="nav-item nav-searchinputs">@yield('main_head')</li>
        <!-- /Search -->
        @if(\Illuminate\Support\Facades\URL::current() != route('dashboard'))
            @if(!auth()->user()->hasRole('cashier'))
            <li>
                <div class="col-lg-4 d-flex text-center align-items-center gap-4">
                    <a href="{{route('newIndex')}}">
                        <div class="icon_containers"><i class="fa fax fa-shopping-cart"></i><span>Cashier</span></div>
                    </a>
                    <a href="{{route('products')}}">
                        <div class="icon_containers"><i class="fa fax fa-shopping-bag"></i><span>Products</span></div>
                    </a>
                    <a href="{{route('orders')}}">
                        <div class="icon_containers"><i class="fa fax fa-shopping-basket"></i><span>Orders</span></div>
                    </a>
                    <a href="{{route('all-customers')}}">
                        <div class="icon_containers"><i class="fa fax fa-users"></i><span>Customers</span></div>
                    </a>
                </div>
            </li>
            @endif
        @endif


        <li class="nav-item nav-item-box">
            <a href="javascript:void(0);" id="btnFullscreen">
                <i data-feather="maximize"></i>
            </a>
        </li>
        <!-- Notifications -->
        <!-- /Notifications -->
        <li class="nav-item dropdown has-arrow main-drop">
            <a href="javascript:void(0);" class="dropdown-toggle nav-link userset" data-bs-toggle="dropdown">
							<span class="user-info">
								<span class="user-letter">
									<img src="@if(auth()->user()->image != null){{asset('storage/employee/'.auth()->user()->image)}}@else{{asset('assets/dashboard/img/profiles/avator1.jpg')}}@endif"
                                        alt="" class="img-fluid">
								</span>
								<span class="user-detail">
									<span class="user-name">{{auth()->user()->name}}</span>
									<span class="user-role">{{auth()->user()->role_name}}</span>
								</span>
							</span>
            </a>
            <div class="dropdown-menu menu-drop-user">
                <div class="profilename">
                    <div class="profileset">
									<span class="user-img">
                                        <img src="@if(auth()->user()->image != null){{asset('storage/employee/'.auth()->user()->image)}}@else{{asset('assets/dashboard/img/profiles/avator1.jpg')}}@endif" alt="image">
									<span class="status online"></span></span>
                        <div class="profilesets">
                            <h6>{{auth()->user()->name}}</h6>
                            <h5>{{auth()->user()->role_name}}</h5>
                        </div>
                    </div>
                    <hr class="m-0">
                    <a class="dropdown-item" href="{{route('profile')}}"> <i class="me-2"  data-feather="user"></i> My Profile</a>
                    <a class="dropdown-item" href="{{route('admin-change-password')}}"> <i class="me-2"  data-feather="user"></i> Change Password</a>

                    <a class="dropdown-item" href="{{route('setting')}}"  @if(auth()->user()->hasRole('delivery')) style="display: none !important;" @elseif(auth()->user()->hasRole('cashier')) style="display: none !important;"  @endif>
                        <i class="me-2" data-feather="settings"></i>
                        Settings
                    </a>
                    <hr class="m-0">

                    <form action="{{route('admin-logout')}}" method="POST">
                        @csrf
                        <button type="submit" class="dropdown-item logout pb-0">
                            <img src="{{asset('assets/dashboard/img/icons/log-out.svg')}}" class="me-2" alt="img"><span>Logout</span>
                        </button>
                    </form>
                </div>
            </div>
        </li>
    </ul>
    <!-- /Header Menu -->

    <!-- Mobile Menu -->
    <div class="dropdown mobile-user-menu">
        <a href="javascript:void(0);" class="nav-link dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
        <div class="dropdown-menu dropdown-menu-right">
            <a class="dropdown-item" href="{{route('profile')}}">My Profile</a>
            <a class="dropdown-item" href="{{route('admin-change-password')}}">Change Password</a>
            <a class="dropdown-item" href="{{route('setting')}}">Settings</a>
            <form action="{{route('admin-logout')}}" method="POST">
                @csrf
                <button type="submit" class="dropdown-item">
                    Logout
                </button>
            </form>
        </div>
    </div>
    <!-- /Mobile Menu -->
</div>
