@extends('layouts.app')

@section('htmlheader_title')
    Inventario
@endsection

@section('contentheader_title')
    <i class='fa fa-history'></i> historial producto
@endsection

@section('template_linked_css')
  <!-- Css Extras -->
 
@endsection

@section('content')
	<div class="container-fluid spark-screen">
        @if($operations->count()>0 && $product->count()>0)
        <div class="row">
            
            <div class="col-md-4 col-sm-6 col-12">
                <div class="info-box">
                    <span class="info-box-icon bg-info"><i class="fa fa-hand-holding-usd"></i></span>
                    @php
                        $total_e=0;
                        $total_s=0;
                        $total_entrada= 0;
                        $total_salida= 0;
                        foreach($operentrada as $item){
                            $product  = $item->getProduct();
                            $total_e += $item->q;
                        }
                            $total_entrada += $total_e;

                        foreach($opersalida as $item){
                            $product  = $item->getProduct();
                            $total_s += $item->q;
                        }
                            $total_salida += $total_s;


                    @endphp
                    <div class="info-box-content">
                    <span class="info-box-text">Entrada</span>
                    <span class="info-box-number"> {{ $total_entrada }} </span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
                  <!-- /.col -->
            <div class="col-md-4 col-sm-6 col-12">
                <div class="info-box">
                    <span class="info-box-icon bg-success"><i class="fa fa-cube"></i></span>

                    <div class="info-box-content">
                    <span class="info-box-text">Disponible</span>
                    <span class="info-box-number"> {{ $total_entrada - $total_salida }} </span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
                  <!-- /.col -->
            <div class="col-md-4 col-sm-6 col-12">
                <div class="info-box">
                    <span class="info-box-icon bg-warning"><i class="fa fa-shopping-cart"></i></span>

                    <div class="info-box-content">
                    <span class="info-box-text">Salida</span>
                    <span class="info-box-number"> {{ $total_salida }} </span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
                  <!-- /.col -->
        </div>   
		<div class="row">
			<div class="col-md-12">
                
				<div class="card panel-info">
                    <div class="card-header">
                        <div class="float-left">
                            <h5 class="card-title"><i class='fab fa-product-hunt'></i>roducto: {{ $product->name }} </h5>
                        </div>
                        <div class="float-right">
                            {!! HTML::icon_link(URL::to(route('inventario.index')), 'fa fa-history', ' Regresar', array('class' => 'btn btn-sm btn-secondary')) !!}
                        </div>
                    </div>

                    <!-- /.card-header -->
                    <div class="card-body">
                        <table class="table table-bordered table-hover">
                            <thead>
                                <th></th>
                                <th>Cantidad</th>
                                <th>Tipo</th>
                                <th>Fecha</th>
                                <th></th>
                            </thead>
                            @foreach ($operations as $operation)
                            <tr>
                                <td></td>
                                <td>{{ $operation->q }}</td>
                                <td>{{ $operation->operation_type->name }}</td>
                                <td>{{ $operation->created_at }}</td>
                                <td style="width:40px;"><a href="#" id="oper-<?php echo $operation->id; ?>" class="btn tip btn-sm btn-danger" title="Eliminar"><i class="fa fa-trash"></i></a> </td>
                            </tr>
                            @endforeach
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>

			</div>
        </div>
        @else
        <div class="col-md-8">
            <div class="card panel-danger">
                <div class="card-header">Error!!
                        <div class="float-right">
                            <a class="btn btn-sm btn-info" href="{{ Route('inventario.index') }}"> <i class="fas fa-undo "></i> Regresar</a>
                        </div>
                </div>
                <div class="card-body">
                    <div class="jumbotron">
                        <h5 class="card-title">Ingreso dato incorrecto</h5>
                        <p class="card-text">Verificar que los datos sean correctos, o reportar algún inconveniente</p>
                    </div>
                </div>
            </div>
        </div>
        @endif
	</div>
@endsection

@section('footer_scripts')
<!-- Scripts Extras -->
    
@endsection
