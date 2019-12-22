<?php $__env->startSection('htmlheader_title'); ?>
    Lista ventas
<?php $__env->stopSection(); ?>
<?php $__env->startSection('template_linked_css'); ?>
  <!-- DataTables -->
  <link rel="stylesheet" href="<?php echo e(asset('plugins/datatables/jquery.dataTables.min.css')); ?>">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('contentheader_title'); ?>
    <i class='glyphicon glyphicon-shopping-cart'></i> Lista de Ventas
<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumbs'); ?>
    <?php echo e(Breadcrumbs::render('sells')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="container-fluid spark-screen">
    <div class="row">
            <div class="col-md-12">
                    <div class="clearfix"></div>
            <?php if(count($products)>0): ?>
            <?php
                $simbol =Config::find(5)->val;
            ?>
            <br>
            <div class="card panel-info <?php if (Auth::check() && Auth::user()->hasRole('admin', true)): ?> panel-success  <?php endif; ?>">
                <div class="card-header with-border">
                    <div class="float-left">
                        <i class="fa fa-shopping-cart" aria-hidden="true"></i> Ventas
                    </div>
                </div>
            <div class="card-body">
            <div class="table-responsive">
            <table id="data-table" class="table table-striped">
                <thead>
                    <th>Productos</th>
                    <th>Total</th>
                    <th>Fecha</th>
                    <th></th>
                </thead>
                <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sell): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php
                        $operations = Operation::getAllProductsBySellId($sell->id);
                        $total= $sell->total-$sell->discount;
                    ?>
                    <tr>
                        <td>
                            <?php echo e(count($operations)); ?>

                        <td>  
                            <b><?php echo e($simbol); ?> <?php echo e(number_format($total)); ?> </b>         
                        </td>
                        <td>
                            <?php echo e($sell->created_at); ?>

                        </td>
                        <td>
                        <div class="input-group">
                            <?php echo HTML::icon_link(URL::to('/sells/detail/'.$sell->id), 'far fa-eye fa-fw', 'VER', array('class' => 'btn btn-sm btn-info')); ?>

                            <?php if (Auth::check() && Auth::user()->hasRole('admin')): ?> 
                            <?php echo Form::model($sell, array('action' => array('VentaController@destroy', $sell->id), 'method' => 'DELETE', 'data-toggle' => 'tooltip', 'title' => 'Eliminar venta permanete')); ?>

                                <?php echo Form::hidden('_method', 'DELETE'); ?>

                                <?php echo Form::button('<i class="fas fa-eraser fa-fw" aria-hidden="true"></i> Eliminar', array('class' => 'btn btn-sm btn-danger','type' => 'button', 'data-toggle' => 'modal', 'data-target' => '#confirmDelete', 'data-title' => 'Eliminar Venta Permanente', 'data-message' => 'Esta seguro de eliminar esta venta?')); ?>

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
            <div class="clearfix"></div>
        <?php else: ?>    
                <div class="jumbotron">
                    <h2>No hay ventas</h2>
                    <p>No se ha realizado ninguna venta.</p>
                </div>   
        <?php endif; ?>
        </div>
    </div>
</div>
<?php echo $__env->make('modals.modal-delete', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('footer_scripts'); ?>

  <?php echo $__env->make('scripts.delete-modal-script', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
  <?php echo $__env->make('scripts.tooltips', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
  <!-- DataTables -->
  <?php echo $__env->make('scripts.datatables', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>