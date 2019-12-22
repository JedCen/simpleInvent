<?php $__env->startSection('htmlheader_title'); ?> Venta
<?php $__env->stopSection(); ?>

<?php $__env->startSection('contentheader_title'); ?> Nueva venta
<?php $__env->stopSection(); ?>


<?php $__env->startSection('template_linked_css'); ?>
<!-- Css Extras -->
<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumbs'); ?>
    <?php echo e(Breadcrumbs::render('venta')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?> 
<?php 
    $levelAmount = 'level'; 
    if (Auth::User()->level() >= 2) { 
        $levelAmount = 'levels';
    }
?>


<div class="card panel-info">
    <div class="card-header">
        <div class="float-left">
            <i class="fab fa-buysellads"></i> Nueva Venta
        </div>
    </div>
    <div class="card-body">
        <venta-up></venta-up>
    </div>
    <?php if(Session::has('ventaUP')): ?>
        <div class="card-footer">
            <p class='alert alert-success'>Venta procesada exitosamente. <?php echo HTML::icon_link(URL::to('/sells/detail/'.Session::get('ventaUP')), 'far fa-eye fa-fw', 'VER', array('class' => 'btn btn-sm btn-info')); ?> </p>
        </div>
    <?php endif; ?>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('footer_scripts'); ?>
<!-- Scripts Extras -->
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>