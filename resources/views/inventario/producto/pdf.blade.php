@extends('layouts.report')

@section('title-head')
    Productos
@endsection

@section('content')
<div class="container-fluid spark-screen">
    <div class="row">
        <div class="col-md-12 col-md">
            <h3 class="box-title"><i class='fa fa-product-hunt'></i> Productos</h3>
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Lista de productos <span class="derecha">{{now()}}</span></h3>
                    </div>
                    <div class="box-body">
                        <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                <th>Codigo</th>
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
                                <td>{{$product->name}}</td>
                                <td>$ {{number_format($product->price_in,2,'.',',')}}</td>
                                <td>$ {{number_format($product->price_out,2,'.',',')}}</td>
                                <td><?php if($product->category_id!=null){echo $product->category->name;}else{ echo "<center>----</center>"; }  ?> </td>
                                <td>{{$product->inventary_min}}</td>
                                <td><?php if($product->is_active == 'ON'): ?><i class="fa fa-check"></i><?php endif;?></td>
                            
                            </tr>
                            @endforeach
                        </table>
                        <div class="shadow-lg p-3 mb-5 bg-white rounded">
                            <p class="font-weight-bold">Total registrado: {{ count($products) }}</p>
                        </div>
                    </div>
                    </div>
                </div>
                    <!-- /.box-body -->
        </div>
    </div>
</div>
@endsection

