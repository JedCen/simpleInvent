<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
    @section('htmlheader')
        @include('layouts.partials.htmlheader')
    @show
<!--
BODY TAG OPTIONS:
=================
Apply one or more of the following classes to to the body tag
to get the desired effect
|---------------------------------------------------------|
|LAYOUT OPTIONS | sidebar-collapse                        |
|               | sidebar-mini                            |
|---------------------------------------------------------|
-->
<body class="hold-transition sidebar-mini">
<div id="app" v-cloak>
    <div class="wrapper">

        @include('layouts.partials.mainheader')
      
        @include('layouts.partials.sidebar')
      
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            @include('layouts.partials.contentheader')
          <!-- /.content-header -->
      
          <!-- Main content -->
          <section class="content">
            <div class="container-fluid">
                @yield('content')
              
            </div><!-- /.container-fluid -->
          </section>
          <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->
        
        @include('layouts.partials.controlsidebar')
        @include('layouts.partials.footer')
      </div>
<!-- ./wrapper -->
</div

@section('scripts')
    @include('layouts.partials.scripts')
@show

@yield('footer_scripts')
</body>
</html>
