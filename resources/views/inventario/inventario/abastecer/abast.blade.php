@extends('layouts.app')

@section('htmlheader_title')
    Inventario
@endsection

@section('contentheader_title')
    <i class="fab fa-product-hunt    "></i> Inventario
@endsection

@section('template_linked_css')
  <!-- Css Extras -->
 
@endsection

@section('content')
	<div class="container-fluid spark-screen">
		<div class="row">
			<div class="col-md-12">
                    @if(count($sells)>0 && $sells->operation_type_id == 1)

				<div class="card panel-info">
                    <div class="card-header">
                        <div class="float-left">
                            <i class="fab fa-product-hunt"></i> Comprobante entrada # {{ str_pad ($sells->id, 7, '0', STR_PAD_LEFT) }}
                        </div>
                        <div class="float-right">
                                {!! HTML::icon_link(URL::to('/abastecimientos'), 'fa fa-mail-reply fa-fw', 'Regresar a Abastecimientos', array('class' => 'btn btn-sm btn-info')) !!}
                            </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="well">
                            <div class="row">
                                <div class="col-sm-6">
                                    <input class="form-control" type="text" readonly value="{{ $sells->person->name }}" />
                                </div>
                                <div class="col-sm-2">
                                    <input class="form-control" type="text" readonly value={{ $sells->person->rfc }} />
                                </div>
                                <div class="col-sm-4">
                                    <input class="form-control" type="text" readonly value={{ $sells->person->address1 }} />
                                </div>
                            </div>
                        </div>
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th>Producto</th>
                                <th style="width:100px;">Cantidad</th>
                                <th style="width:100px;">P.U</th>
                                <th style="width:100px;">Total</th>
                            </tr>
                            </thead>
                            <tbody>

                            @foreach($operations as $operation)
                            <tr>
                                <td>{{$operation->product->name}}</td>
                                <td class="text-right">{{$q1=$operation->q}}</td>
                                <td class="text-right">$ {{number_format( $q2=$operation->product->price_in, 2)}}</td>
                                <td class="text-right">$ {{number_format($q3=$q1*$q2, 2)}}</td>
                            </tr>
                            @endforeach
                            </tbody>
                            <tfoot>
                            <tr>
                                <td colspan="3" class="text-right"><b>Total</b></td>
                                <td class="text-right">$ {{ number_format($q3, 2) }}</td>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
                @else
                    <div class="card panel-danger">
                        <div class="card-header">Error!!
                        </div>
                        <div class="card-body">
                            <div class="jumbotron">
                                <strong>Error!</strong> El comprobante que ingreso no existe.
                                <br>
                                    <a href="{{route('reabastecerinv')}}" class="btn btn-sm btn-danger">Regresar</a>
                            </div>
                        </div>
                    </div>
                @endif
			</div>
		</div>
	</div>
@endsection

@section('footer_scripts')
<!-- Scripts Extras -->
    
@endsection
