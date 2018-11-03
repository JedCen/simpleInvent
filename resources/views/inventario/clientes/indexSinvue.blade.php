@extends('layouts.app')

@section('htmlheader_title')
    Clientes
@endsection

@section('contentheader_title')
    <i class='fa fa-user'></i> Lista de clientes
@endsection

@section('template_linked_css')
  <!-- Css Extras -->
@endsection

@section('main-content')
    <div class="container-fluid spark-screen">
        <div class="row">
            <div class="col-md-12">

                <div class="box box-primary @role('admin', true) box-success  @endrole box-solid">
                    <div class="box-header with-border">
                        <h3 class="box-title"><i class="fa fa-user-circle"></i> Lista de clientes</h3>
                        <div class="box-tools pull-right">
                            <a href="index.php?view=newproduct" class="btn btn-primary"><i class="fa fa-user-plus" aria-hidden="true"></i> Agregar Cliente</a>
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                        </div>
                        <!-- /.box-tools -->
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="clearfix"></div> 
                        <div class="box">
                                <div class="box-header">
                                    <h3 class="box-title"></h3>
                                </div>
                            <div class="box-body">
                            <table class="table table-bordered table-striped">
                                <thead class="thead-dark">
                                    <tr>
                                    <th scope="col">Nombre Completo</th>
                                    <th scope="col">RFC</th>
                                    <th scope="col">Dirección</th>
                                    <th scope="col">Telefono</th>
                                    <th scope="col">Email</th>
                                    <th scope="col"></th>
                                    </tr>
                                </thead>
                                @foreach($clientes as $cliente)
                                <tr>
                                    <td>{{$cliente->name}} {{$cliente->lastname}}</td>
                                    <td>
                                        {{$cliente->rfc}}
                                    </td>
                                    <td>{{$cliente->address1}}</td>
                                    <td>{{$cliente->phone1}}</td>
                                    <td>{{$cliente->email1}}</td>
                                    <td style="width:70px;">
                                    <a href="index.php?view=editproduct&id=<?php echo $cliente->id; ?>" class="btn btn-xs btn-warning"><i class="glyphicon glyphicon-pencil"></i></a>

                                    @role('admin')
                                    <a href="index.php?view=delproduct&id=<?php echo $cliente->id; ?>" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i></a>
                                    @endrole
                                    
                                    </td>
                                </tr>
                                @endforeach
                            </table>
                        </div>
                    </div>
                    </div>
                    <!-- /.box-body -->
                </div>

            </div>
        </div>
    </div>
@endsection

@section('footer_scripts')
<!-- Scripts Extras -->
@endsection
