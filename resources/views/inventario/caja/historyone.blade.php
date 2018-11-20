@extends('layouts.app')

@section('htmlheader_title')
    Inventario
@endsection

@section('contentheader_title')
<i class="fa fa-archive"></i> Historial de caja
@endsection

@section('template_linked_css')
  <!-- Css Extras -->
 
@endsection

@section('content')
	<div class="container-fluid spark-screen">
		<div class="row">
            @if ($sells->count()>0)
            @php
                $total_total = 0;
                $simbol =Config::find(5)->val;
            @endphp
			<div class="col-md-9">

				<div class="card panel-info">
                    <div class="card-header">
                        <div class="float-left">
                            <h5 class="card-title"><i class='fas fa-boxes'></i> Ventas corte de caja # {{ str_pad ($id, 4, '0', STR_PAD_LEFT) }}</h5>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-sm btn-adn" href="{{ Route('caja.history') }}"> <i class="fas fa-undo "></i> Regresar</a>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">  
                            <table class="table table-bordered table-hover	">
                                <thead>
                                    <th></th>
                                    <th>Total</th>
                                    <th>Fecha</th>
                                </thead>
                                @foreach($sells as $sell)
                                <tr>
                                    <td style="width:30px;">
                                            {!! HTML::icon_link(URL::to('/sells/detail/'.$sell->id), 'far fa-eye fa-fw', 'VER', array('class' => 'btn btn-sm btn-info')) !!}			
                                    </td>
                                    <td>
                                        @php
                                            $total_total += $sell->total-$sell->discount;
                                        @endphp
                                          {{$simbol}}  {{number_format( $sell->total-$sell->discount ,2,".",",")}}
                                       
                                    </td>
                                    <td> {{ $sell->created_at }} </td>
                                </tr>
                                @endforeach
                            </table>
                    </div>
                    <!-- /.card-body -->
                </div>

            </div>
            <div class="col-md-3">
                <div class="card panel-info">
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="info-box">
                            <span class="info-box-icon bg-info"><i class="fas fa-file-invoice-dollar"></i></span>
            
                            <div class="info-box-content">
                            <span class="info-box-text">Total corte #{{$id}}</span>
                                <span class="info-box-number">{{$simbol}} {{number_format($total_total,2,".",",")}}</span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
            @else
            <div class="col-md-8">
                <div class="card panel-danger">
                    <div class="card-header">Error!!
                            <div class="float-right">
                                <a class="btn btn-sm btn-info" href="{{ Route('caja.history') }}"> <i class="fas fa-undo "></i> Regresar</a>
                            </div>
                    </div>
                    <div class="card-body">
                        <div class="jumbotron">
                            <h5 class="card-title">Ingreso un corte de caja incorrecto</h5>
                            <p class="card-text">Verificar que los datos ingresados sean correctos</p>
                        </div>
                    </div>
                </div>
            </div>
            @endif
		</div>
	</div>
@endsection

@section('footer_scripts')
<!-- Scripts Extras -->
    
@endsection
