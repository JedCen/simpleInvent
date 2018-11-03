<!-- Main Header -->

<!-- Navbar -->
<nav class="main-header navbar navbar-expand bg-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#"><i class="fa fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="index3.html" class="nav-link">Home</a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="#" class="nav-link">Contact</a>
        </li>
    </ul>

    <!-- SEARCH FORM -->
    <form class="form-inline ml-3">
        <div class="input-group input-group-sm">
            <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
            <div class="input-group-append">
                <button class="btn btn-navbar" type="submit">
            <i class="fa fa-search"></i>
            </button>
            </div>
        </div>
    </form>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <!-- Notifications Dropdown Menu -->
        <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
                <i class="far fa-bell"></i>
                <span class="badge badge-warning navbar-badge"> 15 </span>
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                <span class="dropdown-item dropdown-header">15 Notifications</span>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item">
                    <i class="fa fa-envelope mr-2"></i> 4 new messages
                    <span class="float-right text-muted text-sm">3 mins</span>
                 </a>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item">
                    <i class="fa fa-users mr-2"></i> 8 friend requests
                    <span class="float-right text-muted text-sm">12 hours</span>
                </a>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item">
                    <i class="fa fa-file mr-2"></i> 3 new reports
                    <span class="float-right text-muted text-sm">2 days</span>
                </a>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
            </div>
        </li>
        
        <li class="nav-item dropdown profile">
            <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown" role="button"
                aria-expanded="false"><img src="{{ Auth::user()->profile->avatar }}" class="user-avatar-nav"> <span
                        class="caret"></span></a>
            <ul class="dropdown-menu dropdown-menu-right" style="padding-right: 10px;padding-left: 10px; min-width: 17rem;">
                <li class="profile-img">
                    <img src="{{ Auth::user()->profile->avatar }}" class="profile-img">
                    <div class="profile-body">
                        <h5>{{ Auth::user()->name }}</h5>
                        <h6>{{ Auth::user()->email }}</h6>
                    </div>
                </li>
                <li class="dropdown-divider"></li>
                <?php $nav_items = config('inventarioxd.dashboard.navbar_items'); ?>
                <a class="dropdown-item {{ Request::is('profile/'.Auth::user()->name, 'profile/'.Auth::user()->name . '/edit') ? 'active' : null }}" href="{{ url('/profile/'.Auth::user()->name) }}">
                    <i class="fa fa-user"></i>
                    @lang('titles.profile')
                </a>
                @if(is_array($nav_items) && !empty($nav_items))
                @foreach($nav_items as $name => $item)
                <li {!! isset($item['classes']) && !empty($item['classes']) ? 'class="'.$item['classes'].'"' : '' !!}>
                    @if(isset($item['route']) && $item['route'] == 'logout')
                    <form action="{{ route('logout') }}" method="POST">
                        {{ csrf_field() }}
                        <button type="submit" class="btn btn-danger btn-block">
                            @if(isset($item['icon_class']) && !empty($item['icon_class']))
                            <i class="{!! $item['icon_class'] !!}"></i>
                            @endif
                            {{$name}}
                        </button>
                    </form>
                    @else
                    <a  class="dropdown-item" href="{{ isset($item['route']) && Route::has($item['route']) ? route($item['route']) : (isset($item['route']) ? $item['route'] : '#') }}" {!! isset($item['target_blank']) && $item['target_blank'] ? 'target="_blank"' : '' !!}>
                        @if(isset($item['icon_class']) && !empty($item['icon_class']))
                        <i class="{!! $item['icon_class'] !!}"></i>
                        @endif
                        {{$name}}
                    </a>
                    @endif
                </li>
                @endforeach
                @endif
            </ul>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#"><i
            class="fa fa-th-large"></i></a>
        </li>

    </ul>
</nav>
<!-- /.navbar -->