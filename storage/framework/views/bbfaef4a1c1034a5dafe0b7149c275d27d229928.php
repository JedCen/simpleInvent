<?php $__env->startSection('htmlheader_title'); ?>
    Clientes
<?php $__env->stopSection(); ?>

<?php $__env->startSection('contentheader_title'); ?>
    <i class='fa fa-user'></i> Lista de clientes
<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumbs'); ?>
    <?php echo e(Breadcrumbs::render('cliente')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('template_linked_css'); ?>
  <!-- Css Extras -->
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <newcliente></newcliente>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('footer_scripts'); ?>
<!-- Scripts Extras -->
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>