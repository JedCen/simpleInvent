@extends('layouts.app')

@section('htmlheader_title')
    Proveedores
@endsection

@section('contentheader_title')
    <i class="fa fa-list"></i> Listas de proveedores
@endsection

@section('template_linked_css')
  <!-- Css Extras -->

  <!-- DataTables -->
<link rel="stylesheet" href="{{asset('bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css')}}">
@endsection

@section('main-content')
    <div class="container-fluid spark-screen">
        <div class="row">
            <div class="col-md-12">

                <div class="box box-success box-solid">
                    <div class="box-header with-border">
                        <h3 class="box-title"><i class="fa fa-user"></i> Proveedores</h3>
                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#createModal">
                            <span class="fa fa-user-plus"></span>&nbsp&nbsp Nuevo proveedor</button>                   
                        </div>
                        <!-- /.box-tools -->
                    </div>
                    @include('inventario.proveedor.partials.modal') 
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="clearfix"></div> 
                        <div class="box">
                                <div class="box-header">
                                    @if(count($errors))            
                                        <div class="container">
                                            <div class="row">
                                                <div class="col-md-8 ">
                                                    <div class="alert alert-danger alert-dismissable fade in">
                                                        <i class="icon fa fa-warning fa-fw" aria-hidden="true"></i>
                                                        <p>Corrige los siguientes errores:</p>
                                                        <ul>
                                                            @foreach($errors->all() as $error)
                                                            <li>{{ $error }}</li>
                                                            @endforeach
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            <div class="box-body">
                            <table id="datatable" class="table table-bordered table-striped">
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
                                @foreach($proveedores as $proveedor)
                                <tr>
                                    <td>{{$proveedor->name}} {{$proveedor->lastname}}</td>
                                    <td>
                                        {{$proveedor->rfc}}
                                    </td>
                                    <td>{{$proveedor->address1}}</td>
                                    <td>{{$proveedor->phone1}}</td>
                                    <td>{{$proveedor->email1}}</td>
                                    <td style="width:70px;">
                                        <button class="btn btn-info btn-xs" data-toggle="modal" data-target="#editModal-{{$proveedor->id}}">
                                        <span class="glyphicon glyphicon-edit"></span></button>   
                                    @role('admin') 
                                        {!! Form::model($proveedor, array('action' => array('ProductoController@destroy', $proveedor->id), 'method' => 'DELETE', 'class' => 'form-inline', 'data-toggle' => 'tooltip', 'title' => 'Eliminar producto permanete')) !!}
                                            {!! Form::hidden('_method', 'DELETE') !!}
                                            {!! Form::button('<i class="fa fa-trash fa-fw" aria-hidden="true"></i>', array('class' => 'btn btn-danger btn-xs','type' => 'button', 'style' =>'width: 100%;' ,'data-toggle' => 'modal', 'data-target' => '#confirmDelete', 'data-title' => 'Eliminar proveedor Permanente', 'data-message' => 'Esta seguro de eliminar el proveedor: ' .$proveedor->name.'?')) !!}
                                        {!! Form::close() !!}
                                    @endrole 
                                    </td>
                                </tr>
                                @include('inventario.proveedor.partials.modaledit')
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
@include('modals.modal-delete')
@endsection

@section('footer_scripts')
<!-- Scripts Extras -->
    @include('scripts.delete-modal-script')
    @include('scripts.toast')
    @include('scripts.datatables')
@endsection
