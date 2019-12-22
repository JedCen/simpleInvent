<?php $__env->startSection('htmlheader_title'); ?>
    Inventario
<?php $__env->stopSection(); ?>

<?php $__env->startSection('contentheader_title'); ?>
    <i class="fas fa-chart-line"></i> Reporte por producto
<?php $__env->stopSection(); ?>

<?php $__env->startSection('template_linked_css'); ?>
  <!-- Css Extras -->
 
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="container-fluid spark-screen">
        <div class="row">
            <div class="col-md-12 col-md">
                <div class="card panel-success">
                    <div class="card-header">
                        <div class="float-left">
                                <i class='fab fa-product-hunt'></i> Reporte de producto
                        </div>
                        <div class="float-right">
                            <div class="btn-group" role="group" aria-label="Button group with nested dropdown">
                                <div class="btn-group" role="group">
                                <button id="btnGroupDrop1" type="button" class="btn btn-sm btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Descargar
                                </button>
                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="btnGroupDrop1">
                                        <a class="dropdown-item" href="<?php echo e(route('producto.pdf')); ?>">Descargar PDF</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> <!-- /.box-header -->
                    <div class="card-body">
                        <div class="clearfix"></div> 
                        <div class="box">
                            <div class="box-header">
                                    
                            </div>
                            <div class="box-body table-responsive">
                                <table id="datatable" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                        <th>Codigo</th>
                                        <th>Nombre</th>
                                        <th>Precio Salida</th>
                                        <th>Categoria</th>
                                        <th>Disponible</th>
                                        <th>Total $</th>
                                        <th class="text-center"> <i class="fa fa-history"></i></th>
                                        </tr>
                                    </thead>
                                    <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php 
                                        $q= Operation::getQYesF($product->id);
                                        ?>
                                    <tr>
                                        <td><?php echo e($product->barcode); ?></td>
                                        <td><?php echo e($product->name); ?></td>
                                        <td>$ <?php echo e(number_format($product->price_out,2,'.',',')); ?></td>
                                        <td><?php if($product->category_id!=null){echo $product->category->name;}else{ echo "<center>----</center>"; }  ?> 
                                        </td>
                                        <td><?php echo e($q); ?></td>
                                        <td>  
                                            <?php
                                                $total = 0;   
                                                    $total += $q*$product->price_out;               
                                            ?>
                                            <b>$ <?php echo e(number_format($total,2,".",",")); ?></b>
                                        </td>
                                        <td style="width:70px;">
                                            <?php echo HTML::icon_link(URL::to(route('inventario.history', $product->id)), 'fa fa-history fa-fw','', array('class' => 'btn btn-xs btn-info', 'data-toggle' => 'tooltip', 'title' => 'Historial de producto')); ?>

                                        </td>
                                    </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </table>
                            </div>
                        </div>
                    </div><!-- /.box-body -->
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('footer_scripts'); ?>
<!-- Scripts Extras -->
    
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>