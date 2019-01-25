@extends('layouts.app')

@section('htmlheader_title')
    Inventario
@endsection

@section('contentheader_title')
    <i class="fab fa-product-hunt"></i> Inventario
@endsection
@section('breadcrumbs')
    {{ Breadcrumbs::render('inventario') }}
@endsection

@section('template_linked_css')
  <!-- Css Extras -->
  <link rel="stylesheet" href="{{asset('plugins/datatables/jquery.dataTables.min.css')}}">
@endsection

@section('content')
    <div class="container-fluid spark-screen">
        <div class="row">
            <div class="col-md-12 col-md">
                <div class="card panel-info">
                    <div class="card-header">
                        <div class="float-left">
                                <i class='fab fa-product-hunt'></i> Productos en inventario
                        </div>
                        <div class="float-right">
                            <div class="btn-group" role="group" aria-label="Button group with nested dropdown">
                                {!! HTML::icon_link(URL::to(route('producto.create')), 'fa fa-plus-circle', ' Agregar Producto', array('class' => 'btn btn-sm btn-secondary')) !!}
                                <div class="btn-group" role="group">
                                <button id="btnGroupDrop1" type="button" class="btn btn-sm btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Descargar
                                </button>
                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="btnGroupDrop1">
                                        <a class="dropdown-item" href="{{route('producto.pdf')}}">Descargar PDF</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> <!-- /.box-header -->
                    <div class="card-body">
                            @php
                                $simbol = Config::find(5)->val;
                            @endphp
                        <div class="clearfix"></div> 
                        <div class="table-responsive">
                            <table id="data-table" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                    <th>Codigo</th>
                                    <th>Nombre</th>
                                    <th>Precio Salida</th>
                                    <th>Categoria</th>
                                    <th>Disponible</th>
                                    <th>Total {{$simbol}}</th>
                                    <th class="text-center"> <i class="fa fa-history"></i></th>
                                    </tr>
                                </thead>
                                @foreach($products as $product)
                                @php 
                                    $q= Operation::getQYesF($product->id);
                                    @endphp
                                <tr>
                                    <td>{{$product->barcode}}</td>
                                    <td>{{$product->name}}</td>
                                    <td>{{$simbol}} {{number_format($product->price_out,2,'.',',')}}</td>
                                    <td><?php if($product->category_id != null){echo $product->category->name;}else{ echo "<center>----</center>"; }  ?> 
                                    </td>
                                    <td>{{ $q }}</td>
                                    <td>  
                                        @php
                                            $total = 0;   
                                                $total += $q*$product->price_out;               
                                        @endphp
                                        <b>{{$simbol}} {{number_format($total,2,".",",")}}</b>
                                    </td>
                                    <td style="width:70px;">
                                        {!! HTML::icon_link(URL::to(route('inventario.history', $product->id)), 'fa fa-history fa-fw','', array('class' => 'btn btn-xs btn-info', 'data-toggle' => 'tooltip', 'title' => 'Historial de producto')) !!}
                                        
                                    </td>
                                </tr>
                                @endforeach
                            </table>
                        </div>
                    </div><!-- /.box-body -->
                </div>
            </div>
        </div>
    </div>
@endsection

@section('footer_scripts')
<!-- Scripts Extras -->
@include('scripts.datatables')
@endsection
