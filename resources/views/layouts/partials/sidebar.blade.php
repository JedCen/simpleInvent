<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-info elevation-4">
    <!-- Brand Logo -->
    <a href="{{url('/home')}}" class="brand-link bg-info">
        <!-- User Image -->
        @if ((Auth::User()->profile) && Auth::user()->profile->avatar_status == 1)
        <img src="{{ Auth::user()->profile->avatar }}" alt="{{ Auth::user()->name }}" class="brand-image img-circle elevation-3"
            style="opacity: .8"> 
        @else
            <img src="{{ Gravatar::get(Auth::user()->email) }}" alt="{{ Auth::user()->name }}" class="brand-image img-circle elevation-3" style="opacity: .8">        
        @endif
        <span class="brand-text font-weight-light">AdminLTE 3</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        {{-- <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <!-- User Image -->
                @if ((Auth::User()->profile) && Auth::user()->profile->avatar_status == 1)
                    <img src="{{ Auth::user()->profile->avatar }}" alt="{{ Auth::user()->name }}" class="img-circle elevation-2">                
                @else
                    <img src="{{ Gravatar::get(Auth::user()->email) }}" alt="{{ Auth::user()->name }}" class="img-circle elevation-2">                
                @endif
            </div>
            <div class="info">
                <a href="#" class="d-block">{{Auth::user()->name}}</a>
            </div>
        </div> --}}

        @php require config_path('menu.php'); @endphp
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            {{ Menu::sidebar() }}
            @role('admin')
                {{ Menu::sidebarAdmin() }}
            @endrole
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>