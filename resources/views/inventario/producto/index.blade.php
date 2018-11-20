@extends('layouts.app')

@section('htmlheader_title')
    Productos
@endsection

@section('contentheader_title')
    <i class='fab fa-product-hunt'></i> Lista de productos
@endsection


@section('content')
    <div class="container-fluid spark-screen">
            @php
                $simbol = Config::find(5)->val;
            @endphp
        <div class="row">
                
            <div class="col-md-12 col-md">
                    <div class="card panel-info">
                        <div class="card-header">
                            <div class="float-left">
                                    <i class='fab fa-product-hunt'></i> Productos
                            </div>
                            <div class="float-right">
                                <div class="btn-group" role="group" aria-label="Button group with nested dropdown">
                                    {!! HTML::icon_link(URL::to(route('producto.create')), 'fa fa-plus-circle', ' Agregar Producto', array('class' => 'btn btn-sm btn-secondary')) !!}
                                    <div class="btn-group" role="group">
                                    <button id="btnGroupDrop1" type="button" class="btn btn-sm btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Descargar
                                    </button>
                                        <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                                            <a class="dropdown-item" href="{{route('producto.pdf')}}">Descargar PDF</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            @if(session()->has('info'))
                            <div class="alert alert-success" role="alert">
                                {{ session()->get('info') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            @endif
                            <div class="table-responsive">
                                <table id="data-table" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                        <th>Codigo</th>
                                        <th>Imagen</th>
                                        <th>Nombre</th>
                                        <th>Precio Entrada</th>
                                        <th>Precio Salida</th>
                                        <th>Categoria</th>
                                        <th>Minima</th>
                                        <th>Activo</th>
                                        <th></th>
                                        </tr>
                                    </thead>
                                    @foreach($products as $product)
                                    <tr>
                                        <td>{{$product->barcode}}</td>
                                        <td>
                                            @if($product->image!="")
                                                <img src="{{$product->image}}" style="width:64px;">
                                            @endif
                                        </td>
                                        <td>{{$product->name}}</td>
                                        <td>{{$simbol}} {{number_format($product->price_in,2,'.',',')}}</td>
                                        <td>{{$simbol}} {{number_format($product->price_out,2,'.',',')}}</td>
                                        <td><?php if($product->category_id!=null){echo $product->category->name;}else{ echo "<center>----</center>"; }  ?> </td>
                                        <td>{{$product->inventary_min}}</td>
                                        <td><?php if($product->is_active == 1): ?><i class="fa fa-check"></i><?php endif;?></td>
    
    
                                        <td>
                                        {!! HTML::icon_link(URL::to(route('producto.edit', $product->id)), 'fa fa-edit fa-fw','', array('class' => 'btn btn-sm btn-info', 'type' => 'button', 'data-toggle' => 'tooltip', 'title' => 'Editar producto')) !!}
    
                                        @role('admin')
                                        {!! Form::model($product, array('action' => array('ProductoController@destroy', $product->id), 'method' => 'DELETE', 'class' => 'form-inline', 'data-toggle' => 'tooltip', 'title' => 'Eliminar producto permanete')) !!}
                                            {!! Form::hidden('_method', 'DELETE') !!}
                                            {!! Form::button('<i class="fa fa-trash fa-fw" aria-hidden="true"></i>', array('class' => 'btn btn-danger btn-sm','type' => 'button', 'style' =>'width: 100%;' ,'data-toggle' => 'modal', 'data-target' => '#confirmDelete', 'data-title' => 'Eliminar Producto Permanente', 'data-message' => 'Esta seguro de eliminar el producto ' .$product->name.'?')) !!}
                                        {!! Form::close() !!}
                                        @endrole
                                        </td>
                                    </tr>
                                    @endforeach
                                </table>
                            </div>
                        </div>
                    </div>
        </div>
    </div>
@include('modals.modal-delete')
@endsection

@section('footer_scripts')
<!-- Scripts Extras -->
    @include('scripts.delete-modal-script')
    @include('scripts.tooltips')
    @include('scripts.datatables')
@endsection
