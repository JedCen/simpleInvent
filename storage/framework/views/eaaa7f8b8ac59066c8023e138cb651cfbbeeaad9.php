<?php $__env->startSection('htmlheader_title'); ?>
    Inventario
<?php $__env->stopSection(); ?>

<?php $__env->startSection('contentheader_title'); ?>
    <i class='fa fa-product'></i> Inventario
<?php $__env->stopSection(); ?>

<?php $__env->startSection('template_linked_css'); ?>
  <!-- Css Extras -->
 
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
	<div class="container-fluid spark-screen">
		<div class="row">
			<div class="col-md-12">

				<div class="card panel-info">
                    <div class="card-header">
                        <div class="float-left">
                            <h5 class="card-title"><i class='fa fa-product-hunt'></i> Titulo </h5>
                        </div>
                        <div class="float-right">
                            "xd"
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        Put your content here
                    </div>
                    <!-- /.card-body -->
                </div>

			</div>
		</div>
	</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('footer_scripts'); ?>
<!-- Scripts Extras -->
    
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>