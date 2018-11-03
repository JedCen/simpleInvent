<div id="createModal" class="modal fade" role="dialog" tabindex="-1" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content" style="border-radius: 10px;">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                        <h4 class="modal-title" id="myModalLabel">Nuevo proveedor</h4>
                    </div>
                    <div class="modal-body">
                    {!! Form::open(['route' => 'proveedor.store']) !!}
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label>Nombre:</label>
                            <input type="text" placeholder="Nombre" class="form-control"
                                   >
                        </div>
                        <div class="form-group col-md-6">
                            <label>Apellido:</label>
                            <input type="text" placeholder="Apellido" class="form-control"
                                   >
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label>RFC:</label>
                            <input type="text" placeholder="RFC" class="form-control"
                                   >
                        </div>
                    </div>
                        <div class="form-group">
                            <label>Dirección:</label>
                            <input type="text" placeholder="Dirección" class="form-control"
                                   >
                        </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label>Telefono:</label>
                            <input type="phone" placeholder="Nº Telefono" class="form-control">
                        </div>
                        <div class="form-group col-md-6">
                            <label>Email:</label>
                            <input type="email" class="form-control" id="email" placeholder="Dirección Email">
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