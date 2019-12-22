<?php echo e(Form::hidden('user_id', Auth::user()->id)); ?>


<?php if(request()->path() == request()->is('producto/create')): ?>
    
    <carga-imagen></carga-imagen>

<?php endif; ?>

<div class="form-group">
    <?php echo e(Form::label('barcode', 'Codigo de barra')); ?>

    <?php echo e(Form::text('barcode', null, ['class' => 'form-control', 'id' => 'barcode', 'aria-describedby' => 'passwordHelpBlock', 'placeholder' => 'Codigo de barra del producto'])); ?>

    <small id="passwordHelpBlock" class="form-text text-danger">
            <?php echo e($errors->first('barcode')); ?>

    </small>
</div>
<div class="form-group">
    <?php echo e(Form::label('name', 'Nombre producto')); ?>

    <?php echo e(Form::text('name', null, ['class' => 'form-control', 'id' => 'name', 'placeholder' => 'Nombre del producto'])); ?>

    <small class="form-text text-danger"> <?php echo e($errors->first('name')); ?></small>
</div>
<div class="form-group">
	<?php echo e(Form::label('category_id', 'Categorías')); ?>

    <?php echo e(Form::select('category_id', $categorias, null, ['class' => 'form-control'])); ?>

    <small class="form-text text-danger"> <?php echo e($errors->first('category_id')); ?></small>
</div>
<div class="form-group">
    <?php echo e(Form::label('description', 'Descripción producto')); ?>

    <?php echo e(Form::textarea('description', null, ['class' => 'form-control', 'rows' => '4', 'id' => 'description', 'placeholder' => 'Breve descripción del producto'])); ?>

    <small class="form-text text-danger"> <?php echo e($errors->first('description')); ?></small>
</div>
<div class="form-group">
    <?php echo e(Form::label('price_in', 'Precio de Entrada')); ?>

    <?php echo e(Form::number('price_in', null, ['class' => 'form-control', 'id' => 'price_in', 'placeholder' => 'Precio del producto'])); ?>

    <small class="form-text text-danger"> <?php echo e($errors->first('price_in')); ?></small>
</div>
<div class="form-group">
    <?php echo e(Form::label('price_out', 'Precio de Salida')); ?>

    <?php echo e(Form::number('price_out', null, ['class' => 'form-control', 'id' => 'price_out', 'placeholder' => 'Precio venta al publico'])); ?>

    <small class="form-text text-danger"> <?php echo e($errors->first('description')); ?></small>
</div>
<div class="form-group">
    <?php echo e(Form::label('unit', 'Unidad')); ?>

    <?php echo e(Form::text('unit', null, ['class' => 'form-control', 'id' => 'unit'])); ?>

    <small class="form-text text-danger"> <?php echo e($errors->first('price_out')); ?></small>
</div>
<div class="form-group">
    <?php echo e(Form::label('presentation', 'Presentación')); ?>

    <?php echo e(Form::text('presentation', null, ['class' => 'form-control', 'id' => 'presentation'])); ?>

    <small class="form-text text-danger"> <?php echo e($errors->first('presentation')); ?></small>
</div>
<div class="form-group">
    <?php echo e(Form::label('inventary_min', 'Minima en inventario')); ?>

    <?php echo e(Form::number('inventary_min', null, ['class' => 'form-control', 'id' => 'inventary_min', 'placeholder' => 'Minima en inventario'])); ?>

    <small class="form-text text-danger"> <?php echo e($errors->first('inventary_min')); ?></small>
</div>

<div class="form-group">
    <?php echo e(Form::label('is_active', 'Estado')); ?>

    <label>
        <?php echo e(Form::radio('is_active', 1)); ?> Activo
    </label>
    <label>
        <?php echo e(Form::radio('is_active', 0)); ?> Desactivado
    </label>
</div>


