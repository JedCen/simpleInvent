 
<?php $__env->startSection('htmlheader_title'); ?> Configuracion
<?php $__env->stopSection(); ?>
 
<?php $__env->startSection('contentheader_title'); ?>
<i class="fas fa-cogs"></i> Actualizar información
<?php $__env->stopSection(); ?>
 
<?php $__env->startSection('template_linked_css'); ?>
<!-- Css Extras -->

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="container-fluid spark-screen">
    <div class="row">
        <div class="col-md-12 col-md">
            <div class="card card-info card-outline">

                <div class="card-body" style="display: block;">
                    <h3>Ajustes</h3>
                    <p>Actualizar los datos de su empresa</p>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4 col-md">
            <div class="card card-info">
                <div class="card-header">
                    <div class="float-left">
                        <i class='fas fa-camera'></i> Logo de la empresa
                    </div>
                </div>
                <!-- /.box-header -->
                <div id="avatar_container">
                    <div class="card-body">
                            <div class="dz-preview"></div>
                            <?php echo Form::open(array('route' => ['config.upload', $configs->find(6)->id], 'method' => 'POST', 'name' => 'avatarDropzone','id' => 'avatarDropzone', 'class' => 'form single-dropzone dropzone single', 'files' => true, 'enctype' => 'multipart/form-data')); ?>

                                <img id="user_selected_config" class="user-avatar" src="<?php if($configs->find(6)->val != NULL): ?> <?php echo e($configs->find(6)->val); ?> <?php endif; ?>" alt="<?php echo e($configs->find(6)->name); ?>">
                            <?php echo Form::close(); ?> 
                    </div>
                </div>
                <!-- /.box-body -->
            </div>
        </div>
        <div class="col-md-8 col-md">
            <div class="card card-info card-outline">
                <div class="card-body">
                <form class="needs-validation" method="POST" novalidate action="<?php echo e(route('config.update')); ?>">
                    <?php echo csrf_field(); ?>
                        <h4>Datos Generales:</h4>
                        <div class="form-row">
                            <div class="col-md-5 mb-3">
                                <label for="validationCustom01">Nombre de la empresa</label>
                                <input type="text" class="form-control" id="validationCustom01" placeholder="Nombre de la empresa" required
                                name="<?php echo e($configs->find(1)->short); ?>" value="<?php echo e($configs->find(1)->val); ?>">
                                <div class="invalid-feedback">
                                    Agregar nombre de la empresa
                                </div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="validationCustom02">Telefono</label>
                                <input type="text" class="form-control" id="validationCustom02" placeholder="# Tel." required
                                name="<?php echo e($configs->find(2)->short); ?>" value="<?php echo e($configs->find(2)->val); ?>">
                                <div class="invalid-feedback">
                                    Agregar # telefono
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-3 mb-3">
                                <label for="validationCustom03">Nombre del impuesto</label>
                                <input type="text" class="form-control" id="validationCustom03" placeholder="IVA" required
                                name="<?php echo e($configs->find(3)->short); ?>" value="<?php echo e($configs->find(3)->val); ?>">
                                <div class="invalid-feedback">
                                    Nombre impuesto, ejem: IVA.
                                </div>
                            </div>
                            <div class="col-md-3 mb-3">
                                <label for="validationCustom04">Valor impuesto</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroupPrepend01">%</span>
                                    </div>
                                    <input type="text" class="form-control" id="validationCustom04" placeholder="16" aria-describedby="inputGroupPrepend01" required
                                    name="<?php echo e($configs->find(4)->short); ?>" value="<?php echo e($configs->find(4)->val); ?>">
                                    <div class="invalid-feedback">
                                        Valor de impuesto.
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="validationCustom05">Moneda</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroupPrepend02">Simb.</span>
                                    </div>
                                    <input type="text" class="form-control" id="validationCustom05" placeholder="$" aria-describedby="inputGroupPrepend02" required
                                    name="<?php echo e($configs->find(5)->short); ?>" value="<?php echo e($configs->find(5)->val); ?>">
                                    <div class="invalid-feedback">
                                        Simbolo de la moneda.
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <button class="btn btn-primary" type="submit">Actualizar datos</button>
                    </form>

                </div>
                <!-- /.box-body -->
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
 
<?php $__env->startSection('footer_scripts'); ?>
<!-- Scripts Extras -->
    <?php echo $__env->make('scripts.image_config_dz', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>

    <script>
        // Example starter JavaScript for disabling form submissions if there are invalid fields
    (function() {
        'use strict';
        window.addEventListener('load', function() {
        // Fetch all the forms we want to apply custom Bootstrap validation styles to
        var forms = document.getElementsByClassName('needs-validation');
        // Loop over them and prevent submission
        var validation = Array.prototype.filter.call(forms, function(form) {
            form.addEventListener('submit', function(event) {
            if (form.checkValidity() === false) {
                event.preventDefault();
                event.stopPropagation();
            }
            form.classList.add('was-validated');
            }, false);
        });
        }, false);
    })();

    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>