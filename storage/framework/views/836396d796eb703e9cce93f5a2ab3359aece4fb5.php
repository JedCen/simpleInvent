<!-- Modal form to edit a form -->
    <div id="editModal-<?php echo e($category->id); ?>" class="modal fade modal-success" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel">Editar Categoria</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body" >
                    <?php echo Form::model($category, ['route' => ['categorias.update', $category->id], 'method' => 'PUT']); ?>

                        <div class="form-group">
                            <?php echo e(Form::label('id', 'ID: ')); ?>

                            <?php echo e(Form::text('id', $category->id, ['class' => 'form-control', 'id' => 'id', 'disabled' => 'disabled'])); ?>

                        </div>
                        <div class="form-group">
                            <?php echo e(Form::label('name', 'Nombre categoría: ')); ?>

                            <?php echo e(Form::text('name', $category->name, ['class' => 'form-control', 'id' => 'name'])); ?>

                        </div>
                    
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                        <?php echo Form::button('Enviar <i class="glyphicon glyphicon-send" aria-hidden="true"></i>', array('class' => 'btn btn-info','type' => 'submit')); ?>

                    </div>
                    <?php echo Form::close(); ?>

                    
                </div>
            </div>
        </div>
    </div>