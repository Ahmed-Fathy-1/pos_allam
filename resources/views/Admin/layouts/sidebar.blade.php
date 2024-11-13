@if(auth()->user()->hasRole('delivery'))
@else
<div class="sidebar" id="sidebar">
    <div class="sidebar-inner slimscroll">
        <div id="sidebar-menu" class="sidebar-menu">
            <ul>
                @can('home')
                <li class="submenu-open">
                    <h6 class="submenu-hdr">Main</h6>
                    <ul>
                        <li  @if(\Illuminate\Support\Facades\URL::current() == route('dashboard')) class="active" @endif>
                            <a href="{{route('dashboard')}}" ><i data-feather="home"></i><span>Dashboard</span></a>
                        </li>
                    </ul>
                </li>
                @endcan
                    @can('cashier')
                        <li class="submenu-open">
                            <h6 class="submenu-hdr">Cashier</h6>
                            <ul>
                                {{--<li @if(\Illuminate\Support\Facades\URL::current() == route('cashier')) class="active" @endif>
                                    <a href="{{route('cashier')}}"><i data-feather="shopping-bag"></i><span>Cashier</span></a></li>--}}

                                <li  class="active" >
                                    <a href="{{route('newIndex')}}"><i data-feather="shopping-bag"></i><span>Cashier</span></a></li>
                            </ul>
                        </li>
                    @endcan
                    @can('product')
                <li class="submenu-open">
                    <h6 class="submenu-hdr">Products</h6>
                    <ul>
                        @can('category')
                            <li @if(\Illuminate\Support\Facades\URL::current() == route('category')) class="active" @endif>
                                <a href="{{route('category')}}"><i data-feather="codepen"></i><span>Category</span></a></li>
                        @endcan
                        @can('category')
                                <li @if(\Illuminate\Support\Facades\URL::current() == route('unit.index')) class="active" @endif>
                                <a href="{{route('unit.index')}}"><i data-feather="grid"></i><span>Unit</span></a></li>
                        @endcan
                            <li @if(\Illuminate\Support\Facades\URL::current() == route('products')) class="active" @endif>
                            <a href="{{route('products')}}"><i data-feather="box"></i><span>Products</span></a></li>
                        @can('banner')
                                <li @if(\Illuminate\Support\Facades\URL::current() == route('banner')) class="active" @endif>
                                <a href="{{route('banner')}}"><i data-feather="flag"></i><span>Banners</span></a></li>
                        @endcan
                        @can('coupon')
                                <li @if(\Illuminate\Support\Facades\URL::current() == route('coupon')) class="active" @endif>
                            <a href="{{route('coupon')}}"><i data-feather="speaker"></i><span>Coupons</span></a></li>
                        @endcan
                    </ul>
                </li>
                    @endcan

                    @can('employee')
                        <li class="submenu-open">
                            <h6 class="submenu-hdr">Customers</h6>
                            <ul>
                                <li @if(\Illuminate\Support\Facades\URL::current() == route('all-customers')) class="active" @endif>
                                    <a href="{{route('all-customers')}}"><i data-feather="users"></i><span>Customers</span></a>
                                </li>
                            </ul>
                        </li>
                    @endcan

                    @can('orders')
                <li class="submenu-open">
                    <h6 class="submenu-hdr">Sales</h6>
                    <ul>
                        <li @if(\Illuminate\Support\Facades\URL::current() == route('orders')) class="active" @endif>
                            <a href="{{route('orders')}}"><i data-feather="shopping-cart"></i><span>Orders</span></a></li>
                        @can('invoices')
                        <li><a href="{{route('invoice')}}"><i data-feather="file-text"></i><span>Statements</span></a></li>
                        <li><a href="{{route('general.payment')}}"><i data-feather="dollar-sign"></i><span>Payment</span></a></li>
                        <li><a href="{{route('reports')}}"><i data-feather="file-text"></i><span>Reports</span></a></li>
                        @endcan
                    </ul>
                </li>
                    @endcan
                @can('delivery')
                <li class="submenu-open">
                    <h6 class="submenu-hdr">Delivery</h6>
                    <ul>
                        <li @if(\Illuminate\Support\Facades\URL::current() == route('delivery')) class="active" @endif>
                            <a href="{{route('delivery')}}"><i data-feather="truck"></i><span>Delivery</span></a></li>
                    </ul>
                </li>
                @endcan
                    @can('employee')
                <li class="submenu-open">

                    <h6 class="submenu-hdr">Peoples</h6>

                    <ul>
                        <li class="submenu">
                            <a href="javascript:void(0);"><i data-feather="user-check"></i><span>Employees</span><span class="menu-arrow"></span></a>
                            <ul>
                                @can('create_employee')
                                    <li @if(\Illuminate\Support\Facades\URL::current() == route('employee.create')) class="active" @endif>
                                    <a href="{{route('employee.create')}}">New Employee </a></li>
                                @endcan
                                <li><a href="{{route('employee.index')}}">Employees List</a></li>
                            </ul>
                        </li>
                        @can('role')
                            <li @if(\Illuminate\Support\Facades\URL::current() == route('role.index')) class="active" @endif>
                            <a href="{{route('role.index')}}"><i data-feather="shield"></i><span>Roles</span></a></li>
                        @endcan
                    </ul>
                </li>
                    @endcan
                    @can('setting')
                    <li class="submenu-open">
                        <h6 class="submenu-hdr">Logs</h6>
                        <ul>
                            <li class="submenu">
                                <a href="javascript:void(0);"><i data-feather="file-text"></i><span>Logs</span><span class="menu-arrow"></span></a>
                                <ul>
                                    <li @if(\Illuminate\Support\Facades\URL::current() == route('order.logs')) class="active" @endif>
                                        <a href="{{route('order.logs')}}">Invoices </a></li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                <li class="submenu-open">
                    <h6 class="submenu-hdr">Settings</h6>
                    <ul>
                        <li @if(\Illuminate\Support\Facades\URL::current() == route('setting')) class="active" @endif>
                        <a href="{{route('setting')}}"><i data-feather="settings"></i><span> Settings</span></a></li>
                        <li>
                            <form action="{{route('admin-logout')}}" method="POST">
                                @method('POST')
                                @csrf
                                <button type="submit" class="dropdown-item d-flex" >
                                    <i data-feather="log-out"></i><span>Logout</span>
                                </button>
                            </form>
                        </li>
                    </ul>
                </li>
                @endcan
            </ul>
        </div>
    </div>
</div>
@endif
