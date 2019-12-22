<?php $__env->startSection('htmlheader_title'); ?>
    Abastecer
<?php $__env->stopSection(); ?>

<?php $__env->startSection('contentheader_title'); ?>
    <i class="fa fa-history"></i> Abastecer
<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumbs'); ?>
    <?php echo e(Breadcrumbs::render('abastecer')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<div class="card panel-primary <?php if (Auth::check() && Auth::user()->hasRole('admin', true)): ?> panel-info  <?php endif; ?>">
    <div class="card-header">
        Bienvenido <?php echo e(Auth::user()->name); ?>

        <div class="float-right">
            <?php if (Auth::check() && Auth::user()->hasRole('admin', true)): ?>
                <span class="label label-info">
                Admin Access
                </span>
            <?php else: ?>
                <span class="label label-warning">
                User Access
                </span>
            <?php endif; ?>
        </div>
    </div>
    <div class="card-body">
        <stockup></stockup>
    </div>
</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>