<?php $__env->startSection('htmlheader_title'); ?>
    Caja
<?php $__env->stopSection(); ?>

<?php $__env->startSection('contentheader_title'); ?>
<i class="fa fa-archive"></i> Historial de caja 
<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumbs'); ?>
    <?php echo e(Breadcrumbs::render('historial')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('template_linked_css'); ?>
  <!-- Css Extras -->
 
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
	<div class="container-fluid spark-screen">
		<div class="row">
            <?php if($boxes->count()>0): ?>
            <?php
                $total_total = 0;
                $configSimbMon =Config::find(5)->val;
            ?> 
			<div class="col-md-9">

				<div class="card panel-info">
                    <div class="card-header">
                        <div class="float-left">
                            <h5 class="card-title"><i class='fas fa-boxes'></i> Lista corte de caja </h5>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-sm btn-adn" href="<?php echo e(Route('caja.index')); ?>"> <i class="fas fa-undo "></i> Regresar</a>
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
                                <?php $__currentLoopData = $boxes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $box): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td style="width:30px;">
                                        <?php echo HTML::icon_link(URL::to('caja/historial/'.$box->id), 'fa fa-arrow-right','', array('class' => 'btn btn-sm btn-info')); ?>			
                                    </td>
                                    <td>
                                        <?php
                                        $total=0;
                                        foreach($sells->where('box_id', $box->id) as $sell){
                                            $operations = Operation::getAllProductsBySellId($sell->id);
                                            $total += $sell->total-$sell->discount;
                                        }
                                            $total_total += $total;
                                        ?>
                                        <?php echo e($configSimbMon); ?> <?php echo e(number_format($total,2,".",",")); ?>

                                    </td>
                                    <td> <?php echo e($box->created_at); ?> </td>
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
                                <span class="info-box-text">Total caja</span>
                                <span class="info-box-number"><?php echo e($configSimbMon); ?> <?php echo e(number_format($total_total,2,".",",")); ?></span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
            <?php else: ?>
            xd
        

            <?php endif; ?>
		</div>
	</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('footer_scripts'); ?>
<!-- Scripts Extras -->
    
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>