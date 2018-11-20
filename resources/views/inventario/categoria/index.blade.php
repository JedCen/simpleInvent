@extends('layouts.app')

@section('htmlheader_title')
    Categorías
@endsection

@section('contentheader_title')
    <i class='fa fa-list'></i> Lista de Categorías
@endsection

@section('template_linked_css')
  <!-- Css Extras -->
@endsection

@section('content')

<div class="container-fluid spark-screen">
        @if (count($errors) > 0)
            <div class="alert alert-danger" data-dismiss="alert" aria-label="Close">
                <strong>Whoops!</strong> {{ trans('message.someproblems') }}<br><br>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="row">
                <div class="col-sm-5">
                    <div class="card panel-default">
                            <div class="card-header">
                                <div class="float-left">
                                        <h4><i class='fa fa-list'></i> Categoría</h4>
                                </div>
                            </div>
                            <div class="card-body">
                            {!! Form::open(['route' => 'categorias.store']) !!}
                                <div class="form-group has-feedback" >
                                    <input type="text" class="form-control" placeholder="{{trans('message.description')}}" name="name" autofocus/>
                                    <span class="glyphicon glyphicon-list form-control-feedback"></span>
                                    
                                </div>
                                <div class="pull-right">
                                    <button type="submit" class="btn btn-info">Agregar</button>
                               </div>
                               
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
                <div class="col-sm-7">
                    <div class="card panel-info">
                            <div class="card-header">
                                <div class="float-left">
                                        <h4><i class='fa fa-list'></i> Lista Categorías</h4>
                                </div>
                            </div>
                            <div class="card-body">
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                    <th>Codigo</th>
                                    <th>Nombre</th>
                                    <th></th>
                                    </tr>
                                </thead>
                                @foreach($categories as $category)
                                <tr class="item{{$category->id}}">
                                    <td style="width:10%;">{{$category->id}}</td>
                                    <td style="width:60%;">{{$category->name}}</td>
                                    <td>
                                    <button class="edit-modal btn btn-info btn-sm" data-toggle="modal" data-target="#editModal-{{$category->id}}">
                                    <span class="fa fa-edit"></span></button>

                                    @include('inventario.categoria.partials.modal')

                                    @role('admin')
                                    {!! Form::model($category, array('action' => array('CategoriaController@destroy', $category->id), 'method' => 'DELETE', 'class' => 'form-inline')) !!}
                                        {!! Form::button('<i class="fa fa-trash fa-fw" aria-hidden="true"></i>', array('class' => 'btn btn-danger btn-sm','type' => 'submit', 'style' =>'width: 100%;')) !!}
                                    {!! Form::close() !!}
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

@endsection

@section('footer_scripts')
<!-- Scripts Extras -->
<script>
    @if(Session::has('message'))
        var type = "{{ Session::get('alert-type', 'info') }}";
        switch(type){
            case 'info':
                toastr.info("{{ Session::get('message') }}", {timeOut: 5000});
                break;
            
            case 'warning':
                toastr.warning("{{ Session::get('message') }}", {timeOut: 5000});
                break;
            case 'success':
                toastr.success("{{ Session::get('message') }}", {timeOut: 5000});
                break;
            case 'error':
                toastr.error("{{ Session::get('message') }}", {timeOut: 5000});
                break;
        }
    @endif
</script>

@endsection
