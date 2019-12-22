<?php $__env->startSection('htmlheader_title'); ?>
    Caja
<?php $__env->stopSection(); ?>

<?php $__env->startSection('contentheader_title'); ?>
    <i class='fa fa-archive'></i> Caja
<?php $__env->stopSection(); ?>

<?php $__env->startSection('template_linked_css'); ?>
  <!-- Css Extras -->
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="container-fluid spark-screen">
        <div class="row">
            <div class="col-md-12 col-md">

              <div class="card panel-primary <?php if (Auth::check() && Auth::user()->hasRole('admin', true)): ?> panel-success  <?php endif; ?>">
                    <div class="card-header">
                        <div class="float-left">
                            <i class='fa fa-archive'></i> Caja
                        </div>
                        <div class="float-right">
                            <div class="btn-group">
                                <a href="<?php echo e(route('caja.index')); ?>" class="btn btn-sm btn-secondary "><i class="fa fa-clock"></i> Historial</a>
                                <a href="<?php echo e(route('caja.index')); ?>" class="btn btn-sm btn-secondary ">Corte caja <i class="fa fa-box"></i></a>
                            </div>
                        </div>
                        <!-- /.box-tools -->
                    </div>
                    <!-- /.box-header -->
                    <div class="card-body">
                        
                        <div class="clearfix"></div>   
                            
                            <?php if($sells->count()>0): ?>
                            
                            <?php $total_total = 0; ?>
                            
                            <br>
                            <table class="table table-hover">
                                <thead>
                                    <th></th>
                                    <th>Producto</th>
                                    <th>Total</th>
                                    <th>Fecha</th>
                                </thead>

                                <?php $__currentLoopData = $sells; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sell): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td style="width:30px;">
                                        <?php echo e($sell->id); ?>

                                    </td>
                                    <td>
                                        <?php 
                                        $operations = Operation::getAllProductsBySellId($sell->id); 
                                        $product2 ='';
                                        ?>
                                        
                                        <?php $__currentLoopData = $operations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $opera): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php $product2 = $opera->product->name; ?>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php echo e($product2); ?>

                                    </td>
                                    <td>
                                    <?php
                                        $total=0;
                                        foreach($operations as $operation){
                                            $product  = $operation->getProduct();
                                            $total += $operation->q*$product->price_out;
                                        }
                                            $total_total += $total;
                                    ?> 
                                             <b>$ <?php echo e(number_format($total,2,".",",")); ?></b>
                                    </td>
                                    <td>
                                        <?php echo e($sell->created_at); ?>

                                    </td>
                                </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                            </table>
                            <h1>Total: <?php echo e("$ ".number_format($total_total,2,".",",")); ?></h1>
                            <?php else: ?> 
                                <div class="jumbotron">
                                    <h2>No hay ventas</h2>
                                    <p>No se ha realizado ninguna venta.</p>
                                </div>
                            <?php endif; ?>
                    </div>
                    <!-- /.box-body -->
                </div>

            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('footer_scripts'); ?>
<!-- Scripts Extras -->
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>