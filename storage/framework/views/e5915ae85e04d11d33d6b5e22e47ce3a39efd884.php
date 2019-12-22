<?php $__env->startSection('htmlheader_title'); ?>
Productos
<?php $__env->stopSection(); ?>

<?php $__env->startSection('contentheader_title'); ?>
<i class='fab fa-product-hunt'></i> Lista de productos
<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumbs'); ?>
<?php echo e(Breadcrumbs::render('producto')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('template_linked_css'); ?>
<!-- DataTables -->
<link rel="stylesheet" href="<?php echo e(asset('plugins/datatables/jquery.dataTables.min.css')); ?>">
<?php $__env->stopSection(); ?>


<?php $__env->startSection('content'); ?>
<div class="container-fluid spark-screen">
    <?php
    $configSimbMon = Config::find(5)->val;
    ?>
    <div class="row">

        <div class="col-md-12 col-md">
            <div class="card panel-info">
                <div class="card-header">
                    <div class="float-left">
                        <i class='fab fa-product-hunt'></i> Productos
                    </div>
                    <div class="float-right">
                        <div class="btn-group" role="group" aria-label="Button group with nested dropdown">
                            <?php echo HTML::icon_link(URL::to(route('producto.create')), 'fa fa-plus-circle', ' Agregar
                            Producto', array('class' => 'btn btn-sm btn-secondary')); ?>


                            <button id="btnGroupDrop1" type="button" class="btn btn-sm btn-secondary dropdown-toggle"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Descargar
                            </button>
                            <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                                <a class="dropdown-item" href="<?php echo e(route('producto.pdf')); ?>">Descargar PDF</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <?php if(session()->has('info')): ?>
                    <div class="alert alert-success" role="alert">
                        <?php echo e(session()->get('info')); ?>

                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <?php endif; ?>
                    <div class="table-responsive">
                        <table id="data-table" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Codigo</th>
                                    <th>Imagen</th>
                                    <th>Nombre</th>
                                    <th>Precio Entrada</th>
                                    <th>Precio Salida</th>
                                    <th>Categoria</th>
                                    <th>Minima</th>
                                    <th>Activo</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($product->barcode); ?></td>
                                <td>
                                    <?php if($product->image!=""): ?>
                                    <img src="<?php echo e($product->image); ?>" style="width:64px;">
                                    <?php endif; ?>
                                </td>
                                <td><?php echo e($product->name); ?></td>
                                <td><?php echo e($configSimbMon); ?> <?php echo e(number_format($product->price_in,2,'.',',')); ?></td>
                                <td><?php echo e($configSimbMon); ?> <?php echo e(number_format($product->price_out,2,'.',',')); ?></td>
                                <td><?php if($product->category_id!=null){echo $product->category->name;}else{ echo "<center>----</center>"; }  ?>
                                </td>
                                <td><?php echo e($product->inventary_min); ?></td>
                                <td><?php if($product->is_active == 1): ?><i class="fa fa-check"></i><?php endif;?></td>
                                <td>
                                    <div class="input-group">
                                        <?php echo HTML::icon_link(URL::to(route('producto.edit', $product->id)), 'fas
                                        fa-edit','', array('class' => 'btn btn-info btn-sm mr-3', 'data-toggle' =>
                                        'tooltip',
                                        'title' => 'Editar producto')); ?>


                                        <?php if (Auth::check() && Auth::user()->hasRole('admin')): ?>
                                        <?php echo Form::model($product, array('action' => array('ProductoController@destroy',
                                        $product->id), 'method' => 'DELETE', 'data-toggle' => 'tooltip', 'title' =>
                                        'Eliminar producto permanete')); ?>

                                        <?php echo Form::hidden('_method', 'DELETE'); ?>


                                        <?php echo Form::button('<i class="fa fa-trash fa-fw" aria-hidden="true"></i>',
                                        array('class' => 'btn btn-danger btn-sm','type' => 'button' ,'data-toggle' =>
                                        'modal', 'data-target' => '#confirmDelete', 'data-title' => 'Eliminar Producto
                                        Permanente', 'data-message' => 'Esta seguro de eliminar el producto '
                                        .$product->name.'?')); ?>


                                        <?php echo Form::close(); ?>

                                        <?php endif; ?>
                                    </div>
                                </td>
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php echo $__env->make('modals.modal-delete', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php $__env->stopSection(); ?>

    <?php $__env->startSection('footer_scripts'); ?>
    <!-- Scripts Extras -->
    <?php echo $__env->make('scripts.delete-modal-script', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php echo $__env->make('scripts.tooltips', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php echo $__env->make('scripts.datatables', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>