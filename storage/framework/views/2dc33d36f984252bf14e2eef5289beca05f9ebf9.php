 
<?php $__env->startSection('htmlheader_title'); ?> Log in
<?php $__env->stopSection(); ?>
 
<?php $__env->startSection('content'); ?>

<body class="hold-transition login-page">
        <div class="login-box" id="app" v-cloak>
            <div class="login-logo">
                <a href="<?php echo e(url('/home')); ?>">
                    <img src="<?php if(Config::find(6)->val != NULL): ?> <?php echo e(Config::find(6)->val); ?> <?php endif; ?>" alt="<?php echo e(Config::find(6)->name); ?>" class="img-circle elevation-3"
                    style="opacity: .8; width: 200px; height: 100px;">
                </a>
            </div>
            <!-- /.login-logo -->

            <div class="card panel-info">
                <div class="card-header"><?php echo e(trans('message.siginsession')); ?></div>
                <div class="card-body login-card-body">

                    <login-form name="<?php echo e(config('auth.providers.users.field','email')); ?>" domain="<?php echo e(config('auth.defaults.domain','')); ?>"></login-form>

                    
                    <p class="mb-1">
                        <a href="<?php echo e(url('/password/reset')); ?>"><?php echo e(trans('message.forgotpassword')); ?></a>
                    </p>
                    
                </div>
            </div>

        </div>
    <?php echo $__env->make('layouts.partials.scripts_auth', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
</body>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.auth', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>