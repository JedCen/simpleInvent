<?php $__env->startSection('htmlheader_title'); ?> Abastecimientos
<?php $__env->stopSection(); ?>

<?php $__env->startSection('contentheader_title'); ?>
<i class="fa fa-history"></i> Abastecimientos
<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumbs'); ?>
    <?php echo e(Breadcrumbs::render('reabastecer')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('template_linked_css'); ?>
  <!-- Css Extras -->
  <link rel="stylesheet" href="<?php echo e(asset('plugins/datatables/jquery.dataTables.min.css')); ?>">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="card panel-info <?php if (Auth::check() && Auth::user()->hasRole('admin', true)): ?> panel-info  <?php endif; ?>">
    <div class="card-header">
            Bienvenido <?php echo e(Auth::user()->name); ?> 
        <div class="float-right">
        <?php if (Auth::check() && Auth::user()->hasRole('admin', true)): ?>
            <span class="label label-secondary">
                Admin Access
                </span> <?php else: ?>
            <span class="label label-warning">
                User Access
                </span> <?php endif; ?>
        </div>
    </div>
    <div class="card-body">
        <?php if(count($products) > 0): ?>
        <?php
            $simbol = Config::find(5)->val;
        ?>
        <?php if(session()->has('message')): ?>
            <div class="alert alert-success" role="alert">
                <?php echo e(session()->get('message')); ?>

                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        <?php endif; ?>
        <br>
        <div class="table-responsive">
        <table id="data-table" class="table table-bordered table-hover">
            <thead>
                <th></th>
                <th>Producto</th>
                <th>Total</th>
                <th>Fecha</th>
                <th></th>
            </thead>
            <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sell): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td style="width:30px;"><a href="<?php echo e(route('inventario.show', $sell->id)); ?>" class="btn btn-sm btn-info"><i class="fa fa-eye"></i></a>
                </td>
                <td>
                    <?php
                        $operations = Operation::getAllProductsBySellId($sell->id);
                    ?>
                    <?php echo e(count($operations)); ?>

                </td>
                <td>
                    <?php
                        $total=0;
                        foreach($operations as $operation){
                            $product  = $operation->getProduct();
                            $total += $operation->q*$product->price_in;
                        }
                    ?>
                    <b> <?php echo e($simbol); ?> <?php echo e(number_format($total, 2)); ?> </b>
                </td>
                <td>
                    <?php echo e($sell->created_at); ?>

                </td>
                <td style="width:30px;">
                    <?php if (Auth::check() && Auth::user()->hasRole('admin')): ?> 
                        <?php echo Form::model($sell, array('action' => array('Invent\InventarioController@destroy', $sell->id), 'method' => 'DELETE', 'class' => 'form-inline', 'data-toggle' => 'tooltip', 'title' => 'Eliminar compra permanente')); ?>

                            <?php echo Form::hidden('_method', 'DELETE'); ?>

                            <?php echo Form::button('<i class="fas fa-eraser fa-fw" aria-hidden="true"></i> Eliminar', array('class' => 'btn btn-danger btn-sm','type' => 'button', 'style' =>'width: 100%;' ,'data-toggle' => 'modal', 'data-target' => '#confirmDelete', 'data-title' => 'Eliminar Compra Permanente', 'data-message' => 'Esta seguro de eliminar esta compra?')); ?>

                        <?php echo Form::close(); ?>

                    <?php endif; ?>
                </td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </table>
        </div>
        <?php else: ?>
        <div class="jumbotron">
            <h2>No hay datos</h2>
            <p>No se ha realizado ninguna operacion.</p>
        </div>
        <?php endif; ?>
    </div>
</div>
<?php echo $__env->make('modals.modal-delete', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('footer_scripts'); ?>

  <?php echo $__env->make('scripts.delete-modal-script', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
  <?php echo $__env->make('scripts.tooltips', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
  <?php echo $__env->make('scripts.datatables', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>