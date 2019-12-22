<?php $__env->startSection('htmlheader_title'); ?>
    Comprobante
<?php $__env->stopSection(); ?>

<?php $__env->startSection('contentheader_title'); ?>
    Comprobante de venta
<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumbs'); ?>
    <?php echo e(Breadcrumbs::render('detalles', $sells)); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('template_linked_css'); ?>
  <!-- Css Extras -->
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="container-fluid spark-screen">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <?php if($sells->count()>0 && $sells->operation_type_id == 2): ?>
                <?php
                    $configSimbMon =Config::find(5)->val;
                    $configValImp = Config::find(4)->val;
                ?>
                <div class="card panel-success">
                    <div class="card-header with-border">
                        <div class="float-left">
                            <i class="fab fa-product-hunt"></i> Comprobante salida # <?php echo e(str_pad ($sells->id, 7, '0', STR_PAD_LEFT)); ?>

                        </div>
                        <div class="float-right">
                        <div class="input-group oculto-impresion">
                            <?php echo HTML::icon_link(URL::to(Route('caja.index')), 'fas fa-reply fa-fw', ' Regresar a ventas', array('class' => 'btn btn-sm btn-secondary')); ?>

                              
                                <button type="submit" class="btn btn-sm btn-info" onClick="window.print()">
                                    <i class="fas fa-print"></i>  Ticket
                                </button>
                        </div>
                        </div>
                        <!-- /.box-tools -->
                    </div>
                    <!-- /.box-header -->
                    <div class="card-body">
                        
                        <div class="row">
                            <div class="col-md-12">
                                    <div class="well">
                                        Le atendio:
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <input class="form-control" type="text" readonly value="<?php echo e($sells->user->name); ?>" />
                                            </div>
                                        </div>
                                    </div>
                                    
                                <div class="well">
                                    Datos cliente:
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

                                <hr />
                                <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                    <tr>
                                        <th>Producto</th>
                                        <th>Cantidad</th>
                                        <th>P.U</th>
                                        <th>Total</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    <?php $__currentLoopData = $operations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $operation): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><?php echo e($operation->product->name); ?></td>
                                        <td class="text-right"><?php echo e($q1=$operation->q); ?></td>
                                        <td class="text-right"><?php echo e($configSimbMon); ?> <?php echo e(number_format( $q2=$operation->product->price_out, 2)); ?></td>
                                        <td class="text-right"><?php echo e($configSimbMon); ?> <?php echo e(number_format($q3=$q1*$q2, 2)); ?></td>
                                    </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </tbody>
                                    <tfoot>
                                        
                                    <tr>
                                    
                                    <tr>
                                        <td colspan="3" class="text-right"><b>Sub Total:</b></td>
                                        <td class="text-right"><?php echo e($configSimbMon); ?> <?php echo e(number_format($sells->total/(1 + ($configValImp/100) ),2,'.',',')); ?></td>
                                    </tr>
                                    <td colspan="3" class="text-right"><b><?php echo e(Config::find(3)->val); ?>:</b></td>
                                        <td class="text-right"><?php echo e($configSimbMon); ?> <?php echo e(number_format(($sells->total/(1 + ($configValImp/100) )) *($configValImp/100),2,'.',',')); ?></td>
                                    </tr>
                                    <tr>
                                        <td colspan="3" class="text-right"><b>Total:</b></td>
                                        <td class="text-right"><?php echo e($configSimbMon); ?> <?php echo e(number_format($sells->total, 2,'.',',')); ?></td>
                                    </tr>
                                    </tfoot>
                                </table>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                    <!-- /.box-body -->
                </div>
                <?php else: ?>
                        <div class="alert alert-danger">
                          <strong>Error!</strong> El comprobante que ingreso no existe.
                          <br>
                          <a href="/sells" class="btn btn-sm btn-info">Regresar</a>
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