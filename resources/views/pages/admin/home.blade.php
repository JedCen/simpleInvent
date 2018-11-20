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
                        $simbol = Config::find(5)->val;
                    @endphp 
                                            
                    <span class="info-box-number"> {{$simbol}} {{number_format($total,2,".",",")}} </span>
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

<script>
/*
* Funcion para el chart
*/
var url = '/chart';
var Years = new Array();
var Prices = new Array();

$(document).ready(function(){
  $.get(url, function(response){
  response.forEach(function(data){
      Years.push(data.created_at);
      Prices.push(data.total);
  });
if(document.getElementById("myChart") != null){
var ctx = document.getElementById("myChart").getContext('2d');
var myChart = new Chart(ctx, {
          type: 'line',
          data: {
              labels: Years,
              datasets: [{
                  label: 'Venta $',
                  data: Prices,
                  backgroundColor: [
                      'rgba(63, 191, 191, 0.2)',
                  ],
                  borderColor: [
                      'rgba(63,120,132,1)'
                  ],
                  borderWidth: 1
              }]
          },
          options: {
              scales: {
                  yAxes: [{
                      scaleLabel: {
                          display: true,
                          labelString: 'Monto $$'
                      },
                      ticks: {
                          beginAtZero:true
                      }
                  }],
                  xAxes: [{
                      scaleLabel: {
                          display: true,
                          labelString: 'Fecha'
                      }
                  }]
              },
              title: {
                  display: true,
                  text: 'Ventas del Mes'
              }
          }
      });
    }
  });
});
</script>
@endsection
