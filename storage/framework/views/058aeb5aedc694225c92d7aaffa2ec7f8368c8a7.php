<?php $__env->startSection('htmlheader_title'); ?>
    Caja
<?php $__env->stopSection(); ?>

<?php $__env->startSection('contentheader_title'); ?>
    <i class='fa fa-archive'></i> Caja
<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumbs'); ?>
    <?php echo e(Breadcrumbs::render('caja')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('template_linked_css'); ?>
  <!-- DataTables -->
  <link rel="stylesheet" href="<?php echo e(asset('plugins/datatables/jquery.dataTables.min.css')); ?>">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="container-fluid spark-screen">
        <div class="row">
            <div class="col-md-12 col-md">

              <div class="card panel-info <?php if (Auth::check() && Auth::user()->hasRole('admin', true)): ?> panel-success  <?php endif; ?>">
                    <div class="card-header">
                        <div class="float-left">
                            <i class='fa fa-archive'></i> Caja
                        </div>
                        <div class="float-right">
                            <div class="btn-group">
                                <?php if (Auth::check() && Auth::user()->hasRole('admin')): ?>
                                    <a href="<?php echo e(route('caja.history')); ?>" class="btn btn-sm btn-secondary "><i class="fa fa-clock"></i> Historial</a>
                                <?php endif; ?>
                                <?php if($sells->count()>0): ?>
                                    <?php echo Form::open(array('route' => 'caja.process', 'method' => 'PUT')); ?>

                                        <?php echo Form::button('<i class="fa fa-box"></i> Corte caja', array('class' => 'btn btn-sm btn-secondary','type' => 'button', 'data-toggle' => 'modal', 'data-target' => '#confirmSave', 'data-title' => 'Corte de caja', 'data-message' => 'Esta seguro de realizar el corte de caja?')); ?>

                                    <?php echo Form::close(); ?> 
                                <?php endif; ?>
                            </div>
                        </div>
                        <!-- /.box-tools -->
                    </div>
                    <!-- /.box-header -->
                    <div class="card-body">
                        
                        <div class="clearfix"></div>   
                            
                            <?php if($sells->count()>0): ?>
                            <?php
                                $configSimbMon =Config::find(5)->val;
                            ?>
                            <?php $total_total = 0; ?>
                            
                            <br>
                            <div class="table-responsive">
                            <table id="data-table" class="table table-hover">
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
                                             <b><?php echo e($configSimbMon); ?> <?php echo e(number_format($total,2,".",",")); ?></b>
                                    </td>
                                    <td>
                                        <?php echo e($sell->created_at); ?>

                                    </td>
                                </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                            </table>
                            </div>
                            <hr>
                            <h3>Total: <?php echo e($configSimbMon); ?> <?php echo e(number_format($total_total,2,".",",")); ?></h3>
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
    <?php echo $__env->make('modals.modal-save', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('footer_scripts'); ?>
<!-- Scripts Extras -->
    <?php echo $__env->make('scripts.save-modal-script', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php echo $__env->make('scripts.datatables', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>