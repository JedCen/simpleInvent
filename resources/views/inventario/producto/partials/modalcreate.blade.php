<!-- Modal form to edit a form -->
<div id="newproduct" class="modal fade modal-success" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Nuevo producto</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body" >
                
                {!! Form::open(['route' => 'producto.store', 'files' => true, 'enctype' => 'multipart/form-data', 'id'=>'uploadForm']) !!}
                            
                {{ Form::hidden('user_id', Auth::user()->id) }}

                
                    {{-- <div class="form-group">
                            <img class="elevation-3 rounded mx-auto d-block" id="blah" src="#" alt="Cargar imagen" width="100"/>
                            <hr>
                        {{ Form::label('image', 'Cargar imagen') }}
                        {{ Form::file('image') }}
                        <small class="form-text text-danger">
                                {{ $errors->first('image') }}
                        </small>
                    </div> --}}
                    <carga-imagen></carga-imagen>
               
                
                <div class="form-group">
                    {{ Form::label('barcode', 'Codigo de barra') }}
                    {{ Form::text('barcode', null, ['class' => 'form-control', 'id' => 'barcode', 'aria-describedby' => 'passwordHelpBlock', 'placeholder' => 'Codigo de barra del producto']) }}
                    <small id="passwordHelpBlock" class="form-text text-danger">
                            {{ $errors->first('barcode') }}
                    </small>
                </div>
                <div class="form-group">
                    {{ Form::label('name', 'Nombre producto') }}
                    {{ Form::text('name', null, ['class' => 'form-control', 'id' => 'name', 'placeholder' => 'Nombre del producto']) }}
                    <small class="form-text text-danger"> {{ $errors->first('name') }}</small>
                </div>
                {{-- <div class="form-group">
                    {{ Form::label('category_id', 'Categorías') }}
                    {{ Form::select('category_id', $categorias, null, ['class' => 'form-control']) }}
                    <small class="form-text text-danger"> {{ $errors->first('category_id') }}</small>
                </div> --}}
                <div class="form-group">
                    {{ Form::label('description', 'Descripción producto') }}
                    {{ Form::textarea('description', null, ['class' => 'form-control', 'rows' => '4', 'id' => 'description', 'placeholder' => 'Breve descripción del producto']) }}
                    <small class="form-text text-danger"> {{ $errors->first('description') }}</small>
                </div>
                <div class="form-group">
                    {{ Form::label('price_in', 'Precio de Entrada') }}
                    {{ Form::number('price_in', null, ['class' => 'form-control', 'id' => 'price_in', 'placeholder' => 'Precio del producto']) }}
                    <small class="form-text text-danger"> {{ $errors->first('price_in') }}</small>
                </div>
                <div class="form-group">
                    {{ Form::label('price_out', 'Precio de Salida') }}
                    {{ Form::number('price_out', null, ['class' => 'form-control', 'id' => 'price_out', 'placeholder' => 'Precio venta al publico']) }}
                    <small class="form-text text-danger"> {{ $errors->first('description') }}</small>
                </div>
                <div class="form-group">
                    {{ Form::label('unit', 'Unidad') }}
                    {{ Form::text('unit', null, ['class' => 'form-control', 'id' => 'unit']) }}
                    <small class="form-text text-danger"> {{ $errors->first('price_out') }}</small>
                </div>
                <div class="form-group">
                    {{ Form::label('presentation', 'Presentación') }}
                    {{ Form::text('presentation', null, ['class' => 'form-control', 'id' => 'presentation']) }}
                    <small class="form-text text-danger"> {{ $errors->first('presentation') }}</small>
                </div>
                <div class="form-group">
                    {{ Form::label('inventary_min', 'Minima en inventario') }}
                    {{ Form::number('inventary_min', null, ['class' => 'form-control', 'id' => 'inventary_min', 'placeholder' => 'Minima en inventario']) }}
                    <small class="form-text text-danger"> {{ $errors->first('inventary_min') }}</small>
                </div>
                
                <div class="form-group">
                    {{ Form::label('is_active', 'Estado') }}
                    <label>
                        {{ Form::radio('is_active', 1) }} Activo
                    </label>
                    <label>
                        {{ Form::radio('is_active', 0) }} Desactivado
                    </label>
                </div>
                
                
                 
                            <div class="form-group">
                                {{ Form::label('q', 'Cantidad actual de producto') }} {{ Form::number('q', null, ['class' => 'form-control col-md-6', 'id' => 'q',
                                'placeholder' => 'Cantidad actual de producto']) }}
                                <small class="form-text text-danger"> {{ $errors->first('q') }}</small>
                            </div>
                            <div class="form-group">
                                {{ Form::submit('Agregar Producto', ['class' => 'btn btn-sm btn-primary']) }}
                            </div>
                        {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>