<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">
                    <?php echo $__env->yieldContent('contentheader_title', 'Page Header here'); ?>
                    <small><?php echo $__env->yieldContent('contentheader_description'); ?></small>
                </h1>
            </div>
            <!-- /.col -->
            <div class="col-sm-6">
                <?php echo $__env->yieldContent('breadcrumbs'); ?>
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</div>