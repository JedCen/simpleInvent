<?php $__env->startSection('htmlheader_title'); ?> Producto
<?php $__env->stopSection(); ?>

<?php $__env->startSection('contentheader_title'); ?> Nuevo producto
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
                            <h4><i class='fab fa-product-hunt'></i> Nuevo producto</h4>
                    </div>
                    <div class="float-right">
                        <a class="btn btn-adn" href="<?php echo e(route('producto.index')); ?>">Cancelar</a>
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
                        <?php echo Form::open(['route' => 'producto.store', 'files' => true, 'enctype' => 'multipart/form-data', 'id'=>'uploadForm']); ?>

                            
                            <?php echo $__env->make('inventario.producto.partials.form', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?> 
                            <div class="form-group">
                                <?php echo e(Form::label('q', 'Cantidad actual de producto')); ?> <?php echo e(Form::number('q', null, ['class' => 'form-control col-md-6', 'id' => 'q',
                                'placeholder' => 'Cantidad actual de producto'])); ?>

                                <small class="form-text text-danger"> <?php echo e($errors->first('q')); ?></small>
                            </div>
                            <div class="form-group">
                                <?php echo e(Form::submit('Agregar Producto', ['class' => 'btn btn-sm btn-primary'])); ?>

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
    <script>
    function readURL(input) {

    if (input.files && input.files[0]) {
    var reader = new FileReader();

    reader.onload = function(e) {
        $('#blah').attr('src', e.target.result);
    }

    reader.readAsDataURL(input.files[0]);
    }
    }

    $("#image").change(function() {
    readURL(this);
    });
    </script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>