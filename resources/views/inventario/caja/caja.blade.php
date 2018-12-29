@extends('layouts.app')

@section('htmlheader_title')
    Caja
@endsection

@section('contentheader_title')
    <i class='fa fa-archive'></i> Caja
@endsection
@section('breadcrumbs')
    {{ Breadcrumbs::render('caja') }}
@endsection

@section('template_linked_css')
  <!-- DataTables -->
  <link rel="stylesheet" href="{{asset('plugins/datatables/jquery.dataTables.min.css')}}">
@endsection

@section('content')
    <div class="container-fluid spark-screen">
        <div class="row">
            <div class="col-md-12 col-md">

              <div class="card panel-info @role('admin', true) panel-success  @endrole">
                    <div class="card-header">
                        <div class="float-left">
                            <i class='fa fa-archive'></i> Caja
                        </div>
                        <div class="float-right">
                            <div class="btn-group">
                                @role('admin')
                                    <a href="{{ route('caja.history') }}" class="btn btn-sm btn-secondary "><i class="fa fa-clock"></i> Historial</a>
                                @endrole
                                @if($sells->count()>0)
                                    {!! Form::open(array('route' => 'caja.process', 'method' => 'PUT')) !!}
                                        {!! Form::button('<i class="fa fa-box"></i> Corte caja', array('class' => 'btn btn-sm btn-secondary','type' => 'button', 'data-toggle' => 'modal', 'data-target' => '#confirmSave', 'data-title' => 'Corte de caja', 'data-message' => 'Esta seguro de realizar el corte de caja?')) !!}
                                    {!! Form::close() !!} 
                                @endif
                            </div>
                        </div>
                        <!-- /.box-tools -->
                    </div>
                    <!-- /.box-header -->
                    <div class="card-body">
                        
                        <div class="clearfix"></div>   
                            
                            @if($sells->count()>0)
                            @php
                                $configSimbMon =Config::find(5)->val;
                            @endphp
                            <?php $total_total = 0; ?>
                            
                            <br>
                            <div class="table-responsive">
                            <table id="data-table" class="table table-hover">
                                <thead>
                                    <th></th>
                                    <th>Producto</th>
                                    <th>Total</th>
                                    <th>Fecha</th>
                                </thead>

                                @foreach($sells as $sell)
                                <tr>
                                    <td style="width:30px;">
                                        {{$sell->id}}
                                    </td>
                                    <td>
                                        @php 
                                        $operations = Operation::getAllProductsBySellId($sell->id); 
                                        $product2 ='';
                                        @endphp
                                        
                                        @foreach($operations as $opera)
                                            @php $product2 = $opera->product->name; @endphp
                                        @endforeach
                                        {{$product2}}
                                    </td>
                                    <td>
                                    @php
                                        $total=0;
                                        foreach($operations as $operation){
                                            $product  = $operation->getProduct();
                                            $total += $operation->q*$product->price_out;
                                        }
                                            $total_total += $total;
                                    @endphp 
                                             <b>{{$configSimbMon}} {{number_format($total,2,".",",")}}</b>
                                    </td>
                                    <td>
                                        {{$sell->created_at}}
                                    </td>
                                </tr>
                                @endforeach

                            </table>
                            </div>
                            <hr>
                            <h3>Total: {{$configSimbMon}} {{ number_format($total_total,2,".",",") }}</h3>
                            @else 
                                <div class="jumbotron">
                                    <h2>No hay ventas</h2>
                                    <p>No se ha realizado ninguna venta.</p>
                                </div>
                            @endif
                    </div>
                    <!-- /.box-body -->
                </div>

            </div>
        </div>
    </div>
    @include('modals.modal-save')
@endsection

@section('footer_scripts')
<!-- Scripts Extras -->
    @include('scripts.save-modal-script')
    @include('scripts.datatables')
@endsection
