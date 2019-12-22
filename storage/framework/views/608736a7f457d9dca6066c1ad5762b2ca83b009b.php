 
<?php $__env->startSection('htmlheader_title'); ?> Password recovery
<?php $__env->stopSection(); ?>
 
<?php $__env->startSection('content'); ?>

<body class="login-page">
    <div id="app">

        <div class="login-box">
            <div class="login-logo">
                <a href="<?php echo e(url('/home')); ?>"><b>Admin</b>LTE</a>
            </div>
            <!-- /.login-logo -->

            <?php if(session('status')): ?>
            <div class="alert alert-success">
                <?php echo e(session('status')); ?>

            </div>
            <?php endif; ?> 
            <div class="card">
                <div class="login-card-body">
                    <p class="login-card-msg">Reset Password</p>
                    <form method="POST" action="<?php echo e(route('password.email')); ?>">
                        <?php echo csrf_field(); ?>

                        <div class="form-group row">
                            <label for="email" class="col-md-12 col-form-label"><?php echo e(__('E-Mail Address')); ?></label>

                            <div class="col-md-12">
                                <input id="email" type="email" class="form-control<?php echo e($errors->has('email') ? ' is-invalid' : ''); ?>" name="email" value="<?php echo e(old('email')); ?>"
                                    required> <?php if($errors->has('email')): ?>
                                <span class="invalid-feedback">
                                        <strong><?php echo e($errors->first('email')); ?></strong>
                                    </span> <?php endif; ?>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-6">
                                <button type="submit" class="btn btn-primary btn-block">
                                    <?php echo e(__('Enviar email')); ?>

                                </button>
                            </div>
                        </div>
                    </form>

                    <p class="mb-1">
                        <a href="<?php echo e(url('/login')); ?>">Log in</a>
                    </p>
                    
                </div>
                <!-- /.login-box-body -->
            </div>
        </div>
        <!-- /.login-box -->
    </div>
    <?php echo $__env->make('layouts.partials.scripts_auth', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>

    <script>
        $(function () {
            $('input').iCheck({
                checkboxClass: 'icheckbox_square-blue',
                radioClass: 'iradio_square-blue',
                increaseArea: '20%' // optional
            });
        });
    </script>
</body>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.auth', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>