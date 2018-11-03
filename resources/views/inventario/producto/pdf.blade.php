@extends('layouts.app')

@section('htmlheader_title')
    Productos
@endsection

@section('contentheader_title')
    <i class='fa fa-product-hunt'></i> Lista de productos
@endsection

@section('template_linked_css')
  <!-- Css Extras -->
  <!-- DataTables -->
  <link rel="stylesheet" href="http://local.dev/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
@endsection

@section('content')
    <div class="container-fluid spark-screen">
        <div class="row">
            <div class="col-md-12 col-md">

                <div class="box box-success box-solid">
                    <div class="box-header with-border">
                        <h3 class="box-title"><i class='fa fa-product-hunt'></i> Productos</h3>
                        <div class="box-tools pull-right">
                            {!! HTML::icon_link(URL::to(route('producto.create')), 'fa fa-plus-circle', ' Agregar Producto', array('class' => 'btn btn-primary')) !!}
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                        </div>
                        <!-- /.box-tools -->
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="btn-group  pull-right">
                            <div class="btn-group pull-right">
                              <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                                <i class="fa fa-download"></i> Descargar <span class="caret"></span>
                              </button>
                              <ul class="dropdown-menu" role="menu">
                                <li><a href="{{route('producto.pdf')}}">Descargar PDF</a></li>
                              </ul>
                            </div>
                        </div>
                        <div class="clearfix"></div> 
                        <div class="box">
                                <div class="box-header">
                                    <h3 class="box-title">Lista de productos</h3>
                                </div>
                            <div class="box-body">
                            <div class="table-responsive">
                            <table id="productos12" class="table table-bordered table-striped">
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
                                    <td>$ {{number_format($product->price_in,2,'.',',')}}</td>
                                    <td>$ {{number_format($product->price_out,2,'.',',')}}</td>
                                    <td><?php if($product->category_id!=null){echo $product->category->name;}else{ echo "<center>----</center>"; }  ?> </td>
                                    <td>{{$product->inventary_min}}</td>
                                    <td><?php if($product->is_active == 'ON'): ?><i class="fa fa-check"></i><?php endif;?></td>
                                    

                                    <td style="width:70px;">
                                    {!! HTML::icon_link(URL::to(route('producto.edit', $product->id)), 'glyphicon glyphicon-edit fa-fw','', array('class' => 'btn btn-xs btn-info', 'data-toggle' => 'tooltip', 'title' => 'Editar producto')) !!}

                                    @role('admin') 
                                    {!! Form::model($product, array('action' => array('ProductoController@destroy', $product->id), 'method' => 'DELETE', 'class' => 'form-inline', 'data-toggle' => 'tooltip', 'title' => 'Eliminar producto permanete')) !!}
                                        {!! Form::hidden('_method', 'DELETE') !!}
                                        {!! Form::button('<i class="fa fa-trash fa-fw" aria-hidden="true"></i>', array('class' => 'btn btn-danger btn-xs','type' => 'button', 'style' =>'width: 100%;' ,'data-toggle' => 'modal', 'data-target' => '#confirmDelete', 'data-title' => 'Eliminar Producto Permanente', 'data-message' => 'Esta seguro de eliminar el producto ' .$product->name.'?')) !!}
                                    {!! Form::close() !!}
                                    @endrole
                                    </td>
                                </tr>
                                @endforeach
                            </table>
                        </div>
                        </div>
                    </div>
                    <!-- /.box-body -->
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
<!-- DataTables -->
<script src="http://local.dev/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="http://local.dev/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
  <script>
      $(document).ready(function(){
        $('#productos12').DataTable({
          "language": {
        "sProcessing":    "Procesando...",
        "sLengthMenu":    "Mostrar _MENU_ registros",
        "sZeroRecords":   "No se encontraron resultados",
        "sEmptyTable":    "Ningún dato disponible en esta tabla",
        "sInfo":          "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
        "sInfoEmpty":     "Mostrando registros del 0 al 0 de un total de 0 registros",
        "sInfoFiltered":  "(filtrado de un total de _MAX_ registros)",
        "sInfoPostFix":   "",
        "sSearch":        "Buscar:",
        "sUrl":           "",
        "sInfoThousands":  ",",
        "sLoadingRecords": "Cargando...",
        "oPaginate": {
            "sFirst":    "Primero",
            "sLast":    "Último",
            "sNext":    "Siguiente",
            "sPrevious": "Anterior"
        },
        "oAria": {
            "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
            "sSortDescending": ": Activar para ordenar la columna de manera descendente"
        }
    }
        });
      });
</script>
@endsection
