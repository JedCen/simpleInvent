<?php $__env->startSection('htmlheader_title'); ?>
    about
<?php $__env->stopSection(); ?>

<?php $__env->startSection('contentheader_title'); ?>
    Editar Producto
<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumbs_info'); ?>
  
<?php $__env->stopSection(); ?>

<?php $__env->startSection('template_linked_css'); ?>
  <!-- Css Extras -->
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="container-fluid spark-screen">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                
                <div class="card panel-info">
                    <div class="card-header">
                        <div class="float-left">
                                <h4><i class='fa fa-edit'></i> Editar producto</h4>
                        </div>
                        <div class="float-right">
                                <a class="btn btn-adn" href="<?php echo e(URL::previous()); ?>">Cancelar</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <?php if(session('info')): ?>
                            <div class="container">
                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="alert alert-success">
                                            <?php echo e(session('info')); ?>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>
                        <?php if(count($errors)): ?>
                            <div class="container">
                                <div class="row">
                                    <div class="col-md-8 ">
                                        <div class="alert alert-warning">
                                            <p>Corrige los siguientes errores:</p>
                                            <ul>
                                                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <li><?php echo e($error); ?></li>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>
                        <div id="avatar_container">
                            <div class="card-body">
                                <div class="dz-preview"></div>
                                <?php echo Form::open(array('route' => ['producto.upload', $products->id], 'method' => 'POST', 'name' => 'avatarDropzone','id' => 'avatarDropzone', 'class' => 'form single-dropzone dropzone single', 'files' => true, 'enctype' => 'multipart/form-data')); ?>

                                    <img id="user_selected_product" class="user-avatar" src="<?php if($products->image != NULL): ?> <?php echo e($products->image); ?> <?php endif; ?>" alt="<?php echo e($products->name); ?>">
                                <?php echo Form::close(); ?> 
                            </div>
                        </div>
                                <?php echo Form::model($products, ['route' => ['producto.update', $products->id], 'method' => 'PUT', 'files' => 'true', 'enctype' => 'multipart/form-data']); ?>

                                    <?php echo $__env->make('inventario.producto.partials.form', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                                    <div class="form-group">
                                        <?php echo e(Form::submit('Actualizar producto', ['class' => 'btn btn-sm btn-primary'])); ?>

                                    </div>
                                <?php echo Form::close(); ?>  
                    </div>
                    <!-- /.box-body -->
                </div>

            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('footer_scripts'); ?>
<!-- Scripts Extras -->
<?php echo $__env->make('scripts.image_product_dz', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>