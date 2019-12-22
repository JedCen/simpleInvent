<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-info elevation-4">
    <!-- Brand Logo -->
    <a href="<?php echo e(url('/home')); ?>" class="brand-link bg-info">
        <!-- User Image -->
        <?php if($configimagen->val != NULL): ?>
        <img src="<?php echo e($configimagen->val); ?>" alt="<?php echo e($configimagen->name); ?>" class="brand-image img-circle elevation-3"
            style="opacity: .8"> 
        <?php else: ?>
            <img src="<?php echo e(Gravatar::get(Auth::user()->email)); ?>" alt="<?php echo e(Auth::user()->name); ?>" class="brand-image img-circle elevation-3" style="opacity: .8">        
        <?php endif; ?>
        <span class="brand-text font-weight-light"><?php echo e($configNomEmp); ?></span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->

        <?php require config_path('menu.php'); ?>
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <?php echo e(Menu::sidebar()); ?>

            <?php if (Auth::check() && Auth::user()->hasRole('admin')): ?>
                <?php echo e(Menu::sidebarAdmin()); ?>

            <?php endif; ?>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>