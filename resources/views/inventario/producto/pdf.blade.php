@extends('layouts.app')

@section('htmlheader_title')
    Productos
@endsection

@section('contentheader_title')
    <i class='fa fa-product-hunt'></i> Lista de productos
@endsection

@section('template_linked_css')
  <!-- Css Extras -->
@endsection

@section('content')
    <div class="container-fluid spark-screen">
        <div class="row">
            <div class="col-md-12 col-md">

                <div class="box box-success box-solid">
                    <div class="box-header with-border">
                        <h3 class="box-title"><i class='fa fa-product-hunt'></i> Productos</h3>
                        <!-- /.box-tools -->
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
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
@endsection

@section('footer_scripts')
<!-- Scripts Extras -->

@endsection
