@extends('layouts.app')

@section('htmlheader_title')
    Reportes
@endsection

@section('contentheader_title')
    <i class="fas fa-chart-line"></i> Reporte de ventas
@endsection
@section('breadcrumbs')
    {{ Breadcrumbs::render('rep_venta') }}
@endsection

@section('template_linked_css')
  <!-- Css Extras -->
  <link rel="stylesheet" href="{{asset('plugins/datatables/jquery.dataTables.min.css')}}">
@endsection

@section('content')
    <div class="container-fluid spark-screen">
        <div class="row">
            <div class="col-md-12 col-md">
                <div class="card card-info card-outline">
                    
                    <div class="card-body" style="display: block;">
                        <div class="well">
                            <h5>Ingrese los datos:</h5>
                            {!! Form::open(['route' => 'sells.sells', 'method' => 'GET']) !!}
                                <div class="row">
                                    <div class="input-group col-sm-3">
                                        <div class="input-group-prepend">
                                            {{ Form::label('vendedor', 'Vendedor',['class' => 'input-group-text']) }}
                                        </div>
                                        {{ Form::select('vendedor', $vendedor, Request::input('vendedor'), ['class' => 'custom-select']) }}
                                    </div>
                                    <div class="input-group col-sm-3">
                                        <div class="input-group-prepend">
                                            {{ Form::label('cliente', 'Cliente',['class' => 'input-group-text']) }}
                                        </div>
                                        {{ Form::select('cliente', $cliente, Request::input('cliente'), ['class' => 'custom-select']) }}
                                    </div>
                                    <div class="input-group col-sm-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-calendar-minus"></i></span>
                                        </div>
                                        <input class="form-control" name="ini" value="{{Request::input('ini')}}" type="date" required>
                                    </div>
                                    <div class="input-group col-sm-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-calendar-plus"></i></span>
                                        </div>
                                        <input class="form-control"  name="fin" value="{{Request::input('fin')}}" type="date" required>
                                    </div>
                                </div>
                                <hr/>
                                <div class="form-group row">
                                    <div class="col-sm-1 offset-sm-11">
                                        <button type="submit" class="btn btn-block btn-primary"> <i class="fas fa-file-invoice"></i> </button>
                                    </div>
                                </div>
                                {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
            @if(Request::has('cliente'))
            <div class="col-md-12 col-md">
                <div class="card panel-info">
                    <div class="card-header">
                        <div class="float-left">
                                <i class='fab fa-product-hunt'></i> Reporte de producto
                        </div>
                        <div class="float-right">
                            <div class="btn-group" role="group" aria-label="Button group with nested dropdown">
                                <div class="btn-group" role="group">
                                <a class="btn btn-sm btn-secondary" href="{{ Route('sells.product') }}">
                                    Nueva consulta
                                </a>
                                </div>
                            </div>
                        </div>
                    </div> <!-- /.box-header -->
                    <div class="card-body">
                        @php
                        $operations = Sell::Where('person_id', Request::input('cliente'))
                                ->Where('user_id', Request::input('vendedor'))
                                ->Where('operation_type_id', 2)
                                ->where('created_at', '>=', date('Y-m-d', strtotime(Request::input('ini'))))
                                ->where('created_at', '<=', carbon\Carbon::parse(Request::input('fin'))->addDays(1))
                                ->get();
                        $configSimbMon =Config::find(5)->val;
                        @endphp
                        @if($operations->count()>0)
                        <div class="table-responsive">
                        <table id="data-table" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Subtotal</th>
                                    <th>Descuento</th>
                                    <th>Total</th>
                                    <th>Cliente</th>
                                    <th>Vendedor</th>
                                    <th>Fecha</th>
                                </tr>
                            </thead>
                            
                            @foreach($operations as $operation)
                            <tr>
                                <td> {{$operation->id}}</td>
                                <td> {{$configSimbMon}} {{ number_format($operation->total,2,'.',',') }}</td>
                                <td> {{$configSimbMon}} {{ number_format($operation->discount,2,'.',',') }} </td>
                                <td> {{$configSimbMon}} {{ number_format($operation->total-$operation->discount,2,'.',',') }}</td>
                                <td> {{ $operation->person->name }} </td>
                                <td> {{ $operation->user->name }} </td>
                                <td> {{ $operation->created_at }} </td>
                            </tr>
                            @endforeach
                        </table>
                        </div> 
                        @else
                            <div class="jumbotron">
                                <h2>No hay operaciones</h2>
                                <p>El rango de fechas seleccionado no proporciono ningun resultado de operaciones.</p>
                            </div
                        @endif 
                    </div><!-- /.box-body -->
                </div>
            </div>
            
            @endif
        </div>
    </div>
@endsection

@section('footer_scripts')
<!-- Scripts Extras -->
@include('scripts.datatables')
@endsection
