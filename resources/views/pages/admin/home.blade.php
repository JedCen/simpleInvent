@extends('layouts.app')

@section('htmlheader_title')
    Dashboard
@endsection

@section('template_linked_css')
  <!-- Css Extras -->
 <style>
     user-pan{
        color: #867d7d;
        font-size: 1.25em;
        text-decoration-color: rgba(224, 103, 103, 0.9);
        text-decoration-style: solid;

     }
 </style>
@endsection

@section('contentheader_title')
    <user-pan><i class='fa fa-open'></i> Panel de control </user-pan>
@endsection

@section('content')
        <div class="row">
            <div class="col-md-3 col-sm-6 col-12">
                <div class="info-box">
                <span class="info-box-icon bg-info"><i class="fab fa-product-hunt"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Productos</span>
                    <span class="info-box-number">{{ count($products) }}</span>
                </div>
                <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->
            <div class="col-md-3 col-sm-6 col-12">
                <div class="info-box">
                <span class="info-box-icon bg-success"><i class="fa fa-users"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Clientes</span>
                    <span class="info-box-number"> {{ count($clientes) }} </span>
                </div>
                <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->
            <div class="col-md-3 col-sm-6 col-12">
                <div class="info-box">
                <span class="info-box-icon bg-warning"><i class="fa fa-shopping-cart"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Ventas Mensual</span>
                    <span class="info-box-number"> {{ count($sells) }} </span>
                </div>
                <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->
            <div class="col-md-3 col-sm-6 col-12">
                <div class="info-box">
                <span class="info-box-icon bg-danger"><i class="fa fa-chart-area"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Ingreso Mensual</span>
                    @php
                        $total=0;
                        foreach($sells as $sell){
                            $total += $sell->total;
                        }
                    @endphp 
                                            
                    <span class="info-box-number"> $ {{number_format($total,2,".",",")}} </span>
                </div>
                <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
        <!-- /.col -->
        </div>
        <div class="row">
            <div class="col-12 col-lg-8">
                @include('panels.estadistica-panel')
            </div>
            <div class="col-12 col-lg-4">
                @include('panels.buyup-panel')
            </div>
        </div>
@endsection
@section('footer_scripts')
<!-- Scripts Extras -->
{{ HTML::script('https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.js') }}

@endsection
