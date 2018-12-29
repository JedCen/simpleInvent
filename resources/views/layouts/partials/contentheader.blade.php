<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">
                    @yield('contentheader_title', 'Page Header here')
                    <small>@yield('contentheader_description')</small>
                </h1>
            </div>
            <!-- /.col -->
            <div class="col-sm-6">
                @yield('breadcrumbs')
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</div>