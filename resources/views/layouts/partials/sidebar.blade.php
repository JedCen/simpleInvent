<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-info elevation-4">
    <!-- Brand Logo -->
    <a href="{{url('/home')}}" class="brand-link bg-info">
        <!-- User Image -->
        @if ($configimagen->val != NULL)
        <img src="{{ $configimagen->val }}" alt="{{ $configimagen->name }}" class="brand-image img-circle elevation-3"
            style="opacity: .8"> 
        @else
            <img src="{{ Gravatar::get(Auth::user()->email) }}" alt="{{ Auth::user()->name }}" class="brand-image img-circle elevation-3" style="opacity: .8">        
        @endif
        <span class="brand-text font-weight-light">{{ $configNomEmp }}</span>
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