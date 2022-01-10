@php
$prefix = Request::route()->getPrefix();
$route = Route::current()->getName();

@endphp

<aside class="left-sidebar bg-sidebar">
    <div id="sidebar" class="sidebar sidebar-with-footer">
        <!-- Aplication Brand -->
        <div class="app-brand">
            <a href="{{ route('dashboard') }}">
                <svg class="brand-icon" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid" width="30"
                    height="33" viewBox="0 0 30 33">
                    <g fill="none" fill-rule="evenodd">
                        <path class="logo-fill-blue" fill="#7DBCFF" d="M0 4v25l8 4V0zM22 4v25l8 4V0z" />
                        <path class="logo-fill-white" fill="#FFF" d="M11 4v25l8 4V0z" />
                    </g>
                </svg>
                <span class="brand-name">Dashboard</span>
            </a>
        </div>
        <!-- begin sidebar scrollbar -->
        <div class="sidebar-scrollbar">
            <!-- sidebar menu -->
            <ul class="nav sidebar-inner" id="sidebar-menu">
                <!-- FrontEnd -->
                <li
                    class="has-sub {{ $prefix == '/home' ? 'active' : '' }} {{ $prefix == '/home' ? 'expand' : '' }}">
                    <a class="sidenav-item-link" href="javascript:void(0)" data-toggle="collapse"
                        data-target="#dashboard" aria-expanded="false" aria-controls="dashboard">
                        <i class="mdi mdi-view-dashboard-outline"></i>
                        <span class="nav-text">FrontEnd</span> <b class="caret"></b>
                    </a>

                    <ul class="collapse {{ $prefix == '/home' ? 'show' : '' }}" id="dashboard"
                        data-parent="#sidebar-menu">
                        <div class="sub-menu">
                            <li class="{{ $route == 'home.slider' ? 'active font-weight-bold' : '' }}">
                                <a class="sidenav-item-link" href="{{ route('home.slider') }}">
                                    <span class="nav-text">Home Slider</span>
                                </a>
                            </li>
                            <li class="{{ $route == 'home.about' ? 'active font-weight-bold' : '' }}">
                                <a class="sidenav-item-link" href="{{ route('home.about') }}">
                                    <span class="nav-text">Home About</span>
                                </a>
                            </li>
                            <li class="{{ $route == 'home.service' ? 'active font-weight-bold' : '' }}">
                                <a class="sidenav-item-link" href="{{ route('home.service') }}">
                                    <span class="nav-text">Home Service</span>
                                </a>
                            </li>
                            <li class="{{ $route == 'all.multiImage' ? 'active font-weight-bold' : '' }}">
                                <a class="sidenav-item-link" href="{{ route('all.multiImage') }}">
                                    <span class="nav-text">Home Portfolio</span>
                                </a>
                            </li>
                            <li class="{{ $route == 'all.brand' ? 'active font-weight-bold' : '' }}">
                                <a class="sidenav-item-link" href="{{ route('all.brand') }}">
                                    <span class="nav-text">Home Brand</span>
                                </a>
                            </li>
                            <li class="{{ $route == 'home.contact' ? 'active font-weight-bold' : '' }}">
                                <a class="sidenav-item-link" href="{{ route('home.contact') }}">
                                    <span class="nav-text">Home Contact</span>
                                </a>
                            </li>
                        </div>
                    </ul>
                </li>

                <!-- BackEnd -->
                <li
                    class="has-sub {{ $prefix == '/contactmessages' ? 'active' : '' }} {{ $prefix == '/contactmessages' ? 'expand' : '' }}">
                    <a class="sidenav-item-link" href="javascript:void(0)" data-toggle="collapse"
                        data-target="#ui-elements" aria-expanded="false" aria-controls="ui-elements">
                        <i class="mdi mdi-folder-multiple-outline"></i>
                        <span class="nav-text">Contact</span> <b class="caret"></b>
                    </a>
                    <ul class="collapse {{ $prefix == '/contactmessages' ? 'show' : '' }}" id="ui-elements"
                        data-parent="#sidebar-menu">
                        <div class="sub-menu">

                            <li class="{{ $route == 'contact.message' ? 'active font-weight-bold' : '' }}">
                                <a class="sidenav-item-link" href="{{ route('contact.message') }}">
                                    <span class="nav-text">Contact Messages</span>
                                </a>
                            </li>

                        </div>
                    </ul>
                </li>
            </ul>
        </div>

        <hr class="separator" />
    </div>
</aside>
