<?php $__env->startSection('title-head'); ?>
    Productos
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="container-fluid spark-screen">
    <div class="row">
        <div class="col-md-12 col-md">
            <h3 class="box-title"><i class='fa fa-product-hunt'></i> Productos</h3>
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Lista de productos <span class="derecha"><?php echo e(now()); ?></span></h3>
                    </div>
                    <div class="box-body">
                        <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                <th>Codigo</th>
                                <th>Nombre</th>
                                <th>Precio Entrada</th>
                                <th>Precio Salida</th>
                                <th>Categoria</th>
                                <th>Minima</th>
                                <th>Activo</th>
                                </tr>
                            </thead>
                            <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($product->barcode); ?></td>
                                <td><?php echo e($product->name); ?></td>
                                <td>$ <?php echo e(number_format($product->price_in,2,'.',',')); ?></td>
                                <td>$ <?php echo e(number_format($product->price_out,2,'.',',')); ?></td>
                                <td><?php if($product->category_id!=null){echo $product->category->name;}else{ echo "<center>----</center>"; }  ?> </td>
                                <td><?php echo e($product->inventary_min); ?></td>
                                <td><?php if($product->is_active == 'ON'): ?><i class="fa fa-check"></i><?php endif;?></td>
                            
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </table>
                        <div class="shadow-lg p-3 mb-5 bg-white rounded">
                            <p class="font-weight-bold">Total registrado: <?php echo e(count($products)); ?></p>
                        </div>
                    </div>
                    </div>
                </div>
                    <!-- /.box-body -->
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.report', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>