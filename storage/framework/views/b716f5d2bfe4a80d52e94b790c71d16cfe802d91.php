<?php $__env->startSection('htmlheader_title'); ?>
    Inventario
<?php $__env->stopSection(); ?>

<?php $__env->startSection('contentheader_title'); ?>
    <i class="fab fa-product-hunt    "></i> Inventario
<?php $__env->stopSection(); ?>

<?php $__env->startSection('template_linked_css'); ?>
  <!-- Css Extras -->
 
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
	<div class="container-fluid spark-screen">
		<div class="row">
			<div class="col-md-12">
                    <?php if($sells->count()>0 && $sells->operation_type_id == 1): ?>
                    <?php
                        $simbol = Config::find(5)->val;
                    ?>
				<div class="card panel-info">
                    <div class="card-header">
                        <div class="float-left">
                            <i class="fab fa-product-hunt"></i> Comprobante entrada # <?php echo e(str_pad ($sells->id, 7, '0', STR_PAD_LEFT)); ?>

                        </div>
                        <div class="float-right">
                                <?php echo HTML::icon_link(URL::to('/abastecimientos'), 'fa fa-mail-reply fa-fw', 'Regresar a Abastecimientos', array('class' => 'btn btn-sm btn-info')); ?>

                            </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="well">
                            <div class="row">
                                <div class="col-sm-6">
                                    <input class="form-control" type="text" readonly value="<?php echo e($sells->person->name); ?>" />
                                </div>
                                <div class="col-sm-2">
                                    <input class="form-control" type="text" readonly value=<?php echo e($sells->person->rfc); ?> />
                                </div>
                                <div class="col-sm-4">
                                    <input class="form-control" type="text" readonly value=<?php echo e($sells->person->address1); ?> />
                                </div>
                            </div>
                        </div>
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th>Producto</th>
                                <th style="width:100px;">Cantidad</th>
                                <th style="width:100px;">P.U</th>
                                <th style="width:100px;">Total</th>
                            </tr>
                            </thead>
                            <tbody>

                            <?php $__currentLoopData = $operations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $operation): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($operation->product->name); ?></td>
                                <td class="text-right"><?php echo e($q1=$operation->q); ?></td>
                                <td class="text-right"><?php echo e($simbol); ?> <?php echo e(number_format( $q2=$operation->product->price_in, 2)); ?></td>
                                <td class="text-right"><?php echo e($simbol); ?> <?php echo e(number_format($q3=$q1*$q2, 2)); ?></td>
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                            <tfoot>
                            <tr>
                                <td colspan="3" class="text-right"><b>Total</b></td>
                                <td class="text-right"><?php echo e($simbol); ?> <?php echo e(number_format($q3, 2)); ?></td>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
                <?php else: ?>
                    <div class="card panel-danger">
                        <div class="card-header">Error!!
                        </div>
                        <div class="card-body">
                            <div class="jumbotron">
                                <strong>Error!</strong> El comprobante que ingreso no existe.
                                <br>
                                    <a href="<?php echo e(route('reabastecerinv')); ?>" class="btn btn-sm btn-danger">Regresar</a>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
			</div>
		</div>
	</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('footer_scripts'); ?>
<!-- Scripts Extras -->
    
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>