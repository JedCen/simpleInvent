@extends('layouts.app')
@section('htmlheader_title') Abastecimientos
@endsection

@section('contentheader_title')
<i class="fa fa-history"></i> Abastecimientos
@endsection

@section('content')

<div class="card panel-info @role('admin', true) panel-info  @endrole">
    <div class="card-header">
            Bienvenido {{ Auth::user()->name }} 
        <div class="float-right">
        @role('admin', true)
            <span class="label label-secondary">
                Admin Access
                </span> @else
            <span class="label label-warning">
                User Access
                </span> @endrole
        </div>
    </div>
    <div class="card-body">
        @if(count($products) > 0)
        @php
            $simbol = Config::find(5)->val;
        @endphp
        @if(session()->has('message'))
            <div class="alert alert-success" role="alert">
                {{ session()->get('message') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
        <br>
        <table class="table table-bordered table-hover">
            <thead>
                <th></th>
                <th>Producto</th>
                <th>Total</th>
                <th>Fecha</th>
                <th></th>
            </thead>
            @foreach($products as $sell)
            <tr>
                <td style="width:30px;"><a href="{{ route('inventario.show', $sell->id) }}" class="btn btn-sm btn-info"><i class="fa fa-eye"></i></a>
                </td>
                <td>
                    @php
                        $operations = Operation::getAllProductsBySellId($sell->id);
                    @endphp
                    {{count($operations)}}
                </td>
                <td>
                    <?php
                        $total=0;
                        foreach($operations as $operation){
                            $product  = $operation->getProduct();
                            $total += $operation->q*$product->price_in;
                        }
                    ?>
                    <b> {{$simbol}} {{number_format($total, 2)}} </b>
                </td>
                <td>
                    {{$sell->created_at}}
                </td>
                <td style="width:30px;">
                    @role('admin') 
                        {!! Form::model($sell, array('action' => array('Invent\InventarioController@destroy', $sell->id), 'method' => 'DELETE', 'class' => 'form-inline', 'data-toggle' => 'tooltip', 'title' => 'Eliminar compra permanente')) !!}
                            {!! Form::hidden('_method', 'DELETE') !!}
                            {!! Form::button('<i class="fas fa-eraser fa-fw" aria-hidden="true"></i> Eliminar', array('class' => 'btn btn-danger btn-sm','type' => 'button', 'style' =>'width: 100%;' ,'data-toggle' => 'modal', 'data-target' => '#confirmDelete', 'data-title' => 'Eliminar Compra Permanente', 'data-message' => 'Esta seguro de eliminar esta compra?')) !!}
                        {!! Form::close() !!}
                    @endrole
                </td>
            </tr>
            @endforeach
        </table>
        @else
        <div class="jumbotron">
            <h2>No hay datos</h2>
            <p>No se ha realizado ninguna operacion.</p>
        </div>
        @endif
    </div>
</div>
@include('modals.modal-delete')
@endsection

@section('footer_scripts')

  @include('scripts.delete-modal-script')
  @include('scripts.tooltips')

@endsection
