<div id="editModal-{{$proveedor->id}}" class="modal fade" role="dialog" tabindex="-1" aria-labelledby="myModalLabel2">
    <div class="modal-dialog" role="document">
        <div class="modal-content" style="border-radius: 10px;">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                <h4 class="modal-title" id="myModalLabel2">Actualizar proveedor</h4>
            </div>
            <div class="modal-body">
                    {!! Form::model($proveedor,['route' => ['proveedor.update', $proveedor->id], 'method' => 'PUT']) !!}
                    <div class="row">
                        <div class="form-group col-md-6">
                            {{ Form::label('name', 'Nombre: ') }}
                            {{ Form::text('name', $proveedor->name, ['class' => 'form-control', 'id' => 'name']) }}
                        </div>
                        <div class="form-group col-md-6">
                            {{ Form::label('lastname', 'Apellido: ') }}
                            {{ Form::text('lastname', $proveedor->lastname, ['class' => 'form-control', 'id' => 'lastname']) }}
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                            {{ Form::label('rfc', 'RFC: ') }}
                            {{ Form::text('rfc', $proveedor->rfc, ['class' => 'form-control', 'id' => 'rfc']) }}
                        </div>
                    </div>
                    
                        <div class="form-group">
                            {{ Form::label('address1', 'Dirección:') }}
                            {{ Form::text('address1', $proveedor->address1, ['class' => 'form-control', 'id' => 'address1']) }}
                        </div>
                    
                    <div class="row">
                        <div class="form-group col-md-6">
                            {{ Form::label('phone1', 'Telefono: ') }}
                            {{ Form::text('phone1', $proveedor->phone1, ['class' => 'form-control', 'id' => 'phone1']) }}
                        </div>
                        <div class="form-group col-md-6">
                            {{ Form::label('email1', 'Correo electronico: ') }}
                            {{ Form::text('email1', $proveedor->email1, ['class' => 'form-control', 'id' => 'email1']) }}
                        </div>
                    </div>
                    
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                        {!! Form::button('Agregar <i class="glyphicon glyphicon-send" aria-hidden="true"></i>', array('class' => 'btn btn-info','type' => 'submit')) !!}
                    </div>
                    {!! Form::close() !!}
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
</div>