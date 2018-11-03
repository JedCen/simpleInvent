@extends('layouts.app')

@section('htmlheader_title')
    Reportes
@endsection

@section('contentheader_title')
    <i class="fas fa-chart-line"></i> Reporte por producto
@endsection

@section('template_linked_css')
  <!-- Css Extras -->
 
@endsection

@section('content')
    <div class="container-fluid spark-screen">
        <div class="row">
            <div class="col-md-12 col-md">
                <div class="card card-info card-outline">
                    
                    <div class="card-body" style="display: block;">
                        <div class="well">
                            <h5>Ingrese los datos:</h5>
                            {!! Form::open(['route' => 'getsells.product', 'method' => 'GET']) !!}
                                <div class="row">
                                    <div class="input-group col-sm-5">
                                        <div class="input-group-prepend">
                                            {{ Form::label('producto', 'Producto',['class' => 'input-group-text']) }}
                                        </div>
                                        {{ Form::select('producto', $products2, Request::input('producto'), ['class' => 'custom-select']) }}
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
                                    <div class="col-ms-1">
                                        <button type="submit" class="btn btn-block btn-primary"> <i class="fas fa-file-invoice"></i> </button>
                                    </div>
                                </div>
                                {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
            @if(Request::has('producto'))
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
                        $operations = Operation::Where('product_id', Request::input('producto'))
                                ->where('created_at', '>=', date('Y-m-d', strtotime(Request::input('ini'))))
                                ->where('created_at', '<=', carbon\Carbon::parse(Request::input('fin'))->addDays(1))
                                ->get();
                        @endphp
                        @if($operations->count()>0)
                        <table id="datatable" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                <th>Codigo</th>
                                <th>Producto</th>
                                <th>Cantidad</th>
                                <th>Operación</th>
                                <th>Fecha</th>
                                </tr>
                            </thead>
                            
                            @foreach($operations as $operation)
                            <tr>
                                <td> {{$operation->id}}</td>
                                <td> {{ $operation->product->name }}</td>
                                <td> {{ $operation->q }} </td>
                                <td> {{ $operation->operation_type->name }}</td>
                                <td>  
                                     {{ $operation->created_at }}
                                </td>
                            </tr>
                            @endforeach
                        </table> 
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

@endsection
