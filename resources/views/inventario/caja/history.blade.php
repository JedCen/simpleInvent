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
            @if ($boxes->count()>0)
            @php
                $total_total = 0;
            @endphp 
			<div class="col-md-9">

				<div class="card panel-info">
                    <div class="card-header">
                        <div class="float-left">
                            <h5 class="card-title"><i class='fas fa-boxes'></i> Lista corte de caja </h5>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-sm btn-adn" href="{{ Route('caja.index') }}"> <i class="fas fa-undo "></i> Regresar</a>
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
                                @foreach($boxes as $box)
                                <tr>
                                    <td style="width:30px;">
                                        {!! HTML::icon_link(URL::to('caja/historial/'.$box->id), 'fa fa-arrow-right','', array('class' => 'btn btn-sm btn-info')) !!}			
                                    </td>
                                    <td>
                                        @php
                                        $total=0;
                                        foreach($sells->where('box_id', $box->id) as $sell){
                                            $operations = Operation::getAllProductsBySellId($sell->id);
                                            $total += $sell->total-$sell->discount;
                                        }
                                            $total_total += $total;
                                            echo number_format($total,2,".",",");
                                        @endphp
                                    </td>
                                    <td> {{ $box->created_at }} </td>
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
                                <span class="info-box-text">Total caja</span>
                                <span class="info-box-number">$ {{number_format($total_total,2,".",",")}}</span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
            @else
            xd
        

            @endif
		</div>
	</div>
@endsection

@section('footer_scripts')
<!-- Scripts Extras -->
    
@endsection
