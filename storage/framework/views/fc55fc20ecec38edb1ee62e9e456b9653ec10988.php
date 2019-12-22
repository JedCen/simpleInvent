<?php $__env->startSection('htmlheader_title'); ?>
    Caja
<?php $__env->stopSection(); ?>

<?php $__env->startSection('contentheader_title'); ?>
<i class="fa fa-archive"></i> Historial de caja
<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumbs'); ?>
    <?php echo e(Breadcrumbs::render('historyone', $id)); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('template_linked_css'); ?>
  <!-- Css Extras -->
 
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
	<div class="container-fluid spark-screen">
		<div class="row">
            <?php if($sells->count()>0): ?>
            <?php
                $total_total = 0;
                $configSimbMon =Config::find(5)->val;
            ?>
			<div class="col-md-9">

				<div class="card panel-info">
                    <div class="card-header">
                        <div class="float-left">
                            <h5 class="card-title"><i class='fas fa-boxes'></i> Ventas corte de caja # <?php echo e(str_pad ($id, 4, '0', STR_PAD_LEFT)); ?></h5>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-sm btn-adn" href="<?php echo e(Route('caja.history')); ?>"> <i class="fas fa-undo "></i> Regresar</a>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">  
                            <table class="table table-bordered table-hover	">
                                <thead>
                                    <th></th>
                                    <th>Total</th>
                                    <th>Fecha</th>
                                </thead>
                                <?php $__currentLoopData = $sells; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sell): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td style="width:30px;">
                                            <?php echo HTML::icon_link(URL::to('/sells/detail/'.$sell->id), 'far fa-eye fa-fw', 'VER', array('class' => 'btn btn-sm btn-info')); ?>			
                                    </td>
                                    <td>
                                        <?php
                                            $total_total += $sell->total-$sell->discount;
                                        ?>
                                          <?php echo e($configSimbMon); ?>  <?php echo e(number_format( $sell->total-$sell->discount ,2,".",",")); ?>

                                       
                                    </td>
                                    <td> <?php echo e($sell->created_at); ?> </td>
                                </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </table>
                    </div>
                    <!-- /.card-body -->
                </div>

            </div>
            <div class="col-md-3">
                <div class="card panel-info">
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="info-box">
                            <span class="info-box-icon bg-info"><i class="fas fa-file-invoice-dollar"></i></span>
            
                            <div class="info-box-content">
                            <span class="info-box-text">Total corte #<?php echo e($id); ?></span>
                                <span class="info-box-number"><?php echo e($configSimbMon); ?> <?php echo e(number_format($total_total,2,".",",")); ?></span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
            <?php else: ?>
            <div class="col-md-8">
                <div class="card panel-danger">
                    <div class="card-header">Error!!
                            <div class="float-right">
                                <a class="btn btn-sm btn-info" href="<?php echo e(Route('caja.history')); ?>"> <i class="fas fa-undo "></i> Regresar</a>
                            </div>
                    </div>
                    <div class="card-body">
                        <div class="jumbotron">
                            <h5 class="card-title">Ingreso un corte de caja incorrecto</h5>
                            <p class="card-text">Verificar que los datos ingresados sean correctos</p>
                        </div>
                    </div>
                </div>
            </div>
            <?php endif; ?>
		</div>
	</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('footer_scripts'); ?>
<!-- Scripts Extras -->
    
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>