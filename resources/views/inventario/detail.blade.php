@extends('layouts.app')

@section('htmlheader_title')
    about
@endsection

@section('contentheader_title')
    Comprobante
@endsection

@section('template_linked_css')
  <!-- Css Extras -->
@endsection

@section('content')
    <div class="container-fluid spark-screen">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                @if(count($sells)>0 && $sells->operation_type_id == 2)
                
                <div class="card panel-success">
                    <div class="card-header with-border">
                        <div class="float-left">
                            <i class="fab fa-product-hunt"></i> Comprobante salida # {{ str_pad ($sells->id, 7, '0', STR_PAD_LEFT) }}
                        </div>
                        <div class="float-right">
                            {!! HTML::icon_link(URL::to(Route('caja.index')), 'fa fa-mail-reply fa-fw', 'Regresar a ventas', array('class' => 'btn btn-sm btn-info')) !!}
                        </div>
                        <!-- /.box-tools -->
                    </div>
                    <!-- /.box-header -->
                    <div class="card-body">
                        
                        <div class="row">
                            <div class="col-md-12">
                                    <div class="well">
                                        Le atendio:
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <input class="form-control" type="text" readonly value="{{ Auth::user()->name }}" />
                                            </div>
                                        </div>
                                    </div>
                                    
                                <div class="well">
                                    Datos cliente:
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

                                <hr />

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
                                        <td class="text-right">$ {{number_format( $q2=$operation->product->price_out, 2)}}</td>
                                        <td class="text-right">$ {{number_format($q3=$q1*$q2, 2)}}</td>
                                    </tr>
                                    @endforeach
                                    </tbody>
                                    <tfoot>
                                        
                                    <tr>

                                        <td colspan="3" class="text-right"><b>IVA</b></td>
                                        <td class="text-right">$ {{ number_format($sells->total*.16, 2) }}</td>
                                    </tr>
                                    <tr>
                                        <td colspan="3" class="text-right"><b>Sub Total</b></td>
                                        <td class="text-right">$ {{ number_format($sells->total*.84, 2) }}</td>
                                    </tr>
                                    <tr>
                                        <td colspan="3" class="text-right"><b>Total</b></td>
                                        <td class="text-right">$ {{ number_format($sells->total, 2) }}</td>
                                    </tr>
                                    </tfoot>
                                </table>

                            </div>
                        </div>
                        
                    </div>
                    <!-- /.box-body -->
                </div>
                @else
                        <div class="alert alert-danger">
                          <strong>Error!</strong> El comprobante que ingreso no existe.
                          <br>
                          <a href="/sells" class="btn btn-sm btn-info">Regresar</a>
                        </div>
                @endif
            </div>
        </div>
    </div>
@endsection

@section('footer_scripts')
<!-- Scripts Extras -->
@endsection
