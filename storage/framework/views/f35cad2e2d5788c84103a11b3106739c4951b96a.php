<?php $__env->startSection('htmlheader_title'); ?>
    Categorías
<?php $__env->stopSection(); ?>

<?php $__env->startSection('contentheader_title'); ?>
    <i class='fa fa-list'></i> Lista de Categorías
<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumbs'); ?>
    <?php echo e(Breadcrumbs::render('categoria')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('template_linked_css'); ?>
  <!-- Css Extras -->
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<div class="container-fluid spark-screen">
        <?php if(count($errors) > 0): ?>
            <div class="alert alert-danger" data-dismiss="alert" aria-label="Close">
                <strong>Whoops!</strong> <?php echo e(trans('message.someproblems')); ?><br><br>
                <ul>
                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li><?php echo e($error); ?></li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            </div>
        <?php endif; ?>
        <div class="row">
                <div class="col-sm-5">
                    <div class="card panel-default">
                            <div class="card-header">
                                <div class="float-left">
                                        <h4><i class='fa fa-list'></i> Categoría</h4>
                                </div>
                            </div>
                            <div class="card-body">
                            <?php echo Form::open(['route' => 'categorias.store']); ?>

                                <div class="form-group has-feedback" >
                                    <input type="text" class="form-control" placeholder="<?php echo e(trans('message.description')); ?>" name="name" autofocus/>
                                    <span class="glyphicon glyphicon-list form-control-feedback"></span>
                                    
                                </div>
                                <div class="pull-right">
                                    <button type="submit" class="btn btn-info">Agregar</button>
                               </div>
                               
                            <?php echo Form::close(); ?>

                        </div>
                    </div>
                </div>
                <div class="col-sm-7">
                    <div class="card panel-info">
                            <div class="card-header">
                                <div class="float-left">
                                        <h4><i class='fa fa-list'></i> Lista Categorías</h4>
                                </div>
                            </div>
                            <div class="card-body">
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                    <th>Codigo</th>
                                    <th>Nombre</th>
                                    <th></th>
                                    </tr>
                                </thead>
                                <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr class="item<?php echo e($category->id); ?>">
                                    <td style="width:10%;"><?php echo e($category->id); ?></td>
                                    <td style="width:60%;"><?php echo e($category->name); ?></td>
                                    <td>
                                    <div class="input-group">
                                        <button class="edit-modal btn btn-info btn-sm" data-toggle="modal" data-target="#editModal-<?php echo e($category->id); ?>">
                                        <span class="fa fa-edit"></span></button>

                                        <?php echo $__env->make('inventario.categoria.partials.modal', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>

                                        <?php if (Auth::check() && Auth::user()->hasRole('admin')): ?>
                                        <?php echo Form::model($category, array('action' => array('CategoriaController@destroy', $category->id), 'method' => 'DELETE', 'class' => 'form-inline')); ?>

                                            <?php echo Form::button('<i class="fa fa-trash fa-fw" aria-hidden="true"></i>', array('class' => 'btn btn-danger btn-sm','type' => 'submit')); ?>

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
                    <!-- /.box-body --> 
            </div>
</div>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('footer_scripts'); ?>
<!-- Scripts Extras -->
<script>
    <?php if(Session::has('message')): ?>
        var type = "<?php echo e(Session::get('alert-type', 'info')); ?>";
        switch(type){
            case 'info':
                toastr.info("<?php echo e(Session::get('message')); ?>", {timeOut: 5000});
                break;
            
            case 'warning':
                toastr.warning("<?php echo e(Session::get('message')); ?>", {timeOut: 5000});
                break;
            case 'success':
                toastr.success("<?php echo e(Session::get('message')); ?>", {timeOut: 5000});
                break;
            case 'error':
                toastr.error("<?php echo e(Session::get('message')); ?>", {timeOut: 5000});
                break;
        }
    <?php endif; ?>
</script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>