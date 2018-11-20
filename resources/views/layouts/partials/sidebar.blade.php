<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-info elevation-4">
    <!-- Brand Logo -->
    <a href="{{url('/home')}}" class="brand-link bg-info">
        <!-- User Image -->
        @php
            $imageconfig = Config::find(6);
        @endphp
        @if ($imageconfig->val != NULL)
        <img src="{{ $imageconfig->val }}" alt="{{ $imageconfig->name }}" class="brand-image img-circle elevation-3"
            style="opacity: .8"> 
        @else
            <img src="{{ Gravatar::get(Auth::user()->email) }}" alt="{{ Auth::user()->name }}" class="brand-image img-circle elevation-3" style="opacity: .8">        
        @endif
        <span class="brand-text font-weight-light">{{ Config::find(1)->val }}</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->

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