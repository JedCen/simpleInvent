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
                <span class="badge badge-warning navbar-badge"> <?php echo e($cnt_tot); ?> </span>
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                <span class="dropdown-item dropdown-header"><?php echo e($cnt_tot); ?> Notifications</span>
                <?php if($cnt_tot > 0): ?>
                    <?php $__currentLoopData = Product::all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $produc): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php 
                        $q= Operation::getQYesF($produc->id);
                    ?>
                        <?php if( $q==0 ||  $q<=$produc->inventary_min): ?>
                            <div class="dropdown-divider"></div>
                                <a href="<?php echo e(route('abastecerinv')); ?>" class="dropdown-item">
                                <i class="fas fa-exclamation-triangle mr-2" style="color:Tomato"></i> <?php echo e($q); ?> pz: <?php echo e($produc->name); ?>

                                <span class="float-right text-muted text-sm">
                                    <?php if($q==0){ echo "<span class='label label-danger'>No hay</span>";}else if($q<=$produc->inventary_min/2){ echo "<span class='label label-danger'>Muy pocas</span>";} else if($q<=$produc->inventary_min){ echo "<span class='label label-warning'>Pocas</span>";} ?>
                                </span>
                            </a>
                        <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php else: ?>
                    <a class="dropdown-item disabled" href="#">No hay alertas</a>
                <?php endif; ?>
                
                <div class="dropdown-divider"></div>
            <a href="<?php echo e(route('producto.index')); ?>" class="dropdown-item dropdown-footer">Ver productos</a>
            </div>
        </li>
        
        <li class="nav-item dropdown profile">
            <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown" role="button"
                aria-expanded="false"><img src="<?php echo e(Auth::user()->profile->avatar); ?>" class="user-avatar-nav"> <span
                        class="caret"></span></a>
            <ul class="dropdown-menu dropdown-menu-right" style="padding-right: 10px;padding-left: 10px; min-width: 17rem;">
                <li class="profile-img">
                    <img src="<?php echo e(Auth::user()->profile->avatar); ?>" class="profile-img">
                    <div class="profile-body">
                        <h5><?php echo e(Auth::user()->name); ?></h5>
                        <h6><?php echo e(Auth::user()->email); ?></h6>
                    </div>
                </li>
                <li class="dropdown-divider"></li>
                <?php $nav_items = config('inventarioxd.dashboard.navbar_items'); ?>
                <a class="dropdown-item <?php echo e(Request::is('profile/'.Auth::user()->name, 'profile/'.Auth::user()->name . '/edit') ? 'active' : null); ?>" href="<?php echo e(url('/profile/'.Auth::user()->name)); ?>">
                    <i class="fa fa-user"></i>
                    <?php echo app('translator')->getFromJson('titles.profile'); ?>
                </a>
                <?php if(is_array($nav_items) && !empty($nav_items)): ?>
                <?php $__currentLoopData = $nav_items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $name => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li <?php echo isset($item['classes']) && !empty($item['classes']) ? 'class="'.$item['classes'].'"' : ''; ?>>
                    <?php if(isset($item['route']) && $item['route'] == 'logout'): ?>
                    <form action="<?php echo e(route('logout')); ?>" method="POST">
                        <?php echo e(csrf_field()); ?>

                        <button type="submit" class="btn btn-danger btn-block">
                            <?php if(isset($item['icon_class']) && !empty($item['icon_class'])): ?>
                            <i class="<?php echo $item['icon_class']; ?>"></i>
                            <?php endif; ?>
                            <?php echo e($name); ?>

                        </button>
                    </form>
                    <?php else: ?>
                    <a  class="dropdown-item" href="<?php echo e(isset($item['route']) && Route::has($item['route']) ? route($item['route']) : (isset($item['route']) ? $item['route'] : '#')); ?>" <?php echo isset($item['target_blank']) && $item['target_blank'] ? 'target="_blank"' : ''; ?>>
                        <?php if(isset($item['icon_class']) && !empty($item['icon_class'])): ?>
                        <i class="<?php echo $item['icon_class']; ?>"></i>
                        <?php endif; ?>
                        <?php echo e($name); ?>

                    </a>
                    <?php endif; ?>
                </li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php endif; ?>
            </ul>
        </li>
    </ul>
</nav>
<!-- /.navbar -->