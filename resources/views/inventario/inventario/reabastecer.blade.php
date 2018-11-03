@extends('layouts.app')
@section('htmlheader_title') Abastecimientos
@endsection

@section('contentheader_title')
<i class="fa fa-history"></i> Abastecimientos
@endsection

@section('content')

<div class="card panel-primary @role('admin', true) panel-info  @endrole">
    <div class="card-header">
            Bienvenido {{ Auth::user()->name }} 
        <div class="float-right">
        @role('admin', true)
            <span class="label label-info">
                Admin Access
                </span> @else
            <span class="label label-warning">
                User Access
                </span> @endrole
        </div>
    </div>
    <div class="card-body">
        @if(count($products) > 0)
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
                        echo "<b>$ ".number_format($total)."</b>";
                    ?>
                </td>
                <td>
                    {{$sell->created_at}}
                </td>
                <td style="width:30px;"><a href="index.php?view=delre&id=<?php echo $sell->id; ?>" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>
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
@endsection
