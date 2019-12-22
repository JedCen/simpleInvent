<?php $__env->startSection('htmlheader_title'); ?>
    Inventario
<?php $__env->stopSection(); ?>

<?php $__env->startSection('contentheader_title'); ?>
    <i class='fa fa-history'></i> historial producto
<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumbs'); ?>
    <?php echo e(Breadcrumbs::render('history', $product->name)); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('template_linked_css'); ?>
  <!-- Css Extras -->
 
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
	<div class="container-fluid spark-screen">
        <?php if($operations->count()>0 && $product->count()>0): ?>
        <div class="row">
            
            <div class="col-md-4 col-sm-6 col-12">
                <div class="info-box">
                    <span class="info-box-icon bg-info"><i class="fa fa-hand-holding-usd"></i></span>
                    <?php
                        $total_e=0;
                        $total_s=0;
                        $total_entrada= 0;
                        $total_salida= 0;
                        foreach($operentrada as $item){
                            $product  = $item->getProduct();
                            $total_e += $item->q;
                        }
                            $total_entrada += $total_e;

                        foreach($opersalida as $item){
                            $product  = $item->getProduct();
                            $total_s += $item->q;
                        }
                            $total_salida += $total_s;


                    ?>
                    <div class="info-box-content">
                    <span class="info-box-text">Entrada</span>
                    <span class="info-box-number"> <?php echo e($total_entrada); ?> </span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
                  <!-- /.col -->
            <div class="col-md-4 col-sm-6 col-12">
                <div class="info-box">
                    <span class="info-box-icon bg-success"><i class="fa fa-cube"></i></span>

                    <div class="info-box-content">
                    <span class="info-box-text">Disponible</span>
                    <span class="info-box-number"> <?php echo e($total_entrada - $total_salida); ?> </span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
                  <!-- /.col -->
            <div class="col-md-4 col-sm-6 col-12">
                <div class="info-box">
                    <span class="info-box-icon bg-warning"><i class="fa fa-shopping-cart"></i></span>

                    <div class="info-box-content">
                    <span class="info-box-text">Salida</span>
                    <span class="info-box-number"> <?php echo e($total_salida); ?> </span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
                  <!-- /.col -->
        </div>   
		<div class="row">
			<div class="col-md-12">
                
				<div class="card panel-info">
                    <div class="card-header">
                        <div class="float-left">
                            <h5 class="card-title"><i class='fab fa-product-hunt'></i>roducto: <?php echo e($product->name); ?> </h5>
                        </div>
                        <div class="float-right">
                            <?php echo HTML::icon_link(URL::to(route('inventario.index')), 'fa fa-history', ' Regresar', array('class' => 'btn btn-sm btn-secondary')); ?>

                        </div>
                    </div>

                    <!-- /.card-header -->
                    <div class="card-body">
                        <table class="table table-bordered table-hover">
                            <thead>
                                <th></th>
                                <th>Cantidad</th>
                                <th>Tipo</th>
                                <th>Fecha</th>
                                <th></th>
                            </thead>
                            <?php $__currentLoopData = $operations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $operation): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td></td>
                                <td><?php echo e($operation->q); ?></td>
                                <td><?php echo e($operation->operation_type->name); ?></td>
                                <td><?php echo e($operation->created_at); ?></td>
                                <td style="width:40px;"><a href="#" id="oper-<?php echo $operation->id; ?>" class="btn tip btn-sm btn-danger" title="Eliminar"><i class="fa fa-trash"></i></a> </td>
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>

			</div>
        </div>
        <?php else: ?>
        <div class="col-md-8">
            <div class="card panel-danger">
                <div class="card-header">Error!!
                        <div class="float-right">
                            <a class="btn btn-sm btn-info" href="<?php echo e(Route('inventario.index')); ?>"> <i class="fas fa-undo "></i> Regresar</a>
                        </div>
                </div>
                <div class="card-body">
                    <div class="jumbotron">
                        <h5 class="card-title">Ingreso dato incorrecto</h5>
                        <p class="card-text">Verificar que los datos sean correctos, o reportar algún inconveniente</p>
                    </div>
                </div>
            </div>
        </div>
        <?php endif; ?>
	</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('footer_scripts'); ?>
<!-- Scripts Extras -->
    
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>