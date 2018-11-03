@extends('layouts.app')

@section('htmlheader_title')
    Lista ventas
@endsection

@section('contentheader_title')
    <i class='glyphicon glyphicon-shopping-cart'></i> Lista de Ventas
@endsection

@section('content')
<div class="container-fluid spark-screen">
    <div class="row">
            <div class="col-md-12">
                    <div class="clearfix"></div>
            @if(count($products)>0)

            <br>
            <div class="card panel-primary @role('admin', true) panel-success  @endrole">
                <div class="card-header with-border">
                    <div class="float-left">
                        <i class="fa fa-shopping-cart" aria-hidden="true"></i> Ventas
                    </div>
                </div>
            <div class="card-body">
            <table id="data-table" class="table table-striped">
                <thead>
                    <th>Productos</th>
                    <th>Total</th>
                    <th>Fecha</th>
                    <th></th>
                </thead>
                @foreach($products as $sell)
                    @php
                    $operations = Operation::getAllProductsBySellId($sell->id);
                    $total= $sell->total-$sell->discount;
                    @endphp
                    <tr>
                        <td>
                            {{ count($operations) }}
                        <td>
                            
                            <b>$ {{ number_format($total) }} </b>         

                        </td>
                        <td>
                            {{ $sell->created_at }}
                        </td>
                        <td>
                            {!! HTML::icon_link(URL::to('/sells/detail/'.$sell->id), 'far fa-eye fa-fw', 'VER', array('class' => 'btn btn-sm btn-info')) !!}
                            @role('admin') 
                            {!! Form::model($sell, array('action' => array('VentaController@destroy', $sell->id), 'method' => 'DELETE', 'class' => 'form-inline', 'data-toggle' => 'tooltip', 'title' => 'Eliminar venta permanete')) !!}
                                {!! Form::hidden('_method', 'DELETE') !!}
                                {!! Form::button('<i class="fas fa-eraser fa-fw" aria-hidden="true"></i> Eliminar', array('class' => 'btn btn-danger btn-sm','type' => 'button', 'style' =>'width: 100%;' ,'data-toggle' => 'modal', 'data-target' => '#confirmDelete', 'data-title' => 'Eliminar Venta Permanente', 'data-message' => 'Esta seguro de eliminar esta venta?')) !!}
                            {!! Form::close() !!}
                            @endrole
                        </td>
                    </tr>

                @endforeach

            </table>
            </div>
        </div>
            <div class="clearfix"></div>
        @else    
                <div class="jumbotron">
                    <h2>No hay ventas</h2>
                    <p>No se ha realizado ninguna venta.</p>
                </div>   
        @endif
        </div>
    </div>
</div>
@include('modals.modal-delete')
@endsection

@section('footer_scripts')

  @include('scripts.delete-modal-script')
  @include('scripts.tooltips')
  <!-- DataTables -->
  @include('scripts.datatables')

@endsection
