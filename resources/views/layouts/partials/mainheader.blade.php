<!-- Main Header -->

<!-- Navbar -->
<nav class="main-header navbar navbar-expand bg-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#"><i class="fa fa-bars"></i></a>
        </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <!-- Notifications Dropdown Menu -->
        <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
                <i class="far fa-bell"></i>
                <span class="badge badge-warning navbar-badge"> {{ $cnt_tot }} </span>
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                <span class="dropdown-item dropdown-header">{{ $cnt_tot }} Notifications</span>
                @if ($cnt_tot > 0)
                    @foreach (Product::all() as $produc)
                    @php 
                        $q= Operation::getQYesF($produc->id);
                    @endphp
                        @if( $q==0 ||  $q<=$produc->inventary_min)
                            <div class="dropdown-divider"></div>
                                <a href="{{ route('abastecerinv') }}" class="dropdown-item">
                                <i class="fas fa-exclamation-triangle mr-2" style="color:Tomato"></i> {{$q}} pz: {{$produc->name}}
                                <span class="float-right text-muted text-sm">
                                    <?php if($q==0){ echo "<span class='label label-danger'>No hay</span>";}else if($q<=$produc->inventary_min/2){ echo "<span class='label label-danger'>Muy pocas</span>";} else if($q<=$produc->inventary_min){ echo "<span class='label label-warning'>Pocas</span>";} ?>
                                </span>
                            </a>
                        @endif
                    @endforeach
                @else
                    <a class="dropdown-item disabled" href="#">No hay alertas</a>
                @endif
                
                <div class="dropdown-divider"></div>
            <a href="{{ route('producto.index') }}" class="dropdown-item dropdown-footer">Ver productos</a>
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
    </ul>
</nav>
<!-- /.navbar -->