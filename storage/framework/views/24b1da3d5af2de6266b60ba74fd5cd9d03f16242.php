<?php $__env->startSection('htmlheader_title'); ?>
    Inventario
<?php $__env->stopSection(); ?>

<?php $__env->startSection('contentheader_title'); ?>
    <i class="fab fa-product-hunt"></i> Inventario
<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumbs'); ?>
    <?php echo e(Breadcrumbs::render('inventario')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('template_linked_css'); ?>
  <!-- Css Extras -->
  <link rel="stylesheet" href="<?php echo e(asset('plugins/datatables/jquery.dataTables.min.css')); ?>">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="container-fluid spark-screen">
        <div class="row">
            <div class="col-md-12 col-md">
                <div class="card panel-info">
                    <div class="card-header">
                        <div class="float-left">
                                <i class='fab fa-product-hunt'></i> Productos en inventario
                        </div>
                        <div class="float-right">
                            <div class="btn-group" role="group" aria-label="Button group with nested dropdown">
                                <?php echo HTML::icon_link(URL::to(route('producto.create')), 'fa fa-plus-circle', ' Agregar Producto', array('class' => 'btn btn-sm btn-secondary')); ?>

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
                            <?php
                                $simbol = Config::find(5)->val;
                            ?>
                        <div class="clearfix"></div> 
                        <div class="table-responsive">
                            <table id="data-table" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                    <th>Codigo</th>
                                    <th>Nombre</th>
                                    <th>Precio Salida</th>
                                    <th>Categoria</th>
                                    <th>Disponible</th>
                                    <th>Total <?php echo e($simbol); ?></th>
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
                                    <td><?php echo e($simbol); ?> <?php echo e(number_format($product->price_out,2,'.',',')); ?></td>
                                    <td><?php if($product->category_id != null){echo $product->category->name;}else{ echo "<center>----</center>"; }  ?> 
                                    </td>
                                    <td><?php echo e($q); ?></td>
                                    <td>  
                                        <?php
                                            $total = 0;   
                                                $total += $q*$product->price_out;               
                                        ?>
                                        <b><?php echo e($simbol); ?> <?php echo e(number_format($total,2,".",",")); ?></b>
                                    </td>
                                    <td style="width:70px;">
                                        <?php echo HTML::icon_link(URL::to(route('inventario.history', $product->id)), 'fa fa-history fa-fw','', array('class' => 'btn btn-xs btn-info', 'data-toggle' => 'tooltip', 'title' => 'Historial de producto')); ?>

                                        
                                    </td>
                                </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </table>
                        </div>
                    </div><!-- /.box-body -->
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('footer_scripts'); ?>
<!-- Scripts Extras -->
<?php echo $__env->make('scripts.datatables', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>