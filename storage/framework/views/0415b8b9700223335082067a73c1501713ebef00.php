<?php $__env->startSection('htmlheader_title'); ?>
    Reportes
<?php $__env->stopSection(); ?>

<?php $__env->startSection('contentheader_title'); ?>
    <i class="fas fa-chart-line"></i> Reporte por categoría
<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumbs'); ?>
    <?php echo e(Breadcrumbs::render('rep_categoria')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('template_linked_css'); ?>
  <!-- Css Extras -->
  <link rel="stylesheet" href="<?php echo e(asset('plugins/datatables/jquery.dataTables.min.css')); ?>">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="container-fluid spark-screen">
        <div class="row">
            <div class="col-md-12 col-md">
                <div class="card card-info card-outline">
                    <div class="card-body" style="display: block;">
                        <div class="well">
                            <h5>Ingrese los datos:</h5>
                            <?php echo Form::open(['route' => 'getsells.category', 'method' => 'GET']); ?>

                                <div class="row">
                                        <div class="input-group col-sm-5">
                                            <div class="input-group-prepend">
                                                <?php echo e(Form::label('categoria', 'Categroía',['class' => 'input-group-text'])); ?>

                                            </div>
                                            <?php echo e(Form::select('categoria', $category2, Request::input('categoria'), ['class' => 'custom-select'])); ?>

                                        </div>
                                    <div class="input-group col-sm-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-calendar-minus"></i></span>
                                        </div>
                                        <input class="form-control" name="ini" value="<?php echo e(Request::input('ini')); ?>" type="date" required>
                                    </div>
                                    <div class="input-group col-sm-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-calendar-plus"></i></span>
                                        </div>
                                        <input class="form-control"  name="fin" value="<?php echo e(Request::input('fin')); ?>" type="date" required>
                                    </div>
                                    <div class="col-ms-1">
                                        <button type="submit" class="btn btn-block btn-primary"> <i class="fas fa-file-invoice"></i> </button>
                                    </div>
                                </div>
                                <?php echo Form::close(); ?>

                        </div>
                    </div>
                </div>
            </div>
            <?php if(Request::has('categoria')): ?>
            <div class="col-md-12 col-md">
                <div class="card panel-info">
                    <div class="card-header">
                        <div class="float-left">
                                <i class='fab fa-product-hunt'></i> Reporte por categoría
                        </div>
                        <div class="float-right">
                            <div class="btn-group" role="group" aria-label="Button group with nested dropdown">
                                <div class="btn-group" role="group">
                                <a class="btn btn-sm btn-secondary" href="<?php echo e(Route('sells.category')); ?>">
                                    Nueva consulta
                                </a>                                
                                </div>
                            </div>
                        </div>
                    </div> <!-- /.box-header -->
                    <div class="card-body">
                        <?php
                            $products = Product::Where('category_id', Request::input('categoria'))->get();
                            $configSimbMon =Config::find(5)->val;
                        ?>
                        <?php if($products->count()>0): ?>
                        <div class="table-responsive">
                        <table id="data-table" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Producto</th>
                                    <th>Entradas</th>
                                    <th><?php echo e($configSimbMon); ?> Entradas</th>
                                    <th>Salidas</th>
                                    <th><?php echo e($configSimbMon); ?> Salidas</th>
                                    <th>E-S</th>
                                    <th><?php echo e($configSimbMon); ?> E-S</th>
                                </tr>
                            </thead>
                            <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php
                                $operations = Operation::where('created_at', '>=', date('Y-m-d', strtotime(Request::input('ini'))))
                                        ->where('created_at', '<=', carbon\Carbon::parse(Request::input('fin'))->addDays(1))
                                        ->get();
                                    $input = 0;
                                    $output = 0;
                                    foreach($operations as $operation){
                                        if($operation->operation_type_id==1&& $operation->product_id==$product->id)
                                            { $input+=$operation->q; }
                                        else if($operation->operation_type_id==2&& $operation->product_id==$product->id)
                                            { $output+=$operation->q; }
                                    }
                                ?> 
                            <tr>
                                <td> <?php echo e($product->id); ?></td>
                                <td> <?php echo e($product->name); ?></td>
                                <td> <?php echo e($input); ?> </td>
                                <td> <?php echo e($configSimbMon); ?> <?php echo e($product->price_in*$input); ?></td>
                                <td> <?php echo e($output); ?> </td>
                                <th> <?php echo e($configSimbMon); ?> <?php echo e($product->price_out*$output); ?> </th>
                                <td><?php echo e($input-$output); ?></td>
                                <td> <?php echo e($configSimbMon); ?> <?php echo e(($product->price_in*$input)-($product->price_out*$output)); ?></td>
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </table> 
                        </div>
                        <?php else: ?>
                            <div class="jumbotron">
                                <h2>No hay operaciones</h2>
                                <p>El rango de fechas seleccionado no proporciono ningun resultado de operaciones.</p>
                            </div
                        <?php endif; ?> 
                    </div><!-- /.box-body -->
                </div>
            </div>
            
            <?php endif; ?>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('footer_scripts'); ?>
<!-- Scripts Extras -->
<?php echo $__env->make('scripts.datatables', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>