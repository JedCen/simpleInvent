<?php $__env->startSection('htmlheader_title'); ?>
    Registro
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<body class="hold-transition register-page">
    <div id="app" v-cloak>
        <div class="register-box">
            <div class="register-logo">
                <a href="<?php echo e(url('/home')); ?>">
                    <img src="<?php if(Config::find(6)->val != NULL): ?> <?php echo e(Config::find(6)->val); ?> <?php endif; ?>" alt="<?php echo e(Config::find(6)->name); ?>" class="img-circle elevation-3"
                    style="opacity: .8; width: 200px; height: 100px;">
                </a>
            </div>

            <?php if(count($errors) > 0): ?>
                <div class="alert alert-danger">
                    <strong>Whoops!</strong> <?php echo e(trans('message.someproblems')); ?><br><br>
                    <ul>
                        <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li><?php echo e($error); ?></li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                </div>
            <?php endif; ?>
            <div class="card">
                <div class="card-body register-card-body">
                    <p class="login-box-msg"><?php echo e(trans('message.registermember')); ?></p>

                    <register-form></register-form>
                <div class="social-auth-links text-center">
                        <p>- OR -</p>
                    <?php echo $__env->make('partials.socials', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                </div>
                    <a href="<?php echo e(url('/login')); ?>" class="text-center"><?php echo e(trans('message.membership')); ?></a>
                </div><!-- /.form-box -->
            </div>
        </div><!-- /.register-box -->
    </div>

    <?php echo $__env->make('layouts.partials.scripts_auth', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

    <?php echo $__env->make('auth.terms', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

</body>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.auth', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>